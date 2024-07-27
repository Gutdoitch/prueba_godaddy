<?php
$productgallerytype= get_theme_mod( 'product_gallery_type','one' );
$disablethumb= get_theme_mod( 'disable_thumbnail','yes' );
$pgalleryalt= get_theme_mod( 'product_gallery_options_alt','dflt' );
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
if ($pgalleryalt=="alt"){
$ids = get_field('edd_gallery_mayosis');
} else {
    $ids = get_post_meta($post->ID, 'vdw_gallery_id', true);
}
if( $ids ):
    ?>
    <?php if ($productgallerytype == 'one'): ?>
    
    <div id="mayosisone_1" class="mayosis-main-product-slide-box-mcd">
        
           <div class="swiper-container">
                            <button class="swiper-slide-zoom"><i class="fas fa-expand"></i></button>
                            <span class="close-button"></span>
                            <div class="mayosis-product-gallery-main-bx">

                                <div class="swiper-wrapper">
                                    
                                        <div class="swiper-slide">
                                      
                                      <img src="<?php echo esc_url($featured_img_url); ?>" alt="Featured Image">
                                      
                                      </div>
                                    
                                    
                                    <?php if ($ids) : foreach ($ids as $key => $value) : 
                                   $image = wp_get_attachment_image_src($value,$size = 'full'); 
                                    
                                    $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                                   
                                   
                                    ?>
                                    
                                    
                                        <div class="swiper-slide"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_html($alt); ?>"></div>
                                        
                                        
                                     <?php endforeach; endif; ?>

                                </div>


                                <!-- Add Arrows -->
                                <div class="swiper-button-next swiper-button-white"></div>
                                <div class="swiper-button-prev swiper-button-white"></div>
                                <div class="swiper-pagination"></div>

                            </div>



                            <div class="mayosis-gallery-thumbnail-default">

                                <div class="swiper-wrapper">
                                
                                    <div class="swiper-slide">
                                      
                                      <img src="<?php echo esc_url($featured_img_url); ?>" alt="Featured Image">
                                      
                                      </div>
                                      
                                 
                                    <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value,$size = 'full'); 
                                     $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                                    ?>
                                        <div class="swiper-slide"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_html($alt); ?>"></div>
                                    <?php endforeach; endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        
                         <div class="swipper-social-share">
                        <div class="salad-social-share-btn dropdown">
                            <a class="salad-d-a-main" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-share-alt"></i> <?php esc_html_e('Share','mayosis'); ?>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <span class="salad-caret">
                                <i class="fas fa-caret-up"></i>
                                    </span>
                                  <?php if(function_exists('mayosis_productsliderOverlay_social')){
                               mayosis_productsliderOverlay_social();
                            } ?>  
                            </ul>
                        </div>
                    </div>
       </div>
       
    <?php elseif ($productgallerytype == 'two'): ?>
    
 
  <div id="mayosisone_1" class="mayosis-main-product-slide-box-mcd">
        
           <div class="swiper-container">
                            <button class="swiper-slide-zoom"><i class="fas fa-expand"></i></button>
                            <span class="close-button"></span>
                            
                            
                              <div class="swiper-container sidebar__gallery-thumbs  mayosis-gallery-thumbnail-sidethumbs">

                                <div class="swiper-wrapper">
                                    
                                        <div class="swiper-slide">
                                      
                                      <img src="<?php echo esc_url($featured_img_url); ?>" alt="Featured Image">
                                      
                                      </div>
                                     
                                    <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value,$size = 'full');
                                    $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                                    ?>
                                        <div class="swiper-slide"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_html($alt); ?>"></div>
                                    <?php endforeach; endif; ?>
                                </div>
                            </div>
                            
                            
                            <div class="swiper-container sidebar_gallery-top mayosis-product-gallery-main-bx-side-thumbs ">

                                <div class="swiper-wrapper">
                                
                                 <div class="swiper-slide"><img src="<?php echo esc_url($featured_img_url) ?>" alt="Featured Image"></div>
                                 
                                    <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value,$size = 'full');
                                    $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                                    ?>
                                    
                                    
                                        <div class="swiper-slide"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_html($alt); ?>"></div>
                                        
                                        
                                     <?php endforeach; endif; ?>

                                </div>


                                <!-- Add Arrows -->
                                <div class="swiper-button-next swiper-button-white"></div>
                                <div class="swiper-button-prev swiper-button-white"></div>
                                <div class="swiper-pagination"></div>
                                
                                
                                
                                <div class="swipper-social-share">
                        <div class="salad-social-share-btn dropdown">
                            <a class="salad-d-a-main" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-share-alt"></i> <?php esc_html_e('Share','mayosis'); ?>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <span class="salad-caret">
                                <i class="fas fa-caret-up"></i>
                                    </span>
                                  <?php if(function_exists('mayosis_productsliderOverlay_social')){
                               mayosis_productsliderOverlay_social();
                            } ?>  
                            </ul>
                        </div>
                    </div>

                            </div>



                          
                        </div>
                        
                        
                         
       </div>
     <?php elseif ($productgallerytype == 'three'): ?>
     <div id="mayosisone_1" class="mayosis-main-product-slide-box-mcd">
        
           <div class="swiper-container">
                            <button class="swiper-slide-zoom"><i class="fas fa-expand"></i></button>
                            <span class="close-button"></span>
                            <div class="mayosis-product-gallery-main-bx-wt-thumb">

                                <div class="swiper-wrapper">
                                    
                                      <div class="swiper-slide">
                                      
                                      <img src="<?php echo esc_url($featured_img_url); ?>" alt="Featured Image">
                                      
                                      </div>
                                     
                                    <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value,$size = 'full'); 
                                    $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                                    
                                    ?>
                                    
                                    
                                        <div class="swiper-slide"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_html($alt); ?>"></div>
                                        
                                        
                                     <?php endforeach; endif; ?>

                                </div>


                                <!-- Add Arrows -->
                                <div class="swiper-button-next swiper-button-white"></div>
                                <div class="swiper-button-prev swiper-button-white"></div>
                                <div class="swiper-pagination"></div>

                            </div>



                         
                            
                        </div>
                        
                        
                         <div class="swipper-social-share">
                        <div class="salad-social-share-btn dropdown">
                            <a class="salad-d-a-main" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-share-alt"></i> <?php esc_html_e('Share','mayosis'); ?>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <span class="salad-caret">
                                <i class="fas fa-caret-up"></i>
                                    </span>
                                  <?php if(function_exists('mayosis_productsliderOverlay_social')){
                               mayosis_productsliderOverlay_social();
                            } ?>  
                            </ul>
                        </div>
                    </div>
       </div>
       
       
       
    <?php elseif ($productgallerytype == 'four'): ?>
  
       <div id="mayosisone_1" class="mayosis-main-product-slide-box-mcd">
        
           <div class="swiper-container">
                            <button class="swiper-slide-zoom"><i class="fas fa-expand"></i></button>
                            <span class="close-button"></span>
                            <div class="mayosis-product-gallery-main-bx-carousel">

                                <div class="swiper-wrapper">
                                
                                    <div class="swiper-slide">
                                      
                                      <img src="<?php echo esc_url($featured_img_url); ?>" alt="Featured Image">
                                      
                                      </div>
                                      
                                    <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value,$size = 'full');
                                    $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                                    ?>
                                    
                                    
                                        <div class="swiper-slide"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_html($alt); ?>"></div>
                                        
                                        
                                     <?php endforeach; endif; ?>

                                </div>


                                <!-- Add Arrows -->
                                <div class="swiper-button-next swiper-button-white"></div>
                                <div class="swiper-button-prev swiper-button-white"></div>
                                <div class="swiper-pagination"></div>

                            </div>



                         
                            
                        </div>
                        
                        
                         <div class="swipper-social-share">
                        <div class="salad-social-share-btn dropdown">
                            <a class="salad-d-a-main" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-share-alt"></i> <?php esc_html_e('Share','mayosis'); ?>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <span class="salad-caret">
                                <i class="fas fa-caret-up"></i>
                                    </span>
                                  <?php if(function_exists('mayosis_productsliderOverlay_social')){
                               mayosis_productsliderOverlay_social();
                            } ?>  
                            </ul>
                        </div>
                    </div>
       </div>
       <?php elseif ($productgallerytype == 'five'): ?>
  
       <div id="mayosis-product-list-msv-grid" class="mayosis-p-list-grid">
        
          <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value,$size = 'full');
                                    $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                                    ?>
                                    
                                    
                                        <div class="msv-pg-list-block"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_html($alt); ?>"></div>
                                        
                                        
                                     <?php endforeach; endif; ?>
                        
                        
                       
       </div>
       
       
         <?php elseif ($productgallerytype == 'six'): ?>
  
       <div id="mayosis-product-list-msv-grid4col" class="mayosis-p-list-grid row">
        
          <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value,$size = 'full');
                                    $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                                    ?>
                                    
                                    
                                        <div class="msv-pg-list-block col-12 col-md-6"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_html($alt); ?>"></div>
                                        
                                        
                                     <?php endforeach; endif; ?>
                        
                        
                       
       </div>
       
  <?php endif; ?> 
 
  <?php else : ?>
   <?php if ( has_post_thumbnail() ) : ?>

		<?php the_post_thumbnail(); ?>

<?php endif; ?>
<?php endif; ?>
<div class="clearfix"></div>
