<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

use \FilterEverything\Filter\Container;
use \FilterEverything\Filter\FilterSet;
use \FilterEverything\Filter\FilterFields;
use \FilterEverything\Filter\PostMetaNumEntity;

function mysis_the_set( $set_id = 0 ){
    global $mysis_sets;

    if( function_exists('brizy_load' ) ){
        if( ! did_action('wp_print_scripts') ) {
            return false;
        }
    }

    if( $set_id ){
        foreach ( $mysis_sets as $k => $set ){
            if( $set['ID'] === $set_id ){
                unset( $mysis_sets[$k] );
                return $set;
            }
        }
    }

    return array_shift( $mysis_sets );
}

function mysis_print_filters_for( $hook = '' ) {
    global $wp_filter;
    if( empty( $hook ) || !isset( $wp_filter[$hook] ) )
        return;
    return $wp_filter[$hook];
}

function mysis_is_filter_request()
{
    $wpManager = Container::instance()->getWpManager();
    return $wpManager->getQueryVar('mayosis_is_filter_request');
}

function mysis_include($filename )
{
    $path = mysis_get_path( $filename );

    if( file_exists($path) ) {
        include_once( $path );
    }
}

function mysis_get_path($path = '' )
{
    return MYSIS_PLUGIN_DIR_PATH . ltrim($path, '/');
}

function mysis_ucfirst($text )
{
    if( ! is_string( $text ) ){
        return $text;
    }
    return mb_strtoupper( mb_substr( $text, 0, 1 ) ) . mb_substr( $text, 1 );
}

function mysis_sanitize_tooltip($var )
{
    return htmlspecialchars(
        wp_kses(
            html_entity_decode( $var ),
            array(
                'br'     => array(),
                'em'     => array(),
                'strong' => array(),
                'small'  => array(),
                'span'   => array(),
                'ul'     => array(),
                'li'     => array(),
                'ol'     => array(),
                'p'      => array(),
                'a'      => array('href'=>true)
            )
        )
    );
}

function mysis_help_tip($tip, $allow_html = false )
{
    if ( $allow_html ) {
        $tip = mysis_sanitize_tooltip( $tip );
    } else {
        $tip = esc_attr( $tip );
    }

    return '<span class="mayosis-help-tip" data-tip="' . $tip . '"></span>';
}

function mysis_tooltip($attr )
{
    if( ! isset( $attr['tooltip'] ) || ! $attr['tooltip'] ){
        return false;
    }

    return mysis_help_tip($attr['tooltip'], true);
}

function mysis_field_instructions($attr)
{
    if( ! isset( $attr['instructions'] ) || ! $attr['instructions'] ){
        return false;
    }
    $instructions = wp_kses(
        $attr['instructions'],
        array(
            'br' => array(),
            'span' => array('class'=>true),
            'strong' => array(),
            'a' => array('href'=>true, 'title'=>true)
        )
    );
    return '<p class="mayosis-field-description">'.$instructions.'</p>';
}

function mysis_add_query_arg(...$args ) {
    if ( is_array( $args[0] ) ) {
        if ( count( $args ) < 2 || false === $args[1] ) {
            $uri = $_SERVER['REQUEST_URI'];
        } else {
            $uri = $args[1];
        }
    } else {
        if ( count( $args ) < 3 || false === $args[2] ) {
            $uri = $_SERVER['REQUEST_URI'];
        } else {
            $uri = $args[2];
        }
    }

    $frag = strstr( $uri, '#' );
    if ( $frag ) {
        $uri = substr( $uri, 0, -strlen( $frag ) );
    } else {
        $frag = '';
    }

    if ( 0 === stripos( $uri, 'http://' ) ) {
        $protocol = 'http://';
        $uri      = substr( $uri, 7 );
    } elseif ( 0 === stripos( $uri, 'https://' ) ) {
        $protocol = 'https://';
        $uri      = substr( $uri, 8 );
    } else {
        $protocol = '';
    }

    if ( strpos( $uri, '?' ) !== false ) {
        list( $base, $query ) = explode( '?', $uri, 2 );
        $base                .= '?';
    } elseif ( $protocol || strpos( $uri, '=' ) === false ) {
        $base  = $uri . '?';
        $query = '';
    } else {
        $base  = '';
        $query = $uri;
    }

    wp_parse_str( $query, $qs );

    if ( is_array( $args[0] ) ) {
        foreach ( $args[0] as $k => $v ) {
            $qs[ $k ] = $v;
        }
    } else {
        $qs[ $args[0] ] = $args[1];
    }

    foreach ( $qs as $k => $v ) {
        if ( false === $v ) {
            unset( $qs[ $k ] );
        }
    }

    $ret = build_query( $qs );
    $ret = trim( $ret, '?' );
    $ret = preg_replace( '#=(&|$)#', '$1', $ret );
    $ret = $protocol . $base . $ret . $frag;
    $ret = rtrim( $ret, '?' );
    return $ret;
}

