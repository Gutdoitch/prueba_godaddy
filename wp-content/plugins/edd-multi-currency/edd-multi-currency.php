<?php
/**
 * Plugin Name: Easy Digital Downloads - Multi-Currency
 * Plugin URI: https://easydigitaldownloads.com/downloads/multi-currency/
 * Description: Allows your store to accept orders in multiple currencies.
 * Author: Easy Digital Downloads
 * Author URI: https://easydigitaldownloads.com
 * Version: 1.1.1
 * Requires at least: 5.4
 * Requires PHP: 7.1
 * Text Domain: edd-multi-currency
 * Domain Path: languages
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 */

const EDD_MULTI_CURRENCY_FILE = __FILE__;

require __DIR__ . '/vendor/autoload.php';

/**
 * EDD Multi-Currency
 *
 * @since 1.0
 *
 * @param string|null $abstract Data to retrieve from the service container.
 *
 * @return \EDD_Multi_Currency\Plugin
 */
function eddMultiCurrency( $abstract = null ) {
	static $instance = null;

	if ( null === $instance ) {
		$instance = new EDD_Multi_Currency\Plugin();
	}

	if ( null !== $abstract ) {
		return $instance->make( $abstract );
	}

	return $instance;
}

/**
 * Initializes the loader, which checks plugin requirements and either boots
 * the main plugin (Plugin) or quits with errors.
 */
\EDD\ExtensionUtils\v1\ExtensionLoader::loadOrQuit(
	EDD_MULTI_CURRENCY_FILE,
	function() {
		eddMultiCurrency()->boot();
	},
	array(
		'php'                    => '7.1',
		'easy-digital-downloads' => '3.0',
		'wp'                     => '5.4',
	)
);

/**
 * When plugin is installed, add an option to flag that the installer should run later.
 * Not doing it now because we don't know that this site has passed the necessary system
 * requirements, etc. So instead, we add an option to trigger it later after the plugin
 * is fully booted.
 *
 * @see \EDD_Multi_Currency\ServiceProviders\Installer
 */
register_activation_hook( EDD_MULTI_CURRENCY_FILE, function () {
	if ( ! get_option( 'edd_multi_currency_version' ) ) {
		update_option( 'edd_multi_currency_run_install', time() );
	}
} );
