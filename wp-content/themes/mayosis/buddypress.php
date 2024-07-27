<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package Wordpress
 * @subpackage Mayosis
 * @since Mayosis 2.8.2
 */

get_header('blank'); 
$loginlogo= get_theme_mod( 'login_page_logo', get_template_directory_uri().'/images/logo.png' );

if ( bp_is_register_page() || bp_is_activation_page()) {
  $mayosis_buddypress_class="mayosis-buddypress-login-box";
  $mayosis_buddypress_global="mayosis-buddypress-login-global-box";
} else {
     $mayosis_buddypress_class="mayosis-buddypress";
     $mayosis_buddypress_global="mayosis-buddypress-global-box";
}

?>



<div class="vendor-dasboard-template-main <?php echo esc_html($mayosis_buddypress_global);?>">
    
   	<?php
		get_template_part('includes/buddypress-header');
	?>
    <?php
    if ( have_posts() ) :
        // Start the Loop.
        while ( have_posts() ) : the_post();
        ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      
               <div class="mayosis-buddypress-extended">
                   <div class="<?php echo esc_html($mayosis_buddypress_class);?>">
                    <?php the_content(); ?> 
                    </div>
                </div>
                        

            </article><!-- #post-## -->

        <?php
        endwhile;

    endif;
    ?>

</div>
        

<?php get_footer('blank'); ?>