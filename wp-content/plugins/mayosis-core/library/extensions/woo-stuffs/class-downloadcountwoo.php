<?php
/**
 *  Download Count for WooCommerce
 *
 * @package    Download Count for WooCommerce
 * @subpackage DownloadCountWoo Main Functions
/*  Copyright (c) 2020- Katsushi Kawamori (email : dodesyoswift312@gmail.com)
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; version 2 of the License.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

$downloadcountwoo = new DownloadCountWoo();

/** ==================================================
 * Class Main function
 *
 * @since 1.00
 */
class DownloadCountWoo {

	/** ==================================================
	 * Construct
	 *
	 * @since 1.00
	 */
	public function __construct() {

		/* Admin panel for order */
		add_filter( 'manage_edit-shop_order_columns', array( $this, 'order_column' ) );
		add_action( 'manage_shop_order_posts_custom_column', array( $this, 'order_column_value' ), 10, 2 );

		/* Admin panel for product */
		add_filter( 'manage_edit-product_columns', array( $this, 'product_column' ) );
		add_action( 'manage_product_posts_custom_column', array( $this, 'product_column_value' ), 10, 2 );
		add_filter( 'manage_edit-product_sortable_columns', array( $this, 'sortable_product_column' ), 10, 1 );
		add_filter( 'request', array( $this, 'column_orderby_downloads' ), 10, 1 );

		/* products page */
		add_filter( 'mayosis_custom_download_count_woo', array( $this, 'custom_price_message' ), 10, 2 );

		/* products sort */
		add_filter( 'woocommerce_default_catalog_orderby_options', array( $this, 'custom_woocommerce_sort' ), 10, 1 );
		add_filter( 'woocommerce_catalog_orderby', array( $this, 'custom_woocommerce_sort' ), 10, 1 );
		add_filter( 'woocommerce_get_catalog_ordering_args', array( $this, 'edit_woocommerce_sort' ), 10, 1 );
		add_action( 'woocommerce_product_query', array( $this, 'custom_pre_get_posts_query' ), 10, 1 );

		/* Original hook */
		add_action( 'dcw_search_form', array( $this, 'search_form' ) );
		add_action( 'dcw_product_select_form', array( $this, 'product_select_form' ) );

	}

	/** ==================================================
	 * Order Column
	 *
	 * @param array $cols  cols.
	 * @return array $cols
	 * @since 1.00
	 */
	public function order_column( $cols ) {

		global $pagenow;
		if ( 'edit.php' == $pagenow ) {
			$cols['order_column_dc_woo'] = __( 'Products', 'woocommerce' ) . ' : ' . __( 'Downloads', 'woocommerce' );
		}

		return $cols;

	}

	/** ==================================================
	 * Order Column Value
	 *
	 * @param string $column_name  column_name.
	 * @param int    $id  id.
	 * @since 1.00
	 */
	public function order_column_value( $column_name, $id ) {

		if ( 'order_column_dc_woo' == $column_name ) {

			global $wpdb, $the_order;

			$downloadables = $the_order->get_downloadable_items();
			foreach ( $downloadables as $downloadable ) {

				$product_id = $downloadable['product_id'];
				$product_name = $downloadable['product_name'];
				$order_id = $downloadable['order_id'];

				$count = $wpdb->get_var(
					$wpdb->prepare(
						"
							SELECT SUM( download_count ) AS count
							FROM {$wpdb->prefix}woocommerce_downloadable_product_permissions
							WHERE product_id = %d
							AND order_id = %s
						",
						$product_id,
						$order_id
					)
				);

				?>
				<div>
				<?php echo esc_html( $product_name ); ?> : 
				<?php echo esc_html( number_format( $count ) ); ?>
				</div>
				<?php

			}
		}

	}

