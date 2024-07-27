<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'Sp_Night_Mode', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sp-night-mode-activator.php
 */
function activate_sp_night_mode() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sp-night-mode-activator.php';
	Sp_Night_Mode_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sp-night-mode-deactivator.php
 */
function deactivate_sp_night_mode() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sp-night-mode-deactivator.php';
	Sp_Night_Mode_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sp_night_mode' );
register_deactivation_hook( __FILE__, 'deactivate_sp_night_mode' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sp-night-mode.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sp_night_mode() {

	$plugin = new Sp_Night_Mode();
	$plugin->run();

}
run_sp_night_mode();
