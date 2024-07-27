<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 global $post;

global $product;  
$total_sold = $product->get_total_sales();
 $envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );
 
 if ($envato_item_id){
$api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
$item_number_of_sales = $api_item_results_json['number_of_sales'];
}

  ?>
   
             
                        <li class="release-info-block">
                        <div class="rel-info-tag released--info--flex">
                            
                              <?php esc_html_e('Sales','mayosis'); ?>
                             
                           
                            </div> 
                            
                            <span class="released--info--flex">:</span>
                        
                        <div class="rel-info-value released--info--flex"> 
                        <?php if ($envato_item_id) { ?>
                                <p><span>
                                  
                                <?php
                                        echo esc_html($item_number_of_sales);?> <?php esc_html_e('Sales','mayosis');?></span></p>
                                   
                                   <?php } else { ?>
                                   
                                  
                                   <p><span><?php echo esc_html($total_sold);?></span></p>
                                  
                                   
                                   <?php } ?>
                        
                        </div>
                          <div class="clearfix"></div>
                        </li>