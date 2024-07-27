<?php
/**
 * RestRoute.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\API;

interface RestRoute {

	const NAMESPACE = 'edd-multi-currency';

	/**
	 * Register the route with WordPress using the `register_rest_route` function.
	 *
	 * @see   register_rest_route()
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	public function register();

}
