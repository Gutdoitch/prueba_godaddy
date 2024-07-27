<?php
/**
 * Custom update handler for EDD extensions.
 * Forked from the EDD_SL_Updater class, but customized for EDD.
 *
 * @since 3.1.1.4
 * @package EDD
 */

namespace EDD\Extensions;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; // @codeCoverageIgnore

/**
 * Class Updater
 *
 * @package EDD\Extensions
 */
class Updater {

	/**
	 * The API data.
	 *
	 * @var array
	 */
	private $api_data = array();

	/**
	 * The plugin file.
	 *
	 * @var string
	 */
	private $plugin_file = '';

	/**
	 * The plugin name.
	 *
	 * @var string
	 */
	private $name = '';

	/**
	 * The plugin slug.
	 *
	 * @var string
	 */
	private $slug = '';

	/**
	 * The plugin version.
	 *
	 * @var string
	 */
	private $version = '';

	/**
	 * Whether to override WP's update check.
	 *
	 * @var bool
	 */
	private $wp_override = false;

	/**
	 * Whether to use the beta channel.
	 *
	 * @var bool
	 */
	private $beta = false;

	/**
	 * Class constructor.
	 *
	 * @uses plugin_basename()
	 * @uses hook()
	 *
	 * @param string $_plugin_file Path to the plugin file.
	 * @param array  $_api_data    Optional data to send with API calls.
	 */
	public function __construct( $_plugin_file, $_api_data = null ) {

		global $edd_plugin_data;

		$_plugin_file      = $this->get_plugin_file( $_plugin_file );
		$this->api_data    = $_api_data;
		$this->plugin_file = $_plugin_file;
		$this->name        = plugin_basename( $_plugin_file );
		$this->slug        = basename( dirname( $_plugin_file ) );
		$this->version     = $_api_data['version'];
		$this->wp_override = isset( $_api_data['wp_override'] ) ? (bool) $_api_data['wp_override'] : false;
		$this->beta        = ! empty( $this->api_data['beta'] ) ? true : false;

		$edd_plugin_data[ $this->slug ] = $this->api_data;

		// Set up hooks.
		$this->init();
	}

	/**
	 * Set up WordPress filters to hook into WP's update process.
	 *
	 * @uses add_filter()
	 *
	 * @return void
	 */
	public function init() {
		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_update' ) );
		add_filter( 'plugins_api', array( $this, 'plugins_api_filter' ), 10, 3 );
		add_action( 'after_plugin_row', array( $this, 'show_update_notification' ), 10, 2 );
		add_action( 'admin_init', array( $this, 'show_changelog' ) );
	}

	/**
	 * Check for Updates at the defined API endpoint and modify the update array.
	 *
	 * This function dives into the update API just when WordPress creates its update array,
	 * then adds a custom API call and injects the custom plugin data retrieved from the API.
	 * It is reassembled from parts of the native WordPress plugin update code.
	 * See wp-includes/update.php line 121 for the original wp_update_plugins() function.
	 *
	 * @uses api_request()
	 *
	 * @param array $_transient_data Update array build by WordPress.
	 * @return array Modified update array with custom plugin data.
	 */
	public function check_update( $_transient_data ) {

		if ( ! is_object( $_transient_data ) ) {
			$_transient_data = new \stdClass();
		}

		if ( ! empty( $_transient_data->response ) && ! empty( $_transient_data->response[ $this->name ] ) && false === $this->wp_override ) {
			return $_transient_data;
		}

		$current = $this->get_limited_data();
		if ( false !== $current && is_object( $current ) && isset( $current->new_version ) ) {
			if ( version_compare( $this->version, $current->new_version, '<' ) ) {
				$_transient_data->response[ $this->name ] = $current;
			} else {
				// Populating the no_update information is required to support auto-updates in WordPress 5.5.
				$_transient_data->no_update[ $this->name ] = $current;
			}
		}
		$_transient_data->last_checked           = time();
		$_transient_data->checked[ $this->name ] = $this->version;

		return $_transient_data;
	}

