<?php
// Register Taxonomy Orientation
function mayosis_ex_orientation_tax() {

	$labels = array(
		'name'              => _x( 'Orientations', 'taxonomy general name', 'mayosis-core' ),
		'singular_name'     => _x( 'Orientation', 'taxonomy singular name', 'mayosis-core' ),
		'search_items'      => __( 'Search Orientations', 'mayosis-core' ),
		'all_items'         => __( 'All Orientations', 'mayosis-core' ),
		'parent_item'       => __( 'Parent Orientation', 'mayosis-core' ),
		'parent_item_colon' => __( 'Parent Orientation:', 'mayosis-core' ),
		'edit_item'         => __( 'Edit Orientation', 'mayosis-core' ),
		'update_item'       => __( 'Update Orientation', 'mayosis-core' ),
		'add_new_item'      => __( 'Add New Orientation', 'mayosis-core' ),
		'new_item_name'     => __( 'New Orientation Name', 'mayosis-core' ),
		'menu_name'         => __( 'Orientation', 'mayosis-core' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'mayosis-core' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
	);
	register_taxonomy( 'orientation', array('download'), $args );

}
add_action( 'init', 'mayosis_ex_orientation_tax' );

// Register Taxonomy Size
function mayosis_ex_size_tax() {

	$labels = array(
		'name'              => _x( 'Sizes', 'taxonomy general name', 'mayosis-core' ),
		'singular_name'     => _x( 'Size', 'taxonomy singular name', 'mayosis-core' ),
		'search_items'      => __( 'Search Sizes', 'mayosis-core' ),
		'all_items'         => __( 'All Sizes', 'mayosis-core' ),
		'parent_item'       => __( 'Parent Size', 'mayosis-core' ),
		'parent_item_colon' => __( 'Parent Size:', 'mayosis-core' ),
		'edit_item'         => __( 'Edit Size', 'mayosis-core' ),
		'update_item'       => __( 'Update Size', 'mayosis-core' ),
		'add_new_item'      => __( 'Add New Size', 'mayosis-core' ),
		'new_item_name'     => __( 'New Size Name', 'mayosis-core' ),
		'menu_name'         => __( 'Size', 'mayosis-core' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'mayosis-core' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
	);
	register_taxonomy( 'size', array('download'), $args );

}
add_action( 'init', 'mayosis_ex_size_tax' );

// Register Taxonomy Resolution
function mayosis_resolution_tax() {

	$labels = array(
		'name'              => _x( 'Resolutions', 'taxonomy general name', 'mayosis-core' ),
		'singular_name'     => _x( 'Resolution', 'taxonomy singular name', 'mayosis-core' ),
		'search_items'      => __( 'Search Resolutions', 'mayosis-core' ),
		'all_items'         => __( 'All Resolutions', 'mayosis-core' ),
		'parent_item'       => __( 'Parent Resolution', 'mayosis-core' ),
		'parent_item_colon' => __( 'Parent Resolution:', 'mayosis-core' ),
		'edit_item'         => __( 'Edit Resolution', 'mayosis-core' ),
		'update_item'       => __( 'Update Resolution', 'mayosis-core' ),
		'add_new_item'      => __( 'Add New Resolution', 'mayosis-core' ),
		'new_item_name'     => __( 'New Resolution Name', 'mayosis-core' ),
		'menu_name'         => __( 'Resolution', 'mayosis-core' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'mayosis-core' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
	);
	register_taxonomy( 'resolution', array('download'), $args );

}
add_action( 'init', 'mayosis_resolution_tax' );