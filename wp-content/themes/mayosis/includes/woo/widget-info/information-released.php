<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 global $post;
$envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );

 if ($envato_item_id){

$api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
$item_relased = $api_item_results_json['published_at'];
}
  ?>
        <li class="release-info-block">
                        <div class="rel-info-tag released--info--flex"><?php esc_html_e('Released','mayosis'); ?></div> <span class="released--info--flex">:</span><div class="rel-info-value released--info--flex"> 
                        
                          <?php if ($envato_item_id) { ?>
                          <p> <?php
                                        echo date('F j, Y', strtotime($item_relased));?></p>
                          <?php } else {?>
                        <p><?php echo esc_html(get_the_date()); ?></p>
                        <?php }?>
                        </div>
                         <div class="clearfix"></div>
                       </li>