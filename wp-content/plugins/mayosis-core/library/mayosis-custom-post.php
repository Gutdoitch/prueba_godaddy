<?php
/**
 * Custom posts
 */

add_action( 'init', 'mayosis_register_post_types' );
function mayosis_register_post_types() {
    register_post_type('testimonial', array(
        'public' => true,
        'label' => 'Testimonial',
        'menu_icon'           => 'dashicons-welcome-write-blog',
        'labels' => array(
            'name' => 'Testimonial',
            'singular_name' => 'Testimonials',
            'add_new' => 'Add New Testimonial',
        ),
        'supports' => array('title', 'thumbnail'),
        'can_export' => true,
    ));

    register_post_type('slider', array(
        'public' => true,
        'label' => 'Slider',
        'menu_icon'           => 'dashicons-images-alt',
        'labels' => array(
            'name' => 'Slider',
            'singular_name' => 'Sliders',
            'add_new' => 'Add New Slider',
        ),
        'supports' => array('title', 'thumbnail'),
        'can_export' => true,
    ));

    register_post_type('licence',
        array(
            'labels' => array(
                'name' => __( 'License' ),
                'singular_name' => __( 'License' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New License' ),
                'edit' => __( 'Edit' ),
                'edit_item' => __( 'Edit License' ),
                'new_item' => __( 'New License' ),
                'view' => __( 'View License' ),
                'view_item' => __( 'View License' ),
                'search_items' => __( 'Search Licenses' ),
                'not_found' => __( 'No Licenses found' ),
                'not_found_in_trash' => __( 'No Licenses found in Trash' ),
                'parent' => __( 'Parent License' ),
            ),
            'public' => true,
            'menu_icon' => 'dashicons-tickets',
            'show_ui' => true,
            'exclude_from_search' => true,
            'hierarchical' => true,
            'supports' => array( 'title'),
            'query_var' => true
        )
    );

}
add_action( 'init', 'mayosis_license_taxonomies', 0 );

function mayosis_license_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => _x( 'License Group', 'taxonomy general name' ),
        'singular_name' => _x( 'License Groups', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Group' ),
        'popular_items' => __( 'Popular Group' ),
        'all_items' => __( 'All License Group' ),
        'parent_item' => __( 'Parent License Group' ),
        'parent_item_colon' => __( 'Parent License Group:' ),
        'edit_item' => __( 'Edit License Group' ),
        'update_item' => __( 'Update License Group' ),
        'add_new_item' => __( 'Add New License Group' ),
        'new_item_name' => __( 'New Recording License Group' ),
    );
    register_taxonomy('license-group',array('licence'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'license-group' ),
    ));
}



