<?php
/**
 * CurrencyConverter.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Utils;

use EDD_Multi_Currency\Models\Currency as CurrencyModel;

class Currency {

	/**
	 * Returns the store's base currency.
	 * We're not using `edd_get_currency()` here in order to bypass the filter.
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	public static function getBaseCurrency(): string {
		return edd_get_option( 'currency', 'USD' );
	}

	/**
	 * Determines whether or not a currency is valid.
	 *
	 * @since 1.0
	 *
	 * @param string $currency
	 *
	 * @return bool
	 */
	public static function isValidCurrency( string $currency ): bool {
		try {
			return ( $currency === self::getBaseCurrency() ) || CurrencyModel::getBy( 'currency', $currency ) instanceof CurrencyModel;
		} catch ( \Exception $e ) {
			return false;
		}
	}

	/**
	 * Sanitizes a currency code.
	 *
	 * @since 1.0
	 *
	 * @param string $currency
	 *
	 * @return string
	 */
	public static function sanitizeCurrency( string $currency ): string {
		return strtoupper( wp_strip_all_tags( $currency ) );
	}

	/**
	 * Converts an amount from one currency to another.
	 *
	 * @since 1.0
	 *
	 * @param float|int $amount
	 * @param string    $toCurrency
	 * @param string    $fromCurrency If omitted, base store currency is used.
	 *
	 * @return float|int
	 * @throws \Exception
	 * @throws \InvalidArgumentException
	 */
	public static function convert( $amount, string $toCurrency, string $fromCurrency = '' ) {
		if ( empty( $fromCurrency ) ) {
			$fromCurrency = self::getBaseCurrency();
		}

		if ( $fromCurrency === $toCurrency ) {
			return $amount;
		}

		if ( ! is_numeric( $amount ) ) {
			throw new \InvalidArgumentException( 'Amount argument must be numeric.' );
		}

		if ( $fromCurrency === self::getBaseCurrency() ) {
			$fromCurrencyRate = 1;
		} else {
			try {
				$fromCurrencyRate = CurrencyModel::getBy( 'currency', $fromCurrency )->rate;
			} catch ( \Exception $e ) {
				throw new \InvalidArgumentException( sprintf( 'Invalid "from" currency: %s.', esc_html( $fromCurrency ) ) );
			}
		}

		try {
			$toCurrencyObject = CurrencyModel::getBy( 'currency', $toCurrency );
			$toCurrencyRate   = $toCurrencyObject->rate + $toCurrencyObject->markup;
		} catch ( \Exception $e ) {
			throw new \InvalidArgumentException( sprintf( 'Invalid "to" currency: %s.', esc_html( $toCurrency ) ) );
		}

		return $amount * ( $toCurrencyRate / $fromCurrencyRate );
	}

}
