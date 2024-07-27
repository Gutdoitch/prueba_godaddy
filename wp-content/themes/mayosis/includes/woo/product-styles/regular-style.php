<?php
// get our input from the widget settings.
global $post;
$productthumbvideo = get_theme_mod("thumbnail_video_play", "show");
$productvideointer = get_theme_mod("product_video_interaction", "full");
$productthumbposter = get_theme_mod("thumbnail_video_poster", "show");
$productvcontrol = get_theme_mod("thumb_video_control", "minimal");
$productcartshow = get_theme_mod("thumb_cart_button", "hide");
$productthumbhoverstyle = get_theme_mod(
    "product_thmub_hover_style",
    "style1"
);
?>
<div <?php post_class(); ?>>
    <div class="grid_dm ribbon-box group edge">
        <div class="product-box">
            <?php
            $postdate = get_the_time("Y-m-d"); // Post date
            $postdatestamp = strtotime($postdate);

            $riboontext = get_theme_mod("recent_ribbon_text", "New"); // Newness in days

            $newness = get_theme_mod("recent_ribbon_time", "30"); // Newness in days
            if (time() - 60 * 60 * 24 * $newness < $postdatestamp) {
                // If the product was published within the newness time frame display the new badge
                echo '<div class="wrap-ribbon left-edge point lblue"><span>' .
                    esc_html($riboontext) .
                    "</span></div>";
            }
            ?>
            <figure class="mayosis-fade-in">


                <?php if ($productthumbvideo == "show") { ?>
                <?php if (has_post_format("video")) {

                $mayosis_video = get_post_meta(
                    $post->ID,
                    "woo_video_url",
                    true
                );

                if (strpos($mayosis_video, "youtube.com") == true) {
                    $mayosis_video_cls =
                        "mayosis-youtube-hosted-video";
                } elseif (strpos($mayosis_video, "vimeo") == true) {
                    $mayosis_video_cls =
                        "mayosis-vimeo-hosted-video";

                } elseif (strpos($mayosis_video, "mediadelivery") == true) {
                    $mayosis_video_cls =
                        "mayosis-mediadelivery-hosted-video";
                } else {
                    $mayosis_video_cls =
                        "mayosis-self-hosted-video";
                }
                ?>



                <div class="mayosis--video--box <?php echo esc_html(
                    $mayosis_video_cls
                ); ?>">
                    <div class="video-inner-box-promo">
                        <a href="<?php the_permalink(); ?>" class="mayosis-video-url"></a>
                        <?php get_template_part(
                            "includes/woo/inc/mayosis-video-box-thumb"
                        ); ?>
                        <div class="video-inner-main">


                        </div>
                        <div class="clearfix"></div>
                        <?php if ($productcartshow == "show") { ?>
                            <div class="product-cart-on-hover">
                                <?php
                                if ( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) {
                                    woocommerce_template_loop_add_to_cart();
                                }
                                ?>
                            </div>
                        <?php } ?>
                        <?php if ($productvcontrol == "minimal") { ?>
                            <div class="minimal-video-control">
                                <div class="minimal-control-left">

                                    <?php if (function_exists("edd_favorites_load_link")) {
                                        edd_favorites_load_link($download_id);
                                    } ?>
                                </div>



                                <div class="minimal-control-right">
                                    <ul>
                                        <li>		<?php
                                            if ( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) {
                                                woocommerce_template_loop_add_to_cart();
                                            }
                                            ?>		 </li>
                                        <?php $mayosis_video = get_post_meta($post->ID, "woo_video_url", true); ?>
                                        <li><a href="<?php echo esc_attr($mayosis_video); ?>" data-lity>
                                                <i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>

                                    </ul>
                                </div>

                            </div>
                        <?php } ?>
                    </div>






                    <?php
                    } else {
                    ?>
                    <div class="mayosis--thumb">
                        <?php get_template_part(
                            "includes/product-grid-thumbnail"
                        ); ?>
                        <?php
                        } ?>

                        <?php } else { ?>

                        <div class="mayosis--thumb">
                            <?php get_template_part(
                                "includes/product-grid-thumbnail"
                            ); ?>
                            <?php } ?>

                            <?php if ($productthumbhoverstyle == "style2") { ?>
                                <?php get_template_part("library/product-hover-style-two"); ?>

                            <?php } elseif (
                                $productthumbhoverstyle == "style3"
                            ) { ?>

                                <?php get_template_part("library/product-hover-style-three"); ?>
                            <?php } else { ?>
                                <figcaption class="thumb-caption">
                                    <div class="overlay_content_center">
                                        <?php get_template_part(
                                            "includes/woo/inc/product-hover-content-top"
                                        ); ?>

                                        <div class="product_hover_details_button">
                                            <a href="<?php the_permalink(); ?>" class="button-fill-color"><?php esc_html_e(
                                                    "View Details",
                                                    "mayosis"
                                                ); ?></a>
                                        </div>
                                        <?php
                                        $woo_demo_link = get_post_meta(
                                            get_the_ID(),
                                            "woo_demo_link",
                                            true
                                        );
                                        $livepreviewtext = get_theme_mod(
                                            "live_preview_text",
                                            "Live Preview"
                                        );
                                        ?>
                                        <?php if ($woo_demo_link) { ?>
                                            <div class="product_hover_demo_button">
                                                <a href="<?php echo esc_url(
                                                    $woo_demo_link
                                                ); ?>" class="live_demo_onh" target="_blank"><?php echo esc_html(
                                                        $livepreviewtext
                                                    ); ?></a>
                                            </div>
                                        <?php } ?>

                                        <?php get_template_part(
                                            "includes/woo/inc/product-hover-content-bottom"
                                        ); ?>
                                    </div>
                                </figcaption>
                            <?php } ?>

                        </div>
            </figure>
            <div class="msv-product-meta-box">
               
                    <div class="product-meta">
                        <?php get_template_part( 'includes/woo/inc/product-meta' ); ?>

                    </div>
                
            </div>

        </div>
    </div>
</div>