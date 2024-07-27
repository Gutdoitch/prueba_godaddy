<?php
/**
 * Settings.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ServiceProviders;

class Settings implements ServiceProvider {

	/**
	 * @inheritDoc
	 */
	public function register() {
		eddMultiCurrency()->bind( \EDD_Multi_Currency\Admin\Settings::class );
	}

	/**
	 * @inheritDoc
	 */
	public function boot() {
		add_filter( 'edd_settings_sections_gateways', [ eddMultiCurrency( \EDD_Multi_Currency\Admin\Settings::class ), 'registerSection' ] );
		add_filter( 'edd_settings_gateways', [ eddMultiCurrency( \EDD_Multi_Currency\Admin\Settings::class ), 'settings' ] );
		add_action('edd_eddmc_exchange_rate_update_frequency', [ eddMultiCurrency( \EDD_Multi_Currency\Admin\Settings::class ), 'updateFrequencyCallback' ]);
	}
}
