<?php
function mayosis_wave_fixed_audio(){ ?>
<?php 
global $post;
$mayosis_audio = get_post_meta($post->ID, 'audio_url',true);
$wavecolor=get_theme_mod( 'wave_color','#5a00f0');
$primaryopcitywave = mayosis_hexto_rgb($wavecolor, 0.25);
$author_id=$post->post_author;
 $product_playlist=get_theme_mod( 'product_playlist','disable');
 ?>
 <script type="text/javascript">
        var awp_player; 

           jQuery(document).ready(function($){

                var settings = {
                    instanceName:"fixed_bottom3",
                    sourcePath:"<?php echo plugins_url( '/', __FILE__ ) ?>",
                    playlistList:"#awp-playlist-list",
                    activePlaylist:"playlist-audio1",
                    activeItem:0,
                    volume:0.5,
                    autoPlay:false,
                    drawWaveWithoutLoad:false,
                    randomPlay:false,
                    loopingOn:true,
                    autoAdvanceToNextMedia:true,
                    mediaEndAction:"loop",
                    useKeyboardNavigationForPlayback:true,
                    usePlaylistScroll:true,
                    playlistScrollOrientation:"vertical",
                    playlistScrollTheme:"light",
                    useNumbersInPlaylist: true,
                    numberTitleSeparator: ".  ",
                    artistTitleSeparator: " - ",
                    playlistItemContent:"title",
                    wavesurfer:{
                        waveColor: '<?php echo esc_html($primaryopcitywave);?>',
                        progressColor: '<?php echo esc_html($wavecolor);?>',   
                        barWidth: 0,
                        cursorColor: '#1e1450',
                        cursorWidth: 0,
                        height: 50,
                    }
                };

                awp_player = $("#awp-wrapper").awp(settings);

            }); 


        </script>
           

  <!-- player code -->   
 
        <div id="awp-wrapper">
            
            <?php if ($product_playlist=="enable"){?>
      <div class="awp-playlist-holder">
                <div class="awp-playlist-inner">
                    <div class="awp-playlist-content">
                        <!-- playlist items are appended here! --> 
                    </div>
                </div>
            </div> 
           <?php } ?>
            <div class="awp-player-holder">
                
                 <section class="mayosis-wave-flex">
                
                <div class="mayosis-floating-music-bar-thumb d-none d-lg-block">
                    <?php the_post_thumbnail( 'mayosis-product-wave-small', array( 'class' => 'featured-img img-responsive watermark' ) ); ?>
                    <div class="mayosis-floating-box-title">
                        <span><?php the_title();?></span>
                        <p> by <?php echo get_the_author_meta( 'display_name',$author_id );?></p>
                    </div>
                    
                </div>
                
                
                <div class="mayosis-floating-player-wrap">

               	<div class="awp-playback-toggle awp-contr-btn">
                            <div class="awp-btn awp-btn-play">
                                <i class="fa fa-play"></i>
                            </div>
                            <div class="awp-btn awp-btn-pause">
                                <i class="fa fa-pause"></i>
                            </div>
                        </div>

    
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
           
                
                <div class="mayosis_download_preview-wrap">
                     <div class="mayosis_download_preview awp-contr-btn"><a href="<?php echo $mayosis_audio;?>" download="<?php echo esc_html( get_the_title() );?>"><i class="fa fa-download  awp-contr-btn-i awp-contr-btn-vol-i awp-icon-color"></i></a></div>
                </div>
                
                <div class="mayosis_add_to_cart_wrap">
                    <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?> 
                </div>
                
                           
            <?php if ($product_playlist=="enable"){?>
                <div class="awp-playlist-toggle"><i class="fa fa-th-list awp-contr-btn-i awp-icon-color"></i></div>
                <?php } ?>

            </div>  
            </section>

            </div>

        </div>     
       



        <!-- PLAYLIST LIST -->
        <div id="awp-playlist-list">

             <!-- audio playlist -->
             <ul id="playlist-audio1">


<?php if( have_rows('playlist_repeater') ): ?>
                
                         <li class="awp-playlist-item" data-type="audio" data-mp3="<?php echo $mayosis_audio;?>" data-peak-name="<?php echo esc_html( get_the_title() );?>" data-title="<?php echo esc_html( get_the_title() );?>" ></li>   
                         
                        <?php while( have_rows('playlist_repeater') ): the_row(); 

                    		// vars
                    		$songtitle = get_sub_field('song_title');
                    		$coverimage = get_sub_field('song_cover_image');
                    		$coversongs = get_sub_field('cover_songs');
                    		
                    	
                    
                    		?>
                             <li class="awp-playlist-item" data-type="audio" data-mp3="<?php echo $coversongs['url'];?>" data-peak-name="<?php echo $coversongs['filename']?>" data-title="<?php echo $songtitle;?>" ></li> 

                        <?php endwhile; ?>
                
                
                <?php else :?>
                 <li class="awp-playlist-item" data-type="audio" data-mp3="<?php echo $mayosis_audio;?>" data-peak-name="<?php echo esc_html( get_the_title() );?>" data-title="<?php echo esc_html( get_the_title() );?>" ></li> 
                <?php endif; ?>
               
                 
              

             </ul>

        </div>  

<?php }