/**
 * @param $terms array
 * @param $keys array
 *
 * @return array Array of objects with required keys
 */
function mysis_extract_objects_vars( $terms, $keys = [] )
{
    $required = [];

    foreach ( $terms as $i => $term ) {
        $new_object = new \stdClass();

        foreach( $keys as $key ) {
            if( isset( $term->$key ) ){
                $new_object->$key = $term->$key;
                $required[$term->term_id] = $new_object;
            }
        }
    }

    return $required;
}


function mysis_remove_level_array( $array )
{
    /**
     * @feature maybe rewrite this full of shame code
     */
    if( ! is_array( $array ) ){
        return [];
    }

    $flatten = [];

    array_map( function ($a) use(&$flatten){
        if( is_array( $a ) ){
            $flatten = array_merge($flatten, $a);
        }
    },
        $array );

    return $flatten;
}

function mysis_get_forbidden_prefixes()
{
    //@todo it seems all existing tax prefixes should be there
    // All them actual only when permalinks off
    $forbidden_prefixes = [];
    $permalinksEnabled = defined('MYSIS_PERMALINKS_ENABLED') ? MYSIS_PERMALINKS_ENABLED : false;
    if( ! $permalinksEnabled ) {
        $forbidden_prefixes = array_merge( $forbidden_prefixes, array('cat', 'tag', 'page', 'author') );
    }

    if( mysis_wpml_active() ){
        $wpml_url_format = apply_filters( 'wpml_setting', 0, 'language_negotiation_type' );
        if( $wpml_url_format === '3' ){
            $forbidden_prefixes[] = 'lang';
        }
    }

    return apply_filters( 'mayosis_forbidden_prefixes', $forbidden_prefixes );
}

function mysis_get_forbidden_meta_keys()
{
    $forbidden_meta_keys = array('mayosis_filter_set_post_type', 'mayosis_seo_rule_post_type');
    return apply_filters( 'mayosis_forbidden_meta_keys', $forbidden_meta_keys );
}

function mysis_array_contains_duplicate($array )
{
    return count($array) != count( array_unique($array) );
}

function mysis_maybe_hide_row( $atts )
{
    if( $atts['type'] === 'Hidden' ){
        echo ' style="display:none;"';
    }
}
function mysis_filter_row_class( $field_atts )
{
    $classes = [ 'mayosis-filter-tr' ];
    if( isset( $field_atts['class'] ) ){
        $classes[] = $field_atts['class'] . '-tr';
    }

    if( isset( $field_atts['additional_class'] ) ){
        $classes[] = $field_atts['additional_class'];
    }

    return implode(" ", $classes);
}


function mysis_include_admin_view($path, $args = [] )
{
    $templateManager = Container::instance()->getTemplateManager();
    $templateManager->includeAdminView( $path, $args );
}

function mysis_include_front_view($path, $args = [] )
{
    $templateManager = Container::instance()->getTemplateManager();
    $templateManager->includeFrontView( $path, $args );
}

function mysis_create_filters_nonce()
{
    return FilterSet::createNonce();
}

function mysis_get_filter_fields_mapping()
{
    return Container::instance()->getFilterFieldsService()->getFieldsMapping();
}

function mysis_get_configured_filters($post_id )
{
    $filterFields   = Container::instance()->getFilterFieldsService();
    return $filterFields->getFiltersInputs( $post_id );
}

function mysis_get_filter_view_name($view_key )
{
    $view_options = FilterFields::getViewOptions();
    if( isset( $view_options[ $view_key ] ) ){
        return esc_html($view_options[ $view_key ]);
    }

    return esc_html($view_key);
}

function mysis_get_filter_entity_name($entity_key )
{
    $em = Container::instance()->getEntityManager();
    $entities = $em->getPossibleEntities();

    foreach( $entities as $key => $entity_array ){
        if( isset( $entity_array['entities'][ $entity_key ] ) ){
            return esc_html($entity_array['entities'][ $entity_key ]);
        }
    }

    if( $entity_key === 'post_meta_exists' && ! defined('MYSIS_FILTERS_PRO') ){
        return esc_html__('Available in PRO', 'mayosis-filter');
    }

    return esc_html($entity_key);
}

function mysis_get_set_settings_fields($post_id)
{
    $filterSet = Container::instance()->getFilterSetService();
    return $filterSet->getSettingsTypeFields( $post_id );
}

