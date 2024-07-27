<?php
/*
 * Template Name: Custom Product Template
 * Template Post Type: download
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 $download_id = get_the_ID();
 get_header();  ?>
 

		<main id="main" class="site-main" role="main">
	


		     <?php mayosis_product_builder (); ?>
	
           
	

		</main>




<?php get_footer(); ?>