<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package mayosis
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function mayosis_woocommerce_setup() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_filter( 'woocommerce_enqueue_styles', '__return_false' );
}
add_action( 'after_setup_theme', 'mayosis_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function mayosis_woocommerce_scripts() {
    wp_enqueue_style( 'mayosis-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

    $font_path   = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

    wp_add_inline_style( 'mayosis-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'mayosis_woocommerce_scripts' );


/**
 * Locate a template and return the path for inclusion.
 *
 * @since 1.0.0
 */
function mayosis_wc_locate_template( $template, $template_name, $template_path ) {
    global $woocommerce;

    $_template = $template;

    if ( ! $template_path ) $template_path = $woocommerce->template_url;

    $theme_path = MAYOSIS_ABSPATH . '/includes/woo/vendor/woocommerce/';

    // Look within passed path within the theme - this is priority
    $template = locate_template(
        array(
            trailingslashit( $template_path ) . $template_name,
            $template_name
        )
    );

    // Modification: Get the template from this folder, if it exists
    if ( ! $template && file_exists( $theme_path . $template_name ) )
        $template = $theme_path . $template_name;

    // Use default template
    if ( ! $template )
        $template = $_template;

    // Return what we found
    return $template;
}
function mayosis_wc_locate_template_parts( $template, $slug, $name ) {
    $theme_path  = MAYOSIS_ABSPATH . '/includes/woo/vendor/woocommerce/';
    if ( $name ) {
        $newpath = $theme_path . "{$slug}-{$name}.php";
    } else {
        $newpath = $theme_path . "{$slug}.php";
    }
    return file_exists( $newpath ) ? $newpath : $template;
}
add_filter( 'woocommerce_locate_template', 'mayosis_wc_locate_template', 10, 3 );
add_filter( 'wc_get_template_part', 'mayosis_wc_locate_template_parts', 10, 3 );
/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function mayosis_woocommerce_active_body_class( $classes ) {
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter( 'body_class', 'mayosis_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function mayosis_woocommerce_products_per_page() {
    return 12;
}
add_filter( 'loop_shop_per_page', 'mayosis_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function mayosis_woocommerce_thumbnail_columns() {
    return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'mayosis_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function mayosis_woocommerce_loop_columns() {
    return 3;
}
add_filter( 'loop_shop_columns', 'mayosis_woocommerce_loop_columns' );




/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function mayosis_woocommerce_related_products_args( $args ) {
    $productcount= get_theme_mod( 'woos_related_tpr_count','4' );
    $defaults = array(
        'posts_per_page' => $productcount,
        'columns'        => 4,
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'mayosis_woocommerce_related_products_args' );

if ( ! function_exists( 'mayosis_woocommerce_product_columns_wrapper' ) ) {
    /**
     * Product columns wrapper.
     *
     * @return  void
     */
    function mayosis_woocommerce_product_columns_wrapper() {
        $columns = mayosis_woocommerce_loop_columns();
        echo '<div class="columns-' . absint( $columns ) . '">';
    }
}
add_action( 'woocommerce_before_shop_loop', 'mayosis_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'mayosis_woocommerce_product_columns_wrapper_close' ) ) {
    /**
     * Product columns wrapper close.
     *
     * @return  void
     */
    function mayosis_woocommerce_product_columns_wrapper_close() {
        echo '</div>';
    }
}
add_action( 'woocommerce_after_shop_loop', 'mayosis_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'mayosis_woocommerce_wrapper_before' ) ) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function mayosis_woocommerce_wrapper_before() {
        ?>
        <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
        <?php
    }
}
add_action( 'woocommerce_before_main_content', 'mayosis_woocommerce_wrapper_before' );

if ( ! function_exists( 'mayosis_woocommerce_wrapper_after' ) ) {
    /**
     * After Content.
     *
     * Closes the wrapping divs.
     *
     * @return void
     */
    function mayosis_woocommerce_wrapper_after() {
        ?>
        </main><!-- #main -->
        </div><!-- #primary -->
        <?php
    }
}
add_action( 'woocommerce_after_main_content', 'mayosis_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
<?php
if ( function_exists( 'mayosis_woocommerce_header_cart' ) ) {
mayosis_woocommerce_header_cart();
}
?>
 */

if ( ! function_exists( 'mayosis_refresh_mini_cart_count' ) ) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    add_filter( 'woocommerce_add_to_cart_fragments', 'mayosis_refresh_mini_cart_count');
    function mayosis_refresh_mini_cart_count($fragments){
        ob_start();
        $items_count = WC()->cart->get_cart_contents_count();
        ?>
        <span class="items edd-cart-quantity"><?php echo maybe_unserialize($items_count ? $items_count : '0'); ?></span>
        <?php
        $fragments['.edd-cart-quantity'] = ob_get_clean();
        return $fragments;
    }

}

if ( ! function_exists( 'mayosis_woocommerce_cart_link' ) ) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function mayosis_woocommerce_cart_link() {
        ?>
        <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'mayosis' ); ?>">
            <?php
            $item_count_text = sprintf(
            /* translators: number of items in the mini cart. */
                _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'mayosis' ),
                WC()->cart->get_cart_contents_count()
            );
            ?>
            <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
        </a>
        <?php
    }
}

if ( ! function_exists( 'mayosis_woocommerce_header_cart' ) ) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function mayosis_woocommerce_header_cart() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr( $class ); ?>">
                <?php mayosis_woocommerce_cart_link(); ?>
            </li>
            <li>
                <?php
                $instance = array(
                    'title' => '',
                );

                the_widget( 'WC_Widget_Cart', $instance );
                ?>
            </li>
        </ul>
        <?php
    }
}


