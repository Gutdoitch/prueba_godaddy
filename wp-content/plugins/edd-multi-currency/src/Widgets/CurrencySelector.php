<?php
/**
 * CurrencySelector.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Widgets;

use EDD_Multi_Currency\Checkout\CurrencyHandler;
use EDD_Multi_Currency\Models\Currency;

class CurrencySelector extends \WP_Widget {

	const TYPE_BUTTONS = 'buttons';
	const TYPE_DROPDOWN = 'dropdown';

	/**
	 * CurrencySelector constructor.
	 */
	public function __construct() {
		parent::__construct(
			'edd_multi_currency_selector',
			__( 'EDD Currency Selector', 'edd-multi-currency' ),
			[
				'description' => __( 'Allows your customers to switch the store\'s currency.', 'edd-multi-currency' )
			]
		);
	}

	/**
	 * Returns an array of all available widget types.
	 *
	 * @since 1.0
	 *
	 * @return array[]
	 */
	protected function widgetTypes() {
		return [
			self::TYPE_BUTTONS  => [
				'name'        => __( 'Buttons', 'edd-multi-currency' ),
				'template'    => 'currency-selector-widget-buttons',
				'description' => __( 'Displays a button for each currency.', 'edd-multi-currency' )
			],
			self::TYPE_DROPDOWN => [
				'name'        => __( 'Dropdown', 'edd-multi-currency' ),
				'template'    => 'currency-selector-widget-dropdown',
				'description' => __( 'Displays a dropdown with all the available currencies.', 'edd-multi-currency' )
			]
		];
	}

	/**
	 * Displays the widget on the front-end.
	 *
	 * @since 1.0
	 *
	 * @param array $args
	 * @param array $instance
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		try {
			$this->loadTemplate( array_merge( $instance, $args ) );
		} catch ( \Exception $e ) {
			if ( current_user_can( 'manage_options' ) ) : ?>
				<p>
					<?php echo esc_html( $e->getMessage() ) ?>
				</p>
			<?php endif;
		}
	}

	/**
	 * Loads the template for the current widget type.
	 *
	 * @since 1.0
	 *
	 * @param array $widgetArgs
	 *
	 * @throws \Exception
	 */
	protected function loadTemplate( $widgetArgs ) {
		$widgetArgs = wp_parse_args( $widgetArgs, [
			'before_widget' => '',
			'after_widget'  => '',
			'title'         => '',
			'widget_type'   => self::TYPE_BUTTONS
		] );

		if ( ! array_key_exists( $widgetArgs['widget_type'], $this->widgetTypes() ) ) {
			throw new \Exception( sprintf( 'Invalid widget type: %s', $widgetArgs['widget_type'] ) );
		}

		$widgetOptions = $this->widgetTypes()[ $widgetArgs['widget_type'] ];

		if ( empty( $widgetOptions['template'] ) ) {
			throw new \Exception( sprintf( 'No template path for widget type %s', $widgetArgs['widget_type'] ) );
		}

		if ( 'dropdown' === $widgetArgs['widget_type'] ) {
			wp_enqueue_script( 'edd-multi-currency' );
		}

		echo $widgetArgs['before_widget'];

		if ( ! empty( $widgetArgs['title'] ) ) {
			echo $widgetArgs['before_title'] . $widgetArgs['title'] . $widgetArgs['after_title'];
		}

		?>
		<div class="edd-multi-currency-selector edd-multi-currency-selector-<?php echo esc_attr( sanitize_html_class( strtolower( $widgetArgs['widget_type'] ) ) ); ?>">
			<?php
			set_query_var( 'widgetArgs', $widgetArgs );
			set_query_var( 'currencies', Currency::all() );
			set_query_var( 'currentCurrency', eddMultiCurrency( CurrencyHandler::class )->getSelectedCurrency() );

			edd_get_template_part( $widgetOptions['template'] );
			?>
		</div>
		<?php
		echo $widgetArgs['after_widget'];
	}

	/**
	 * Outputs the widget form in the admin area.
	 *
	 * @since 1.0
	 *
	 * @param array $instance
	 *
	 * @return void
	 */
	public function form( $instance ) {
		$settings = wp_parse_args( $instance, [
			'title'       => '',
			'widget_type' => self::TYPE_BUTTONS
		] );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php esc_html_e( 'Title:', 'edd-multi-currency' ); ?>
			</label>
			<input
				type="text"
				id="<?php echo $this->get_field_id( 'title' ); ?>"
				class="widefat"
				name="<?php echo $this->get_field_name( 'title' ); ?>"
				value="<?php echo esc_attr( $settings['title'] ); ?>"
			>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'widget_type' ); ?>">
				<?php esc_html_e( 'Widget Type:', 'edd-multi-currency' ); ?>
			</label>
			<select
				id="<?php echo $this->get_field_id( 'widget_type' ); ?>"
				class="widefat"
				name="<?php echo $this->get_field_name( 'widget_type' ); ?>"
			>
				<?php foreach ( $this->widgetTypes() as $typeId => $typeInfo ): ?>
					<option value="<?php echo esc_attr( $typeId ); ?>" <?php selected( $typeId, $settings['widget_type'] ); ?>>
						<?php echo esc_html( ! empty( $typeInfo['name'] ) ? $typeInfo['name'] : '' ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php
	}

	/**
	 * Saves the widget options.
	 *
	 * @since 1.0
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		return [
			'title'       => ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '',
			'widget_type' => ! empty( $new_instance['widget_type'] ) && array_key_exists( $new_instance['widget_type'], $this->widgetTypes() )
				? strip_tags( $new_instance['widget_type'] )
				: self::TYPE_BUTTONS
		];
	}

}
