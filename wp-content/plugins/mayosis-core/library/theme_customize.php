<?php
 $disable_google_fonts = get_theme_mod( 'disable_google_fonts','show');
 
function mayosis_customize_register( $wp_customize ) {
    //All our sections, settings, and controls will be added here

    $wp_customize->remove_section( 'title_tagline');
    $wp_customize->remove_section( 'colors');
    $wp_customize->remove_section( 'header_image');
    $wp_customize->remove_section( 'background_image');
    $wp_customize->remove_section( 'static_front_page');


}
add_action( 'customize_register', 'mayosis_customize_register',50 );


/**
 * Removes the core 'Menus' panel from the Customizer.
 *
 * @param array $components Core Customizer components list.
 * @return array (Maybe) modified components list.
 */
function mayosis_remove_nav_menus_panel( $components ) {
    $i = array_search( 'nav_menus', $components );
    if ( false !== $i ) {
        unset( $components[ $i ] );
    }
    return $components;
}
add_filter( 'customize_loaded_components', 'mayosis_remove_nav_menus_panel' );


function mayosis_hide_admin_bar_settings() { ?>
	<style type="text/css">
		.show-admin-bar {
			display: none;
		}
	</style>
<?php
}

function mayosis_disable_admin_bar() {
	if ( ! current_user_can( 'administrator' ) ) {
		add_filter( 'show_admin_bar', '__return_false' );
		add_action( 'admin_print_scripts-profile.php', 'mayosis_hide_admin_bar_settings' );
	}
}
add_action('init', 'mayosis_disable_admin_bar', 9);

if ( $disable_google_fonts == 'hide'){
   add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );
     add_filter( 'kirki/enqueue_google_fonts', '__return_empty_array' );
}
