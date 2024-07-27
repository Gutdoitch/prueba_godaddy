<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $post;
$productgridsystem= get_theme_mod( 'product_grid_system','one' );
$author = get_user_by( 'id', get_query_var( 'author' ) );
$author_id = get_the_author_meta('ID');
$vendorprofileimage =get_the_author_meta( 'fes_cover_photo',$author->ID);
$contentlayouts  = get_theme_mod( 'vendor_layout_control', array( 'products','sales','page','follower','following' ) );
?>

<div class="page-head vendor-page-header">
   
    <div class="container-fluid single-author--cover no-margin no-padding" style="background-image:url(<?php echo esc_url($vendorprofileimage); ?>);
    ">

    </div>
   
    <!-- Begin Page Headings Layout -->
    <div class="single--author--content has_mayosis_dark_alt_bg container-fluid">
        <div class="container">
            <div class="single--author--flex row">
                <div class="single--author--part col-12 col-lg-4">
                    <div class="author--name--image">
                        <?php echo get_avatar( $author->ID,100 ) ?>
                        <div class="author--identity--box">
                        <h5 class="author--single--title">
                            <?php echo get_the_author_meta( 'display_name',$author->ID );?>
                       </h5>
                        <p class="single--author-address"><?php echo get_the_author_meta( 'address',$author->ID);?></p>
                        </div>
                    </div>
                    <div class="author--box--btn">
                        <div class="follow--au--btn">
                             <?php
                             if ( is_user_logged_in() ) { ?>
                            <?php
                            $teconcefollow = teconce_get_follow_unfollow_links( $author->ID );
                            echo maybe_unserialize($teconcefollow);
                            ?>
                            <?php } else  { ?>
                            
                             <a href="#" data-toggle="modal" data-target="#authormessagelogin" class="tec-follow-link">Follow</a>
                            <?php } ?>
                        </div>
                    
                    </div>
                </div>

                <div class="single--meta--part col-12 col-lg-8">
                    <div class="single--meta--top--part row ">
                       <?php if ($contentlayouts): foreach ($contentlayouts as $layout) {
 
                            switch($layout) {
                         
                         
                                case 'products': get_template_part( 'content/content-items/author-download-product-count' );
                                break;
                                
                                
                                 case 'page': get_template_part( 'content/content-items/author-download-page-view' );
                                break;
                                
                                
                                 case 'follower': get_template_part( 'content/content-items/auhor-download-follower' );
                                break;
                         
                               
                                case 'following': get_template_part( 'content/content-items/author-download-following' );
                                break;
                         
                            }
                         
                        }
                         
                        endif; ?>
                      
                    </div> <!-- top part-->

                    <div class="single--meta--bottom--part row">
                        <div class="bottom--meta--social col-12 col-md-6">
                            <ul class="icons">
                                <?php
                                $facebook_profile = get_the_author_meta( 'facebook_profile',$author->ID );
                                if ( $facebook_profile && $facebook_profile != '' ) {
                                    echo '<li class="facebook"><a href="' . esc_url($facebook_profile) . '"><i class="zil zi-facebook" aria-hidden="true"></i>
</a></li>';
                                }
                                
                                $twitter_profile = get_the_author_meta( 'twitter_profile',$author->ID );
                                if ( $twitter_profile && $twitter_profile != '' ) {
                                    echo '<li class="twitter"><a href="' . esc_url($twitter_profile) . '"><i class="zil zi-twitter" aria-hidden="true"></i>
</a></li>';
                                }
                                
                                 $linkedin_profile = get_the_author_meta( 'linkedin_profile',$author->ID );
                                if ( $linkedin_profile && $linkedin_profile != '' ) {
                                    echo '<li class="linkedin"><a href="' . esc_url($linkedin_profile) . '"><i class="zil zi-linked-in" aria-hidden="true"></i>
</a></li>';
                                }
                                
                                $behance_profile = get_the_author_meta( 'behance_profile',$author->ID );
                                if ( $behance_profile && $behance_profile != '' ) {
                                    echo '<li class="rss"><a href="' . esc_url($behance_profile) . '"><i class="zil zi-behance" aria-hidden="true"></i>
</a></li>';
                                }

                                $dribble_profile = get_the_author_meta( 'dribble_profile',$author->ID );
                                if ( $dribble_profile && $dribble_profile != '' ) {
                                    echo '<li class="google"><a href="' . esc_url($dribble_profile) . '" rel="author"><i class="zil zi-dribbble" aria-hidden="true"></i>
</a></li>';
                                }
                                
                                  $pinterest_profile = get_the_author_meta( 'pinterest_profile',$author->ID );
                                if ( $pinterest_profile && $pinterest_profile != '' ) {
                                    echo '<li class="pinterest"><a href="' . esc_url($pinterest_profile) . '"><i class="zil zi-pinterest" aria-hidden="true"></i>
</a></li>';
                                }
                                
                                $flicker_profile = get_the_author_meta( 'flicker_profile',$author->ID );
                                if ( $flicker_profile && $flicker_profile != '' ) {
                                    echo '<li class="flickr"><a href="' . esc_url($flicker_profile) . '"><i class="fab fa-flickr" aria-hidden="true"></i>
</a></li>';
                                }
                                
                                 $instagram_profile = get_the_author_meta( 'instagram_profile',$author->ID );
                                if ( $instagram_profile && $instagram_profile != '' ) {
                                    echo '<li class="instagram"><a href="' . esc_url($instagram_profile) . '"><i class="zil zi-instagram" aria-hidden="true"></i>
</a></li>';
                                }

                                ?>
                            </ul>
                        </div>
                        
                        <div class="bottom--meta--desc">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Page Headings Layout -->
