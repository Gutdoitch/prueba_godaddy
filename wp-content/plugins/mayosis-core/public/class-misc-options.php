<?php
/**
*Mayosis Misc Options
* */ 


/**
 * Shortcode Copyright Year
 *
 */
function year_shortcode() {
    $year = date('Y');
    return $year;
}

add_shortcode('year', 'year_shortcode');


/**
 * Server Information
 *
 */
function server_information() {
    $server = $_SERVER['SERVER_SOFTWARE'];
    return $server;
}

add_shortcode('server-information', 'server_information');


// //////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////  XML SITEMAP GENARATOR  /////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

add_action("publish_post", "digitalmarketplace_create_sitemap");
add_action("publish_page", "digitalmarketplace_create_sitemap");

function digitalmarketplace_create_sitemap()
{
    $postsForSitemap = get_posts(array(
        'numberposts' => - 1,
        'orderby' => 'modified',
        'post_type' => array(
            'post',
            'page',
            'download'
        ) ,
        'order' => 'DESC'
    ));
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
    $sitemap.= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach($postsForSitemap as $post)
    {
        setup_postdata($post);
        $postdate = explode(" ", $post->post_modified);
        $sitemap.= '<url>' . '<loc>' . get_permalink($post->ID) . '</loc>' . '<lastmod>' . $postdate[0] . '</lastmod>' . '<changefreq>monthly</changefreq>' . '</url>';
    }

    $sitemap.= '</urlset>';
    $fp = fopen(ABSPATH . "sitemap.xml", 'w');
    fwrite($fp, $sitemap);
    fclose($fp);
}


// //////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////   Visual Composer  /////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////
// Before VC Init
add_action('vc_before_init', 'vc_before_init_actions');
function vc_before_init_actions()
{
    // Setup VC to be part of a theme
    if (function_exists('vc_set_as_theme')) {
        vc_set_as_theme(true);
    }
    // Link your VC elements's folder
    if (function_exists('vc_set_shortcodes_templates_dir')) {
        vc_set_shortcodes_templates_dir(get_template_directory() . '/vc_templates');
    }
    // Disable Instructional/Help Pointers
    if (function_exists('vc_pointer_load')) {
        remove_action('admin_enqueue_scripts', 'vc_pointer_load');
    }
}
// After VC Init
add_action('vc_after_init', 'vc_after_init_actions');
function vc_after_init_actions()
{
    // Enable VC by default on a list of Post Types
    if (function_exists('vc_set_default_editor_post_types')) {
        $list = array(
            'page',
            'post',
            'download'
            // add here your custom post types slug
        );
        vc_set_default_editor_post_types($list);
    }
    // Disable AdminBar VC edit link
    if (function_exists('vc_frontend_editor')) {
        remove_action('admin_bar_menu', array(
            vc_frontend_editor(),
            'adminBarEditLink'
        ), 1000);
    }
    // Disable Frontend VC links
    if (function_exists('vc_disable_frontend')) {
        vc_disable_frontend();
    }
}






// //////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////   AUTHOR CUSTOM LINK  /////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function digitalmarketplace_to_author_profile($contactmethods)
{
    $contactmethods['address'] = 'Address';
    $contactmethods['behance_profile'] = 'Behance Profile URL';
    $contactmethods['dribble_profile'] = 'Dribble Profile URL';
    $contactmethods['twitter_profile'] = 'Twitter Profile URL';
    $contactmethods['facebook_profile'] = 'Facebook Profile URL';
    $contactmethods['linkedin_profile'] = 'Linkedin Profile URL';
    $contactmethods['instagram_profile'] = 'Instagram Profile URL';
    $contactmethods['pinterest_profile'] = 'Pinterest Profile URL';
    $contactmethods['flicker_profile'] = 'Flicker Profile URL';
    $contactmethods['fes_cover_photo'] = ' User Profile Cover Image';
    $contactmethods['fes_author_available'] = 'Freelance Available Text (i.e Available for Hire)';
    return $contactmethods;
}

add_filter('user_contactmethods', 'digitalmarketplace_to_author_profile', 10, 1);

