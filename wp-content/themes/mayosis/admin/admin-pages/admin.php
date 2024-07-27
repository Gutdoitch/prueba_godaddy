<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $pagenow;
function mayosis_welcome_page(){
    require_once 'mayosis-welcome.php';
}

function mayosis_license_page(){
    require_once 'mayosis_license_page.php';
}

function mayosis_recommandation_page(){
    require_once 'mayosis_recommandation.php';
}

function teconce_themes_page(){
    require_once 'mayosis_themes.php';
}


function mayosis_admin_menu(){
    if ( current_user_can( 'edit_theme_options' ) ) {
        add_menu_page( 'Mayosis', 'Mayosis', 'administrator', 'mayosis-admin-menu', 'mayosis_welcome_page',  MAYOSIS_THEMEPATH .'/images/icon.svg', 4 );
        add_submenu_page( 'mayosis-admin-menu', 'mayosis', esc_html__('Welcome','mayosis'), 'administrator', 'mayosis-admin-menu', 'mayosis_welcome_page' );
         add_submenu_page('mayosis-admin-menu', '', 'Theme Options', 'manage_options', 'customize.php' );
      
         add_submenu_page( 'mayosis-admin-menu', esc_html__( 'Demo Import', 'mayosis' ), esc_html__( 'Demo Import', 'mayosis' ), 'administrator', 'demo_install', 'demo_install_function' );
         
         add_submenu_page('mayosis-admin-menu', '', 'Start Wizard', 'manage_options', 'mayosis-wizard','widzard_install_function' );
         
         add_submenu_page('mayosis-admin-menu', '', 'Other Themes', 'manage_options', 'teconce-themes','teconce_themes_page' );
        
         add_submenu_page('mayosis-admin-menu', '', 'Recommandations', 'manage_options', 'mayosis-recommandation','mayosis_recommandation_page' );
     
    }
}

add_action( 'admin_menu', 'mayosis_admin_menu' );
  
function demo_install_function(){
    $url = admin_url().'admin.php?page=mayosis-wizard&step=content';
    ?>
    <script>location.href='<?php echo esc_html($url);?>'.replace(/\&amp\;/gi, "&");</script>
    <?php
  }
  
  function widzard_install_function(){
    $url = admin_url().'themes.php?page=mayosis-wizard';
    ?>
    <script>location.href='<?php echo esc_url($url);?>';</script>
    <?php
  }
  
if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

	wp_redirect(admin_url("admin.php?page=mayosis-admin-menu"));
	exit;
	
}