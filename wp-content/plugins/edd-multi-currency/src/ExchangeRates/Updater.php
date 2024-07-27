<?php
/**
 * Updater.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2021, Ashley Gibson
 * @license   GPL2+
 */

namespace EDD_Multi_Currency\ExchangeRates;

use EDD_Multi_Currency\ExchangeRates\Providers\Provider;
use EDD_Multi_Currency\Models\Currency;

class Updater {

	const LAST_UPDATE_OPTION_NAME = 'edd_multi_currency_exchange_rates_updated';

	/**
	 * @var Provider
	 */
	public $provider;

	/**
	 * @var string
	 */
	private $baseCurrency;

	/**
	 * Updater constructor.
	 *
	 * @param Provider $provider
	 */
	public function __construct( Provider $provider ) {
		$this->provider     = $provider;
		$this->baseCurrency = \EDD_Multi_Currency\Utils\Currency::getBaseCurrency();
	}

	/**
	 * Sets the exchange rate provider.
	 *
	 * @since 1.0
	 *
	 * @param Provider $provider
	 */
	public function setProvider( Provider $provider ) {
		$this->provider = $provider;
	}

	/**
	 * Retrieves the exchange rates for all currencies.
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function getRates(): array {
		return $this->provider->getRates( Currency::all( [
			'manual' => 0,
			'fields' => 'currency'
		] ) );
	}

	/**
	 * Updates the exchange rates.
	 *
	 * @since 1.0
	 *
	 * @return array Newly set exchange rates.
	 * @throws \Exception
	 */
	public function updateRates(): array {
		edd_debug_log( 'Multi Currency - Updating exchange rates.' );

		global $wpdb;

		try {
			$rates = $this->getRates();
		} catch ( \Exception $e ) {
			edd_debug_log( sprintf(
				'-- Exception while fetching rates: %s',
				$e->getMessage()
			) );

			throw $e;
		}

		foreach ( $rates as $currencyCode => $rate ) {
			if ( $currencyCode !== $this->baseCurrency ) {
				edd_debug_log( sprintf(
					'New %s exchange rate: %f',
					$currencyCode,
					$rate
				) );

				// Using WPDB here because we have the currency code instead of the ID.
				$wpdb->update(
					$wpdb->edd_mc_currencies,
					[ 'rate' => $rate ],
					[ 'currency' => $currencyCode ],
					[ '%f' ],
					[ '%s' ]
				);
			}
		}

		update_option( self::LAST_UPDATE_OPTION_NAME, time() );

		return $rates;
	}

	/**
	 * Returns the time the exchange rates were last updated.
	 *
	 * @since 1.0
	 *
	 * @return int|false Timestamp or false.
	 */
	public static function lastUpdatedTime() {
		return get_option( self::LAST_UPDATE_OPTION_NAME );
	}

	/**
	 * Returns the time the exchange rates were last updated, in the site's
	 * timezone and formatted for display.
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	public static function lastUpdatedTimeLocalized(): string {
		$time = self::lastUpdatedTime();

		if ( ! $time ) {
			return '';
		}

		return edd_date_i18n( $time, get_option( 'date_format' ) . ', ' . get_option( 'time_format' ) ) . ' ' . edd_get_timezone_abbr();
	}

}
