<?php
/**
 * Currencies.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\API\Endpoints\v1;

use EDD_Multi_Currency\API\RestRoute;
use EDD_Multi_Currency\Models\Currency;
use EDD_Multi_Currency\Models\Exceptions\ModelNotFound;
use WP_REST_Request;
use WP_REST_Response;

class Currencies extends Endpoint implements RestRoute {

	/**
	 * Registers API routes.
	 *
	 * @since 1.0
	 */
	public function register() {
		// List all currencies.
		register_rest_route(
			self::NAMESPACE . '/v1',
			'currencies',
			[
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => [ $this, 'list' ],
				'permission_callback' => [ $this, 'permissionsCheck' ]
			]
		);

		// Create a new currency.
		register_rest_route(
			self::NAMESPACE . '/v1',
			'currency',
			[
				'methods'             => \WP_REST_Server::CREATABLE,
				'callback'            => [ $this, 'create' ],
				'permission_callback' => [ $this, 'permissionsCheck' ],
				'args'                => array_merge(
					[
						'currency' => [
							'required'          => true,
							'validate_callback' => function ( $param, $request, $key ) {
								if ( strlen( $param ) > 3 || strlen( $param ) < 3 ) {
									return false;
								}

								try {
									// If it already exists, that's a problem.
									Currency::getBy( 'code', $param );

									return false;
								} catch ( \Exception $e ) {
									return true;
								}
							},
							'sanitize_callback' => function ( $param, $request, $key ) {
								return wp_strip_all_tags( strtoupper( $param ) );
							}
						]
					],
					$this->currencyArgs()
				)
			]
		);

		// Update a single currency.
		register_rest_route(
			self::NAMESPACE . '/v1',
			'currency/(?P<id>\d+)',
			[
				'methods'             => \WP_REST_Server::EDITABLE,
				'callback'            => [ $this, 'update' ],
				'permission_callback' => [ $this, 'permissionsCheck' ],
				'args'                => array_merge(
					[
						'id' => [
							'required'          => true,
							'validate_callback' => function ( $param, $request, $key ) {
								return is_numeric( $param );
							},
							'sanitize_callback' => function ( $param, $request, $key ) {
								return absint( $param );
							}
						],
					],
					$this->currencyArgs()
				)
			]
		);

		// Delete a single currency.
		register_rest_route(
			self::NAMESPACE . '/v1',
			'currency/(?P<id>\d+)',
			[
				'methods'             => \WP_REST_Server::DELETABLE,
				'callback'            => [ $this, 'delete' ],
				'permission_callback' => [ $this, 'permissionsCheck' ],
				'args'                => [
					'id' => [
						'required'          => true,
						'validate_callback' => function ( $param, $request, $key ) {
							return is_numeric( $param );
						},
						'sanitize_callback' => function ( $param, $request, $key ) {
							return absint( $param );
						}
					],
				]
			]
		);
	}

	/**
	 * Returns currency arguments shared between CREATE and UPDATE.
	 *
	 * @since 1.0
	 *
	 * @return \Closure[][]
	 */
	private function currencyArgs(): array {
		return [
			'rate'     => [
				'validate_callback' => function ( $param, $request, $key ) {
					return empty( $param ) || ( is_numeric( $param ) && $param > 0 );
				},
				'sanitize_callback' => function ( $param, $request, $key ) {
					return empty( $param ) ? 1.0 : (float) $param;
				}
			],
			'manual'   => [
				'validate_callback' => function ( $param, $request, $key ) {
					return in_array( $param, [
						0,
						1,
						true,
						false
					] );
				},
				'sanitize_callback' => function ( $param, $request, $key ) {
					return ! empty( $param ) ? 1 : 0;
				}
			],
			'markup'   => [
				'validate_callback' => function ( $param, $request, $key ) {
					return empty( $param ) || ( is_numeric( $param ) && $param > 0 );
				},
				'sanitize_callback' => function ( $param, $request, $key ) {
					return empty( $param ) ? 0.0 : (float) $param;
				}
			],
			'gateways' => [
				'validate_callback' => function ( $param, $request, $key ) {
					return is_null( $param ) || is_array( $param );
				},
				'sanitize_callback' => function ( $param, $request, $key ) {
					if ( empty( $param ) || ! is_array( $param ) ) {
						return null;
					}

					return json_encode( array_intersect( $param, array_keys( edd_get_payment_gateways() ) ) );
				}
			]
		];
	}

	/**
	 * Callback for listing all currencies.
	 *
	 * @since 1.0
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function list( WP_REST_Request $request ): WP_REST_Response {
		try {
			$currencies = Currency::all();

			return new WP_REST_Response( array_map( function ( Currency $currency ) {
				return $currency->toArray();
			}, $currencies ) );
		} catch ( \Exception $e ) {
			return new WP_REST_Response( [
				'error_message' => $e->getMessage()
			], 500 );
		}
	}

	/**
	 * Callback for creating a new currency.
	 *
	 * @since 1.0
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function create( WP_REST_Request $request ): WP_REST_Response {
		try {
			$currencyId = Currency::create( $request->get_params() );

			return new WP_REST_Response(
				Currency::get( $currencyId )->toArray()
			);
		} catch ( \Exception $e ) {
			return new WP_REST_Response( [
				'error' => $e->getMessage()
			], 500 );
		}
	}

	/**
	 * Callback for updating currencies.
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function update( WP_REST_Request $request ): WP_REST_Response {
		try {
			$params   = $request->get_params();
			$currency = Currency::get( $request->get_param( 'id' ) );
			if ( $currency->is_base ) {
				$params['rate']   = 1;
				$params['markup'] = 0;
			}

			Currency::update( $request->get_param( 'id' ), $params );

			return new WP_REST_Response(
				Currency::get( $request->get_param( 'id' ) )->toArray()
			);
		} catch ( ModelNotFound $e ) {
			return new WP_REST_Response( [
				'error' => esc_html__( 'No such currency.', 'edd-multi-currency' )
			], 404 );
		} catch ( \Exception $e ) {
			return new WP_REST_Response( [
				'error' => $e->getMessage()
			], 500 );
		}
	}

	/**
	 * Callback for deleting a currency.
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function delete( WP_REST_Request $request ): WP_REST_Response {
		try {
			Currency::delete( $request->get_param( 'id' ) );

			return new WP_REST_Response( true );
		} catch ( \Exception $e ) {
			return new WP_REST_Response( [
				'error' => $e->getMessage()
			], 500 );
		}
	}
}
