<?php
/**
 * Serializer.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Traits;

trait Serializer {

	/**
	 * Converts properties to an array.
	 *
	 * To exclude properties from the array, set the `$guarded` property
	 * with an array of property names to exclude.
	 *
	 * @since 1.0
	 *
	 * @return array
	 */
	public function toArray(): array {
		$vars     = get_object_vars( $this );
		$excluded = [ 'casts', 'originalAttributes' ];

		if ( property_exists( $this, 'guarded' ) ) {
			$excluded = array_merge( $excluded, $this->guarded );
		}

		return array_diff_key( $vars, array_flip( $excluded ) );
	}

	/**
	 * Converts properties to JSON.
	 *
	 * @since 1.0
	 *
	 * @return string|false
	 */
	public function toJson() {
		return json_encode( $this->toArray() );
	}

}