//==============================================================================
// Out of Stock
//==============================================================================
if ( ! function_exists( 'mayosis_out_of_stock' ) ) {

    function mayosis_out_of_stock() {


        global $product;
        $out_of_stock = ! $product->is_in_stock();
        if ($out_of_stock){ ?>
            <div class="mayosis-out-of-stock-stacked"><?php _e( 'Out of stock', 'mayosis' ); ?></div>
        <?php }
    }
}
//==============================================================================
// Saasplate Woo Normal Thumbnail
//==============================================================================
if ( ! function_exists( 'mayosis_woo_thumbnail' ) ) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function mayosis_woo_thumbnail() {

        if ( has_post_thumbnail() ) {

            the_post_thumbnail('full', true);


        }

    }
endif;
//==============================================================================
// Saasplate Hover Thumbnail
//==============================================================================
if ( ! function_exists( 'mayosis_woocommerce_get_alt_product_thumbnail' ) ) {
    /**
     * Get Hover image for WooCommerce Grid
     */
    function mayosis_woocommerce_get_alt_product_thumbnail() {


        global $product;
        $attachment_ids = $product->get_gallery_image_ids();
        $class          = 'show-on-hover hide-for-small mayosis-back-image';

        if ( $attachment_ids ) {
            $loop = 0;
            foreach ( $attachment_ids as $attachment_id ) {
                $image_link = wp_get_attachment_url( $attachment_id );
                if ( ! $image_link ) {
                    continue;
                }
                $loop ++;
                echo apply_filters( 'mayosis_woocommerce_get_alt_product_thumbnail',
                    wp_get_attachment_image( $attachment_id, 'woocommerce_thumbnail', false, array( 'class' => $class ) ) );
                if ( $loop == 1 ) {
                    break;
                }
            }
        }
    }
}
add_action( 'mayosis_woocommerce_shop_loop_images', 'mayosis_woocommerce_get_alt_product_thumbnail', 11 );
//add_action( 'mayosis_woocommerce_shop_loop_images', 'mayosis_woo_thumbnail', 11 );
/* Remove and add Product image */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'mayosis_woocommerce_shop_loop_images', 'woocommerce_template_loop_product_thumbnail', 10 );


if (class_exists('WPCleverWoosc')) {
    add_filter( 'woosc_button_position_archive', '__return_false' );
    add_filter( 'woosc_button_position_single', '__return_false' );
}

//==============================================================================
// Add Wishlist Icon in Product Card
//==============================================================================

