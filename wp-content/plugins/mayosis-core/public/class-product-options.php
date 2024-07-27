<?php
/**
*Mayosis Product Options
* */


if( function_exists('edd_get_settings') ) {
    remove_filter('the_content', 'edd_append_purchase_link');
    remove_filter('edd_after_download_content', 'edd_append_purchase_link');


}

// /////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////    Get Popular Product  Footer ////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_most_viewed_product_footer($posts_number = 3, $thumb = true)
{
    global $post;
    $original_post = $post;
    $args = array(
        'post_type' => 'download',
        'orderby' => 'meta_value_num',
        'meta_key' => 'hits',
        'posts_per_page' => $posts_number,
        'post_status' => 'publish',
        'no_found_rows' => true,
        'ignore_sticky_posts' => true
    );
    $popularposts = new WP_Query($args);
    if ($popularposts->have_posts()):
        while ($popularposts->have_posts()):
            $popularposts->the_post() ?>
            <div class="bottom-widget-product row gx-3 gy-0 row gx-3 gy-0 ">
                <div class="col-6 sidebar-thumbnail paading-left-0">
                    <div class="product-thumb grid_dm">
                        <figure class="mayosis-fade-in">
                            <?php
                            the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                            ?>
                            <figcaption>
                                <div class="overlay_content_center">
                                    <a href="<?php
                                    the_permalink(); ?>"><i class="zil zi-plus"></i></a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-6 sidebar-details paading-left-0">
                    <h3><a href="<?php
                        the_permalink(); ?>"><?php
                            the_title(); ?></a></h3>
                    <?php get_template_part( 'includes/product-additional-meta'); ?>


                </div>
                <div class="clearfix"></div>
            </div>
        <?php
        endwhile;
    endif;
    $post = $original_post;
    wp_reset_postdata();
}



// /////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////    Get Featured Product  Footer ////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_featured_product_footer($posts_number = 3, $thumb = true)
{
    global $post;
    $original_post = $post;
    $args = array(
        'post_type' => 'download',
        'orderby' => 'meta_value_num',
        'meta_key' => 'edd_feature_download',
        'posts_per_page' => $posts_number,
        'post_status' => 'publish',
        'no_found_rows' => true,
        'ignore_sticky_posts' => true
    );
    $popularposts = new WP_Query($args);
    if ($popularposts->have_posts()):
        while ($popularposts->have_posts()):
            $popularposts->the_post() ?>
            <div class="bottom-widget-product row gx-3 gy-0 ">
                <div class="col-6 sidebar-thumbnail paading-left-0">
                    <div class="product-thumb grid_dm">
                        <figure class="mayosis-fade-in">
                            <?php
                            the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                            ?>
                            <figcaption>
                                <div class="overlay_content_center">
                                    <a href="<?php
                                    the_permalink(); ?>"><i class="zil zi-plus"></i></a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-6 sidebar-details paading-left-0">
                    <h3><a href="<?php
                        the_permalink(); ?>"><?php
                            the_title(); ?></a></h3>
                    <?php get_template_part( 'includes/product-additional-meta'); ?>


                </div>
                <div class="clearfix"></div>
            </div>
        <?php
        endwhile;
    endif;
    $post = $original_post;
    wp_reset_postdata();
}


// /////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////    Get Related Product  Footer ////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_related_product_footer($posts_number = 3, $thumb = true)
{
    global $post;
    $original_post = $post;
    $exclude_post_id = $post->ID;
    $taxchoice = isset( $edd_options['related_filter_by_cat'] ) ? 'download_tag' : 'download_category';
    $custom_taxterms = wp_get_object_terms( $post->ID, $taxchoice, array('fields' => 'ids') );
    $args = array(
        'post_type' => 'download',
        'post_status' => 'publish',
        'posts_per_page' => $posts_number,
        'orderby' => 'rand',
        'ignore_sticky_posts' => 1,
        'post__not_in' => array($post->ID),
        'ignore_sticky_posts'=>1,
        'tax_query' => array(
            array(
                'taxonomy' => $taxchoice,
                'field' => 'id',
                'terms' => $custom_taxterms
            )
        ),
    );
    $popularposts = new WP_Query($args);
    if ($popularposts->have_posts()):
        while ($popularposts->have_posts()):
            $popularposts->the_post() ?>
            <div class="bottom-widget-product row gx-3 gy-0 ">
                <div class="col-6 sidebar-thumbnail paading-left-0">
                    <div class="product-thumb grid_dm">
                        <figure class="mayosis-fade-in">
                            <?php
                            the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                            ?>
                            <figcaption>
                                <div class="overlay_content_center">
                                    <a href="<?php
                                    the_permalink(); ?>"><i class="zil zi-plus"></i></a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-6 sidebar-details paading-left-0">
                    <h3><a href="<?php
                        the_permalink(); ?>"><?php
                            the_title(); ?></a></h3>
                    <?php get_template_part( 'includes/product-additional-meta'); ?>


                </div>
                <div class="clearfix"></div>
            </div>
        <?php
        endwhile;
    endif;
    $post = $original_post;
    wp_reset_postdata();
}



