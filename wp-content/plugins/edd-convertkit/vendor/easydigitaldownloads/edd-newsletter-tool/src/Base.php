<?php
/**
 * Base newsletter class
 *
 * @package EDD_Newsletter
 * @copyright Copyright (c) 2021, Easy Digital Downloads
 * @license   https://opensource.org/licenses/gpl-2.0.php GNU Public License
*/

namespace EDD\Newsletter;

abstract class Base implements Settings, Subscribe {

	/**
	 * The ID for this newsletter extension.
	 * This is defined in `get_id` during `init`.
	 *
	 * @since 1.0
	 */
	public $id;

	/**
	 * The current instance of the class.
	 *
	 * @var Base
	 * @since 1.0
	 */
	protected static $instance;

	/**
	 * Gets the id for the extension.
	 *
	 * @since 1.0
	 * @return string
	 */
	abstract protected function get_id();

	/**
	 * Gets the formal label for the extension.
	 *
	 * @since 1.0
	 * @return string
	 */
	abstract protected function get_label();

	/**
	 * Retrieves the newsletter lists.
	 *
	 * Must return an array like this:
	 *   array(
	 *     'some_id'  => 'value1',
	 *     'other_id' => 'value2'
	 *   )
	 *
	 * @since 1.0
	 */
	abstract public function get_lists();

	/**
	 * Returns the class instance.
	 * Ensures that only one instance of \EDD\Newsletter\Base and the extending classes exist in memory at any one time.
	 *
	 * @since 1.0
	 * @return Base
	 */
	public static function instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Initializes the plugin with default functions.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function init() {
		$this->id = $this->get_id();

		add_action( 'init', array( $this, 'textdomain' ) );

		// Settings
		$tab = $this->get_settings_tab();
		add_filter( "edd_settings_sections_{$tab}", array( $this, 'subsection' ), 10, 1 );
		add_filter( "edd_settings_{$tab}", array( $this, 'settings' ) );

		// Post Meta
		add_action( 'add_meta_boxes_download', array( $this, 'add_metabox' ) );
		add_filter( 'edd_metabox_fields_save', array( $this, 'save_metabox' ) );

		// Subscribe
		add_action( 'edd_purchase_form_before_submit', array( $this, 'checkout_fields' ), 100 );
		add_action( 'edd_insert_payment', array( $this, 'check_for_email_signup' ), 10, 2 );
		add_action( 'edd_complete_purchase', array( $this, 'subscribe_to_lists' ), 30, 3 );
	}

	/**
	 * Load the plugin's textdomain.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function textdomain() {
		load_plugin_textdomain( 'edd_' . $this->id, false, dirname( dirname( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Gets the settings screen URL.
	 *
	 * @since 1.0
	 * @return string
	 */
	protected function get_settings_url() {
		return add_query_arg(
			array(
				'post_type' => 'download',
				'page'      => 'edd-settings',
				'tab'       => urlencode( $this->get_settings_tab() ),
				'section'   => urlencode( $this->id ),
			),
			admin_url( 'edit.php' )
		);
	}

	/**
	 * Gets the settings tab.
	 *
	 * @since 1.0
	 * @return string
	 */
	protected function get_settings_tab() {
		return version_compare( EDD_VERSION, '2.11.4', '>=' ) && array_key_exists( 'marketing', edd_get_settings_tabs() ) ? 'marketing' : 'extensions';
	}

	/**
	 * Output the signup checkbox on the checkout screen, if enabled.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function checkout_fields() {
		if ( ! $this->show_signup_on_checkout() ) {
			return;
		}

		?>
		<fieldset id="edd_<?php echo esc_attr( $this->id ); ?>">
			<p>
				<input name="edd_<?php echo esc_attr( $this->id ); ?>_signup" id="edd_<?php echo esc_attr( $this->id ); ?>_signup" type="checkbox" <?php checked( $this->is_signup_checked_by_default() ); ?>/>
				<label for="edd_<?php echo esc_attr( $this->id ); ?>_signup"><?php echo esc_html( $this->get_checkout_label() ); ?></label>
			</p>
		</fieldset>
		<?php
	}

	/**
	 * Gets the checkout label setting.
	 *
	 * @since 1.0
	 * @return string
	 */
	protected function get_checkout_label() {
		return edd_get_option( "edd_{$this->id}_label", __( 'Sign up for the newsletter', 'easy-digital-downloads' ) );
	}

