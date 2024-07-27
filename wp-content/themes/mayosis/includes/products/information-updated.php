<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 global $post;
$envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );
 if ($envato_item_id){
$api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
$item_updated = $api_item_results_json['updated_at'];

}
  ?>
        <li class="release-info-block">
                        <div class="rel-info-tag released--info--flex"><?php esc_html_e('Last Updated','mayosis'); ?></div> <span class="released--info--flex">:</span><div class="rel-info-value released--info--flex"> 
                        <?php if ($envato_item_id) { ?>
                        <p><?php
                                        echo date('F j, Y', strtotime($item_updated));?></p>
                        <?php } else { ?>
                        <p><?php esc_html(the_modified_date()); ?></p>
                        <?php }?>
                        
                        </div>
                          <div class="clearfix"></div>
                        </li>