function mayosis_wishlist_icon_in_product_grid() {
    if (class_exists('YITH_WCWL')) :
        global $product;
        ?>

        <a href="<?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id())? esc_url(YITH_WCWL()->get_wishlist_url()) : esc_url(add_query_arg('add_to_wishlist', $product->get_id())); ?>"
           data-product-id="<?php echo esc_attr($product->get_id()); ?>"
           data-product-type="<?php echo esc_attr($product->get_type()); ?>"
           data-wishlist-url="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>"
           data-browse-wishlist-text="<?php echo esc_attr(get_option('yith_wcwl_browse_wishlist_text')); ?>"
           class="button mayosis_product_wishlist_button <?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id())? 'clicked added' : 'add_to_wishlist'; ?>" rel="nofollow" data-toggle="tooltip">
				<span class="tooltip left">
					<?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id())? esc_attr(get_option( 'yith_wcwl_browse_wishlist_text' )) : esc_attr(get_option('yith_wcwl_add_to_wishlist_text')); ?>
				</span>
        </a>

    <?php
    endif;
}

//==============================================================================
// Add Compare Icon in Product Card
//==============================================================================

function mayosis_compare_icon_in_product_card() {


    ?>



    <?php
    if (class_exists('YITH_Woocompare')) :
        global $product, $yith_woocompare;

        $productId = $product->get_id();


        if ( ! isset( $button_text ) || $button_text == 'default' ) {
            $button_text = get_option( 'yith_woocompare_button_text', __( 'Compare', 'mayosis' ) );
            do_action ( 'wpml_register_single_string', 'Plugins', 'plugin_yit_compare_button_text', $button_text );
            $button_text = apply_filters( 'wpml_translate_single_string', $button_text, 'Plugins', 'plugin_yit_compare_button_text' );
        }
        ?>
        <div class="woocommerce product compare-button">
            <a href="<?php echo esc_url( home_url() ); ?>?action=yith-woocompare-add-product&id=<?php echo esc_html($productId);?>" class="compare button" data-product_id="<?php echo esc_html($productId);?>" rel="nofollow"><i class="ri-repeat-2-line"></i>
                <span class="tooltip left">
				                    <?php esc_attr($button_text); ?>
				                    </span>

            </a>
        </div>

    <?php endif; ?>

    <?php
    if (class_exists('WPCleverWoosc')) {
        global $product;
        $productId = $product->get_id();
        $comparetxt = cs_get_option('mayosis_compare_text');
        ?>
        <div class="woocommerce product compare-button woosc-compare-button">

            <a href="#" class="compare button woosc-btn woosc-btn-<?php echo esc_html($productId);?>" data-id="<?php echo esc_html($productId);?>" rel="nofollow"><i class="ri-repeat-2-line"></i>


            </a>
            <span class="tooltip left">
				                    <?php echo esc_html($comparetxt);?>
				                    </span>
        </div>

    <?php } ?>

    <?php

}

//==============================================================================
// Add Quick view Icon in Product Card
//==============================================================================

if ( !function_exists('mayosis_add_quick_view_card')):
    function mayosis_add_quick_view_card() {

        do_action('mayosis_add_quick_view_action');

    }
endif;




//==============================================================================
// Add Product Card Icon in Product Card
//==============================================================================

function mayosis_product_cart_card() {
    global $product;

    $productId = $product->get_id();
    $args = "";


    ?>





    <?php echo apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
        sprintf( '<a href="%s" data-quantity="%s" class="%s mayosis-grid-quick-view-btn add_to_cart_button ajax_add_to_cart" %s><i class="ri-shopping-cart-line"></i> <span class="tooltip left">
				                    %s
				                    </span></a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( $product->add_to_cart_text() )
        ),
        $product, $args );

    ?>



    <?php

}

//==============================================================================
// Remove WooCommerce product and WordPress page results from the search form widget
//==============================================================================
function mayosis_modify_search_result( $query ) {
    // Make sure this isn't the admin or is the main query
    if( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    // Make sure this isn't the WooCommerce product search form
    if( isset($_GET['post_type']) && ($_GET['post_type'] == 'product') ) {
        return;
    }

    if( $query->is_search() ) {
        $in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );

        // The post types you're removing (example: 'product' and 'page')
        $post_types_to_remove = array( 'product' );

        foreach( $post_types_to_remove as $post_type_to_remove ) {
            if( is_array( $in_search_post_types ) && in_array( $post_type_to_remove, $in_search_post_types ) ) {
                unset( $in_search_post_types[ $post_type_to_remove ] );
                $query->set( 'post_type', $in_search_post_types );
            }
        }
    }

}
add_action( 'pre_get_posts', 'mayosis_modify_search_result' );



