<?php
 
if( !function_exists('mayosis_wc_get_gallery_image_html') ) {
  // Copied and modified from woocommerce plugin and wc_get_gallery_image_html helper function.
  function mayosis_wc_get_gallery_image_html( $attachment_id, $main_image = false, $size = 'woocommerce_single' ) {
     $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
		$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
		$image_size        = apply_filters( 'woocommerce_gallery_image_size', $size );
		$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
		$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
		$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
		$alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );

		if ( empty( $full_src ) ) {
			return '';
		}

		$image = wp_get_attachment_image(
			$attachment_id,
			$image_size,
			false,
			apply_filters(
				'woocommerce_gallery_image_html_attachment_image_params',
				array(
					'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
					'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
					'data-src'                => esc_url( $full_src[0] ),
					'data-large_image'        => esc_url( $full_src[0] ),
					'data-large_image_width'  => esc_attr( $full_src[1] ),
					'data-large_image_height' => esc_attr( $full_src[2] ),
					'class'                   => esc_attr( $main_image ? 'wp-post-image skip-lazy' : 'skip-lazy' ), // skip-lazy, blacklist for Jetpack's lazy load.
				),
				$attachment_id,
				$image_size,
				$main_image
			)
		);

		$image_wrapper_class = $main_image ? 'slide first' : 'slide';

		return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image ' . $image_wrapper_class . '"><a href="' . esc_url( $full_src[0] ) . '">' . $image . '</a></div>';
  }
}



    // Disable the hooks so that their order can be changed.
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
    remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
       remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20, 0);
    
    
    
    
     remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30, 0);
     
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20, 0);
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
  
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    
   add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 20 );
   
   // Then the product short description.
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30 );
    
     
    // And finally include the 'Add to cart' section.
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40 );
      
    // Include the category/tags info.
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 50 );
    
    
    /* Add stuff to lightbox */
//add_action( 'woocommerce_single_product_quickview_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_quickview_summary', 'woocommerce_template_single_excerpt', 15 );
add_action( 'woocommerce_single_product_quickview_summary', 'woocommerce_template_single_add_to_cart', 30 );

add_action( 'woocommerce_before_single_product_lightbox_summary', 'woocommerce_show_product_sale_flash', 20 );


    
    
      // mayosis Single Product Hooks
    function mayosis_woo_sale_hook() {
	do_action('mayosis_woo_sale_hook');
    }
    
    function mayosis_woo_inventory_hook() {
	do_action('mayosis_woo_inventory_hook');
    }
  
  
  
  
  function mayosis_woo_sale_functions() {

   
    if (!defined('ABSPATH')) exit; // Exit if accessed directly
    global $post, $product;
    if (!$product->is_in_stock()) return;
    if (is_a($product, 'WC_Product_Grouped')) return;
    $sale_price = get_post_meta($product->get_id(), '_price', true);
    $regular_price = get_post_meta($product->get_id(), '_regular_price', true);
    if ($product->is_type( 'variable' ) && !empty($regular_price) && !empty($sale_price)) { //then this is a variable product
        $regular_price = $product->get_variation_regular_price();
        $sale_price = $product->get_variation_sale_price();
    }
    if (!empty($regular_price)) {
        $sale = ceil((($regular_price - $sale_price) / $regular_price) * 100);
    }

    if (!empty($regular_price) && !empty($sale_price) && $regular_price > $sale_price) {
        echo
        apply_filters('woocommerce_sale_flash', '<span class="onsale-percent">-' . $sale . '%</span>', $post, $product);
    }


  }
add_action('mayosis_woo_sale_hook', 'mayosis_woo_sale_functions', 7);


  function mayosis_woo_inventory_functions() {
      global $post, $product;
      if ( $product->get_stock_quantity() ) { // if manage stock is enabled 
if ( number_format($product->get_stock_quantity(),0,'','') < 10 ) { // if stock is low
echo '<span class="mayosis-remaining-stock red-notice">Only ' . number_format($product->get_stock_quantity(),0,'','') . ' in stock</span>';
} else {
echo '<span class="mayosis-remaining-stock green-notice">' . number_format($product->get_stock_quantity(),0,'','') . ' in stock</span>';
		}
	}
  }
add_action('mayosis_woo_inventory_hook', 'mayosis_woo_inventory_functions');


add_action( 'wp_footer' , 'mayosis_quanity_script' );
function mayosis_quanity_script(){
    ?>
    <script type='text/javascript'>
    jQuery( function( $ ) {
        if ( ! String.prototype.getDecimals ) {
            String.prototype.getDecimals = function() {
                var num = this,
                    match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                if ( ! match ) {
                    return 0;
                }
                return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
            }
        }
        // Quantity "plus" and "minus" buttons
        $( document.body ).on( 'click', '.plus, .minus', function() {
            var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                currentVal  = parseFloat( $qty.val() ),
                max         = parseFloat( $qty.attr( 'max' ) ),
                min         = parseFloat( $qty.attr( 'min' ) ),
                step        = $qty.attr( 'step' );

            // Format values
            if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
            if ( max === '' || max === 'NaN' ) max = '';
            if ( min === '' || min === 'NaN' ) min = 0;
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

            // Change the value
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( currentVal >= max ) ) {
                    $qty.val( max );
                } else {
                    $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            } else {
                if ( min && ( currentVal <= min ) ) {
                    $qty.val( min );
                } else if ( currentVal > 0 ) {
                    $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            }

            // Trigger change event
            $qty.trigger( 'change' );
        });
    });
    </script>
    <?php
}

add_filter( 'woocommerce_breadcrumb_defaults', 'mayosis_breadcrumb_delimiter' );
function mayosis_breadcrumb_delimiter( $defaults ) {
  $defaults['delimiter'] = '<i class="isax icon-arrow-right-11"></i> ';
  return $defaults;
}
 if( class_exists( 'YITH_WCWL' ) ){

	/**
	 * Add wishlist Button to Product page
	 */
	function mayosis_product_wishlist_button() {
		?>
		<div class="mayosis-wishlist-sp">
				<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
		
		</div>
		<?php
	}
add_action( 'woocommerce_after_add_to_cart_button', 'mayosis_product_wishlist_button',10, 0 );


}