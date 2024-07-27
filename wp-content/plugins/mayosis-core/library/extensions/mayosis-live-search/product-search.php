<?php
// Restrict direct access 
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Plugin setup and initialization
 */
class MayosisAjaxSearch{

	private static $instance;

	/**
	 * Actions setup
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'constants' ), 2);
		add_action( 'wp_enqueue_scripts', array( $this, 'mayosis_edd_search_enqueue' ), 5);
		add_shortcode( 'mayosis_edd_search', array( $this, 'mayosis_edd_search' ), 6);
		
		add_action('wp_ajax_nopriv_mayosis_edd_search_fetch_data',array($this, 'mayosis_edd_search_fetch_data'), 7);
		add_action('wp_ajax_mayosis_edd_search_fetch_data' , array($this,'mayosis_edd_search_fetch_data'), 8);

	}

	/**
	 * Define Plugin Constants
	 */
	function constants() {

		define( 'MAYOSIS_AJS_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		define( 'MAYOSIS_AJS_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	}


	/**
     * load js and css files
     */
	function mayosis_edd_search_enqueue(){

	

		wp_enqueue_script( 'mayosis-edd-ajax-search-script', MAYOSIS_AJS_URL.'js/mayosis-ajax-search.js', array('jquery'), '1.0.1');

		wp_localize_script( 'mayosis-edd-ajax-search-script', 'mayosis_edd_search_wp_ajax', array( 
			'ajaxurl' 	=> admin_url( 'admin-ajax.php'),
			'ajaxnonce' => wp_create_nonce('ajax-nonce')
		));

	}

	//search form
	function mayosis_edd_search($atts){

		$atts = shortcode_atts(
			array(
				'placeholder' 	=> 'Search...',
				'length'		=> 2,	
				'category'		=> false,	
				'tag'			=> false,	
				'not-found'		=> 'Download not Found'
			),$atts
		);
		ob_start();
		?>
		<div class="mayosis-edd-ajax-search">
			<input type="text" value="" name="mayosisajaxsearch" class="mayosisajaxsearch" autocomplete="off" placeholder="<?php echo esc_attr__($atts['placeholder']); ?>" data-length="<?php echo esc_attr__($atts['length']); ?>" search-by-tag="<?php echo esc_attr__($atts['tag']); ?>" search-by-category="<?php echo esc_attr__($atts['category']); ?>" data-not-found="<?php echo esc_attr__($atts['not-found']); ?>" />
			<div class="mayosis_edd_search_result"></div>
		</div>
		<?php 
		return ob_get_clean();
	}

	// ajax search function
	function mayosis_edd_search_fetch_data(){

		if ( ! wp_verify_nonce( $_POST['security'], 'ajax-nonce' ) ){
			die ();
		}
		if( class_exists( 'Easy_Digital_Downloads' ) ) {

			global $wpdb;

			$select = "SELECT DISTINCT id
			FROM  $wpdb->posts as p
			LEFT JOIN $wpdb->term_relationships as tr ON (p.ID = tr.object_id)
			LEFT JOIN $wpdb->term_taxonomy as tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
			LEFT JOIN $wpdb->terms as wt ON(tt.term_id = wt.term_id)
			WHERE p.post_status = 'publish' AND p.post_type = 'download' ";

			if ('true' == $_POST['tag'] && 'true' == $_POST['category']) {
				$select .= " AND (tt.taxonomy = 'download_tag' OR tt.taxonomy = 'download_category') AND ( p.post_title LIKE '%". sanitize_text_field( $_POST['mayosisajaxsearch'] ) ."%'  OR wt.name LIKE '%". sanitize_text_field( $_POST['mayosisajaxsearch'] ) ."%')";
			}else{

				if ('true' == $_POST['tag']) {
					$select .= " AND tt.taxonomy = 'download_tag' AND ( p.post_title LIKE '%". sanitize_text_field( $_POST['mayosisajaxsearch'] ) ."%'  OR wt.name LIKE '%". sanitize_text_field( $_POST['mayosisajaxsearch'] ) ."%')";
				}else if ('true' == $_POST['category']) {
					$select .= " AND tt.taxonomy = 'download_category' AND ( p.post_title LIKE '%". sanitize_text_field( $_POST['mayosisajaxsearch'] ) ."%'  OR wt.name LIKE '%". sanitize_text_field( $_POST['mayosisajaxsearch'] ) ."%')";
				}else{
					$select .= " AND ( p.post_title LIKE '%". sanitize_text_field( $_POST['mayosisajaxsearch'] ) ."%')";

				}
			}

			$select .= "ORDER BY p.post_date DESC";
			$posts = $wpdb->get_results ( $select);

			if (!$posts) {
				$response['status'] = 0;
			}

			foreach ($posts as $key => $post) {

				$data[$key]['id'] = $post->id;
				$postaut = get_post( $post->id );
				$authorid = $postaut->post_author;
				$data[$key]['title'] = get_the_title($post->id);
				$data[$key]['link'] = get_permalink($post->id);
				$data[$key]['thumb']= get_the_post_thumbnail( $post->id, 'thumbnail' );
				$data[$key]['authorname']= get_the_author_meta( 'display_name',$authorid);
		        $data[$key]['vcheck'] = edd_has_variable_prices($post->id);
		        if ($data[$key]['vcheck']){
		            $data[$key]['price']= edd_price_range($post->id);
		            
		        }else {
				     	$data[$key]['price']= edd_currency_filter(edd_get_download_price($post->id));
		        }
				
				 

			}
			$response = array(
				'status' => 1,
				'data' => $data,
			);

		}
		else{

			$response['status'] = 0;
			

		}

		wp_send_json($response);

	}

	/**
	 * Returns the instance.
	 */
	public static function get_instance() {

		if ( !self::$instance )
			self::$instance = new self;

		return self::$instance;
	}

}

function MayosisAjaxSearch_plugin_load() {

	return MayosisAjaxSearch::get_instance();

}
add_action('plugins_loaded', 'MayosisAjaxSearch_plugin_load', 1 );