<?php
function mayosis_wave_all_elementor($settings){ ?>


<?php 
global $post;
$mayosis_audio = get_post_meta($post->ID, 'audio_url',true);
$wavecolor=$settings['product_wave_color'];
 $primaryopcitywave = mayosis_hexto_rgb($wavecolor, 0.25);
 $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
 $thumbstate=get_theme_mod( 'product_thumbnail_state','disable');
 $product_playlist=get_theme_mod( 'product_playlist','disable');
 $peakpath= plugins_url( '/', __FILE__ );
 
   $post_count = ! empty( $settings['item_per_page'] ) ? (int)$settings['item_per_page'] : 5;
   $post_order_term=$settings['order'];
    $categories= $settings['category'];
        $tags = $settings['tags'];
        $downloads_category_not=$settings['categorynotin'];
        $post_style = $settings['post_style'];
        $listlayout= $settings['list_layout'];
        $ptype= $settings['product_type'];
        
   
   if ( $listlayout == '2') {
       $msvrowclass = 'col-md-6';
   } elseif ( $listlayout == '3'){
        $msvrowclass = 'col-md-4';
   } elseif ( $listlayout == '4'){
        $msvrowclass = 'col-md-3';
   } else {
        $msvrowclass = 'col-md-12';
   }
 ?>
 <?php if ($post_style=="normal"){ ?>
<div class="row">
 
  <?php
                   global $post;
                   global $wp_query; 
						if ( get_query_var('paged') ) {
							$paged = get_query_var('paged');
						} else if ( get_query_var('page') ) {
							$paged = get_query_var('page');
						} else {
							$paged = 1;
						}
               if ($ptype == "featured"){
                    $args = array(
                            'post_type' => 'download',
                            'posts_per_page' => $post_count,
                            'meta_key' => 'edd_feature_download',
                            'order' => (string)trim($post_order_term),);
                   
               } elseif($ptype == "popular"){
                 $args = array(
                            'post_type' => 'download',
                            'posts_per_page' => $post_count,
                            'orderby' => 'meta_value_num',
                              'meta_key' => 'hits',
                            'order' => (string)trim($post_order_term),);
               
               } else {
                    $args = array(
                            'post_type' => 'download',
                            'posts_per_page' => $post_count,
                            'order' => (string)trim($post_order_term),);
               }
                   
                            
                            
                             
         if(!empty($categories[0])) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'download_category',
          'field'    => 'ids',
          'terms'    => $categories
        )
      );
    }
    
    if(!empty($tags[0])) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'download_tag',
          'field'    => 'ids',
          'terms'    => $tags
        )
      );
    }
    
     if(!empty($downloads_category_not[0])) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'download_category',
          'field'    => 'ids',
          'terms'    => $downloads_category_not,
          'operator' => 'NOT IN'
        )
      );
    }
               
                 $the_query =new \WP_Query($args);
    while ($the_query -> have_posts()) : $the_query -> the_post();
    $max_num_pages = $the_query->max_num_pages;
    $mayosis_audio = get_post_meta($post->ID, 'audio_url',true);
    $featured_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'mayosis-product-wave-small-audio' );  
    $author = get_user_by( 'id', get_query_var( 'author' ) );
    $author_id=$post->post_author;
    $download_cats = get_the_term_list( get_the_ID(), 'download_category', '', _x(', ', '', 'mayosis' ), '' );
    $envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );
    $productfreeoptins= get_theme_mod( 'product_free_options','custom' );
