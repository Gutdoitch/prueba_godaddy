<?php
/**
 * Notice.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 */

namespace EDD_Multi_Currency\Admin\Notices;

use EDD_Multi_Currency\Utils\Str;

/**
 * Class Notice
 *
 * @property string $id
 *
 * @package EDD_Multi_Currency\Admin\Notices
 */
abstract class Notice {

	const TYPE = 'info';

	const CAPABILITY = '';

	public function __get( $property ) {
		if ( 'id' === $property ) {
			return Str::getBaseClassName( static::class );
		}
	}

	/**
	 * Content of the notice.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	abstract protected function content();

	/**
	 * Whether or not the notice should display.
	 *
	 * @since 1.0
	 *
	 * @return bool
	 */
	private function shouldDisplay(): bool {
		return $this->currentUserCanView() && $this->_shouldDisplay();
	}

	/**
	 * Determines whether or not the current user can view the notice.
	 *
	 * @since 1.0
	 *
	 * @return bool
	 */
	public function currentUserCanView(): bool {
		return empty( static::CAPABILITY ) || current_user_can( static::CAPABILITY );
	}

	/**
	 * Sub classes can extend this to customize the display logic.
	 *
	 * @since 1.0
	 *
	 * @return bool
	 */
	protected function _shouldDisplay(): bool {
		return true;
	}

	/**
	 * Displays the notice.
	 *
	 * @since 1.0
	 */
	public function display() {
		if ( $this->shouldDisplay() ) {
			?>
			<div class="notice notice-<?php echo esc_attr( static::TYPE ); ?>">
				<?php $this->content(); ?>
			</div>
			<?php
		}
	}

	/**
	 * Generates a dismiss URL.
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	protected function dismissUrl(): string {
		return wp_nonce_url(
			add_query_arg( array(
				'edd_action' => 'multi_currency_dismiss_notice',
				'notice'     => $this->id
			) ),
			'edd_multi_currency_dismiss_' . $this->id
		);
	}

	/**
	 * Dismisses the notice.
	 *
	 * @since 1.0
	 */
	public function dismiss() {
		update_option( sanitize_key( 'edd_multi_currency_dismissed_' . $this->id ), time() );
	}

}
