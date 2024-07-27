<?php
/**
 * CurrencyHandler.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2021, Ashley Gibson
 * @license   GPL2+
 */

namespace EDD_Multi_Currency\Checkout;

use EDD_Multi_Currency\Utils\Currency;

class CurrencyHandler {

	/**
	 * Determines the currency for the session, based on the following rules (first match wins):
	 *
	 *        - Currency explicitly set in URL.
	 *        - Currency stored in session.
	 *        - User's last selected currency.
	 *        - Base EDD currency.
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	public function getSelectedCurrency(): string {
		$currency = eddMultiCurrency( Currency::class )::getBaseCurrency();
		if ( is_admin() && ! edd_doing_ajax() ) {
			return $currency;
		}

		// If we are running an action on AJAX that should always return the base currency, do so.
		$actions_for_base_currency = apply_filters(
			'edd_multi_currency_base_currency_action_list',
			array(
				'edd_load_dashboard_widget',
				'heartbeat',
			)
		);

		$current_action = isset( $_REQUEST['action'] ) ? sanitize_text_field( $_REQUEST['action'] ) : false;

		if ( edd_doing_ajax() && ( false !== $current_action && in_array( $current_action, $actions_for_base_currency ) ) ) {
			return $currency;
		}

		try {
			if ( isset( $_GET['currency'] ) ) {
				return $this->setCurrencyForSession( $_GET['currency'] );
			}

			$sessionCurrency = $this->getCurrencyFromSession();
			if ( ! empty( $sessionCurrency ) && eddMultiCurrency( Currency::class )::isValidCurrency( $sessionCurrency ) ) {
				return $sessionCurrency;
			}

			if ( is_user_logged_in() ) {
				return $this->setCurrencyForSession( $this->get_last_order_currency( $currency ) );
			}
		} catch ( \Exception $e ) {

		} catch ( \EDD_Exception $e ) {

		}

		return $currency;
	}

	/**
	 * Gets the currency for the logged in user's last order.
	 *
	 * @since 1.0
	 * @param string $currency
	 * @return string
	 */
	private function get_last_order_currency( $currency ) {
		// Return the default currency if the EDD Orders table is not available.
		global $wpdb;
		if ( empty( $wpdb->edd_orders ) ) {
			return $currency;
		}
		$last_order_currency = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT currency FROM {$wpdb->edd_orders}
				WHERE user_id = %d
				ORDER BY id DESC
				LIMIT 1",
				get_current_user_id()
			)
		);

		// If the last order was located, set its currency in the session data to prevent excess database queries.
		if ( ! empty( $last_order_currency ) && eddMultiCurrency( Currency::class )->isValidCurrency( $currency ) ) {
			return $last_order_currency;
		}

		return $currency;
	}

	/**
	 * Modifies the set currency.
	 *
	 * @since 1.0
	 *
	 * @param string $currency
	 *
	 * @return string
	 */
	public function maybeChangeCurrency( string $currency ): string {
		return $this->getSelectedCurrency();
	}

	/**
	 * Sets the currency for the current session.
	 *
	 * @since 1.0
	 *
	 * @param string $currency
	 *
	 * @return string
	 * @throws \EDD_Exception
	 * @throws \Exception
	 */
	public function setCurrencyForSession( string $currency ): string {
		$currency = eddMultiCurrency( Currency::class )::sanitizeCurrency( $currency );

		if ( ! eddMultiCurrency( Currency::class )::isValidCurrency( $currency ) ) {
			throw new \Exception( sprintf( 'Invalid currency: %s', esc_html( $currency ) ) );
		}

		return EDD()->session->set( 'currency', $currency );
	}

	/**
	 * Returns the currency value from the current session.
	 *
	 * @since 1.0
	 *
	 * @return string|false
	 */
	public function getCurrencyFromSession() {
		return EDD()->session->get( 'currency' );
	}
}
