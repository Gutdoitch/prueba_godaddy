<?php
/**
 * Str.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Utils;

class Str {

	/**
	 * Returns the base name of the class, without the namespace.
	 *
	 * @param string $className
	 *
	 * @return string
	 */
	public static function getBaseClassName( string $className ): string {
		return basename( str_replace( '\\', '/', $className ) );
	}

}
