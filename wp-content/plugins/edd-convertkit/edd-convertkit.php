<?php
/**
 * Plugin Name: Easy Digital Downloads - ConvertKit
 * Plugin URI: https://easydigitaldownloads.com/downloads/convertkit
 * Description: Subscribe your customers to ConvertKit forms during purchase.
 * Version: 1.0.10
 * Author: Easy Digital Downloads
 * Author URI: https://easydigitaldownloads.com/
 */


define( 'EDD_CONVERTKIT_PATH', dirname( __FILE__ ) );

if ( ! defined( 'EDDCONVERTKIT_VERSION' ) ) {
	define( 'EDDCONVERTKIT_VERSION', '1.0.10' );
}

require_once EDD_CONVERTKIT_PATH . '/vendor/autoload.php';
\EDD\ExtensionUtils\v1\ExtensionLoader::loadOrQuit(
	__FILE__,
	function() {
		if ( ! class_exists( 'EDD_ConvertKit' ) ) {
			include EDD_CONVERTKIT_PATH . '/includes/class-edd-convertkit.php';
		}

		// @todo Remove class_exists and EDD_License checks when minimum EDD version is >= 2.11.4
		if ( class_exists( '\\EDD\\Extensions\\ExtensionRegistry' ) ) {
			add_action(
				'edd_extension_license_init',
				function( \EDD\Extensions\ExtensionRegistry $registry ) {
					$registry->addExtension( __FILE__, 'ConvertKit', 648002, EDDCONVERTKIT_VERSION );
				}
			);
		} elseif ( class_exists( 'EDD_License' ) ) {
			new EDD_License( __FILE__, 'ConvertKit', EDDCONVERTKIT_VERSION, 'Easy Digital Downloads', null, null, 648002 );
		}

		EDD_ConvertKit::instance()->init();
	},
	array(
		'php'                    => '5.3',
		'easy-digital-downloads' => '2.9',
	)
);
