<?php $titleaudiostate = get_theme_mod( 'title_player_button_state_woo','show' );?>
<?php if ($titleaudiostate=="show"){?>
<?php $mayosis_audio = get_post_meta($post->ID, 'woo_audio_url',true); ?>
    <div class="mayosis-title-audio">
       <?php echo do_shortcode('[audio src="'.$mayosis_audio.'"]'); ?>
    </div>
<?php } ?>