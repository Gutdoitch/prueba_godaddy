<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined('ABSPATH') || exit;

// FL: Disable check, Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
//if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
//	return;
//}

global $product, $post;

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = get_post_thumbnail_id($post->ID);
$full_size_image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
$image_title = get_post_field('post_excerpt', $post_thumbnail_id);
$placeholder = $product->get_image_id() ? 'with-images' : 'without-images';
$wrapper_classes = apply_filters('woocommerce_single_product_image_gallery_classes', array(
    'woocommerce-product-gallery',
    'woocommerce-product-gallery--' . ($product->get_image_id() ? 'with-images' : 'without-images'),
    'woocommerce-product-gallery--columns-' . absint($columns),
    'images',
));

$attachment_ids = $product->get_gallery_image_ids();
$thumb_count = count($attachment_ids);
if ($thumb_count < 2) {
   $slider_classes = array('product-gallery-slider', 'slider', 'product-gallery-slider-vertical','emrce_slider-single-image');
} else {
$slider_classes = array('product-gallery-slider', 'slider', 'product-gallery-slider-vertical');
}

$rtl = 'false';
if (is_rtl()) $rtl = 'true';


$slider_classes[] = 'has-image-zoom';


?>
<div class="row">
    <div class="col-12 col-md-10 position-relative">
        <div class="pivoo-product-sale-tag absolute flex items-start">
            <?php
            $postdate = get_the_time('Y-m-d'); // Post date
            $postdatestamp = strtotime($postdate);

            $riboontext = get_theme_mod('recent_ribbon_text', 'New'); // Newness in days

            $newness = get_theme_mod('recent_ribbon_time', '30'); // Newness in days
            if ((time() - (60 * 60 * 24 * floatval($newness))) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
                echo '<span class="pivoo-new-tag">NEW</span>';
            }

            ?>

            <?php woocommerce_show_product_loop_sale_flash(); ?>
            <?php pivoo_woo_sale_hook(); ?>

        </div>
        <div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?> relative mb-half has-hover"
             data-columns="<?php echo esc_attr($columns); ?>">


            <figure class="woocommerce-product-gallery__wrapper <?php echo implode(' ', $slider_classes); ?>"
                    data-flickity='{
                "cellAlign": "center",
                "wrapAround": true,
                "autoPlay": false,
                "prevNextButtons":true,
                "adaptiveHeight": true,
                "imagesLoaded": true,
                "lazyLoad": 1,
                "dragThreshold" : 15,
                "pageDots": false,
                "rightToLeft": <?php echo esc_attr($rtl); ?>
       }'>
                <?php
                $attributes = array(
                    'class' => 'single-product-img',
                    'title' => get_post_field('post_title', $post_thumbnail_id),
                    'data-caption' => get_post_field('post_excerpt', $post_thumbnail_id),
                    'data-src' => $full_size_image[0],
                    'data-large_image' => $full_size_image[0],
                    'data-flickity-lazyload' => $full_size_image[0],
                    'data-large_image_width' => $full_size_image[1],
                    'data-large_image_height' => $full_size_image[2],
                );

                if (has_post_thumbnail()) {
                    $html = '<div data-thumb="' . get_the_post_thumbnail_url($post->ID, 'shop_thumbnail') . '" class="woocommerce-product-gallery__image product-gallery-cell">';
                    $html .= get_the_post_thumbnail($post->ID, 'shop_single', $attributes);
                    $html .= '</div>';
                } else {
                    $html = '<div class="woocommerce-product-gallery__image--placeholder product-gallery-cell">';
                    $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'mayosis'));
                    $html .= '</div>';
                }

                echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id($post->ID));

                do_action('woocommerce_product_thumbnails');
                ?>
            </figure>


        </div>

    </div>

    <?php

    $attachment_ids = $product->get_gallery_image_ids();
    $thumb_count = count($attachment_ids) + 1;

    $rtl = 'false';

    if (is_rtl()) $rtl = 'true';

    $thumb_cell_align = "left";

    if ($attachment_ids) {
        $loop = 0;
        $image_size = 'gallery_thumbnail';
        $gallery_class = array('product-thumbnails', 'thumbnails');
        $gallery_thumbnail = wc_get_image_size(apply_filters('woocommerce_gallery_thumbnail_size', 'woocommerce_' . $image_size));

        if ($thumb_count <= 5) {
            $gallery_class[] = 'slider-no-arrows';
        }

        $gallery_class[] = 'slider row row-slider slider-nav-small small-columns-4';

        ?>
        <div class="col-12 col-md-2 vertical-thumbnails pb-0">

            <div class="<?php echo implode(' ', $gallery_class); ?>"
                 data-flickity='{
                "cellAlign": "left",
                "wrapAround": false,
                "autoPlay": false,
                "prevNextButtons": false,
                "asNavFor": ".product-gallery-slider-vertical",
                "percentPosition": true,
                "imagesLoaded": true,
                "pageDots": false,
                "rightToLeft": <?php echo esc_attr($rtl); ?>,
                "contain":  true
            }'
            ><?php

                if (has_post_thumbnail()) :
                    ?>
                    <div class="col is-nav-selected first">
                        <a>
                            <?php
                            $image_id = get_post_thumbnail_id($post->ID);
                            $image = wp_get_attachment_image_src($image_id, apply_filters('woocommerce_gallery_thumbnail_size', 'woocommerce_' . $image_size));
                            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                            $image = '<img src="' . $image[0] . '" alt="' . $image_alt . '" width="' . $gallery_thumbnail['width'] . '" height="' . $gallery_thumbnail['height'] . '" class="attachment-woocommerce_thumbnail" />';

                            echo maybe_unserialize($image);
                            ?>
                        </a>
                    </div>
                <?php endif;

                foreach ($attachment_ids as $attachment_id) {

                    $classes = array('');
                    $image_class = esc_attr(implode(' ', $classes));
                    $image = wp_get_attachment_image_src($attachment_id, apply_filters('woocommerce_gallery_thumbnail_size', 'woocommerce_' . $image_size));
                    $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
                    $image = '<img src="' . $image[0] . '" alt="' . $image_alt . '" width="' . $gallery_thumbnail['width'] . '" height="' . $gallery_thumbnail['height'] . '"  class="attachment-woocommerce_thumbnail" />';

                    echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<div class="col"><a>%s</a></div>', $image), $attachment_id, $post->ID, $image_class);

                    $loop++;
                }
                ?>
            </div>
        </div>
    <?php } ?>
</div>
