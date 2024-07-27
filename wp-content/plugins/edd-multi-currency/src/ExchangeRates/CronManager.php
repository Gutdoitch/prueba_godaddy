<?php
/**
 * CronManager.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ExchangeRates;

class CronManager {

	const CRON_HOOK = 'edd_multi_currency_update_exchange_rates';

	/**
	 * If enabled, schedules a recurring event to update the exchange rates.
	 *
	 * @since 1.0
	 */
	public function maybeScheduleUpdate() {
		if ( ! self::shouldSchedule() ) {
			return;
		}

		wp_schedule_event(
			time(),
			$this->getRecurrence(),
			self::CRON_HOOK
		);
	}

	/**
	 * Determines whether or not we should schedule a cron event.
	 *
	 * @since 1.0
	 *
	 * @return bool
	 */
	private static function shouldSchedule(): bool {
		if ( ! edd_get_option( 'eddmc_auto_update_exchange_rates' ) ) {
			wp_clear_scheduled_hook( self::CRON_HOOK );

			return false;
		}

		return ! wp_next_scheduled( self::CRON_HOOK );
	}

	/**
	 * Returns how often the event should recur.
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	protected function getRecurrence(): string {
		return edd_get_option( 'eddmc_exchange_rate_update_frequency', 'daily' );
	}

}