	/**
	 * Get repo API data from store.
	 * Save to cache.
	 *
	 * @return \stdClass
	 */
	public function get_repo_api_data() {
		$version_info = $this->get_cached_version_info();

		if ( false === $version_info ) {
			$version_info = $this->api_request(
				'plugin_latest_version',
				array(
					'slug' => $this->slug,
					'beta' => $this->beta,
				)
			);
			if ( ! $version_info ) {
				return false;
			}

			// This is required for your plugin to support auto-updates in WordPress 5.5.
			$version_info->plugin = $this->name;
			$version_info->id     = $this->name;
			$version_info->tested = $this->get_tested_version( $version_info );

			$this->set_version_info_cache( $version_info );
		}

		return $version_info;
	}

	/**
	 * Gets a limited set of data from the API response.
	 * This is used for the update_plugins transient.
	 *
	 * @since 3.2.10
	 * @return \stdClass|false
	 */
	private function get_limited_data() {
		$version_info = $this->get_repo_api_data();

		if ( ! $version_info ) {
			return false;
		}

		$limited_data               = new \stdClass();
		$limited_data->slug         = $this->slug;
		$limited_data->plugin       = $this->name;
		$limited_data->url          = $version_info->url;
		$limited_data->package      = $version_info->package;
		$limited_data->icons        = $this->convert_object_to_array( $version_info->icons );
		$limited_data->banners      = $this->convert_object_to_array( $version_info->banners );
		$limited_data->new_version  = $version_info->new_version;
		$limited_data->tested       = $version_info->tested;
		$limited_data->requires     = $version_info->requires;
		$limited_data->requires_php = $version_info->requires_php;

		return $limited_data;
	}

	/**
	 * Gets the plugin's tested version.
	 *
	 * @since 1.9.2
	 * @param object $version_info The version info.
	 * @return null|string
	 */
	private function get_tested_version( $version_info ) {

		// There is no tested version.
		if ( empty( $version_info->tested ) ) {
			return null;
		}

		// Strip off extra version data so the result is x.y or x.y.z.
		list( $current_wp_version ) = explode( '-', get_bloginfo( 'version' ) );

		// The tested version is greater than or equal to the current WP version, no need to do anything.
		if ( version_compare( $version_info->tested, $current_wp_version, '>=' ) ) {
			return $version_info->tested;
		}
		$current_version_parts = explode( '.', $current_wp_version );
		$tested_parts          = explode( '.', $version_info->tested );

		// The current WordPress version is x.y.z, so update the tested version to match it.
		if ( isset( $current_version_parts[2] ) && $current_version_parts[0] === $tested_parts[0] && $current_version_parts[1] === $tested_parts[1] ) {
			$tested_parts[2] = $current_version_parts[2];
		}

		return implode( '.', $tested_parts );
	}

