<?php
/**
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$productpricingoptions= get_theme_mod( 'product_pricing_options','price' );
$productfreeoptins= get_theme_mod( 'product_free_options','custom' );
$productcustomtext= get_theme_mod( 'free_text','Free' );
$envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );
 
   if ($envato_item_id){
$api_item_results_json = json_decode(mayosis_custom_envato_api(), true);

$item_price = $api_item_results_json['price_cents'];
}

?>


 <?php if ($envato_item_id) { ?>
 <p>  <?php esc_html_e('$','mayosis');?><?php echo number_format(($item_price /100), 2, '.', ' ');?> </p>
 <?php } else {?>
 <?php 
																	global $edd_logs;
															$single_count = $edd_logs->get_log_count(66, 'file_download');
															$total_count  = $edd_logs->get_log_count('*', 'file_download');
                                                            $sales = edd_get_download_sales_stats( get_the_ID() );
                                                            $sales = $sales > 1 ? $sales . ' sales' : $sales . ' sale';
                                        $price = edd_get_download_price(get_the_ID());
																	?>
 <?php if ($productpricingoptions=='price'): ?>								
								 <?php if( $price == "0.00"  ){ ?>
								 <?php if ($productfreeoptins=='none'): ?>		
									<p><?php edd_price(get_the_ID()); ?></p>
								<?php else: ?>
								    <p><?php echo esc_html($productcustomtext); ?></p>
								<?php endif;?>
								
								
									 <?php } else { ?>
                      <div class="product-price"><?php edd_price(get_the_ID()); ?></div>
                    <?php } ?>
									
							
								<?php endif; ?>
								
								<?php } ?>