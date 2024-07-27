<?php
/**
 * CurrencyChangeDetected.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Admin\Notices;

use EDD_Multi_Currency\Observers\CurrencyObserver;

class CurrencyChangeDetected extends Notice {

	const CAPABILITY = 'manage_options';
	const TYPE = 'warning';

	/**
	 * @inheritDocs
	 */
	protected function content() {
		$data              = CurrencyObserver::getFlagData();
		$changeCurrencyUrl = wp_nonce_url(
			add_query_arg( 'edd_action', 'multi_currency_change_base' ),
			'edd_multi_currency_change_base'
		);
		?>
		<p>
			<?php
			printf(
			/* Translators: %1$s - old currency code; %2$s - new currency code */
				__( '<strong>Warning:</strong> EDD Multi Currency has detected an attempt to change your base shop currency from %1$s to %2$s. Changing your base currency is not advisable once you\'ve already started taking orders. This can create reporting inaccuracies.', 'edd-multi-currency' ),
				esc_html( $data['oldCurrency'] ?? '' ),
				esc_html( $data['newCurrency'] ?? '' )
			);
			?>
		</p>
		<p>
			<a href="<?php echo esc_url( $this->dismissUrl() ); ?>" class="button button-primary">
				<?php printf( esc_html__( 'Stay with %s', 'edd-multi-currency' ), $data['oldCurrency'] ?? edd_get_currency() ); ?>
			</a>

			<?php if ( ! empty( $data['newCurrency'] ) ) : ?>
				<a href="<?php echo esc_url( $changeCurrencyUrl ); ?>" class="button">
					<?php
					/* Translators: %s - currency code */
					printf( esc_html__( 'Change to %s', 'edd-multi-currency' ), esc_html( $data['newCurrency'] ) );
					?>
				</a>
			<?php endif; ?>
		</p>
		<?php
	}

	/**
	 * Display the notice if the currency has changed.
	 *
	 * @since 1.0
	 *
	 * @return bool
	 */
	protected function _shouldDisplay(): bool {
		return CurrencyObserver::currencyHasChanged();
	}

	/**
	 * Dismisses the notice.
	 *
	 * @since 1.0
	 */
	public function dismiss() {
		CurrencyObserver::removeFlag();
	}

	/**
	 * Reverts the change.
	 *
	 * @since 1.0
	 *
	 * @throws \Exception
	 */
	public function maybeChangeBaseCurrency() {
		if ( ! wp_verify_nonce( $_GET['_wpnonce'] ?? '', 'edd_multi_currency_change_base' ) ) {
			throw new \Exception( __( 'You do not have permission to perform this action.', 'edd-multi-currency' ), 403 );
		}

		if ( ! $this->currentUserCanView() ) {
			throw new \Exception( __( 'You do not have permission to perform this action.', 'edd-multi-currency' ), 403 );
		}

		eddMultiCurrency( CurrencyObserver::class )->changeBaseCurrency();
	}
}
