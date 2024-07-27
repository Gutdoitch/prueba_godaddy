<?php
defined('ABSPATH') or die();
$download_id = get_the_ID();
$producttopsocialbuttons= get_theme_mod( 'product_top_social_share','show' );
$livepreviewtext= get_theme_mod( 'live_preview_text','Live Preview' );
$showcartonfree= get_theme_mod( 'free_product_cart_button','hide' );
global $post;
 $envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );
 $custom_purchase_text= get_post_meta( $post->ID, 'custom_product_text', true );
 $custom_purchase_btn= get_post_meta( $post->ID, 'custom_product_url', true );
  if ($envato_item_id){
$api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
$item_price = $api_item_results_json['price_cents'];
 $item_url = $api_item_results_json['url'];
 
  }
?>
	
 <div class="single-product-buttons row g-3">
     
      <?php if ($envato_item_id) { ?>
       <div class="col-12 col-md-4 product-cart-flex-button">
           
             <?php if ($custom_purchase_btn){ ?>
              <a href="<?php echo esc_url($custom_purchase_btn);?>" class="button blue edd-submit custom-envato-btn">
			         <?php echo esc_html($custom_purchase_text);?>
			         </a>
             <?php } else { ?>
            <a href="<?php echo esc_url($item_url);?>" class="button blue edd-submit custom-envato-btn">
			          <?php esc_html_e('Purchase','mayosis');?>
			         </a>
			         
			         <?php } ?>
        </div>
      
      <?php } else { ?>
      
      
      <?php if ($custom_purchase_btn){ ?>
      <div class="col-12 col-md-4 product-cart-flex-button">
             <a href="<?php echo esc_url($custom_purchase_btn);?>" class="button blue edd-submit custom-envato-btn">
			          <?php echo esc_html($custom_purchase_text);?>
			         </a>
          </div>
      <?php } else { ?>
                         <?php 
                                global $edd_logs;
                                $single_count = $edd_logs->get_log_count(66, 'file_download');
                                $total_count  = $edd_logs->get_log_count('*', 'file_download');
                                $price = edd_get_download_price(get_the_ID());
                                ?>
                           <?php if( $price == "0.00"  ){ ?>
                           <?php if ($showcartonfree=='show'){?>
                           <div class="col-12 col-md-4 product-cart-flex-button">
                               <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
                           </div>
                           <?php }?>
                           <?php } else { ?>
                   
                           <div class="col-12 col-md-4 product-cart-flex-button">
                            <?php if(edd_has_variable_prices($download_id)):?>
        					<a class="btn btn-primary multiple_button_v" href="#mayosis_variable_price" data-lity>
                                 <?php esc_html_e('Purchase','mayosis'); ?>
                                </a>
				</div>
				<?php else: ?>
				
			
				<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
				</div>
                     
			<?php endif; ?>
			<?php } ?>
			
				<?php } ?>
		
                             
                           
                           
                           	<?php } ?>
                           <?php $demo_link =  get_post_meta($post->ID, 'demo_link', true); ?>
       <?php if ( $demo_link ) { ?>
                      <div class="col-12 col-md-4 comment-button">
                         
                               <a href="<?php echo esc_html($demo_link); ?>" class="btn btn-default" target="_blank"><?php echo esc_html($livepreviewtext); ?></a>
                                 
                        
                     </div>
                     <?php } ?>
                           <?php if ($producttopsocialbuttons=='show'): ?>
                         <div class="col-12 col-md-4">
                         <?php if(function_exists('mayosis_productbreadcrubm')){
                               mayosis_productbreadcrubm();
                            } ?>  
                        
                            </div>
                            <?php endif; ?>
                   </div>