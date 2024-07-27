<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage mayosis
 * @since mayosis 1.0
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$product_active= "";
if ( class_exists( 'WooCommerce' ) ) {
    $product_active = is_product();
}
?>
<?php 
if ( ! $product_active ) { 

?>
<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
	<aside id="secondary" class="sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- .sidebar .widget-area -->
	

<?php endif; ?>

<?php } ?>