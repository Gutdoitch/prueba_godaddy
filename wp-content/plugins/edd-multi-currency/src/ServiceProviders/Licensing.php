<?php
/**
 * Licensing.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 */

namespace EDD_Multi_Currency\ServiceProviders;

use EDD\Extensions\ExtensionRegistry;
use EDD_Multi_Currency\Plugin;

class Licensing implements ServiceProvider {

	/**
	 * @inheritDoc
	 */
	public function register() {

	}

	/**
	 * @inheritDoc
	 */
	public function boot() {
		add_action( 'edd_extension_license_init', function ( ExtensionRegistry $registry ) {
			$registry->addExtension( EDD_MULTI_CURRENCY_FILE, 'Multi Currency', 1742525, Plugin::VERSION );
		} );
	}
}
