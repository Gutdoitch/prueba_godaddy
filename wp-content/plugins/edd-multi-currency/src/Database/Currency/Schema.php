<?php
/**
 * Schema.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Database\Currency;

use EDD\Database\Schema as BerlinDBSchema;

class Schema extends BerlinDBSchema {
	/**
	 * Array of database column objects
	 *
	 * @since 1.0
	 * @var array
	 */
	public $columns = [
		[
			'name'     => 'id',
			'type'     => 'bigint',
			'length'   => '20',
			'unsigned' => true,
			'extra'    => 'auto_increment',
			'primary'  => true,
			'sortable' => true
		],
		[
			'name'      => 'currency',
			'type'      => 'char',
			'length'    => 3,
			'cache_key' => true,
			'sortable'  => true,
		],
		[
			'name'     => 'is_base',
			'type'     => 'tinyint',
			'length'   => '1',
			'default'  => 0,
			'unsigned' => true
		],
		[
			'name'     => 'rate',
			'type'     => 'decimal',
			'length'   => '10,5',
			'default'  => 1,
			'unsigned' => true,
			'sortable' => true
		],
		[
			'name'     => 'markup',
			'type'     => 'decimal',
			'length'   => '10,5',
			'default'  => 0,
			'unsigned' => true
		],
		[
			'name'     => 'manual',
			'type'     => 'tinyint',
			'length'   => '1',
			'default'  => 0,
			'unsigned' => true
		],
		[
			'name'       => 'gateways',
			'type'       => 'text',
			'default'    => null,
			'allow_null' => true
		],
		[
			'name'       => 'date_created',
			'type'       => 'datetime',
			'default'    => '', // Defaults to current time in query class
			'created'    => true,
			'date_query' => true,
			'sortable'   => true
		],
		[
			'name'       => 'date_modified',
			'type'       => 'datetime',
			'default'    => '', // Defaults to current time in query class
			'modified'   => true,
			'date_query' => true,
			'sortable'   => true
		]
	];
}