function mysis_render_input( $atts )
{
    $className = isset( $atts['type'] ) ? '\FilterEverything\Filter\\' . $atts['type'] : '\FilterEverything\Filter\Text';

    if( class_exists( $className ) ){
        $input = new $className( $atts );
        return $input->render();
    }

    return false;
}

function mysis_extract_vars(&$array, $keys )
{
    $r = [];
    foreach( $keys as $key ) {
        $var = mysis_extract_var( $array, $key );
        if( $var ){
            $r[ $key ] = $var;
        }
    }
    return $r;
}

function mysis_extract_var(&$array, $key, $default = null )
{
    // check if exists
    // - uses array_key_exists to extract NULL values (isset will fail)
    if( is_array($array) && array_key_exists($key, $array) ) {
        $v = $array[ $key ];
        unset( $array[ $key ] );
        return $v;
    }
    return $default;
}

function mysis_get_empty_filter( $set_id )
{
    $filterFields = Container::instance()->getFilterFieldsService();
    return $filterFields->getEmptyFilterObject( $set_id );
}

function mysis_excluded_taxonomies()
{
    $excluded_taxonomies = array(
        'nav_menu',
        'link_category',
        'post_format',
        'template_category',
        'element_category',
        'fusion_tb_category',
        'slide-page',
        'elementor_font_type',
        'post_translations',
        'term_language',
        'term_translations'
    );

    return apply_filters( 'mayosis_excluded_taxonomies', $excluded_taxonomies );
}

function mysis_force_non_unique_slug($notNull, $originalSlug )
{
    return $originalSlug;
}

function mysis_redirect_to_error($post_id, $errors )
{
    $redirect = get_edit_post_link( $post_id, 'url' );
    $error_code = 20; // Default error code

    if( !empty( $errors ) && is_array( $errors ) ){
        $error_code = reset( $errors );
    }

    $redirect = add_query_arg( 'message', $error_code, $redirect );
    wp_redirect( $redirect );
    exit;
}

function mysis_sanitize_int($var )
{
    return preg_replace('/[^\d]+/', '', $var );
}

function mysis_range_input_name($meta_key, $edge = 'min' )
{
    return PostMetaNumEntity::inputName( $meta_key, $edge );
}

