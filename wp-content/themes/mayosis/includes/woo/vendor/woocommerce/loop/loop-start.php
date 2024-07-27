<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce/Templates
 * @version     3.3.0
 */

if (!defined('ABSPATH')) {
    exit;
}
$col= get_theme_mod('woo_archive_column_grid','3');
$productgridsystem= get_theme_mod( 'product_grid_system','one' );
$productmascol= get_theme_mod( 'product_masonry_column','3' );
$pagination= get_theme_mod( 'product_pagination_type','one' );
?>
 <?php if ($productgridsystem=='two'){ ?>
     <div class="product-masonry product-masonry-gutter product-masonry-style-2 product-masonry-masonry product-masonry-full product-masonry-<?php echo esc_html($productmascol);?>-column  <?php
                if ($pagination=='two') { ?>infinite-content-masonry<?php }?>">
 <?php } else { ?>
   <div class="row row-cols-1 row-cols-md-<?php echo esc_html($col);?>">
 <?php } ?>
