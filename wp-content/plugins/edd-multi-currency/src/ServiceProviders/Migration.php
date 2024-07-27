<?php
/**
 * Migration.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 */

namespace EDD_Multi_Currency\ServiceProviders;

use EDD_Multi_Currency\Migrations\CurrencySwitcher\OrderMigration;
use EDD_Multi_Currency\Migrations\CurrencySwitcher\SettingsMigrator;

class Migration implements ServiceProvider {

	/**
	 * @inheritDoc
	 */
	public function register() {
		eddMultiCurrency()->singleton( OrderMigration::class );

		add_action( 'edd_multi_currency_install', [ eddMultiCurrency( SettingsMigrator::class ), 'maybeMigrate' ] );
	}

	/**
	 * @inerhitDoc
	 */
	public function boot() {
		add_filter( 'edd_30_migration_payment_meta', [ eddMultiCurrency( OrderMigration::class ), 'modifyPaymentMeta' ], 10, 3 );
		add_filter( 'edd_30_migration_order_creation_data', [ eddMultiCurrency( OrderMigration::class ), 'orderArgs' ], 10, 4 );
		add_filter( 'edd_30_migration_order_item_creation_data', [ eddMultiCurrency( OrderMigration::class ), 'orderItemArgs' ], 10, 4 );
		add_filter( 'edd_30_migration_order_item_adjustment_creation_data', [ eddMultiCurrency( OrderMigration::class ), 'orderItemAdjustmentArgs' ], 10, 5 );
		add_filter( 'edd_30_migration_order_adjustment_creation_data', [ eddMultiCurrency( OrderMigration::class ), 'orderAdjustmentArgs' ], 10, 4 );
		add_filter( 'edd_30_migration_order_discount_creation_data', [ eddMultiCurrency( OrderMigration::class ), 'orderDiscountArgs' ], 10, 6 );

		add_action( 'edd_30_migrate_order', [ eddMultiCurrency( OrderMigration::class ), 'addMigrationMeta' ], 10, 3 );
	}
}
