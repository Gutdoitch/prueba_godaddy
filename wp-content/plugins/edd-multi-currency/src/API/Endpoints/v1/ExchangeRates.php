<?php
/**
 * ExchangeRates.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\API\Endpoints\v1;

use EDD_Multi_Currency\API\RestRoute;
use EDD_Multi_Currency\ExchangeRates\Updater;

class ExchangeRates extends Endpoint implements RestRoute {

	/**
	 * @var Updater
	 */
	private $updater;

	/**
	 * ExchangeRates constructor.
	 *
	 * @param Updater $updater
	 */
	public function __construct( Updater $updater ) {
		$this->updater = $updater;
	}

	/**
	 * @inheritDoc
	 */
	public function register() {
		register_rest_route(
			self::NAMESPACE . '/v1',
			'exchange-rates',
			[
				'methods'             => \WP_REST_Server::EDITABLE,
				'callback'            => [ $this, 'handleRequest' ],
				'permission_callback' => [ $this, 'permissionsCheck' ]
			]
		);
	}

	/**
	 * Updates all exchange rates.
	 *
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function handleRequest( \WP_REST_Request $request ): \WP_REST_Response {
		try {
			$rates = $this->updater->updateRates();

			return new \WP_REST_Response( [
				'last_updated'           => $this->updater::lastUpdatedTime(),
				'last_updated_localized' => $this->updater::lastUpdatedTimeLocalized(),
				'rates'                  => $rates
			] );
		} catch ( \Exception $e ) {
			return new \WP_REST_Response( [
				'error' => $e->getMessage()
			], 500 );
		}
	}
}
