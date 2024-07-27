<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 global $post;
  global $product;

 $envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );
 
 if ($envato_item_id){
$api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
$item_price = $api_item_results_json['price_cents'];
}
  ?>
     <li class="release-info-block">
                        <div class="rel-info-tag released--info--flex"><?php esc_html_e('Price','mayosis'); ?></div> <span class="released--info--flex">:</span><div class="rel-info-value released--info--flex"> 
                         <?php if ($envato_item_id) { ?>
                         <p>  <?php esc_html_e('$','mayosis');?><?php echo number_format(($item_price /100), 2, '.', ' ');?> </p>
                         
                         <?php } else { ?>
                        <p> <?php echo maybe_unserialize($product->get_price_html()); ?></p>
                        <?php } ?>
                        
                        </div>
                         <div class="clearfix"></div>
                       </li>