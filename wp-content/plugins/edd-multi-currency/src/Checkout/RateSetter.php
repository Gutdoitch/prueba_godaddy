<?php
/**
 * RateSetter.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Checkout;

use EDD\Database\Query;
use EDD\Orders\Order;
use EDD\Orders\Order_Item;
use EDD_Multi_Currency\Models\Currency;

class RateSetter {

	/**
	 * Sets the rate on an order if the currency is not the base shop currency.
	 *
	 * @since 1.0
	 *
	 * @param array $args
	 * @param Query $query
	 *
	 * @return array
	 */
	public function orderRate( array $args, Query $query ): array {
		if ( empty( $args['currency'] ) ) {
			return $args;
		}

		// If the rate isn't `1` (the default), don't mess with it.
		if ( isset( $args['rate'] ) && $args['rate'] != 1 ) {
			return $args;
		}

		// If this is the base shop currency, we don't need to set a rate.
		if ( \EDD_Multi_Currency\Utils\Currency::getBaseCurrency() === $args['currency'] ) {
			return $args;
		}

		edd_debug_log( sprintf( 'Multi Currency - Setting rate for order ID %s.', $args['id'] ?? 'unknown' ) );

		try {
			$currency     = Currency::getBy( 'currency', $args['currency'] );
			$args['rate'] = $currency->rate;

			edd_debug_log( sprintf( 'Multi Currency - Setting order rate to: %s', $args['rate'] ) );
		} catch ( \Exception $e ) {
			edd_debug_log( sprintf( 'Multi Currency - Exception while setting rate: %s', $e->getMessage() ) );
		}

		return $args;
	}

	/**
	 * Sets the rate on an order item.
	 *
	 * @since 1.0
	 *
	 * @param array $args
	 * @param Query $query
	 *
	 * @return array
	 */
	public function orderItemRate( array $args, Query $query ): array {
		if ( empty( $args['order_id'] ) ) {
			return $args;
		}

		// If the rate isn't `1` (the default), don't mess with it.
		if ( isset( $args['rate'] ) && $args['rate'] != 1 ) {
			return $args;
		}

		edd_debug_log( sprintf( 'Multi Currency - Maybe setting rate for order item attached to order #%d.', $args['order_id'] ) );

		try {
			$args['rate'] = $this->getRateFromOrderId( (int) $args['order_id'] );

			edd_debug_log( sprintf( 'Multi Currency - Setting order item rate to: %s', $args['rate'] ) );
		} catch ( \Exception $e ) {
			edd_debug_log( sprintf( 'Multi Currency - Exception while setting rate: %s', $e->getMessage() ) );
		}

		return $args;
	}

	/**
	 * Sets the rate on order adjustments.
	 *
	 * @param array $args
	 * @param Query $query
	 *
	 * @return array
	 */
	public function orderAdjustmentRate( array $args, Query $query ): array {
		if ( empty( $args['object_id'] ) || empty( $args['object_type'] ) ) {
			return $args;
		}

		// If the rate isn't `1` (the default), don't mess with it.
		if ( isset( $args['rate'] ) && $args['rate'] != 1 ) {
			return $args;
		}

		edd_debug_log( sprintf(
			'Multi Currency - Maybe setting rate for order adjustment. Object ID: %d; Object Type: %s',
			$args['object_id'],
			$args['object_type']
		) );

		try {
			if ( 'order' === $args['object_type'] ) {
				$args['rate'] = $this->getRateFromOrderId( (int) $args['object_id'] );
			} elseif ( 'order_item' === $args['object_type'] ) {
				$orderItem = edd_get_order_item( $args['object_id'] );
				if ( ! $orderItem instanceof Order_Item ) {
					throw new \Exception( sprintf( 'Invalid order item %d', $args['object_id'] ) );
				}
				$args['rate'] = $orderItem->rate;
			}

			if ( ! isset( $args['rate'] ) ) {
				throw new \Exception( 'Rate never set. Potentially unexpected object type.' );
			}

			edd_debug_log( sprintf( 'Multi Currency - Setting order adjustment rate to: %s', $args['rate'] ) );
		} catch ( \Exception $e ) {
			edd_debug_log( sprintf( 'Multi Currency - Exception while setting rate: %s', $e->getMessage() ) );
		}

		return $args;
	}

	/**
	 * Sets the rate for order transactions.
	 *
	 * @since 1.0
	 *
	 * @param array $args
	 * @param Query $query
	 *
	 * @return array
	 */
	public function orderTransactionRate( array $args, Query $query ): array {
		if ( empty( $args['object_id'] ) || empty( $args['object_type'] ) || 'order' !== $args['object_type'] ) {
			return $args;
		}

		// If the rate isn't `1` (the default), don't mess with it.
		if ( isset( $args['rate'] ) && $args['rate'] != 1 ) {
			return $args;
		}

		edd_debug_log( sprintf(
			'Multi Currency - Maybe setting rate for order transaction. Object ID: %d; Object Type: %s',
			$args['object_id'],
			$args['object_type']
		) );

		try {
			$args['rate'] = $this->getRateFromOrderId( (int) $args['object_id'] );

			edd_debug_log( sprintf( 'Multi Currency - Setting order transaction rate to: %s', $args['rate'] ) );
		} catch ( \Exception $e ) {
			edd_debug_log( sprintf( 'Multi Currency - Exception while setting rate: %s', $e->getMessage() ) );
		}

		return $args;
	}

	/**
	 * Retrieves the rate from an order ID.
	 *
	 * @since 1.0
	 *
	 * @param int $orderId
	 *
	 * @return float
	 * @throws \Exception
	 */
	private function getRateFromOrderId( int $orderId ): float {
		$order = edd_get_order( $orderId );
		if ( ! $order instanceof Order ) {
			throw new \Exception( 'Order not found.' );
		}

		return $order->rate;
	}

}
