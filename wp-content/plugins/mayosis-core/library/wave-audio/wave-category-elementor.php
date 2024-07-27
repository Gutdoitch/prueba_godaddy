<?php
function mayosis_wave_cat_elementor($settings){ ?>


<?php 
global $post;
$mayosis_audio = get_post_meta($post->ID, 'audio_url',true);
$wavecolor=$settings['product_wave_color'];
 $primaryopcitywave = mayosis_hexto_rgb($wavecolor, 0.25);
 $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

 $peakpath= plugins_url( '/', __FILE__ );
 
    $recent_section_title = $settings['title'];
    $listlayout= $settings['list_layout'];
    $pstyle= $settings['product_style'];
    
  
        
   $row= '';
   if ( $listlayout == '2') {
       $msvrowclass = 'col-12 col-md-6';
   } elseif ( $listlayout == '3'){
        $msvrowclass = 'col-12 col-md-4';
   } elseif ( $listlayout == '4'){
        $msvrowclass = 'col-12 col-md-3';
        
   } elseif ( $listlayout == '5'){
        $msvrowclass = 'col';
        $row= 'row-cols-1 row-cols-md-5';
        
   } elseif ( $listlayout == '6'){
        $msvrowclass = 'col-12 col-md-2';
   } else {
        $msvrowclass = 'col-12 col-md-12';
   }
 ?>
 <?php if ($pstyle == "two"){?>
 
 <div class="row">
 
  <?php $term=get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $CatTerms=(isset($term->slug))?$term->slug:null;
    $paged=( get_query_var( 'paged')) ? get_query_var( 'paged') : 1;
    if ( ! isset( $wp_query->query['orderby'] ) ) {
        $args = array(
            'order' => 'DESC',
            'post_type' => 'download',
            'download_category'=>$CatTerms,
            'paged' => $paged );
    } else {
        switch ($wp_query->query['orderby']) {
            case 'newness_asc':
                $args = array(
                    'orderby' => 'newness_asc',
                    'order' => 'ASC',
                    'post_type' => 'download',
                    'download_category'=>$CatTerms,
                    'paged' => $paged );
                break;
            case 'newness_desc':
                $args = array(
                    'orderby' => 'newness_desc',
                    'order' => 'DESC',
                    'post_type' => 'download',
                    'download_category'=>$CatTerms,
                    'paged' => $paged );
                break;
            case 'sales':
                $args = array(
                    'meta_key'=>'_edd_download_sales',
                    'order' => 'DESC',
                    'orderby' => 'meta_value_num',
                    'download_category'=>$CatTerms,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
            case 'price_asc':
                $args = array(
                    'meta_key'=>'edd_price',
                    'order' => 'ASC',
                    'orderby' => 'meta_value_num',
                    'download_category'=>$CatTerms,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
                
                case 'price_desc':
                $args = array(
                    'meta_key'=>'edd_price',
                    'order' => 'DESC',
                    'orderby' => 'meta_value_num',
                    'download_category'=>$CatTerms,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
                
                case 'title_asc':
                $args = array(
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'download_category'=>$CatTerms,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
                
                case 'title_desc':
                $args = array(
                    'orderby' => 'title',
                    'order' => 'DESC',
                    'download_category'=>$CatTerms,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
        } }
   
    $wp_query = new \WP_Query(); $wp_query->query($args);
    
    if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
    $max_num_pages = $wp_query->max_num_pages;
    $mayosis_audio = get_post_meta($post->ID, 'audio_url',true);
    $featured_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'mayosis-audio-list-thumbnail' );  
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
        $jsxarchive= "<script type='text/javascript'>
        var awp_player_archive$postidx; 
        jQuery(document).ready(function($){
         var settings = {
                    instanceName:'defaultarhive$postidx',
                    sourcePath:'$peakpath',
                   playlistList:'#awp-playlist-list-archive$postidx',
                    activePlaylist:'#playlist-audio-archive$postidx',
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
                
                  awp_player_archive$postidx = $('#awp_player_archive$postidx').awp(settings);
        
        }); 
        </script>";
        echo mayosis_compress_js_lines($jsxarchive);
        ?>
    
        <div id="awp_player_archive<?php echo $postidx;?>" class="<?php echo $msvrowclass;?> mayosis-awp-player-box-msb">

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
        <div id="awp-playlist-list-archive<?php echo $postidx;?>">

             <!-- audio playlist -->
             <div id="playlist-audio-archive<?php echo $postidx;?>">

          
                 
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
        
            <?php endwhile;
          wp_reset_postdata();?>
<?php else : ?>
<h4 class="msv-no-p-title">No products Available on this category</h4>
<?php endif; ?>
 </div>
 
 <?php } else { ?>
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
                        height: 100,
                    },
                    togglePlaybackOnPlaylistItem:true,

                };
                awp_player = $("#awp-wrapper").awp(settings); 

            });

        </script>
 
	
        <!-- player code -->   
        <div id="awp-wrapper" class="awp-play-overlay awp-wall4">

            <div class="awp-player-thumb-wrapper">

                <div class="awp-playback-toggle awp-contr-btn">
                    <div class="awp-btn awp-btn-play">
                        <i class="fa fa-play"></i>
                    </div>
                    <div class="awp-btn awp-btn-pause">
                        <i class="fa fa-pause"></i>
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
            <?php if($recent_section_title){?>
            <h3 class="msb-title-section-tld"><?php echo esc_html($recent_section_title);?> <?php single_cat_title( __( '', 'mayosis' ) ); ?></h3>
            <?php } ?>
            
            <div class="awp-playlist-holder">
                <div class="awp-playlist-filter-msg"><p>NOTHING FOUND!</p></div>
                <div class="awp-playlist-inner">
                    <div class="awp-playlist-content row <?php echo $row;?>">
                        <!-- playlist items are appended here! --> 
      
                    </div>
                                      
                        <div class="nav-links">
<?php if (function_exists("mayosis_page_navs")) { mayosis_page_navs(); } ?>
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


          

            

            

            <div class="awp-tooltip"></div>

        </div>     
       
        <!-- PLAYLIST LIST -->
        <div id="awp-playlist-list">

             <div id="playlist-audio2">
                 
                   <?php
    $term=get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $CatTerms=(isset($term->slug))?$term->slug:null;
    $paged=( get_query_var( 'paged')) ? get_query_var( 'paged') : 1;
    if ( ! isset( $wp_query->query['orderby'] ) ) {
        $args = array(
            'order' => 'DESC',
            'post_type' => 'download',
            'download_category'=>$CatTerms,
            'paged' => $paged );
    } else {
        switch ($wp_query->query['orderby']) {
            case 'newness_asc':
                $args = array(
                    'orderby' => 'newness_asc',
                    'order' => 'ASC',
                    'post_type' => 'download',
                    'download_category'=>$CatTerms,
                    'paged' => $paged );
                break;
            case 'newness_desc':
                $args = array(
                    'orderby' => 'newness_desc',
                    'order' => 'DESC',
                    'post_type' => 'download',
                    'download_category'=>$CatTerms,
                    'paged' => $paged );
                break;
            case 'sales':
                $args = array(
                    'meta_key'=>'_edd_download_sales',
                    'order' => 'DESC',
                    'orderby' => 'meta_value_num',
                    'download_category'=>$CatTerms,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
            case 'price_asc':
                $args = array(
                    'meta_key'=>'edd_price',
                    'order' => 'ASC',
                    'orderby' => 'meta_value_num',
                    'download_category'=>$CatTerms,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
                
                case 'price_desc':
                $args = array(
                    'meta_key'=>'edd_price',
                    'order' => 'DESC',
                    'orderby' => 'meta_value_num',
                    'download_category'=>$CatTerms,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
                
                case 'title_asc':
                $args = array(
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'download_category'=>$CatTerms,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
                
                case 'title_desc':
                $args = array(
                    'orderby' => 'title',
                    'order' => 'DESC',
                    'download_category'=>$CatTerms,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
        } }
   
    $wp_query = new \WP_Query(); $wp_query->query($args); ?>
    <?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
    
    global $post;
     $featured_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'mayosis-audio-cat-thumbnail' ); 
     $mayosis_audio = get_post_meta($post->ID, 'audio_url',true);
    ?>
                    
                <div class="awp-playlist-item <?php echo $msvrowclass;?>" data-type="audio" data-mp3="<?php echo esc_url($mayosis_audio);?>" data-thumb="<?php echo $featured_img_url[0];?>" >
                    <div class="mav-title-cat-mn">
                        
                        <div class="product-meta">
                            <?php get_template_part( 'includes/product-meta' ); ?>

                        </div>
                    </div>
                </div>

          <?php endwhile;
          wp_reset_postdata();?>
<?php else : ?>
<h4 class="msv-no-p-title">No products Available on this category</h4>
<?php endif; ?>



            </div>

        </div>    	
<?php } ?>
<?php 

}