// Product review Star Reting Founction
add_action('woocommerce_after_shop_loop_item', 'mayosis_get_star_rating' );
function mayosis_get_star_rating($r_count = '')
{
    global $woocommerce, $product;
    $average = $product->get_average_rating();

    echo '<div class="star-rating"> '. $r_count .' <span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong class="rating">'.$average.'</strong> '.__( 'out of 5', 'mayosis' ).'</span></div>';
}


remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


function mayosis_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

    return $title;
}

add_filter( 'get_the_archive_title', 'mayosis_archive_title' );

//==============================================================================
// Dokan Widgets
//==============================================================================

add_action( 'mayosis_seller_information_main','mayosis_sold_by' );
    function mayosis_sold_by(){
        global $product;
    ?>
 
        <?php
        
          if (class_exists('Marketkingcore_Public')) {
              
              $vendor_id = marketking()->get_product_vendor($product->get_id());
              ?>
              
              <span class="mayosis-dokan-seller-name">
                        <span class="mayosis-dokan-seller-label opacitydown75"><?php esc_html_e('By ','mayosis');?></span>
                        <?php printf( '<a href="%s">%s</a>', marketking()->get_store_link($vendor_id),marketking()->get_store_name_display($vendor_id) ); ?>
                    </span>
              <?php
              
              
              
          }
        
              if (class_exists('WeDevs_Dokan')) {
            
            $seller = get_post_field( 'post_author', $product->get_id());
             $author  = get_user_by( 'id', $seller );

            $store_info = dokan_get_store_info( $author->ID );
            if ( !empty( $store_info['store_name'] ) ) { ?>
                    <span class="mayosis-dokan-seller-name">
                        <span class="mayosis-dokan-seller-label opacitydown75"><?php esc_html_e('By ','mayosis');?></span>
                        <?php printf( '<a href="%s">%s</a>', dokan_get_store_url( $author->ID ), $author->display_name ); ?>
                    </span>
            <?php 
            }
            
            }
        

    }
    
    
    add_action( 'mayosis_seller_information_media','mayosis_sold_by_button' );
    function mayosis_sold_by_button(){
        global $product;
    ?>
 
        <?php
        
          if (class_exists('Marketkingcore_Public')) {
              
              $vendor_id = marketking()->get_product_vendor($product->get_id());
              ?>
              
              <span class="mayosis-dokan-seller-name">
                        <?php printf( '<a href="%s" class="photo--template--button">%s</a>', marketking()->get_store_link($vendor_id),'View Portfolio' ); ?>
                    </span>
              <?php
              
              
              
          }
        
              if (class_exists('WeDevs_Dokan')) {
            
            $seller = get_post_field( 'post_author', $product->get_id());
             $author  = get_user_by( 'id', $seller );

            $store_info = dokan_get_store_info( $author->ID );
            if ( !empty( $store_info['store_name'] ) ) { ?>
                    <span class="mayosis-dokan-seller-name">
                    
                        <?php printf( '<a href="%s" class="photo--template--button">%s</a>', dokan_get_store_url( $author->ID ), 'View Portfolio' ); ?>
                    </span>
            <?php 
            }
            
            }
        

    }
    
    function mayosis_woo_downloads_count() {
    global $wpdb, $product;

    $product_id = ( is_object( $product ) && is_callable( array( $product, 'get_id' ) ) ) ? $product->get_id() : 0;

    if ( empty( $product_id ) ) return;

    $product_type = ( is_object( $product ) && is_callable( array( $product, 'get_type' ) ) ) ? $product->get_type() : 'simple';

    if ( 'variable' === $product_type ) {
        $product_ids = $product->get_children();
    } else {
        $product_ids = array( $product_id );
    }

    $how_many_product_ids = count( $product_ids );
    $id_placeholder       = array_fill( 0, $how_many_product_ids, '%d' );

    $count = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT SUM( download_count ) AS count
                FROM {$wpdb->prefix}woocommerce_downloadable_product_permissions
                WHERE product_id IN (".implode( ',', $id_placeholder ).")",
            $product_ids
        )
    );
    if ( ! empty( $count ) ) {
        echo '<strong>' . esc_html__( 'Total downloads','mayosis' ) . '</strong>: ' . $count;
    }
}
//add_action( 'woocommerce_single_product_summary', 'mayosis_woo_downloads_count' );

	