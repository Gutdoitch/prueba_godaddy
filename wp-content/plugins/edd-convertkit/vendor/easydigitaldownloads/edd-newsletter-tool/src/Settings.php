<?php
/**
 * The Settings interface for the Newsletter tool.
 *
 * @package EDD_Newsletter
 * @copyright Copyright (c) 2021, Easy Digital Downloads
 * @license   https://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

namespace EDD\Newsletter;

interface Settings {

	/**
	 * Registers the plugin settings.
	 *
	 * @since 1.0
	 * @param array $settings
	 * @return array
	 */
	public function settings( $settings );

	/**
	 * Registers the plugin subsection.
	 *
	 * @since 1.0
	 * @param array $sections
	 * @return array
	 */
	public function subsection( $sections );
}
