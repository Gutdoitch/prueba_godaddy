<?php
/**
 * search grid
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $post;
$productarchivecolgrid= get_theme_mod( 'product_archive_column_grid','two' );
$productthumbvideo= get_theme_mod( 'thumbnail_video_play','show' );
$productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
$productvcontrol= get_theme_mod( 'thumb_video_control','minimal' );
$productcartshow= get_theme_mod( 'thumb_cart_button','hide' );
$productthumbhoverstyle= get_theme_mod( 'product_thmub_hover_style','style1' );
if ($productarchivecolgrid=="five"){
    $col_5_row = 'row-cols-1 row-cols-md-5';
} else {
    $col_5_row = '';
}
?>
<div class="row <?php echo esc_html($col_5_row);?>">

	<?php if ( have_posts() ) :
  	while ( have_posts() ) : the_post();
  	
  	?>
    <?php if ($productarchivecolgrid=='one'): ?>
    <div class="col-md-6 col-12 col-sm-6 product-grid" id="edd_download_<?php the_ID(); ?>">
        <?php elseif ($productarchivecolgrid=='two'): ?>
        <div class="col-md-4 col-12 col-sm-4 product-grid" id="edd_download_<?php the_ID(); ?>">

            <?php elseif ($productarchivecolgrid=='four'): ?>
            <div class="col-md-2 col-12 col-sm-2 product-grid" id="edd_download_<?php the_ID(); ?>">
                <?php elseif ($productarchivecolgrid=='five'): ?>
                <div class="col product-grid" id="edd_download_<?php the_ID(); ?>">
                    <?php else:?>
                    <div class="col-md-3 col-12 col-sm-3 product-grid" id="edd_download_<?php the_ID(); ?>">
                        <?php endif;?>
                        <div <?php post_class(); ?>>
                            <div class="grid_dm ribbon-box group edge">
                                <div class="product-box">
                                    <?php
                                    $postdate = get_the_time('Y-m-d');   // Post date
                                    $postdatestamp = strtotime($postdate);   // Timestamped post date
                                    $newness = get_theme_mod('dm_days_products_new', '30');  // Newness in days

                                    if ((time() - (60 * 60 * 24 * floatval($newness))) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
                                        echo '
			<div class="wrap-ribbon left-edge point lblue">
				<span>'. esc_html__('New', 'mayosis') .'</span>
			</div>';
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
                                       <div class="msv-product-meta-box">
                                         <?php edd_get_template_part( 'shortcode', 'content-title' ); ?>

                                    </div>
                                </div>
                                <!-- .product box -->
                            </div>
                        </div>
                    </div>
                   
                    <?php endwhile; else : ?>
                        <h5>
                            <?php esc_html_e("No product found","mayosis"); ?>
                        </h5>
                    <?php endif; ?>
                    <div class="col-md-12">
                        <?php mayosis_page_navs(); ?>
                    </div>
                </div>