<?php
/**
 * AssetLoader.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ServiceProviders;

use EDD_Multi_Currency\API\RestRoute;
use EDD_Multi_Currency\Models\Currency;
use EDD_Multi_Currency\Plugin;

class AssetLoader implements ServiceProvider {

	/**
	 * @inheritDocs
	 */
	public function register() {

	}

	/**
	 * @inheritDocs
	 */
	public function boot() {
		add_action( 'admin_enqueue_scripts', [ $this, 'adminAssets' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'frontEndAssets' ] );
	}

	/**
	 * Registers admin assets.
	 *
	 * @since 1.0
	 */
	public function adminAssets() {
		if ( ! edd_is_admin_page( 'settings', 'gateways' ) ) {
			return;
		}

		wp_enqueue_script(
			'edd-multi-currency',
			plugins_url(
				'assets/build/admin.js',
				EDD_MULTI_CURRENCY_FILE
			),
			[ 'wp-element' ],
			Plugin::VERSION,
			true
		);

		$currencies = edd_get_currencies();
		$gateways   = edd_get_enabled_payment_gateways();

		wp_localize_script(
			'edd-multi-currency',
			'eddMultiCurrency',
			[
				'currencies'   => array_map( function ( $value, $key ) {
					return [
						'value' => $key,
						'label' => esc_html( $value )
					];
				}, $currencies, array_keys( $currencies ) ),
				'gateways'     => array_map( function ( $value, $key ) {
					return [
						'value' => $key,
						'label' => esc_html( $value['admin_label'] ?? $key )
					];
				}, $gateways, array_keys( $gateways ) ),
				'api_key'      => edd_get_option( 'edd_mc_open_exchange_api_key' ),
				'restBase'     => rest_url( RestRoute::NAMESPACE . '/v1' ),
				'restNonce'    => wp_create_nonce( 'wp_rest' ),
				'genericError' => esc_html__( 'An error occurred.', 'edd-multi-currency' )
			]
		);

		wp_enqueue_style(
			'edd-multi-currency',
			plugins_url(
				'assets/build/style-admin.css',
				EDD_MULTI_CURRENCY_FILE
			),
			[],
			Plugin::VERSION
		);
	}

	/**
	 * Registers front-end assets.
	 *
	 * @since 1.0
	 */
	public function frontEndAssets() {
		wp_register_script(
			'edd-multi-currency',
			plugins_url(
				'assets/build/frontend.js',
				EDD_MULTI_CURRENCY_FILE
			),
			[],
			Plugin::VERSION,
			true
		);

		wp_enqueue_style(
			'edd-multi-currency',
			plugins_url(
				'assets/build/style-frontend.css',
				EDD_MULTI_CURRENCY_FILE
			),
			[],
			Plugin::VERSION
		);
	}
}