function short_excerpt($string)
{
    echo substr($string, 0, 210);
}
if (class_exists('Easy_Digital_Downloads')){
// Register Custom Post Type Product Template
function mayosis_product_template_cpt() {

    $mproduct_labels = array(
        'name' => _x( 'Product Templates', 'Post Type General Name', 'mayosis-core' ),
        'singular_name' => _x( 'Product Template', 'Post Type Singular Name', 'mayosis-core' ),
        'menu_name' => _x( 'Product Templates', 'Admin Menu text', 'mayosis-core' ),
        'name_admin_bar' => _x( 'Product Template', 'Add New on Toolbar', 'mayosis-core' ),
        'archives' => __( 'Product Template Archives', 'mayosis-core' ),
        'attributes' => __( 'Product Template Attributes', 'mayosis-core' ),
        'parent_item_colon' => __( 'Parent Product Template:', 'mayosis-core' ),
        'all_items' => __( 'Product Templates', 'mayosis-core' ),
        'add_new_item' => __( 'Add New Product Template', 'mayosis-core' ),
        'add_new' => __( 'Add New', 'mayosis-core' ),
        'new_item' => __( 'New Product Template', 'mayosis-core' ),
        'edit_item' => __( 'Edit Product Template', 'mayosis-core' ),
        'update_item' => __( 'Update Product Template', 'mayosis-core' ),
        'view_item' => __( 'View Product Template', 'mayosis-core' ),
        'view_items' => __( 'View Product Templates', 'mayosis-core' ),
        'search_items' => __( 'Search Product Template', 'mayosis-core' ),
        'not_found' => __( 'Not found', 'mayosis-core' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'mayosis-core' ),
        'featured_image' => __( 'Featured Image', 'mayosis-core' ),
        'set_featured_image' => __( 'Set featured image', 'mayosis-core' ),
        'remove_featured_image' => __( 'Remove featured image', 'mayosis-core' ),
        'use_featured_image' => __( 'Use as featured image', 'mayosis-core' ),
        'insert_into_item' => __( 'Insert into Product Template', 'mayosis-core' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Product Template', 'mayosis-core' ),
        'items_list' => __( 'Product Templates list', 'mayosis-core' ),
        'items_list_navigation' => __( 'Product Templates list navigation', 'mayosis-core' ),
        'filter_items_list' => __( 'Filter Product Templates list', 'mayosis-core' ),
         'name_admin_bar'  => __( 'Product', 'mayosis-core' ),
        
    );
    $mproduct_args = array(
        'label' => __( 'Product Template', 'mayosis-core' ),
        'description' => __( '', 'mayosis-core' ),
        'labels' => $mproduct_labels,
        'menu_icon' => '',
        'supports' => array('title', 'editor'),
        'taxonomies' => array(),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
       
    );
    register_post_type( 'product_template', $mproduct_args );

}
add_action( 'init', 'mayosis_product_template_cpt', 0 );

// Move the "example_cpt" Custom-Post-Type to be a submenu of the "example_parent_page_id" admin page.
add_action('admin_menu', 'mayosis_fix_product_t_menu', 11);
function mayosis_fix_product_t_menu() {

    // Add "Example CPT" Custom-Post-Type as submenu of the "Example Parent Page" page
    add_submenu_page('mayosis-admin-menu', 'Product Builder (EDD)', 'Product Builder (EDD)', 'edit_pages' , 'edit.php?post_type=product_template');
}

}

// Register Custom Post Type Footer Builder
function mayosis_footer_builder_cpt() {

    $mfooter_labels = array(
        'name' => _x( 'Footer Builders', 'Post Type General Name', 'mayosis-core' ),
        'singular_name' => _x( 'Footer Template', 'Post Type Singular Name', 'mayosis-core' ),
        'menu_name' => _x( 'Footer Builder', 'Admin Menu text', 'mayosis-core' ),
        'name_admin_bar' => _x( 'Footer Template', 'Add New on Toolbar', 'mayosis-core' ),
        'archives' => __( 'Footer Builder Archives', 'mayosis-core' ),
        'attributes' => __( 'Footer Builder Attributes', 'mayosis-core' ),
        'parent_item_colon' => __( 'Parent Footer Builder:', 'mayosis-core' ),
        'all_items' => __( 'Footer Builder', 'mayosis-core' ),
        'add_new_item' => __( 'Add New Footer Builder', 'mayosis-core' ),
        'add_new' => __( 'Add New', 'mayosis-core' ),
        'new_item' => __( 'New Footer Builder', 'mayosis-core' ),
        'edit_item' => __( 'Edit Footer Builder', 'mayosis-core' ),
        'update_item' => __( 'Update Footer Builder', 'mayosis-core' ),
        'view_item' => __( 'View Footer Builder', 'mayosis-core' ),
        'view_items' => __( 'View Footer Builder', 'mayosis-core' ),
        'search_items' => __( 'Search Footer Builder', 'mayosis-core' ),
        'not_found' => __( 'Not found', 'mayosis-core' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'mayosis-core' ),
        'featured_image' => __( 'Featured Image', 'mayosis-core' ),
        'set_featured_image' => __( 'Set featured image', 'mayosis-core' ),
        'remove_featured_image' => __( 'Remove featured image', 'mayosis-core' ),
        'use_featured_image' => __( 'Use as featured image', 'mayosis-core' ),
        'insert_into_item' => __( 'Insert into Footer Builder', 'mayosis-core' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Footer Builder', 'mayosis-core' ),
        'items_list' => __( 'Footer Builder list', 'mayosis-core' ),
        'items_list_navigation' => __( 'Footer Builder list navigation', 'mayosis-core' ),
        'filter_items_list' => __( 'Filter Footer Builder list', 'mayosis-core' ),
    );
    $mfooter_args = array(
        'label' => __( 'Footer Builder', 'mayosis-core' ),
        'description' => __( '', 'mayosis-core' ),
        'labels' => $mfooter_labels,
        'menu_icon' => '',
        'supports' => array('title', 'editor'),
        'taxonomies' => array(),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => false,
        'hierarchical' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'footer_builder', $mfooter_args );

}
add_action( 'init', 'mayosis_footer_builder_cpt', 0 );

// Move the "example_cpt" Custom-Post-Type to be a submenu of the "example_parent_page_id" admin page.
add_action('admin_menu', 'mayosis_fix_footer_t_menu', 11);
function mayosis_fix_footer_t_menu() {

// Add "Example CPT" Custom-Post-Type as submenu of the "Example Parent Page" page
    add_submenu_page('mayosis-admin-menu', 'Footer Builder', 'Footer Builder', 'edit_pages' , 'edit.php?post_type=footer_builder');
}

if (class_exists('Easy_Digital_Downloads')){

// Register Custom Post Type EDD Archive Builder
function mayosis_edd_archive_builder_cpt() {

    $marchive_labels = array(
        'name' => _x( 'EDD Archive Builders', 'Post Type General Name', 'mayosis-core' ),
        'singular_name' => _x( 'EDD Archive Builders', 'Post Type Singular Name', 'mayosis-core' ),
        'menu_name' => _x( 'EDD Archive Builder', 'Admin Menu text', 'mayosis-core' ),
        'name_admin_bar' => _x( 'EDD Archive', 'Add New on Toolbar', 'mayosis-core' ),
        'archives' => __( 'EDD Archive Builder Archives', 'mayosis-core' ),
        'attributes' => __( 'EDD Archive Builder Attributes', 'mayosis-core' ),
        'parent_item_colon' => __( 'Parent EDD Archive Builder:', 'mayosis-core' ),
        'all_items' => __( 'EDD Archive Builder', 'mayosis-core' ),
        'add_new_item' => __( 'Add New EDD Archive Builder', 'mayosis-core' ),
        'add_new' => __( 'Add New', 'mayosis-core' ),
        'new_item' => __( 'New EDD Archive Builder', 'mayosis-core' ),
        'edit_item' => __( 'Edit EDD Archive Builder', 'mayosis-core' ),
        'update_item' => __( 'Update EDD Archive Builder', 'mayosis-core' ),
        'view_item' => __( 'View EDD Archive Builder', 'mayosis-core' ),
        'view_items' => __( 'View EDD Archive Builder', 'mayosis-core' ),
        'search_items' => __( 'Search EDD Archive Builder', 'mayosis-core' ),
        'not_found' => __( 'Not found', 'mayosis-core' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'mayosis-core' ),
        'featured_image' => __( 'Featured Image', 'mayosis-core' ),
        'set_featured_image' => __( 'Set featured image', 'mayosis-core' ),
        'remove_featured_image' => __( 'Remove featured image', 'mayosis-core' ),
        'use_featured_image' => __( 'Use as featured image', 'mayosis-core' ),
        'insert_into_item' => __( 'Insert into EDD Archive Builder', 'mayosis-core' ),
        'uploaded_to_this_item' => __( 'Uploaded to this EDD Archive Builder', 'mayosis-core' ),
        'items_list' => __( 'EDD Archive Builder list', 'mayosis-core' ),
        'items_list_navigation' => __( 'EDD Archive Builder list navigation', 'mayosis-core' ),
        'filter_items_list' => __( 'Filter EDD Archive Builder list', 'mayosis-core' ),
    );
    $marchive_args = array(
        'label' => __( 'EDD Archive Builder', 'mayosis-core' ),
        'description' => __( '', 'mayosis-core' ),
        'labels' => $marchive_labels,
        'menu_icon' => '',
        'supports' => array('title', 'editor'),
        'taxonomies' => array(),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'edd_archive_builder', $marchive_args );

}
add_action( 'init', 'mayosis_edd_archive_builder_cpt', 0 );


add_action('admin_menu', 'mayosis_fix_edd_archive_b_menu', 11);
function mayosis_fix_edd_archive_b_menu() {

// Add "Example CPT" Custom-Post-Type as submenu of the "Example Parent Page" page
    add_submenu_page('mayosis-admin-menu', 'Archive Builder', 'Archive Builder (EDD)', 'edit_pages' , 'edit.php?post_type=edd_archive_builder');
}
}
// Get block id by ID or slug.
function mayosis_get_block_id( $post_id ) {
  global $wpdb;

  if ( empty ( $post_id ) ) {
    return null;
  }

  // Get post ID if using post_name as id attribute.
  if ( ! is_numeric( $post_id ) ) {
    $post_id = $wpdb->get_var(
      $wpdb->prepare(
        "SELECT ID FROM $wpdb->posts WHERE post_type = 'mayosis_block' AND post_name = %s",
        $post_id
      )
    );
  }

  // Polylang support.
  if ( function_exists( 'pll_get_post' ) ) {
    if ( $lang_id = pll_get_post( $post_id ) ) {
      $post_id = $lang_id;
    }
  }

  // WPML Support.
  if ( function_exists( 'icl_object_id' ) ) {
    if ( $lang_id = icl_object_id( $post_id, 'mayosis_block', false, ICL_LANGUAGE_CODE ) ) {
      $post_id = $lang_id;
    }
  }

  return $post_id;
}
// Register Custom Post Type mayosis_block
function mayosis_create_block_cpt() {

	$labels = array(
		'name' => _x( 'Mayosis Blocks', 'Post Type General Name', 'textdomain' ),
		'singular_name' => _x( 'Mayosis Block', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => _x( 'Mayosis Block', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar' => _x( 'Mayosis Block', 'Add New on Toolbar', 'textdomain' ),
		'archives' => __( 'Block Archives', 'textdomain' ),
		'attributes' => __( 'Block Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent mayosis_block:', 'textdomain' ),
		'all_items' => __( 'Mayosis Blocks', 'textdomain' ),
		'add_new_item' => __( 'Add New Block', 'textdomain' ),
		'add_new' => __( 'Add New Block', 'textdomain' ),
		'new_item' => __( 'New Block', 'textdomain' ),
		'edit_item' => __( 'Edit Block', 'textdomain' ),
		'update_item' => __( 'Update Block', 'textdomain' ),
		'view_item' => __( 'View Block', 'textdomain' ),
		'view_items' => __( 'View Block', 'textdomain' ),
		'search_items' => __( 'Search Block', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into Block', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Block', 'textdomain' ),
		'items_list' => __( 'Block list', 'textdomain' ),
		'items_list_navigation' => __( 'Block list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter Block list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'Block', 'textdomain' ),
		'description' => __( '', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-editor-ul',
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => false,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => false,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => true,
		'exclude_from_search' => true,
		'show_in_rest' => false,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'mayosis_block', $args );

}
add_action( 'init', 'mayosis_create_block_cpt', 0 );

add_action('admin_menu', 'mayosis_fix_block_t_menu', 11);
function mayosis_fix_block_t_menu() {

// Add "Example CPT" Custom-Post-Type as submenu of the "Example Parent Page" page
    add_submenu_page('mayosis-admin-menu', 'Mayosis Blocks', 'Mayosis Blocks', 'edit_pages' , 'edit.php?post_type=mayosis_block');
}

function my_edit_mayosis_block_columns() {
	$columns = array(
		'cb'        => '<input type="checkbox" />',
		'title'     => __( 'Title', 'mayosis' ),
		'shortcode' => __( 'Shortcode', 'mayosis' ),
		'date'      => __( 'Date', 'mayosis' ),
	);

	return $columns;
}

add_filter( 'manage_edit-mayosis_block_columns', 'my_edit_mayosis_block_columns' );

function my_manage_mayosis_block_columns( $column, $post_id ) {
	$post_data = get_post( $post_id, ARRAY_A );
	$slug      = $post_data['post_name'];
	add_thickbox();
	switch ( $column ) {
		case 'shortcode':
			echo '<textarea style="min-width: 60%;
    max-height: 27px;
    background: #FBEEE6;
    border-color: #FBEEE6;
    color: #28170E;
    font-size: 14px;
    margin-top: 5px;
">[mayosis_block id="' . $slug . '"]</textarea>';
			break;
	}
}

add_action( 'manage_mayosis_block_posts_custom_column', 'my_manage_mayosis_block_columns', 10, 2 );


/**
 * Disable gutenberg support for now.
 *
 * @param bool   $use_mayosis_block_editor Whether the post type can be edited or not. Default true.
 * @param string $post_type        The post type being checked.
 *
 * @return bool
 */
function mayosis_block_disable_gutenberg( $use_mayosis_block_editor, $post_type ) {
	return $post_type === 'mayosis_block' ? false : $use_mayosis_block_editor;
}

add_filter( 'use_mayosis_block_editor_for_post_type', 'mayosis_block_disable_gutenberg', 10, 2 );
add_filter( 'gutenberg_can_edit_post_type', 'mayosis_block_disable_gutenberg', 10, 2 );


/**
 * Update mayosis_block preview URL
 */
function setec_mayosis_block_scripts() {
	global $typenow;
	if ( 'mayosis_block' == $typenow && isset( $_GET["post"] ) ) {
		?>
		<script>
          jQuery(document).ready(function ($) {
            var mayosis_block_id = $('input#post_name').val()
            $('#submitdiv').
              after('<div class="postbox"><h2 class="hndle">Shortcode</h2><div class="inside"><p><textarea style="width:100%; max-height:30px;">[mayosis_block id="' + mayosis_block_id +
                '"]</textarea></p></div></div>')
          })
		</script>
		<?php
	}
}

add_action( 'admin_head', 'setec_mayosis_block_scripts' );

function setec_mayosis_block_frontend() {
	if ( isset( $_GET["mayosis_block"] ) ) {
		?>
		<script>
          jQuery(document).ready(function ($) {
            $.scrollTo('#<?php echo esc_attr( $_GET["mayosis_block"] );?>', 300, {offset: -200})
          })
		</script>
		<?php
	}
}

add_action( 'wp_footer', 'setec_mayosis_block_frontend' );

function mayosis_block_shortcode( $atts, $content = null ) {
	global $post;

	extract( shortcode_atts( array(
			'id' => '',
		),
			$atts
		)
	);

	// Abort if ID is empty.
	if ( empty ( $id ) ) {
		return '<p><mark>No mayosis_block ID is set</mark></p>';
	}



	if ( is_home() ) $post = get_post( get_option('page_for_posts') );

	$post_id  = mayosis_get_block_id( $id );
	$the_post = $post_id ? get_post( $post_id, OBJECT, 'display' ) : null;

	if ( $the_post ) {
	      if (  did_action( 'elementor/loaded' ) ) {
	        $html = \Elementor\Plugin::$instance->frontend->get_builder_content( intval($post_id) );
	    } else {
		$html = $the_post->post_content;
	    }

		if ( empty( $html ) ) {
			$html = '<p class="lead shortcode-error">Open this in Elementor to add and edit content</p>';
		}

		// Add edit link for admins.
		if ( isset( $post ) && current_user_can( 'edit_pages' )
		     && ! is_customize_preview()
		     && function_exists( 'setec_builder_is_active' )
		     && ! setec_builder_is_active() ) {
			$edit_link         = setec_builder_edit_url( $post->ID, $post_id );
			$edit_link_backend = admin_url( 'post.php?post=' . $post_id . '&action=edit' );
			$html              = '<div class="mayosis_block-edit-link" data-title="Edit Block: ' . get_the_title( $post_id ) . '"   data-backend="' . esc_url( $edit_link_backend )
			                     . '" data-link="' . esc_url( $edit_link ) . '"></div>' . $html . '';
		}
	} else {
		$html = '<p class="text-center"><mark>Block <b>"' . esc_html( $id ) . '"</b> not found</mark></p>';
	}

	return do_shortcode( $html );
}

add_shortcode( 'mayosis_block', 'mayosis_block_shortcode' );


if ( ! function_exists( 'mayosis_block_categories' ) ) {
	/**
	 * Add mayosis_block categories support
	 */
	function mayosis_block_categories() {
		$args = array(
			'hierarchical'      => true,
			'public'            => false,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
		);
		register_taxonomy( 'mayosis_block_categories', array( 'mayosis_block' ), $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'mayosis_block_categories', 0 );
}
