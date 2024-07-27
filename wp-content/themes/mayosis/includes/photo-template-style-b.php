 <?php
 $relatedtdownloadstyle= get_theme_mod( 'related_download_style','justified' );
$productthumbvideo= get_theme_mod( 'thumbnail_video_play','show' );
$productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
$productvcontrol= get_theme_mod( 'thumb_video_control','minimal' );
$productcartshow= get_theme_mod( 'thumb_cart_button','hide' );
$productrelnumber= get_theme_mod( 'related_product_number','8' );
$productreltitle= get_theme_mod( 'related_product_title','Similar Images' );
 ?>
 <?php if( '' !== get_post()->post_content ) { ?>
        <section class="blog-main-content photo-template-main-content">
            <div class="row">
                <div class="col-md-12">
                    
                        <div class="photo--template--content">
                            <?php get_template_part( 'includes/product-gallery' ); ?>
                            <?php the_content(); ?>
                        </div>
                  
                </div>
            </div>
        </section>
          <?php } ?>