<?php
///*/**
// * Theme functions and definitions.
// */
//function mayosis_child_enqueue_styles() {
//    // Cargar el estilo principal del tema padre
//    if ( SCRIPT_DEBUG ) {
//        wp_enqueue_style( 'mayosis-style', get_template_directory_uri() . '/style.css' );
//    } else {
//        wp_enqueue_style( 'mayosis-style', get_template_directory_uri() . '/style.min.css' );
//    }
//
//    // Cargar el estilo del tema hijo
//    wp_enqueue_style( 'mayosis-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'mayosis-style' ), "8.0.0" );
//
//    // Desregistrar y descolar el main.css o main.min.css del tema padre
//    wp_dequeue_style( 'mayosis-main-style-css' );
//    wp_deregister_style( 'mayosis-main-style-css' );
//
//    // Opcional: Si deseas encolar tu propio main.css o main.min.css del tema hijo
//    if ( SCRIPT_DEBUG ) {
//        wp_enqueue_style( 'mayosis-child-main-style-css', get_stylesheet_directory_uri() . '/css/main.css', array( 'mayosis-style' ), "8.0.0");
//    } else {
//        wp_enqueue_style( 'mayosis-child-main-style-css', get_stylesheet_directory_uri() . '/css/main.min.css', array( 'mayosis-style' ), "8.0.0" );
//    }
//}
//
//add_action( 'wp_enqueue_scripts', 'mayosis_child_enqueue_styles', 20 ); // Establecer prioridad adecuada para este hook*/
add_action( 'wp_enqueue_scripts', 'custom_enqueue_styles');

function custom_enqueue_styles() {
    wp_enqueue_style( 'custom-style',
        get_stylesheet_directory_uri() . '/css/custom.css',
        array(),
        wp_get_theme()->get('Version')
    );
}