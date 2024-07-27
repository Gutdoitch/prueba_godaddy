<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/markoarula
 * @since      1.0.0
 *
 * @package    Sp_Night_Mode
 * @subpackage Sp_Night_Mode/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sp_Night_Mode
 * @subpackage Sp_Night_Mode/public
 * @author     Marko Arula <marko.arula21@gmail.com>
 */
class Sp_Night_Mode_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function sp_night_mode_enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sp_Night_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sp_Night_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( is_rtl() ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sp-night-mode-public-rtl.css', array(), $this->version, 'all' );
		} else {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sp-night-mode-public.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function sp_night_mode_enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sp_Night_Mode_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sp_Night_Mode_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        $plugin_admin = new Sp_Night_Mode_Admin( $this->plugin_name, $this->version );
        $button_html = $plugin_admin->sp_night_mode_shortcode( '' );
        $sp_night_mode_default =  get_theme_mod('sp_night_mode_default');

        // print_r('time()');
        // print_r(time());

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sp-night-mode-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'wpnmObject', array(
            'button_html' => $button_html,
            'default' => $sp_night_mode_default,
            'server_time' => time(),
            'turn_on_time' => strtotime( get_theme_mod('sp_night_mode_turn_on_time') ),
            'turn_off_time' => strtotime( get_theme_mod('sp_night_mode_turn_off_time') ),
        ) );

	}

	/**
	 * Add classes to body.
	 *
	 * @since    1.0.0
	 */
	public function sp_night_mode_body_classes( $classes ) {

		$sp_night_mode = isset( $_COOKIE['wpNightMode'] ) ? $_COOKIE['wpNightMode'] : '';

	    if ( 'true' === $sp_night_mode ) {
	        $classes[] = 'sp-night-mode-on';
	    }

	    return $classes;

	}

	/**
	 * Customizer CSS.
	 *
	 * @since    1.0.0
	 */
	public function sp_night_mode_customizer_css() {


		$toggle_size_css = '';
	     $dc_main_bg = get_theme_mod( 'site_bg_color_dark' );
	     $dc_alt_bg = get_theme_mod( 'dark_alter_color' );

		$output_css =
		' ' . $toggle_size_css . '
			.sp-night-mode-slider {
				background-color: ' . get_theme_mod('sp_night_mode_toggle_off_color', '') . ';
			}

			.sp-night-mode-button.active .sp-night-mode-slider {
				background-color: ' . get_theme_mod('sp_night_mode_toggle_on_color', '') . ';
			}

			body.sp-night-mode-on,
			body.sp-night-mode-on .has_saasplate_dark_bg{
				background: ' . $dc_main_bg . ' !important;
			}
			
				body.sp-night-mode-on .has_saasplate_dark_alt_bg,
				body.sp-night-mode-on .has_saasplate_dark_sec_bg.xpcs-header,
				body.sp-night-mode-on .tctz-default-thm-blog,
				body.sp-night-mode-on .widget,
				body.sp-night-mode-on .has_saasplate_elementor_inner_bg .elementor-widget-wrap,
				body.sp-night-mode-on #saasplate-hero-banner,
				body.sp-night-mode-on .sgl-left-content i,
				body.sp-night-mode-on .wp-block-quote,
				body.sp-night-mode-on .saasplate-tags-sgl ul li a,
				body.sp-night-mode-on .saasplate-post-nav-ds a,
				body.sp-night-mode-on .mobile--nav-menu,
				body.sp-night-mode-on .mayosis-woo-related-products{
				background-color: ' .$dc_alt_bg. ' !important;
			}

			body.sp-night-mode-on .customize-partial-edit-shortcut button,
			body.sp-night-mode-on .customize-partial-edit-shortcut button svg,
			body.sp-night-mode-on #adminbarsearch,
			body.sp-night-mode-on span.display-name,
			body.sp-night-mode-on span.ab-icon,
			body.sp-night-mode-on span.ab-label {
			    background: transparent;
			}

			body.sp-night-mode-on *,
			body.sp-night-mode-on h1,
			body.sp-night-mode-on h2,
			body.sp-night-mode-on h3,
			body.sp-night-mode-on h4,
			body.sp-night-mode-on h5,
			body.sp-night-mode-on h6,
			body.sp-night-mode-on .sidebar-details h3 a{
				color: ' .  get_theme_mod('site_txt_color_dark', '#fff') . ' !important;
			}
            
			body.sp-night-mode-on a {
				color: ' . get_theme_mod('site_link_color_dark', '') . ';
			}

			body.sp-night-mode-on a:hover,
			body.sp-night-mode-on a:visited,
			body.sp-night-mode-on a:active {
				color: ' . get_theme_mod('site_link_hvr_color_dark', ''). ';
			}
			
			body.sp-night-mode-on input[type="text"], 
			body.sp-night-mode-on input[type="email"],
			body.sp-night-mode-on input[type="url"], 
			body.sp-night-mode-on input[type="password"], 
			body.sp-night-mode-on input[type="search"], 
			body.sp-night-mode-on input[type="number"], 
			body.sp-night-mode-on input[type="tel"], 
			body.sp-night-mode-on input[type="range"],
			body.sp-night-mode-on input[type="date"],
			body.sp-night-mode-on input[type="month"],
			body.sp-night-mode-on input[type="week"],
			body.sp-night-mode-on input[type="time"], 
			body.sp-night-mode-on input[type="datetime"],
			body.sp-night-mode-on input[type="datetime-local"],
			body.sp-night-mode-on input[type="color"],
			body.sp-night-mode-on select, 
			body.sp-night-mode-on textarea,
			body.sp-night-mode-on .select2-container--default .select2-selection--single,
			body.sp-night-mode-on select.lable-form-all{
			    background: ' .  get_theme_mod('dark_input_color', ''). ';
			    border-color: ' .  get_theme_mod('dark_input_border_color', ''). ';
			    color: ' . get_theme_mod('dark_input_text_color', '') . ';
			}
		}';

		?>
			<style type="text/css">
				<?php echo $output_css; ?>
				@media (prefers-color-scheme: dark) {
					<?php echo $output_css; ?>
				}
			</style>
		<?php
	}

}
