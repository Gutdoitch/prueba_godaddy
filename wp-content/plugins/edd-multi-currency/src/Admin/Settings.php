<?php
/**
 * Settings.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Admin;

use EDD_Multi_Currency\ExchangeRates\ProviderRegistry;
use EDD_Multi_Currency\ExchangeRates\Updater;

class Settings {

	/**
	 * Registers a new settings section for Multi Currency.
	 *
	 * @since 1.0
	 *
	 * @param array $sections
	 *
	 * @return array
	 */
	public function registerSection( $sections ) {
		$sections['multi_currency'] = __( 'Multi Currency', 'edd-multi-currency' );

		return $sections;
	}

	public function settings( $settings ): array {
		$providers = [];
		foreach ( eddMultiCurrency( ProviderRegistry::class )->get_items() as $id => $info ) {
			$providers[ $id ] = $info['admin_label'] ?? $id;
		}

		$mcSettings = [
			[
				'id'   => 'eddmc_currencies',
				'name' => '<strong>' . esc_html__( 'Currencies', 'edd-multi-currency' ) . '</strong>',
				'type' => 'descriptive_text',
				'desc' => '<div id="edd-multi-currency-table-app"></div>',
			],
			[
				'id'   => 'eddmc_exchange_rates_header',
				'name' => '<strong>' . esc_html__( 'Exchange Rate Service', 'edd-multi-currency' ) . '</strong>',
				'desc' => '',
				'type' => 'header',
			],
			[
				'id'      => 'edd_mc_exchange_rate_provider',
				'name'    => __( 'Provider', 'edd-multi-currency' ),
				'desc'    => '',
				'type'    => 'select',
				'options' => $providers
			],
			[
				'id'   => 'edd_mc_open_exchange_api_key',
				'name' => __( 'Open Exchange Rates API Key', 'edd-multi-currency' ),
				'desc' => sprintf(
					__( 'You can obtain an API key from <a href="%s" target="_blank">openexchangerates.org</a>.', 'edd-multi-currency' ),
					'https://openexchangerates.org/'
				),
				'type' => 'text'
			],
			[
				'id'    => 'eddmc_auto_update_exchange_rates',
				'name'  => __( 'Auto Update Rates', 'edd-multi-currency' ),
				'desc'  => '',
				'type'  => 'checkbox',
				'class' => 'edd-toggle',
			],
			[
				'id'   => 'eddmc_exchange_rate_update_frequency',
				'name' => __( 'Update Frequency', 'edd-multi-currency' ),
				'type' => 'hook',
			],
		];

		return array_merge( $settings, [ 'multi_currency' => $mcSettings ] );
	}

	/**
	 * Renders the "Update Frequency" setting.
	 * This is done via a hook so we can put the "Update Now" button right next
	 * to the select dropdown.
	 *
	 * @since 1.0
	 *
	 * @param array $args
	 */
	public function updateFrequencyCallback( array $args ) {
		$auto_updates_enabled = edd_get_option( 'eddmc_auto_update_exchange_rates', false );

		echo EDD()->html->select( [
			'id'               => 'edd_settings[eddmc_exchange_rate_update_frequency]',
			'name'             => 'edd_settings[eddmc_exchange_rate_update_frequency]',
			'selected'         => edd_get_option( 'eddmc_exchange_rate_update_frequency', 'daily' ),
			'show_option_all'  => false,
			'show_option_none' => false,
			'disabled'         => ! ( $auto_updates_enabled ),
			'options'          => [
				'hourly'     => __( 'Once Hourly', 'edd-multi-currency' ),
				'twicedaily' => __( 'Twice Daily', 'edd-multi-currency' ),
				'daily'      => __( 'Once Daily', 'edd-multi-currency' ),
				'weekly'     => __( 'Once Weekly', 'edd-multi-currency' )
			],
		] );
		?>
		<button
			type="button"
			id="edd-multi-currency-update-exchange-rates"
			class="button"
		>
			<?php esc_html_e( 'Update Now', 'edd-multi-currency' ); ?>
		</button>
		<p id="edd-multi-currency-exchange-rates-updated-date" class="description"<?php echo ! Updater::lastUpdatedTime() ? ' style="display:none;"' : '' ?>>
			<?php
			printf(
			/* Translators: %s date the exchange rates were last updated */
				esc_html__( 'Last updated: %s', 'edd-multi-currency' ),
				'<span>' . Updater::lastUpdatedTimeLocalized() . '</span>'
			)
			?>
		</p>
		<div id="edd-multi-currency-exchange-rates-updated-response"></div>
		<?php
	}

	public function appendExchangeRateUpdateTime( $html, $args ): string {
		if ( 'eddmc_exchange_rate_update_frequency' === $args['id'] ?? '' ) {
			$html .= '<button type="button" class="button">' . esc_html__( 'Update Now', 'edd-multi-currency' ) . '</button>';
		}

		return $html;
	}

}
