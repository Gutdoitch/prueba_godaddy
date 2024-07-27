<?php
$mayosis_video = get_post_meta($post->ID, 'video_url',true);
$mayosisvideomd= str_replace("play","embed",$mayosis_video);
$productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
$posterimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
if (strpos($mayosis_video,'youtube.com')==true){ ?>

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
<div style="position: relative; padding-top: 56.25%;" class="bunny-video-single-block"><iframe src="<?php echo esc_url($mayosisvideomd);?>" loading="lazy" style="border: none; position: absolute; top: 0; height: 100%; width: 100%;" allow="accelerometer; gyroscope; encrypted-media; picture-in-picture;" allowfullscreen="true"></iframe></div>



<?php } else { ?>


<video id="mayosisplayer" controls="controls" <?php if ($productthumbposter=='show'){ ?>poster="<?php echo esc_url($posterimage[0]);?>"<?php }?> ><source src="<?php echo esc_url($mayosis_video);?>" type="video/mp4" /></video>
<?php } ?>