// /////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////    Masonry Related ////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_related_product_masonry($posts_number = 3, $thumb = true)
{
    global $post;
    $original_post = $post;
    $exclude_post_id = $post->ID;
    $taxchoice = isset( $edd_options['related_filter_by_cat'] ) ? 'download_tag' : 'download_category';
    $custom_taxterms = wp_get_object_terms( $post->ID, $taxchoice, array('fields' => 'ids') );
    $productmastitle= get_theme_mod( 'product_masonry_title_hover','1' );
    $titileboxstyle= get_theme_mod( 'product_masonry_hover_style','one' );
    $masonrymetastate= get_theme_mod( 'product_masonry_meta_state','disable' );
    $imageeffect= get_theme_mod( 'product_masonry_image_hover_style','disable' );
    if($imageeffect=='enable'){
        $imgeftcls='masonry-hover-effect-enabled';
    } else {
        $imgeftcls='';
    }
    $args = array(
        'post_type' => 'download',
        'post_status' => 'publish',
        'posts_per_page' => $posts_number,
        'orderby' => 'rand',
        'ignore_sticky_posts' => 1,
        'post__not_in' => array($post->ID),
        'ignore_sticky_posts'=>1,
        'tax_query' => array(
            array(
                'taxonomy' => $taxchoice,
                'field' => 'id',
                'terms' => $custom_taxterms
            )
        ),
    );
    $popularposts = new WP_Query($args);
    if ($popularposts->have_posts()):
        while ($popularposts->have_posts()):
            $popularposts->the_post() ?>
            <div class="product-masonry-item <?php echo esc_html($imgeftcls);?>" id="edd_download_<?php the_ID(); ?>">
                <div <?php post_class(); ?>>
                    <div class="product-masonry-item-content">
                        <?php if ( has_post_format( 'video' )) { ?>
                            <div class="item-thumbnail item-video-masonry">
                                <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
                                <a href="<?php the_permalink();?>" class="video-masonry-link"></a>
                            </div>
                        <?php } else { ?>
                            <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                            <div class="item-thumbnail">
                                <a href="<?php the_permalink();?>"><img src="<?php echo maybe_unserialize($thumbnail['0']); ?>" alt="<?php the_title();?>"></a>
                            </div>
                        <?php } ?>
                        <?php if ($productmastitle==1){?>

                            <?php if ($titileboxstyle== "one"){ ?>
                                <div class="product-masonry-description">

                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                                </div>

                            <?php } elseif ($titileboxstyle== "three"){ ?>

                                <div class="product-masonry-description masonry-style-three">
                                    <div class="product_hover_details_button">
                                        <a href="<?php the_permalink();?>"  class="button-fill-color"><?php esc_html_e('View Details','mayosis-core');?></a>
                                    </div>

                                </div>
                            <?php } else { ?>
                                <div class="product-masonry-description masonry-style-two">

                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>

                                    <div class="bottom-metaflex">
                                        <?php if ( function_exists( 'edd_favorites_load_link' ) ) {
                                            edd_favorites_load_link( $download_id );
                                        } ?> <span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">

								     <i class="zil zi-user"></i>
								 </a></span>
                                    </div>
                                </div>
                            <?php } ?>

                        <?php } ?>

                        <?php if ($masonrymetastate=="enable"){?>
                            <div class="product-meta">
                                <?php get_template_part( 'includes/product-meta' ); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
    endif;
    $post = $original_post;
    wp_reset_postdata();
}



// /////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////    Justified Related ////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_related_product_justified($posts_number = 3, $thumb = true)
{
    global $post;
    $original_post = $post;
    $exclude_post_id = $post->ID;
    $taxchoice = isset( $edd_options['related_filter_by_cat'] ) ? 'download_tag' : 'download_category';
    $custom_taxterms = wp_get_object_terms( $post->ID, $taxchoice, array('fields' => 'ids') );
  $justified_gap= get_theme_mod( 'product_justified_gap','5' );
$productmastitle= get_theme_mod( 'product_justified_title_hover','1' );
$titileboxstyle= get_theme_mod( 'product_justified_hover_style','one' );
$author = get_user_by( 'id', get_query_var( 'author' ) );
$author_id=$post->post_author;
    $args = array(
        'post_type' => 'download',
        'post_status' => 'publish',
        'posts_per_page' => $posts_number,
        'orderby' => 'rand',
        'ignore_sticky_posts' => 1,
        'post__not_in' => array($post->ID),
        'ignore_sticky_posts'=>1,
        'tax_query' => array(
            array(
                'taxonomy' => $taxchoice,
                'field' => 'id',
                'terms' => $custom_taxterms
            )
        ),
    );
    $popularposts = new WP_Query($args);
    if ($popularposts->have_posts()):
        while ($popularposts->have_posts()):
            $popularposts->the_post() ?>
             <div class="justified-items" id="edd_download_<?php the_ID(); ?>">
                                  <div class="product-justify-item ">
                            <div class="product-justify-item-content">
                               <?php if ( has_post_format( 'video' )) { ?>
                                        <div class="item-thumbnail item-video-justify">
                                            <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
                                        </div>
                                    <?php } else { ?>
                                    <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                                    <div class="item-thumbnail">
                                    <a href="<?php the_permalink();?>"><img src="<?php echo maybe_unserialize($thumbnail['0']); ?>" alt="<?php the_title()?>"></a>
                                     </div>
                                    <?php } ?>
                                <?php if ($productmastitle==1){?>
                                
                                <?php if ($titileboxstyle== "one"){ ?>
                                <div class="product-justify-description">
                                    
                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                                    </div>
                                    
                                <?php } elseif ($titileboxstyle== "three"){ ?>
                                
                                 <div class="product-justify-description justify-style-three">
                                     <div class="product_hover_details_button">
                                  <a href="<?php the_permalink();?>"  class="button-fill-color"><?php esc_html_e('View Details','mayosis');?></a>
                                </div>
                                    
                                    </div>
                                <?php } else { ?>
                                <div class="product-justify-description justify-style-two">
                                    
                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                                    
                                    <div class="bottom-metaflex">
                                    <?php if ( function_exists( 'edd_favorites_load_link' ) ) {
                        edd_favorites_load_link( $download_id );
                    } ?> <span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">
								     
								     <i class="zil zi-user"></i>
								 </a></span>
								 </div>
                                </div>
                                <?php } ?>
                                
                                <?php } ?>
                            </div>
                        </div>
                        </div>
        <?php
        endwhile;
    endif;
    $post = $original_post;
    wp_reset_postdata();
}

// /////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////    Masonry Same Author ////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_same_author_product_masonry($posts_number = 3, $thumb = true)
{
    global $post;
    $original_post = $post;
    $exclude_post_id = $post->ID;
    $taxchoice = isset( $edd_options['related_filter_by_cat'] ) ? 'download_tag' : 'download_category';
    $custom_taxterms = wp_get_object_terms( $post->ID, $taxchoice, array('fields' => 'ids') );
    $productmastitle= get_theme_mod( 'product_masonry_title_hover','1' );
    $titileboxstyle= get_theme_mod( 'product_masonry_hover_style','one' );
    $masonrymetastate= get_theme_mod( 'product_masonry_meta_state','disable' );
    $imageeffect= get_theme_mod( 'product_masonry_image_hover_style','disable' );
    $author= $post->post_author;
    if($imageeffect=='enable'){
        $imgeftcls='masonry-hover-effect-enabled';
    } else {
        $imgeftcls='';
    }
    $args = array(
        'post_type' => 'download',
        'post_status' => 'publish',
        'posts_per_page' => $posts_number,
        'orderby' => 'rand',
        'ignore_sticky_posts' => 1,
        'post__not_in' => array($post->ID),
        'ignore_sticky_posts'=>1,
        'author'=> $author,
    );
    $popularposts = new WP_Query($args);
    if ($popularposts->have_posts()):
        while ($popularposts->have_posts()):
            $popularposts->the_post() ?>
            <div class="product-masonry-item <?php echo esc_html($imgeftcls);?>" id="edd_download_<?php the_ID(); ?>">
                <div <?php post_class(); ?>>
                    <div class="product-masonry-item-content">
                        <?php if ( has_post_format( 'video' )) { ?>
                            <div class="item-thumbnail item-video-masonry">
                                <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
                                <a href="<?php the_permalink();?>" class="video-masonry-link"></a>
                            </div>
                        <?php } else { ?>
                            <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                            <div class="item-thumbnail">
                                <a href="<?php the_permalink();?>"><img src="<?php echo maybe_unserialize($thumbnail['0']); ?>" alt="<?php the_title();?>"></a>
                            </div>
                        <?php } ?>
                        <?php if ($productmastitle==1){?>

                            <?php if ($titileboxstyle== "one"){ ?>
                                <div class="product-masonry-description">

                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                                </div>

                            <?php } elseif ($titileboxstyle== "three"){ ?>

                                <div class="product-masonry-description masonry-style-three">
                                    <div class="product_hover_details_button">
                                        <a href="<?php the_permalink();?>"  class="button-fill-color"><?php esc_html_e('View Details','mayosis-core');?></a>
                                    </div>

                                </div>
                            <?php } else { ?>
                                <div class="product-masonry-description masonry-style-two">

                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>

                                    <div class="bottom-metaflex">
                                        <?php if ( function_exists( 'edd_favorites_load_link' ) ) {
                                            edd_favorites_load_link( $download_id );
                                        } ?> <span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">

								     <i class="zil zi-user"></i>
								 </a></span>
                                    </div>
                                </div>
                            <?php } ?>

                        <?php } ?>

                        <?php if ($masonrymetastate=="enable"){?>
                            <div class="product-meta">
                                <?php get_template_part( 'includes/product-meta' ); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
    endif;
    $post = $original_post;
    wp_reset_postdata();
}

// /////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////    Justified Same Author ////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_same_author_product_justified($posts_number = 3, $thumb = true)
{
    global $post;
    $original_post = $post;
    $exclude_post_id = $post->ID;
    $taxchoice = isset( $edd_options['related_filter_by_cat'] ) ? 'download_tag' : 'download_category';
    $custom_taxterms = wp_get_object_terms( $post->ID, $taxchoice, array('fields' => 'ids') );
  $justified_gap= get_theme_mod( 'product_justified_gap','5' );
$productmastitle= get_theme_mod( 'product_justified_title_hover','1' );
$titileboxstyle= get_theme_mod( 'product_justified_hover_style','one' );
 $author= $post->post_author;
		$exclude_post_id = $post->ID;
    $args = array(
        'post_type' => 'download',
        'post_status' => 'publish',
        'posts_per_page' => $posts_number,
        'orderby' => 'rand',
        'ignore_sticky_posts' => 1,
        'post__not_in' => array($post->ID),
        'ignore_sticky_posts'=>1,
       'author'=> $author,
    );
    $popularposts = new WP_Query($args);
    if ($popularposts->have_posts()):
        while ($popularposts->have_posts()):
            $popularposts->the_post() ?>
             <div class="justified-items" id="edd_download_<?php the_ID(); ?>">
                                  <div class="product-justify-item ">
                            <div class="product-justify-item-content">
                               <?php if ( has_post_format( 'video' )) { ?>
                                        <div class="item-thumbnail item-video-justify">
                                            <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
                                        </div>
                                    <?php } else { ?>
                                    <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                                    <div class="item-thumbnail">
                                    <a href="<?php the_permalink();?>"><img src="<?php echo maybe_unserialize($thumbnail['0']); ?>" alt="<?php the_title()?>"></a>
                                     </div>
                                    <?php } ?>
                                <?php if ($productmastitle==1){?>
                                
                                <?php if ($titileboxstyle== "one"){ ?>
                                <div class="product-justify-description">
                                    
                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                                    </div>
                                    
                                <?php } elseif ($titileboxstyle== "three"){ ?>
                                
                                 <div class="product-justify-description justify-style-three">
                                     <div class="product_hover_details_button">
                                  <a href="<?php the_permalink();?>"  class="button-fill-color"><?php esc_html_e('View Details','mayosis');?></a>
                                </div>
                                    
                                    </div>
                                <?php } else { ?>
                                <div class="product-justify-description justify-style-two">
                                    
                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                                    
                                    <div class="bottom-metaflex">
                                    <?php if ( function_exists( 'edd_favorites_load_link' ) ) {
                        edd_favorites_load_link( $download_id );
                    } ?> <span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">
								     
								     <i class="zil zi-user"></i>
								 </a></span>
								 </div>
                                </div>
                                <?php } ?>
                                
                                <?php } ?>
                            </div>
                        </div>
                        </div>
        <?php
        endwhile;
    endif;
    $post = $original_post;
    wp_reset_postdata();
}


// /////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////    Get Related Product  Footer ////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_same_product_author($posts_number = 3, $thumb = true)
{
    global $post;
    $original_post = $post;
    $author= get_the_author_meta( 'ID' );
    $exclude_post_id = $post->ID;
    $args = array(
        'post_type' => 'download',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'ignore_sticky_posts' => 1,
        'post__not_in' => array($post->ID),
        'ignore_sticky_posts'=>1,
        'author'=> $author,
    );
    $popularposts = new WP_Query($args);
    if ($popularposts->have_posts()):
        while ($popularposts->have_posts()):
            $popularposts->the_post() ?>
            <div class="bottom-widget-product row gx-3 gy-0 ">
                <div class="col-6 sidebar-thumbnail paading-left-0">
                    <div class="product-thumb grid_dm">
                        <figure class="mayosis-fade-in">
                            <?php
                            the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                            ?>
                            <figcaption>
                                <div class="overlay_content_center">
                                    <a href="<?php
                                    the_permalink(); ?>"><i class="zil zi-plus"></i></a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-6 sidebar-details paading-left-0">
                    <h3><a href="<?php
                        the_permalink(); ?>"><?php
                            the_title(); ?></a></h3>
                    <?php get_template_part( 'includes/product-additional-meta'); ?>


                </div>
                <div class="clearfix"></div>
            </div>
        <?php
        endwhile;
    endif;
    $post = $original_post;
    wp_reset_postdata();
}




// /////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////   Exif Data ////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////


function mayosis_image_exif_data($postID = NULL) {
    // if $postID not specified, then get global post and assign ID
    if (!$postID) {
        global $post;
        $postID = $post->ID;
    }
    if (has_post_thumbnail($postID)) {
        // get the meta data from the featured image
        $postThumbnailID = get_post_thumbnail_id( $postID );
        $photoMeta = wp_get_attachment_metadata( $postThumbnailID );

        // if the shutter speed is not equal to 0
        if ($photoMeta['image_meta']['shutter_speed'] != 0) {

            // Convert the shutter speed to a fraction
            if ((1 / $photoMeta['image_meta']['shutter_speed']) > 1) {
                if ((number_format((1 / $photoMeta['image_meta']['shutter_speed']), 1)) == 1.3
                    or number_format((1 / $photoMeta['image_meta']['shutter_speed']), 1) == 1.5
                    or number_format((1 / $photoMeta['image_meta']['shutter_speed']), 1) == 1.6
                    or number_format((1 / $photoMeta['image_meta']['shutter_speed']), 1) == 2.5) {
                    $photoShutterSpeed = "1/" . number_format((1 / $photoMeta['image_meta']['shutter_speed']), 1, '.', '') . " second";
                } else {
                    $photoShutterSpeed = "1/" . number_format((1 / $photoMeta['image_meta']['shutter_speed']), 0, '.', '') . " second";
                }
            } else {
                $photoShutterSpeed = $photoMeta['image_meta']['shutter_speed'] . " seconds";
            }
            // print our definition list
            ?>
            <ul class="mayosis-exif-lists">
                <?php if ( isset( $photoMeta['image_meta']['created_timestamp'] ) && ! empty( $photoMeta['image_meta']['created_timestamp'] ) ){ ?>
                    <li class="mayosis-exif-item">
                        <div class="mayo-exif-tag mayo--exif--flex"><?php _e('Date Taken','mayosis-core');?></div>
                        <span class="mayo--exif--flex mayo-exif-dot">:</span>
                        <div class="mayo-exif-value mayo--exif--flex"><?php echo date("d M Y, H:i:s", $photoMeta['image_meta']['created_timestamp']); ?></div>
                    </li>
                <?php } ?>

                <?php if ( isset( $photoMeta['image_meta']['camera'] ) && ! empty( $photoMeta['image_meta']['camera'] ) ){ ?>
                    <li class="mayosis-exif-item">
                        <div class="mayo-exif-tag mayo--exif--flex"><?php _e('Camera','mayosis-core');?></div>
                        <span class="mayo--exif--flex mayo-exif-dot">:</span>
                        <div class="mayo-exif-value mayo--exif--flex"><?php echo $photoMeta['image_meta']['camera']; ?></div>
                    </li>
                <?php } ?>

                <?php if ( isset( $photoMeta['image_meta']['focal_length'] ) && ! empty( $photoMeta['image_meta']['focal_length'] ) ){ ?>
                    <li class="mayosis-exif-item">
                        <div class="mayo-exif-tag mayo--exif--flex"><?php _e('Focal Length','mayosis-core');?></div>
                        <span class="mayo--exif--flex mayo-exif-dot">:</span>
                        <div class="mayo-exif-value mayo--exif--flex"><?php echo $photoMeta['image_meta']['focal_length']; ?>mm</div>
                    </li>
                <?php } ?>

                <?php if ( isset( $photoMeta['image_meta']['aperture'] ) && ! empty( $photoMeta['image_meta']['aperture'] ) ){ ?>
                    <li class="mayosis-exif-item">
                        <div class="mayo-exif-tag mayo--exif--flex"><?php _e('Aperture','mayosis-core');?></div>
                        <span class="mayo--exif--flex mayo-exif-dot">:</span>
                        <div class="mayo-exif-value mayo--exif--flex">f/<?php echo $photoMeta['image_meta']['aperture']; ?></div>
                    </li>
                <?php } ?>

                <?php if ( isset( $photoMeta['image_meta']['iso'] ) && ! empty( $photoMeta['image_meta']['iso'] ) ){ ?>
                    <li class="mayosis-exif-item">
                        <div class="mayo-exif-tag mayo--exif--flex"><?php _e('ISO','mayosis-core');?></div>
                        <span class="mayo--exif--flex mayo-exif-dot">:</span>
                        <div class="mayo-exif-value mayo--exif--flex"><?php echo $photoMeta['image_meta']['iso']; ?></div>
                    </li>
                <?php } ?>

                <?php if ( isset( $photoShutterSpeed ) && ! empty( $photoShutterSpeed ) ){ ?>
                    <li class="mayosis-exif-item">
                        <div class="mayo-exif-tag mayo--exif--flex"><?php _e('Shutter Speed','mayosis-core');?></div>
                        <span class="mayo--exif--flex mayo-exif-dot">:</span>
                        <div class="mayo-exif-value mayo--exif--flex"><?php echo $photoShutterSpeed; ?></div>
                    </li>
                <?php } ?>

                <?php if ( isset( $photoMeta['image_meta']['credit'] ) && ! empty( $photoMeta['image_meta']['credit'] ) ){ ?>
                    <li class="mayosis-exif-item">
                        <div class="mayo-exif-tag mayo--exif--flex"><?php _e('Credit','mayosis-core');?></div>
                        <span class="mayo--exif--flex mayo-exif-dot">:</span>
                        <div class="mayo-exif-value mayo--exif--flex"><?php echo $photoMeta['image_meta']['credit']; ?></div>
                    </li>
                <?php } ?>

                <?php if ( isset( $photoMeta['image_meta']['copyright'] ) && ! empty( $photoMeta['image_meta']['copyright'] ) ){ ?>
                    <li class="mayosis-exif-item">
                        <div class="mayo-exif-tag mayo--exif--flex"><?php _e('Copyright','mayosis-core');?></div>
                        <span class="mayo--exif--flex mayo-exif-dot">:</span>
                        <div class="mayo-exif-value mayo--exif--flex"><?php echo $photoMeta['image_meta']['copyright']; ?></div>
                    </li>
                <?php } ?>

                <?php if ( isset( $photoMeta['image_meta']['orientation'] ) && ! empty( $photoMeta['image_meta']['orientation'] ) ){ ?>
                    <li class="mayosis-exif-item">
                        <div class="mayo-exif-tag mayo--exif--flex"><?php _e('Orientation','mayosis-core');?></div>
                        <span class="mayo--exif--flex mayo-exif-dot">:</span>
                        <div class="mayo-exif-value mayo--exif--flex"><?php echo $photoMeta['image_meta']['orientation']; ?></div>
                    </li>
                <?php } ?>

                <?php if ( isset( $photoMeta['image_meta']['caption'] ) && ! empty( $photoMeta['image_meta']['caption'] ) ){ ?>
                    <li class="mayosis-exif-item">
                        <div class="mayo-exif-tag mayo--exif--flex"><?php _e('Caption','mayosis-core');?></div>
                        <span class="mayo--exif--flex mayo-exif-dot">:</span>
                        <div class="mayo-exif-value mayo--exif--flex"><?php echo $photoMeta['image_meta']['caption']; ?></div>
                    </li>
                <?php } ?>
            </ul>
            <?php
            // if shutter speed exif is 0 then echo error message
        } else {
            echo '<p>EXIF data not found</p>';
        }
        // if no featured image, echo error message
    } else {
        echo '<p>Featured image not found</p>';
    }
}


function mayosis_download_child_categories(){
    global $post;

    $terms = wp_get_post_terms(
        $post->ID,
        'download_category',
        array(
            'parent' => 0
        )
    );
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
            echo '';
        }
    }
    $theCatId = get_term_by( 'slug', $term->name, 'download_category' );
    $theCatId = $theCatId->term_id;
    $taxonomy = 'download_category';
    $termchildren = get_term_children( $theCatId, $taxonomy );
    echo '<div class="layouts-block">';
    echo '<ul class="nav nav-tabs">';
    foreach ( $termchildren as $child ) {
        $term = get_term_by( 'id', $child, $taxonomy );
        echo '<li><a href="' . get_term_link( $child, $taxonomy ) . '">' . $term->name . '</a></li>';
    }
    echo '</ul>';
    echo '</div>';
}

