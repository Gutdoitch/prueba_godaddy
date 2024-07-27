<?php
/**
 * Plugin.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency;

use EDD_Multi_Currency\Container\Container;
use EDD_Multi_Currency\ServiceProviders\ServiceProvider;
use EDD_Multi_Currency\ServiceProviders;

/**
 * Class Plugin
 *
 * @package EDD_Multi_Currency
 * @mixin Container
 */
class Plugin {

	const VERSION = '1.1.1';

	/**
	 * @var Container
	 */
	private $container;

	/**
	 * Service providers to boot.
	 *
	 * @see Plugin::boot()
	 * @see Plugin::loadServiceProviders()
	 *
	 * @var string[]
	 */
	private $serviceProviders = [
		ServiceProviders\Installer::class,
		ServiceProviders\AdminNotices::class,
		ServiceProviders\AssetLoader::class,
		ServiceProviders\Checkout::class,
		ServiceProviders\Database::class,
		ServiceProviders\ExchangeRates::class,
		ServiceProviders\Licensing::class,
		ServiceProviders\Migration::class,
		ServiceProviders\Products::class,
		ServiceProviders\RestAPI::class,
		ServiceProviders\Settings::class,
		ServiceProviders\ShopCurrencyObserver::class,
		ServiceProviders\TemplateLoader::class,
		ServiceProviders\Widgets::class,
	];

	/**
	 * @var bool Whether or not service providers have been loaded.
	 */
	private $serviceProvidersLoaded = false;

	/**
	 * EDDMultiCurrency constructor.
	 */
	public function __construct() {
		$this->container = new Container();
	}

	/**
	 * Properties are loaded from the service container.
	 *
	 * @since 1.0
	 *
	 * @param string $property
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function __get( $property ) {
		return $this->container->get( $property );
	}

	/**
	 * Magic methods are passed to the service container.
	 *
	 * @since 1.0
	 *
	 * @param $name
	 * @param $arguments
	 *
	 * @return mixed
	 */
	public function __call( $name, $arguments ) {
		return call_user_func_array( [ $this->container, $name ], $arguments );
	}

	/**
	 * Initializes the plugin.
	 *
	 * @since 1.0
	 */
	public function boot() {
		$this->defineConstants();
		$this->loadServiceProviders();
	}

	/**
	 * Defines constants
	 *
	 * @since 1.0
	 */
	private function defineConstants() {
		define( 'EDD_MULTI_CURRENCY_DIRECTORY', dirname( EDD_MULTI_CURRENCY_FILE ) );
	}

	/**
	 * Loads, registers, and boots all service providers.
	 *
	 * @since 1.0
	 */
	private function loadServiceProviders() {
		if ( $this->serviceProvidersLoaded ) {
			return;
		}

		$providers = [];
		foreach ( $this->serviceProviders as $service_provider ) {
			if ( ! is_subclass_of( $service_provider, ServiceProvider::class ) ) {
				throw new \InvalidArgumentException( sprintf( '%s class must implement the ServiceProvider interface.', $service_provider ) );
			}

			/**
			 * @var ServiceProvider $service_provider
			 */
			$service_provider = new $service_provider();
			$service_provider->register();
			$providers[] = $service_provider;
		}

		foreach ( $providers as $service_provider ) {
			$service_provider->boot();
		}

		$this->serviceProvidersLoaded = true;
	}

}
