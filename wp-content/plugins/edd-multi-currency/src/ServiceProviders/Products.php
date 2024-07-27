<?php
/**
 * Products.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ServiceProviders;

use EDD_Multi_Currency\Admin\ProductPrices;
use EDD_Multi_Currency\Products\PriceConversion;

class Products implements ServiceProvider {

	/**
	 * @inheritDocs
	 */
	public function register() {
		eddMultiCurrency()->singleton( PriceConversion::class );
		eddMultiCurrency()->singleton( ProductPrices::class );
	}

	/**
	 * @inheritDocs
	 */
	public function boot() {
		if ( ! is_admin() || wp_doing_ajax() ) {
			add_filter( 'edd_get_download_price', [ eddMultiCurrency( PriceConversion::class ), 'maybeConvertSingle' ], 10, 2 );
			add_filter( 'edd_get_variable_prices', [ eddMultiCurrency( PriceConversion::class ), 'maybeConvertVariable' ], 10, 2 );
		}

		if ( is_admin() ) {
			add_action( 'edd_after_price_field', [ eddMultiCurrency( ProductPrices::class ), 'displaySinglePrices' ] );
			add_action( 'edd_download_price_option_row', [ eddMultiCurrency( ProductPrices::class ), 'displayVariablePrices' ], 5, 3 );
			add_action( 'edd_save_download', [ eddMultiCurrency( ProductPrices::class ), 'save' ], 10, 2 );
		}
	}
}
