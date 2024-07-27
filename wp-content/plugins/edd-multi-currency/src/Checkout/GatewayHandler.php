<?php
/**
 * GatewayHandler.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Checkout;

use EDD_Multi_Currency\Models\Currency;

class GatewayHandler {

	/**
	 * Modifies the available payment gateways based on the selected currency.
	 *
	 * @since 1.0
	 *
	 * @param array $gateways
	 *
	 * @return array
	 */
	public function setGatewaysFromCurrency( array $gateways ): array {
		try {
			$selectedCurrency = eddMultiCurrency( CurrencyHandler::class )->getSelectedCurrency();
			$currency         = Currency::getBy( 'currency', $selectedCurrency );

			if ( ! empty( $currency->gateways ) ) {
				$gateways = array_filter( $gateways, function ( $gatewayId ) use ( $currency ) {
					return in_array( $gatewayId, $currency->gateways );
				}, ARRAY_FILTER_USE_KEY );
			}
		} catch ( \Exception $e ) {

		}

		return $gateways;
	}

}
