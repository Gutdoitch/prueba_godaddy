<?php
/**
 * ExchangeRates.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ServiceProviders;

use EDD_Multi_Currency\Admin\OrderExchangeRate;
use EDD_Multi_Currency\ExchangeRates\CronManager;
use EDD_Multi_Currency\ExchangeRates\ProviderRegistry;
use EDD_Multi_Currency\ExchangeRates\Providers\OpenExchangeRates;
use EDD_Multi_Currency\ExchangeRates\Providers\Provider;
use EDD_Multi_Currency\ExchangeRates\Updater;

class ExchangeRates implements ServiceProvider {

	/**
	 * Exchange rate providers to register.
	 *
	 * @var \string[][]
	 */
	public $providers = [
		'open_exchange' => [
			'admin_label' => 'Open Exchange Rates',
			'class'       => OpenExchangeRates::class,
		]
	];

	/**
	 * @inheritDoc
	 */
	public function register() {
		eddMultiCurrency()->singleton( ProviderRegistry::class, function () {
			/*
			 * Manually returning an instance here, as otherwise the Container will try
			 * to resolve dependencies for ArrayObject, and will fail due to this error:
			 *
			 * `ReflectionException: Cannot determine default value for internal functions`
			 * @link https://www.php.net/manual/en/reflectionparameter.getdefaultvalue.php
			 *
			 * This is fixed in PHP 8 but won't work in lower versions.
			 */
			return new ProviderRegistry();
		} );
		$this->registerProviders();
		$this->setProviderForUpdater();
		eddMultiCurrency()->bind( Updater::class );
	}

	/**
	 * @inerhitDoc
	 */
	public function boot() {
		add_action( 'init', [ eddMultiCurrency( CronManager::class ), 'maybeScheduleUpdate' ] );
		add_action( CronManager::CRON_HOOK, [ eddMultiCurrency( Updater::class ), 'updateRates' ] );

		add_action( 'edd_view_order_details_payment_meta_before', [ eddMultiCurrency( OrderExchangeRate::class ), '__invoke' ] );
	}

	/**
	 * Registers exchange rate providers.
	 *
	 * @since 1.0
	 */
	private function registerProviders() {
		foreach ( $this->providers as $providerId => $providerDetails ) {
			try {
				eddMultiCurrency( ProviderRegistry::class )->add_item( $providerId, $providerDetails );
			} catch ( \Exception $e ) {
				edd_debug_log( sprintf(
					'Exception registering exchange rate provider %s. Error: %s',
					esc_html( $providerId ),
					$e->getMessage()
				) );
			}
		}
	}

	/**
	 * Sets the exchange rate provider to the currency selected one.
	 *
	 * @since 1.0
	 */
	private function setProviderForUpdater() {
		eddMultiCurrency()->when( Updater::class )
			->needs( Provider::class )
			->give( function () {
				try {
					$selected        = edd_get_option( 'edd_mc_exchange_rate_provider', 'open_exchange' );
					$providerDetails = eddMultiCurrency( ProviderRegistry::class )->get_item( $selected );
					$providerClass   = $providerDetails['class'] ?? '';

					if ( empty( $providerClass ) || ! class_exists( $providerClass ) ) {
						throw new \Exception( sprintf( 'Empty or invalid class for provider %s', $selected ) );
					}

					$providerObj = new $providerClass;
					if ( ! is_subclass_of( $providerObj, Provider::class ) ) {
						throw new \Exception( 'Provider must implement Provider interface.' );
					}

					return $providerObj;
				} catch ( \Exception $e ) {
					edd_debug_log( sprintf( 'Error while resolving provider. Message: %s', $e->getMessage() ) );

					return new OpenExchangeRates();
				}
			} );
	}
}
