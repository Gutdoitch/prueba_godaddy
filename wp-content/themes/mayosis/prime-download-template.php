<?php
/*
 * Template Name: Prime Template
 * Template Post Type: download
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
if ( is_singular( 'download' ) ) {
			$author = new WP_User( $post->post_author );
		} else {
			$author = fes_get_vendor();
		}

		if ( ! $author ) {
			$author = get_current_user_id();
		}
$download_id = get_the_ID();
$hidecommenttab = get_theme_mod('hide_comment_on_review_prime','show');
get_header(); ?>


    <main id="main" class="site-main">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content/content', 'prime-download' ); ?>
            <?php get_template_part( 'content/footer-widget', 'download' ); ?>
            <div class="container has_mayosis_dark_bg" id="comment_box">
                  <?php if ( class_exists( 'EDD_Reviews' ) ) { ?>
                  
                   <?php if($hidecommenttab== 'show'){ ?>
                <div class="mayosis-review-tabs">
			      <div class="tabbable-line">
            
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item"><a href="#commentmain" class="nav-link active" role="tab" data-bs-toggle="tab">Comments</a></li>
                    <li class="nav-item"><a href="#mayosisreview" class="nav-link" role="tab" data-bs-toggle="tab">Customer Reviews</a></li>
                  </ul>
                    </div>
                  
                   <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="commentmain">
                        	<?php if ( comments_open() || '0' != get_comments_number() ) { ?>
                    <?php comments_template(); ?>
                <?php } ?>
                        
                    </div>
                    <div role="tabpanel" class="tab-pane" id="mayosisreview">
                        
                         <?php if ( class_exists( 'EDD_Reviews' ) ) {
								global $post;
								$user = wp_get_current_user();
								$user_id = ( isset( $user->ID ) ? (int) $user->ID : 0 );

								if ( ! edd_reviews()->is_review_status( 'disabled' ) ) {
								?>
								<div class="mayosis-review-section reviews-section">
									<div class="comments">
										<div class="comments-wrap">
										<?php
											edd_get_template_part( 'reviews' );
											if ( get_option( 'thread_comments' ) ) {
												edd_get_template_part( 'reviews-reply' );
											}
										?>
										</div>
									</div>
								</div>
							<?php } }?>
                    </div>
                   
                  </div>
                </div>
              
               <?php } else { ?>
                  
                  
                    
                         <?php if ( class_exists( 'EDD_Reviews' ) ) {
								global $post;
								$user = wp_get_current_user();
								$user_id = ( isset( $user->ID ) ? (int) $user->ID : 0 );

								if ( ! edd_reviews()->is_review_status( 'disabled' ) ) {
								?>
								<div class="mayosis-review-section reviews-section">
									<div class="comments">
										<div class="comments-wrap">
										<?php
											edd_get_template_part( 'reviews' );
											if ( get_option( 'thread_comments' ) ) {
												edd_get_template_part( 'reviews-reply' );
											}
										?>
										</div>
									</div>
								</div>
							<?php } }?>
							
							
                  <?php } ?>
                
                <?php } else { ?>
                 
                 
                 <?php if ( comments_open() || '0' != get_comments_number() ) { ?>
                    <?php comments_template(); ?>
                <?php } ?>
							
							
			<?php } ?>
            </div>

        <?php endwhile;  ?>
        
	
	


    </main>



<?php get_footer(); ?>