<?php
/**
 * Product.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Models;

use EDD_Multi_Currency\Utils\Currency;

class Product {

	const REGULAR_PRICE_KEY = '_regular_currency_prices';

	const VARIATION_PRICES_KEY = '_variations_regular_currency_prices';

	/**
	 * @var \EDD_Download
	 */
	private $download;

	private $basePrice;

	private $baseVariations = [];

	/**
	 * Product constructor.
	 *
	 * @param int $downloadId
	 *
	 * @throws \Exception
	 */
	public function __construct( int $downloadId ) {
		$this->download = new \EDD_Download( $downloadId );

		if ( ! $this->download->ID ) {
			throw new \Exception( 'Invalid product' );
		}

		$this->setBases();
	}

	/**
	 * Sets the base (unmodified) price or variable prices.
	 *
	 * @since 1.0
	 */
	private function setBases() {
		if ( $this->download->has_variable_prices() ) {
			$this->baseVariations = get_post_meta( $this->download->ID, 'edd_variable_prices', true );
			if ( ! is_array( $this->baseVariations ) ) {
				$this->baseVariations = [];
			}
		} else {
			$this->basePrice = edd_sanitize_amount( (float) get_post_meta( $this->download->ID, 'edd_price', true ) );
		}
	}

	/**
	 * Returns a new Product by ID.
	 *
	 * @param int $downloadId
	 *
	 * @return Product
	 * @throws \Exception
	 */
	public static function fromId( int $downloadId ): Product {
		return new self( $downloadId );
	}

	/**
	 * Whether or not the product has variable prices.
	 *
	 * @since 1.0
	 *
	 * @return bool
	 */
	public function hasVariablePrices(): bool {
		return $this->download->has_variable_prices();
	}

	/**
	 * Gets the product price in a given currency.
	 *
	 * @since 1.0
	 *
	 * @param string $currency Currency to retrieve the price in.
	 *
	 * @return float|int
	 */
	public function getPrice( string $currency ) {
		if ( array_key_exists( $currency, $this->getExplicitPrices() ) ) {
			return $this->getExplicitPrices()[ $currency ];
		}

		try {
			return Currency::convert( $this->basePrice, $currency );
		} catch ( \Exception $e ) {
			return $this->basePrice;
		}
	}

	/**
	 * Returns the variable prices in a given currency.
	 *
	 * @since 1.0
	 *
	 * @param string $currency Currency to retrieve the price in.
	 *
	 * @return array
	 */
	public function getVariablePrices( string $currency ): array {
		$variations     = $this->baseVariations;
		$explicitPrices = $this->getExplicitPrices( self::VARIATION_PRICES_KEY );

		foreach ( $variations as $priceId => $variation ) {
			if ( ! array_key_exists( 'amount', $variation ) ) {
				continue;
			}

			if ( isset( $explicitPrices[ $priceId ][ $currency ] ) ) {
				$variations[ $priceId ]['amount'] = $explicitPrices[ $priceId ][ $currency ];
			} else {
				try {
					$variations[ $priceId ]['amount'] = Currency::convert( $variation['amount'], $currency );
				} catch ( \Exception $e ) {

				}
			}
		}

		return $variations;
	}

	/**
	 * Returns explicitly set (not auto converted) prices.
	 *
	 * @since 1.0
	 *
	 * @param string $type Regular or variable.
	 *
	 * @return array
	 */
	public function getExplicitPrices( string $type = self::REGULAR_PRICE_KEY ): array {
		$result = json_decode( get_post_meta( $this->download->ID, $type, true ), true );
		if ( ! is_array( $result ) ) {
			$result = [];
		}

		return $result;
	}

}
