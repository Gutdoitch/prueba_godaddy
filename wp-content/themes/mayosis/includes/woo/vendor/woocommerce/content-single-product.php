<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
global $post;
$productstyle= get_theme_mod( 'woos_product_style','default' );
$stickycartbar= get_theme_mod( 'enable_sticky_cart_bar', 'hide');
$stickycarttype= get_theme_mod( 'sticky_cart_bar_background_type', 'standard');
$titlebeforetxt = get_theme_mod( 'stk_txt_text', 'youre viewing');
?>
<div class="container">
    <?php

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
</div>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    <?php if($productstyle=="media"){?>
    <?php get_template_part('includes/woo/vendor/woocommerce/single-product-style/product-media-style'); ?>
   
     <?php } elseif($productstyle=="prime"){?>
    <?php get_template_part('includes/woo/vendor/woocommerce/single-product-style/product-prime-style'); ?>
    <?php } else { ?>
      <?php get_template_part('includes/woo/vendor/woocommerce/single-product-style/product-default-style'); ?>
    <?php } ?>
   
   
   
</div>

<?php if($stickycartbar=="show"){?>
    <section class="mayosis-sticky-cart-bar-woo mayosis-sticky-cart-bar has_mayosis_dark_sec_bg mayosis-sticky-cart-<?php echo esc_html($stickycarttype);?>" id="mayosis-sticky-cart-bar">
        <div class="container">
            <div class="row align-items-center">
              
                <div class="col-7 col-md-8 d-flex align-items-center">
                      <?php
			// display featured image?
			if ( has_post_thumbnail() ) { ?>
                <div class="mayosis-sticky-bar-thumb d-none d-md-block">
                    	<?php the_post_thumbnail( 'full', array( 'class' => 'featured-img img-responsive watermark' ) ); ?>
                </div>
                <?php } ?>
                <div class="msc-sticky-other-contents">
                    <h4><span class="d-none d-md-inline-block"><?php echo esc_html($titlebeforetxt);?></span><?php the_title();?></h4>
                    
                     <?php woocommerce_template_single_price(); ?>
                   
                    </div>
                </div>
                <div class="col-5 col-md-4 woo-stk-cart-btn-box">
                    <?php  if ( $product->is_type( 'variable' ) ) { ?>
                           
                           <a class="btn btn-primary multiple_button_v" href="#mayosis_variable_price" data-lity="">
                                 <?php esc_html_e('Purchase','mayosis');?>                                </a>
                                 
                                 <div id="mayosis_variable_price" class="lity-hide" style="max-height: 969px;">
          <h4><?php esc_html_e('Choose Your Desired Option(s)','mayosis');?></h4>
          <?php woocommerce_template_single_add_to_cart();?>
          
          </div>
                           <?php } else { ?>
                               
                               
                    <?php woocommerce_template_single_add_to_cart();?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

<?php do_action( 'woocommerce_after_single_product' ); ?>
