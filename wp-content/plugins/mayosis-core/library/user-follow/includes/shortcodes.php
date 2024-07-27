<?php
/**
 * Shows the links to follow/unfollow a user
 *
 * @access      private
 * @since       1.0
 * @return      string
 */

function teconce_follow_links_shortcode( $atts, $content = null ) {

    extract( shortcode_atts( array(
            'follow_id' => get_the_author_meta( 'ID' )
        ),
            $atts, 'follow_links' )
    );

    return teconce_get_follow_unfollow_links( $follow_id );
}
add_shortcode( 'follow_links', 'teconce_follow_links_shortcode' );

/**
 * Shows the posts from users that the current user follows
 *
 * @access      private
 * @since       1.0
 * @return      string
 */

function teconce_following_posts_shortcode( $atts, $content = null ) {

    // Make sure the current user follows someone
    if( empty( teconce_get_following() ) )
        return;

    $items = new WP_Query( array(
        'post_type'      => 'download',
        'author__in'     => teconce_get_following()
    ) );

    ob_start(); ?>
    <ul class="recent_image_block">
        <?php if( $items->have_posts() ) : ?> <?php while( $items->have_posts() ) : $items->the_post(); ?>
            <li class="grid-product-box">
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
            </li>

        <?php endwhile; ?> <?php wp_reset_postdata(); ?> <?php else : ?>
            <ul>
                <ul>
                    <li class="teconce_following_post teconce_following_no_results"><?php _e( 'None of the users you follow have posted anything.', 'teconce' ); ?></li>
                </ul>
            </ul>
        <?php endif; ?>
    </ul>
    <?php return ob_get_clean();

}
add_shortcode( 'following_posts', 'teconce_following_posts_shortcode' );

/**
 * Shows current user follows
 *
 * @access      private
 * @since       1.0
 * @return      string
 */

function teconce_follower_shortcode( $atts, $content = null ) {

    // Make sure the current user follows someone
    if( empty( teconce_get_followers() ) )
        return;

    $user_id = get_current_user_id();

    $include =  teconce_get_followers();
    $userarg = array(
        'include' => $include,
        'orderby'      => 'include',
    );
    $allUsers = get_users($userarg);

    ob_start(); ?>
    <?php if ($allUsers){?>
        <div class="mayos-full-followr-box">
            <?php
            foreach($allUsers as $user){
                global $post;
                $post_count = count_user_posts($user->ID);

                $author = $post->post_author;
                $authorID= get_the_author_meta('ID', $user->ID );
                ?>

                <div class="mayos-follower-box">
                    <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$authorID) ) ?>">
                        <?php
                        echo get_avatar($user->user_email, '100', array(
                            'class' => array(
                                'd-block',
                                'img-responsive'
                            )
                        )); ?></a>
                    <div class="mayos-follow-content">
                        <h4><?php echo get_the_author_meta( 'display_name',$authorID);?></h4>

                        <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$authorID) ) ?>">View Portfolio</a>
                    </div>


                </div>

                <?php
            }

            ?>
        </div>
    <?php } else { ?>
        <h5 class="without-follow-txt-mayosis"><?php esc_html_e('You Have No Followers','mayosis-core');?></h5>
    <?php } ?>

    <?php return ob_get_clean();

}
add_shortcode( 'get_follower', 'teconce_follower_shortcode' );


/**
 * Shows current user following user
 *
 * @access      private
 * @since       1.0
 * @return      string
 */

function teconce_following_shortcode( $atts, $content = null ) {

    // Make sure the current user follows someone
    if( empty( teconce_get_following() ) )
        return;

    $user_id = get_current_user_id();

    $include =  teconce_get_following();
    $userarg = array(
        'include' => $include,
        'orderby'      => 'include',
    );
    $allUsers = get_users($userarg);

    ob_start(); ?>
    <?php if ($allUsers){?>
        <div class="mayos-full-followr-box">
            <?php
            foreach($allUsers as $user){
                global $post;
                $post_count = count_user_posts($user->ID);
                $author = $post->post_author;
                $authorID= get_the_author_meta('ID', $user->ID );
                ?>

                <div class="mayos-follower-box">
                    <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$authorID) ) ?>">
                        <?php
                        echo get_avatar($user->user_email, '100', array(
                            'class' => array(
                                'd-block',
                                'img-responsive'
                            )
                        )); ?></a>
                    <div class="mayos-follow-content">
                        <h4><?php echo get_the_author_meta( 'display_name',$authorID);?></h4>

                        <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$authorID) ) ?>">View Portfolio</a>
                    </div>


                </div>

                <?php
            }

            ?>
        </div>
    <?php } else { ?>
        <h5 class="without-follow-txt-mayosis"><?php esc_html_e('You Do Not Follow Anyone','mayosis-core');?></h5>
    <?php } ?>

    <?php return ob_get_clean();

}
add_shortcode( 'get_following', 'teconce_following_shortcode' );