<?php

defined( 'ABSPATH' ) || exit;
global $product;
global $post;
$livepreviewtext= get_theme_mod( 'live_preview_text','Live Preview' );
$producttopsocialbuttons= get_theme_mod( 'product_top_social_share','show' );
$productbredtype= get_theme_mod( 'woos_bredcrumb_type','full-width' );
?>
<div class="<?php echo esc_html($productbredtype);?>">
   <div class="mayosis-woo-single-style-one">
     <div class="mayosis-woo-single-hero container">
         <div class="row align-items-center">
             <div class="col-12 col-md-4 mayosis-woo-single-hero-thumbnail">
                 <?php 
                 if ( has_post_format( 'video' )) {
                     get_template_part( 'library/mayosis-video-woo' );
                 } elseif ( has_post_format( 'audio' )) {
                     get_template_part( 'library/mayosis-audio-woo' );
                 } else {
                 woocommerce_show_product_images();
                 }
                 
                 ?>
             </div>
             <div class="col-12 col-md-8 mayosis-woo-single-meta-contents">
                 <?php woocommerce_breadcrumb();?>
                <?php woocommerce_template_single_title();?>
                <?php woocommerce_template_single_meta();?>
                 <div class="msv-woo-top-buttons row">
                       <div class="col-12 col-md-4 product-cart-flex-button">
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
                    <?php $demo_link =  get_post_meta($post->ID, 'woo_demo_link', true); ?>
       <?php if ( $demo_link ) { ?>
       <div class="col-12 col-md-4 comment-button">
                               <a href="<?php echo esc_html($demo_link); ?>" class="btn btn-default" target="_blank"><?php echo esc_html($livepreviewtext); ?></a>
                               </div>
       <?php } ?>
       
        <?php if ($producttopsocialbuttons=='show'): ?>
                         <div class="col-12 col-md-4">
                         <?php if(function_exists('mayosis_productbreadcrubm')){
                               mayosis_productbreadcrubm();
                            } ?>  
                        
                            </div>
                            <?php endif; ?>
       
                 </div>
             </div>
         </div>
     </div>
  </div>
 </div>
 
 
 <div class="mayosis-woo-style-one-content-panel">
     <div class="container">
         <div class="row">
             <div class="col-12 col-md-8 msv-woo-single-cp-left">
                 <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
             </div>
             <div class="col-12 col-md-4 msv-woo-single-cp-right">
                 <?php if ( is_active_sidebar( 'single-product' ) ) : ?>
					<?php dynamic_sidebar( 'single-product' ); ?>
				<?php endif; ?>
             </div>
             <div class="clearfix"></div>
         </div>
     </div>
     
     
     <div class="mayosis-woo-related-products">
         <div class="container">
             <?php woocommerce_output_related_products();?>
             
              
         </div>
     </div>
 </div>
	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	//do_action( 'woocommerce_before_single_product_summary' );
	?>

	<!--<div class="summary entry-summary">-->
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		//do_action( 'woocommerce_single_product_summary' );
		?>
<!--	</div> -->

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	//do_action( 'woocommerce_after_single_product_summary' );
	?>