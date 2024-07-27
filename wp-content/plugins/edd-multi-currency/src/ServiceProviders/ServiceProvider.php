<?php
/**
 * ServiceProvider.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ServiceProviders;

interface ServiceProvider {

	/**
	 * Registers the service provider within the application.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	public function register();

	/**
	 * Bootstraps the service after all of the services have been registered.
	 * All dependencies will be available at this point.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	public function boot();

}
