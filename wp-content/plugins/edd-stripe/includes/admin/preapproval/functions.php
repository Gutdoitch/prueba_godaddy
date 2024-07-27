<?php
/**
 * Preapproval Admin functions.
 *
 * @since 3.0.0
 */
namespace EDD\StripePro\Admin\Preapproval;

defined( 'ABSPATH' ) || exit;

/**
 * Admin Messages
 *
 * @since 1.6
 * @since 3.0.0 Moved from EDD to Stripe Pro.
 * @return void
 */
function admin_messages() {
	if ( version_compare( EDD_VERSION, '3.2', '<' ) ) {
		return;
	}

	// Don't show these messages to users who cannot edit shop payments.
	if ( ! current_user_can( 'edit_shop_payments' ) ) {
		return;
	}

	if ( isset( $_GET['edd-message'] ) && 'preapproval-charged' == $_GET['edd-message'] ) {
		add_settings_error( 'edds-notices', 'edds-preapproval-charged', __( 'The preapproved order was successfully charged.', 'edds' ), 'updated' );
	}
	if ( isset( $_GET['edd-message'] ) && 'preapproval-failed' == $_GET['edd-message'] ) {
		add_settings_error( 'edds-notices', 'edds-preapproval-charged', __( 'The preapproved order failed to be charged. View order details for further details.', 'edds' ), 'error' );
	}
	if ( isset( $_GET['edd-message'] ) && 'preapproval-cancelled' == $_GET['edd-message'] ) {
		add_settings_error( 'edds-notices', 'edds-preapproval-cancelled', __( 'The preapproved order was successfully cancelled.', 'edds' ), 'updated' );
	}

	settings_errors( 'edds-notices' );
}
add_action( 'admin_notices', __NAMESPACE__ . '\admin_messages' );

/**
 * Trigger preapproved payment charge
 *
 * @since 1.6
 * @since 3.0.0 Moved from EDD to Stripe Pro.
 * @param array $data The data from the link.
 * @return void
 */
