<?php

namespace FilterEverything\Filter;

if ( ! defined('WPINC') ) {
    wp_die();
}

use FilterEverything\Filter\Shortcodes;
use FilterEverything\Filter\Pro\PluginPro;

class Plugin
{
    private $wpManager;

    public function __construct()
    {
        $this->wpManager = Container::instance()->getWpManager();
        $this->wpManager->init();
        $this->register_hooks();

        new Shortcodes();

        if( defined('MYSIS_FILTERS_PRO') && MYSIS_FILTERS_PRO ){
            new PluginPro();
        }

        if( is_admin() ){
            new Admin();
        }
    }

    public function register_hooks(){
        $postData = Container::instance()->getThePost();
        $getData  = Container::instance()->getTheGet();

        if( ! is_admin() ){
            global $wp_version;

            // Different ParseRequest methods for WP version 6.0 or prior
            if( version_compare( $wp_version, '5.9.3', '>' ) ){
                add_filter( 'do_parse_request', array( $this->wpManager, 'customParseRequest' ), 10, 3 );
            }else{
                add_filter( 'do_parse_request', array( $this->wpManager, 'customParseRequestBefore60' ), 10, 3 );
            }

            add_action( 'parse_request', array( $this->wpManager, 'parseRequest' ) );
            add_action( 'pre_get_posts', array( $this->wpManager, 'addFilterQueryToWpQuery' ), 9999 );

            add_filter( 'posts_where', [ $this->wpManager, 'fixPostsWhereForSearch' ], 10, 2 );
            add_filter( 'post_limits_request', [ $this->wpManager, 'addSQlComment' ], 10, 2 );
            add_action( 'pre_get_posts', array( $this->wpManager, 'fixSearchPostType' ), 9999 );

            add_action( 'template_redirect', [ $this, 'prepareEntities' ] );

            $sorting = new Sorting();
            $sorting->registerHooks();
        }

        add_action( 'body_class', array( $this, 'bodyClass' ) );

        add_action( 'admin_print_styles', array( $this, 'includeAdminCss' ) );
        add_action( 'admin_print_scripts', array( $this, 'includeAdminJs' ) );

        // Do not include JS, if this page is admin or can't contain filters
        if( ! is_admin() ){
            add_action( 'wp_print_styles', array( $this, 'includeFrontCss' ) );
            add_action( 'wp_print_scripts', array( $this, 'includeFrontJs' ) );
            add_action( 'wp_print_styles', array( $this, 'inlineFrontCss' ) );
        }

        add_action( 'wp_footer', [$this, 'footerHtml'] );

        if( ! defined('MYSIS_FILTERS_PRO') ) {
            add_action( 'wp_head', array($this, 'noIndexFilterPages'), 1 );
            //add_filter( 'mayosis_filter_set_default_fields', [ $this, 'addAvailableInProFields' ], 10, 2 );
            add_filter( 'mayosis_pre_save_set_fields', [ $this, 'unsetAvailableInProFields' ] );
        }

        add_filter( 'mayosis_filter_set_default_fields', [ $this, 'addSetTailFields' ], 20, 2 );

        // Disable single search result redirect
        add_filter( 'woocommerce_redirect_single_search_result', '__return_false' );

        add_action( 'save_post', [$this, 'resetTransitions'] );
        add_action( 'delete_post', [$this, 'resetTransitions'] );
        add_action( 'woocommerce_ajax_save_product_variations', [$this, 'resetTransitions'] );

        if( isset( $getData['reset_filters_cache'] ) && $getData['reset_filters_cache'] == true ){
            $this->resetTransitions();
        }

        add_action( 'mayosis_before_filter_set_settings_fields', [$this, 'removeApplyButtonOrderField'] );
        add_filter( 'mayosis_filter_set_prepared_values', [$this, 'handleApplyButtonTextVisibility'] );

        add_action( 'mayosis_cycle_filter_fields', [$this, 'showIncludeExcludeFields'] );

        $woo_shortcodes = array(
            'products',
            'featured_products',
            'sale_products',
            'best_selling_products',
            'recent_products',
            'product_attribute',
            'top_rated_products'
        );

        // Fix caching problem for products queried by shortcode
        foreach ( $woo_shortcodes as $woo_shortcode ){
            add_filter( "shortcode_atts_{$woo_shortcode}", [$this, 'disableCacheProductsShortcode'] );
        }
    }

