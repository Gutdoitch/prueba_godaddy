<?php
/**
 * Table.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Database\Currency;

use EDD\Database\Table as BerlinDBTable;

class Table extends BerlinDBTable {

	/**
	 * Table name
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $name = 'mc_currencies';

	/**
	 * Current version
	 *
	 * @var int
	 * @since 1.0
	 */
	protected $version = 202005221;

	/**
	 * Database upgrades to perform.
	 *
	 * @var array
	 * @since 1.0
	 */
	protected $upgrades = [];

	/**
	 * Sets the database schema.
	 *
	 * @since 1.0
	 */
	protected function set_schema() {
		$this->schema = "id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		currency char(3) NOT NULL,
		is_base tinyint(1) unsigned NOT NULL DEFAULT 0,
		rate decimal(10,5) unsigned NOT NULL DEFAULT 1.00000,
		markup decimal(10,5) unsigned NOT NULL DEFAULT 0.00000,
		manual tinyint(1) unsigned NOT NULL DEFAULT 0,
		gateways text DEFAULT NULL,
		date_created datetime NOT NULL default CURRENT_TIMESTAMP,
		date_modified datetime NOT NULL default CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		UNIQUE KEY (currency)";
	}
}