	/**
	 * Check if a customer needs to be subscribed at checkout.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function check_for_email_signup( $payment_id = 0, $payment_data = array() ) {
		if ( ! empty( $_POST[ "edd_{$this->id}_signup" ] ) ) {
			edd_update_payment_meta( $payment_id, "_{$this->id}_subscribed", 1 );
		}
	}

	/**
	 * Check if a customer needs to be subscribed on completed purchase for the default list and of specific products.
	 *
	 * @since 1.0
	 * @param int $payment_id        The Payment ID being completed.
	 * @param \EDD_Payment $payment   The EDD_Payment object of the payment being completed.
	 * @param \EDD_Customer $customer The customer being processed.
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
		}

		/**
		 * Customers are always added to per-product lists/tags, even if they did not opt in.
		 * Then we go through each item purchased and handle the per-list subscription status.
		 */
		foreach ( $payment->cart_details as $item ) {

			$lists = get_post_meta( $item['id'], $this->get_post_meta_key(), true );

			if ( empty( $lists ) || ! is_array( $lists ) ) {
				continue;
			}

			$lists = array_filter( array_unique( $lists ) );
			foreach ( $lists as $list ) {
				$this->subscribe_email( $user_info, $list );
			}
		}

		$payment->delete_meta( "_{$this->id}_subscribed" );
	}

	/**
	 * Register the metabox on the 'download' post type.
	 *
	 * @since 1.0
	 * @param \WP_Post $post The post object.
	 * @return void
	 */
	public function add_metabox( $post ) {
		if ( current_user_can( 'edit_product', $post->ID ) ) {
			add_meta_box( "edd_{$this->id}", $this->get_label(), array( $this, 'render_metabox' ), 'download', 'side' );
		}
	}

	/**
	 * Display the metabox, which is a list of newsletter lists.
	 *
	 * @since 1.0
	 * @param \WP_Post $post The post object.
	 * @return void
	 */
	public function render_metabox( $post ) {

		$checked = (array) get_post_meta( $post->ID, $this->get_post_meta_key(), true );
		foreach ( $this->get_lists() as $list_id => $list_name ) {
			// Don't show the empty "Select a List" option here.
			if ( empty( $list_id ) ) {
				continue;
			}
			?>
			<label>
				<input type="checkbox" name="<?php echo esc_attr( $this->get_post_meta_key() ); ?>[]" value="<?php echo esc_attr( $list_id ); ?>" <?php checked( true, in_array( $list_id, $checked ) ); ?>>
				&nbsp;<?php echo esc_html( $list_name ); ?>
			</label><br/>
			<?php
		}
	}

	/**
	 * Save the metabox.
	 *
	 * @since 1.0
	 * @param array $fields
	 * @return array
	 */
	public function save_metabox( $fields ) {

		$fields[] = $this->get_post_meta_key();

		return $fields;
	}

	/**
	 * Gets the string for the post meta key.
	 *
	 * @since 1.0
	 * @return string
	 */
	protected function get_post_meta_key() {
		return '_edd_' . esc_attr( $this->id );
	}

	/**
	 * Gets the primary list ID.
	 *
	 * @since 1.0
	 * @return bool|int|string
	 */
	protected function get_primary_list() {
		return edd_get_option( "edd_{$this->id}_list", false );
	}

	/**
	 * Whether the signup option should be shown on checkout.
	 *
	 * @since 1.0
	 * @return bool
	 */
	protected function show_signup_on_checkout() {
		return edd_get_option( "edd_{$this->id}_show_checkout_signup", false ) && $this->get_primary_list();
	}

	/**
	 * Whether the signup checkbox should be checked by default on checkout.
	 *
	 * @since 1.0
	 * @return bool
	 */
	protected function is_signup_checked_by_default() {
		return edd_get_option( "edd_{$this->id}_checkout_signup_default_value", false );
	}
}
