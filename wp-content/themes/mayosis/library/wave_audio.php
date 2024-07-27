<?php
/*
*Wave player
*since 2.7.1
*/
global $post;
$mayosis_audio = get_post_meta($post->ID, 'audio_url',true);
$wavecolor=get_theme_mod( 'wave_color','#5a00f0');
 $primaryopcitywave = mayosis_hexto_rgb($wavecolor, 0.25);
$author_id=$post->post_author;
$mayosis_player_style = get_theme_mod( 'product_wave_style','standard');
?>
  <?php if ($mayosis_player_style=="fixed"){?>

  <?php if(function_exists('mayosis_wave_fixed_audio')){
        mayosis_wave_fixed_audio();
  }?>
 
 
 <?php } else {?>
   <?php if(function_exists('mayosis_wave_standard_audio')){
        mayosis_wave_standard_audio();
  }?>
 <?php }?>