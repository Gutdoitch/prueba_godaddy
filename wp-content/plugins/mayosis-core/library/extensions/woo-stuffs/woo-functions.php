<?php
function mayosis_woo_total_sales_count( $atts, $content = null ) {

	$args = shortcode_atts( array(
		'status' => 'completed',
	), $atts );

	$statuses    = array_map( 'trim', explode( ',', $args['status'] ) );
	$order_count = 0;

	foreach ( $statuses as $status ) {

		// if we didn't get a wc- prefix, add one
		if ( 0 !== strpos( $status, 'wc-' ) ) {
			$status = 'wc-' . $status;
		}

		$order_count += wp_count_posts( 'shop_order' )->$status;
	}

	ob_start();

	echo number_format( $order_count );

	return ob_get_clean();
}
add_shortcode( 'mayosis_wc_order_count', 'mayosis_woo_total_sales_count' );

  if (class_exists('WeDevs_Dokan')) {

add_filter( 'woocommerce_product_tabs', 'mayosiswoo_remove_more_seller_product_tab', 98 );
    function mayosiswoo_remove_more_seller_product_tab($tabs) {
    unset($tabs['more_seller_product']);
    return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'mayosis_dokan_remove_seller_info_tab', 50 );
function mayosis_dokan_remove_seller_info_tab( $array ) {
  unset( $array['seller'] );
  return $array;
}

}