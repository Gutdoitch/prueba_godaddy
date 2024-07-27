<?php
/**
 * HasDatabase.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Traits;

use EDD\Database\Query;
use EDD_Multi_Currency\Database\ComponentRegistry;
use EDD_Multi_Currency\Models\Exceptions\ModelNotFound;
use EDD_Multi_Currency\Models\Model;
use EDD_Multi_Currency\Utils\Str;

trait HasDatabase {

	/**
	 * Returns the query interface.
	 *
	 * @since 1.0
	 *
	 * @return Query
	 * @throws \Exception
	 */
	protected static function getQueryInterface(): Query {
		$className = strtolower( Str::getBaseClassName( self::class ) );
		$component = eddMultiCurrency( ComponentRegistry::class )->get_item( $className );

		if ( ! isset( $component['query'] ) || ! $component['query'] instanceof Query ) {
			throw new \Exception( sprintf( 'Unable to locate query class for component "%s".', $className ) );
		}

		return $component['query'];
	}

	/**
	 * Creates a new item.
	 *
	 * @since 1.0
	 *
	 * @param array $args
	 *
	 * @return int ID of the new model.
	 * @throws \Exception
	 */
	public static function create( array $args ): int {
		$id = self::getQueryInterface()->add_item( $args );

		if ( $id ) {
			return $id;
		}

		throw new \Exception( 'Failed to create model.' );
	}

	/**
	 * Updates an item by its ID.
	 *
	 * @since 1.0
	 *
	 * @param int   $id
	 * @param array $args
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public static function update( int $id, array $args ): bool {
		return (bool) self::getQueryInterface()->update_item( $id, $args );
	}

	/**
	 * Deletes an item by its ID.
	 *
	 * @since 1.0
	 *
	 * @param int $id
	 *
	 * @return true
	 * @throws \Exception
	 */
	public static function delete( int $id ): bool {
		if ( self::getQueryInterface()->delete_item( $id ) ) {
			return true;
		}

		throw new \Exception( 'Failed to delete item.' );
	}

	/**
	 *
	 * Returns an item by its ID.
	 *
	 * @since 1.0
	 *
	 * @param int $id
	 *
	 * @return Model|object
	 * @throws ModelNotFound
	 * @throws \Exception
	 */
	public static function get( int $id ): Model {
		$item = self::getQueryInterface()->get_item( $id );

		if ( ! $item ) {
			throw new ModelNotFound( 'Item not found.' );
		}

		return $item;
	}

	/**
	 * Returns an item by a given column.
	 *
	 * @since 1.0
	 *
	 * @param string $column
	 * @param mixed  $value
	 *
	 * @return Model|object
	 * @throws ModelNotFound
	 */
	public static function getBy( string $column, $value ): Model {
		$item = self::getQueryInterface()->get_item_by( $column, $value );

		if ( ! $item ) {
			throw new ModelNotFound( 'Item not found.' );
		}

		return $item;
	}

	/**
	 * Queries for models.
	 *
	 * @since 1.0
	 *
	 * @param array $args Query args.
	 *
	 * @return Model[]|array
	 * @throws \Exception
	 */
	public static function query( array $args = [] ): array {
		return self::getQueryInterface()->query( $args );
	}

	/**
	 * Queries for all models.
	 *
	 * @since 1.0
	 *
	 * @return Model[]|array
	 * @throws \Exception
	 */
	public static function all( array $args = [] ): array {
		return self::query(
			wp_parse_args(
				$args,
				[
					'number'  => 9999,
					'order'   => 'ASC',
					'orderby' => 'id',
				]
			)
		);
	}

	/**
	 * Counts the number of models.
	 *
	 * @since 1.0
	 *
	 * @param array $args
	 *
	 * @return int
	 * @throws \Exception
	 */
	public static function count( array $args = [] ): int {
		$args  = wp_parse_args( $args, [ 'count' => true ] );
		$query = self::getQueryInterface();
		$query->query( $args );

		return absint( $query->found_items );
	}

}
