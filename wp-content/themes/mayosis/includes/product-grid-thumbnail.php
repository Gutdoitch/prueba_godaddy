<?php
$productgridimagesize= get_theme_mod( 'product_grid_image_size','full' );
$productgridimagewidth= get_theme_mod( 'product_grid_image_width','' );
$productgridimageheight= get_theme_mod( 'product_grid_image_height','' );
$pgalleryalt= get_theme_mod( 'product_gallery_options_alt','dflt' );
if ($pgalleryalt=="alt"){
$ids = get_field('edd_gallery_mayosis');
} else {
    $ids = get_post_meta($post->ID, 'vdw_gallery_id', true);
}

?>
<?php if ( has_post_format( 'gallery' )) { ?>

<div id="mayosisone_1" class="mayosis-main-product-slide-box-thumnail">
        
           <div class="swiper-container">
                    
                            <div class="mayosis-product--gallery--thumnail_msb">

                                <div class="swiper-wrapper">
                                    <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value,$size = 'full'); ?>
                                    
                                    
                                        <div class="swiper-slide"> <a href="<?php the_permalink();?>" class="msv-gallery-thumnail-anchor"><img src="<?php echo esc_url($image[0]); ?>">  </a>   </div>
                                        
                                        
                                     <?php endforeach; endif; ?>

                                </div>


                                <!-- Add Arrows -->
                                <div class="swiper-button-next swiper-button-white"></div>
                                <div class="swiper-button-prev swiper-button-white"></div>
                                <div class="swiper-pagination"></div>

                            </div>



                         
                            
                        </div>
                        
                  
                     
       </div>
       
        <?php } else {?>
 <?php if ($productgridimagesize=='custom'){ ?>


 <?php
                        // display featured image?
                        if ( has_post_thumbnail() ) :
                            the_post_thumbnail('mayosis-custom-thumb');
                        endif;

                        ?>

<?php } else { ?>

            <?php
                        // display featured image?
                        if ( has_post_thumbnail() ) :
                            the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                        endif;

                        ?>
 <?php } ?>
                        
<?php }?>