</div>

 <!-- Modal Login Form -->
            <div class="modal fade authormessagelogin" id="authormessagelogin" tabindex="-1" role="dialog" aria-labelledby="authormessagelogin">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Login</h4>
                  </div>
                  <div class="modal-body">
                      <?php echo do_shortcode(' [edd_login]'); ?>
                  </div>
                </div>
              </div>
            </div>


<!-- Description -->
<div class="fes--description container">
    <?php $desc_vendor =get_the_author_meta( 'description',$author->ID);?>
    <?php if ($desc_vendor){ ?>
        <p><?php echo get_the_author_meta( 'description',$author->ID);?></p>
    <?php }?>
    
</div>
  
<!-- vendor searchbar -->
<div class="fes--vendor--searchbar">
   <div class="container">
       <div class="vendor--search--flex">
           <div class="vendor--search--box">
        
           <form role="search" method="GET" id="searchform" action="<?php echo esc_url(get_search_query( true )); ?>">
    <input type="text" name="search" id="search" placeholder="Search Portfolio">

    <span class="search-btn"><input value="" type="submit" placeholder="Submit"></span>
</form>

                
           </div>
           
           <div class="vendor--search-filter--box">
              
            <?php
             $authordownload =get_the_author_meta( 'ID',$author->ID );
            if( $terms = get_terms( 'download_category',
            array(
    'hide_empty' => true,
)) )  { ?>

      <select name="categoryfilter" class="category--filter product_filter_mayosis" onchange="if (this.value) window.location.href=this.value">
          <option value=null>Select category</option>
	<?php foreach ( $terms as $term ) { ?>
	<option name"categoryfilter" value="<?php echo esc_url(add_query_arg(array( 'download_category'=>$term->slug))); ?>"><?php echo esc_html($term->name) ?></option>'
	<?php } ?>
	</select>
<?php } ?>

                                                
               <?php if(function_exists('mayosis_cat_filter')){
                                                    mayosis_cat_filter();
                                                } ?>
           </div>
       </div>
   </div>
</div>



  <div class="vendor--product--box container has_mayosis_dark_bg">
                                            <?php 
                                            if ($productgridsystem=='two'): ?>
                                                <?php get_template_part( 'content/content-author-masonry' ); ?>
                                                 <?php elseif ($productgridsystem=='three'): ?>
                                                 
                                                   <?php get_template_part( 'content/content-author-justified' ); ?>
                                            <?php else : ?>
                                                <?php get_template_part( 'content/content-author-grid' ); ?>
                                            <?php endif; ?>
                                            <?php mayosis_page_navs(); ?>
                                            
                                            
                                          
                                            
                                            
</div>
<?php
                        $authordownload =get_the_author_meta( 'ID',$author->ID );
                        $paged=( get_query_var( 'paged')) ? get_query_var( 'paged') : 1;
                        $args = array(
                        'order' => 'DESC',
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'author' => $authordownload,
                        'paged' => $paged ,
                         
            );
            
    $temp = $wp_query; $wp_query = null;
    $wp_query = new WP_Query(); $wp_query->query($args); ?>

<?php if ( $wp_query->have_posts() ) : ?>
<div class="vendor-blog--main has_mayosis_dark_alt_bg">
    <div class="container">
        <h5>Article By   <?php echo get_the_author_meta( 'display_name',$author->ID );?></h5>
                        
                           <div class="row">
    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
    
    
     <div class="col-md-4 col-12 col-sm-6">
					     <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			 		 <div class="blog-box grid_dm">
							<figure class="mayosis-fade-in"> 
							<a href="<?php
	the_permalink(); ?>"> 
								   <?php
								// display featured image?
								if ( has_post_thumbnail() ) :
									the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
<?php endif; ?>                         
								
							</a>
						<figcaption>
							    <div class="overlay_content_center blog_overlay_content">
							    <a href="<?php the_permalink(); ?>"><i class="zil zi-plus"></i></a>
							    </div>
							</figcaption>
						</figure>
						<div class="clearfix"></div>
						<div class="blog-meta">
					
                     <?php
 global $post;
 $categories = get_the_category($post->ID);
 $cat_link = get_category_link($categories[0]->cat_ID);
?>
					
							<h4 class="blog-title"><a href="<?php
	the_permalink(); ?>"> <?php
	the_title(); ?></a></h4>
							<div class="meta-bottom">
								<div class="user-info">
								<span><?php esc_html_e('by','mayosis'); ?></span>	<a href="<?php
	echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php
	the_author(); ?></a> <span><?php esc_html_e('in','mayosis'); ?></span>	<a href="<?php echo  esc_url($cat_link); ?>"><?php
	$category = get_the_category();
	$dmcat = $category[0]->cat_name;
	echo esc_html($dmcat); ?></a>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div><!-- .blog box -->
                    <!-- Blog Post-->
							</div>
					   </div>
					   
    <?php endwhile; else : ?>

</div>
    </div>
</div>

<?php endif; ?>