	/** ==================================================
	 * Product Column
	 *
	 * @param array $cols  cols.
	 * @return array $cols
	 * @since 1.00
	 */
	public function product_column( $cols ) {

		global $pagenow;
		if ( 'edit.php' == $pagenow ) {
			$new_cols = array();
			foreach ( $cols as $key => $value ) {
				$new_cols[ $key ] = $value;
				if ( 'price' == $key ) {
					$new_cols['product_column_dc_woo'] = '<span class="tips" data-tip="' . esc_attr__( 'Downloads', 'woocommerce' ) . '"><span class="dashicons dashicons-download"></span></span>';
				}
			}
			return $new_cols;
		}

		return $cols;

	}

	/** ==================================================
	 * Product Column Value
	 *
	 * @param string $column_name  column_name.
	 * @param int    $id  id.
	 * @since 1.00
	 */
	public function product_column_value( $column_name, $id ) {

		if ( 'product_column_dc_woo' == $column_name ) {

			$count = $this->downloadable_count( $id );

			if ( 0 < $count ) {
				?>
				<span>
				<?php echo esc_html( number_format( $count ) ); ?>
				</span>
				<?php
			}
		}

	}

	/** ==================================================
	 * Product Column for sortable
	 *
	 * @param array $sortable_column  sortable_column.
	 * @return array $sortable_column
	 * @since 1.00
	 */
	public function sortable_product_column( $sortable_column ) {

		global $pagenow;
		if ( 'edit.php' == $pagenow ) {
			$sortable_column['product_column_dc_woo'] = 'downloads';
		}

		return $sortable_column;

	}

	/** ==================================================
	 * Product Column Sort by downloads count
	 *
	 * @param array $vars  vars.
	 * @return array $vars
	 * @since 1.00
	 */
	public function column_orderby_downloads( $vars ) {

		if ( is_admin() ) {
			if ( isset( $vars['orderby'] ) && 'downloads' == $vars['orderby'] ) {
				$vars = array_merge(
					$vars,
					array(
						'meta_key' => 'dlcwoo_downloads',
						'orderby' => 'meta_value_num',
					)
				);
			}
		}

		return $vars;

	}

	/** ==================================================
	 * Custom price filter
	 *
	 * @param string $price  price.
	 * @param object $product  product.
	 * @return string $price & text
	 * @since 1.00
	 */
	public function custom_price_message( $price=null, $product=null ) {

		if ( ! is_admin() ) {

			$product_ids = get_posts(
				array(
					'post_type' => 'product',
					'numberposts' => -1,
					'post_status' => 'publish',
					'fields' => 'ids',
					'meta_query' => array(
						array(
							'key' => '_downloadable',
							'value' => 'yes',
							'compare' => '=',
						),
					),
				)
			);

			if ( ! empty( $product_ids ) ) {
			    global $product;
				if ( $product_ids ) {
					$count = $this->downloadable_count( $product->id );
					$downloaded_html = '<br /><span class="price-description">' . number_format( $count ) . ' ' . __( 'Downloads', 'woocommerce' ) . '</span>';
					if ( get_option( 'downloadcountwoo_only_admin' ) ) {
						$downloaded_html = null;
					}
					$downloaded_html = apply_filters( 'download_count_woo', $downloaded_html, $count );
					$downloaded_html = apply_filters( 'download_count_woo_' . $product->id, $downloaded_html, $count );
					return $price . $downloaded_html;
				}
			}
		}

		return $price;

	}

	/** ==================================================
	 * Downlodable count of product
	 *
	 * @param  int $product_id  product_id.
	 * @return int $count
	 * @since 1.00
	 */
	private function downloadable_count( $product_id ) {

		global $wpdb;

		$count = $wpdb->get_var(
			$wpdb->prepare(
				"
					SELECT SUM( download_count ) AS count
					FROM {$wpdb->prefix}woocommerce_downloadable_product_permissions
					WHERE product_id = %d
				",
				$product_id
			)
		);

		if ( 0 < $count ) {
			update_post_meta( $product_id, 'dlcwoo_downloads', $count );
		}

		return $count;

	}

