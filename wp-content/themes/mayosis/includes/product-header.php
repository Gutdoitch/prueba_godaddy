 <?php
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$featured_image_visibility= get_theme_mod( 'featured_image_visibility','show' );
$featured_image_position= get_theme_mod( 'featured_image_position','left' );
$download_id = get_the_ID();
$audioplayerplace= get_theme_mod( 'audio_player_bread','two');
$mayosis_player_style = get_theme_mod( 'product_wave_style','standard');
?>
<?php if ($featured_image_position == 'left'): ?>
<?php if ($featured_image_visibility == 'show'): ?>
    <?php
			// display featured image?
			if ( has_post_thumbnail() ) : ?>
 <div class="col-lg-4 col-12 post-thumb-single ">
                    
                
				<?php the_post_thumbnail( 'full', array( 'class' => 'featured-img img-responsive watermark' ) ); ?>
			
			    <?php if ( has_post_format( 'audio' ) && $mayosis_player_style== "fixed") {?>
				<div class="mayosis-audio-floating-play-button">
		                <a href="" class="floating_play" onClick="awp_player.playMedia(); return false;"><i class="fa fa-play-circle"></i></a>
		                
		                <a href="#" class="floating_pause" onClick="awp_player.pauseMedia(); return false;"><i class="fa fa-pause-circle"></i></a>
		            </div>
		     <?php }?>
                </div> 
                	<?php endif; ?>
		
		            <?php endif; ?>
		            <?php endif; ?>
                   <?php if ($featured_image_visibility == 'show'): ?>
                <div class="col-lg-8 col-12 single_main_header_products">
                    <?php else : ?>
                     <div class="col-lg-12 col-12 single_main_header_products">
                    <?php endif; ?>
                    <div class="single--post--content">
                        <?php get_template_part( 'includes/default-product-header-layout' ); ?>
                        
                        <?php if ($audioplayerplace== "one"){?>
                    <?php if ( has_post_format( 'audio' )) { ?>
                    
                     <div class="mayosis-main-media">
                    <?php get_template_part( 'library/mayosis_audio' ); ?>
                    </div>
                    <?php } ?>
                    <?php } ?>
                  </div>
                </div>
                
                <?php if ($featured_image_position == 'right'): ?>
<?php if ($featured_image_visibility == 'show'): ?>
    <?php
			// display featured image?
			if ( has_post_thumbnail() ) : ?>
			
 <div class="col-lg-4 col-12 post-thumb-single ">
                    
                
				<?php the_post_thumbnail( 'full', array( 'class' => 'featured-img img-responsive pull-right' ) ); ?>
				
				  <?php if ( has_post_format( 'audio' ) && $mayosis_player_style== "fixed") {?>
				<div class="mayosis-audio-floating-play-button">
		                <a href="" class="floating_play" onClick="awp_player.playMedia(); return false;"><i class="fa fa-play-circle"></i></a>
		                
		                <a href="#" class="floating_pause" onClick="awp_player.pauseMedia(); return false;"><i class="fa fa-pause-circle"></i></a>
		            </div>
		     <?php }?>
		            
                </div> 
                	<?php endif; ?>
		
		            <?php endif; ?>
		            <?php endif; ?>
                
                
