<?php
/**
 * Widgets.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ServiceProviders;

use EDD_Multi_Currency\Widgets\CurrencySelector;

class Widgets implements ServiceProvider {

	/**
	 * Registered widgets.
	 *
	 * @var string[]
	 */
	private $widgets = [
		CurrencySelector::class
	];

	/**
	 * @inheritDoc
	 */
	public function register() {

	}

	/**
	 * @inheritDoc
	 */
	public function boot() {
		add_action( 'widgets_init', function () {
			foreach ( $this->widgets as $widget ) {
				register_widget( $widget );
			}
		} );
	}
}
