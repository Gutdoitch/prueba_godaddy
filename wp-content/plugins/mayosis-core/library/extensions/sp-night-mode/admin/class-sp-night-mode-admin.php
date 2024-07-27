<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/markoarula
 * @since      1.0.0
 *
 * @package    Sp_Night_Mode
 * @subpackage Sp_Night_Mode/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sp_Night_Mode
 * @subpackage Sp_Night_Mode/admin
 * @author     Marko Arula <marko.arula21@gmail.com>
 */
class Sp_Night_Mode_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sp-night-mode-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sp-night-mode-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add Shortcode
	 *
	 * @since    1.0.0
	 */
	public function sp_night_mode_shortcode( $atts ) {

        $button_style = '';
        $active_class = '';
        $sp_night_mode = isset( $_COOKIE['wpNightMode'] ) ? $_COOKIE['wpNightMode'] : '';
        $atts = shortcode_atts( array(
            'style' => '',
        ), $atts, 'sp-night-mode-button' );

        if ( '' != $atts['style'] ) {
            $button_style = $atts['style'];
        } else {
            $button_style = get_theme_mod('sp_night_mode_toggle_style','1');
        }

        if ( 'true' == $sp_night_mode ) {
		  $active_class = ' active';
        }

        switch ( $button_style ) {
            case '1':
                return '<div class="wpnm-button style-1'.$active_class.'">
                            <div class="wpnm-slider round"></div>
                        </div>';
                break;
            case '2':
                return '<div class="wpnm-button style-2'.$active_class.'">
                            <div class="wpnm-button-inner-left"></div>
                            <div class="wpnm-button-inner"></div>
                        </div>';
                break;
            case '3':
                return '<div class="wpnm-button style-3'.$active_class.'">
                            <div class="wpnm-button-circle">
                                <div class="wpnm-button-moon-spots"></div>
                            </div>
                            <div class="wpnm-button-cloud">
                                <div></div>
                                <div></div>
                            </div>
                            <div class="wpnm-button-stars">
                                <div></div>
                                <div></div>
                            </div>
                        </div>';
                break;
                case '4':
                return '<div class="wpnm-button style-4'.$active_class.'">
                            <div class="wpnm-button-inner"></div>
                        </div>';
                break;
                case '5':
                return '<div class="wpnm-button style-5'.$active_class.'">
                            <div class="wpnm-button-sun">
                                <i class="isax icon-sun-11"></i>
                            </div>
                            
                            <div class="wpnm-button-moon">
                                <i class="isax icon-moon1"></i>
                            </div>
                        </div>';
                break;
            default:
                return '<div class="wpnm-button style-1'.$active_class.'">
                            <div class="wpnm-slider round"></div>
                        </div>';
                break;
        }

	}


	/**
	 * Register Customizer.
	 *
	 * @since    1.0.0
	 */
	public function sp_night_mode_customize_register($wp_customize) {

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

	    $wp_customize->add_section('sp_night_mode_settings', array(
            'title'    => __('Night Mode', 'sp-night-mode'),
            'description' => __('If you want to change color in some other elements you can use the Additional CSS field. CSS example: body.sp-night-mode-on .element-class { color: #000; }', 'sp-night-mode'),
            'priority' => 1200,
        ));

        //  =============================
        //  Night Mode as Default
        //  =============================
        $wp_customize->add_setting('sp_night_mode_default', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',

        ));

        $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'sp_night_mode_default', array(
            'label'    => __('Night Mode as Default', 'sp-night-mode'),
            'section'  => 'sp_night_mode_settings',
            'settings' => 'sp_night_mode_default',
            'type'     => 'checkbox',
        )));

        //  =============================
        //  Automatic Switching
        //  =============================
        // $wp_customize->add_setting('sp_night_mode_automatic_switching', array(
        //     'default'           => '',
        //     // 'sanitize_callback' => 'sanitize_hex_color',
        //     'capability'        => 'edit_theme_options',
        //     'transport'         => 'refresh',

        // ));

        // $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'sp_night_mode_automatic_switching', array(
        //     'label'    => __('Automatic Switching', 'sp-night-mode'),
        //     'section'  => 'sp_night_mode_settings',
        //     'settings' => 'sp_night_mode_automatic_switching',
        //     'default'  => '0',
        //     'type'     => 'checkbox',
        // )));

        //  =============================
        //  Each Day Turn on Time
        //  =============================
        // $wp_customize->add_setting('sp_night_mode_turn_on_time', array(
        //     'default'           => '',
        //     // 'sanitize_callback' => 'sanitize_hex_color',
        //     'capability'        => 'edit_theme_options',
        //     'transport'         => 'refresh',

        // ));

        // $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'sp_night_mode_turn_on_time', array(
        //     'label'    => __('Turn on Time', 'sp-night-mode'),
        //     'description' => __('If set ', 'sp-night-mode'),
        //     'section'  => 'sp_night_mode_settings',
        //     'settings' => 'sp_night_mode_turn_on_time',
        //     'type'     => 'time',
        // )));

        //  =============================
        //  Each Day Turn off Time
        //  =============================
        // $wp_customize->add_setting('sp_night_mode_turn_off_time', array(
        //     'default'           => '',
        //     // 'sanitize_callback' => 'sanitize_hex_color',
        //     'capability'        => 'edit_theme_options',
        //     'transport'         => 'refresh',

        // ));

        // $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'sp_night_mode_turn_off_time', array(
        //     'label'    => __('Turn off Time', 'sp-night-mode'),
        //     'section'  => 'sp_night_mode_settings',
        //     'settings' => 'sp_night_mode_turn_off_time',
        //     'type'     => 'time',
        // )));

        //  =============================
        //  Toggle Style
        //  =============================
        $wp_customize->add_setting('sp_night_mode_toggle_style', array(
            'default'           => '',
            // 'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
            'transport'   		=> 'refresh',

        ));

        $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'sp_night_mode_toggle_style', array(
            'label'    => __('Toggle Style', 'sp-night-mode'),
            'section'  => 'sp_night_mode_settings',
            'settings' => 'sp_night_mode_toggle_style',
            'default'  => '1',
            'type'     => 'select',
			'choices'  => array(
                '1'  => 'Style 1',
                '2'  => 'Style 2',
                '3'  => 'Style 3',
                '4'  => 'Style 4',
				'5'  => 'Style 5',
			),
        )));

        //  =============================
        //  Toggle Size
        //  =============================
       

        //  =============================
        //  Toggle Off Color
        //  =============================
        // $wp_customize->add_setting('sp_night_mode_toggle_off_color', array(
        //     'default'           => '',
        //     'sanitize_callback' => 'sanitize_hex_color',
        //     'capability'        => 'edit_theme_options',
        //     'transport'   		=> 'refresh',

        // ));

        // $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sp_night_mode_toggle_off_color', array(
        //     'label'    => __('Toggle Off Color', 'sp-night-mode'),
        //     'section'  => 'sp_night_mode_settings',
        //     'settings' => 'sp_night_mode_toggle_off_color',
        // )));

        //  =============================
        //  Toggle On Color
        //  =============================
        // $wp_customize->add_setting('sp_night_mode_toggle_on_color', array(
        //     'default'           => '',
        //     'sanitize_callback' => 'sanitize_hex_color',
        //     'capability'        => 'edit_theme_options',
        //     'transport'   		=> 'refresh',

        // ));

        // $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sp_night_mode_toggle_on_color', array(
        //     'label'    => __('Toggle On Color', 'sp-night-mode'),
        //     'section'  => 'sp_night_mode_settings',
        //     'settings' => 'sp_night_mode_toggle_on_color',
        // )));

        //  =============================
        //  Body Backgrpund
        //  =============================
        $wp_customize->add_setting('sp_night_mode_body_background', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
            'transport'   		=> 'refresh',

        ));

        $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sp_night_mode_body_background', array(
            'label'    => __('Body Background', 'sp-night-mode'),
            'section'  => 'sp_night_mode_settings',
            'settings' => 'sp_night_mode_body_background',
        )));
        
        
        //  =============================
        //  Alternative Backgrpund
        //  =============================
        $wp_customize->add_setting('sp_night_mode_alt_background', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
            'transport'   		=> 'refresh',

        ));

        $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sp_night_mode_alt_background', array(
            'label'    => __('Alternative Background', 'sp-night-mode'),
            'section'  => 'sp_night_mode_settings',
            'settings' => 'sp_night_mode_alt_background',
        )));

        //  =============================
        //  Text Color
        //  =============================
        $wp_customize->add_setting('sp_night_mode_text_color', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
            'transport'   		=> 'refresh',

        ));

        $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sp_night_mode_text_color', array(
            'label'    => __('Text Color', 'sp-night-mode'),
            'section'  => 'sp_night_mode_settings',
            'settings' => 'sp_night_mode_text_color',
        )));

        //  =============================
        //  Link Color
        //  =============================
        $wp_customize->add_setting('sp_night_mode_link_color', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
            'transport'   		=> 'refresh',

        ));

        $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sp_night_mode_link_color', array(
            'label'    => __('Link Color', 'sp-night-mode'),
            'section'  => 'sp_night_mode_settings',
            'settings' => 'sp_night_mode_link_color',
        )));

        //  =============================
        //  Link Hover Color
        //  =============================
        $wp_customize->add_setting('sp_night_mode_link_hover_color', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color',
            'capability'        => 'edit_theme_options',
            'transport'   		=> 'refresh',

        ));

        $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sp_night_mode_link_hover_color', array(
            'label'    => __('Link Hover Color', 'sp-night-mode'),
            'section'  => 'sp_night_mode_settings',
            'settings' => 'sp_night_mode_link_hover_color',
        )));

	}

}
