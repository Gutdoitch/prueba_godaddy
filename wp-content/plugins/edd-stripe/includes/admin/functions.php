<?php
/**
 * Stripe Pro Admin Functions
 *
 * @package EDD_Stripe_Pro
 * @since 3.0.0
 */

namespace EDD\StripePro;

defined( 'ABSPATH' ) || exit;

/**
 * Performs database upgrades.
 *
 * @since 2.6.0
 */
function database_upgrades() {
	$version = get_option( 'edds_stripe_version' );
	if ( version_compare( $version, EDD_STRIPE_PRO_VERSION, '>=' ) ) {
		return;
	}

	$new_version = edd_format_db_version( EDD_STRIPE_PRO_VERSION );

	switch ( $new_version ) {
		case '2.5.8':
			edd_update_option( 'stripe_checkout_remember', true );
			break;
		case '2.8.0':
			edd_update_option( 'stripe_allow_prepaid', true );
			break;
		case '3.0.0':
			if ( ! get_transient( 'edd_stripe_new_install' ) ) {
				set_transient( 'edds_stripe_check_license', true, 30 );
			}
			break;
	}

	update_option( 'edds_stripe_version', EDD_STRIPE_PRO_VERSION );
}
add_action( 'admin_init', __NAMESPACE__ . '\database_upgrades' );
