<?php
/**
 * Preapproval admin filters.
 *
 * @since 3.0.0
 */
namespace EDD\StripePro\Admin\Preapproval;

defined( 'ABSPATH' ) || exit;

/**
 * Show the Process / Cancel buttons for preapproved payments
 *
 * @since 1.6
 * @since 3.0.0 Moved from EDD to Stripe Pro.
 * @return string
 */
function edds_payments_column_data( $value, $order_id, $column_name ) {
	if ( 'status' !== $column_name ) {
		return $value;
	}

	$order = edd_get_order( $order_id );
	if ( ! in_array( $order->status, array( 'preapproval', 'preapproval_pending' ), true ) ) {
		return $value;
	}

	$customer_id = edd_get_order_meta( $order_id, '_edds_stripe_customer_id', true );

	if ( empty( $customer_id ) ) {
		return $value;
	}

	$nonce = wp_create_nonce( 'edds-process-preapproval' );

	$base_args        = array(
		'post_type'  => 'download',
		'page'       => 'edd-payment-history',
		'payment_id' => urlencode( $order_id ),
		'nonce'      => urlencode( $nonce ),
	);
	$preapproval_args = array(
		'edd-action' => 'charge_stripe_preapproval',
	);
	$cancel_args      = array(
		'preapproval_key' => urlencode( $customer_id ),
		'edd-action'      => 'cancel_stripe_preapproval',
	);

	$actions = array(
		sprintf(
			'<a href="%s">%s</a>',
			esc_url(
				add_query_arg(
					array_merge( $base_args, $preapproval_args ),
					admin_url( 'edit.php' )
				)
			),
			esc_html__( 'Process', 'edds' )
		),
	);
	if ( 'preapproval' === $order->status ) {
		$actions[] = sprintf(
			'<span class="cancel-preapproval"><a href="%s">%s</a></span>',
			esc_url(
				add_query_arg(
					array_merge( $base_args, $cancel_args ),
					admin_url( 'edit.php' )
				)
			),
			esc_html__( 'Cancel', 'edds' )
		);
	}

	$value .= '<p class="row-actions">';
	$value .= implode( ' | ', $actions );
	$value .= '</p>';

	return $value;
}
add_filter( 'edd_payments_table_column', __NAMESPACE__ . '\edds_payments_column_data', 20, 3 );
// Remove when EDD minimum is 3.2
remove_filter( 'edd_payments_table_column', 'edds_payments_column_data', 20, 3 );

/**
 * Adds bulk actions to mark orders as preapproved or cancel preapproved orders..
 *
 * @since 3.0.0
 * @return array
 */
function register_bulk_actions( $actions ) {
	if ( ! empty( $_GET['order_type'] ) && 'refund' === $_GET['order_type'] ) {
		return $actions;
	}
	if ( ! current_user_can( 'edit_shop_payments' ) ) {
		return $actions;
	}
	$position = array_search(
		'resend-receipt',
		array_keys( $actions ),
		true
	);

	$new_actions = $actions;
	array_splice(
		$new_actions,
		$position
	);
	$new_actions['set-status-preapproval'] = __( 'Mark Preapproved', 'edds' );
	$new_actions['set-status-cancelled']   = __( 'Mark Cancelled', 'edds' );

	return array_merge( $new_actions, $actions );
}
add_filter( 'edd_payments_table_bulk_actions', __NAMESPACE__ . '\register_bulk_actions' );

/**
 * Process the bulk action to mark orders as preapproved.
 *
 * @since 3.0.0
 * @return void
 */
function process_bulk_action( $id, $action ) {
	if ( version_compare( EDD_VERSION, '3.2', '<' ) ) {
		return;
	}
	if ( ! in_array( $action, array( 'set-status-preapproval', 'set-status-cancelled' ), true )  ) {
		return;
	}
	if ( ! current_user_can( 'edit_shop_payments' ) ) {
		return;
	}

	if ( 'set-status-cancelled' === $action ) {
		edd_update_payment_status( $id, 'cancelled' );
	} elseif ( 'set-status-preapproval' === $action ) {
		edd_update_payment_status( $id, 'preapproval' );
	}
}
add_filter( 'edd_payments_table_do_bulk_action', __NAMESPACE__ . '\process_bulk_action', 10, 2 );
