<?php

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

if ( !class_exists( 'Mayosis_Elementor_Addons_Assests' ) ) {

    class Mayosis_Elementor_Addons_Assests{

        /**
         * [$_instance]
         * @var null
         */
        private static $_instance = null;

        /**
         * [instance] Initializes a singleton instance
         * @return [Mayosis_Elementor_Addons_Assests]
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * [__construct] Class construcotr
         */
        public function __construct(){

            // Register Scripts
            add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
            add_action( 'admin_enqueue_scripts', [ $this, 'register_assets' ] );

           

            add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

        }

        /**
         * All available styles
         *
         * @return array
         */
        public function get_styles() {

            $style_list = [

                'before-after-css' => [
                    'src'     => MAYOSIS_PL_ASSETS . 'css/mayo-elementor.css',
                    'version' => 1.1
                ],
                
            ];
            return $style_list;

        }

        /**
         * All available scripts
         *
         * @return array
         */
        public function get_scripts(){


            $script_list = [

                'before-after' => [
                    'src'     => MAYOSIS_PL_ASSETS . 'js/mayo-elementor.js',
                    'version' => 1.1,
                    'deps'    => [ 'jquery' ]
                ],
                

            ];

        

            return $script_list;

        }

        /**
         * Register scripts and styles
         *
         * @return void
         */
        public function register_assets() {
            $scripts = $this->get_scripts();
            $styles  = $this->get_styles();

            // Register Scripts
            foreach ( $scripts as $handle => $script ) {
                $deps = ( isset( $style['deps'] ) ? $style['deps'] : true );
                wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
            }

            // Register Styles
            foreach ( $styles as $handle => $style ) {
                $deps = ( isset( $style['deps'] ) ? $style['deps'] : false );
                wp_register_style( $handle, $style['src'], $deps, $style['version'] );
            }
    
            
            
        }


       

        /**
         * [enqueue_scripts]
         * @return [void] Frontend Scripts
         */
        public function enqueue_scripts(){

            // CSS
            wp_enqueue_style( 'before-after-css' );
            

            // JS
            wp_enqueue_script( 'before-after' );
           

        }

    }

    Mayosis_Elementor_Addons_Assests::instance();

}