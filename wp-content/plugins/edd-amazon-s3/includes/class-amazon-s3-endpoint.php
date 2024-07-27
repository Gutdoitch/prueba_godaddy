<?php
/**
 * Amazon S3 Endpoint Builder
 *
 * @package   edd-amazon-s3
 * @copyright Copyright (c) 2021, Sandhills Development, LLC
 * @license   GPL2+
 * @since     2.3.13
 */

class EDD_Amazon_S3_Endpoint {

	/**
	 * The string to be converted to a fully qualified endpoint.
	 *
	 * @var string
	 * @since 2.3.13
	 */
	private $input;

	/**
	 * EDD_Amazon_S3_Endpoint constructor.
	 *
	 * @param string $input
	 *
	 * @since 2.3.13
	 */
	public function __construct( $input ) {
		$this->input = $input;
	}

	/**
	 * Builds a fully qualified Amazon S3 endpoint.
	 *
	 * @since 2.3.13
	 *
	 * @return string Full endpoint URL. Expected output format: `https://s3.us-west-2.amazonaws.com`
	 */
	public function get_endpoint() {
		$host = untrailingslashit( $this->input );

		if ( ! preg_match( "~^(?:f|ht)tps?://~i", $host ) ) {
			// If it doesn't start with `s3.` then add that in.
			if ( 's3.' !== substr( $host, 0, 3 ) ) {
				$host = 's3.' . $host;
			}

			$host = 'https://' . $host;
		}

		// Change http to https
		if ( 'http://' === strtolower( substr( $host, 0, 7 ) ) ) {
			$host = str_ireplace( 'http://', 'https://', $host );
		}

		// If it doesn't end with `amazonaws.com` then add that in.
		if ( ! $this->ends_with_domain( $host ) ) {
			$host = $host . '.amazonaws.com';
		}

		/**
		 * Filters the fully qualified Amazon S3 endpoint.
		 * This is the final endpoint that will be used to connect to Amazon S3.
		 *
		 * @since 2.4.0
		 * @param string $host  The endpoint URL.
		 * @param string $input The input string that was used to build the endpoint.
		 */
		return apply_filters( 'edd_amazon_s3_endpoint', $host, $this->input );
	}

	/**
	 * Determines whether or not the input string ends with `.amazonaws.com`
	 *
	 * @since 2.3.13
	 *
	 * @param string $host
	 *
	 * @return bool
	 */
	private function ends_with_domain( $host ) {
		$domain = '.amazonaws.com';

		if ( function_exists( 'str_ends_with' ) ) {
			return str_ends_with( strtolower( $host ), strtolower( $domain ) );
		}

		$domain_length = strlen( $domain );
		$host_length   = strlen( $host );

		if ( $domain_length > $host_length ) {
			return false;
		}

		return 0 === substr_compare( strtolower( $host ), strtolower( $domain ), $host_length - $domain_length, $domain_length );
	}

	/**
	 * Builds and returns a fully qualified Amazon S3 endpoint from an input string.
	 *
	 * @since 2.3.13
	 *
	 * @param string $host All of the following options are accepted:
	 *                     us-west-2
	 *                     s3-us-west-2.amazonaws.com
	 *                     https://s3.us-west-2.amazonaws.com
	 *
	 * @return string Full endpoint URL. All of the above options would be converted to:
	 *                `https://s3.us-west-2.amazonaws.com`
	 */
	public static function build( $input ) {
		$builder = new self( $input );

		return $builder->get_endpoint();
	}
}
