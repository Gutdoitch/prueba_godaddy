<?php
/**
 * SettingsMigrator.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Migrations\CurrencySwitcher;

use EDD_Multi_Currency\Models\Currency;

class SettingsMigrator {

	/**
	 * @var array
	 */
	private $oldSettings;

	/**
	 * Migrates from Currency Switcher if the option is available.
	 *
	 * @since 1.0
	 */
	public function maybeMigrate() {
		$this->oldSettings = get_option( 'edd_aelia_currencyswitcher' );
		if ( empty( $this->oldSettings ) ) {
			return;
		}

		try {
			$this->migrateExchangeRates();
			$this->migrateSettings();
		} catch ( \Exception $e ) {
			edd_debug_log( sprintf(
				'Multi Currency - Exception while migrating settings from Currency Switcher: %s',
				$e->getMessage()
			) );
		}
	}

	/**
	 * Migrates exchange rates.
	 *
	 * @since 1.0
	 *
	 * @throws \Exception
	 */
	protected function migrateExchangeRates() {
		$exchangeRates = ! empty( $this->oldSettings['exchange_rates'] ) && is_array( $this->oldSettings['exchange_rates'] )
			? $this->oldSettings['exchange_rates']
			: [];

		foreach ( $exchangeRates as $currencyCode => $exchangeRate ) {
			$gateways = $this->oldSettings['payment_gateways'][ $currencyCode ]['enabled_gateways'] ?? null;

			Currency::create( [
				'currency' => strtoupper( $currencyCode ),
				'rate'     => isset( $exchangeRate['rate'] ) ? (float) $exchangeRate['rate'] : 1,
				'markup'   => isset( $exchangeRate['rate_markup'] ) ? (float) $exchangeRate['rate_markup'] : 0,
				'manual'   => ! empty( $exchangeRate['set_manually'] ) ? 1 : 0,
				'gateways' => ! empty( $gateways ) && is_array( $gateways ) ? json_encode( $gateways ) : null
			] );
		}
	}

	/**
	 * Migrates general Currency Switcher settings.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	protected function migrateSettings(): void {
		if ( ! empty( $this->oldSettings['openexchange_api_key'] ) ) {
			edd_update_option( 'edd_mc_exchange_rate_provider', 'open_exchange' );
			edd_update_option( 'edd_mc_open_exchange_api_key', sanitize_text_field( $this->oldSettings['openexchange_api_key'] ) );
		}

		if ( ! empty( $this->oldSettings['exchange_rates_update_enable'] ) ) {
			edd_update_option( 'eddmc_auto_update_exchange_rates', '1' );
		}

		$oldUpdateSchedule = $this->oldSettings['exchange_rates_update_schedule'] ?? null;
		if ( in_array( $oldUpdateSchedule, [ 'hourly', 'twicedaily', 'daily', 'weekly' ], true ) ) {
			edd_update_option( 'eddmc_exchange_rate_update_frequency', sanitize_text_field( $oldUpdateSchedule ) );
		}
	}

}
