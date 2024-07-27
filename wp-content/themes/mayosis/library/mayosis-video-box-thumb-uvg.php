<?php
$mayosis_video = get_post_meta($post->ID, 'video_url',true);
$productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
$minimalcontrol= get_theme_mod( 'thumb_video_control','full' );
$posterimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
?>
<div class="msv-video-bx--wrapper">
<?php if (strpos($mayosis_video,'youtube.com')==true){ ?>


<div class="plyr__video-embed" id="mayosisplayeruvg">
    <iframe
        src="<?php echo esc_url($mayosis_video);?>?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
        allowfullscreen
        allowtransparency
        allow="autoplay"
    ></iframe>
</div>

<?php } elseif (strpos($mayosis_video,'vimeo')==true){ ?>
<div class="plyr__video-embed" id="mayosisplayeruvg">
    <iframe
        src="<?php echo esc_url($mayosis_video);?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media"
        allowfullscreen
        allowtransparency
        allow="autoplay"
    ></iframe>
</div>
<?php } else { ?>
  
<video id="mayosisplayergriduvg" <?php if ($productthumbposter=='show'){ ?>poster="<?php echo esc_url($posterimage[0]);?>"<?php }?> controls data-play="hover"><source src="<?php echo esc_url($mayosis_video);?>" type="video/mp4" /></video>

<?php } ?>
</div>
