 <?php 
 
 $mayosis_audio = get_post_meta($post->ID, 'audio_url',true);
  $mayosis_player_type = get_theme_mod( 'product_wave_audio','hide');
 ?>
 
 <?php if($mayosis_player_type=="show"){?>
 
 <?php get_template_part( 'library/wave_audio'); ?>
 
 <?php } else { ?>
   <audio id="mayosisplayer" controls>
    <source src="<?php echo esc_url($mayosis_audio);?>" type="audio/mp3" />
   
</audio>

<?php } ?>



