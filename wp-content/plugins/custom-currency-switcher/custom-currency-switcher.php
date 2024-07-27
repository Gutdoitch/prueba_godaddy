<?php
/** 
* Plugin Name: Custom Currency Switcher
* Plugin URI: http://magnigenie.com
* Description: A small light weight plugin for Currency Switcher.
* Version: 1.0
* Author: Magnigenie
* Author URI: http://magnigenie.com
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: currencyswitcher
* Domain path: languages
* WC tested upto: 8.1.9
*/

// No direct file access
if (!defined('ABSPATH')) {
    exit;
}

// Load the main class
require_once(plugin_dir_path(__FILE__) . 'class-custom-currency-switcher.php');