function mayosis_edd_total_items(){
    $args = array(
        'post_type' => 'download',
        'posts_per_page'    => -1,
        'download_category' => ''
    );
    $query = new WP_Query($args);
    echo $query->found_posts;
}

function mayosis_cat_filter() { ?>
    <div class="mayosis-filter-title">
        <?php
        $old=null;
        $pricelowtohigh=null;
        $pricehightolow=null;
        $popular=null;
        $recent=null;
        $titleAtoZ=null;
        $titleZtoA=null;
        if(isset($_GET['orderby'])){
            if($_GET['orderby']=="price_asc"){
                $pricelowtohigh="selected";
            }

            else if($_GET['orderby']=="price_desc"){
                $pricehightolow="selected";
            }

            else if($_GET['orderby']=="newness_asc"){
                $recent="selected";
            }

            else if($_GET['orderby']=="newness_desc"){
                $old="selected";
            }
            else if($_GET['orderby']=="sales"){
                $popular="selected";
            }

            else if($_GET['orderby']=="title_asc"){
                $titleAtoZ="selected";
            }

            else if($_GET['orderby']=="title_desc"){
                $titleZtoA="selected";
            }


        }
        else{
            $old="selected";
        } ?>
        
         <?php 
            $layouts  = get_theme_mod( 'p_archive_sorting_items', array( 'popular','recent','older','pricel2h','priceh2l','titlea2z','titlez2a' ) )
            ?>
<?php

if ($layouts):?>
        <select class="product_filter_mayosis resizeselect" id="resizing_select" onchange="if (this.value) window.location.href=this.value">
            
            
            <?php 
            foreach ($layouts as $layout) {
            $poulararg = add_query_arg(array( "orderby"=>"sales"));
             switch($layout) {
                   case 'popular': 
                       
                       echo '<option '.esc_html($popular).' value='.esc_html($poulararg).'>'. esc_html__('Popular','mayosis-core').' </option>';
                       
               break;
               
               case 'recent': 
                    echo ' <option  '.esc_html($old).' value='.esc_url(add_query_arg(array( 'orderby'=>'newness_desc'))).'>'.esc_html__('Recent','mayosis-core').'</option>';
                break;
                
                
                case 'older': 
                    echo ' <option  '.esc_html($recent).' value='.esc_url(add_query_arg(array( 'orderby'=>'newness_asc'))).'>'.esc_html__('Older','mayosis-core').'</option>';
                break;
                
                
                 case 'pricel2h': 
                    echo ' <option  '.esc_html($pricelowtohigh).' value='.esc_url(add_query_arg(array( 'orderby'=>'price_asc'))).'>'.esc_html__('Price (Low to High)','mayosis-core').'</option>';
                break;
                
                
                case 'priceh2l': 
                    echo ' <option  '.esc_html($pricehightolow).' value='.esc_url(add_query_arg(array( 'orderby'=>'price_desc'))).'>'.esc_html__('Price (High to Low)','mayosis-core').'</option>';
                break;
                
                 case 'titlea2z': 
                    echo ' <option  '.esc_html($titleAtoZ).' value='.esc_url(add_query_arg(array( 'orderby'=>'title_asc'))).'>'.esc_html__('Title (A - Z)','mayosis-core').'</option>';
                break;
                
                case 'titlez2a': 
                    echo ' <option  '.esc_html($titleZtoA).' value='.esc_url(add_query_arg(array( 'orderby'=>'title_desc'))).'>'.esc_html__('Title (Z - A)','mayosis-core').'</option>';
                break;
                 
             }
             
            }
            ?>
  
        </select>
        <?php endif; ?>

    </div>

<?php }




