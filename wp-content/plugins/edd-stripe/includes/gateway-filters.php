<?php
/**
 * Filters
 *
 * @package EDD_Stripe\Pro
 * @copyright Copyright (c) 2021, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 2.8.5
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register our new payment status labels for EDD
 *
 * @since 1.6
 * @param array $statuses The array of registered payment/order statuses.
 * @return array
 */
function edds_payment_status_labels( $statuses ) {
	$statuses['preapproval']         = __( 'Preapproved', 'edds' );
	$statuses['preapproval_pending'] = __( 'Preapproval Pending', 'edds' );
	$statuses['cancelled']           = __( 'Cancelled', 'edds' );

	return $statuses;
}
add_filter( 'edd_payment_statuses', 'edds_payment_status_labels' );
