<?php
/**
 * HasAttribute.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Traits;

trait HasAttribute {

	/**
	 * Original, unmodified attributes.
	 *
	 * @var array
	 */
	protected $originalAttributes = [];

	/**
	 * The attributes that should be cast.
	 *
	 * @var string[]
	 */
	protected $casts = [];

	/**
	 * Supported cast types.
	 *
	 * @var string[]
	 */
	protected static $supportedCastTypes = [
		'array',
		'bool',
		'int',
		'float',
		'string',
	];

	/**
	 * Casts all the model's attributes.
	 *
	 * @since 1.0
	 *
	 * @param array $attributes
	 *
	 * @return array
	 */
	protected function castAttributes( array $attributes = [] ): array {
		$this->originalAttributes = (array) $attributes;

		$newAttributes = $this->originalAttributes;

		foreach ( $this->casts as $propertyName => $castType ) {
			$newAttributes[ $propertyName ] = $this->castAttribute( $propertyName, $castType );
		}

		return $newAttributes;
	}

	/**
	 * Casts an attribute to its designated format.
	 *
	 * @since 1.0
	 *
	 * @param string $propertyName
	 * @param string $castType
	 *
	 * @return bool|float|int|mixed|string
	 */
	protected function castAttribute( string $propertyName, string $castType ) {
		// Let null be null.
		if ( is_null( $this->originalAttributes[ $propertyName ] ?? null ) ) {
			return null;
		}

		if ( ! array_key_exists( $propertyName, $this->casts ) || ! in_array( $this->casts[ $propertyName ], self::$supportedCastTypes ) ) {
			return $this->originalAttributes[ $propertyName ];
		}

		switch ( $castType ) {
			case 'array' :
				return json_decode( $this->originalAttributes[ $propertyName ], true );
			case 'bool' :
				return (bool) $this->originalAttributes[ $propertyName ];
			case 'float' :
				return (float) $this->originalAttributes[ $propertyName ];
			case 'int' :
				return (int) $this->originalAttributes[ $propertyName ];
			case 'string' :
				return (string) $this->originalAttributes[ $propertyName ];
		}

		return $this->originalAttributes[ $propertyName ];
	}

}
