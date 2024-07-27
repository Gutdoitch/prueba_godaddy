<?php
/**
 * RestAPI.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ServiceProviders;

use EDD_Multi_Currency\API\Endpoints\v1\Currencies;
use EDD_Multi_Currency\API\Endpoints\v1\ExchangeRates as ExchangeRatesRoute;

class RestAPI implements ServiceProvider {

	/**
	 * API routes to register.
	 *
	 * @var string[]
	 */
	private $routes = [
		Currencies::class,
		ExchangeRatesRoute::class
	];

	/**
	 * @inheritDoc
	 */
	public function register() {

	}

	/**
	 * @inheritDoc
	 */
	public function boot() {
		add_action( 'rest_api_init', [ $this, 'registerRoutes' ] );
	}

	/**
	 * Registers all REST API routes.
	 *
	 * @since 1.0
	 */
	public function registerRoutes() {
		foreach ( $this->routes as $route ) {
			eddMultiCurrency()->make( $route )->register();
		}
	}
}
