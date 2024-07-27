<?php
/**
 * NoticeHandler.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Admin;

use EDD_Multi_Currency\Admin\Notices\Notice;
use EDD_Multi_Currency\Utils\Str;

class NoticeHandler {

	/**
	 * Registered admin notices.
	 *
	 * @var array
	 */
	private $notices = [];

	/**
	 * Adds a notice.
	 *
	 * @since 1.0
	 *
	 * @param string $notice
	 */
	public function addNotice( string $notice ) {
		$this->notices[ Str::getBaseClassName( $notice ) ] = $notice;
	}

	/**
	 * Retrieves a notice by its ID.
	 *
	 * @since 1.0
	 *
	 * @param string $noticeId
	 *
	 * @return Notice
	 * @throws \Exception
	 */
	public function getNotice( string $noticeId ): Notice {
		if ( ! isset( $this->notices[ $noticeId ] ) || ! class_exists( $this->notices[ $noticeId ] ) ) {
			throw new \Exception( 'Notice does not exist.', 404 );
		}

		$noticeClassName = $this->notices[ $noticeId ];
		$noticeObject    = new $noticeClassName;

		if ( ! is_subclass_of( $noticeObject, Notice::class ) ) {
			throw new \Exception( __( 'Invalid notice.', 'edd-multi-currency' ), 400 );
		}

		return $noticeObject;
	}

	/**
	 * Displays all notices.
	 *
	 * @since 1.0
	 */
	public function displayNotices() {
		foreach ( $this->notices as $noticeId => $noticeClass ) {
			try {
				$this->getNotice( $noticeId )->display();
			} catch ( \Exception $e ) {

			}
		}
	}

	/**
	 * Dismisses a notice.
	 *
	 * @since 1.0
	 */
	public function dismiss() {
		try {
			$noticeId = $_GET['notice'] ?? '';
			if ( empty( $noticeId ) || ! isset( $this->notices[ $noticeId ] ) || ! class_exists( $this->notices[ $noticeId ] ) ) {
				return;
			}

			if ( ! wp_verify_nonce( $_GET['_wpnonce'] ?? '', 'edd_multi_currency_dismiss_' . $noticeId ) ) {
				throw new \Exception( __( 'You do not have permission to perform this action.', 'edd-multi-currency' ), 403 );
			}

			$notice = $this->getNotice( $noticeId );
			if ( ! $notice->currentUserCanView() ) {
				throw new \Exception( __( 'You do not have permission to perform this action.', 'edd-multi-currency' ), 403 );
			}

			$notice->dismiss();

			wp_safe_redirect( remove_query_arg( [
				'edd_action',
				'notice',
				'_wpnonce'
			] ) );
			exit;
		} catch ( \Exception $e ) {
			wp_die(
				$e->getMessage(),
				__( 'Error', 'edd-multi-currency' ),
				[
					'response'  => $e->getCode() > 0 ? $e->getCode() : 403,
					'back_link' => true
				]
			);
		}
	}

}
