<?php
/**
 * Widget: Currency Selector
 *
 * Buttons view.
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 *
 * @var array                                 $widgetArgs      Widget settings.
 * @var \EDD_Multi_Currency\Models\Currency[] $currencies      Array of available currencies.
 * @var string                                $currentCurrency Currently selected currency.
 */

?>
	<form method="GET">
		<?php foreach ( $currencies as $currency ) : ?>
			<?php
			$classes    = 'button edd-submit edd-multi-currency-button ' . sanitize_html_class( edd_get_option( 'checkout_color', 'blue' ) );
			$buttonText = $currency->currency;
			if ( $currency->currency == $currentCurrency ) {
				$classes    .= ' edd-multi-currency-button--selected';
				$buttonText .= ' ' . __( '(active)', 'edd-multi-currency' );
			}
			?>
			<button
				type="submit"
				class="<?php echo esc_attr( $classes ); ?>"
				name="currency"
				value="<?php echo esc_attr( $currency->currency ); ?>"
				<?php disabled( $currency->currency, $currentCurrency ); ?>
			>
				<?php echo esc_html( $buttonText ); ?>
			</button>
		<?php endforeach; ?>
	</form>
<?php
