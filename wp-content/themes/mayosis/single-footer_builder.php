<?php
/**
 * This is a Single footer builder
 *
 * @package mayosis-digital-marketplace-theme
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 
get_header('blank');
?>

 <div class="full-screen-blank">
<?php while ( have_posts() ) : the_post(); ?>
	<?php the_content()?>
	<?php endwhile; ?>
					
</div>
<?php get_footer('blank'); ?>