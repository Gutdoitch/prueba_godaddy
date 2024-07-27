<?php
/**
 * TemplateLoader.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 */

namespace EDD_Multi_Currency\ServiceProviders;

class TemplateLoader implements ServiceProvider {

	/**
	 * @inheritDoc
	 */
	public function register() {
	}

	/**
	 * @inheritDoc
	 */
	public function boot() {
		add_filter( 'edd_template_paths', function ( $paths ) {
			$paths[110] = EDD_MULTI_CURRENCY_DIRECTORY . '/templates';

			return $paths;
		} );
	}
}