$productcustomtext= get_theme_mod( 'free_text','FREE' );
    if ($envato_item_id){
    $api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
    $item_price = $api_item_results_json['price_cents'];
    $item_url = $api_item_results_json['url'];
    $item_number_of_sales = $api_item_results_json['number_of_sales'];
        
}


      global $edd_logs;
        $single_count = $edd_logs->get_log_count(66, 'file_download');
        $total_count  = $edd_logs->get_log_count('*', 'file_download');
        $sales = edd_get_download_sales_stats( get_the_ID() );
        $sales = $sales > 1 ? $sales . ' sales' : $sales . ' sale';
        $price = edd_get_download_price(get_the_ID());
        
         $postidx = $post->ID;
    
                 ?>
   <!-- player code -->  
   
        <?php
        $jsx= "<script type='text/javascript'>
        var awp_player$ptype$postidx; 
        jQuery(document).ready(function($){
         var settings = {
                    instanceName:'default$ptype$postidx',
                    sourcePath:'$peakpath',
                    playlistList:'#awp-playlist-list$ptype$postidx',
                    activePlaylist:'#playlist-audio$ptype$postidx',
                    activeItem:0,
                    volume:0.5,
                    autoPlay:false,
                    drawWaveWithoutLoad:false,
                    randomPlay:false,
                    loopingOn:true,
                    autoAdvanceToNextMedia:false,
                    mediaEndAction:'pause',
                    useKeyboardNavigationForPlayback:true,
                    usePlaylistScroll:true,
                    playlistScrollOrientation:'vertical',
                    playlistScrollTheme:'light',
                    useNumbersInPlaylist: true,
                    wavesurfer:{
                       waveColor: '$primaryopcitywave',
                        progressColor: '$wavecolor',   
                        barWidth: 0,
                        barRadius: 0,
                        cursorColor: '#0000ff',
                        cursorWidth: 0,
                        height: 90,
                        barGap: 0,
                    },
                    

                };
                
                 awp_player$ptype$postidx = $('#awp-wrapper$ptype$postidx').awp(settings);
        
        }); 
        </script>";
        echo mayosis_compress_js_lines($jsx);
        ?>
    
        <div id="awp-wrapper<?php echo $ptype;?><?php echo $postidx;?>" class="<?php echo $msvrowclass;?> mayosis-awp-player-box-msb">

            <div class="awp-player-wrap">

                <div class="awp-player-thumb-wrapper">
    			
        			<div class="awp-player-thumb"></div>

                    <div class="awp-playback-controls">

                        
            			
            			<div class="awp-playback-toggle awp-contr-btn">
                            <div class="awp-btn awp-btn-play">
                                <i class="fa fa-play"></i>
                            </div>
                            <div class="awp-btn awp-btn-pause">
                                <i class="fa fa-pause"></i>
                            </div>
                        </div>


                    </div>

                   

                </div>

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
                    
                  

                </div>
                
                
                  <div class="msb-ad-post-content">
                      <div class="row">
                         <div class="product-audio-meta-titlebar col-12 col-md-8">
                            <h3><a href="<?php the_permalink();?>"><?php echo esc_html( get_the_title() );?></a></h3>
                            <div class="msb-alt-metas">
                            <span class="opacitydown75"><?php esc_html_e("by","mayosis"); ?></span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">


                <?php echo get_the_author_meta( 'display_name',$author_id);?>
            </a>
            <?php if ($download_cats){?>
             <span class="opacitydown75"><?php esc_html_e("in","mayosis"); ?></span> <span><?php echo '<span>' . $download_cats . '</span>'; ?></span>
            <?php } ?>
            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="msb-inner-meta-price">
                    
                                <?php if ($envato_item_id) { ?>
                                    <span><?php esc_html_e('$','mayosis');?><?php echo number_format(($item_price /100), 2, '.', ' ');?></span>
                                <?php } else { ?>
                                    <?php if( $price == "0.00"  ){ ?>
                                        <?php if ($productfreeoptins=='none'): ?>
                                            <span><?php edd_price(get_the_ID()); ?></span>
                                        <?php else: ?>
                                            <span><?php echo esc_html($productcustomtext); ?></span>
                                        <?php endif;?>
                    
                    
                                    <?php } else { ?>
                                        <div class="product-price promo_price"><?php edd_price(get_the_ID()); ?></div>
                                    <?php } ?>
                                <?php } ?>
                    
                            </div>
                            </div>
                            </div>
                    </div>
                    

            </div>
              
            <div class="awp-playlist-holder">
                <div class="awp-playlist-filter-msg"><p>NOTHING FOUND!</p></div>
                <div class="awp-playlist-inner">
                    <div class="awp-playlist-content">
                        <!-- playlist items are appended here! --> 
                    </div>
                </div>
                
                <div class="awp-preloader"></div>

                

            </div>

          

          

            <div class="awp-tooltip"></div>
        
        </div>  



        <!-- PLAYLIST LIST -->
        <div id="awp-playlist-list<?php echo $ptype; ?><?php echo $postidx;?>">

             <!-- audio playlist -->
             <div id="playlist-audio<?php echo $ptype; ?><?php echo $postidx;?>">

          
                 
                 <div class="awp-playlist-item mayosis-plylist-list-style-mws" data-type="audio" data-mp3="<?php echo esc_url($mayosis_audio);?>" 
                 data-thumb="<?php echo $featured_img_url[0];?>"
                 >
                    <div class="product-audio-meta-fwall row align-items-center">
                       
                      
                        
                        <div class="mayosis-purchase-btn-audio col-md-3">
                                <?php echo  edd_get_purchase_link( array( 'download_id' => get_the_ID() ) );?>
                            </div>
                        
                        </div> 
                     
                 </div>
          
          
        
                
           

             </div>

        </div>    
        
           <?php endwhile; wp_reset_postdata(); ?>
 </div>
 
 <?php } else { ?>
<script type="text/javascript">

            var awp_player2
            
            
            jQuery(document).ready(function($){
                
                var settings2 = {
                    instanceName:"wall2_2",
                    sourcePath:"<?php echo plugins_url( '/', __FILE__ ) ?>",
                    playlistList:"#awp-playlist-list",
                    activePlaylist:"#playlist-audio2",
                    activeItem:0,
                    volume:0.5,
                    autoPlay:false,
                    preload:"auto",
                    randomPlay:false,
                    loopingOn:true,
                    autoAdvanceToNextMedia:false,
                    usePlaylistScroll:false,
                    playlistScrollOrientation:"vertical",
                    playlistScrollTheme:"minimal",
                    useTooltips:true,
                    useKeyboardNavigationForPlayback:false,
                    useNumbersInPlaylist: false,
                    playlistItemContent:"thumb",
                     wavesurfer:{
                        waveColor: '<?php echo esc_html($primaryopcitywave);?>',
                        progressColor: '<?php echo esc_html($wavecolor);?>',   
                        barWidth: 1,
                        cursorColor: '#1e1450',
                        cursorWidth: 1,
                        height: 50,
                        barGap: 2,
                    },
                    togglePlaybackOnPlaylistItem:true,
                };

                awp_player2 = $("#awp-wrapper2").awp(settings2); 

            });
        </script>
 <!-- player code -->   
       <!-- player code -->   
        <div id="awp-wrapper2" class="awp-wall2 awp-play-overlay mayosis-awp-wall-pls">
      
            <div class="awp-playlist-holder">
                <div class="awp-playlist-inner">
                    <div class="awp-playlist-content">
                        <!-- playlist items are appended here! --> 
                    </div>
                </div>
            </div> 

            <!-- preloader --> 
            <div class="awp-preloader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="awp-player-holder">
                 <div class="awp-player-thumb"></div>  

                <div class="awp-playback-toggle awp-contr-btn">
                    <div class="awp-btn awp-btn-play">
                        <i class="fa fa-play"></i>
                    </div>
                    <div class="awp-btn awp-btn-pause">
                        <i class="fa fa-pause"></i>
                    </div>
                </div>

                <div class="awp-prev-toggle awp-contr-btn" data-tooltip="Previous"><i class="fa fa-step-backward"></i></div>
                
                <div class="awp-next-toggle awp-contr-btn" data-tooltip="Next"><i class="fa fa-step-forward"></i></div>

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

                

                <div class="awp-playback-rate-toggle awp-contr-btn" data-tooltip="Speed">
                    <i class="fa fa-asterisk"></i>
                </div>


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

          

            <div class="awp-playback-rate-holder">

                <div class="awp-playback-rate-wrap">
                    <div class="awp-playback-rate-min"></div>
                    <div class="awp-playback-rate-seekbar">
                         <div class="awp-playback-rate-bg">
                            <div class="awp-playback-rate-level"><!--<div class="awp-playback-rate-drag"></div>--></div>
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
                 <?php
                   global $post;
                   global $wp_query; 
						if ( get_query_var('paged') ) {
							$paged = get_query_var('paged');
						} else if ( get_query_var('page') ) {
							$paged = get_query_var('page');
						} else {
							$paged = 1;
						}
               
                    $args = array(
                            'post_type' => 'download',
                            'posts_per_page' => $post_count,
                            'order' => (string)trim($post_order_term),);
                            
                            
                             
         if(!empty($categories[0])) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'download_category',
          'field'    => 'ids',
          'terms'    => $categories
        )
      );
    }
    
    if(!empty($tags[0])) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'download_tag',
          'field'    => 'ids',
          'terms'    => $tags
        )
      );
    }
    
     if(!empty($downloads_category_not[0])) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'download_category',
          'field'    => 'ids',
          'terms'    => $downloads_category_not,
          'operator' => 'NOT IN'
        )
      );
    }
               
                 $the_query =new \WP_Query($args);
    while ($the_query -> have_posts()) : $the_query -> the_post();
    $max_num_pages = $the_query->max_num_pages;
    $mayosis_audio = get_post_meta($post->ID, 'audio_url',true);
    $featured_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'mayosis-product-wave-small-audio' );  
    $author = get_user_by( 'id', get_query_var( 'author' ) );
    $author_id=$post->post_author;
    $download_cats = get_the_term_list( get_the_ID(), 'download_category', '', _x(', ', '', 'mayosis' ), '' );
    $envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );
    $productfreeoptins= get_theme_mod( 'product_free_options','custom' );
