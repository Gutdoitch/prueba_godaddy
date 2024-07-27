<?php
/**
 * Database.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ServiceProviders;

use EDD_Multi_Currency\Database\ComponentRegistry;
use EDD_Multi_Currency\ServiceProviders\ServiceProvider as ServiceProviderInterface;

class Database implements ServiceProviderInterface {

	/**
	 * @inheritDocs
	 */
	public function register() {
		eddMultiCurrency()->singleton( ComponentRegistry::class, function () {
			/*
			 * Manually returning an instance here, as otherwise the Container will try
			 * to resolve dependencies for ArrayObject, and will fail due to this error:
			 *
			 * `ReflectionException: Cannot determine default value for internal functions`
			 * @link https://www.php.net/manual/en/reflectionparameter.getdefaultvalue.php
			 *
			 * This is fixed in PHP 8 but won't work in lower versions.
			 */
			return new ComponentRegistry();
		} );
	}

	/**
	 * @inheritDocs
	 */
	public function boot() {
		add_action( 'edd_setup_components', [ eddMultiCurrency( ComponentRegistry::class ), 'register' ] );
	}
}
