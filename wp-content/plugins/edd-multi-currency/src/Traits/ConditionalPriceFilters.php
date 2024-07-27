<?php
/**
 * ConditionalPriceFilters.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Traits;

trait ConditionalPriceFilters {

	/**
	 * Determines if the price/amount should be filtered.
	 *
	 * We run the filter during ajax actions, but need to make sure we don't trigger it during ajax actions
	 * that happen while manually creating an order via the admin area.
	 *
	 * @link https://github.com/awesomemotive/edd-multi-currency/issues/30
	 *
	 * @return bool
	 */
	protected function shouldFilterPrice(): bool {
		return 'edd-admin-order-get-item-amounts' !== ( $_REQUEST['action'] ?? null );
	}

}
