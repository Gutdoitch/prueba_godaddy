<?php
/**
 * OrderMigration.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Migrations\CurrencySwitcher;

use EDD\Admin\Upgrades\v3\Data_Migrator;

class OrderMigration {

	/**
	 * Determines the exchange rate for the payment.
	 *
	 * If this is `1`, then that means multi currency isn't enabled for the order.
	 *
	 * @param array $paymentMeta
	 *
	 * @return float|int
	 */
	private function getExchangeRate( $paymentMeta ) {
		if ( empty( $paymentMeta['currency'] ) || edd_get_option( 'currency', 'USD' ) === strtoupper( $paymentMeta['currency'] ) ) {
			return 1;
		}

		if ( empty( $paymentMeta['_edd_payment_exchange_rate'] ) || empty( (float) $paymentMeta['_edd_payment_exchange_rate'] ) ) {
			return 1;
		}

		return 1 / (float) $paymentMeta['_edd_payment_exchange_rate'];
	}

	/**
	 * Modifies the array of payment meta.
	 *
	 * In Currency Switcher, the totals that EDD is aware of are the amounts converted
	 * to store currency. The original order values in the "custom" currency are stored
	 * in custom payment meta fields. Our goal is to swap those values, so that the amounts
	 * EDD is aware of are actually the "custom" values in the customer's chosen currency.
	 *
	 * @since 1.0
	 *
	 * @param array $paymentMeta Payment meta.
	 * @param int   $paymentId   ID of the payment record.
	 * @param array $meta        All post meta for this payment.
	 *
	 * @return array
	 */
	public function modifyPaymentMeta( $paymentMeta, $paymentId, $meta ) {
		$exchangeRate = $this->getExchangeRate( $paymentMeta );

		// If this isn't in a custom currency, don't make any changes.
		if ( 1 === $exchangeRate ) {
			return $paymentMeta;
		}

		$paymentMeta['cart_details'] = $this->newCartDetails( $paymentMeta['cart_details'] );

		return $paymentMeta;
	}

	/**
	 * Adds a new piece of order meta to designate that this has been converted
	 * from Currency Switcher to Multi Currency.
	 *
	 * @since 1.0
	 *
	 * @param int   $orderId     ID of the newly migrated order.
	 * @param array $paymentMeta Old payment meta.
	 * @param array $meta        All post meta.
	 */
	public function addMigrationMeta( $orderId, $paymentMeta, $meta ) {
		if ( 1 !== $this->getExchangeRate( $paymentMeta ) ) {
			edd_add_order_meta( $orderId, '_multi_currency_converted', time() );
		}
	}

	/**
	 * Rebuilds the `cart_details` array with the correct multi currency values.
	 * The original array used values converted to store currency and we want to swap
	 * them back to the order currency.
	 *
	 * @since 1.0
	 *
	 * @param array $cartDetails
	 *
	 * @return array
	 */
	private function newCartDetails( $cartDetails ) {
		$cartDetails = Data_Migrator::fix_possible_serialization( $cartDetails );

		if ( ! empty( $cartDetails ) && is_array( $cartDetails ) ) {
			foreach ( $cartDetails as $key => $cartItem ) {
				$cartDetails[ $key ] = array_merge( $cartItem, $this->parseOrderItemArgs( $cartItem ) );
			}
		}

		return $cartDetails;
	}

	/**
	 * Parses the order amounts out of the cart item.
	 *
	 * @since 1.0
	 *
	 * @param array $cartItem
	 *
	 * @return array
	 */
	private function parseOrderItemArgs( $cartItem ) {
		$keyMap = [
			'item_price_order_currency' => 'item_price',
			'subtotal_order_currency'   => 'subtotal',
			'discount_order_currency'   => 'discount',
			'tax_order_currency'        => 'tax',
			'price_order_currency'      => 'price'
		];

		return $this->remapArgs( $keyMap, $cartItem );
	}

	/**
	 * Adds the exchange rate to the order creation arguments.
	 *
	 * @since 1.0
	 *
	 * @param array $orderArgs
	 * @param array $paymentMeta
	 * @param array $cartDetails
	 * @param array $meta
	 *
	 * @return array
	 */
	public function orderArgs( $orderArgs, $paymentMeta, $cartDetails, $meta ) {
		$orderArgs['rate'] = $this->getExchangeRate( $paymentMeta );

		/*
		 * Fix order total & tax amount.
		 *
		 * At this point the values will have been set to the base store currency.
		 * We need to change those to use the amount in the order currency. That's
		 * store in the original meta under `{x}_order_currency`.
		 */
		$keyMap = [
			'_edd_payment_total_order_currency' => 'total',
			'_edd_payment_tax_order_currency'   => 'tax',
		];

		foreach ( $keyMap as $oldKey => $newKey ) {
			if ( isset( $meta[ $oldKey ][0] ) ) {
				$orderArgs[ $newKey ] = $meta[ $oldKey ][0];
			}
		}

		return $orderArgs;
	}

	/**
	 * Adds the exchange rate to the order item creation arguments.
	 *
	 * @since 1.0
	 *
	 * @param array $orderItemArgs
	 * @param array $cartItem
	 * @param array $paymentMeta
	 * @param array $meta
	 *
	 * @return array
	 */
	public function orderItemArgs( $orderItemArgs, $cartItem, $paymentMeta, $meta ) {
		$orderItemArgs['rate'] = $this->getExchangeRate( $paymentMeta );

		return $orderItemArgs;
	}

	/**
	 * Adds the exchange rate to order item fees.
	 *
	 * @since 1.0
	 *
	 * @param array $adjustmentArgs Adjustment arguments for a fee.
	 * @param array $fee            Original fee data.
	 * @param array $cartItem       Cart item this fee is part of.
	 * @param array $paymentMeta    Payment meta.
	 * @param array $meta           All post meta.
	 */
	public function orderItemAdjustmentArgs( $adjustmentArgs, $fee, $cartItem, $paymentMeta, $meta ) {
		$adjustmentArgs['rate'] = $this->getExchangeRate( $paymentMeta );

		return $adjustmentArgs;
	}

	/**
	 * Adds the exchange rate to order fees.
	 *
	 * @since 1.0
	 *
	 * @param array $adjustmentArgs Arguments used to create the order adjustment.
	 * @param array $fee            Fee data.
	 * @param array $paymentMeta    Payment meta.
	 * @param array $meta           All post meta.
	 */
	public function orderAdjustmentArgs( $adjustmentArgs, $fee, $paymentMeta, $meta ) {
		$adjustmentArgs['rate'] = $this->getExchangeRate( $paymentMeta );

		return $adjustmentArgs;
	}

	/**
	 * Modifies the arguments used to create a discount order adjustment.
	 *
	 *    - Adds the exchange rate.
	 *    - If it's a `flat` discount, we need to convert the discount amount to
	 *      the order currency.
	 *
	 * @since 1.0
	 *
	 * @param array         $discountArgs Order adjustment arguments.
	 * @param \EDD_Discount $discount     Discount object.
	 * @param float         $subtotal     Order subtotal.
	 * @param array         $userInfo     User info array.
	 * @param array         $paymentMeta  Payment meta.
	 * @param array         $meta         All post meta.
	 */
	public function orderDiscountArgs( $discountArgs, $discount, $subtotal, $userInfo, $paymentMeta, $meta ) {
		$discountArgs['rate'] = $this->getExchangeRate( $paymentMeta );

		if ( 'flat' === $discount->amount_type ) {
			$discountArgs['subtotal'] = $subtotal - ( (float) $discount->amount * $discountArgs['rate'] );
			$discountArgs['total']    = $subtotal - ( (float) $discount->amount * $discountArgs['rate'] );
		}

		return $discountArgs;
	}

	/**
	 * Remaps values from an old array key to a new one.
	 * Note that the return value ONLY contains what's inside the key map.
	 *
	 * @since 1.0
	 *
	 * @param array $keyMap Map of old keys to new keys.
	 * @param array $item   Source item to retrieve values from.
	 *
	 * @return array
	 */
	private function remapArgs( $keyMap, $item ) {
		$newArgs = [];
		foreach ( $keyMap as $oldKey => $newKey ) {
			if ( isset( $item[ $oldKey ] ) ) {
				$newArgs[ $newKey ] = $item[ $oldKey ];
			}
		}

		return $newArgs;
	}

}
