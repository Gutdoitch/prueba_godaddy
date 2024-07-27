<?php
/**
 * The audio template for download page content
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$mayosis_player_state = get_theme_mod( 'product_wave_audio','hide');
$mayosis_player_style = get_theme_mod( 'product_wave_style','standard');
$productarchivecolgrid= get_theme_mod( 'product_archive_column_grid','two' );
$productthumbvideo= get_theme_mod( 'thumbnail_video_play','show' );
$productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
$productvcontrol= get_theme_mod( 'thumb_video_control','minimal' );
$productcartshow= get_theme_mod( 'thumb_cart_button','hide' );
$productthumbhoverstyle= get_theme_mod( 'product_thmub_hover_style','style1' );
?>

<div class="mayosis_wave-audio_template">
    
  
            <?php if ($mayosis_player_state== "show"){?>
            
            <?php if ($mayosis_player_style  == "standard"){ ?>
            
                    <?php
                    mayosis_wave_template_audio();
                    ?>
            
            <?php } else { ?>
            
                    <?php
                    mayosis_fixed_template_audio();
                    ?>
            <?php } ?>
            
    
    <?php } else { ?>
    <h3><?php esc_html_e('Please active wave player from theme option','mayosis');?></h3>
    <?php } ?>
    
 
   

    
    <div class="container">
           <div class="mayosis-audio-description">
        <?php the_content();?>
    </div>
    </div>
    
    <div class="mayosis-audio-related-downloads">
        <div class="container">
            <h4><?php esc_html_e('Releted Product ','mayosis');?></h4>
            <div class="row">
            <?php  
               
               
			   //Fetch data
		$exclude_post_id = $post->ID;
		$taxchoice = isset( $edd_options['related_filter_by_cat'] ) ? 'download_tag' : 'download_category';
		$custom_taxterms = wp_get_object_terms( $post->ID, $taxchoice, array('fields' => 'ids') );
			   
		$arguments = array(
			'post_type' => 'download',
			'post_status' => 'publish',
			'posts_per_page' => 3,
			'orderby' => 'rand', 
			'ignore_sticky_posts' => 1,
			'post__not_in' => array($post->ID),
			'ignore_sticky_posts'=>1,
			'tax_query' => array(
							array(
								'taxonomy' => $taxchoice,
								'field' => 'id',
								'terms' => $custom_taxterms
							)
						),
		);
	
		$post_query = new WP_Query($arguments); ?>
               <?php if ( $post_query->have_posts() ) : while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
              <?php if ($productarchivecolgrid=='one'): ?>
    <div class="col-md-6 col-12 col-sm-6 product-grid" id="edd_download_<?php the_ID(); ?>">
        <?php elseif ($productarchivecolgrid=='two'): ?>
        <div class="col-md-4 col-12 col-sm-4 product-grid" id="edd_download_<?php the_ID(); ?>">
            
            <?php elseif ($productarchivecolgrid=='four'): ?>
            <div class="col-md-2 col-12 col-sm-2 product-grid" id="edd_download_<?php the_ID(); ?>">
            <?php else:?>
            <div class="col-md-3 col-12 col-sm-3 product-grid" id="edd_download_<?php the_ID(); ?>">
                <?php endif;?>

                <div class="grid_dm ribbon-box group
                                        edge">
                    <div class="product-box">
                        <?php
                                $postdate = get_the_time('Y-m-d'); // Post date
                                $postdatestamp = strtotime($postdate); 
                                
                                $riboontext = get_theme_mod('recent_ribbon_text', 'New'); // Newness in days
                                
                                $newness = get_theme_mod('recent_ribbon_time', '30'); // Newness in days
                                if ((time() - (60 * 60 * 24 * floatval($newness))) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
                                    echo '<div class="wrap-ribbon left-edge point lblue"><span>' . esc_html($riboontext) . '</span></div>';
                                }
                        ?>
                        <figure class="mayosis-fade-in">


    <?php if ($productthumbvideo=='show'){ ?>
    <?php if ( has_post_format( 'video' )) { ?>

    <div class="mayosis--video--box">
        <div class="video-inner-box-promo">

            <a href="<?php the_permalink();?>" class="mayosis-video-url"></a>
            <div class="video-inner-main">
                <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
            </div>
            <div class="clearfix"></div>
            <?php if ($productcartshow=='show'){ ?>
                <div class="product-cart-on-hover">
                    <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
                </div>
            <?php }?>
            <?php if ($productvcontrol=='minimal'){ ?>
                <div class="minimal-video-control">
                    <div class="minimal-control-left">

                        <?php if ( function_exists( 'edd_favorites_load_link' ) ) {
                            edd_favorites_load_link( $download_id );
                        } ?>
                    </div>



                    <div class="minimal-control-right">
                        <ul>
                            <li>	<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>  </li>
                            <?php $mayosis_video = get_post_meta($post->ID, 'video_url',true);?>
                            <li><a href="<?php echo esc_attr($mayosis_video); ?>" data-lity>
                                    <i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>

                        </ul>
                    </div>

                </div>
            <?php } ?>
        </div>






        <?php } else { ?>
        <div class="mayosis--thumb">
            <?php get_template_part( 'includes/product-grid-thumbnail' ); ?>
            <?php } ?>

            <?php } else { ?>

            <div class="mayosis--thumb">
                 <?php get_template_part( 'includes/product-grid-thumbnail' ); ?>
                <?php } ?>
                 <?php
                if ($productthumbhoverstyle=='style2') { ?>
                <?php get_template_part( 'library/product-hover-style-two' ); ?>
                
                               <?php
                } elseif ($productthumbhoverstyle=='style3') { ?>
                
               <?php get_template_part( 'library/product-hover-style-three' ); ?>
                <?php } else { ?>
                <figcaption class="thumb-caption">
                            <div class="overlay_content_center">
                                <?php get_template_part( 'includes/product-hover-content-top' ); ?>

                                <div class="product_hover_details_button">
                                    <a href="<?php the_permalink(); ?>" class="button-fill-color"><?php esc_html_e('View Details', 'mayosis'); ?></a>
                                </div>
                                <?php
                                $demo_link = get_post_meta(get_the_ID(), 'demo_link', true);
                                $livepreviewtext= get_theme_mod( 'live_preview_text','Live Preview' );
                                ?>
                                <?php if ( $demo_link ) { ?>
                                    <div class="product_hover_demo_button">
                                        <a href="<?php echo esc_url($demo_link); ?>" class="live_demo_onh" target="_blank"><?php echo esc_html($livepreviewtext); ?></a>
                                    </div>
                                <?php } ?>

                                <?php get_template_part( 'includes/product-hover-content-bottom' ); ?>
                            </div>
                              </figcaption>
                            <?php } ?>
                      
            </div>
</figure>
                        <div class="product-meta">
                            <?php get_template_part( 'includes/product-meta' ); ?>

                        </div>
                    </div>
                </div>
            </div>
                   	 <?php endwhile; else: ?>
                   	 <div class="col-lg-12 pm-column-spacing">
                     <p><?php esc_html_e('No posts were found.', 'mayosis'); ?></p>
                    </div>
                <?php endif; ?>
                    <!--Sidebar Product-->
<?php wp_reset_postdata(); ?>
</div>
        </div>
    </div>
</div>