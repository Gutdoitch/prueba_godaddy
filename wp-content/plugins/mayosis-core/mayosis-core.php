<?php

/**
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://teconce.com/about/
 * @since             1.0.0
 * @package           Mayosis_Core
 *
 * @wordpress-plugin
 * Plugin Name:       Mayosis Core
 * Plugin URI:        https://teconce.com
 * Description:      Use core plugin to extend theme all options.
 * Version:           4.6
 * Author:            Teconce Theme
 * Author URI:        https://teconce.com/about/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mayosis-core
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'MAYOSIS_CORE_VERSION', '4.6' );
define( 'MAYOSIS_CORE_PATH', plugin_dir_path( __FILE__ ));
define( 'MAYOSIS_CORE_URL',  plugin_dir_url( __FILE__ ));
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mayosis-core-activator.php
 */
function activate_mayosis_core() {
	require_once MAYOSIS_CORE_PATH . 'includes/class-mayosis-core-activator.php';
	Mayosis_Core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mayosis-core-deactivator.php
 */
function deactivate_mayosis_core() {
	require_once MAYOSIS_CORE_PATH . 'includes/class-mayosis-core-deactivator.php';
	Mayosis_Core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mayosis_core' );
register_deactivation_hook( __FILE__, 'deactivate_mayosis_core' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 
require MAYOSIS_CORE_PATH . 'includes/class-mayosis-core.php';


require MAYOSIS_CORE_PATH  .'library/edd-advanced.php';
require MAYOSIS_CORE_PATH  .'library/theme_customize.php';
require MAYOSIS_CORE_PATH  .'library/user-follow/user_follow.php';
require MAYOSIS_CORE_PATH  .'library/mayosis-custom-post.php';
require MAYOSIS_CORE_PATH  .'library/license-manager/mayosis-licensebox-options.php';
require MAYOSIS_CORE_PATH .'library/mayosis_options.php';
require MAYOSIS_CORE_PATH .'library/mayosis-presets.php';
require MAYOSIS_CORE_PATH  .'library/header-helper.php';
require MAYOSIS_CORE_PATH . 'library/extensions/ttc-ajax-filter/ttc-ajax-filter.php';
$megaebl= get_theme_mod( 'mega_menu_ebl','disable' );

if ($megaebl== 'enable'){
require MAYOSIS_CORE_PATH  .'library/extensions/mysf-framework/mysf-framework.php';
require MAYOSIS_CORE_PATH  .'library/mega-menu/mega-menu-options.php';


}
$filterebl = get_theme_mod('enable_dbl_filter','hide');
if ($filterebl== 'show'){
require MAYOSIS_CORE_PATH  .'library/extensions/mayosis-filter/mayosis-filter.php';
}


$productgalleryalt= get_theme_mod( 'product_gallery_options_alt','dflt' );
if ($productgalleryalt== 'alt'){
require MAYOSIS_CORE_PATH  .'library/acf-alt-gallery.php';
}

require MAYOSIS_CORE_PATH  .'public/class-post-options.php';
require MAYOSIS_CORE_PATH  .'public/class-product-options.php';
require MAYOSIS_CORE_PATH  .'public/class-misc-options.php';





// Include Kirki
require MAYOSIS_CORE_PATH  .'library/kirki/kirki.php';
require MAYOSIS_CORE_PATH  .'library/header-builder/header-builder-options/header-contain.php';
require MAYOSIS_CORE_PATH  .'library/header-builder/header-builder-panel.php';
require MAYOSIS_CORE_PATH  .'library/header-builder/builder-config.php';
require MAYOSIS_CORE_PATH  .'library/options-helper.php';
require MAYOSIS_CORE_PATH  .'library/theme-options/option-panel.php';

$nightmodedisable= get_theme_mod( 'sp_night_mode_ebl',  false);

if ($nightmodedisable == true){
// Include Night Mode
require MAYOSIS_CORE_PATH  .'library/extensions/sp-night-mode/sp-night-mode.php';
}



$disablehit= get_theme_mod( 'disable_hit_count','show' );

if ($disablehit== 'show'){
    include( MAYOSIS_CORE_PATH .'library/hit-counter/ajax-hits-counter.php');
}


require MAYOSIS_CORE_PATH  .'public/elementor/elementor-main.php';


$mayosis_custom_taxonomy = get_theme_mod( 'product_audio_taxonomoy','hide');
$pexmetacs = get_theme_mod('product_extra_meta_mcs','disable');
if ($mayosis_custom_taxonomy == 'show'){
    require MAYOSIS_CORE_PATH  .'library/mayosis-audio-taxonomy.php';
}

require MAYOSIS_CORE_PATH  .'admin/metabox/page.php';
require MAYOSIS_CORE_PATH  .'admin/metabox/page-color.php';
require MAYOSIS_CORE_PATH  .'admin/metabox/download-category.php';
require MAYOSIS_CORE_PATH  .'admin/metabox/menu_custom_fields.php';
require MAYOSIS_CORE_PATH  .'admin/metabox/category-metabox.php';

if ( is_plugin_active( 'woocommerce/woocommerce.php') ) {
require MAYOSIS_CORE_PATH  .'admin/metabox/woo-meta.php';
require MAYOSIS_CORE_PATH  .'public/widgets/woo-single-product-details.php';
require MAYOSIS_CORE_PATH  .'library/extensions/woo-stuffs/login.php';
require MAYOSIS_CORE_PATH  .'library/extensions/woo-stuffs/register.php';
//require MAYOSIS_CORE_PATH  .'library/extensions/woo-stuffs/class-downloadcountwoo.php';
require MAYOSIS_CORE_PATH  .'library/extensions/woo-stuffs/woo-functions.php';
require MAYOSIS_CORE_PATH  .'library/extensions/woo-live-search/product-search.php';

require MAYOSIS_CORE_PATH  .'public/widgets/coounter-woo.php';
require MAYOSIS_CORE_PATH  .'public/widgets/woo-product-release-info.php';
require MAYOSIS_CORE_PATH  .'public/widgets/woo_product_tags.php';
  if (class_exists('WeDevs_Dokan')) {
require MAYOSIS_CORE_PATH  .'public/widgets/woo_vendor.php';
}

  if (class_exists('Marketkingcore_Public')) {
require MAYOSIS_CORE_PATH  .'public/widgets/woo_vendor_marketking.php';
}

}

if ($pexmetacs== 'enable'){
require MAYOSIS_CORE_PATH  .'admin/metabox/edd-extra-meta.php';
}
include( MAYOSIS_CORE_PATH .'admin/shortcodes/mayosis-shortcode.php');

require MAYOSIS_CORE_PATH  .'public/widgets/mayosis-instagram-widget.php';
require MAYOSIS_CORE_PATH  .'public/widgets/search_widget.php';
require MAYOSIS_CORE_PATH  .'public/widgets/post-categories.php';
require MAYOSIS_CORE_PATH  .'public/widgets/about-us.php';
require MAYOSIS_CORE_PATH  .'public/widgets/subscribe.php';
require MAYOSIS_CORE_PATH  .'public/widgets/blog_tag.php';
require MAYOSIS_CORE_PATH  .'public/widgets/recent_post.php';
require MAYOSIS_CORE_PATH  .'public/widgets/recent-searches-widget.php';
require MAYOSIS_CORE_PATH  .'public/widgets/payment-icon.php';
require MAYOSIS_CORE_PATH  .'public/widgets/image-exif.php';
require MAYOSIS_CORE_PATH  .'public/widgets/social_widget.php';


if (class_exists('Easy_Digital_Downloads')):
   
    require MAYOSIS_CORE_PATH  .'public/widgets/product-details.php';
    require MAYOSIS_CORE_PATH  .'public/widgets/product-features.php';
    require MAYOSIS_CORE_PATH  .'public/widgets/product-release-info.php';
    require MAYOSIS_CORE_PATH  .'public/widgets/digital-recent-product.php';
    require MAYOSIS_CORE_PATH  .'public/widgets/product_tag.php';
    require MAYOSIS_CORE_PATH  .'public/widgets/download-filters.php';
    require MAYOSIS_CORE_PATH  .'public/widgets/product-additional-widget-pack.php';
    
    require MAYOSIS_CORE_PATH  .'public/widgets/counter.php';
   
    require MAYOSIS_CORE_PATH  .'admin/metabox/edd-features.php';
    require MAYOSIS_CORE_PATH  .'admin/metabox/edd-fonts.php';
    require MAYOSIS_CORE_PATH  .'admin/metabox/edd.php';
    $pgalleryalt= get_theme_mod( 'product_gallery_options_alt','dflt' );
     $ebookmeta= get_theme_mod( 'msv_ebook_meta','disable' );
    if ($ebookmeta=="enable"){
    require MAYOSIS_CORE_PATH  .'admin/metabox/edd-ebook.php';
    }
     if ($pgalleryalt=="alt"){
     require MAYOSIS_CORE_PATH  .'admin/metabox/edd-gallery-alt.php';
     } else {
         require MAYOSIS_CORE_PATH  .'admin/metabox/edd-gallery.php';
     }
    require MAYOSIS_CORE_PATH  .'library/edd-category-grid.php';
    require MAYOSIS_CORE_PATH  .'library/edd-category-carousel.php';
    require MAYOSIS_CORE_PATH  .'library/edd-category-list.php';
    require MAYOSIS_CORE_PATH  .'library/edd-management.php';
    require MAYOSIS_CORE_PATH  .'library/mayosis-edd-template.php';
    require MAYOSIS_CORE_PATH  .'library/user-profile/edd-user-profiles.php';
    require MAYOSIS_CORE_PATH  .'library/mayosis-hook.php';
    require MAYOSIS_CORE_PATH  .'library/assets-minification.php';
    require MAYOSIS_CORE_PATH  .'library/wave-audio/wave-standard.php';
    require MAYOSIS_CORE_PATH  .'library/wave-audio/wave-fixed-bar.php';
    require MAYOSIS_CORE_PATH  .'library/wave-audio/wave-audio-template.php';
    require MAYOSIS_CORE_PATH  .'library/wave-audio/wave-fixed-audio-template.php';
    require MAYOSIS_CORE_PATH  .'library/wave-audio/wave-wall-elementor.php';
    require MAYOSIS_CORE_PATH  .'library/wave-audio/wave-category-elementor.php';
 
     require MAYOSIS_CORE_PATH  .'library/extensions/mayosis-live-search/product-search.php';
     
    
    

    if (class_exists( 'EDD_Front_End_Submissions' ) ) {
        require MAYOSIS_CORE_PATH  .'public/widgets/downloads-author.php';
    }


    if (class_exists( 'EDD_All_Access' ) ) {
        require MAYOSIS_CORE_PATH  .'public/widgets/subscription.php';
        require MAYOSIS_CORE_PATH  .'public/widgets/subscription-package.php';

    }

endif;

if (class_exists( 'ESSB_Manager' ) ) {
    require MAYOSIS_CORE_PATH  .'library/easy-social-share.php';
    require MAYOSIS_CORE_PATH  .'library/easy-social-loactions.php';
}else{
    require MAYOSIS_CORE_PATH  .'library/social-share.php';

}

add_action( 'fes_load_fields_require', 'mayosis_fes_custom_fields' );
function mayosis_fes_custom_fields(){
    if ( class_exists( 'EDD_Front_End_Submissions' ) ){
        
         if ( version_compare( fes_plugin_version, '2.7.1', '==' ) ) {
              require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-gallery-new.php';
         } else {
                require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-gallery.php';
         }
        if ( version_compare( fes_plugin_version, '2.3', '>=' ) ) {
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-facebook.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-twitter.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-linkedin.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-behance.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-dribble.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-flicker.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-instagram.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-pinterest.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-address.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-demo.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-video.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-audio.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-version.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-cover.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-freelance.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-file-included.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-file-size.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-compatible.php';
            require MAYOSIS_CORE_PATH  .'public/fes-fields/fes-documentation.php';

            add_filter(  'fes_load_fields_array', 'mayosis_fes_metas', 10, 1 );
            function mayosis_fes_metas( $fields ){

                $fields['facebook_profile'] = 'FES_facebook_profile_Field';
                $fields['twitter_profile'] = 'FES_twitter_profile_Field';
                $fields['linkedin_profile'] = 'FES_linkedin_profile_Field';
                $fields['behance_profile'] = 'FES_behance_profile_Field';
                $fields['dribble_profile'] = 'FES_dribble_profile_Field';
                $fields['flicker_profile'] = 'FES_flicker_profile_Field';
                $fields['instagram_profile'] = 'FES_instagram_profile_Field';
                $fields['pinterest_profile'] = 'FES_pinterest_profile_Field';
                $fields['address'] = 'FES_address_Field';
                $fields['demo_link'] = 'FES_demo_link_Field';
                $fields['video_url'] = 'FES_video_url_Field';
                $fields['audio_url'] = 'FES_audio_url_Field';
                $fields['product_version'] = 'FES_product_version_Field';
                $fields['vdw_gallery_id'] = 'FES_vdw_gallery_id_Field';
                $fields['fes_cover_photo'] = 'FES_fes_cover_photo_Field';
                $fields['fes_author_available'] = 'FES_fes_author_available_Field';
                $fields['file_type'] = 'FES_file_type_Field';
                $fields['file_size'] = 'FES_file_size_Field';
                $fields['compatible_with'] = 'FES_compatible_with_Field';
                $fields['documentation'] = 'FES_documentation_Field';
                
                
                return $fields;

            }
        }
    }

}


// exclude from submission form in admin

add_filter( 'fes_templates_to_exclude_render_submission_form_admin',  'mayosis_fes_exclude' ,10, 1  );


function mayosis_fes_exclude( $fields ) {
    array_push( $fields, 'demo_link' );
    array_push( $fields, 'video_url' );
    array_push( $fields, 'audio_url' );
    array_push( $fields, 'file_type' );
    array_push( $fields, 'file_size' );
    array_push( $fields, 'compatible_with' );
    array_push( $fields, 'documentation' );
    array_push( $fields, 'product_version' );
    array_push( $fields, 'vdw_gallery_id' );
    return $fields;
}
if (class_exists('WPBakeryShortCode')):


    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_icon_box.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_theme_button.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_post.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_clients.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_theme_dual_button.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_theme_hero.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_subscribe.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_testimonial.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_pricing_table.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_vc_extend.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_search.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_counter.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_team.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_contact.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_licence.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_slider.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis_object_parallax.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/mayosis-modal.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/search_term.php';
    require MAYOSIS_CORE_PATH  .'public/vc-elements/before-after.php';





    if (class_exists('Easy_Digital_Downloads')):
        require MAYOSIS_CORE_PATH  .'public/vc-elements/edd_featured.php';
        require MAYOSIS_CORE_PATH  .'public/vc-elements/edd_recent.php';
        require MAYOSIS_CORE_PATH  .'public/vc-elements/edd_hero.php';
        require MAYOSIS_CORE_PATH  .'public/vc-elements/edd_recent_grid.php';
        require MAYOSIS_CORE_PATH  .'public/vc-elements/edd_login.php';
        require MAYOSIS_CORE_PATH  .'public/vc-elements/edd_register.php';
        require MAYOSIS_CORE_PATH  .'public/vc-elements/edd_justified_grid.php';
        require MAYOSIS_CORE_PATH  .'public/vc-elements/edd_masonary_grid.php';
        require MAYOSIS_CORE_PATH  .'public/vc-elements/edd_category_grid.php';
        require MAYOSIS_CORE_PATH  .'public/vc-elements/edd_popular.php';
        require MAYOSIS_CORE_PATH  .'public/vc-elements/edd_hero_block.php';


        if ( class_exists( 'EDD_Front_End_Submissions' ) ):
            require MAYOSIS_CORE_PATH  .'public/vc-elements/edd_author.php';
        endif;
    endif;

endif;





/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mayosis_core() {

	$plugin = new Mayosis_Core();
	$plugin->run();

}
run_mayosis_core();