    public function resetTransitions()
    {
        $em = Container::instance()->getEntityManager();
        $all_filters = $em->getGlobalConfiguredSlugs();

        if( is_array( $all_filters ) ){
            foreach ( $all_filters as $entityEname => $slug ){
                // For terms it should be entity name
                $parts = explode( '#', $entityEname, 2 );
                $e_name = isset( $parts[1] ) ? $parts[1] : '';
                $type   = isset( $parts[0] ) ? $parts[0] : '';

                $terms_transient_key = '';

                if ( in_array( $type, [ 'post_meta_num', 'tax_numeric' ] ) ) {
                    global $wpdb;
                    $key = mysis_get_terms_transient_key(  $type . '_'. $e_name, false );

                    $result = $wpdb->get_results( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '%{$key}%'", ARRAY_A );

                    if ( isset( $result[0]['option_name'] ) ) {
                        $terms_transient_key = str_replace( '_transient_', '', str_replace( '_transient_timeout_', '', $result[0]['option_name'] ) );
                    }
                }

                if( ! $terms_transient_key ){
                    $terms_transient_key    = mysis_get_terms_transient_key( $type . '_'. $e_name );
                }

                $post_ids_transient_key = mysis_get_post_ids_transient_key( $slug );
                $var_meta_transient_key = mysis_get_variations_transient_key( 'attribute_'. $e_name );

                delete_transient( $terms_transient_key );
                delete_transient( $post_ids_transient_key );
                delete_transient( $var_meta_transient_key );
            }
        }

        $variations_key = 'mayosis_posts_variations';
        $filter_key     = 'mayosis_filters_query';

        delete_transient($variations_key);
        delete_transient($filter_key);

        unset( $terms_transient_key, $post_ids_transient_key, $var_meta_transient_key, $all_filters, $em );
    }

    public function prepareEntities()
    {
        $wpManager  = Container::instance()->getWpManager();
        $em         = Container::instance()->getEntityManager();
        $sets       = $wpManager->getQueryVar('mayosis_page_related_set_ids');

        if( $sets ){
            foreach( $sets as $set ){
                $em->prepareEntitiesToDisplay( array( $set ) );
            }
        }
    }


 

    public function addSetTailFields(  $fields, $filterSet )
    {
        $new_fields     = [];
        $insert_after   = defined('MYSIS_FILTERS_PRO') ? 'custom_posts_container' : 'show_count';

        foreach ( $fields as $key => $attributes ){
            // Always insert regular 'old' field
            $new_fields[$key] = $attributes;

            if( $key === $insert_after ){
                $new_fields['use_apply_button'] =  array(
                    'type'          => 'Checkbox',
                    'label'         => esc_html__('Apply mode', 'mayosis-filter'),
                    'name'          => $filterSet->generateFieldName('use_apply_button'),
                    'id'            => $filterSet->generateFieldId('use_apply_button'),
                    'class'         => 'mayosis-field-use-apply-button',
                    'default'       => 'no',
                    'instructions'  => esc_html__('Enables filtering by click on the Apply button', 'mayosis-filter'),
                    'settings'      => true
                );

                $new_fields['apply_button_menu_order'] = array(
                    'type'          => 'Hidden',
                    'label'         => '',
                    'class'         => 'mayosis-menu-order-field',
                    'id'            => $filterSet->generateFieldId('apply_button_menu_order'),
                    'name'          => $filterSet->generateFieldName('apply_button_menu_order'),
                    'default'       => -1,
                    'settings'      => true
                );

                $new_fields['apply_button_text'] = array(
                    'type'          => 'Text',
                    'label'         => esc_html__('Apply Button label', 'mayosis-filter'),
                    'name'          => $filterSet->generateFieldName('apply_button_text'),
                    'id'            => $filterSet->generateFieldId('apply_button_text'),
                    'class'         => 'mayosis-field-apply-button-text',
                    'default'       => esc_html__('Apply', 'mayosis-filter'),
                    'settings'      => true
                );

                $new_fields['reset_button_text'] = array(
                    'type'          => 'Text',
                    'label'         => esc_html__('Reset Button label', 'mayosis-filter'),
                    'name'          => $filterSet->generateFieldName('reset_button_text'),
                    'id'            => $filterSet->generateFieldId('reset_button_text'),
                    'class'         => 'mayosis-field-reset-button-text',
                    'default'       => esc_html__('Reset', 'mayosis-filter'),
                    'settings'      => true
                );
            }
        }

        return $new_fields;
    }

    public function unsetAvailableInProFields( $setFields )
    {
        unset( $setFields['instead_post_name'], $setFields['instead_custom_posts_container'] );

        return $setFields;
    }

    public function noIndexFilterPages()
    {
        if( mysis_is_filter_request() ){
            $robots['index']    = 'noindex';
            $robots['follow']   = 'nofollow';
            $content = implode(', ', $robots );
            echo sprintf('<meta name="robots" content="%s">', $content)."\r\n";
        }
    }

    public function inlineFrontCss()
    {
        if( ! $this->wpManager->getQueryVar('allowed_filter_page') ) {
            return false;
        }

        $maxHeight      = mysis_get_option('container_height');
        $color          = mysis_get_option( 'primary_color', mysis_default_theme_color() );
        $move_to_top    = mysis_get_option('try_move_to_top_sidebar');
        $mayosis_mobile_width = mysis_get_mobile_width();

        // Experimental Options
        $custom_css     = mysis_get_experimental_option('custom_css');
        $use_loader     = mysis_get_experimental_option('use_loader');
        $dark_overlay   = mysis_get_experimental_option('dark_overlay');
        $styled_inputs  = mysis_get_experimental_option('styled_inputs');
        $use_select2    = mysis_get_experimental_option('select2_dropdowns');
        $contrastColor  = false;

        $css = '';

        $css .= '@media screen and (min-width:'.($mayosis_mobile_width+1).'px){.mayosis_show_bottom_widget .mayosis-filters-widget-content{height:auto!important}}@media screen and (min-width:'.$mayosis_mobile_width.'px){.mayosis-custom-selected-terms{clear:both;width:100%}.mayosis-custom-selected-terms ul.mayosis-filter-chips-list{display:flex;overflow-x:auto;padding-left:0}#secondary .mayosis-custom-selected-terms ul.mayosis-filter-chips-list,#sidebar .mayosis-custom-selected-terms ul.mayosis-filter-chips-list,.sidebar .mayosis-custom-selected-terms ul.mayosis-filter-chips-list,.widget-area .mayosis-custom-selected-terms ul.mayosis-filter-chips-list{display:block;overflow:visible}html.is-active .mayosis-filters-overlay{top:0;opacity:.3;background:#fff}body.mayosis_show_open_close_button .mayosis-filters-widget-content.mayosis-closed,body.mayosis_show_open_close_button .mayosis-filters-widget-content.mayosis-opened,body.mayosis_show_open_close_button .mayosis-filters-widget-content:not(.mayosis-opened){display:block!important}.widget-area input.mayosis-label-input+label:hover,.mayosis-filters-widget-main-wrapper input.mayosis-label-input+label:hover{border:1px solid rgba(0,0,0,.25);border-radius:5px}.widget-area input.mayosis-label-input+label:hover span.mayosis-filter-label-wrapper,.mayosis-filters-widget-main-wrapper input.mayosis-label-input+label:hover span.mayosis-filter-label-wrapper{color:#333;background-color:rgba(0,0,0,.25)}.widget-area .mayosis-filters-labels li.mayosis-term-item input+label:hover a,.mayosis-filters-widget-main-wrapper .mayosis-filters-labels li.mayosis-term-item input+label:hover a{color:#333}.theme-storefront #primary .storefront-sorting .mayosis-custom-selected-terms{font-size:inherit}.theme-storefront #primary .mayosis-custom-selected-terms{font-size:.875em}}@media screen and (max-width:'.$mayosis_mobile_width.'px){.mayosis_show_bottom_widget .mayosis-filters-widget-top-container,.mayosis_show_open_close_button .mayosis-filters-widget-top-container{text-align:center}.mayosis_show_bottom_widget .mayosis-filters-widget-top-container{position:sticky;top:0;z-index:99999;border-bottom:1px solid #f7f7f7}.mayosis-custom-selected-terms:not(.mayosis-show-on-mobile),.mayosis-edit-mayosis-filter,.mayosis_show_bottom_widget .widget_mayosis_selected_filters_widget,.mayosis_show_bottom_widget .mayosis-filters-widget-content .mayosis-mayosis-filter-widget-title,.mayosis_show_bottom_widget .mayosis-filters-widget-main-wrapper .widget-title,.mayosis_show_bottom_widget .mayosis-filters-widget-wrapper .mayosis-filter-layout-submit-button,.mayosis_show_bottom_widget .mayosis-posts-found,body.mayosis_show_bottom_widget .mayosis-open-close-filters-button,body.mayosis_show_open_close_button .mayosis-filters-widget-content:not(.mayosis-opened){display:none}.mayosis_show_bottom_widget .mayosis-filters-widget-top-container:not(.mayosis-show-on-desktop),.mayosis_show_bottom_widget .mayosis-spinner.is-active,.mayosis_show_bottom_widget .mayosis-widget-close-container,html.is-active body:not(.mayosis_show_bottom_widget) .mayosis-spinner{display:block}.widget-area li.mayosis-term-item,body .mayosis-filters-widget-main-wrapper li.mayosis-term-item{padding:2px 0}.widget-area ul.mayosis-filters-ul-list,.mayosis-filters-widget-main-wrapper ul.mayosis-filters-ul-list{padding-left:0}.mayosis-chip-empty{width:0;display:list-item;visibility:hidden;margin-right:0!important}.mayosis-overlay-visible #secondary{z-index:auto}html.is-active:not(.mayosis-overlay-visible) .mayosis-filters-overlay{top:0;opacity:.2;background:#fff}.mayosis-custom-selected-terms.mayosis-show-on-mobile ul.mayosis-filter-chips-list{display:flex;overflow-x:auto;padding-left:0}html.is-active body:not(.mayosis_show_bottom_widget) .mayosis-filters-overlay{top:0;opacity:.3;background:#fff}body.mayosis_show_bottom_widget .mayosis-filters-widget-content.mayosis-closed,body.mayosis_show_bottom_widget .mayosis-filters-widget-content.mayosis-opened,body.mayosis_show_bottom_widget .mayosis-filters-widget-content:not(.mayosis-opened){display:block!important}.mayosis-open-close-filters-button{display:block;margin-bottom:20px}.mayosis-overlay-visible body,html.mayosis-overlay-visible{overflow:hidden!important}.mayosis_show_bottom_widget .widget_mayosis_filters_widget,.mayosis_show_bottom_widget .mayosis-filters-widget-main-wrapper{padding:0!important;margin:0!important}.mayosis_show_bottom_widget .mayosis-filters-range-column{width:48%;max-width:none}.mayosis_show_bottom_widget .mayosis-filters-toolbar{display:flex;margin:1em 0}.mayosis_show_bottom_widget .mayosis-inner-widget-chips-wrapper{display:block;padding-left:20px;padding-right:20px}.mayosis_show_bottom_widget .mayosis-filters-widget-main-wrapper .widget-title.mayosis-filter-title-widbar{display:flex}.mayosis_show_bottom_widget .mayosis-inner-widget-chips-wrapper .mayosis-filter-chips-list,.mayosis_show_open_close_button .mayosis-inner-widget-chips-wrapper .mayosis-filter-chips-list{display:flex;-webkit-box-pack:start;place-content:center flex-start;overflow-x:auto;padding-top:5px;padding-bottom:5px;margin-left:0;padding-left:0}.mayosis-overlay-visible .mayosis_show_bottom_widget .mayosis-filters-overlay{top:0;opacity:.4}.mayosis_show_bottom_widget .mayosis-filters-widget-main-wrapper .mayosis-spinner.is-active+.mayosis-filters-widget-content .mayosis-filters-scroll-container .mayosis-filters-widget-wrapper{opacity:.6;pointer-events:none}.mayosis_show_bottom_widget .mayosis-filters-open-button-container{margin-top:1em;margin-bottom:1em}.mayosis_show_bottom_widget .mayosis-filters-widget-content{position:fixed;bottom:0;right:0;left:0;top:5%;z-index:999999;padding:0;background-color:#fff;margin:0;box-sizing:border-box;border-radius:7px 7px 0 0;transition:transform .25s;transform:translate3d(0,120%,0);-webkit-overflow-scrolling:touch;height:auto}.mayosis_show_bottom_widget .mayosis-filters-widget-containers-wrapper{padding:0;margin:0;overflow-y:scroll;box-sizing:border-box;position:fixed;top:56px;left:0;right:0;bottom:0}.mayosis_show_bottom_widget .mayosis-filters-widget-content.mayosis-filters-widget-opened{transform:translate3d(0,0,0)}.theme-twentyfourteen .mayosis_show_bottom_widget .mayosis-filters-widget-content,.theme-twentyfourteen.mayosis_show_bottom_widget .mayosis-filters-scroll-container{background-color:#000}.mayosis_show_bottom_widget .mayosis-filters-section:not(.mayosis-filter-post_meta_num):not(.mayosis-filter-tax_numeric) .mayosis-filter-content ul.mayosis-filters-ul-list,.mayosis_show_open_close_button .mayosis-filters-section:not(.mayosis-filter-post_meta_num):not(.mayosis-filter-tax_numeric) .mayosis-filter-content ul.mayosis-filters-ul-list{max-height:none}.mayosis_show_bottom_widget .mayosis-filters-scroll-container{background:#fff;min-height:100%}.mayosis_show_bottom_widget .mayosis-filters-widget-wrapper{padding:20px 20px 15px}.mayosis-mayosis-filter-dropdown .select2-search--dropdown .select2-search__field,.mayosis-sorting-form select,.mayosis_show_bottom_widget .mayosis-filters-widget-main-wrapper input[type=number],.mayosis_show_bottom_widget .mayosis-filters-widget-main-wrapper input[type=text],.mayosis_show_bottom_widget .mayosis-filters-widget-main-wrapper select,.mayosis_show_bottom_widget .mayosis-filters-widget-main-wrapper textarea{font-size:16px}.mayosis-filter-layout-dropdown .select2-container .select2-selection--single,.mayosis-sorting-form .select2-container .select2-selection--single{height:auto;padding:6px}.mayosis_show_bottom_widget .mayosis-filters-section:not(.mayosis-filter-post_meta_num):not(.mayosis-filter-tax_numeric) .mayosis-filter-content ul.mayosis-filters-ul-list{overflow-y:visible}.theme-twentyeleven #primary,.theme-twentyeleven #secondary{margin-left:0;margin-right:0;clear:both;float:none}#main>.fusion-row{max-width:100%}}'."\r\n";
        // Number of items visible by default in More/Less filters
        $css .= '.mayosis-filter-more-less:not(.mayosis-search-active) .mayosis-filters-ul-list > li:nth-child(-n+'.mysis_more_less_count().'){display: list-item;}'."\r\n";

        if( $maxHeight ){
            $css .= '.mayosis-filters-section:not(.mayosis-filter-more-less):not(.mayosis-filter-post_meta_num):not(.mayosis-filter-tax_numeric):not(.mayosis-filter-layout-dropdown) .mayosis-filter-content:not(.mayosis-filter-has-hierarchy) ul.mayosis-filters-ul-list{
                        max-height: '.$maxHeight.'px;
                        overflow-y: auto;
                }'."\r\n";
        }

        if( $color ){
            $contrastColor = mysis_get_contrast_color($color);
            $css .= '.ui-slider-horizontal .ui-slider-range,.ui-slider .ui-slider-handle{
                        background-color: '.$color.';
                    }
                '."\r\n";

            $css .= '.mayosis-spinner:after {
                        border-top-color: '.$color.';
                    }'."\r\n";

