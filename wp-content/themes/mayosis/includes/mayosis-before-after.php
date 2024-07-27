<?php
global $post;
$thumb_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
$after_image = get_post_meta($post->ID, 'after_image', true);
?>

<div id="mayosis-before-after" class="beer-slider" data-beer-label="before">
                        <img src="<?php echo esc_url($thumb_image);?>" alt="before-image">
                        <div class="beer-reveal" data-beer-label="after">
                          <img src="<?php echo esc_url($after_image);?>" alt="after-image">
                        </div>
                      </div>