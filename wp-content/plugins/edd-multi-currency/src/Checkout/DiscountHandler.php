<?php
/**
 * DiscountHandler.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Checkout;

use EDD_Multi_Currency\Traits\ConditionalPriceFilters;
use EDD_Multi_Currency\Utils\Currency;

class DiscountHandler {

	use ConditionalPriceFilters;

	/**
	 * Convert flat discount amounts to the selected currency.
	 *
	 * @param int|float $amount
	 * @param int       $discountId
	 *
	 * @return float|int
	 */
	public function convertDiscountAmount( $amount, int $discountId ) {
		if ( $this->shouldFilterPrice() && 'flat' === edd_get_discount_type( $discountId ) ) {
			try {
				$amount = Currency::convert( $amount, eddMultiCurrency( CurrencyHandler::class )->getSelectedCurrency() );
			} catch ( \Exception $e ) {

			}
		}

		return $amount;
	}

}
