<?php
/**
 * Functions
 *
 * @package EDD_Stripe\Pro
 * @copyright Copyright (c) 2023, Easy Digital Downloads
 * @license https://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.0.0
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'edd_extension_license_init',
	function ( \EDD\Extensions\ExtensionRegistry $registry ) {
		$registry->addExtension(
			__FILE__,
			'Stripe Pro Payment Gateway',
			167,
			EDD_STRIPE_PRO_VERSION,
			'stripe_license_key'
		);
	}
);

/**
 * Loads the plugin textdomain.
 *
 * @since 3.0.0
 * @return void
 */
function edds_load_textdomain() {
	load_plugin_textdomain( 'edds', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'init', 'edds_load_textdomain' );
