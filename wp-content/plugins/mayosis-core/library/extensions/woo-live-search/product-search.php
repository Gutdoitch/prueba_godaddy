<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function search_plugin_scripts_styles(){
    if (class_exists("Woocommerce")) {
        wp_register_script( 'mayosis-ajax-search', plugins_url('/js/mayosis-ajax-search.js', __FILE__ ), array('jquery'), '', true);
        wp_localize_script(
            'mayosis-ajax-search',
            'opt',
            array(
                'ajaxUrl'   => admin_url('admin-ajax.php'),
                'noResults' => esc_html__( 'No products found', 'mayosis' ),
            )
        );
    }
}
add_action( 'wp_enqueue_scripts', 'search_plugin_scripts_styles' );

/*  Get taxonomy hierarchy
/*-------------------*/

    function get_taxonomy_hierarchy( $taxonomy, $parent = 0, $exclude = 0) {
        $taxonomy = is_array( $taxonomy ) ? array_shift( $taxonomy ) : $taxonomy;
        $terms = get_terms( $taxonomy, array( 'parent' => $parent, 'hide_empty' => false, 'exclude' => $exclude) );

        $children = array();
        foreach ( $terms as $term ){
            $term->children = get_taxonomy_hierarchy( $taxonomy, $term->term_id, $exclude);
            $children[ $term->term_id ] = $term;
        }
        return $children;
    }

/*  List taxonomy hierarchy
/*-------------------*/

    function list_taxonomy_hierarchy_no_instance( $taxonomies) {
    ?>
        <?php foreach ( $taxonomies as $taxonomy ) { ?>
            <?php $children = $taxonomy->children; ?>
            <option value="<?php echo $taxonomy->term_id; ?>"><?php echo $taxonomy->name; ?></option>
            <?php if (is_array($children) && !empty($children)): ?>
                <optgroup>
                    <?php list_taxonomy_hierarchy_no_instance($children); ?>
                </optgroup>
            <?php endif ?>
        <?php } ?>

    <?php
    }

/*  Product categories transient
/*-------------------*/

    function get_product_categories_hierarchy() {

        if ( false === ( $categories = get_transient( 'product-categories-hierarchy' ) ) ) {

            $categories = get_taxonomy_hierarchy( 'product_cat', 0, 0);

            // do not set an empty transient - should help catch private or empty accounts.
            if ( ! empty( $categories ) ) {
                $categories = base64_encode( serialize( $categories ) );
                set_transient( 'product-categories-hierarchy', $categories, apply_filters( 'null_categories_cache_time', 0 ) );
            }
        }

        if ( ! empty( $categories ) ) {

            return unserialize( base64_decode( $categories ) );

        } else {

            return new WP_Error( 'no_categories', esc_html__( 'No categories.', 'mayosis' ) );

        }
    }

/*  Delete product categories transient
/*-------------------*/

    function edit_product_term($term_id, $tt_id, $taxonomy) {
        $term = get_term($term_id,$taxonomy);
        if (!is_wp_error($term) && is_object($term)) {
            $taxonomy = $term->taxonomy;
            if ($taxonomy == "product_cat") {
                delete_transient( 'product-categories-hierarchy' );
            }
        }
    }

    function delete_product_term($term_id, $tt_id, $taxonomy, $deleted_term) {
        if (!is_wp_error($deleted_term) && is_object($deleted_term)) {
            $taxonomy = $deleted_term->taxonomy;
            if ($taxonomy == "product_cat") {
                delete_transient( 'product-categories-hierarchy' );
            }
        }
    }
    add_action( 'create_term', 'edit_product_term', 99, 3 );
    add_action( 'edit_term', 'edit_product_term', 99, 3 );
    add_action( 'delete_term', 'delete_product_term', 99, 4 );

    add_action( 'save_post', 'save_post_action', 99, 3);
    function save_post_action( $post_id ){

        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if (!current_user_can( 'edit_page', $post_id ) ) return;

        $post_info = get_post($post_id);

        if (!is_wp_error($post_info) && is_object($post_info)) {
            $content   = $post_info->post_content;
            $post_type = $post_info->post_type;

            if ($post_type == "product"){
                delete_transient( 'enovathemes-product-categories' );
            }
        }

    }