            $css .= '.theme-Avada .mayosis-filter-product_visibility .star-rating:before,
                .mayosis-filter-product_visibility .star-rating span:before{
                    color: '.$color.';
                }'."\r\n";

            $css .= '.theme-twentyfourteen .widget-area input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper,
                .widget-area input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper, 
                .mayosis-filters-widget-main-wrapper input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper{
                        background-color: '.$color.';
                }'."\r\n";

            $css .= '.widget-area input.mayosis-label-input:checked+label, 
                input.mayosis-label-input:checked+label{
                        border-color: '.$color.';
                }'."\r\n";

            // Disabled label
            $css .= '.theme-twentyfourteen .widget-area .mayosis-term-disabled input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper,
                .widget-area .mayosis-term-disabled input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper, 
                .mayosis-filters-widget-main-wrapper .mayosis-term-disabled input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper{
                        background-color: #d8d8d8;
                }'."\r\n";

            $css .= '.widget-area .mayosis-term-disabled input.mayosis-label-input:checked+label, 
                .mayosis-term-disabled input.mayosis-label-input:checked+label{
                        border-color: #d8d8d8;
                }'."\r\n";

            $css .= '.widget-area .mayosis-term-disabled input.mayosis-label-input+label:hover, 
                .mayosis-filters-widget-main-wrapper .mayosis-term-disabled input.mayosis-label-input+label:hover{
                        border-color: #d8d8d8;
                }'."\r\n";

