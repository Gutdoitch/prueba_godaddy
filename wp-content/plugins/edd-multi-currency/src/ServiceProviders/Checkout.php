<?php
/**
 * Checkout.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ServiceProviders;

use EDD_Multi_Currency\Checkout\CurrencyHandler;
use EDD_Multi_Currency\Checkout\DiscountHandler;
use EDD_Multi_Currency\Checkout\FeeHandler;
use EDD_Multi_Currency\Checkout\GatewayHandler;
use EDD_Multi_Currency\Checkout\RateSetter;

class Checkout implements ServiceProvider {

	/**
	 * @inheritDocs
	 */
	public function register() {
		eddMultiCurrency()->singleton( CurrencyHandler::class );
		eddMultiCurrency()->bind( GatewayHandler::class );
		eddMultiCurrency()->bind( FeeHandler::class );
		eddMultiCurrency()->bind( DiscountHandler::class );
		eddMultiCurrency()->singleton( RateSetter::class );
	}

	/**
	 * @inheritDocs
	 */
	public function boot() {
		if ( ! is_admin() || wp_doing_ajax() ) {
			add_filter( 'edd_currency', [ eddMultiCurrency( CurrencyHandler::class ), 'maybeChangeCurrency' ], 5 );
			add_filter( 'edd_enabled_payment_gateways', [ eddMultiCurrency( GatewayHandler::class ), 'setGatewaysFromCurrency' ], 20 );
			add_filter( 'edd_fees_get_fees', [ eddMultiCurrency( FeeHandler::class ), 'convertFees' ], 10, 1 );
			add_filter( 'edd_get_discount_amount', [ eddMultiCurrency( DiscountHandler::class ), 'convertDiscountAmount' ], 10, 2 );
		}

		add_filter( 'edd_filter_order_item', [ eddMultiCurrency( RateSetter::class ), 'orderRate' ], 10, 2 );
		add_filter( 'edd_filter_order_item_item', [ eddMultiCurrency( RateSetter::class ), 'orderItemRate' ], 10, 2 );
		add_filter( 'edd_filter_order_adjustment_item', [ eddMultiCurrency( RateSetter::class ), 'orderAdjustmentRate' ], 10, 2 );
		add_filter( 'edd_filter_order_transaction_item', [ eddMultiCurrency( RateSetter::class ), 'orderTransactionRate' ], 10, 2 );
	}
}
