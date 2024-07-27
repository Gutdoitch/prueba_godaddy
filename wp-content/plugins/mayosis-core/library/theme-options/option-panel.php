<?php
$woo_plugin_path = trailingslashit( WP_PLUGIN_DIR ) . 'woocommerce/woocommerce.php';
include_once(dirname( __FILE__ ).'/global-colors/global-style.php'); 
include_once(dirname( __FILE__ ).'/global-colors/footer-color.php');  
include_once(dirname( __FILE__ ).'/global-colors/thumbnail-color.php'); 
include_once(dirname( __FILE__ ).'/global-colors/blog-style.php'); 
include_once(dirname( __FILE__ ).'/global-colors/widget-color.php'); 
include_once(dirname( __FILE__ ).'/global-colors/page-builder-color.php'); 
include_once(dirname( __FILE__ ).'/global-colors/button-style.php'); 
include_once(dirname( __FILE__ ).'/global-colors/input-color.php'); 
include_once(dirname( __FILE__ ).'/global-colors/popup-color.php'); 
include_once(dirname( __FILE__ ).'/template/tag-style.php'); 
include_once(dirname( __FILE__ ).'/footer/footer-options.php'); 
include_once(dirname( __FILE__ ).'/product-options/product-options.php'); 
if (class_exists('Easy_Digital_Downloads')){
include_once(dirname( __FILE__ ).'/template/product-template.php'); 

}
include_once(dirname( __FILE__ ).'/template/other-template.php'); 
if ( is_plugin_active( 'woocommerce/woocommerce.php') ) {
    include_once(dirname( __FILE__ ).'/woocommerce/woocommerce.php'); 
}
include_once(dirname( __FILE__ ).'/typography/typography.php'); 
include_once(dirname( __FILE__ ).'/white-label/white-label.php'); 
include_once(dirname( __FILE__ ).'/other-options/other-options.php'); 
if ( function_exists( 'bp_is_active' ) ) {
    include_once(dirname( __FILE__ ).'/buddypress/buddypress.php'); 
}

