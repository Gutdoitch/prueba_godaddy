<?php
/**
 * Installer.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ServiceProviders;

use EDD_Multi_Currency\Models\Currency;
use EDD_Multi_Currency\Models\Exceptions\ModelNotFound;
use EDD_Multi_Currency\Plugin;
use EDD_Multi_Currency\Utils;

class Installer implements ServiceProvider {

	public function register() {

	}

	public function boot() {
		/**
		 * This `admin_init` hook priority needs to be after BerlinDB runs the table install.
		 * @see Table::add_hooks()
		 */
		add_action( 'admin_init', function () {
			if ( ! get_option( 'edd_multi_currency_run_install' ) ) {
				return;
			}

			update_option( 'edd_multi_currency_version', Plugin::VERSION );

			// Insert the store currency.
			$this->storeBaseCurrency();

			/**
			 * Fires when the installer is running.
			 *
			 * @since 1.0
			 */
			do_action( 'edd_multi_currency_install' );

			// Delete the option so we don't run this process again.
			delete_option( 'edd_multi_currency_run_install' );
		}, 100 );
	}

	/**
	 * Inserts the store's base currency into the `wp_edd_mc_currencies` database.
	 *
	 * @return void
	 * @throws \Exception
	 */
	private function storeBaseCurrency(): void {
		$baseCurrency = Utils\Currency::getBaseCurrency();

		try {
			$currency = Currency::getBy( 'currency', $baseCurrency );
			Currency::update( $currency->id, [
				'is_base' => 1,
				'rate'    => 1,
			] );
		} catch ( ModelNotFound $e ) {
			Currency::create( [
				'currency' => $baseCurrency,
				'is_base'  => 1,
				'rate'     => 1,
			] );
		} catch ( \Exception $e ) {
			edd_debug_log( sprintf(
				'Exception while inserting base currency into database. Message: %s',
				$e->getMessage()
			) );
		}
	}
}
