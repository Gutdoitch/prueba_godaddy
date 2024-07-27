<?php
$mayosis_video = get_post_meta($post->ID, 'woo_video_url',true);
$mayosisvideomd= str_replace("play","embed",$mayosis_video);
$productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
$minimalcontrol= get_theme_mod( 'thumb_video_control','full' );
$posterimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
?>
<div class="msv-video-bx--wrapper">
<?php if (strpos($mayosis_video,'youtube.com')==true){ ?>


<div class="plyr__video-embed" id="mayosisplayer">
    <iframe
        src="<?php echo esc_url($mayosis_video);?>?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
        allowfullscreen
        allowtransparency
        allow="autoplay"
    ></iframe>
</div>

<?php } elseif (strpos($mayosis_video,'vimeo')==true){ ?>
<div class="plyr__video-embed" id="mayosisplayer">
    <iframe
        src="<?php echo esc_url($mayosis_video);?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media"
        allowfullscreen
        allowtransparency
        allow="autoplay"
    ></iframe>
</div>

<?php } elseif (strpos($mayosis_video,'mediadelivery')==true){ ?>
<div class="plyr__video-embed" id="mayosisplayer" style="position: relative; padding-top: 56.25%;"><iframe src="<?php echo esc_url($mayosisvideomd);?>" style="border: none; position: absolute; top: 0; height: 100%; width: 100%;left:0"  allowfullscreen="true" class="medialibraryifame"></iframe></div>

<?php } else { ?>

<video id="mayosisplayergrid"
      muted="true" <?php if ($productthumbposter=='show'){ ?>poster="<?php echo esc_url($posterimage[0]);?>"<?php }?> controls><source src="<?php echo esc_url($mayosis_video);?>" type="video/mp4" /></video>

<?php } ?>
</div>