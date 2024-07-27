<?php
/**
 * Currency.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Models;

use EDD_Multi_Currency\Traits\HasDatabase;

/**
 * @method static Currency getBy( string $column, $value )
 */
class Currency extends Model {

	use HasDatabase;

	/**
	 * @var int
	 */
	public $id;

	/**
	 * @var string
	 */
	public $currency;

	/**
	 * @var bool
	 */
	public $is_base;

	/**
	 * @var float
	 */
	public $rate = 1.00000;

	/**
	 * @var float
	 */
	public $markup = 0.00000;

	/**
	 * @var bool
	 */
	public $manual = false;

	/**
	 * @var array|null
	 */
	public $gateways = null;

	/**
	 * @var string
	 */
	public $date_created = '';

	/**
	 * @var string
	 */
	public $date_modified = '';

	/**
	 * @var string[]
	 */
	protected $casts = [
		'id'       => 'int',
		'currency' => 'string',
		'is_base'  => 'bool',
		'rate'     => 'float',
		'markup'   => 'float',
		'manual'   => 'bool',
		'gateways' => 'array',
	];

	/**
	 * Currency constructor.
	 *
	 * @param object|array $properties
	 */
	public function __construct( $properties = [] ) {
		foreach ( $this->castAttributes( (array) $properties ) as $key => $value ) {
			$this->{$key} = $value;
		}
	}

}