function mysis_query_string_form_fields($values = null, $exclude = [], $current_key = '', $return = false ) {

    $filter_everything_exclude = array_keys( apply_filters( 'mayosis_unnecessary_get_parameters', [] ) );
    $exclude = array_merge( $exclude, $filter_everything_exclude );

    if ( is_null( $values ) ) {
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        $values = Container::instance()->getTheGet();
        // For compatibility with some Nginx configurations
        unset($values['q']);
    } elseif ( is_string( $values ) ) {
        $url_parts = wp_parse_url( $values );
        $values    = [];

        if ( ! empty( $url_parts['query'] ) ) {
            // This is to preserve full-stops, pluses and spaces in the query string when ran through parse_str.
            $replace_chars = array(
                '.' => '{dot}',
                '+' => '{plus}',
            );

            $query_string = str_replace( array_keys( $replace_chars ), array_values( $replace_chars ), $url_parts['query'] );

            // Parse the string.
            parse_str( $query_string, $parsed_query_string );

            // Convert the full-stops, pluses and spaces back and add to values array.
            foreach ( $parsed_query_string as $key => $value ) {
                $new_key            = str_replace( array_values( $replace_chars ), array_keys( $replace_chars ), $key );
                $new_value          = str_replace( array_values( $replace_chars ), array_keys( $replace_chars ), $value );
                $values[ $new_key ] = $new_value;
            }
        }
    }
    $html = '';

    foreach ( $values as $key => $value ) {
        if ( in_array( $key, $exclude, true ) ) {
            continue;
        }
        if ( $current_key ) {
            $key = $current_key . '[' . $key . ']';
        }
        if ( is_array( $value ) ) {
            $html .= mysis_query_string_form_fields( $value, $exclude, $key, true );
        } else {
            $html .= '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( wp_unslash( $value ) ) . '" />';
        }
    }

    if ( $return ) {
        return $html;
    }

    echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

function mysis_get_query_string_parameters()
{
    $container  = Container::instance();
    $get        = $container->getTheGet();
    $post       = $container->getThePost();

    // For compatibility with some Nginx configurations
    unset($get['q']);

    if( isset( $post['mysis_ajax_link'] ) ){
        $parts = parse_url( $post['mysis_ajax_link'] );
        if( isset( $parts['query'] ) ){
            parse_str( $parts['query'], $output );
            return $output;
        }
    }

    return $get;
}

function mysis_count($term, $show = 'yes' )
{
    if( $show === 'yes' ) :
        echo mysis_get_count( $term );
    endif;
}

/**
 * @since 1.0.5
 * @param $term
 * @return string
 */
function mysis_get_count( $term ){
    return '<span class="mayosis-term-count">(<span class="mayosis-term-count-value">'.esc_html( $term->cross_count ).'</span>)</span>';
}

if ( ! function_exists( 'mysis_spinner_html' ) ) {
    function mysis_spinner_html()
    {
        return '<div class="mayosis-spinner"></div>';
    }
}

function mysis_filters_widget_content_class( $setId )
{
    if ( isset( $_COOKIE[ MYSIS_OPEN_CLOSE_BUTTON_COOKIE_NAME ] ) ) {

        if ( $_COOKIE[ MYSIS_OPEN_CLOSE_BUTTON_COOKIE_NAME ] === $setId ) {
            return ' mayosis-opened';
        }else{
            return ' mayosis-closed';
        }
    }
}

function mysis_filters_button( $setId = 0, $class = '' )
{
    /**
     * @feature add nice wrapper to this functions to allow users put it into themes.
     */
    $classes         = [];
    $sets            = [];
    $wpManager       = \FilterEverything\Filter\Container::instance()->getWpManager();
    $templateManager = \FilterEverything\Filter\Container::instance()->getTemplateManager();

    if( ! $wpManager->getQueryVar( 'allowed_filter_page' ) ){
        return false;
    }

    $draft_sets = $wpManager->getQueryVar('mayosis_page_related_set_ids');

    foreach ( $draft_sets as $set ){
        if( isset( $set['show_on_the_page'] ) && $set['show_on_the_page'] ){
            $sets[] = $set;
        }
    }

    if( ! $setId && isset( $sets[0]['ID'] ) ){
        $setId = $sets[0]['ID'];
    }

    foreach ( $sets as $set ){
        if( $set['ID'] === $setId ){
            $theSet = $set;
            break;
        }
    }

    if( mysis_get_option('show_bottom_widget') === 'on' ){
        $classes[] = 'mayosis-filters-open-widget';
    }else{
        $classes[] = 'mayosis-open-close-filters-button';
    }

    if( $class ){
        $classes[] = trim($class);
    }

    $attrClass = implode(" ", $classes);
    $setId = preg_replace('/[^\d]+/', '', $setId);

    $mayosis_found_posts = NULL;

    if( $wpManager->getQueryVar('mayosis_is_filter_request' ) ){
        $mayosis_found_posts = mysis_posts_found_quantity( $setId );
    }

    $templateManager->includeFrontView( 'filters-button', array( 'mayosis_found_posts' => $mayosis_found_posts, 'class' => $attrClass, 'set_id' => $setId ) );
}

function mysis_posts_found( $setid = 0 )
{
    $templateManager = \FilterEverything\Filter\Container::instance()->getTemplateManager();
    $fss             = \FilterEverything\Filter\Container::instance()->getFilterSetService();
    $count           = mysis_posts_found_quantity( $setid );

    $theSet          = $fss->getSet( $setid );
    $postType        = isset( $theSet['post_type']['value'] ) ? $theSet['post_type']['value'] : '';

    $obj             = get_post_type_object($postType);
    $pluralLabel     = isset( $obj->label ) ? apply_filters( 'mayosis_label_singular_posts_found_msg', $obj->label ) : esc_html__('items', 'mayosis-filter');
    $singularLabel   = isset( $obj->labels->singular_name ) ? apply_filters( 'mayosis_label_plural_posts_found_msg', $obj->labels->singular_name ) : esc_html__('item', 'mayosis-filter');

    $templateManager->includeFrontView( 'posts-found', array( 'posts_found_count' => $count, 'singular_label' => $singularLabel, 'plural_label' => $pluralLabel) );
}

function mysis_get_option( $key, $default = false )
{
    $settings = get_option('mayosis_filter_settings');

    if( isset( $settings[$key] ) ){
        return apply_filters( 'mayosis_get_option', $settings[$key], $key);
    }

    if( $default ){
        return $default;
    }

    return false;

}

function mysis_remove_option($key )
{
    $settings = get_option('mayosis_filter_settings');

    if (isset($settings[$key]) && $settings[$key]) {
        unset($settings[$key]);
        return update_option('mayosis_filter_settings', $settings);
    }

    return false;
}

function mysis_get_experimental_option($key, $default = false )
{
    /**
     * @todo This should be rewritten
     */
    $settings = get_option('mayosis_filter_experimental');

    if( isset( $settings[$key] ) ){
        return apply_filters( 'mayosis_get_option', $settings[$key], $key);
    }

    if( $default ){
        return apply_filters( 'mayosis_get_option', $default, $key);
    }

    return apply_filters( 'mayosis_get_option', false, $key );

}

function mysis_get_status_css_class( $id, $cookieName, $classes = [ 'opened' => 'mayosis-opened', 'closed' => 'mayosis-closed' ] ){

    if ( isset( $_COOKIE[ $cookieName ] ) ) {
        $openediDs = explode(",", $_COOKIE[ $cookieName ] );

        if ( in_array( $id, $openediDs ) ) {
            return $classes['opened'];
        } elseif ( in_array( -$id, $openediDs ) ) {
            return $classes['closed'];
        } else {
            return '';
        }
    }

    return '';
}

function mysis_filter_header( $filter, $terms )
{
    $openButton     = ($filter['collapse'] === 'yes') ? '<button><span class="mayosis-wrap-icons">' : '';
    $closeButton    = ($filter['collapse'] === 'yes') ? '</span><span class="mayosis-open-icon"></span></button>' : '';
    $tooltip        = '';

    if ($filter['collapse'] === 'yes' && !empty($filter['values']) && !empty($terms)) {
        $selected = [];
        $list = '<div class="mayosis-filter-selected-values">&mdash; ';

        foreach ( $terms as $id => $term_object ) {
            if ( in_array( $term_object->slug, $filter['values'] ) ) {
                $selected[] = $term_object->name;
            }
        }

        $list .= implode(", ", $selected) . '</div>';

        $closeButton = $list . $closeButton;
    }

    if( isset( $filter['tooltip'] ) && $filter['tooltip'] ){
        $tooltip = mysis_help_tip( $filter['tooltip'], true );
    }
    $filter_label = apply_filters( 'mayosis_filter_label', $filter['label'] );
    ?>
    <div class="mayosis-filter-header">
        <div class="widget-title mayosis-filter-title-widbar">
            <?php echo $openButton . esc_html( $filter_label ) . $tooltip . $closeButton;  ?>
        </div>
    </div>
    <?php
}

function mysis_filter_class( $filter, $default_classes = [], $terms = [], $args = [] )
{
    $classes = array(
        'mayosis-filters-section',
        'mayosis-filters-section-'.esc_attr( $filter['ID'] ),
        'mayosis-filter-'.esc_attr( $filter['e_name'] ),
        'mayosis-filter-'.esc_attr( $filter['entity'] ),
        'mayosis-filter-layout-'.esc_attr( $filter['view'] )
    );

    if ( isset( $filter['values'] ) && ! empty( $filter['values'] ) ) {
        $classes[] = 'mayosis-filter-has-selected';
    }

    // Set correct more/less class for specific views
    if ( in_array( $filter['view'], [ 'checkboxes', 'radio', 'labels' ] ) ) {
        if ( isset( $filter['more_less'] ) && $filter['more_less'] === 'yes' ) {

            $classes[] = 'mayosis-filter-more-less';

            if ( in_array( $filter['ID'], mysis_more_less_opened() ) ) {
                $classes[] = 'mayosis-show-more-reverse';
            }

            $classes[] = mysis_get_status_css_class( $filter['ID'], MYSIS_MORELESS_COOKIE_NAME, [ 'opened' => 'mayosis-show-more', 'closed' => 'mayosis-show-less'] );

            // We have to count only first-level terms if hierarchy is enabled
            if( isset( $filter['hierarchy'] ) && $filter['hierarchy'] === 'yes' ) {
                if ( ! empty( $terms ) ) {
                    $only_parents = [];
                    foreach ( $terms as $term_id => $term ) {
                       if ( $term->parent == 0 ) {
                           $only_parents[ $term_id ] = $term;
                       }
                    }

                    $terms = $only_parents;
                    unset( $only_parents );
                }
            }

            if ( count( $terms ) <= mysis_more_less_count() || $args['hide'] ) {
                $classes[] = 'mayosis-filter-few-terms';
            }

        } else {
            $classes[] = 'mayosis-filter-full-height';
        }
    }

    if ( isset( $filter['collapse'] ) && $filter['collapse'] === 'yes' ) {
        if ( in_array( $filter['ID'], mysis_folding_opened() ) ) {
            $classes[] = 'mayosis-filter-collapsible-reverse';
        }

        $classes[] = 'mayosis-filter-collapsible';

        $classes[] = mysis_get_status_css_class( $filter['ID'], MYSIS_FOLDING_COOKIE_NAME );
    }

    if ( in_array( $filter['ID'], mysis_hierarchy_opened() ) ) {
        if( isset( $filter['hierarchy'] ) && $filter['hierarchy'] === 'yes' ){
            $classes[] = 'mayosis-filter-hierarchy-reverse';
        }
    }

    if ( ! empty( $default_classes ) ) {
        $classes = array_merge( $classes, $default_classes );
    }

    return implode( " ", $classes );
}

function mysis_filter_content_class( $filter, $default_classes = [] )
{
    $classes = array(
        'mayosis-filter-content'
    );

    if( isset( $filter['e_name'] ) ){
        $classes[] = 'mayosis-filter-'.$filter['e_name'];
    }

    if( isset( $filter['hierarchy'] ) && $filter['hierarchy'] === 'yes' ){
        $classes[] = 'mayosis-filter-has-hierarchy';
    }

    if( ! empty( $default_classes ) ){
        $classes = array_merge( $classes, $default_classes );
    }

    return implode( " ", $classes );

}

function mysis_get_contrast_color($hexColor)
{
    // hexColor RGB
    $R1 = hexdec(substr($hexColor, 1, 2));
    $G1 = hexdec(substr($hexColor, 3, 2));
    $B1 = hexdec(substr($hexColor, 5, 2));

    // Black RGB
    $blackColor = "#000000";
    $R2BlackColor = hexdec(substr($blackColor, 1, 2));
    $G2BlackColor = hexdec(substr($blackColor, 3, 2));
    $B2BlackColor = hexdec(substr($blackColor, 5, 2));

    // Calc contrast ratio
    $L1 = 0.2126 * pow($R1 / 255, 2.2) +
        0.7152 * pow($G1 / 255, 2.2) +
        0.0722 * pow($B1 / 255, 2.2);

    $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
        0.7152 * pow($G2BlackColor / 255, 2.2) +
        0.0722 * pow($B2BlackColor / 255, 2.2);

    $contrastRatio = 0;
    if ($L1 > $L2) {
        $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
    } else {
        $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
    }

    // If contrast is more than 5, return black color

    if ($contrastRatio > 10) {
        return '#333333';
    } else {
        // if not, return white color.
        return '#f5f5f5';
    }
}

function mysis_default_posts_container()
{
    return  apply_filters( 'mayosis_theme_posts_container', '#primary' );
}

function mysis_default_theme_color()
{
    return  apply_filters( 'mayosis_theme_color', '#0570e2' );
}

function mysis_term_id($name, $filter, $id, $echo = true )
{
    $attr = esc_attr( "mayosis-" . $name . "-" . $filter['entity'] . "-" . esc_attr( $filter['e_name'] ) . "-" . $id );
    if( $echo ){
        echo $attr;
    } else {
        return $attr;
    }
}

function mysis_get_icon_svg($color = '#ffffff' )
{
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0H24V24H0z"/><path d="M21 4v2h-1l-5 7.5V22H9v-8.5L4 6H3V4h18zM6.404 6L11 12.894V20h2v-7.106L17.596 6H6.404z"/></svg>';

    return 'data:image/svg+xml;base64,' . base64_encode( $svg );

}

function mysis_get_icon_html()
{
    ?>
    <span class="mayosis-icon-html-wrapper">
    <span class="mayosis-icon-line-1"></span>
    <span class="mayosis-icon-line-2"></span>
    <span class="mayosis-icon-line-3"></span>
</span>
    <?php
}

function mysis_get_plugin_name()
{
    if( defined('MYSIS_FILTERS_PRO')){
        return esc_html__( 'Mayosis Filter Pro', 'mayosis-filter' );
    }else{
        return esc_html__( 'Mayosis Filter', 'mayosis-filter' );
    }
}

function mysis_get_plugin_url($type = 'about', $full = false )
{
    if( $full ){
        return esc_url($full);
    }

    return esc_url(MYSIS_PLUGIN_URL . '/' . $type );
}

function mysis_get_term_by_slug($prefix ){
    global $wpdb;

    $sql    = "SELECT {$wpdb->terms}.slug FROM {$wpdb->terms} WHERE {$wpdb->terms}.slug = '%s'";
    $sql    = $wpdb->prepare( $sql, $prefix );
    $result = $wpdb->get_row( $sql );

    if( isset($result->slug) && $result->slug ){
        return $result->slug;
    }

    return false;
}

function mysis_walk_terms_tree($terms, $args ) {
    $walker = new \FilterEverything\Filter\WalkerCheckbox();

    $depth = -1;
    if ( isset( $args['filter']['hierarchy'] ) && $args['filter']['hierarchy'] === 'yes' ) {
        $depth = 10;
    }

    return $walker->walk( $terms, $depth, $args );
}

function mysis_get_all_parents($elements, $parent_id, &$ids ){
    if( isset( $elements[$parent_id]->parent ) && $elements[$parent_id]->parent > 0 ){
        $id = $elements[$parent_id]->parent;
        $ids_flipped = array_flip($ids);
//        if( ! in_array( $id, $ids, true ) ){
        if( ! isset( $ids_flipped[$id] ) ){
            $ids[] = $id;
        }

        mysis_get_all_parents( $elements, $id, $ids );
    }else{
        return $ids;
    }
}

function mysis_get_parents_with_not_empty_children($elements, $key = 'cross_count' ){
    $has_posts_in_children = [];

    if( empty( $elements ) || ! is_array( $elements ) ){
        return $has_posts_in_children;
    }

    $new_elements = [];

    foreach ( $elements as $k => $e ) {
        $new_elements[$e->term_id] = $e;
    }

    $has_posts_in_children_flipped = array_flip( $has_posts_in_children );

    foreach ( $new_elements as $e ) {
        if ( isset( $e->parent ) && ! empty( $e->parent ) && $e->$key > 0 ) {
            // Find all parents for term that contains posts
            if( ! isset( $has_posts_in_children_flipped[ $e->parent ] ) ){
                $has_posts_in_children[] = $e->parent;
            }

            mysis_get_all_parents( $new_elements, $e->parent, $has_posts_in_children );
        }
    }

    return $has_posts_in_children;
}

/**
 * Combines all filter sets for the same WP_Query
 *
 * @param array $all_sets - list of all page related sets
 * @param $current_set
 * @return array $queryRelatedSets IDs of all query related sets
 */
function mysis_get_sets_with_the_same_query( $all_sets, $current_set ){
    $queryRelatedSets = [];
    // First detect desired query index;
    $query      = '';
    $post_type  = '';
    $location   = '';
    $set_id     = $current_set['ID'];

    foreach( $all_sets as $set ){
        if( $set['ID'] === $set_id ){
            // Current Set values
            $query      = $set['query'];
            $post_type  = $set['filtered_post_type'];
            $location   = $set['query_location'];
            break;
        }
    }

    // Then find all sets with such query
    foreach( $all_sets as $set ){
        if( $set['query'] === $query && $post_type === $set['filtered_post_type'] && $location === $set['query_location'] ){
            $queryRelatedSets[] = $set['ID'];
        }
    }

    if( empty( $queryRelatedSets ) ){
        $queryRelatedSets[] = $set_id;
    }

    return $queryRelatedSets;
}

function mysis_find_all_descendants($arr) {
    $all_results = [];

    if( empty( $arr ) || ! is_array( $arr ) ){
        return $all_results;
    }

    foreach ($arr as $k => $v) {
        $curr_result = [];

        for ($stack = [$k]; count($stack);) {
            $el = array_pop($stack);

            if (array_key_exists($el, $arr) && is_array($arr[$el])) {
                foreach ($arr[$el] as $child) {
                    $curr_result []= $child;
                    $stack []= $child;
                }
            }
        }

        if (count($curr_result)) {
            $all_results[$k] = $curr_result;
        }
    }

    return $all_results;
}

function mysis_debug_title(){

    echo '<div class="mayosis-debug-title">'.esc_html__('Mayosis Filter debug', 'mayosis-filter');
    echo  '&nbsp;'.mysis_help_tip(
            sprintf(
                __('Debug messages are visible for logged in administrators only. You can disable them in Filters -> <a href="%s">Settings</a> -> Debug mode.', 'mayosis-filter'),
                admin_url( 'edit.php?post_type=mayosis-filter&page=filters-settings' )
            ), true ).'</div>';
}

function mysis_is_debug_mode(){
    $debug_mode = false;
    if( mysis_get_option( 'widget_debug_messages' ) === 'on' ) {
        if( current_user_can( 'manage_options' ) ){
            $debug_mode = true;
        }
    }

    return $debug_mode;
}

function mayosis_clean( $var ) {
    if ( is_array( $var ) ) {
        return array_map( 'mayosis_clean', $var );
    } else {
        return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
    }
}

function mysis_sorting_option_value(  $order_by_value, $meta_keys, $orders, $i ){
    $meta_key     = isset( $meta_keys[$i] ) ? $meta_keys[$i] : '';
    $order        = isset( $orders[$i] ) ? $orders[$i] : '';

    $option_value = $order_by_value;

    if( in_array( $order_by_value, ['m', 'n'], true ) ){
        $option_value .= $meta_key;
    }

    $option_value .= ( $order === 'desc' ) ? '-'.$order : '';

    return $option_value;
}

function mysis_get_active_plugins(){

    if( is_multisite() ){
        $active_plugins = get_site_option('active_sitewide_plugins');
        if( is_array( $active_plugins ) ){
            $active_plugins = array_keys( $active_plugins );
        }

        $site_active_plugins = apply_filters( 'active_plugins', get_option('active_plugins') );
        $active_plugins      = array_merge( $active_plugins, $site_active_plugins );
    }else{
        $active_plugins = apply_filters( 'active_plugins', get_option('active_plugins') );
    }

    return $active_plugins;
}

function mysis_get_terms_transient_key( $salt, $include_lang = true ){
    $key = 'mayosis_terms_' . $salt;
    if ( mysis_wpml_active() && defined( 'ICL_LANGUAGE_CODE' ) && $include_lang ) {
        $key .= '_'.ICL_LANGUAGE_CODE;
    }

    if( function_exists('pll_current_language') && $include_lang ){
        $pll_lang = pll_current_language();
        if( $pll_lang ){
            $key .= '_'.$pll_lang;
        }
    }

    return $key;
}

function mysis_get_post_ids_transient_key( $salt ){
    $key = 'mayosis_posts_' . $salt;
    if (mysis_wpml_active() && defined('ICL_LANGUAGE_CODE')) {
        $key .= '_'.ICL_LANGUAGE_CODE;
    }

    if( function_exists('pll_current_language') ){
        $pll_lang = pll_current_language();
        if( $pll_lang ){
            $key .= '_'.$pll_lang;
        }
    }

    return $key;
}

function mysis_get_variations_transient_key( $salt ){
    $key = 'mayosis_variations_' . $salt;
    if (mysis_wpml_active() && defined('ICL_LANGUAGE_CODE')) {
        $key .= '_'.ICL_LANGUAGE_CODE;
    }

    if( function_exists('pll_current_language') ){
        $pll_lang = pll_current_language();
        if( $pll_lang ){
            $key .= '_'.$pll_lang;
        }
    }

    return $key;
}

function mysis_is_query_on_page( $setPosts, $searchKey ){
    $sets = [];
    if( ! is_array( $setPosts ) ){
        return $sets;
    }

    foreach ( $setPosts as $set ){

        $parameters = maybe_unserialize( $set->post_content );
        $query      = isset( $parameters['wp_filter_query'] ) ? $parameters['wp_filter_query']: '-1';

        if( isset( $parameters['use_apply_button'] ) && $parameters['use_apply_button'] === 'yes' ){

            $query_on_the_page = false;
            $show_on_the_page  = false;

            if( defined('MYSIS_FILTERS_PRO') && MYSIS_FILTERS_PRO ) {
                if ( isset( $parameters['apply_button_post_name'] ) ){

                    if( $parameters['apply_button_post_name'] === $set->post_name ||
                        $parameters['apply_button_post_name'] === 'no_page___no_page' ){
                        $query_on_the_page = true;
                    }

                    if( in_array( $parameters['apply_button_post_name'], $searchKey ) || ( $parameters['apply_button_post_name'] === 'no_page___no_page' ) ){
                        $show_on_the_page = true;
                    }
                }

            }else{
                $query_on_the_page = true;
                $show_on_the_page  = true;
            }

            $sets[] = array(
                'ID'                 => (string) $set->ID,
                'filtered_post_type' => $set->post_excerpt,
                'query'              => $query, // query hash
                'query_location'     => $set->post_name,
                'query_on_the_page'  => $query_on_the_page,
                'page_search_keys'   => $searchKey,
                'show_on_the_page'   => $show_on_the_page
            );

        }else{
            if( in_array( $set->post_name, $searchKey ) ){
                $sets[] = array(
                    'ID'                 => (string) $set->ID,
                    'filtered_post_type' => $set->post_excerpt,
                    'query'              => $query, // query hash
                    'query_location'     => $set->post_name,
                    'query_on_the_page'  => true,
                    'page_search_keys'   => $searchKey,
                    'show_on_the_page'   => true
                );
            }else{
                // This set is for another page and was selected by Apply button location but the button disabled
                continue;
            }
        }

    }

    return $sets;
}

function mysis_remove_empty_terms( $checkTerms, $filter, $has_not_empty_children_flipped = [] ){

    foreach ($checkTerms as $index => $term) {
        if( $filter['hierarchy'] === 'yes' ){

            if(  $term->cross_count === 0
                && ! isset( $has_not_empty_children_flipped[$term->term_id] ) ){
                unset($checkTerms[$index]);
            }

        }else{
            if( $term->cross_count === 0 ){
                unset($checkTerms[$index]);
            }
        }
    }

    return $checkTerms;
}

function mysis_get_filter_terms( $filter, $posType, $em = false ){
    if( ! $em ){
        $em = Container::instance()->getEntityManager();
    }

    $entityObj  = $em->getEntityByFilter( $filter, $posType );
    // Exclude or include terms
    $isInclude = ( isset( $filter['include'] ) && $filter['include'] === 'yes' );
    $entityObj->setExcludedTerms( $filter['exclude'], $isInclude );

    $terms = $entityObj->getTerms();

    return apply_filters( 'mayosis_items_after_calc_term_count', $terms );
}