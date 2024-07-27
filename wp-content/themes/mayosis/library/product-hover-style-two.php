<?php
$producthovertype= get_theme_mod( 'hover_two_style_type','plus' );
$icondclass = get_theme_mod('custom_icon_on_hvr_2');
?>

 <figcaption class="thumb-caption mayosis-hover-style-2">
                <a href="<?php the_permalink();?>" class="full-thumb-hover-plus">
                    <?php if ($producthovertype=="plus"){?>
                <i class="zil zi-plus"></i>
                <?php } ?>
                
                 <?php if ($producthovertype=="custom"){?>
                <i class="<?php echo esc_html($icondclass);?>"></i>
                <?php } ?>
                </a>
                
                
                 <?php if ($producthovertype=="audio"){?>
                 
                 <?php if ( has_post_format( 'audio' )) { ?>
                <?php $mayosis_audio = get_post_meta($post->ID, 'audio_url',true); ?>
<div class="mayosis-title-audio mayosis-style-two-player">
   <?php echo do_shortcode('[audio src="'.$mayosis_audio.'"]'); ?>
</div>
<?php } ?>

<div class="product-hover-two-cart">
      <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?> 
</div>
<?php } ?>
                </figcaption>