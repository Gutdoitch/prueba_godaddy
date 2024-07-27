<?php
/**
 * AdminNotices.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\ServiceProviders;

use EDD_Multi_Currency\Admin\NoticeHandler;
use EDD_Multi_Currency\Admin\Notices;
use EDD_Multi_Currency\Utils\Str;

class AdminNotices implements ServiceProvider {

	/**
	 * @inheritDocs
	 */
	public function register() {
		eddMultiCurrency()->singleton( NoticeHandler::class );
	}

	/**
	 * @inheritDocs
	 */
	public function boot() {
		add_action( 'admin_notices', [ eddMultiCurrency( NoticeHandler::class ), 'displayNotices' ] );
		add_action( 'edd_multi_currency_dismiss_notice', [ eddMultiCurrency( NoticeHandler::class ), 'dismiss' ] );

		add_action( 'edd_multi_currency_change_base', function () {
			try {
				$notice = eddMultiCurrency( NoticeHandler::class )
					->getNotice( Str::getBaseClassName( Notices\CurrencyChangeDetected::class ) );
			} catch ( \Exception $e ) {
				return;
			}

			try {
				$notice->maybeChangeBaseCurrency();
			} catch ( \Exception $e ) {
				wp_die( $e->getMessage(), __( 'Error', 'edd-multi-currency' ), [ 'response' => $e->getCode(), 'back_link' => true ] );
			}

			wp_safe_redirect( edd_get_admin_url( [
				'page'    => 'edd-settings',
				'tab'     => 'general',
				'section' => 'currency'
			] ) );
		} );
	}
}
