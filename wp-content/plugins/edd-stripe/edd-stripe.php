<?php
/**
 * Plugin Name: Easy Digital Downloads - Stripe Pro Payment Gateway
 * Plugin URI: https://easydigitaldownloads.com/downloads/stripe-gateway/
 * Description: Adds support for pre-authorized credit card payments and removes additional transaction fees.
 * Version: 3.0.1
 * Requires at least: 5.4
 * Requires PHP: 7.1
 * Author: Easy Digital Downloads
 * Author URI: https://easydigitaldownloads.com
 * Text Domain: edds
 * Domain Path: languages
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'EDD_STRIPE_PRO_VERSION' ) ) {
	define( 'EDD_STRIPE_PRO_VERSION', '3.0.1' );
}

/**
 * Initializes the plugin.
 *
 * @since 2.8.1
 */
function edd_stripe_bootstrap() {
	require_once __DIR__ . '/includes/functions.php';
	require_once __DIR__ . '/includes/gateway-filters.php';
	require_once __DIR__ . '/includes/payment-actions.php';
	require_once __DIR__ . '/includes/preapproval.php';

	if ( is_admin() ) {
		require_once __DIR__ . '/includes/admin/functions.php';
		require_once __DIR__ . '/includes/admin/preapproval/filters.php';
		require_once __DIR__ . '/includes/admin/preapproval/functions.php';
		require_once __DIR__ . '/includes/admin/settings/preapproval.php';
	}
}

require_once __DIR__ . '/vendor/autoload.php';
\EDD\ExtensionUtils\v1\ExtensionLoader::loadOrQuit(
	__FILE__,
	'edd_stripe_bootstrap',
	array(
		'php'                    => '7.1',
		'easy-digital-downloads' => '3.1.4',
		'wp'                     => '5.4',
	)
);

/**
 * Sets a transient to indicate that the plugin was just activated.
 *
 * @since 3.0.0
 */
register_activation_hook(
	__FILE__,
	function () {
		// Do nothing if the new install transient is already set.
		if ( get_transient( 'edd_stripe_new_install' ) ) {
			return;
		}

		// If Stripe was already installed, do nothing.
		if ( get_option( 'edds_stripe_version' ) ) {
			return;
		}

		// If an EDD pass license is active that covers Stripe, do nothing.
		if ( class_exists( '\\EDD\\Gateways\\Stripe\\License' ) ) {
			$license = new \EDD\Gateways\Stripe\License();
			if ( $license->is_pass_license ) {
				return;
			}
		}

		// Set the transient for 72 hours.
		set_transient( 'edd_stripe_new_install', time(), HOUR_IN_SECONDS * 72 );
	}
);
