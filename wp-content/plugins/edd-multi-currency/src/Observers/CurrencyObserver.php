<?php
/**
 * CurrencyObserver.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Observers;

use EDD_Multi_Currency\Admin\NoticeHandler;
use EDD_Multi_Currency\Admin\Notices\CurrencyChangeDetected;
use EDD_Multi_Currency\Models\Currency;
use EDD_Multi_Currency\Models\Exceptions\ModelNotFound;

class CurrencyObserver {

	const FLAG_OPTION = 'edd_multi_currency_base_change_detected';

	/**
	 * @var string
	 */
	private $oldCurrencyCode;

	/**
	 * @var string
	 */
	private $newCurrencyCode;

	/**
	 * CurrencyObserver constructor.
	 */
	public function __construct( NoticeHandler $registry ) {
		$this->oldCurrencyCode = strtoupper( edd_get_option( 'currency', 'USD' ) );

		// Registers an admin notice if the currency has changed.
		if ( self::currencyHasChanged() ) {
			try {
				$registry->addNotice( CurrencyChangeDetected::class );
			} catch ( \Exception $e ) {

			}
		}
	}

	/**
	 * Listens for changes to the base shop currency.
	 *
	 * @since 1.0
	 *
	 * @param mixed  $newValue
	 * @param string $key
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function observeBaseCurrencyChanges( $newValue, string $key ) {
		if ( ! $this->hasCurrencyChanged( $newValue, $key ) ) {
			return $newValue;
		}

		$this->newCurrencyCode = strtoupper( (string) $newValue );

		// The currency has changed!
		edd_debug_log( sprintf(
			'Multi Currency - Base currency change detected. Old: %s; New: %s',
			$this->oldCurrencyCode,
			$this->newCurrencyCode
		), true );

		if ( $this->isCurrencyChangeProblematic() ) {
			edd_debug_log( 'Multi Currency - Adding notice about problematic change.', true );
			$this->addNoticeFlag();

			// Prevent the change.
			$newValue = $this->oldCurrencyCode;
		} else {
			edd_debug_log( 'Multi Currency - Change is acceptable, as there have been no new orders.', true );
		}

		return $newValue;
	}

	/**
	 * Determines whether or not the shop currency has just changed.
	 *
	 * @since 1.0
	 *
	 * @param mixed  $newValue New value EDD is setting.
	 * @param string $key      Setting ID.
	 *
	 * @return bool
	 */
	private function hasCurrencyChanged( $newValue, string $key ): bool {
		if ( 'currency' !== $key ) {
			return false;
		}

		return strtoupper( $newValue ) !== $this->oldCurrencyCode;
	}

	/**
	 * Updates the database to reflect the new base currency.
	 *
	 * @since 1.0
	 *
	 * @throws \Exception
	 */
	private function updateCurrenciesDatabase() {
		global $wpdb;

		// Set all bases to 0.
		$wpdb->query( "UPDATE {$wpdb->edd_mc_currencies} SET is_base = 0" );

		try {
			$oldCurrency = Currency::getBy( 'currency', $this->oldCurrencyCode );
			Currency::update( $oldCurrency->id, [ 'is_base' => 0 ] );
		} catch ( ModelNotFound $e ) {
			// This is fine.
		} catch ( \Exception $e ) {
			edd_debug_log( sprintf(
				'Multi Currency - Error while updating old base currency: %s',
				$e->getMessage()
			) );
		}

		try {
			$newCurrency = Currency::getBy( 'currency', $this->newCurrencyCode );
			Currency::update( $newCurrency->id, [
				'is_base' => 1,
				'rate'    => 1
			] );
		} catch ( ModelNotFound $e ) {
			// It didn't exist already, so let's add a new one.
			Currency::create( [
				'currency' => $this->newCurrencyCode,
				'is_base'  => 1,
				'rate'     => 1
			] );
		} catch ( \Exception $e ) {
			edd_debug_log( sprintf(
				'Multi Currency - Error while updating or creating new currency: %s',
				$e->getMessage()
			) );
		}
	}

	/**
	 * Determines whether or not we should be concerned about a base
	 * currency change. It's only an issue if we already have orders.
	 *
	 * @since 1.0
	 *
	 * @return bool
	 */
	private function isCurrencyChangeProblematic(): bool {
		return edd_count_orders() > 0;
	}

	/**
	 * Adds a flag designating that we should show an admin notice to the user.
	 *
	 * @since 1.0
	 */
	private function addNoticeFlag() {
		update_option( self::FLAG_OPTION, json_encode( [
			'timestamp'   => time(),
			'oldCurrency' => sanitize_text_field( $this->oldCurrencyCode ),
			'newCurrency' => sanitize_text_field( $this->newCurrencyCode )
		] ) );
	}

	/**
	 * Determines whether or not the currency has changed.
	 *
	 * @since 1.0
	 *
	 * @return bool
	 */
	public static function currencyHasChanged(): bool {
		return (bool) get_option( self::FLAG_OPTION );
	}

	/**
	 * Retrieves the flag information from the database.
	 *
	 * @since 1.0
	 *
	 * @return array
	 */
	public static function getFlagData(): array {
		$flag = get_option( self::FLAG_OPTION );

		return ! empty( $flag ) ? json_decode( $flag, true ) : [];
	}

	/**
	 * Removes the flag.
	 *
	 * @since 1.0
	 */
	public static function removeFlag() {
		delete_option( self::FLAG_OPTION );
	}

	/**
	 * Changes the base currency.
	 *
	 * @since 1.0
	 *
	 * @throws \Exception
	 */
	public function changeBaseCurrency() {
		$data = CurrencyObserver::getFlagData();
		if ( empty( $data['newCurrency'] ) ) {
			throw new \Exception( __( 'Unable to determine new currency.', 'edd-multi-currency' ), 400 );
		}

		edd_update_option( 'currency', sanitize_text_field( $data['newCurrency'] ) );

		CurrencyObserver::removeFlag();

		$this->oldCurrencyCode = $data['oldCurrency'];
		$this->newCurrencyCode = $data['newCurrency'];

		$this->updateCurrenciesDatabase();
	}

}
