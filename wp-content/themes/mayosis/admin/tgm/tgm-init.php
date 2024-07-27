<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */


add_action( 'tgmpa_register', 'mayosis_register_required_plugins' );
          
function mayosis_register_required_plugins() {
if (class_exists('woocommerce')){
    
    $plugins = array(
	    
		array(
			'name'      => esc_html__('Elementor','mayosis'),
			'slug'      => 'elementor',
			'required'  => true,
		),
		array(
            'name'      => esc_html__('Custom Field Pro', 'mayosis'),
            'slug'      => 'advanced-custom-fields-pro',
             'source'    => 'https://plugins-hosted.nyc3.cdn.digitaloceanspaces.com/advanced-custom-fields-pro.zip',
            'required'  => true,
             'version'   => '6.0.7',
		),
		
		array(
            'name'      => esc_html__('Easy Social Share', 'mayosis'),
            'slug'      => 'easy-social-share',
			'source'    => 'https://plugins-hosted.nyc3.cdn.digitaloceanspaces.com/easy-social-share-buttons3.zip',
            'required'  => false,
            'version'   => '8.8',
		),
		
		 array(
            'name'      => esc_html__('WooCommerce', 'mayosis'),
            'slug'      => 'woocommerce',
            'required'  => true,
            'version'   => '8.4.0',
		),
	
		 array(
            'name'      => esc_html__('Mayosis  Core', 'mayosis'),
            'slug'      => 'mayosis-core',
			'source'    =>'https://plugins-hosted.nyc3.cdn.digitaloceanspaces.com/mayosis-core.zip',
            'required'  => true,
            'version'   => '4.6',
		),
		
		
		array(
			'name'      => esc_html__('Contact Form 7','mayosis'),
			'slug'      => 'contact-form-7',
			'required'  => true,
		),
		
		
		
);

} elseif (class_exists('Easy_Digital_Downloads')){
    
    	$plugins = array(
	    
		array(
			'name'      => esc_html__('Elementor','mayosis'),
			'slug'      => 'elementor',
			'required'  => true,
		),
		array(
            'name'      => esc_html__('Custom Field Pro', 'mayosis'),
            'slug'      => 'advanced-custom-fields-pro',
             'source'    => 'https://plugins-hosted.nyc3.cdn.digitaloceanspaces.com/advanced-custom-fields-pro.zip',
            'required'  => true,
             'version'   => '6.0.7',
		),
		
		array(
            'name'      => esc_html__('Easy Social Share', 'mayosis'),
            'slug'      => 'easy-social-share',
			'source'    => 'https://plugins-hosted.nyc3.cdn.digitaloceanspaces.com/easy-social-share-buttons3.zip',
            'required'  => false,
            'version'   => '8.8',
		),
	
		array(
			'name'      => esc_html__('Easy Digital Download','mayosis'),
			'slug'      => 'easy-digital-downloads',
			'required'  => true,
		),
		
			array(
            'name'               => esc_html__('EDD Featured', 'mayosis'),
            'slug'               => 'edd-featured-downloads',
            'required'           => true,
        ),
        
        
        	array(
			'name'      => esc_html__('Fontier Font Preview','mayosis'),
			'slug'      => 'fontier',
			'required'  => false,
		),
		
	
		
		 array(
            'name'      => esc_html__('Mayosis  Core', 'mayosis'),
            'slug'      => 'mayosis-core',
			'source'    =>'https://plugins-hosted.nyc3.cdn.digitaloceanspaces.com/mayosis-core.zip',
            'required'  => true,
            'version'   => '4.6',
		),
		
		
		array(
			'name'      => esc_html__('Contact Form 7','mayosis'),
			'slug'      => 'contact-form-7',
			'required'  => true,
		),
		
		
		
);
    
} else {

	$plugins = array(
	    
		array(
			'name'      => esc_html__('Elementor','mayosis'),
			'slug'      => 'elementor',
			'required'  => true,
		),
		array(
            'name'      => esc_html__('Custom Field Pro', 'mayosis'),
            'slug'      => 'advanced-custom-fields-pro',
             'source'    => 'https://plugins-hosted.nyc3.cdn.digitaloceanspaces.com/advanced-custom-fields-pro.zip',
            'required'  => true,
             'version'   => '6.0.7',
		),
		
		array(
            'name'      => esc_html__('Easy Social Share', 'mayosis'),
            'slug'      => 'easy-social-share',
			'source'    => 'https://plugins-hosted.nyc3.cdn.digitaloceanspaces.com/easy-social-share-buttons3.zip',
            'required'  => false,
            'version'   => '8.8',
		),
	
		array(
			'name'      => esc_html__('Easy Digital Download','mayosis'),
			'slug'      => 'easy-digital-downloads',
			'required'  => true,
		),
		
			array(
            'name'               => esc_html__('EDD Featured', 'mayosis'),
            'slug'               => 'edd-featured-downloads',
            'required'           => true,
        ),
        
        array(
            'name'      => esc_html__('WooCommerce', 'mayosis'),
            'slug'      => 'woocommerce',
            'required'  => true,
            'version'   => '8.4.0',
		),
	
        
        
        	array(
			'name'      => esc_html__('Fontier Font Preview','mayosis'),
			'slug'      => 'fontier',
			'required'  => false,
		),
		
	
		
		 array(
            'name'      => esc_html__('Mayosis  Core', 'mayosis'),
            'slug'      => 'mayosis-core',
			'source'    =>'https://plugins-hosted.nyc3.cdn.digitaloceanspaces.com/mayosis-core.zip',
            'required'  => true,
            'version'   => '4.6',
		),
		
		
		array(
			'name'      => esc_html__('Contact Form 7','mayosis'),
			'slug'      => 'contact-form-7',
			'required'  => true,
		),
		
		
		
);
}
	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'mayosis-required-plugins', 			// Menu slug.
		'parent_slug'  => 'admin.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

function mayosis_plugins_menu_args($args) {
    $args['parent_slug'] = 'mayosis-admin-menu';
    return $args;
}

add_filter( 'tgmpa_admin_menu_args', 'mayosis_plugins_menu_args' );