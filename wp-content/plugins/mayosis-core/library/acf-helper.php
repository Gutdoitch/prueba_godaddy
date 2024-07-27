<?php

/**
 * ACF Helper Functions
 */

if ( ! function_exists( 'mayosis_have_rows' ) ) {
	function mayosis_have_rows( $args, $options = '' ) {

		if ( function_exists( 'have_rows' ) ) {
			return have_rows( $args, $options );
		} else {
			return false;
		}

	}
}

if ( ! function_exists( 'mayosis_get_field' ) ) {
	function mayosis_get_field( $args, $options = '' ) {

		if ( function_exists( 'get_field' ) ) {
			return get_field( $args, $options );
		} else {
			return false;
		}

	}
}


