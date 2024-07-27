<?php
/**
 * The default template for download page content
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
global $post,$product;

?>
<div class="clearfix"></div>
<main id="main" class="media-template-wrapper has_mayosis_dark_bg" role="main">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="container">
                <div class="photo-template-author">
                    
                    <div class="row g-0">
                        <div class="col-md-8 col-12 photo--section--image">
                            <div class="photo-video-box-shadow photo--section--image-content has_mayosis_dark_alt_bg">
                                
                                 <?php 
                                     if ( has_post_format( 'video' )) {
                                         get_template_part( 'library/mayosis-video-woo' );
                                     } elseif ( has_post_format( 'audio' )) {
                                         get_template_part( 'library/mayosis-audio-woo' );
                                     } else {
                                         
                                     $thumb_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
                                     $thumb_image_lity = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'full');
                                     ?>
                                      <a class="photo-image-zoom" data-lity
                                           href="<?php echo esc_url($thumb_image_lity); ?>"
                                           ><i class="fas fa-search-plus"></i></a>
                                           
                                      <img src="<?php echo esc_url($thumb_image); ?>" alt="featured-image"
                                         class="featured-img img-responsive">
                                     <?php
                                     }
                                     
                                    ?>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-4 col-12 photo--credential--box">
                            <div class="photo-credential has_mayosis_dark_sec_bg">
                                <div class="photo--title-block">
                                    <h1><?php the_title();?></h1>
                                    <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in"><span class="msv-value_tp-span"> In </span>' . _n( '', '',count( $product->get_category_ids() ), 'mayosis' ) . ' ', '</span>' ); ?>
                                    <span class="opacitydown75"><?php esc_html_e("on", "mayosis"); ?> </span><span><?php echo esc_html(get_the_date()); ?></span>
                                </div><!--title Block end-->
                                
                                
                                <div class="photo--price--block">
                                    <?php woocommerce_template_single_add_to_cart();?>
                                </div><!--price Block end-->
                                
                                <div class="photo-template-social">
                                     <?php if (function_exists('mayosis_photosocial')) {
                                    mayosis_photosocial();
                                } ?>
                                </div><!--Social Block end-->
                                
                                
                                  <div class="photo--template--author--meta">
                                        <div class="photo--author--photo">
                                            <?php echo get_avatar(get_the_author_meta('email'), '40'); ?>
                                        </div>
                                        <div class="photo--author--details">
                                            <p><?php echo esc_html($photographyby); ?></p>
                                            <h4 class="author--name--photo--template"><?php echo get_the_author_meta('display_name'); ?></h4>
                                        </div>
                                        <div class="photo--author--button">
                                            <?php
                                           do_action('mayosis_seller_information_media');?>
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>
                </div>
                
                
                <section class="container blog-main-content photo-template-main-content photo-template-main-content-woo">
                        <div class="row">
                            <div class="col-md-12">
                                  <div class="photo--template--content has_mayosis_dark_alt_bg msv-woo-single-cp-left">
                                      <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
                                     </div>
                            </div>
                        </div>
            </section>
        </section>
        
        
        <section class="container-fluid bottom-post-footer-widget photo-template-footer-bg">
                <div class="container photo-template-bottom-similar">
                    <div class="bottom-product-sidebar">
                         <?php woocommerce_output_related_products();?>
                    </div>
                    
                    
                    <div class="bottom_meta product--bottom--tag photo-bottom--tag">
                        <h3><?php esc_html_e('Keywords', 'mayosis'); ?></h3>
                        <?php $download_tags = get_the_term_list(get_the_ID(), 'product_tag', ' ', ' '); ?>
                        <?php echo '<span class="tags">' . $download_tags . '</span>'; ?>
                    </div>
                </div>
            </section>
    </article>
</main