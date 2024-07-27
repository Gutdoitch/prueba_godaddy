<?php
/**
 * Preapproval Functions.
 */
namespace EDD\StripePro\Preapproval;

defined( 'ABSPATH' ) || exit;

/**
 * Output a Payment authorization form in the Payment Receipt.
 *
 * @since 3.0.0 Moved from EDD to Stripe Pro.
 * @param \EDD\Orders\Order $order The order object.
 */
function receipt_authorize_payment_form( $order ) {

	if ( 'preapproval_pending' !== $order->status ) {
		return;
	}

	$customer_id       = edd_get_order_meta( $order->id, '_edds_stripe_customer_id', true );
	$payment_intent_id = edd_get_order_meta( $order->id, '_edds_stripe_payment_intent_id', true );

	if ( empty( $customer_id ) || empty( $payment_intent_id ) ) {
		return;
	}

	$payment_intent = edds_api_request( 'PaymentIntent', 'retrieve', $payment_intent_id );

	// Enqueue core scripts.
	add_filter( 'edd_is_checkout', '__return_true' );

	edd_load_scripts();

	remove_filter( 'edd_is_checkout', '__return_true' );

	edd_stripe_js( true );
	edd_stripe_css( true );
	?>

<form
	id="edds-update-payment-method"
	data-payment-intent="<?php echo esc_attr( $payment_intent->id ); ?>"
	<?php if ( isset( $payment_intent->last_payment_error ) && isset( $payment_intent->last_payment_error->payment_method ) ) : ?>
	data-payment-method="<?php echo esc_attr( $payment_intent->last_payment_error->payment_method->id ); ?>"
	<?php endif; ?>
>
	<h3><?php esc_html_e( 'Authorize Payment', 'edds' ); ?></h3>
	<p><?php esc_html_e( 'To finalize your preapproved purchase, please confirm your payment method.', 'edds' ); ?></p>

	<div id="edd_checkout_form_wrap">
		<?php
		/** This filter is documented in easydigitaldownloads/includes/checkout/template.php */
		do_action( 'edd_stripe_cc_form' );
		?>

		<p>
			<input
				id="edds-update-payment-method-submit"
				type="submit"
				data-loading="<?php echo esc_attr( 'Please Wait…', 'edds' ); ?>"
				data-submit="<?php echo esc_attr( 'Authorize Payment', 'edds' ); ?>"
				value="<?php echo esc_attr( 'Authorize Payment', 'edds' ); ?>"
				class="button edd-button"
			/>
		</p>

		<div id="edds-update-payment-method-errors"></div>

		<?php
		wp_nonce_field(
			'edds-complete-payment-authorization',
			'edds-complete-payment-authorization'
		);
		?>

	</div>
</form>

	<?php
}
add_action( 'edd_order_receipt_after_table', __NAMESPACE__ . '\receipt_authorize_payment_form' );
// Remove when EDD minimum is 3.2
remove_action( 'edd_payment_receipt_after_table', 'edds_payment_receipt_authorize_payment_form' );

/**
 * Completes a Payment authorization.
 *
 * @since 2.7.0
 */
function complete_payment_authorization() {
	$intent_id = isset( $_REQUEST['intent_id'] ) ? sanitize_text_field( $_REQUEST['intent_id'] ) : null;

	try {
		if ( edd_stripe()->rate_limiting->has_hit_card_error_limit() ) {
			throw new \EDD_Stripe_Gateway_Exception(
				esc_html__(
					'An error occurred, but your payment may have gone through. Please contact the site administrator.',
					'edds'
				),
				'Rate limit reached during payment authorization.'
			);
		}

		$nonce_verified = edds_verify( 'edds-complete-payment-authorization', 'edds-complete-payment-authorization' );
		if ( false === $nonce_verified ) {
			throw new \EDD_Stripe_Gateway_Exception(
				esc_html__(
					'An error occurred, but your payment may have gone through. Please contact the site administrator.',
					'edds'
				),
				'Nonce verification failed during payment authorization.'
			);
		}

		$intent         = edds_api_request( 'PaymentIntent', 'retrieve', $intent_id );
		$edd_payment_id = $intent->metadata->edd_payment_id ? $intent->metadata->edd_payment_id : false;

		if ( ! $edd_payment_id ) {
			throw new \EDD_Stripe_Gateway_Exception(
				esc_html__(
					'An error occurred, but your payment may have gone through. Please contact the site administrator.',
					'edds'
				),
				'Unable to retrieve payment record ID from Stripe metadata.'
			);
		}

		$payment   = edd_get_payment( $edd_payment_id );
		$charge_id = current( $intent->charges->data )->id;

		$payment->add_note( 'Stripe Charge ID: ' . $charge_id );
		$payment->transaction_id = $charge_id;
		$payment->status = 'publish';


		if ( $payment->save() ) {

			/**
			 * Allows further processing after a payment authorization is completed.
			 *
			 * @since 2.7.0
			 *
			 * @param \Stripe\PaymentIntent $intent Created Stripe Intent.
			 * @param EDD_Payment           $payment EDD Payment.
			 */
			do_action( 'edds_payment_authorization_complete', $intent, $payment );

			return wp_send_json_success( array(
				'intent'  => $intent,
				'payment' => $payment,
			) );
		} else {
			throw new \EDD_Stripe_Gateway_Exception(
				esc_html__(
					'An error occurred, but your payment may have gone through. Please contact the site administrator.',
					'edds'
				),
				'Unable to save payment record during authorization.'
			);
		}
	} catch( \Exception $e ) {
		return wp_send_json_error( array(
			'message' => esc_html( $e->getMessage() ),
		) );
	}
}
add_action( 'wp_ajax_edds_complete_payment_authorization', __NAMESPACE__ . '\complete_payment_authorization' );
add_action( 'wp_ajax_nopriv_edds_complete_payment_authorization', __NAMESPACE__ . '\complete_payment_authorization' );
// Remove when EDD minimum is 3.2
remove_action( 'wp_ajax_edds_complete_payment_authorization', 'edds_complete_payment_authorization' );
remove_action( 'wp_ajax_nopriv_edds_complete_payment_authorization', 'edds_complete_payment_authorization' );

/**
 * Removes the link payment method from the Stripe Elements payment method types when preapproval is enabled.
 *
 * @since 3.0.0
 * @param array $types Payment method types.
 * @return array
 */
function remove_link_from_payment_method_types( $types ) {
	return edds_is_preapprove_enabled() ? array( 'card' ) : $types;
}
add_filter( 'edds_stripe_payment_elements_payment_method_types', __NAMESPACE__ . '\remove_link_from_payment_method_types', 50 );