	/**
	 * Show the update notification on multisite subsites.
	 *
	 * @param string $file   The plugin file.
	 * @param array  $plugin The plugin data.
	 */
	public function show_update_notification( $file, $plugin ) {

		// Return early if in the network admin, or if this is not a multisite install.
		if ( is_network_admin() || ! is_multisite() ) {
			return;
		}

		// Allow single site admins to see that an update is available.
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		if ( $this->name !== $file ) {
			return;
		}

		// Do not print any message if update does not exist.
		$update_cache = get_site_transient( 'update_plugins' );

		if ( ! isset( $update_cache->response[ $this->name ] ) ) {
			if ( ! is_object( $update_cache ) ) {
				$update_cache = new \stdClass();
			}
			$update_cache->response[ $this->name ] = $this->get_repo_api_data();
		}

		// Return early if this plugin isn't in the transient->response or if the site is running the current or newer version of the plugin.
		if ( empty( $update_cache->response[ $this->name ] ) || version_compare( $this->version, $update_cache->response[ $this->name ]->new_version, '>=' ) ) {
			return;
		}

		printf(
			'<tr class="plugin-update-tr %3$s" id="%1$s-update" data-slug="%1$s" data-plugin="%2$s">',
			$this->slug,
			$file,
			in_array( $this->name, $this->get_active_plugins(), true ) ? 'active' : 'inactive'
		);

		echo '<td colspan="3" class="plugin-update colspanchange">';
		echo '<div class="update-message notice inline notice-warning notice-alt"><p>';

		$changelog_link = '';
		if ( ! empty( $update_cache->response[ $this->name ]->sections->changelog ) ) {
			$changelog_link = add_query_arg(
				array(
					'edd_sl_action' => 'view_plugin_changelog',
					'plugin'        => urlencode( $this->name ),
					'slug'          => urlencode( $this->slug ),
					'TB_iframe'     => 'true',
					'width'         => 77,
					'height'        => 911,
				),
				self_admin_url( 'index.php' )
			);
		}
		$update_link = add_query_arg(
			array(
				'action' => 'upgrade-plugin',
				'plugin' => urlencode( $this->name ),
			),
			self_admin_url( 'update.php' )
		);

		printf(
			/* translators: the plugin name. */
			esc_html__( 'There is a new version of %1$s available.', 'easy-digital-downloads' ),
			esc_html( $plugin['Name'] )
		);

		if ( ! current_user_can( 'update_plugins' ) ) {
			echo ' ';
			esc_html_e( 'Contact your network administrator to install the update.', 'easy-digital-downloads' );
		} elseif ( empty( $update_cache->response[ $this->name ]->package ) && ! empty( $changelog_link ) ) {
			echo ' ';
			printf(
				/* translators: 1: opening anchor tag, do not translate 2. the new plugin version 3. closing anchor tag, do not translate. */
				__( '%1$sView version %2$s details%3$s.', 'easy-digital-downloads' ),
				'<a target="_blank" class="thickbox open-plugin-details-modal" href="' . esc_url( $changelog_link ) . '">',
				esc_html( $update_cache->response[ $this->name ]->new_version ),
				'</a>'
			);
		} elseif ( ! empty( $changelog_link ) ) {
			echo ' ';
			printf(
				/* translators: 1: opening anchor tag, do not translate 2. the new plugin version 3. closing anchor tag, do not translate 4. opening anchor tag, do not translate 5. closing anchor tag, do not translate. */
				__( '%1$sView version %2$s details%3$s or %4$supdate now%5$s.', 'easy-digital-downloads' ),
				'<a target="_blank" class="thickbox open-plugin-details-modal" href="' . esc_url( $changelog_link ) . '">',
				esc_html( $update_cache->response[ $this->name ]->new_version ),
				'</a>',
				'<a target="_blank" class="update-link" href="' . esc_url( wp_nonce_url( $update_link, 'upgrade-plugin_' . $file ) ) . '">',
				'</a>'
			);
		} else {
			printf(
				' %1$s%2$s%3$s',
				'<a target="_blank" class="update-link" href="' . esc_url( wp_nonce_url( $update_link, 'upgrade-plugin_' . $file ) ) . '">',
				esc_html__( 'Update now.', 'easy-digital-downloads' ),
				'</a>'
			);
		}

		do_action( "in_plugin_update_message-{$file}", $plugin, $plugin ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores

		echo '</p></div></td></tr>';
	}

	/**
	 * Gets the plugins active in a multisite network.
	 *
	 * @return array
	 */
	private function get_active_plugins() {
		$active_plugins         = (array) get_option( 'active_plugins' );
		$active_network_plugins = (array) get_site_option( 'active_sitewide_plugins' );

		return array_merge( $active_plugins, array_keys( $active_network_plugins ) );
	}

	/**
	 * Updates information on the "View version x.x details" page with custom data.
	 *
	 * @uses api_request()
	 *
	 * @param mixed  $_data   The default data.
	 * @param string $_action The requested action.
	 * @param object $_args   The Plugin API arguments.
	 * @return object $_data
	 */
	public function plugins_api_filter( $_data, $_action = '', $_args = null ) {

		if ( 'plugin_information' !== $_action ) {
			return $_data;
		}

		if ( ! isset( $_args->slug ) || ( $_args->slug !== $this->slug ) ) {
			return $_data;
		}

		$to_send = array(
			'slug'   => $this->slug,
			'is_ssl' => is_ssl(),
			'fields' => array(
				'banners' => array(),
				'reviews' => false,
				'icons'   => array(),
			),
		);

		// Get the transient where we store the api request for this plugin for 24 hours.
		$edd_api_request_transient = $this->get_cached_version_info();

		// If we have no transient-saved value, run the API, set a fresh transient with the API value, and return that value too right now.
		if ( empty( $edd_api_request_transient ) ) {

			$api_response = $this->api_request( 'plugin_information', $to_send );

			// Expires in 3 hours.
			$this->set_version_info_cache( $api_response );

			if ( false !== $api_response ) {
				$_data = $api_response;
			}
		} else {
			$_data = $edd_api_request_transient;
		}

		// Convert sections into an associative array, since we're getting an object, but Core expects an array.
		if ( isset( $_data->sections ) && ! is_array( $_data->sections ) ) {
			$_data->sections = $this->convert_object_to_array( $_data->sections );
		}

		// Convert banners into an associative array, since we're getting an object, but Core expects an array.
		if ( isset( $_data->banners ) && ! is_array( $_data->banners ) ) {
			$_data->banners = $this->convert_object_to_array( $_data->banners );
		}

		// Convert icons into an associative array, since we're getting an object, but Core expects an array.
		if ( isset( $_data->icons ) && ! is_array( $_data->icons ) ) {
			$_data->icons = $this->convert_object_to_array( $_data->icons );
		}

		// Convert contributors into an associative array, since we're getting an object, but Core expects an array.
		if ( isset( $_data->contributors ) && ! is_array( $_data->contributors ) ) {
			$_data->contributors = $this->convert_object_to_array( $_data->contributors );
		}

		if ( ! isset( $_data->plugin ) ) {
			$_data->plugin = $this->name;
		}

		if ( ! isset( $_data->version ) && ! empty( $_data->new_version ) ) {
			$_data->version = $_data->new_version;
		}

		return $_data;
	}

	/**
	 * Convert some objects to arrays when injecting data into the update API
	 *
	 * Some data like sections, banners, and icons are expected to be an associative array, however due to the JSON
	 * decoding, they are objects. This method allows us to pass in the object and return an associative array.
	 *
	 * @since 3.6.5
	 *
	 * @param stdClass $data The data to convert.
	 *
	 * @return array
	 */
	private function convert_object_to_array( $data ) {
		if ( ! is_array( $data ) && ! is_object( $data ) ) {
			return array();
		}
		$new_data = array();
		foreach ( $data as $key => $value ) {
			$new_data[ $key ] = is_object( $value ) ? $this->convert_object_to_array( $value ) : $value;
		}

		return $new_data;
	}

	/**
	 * Calls the API and, if successfull, returns the object delivered by the API.
	 *
	 * @uses get_bloginfo()
	 * @uses wp_remote_get()
	 * @uses is_wp_error()
	 *
	 * @param string $_action The requested action.
	 * @param array  $_data   Parameters for the API action.
	 * @return false|object
	 */
	private function api_request( $_action, $_data ) {
		$data = array_merge( $this->api_data, $_data );

		if ( $data['slug'] !== $this->slug ) {
			return false;
		}

		return $this->get_version_from_remote();
	}

	/**
	 * If available, show the changelog for sites in a multisite install.
	 */
	public function show_changelog() {

		if ( empty( $_REQUEST['edd_sl_action'] ) || 'view_plugin_changelog' !== $_REQUEST['edd_sl_action'] ) {
			return;
		}

		if ( empty( $_REQUEST['plugin'] ) ) {
			return;
		}

		if ( empty( $_REQUEST['slug'] ) || $this->slug !== $_REQUEST['slug'] ) {
			return;
		}

		if ( ! current_user_can( 'update_plugins' ) ) {
			wp_die( esc_html__( 'You do not have permission to install plugin updates', 'easy-digital-downloads' ), esc_html__( 'Error', 'easy-digital-downloads' ), array( 'response' => 403 ) );
		}

		$version_info = $this->get_repo_api_data();
		if ( isset( $version_info->sections ) ) {
			$sections = $this->convert_object_to_array( $version_info->sections );
			if ( ! empty( $sections['changelog'] ) ) {
				echo '<div style="background:#fff;padding:10px;">' . wp_kses_post( $sections['changelog'] ) . '</div>';
			}
		}

		exit;
	}

	/**
	 * Gets the current version information from the remote site.
	 *
	 * @return array|false
	 */
	private function get_version_from_remote() {

		$api_handler                              = new \EDD\Licensing\API();
		$api_handler->should_check_failed_request = true;
		$request                                  = $api_handler->make_request( $this->get_api_params() );
		if ( ! $request ) {
			return false;
		}

		if ( isset( $request->sections ) ) {
			$request->sections = maybe_unserialize( $request->sections );
		}

		if ( isset( $request->banners ) ) {
			$request->banners = maybe_unserialize( $request->banners );
		}

		if ( isset( $request->icons ) ) {
			$request->icons = maybe_unserialize( $request->icons );
		}

		if ( ! empty( $request->sections ) ) {
			foreach ( $request->sections as $key => $section ) {
				$request->$key = (array) $section;
			}
		}

		return $request;
	}

	/**
	 * Get the version info from the cache, if it exists.
	 *
	 * @param string $cache_key The cache key.
	 * @return object
	 */
	public function get_cached_version_info( $cache_key = '' ) {

		if ( empty( $cache_key ) ) {
			$cache_key = $this->get_cache_key();
		}

		$cache = get_option( $cache_key );

		// Cache is expired.
		if ( empty( $cache['timeout'] ) || time() > $cache['timeout'] ) {
			return false;
		}

		// We need to turn the icons into an array, thanks to WP Core forcing these into an object at some point.
		$cache['value'] = json_decode( $cache['value'] );
		if ( ! empty( $cache['value']->icons ) ) {
			$cache['value']->icons = (array) $cache['value']->icons;
		}

		return $cache['value'];
	}

	/**
	 * Adds the plugin version information to the database.
	 *
	 * @param string|\stdClass $value     The value to store.
	 * @param string           $cache_key The cache key.
	 */
	public function set_version_info_cache( $value = '', $cache_key = '' ) {

		if ( empty( $cache_key ) ) {
			$cache_key = $this->get_cache_key();
		}

		$data = array(
			'timeout' => strtotime( '+3 hours', time() ),
			'value'   => wp_json_encode( $value ),
		);

		update_option( $cache_key, $data, false );
	}

	/**
	 * Gets the parameters for the API request.
	 *
	 * @since 3.1.1.4
	 * @return array
	 */
	private function get_api_params() {
		return array(
			'edd_action'                     => 'get_version',
			'license'                        => ! empty( $this->api_data['license'] ) ? $this->api_data['license'] : '',
			'item_id'                        => isset( $this->api_data['item_id'] ) ? $this->api_data['item_id'] : false,
			'version'                        => isset( $this->api_data['version'] ) ? $this->api_data['version'] : false,
			'slug'                           => $this->slug,
			'beta'                           => $this->beta,
			'php_version'                    => phpversion(),
			'wp_version'                     => get_bloginfo( 'version' ),
			'easy-digital-downloads_version' => EDD_VERSION,
		);
	}

	/**
	 * Gets the unique key (option name) for a plugin.
	 *
	 * @since 1.9.0
	 * @return string
	 */
	private function get_cache_key() {
		$string = $this->slug . $this->api_data['license'] . $this->beta;

		return 'edd_sl_' . md5( serialize( $string ) );
	}

	/**
	 * Gets the plugin file. This is to correct an incorrect plugin file passed by Stripe 3.0.0 and 3.0.1.
	 *
	 * @since 3.2.2
	 * @param string $file The plugin file.
	 * @return string
	 */
	private function get_plugin_file( $file ) {

		// Return the file if it's not the Stripe plugin with the wrong file.
		if ( false === strpos( $file, 'functions.php' ) ) {
			return $file;
		}

		// Replace the incorrect file path and return the correct string.
		if ( false !== strpos( $file, 'edd-stripe/includes/functions.php' ) ) {
			return str_replace( 'includes/functions.php', 'edd-stripe.php', $file );
		}

		// Otherwise, return the file as is.
		return $file;
	}
}
