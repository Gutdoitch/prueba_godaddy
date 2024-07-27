<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $post;
  ?>
   
                        
        <?php $product_version = get_post_meta($post->ID, 'woo_product_version',true );; if ( $product_version ) { ?>
        <li class="release-info-block">
        <div class="rel-info-tag released--info--flex"><?php esc_html_e('Version','mayosis'); ?></div> <span class="released--info--flex">:</span> <div class="rel-info-value released--info--flex"><p><?php echo esc_html($product_version); ?></p></div>
         <div class="clearfix"></div>
        </li>
        <?php } ?>