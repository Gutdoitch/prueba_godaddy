<?php
/**
 * Mayosis functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mayosis
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
#-----------------------------------------------------------------#
# Defined Constants
#-----------------------------------------------------------------#/
define('MAYOSIS_THEME_NAME', 'mayosis');
if( !defined('MAYOSIS_ABSPATH') ) define('MAYOSIS_ABSPATH', get_template_directory() );
if( !defined('MAYOSIS_THEMEPATH') ) define('MAYOSIS_THEMEPATH', get_template_directory_uri() );
if( !isset($content_width) ) $content_width = 580; 

if( !class_exists('mayosis_theme_setup') ) {

    class mayosis_theme_setup {

        public function __construct() {

            /* includes_files Theme Files */

            add_action('after_setup_theme', array( $this, 'includes_files' ), 4 );

            /* Main Theme Options */

            add_action('after_setup_theme', array( $this, 'theme_support') );

        }

        public function includes_files(){
            require_once (MAYOSIS_ABSPATH.'/admin/mayosis-admin-helper.php');
            require_once (MAYOSIS_ABSPATH.'/library/theme-functions.php');
            require_once (MAYOSIS_ABSPATH.'/library/mayosis-enqueue.php');
            require_once (MAYOSIS_ABSPATH.'/library/widget.php');
            require_once (MAYOSIS_ABSPATH.'/library/edd.php');
            require_once (MAYOSIS_ABSPATH.'/library/breadcrumb.php');
            require_once (MAYOSIS_ABSPATH.'/library/acf.php');
            require_once (MAYOSIS_ABSPATH.'/library/acf_fallback.php');
            require_once (MAYOSIS_ABSPATH.'/library/mayosis_comment.php');
            require_once (MAYOSIS_ABSPATH.'/library/post_format.php');
            require_once (MAYOSIS_ABSPATH.'/library/mayosis_navwalker.php');
            require_once (MAYOSIS_ABSPATH.'/library/mayosis-accordion-navalker.php');
            
            require_once (MAYOSIS_ABSPATH.'/library/bootstrap-navwalker.php');
            require_once (MAYOSIS_ABSPATH.'/library/mayosis_classes.php');
            require_once (MAYOSIS_ABSPATH.'/library/mayosis-post-tags.php');
            require_once (MAYOSIS_ABSPATH.'/library/mayosis-theme-options.php');
            
            require_once(MAYOSIS_ABSPATH.'/css/mayosis_custom_css_loader.php');
            if ( function_exists( 'bp_is_active' ) ) {
                require_once (MAYOSIS_ABSPATH.'/library/buddypress.php');
            }
            if (class_exists('mayosis_core')){
                require_once (MAYOSIS_ABSPATH.'/library/thumb-custom-size.php');
                require_once (MAYOSIS_ABSPATH.'/library/mayosis_js.php');
            }

            require_once MAYOSIS_ABSPATH . '/admin/tgm/class-tgm-plugin-activation.php';
                require_once MAYOSIS_ABSPATH . '/admin/tgm/tgm-init.php';
                require_once MAYOSIS_ABSPATH . '/admin/admin-pages/admin.php';
                
                
                 /**
             * Load WooCommerce compatibility file.
             */
            if ( class_exists( 'WooCommerce' ) ) {
                require MAYOSIS_ABSPATH . '/includes/woo/woocommerce.php';
                 require MAYOSIS_ABSPATH . '/includes/woo/vendor/woo-single-product-structure.php';
                
            }
                
            if (!is_customize_preview()  && is_admin() ) {
                require_once (MAYOSIS_ABSPATH. '/admin/merlin/vendor/autoload.php' );
                require_once (MAYOSIS_ABSPATH. '/admin/merlin/class-merlin.php' );
                require_once (MAYOSIS_ABSPATH. '/admin/merlin/merlin-config.php' );
                require_once (MAYOSIS_ABSPATH. '/admin/merlin/merlin-filters.php' );

            }
                
            
        }


        public function theme_support(){
            // Set our theme version.
            define('GENERATE_VERSION', '4.7');

            /*
             * Make theme available for translation.
             * Translations can be filed in the /languages/ directory.
             * If you're building a theme based on mayosis, use a find and replace
             * to change 'mayosis' to the name of your theme in all the template files.
             */
            load_theme_textdomain('mayosis', MAYOSIS_ABSPATH . '/languages');

            // Add default posts and comments RSS feed links to head.
            add_theme_support( 'automatic-feed-links' );
            
            

            /*
             * Let WordPress manage the document title.
             * By adding theme support, we declare that this theme does not use a
             * hard-coded <title> tag in the document head, and expect WordPress to
             * provide it for us.
             */
            add_theme_support('post-thumbnails');
            add_image_size('mayosis-product-thumb-small', 170, 170, true);
            add_image_size('mayosis-product-grid-small', 150, 100, true);
            add_image_size('mayosis-product-wave-small', 90, 90, true);
            add_image_size('mayosis-product-wave-small-audio', 120, 120, true);
            add_image_size('mayosis-grid-small', 300);
            add_image_size('mayosis-single-page-thumbnail', 720, 480, true);
            add_image_size('mayosis-grid-list', 150,100, true);
            add_image_size('mayosis-product-carousel',592, 665, true);
            add_image_size('mayosis-uneven-left-small', 374,590, true);
            add_image_size('mayosis-uneven-middle-large', 684,1072, true);
            add_image_size('mayosis-book-thumbnail', 342,536, true);
            add_image_size('mayosis-audio-list-thumbnail', 350,250, true);
            add_image_size('mayosis-audio-cat-thumbnail', 500,500, true);
            add_image_size('mayosis-cart-image', 120,80, true);
            add_theme_support('custom-background');
            add_theme_support('custom-header');
            add_theme_support('automatic-feed-links');
            add_theme_support('title-tag');
            add_post_type_support('attachment:audio', 'thumbnail');
            add_post_type_support('attachment:video', 'thumbnail');
            add_filter('wpcf7_form_elements', 'do_shortcode');
            add_filter('wpcf7_autop_or_not', '__return_false');
            add_theme_support('title-tag');
            add_theme_support( 'bbpress' );
          

            /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
            add_theme_support( 'post-thumbnails' );

            // This theme uses wp_nav_menu() in one location.
            register_nav_menus(array(
                'main-menu' => esc_html__('Main Menu', 'mayosis'),
                'top-menu' => esc_html__('Top Menu', 'mayosis'),
                'bottom-menu' => esc_html__('Bottom Menu', 'mayosis'),
                'mobile-menu' => esc_html__('Mobile Menu', 'mayosis'),
                'account-menu' => esc_html__('Account Menu', 'mayosis'),
               
            ));
            /*
             * Switch default core markup for search form, comment form, and comments
             * to output valid HTML5.
             */
            add_theme_support('html5', array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption'
            ));


            add_theme_support('post-formats', array(
                'aside',
                'image',
                'video',
                'gallery',
                'audio'
            ));
            add_post_type_support('download', 'post-formats');
            add_post_type_support('product', 'post-formats');

            // Add theme support for selective refresh for widgets.
            add_theme_support( 'customize-selective-refresh-widgets' );

