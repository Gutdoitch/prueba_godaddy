<?php
/**
 * The template for displaying archive pages.
 *
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
get_header(); ?>


    <div id="main" class="site-main archive-page">
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
  
                <div id="posts" class="posts">
                    <?php if ( have_posts() ) : ?>
<?php



                            // Load the default post template
                            get_template_part( 'content/content' );





                        else :

                            // Load the empty post template
                            get_template_part( 'content/content-none-category' );

                        endif; ?>
                </div><!-- #posts .posts -->

            </div><!-- #content .site-content -->
        </div><!-- #primary .content-area -->


    </div><!-- #main .site-main -->
<?php get_footer(); ?>