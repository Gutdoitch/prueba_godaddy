<?php
/**
*Mayosis Post Options
* */

// //////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////   Post View Count  /////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////
// function to display number of posts.

function mayosis_views($postID)
{
    global $post;
    if (empty($postID)) $postID = $post->ID;
    $count_key = 'mayosis_views';
    $count = get_post_meta($postID, $count_key, true);
    $count = @number_format($count);
    if (empty($count))
    {
        delete_post_meta($postID, $count_key);
        update_post_meta($postID, $count_key, 0);
        $count = 0;
    }

    return '<span class="post-views">' . $count . ' ' . __('Views', 'mayosis-digital-marketplace-theme') . '</span> ';
}

// function to count views.

function mayosis_setPostViews($postID)
{
    global $post;
    $count = 0;
    $postID = $post->ID;
    $count_key = 'mayosis_views';
    $count = (int)get_post_meta($postID, $count_key, true);
    if (!defined('WP_CACHE') || !WP_CACHE)
    {
        $count++;
        update_post_meta($postID, $count_key, (int)$count);
    }
}

// //////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////    Get Most Recent posts   /////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_sidebar_post($numberOfPosts = 5, $thumb = true)
{
    global $post;
    $orig_post = $post;
    $lastPosts = get_posts('no_found_rows=1&suppress_filters=0&numberposts=' . $numberOfPosts);
    $disablehit= get_theme_mod( 'disable_hit_count','show' );
    foreach($lastPosts as $post):
        setup_postdata($post);
        ?>
        <div class="widget-posts row gx-3 gy-0">

            <div class="col-6 sidebar-thumbnail">
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
                        $title  = the_title('','',false);
                        if(strlen($title) > 36):
                            echo trim(substr($title, 0, 32)).'...';
                        else:
                            echo esc_html($title);
                        endif;
                        ?></a></h3>
                <?php if ($disablehit== 'show'){ ?>
                    <p><?php echo(ajax_hits_counter_get_hits(get_the_ID())); ?>  <?php esc_html_e('Views','mayosis-core');?> </p>

                <?php } ?>

            </div>
        </div>
    <?php
    endforeach;
    $post = $orig_post;
    wp_reset_postdata();
}

// //////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////   Get Popular posts   /////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_popular_posts($pop_posts = 5, $thumb = true)
{
    global $post;
    $orig_post = $post;
    $popularposts = new WP_Query(array(
        'orderby' => 'comment_count',
        'order' => 'DESC',
        'posts_per_page' => $pop_posts,
        'post_status' => 'publish',
        'no_found_rows' => 1,
        'ignore_sticky_posts' => 1
    ));
    while ($popularposts->have_posts()):
        $popularposts->the_post() ?>
        <div class="widget-posts row gx-3 gy-0">

            <div class="col-6 sidebar-thumbnail">
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
                <?php if ($disablehit== 'show'){ ?>
                    <p><?php echo(ajax_hits_counter_get_hits(get_the_ID())); ?>  <?php esc_html_e('Views','mayosis-core');?>  </p>
                <?php } ?>



            </div>
        </div>
    <?php
    endwhile;
    $post = $orig_post;
    wp_reset_postdata();
}

// //////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////    Get Popular posts / Views   /////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_most_viewed_posts($posts_number = 5, $thumb = true)
{
    global $post;
    $original_post = $post;
    $disablehit= get_theme_mod( 'disable_hit_count','show' );
    $args = array(
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
            <div class="widget-posts row gx-3 gy-0">


                <div class="col-6 sidebar-thumbnail">
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
                    <?php if ($disablehit== 'show'){ ?>
                        <p><?php echo(ajax_hits_counter_get_hits(get_the_ID())); ?>  <?php esc_html_e('Views','mayosis-core');?> </p>
                    <?php } ?>


                </div>
            </div>
        <?php
        endwhile;
    endif;
    $post = $original_post;
    wp_reset_postdata();
}

// //////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////   Get Most Viewed posts  /////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_best_reviews_posts($pop_posts = 5, $thumb = true)
{
    global $post;
    $orig_post = $post;
    $cat_query1 = new WP_Query(array(
        'posts_per_page' => $pop_posts,
        'orderby' => 'meta_value_num',
        'meta_key' => 'mayosis_review_score',
        'post_status' => 'publish',
        'no_found_rows' => 1
    ));
    while ($cat_query1->have_posts()):
        $cat_query1->the_post() ?>
        <div class="widget-posts row gx-3 gy-0">
            <div class="col-6 sidebar-thumbnail">
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
                <p><?php
                    echo mayosis_views(get_the_ID()); ?> </p>
            </div>
        </div>
    <?php
    endwhile;
    $post = $orig_post;
}



// //////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////    Get Popular posts / Views  Footer ////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_most_viewed_posts_footer($posts_number = 3, $thumb = true)
{
    global $post;
    $original_post = $post;
    $disablehit= get_theme_mod( 'disable_hit_count','show' );
    $args = array(
        'orderby' => 'meta_value_num',
        'meta_key' => 'mayosis_views',
        'posts_per_page' => $posts_number,
        'post_status' => 'publish',
        'no_found_rows' => true,
        'ignore_sticky_posts' => true
    );
    $popularposts = new WP_Query($args);
    if ($popularposts->have_posts()):
        while ($popularposts->have_posts()):
            $popularposts->the_post() ?>
            <div class="bottom-widget-product ">
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
                        the_permalink(); ?>">
                            <?php
                            $title  = the_title('','',false);
                            if(strlen($title) > 40):
                                echo trim(substr($title, 0, 37)).'...';
                            else:
                                echo esc_html($title);
                            endif;
                            ?>
                        </a></h3>
                    <?php if ($disablehit== 'show'){ ?>
                        <p><?php echo(ajax_hits_counter_get_hits(get_the_ID())); ?>  <?php esc_html_e('Views','mayosis-core');?> </p>
                    <?php } ?>


                </div>
                <div class="clearfix"></div>
            </div>
        <?php
        endwhile;
    endif;
    $post = $original_post;
    wp_reset_postdata();
}