<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

// Make post type name lowercase in posts found message
add_filter( 'mayosis_label_singular_posts_found_msg', 'mb_strtolower' );
add_filter( 'mayosis_label_plural_posts_found_msg', 'mb_strtolower' );

add_filter( 'mayosis_filter_post_meta_num_term_name', 'mysis_ucfirst_term_slug_name' );
add_filter( 'mayosis_filter_post_meta_term_name', 'mysis_ucfirst_term_slug_name' );
add_filter( 'mayosis_filter_tax_numeric_term_name', 'mysis_ucfirst_term_slug_name' );
if( ! function_exists('mysis_ucfirst_term_slug_name') ) {
    function mysis_ucfirst_term_slug_name($term_name)
    {
        $term_name = mysis_ucfirst($term_name);
        return $term_name;
    }
}

add_filter( 'mayosis_filter_post_meta_exists_term_name', 'mysis_custom_field_exists_name' );
if( ! function_exists( 'mysis_custom_field_exists_name' ) ){
    function mysis_custom_field_exists_name( $term_name ){
        if( $term_name === 'yes'  ){
            return esc_html__('Yes', 'mayosis-filter');
        }else if( $term_name === 'no' ){
            return esc_html__('No', 'mayosis-filter');
        }
        return $term_name;
    }
}

add_filter( 'mayosis_filter_post_meta_term_name', 'mysis_stock_status_term_name', 10, 2 );
if( ! function_exists('mysis_stock_status_term_name') ) {
    function mysis_stock_status_term_name($term_name, $e_name)
    {
        if ($e_name === '_stock_status') {
            $term_name = strtolower($term_name);
            if ($term_name === "instock") {
                $term_name = esc_html__('In stock', 'mayosis-filter');
            }

            if ($term_name === "onbackorder") {
                $term_name = esc_html__('On backorder', 'mayosis-filter');
            }

            if ($term_name === "outofstock") {
                $term_name = esc_html__('Out of stock', 'mayosis-filter');
            }
        }

        return $term_name;
    }
}

add_filter( 'mayosis_filter_post_meta_exists_term_name', 'mysis_on_sale_term_name', 15, 2 );
if( ! function_exists('mysis_on_sale_term_name') ) {
    function mysis_on_sale_term_name( $term_name, $entity )
    {
        if( $entity === '_sale_price' ){
            $term_name = strtolower( $term_name );
            if( $term_name === 'yes' ){
                $term_name = esc_html__('On Sale', 'mayosis-filter');
            }
            if( $term_name  === 'no' ){
                $term_name = esc_html__('Regular price', 'mayosis-filter');
            }
        }
        return $term_name;
    }
}

add_filter('mayosis_filter_taxonomy_term_name', 'mysis_modify_taxonomy_term_name', 10, 2 );
if( ! function_exists( 'mysis_modify_taxonomy_term_name' ) ) {
    function mysis_modify_taxonomy_term_name($term_name, $e_name)
    {
        if (in_array($e_name, array('product_type', 'product_visibility'))) {
            $term_name = mysis_ucfirst($term_name);
        }
        return $term_name;
    }
}

add_filter('mayosis_filter_term_query_args', 'mysis_exclude_uncategorized_category', 10, 3);
if( ! function_exists('mysis_exclude_uncategorized_category') ) {
    function mysis_exclude_uncategorized_category($args, $entity, $e_name)
    {
        if ($e_name === 'category') {
            $args['exclude'] = array(1); // Uncategorized category
        }

        return $args;
    }
}

add_filter( 'mayosis_filter_get_taxonomy_terms', 'mysis_exclude_product_visibility_terms', 10, 2 );
if( ! function_exists('mysis_exclude_product_visibility_terms') ) {
    function mysis_exclude_product_visibility_terms( $terms, $e_name )
    {
        if( $e_name === 'product_visibility' ){
            if( is_array( $terms ) ){
                foreach ( $terms as $index => $term ){

                    if( in_array( $term->slug, array( 'exclude-from-search', 'exclude-from-catalog' ) ) ){
                        unset( $terms[$index] );
                    }
                }
            }
        }

        if( $e_name === 'product_cat' ){
            if( is_array( $terms ) ){
                foreach ( $terms as $index => $term ){
                    if( in_array( $term->slug, array( 'uncategorized' ) ) ){
                        unset( $terms[$index] );
                    }
                }
            }
        }

        return $terms;
    }
}

add_filter( 'mayosis_filter_author_query_post_types', 'mysis_remove_author_query_post_types' );
if( ! function_exists('mysis_remove_author_query_post_types') ) {
    function mysis_remove_author_query_post_types( $post_types )
    {
        if( isset( $post_types['attachment'] ) ){
            unset( $post_types['attachment'] );
        }
        return $post_types;
    }
}