            $css .= '#secondary .widget-area .mayosis-term-disabled  input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper,
                .widget-area .mayosis-term-disabled input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper, 
                .mayosis-filters-widget-main-wrapper .mayosis-term-disabled input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper,
                body#colibri .widget-area .mayosis-term-disabled input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper,
                #secondary .mayosis-filters-labels li.mayosis-term-item.mayosis-term-disabled input:checked+label a,
                .widget-area .mayosis-filters-labels li.mayosis-term-item.mayosis-term-disabled input:checked+label a, 
                .mayosis-filters-widget-main-wrapper .mayosis-filters-labels li.mayosis-term-item.mayosis-term-disabled  input:checked+label a,
                body .mayosis-filters-labels li.mayosis-term-item.mayosis-term-disabled input:checked+label a,
                body#colibri .mayosis-filters-labels li.mayosis-term-item.mayosis-term-disabled input:checked+label a{
                        color: #333333;
                }'."\r\n";
            // End of disabled label

            $css .= '#secondary .mayosis-filters-labels li.mayosis-term-item input:checked+label a,
                #secondary .widget-area input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper,
                .widget-area input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper, 
                .mayosis-filters-widget-main-wrapper input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper,
                .widget-area .mayosis-filters-labels li.mayosis-term-item input:checked+label a, 
                .mayosis-filters-widget-main-wrapper .mayosis-filters-labels li.mayosis-term-item input:checked+label a,
                body .mayosis-filters-labels li.mayosis-term-item input:checked+label a,
                body#colibri .mayosis-filters-labels li.mayosis-term-item input:checked+label a,
                body#colibri .widget-area input.mayosis-label-input:checked+label span.mayosis-filter-label-wrapper{
                        color: '.$contrastColor.';
                }'."\r\n";

            $css .= '#secondary .mayosis-filter-chips-list li.mayosis-filter-chip:not(.mayosis-chip-reset-all) a,
                .widget-area .widget .mayosis-filter-chips-list li.mayosis-filter-chip:not(.mayosis-chip-reset-all) a, 
                body .mayosis-filter-chips-list li.mayosis-filter-chip:not(.mayosis-chip-reset-all) a, 
                body#colibri .mayosis-filter-chips-list li.mayosis-filter-chip:not(.mayosis-chip-reset-all) a,
                .mayosis-filter-chips-list li.mayosis-filter-chip:not(.mayosis-chip-reset-all) a{
                    border-color: '.$color.';
                }'."\r\n";

            $css .= '.widget-area .widget .mayosis-filters-widget-controls-container a.mayosis-filters-apply-button, 
                .widget .mayosis-filters-widget-controls-container a.mayosis-filters-apply-button, 
                .mayosis-filters-widget-main-wrapper .mayosis-filters-widget-controls-container a.mayosis-filters-apply-button,
                .mayosis-filters-widget-main-wrapper a.mayosis-filters-submit-button{
                    border-color: '.$color.';
                    background-color: '.$color.';
                    color: '.$contrastColor.';
                }'."\r\n";

            $css .= '.widget-area .widget .mayosis-filter-chips-list li.mayosis-filter-chip:not(.mayosis-chip-reset-all) a:hover, 
                .mayosis-filter-chips-list li.mayosis-filter-chip:not(.mayosis-chip-reset-all) a:hover{
                    opacity: 0.9;
                }'."\r\n";

            $css .= '.widget-area .widget .mayosis-filter-chips-list li.mayosis-filter-chip:not(.mayosis-chip-reset-all) a:active, 
                .mayosis-filter-chips-list li.mayosis-filter-chip:not(.mayosis-chip-reset-all) a:active{
                    opacity: 0.75;
                }'."\r\n";

            $css .= '.star-rating span,
                .star-rating span:before{
                    color: '.$color.';
                }'."\r\n";

            $css .= 'body a.mayosis-filters-open-widget:active, a.mayosis-filters-open-widget:active, 
                .mayosis-filters-open-widget:active{
                    border-color: '.$color.';
                    background-color: '.$color.';
                    color: '.$contrastColor.';
                }'."\r\n";

            $css .= 'a.mayosis-filters-open-widget:active span.mayosis-icon-line-1:after,
                a.mayosis-filters-open-widget:active span.mayosis-icon-line-2:after,
                a.mayosis-filters-open-widget:active span.mayosis-icon-line-3:after{
                    background-color: '.$color.';
                    border-color: '.$contrastColor.';
                }'."\r\n";

            $css .= 'a.mayosis-filters-open-widget:active .mayosis-icon-html-wrapper span{
                    background-color: '.$contrastColor.';
                }'."\r\n";

            $css .= '@media screen and (min-width: '.$mayosis_mobile_width.'px) {'."\r\n";
            $css .= '.theme-twentyfourteen .widget-area input.mayosis-label-input+label:hover span.mayosis-filter-label-wrapper,
                    .widget-area input.mayosis-label-input+label:hover span.mayosis-filter-label-wrapper, 
                    .mayosis-filters-widget-main-wrapper input.mayosis-label-input+label:hover span.mayosis-filter-label-wrapper{
                        color: '.$contrastColor.';
                        background-color: '.$color.';
                    }'."\r\n";

            $css .= '#secondary .mayosis-filters-labels li.mayosis-term-item input+label:hover a,
                    body .mayosis-filters-labels li.mayosis-term-item input+label:hover a,
                    body#colibri .mayosis-filters-labels li.mayosis-term-item input+label:hover a,
                    .widget-area .mayosis-filters-labels li.mayosis-term-item input+label:hover a, 
                    .mayosis-filters-widget-main-wrapper .mayosis-filters-labels li.mayosis-term-item input+label:hover a{
                        color: '.$contrastColor.';
                    }'."\r\n";
            $css .= '.widget-area input.mayosis-label-input+label:hover, 
                    .mayosis-filters-widget-main-wrapper input.mayosis-label-input+label:hover{
                        border-color: '.$color.';
                    }'."\r\n";

            $css .= '}'."\r\n";
        }
        if( $styled_inputs ){
            $styled_color   = $color ? $color : '#0570e2';
            $contrastColor  = $contrastColor ? $contrastColor : mysis_get_contrast_color($styled_color);

            $css .= '.mayosis-filters-widget-main-wrapper input[type=checkbox],
                        .mayosis-filters-widget-main-wrapper input[type=radio]{
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            position: relative;
                            width: 20px;
                            height: 20px;
                            border: 2px solid #bdbdbd;
                            border: 2px solid #ccd0dc;
                            background: #ffffff;
                            border-radius: 5px;
                            min-width: 20px;
                        }
                        .mayosis-filters-widget-main-wrapper input[type=checkbox]:after {
                            content: "";
                            opacity: 0;
                            display: block;
                            left: 5px;
                            top: 2px;
                            position: absolute;
                            width: 4px;
                            height: 8px;
                            border: 2px solid '.$styled_color.';
                            border-top: 0;
                            border-left: 0;
                            transform: rotate(45deg);
                            box-sizing: content-box;
                        }
                        .mayosis-filters-widget-main-wrapper input[type=radio]:after {
                            content: "";
                            opacity: 0;
                            display: block;
                            left: 4px;
                            top: 4px;
                            position: absolute;
                            width: 8px;
                            height: 8px;
                            border-radius: 50%;
                            background: '.$styled_color.';
                            box-sizing: content-box;
                        }
                        .mayosis-filters-widget-main-wrapper input[type=radio]:checked,
                        .mayosis-filters-widget-main-wrapper input[type=checkbox]:checked {
                            border-color: '.$styled_color.';
                        }
                        .mayosis-filters-widget-main-wrapper .mayosis-radio-item.mayosis-term-disabled input[type=radio],
                        .mayosis-filters-widget-main-wrapper .mayosis-checkbox-item.mayosis-term-disabled > div > input[type=checkbox],
                        .mayosis-filters-widget-main-wrapper .mayosis-checkbox-item.mayosis-term-disabled > div > input[type=checkbox]:after,
                        .mayosis-filters-widget-main-wrapper .mayosis-term-count-0:not(.mayosis-has-not-empty-children) input[type=checkbox]:after,
                        .mayosis-filters-widget-main-wrapper .mayosis-term-count-0:not(.mayosis-has-not-empty-children) input[type=checkbox],
                        .mayosis-filters-widget-main-wrapper .mayosis-term-count-0:not(.mayosis-has-not-empty-children) input[type=radio]{
                            border-color: #d8d8d8;
                        }
                        .mayosis-filters-widget-main-wrapper .mayosis-radio-item.mayosis-term-disabled input[type=radio]:after,
                        .mayosis-filters-widget-main-wrapper .mayosis-term-count-0:not(.mayosis-has-not-empty-children) input[type=radio]:after{
                            background-color: #d8d8d8;
                        }
                        .mayosis-filters-widget-main-wrapper input[type=radio]:checked:after,
                        .mayosis-filters-widget-main-wrapper input[type=checkbox]:checked:after {
                            opacity: 1;
                        }
                        .mayosis-filters-widget-main-wrapper input[type=radio] {
                            border-radius: 50%;
                        }
                        
                        @media screen and (min-width: '.$mayosis_mobile_width.'px) {
                            .mayosis-filters-widget-main-wrapper input[type=radio]:hover,
                            .mayosis-filters-widget-main-wrapper input[type=checkbox]:hover{
                                border-color: '.$styled_color.';
                            }
                            .mayosis-filters-widget-main-wrapper .mayosis-term-count-0:not(.mayosis-has-not-empty-children) input[type=radio]:hover,
                            .mayosis-filters-widget-main-wrapper .mayosis-term-count-0:not(.mayosis-has-not-empty-children) input[type=checkbox]:hover{
                                border-color: #c3c3c3;
                            }
                        }';
        }

        if( $use_select2 ){
            $styled_color   = $color ? $color : '#0570e2';
            $contrastColor  = $contrastColor ? $contrastColor : mysis_get_contrast_color($styled_color);

            $css .= '.mayosis-sorting-form select,
                        .mayosis-filter-content select{
                            padding: 2px 8px 2px 10px;
                            border-color: #ccd0dc;
                            border-radius: 3px;
                            color: inherit;
                            -webkit-appearance: none;
                        }
                        .select2-container--default .mayosis-mayosis-filter-dropdown .select2-results__option--highlighted[aria-selected],
                        .select2-container--default .mayosis-mayosis-filter-dropdown .select2-results__option--highlighted[data-selected]{
                            background-color: '.$styled_color.';
                            color: '.$contrastColor.';  
                        }
                        ';
            $css .= '@media screen and (max-width: '.$mayosis_mobile_width.'px) {'."\r\n";
            $css .=  '.mayosis-sorting-form select,
                        .mayosis-filter-content select{
                            padding: 6px 12px 6px 14px;
                        }';

            $css .= '}'."\r\n";
        }

        if( $move_to_top ){
            $css .= '@media screen and (max-width: '.$mayosis_mobile_width.'px) {'."\r\n";

            $css .= 'body #main,
                        body #content .col-full,
                        .woocommerce-page .content-has-sidebar,
                        .woocommerce-page .has-one-sidebar,
                        .woocommerce-page #main-sidebar-container,
                        .woocommerce-page .theme-page-wrapper,
                        .woocommerce-page #content-area,
                        .theme-jevelin.woocommerce-page .woocomerce-styling,
                        .woocommerce-page .content_wrapper,
                        .woocommerce-page #col-mask,
                        body #main-content .content-area {
                            -js-display: flex;
                            display: -webkit-box;
                            display: -webkit-flex;
                            display: -moz-box;
                            display: -ms-flexbox;
                            display: flex;
                            -webkit-box-orient: vertical;
                            -moz-box-orient: vertical;
                            -webkit-flex-direction: column;
                            -ms-flex-direction: column;
                            flex-direction: column;
                        }
                        body #primary,
                        .woocommerce-page .has-one-sidebar > section,
                        .woocommerce-page .theme-content,
                        .woocommerce-page #left-area,
                        .woocommerce-page #content,
                        .woocommerce-page .sections_group,
                        .woocommerce-page .content-box,
                        body #main-sidebar-container #main {
                            -webkit-box-ordinal-group: 2;
                            -moz-box-ordinal-group: 2;
                            -ms-flex-order: 2;
                            -webkit-order: 2;
                            order: 2;
                        }
                        body #secondary,
                        .woocommerce-page .has-one-sidebar > aside,
                        body aside#mk-sidebar,
                        .woocommerce-page #sidebar,
                        .woocommerce-page .sidebar,
                        body #main-sidebar-container #sidebar {
                            -webkit-box-ordinal-group: 1;
                            -moz-box-ordinal-group: 1;
                            -ms-flex-order: 1;
                            -webkit-order: 1;
                            order: 1;
                        }
                    
                        /*second method first method solve issue theme specific*/
                        .woocommerce-page:not(.single,.page) .btWithSidebar.btSidebarLeft .btContentHolder,
                        body .theme-generatepress.woocommerce #content {
                            display: table;
                        }
                        body .btContent,
                        body .theme-generatepress.woocommerce #primary {
                            display: table-footer-group;
                        }
                        body .btSidebar,
                        body .theme-generatepress.woocommerce #left-sidebar {
                            display: table-header-group;
                        }'."\r\n";
            $css .= '}'."\r\n";
        }

        if( $use_loader ){
            $css .= '@media screen and (min-width: '.$mayosis_mobile_width.'px) {'."\r\n";
            $css .= 'html.is-active .mayosis-spinner{
                                display: block;
                            }';
            $css .= '}'."\r\n";
        }

        if( $dark_overlay ){
            $css .= '@media screen and (min-width: '.$mayosis_mobile_width.'px) {'."\r\n";
            $css .= 'html.is-active .mayosis-filters-overlay{
                            opacity: .15;
                            background: #000000;
                        }';
            $css .= '}'."\r\n";
        }

        if( $custom_css ){
            $css .= $custom_css."\r\n";
        }

        $wp_upload_dir = wp_upload_dir();
        $upload_dir_baseurl = $wp_upload_dir['baseurl'];
        $upload_dir_basepath = $wp_upload_dir['basedir'];

        $cache_dir = $upload_dir_basepath . '/cache/mayosis-filter/';

        if ( ! file_exists( $cache_dir ) ) {
            mkdir($cache_dir, 0777, true);
            chmod($cache_dir, 0777);
        }

        $filename = md5( $css ) . '.css';

        $fileurl  = $upload_dir_baseurl .'/cache/mayosis-filter/' . $filename;
        $filepath = $cache_dir . $filename;

        if ( $css !== '' ) {
            if ( ! file_exists( $filepath ) ) {
                file_put_contents( $filepath, $css );
            }

            if( file_exists( $filepath ) ){
                wp_enqueue_style('mayosis-mayosis-filter-custom', $fileurl );
            }
        }

    }

    public function bodyClass( $classes )
    {
        if( mysis_get_option('show_open_close_button') === 'on' ){
            $classes[] = 'mayosis_show_open_close_button';
        }

        if( mysis_is_filter_request() ){
            $classes[] = 'mayosis_is_filter_request';
        }

        return $classes;
    }

    public static function activate()
    {
        if ( ! get_option('mayosis_filter_settings') ) {
            $default_show_terms_in_content  = [];
            $theme_dependencies             = mysis_get_theme_dependencies();

            if( mysis_is_woocommerce() ){
                $default_show_terms_in_content = ['woocommerce_no_products_found', 'woocommerce_archive_description'];
            }

            if ( isset( $theme_dependencies['chips_hook'] ) && is_array( $theme_dependencies['chips_hook'] ) ) {
                foreach ( $theme_dependencies['chips_hook'] as $compat_chips_hook ) {
                    $default_show_terms_in_content[] = $compat_chips_hook;
                }
            }

            $defaultOptions = array(
                'primary_color'              => '#0570e2',
                'container_height'           => '350',
                'show_open_close_button'     => '',
                'show_terms_in_content'      => $default_show_terms_in_content,
                'widget_debug_messages'      => 'on'
            );

            // PRO default options
            if( defined('MYSIS_FILTERS_PRO') && MYSIS_FILTERS_PRO ){
                $defaultOptions['show_bottom_widget'] = '';
            }

            add_option('mayosis_filter_settings', $defaultOptions );
        }

        if( ! get_option( 'mayosis_filter_experimental' ) ){

            $defaultExperimentalOptions = array(
                'use_loader'        => 'on',
                'use_wait_cursor'   => 'on',
                'dark_overlay'      => 'on',
                'auto_scroll'       => '',
                'styled_inputs'     => '',
                'select2_dropdowns' => ''
            );

            add_option('mayosis_filter_experimental', $defaultExperimentalOptions );
        }
    }

    /**
     * Clears all plugin data: options and posts
     */
    public static function uninstall()
    {
        $active_plugins  = [];
        $allow_to_delete = true;

        if( is_multisite() ){
            $active_plugins = get_site_option('active_sitewide_plugins');
            if( is_array( $active_plugins ) ){
                $active_plugins = array_keys( $active_plugins );
            }
        }else{
            $active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
        }

        $fe_active    = [];
        $to_compare   = [
            'mayosis-filter-pro/mayosis-filter.php',
            'mayosis-filter/mayosis-filter.php'
        ];

        if( ! empty( $active_plugins ) ){
            foreach ( $active_plugins as $plugin_path ){
                if( in_array( $plugin_path, $to_compare ) ){
                    $fe_active[] = $plugin_path;
                }
            }
        }

        if( count( $fe_active ) > 0 ){
            $allow_to_delete = false;
        }

        if( $allow_to_delete ){

            delete_option('mayosis_filter_settings' );
            delete_option('mayosis_indexing_deep_settings' );
            delete_option('mayosis_filter_permalinks' );
            delete_option('mayosis_seo_rules_settings' );
            delete_option('mayosis_filter_experimental' );

            $postTypes = array(
                MYSIS_FILTERS_SET_POST_TYPE,
                MYSIS_FILTERS_POST_TYPE
            );

            if( defined( 'MYSIS_SEO_RULES_POST_TYPE' ) ){
                $postTypes[] = MYSIS_SEO_RULES_POST_TYPE;
            }

            $filterPosts = new \WP_Query(
                array(
                    'posts_per_page' => -1,
                    'post_status' => array('any'),
                    'post_type' => $postTypes,
                    'fields' => 'ids',
                    'suppress_filters' => true
                )
            );

            $filterPostsIds = $filterPosts->get_posts();

            if( ! empty( $filterPostsIds ) ){
                foreach ($filterPostsIds as $post_id) {
                    wp_delete_post( $post_id, true );
                }
            }

        }
    }

    public static function switchTheme() {
        mysis_remove_option('posts_container');
        mysis_remove_option('primary_color');
    }

    public function includeAdminCss()
    {
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
        $ver    = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? rand(0, 1000) : MYSIS_PLUGIN_VER;
        wp_enqueue_style( 'mayosis-mayosis-filter-admin', MYSIS_PLUGIN_DIR_URL . 'assets/css/mayosis-filter-admin'.$suffix.'.css', ['wp-color-picker'], $ver );

        $screen = get_current_screen();
        if( ! is_null( $screen ) && property_exists( $screen, 'base' ) && $screen->base === 'widgets' ){
            wp_enqueue_style('mayosis-widgets', MYSIS_PLUGIN_DIR_URL . 'assets/css/mayosis-widgets' . $suffix . '.css', [], $ver );
        }
    }

    public function includeAdminJs()
    {
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
        $ver    = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? rand(0, 1000) : MYSIS_PLUGIN_VER;
        $select2ver = '4.1.0';

        wp_register_script( 'jquery-tiptip', MYSIS_PLUGIN_DIR_URL . 'assets/js/jquery-tiptip/jquery.tipTip' . $suffix . '.js', array( 'jquery' ), $ver, true );
        wp_enqueue_script('jquery-tiptip');

        wp_enqueue_script('mayosis-filters-admin', MYSIS_PLUGIN_DIR_URL . 'assets/js/mayosis-filters-common-admin' . $suffix . '.js', array( 'jquery', 'jquery-ui-sortable', 'wp-color-picker', 'select2' ), $ver );

        $l10n = array(
            'prefixesOrderAvailableInPro' => esc_html__( 'Editing the order of URL prefixes is available in PRO version', 'mayosis-filter' ),
            'chipsPlaceholder' => esc_html__( 'Select or enter hooks', 'mayosis-filter' )
        );
        wp_localize_script( 'mayosis-filters-admin', 'mayosisFiltersAdminCommon', $l10n );

        wp_enqueue_script( 'select2', MYSIS_PLUGIN_DIR_URL . "assets/js/select2/select2".$suffix.".js", array('jquery'), $select2ver );
        wp_enqueue_style('select2', MYSIS_PLUGIN_DIR_URL . "assets/css/select2/select2".$suffix.".css", '', $select2ver );

        $screen = get_current_screen();

        if( ! is_null( $screen ) && property_exists( $screen, 'base' ) && $screen->base === 'widgets' ){
            wp_enqueue_script('mayosis-widgets', MYSIS_PLUGIN_DIR_URL . 'assets/js/mayosis-widgets' . $suffix . '.js', array('jquery'), $ver );
            $l10n = array(
                'mayosisItemNum'  => esc_html__( 'Item #', 'mayosis-filter')
            );
            wp_localize_script( 'mayosis-widgets', 'mayosisWidgets', $l10n );
        }
    }

    public function includeFrontCss()
    {
        if( ! $this->wpManager->getQueryVar('allowed_filter_page') ) {
            if( mysis_get_option( 'widget_debug_messages' ) !== 'on' ){
                return false;
            }
        }

        $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
        $ver = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? rand(0, 1000) : MYSIS_PLUGIN_VER;
        wp_enqueue_style('mayosis-mayosis-filter', MYSIS_PLUGIN_DIR_URL . 'assets/css/mayosis-filter' . $suffix . '.css', [], $ver);

        $getData  = Container::instance()->getTheGet();
        if( isset( $getData[MYSIS_BEAVER_BUILDER_VAR] ) ){
            wp_enqueue_style('mayosis-widgets', MYSIS_PLUGIN_DIR_URL . 'assets/css/mayosis-widgets' . $suffix . '.css', [], $ver );
        }

    }

    public function footerHtml()
    {
        if( $this->wpManager->getQueryVar( 'allowed_filter_page' ) ){
            echo '<div class="mayosis-filters-overlay"></div>'."\r\n";
        }
    }

    public function includeFrontJs()
    {
        $showBottomWidget   = 'no';
        $ajaxEnabled        = false;
        $autoScroll         = false;
        $waitCursor         = false;
        $mayosisUseSelect2      = false;
        $mayosisPopupCompatMode = false;
        $autoScrollOffset   = apply_filters( 'mayosis_auto_scroll_offset', 150 );
        $mayosis_mobile_width   = mysis_get_mobile_width();
        $per_page           = [];
        $applyButtonSets    = [];
        $queryOnThePageSets = [];
        $sets               = $this->wpManager->getQueryVar('mayosis_page_related_set_ids', []);
        $filterSetService   = Container::instance()->getFilterSetService();

        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
        $ver    = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? rand(0, 1000) : MYSIS_PLUGIN_VER;

        if( mysis_get_option('show_bottom_widget') === 'on' ) {
            $showBottomWidget = 'yes';
        }

        if( mysis_get_option('enable_ajax') === 'on' ){
            $ajaxEnabled = true;
        }

        if( mysis_get_experimental_option('auto_scroll') === 'on' ){
            $autoScroll = true;
        }

        if( mysis_get_experimental_option( 'use_wait_cursor' ) === 'on' ){
            $waitCursor = true;
        }

        if( mysis_get_option('bottom_widget_compatibility') ){
            $mayosisPopupCompatMode = true;
        }

        //@todo This appears on login page and produce not an array error
        foreach( $sets as $set ){
            if( $set['filtered_post_type'] === 'product' && function_exists('wc_get_default_products_per_row') ){
                $numberposts = apply_filters( 'loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page() );
            }else{
                $numberposts = get_option( 'posts_per_page' );
            }

            $per_page[ $set['ID'] ] = intval($numberposts);
            $theSet = $filterSetService->getSet($set['ID']);

            if( isset( $set['query_on_the_page'] ) && $set['query_on_the_page'] ){
                if( (int) $set['ID'] > 0 ) {
                    $queryOnThePageSets[] = (int) $set['ID'];
                }
            }

            if( isset( $theSet['use_apply_button']['value'] ) && $theSet['use_apply_button']['value'] === 'yes' ){
                if( (int) $set['ID'] > 0 ){
                    $applyButtonSets[] = (int) $set['ID'];
                }
            }
        }

        $per_page = apply_filters( 'mayosis_filter_sets_posts_per_page', $per_page );

        $mayosisPostContainers = apply_filters( 'mayosis_posts_containers', mysis_get_option( 'posts_container', mysis_default_posts_container() ) );

        wp_register_script( 'wc-jquery-ui-touchpunch', MYSIS_PLUGIN_DIR_URL . 'assets/js/jquery-ui-touch-punch/jquery-ui-touch-punch'.$suffix.'.js', [], $ver, true );
        wp_enqueue_script('mayosis-mayosis-filter', MYSIS_PLUGIN_DIR_URL . 'assets/js/mayosis-filter'.$suffix.'.js', array('jquery', 'jquery-ui-slider', 'wc-jquery-ui-touchpunch'), $ver, true );

        if( mysis_get_experimental_option('select2_dropdowns') === 'on' ){
            $select2ver = '4.1.0';
            $mayosisUseSelect2 = 'yes';
            wp_enqueue_script( 'select2', MYSIS_PLUGIN_DIR_URL . "assets/js/select2/select2".$suffix.".js", array('jquery'), $select2ver );
            wp_enqueue_style('select2', MYSIS_PLUGIN_DIR_URL . "assets/css/select2/select2".$suffix.".css", '', $select2ver );
        }

        wp_localize_script( 'mayosis-mayosis-filter', 'mayosisFilterFront',
            array(
                'ajaxUrl'                    => admin_url('admin-ajax.php'),
                'mayosisAjaxEnabled'             => $ajaxEnabled,
                'mayosisStatusCookieName'        => MYSIS_FOLDING_COOKIE_NAME,
                'mayosisMoreLessCookieName'      => MYSIS_MORELESS_COOKIE_NAME,
                'mayosisHierarchyListCookieName' => MYSIS_HIERARCHY_LIST_COOKIE_NAME,
                'mayosisWidgetStatusCookieName'  => MYSIS_OPEN_CLOSE_BUTTON_COOKIE_NAME,
                'mayosisMobileWidth'             => $mayosis_mobile_width,
                'showBottomWidget'           => $showBottomWidget,
                '_nonce'                     => wp_create_nonce('mayosisNonceFront'),
                'mayosisPostContainers'          => $mayosisPostContainers,
                'mayosisAutoScroll'              => $autoScroll,
                'mayosisAutoScrollOffset'        => $autoScrollOffset,
                'mayosisWaitCursor'              => $waitCursor,
                'mayosisPostsPerPage'            => $per_page,
                'mayosisUseSelect2'              => $mayosisUseSelect2,
                'mayosisPopupCompatMode'         => $mayosisPopupCompatMode,
                'mayosisApplyButtonSets'         => $applyButtonSets,
                'mayosisQueryOnThePageSets'      => $queryOnThePageSets
            )
        );

        $getData  = Container::instance()->getTheGet();
        if( isset( $getData[MYSIS_BEAVER_BUILDER_VAR] ) ){
            wp_enqueue_script('mayosis-widgets', MYSIS_PLUGIN_DIR_URL . 'assets/js/mayosis-widgets' . $suffix . '.js', array('jquery'), $ver );
            $l10n = array(
                'mayosisItemNum'  => esc_html__( 'Item #', 'mayosis-filter')
            );
            wp_localize_script( 'mayosis-widgets', 'mayosisWidgets', $l10n );
        }
    }

    public function removeApplyButtonOrderField( &$set_settings_fields )
    {
        unset( $set_settings_fields['apply_button_menu_order'] );
    }

    public function handleApplyButtonTextVisibility( $filterSetFields )
    {
        if( isset( $filterSetFields['use_apply_button']['value'] ) && $filterSetFields['use_apply_button']['value'] === 'yes' ){
            $filterSetFields['apply_button_text']['additional_class'] = 'mayosis-opened';
            $filterSetFields['reset_button_text']['additional_class'] = 'mayosis-opened';
        }

        return $filterSetFields;
    }

    public function disableCacheProductsShortcode( $out )
    {
        $wpManager          = Container::instance()->getWpManager();
        $is_filter_request  = $wpManager->getQueryVar('mayosis_is_filter_request');
        $thePost            = Container::instance()->getThePost();
        $action             = isset( $thePost['action'] ) ? $thePost['action'] : false;

        // mayosis_get_wp_queries - action to get WP_Queries on a page
        if( isset( $out['cache'] ) && ( $is_filter_request || $action === 'mayosis_get_wp_queries' ) ){
            $out['cache'] = false;
        }

        return $out;
    }

    public function showIncludeExcludeFields( &$filter )
    {
        $includeExclude = mysis_extract_vars( $filter, array('exclude', 'include') );
        if( $includeExclude ):

            ?><tr class="<?php echo esc_attr( mysis_filter_row_class( $includeExclude['exclude'] ) ); ?>"<?php mysis_maybe_hide_row( $includeExclude['exclude'] ); ?>><?php

            mysis_include_admin_view('filter-field-label', array(
                    'field_key'  => 'exclude',
                    'attributes' => $includeExclude['exclude']
                )
            );
            ?>
            <td class="mayosis-filter-field-td mayosis-filter-field-include-exclude-td">
                <div class="mayosis-filter-field-include-exclude-wrap">
                    <div class="mayosis-field-wrap mayosis-field-exclude-wrap <?php if( isset( $includeExclude['exclude']['id'] ) ){ echo esc_attr( $includeExclude['exclude']['id'] ); } ?>-wrap">
                        <?php echo mysis_render_input( $includeExclude['exclude'] ); // Already escaped in function ?>
                        <?php do_action('mayosis_after_filter_input', $includeExclude['exclude'] ); ?>
                    </div>
                    <div class="mayosis-field-wrap mayosis-field-include-wrap <?php if( isset( $includeExclude['include']['id'] ) ){ echo esc_attr( $includeExclude['include']['id'] ); } ?>-wrap">
                        <?php echo mysis_render_input( $includeExclude['include'] ); // Already escaped in function ?>
                        <?php do_action('mayosis_after_filter_input', $includeExclude['include'] ); ?>
                    </div>
                </div>
            </td>
            </tr><?php

        endif;
    }
}