function process_preapproved_charge( $data ) {

	if ( empty( $data['nonce'] ) || ! wp_verify_nonce( $data['nonce'], 'edds-process-preapproval' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_shop_payments' ) ) {
		return;
	}

	$payment_id  = absint( $data['payment_id'] );
	$charge      = charge_preapproved( $payment_id );
	$message     = $charge ? 'preapproval-charged' : 'preapproval-failed';
	$url         = edd_get_admin_url(
		array(
			'page'        => 'edd-payment-history',
			'edd-message' => urlencode( $message ),
		)
	);

	edd_redirect( esc_url_raw( $url ) );
}
add_action( 'edd_charge_stripe_preapproval', __NAMESPACE__ . '\process_preapproved_charge' );
// Remove when EDD minimum is 3.2
remove_action( 'edd_charge_stripe_preapproval', 'edds_process_preapproved_charge' );

/**
 * Cancel a preapproved payment
 *
 * @since 1.6
 * @since 3.0.0 Moved from EDD to Stripe Pro.
 * @param array $data The data from the link.
 * @return void
 */
function process_preapproved_cancel( $data ) {

	if ( empty( $data['nonce'] ) || ! wp_verify_nonce( $data['nonce'], 'edds-process-preapproval' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_shop_payments' ) ) {
		return;
	}

	$payment_id = absint( $data['payment_id'] );
	if ( empty( $payment_id ) ) {
		return;
	}

	$order = edd_get_order( $payment_id );
	if ( 'preapproval' !== $order->status ) {
		return;
	}

	$customer_id = edd_get_order_meta( $payment_id, '_edds_stripe_customer_id', true );
	if ( empty( $customer_id ) ) {
		return;
	}

	edd_insert_payment_note( $payment_id, __( 'Preapproval cancelled', 'edds' ) );
	edd_update_payment_status( $payment_id, 'cancelled' );
	edd_delete_order_meta( $payment_id, '_edds_stripe_customer_id' );

	edd_redirect(
		esc_url_raw(
			edd_get_admin_url(
				array(
					'page'        => 'edd-payment-history',
					'edd-message' => 'preapproval-cancelled',
				)
			)
		)
	);
}
add_action( 'edd_cancel_stripe_preapproval', __NAMESPACE__ . '\process_preapproved_cancel' );
// Remove when EDD minimum is 3.2
remove_action( 'edd_cancel_stripe_preapproval', 'edds_process_preapproved_cancel' );

/**
 * Adds a JS confirmation to check whether a preapproved payment should really be cancelled.
 *
 * @since 2.8.10
 * @since 3.0.0 Moved from EDD to Stripe Pro.
 * @return void
 */
add_action( 'admin_print_footer_scripts-download_page_edd-payment-history', function () {
	if ( version_compare( EDD_VERSION, '3.2', '<' ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_shop_payments' ) ) {
		return;
	}
	?>
	<script type="text/javascript" id="stripe-pro-preapproval">
		document.addEventListener( 'DOMContentLoaded', function() {
			var cancelLinks = document.querySelectorAll( '.row-actions .cancel-preapproval a' );
			cancelLinks.forEach( function( link ) {
				link.addEventListener( 'click', function( e ) {
					if ( ! confirm( '<?php esc_attr_e( 'Are you sure you want to cancel this order?', 'edds' ); ?>' ) ) {
						e.preventDefault();
					}
				} );
			} );
		} );
	</script>
	<?php
} );

/**
 * Charge a preapproved payment
 *
 * @since 1.6
 * @since 3.0.0 Moved from EDD to Stripe Pro.
 * @return bool
 */
function charge_preapproved( $payment_id = 0 ) {
	$charge_succeeded = false;

	if ( empty( $payment_id ) ) {
		return $charge_succeeded;
	}

	$payment = edd_get_payment( $payment_id );
	if ( ! in_array( $payment->status, array( 'preapproval', 'preapproval_pending' ), true ) ) {
		return $charge_succeeded;
	}

	$customer_id = $payment->get_meta( '_edds_stripe_customer_id' );
	if ( empty( $customer_id ) ) {
		return $charge_succeeded;
	}

	$setup_intent_id = $payment->get_meta( '_edds_stripe_setup_intent_id' );

	try {
		if ( edds_is_zero_decimal_currency() ) {
			$amount = edd_get_payment_amount( $payment->ID );
		} else {
			$amount = edd_get_payment_amount( $payment->ID ) * 100;
		}

		$cart_details         = edd_get_payment_meta_cart_details( $payment->ID );
		$purchase_summary     = edds_get_payment_description( $cart_details );
		$statement_descriptor = edds_get_statement_descriptor();

		if ( empty( $statement_descriptor ) ) {
			$statement_descriptor = substr( $purchase_summary, 0, 22 );
		}

		$statement_descriptor = apply_filters( 'edds_preapproved_statement_descriptor', $statement_descriptor, $payment->ID );
		$statement_descriptor = edds_sanitize_statement_descriptor( $statement_descriptor );

		if ( empty( $statement_descriptor ) ) {
			$statement_descriptor = null;
		}

		// Create a PaymentIntent using SetupIntent data.
		if ( ! empty( $setup_intent_id ) ) {
			$setup_intent = edds_api_request( 'SetupIntent', 'retrieve', $setup_intent_id );
			$intent_args  = array(
				'amount'               => $amount,
				'currency'             => edd_get_currency(),
				'payment_method'       => $setup_intent->payment_method,
				'customer'             => $setup_intent->customer,
				'off_session'          => true,
				'confirm'              => true,
				'description'          => $purchase_summary,
				'metadata'             => $setup_intent->metadata->toArray(),
				'statement_descriptor' => $statement_descriptor,
			);
		// Process a legacy preapproval. Uses the Customer's default source.
		} else {
			$customer    = \Stripe\Customer::retrieve( $customer_id );
			$intent_args = array(
				'amount'               => $amount,
				'currency'             => edd_get_currency(),
				'payment_method'       => $customer->default_source,
				'customer'             => $customer->id,
				'off_session'          => true,
				'confirm'              => true,
				'description'          => $purchase_summary,
				'metadata'             => array(
					'email'          => edd_get_payment_user_email( $payment->ID ),
					'edd_payment_id' => $payment->ID,
				),
				'statement_descriptor' => $statement_descriptor,
			);
		}

		/** This filter is documented in includes/payment-actions.php */
		$intent_args = apply_filters( 'edds_create_payment_intent_args', $intent_args, array() );

		$payment_intent = edds_api_request( 'PaymentIntent', 'create', $intent_args );

		if ( 'succeeded' === $payment_intent->status ) {
			$charge_id = current( $payment_intent->charges->data )->id;

			$payment->status = 'publish';
			$payment->add_note( 'Stripe Charge ID: ' . $charge_id );
			$payment->add_note( 'Stripe PaymentIntent ID: ' . $payment_intent->id );
			$payment->add_meta( '_edds_stripe_payment_intent_id', $payment_intent->id );
			$payment->transaction_id = $charge_id;

			$charge_succeeded = $payment->save();
		}
	} catch( \Stripe\Exception\ApiErrorException $e ) {
		$error = $e->getJsonBody()['error'];

		$payment->status = 'preapproval_pending';
		$payment->add_note( esc_html(
			edds_get_localized_error_message( $error['code'], $error['message'] )
		) );
		$payment->add_note( 'Stripe PaymentIntent ID: ' . $error['payment_intent']['id'] );
		$payment->add_meta( '_edds_stripe_payment_intent_id', $error['payment_intent']['id'] );
		$payment->save();

		/**
		 * Allows further processing when a Preapproved payment needs further action.
		 *
		 * @since 2.7.0
		 *
		 * @param int $payment_id ID of the payment.
		 */
		do_action( 'edds_preapproved_payment_needs_action', $payment_id );
	} catch( \Exception $e ) {
		$payment->add_note( esc_html( $e->getMessage() ) );
	}

	return $charge_succeeded;
}
