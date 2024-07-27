<?php
/**
 * ComponentRegistry.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Database;

use EDD\Utils\Registry;
use EDD_Multi_Currency\Database\Currency\Schema as CurrencySchema;
use EDD_Multi_Currency\Database\Currency\Table as CurrencyTable;
use EDD_Multi_Currency\Database\Currency\Query as CurrencyQuery;
use EDD_Multi_Currency\Models\Currency;

class ComponentRegistry extends Registry {

	/**
	 * Registers components.
	 *
	 * @since 1.0
	 * @throws \EDD_Exception
	 */
	public function register() {
		$this->add_item( 'currency', [
			'schema' => new CurrencySchema(),
			'table'  => new CurrencyTable(),
			'query'  => new CurrencyQuery(),
			'object' => Currency::class
		] );
	}

}