function mysis_chips( $showReset = false, $setIds = [] ) {
    $templateManager    = \FilterEverything\Filter\Container::instance()->getTemplateManager();
    $wpManager          = \FilterEverything\Filter\Container::instance()->getWpManager();

    if( ! $wpManager->getQueryVar( 'allowed_filter_page' ) ){
        return false;
    }

    if( empty( $setIds ) || ! $setIds || ! is_array( $setIds ) ){
        foreach ( $wpManager->getQueryVar('mayosis_page_related_set_ids') as $set ){
            $setIds[] = $set['ID'];
        }
    }

    $chipsObj = new \FilterEverything\Filter\Chips( $showReset, $setIds );
    $chips = $chipsObj->getChips();

    $templateManager->includeFrontView( 'chips', array( 'chips' => $chips, 'setid' => reset($setIds) ) );

}

function mysis_show_selected_terms( $showReset = true, $setIds = [], $class = [] )
{
    $default_class  = array('mayosis-custom-selected-terms');

    if(! empty( $class ) && is_array($class) ){
        $default_class = array_merge( $default_class, $class );
    }

    echo '<div class="'.implode(' ', $default_class).'">'."\r\n";
        mysis_chips( $showReset, $setIds );
    echo '</div>'."\r\n";
}

add_filter( 'mayosis_dropdown_option_attr', 'mysis_parse_dropdown_value' );
function mysis_parse_dropdown_value( $attr ){
    if( ! is_array( $attr ) ){
        $new_attr = array();
        $new_attr['label'] = $attr;
        return $new_attr;
    }

    return $attr;
}

add_filter( 'mayosis_unnecessary_get_parameters', 'mysis_unnecessary_get_parameters' );
function mysis_unnecessary_get_parameters( $params ){
    $unnecessary_params = array(
        'product-page' => true,
        '_pjax' => true
    );

    return array_merge( $params, $unnecessary_params );
}

add_filter('mayosis_posts_containers', 'mysis_convert_posts_container_to_array');
function mysis_convert_posts_container_to_array( $container ){

    if( ! is_array( $container ) ){
        return [ 'default' => trim($container) ];
    }

    return $container;
}

add_filter( 'mayosis_filter_post_types', 'mysis_exclude_post_types' );
if( ! function_exists('mysis_exclude_post_types') ) {
    function mysis_exclude_post_types($post_types)
    {

        $post_types = array(
            MYSIS_FILTERS_POST_TYPE,
            MYSIS_FILTERS_SET_POST_TYPE,
            'attachment',
            'elementor_library',
            'e-landing-page',
            'jet-smart-filters',
            'ct_template'
        );

        return $post_types;
    }
}

add_action('mayosis_after_filter_input', 'mysis_after_filter_input');
if( ! function_exists('mysis_after_filter_input') ) {
    function mysis_after_filter_input($attributes)
    {
        if( isset($attributes['class']) && $attributes['class'] === 'mayosis-field-slug' && $attributes['value'] === '' ){
            echo '<p class="description">'.esc_html__( 'a-z, 0-9, "_" and "-" symbols supported only', 'mayosis-filter').'</p>';
        }

        if( isset($attributes['class']) && $attributes['class'] === 'mayosis-field-ename' && $attributes['value'] === '' ){
            echo '<p class="description">'.esc_html__( 'Note: for ACF meta fields, please use names without the "_" character at the beginning', 'mayosis-filter').'</p>';
        }

    }
}

add_filter( 'mayosis_seo_title', 'do_shortcode' );
add_filter( 'mayosis_seo_description', 'do_shortcode' );
add_filter( 'mayosis_seo_h1', 'do_shortcode' );

/**
 * @return int
 * @since 1.7.1
 */
function mysis_more_less_count() {
    return apply_filters( 'mayosis_more_less_count', 5 );
}
/**
 * @return mixed|void
 * @since 1.7.1
 */
function mysis_more_less_opened() {
    return apply_filters( 'mayosis_more_less_opened', [] );
}
/**
 * @return mixed|void
 * @since 1.7.1
 */
function mysis_folding_opened() {
    return apply_filters( 'mayosis_folding_opened', [] );
}
/**
 * @return mixed|void
 * @since 1.7.1
 */
function mysis_hierarchy_opened() {
    return apply_filters( 'mayosis_hierarchy_opened', [] );
}
/**
 * @param $filter
 * @return mixed|void
 * @since 1.7.1
 */
function mysis_dropdown_default_option( $filter ) {
    return apply_filters( 'mayosis_dropdown_default_option', sprintf( __( '- Select %s -', 'mayosis-filter' ),  $filter['label'] ), $filter );
}