	/** ==================================================
	 * Custom action sort products by downloads for dropdown list
	 *
	 * @param array $sortby  sortby.
	 * @return array $sortby
	 * @since 1.00
	 */
	public function custom_woocommerce_sort( $sortby ) {

		$sortby['downloads'] = __( 'Sort by downloads (desc)', 'download-count-for-woocommerce' );

		return $sortby;

	}

	/** ==================================================
	 * Custom action sort products by downloads for orderby
	 *
	 * @param array $args  args.
	 * @return array $args
	 * @since 1.00
	 */
	public function edit_woocommerce_sort( $args ) {

		if ( isset( $_GET['orderby'] ) ) {
			$orderby_value = wc_clean( sanitize_text_field( wp_unslash( $_GET['orderby'] ) ) );
		} else {
			$orderby_value = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
		}

		if ( 'downloads' == $orderby_value ) {
			$args['orderby'] = 'downloads';
		}

		return $args;

	}

	/** ==================================================
	 * Custom action sort filter products by downloads
	 *
	 * @param object $query  query.
	 * @since 1.00
	 */
	public function custom_pre_get_posts_query( $query ) {

		if ( array_key_exists( 'orderby', $query->query_vars ) && 'downloads' == $query->query_vars['orderby'] ) {
			$query->set( 'meta_value', 'null' );
			$query->set( 'meta_compare', '!=' );
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'desc' );
			$query->set( 'meta_key', 'dlcwoo_downloads' );
		}

	}

	/** ==================================================
	 * Search form
	 *
	 * @since 1.08
	 */
	public function search_form() {

		$search_text = get_user_option( 'downloadcountwoo_search_text', get_current_user_id() );

		?>
		<div style="margin: 0px; text-align: right;">
		<form method="post">
		<?php
		wp_nonce_field( 'dcw_search_text', 'download_count_woo_search_text' );
		if ( empty( $search_text ) ) {
			?>
			<input name="search_text" type="text" value="" placeholder="<?php echo esc_attr__( 'Search' ); ?>">
			<?php
		} else {
			?>
			<input name="search_text" type="text" value="" placeholder="<?php echo esc_attr( $search_text ); ?>">
			<?php
		}
		submit_button( __( 'Search' ), 'large', 'download-count-woo-searchtext', false );
		?>
		</form>
		</div>
		<?php

	}

	/** ==================================================
	 * Product select form
	 *
	 * @since 1.08
	 */
	public function product_select_form() {

		$search_text = get_user_option( 'downloadcountwoo_search_text', get_current_user_id() );

		global $wpdb;

		$all_products = $wpdb->get_col(
			"
			SELECT post_title
			FROM {$wpdb->prefix}posts
			WHERE post_type = 'product'
			"
		);

		?>
		<form method="post">
		<?php wp_nonce_field( 'dcw_product_text', 'download_count_woo_product_text' ); ?>
		<div>
		<select name="product">
		<?php
		$select = false;
		foreach ( $all_products as $product ) {
			if ( $product === $search_text ) {
				$select = true;
				?>
				<option value="<?php echo esc_attr( $product ); ?>" selected><?php echo esc_html( $product ); ?></option>
				<?php
			} else {
				?>
				<option value="<?php echo esc_attr( $product ); ?>"><?php echo esc_html( $product ); ?></option>
				<?php
			}
		}
		if ( $select ) {
			?>
			<option value=""><?php esc_html_e( 'All products', 'woocommerce' ); ?></option>
			<?php
		} else {
			?>
			<option value="" selected><?php esc_html_e( 'All products', 'woocommerce' ); ?></option>
			<?php
		}
		?>
		</select>
		<?php submit_button( __( 'Search' ), 'large', 'download-count-woo-producttext', false ); ?>
		</div>
		</form>
		<?php

	}

}


