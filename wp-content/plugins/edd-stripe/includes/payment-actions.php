<?php
/**
 * Pro: Payment actions
 *
 * @package EDD_Stripe\Pro
 * @copyright Copyright (c) 2021, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 2.8.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Removes the Application Fee amount.
 *
 * @since 2.8.1
 *
 * @param array $intent_args Intent arguments.
 * @return array
 */
function edds_pro_create_intent_args( $intent_args ) {
	if ( isset( $intent_args['application_fee_amount'] ) ) {
		unset( $intent_args['application_fee_amount'] );
	}

	return $intent_args;
}
add_filter( 'edds_create_payment_intent_args', 'edds_pro_create_intent_args' );
add_filter( 'edds_create_setup_intent_args', 'edds_pro_create_intent_args' );

add_filter( 'edds_show_stripe_connect_fee_message', '__return_false' );
