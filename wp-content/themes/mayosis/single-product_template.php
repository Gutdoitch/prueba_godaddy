<?php
/**
 * This is a Product Template
 *
 * @package mayosis-digital-marketplace-theme
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 
get_header();
?>

 <div class="full-screen-blank">
<?php while ( have_posts() ) : the_post(); ?>
	<?php the_content()?>
	<?php endwhile; ?>
					
</div>
<?php get_footer(); ?>