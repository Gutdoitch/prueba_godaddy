<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

function mysis_is_woocommerce()
{
    if( class_exists('WooCommerce') ){
        return true;
    }
    return false;
}

function mysis_get_mobile_width(){
    return apply_filters( 'mayosis_mobile_width', 768 );
}

/**
 * @feature for other popular themes there is possibility to add action to hook get_template_part_{$slug}
 * But it seems we need to detect what current theme is enabled
 */
if( ! function_exists('mysis_wp') ){

    function mysis_wp(){
        $theme_dependencies = mysis_get_theme_dependencies();

        if( mysis_get_option('show_bottom_widget') === 'on' ) {

            if( mysis_get_experimental_option('disable_buttons') !== 'on' ) {

                if (mysis_is_woocommerce()) { // It means WooCommerce installed

                    if( is_woocommerce() ){ // It means is a WooCommerce page
                        add_action('woocommerce_before_shop_loop', 'mysis_filters_button', 5);
                        add_action('woocommerce_no_products_found', 'mysis_filters_button', 5);
                    }else{
                        if (isset($theme_dependencies['button_hook']) && is_array($theme_dependencies['button_hook'])) {
                            foreach ($theme_dependencies['button_hook'] as $button_hook) {
                                add_action($button_hook, 'mysis_filters_button', 15);
                            }
                        }
                    }

                } else {
                    if (isset($theme_dependencies['button_hook']) && is_array($theme_dependencies['button_hook'])) {
                        foreach ($theme_dependencies['button_hook'] as $button_hook) {
                            add_action($button_hook, 'mysis_filters_button', 15);
                        }
                    }
                }
            }

        }

        // Add selected terms to the top
        $chips_hooks  = mysis_get_option('show_terms_in_content', []);

        if( $chips_hooks ){
            if( is_array( $chips_hooks ) && ! empty( $chips_hooks ) ){
                foreach ( $chips_hooks as $hook ){
                    add_action( $hook, 'mysis_add_selected_terms_above_the_top' );
                }
            }
        }
    }
}

function mayosis_add_selected_terms_above_the_top(){
    _deprecated_function( __FUNCTION__, '1.0.7', 'mysis_add_selected_terms_above_the_top()' );
    mysis_add_selected_terms_above_the_top();
}

function mysis_add_selected_terms_above_the_top()
{
    mysis_show_selected_terms(true);
}

function mysis_get_theme_dependencies(){
    $current_theme = strtolower( get_template() );

    $theme_dependencies = array(
          'mayosis'        => array(
            'posts_container'   => '.mayosis-archive-wrapper',
            'sidebar_container' => '#secondary',
            'primary_color'     => '#96588a',
            'button_hook'       => array('mayosis_store_content_top'),
            'chips_hook'        => array('mayosis_store_loop_before')
        ),
    );

    $theme_dependencies = apply_filters( 'mayosis_theme_dependencies', $theme_dependencies );

    if( isset( $theme_dependencies[ $current_theme ] ) ){
        return $theme_dependencies[ $current_theme ];
    }

    return array(
        'posts_container'   => false,
        'sidebar_container' => false,
        'primary_color'     => false,
        'button_hook'       => array(),
        'chips_hook'        => array()
    );
}

add_action( 'wp', 'mysis_wp' );

if( ! function_exists('mysis_set_posts_container') ){
    function mysis_set_posts_container( $theme_posts_container )
    {
        $theme_dependencies = mysis_get_theme_dependencies();

        if( isset( $theme_dependencies[ 'posts_container' ] ) ){
            return $theme_dependencies[ 'posts_container' ];
        }

        return $theme_posts_container;
    }
}

function mysis_set_theme_color($color ){

    $theme_dependencies = mysis_get_theme_dependencies();

    if( $theme_dependencies['primary_color'] ){
        $color = $theme_dependencies['primary_color'];
    }

    return $color;
}

if( ! function_exists('mysis_init') ){
    function mysis_init()
    {
        // Set correct theme posts container
        add_filter('mayosis_theme_posts_container', 'mysis_set_posts_container');

        // Set correct theme color
        add_filter('mayosis_theme_color', 'mysis_set_theme_color');
    }
}
add_action('init', 'mysis_init');

/**
 * @todo check the problem with Elementor archive template and different posts queries
 * Different post types, custom and predefined category or custom term
 */
//add_filter( 'elementor/theme/posts_archive/query_posts/query_vars', 'mysis_fix_elementor_query_args' );
//add_filter( 'elementor/query/get_query_args/current_query', 'mysis_fix_elementor_query_args' );
function mysis_fix_elementor_query_args( $query_args ){
    $wpManager = \FilterEverything\Filter\Container::instance()->getWpManager();
    if( ! $wpManager->getQueryVar( 'allowed_filter_page' ) ){
        return $query_args;
    }

    if( isset( $query_args['taxonomy']  ) ){
        unset( $query_args['taxonomy'] );
        unset( $query_args['term'] );
    }

    return $query_args;
}

function mysis_wpml_active(){
    if( defined('WPML_PLUGIN_BASENAME') ){
        return true;
    }
    return false;
}

add_action( 'elementor/editor/before_enqueue_scripts', 'mysis_include_elementor_script' );
function mysis_include_elementor_script(){
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    $ver    = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? rand(0, 1000) : MYSIS_PLUGIN_VER;
    wp_enqueue_script('mayosis-widgets', MYSIS_PLUGIN_DIR_URL . 'assets/js/mayosis-widgets' . $suffix . '.js', ['jquery', 'jquery-ui-sortable'], $ver, true );
    wp_enqueue_style('mayosis-widgets', MYSIS_PLUGIN_DIR_URL . 'assets/css/mayosis-widgets' . $suffix . '.css', [], $ver );

    $l10n = array(
        'mayosisItemNum'  => esc_html__( 'Item #', 'mayosis-filter')
    );
    wp_localize_script( 'mayosis-widgets', 'mayosisWidgets', $l10n );
}

/*
 * Polylang compatibility functions
 * */
function mysis_maybe_has_translation( $post_id, $lang = '' ){

    if( function_exists( 'pll_get_post' ) ){
        $translation_post_id = pll_get_post( $post_id, $lang );
        if( $translation_post_id ){
            $post_id = $translation_post_id;
        }
    }

    return $post_id;
}

function mysis_pll_pro_active(){
    if( defined('POLYLANG_PRO') ){
        return true;
    }
    return false;
}
// Allow Filter Sets to be translatable if Polylang PRO activated
// This make sense for Filter Sets with common locations only
add_action( 'after_setup_theme', 'mysis_pll_init', 20 );
function mysis_pll_init(){
    if( mysis_pll_pro_active() && defined('MYSIS_ALLOW_PLL_TRANSLATIONS') && MYSIS_ALLOW_PLL_TRANSLATIONS ){
        add_filter( 'pll_get_post_types', 'mysis_add_cpt_to_pll', 10, 2 );
    }
}

function mysis_add_cpt_to_pll( $post_types, $is_settings ) {
    if ( $is_settings ) {
        unset( $post_types[ MYSIS_FILTERS_SET_POST_TYPE ] );
    } else {
        $post_types[ MYSIS_FILTERS_SET_POST_TYPE ] = MYSIS_FILTERS_SET_POST_TYPE;
    }
    return $post_types;
}