<?php
/**
 * Query.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Database\Currency;

use EDD\Database\Query as BerlinDBQuery;
use EDD_Multi_Currency\Models\Currency;

class Query extends BerlinDBQuery {

	/**
	 * Name of the table.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $table_name = 'mc_currencies';

	/**
	 * Table alias.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $table_alias = 'mc_c';

	/**
	 * Class used to set up the database schema.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $table_schema = Schema::class;

	/**
	 * Name of a single item.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $item_name = 'currency';

	/**
	 * Plural name.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $item_name_plural = 'currencies';

	/**
	 * Class used for turning IDs into objects.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $item_shape = Currency::class;

	/**
	 * Cache group.
	 *
	 * @var string
	 * @since 1.0
	 */
	protected $cache_group = 'currencies';

	/**
	 * Query constructor.
	 *
	 * @param array $query               {
	 *
	 * @type int    $id                  Currency ID.
	 * @type array  $id__in              Array of IDs to include.
	 * @type array  $id__not_in          Array of IDs to exclude.
	 * @type string $currency            Currency code.
	 * @type array  $currency__in        Array of codes to include.
	 * @type array  $currency__not_in    Array of codes to exclude.
	 * @type int    $manual              Pass `1` to query for manual currencies, or `0` for automatic.
	 * @type array  $date_created_query  Date query clauses. See WP_Date_Query.
	 * @type array  $date_modified_query Date query clauses. See WP_Date_Query.
	 *                     }
	 */
	public function __construct( $query = array() ) {
		parent::__construct( $query );
	}

}