#-----------------------------------------------------------------#
# Gutenberg
#-----------------------------------------------------------------#/
            // Theme supports wide images, galleries and videos.
            add_theme_support( 'align-wide' );
            
            add_editor_style('custom-editor-style.css');

            // Make specific theme colors available in the editor.
            add_theme_support( 'editor-color-palette', array(
                array(
                    'name'  => __( 'Light gray', 'mayosis' ),
                    'slug'  => 'light-gray',
                    'color'	=> '#f5f5f5',
                ),
                array(
                    'name'  => __( 'Medium gray', 'mayosis' ),
                    'slug'  => 'medium-gray',
                    'color' => '#999',
                ),
                array(
                    'name'  => __( 'Dark gray', 'mayosis' ),
                    'slug'  => 'dark-gray',
                    'color' => '#222a36',
                ),

                array(
                    'name'  => __( 'Purple', 'mayosis' ),
                    'slug'  => 'purple',
                    'color' => '#5a00f0',
                ),

                array(
                    'name'  => __( 'Dark Blue', 'mayosis' ),
                    'slug'  => 'dark-blue',
                    'color' => '#28375a',
                ),

                array(
                    'name'  => __( 'Red', 'mayosis' ),
                    'slug'  => 'red',
                    'color' => '#c44d58',
                ),

                array(
                    'name'  => __( 'Yellow', 'mayosis' ),
                    'slug'  => 'yellow',
                    'color' => '#ecca2e',
                ),

                array(
                    'name'  => __( 'Green', 'mayosis' ),
                    'slug'  => 'green',
                    'color' => '#64a500',
                ),

                array(
                    'name'  => __( 'White', 'mayosis' ),
                    'slug'  => 'white',
                    'color' => '#ffffff',
                ),
            ) );

            add_theme_support( 'editor-font-sizes', array(
                array(
                    'name' => __( 'Small', 'mayosis' ),
                    'size' => 14,
                    'slug' => 'small'
                ),
                array(
                    'name' => __( 'Normal', 'mayosis' ),
                    'size' => 16,
                    'slug' => 'normal'
                ),
                array(
                    'name' => __( 'Large', 'mayosis' ),
                    'size' => 26,
                    'slug' => 'large'
                ),
                array(
                    'name' => __( 'Huge', 'mayosis' ),
                    'size' => 36,
                    'slug' => 'huge'
                )
            ) );
            add_theme_support( 'wp-block-styles' );
            add_theme_support( 'editor-styles' );
            add_editor_style( 'style-editor.css' );
            add_theme_support( 'responsive-embeds' );
            add_theme_support( 'custom-units' );
            
            remove_theme_support( 'widgets-block-editor' );
           

        }
    }

    new mayosis_theme_setup;

}