/**
 * Get the parameters for ordering that we'll include in our select field
 *
 * @since 1.0.0
 * @return Array
 */
function mayosis_edd_orderby_params() {
    $params = array(
        'newness_asc' => array(
            'id' => 'newness_asc', // Unique ID 
            'title' => __( 'Newest first', 'mayosis-core' ), // Text to display in select option 
            'orderby' => 'post_date', // Orderby parameter, must be legit WP_Query orderby param 
            'order' => 'DESC' // Either ASC or DESC
        ),
        'newness_desc' => array(
            'id' => 'newness_desc',
            'title' => __( 'Oldest first', 'mayosis-core' ),
            'orderby' => 'post_date',
            'order' => 'ASC'
        ),
        'price_asc' => array(
            'id' => 'price_asc',
            'title' => __( 'Price (Lowest to Highest)', 'mayosis-core' ),
            'orderby' => 'meta_value_num',
            'order' => 'ASC'
        ),
        'price_desc' => array(
            'id' => 'price_desc',
            'title' => __( 'Price (Highest to Lowest)', 'mayosis-core' ),
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        ),
        'title_asc' => array(
            'id' => 'title_asc',
            'title' => __( 'Title (A - Z)', 'mayosis-core' ),
            'orderby' => 'title',
            'order' => 'ASC'
        ),
        'title_desc' => array(
            'id' => 'title_desc',
            'title' => __( 'Title (Z - A)', 'mayosis-core' ),
            'orderby' => 'title',
            'order' => 'DESC'
        )
    );
    $params = apply_filters( 'mayosis_edd_filter_orderby_params', $params );
    return $params;
}

