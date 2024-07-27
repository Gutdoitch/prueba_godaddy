<?php
/**
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $product;
$producthovertop= get_theme_mod( 'product_hover_bottom','share' );
?>
                                                           
                                                           <?php if ($producthovertop== 'cart'): ?>
                                                            
													<?php 
                            if ( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) {
			woocommerce_template_loop_add_to_cart();
		}
                            ?>		
															
														
												
						
							 <?php elseif ($producthovertop=='share'): ?>
							
                                            <div class="product-hover-social-share">
                                                <?php get_template_part( 'includes/social-share-grid' ); ?>
                                            </div>
                                            
                    <?php elseif ($producthovertop=='sales'): ?>
                    	                                     <?php 
    $count = get_post_meta($post->ID,'total_sales', true);
    $sales = sprintf( _n( '%s Sale', '%s Sales', $count, 'mayosis' ), number_format_i18n($count));
   
    ?> 
                   
                    <div class="download-count-hover">
                       <?php if( $product->get_price() == "0.00"  ){ ?>
                       <p><i class="fas fa-cloud-download-alt"></i> <span><?php mayosis_woo_downloads_count(); ?></span></p>
                       <?php } else { ?>
                       <p><i class="fas fa-cloud-download-alt"></i> <span><?php echo esc_html($sales); ?></span></p>
                       <?php } ?>
                        
                    </div>
						<?php else: ?>
						<?php endif; ?>