/*  Search action
/*-------------------*/

    function search_product() {

        global $wpdb, $woocommerce;

        if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {

            $keyword = $_POST['keyword'];

            if (isset($_POST['category']) && !empty($_POST['category'])) {

                $category = $_POST['category'];

                $querystr = "SELECT DISTINCT * FROM $wpdb->posts AS p
                LEFT JOIN $wpdb->term_relationships AS r ON (p.ID = r.object_id)
            	INNER JOIN $wpdb->term_taxonomy AS x ON (r.term_taxonomy_id = x.term_taxonomy_id)
            	INNER JOIN $wpdb->terms AS t ON (r.term_taxonomy_id = t.term_id)
            	WHERE p.post_type IN ('product')
            	AND p.post_status = 'publish'
                AND x.taxonomy = 'product_cat'
            	AND (
                    (x.term_id = {$category})
                    OR
                    (x.parent = {$category})
                )
                AND (
                    (p.ID IN (SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_sku' AND meta_value LIKE '%{$keyword}%'))
                    OR
                    (p.post_content LIKE '%{$keyword}%')
                    OR
                    (p.post_title LIKE '%{$keyword}%')
                )
            	ORDER BY t.name ASC, p.post_date DESC;";

            } else {
                $querystr = "SELECT DISTINCT $wpdb->posts.*
                FROM $wpdb->posts, $wpdb->postmeta
                WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
                AND (
                    ($wpdb->postmeta.meta_key = '_sku' AND $wpdb->postmeta.meta_value LIKE '%{$keyword}%')
                    OR
                    ($wpdb->posts.post_content LIKE '%{$keyword}%')
                    OR
                    ($wpdb->posts.post_title LIKE '%{$keyword}%')
                )
                AND $wpdb->posts.post_status = 'publish'
                AND $wpdb->posts.post_type = 'product'
                ORDER BY $wpdb->posts.post_date DESC";
            }

            $query_results = $wpdb->get_results($querystr);

            if (!empty($query_results)) {
                
                $spstyle = get_theme_mod('search_product_style_woo','list');
                $pcol = get_theme_mod('search_product_grid_count_woo','3');
                
                if ($spstyle == 'list'){
                    $spgrid ="mayosis-ajax-list-search";
                    $spli = "";
                } else {
                      $spgrid ="mayosis-ajax-grid-search row row-cols-1 row-cols-md-$pcol";
                      $spli = "col";
                }
                
                     $output = "";
                $output .= '<ul class="'.$spgrid.'">';

                foreach ($query_results as $result) {
                    $product = wc_get_product( $result->ID);
        

                    $price = $product->get_price_html();

                    $sku   = get_post_meta($result->ID,'_sku');
                    $stock = get_post_meta($result->ID,'_stock_status');

                    $categories = wc_get_product_category_list($product->get_id());
                    

                    $output .= '<li class="'.$spli.'">';
                        
                            $output .= '<div class="mayosis-ajax-product-image">';
                                $output .= '<a href="'.get_post_permalink($result->ID).'"><img src="'.esc_url(get_the_post_thumbnail_url($result->ID,'full')).'"></a>';
                            $output .= '</div>';
                            $output .= '<div class="mayosis-ajax-product-data">';
                            $output .= '<div class="mayosis-ajax-category-data">'.$categories.'</div>';
                                $output .= '<h3><a href="'.get_post_permalink($result->ID).'">'.$result->post_title.'</a></h3>';
                               
                                    $output .= '<div class="mayosis-ajax-product-price">';
                                       
                                        
                                        $output .= $price;
                                        
                                    $output .= '</div>';
                                
                               
                               
                            $output .= '</div>';
                          
                    $output .= '</li>';
                }
              $output .= '</ul>';
                if (!empty($output)) {
                    echo $output;
                }
            }
        }

        die();
    }
    add_action( 'wp_ajax_search_product', 'search_product' );
    add_action( 'wp_ajax_nopriv_search_product', 'search_product' );

/*  Widget
/*-------------------*/

   function mayosis_live_search() {

    		wp_enqueue_script('mayosis-ajax-search');
                $catfilter = get_theme_mod('search_category_ds','show');
                $search_style_ds = get_theme_mod('search_style_ds', 'one');
                $search_placeholder= get_theme_mod('search_woo_placeholder_m', 'Search for Product...');
                
                
               if ($catfilter=="show"){
                   $catfilcls="mayosis-filter-available";
               } else {
               $catfilcls="mayosis-filter-not-available";
               }
               
                ?>

    			<div class="product-search <?php echo esc_html($catfilcls);?> mayosis-search-style-<?php echo esc_html($search_style_ds);?>">
    				<form name="product-search" method="get" class="mayosis-search-box" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    				    <?php if ($catfilter=="show"){?>
                        <?php $categories = get_product_categories_hierarchy(); ?>
                        <?php if ($categories): ?>
                        <div class="mayosis-ajax-search-bar category-wrapper">
                            <select name="category" class="category">
                                <option class="default" value=""><?php echo esc_html__( 'All Categories', 'mayosis' ); ?></option>
                                <?php list_taxonomy_hierarchy_no_instance( $categories); ?>
                            </select>
                        </div>
                        <?php endif ?>
                        <?php } ?>
                        <div class="search-wrapper">
                            <input type="text" name="s" class="search" placeholder="<?php echo $search_placeholder; ?>" value="<?php the_search_query(); ?>">
                         
                           <button type="submit" value="Search" class="mayosis-ajax-search-btn">
                          <i class="isax icon-search-normal-11"></i>
                            <input type="hidden" name="post_type" value="product" />
                        </button> 
                            <?php echo file_get_contents(plugins_url( 'images/loading.svg', __FILE__ )); ?>
                        </div>
    	            </form>
                    <div class="search-results mayosis-search-result"></div>
        		</div>

    		<?php
    	}
    	
    	
    	
    	function mayosis_live_search_elementor($settings) {

    		wp_enqueue_script('mayosis-ajax-search');
                $catfilter = $settings['ebl_search_filter'];
                $search_style_ds = $settings['search-style'];
                $search_placeholder= $settings['placeholder_text'];
                
                
               if ($catfilter=="enable"){
                   $catfilcls="mayosis-filter-available";
               } else {
               $catfilcls="mayosis-filter-not-available";
               }
               
                ?>

    			<div class="product-search <?php echo esc_html($catfilcls);?> mayosis-search-style-<?php echo esc_html($search_style_ds);?>">
    				<form name="product-search" method="get" class="mayosis-search-box" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    				    <?php if ($catfilter=="enable"){?>
                        <?php $categories = get_product_categories_hierarchy(); ?>
                        <?php if ($categories): ?>
                        <div class="mayosis-ajax-search-bar category-wrapper">
                            <select name="category" class="category">
                                <option class="default" value=""><?php echo esc_html__( 'All Categories', 'mayosis' ); ?></option>
                                <?php list_taxonomy_hierarchy_no_instance( $categories); ?>
                            </select>
                        </div>
                        <?php endif ?>
                        <?php } ?>
                        <div class="search-wrapper">
                            <input type="text" name="s" class="search" placeholder="<?php echo $search_placeholder; ?>" value="<?php the_search_query(); ?>">
                         
                           <button type="submit" value="Search" class="mayosis-ajax-search-btn">
                          <i class="isax icon-search-normal-11"></i>
                            <input type="hidden" name="post_type" value="product" />
                        </button> 
                            <?php echo file_get_contents(plugins_url( 'images/loading.svg', __FILE__ )); ?>
                        </div>
    	            </form>
                    <div class="search-results mayosis-search-result"></div>
        		</div>

    		<?php
    	}
?>
