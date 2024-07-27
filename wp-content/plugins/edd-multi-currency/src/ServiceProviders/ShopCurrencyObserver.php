<?php
/**
 * ShopCurrencyObserver.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ServiceProviders;

use EDD_Multi_Currency\Observers\CurrencyObserver;

class ShopCurrencyObserver implements ServiceProvider {

	/**
	 * @inheritDocs
	 */
	public function register() {

	}

	/**
	 * @inheritDocs
	 */
	public function boot() {
		add_filter( 'edd_settings_sanitize', [ eddMultiCurrency( CurrencyObserver::class ), 'observeBaseCurrencyChanges' ], 10, 2 );
	}
}
