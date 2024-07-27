<?php
/**
 * The default template for download page content
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
global $post;
global $edd_logs;
$author = get_user_by('id', get_query_var('author'));
$author_id = $post->post_author;
$productgallerytype = get_theme_mod('product_gallery_type', 'one');
$download_id = get_the_ID();
$photovtemplate = get_theme_mod('photo_promobar_type', 'color');
$photographyby = get_theme_mod('photography_by', 'Photography By');
$download_cats = get_the_term_list(get_the_ID(), 'download_category', '', _x(' , ', '', 'mayosis'), '');
$promoshow = get_theme_mod('photo_template_promo', 'hide');
$authormetashow = get_theme_mod('photo_template_author_enable', 'enable');
$photozoom = get_theme_mod('photo_zoom_disable', 'enable');
$mediasubscribe = get_theme_mod('media_subscription_box', 'disable');
$mediastyle = get_theme_mod('media_subscription_style', 'stylec');
$mediasubscrib = get_theme_mod('media_subscription_text', 'Download Unlimited Stock Videos at $99/month');
$mediasubscribtitle = get_theme_mod('media_subscription_btn_text', 'Subscribe');
$mediasubscriblink = get_theme_mod('media_subscription_url', '');
$pricealign = get_theme_mod('media_price_align', 'center');
$priceabovetext = get_theme_mod('media_price_desc_txt', '');
$relatedtdownloadstyle = get_theme_mod('related_download_style', 'justified');
$productthumbvideo = get_theme_mod('thumbnail_video_play', 'show');
$productthumbposter = get_theme_mod('thumbnail_video_poster', 'show');
$productrelnumber = get_theme_mod('related_product_number', '8');
$productreltitle = get_theme_mod('related_product_title', 'Similar Images');
$commentmode = get_theme_mod('media_coment', 'normal');
$productvcontrol = get_theme_mod('thumb_video_control', 'minimal');
$productcartshow = get_theme_mod('thumb_cart_button', 'hide');
$mayosis_video = get_post_meta($post->ID, 'video_url', true);
$subscriptionoption = get_theme_mod('photoz_subscription_options');
$loginlink = get_theme_mod('login_url');
$subscriptioncontent = get_theme_mod('subscription_content_show', 'enable');
$subscriberloginst = get_theme_mod('text_on_after_login_subscribtion', 'Download & use without credit. You can generate a license from your dashboard.');
$textlogoutuser = get_theme_mod('text_on_loggout_user', 'Subscribe to download this product. Already subscribed? Please login!');
$textloginuser = get_theme_mod('text_on_loggin_user', 'Subscribe to download this product.Check the subscription plan.');
$textfreedownload = get_theme_mod('text_on_free_download', 'A credit link is required for free downloads. Get a subscription & use without credit!');
$licenseurl = get_theme_mod('license_url_media', '');
$productmascol = get_theme_mod('product_masonry_column', '3');
$productmastitle = get_theme_mod('product_masonry_title_hover', '1');
$titileboxstyle = get_theme_mod('product_masonry_hover_style', 'one');
$photoTemplgap = get_theme_mod('photo_template_box_gap', 'disable');

$stickycartbar= get_theme_mod( 'enable_sticky_cart_bar', 'hide');
$stickycarttype= get_theme_mod( 'sticky_cart_bar_background_type', 'standard');
$titlebeforetxt = get_theme_mod( 'stk_txt_text', 'youre viewing');

$custom_button = get_post_meta($post->ID, 'custom-button-url', true);
$custom_text = get_post_meta($post->ID, 'custom-button-title', true);
$custom_desc = get_post_meta($post->ID, 'custom-button-description', true);
$price = edd_get_download_price(get_the_ID());
$productthumbhoverstyle = get_theme_mod('product_thmub_hover_style', 'style1');
$envato_item_id = get_post_meta($post->ID, 'item_unique_id', true);
$custom_purchase_text= get_post_meta( $post->ID, 'custom_product_text', true );
$custom_purchase_btn = get_post_meta($post->ID, 'custom_product_url', true);


if ($envato_item_id) {
    $api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
    $item_price = $api_item_results_json['price_cents'];
    $item_url = $api_item_results_json['url'];
    $item_number_of_sales = $api_item_results_json['number_of_sales'];
}
?>
<div class="clearfix"></div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- Begin Page Headings Layout -->
    <?php if ($promoshow == 'show') : ?>
        <div class="photo-video-template product-main-header container-fluid">
            <?php if ($photovtemplate == 'featured'): ?>
                <?php $feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                <div class="container-fluid featuredimagebg"
                     style="background:url(<?php echo esc_url($feat_image); ?>) center center;">
                </div>
            <?php elseif ($photovtemplate == 'video'): ?>
                <div class="header-video-template-box">
                    <div class="header_video_part_main">

                        <?php echo do_shortcode('[video src="' . $mayosis_video . '" autoplay="true" fullscreen="false" duration="false" volume="false" progress="false"]'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="photo--tempalte--top-space"></div>
        </div>

    <?php endif; ?>
    <?php if ($mediastyle == 'styled'){ ?>
    <?php if($photoTemplgap== 'enable'){
        $gbClass = 'gx-3';
    } else {
        $gbClass = 'g-0';
    } ?>
    <div class="clearfix"></div>
    <section class="container">
        <div class="photo-template-author">
            <div class="row <?php echo esc_html($gbClass);?>">
                <div class="col-md-8 col-12">
                    <div class="media-box-main">
                        <?php if (has_post_format('video')) { ?>

                            <?php if ($mayosis_video) { ?>
                                <?php get_template_part('library/mayosis-video-box'); ?>
                            <?php } else { ?>
                                <?php $thumb_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                                <img src="<?php echo esc_url($thumb_image); ?>" alt="featured-image"
                                     class="featured-img img-responsive">
                            <?php } ?>
                        <?php } elseif (has_post_format('audio')) { ?>
                            <?php get_template_part('library/mayosis_audio'); ?>
                        <?php } else { ?>
                            <?php $thumb_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>

                            <?php $thumb_image_lity = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail'); ?>
                            <?php if ($photozoom == 'enable') : ?>
                                <a class="photo-image-zoom" data-lity href="<?php echo esc_url($thumb_image_lity); ?>"
                                  ><i class="fas fa-search-plus"></i></a>
                            <?php endif; ?>
                            <img src="<?php echo esc_url($thumb_image); ?>" alt="featured-image"
                                 class="featured-img img-responsive">
                        <?php } ?>


                    </div>

                    <div class="media__content">
                        <?php get_template_part('includes/product-gallery'); ?>
                        <?php the_content(); ?>
                    </div>
                </div>

                <div class="col-md-4 col-12 media-style-four-sidebar">
                    <?php if ($subscriptioncontent == 'enable') { ?>


                    <?php } ?>
                    <?php if (is_active_sidebar('media-template-product')) : ?>

                        <?php dynamic_sidebar('media-template-product'); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>

        </div>
        <?php } else { ?>
        
        <?php if($photoTemplgap== 'enable'){
        $gbClass = 'gx-3';
    } else {
        $gbClass = 'g-0';
    } ?>
            <div class="clearfix"></div>
            <section class="container">
                <div class="photo-template-author">

                    <div class="row <?php echo esc_html($gbClass);?>">
                        <div class="col-md-8 col-12 photo--section--image">
                            <div class="photo-video-box-shadow photo--section--image-content has_mayosis_dark_alt_bg">
                                <?php if (has_post_format('video')) { ?>

                                    <?php if ($mayosis_video) { ?>
                                        <?php get_template_part('library/mayosis-video-box'); ?>
                                    <?php } else { ?>
                                        <?php $thumb_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                                        <img src="<?php echo esc_url($thumb_image); ?>" alt="featured-image"
                                             class="featured-img img-responsive">
                                    <?php } ?>
                                <?php } elseif (has_post_format('audio')) { ?>
                                    <?php get_template_part('library/mayosis_audio'); ?>

                                <?php } elseif (has_post_format('gallery')) { ?>

                                    <?php get_template_part('includes/product-gallery-prime'); ?>
                                <?php } else { ?>
                                    <?php $thumb_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>

                                    <?php $thumb_image_lity = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail'); ?>
                                    <?php if ($photozoom == 'enable') : ?>
                                        <a class="photo-image-zoom" data-lity
                                           href="<?php echo esc_url($thumb_image_lity); ?>"
                                           ><i class="fas fa-search-plus"></i></a>
                                    <?php endif; ?>
                                    <img src="<?php echo esc_url($thumb_image); ?>" alt="featured-image"
                                         class="featured-img img-responsive">
                                <?php } ?>

                            </div>

                        </div>
                        <div class="col-md-4 col-12 photo--credential--box">
                            <div class="photo-credential has_mayosis_dark_sec_bg">
                                <div class="photo--title-block">
                                    <?php if ($mediastyle == 'stylea') { ?>
                                        <div class="media-style-subcs-text d-block d-sm-none">
                                            <h1><?php the_title(); ?></h1>
                                            <span class="opacitydown75"><?php esc_html_e("by", "mayosis"); ?></span> <a
                                                    href="<?php echo mayosis_fes_author_url(get_the_author_meta('ID', $author_id)) ?>">
                                                <?php echo get_the_author_meta('display_name', $author_id); ?>
                                            </a><span
                                                    class="opacitydown75"><?php esc_html_e("in", "mayosis"); ?></span> <?php echo '<span>' . $download_cats . '</span>'; ?>
                                            <span class="opacitydown75"><?php esc_html_e("on", "mayosis"); ?> </span><span><?php echo esc_html(get_the_date()); ?></span>

                                        </div>
                                    <?php } ?>
                                    <?php if ($mediastyle == 'stylea') { ?>
                                        <?php if ($subscriptioncontent == 'enable') { ?>
                                            <div class="photo-subscription-box row">
                                                <div class="col-12 col-md-8">
                                                    <h3><?php echo esc_html($mediasubscrib); ?></h3>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <a href="<?php echo esc_html($mediasubscriblink); ?>"
                                                       class="btn button subscribe-block-btn"><?php echo esc_html($mediasubscribtitle); ?></a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <h1><?php the_title(); ?></h1>
                                        <span class="photo-toolspan"> <?php esc_html_e("in", "mayosis"); ?></span> <?php echo '<span>' . $download_cats . '</span>'; ?>
                                        <span class="photo-toolspan"><?php esc_html_e("on", "mayosis"); ?> <?php echo esc_html(get_the_date()); ?></span>
                                    <?php } ?>
                                </div>

                                <div class="photo--price--block">
                                    <?php if ($priceabovetext) { ?>
                                        <p><?php echo esc_html($priceabovetext); ?></p>
                                    <?php } ?>

                                    <?php if ($envato_item_id) { ?>
                                        <h3 style="text-align:<?php echo esc_html($pricealign); ?>"><?php esc_html_e('$', 'mayosis'); ?><?php echo number_format(($item_price / 100), 2, '.', ' '); ?></h3>
                                    <?php } else { ?>
                                        <h3 style="text-align:<?php echo esc_html($pricealign); ?>"><?php
                                            if (edd_has_variable_prices($download_id)) {
                                                echo edd_price_range($download_id);
                                            } else {
                                                edd_price($download_id);
                                            }
                                            ?></h3>

                                    <?php } ?>

                                    <?php if ($envato_item_id) { ?>
                                        <?php if ($custom_purchase_btn) { ?>
                                            <a href="<?php echo esc_url($custom_purchase_btn); ?>"
                                               class="edd-add-to-cart button blue edd-submit edd-has-js custom-envato-btn">
                                               <?php echo esc_html($custom_purchase_text);?>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo esc_url($item_url); ?>"
                                               class="edd-add-to-cart button blue edd-submit edd-has-js custom-envato-btn">
                                                <?php esc_html_e('Purchase', 'mayosis'); ?>
                                            </a>

                                        <?php } ?>
                                    <?php } else { ?>

                                        <?php if ($custom_purchase_btn) { ?>
                                            <a href="<?php echo esc_url($custom_purchase_btn); ?>"
                                               class="edd-add-to-cart button blue edd-submit edd-has-js custom-envato-btn">
                                              <?php echo esc_html($custom_purchase_text);?>
                                            </a>
                                        <?php } else { ?>
                                            <?php echo edd_get_purchase_link(array('download_id' => get_the_ID())); ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <div class="photo--button--wishlistset photo-wishlist-fav">
                                        <?php if (function_exists('edd_favorites_load_link')) {
                                            edd_favorites_load_link($download_id);
                                        } ?>

                                        <?php if (function_exists('edd_wl_load_wish_list_link')) { ?>
                                            <?php if (edd_has_variable_prices($download_id)): ?>
                                                <a class="photo_edd_el_button edd-wl-button" href="#mayosis_variable_price" data-lity>
                                                    <i class="glyphicon glyphicon-add"></i> <?php esc_html_e('Add to Wishlist', 'mayosis'); ?>
                                                </a>

                                            <?php else: ?>
                                                <?php edd_wl_load_wish_list_link($download_id); ?>
                                            <?php endif; ?>


                                        <?php } ?>


                                        <?php if ($custom_button) { ?>
                                            <div class="photo--template--cs-button">

                                                <a href="<?php echo esc_html($custom_button); ?>" class="ghost_button"
                                                   target="_blank"><?php echo esc_html($custom_text); ?></a>
                                                <?php if ($productbottomextratext == 'show'): ?>
                                                    <p class="text-center extra__text"><?php echo esc_html($custom_desc); ?></p>

                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>


                                </div>
                                <?php if (function_exists('mayosis_photosocial')) {
                                    mayosis_photosocial();
                                } ?>
                                <?php if ($authormetashow == 'enable') : ?>
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
                                            global $post;
                                            $author = $post->post_author;
                                            ?>
                                            <a href="<?php echo mayosis_fes_author_url($author) ?>"
                                               class="photo--template--button"><?php esc_html_e('View Portfolio', 'mayosis'); ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 col-12">

                            <?php if ($mediastyle == 'stylea') { ?>
                                <div class="media-style-subcs-style-a">
                                    <div class="media-style-subcs-text d-none d-sm-block px-0 py-3">
                                        <h1><?php the_title(); ?></h1>
                                        <span class="opacitydown75"><?php esc_html_e("by", "mayosis"); ?></span> <a
                                                href="<?php echo mayosis_fes_author_url(get_the_author_meta('ID', $author_id)) ?>">
                                            <?php echo get_the_author_meta('display_name', $author_id); ?>
                                        </a><span
                                                class="opacitydown75"><?php esc_html_e("in", "mayosis"); ?></span> <?php echo '<span>' . $download_cats . '</span>'; ?>
                                        <span class="opacitydown75"><?php esc_html_e("on", "mayosis"); ?> </span><span><?php echo esc_html(get_the_date()); ?></span>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </section>
            <!-- End Page Headings Layout -->
            <!-- Begin Blog Main Post Layout -->
            <?php if ($mediastyle == 'styleb') { ?>

                <section class="container stylebphotos">
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="xtra-desktop-padding">
                                <?php get_template_part('includes/photo-template-style-b'); ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 no-paading-left-desktop no-paading-right-desktop subscribe-box-photo-main">
                            <?php if ($subscriptioncontent == 'enable') { ?>
                                <div class="subscribe-box-photo">
                                    <h4><?php echo esc_html($mediasubscrib); ?></h4>
                                    <div class="photo-subscribe--content">
                                        <ul>
                                            <?php foreach ($subscriptionoption as $setting) : ?>
                                                <li>
                                                    <i class="zil zi-check"></i> <?php echo esc_html($setting['subscription_option']); ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <a href="<?php echo esc_html($mediasubscriblink); ?>"
                                           class="btn button subscribe-block-btn"><?php echo esc_html($mediasubscribtitle); ?></a>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if (is_active_sidebar('media-template-product')) : ?>

                                <?php dynamic_sidebar('media-template-product'); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            <?php } else { ?>
                <?php if ('' !== get_post()->post_content) { ?>
                    <section class="container blog-main-content photo-template-main-content">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="photo--template--content has_mayosis_dark_alt_bg">
                                    <?php get_template_part('includes/product-gallery'); ?>
                                    <?php the_content(); ?>
                                </div>

                            </div>
                        </div>
                    </section>
                <?php } ?>
            <?php } ?>
        <?php } ?>


        <?php get_template_part('includes/photo-template-bottom-part');?>


        <!-- End Blog Main Post Layout-->
        <!-- Modal -->
        <div id="mayosis_variable_price" class="lity-hide msv-wislist-box">
            
                    <h4><?php esc_html_e('Choose Your Desired Option(s) & Add Wishlist','mayosis'); ?></h4>
                   
               
            
                    <?php echo edd_get_purchase_link(array('download_id' => get_the_ID())); ?>
            
           
        </div>
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