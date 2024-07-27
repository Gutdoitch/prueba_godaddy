<?php
/**
 * PriceConversion.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Products;

use EDD_Multi_Currency\Checkout\CurrencyHandler;
use EDD_Multi_Currency\Models\Product;
use EDD_Multi_Currency\Traits\ConditionalPriceFilters;

class PriceConversion {

	use ConditionalPriceFilters;

	/**
	 * Converts a product's price to the selected currency.
	 *
	 * @param float|int $price
	 * @param int       $download_id
	 *
	 * @return float|int
	 */
	public function maybeConvertSingle( $price, int $download_id ) {
		if ( ! $this->shouldFilterPrice() ) {
			return $price;
		}

		try {
			return Product::fromId( $download_id )->getPrice( eddMultiCurrency( CurrencyHandler::class )->getSelectedCurrency() );
		} catch ( \Exception $e ) {
			return $price;
		}
	}

	/**
	 * Converts all variable price options to the selected currency.
	 *
	 * @param array $prices
	 * @param int   $productId
	 *
	 * @return array
	 */
	public function maybeConvertVariable( array $prices, int $productId ): array {
		if ( ! $this->shouldFilterPrice() ) {
			return $prices;
		}

		try {
			return Product::fromId( $productId )->getVariablePrices( eddMultiCurrency( CurrencyHandler::class )->getSelectedCurrency() );
		} catch ( \Exception $e ) {
			return $prices;
		}
	}

}
