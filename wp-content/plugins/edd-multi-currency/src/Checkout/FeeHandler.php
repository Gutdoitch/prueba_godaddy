<?php
/**
 * FeeHandler.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Checkout;

use EDD_Multi_Currency\Utils\Currency;

class FeeHandler {

	/**
	 * Converts fees to the selected currency.
	 *
	 * @since 1.0
	 *
	 * @param array $fees
	 *
	 * @return array
	 */
	public function convertFees( array $fees ): array {
		if ( ! is_array( $fees ) || empty( $fees ) ) {
			return $fees;
		}

		foreach ( $fees as $key => $fee ) {
			// Bail if we've already converted this fee.
			if ( isset( $fee['converted'] ) ) {
				continue;
			}

			// Bail if it's a Discounts Pro fee.
			// @link https://github.com/easydigitaldownloads/edd-multi-currency/issues/7
			if ( 'dp_' === substr( $key, 0, 3 ) ) {
				continue;
			}

			try {
				$fees[ $key ]['amount']    = Currency::convert( $fee['amount'], eddMultiCurrency( CurrencyHandler::class )->getSelectedCurrency() );
				$fees[ $key ]['converted'] = true;
			} catch ( \Exception $e ) {

			}
		}

		return $fees;
	}

}
