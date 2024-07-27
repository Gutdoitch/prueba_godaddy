<?php
/**
 * OpenExchangeRates.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ExchangeRates\Providers;

use EDD_Multi_Currency\ExchangeRates\Exceptions\ApiException;
use EDD_Multi_Currency\ExchangeRates\Exceptions\AuthenticationException;

class OpenExchangeRates extends Provider {

	const API_URL = 'https://openexchangerates.org/api/';

	/**
	 * Performs an API request.
	 *
	 * @since 1.0
	 *
	 * @param string $path
	 *
	 * @return array
	 * @throws ApiException
	 * @throws AuthenticationException
	 */
	protected function makeRequest( string $path ): array {
		$apiKey = edd_get_option( 'edd_mc_open_exchange_api_key' );
		if ( empty( $apiKey ) ) {
			throw new AuthenticationException( 'Missing API key.' );
		}

		$url = add_query_arg( array(
			'app_id' => urlencode( $apiKey )
		), self::API_URL . $path );

		return $this->validateAndReturnBody( wp_remote_get( $url ) );
	}

	/**
	 * @inheritDoc
	 *
	 * @since 1.0
	 *
	 * @param array  $currencies
	 * @param string $baseCurrency
	 *
	 * @return array
	 * @throws ApiException
	 * @throws AuthenticationException
	 */
	protected function _getRates( array $currencies, string $baseCurrency ): array {
		$response = $this->makeRequest( add_query_arg( [
			'symbols'     => implode( ',', $currencies ),
			'prettyprint' => false
		], 'latest.json' ) );

		if ( ! $response['rates'] ?? false ) {
			throw new ApiException( 'No rates in response.' );
		}

		return $this->maybe_rebase_rates( $response['rates'], $baseCurrency );
	}

	/**
	 * Maybe rebases the exchange rates on a currency other than USD.
	 *
	 * @since 1.1
	 * @param array  $exchange_rates The exchange rates retrieved from the API.
	 * @param string $base_currency  The store's base currency.
	 * @return array
	 */
	private function maybe_rebase_rates( array $exchange_rates, string $base_currency ) {
		if ( 'USD' === $base_currency ) {
			return $exchange_rates;
		}
		$base_rate = array_key_exists( $base_currency, $exchange_rates ) ? $exchange_rates[ $base_currency ] : false;
		if ( empty( $base_rate ) ) {
			return $exchange_rates;
		}

		$rebased_rates = array();
		foreach ( $exchange_rates as $currency => $rate ) {
			$rebased_rates[ $currency ] = $rate / $base_rate;
		}

		return $rebased_rates;
	}
}
