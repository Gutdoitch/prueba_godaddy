<?php

add_action( 'wp_enqueue_scripts', 'mayosis_bp_dequeue', 9 );

function mayosis_bp_dequeue() {
    wp_dequeue_style( 'bp-legacy-css' );
    wp_deregister_style( 'bp-legacy-css' );
    if (is_rtl()) {
    	if (is_child_theme() && file_exists(get_stylesheet_directory() . '/buddypress/css/buddypress.css')) {
    		$location = get_stylesheet_directory() . '/buddypress/css/buddypress.css';
	    } else {
		    $location = get_template_directory_uri() . '/buddypress/css/buddypress.css';
	    }

    	wp_enqueue_style('bp-parent-css', $location, [], BP_VERSION );
    }
}


/**
 * Your theme callback function
 *
 * <a class="bp-suggestions-mention" href="https://buddypress.org/members/see/" rel="nofollow">@see</a> bp_legacy_theme_cover_image() to discover the one used by BP Legacy
 */
function mayosis_theme_cover_image_callback( $params = array() ) {
    if ( empty( $params ) ) {
        return;
    }
 
    return '
        /* Cover image - Do not forget this part */
        #buddypress #header-cover-image {
            height: ' . $params["height"] . 'px;
            background-image: url(' . $params['cover_image'] . ');
        }
    ';
}
 



function mayosis_cover_image_css( $settings = array() ) {
    /**
     * If you are using a child theme, use bp-child-css
     * as the theme handel
     */
    $theme_handle = 'bp-parent-css';
 
    $settings['theme_handle'] = $theme_handle;
 
    /**
     * Then you'll probably also need to use your own callback function
     * <a class="bp-suggestions-mention" href="https://buddypress.org/members/see/" rel="nofollow">@see</a> the previous snippet
     */
     $settings['callback'] = 'mayosis_theme_cover_image_callback';
 
    return $settings;
}
add_filter( 'bp_before_members_cover_image_settings_parse_args', 'mayosis_cover_image_css', 10, 1 );
add_filter( 'bp_before_groups_cover_image_settings_parse_args', 'mayosis_cover_image_css', 10, 1 );
