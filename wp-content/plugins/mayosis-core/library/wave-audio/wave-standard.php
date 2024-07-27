<?php
function mayosis_wave_standard_audio(){ ?>

    <?php
    global $post;
    $author_id=$post->post_author;
    $download_id = get_the_ID();
    $mayosis_audio = get_post_meta($post->ID, 'audio_url',true);
    $wavecolor=get_theme_mod( 'wave_color','#5a00f0');
    $primaryopcitywave = mayosis_hexto_rgb($wavecolor, 0.25);
    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
     $featured_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'mayosis-audio-cat-thumbnail' ); 
    $thumbstate=get_theme_mod( 'product_thumbnail_state','disable');
    $product_playlist=get_theme_mod( 'product_playlist','disable');
    $audiotemplate= get_theme_mod( 'background_audio_hero', 'color');
    $audiofetpos= get_theme_mod( 'audio_featured_image_position', 'left');
     $peakpath= plugins_url( '/', __FILE__ );
    
    $download_cats = get_the_term_list( get_the_ID(), 'download_category', '', _x(' , ', '', 'mayosis-core' ), '' );
    ?>
    <script type="text/javascript">

    
            

           
            
            
             var awp_player; 

            jQuery(document).ready(function($){
                
                var settings = {
                    instanceName:"wall4",
                    sourcePath:"<?php echo $peakpath;?>",
                    playlistList:"#awp-playlist-list",
                    activePlaylist:"#playlist-audio2",
                    activeItem:0,
                    volume:0.5,
                    autoPlay:false,
                    preload:"auto",
                    randomPlay:false,
                    loopingOn:true,
                    autoAdvanceToNextMedia:false,
                    sck:"",
                    useTooltips:true,
                    useKeyboardNavigationForPlayback:false,
                    usePlaylistScroll:false,
                    playlistScrollOrientation:"vertical",
                    playlistScrollTheme:"minimal",
                    useNumbersInPlaylist: false,
                    numberTitleSeparator: ".  ",
                    artistTitleSeparator: " - ",
                    playlistItemContent:"thumb",
                    wavesurfer:{
                         waveColor: '<?php echo $primaryopcitywave;?>',
                        progressColor: '<?php echo $wavecolor;?>',
                        barWidth: 0,
                        cursorColor: '#ffffff',
                        cursorWidth: 0,
                        height: 120,
                        
                    },
                    togglePlaybackOnPlaylistItem:true,

                };
                awp_player = $("#awp-wrapper").awp(settings); 

            });


    

    </script>
    
    <!-- player code -->
<?php  if ( has_post_format('audio') ) { ?>
    <div id="awp-wrapper">
        <div class="awp-player-wrap">
        <div class="maysosis-audio_hero_standard position-relative">
            <?php if ($audiotemplate=='featured'){
            $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            ?>
                <div class="container-fluid featuredimagebg" style="background:url(<?php echo esc_url($feat_image); ?>) center center;">
                </div>
            <?php } ?>
            <div class="maysosis-audio_hero_container">
                <div class="row gx-0 align-items-center">
               <?php if ($audiofetpos=="left"){ ?>
                         <div class="col-md-4 col-12">
                        <div class="awp-player-thumb-wrapper">

                            <div class="awp-player-thumb"></div>

                          	<div class="awp-playback-toggle awp-contr-btn">
                            <div class="awp-btn awp-btn-play">
                                <i class="fa fa-play"></i>
                            </div>
                            <div class="awp-btn awp-btn-pause">
                                <i class="fa fa-pause"></i>
                            </div>
                        </div>

                             <div class="awp-volume-wrapper">
                        <div class="awp-player-volume awp-contr-btn">
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
                        <div class="awp-volume-seekbar">
                             <div class="awp-volume-bg"><div class="awp-volume-level"></div></div>
                        </div>
                    </div>

                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-md-8 col-12">
                        
                        
                        
                     
                <div class="awp-player-holder">

                    <div class="awp-waveform-wrap">
                        <div class="awp-waveform awp-hidden"></div>  
                        <div class="awp-waveform-img awp-hidden"><!-- image waveform backup -->
                            <div class="awp-waveform-img-load"></div>
                            <div class="awp-waveform-img-progress-wrap"><div class="awp-waveform-img-progress"></div></div>
                        </div>
                        <span class="awp-waveform-preloader"></span>
                    </div>  

                    <div class="awp-media-time-total awp-hidden">0:00</div>
                    <div class="awp-media-time-current awp-hidden">0:00</div>

                    <div class="awp-bottom-controls">

                        <div class="awp-playback-rate-toggle awp-contr-btn" data-tooltip="Speed">
                            <i class="fa fa-asterisk"></i>
                        </div>

                        <div class="awp-share-toggle awp-contr-btn" data-tooltip="Share">
                            <i class="fa fa-share-square-o"></i>
                        </div>

                    </div>

                </div>
                      
                    </div>
                    
                    <?php if ($audiofetpos=="right"){ ?>
                         <div class="col-md-3 col-12">
                        <div class="awp-player-thumb-wrapper">

                            <div class="awp-player-thumb"></div>

                            <div class="awp-playback-toggle"><i class="fa fa-play"></i></div>

                            <div class="awp-volume-wrapper">
                                <div class="awp-player-volume"><i class="fa fa-volume-up"></i></div>
                                <div class="awp-volume-seekbar awp-tooltip-top">
                                    <div class="awp-volume-bg"></div>
                                    <div class="awp-volume-level"></div>
                                </div>
                            </div>

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
                    <div class="awp-playlist-filter-msg"><p>NOTHING FOUND!</p></div>
                    <div class="awp-playlist-inner">
                        <div class="awp-playlist-content">
                            <!-- playlist items are appended here! -->
                        </div>
                    </div>

                    <div class="awp-preloader"></div>



                </div>
            <?php } ?>
            </div>
        </div>
        
        </div>
    </div>




<!-- PLAYLIST LIST -->
        <div id="awp-playlist-list">

             <!-- audio playlist -->
             <div id="playlist-audio2">
                 <?php if( have_rows('playlist_repeater') ): ?>

                <div class="awp-playlist-item" data-type="audio" data-mp3="<?php echo $mayosis_audio;?>"  data-thumb="<?php echo $featured_img_url[0];?>">
                    
                  <div class="mav-title-cat-mn">
                        
                        <div class="product-meta">
                             <h3><?php the_title();?></h3>

                        </div>
                    </div>
                </div>

                <?php while( have_rows('playlist_repeater') ): the_row();

                    // vars
                    $songtitle = get_sub_field('song_title');
                    $coverimage = get_sub_field('song_cover_image');
                    $coversongs = get_sub_field('cover_songs');



                    ?>

                    <div class="awp-playlist-item" data-type="audio" data-mp3="<?php echo $coversongs['url'];?>" data-thumb="<?php echo  $coverimage; ?>" >
                       <div class="mav-title-cat-mn">
                        
                        <div class="product-meta">
                            <h3><?php echo esc_html($songtitle);?></h3>

                        </div>
                    </div>
                        
                    </div>

                <?php endwhile; ?>
                
              
            <?php else :?>
              
                <div class="awp-playlist-item" data-type="audio" data-mp3="<?php echo $mayosis_audio;?>" data-thumb="<?php echo $featured_img_url[0];?>">
                    
                  <div class="mav-title-cat-mn">
                        
                        <div class="product-meta">
                            <h3><?php the_title();?></h3>

                        </div>
                    </div>
                </div>
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