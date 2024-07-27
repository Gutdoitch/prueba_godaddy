<?php
/**
 * OrderExchangeRate.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Admin;


use EDD_Multi_Currency\Utils\Currency;

class OrderExchangeRate {

	/**
	 * Displays the order currency and exchange rate in the sidebar.
	 *
	 * @since 1.0
	 *
	 * @param int $orderId
	 */
	public function __invoke( int $orderId ) {
		if ( edd_is_add_order_page() ) {
			return;
		}
		$order = edd_get_order( $orderId );
		if ( $order->currency === Currency::getBaseCurrency() ) {
			return;
		}
		?>
		<div class="edd-order-gateway edd-admin-box-inside edd-admin-box-inside--row">
			<span class="label"><?php esc_html_e( 'Currency', 'edd-multi-currency' ); ?></span>
			<span class="value"><?php echo esc_html( $order->currency ); ?></span>
		</div>

		<div class="edd-order-gateway edd-admin-box-inside edd-admin-box-inside--row">
			<span class="label"><?php esc_html_e( 'Exchange Rate', 'edd-multi-currency' ); ?></span>
			<span class="value"><?php echo esc_html( $order->rate ); ?></span>
		</div>
		<?php
	}

}
