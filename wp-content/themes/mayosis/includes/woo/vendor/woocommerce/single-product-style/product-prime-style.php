<?php
/**
 * The prime template for download page content
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $product;
global $post;
$livepreviewtext= get_theme_mod( 'live_preview_text','Live Preview' );
$producttopsocialbuttons= get_theme_mod( 'product_top_social_share','show' );
$productbredtype= get_theme_mod( 'woos_bredcrumb_type','full-width' );
?>




    <div class="mayosis-woo-single-style-one woo-prime-product-template product-main-header container-fluid has_mayosis_dark_alt_bg">

        <div class="container">
            <div class="row productflexfix">

                <div class="col-md-12 col-12 single_main_header_products">
                    <div class="single--post--content">
                       <?php woocommerce_template_single_title();?>
                        <?php woocommerce_breadcrumb();?>

                    </div>
                </div>

            </div>

        </div>
    </div>



    <section class="blog-main-content">
        <div class="container">
            <div class="mayosis-floating-share">
                <div class="theiaStickySidebar">
                    <?php mayosis_floatsocial(); ?>
                </div>
            </div>
            <!------ section content start ---->
            <div class="row">

                <div class="col-md-8 col-sm-7 col-12">
                    <div class="single-post-block single-prime-layout has_mayosis_dark_bg position-relative">

                        <?php
                        if ( has_post_format( 'video' )) {
                            get_template_part( 'library/mayosis-video-woo' );
                        } elseif ( has_post_format( 'audio' )) {
                            get_template_part( 'library/mayosis-audio-woo' );
                        } else {
                            woocommerce_show_product_images();
                        }

                        ?>


                        <div class="prime--button-set">
                            <div class="prime--button--left">

                            <div class="prime-cart-button">
                                
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
                        <div class="prime--box--demo-button">

                            <a href="<?php echo esc_html($demo_link); ?>" class="btn btn-default prime-demo-button" target="_blank"><?php echo esc_html($livepreviewtext); ?></a>


                        </div>
                    <?php } ?>
                    
                     </div><!-- button left-->
                     
                     
                       <div class="prime--button--right prime-wishlist-fav">
                           
                        </div>
                     

                        </div><!-- button set -->

                    </div>
                    
                    <div class="prime-content-msd-main-part msv-woo-single-cp-left">
                          <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
                    </div>

                </div><!-- left side section -->
                
                
                 <div class="col-md-4 col-sm-5 col-12 product-sidebar">

                        <?php if ( is_active_sidebar( 'single-product' ) ) : ?>
                            <?php dynamic_sidebar( 'single-product' ); ?>
                        <?php endif; ?>
                
                
                
                        <!--sidebar widget-->
                    </div>
    
    
            </div>

            <!------ section content end ---->
        </div>
    </section>
    
    
    
      <section class="container-fluid bottom-post-footer-widget has_mayosis_dark_alt_bg overflow-hidden">
        <div class="container bottom-product-sidebar">
                <?php get_template_part( 'includes/woo/inc/product-footer-prime'); ?>
        </div>
    </section>