/**
 * Filter the [downloads] query
 * @since 1.0.0
 * @param $query The query to filter
 * @param $atts The shortcode atts
 */
function mayosis_edd_filter_query( $query, $atts ) {
    // We're going to modify the order and orderby parameters depending on variables contained in the URL
    if( isset( $_GET['mayosis_orderby'] ) ) {
        // If a orderby option has been set, get the array of parameters
        $params = mayosis_edd_orderby_params();
        $orderby = $_GET['mayosis_orderby'];
        // Check the parameter that we've chosen exists
        if( isset( $params[$orderby] ) ) {
            $param = $params[$orderby];
            // Set the query parameters according to our selection
            $query['orderby'] = esc_attr( $param['orderby'] );
            $query['order'] = esc_attr( $param['order'] );
            if( strpos( $param['id'], 'price' ) !== false ) {
                // Specify meta key if we're querying by price
                $query['meta_key'] = 'edd_price';
            }
        }
    }
// Return the query, with thanks
    return $query;
}
add_filter( 'edd_downloads_query', 'mayosis_edd_filter_query', 10, 2 );

/**
 * Filter the [downloads] shortcode to add dropdown field
 * @since 1.0.0
 * @param $display The markup to print
 */
function mayosis_edd_add_dropdown( $display ) {
    $orderby = '';
    // Get the current parameter
    if( isset( $_GET['mayosis_orderby'] ) ) {
        $orderby = $_GET['mayosis_orderby'];
    }
    // Get the array of parameters
    $params = mayosis_edd_orderby_params();
    $select = '';
    if( ! empty( $params ) ) {
        // Build the select field
        $select = '<form class="mayofilter-edd-sorting">';
        $select .= '<select class="mayofilter-orderby" name="mayosis_orderby">';
        // Iterate through each parameter to add options to the select field
        foreach( $params as $param ) {
            $select .= '<option value="' . $param['id'] . '" ' . selected( $param['id'], $orderby, false ) . '>' . $param['title'] . '</option>';
        }
        $select .= '</select>';
        $select .= '</form>';
        // Add a script to submit the form when a new selection is made
        $select .= '<script>
      jQuery(document).ready(function($) {
        $(".mayofilter-orderby").change( function(){
          $(this).closest("form").submit();
        });
      });
    </script>';

        // Add the select field to the top of the downloads grid
        $display = $select . $display;
    }
    return $display;
}
add_filter( 'downloads_shortcode', 'mayosis_edd_add_dropdown', 10, 1 );
