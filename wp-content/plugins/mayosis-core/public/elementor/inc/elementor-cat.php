<?php
function mayosis_elementor_category_init( $elements_manager ) {

	$elements_manager->add_category(
		'mayosis-ele-cat',
		[
			'title' => __( 'Mayosis Elements', 'mayosis-core' ),
			'icon' => 'fa fa-plug',
		]
	);
	$elements_manager->add_category(
		'mayosis-product-elements',
		[
			'title' => __( 'Mayosis Products Elements', 'mayosis-core' ),
			'icon' => 'fa fa-plug',
		]
	);
	
		$elements_manager->add_category(
		'mayosis-product-archive',
		[
			'title' => __( 'Mayosis EDD Archive Elements', 'mayosis-core' ),
			'icon' => 'fa fa-plug',
		]
	);
	
		$elements_manager->add_category(
		'mayosis-woo-cat',
		[
			'title' => __( 'Mayosis Woocommerce', 'mayosis-core' ),
			'icon' => 'fa fa-plug',
		]
	);
	
	


}
add_action( 'elementor/elements/categories_registered', 'mayosis_elementor_category_init' );


if ( ! function_exists( 'mayosis_items_extracts' ) ) {
  function mayosis_items_extracts(  $type = '', $query_args = array() ) {

    $options = array();

    switch( $type ) {

      case 'pages':
      case 'page':
      $pages = get_pages( $query_args );

      if ( !empty($pages) ) {
        foreach ( $pages as $page ) {
          $options[$page->post_title] = $page->ID;
        }
      }
      break;

      case 'posts':
      case 'post':
      $posts = get_posts( $query_args );

      if ( !empty($posts) ) {
        foreach ( $posts as $post ) {
          $options[$post->post_title] = lcfirst($post->ID);
        }
      }
      break;

      case 'tags':
      case 'tag':

	  if (isset($query_args['taxonomies']) && taxonomy_exists($query_args['taxonomies'])) {
		$tags = get_terms( $query_args['taxonomies'] );
		  if ( !is_wp_error($tags) && !empty($tags) ) {
			foreach ( $tags as $tag ) {
			  $options[$tag->name] = $tag->term_id;
		  }
		}
	  }
      break;

      case 'categories':
      case 'category':

	  if (isset($query_args['taxonomy']) && taxonomy_exists($query_args['taxonomy'])) {
		$categories = get_categories( $query_args );
  		if ( !empty($categories) && is_array($categories) ) {

  		  foreach ( $categories as $category ) {
  			 $options[$category->name] = $category->term_id;
  		  }
  		}
	  }
      break;

    }

    return $options;

  }
}
#-----------------------------------------------------------------#
# elementor pagination
#-----------------------------------------------------------------#/

if ( ! function_exists( 'mayosis_page_paging_nav' ) ) {
  function mayosis_page_paging_nav( $max_num_pages = false, $args = array() ) {

    if (get_query_var('paged')) {
      $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
      $paged = get_query_var('page');
    } else {
      $paged = 1;
    }

    if ($max_num_pages === false) {
      global $wp_query;
      $max_num_pages = $wp_query->max_num_pages;
    }


    $defaults = array(
      'nav'            => 'load',
      'posts_per_page' => get_option( 'posts_per_page' ),
      'max_pages'      => $max_num_pages,
      'post_type'      => 'download',
    );


    $args = wp_parse_args( $args, $defaults );

    if ( $max_num_pages < 2 ) { return; }

 

      $big = 999999999; // need an unlikely integer

      $links = paginate_links( array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'total'     => $max_num_pages,
        'prev_next' => true,
        'prev_text' => esc_html__('Previous', 'mayosis-core'),
        'next_text' => esc_html__('Next', 'mayosis-core'),
        'end_size'  => 1,
        'mid_size'  => 2,
      ) );

      if (!empty($links)): ?>
       <div class="common-paginav text-center">
           <div class="pagination">
           <?php echo wp_kses_post($links); ?>    
           </div>
        </div>
  
      <?php endif;
    }

  
}

/*
 * HTML Tag list
 * return array
 */
function mayosis_html_tag_lists() {
    $html_tag_list = [
        'h1'   => __( 'H1', 'mayosis-core' ),
        'h2'   => __( 'H2', 'mayosis-core' ),
        'h3'   => __( 'H3', 'mayosis-core' ),
        'h4'   => __( 'H4', 'mayosis-core' ),
        'h5'   => __( 'H5', 'mayosis-core' ),
        'h6'   => __( 'H6', 'mayosis-core' ),
        'p'    => __( 'p', 'mayosis-core' ),
        'div'  => __( 'div', 'mayosis-core' ),
        'span' => __( 'span', 'mayosis-core' ),
    ];
    return $html_tag_list;
}


/*
 * Image Size
 * return array
 */
function mayosis_image_size_ebl() {
    $image_size_list = [
        'full'   => __( 'Full', 'mayosis-core' ),
        'thumbnail'   => __( 'Thumbnail', 'mayosis-core' ),
        'mayosis-product-thumb-small'   => __( 'Mayosis Small (170x170)', 'mayosis-core' ),
        'mayosis-single-page-thumbnail'   => __( 'Mayosis Single (720x480)', 'mayosis-core' ),
        'mayosis-product-carousel'   => __( 'Mayosis Carousel (592x665)', 'mayosis-core' ),
        'mayosis-uneven-middle-large'   => __( 'Mayosis Large (708x950)', 'mayosis-core' ),
        
         'mayosis-book-thumbnail'   => __( 'Mayosis Book Thumb (708x950)', 'mayosis-core' ),
    ];
    return $image_size_list;
}

/**
* EDD Product last product id return
*/
function mayosis_get_last_product_id(){
    global $wpdb;
    
    // Getting last Product ID (max value)
    $results = $wpdb->get_col( "
        SELECT MAX(ID) FROM {$wpdb->prefix}posts
        WHERE post_type LIKE 'download'
        AND post_status = 'publish'" 
    );
    return reset($results);
}


