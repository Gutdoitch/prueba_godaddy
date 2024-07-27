<?php

namespace FilterEverything\Filter;

if ( ! defined('WPINC') ) {
    wp_die();
}

class PostTypes
{
    public function __construct()
    {
        add_action( 'init', array( $this, 'registerPostType' ) );
    }

    function registerPostType() {
        // No need to escape
        register_post_type( MYSIS_FILTERS_SET_POST_TYPE, array(
            'label'    => esc_html__( 'Filter Sets', 'mayosis-filter' ),
            'labels'			=> array(
                'name'					=> esc_html__( 'Filter Sets', 'mayosis-filter' ),
                'singular_name'			=> esc_html__( 'Filters Set', 'mayosis-filter' ),
                'add_new'				=> esc_html__( 'Add Filter Set' , 'mayosis-filter' ),
                'add_new_item'			=> esc_html__( 'Add Filter Set' , 'mayosis-filter' ),
                'edit_item'				=> esc_html__( 'Edit Filter Set' , 'mayosis-filter' ),
                'new_item'				=> esc_html__( 'New Filter Set' , 'mayosis-filter' ),
                'view_item'				=> esc_html__( 'View Filter Set', 'mayosis-filter' ),
                'search_items'			=> esc_html__( 'Search Filter Sets', 'mayosis-filter' ),
                'not_found'				=> esc_html__( 'Filter Sets are Filters grouped together. Create your first Filter Set.', 'mayosis-filter' ),
                'not_found_in_trash'	=> esc_html__( 'No Filter Sets found in Trash', 'mayosis-filter' ),
            ),
            'has_archive'       => false,
            'public'			=> false,
            'show_ui'			=> true,
            '_builtin'			=> false,
            'capability_type'	=> 'post',
            'hierarchical'		=> true,
            'rewrite'			=> false,
            'query_var'			=> false,
            'supports' 			=> array('title'),
            'show_in_menu'		=> false,
        ) );

        register_post_type(MYSIS_FILTERS_POST_TYPE, array(
            'labels'			=> array(
                'name'					=> esc_html__( 'Filters', 'mayosis-filter' ),
                'singular_name'			=> esc_html__( 'Filter', 'mayosis-filter' ),
                'add_new'				=> esc_html__( 'Add New' , 'mayosis-filter' ),
                'add_new_item'			=> esc_html__( 'Add New Filter' , 'mayosis-filter' ),
                'edit_item'				=> esc_html__( 'Edit Filter' , 'mayosis-filter' ),
                'new_item'				=> esc_html__( 'New Filter' , 'mayosis-filter' ),
                'view_item'				=> esc_html__( 'View Filter', 'mayosis-filter' ),
                'search_items'			=> esc_html__( 'Search Filters', 'mayosis-filter' ),
                'not_found'				=> esc_html__( 'No Filters found', 'mayosis-filter' ),
                'not_found_in_trash'	=> esc_html__( 'No Filters found in Trash', 'mayosis-filter' ),
            ),
            'public'			=> false,
            'show_ui'			=> false,
            '_builtin'			=> false,
            'capability_type'	=> 'post',
            'hierarchical'		=> true,
            'rewrite'			=> false,
            'query_var'			=> false,
            'supports' 			=> array('title'),
            'show_in_menu'		=> false,
        ) );
    }
}

new PostTypes();