$productcustomtext= get_theme_mod( 'free_text','FREE' );
    if ($envato_item_id){
    $api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
    $item_price = $api_item_results_json['price_cents'];
    $item_url = $api_item_results_json['url'];
    $item_number_of_sales = $api_item_results_json['number_of_sales'];
}


      global $edd_logs;
        $single_count = $edd_logs->get_log_count(66, 'file_download');
        $total_count  = $edd_logs->get_log_count('*', 'file_download');
        $sales = edd_get_download_sales_stats( get_the_ID() );
        $sales = $sales > 1 ? $sales . ' sales' : $sales . ' sale';
        $price = edd_get_download_price(get_the_ID());
    
                 ?>
                 
                 <div class="awp-playlist-item mayosis-plylist-list-style-mws" data-type="audio" data-mp3="<?php echo esc_url($mayosis_audio);?>" 
                 data-thumb="<?php echo $featured_img_url[0];?>"
                 >
                    <div class="product-audio-meta-fwall row align-items-center">
                        <div class="product-audio-meta-titlebar col-12 col-md-7">
                            <h3><a href="<?php the_permalink();?>"><?php echo esc_html( get_the_title() );?></a></h3>
                            <span class="opacitydown75"><?php esc_html_e("by","mayosis"); ?></span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">


                <?php echo get_the_author_meta( 'display_name',$author_id);?>
            </a>
            <?php if ($download_cats){?>
             <span class="opacitydown75"><?php esc_html_e("in","mayosis"); ?></span> <span><?php echo '<span>' . $download_cats . '</span>'; ?></span>
            <?php } ?>
                        </div>
                        <div class="product-audio-meta-titlebar col-md-2">
                                                  <div class="msb-inner-meta-price">
                    
                                <?php if ($envato_item_id) { ?>
                                    <span><?php esc_html_e('$','mayosis');?><?php echo number_format(($item_price /100), 2, '.', ' ');?></span>
                                <?php } else { ?>
                                    <?php if( $price == "0.00"  ){ ?>
                                        <?php if ($productfreeoptins=='none'): ?>
                                            <span><?php edd_price(get_the_ID()); ?></span>
                                        <?php else: ?>
                                            <span><?php echo esc_html($productcustomtext); ?></span>
                                        <?php endif;?>
                    
                    
                                    <?php } else { ?>
                                        <div class="product-price promo_price"><?php edd_price(get_the_ID()); ?></div>
                                    <?php } ?>
                                <?php } ?>
                    
                            </div>
                            
                            
                        </div>
                        
                        <div class="mayosis-purchase-btn-audio col-md-3">
                                <?php echo  edd_get_purchase_link( array( 'download_id' => get_the_ID() ) );?>
                            </div>
                        
                        </div> 
                     
                 </div>
          
          
           <?php endwhile; wp_reset_postdata(); ?>
                
                

                 
            </div>

        </div>    

		

<?php }

}