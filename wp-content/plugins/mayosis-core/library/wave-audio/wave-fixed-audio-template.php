<?php
function mayosis_fixed_template_audio(){ ?>
    <?php
    global $post;
    $author_id=$post->post_author;
    $download_id = get_the_ID();
    $mayosis_audio = get_post_meta($post->ID, 'audio_url',true);
    $wavecolor=get_theme_mod( 'wave_color','#5a00f0');
    $primaryopcitywave = mayosis_hexto_rgb($wavecolor, 0.25);
    $author_id=$post->post_author;
    $product_playlist=get_theme_mod( 'product_playlist','disable');
    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    $thumbstate=get_theme_mod( 'product_thumbnail_state','disable');
    $product_playlist=get_theme_mod( 'product_playlist','disable');
    $download_cats = get_the_term_list( get_the_ID(), 'download_category', '', _x(' , ', '', 'mayosis-core' ), '' );
    $audiotemplate= get_theme_mod( 'background_audio_hero', 'color');
    $audiofetpos= get_theme_mod( 'audio_featured_image_position', 'left');
    ?>
    <script type="text/javascript">
        var awp_player;

        jQuery(document).ready(function($){

            var settings = {
                instanceName:"fixed_bottom",
                sourcePath:"<?php echo plugins_url( '/', __FILE__ ) ?>",
                playlistList:"#awp-playlist-list",
                activePlaylist:"#playlist-audio2",
                activeItem:0,
                volume:0.5,
                autoPlay:false,
                preload:"auto",
                drawWaveWithoutLoad:false,
                randomPlay:false,
                loopingOn:true,
                autoAdvanceToNextMedia:true,
                mediaEndAction:"loop",
                usePlaylistScroll:true,
                playlistScrollOrientation:"vertical",
                playlistScrollTheme:"light",
                useKeyboardNavigationForPlayback:false,
                fbk:"",
                useNumbersInPlaylist: false,
                numberTitleSeparator: ".  ",
                artistTitleSeparator: " - ",
                playlistItemContent:"title,thumb",
                wavesurfer:{
                    waveColor: '<?php echo esc_html($primaryopcitywave);?>',
                    progressColor: '<?php echo esc_html($wavecolor);?>',
                    barWidth: 0,
                        barRadius: 0,
                        cursorColor: '#0000ff',
                        cursorWidth: 0,
                        height: 50,
                        barGap: 0,
                }
            };

            awp_player = $("#awp-wrapper").awp(settings);

        });



    </script>


 
<?php  if ( has_post_format('audio') ) { ?>


    <!-- player code -->
    <div id="awp-wrapper">
        
            <div class="maysosis-audio_hero position-relative">
        <?php if ($audiotemplate=='featured'){
            $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            ?>
            <div class="container-fluid featuredimagebg" style="background:url(<?php echo esc_url($feat_image); ?>) center center;">
            </div>
        <?php } ?>
        <div class="container">
            <div class="row">
                <?php if ($audiofetpos=="left"){ ?>
                    <div class="col-md-3 col-12">
                        <div class="awp-player-thumb-wrapper">

                            <div class="awp-player-thumb"></div>

                          

                           

                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-9 col-12">
                    <div class="mayosis-audio-template-data">
                        <h1 class="mayosis-music-main-title"><?php the_title();?></h1>

                        <div class="mayosis-audio-metabox">
                            <span class="opacitydown75"><?php esc_html_e("by","mayosis"); ?></span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">
                                <?php echo get_the_author_meta( 'display_name',$author_id);?>
                            </a><span class="opacitydown75"><?php esc_html_e("in","mayosis"); ?></span> <?php echo '<span>' . $download_cats . '</span>'; ?>
                            <span class="opacitydown75"><?php esc_html_e("on","mayosis"); ?> </span><span><?php echo esc_html(get_the_date()); ?></span>


                        </div>
                        <div class="mayosis-audio-button-set">
                            <h3 class="mayosis_music_price"><?php
                                if(edd_has_variable_prices($download_id)){
                                    echo edd_price_range( $download_id );
                                }
                                else{
                                    edd_price($download_id);
                                }
                                ?></h3>

                            <?php
                            if(edd_has_variable_prices($download_id)){ ?>
                                <a href="#mayosis_variable_price" class="btn audio_variable_btn" data-lity><i class="zil zi-cart"></i> <?php echo esc_html('Purchase','mayosis-core');?></a>

                                <div id="mayosis_variable_price" class="lity-hide">
                                    <h4><?php echo esc_html('Choose Your Desired Option(s)','mayosis-core');?></h4>
                                    <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
                                </div>
                            <?php } else { ?>
                                <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>

                            <?php } ?>

                            <div class="mayosis-audio-template-play-button">
                                <a href="" class="floating_play" onClick="awp_player.playMedia(); return false;"><i class="fa fa-play"></i></a>

                                <a href="#" class="floating_pause" onClick="awp_player.pauseMedia(); return false;"><i class="fa fa-pause"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <?php if ($audiofetpos=="right"){ ?>
                    <div class="col-md-3 col-12">
                        <div class="awp-player-thumb-wrapper">

                            <div class="awp-player-thumb"></div>

                            <div class="awp-playback-toggle"><i class="fa fa-play"></i></div>

                         

                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
  </div>
        <div class="container">
        <div class="row">
            <?php if ($product_playlist=="enable"){?>
                <div class="awp-playlist-holder col-xs-12">
                    <div class="awp-playlist-inner">
                        <div class="awp-playlist-content">
                            <!-- playlist items are appended here! -->
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>

       

        <div class="awp-player-holder">

            <div class="awp-playback-toggle awp-contr-btn">
                <div class="awp-btn awp-btn-play">
                    <i class="fa fa-play"></i>
                </div>
                <div class="awp-btn awp-btn-pause">
                    <i class="fa fa-pause"></i>
                </div>
            </div>


            <div class="awp-prev-toggle awp-contr-btn"><i class="fa fa-step-backward"></i></div>

            <div class="awp-next-toggle awp-contr-btn"><i class="fa fa-step-forward"></i></div>

            <div class="awp-media-time-current awp-contr-btn">0:00</div>

            <div class="awp-waveform-wrap">
                <div class="awp-waveform awp-hidden"></div>
                <div class="awp-waveform-img awp-hidden"><!-- image waveform backup -->
                    <div class="awp-waveform-img-load"></div>
                    <div class="awp-waveform-img-progress-wrap"><div class="awp-waveform-img-progress"></div></div>
                </div>
                <span class="awp-waveform-preloader"></span>
            </div>

            <div class="awp-media-time-total awp-contr-btn">0:00</div>

           

            <div class="awp-playback-rate-toggle d-none d-lg-block awp-contr-btn" data-tooltip="Speed">
                <i class="fa fa-asterisk"></i>
            </div>

            <div class="awp-playlist-toggle awp-contr-btn" data-tooltip="Playlist"><i class="fa fa-th-list"></i></div>

            <div class="awp-volume-wrapper awp-contr-btn">
                <div class="awp-player-volume awp-contr-btn awp-volume-toggable">
                    <div class="awp-btn awp-btn-volume-up">
                        <i class="fa fa-volume-up"></i>
                    </div>
                    <div class="awp-btn awp-btn-volume-down">
                        <i class="fa fa-volume-down"></i>
                    </div>
                    <div class="awp-btn awp-btn-volume-off">
                        <i class="fa fa-volume-off"></i>
                    </div>
                </div>
                <div class="awp-volume-seekbar awp-vertical ">
                    <div class="awp-volume-bg"></div>
                    <div class="awp-volume-level"></div>
                    <div class="awp-volume-seekbar-shadow-hider"></div>
                </div>
            </div>

        </div>

        <div class="awp-share-holder">

            <div class="awp-info-data">
                <div class="awp-player-title"></div>
                <div class="awp-player-desc"></div>
            </div>

            <div class="awp-share-holder-inner">

                <div class="awp-share-item awp-contr-btn" data-type="tumblr" data-tooltip="Share on Tumblr"><i class="fa fa-tumblr"></i></div>
                <div class="awp-share-item awp-contr-btn" data-type="twitter" data-tooltip="Share on Twitter"><i class="fa fa-twitter"></i></div>
                <div class="awp-share-item awp-contr-btn" data-type="facebook" data-tooltip="Share on Facebook"><i class="fa fa-facebook"></i></div>
                <div class="awp-share-item awp-contr-btn" data-type="whatsapp" data-tooltip="Share on WhatsApp"><i class="fa fa-whatsapp"></i></div>

            </div>

            <div class="awp-share-close awp-contr-btn" data-tooltip="Close"><i class="fa fa-close"></i></div>

        </div>

        <div class="awp-playback-rate-holder">

            <div class="awp-playback-rate-wrap">
                <div class="awp-playback-rate-min"></div>
                <div class="awp-playback-rate-seekbar">
                    <div class="awp-playback-rate-bg">
                        <div class="awp-playback-rate-level"></div>
                    </div>
                </div>
                <div class="awp-playback-rate-max"></div>
            </div>

            <div class="awp-playback-rate-close awp-contr-btn" data-tooltip="Close">
                <i class="fa fa-times"></i>
            </div>

        </div>

        <div class="awp-tooltip"></div>

    </div>

    <!-- PLAYLIST LIST -->
    <div id="awp-playlist-list">

     

        <div id="playlist-audio2">
            <?php if( have_rows('playlist_repeater') ): ?>

                <li class="awp-playlist-item" <?php if ($thumbstate=="enable"){?>data-thumb="<?php echo  $feat_image; ?>"<?php }?> data-type="audio" data-mp3="<?php echo $mayosis_audio;?>" data-title="<?php echo esc_html( get_the_title() );?>" ></li>

                <?php while( have_rows('playlist_repeater') ): the_row();

                    // vars
                    $songtitle = get_sub_field('song_title');
                    $coverimage = get_sub_field('song_cover_image');
                    $coversongs = get_sub_field('cover_songs');



                    ?>

                    <li class="awp-playlist-item" <?php if ($thumbstate=="enable"){?>data-thumb="<?php echo  $coverimage; ?>"<?php }?> data-type="audio" data-mp3="<?php echo $coversongs['url'];?>" data-title="<?php echo $songtitle;?>"></li>

                <?php endwhile; ?>


            <?php else :?>
                <li class="awp-playlist-item" <?php if ($thumbstate=="enable"){?>data-thumb="<?php echo  $feat_image; ?>"<?php }?> data-type="audio" data-mp3="<?php echo $mayosis_audio;?>" data-title="<?php echo esc_html( get_the_title() );?>"></li>
            <?php endif; ?>
        </div>

    </div>
<?php } else { ?>
<div class="audionon-m-boxs-g container">
  
    <div class="alert alert-warning" role="alert">
  If you want to show Waveplayer here, Please select <span>Audio</span> as the post format.
</div>
</div>
<?php } }