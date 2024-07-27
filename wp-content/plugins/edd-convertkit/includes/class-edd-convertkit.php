<?php
/**
 * EDD ConvertKit class, extension of the EDD base newsletter classs
 *
 * @copyright   Copyright (c) 2013, Pippin Williamson
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/

use \EDD\Newsletter\Base;

class EDD_ConvertKit extends Base {

	/**
	 * @var EDD_ConvertKit
	 */
	protected static $instance;

	/**
	 * ConvertKit API Key
	 *
	 * @var string
	 */
	public $api_key;

	/**
	 * ConvertKit API Secret
	 *
	 * @var string
	 */
	public $api_secret;

	/**
	 * Convert kit account tags
	 *
	 * @var object
	 */
	public $tags;

	/**
	 * Gets the ID for the class.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	protected function get_id() {
		return 'convertkit';
	}

	/**
	 * Gets the label for the class.
	 *
	 * @since 1.0.9
	 * @return string
	 */
	protected function get_label() {
		return 'ConvertKit';
	}

	/**
	 * Sets up the checkout label
	 */
	public function init() {

		parent::init();
		$this->api_key    = edd_get_option( 'edd_convertkit_api', '' );
		$this->api_secret = edd_get_option( 'edd_convertkit_api_secret', '' );

		$tab = $this->get_settings_tab();
		add_filter( "edd_settings_{$tab}_sanitize", array( $this, 'save_settings' ) );
		add_action( 'edd_after_payment_actions', array( $this, 'after_purchase' ) );
	}

	/**
	 * Retrieves the lists from ConvertKit
	 */
	public function get_lists() {

		$saved_lists = array(
			'' => __( 'Select a form', 'edd-convertkit' ),
		);
		if ( ! empty( $this->api_key ) ) {

			$lists = get_transient( 'edd_convertkit_list_data' );

			if ( false === $lists ) {

				$request = wp_remote_get( 'https://api.convertkit.com/v3/forms?api_key=' . $this->api_key );

				if ( ! is_wp_error( $request ) && 200 === wp_remote_retrieve_response_code( $request ) ) {

					$lists = json_decode( wp_remote_retrieve_body( $request ) );

					set_transient( 'edd_convertkit_list_data', $lists, 4 * HOUR_IN_SECONDS );

				}
			}

			if ( ! empty( $lists ) && ! empty( $lists->forms ) ) {
				foreach ( $lists->forms as $key => $form ) {
					$saved_lists[ $form->id ] = $form->name;
				}
			}
		}

		return (array) $saved_lists;
	}

	/**
	 * Retrieve plugin tags
	 */
	public function get_tags() {

		if( ! empty( $this->api_key ) ) {

			$tags = get_transient( 'edd_convertkit_tag_data' );

			if( false === $tags ) {

				$request = wp_remote_get( 'https://api.convertkit.com/v3/tags?api_key=' . $this->api_key );

				if( ! is_wp_error( $request ) && 200 == wp_remote_retrieve_response_code( $request ) ) {

					$tags = json_decode( wp_remote_retrieve_body( $request ) );

					set_transient( 'edd_convertkit_tag_data', $tags, 24*24*24 );

				}

			}

			if( ! empty( $tags ) && ! empty( $tags->tags ) ) {

				foreach( $tags->tags as $key => $tag ) {

					$this->tags[ $tag->id ] = $tag->name;

				}

			}

		}

		return (array) $this->tags;

	}

	/**
	 * Register our subsection for EDD 2.5
	 *
	 * @since  1.0.3
	 * @param  array $sections The subsections
	 * @return array           The subsections with Convertkit added
	 */
	public function subsection( $sections ) {
		$sections['convertkit'] = __( 'ConvertKit', 'edd-convertkit' );

		return $sections;
	}

	/**
	 * Registers the plugin settings
	 */
	public function settings( $settings ) {

		$edd_convertkit_settings = array(
			array(
				'id'            => 'edd_convertkit_api',
				'name'          => __( 'ConvertKit API Key', 'edd-convertkit' ),
				'desc'          => __( 'Enter your ConvertKit API key', 'edd-convertkit' ),
				'type'          => 'text',
				'size'          => 'regular',
				'tooltip_title' => __( 'API Key', 'edd-convertkit' ),
				'tooltip_desc'  => __( 'This can be found in your ConvertKit account under the Account menu', 'edd-convertkit' ),
			),
			array(
				'id'            => 'edd_convertkit_api_secret',
				'name'          => __( 'ConvertKit API Secret', 'edd-convertkit' ),
				'desc'          => __( 'Enter your ConvertKit API Secret', 'edd-convertkit' ),
				'type'          => 'text',
				'size'          => 'regular',
				'tooltip_title' => __( 'API Secret', 'edd-convertkit' ),
				'tooltip_desc'  => __( 'This can be found in your ConvertKit account under the Account menu', 'edd-convertkit' ),
			),
			array(
				'id'            => 'edd_convertkit_show_checkout_signup',
				'name'          => __( 'Show Signup on Checkout', 'edd-convertkit' ),
				'desc'          => __( 'Allow customers to signup for the list selected below during checkout?', 'edd-convertkit' ),
				'type'          => 'checkbox',
				'tooltip_title' => __( 'Signup on Checkout', 'edd-convertkit' ),
				'tooltip_desc'  => __( 'If enabled, a checkbox will be shown on the checkout screen allowing customers to opt-into an email subscription. If not enabled, customers will be subscribed only if one or more Forms is selected from the Edit screen of the Download product(s) being purchased.', 'edd-convertkit' ),
			),
			array(
				'id'      => 'edd_convertkit_list',
				'name'    => __( 'Choose a form', 'edd-convertkit' ),
				'desc'    => __( 'Select the form you wish to subscribe buyers to. The form can also be selected on a per-product basis from the product edit screen', 'edd-convertkit' ),
				'type'    => 'select',
				'options' => $this->get_lists(),
			),
			array(
				'id'   => 'edd_convertkit_checkout_signup_default_value',
				'name' => __( 'Signup Checked by Default', 'edd-convertkit' ),
				'desc' => __( 'Should the newsletter signup checkbox shown during checkout be checked by default?', 'edd-convertkit' ),
				'type' => 'checkbox',
			),
			array(
				'id'   => 'edd_convertkit_label',
				'name' => __( 'Checkout Label', 'edd-convertkit' ),
				'desc' => __( 'This is the text shown next to the signup option', 'edd-convertkit' ),
				'type' => 'text',
				'size' => 'regular',
			),
		);

		return array_merge( $settings, array( 'convertkit' => $edd_convertkit_settings ) );
	}

	/**
	 * Flush the list transient on save
	 */
	public function save_settings( $input ) {
		if( isset( $input['edd_convertkit_api'] ) ) {
			delete_transient( 'edd_convertkit_list_data' );
			delete_transient( 'edd_convertkit_tag_data' );
		}
		return $input;
	}

	/**
	 * Display the metabox, which is a list of newsletter lists
	 */
	public function render_metabox( $post ) {

		echo '<p>' . esc_html__( 'Select the form you wish buyers to be subscribed to when purchasing. Customers will be subscribed to this form even if they have not opted in during checkout.', 'edd-convertkit' ) . '</p>';

		parent::render_metabox( $post );

		$tags = $this->get_tags();
		if ( ! empty( $tags ) ) {
			$checked = (array) get_post_meta( $post->ID, '_edd_' . esc_attr( $this->id ) . '_tags', true );
			echo '<p>' . __( 'Add the following tags to subscribers. These tags will be applied even if the customer has not opted in during checkout.', 'edd-convertkit' ) . '</p>';
			foreach ( $tags as $tag_id => $tag_name ){
				echo '<label>';
					echo '<input type="checkbox" name="_edd_' . esc_attr( $this->id ) . '_tags[]" value="' . esc_attr( $tag_id ) . '"' . checked( true, in_array( $tag_id, $checked ), false ) . '>';
					echo '&nbsp;' . $tag_name;
				echo '</label><br/>';
			}
		}
	}

	/**
	 * Save the metabox
	 *
	 * @params array $fields
	 */
	public function save_metabox( $fields ) {
		$fields   = parent::save_metabox( $fields );
		$fields[] = '_edd_' . esc_attr( $this->id ) . '_tags';

		return $fields;
	}

	/**
	 * Check if a customer needs to be subscribed on completed purchase for the default list and of specific products
	 *
	 * @param int $payment_id        The Payment ID being completed.
	 * @param EDD_Payment $payment   The EDD_Payment object of the payment being completed.
	 * @param EDD_Customer $customer The customer being processed.
	 */
	public function subscribe_to_lists( $payment_id, \EDD_Payment $payment, \EDD_Customer $customer ) {

		$primary_list = $this->get_primary_list();
		$opted_in     = $payment->get_meta( "_{$this->id}_subscribed" );
		$user_info    = array(
			'first_name' => $payment->first_name,
			'last_name'  => $payment->last_name,
			'email'      => $payment->email,
		);

		// First, subscribe them to the default list if they opted in.
		if ( $opted_in && $primary_list ) {
			$this->subscribe_email( $user_info, $primary_list );
			$payment->update_meta( 'convertkit_subscription', true );
		}

		/**
		 * Customers are always added to per-product lists/tags, even if they did not opt in.
		 * @link https://github.com/easydigitaldownloads/edd-convertkit/issues/22
		 *
		 * Then we go through each item purchased and handle the per-list subscription status.
		 */
		foreach ( $payment->cart_details as $item ) {

			// Add any lists directly assigned to this product in wp-admin
			$lists = get_post_meta( $item['id'], $this->get_post_meta_key(), true );
			$tags  = get_post_meta( $item['id'], '_edd_convertkit_tags', true );

			// Make sure tags is an array.
			if ( ! empty( $tags ) && ! is_array( $tags ) ) {
				$tags = array( $tags );
			}

			if ( empty( $lists ) && ! empty( $tags ) ) {
				// Subscribe them to tags only.
				try {
					$this->subscribe_to_tags( $user_info, $tags );

					if ( $opted_in ) {
						$payment->update_meta( 'convertkit_subscription', true );
					}
				} catch ( \Exception $e ) {
					edd_debug_log( sprintf( 'ConvertKit: Error when subscribing to tags: %s', $e->getMessage() ) );
				}

				continue;
			}

			if ( is_array( $lists ) ) {
				$lists = array_filter( array_unique( $lists ) );
				$tags  = array_unique( $tags );

				foreach ( $lists as $list ) {
					$this->subscribe_email( $user_info, $list, $tags );
				}
			}
		}

		$payment->delete_meta( "_{$this->id}_subscribed" );
	}

	/**
	 * Records purchase record for customer after a purchase is completed
	 *
	 * @param int $payment_id ID of payment
	 *
	 * @return void
	 */
	public function after_purchase( $payment_id ) {

		$payment = new EDD_Payment( $payment_id );

		if ( ! $payment->get_meta( 'convertkit_subscription' ) ) {

			edd_debug_log( 'EDD ConvertKit purchase not recorded because customer was not subscribed.' );
			return;
		}

		$products = array();
		$discount = 0.00;

		foreach( $payment->cart_details as $item ) {
			$products[] = array(
				'name'       => $item['name'],
				'pid'        => 'edd-' . $item['id'],
				'lid'        => $item['item_number']['options']['price_id'],
				'unit_price' => $item['item_price'],
				'quantity'   => $item['quantity']
			);

			$discount += $item['discount'];
		}

		/**
		 * Filter purchase info sent to ConvertKit
		 *
		 * @since 1.1
		 * @return array
		 * @var $payment EDD_Payment object
		 * @var $customer EDD_Customer object
		 */
		$args = apply_filters( 'edd_convertkit_purchase_vars', array(
			'api_secret'       => $this->api_secret,
			'integration_key'  => '0E2M6126Ar7Ny3Z8XZz1yQ',
			'purchase'         => array(
				'integration'      => 'Easy Digital Downloads',
				'transaction_id'   => $payment->transaction_id,
				'email_address'    => $payment->email,
				'products'         => $products,
				'subtotal'         => $payment->subtotal,
				'tax'              => $payment->tax,
				'discount'         => $discount,
				'total'            => $payment->total,
				'currency'         => $payment->currency,
				'transaction_time' => $payment->date
			)
		), $payment );

		$request = wp_remote_post(
			'https://api.convertkit.com/v3/purchases',
			array(
				'body'    => json_encode( $args ),
				'timeout' => 30,
				'headers' => array(
					'Content-Type' => 'application/json'
				)
			)
		);

		if( is_wp_error( $request ) || 201 !== wp_remote_retrieve_response_code( $request ) ) {
			edd_debug_log( 'EDD ConvertKit purchase not recorded. Request result: ' . var_export( $request, true ) );
		}

	}

	/**
	 * Subscribe an email to a list
	 *
	 * @param array $user_info User info as returned by edd_get_payment_meta_user_info()
	 * @param bool|string $list_id Optional. ID of list to subscribe to. If false, the default, value saved in UI will be used.
	 * @param bool $opt_in_overridde Not used
	 * @param array $tags Optional. Optional. Array of tags to add to subscriber
	 *
	 * @return bool
	 */
	public function subscribe_email( $user_info = array(), $list_id = false, $tags = array() ) {

		// Make sure an API key has been entered
		if ( empty( $this->api_key ) ) {
			return false;
		}

		$args   = $this->get_subscription_body( $user_info, $list_id, $tags );
		$return = false;

		$request = wp_remote_post(
			'https://api.convertkit.com/v3/forms/' . $list_id . '/subscribe?api_key=' . $this->api_key,
			array(
				'body'    => $args,
				'timeout' => 30,
			)
		);

		if( ! is_wp_error( $request ) && 200 == wp_remote_retrieve_response_code( $request ) ) {
			$return = true;
		}

		if( ! empty( $tags ) && is_array( $tags ) ) {
			try {
				$this->subscribe_to_tags( $user_info, $tags );
				$return = true;
			} catch ( \Exception $e ) {
				edd_debug_log( sprintf( 'ConvertKit - Error when subscribing user to tags: %s', $e->getMessage() ) );
			}

		}

		return $return;

	}

	/**
	 * Retrieves the arguments used to build an API request body.
	 *
	 * @since 1.0.8
	 *
	 * @param array        $user_info
	 * @param string|false $list_id
	 * @param array        $tags
	 *
	 * @return array
	 */
	private function get_subscription_body( $user_info, $list_id = false, $tags = array() ) {
		/**
		 * Filter subscriber info sent to ConvertKit
		 *
		 * @since 1.0.4
		 * @return array
		 * @var array  $user_info Array including all available user info
		 * @var string $list_id   ID of the ConvertKit list
		 * @var array  $tags      Array of tags
		 */
		return apply_filters( 'edd_convertkit_subscribe_vars', array(
			'email'      => $user_info['email'],
			'first_name' => $user_info['first_name'],
			'fields'     => array(
				'last_name' => $user_info['last_name']
			),
		), $user_info, $list_id, $tags );
	}

	/**
	 * Subscribes a user to the given tags.
	 *
	 * @since 1.0.8
	 *
	 * @param array $user_info
	 * @param array $tags
	 *
	 * @throws Exception
	 */
	private function subscribe_to_tags( $user_info, $tags ) {
		if ( empty( $this->api_key ) ) {
			throw new \Exception( 'Missing API key.' );
		}

		$args = $this->get_subscription_body( $user_info, false, $tags );

		foreach( $tags as $tag ) {
			$response = wp_remote_post(
				'https://api.convertkit.com/v3/tags/' . $tag . '/subscribe?api_key=' . $this->api_key,
				array(
					'body'    => $args,
					'timeout' => 15,
				)
			);

			if ( is_wp_error( $response ) ) {
				throw new \Exception( $response->get_error_message() );
			}

			if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
				throw new \Exception( sprintf(
					'Invalid response from ConvertKit. Code: %d; Response Body: %s',
					wp_remote_retrieve_response_code( $response ),
					wp_remote_retrieve_body( $response )
				) );
			}
		}
	}

}
