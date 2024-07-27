<?php
/**
 * Provider.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ExchangeRates\Providers;

use EDD_Multi_Currency\ExchangeRates\Exceptions\ApiException;
use EDD_Multi_Currency\Utils\Currency;

abstract class Provider {

	/**
	 * Returns the exchange rates for all the supplied currencies.
	 *
	 * @param array $currencies Currency codes to get the rates for.
	 *
	 * @return array
	 */
	public function getRates( array $currencies ): array {
		return $this->_getRates( $currencies, eddMultiCurrency( Currency::class )::getBaseCurrency() );
	}

	/**
	 * Validates the response and returns the body.
	 *
	 * @since 1.0
	 *
	 * @param array|\WP_Error $response
	 *
	 * @return array
	 * @throws ApiException
	 */
	protected function validateAndReturnBody( $response ): array {
		if ( is_wp_error( $response ) ) {
			throw new ApiException( sprintf(
				'WP Error in response. Message: %s',
				$response->get_error_message()
			) );
		}

		$responseCode = wp_remote_retrieve_response_code( $response );
		$body         = wp_remote_retrieve_body( $response );
		if ( 200 !== $responseCode ) {
			throw new ApiException( sprintf(
				'Invalid response code %d. Response body: %s',
				$responseCode,
				$body
			) );
		}

		$body = json_decode( $body, true );
		if ( empty( $body ) ) {
			throw new ApiException( 'Empty response body.' );
		}

		return $body;
	}

	/**
	 * Fetches the exchanges rates for an array of currencies.
	 *
	 * @since 1.0
	 *
	 * @param array  $currencies   Array of currency codes to get the rate sfor.
	 * @param string $baseCurrency Base currency.
	 *
	 * @return array
	 */
	abstract protected function _getRates( array $currencies, string $baseCurrency ): array;

}
