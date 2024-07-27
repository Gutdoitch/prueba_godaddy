<?php
/**
 * The prime template for download page content
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$productgallerytype= get_theme_mod( 'product_gallery_type','one');
$download_id = get_the_ID();
$primetemplate= get_theme_mod( 'background_prime', 'color');
$disableprimewidget= get_theme_mod( 'prime_bottom_widget','on');

$stickycartbar= get_theme_mod( 'enable_sticky_cart_bar', 'hide');
$stickycarttype= get_theme_mod( 'sticky_cart_bar_background_type', 'standard');
$titlebeforetxt = get_theme_mod( 'stk_txt_text', 'youre viewing');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- Begin Page Headings Layout -->
    <div class="prime-product-template product-main-header container-fluid has_mayosis_dark_alt_bg">
        <?php if ($primetemplate=='featured'): ?>
            <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
            <div class="container-fluid featuredimagebg" style="background:url(<?php echo esc_url($feat_image); ?>) center center;">
            </div>

        <?php endif; ?>
        <div class="container">
            <div class="row productflexfix">
                <?php get_template_part( 'includes/product-header-prime' ); ?>


            </div>

        </div>
    </div>


    <!-- Modal -->
    <div id="variablepricemodal" class="mayosis-overlay">
        <div class="mayosis-popup">
            <div class="modal-header">
                <h4><?php esc_html_e('Choose Your Desired Option(s)','mayosis'); ?></h4>
                <a class="close" href="#">&times;</a>
            </div>
            <div class="modal-body">
                <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID()) ); ?>
            </div>
        </div>
    </div>
    <!-- End Page Headings Layout -->
    <!-- Begin Blog Main Post Layout -->
    <section class="blog-main-content">
        <div class="container">
            <div class="mayosis-floating-share">
                <div class="theiaStickySidebar">
                <?php mayosis_floatsocial(); ?>
                </div>
            </div>
            <?php get_template_part( 'includes/single-product-layout-prime' ); ?>
       </div>
    </section>

    <?php if ($disableprimewidget == 'on'): ?>
    <section class="container-fluid bottom-post-footer-widget has_mayosis_dark_alt_bg">
        <div class="container bottom-product-sidebar">
            <?php get_template_part( 'content/content', 'product-footer-prime' ); ?>
        </div>
    </section>
    <?php endif; ?>
    <!-- End Blog Main Post Layout-->
    
    
</article>

 <?php if($stickycartbar=="show"){?>
    <section class="mayosis-sticky-cart-bar has_mayosis_dark_sec_bg mayosis-sticky-cart-<?php echo esc_html($stickycarttype);?>" id="mayosis-sticky-cart-bar">
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
                    <?php
                    
                            if( function_exists('mayosis_global_edd_price')) { 
                                                mayosis_global_edd_price();
                            }
                    ?>
                    </div>
                </div>
                <div class="col-5 col-md-4">
                   <?php get_template_part( 'includes/products/parts/purchase-btn' ); ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>