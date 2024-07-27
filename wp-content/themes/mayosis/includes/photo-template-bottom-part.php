<?php
$productmascol= get_theme_mod( 'product_masonry_column','3' );
$productmastitle= get_theme_mod( 'product_masonry_title_hover','1' );
$titileboxstyle= get_theme_mod( 'product_masonry_hover_style','one' );
$relatedtdownloadstyle= get_theme_mod( 'related_download_style','justified' );
$productthumbvideo= get_theme_mod( 'thumbnail_video_play','show' );
$productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
$productvcontrol= get_theme_mod( 'thumb_video_control','minimal' );
$productcartshow= get_theme_mod( 'thumb_cart_button','hide' );
$productrelnumber= get_theme_mod( 'related_product_number','8' );
$productreltitle= get_theme_mod( 'related_product_title','Similar Images' );
$productthumbhoverstyle= get_theme_mod( 'product_thmub_hover_style','style1' );
$commentmode = get_theme_mod( 'media_coment','normal' );
$loadsrelatedfrom = get_theme_mod( 'ps_related_loads_from','download_category' );
?>
<div class="saleaction">
    <?php do_action('mayosis_date_echo');?>
</div>

<section class="container-fluid bottom-post-footer-widget photo-template-footer-bg">
    <div class="container photo-template-bottom-similar">
        <div class="bottom-product-sidebar">
            <h3><?php echo esc_html($productreltitle); ?></h3>
            <?php if ($relatedtdownloadstyle == 'normal') { ?>
            <div class="row">
                <?php } elseif ($relatedtdownloadstyle == 'masonry') { ?>
                <div class="product-masonry product-masonry-gutter product-masonry-style-2 product-masonry-masonry product-masonry-full product-masonry-<?php echo esc_html($productmascol); ?>-column">
                    <?php } else { ?>
                    <div class="gridzy justified-gallery-main gridzyLightProgressIndicator gridzyAnimated">


                        <?php } ?>

                        <?php
                        //Fetch data
                        $exclude_post_id = $post->ID;
                        $taxchoice = $loadsrelatedfrom;
                        $custom_taxterms = wp_get_object_terms($post->ID, $taxchoice, array('fields' => 'ids'));

                        $arguments = array(
                            'post_type' => 'download',
                            'post_status' => 'publish',
                            'posts_per_page' => $productrelnumber,
                            'order' => 'DESC',
                            'ignore_sticky_posts' => 1,
                            'post__not_in' => array($post->ID),
                            'ignore_sticky_posts' => 1,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $taxchoice,
                                    'field' => 'id',
                                    'terms' => $custom_taxterms
                                )
                            ),
                        );

                        $post_query = new WP_Query($arguments); ?>
                        <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
                            <?php $thumbnail = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>

                            <?php if ($relatedtdownloadstyle == 'normal') { ?>
                                <div class="col-md-3 col-12">

                                    <div class="grid_dm ribbon-box group
                                        edge">
                                        <div class="product-box">
                                            <?php
                                            $postdate = get_the_time('Y-m-d'); // Post date
                                            $postdatestamp = strtotime($postdate);

                                            $riboontext = get_theme_mod('recent_ribbon_text', 'New'); // Newness in days

                                            $newness = get_theme_mod('recent_ribbon_time', '30'); // Newness in days
                                            if ((time() - (60 * 60 * 24 * floatval($newness))) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
                                                echo '<div class="wrap-ribbon left-edge point lblue"><span>' . esc_html($riboontext) . '</span></div>';
                                            }
                                            ?>
                                            <figure class="mayosis-fade-in">


                                                <?php if ($productthumbvideo == 'show'){ ?>
                                                <?php if (has_post_format('video')) { ?>

                                                <div class="mayosis--video--box">
                                                    <div class="video-inner-box-promo">

                                                        <a href="<?php the_permalink(); ?>"
                                                           class="mayosis-video-url"></a>
                                                        <div class="video-inner-main">
                                                            <?php get_template_part('library/mayosis-video-box-thumb'); ?>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <?php if ($productcartshow == 'show') { ?>
                                                            <div class="product-cart-on-hover">
                                                                <?php echo edd_get_purchase_link(array('download_id' => get_the_ID())); ?>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($productvcontrol == 'minimal') { ?>
                                                            <div class="minimal-video-control">
                                                                <div class="minimal-control-left">

                                                                    <?php if (function_exists('edd_favorites_load_link')) {
                                                                        edd_favorites_load_link($download_id);
                                                                    } ?>
                                                                </div>


                                                                <div class="minimal-control-right">
                                                                    <ul>
                                                                        <li>    <?php echo edd_get_purchase_link(array('download_id' => get_the_ID())); ?>  </li>
                                                                        <?php $mayosis_video = get_post_meta($post->ID, 'video_url', true); ?>
                                                                        <li>
                                                                            <a href="<?php echo esc_attr($mayosis_video); ?>"
                                                                               data-lity>
                                                                                <i class="fa fa-arrows-alt"
                                                                                   aria-hidden="true"></i></a></li>

                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        <?php } ?>
                                                    </div>


                                                    <?php } else { ?>
                                                    <div class="mayosis--thumb">
                                                        <?php
                                                        // display featured image?
                                                        if (has_post_thumbnail()) :
                                                            the_post_thumbnail('full', array('class' => 'img-responsive'));
                                                        endif;

                                                        ?>
                                                        <?php } ?>

                                                        <?php } else { ?>

                                                        <div class="mayosis--thumb">
                                                            <?php
                                                            // display featured image?
                                                            if (has_post_thumbnail()) :
                                                                the_post_thumbnail('full', array('class' => 'img-responsive'));
                                                            endif;

                                                            ?>
                                                            <?php } ?>
                                                            <?php
                                                            if ($productthumbhoverstyle == 'style2') { ?>
                                                                <figcaption class="thumb-caption">
                                                                    <a href="<?php the_permalink(); ?>"
                                                                       class="full-thumb-hover-plus">
                                                                        <i class="zil zi-plus"></i>
                                                                    </a>
                                                                </figcaption>

                                                                <?php
                                                            } elseif ($productthumbhoverstyle == 'style3') { ?>

                                                                <?php get_template_part('library/product-hover-style-three'); ?>
                                                            <?php } else { ?>
                                                                <figcaption class="thumb-caption">
                                                                    <div class="overlay_content_center">
                                                                        <?php get_template_part('includes/product-hover-content-top'); ?>

                                                                        <div class="product_hover_details_button">
                                                                            <a href="<?php the_permalink(); ?>"
                                                                               class="button-fill-color"><?php esc_html_e('View Details', 'mayosis'); ?></a>
                                                                        </div>
                                                                        <?php
                                                                        $demo_link = get_post_meta(get_the_ID(), 'demo_link', true);
                                                                        $livepreviewtext = get_theme_mod('live_preview_text', 'Live Preview');
                                                                        ?>
                                                                        <?php if ($demo_link) { ?>
                                                                            <div class="product_hover_demo_button">
                                                                                <a href="<?php echo esc_url($demo_link); ?>"
                                                                                   class="live_demo_onh"
                                                                                   target="_blank"><?php echo esc_html($livepreviewtext); ?></a>
                                                                            </div>
                                                                        <?php } ?>

                                                                        <?php get_template_part('includes/product-hover-content-bottom'); ?>
                                                                    </div>
                                                                </figcaption>
                                                            <?php } ?>
                                                        </div>
                                            </figure>
                                            <div class="product-meta">
                                                <?php get_template_part('includes/product-meta'); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } elseif ($relatedtdownloadstyle == 'masonry') { ?>
                                <div class="product-masonry-item " id="edd_download_<?php the_ID(); ?>">
                                    <div <?php post_class(); ?>>
                                        <div class="product-masonry-item-content">
                                            <?php if (has_post_format('video')) { ?>
                                                <div class="item-thumbnail item-video-masonry">
                                                    <?php get_template_part('library/mayosis-video-box-thumb'); ?>
                                                </div>
                                            <?php } else { ?>
                                                <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
                                                <div class="item-thumbnail">
                                                    <a href="<?php the_permalink(); ?>"><img
                                                                src="<?php echo maybe_unserialize($thumbnail['0']); ?>"
                                                                alt="product thumbnail"></a>
                                                </div>
                                            <?php } ?>
                                            <?php if ($productmastitle == 1) { ?>

                                                <?php if ($titileboxstyle == "one") { ?>
                                                    <div class="product-masonry-description">

                                                        <h5>
                                                            <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                                                        </h5>
                                                    </div>

                                                <?php } elseif ($titileboxstyle == "three") { ?>

                                                    <div class="product-masonry-description masonry-style-three">
                                                        <div class="product_hover_details_button">
                                                            <a href="<?php the_permalink(); ?>"
                                                               class="button-fill-color"><?php esc_html_e('View Details', 'mayosis'); ?></a>
                                                        </div>

                                                    </div>
                                                <?php } else { ?>
                                                    <div class="product-masonry-description masonry-style-two">

                                                        <h5>
                                                            <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                                                        </h5>

                                                        <div class="bottom-metaflex">
                                                            <?php if (function_exists('edd_favorites_load_link')) {
                                                                edd_favorites_load_link($download_id);
                                                            } ?> <span> <a
                                                                        href="<?php echo mayosis_fes_author_url(get_the_author_meta('ID', $author_id)) ?>">
								     
								     <i class="zil zi-user"></i>
								 </a></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>


                                <div class="justified-items">
                                    <div <?php post_class(); ?>>
                                        <div class="product-justify-item-content">

                                            <?php if (has_post_format('video')) { ?>
                                                <div class="item-thumbnail item-video-justify">
                                                    <?php get_template_part('library/mayosis-video-box-thumb'); ?>
                                                </div>
                                            <?php } else { ?>

                                                <div class="item-thumbnail">
                                                    <a href="<?php the_permalink(); ?>"><img
                                                                src="<?php echo esc_url($thumbnail); ?>"
                                                                alt="product thumbnail"></a>
                                                </div>
                                            <?php } ?>
                                            <?php
                                            $titlebox = get_theme_mod('product_justified_title_hover', '1');
                                            $titileboxstylejustified = get_theme_mod('product_justified_hover_style', 'one');
                                            ?>
                                            <?php if ($titlebox == "1") { ?>

                                                <?php if ($titileboxstylejustified == "one") { ?>
                                                    <div class="product-justify-description">

                                                        <h5>
                                                            <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                                                        </h5>
                                                    </div>

                                                <?php } elseif ($titileboxstylejustified == "three") { ?>

                                                    <div class="product-justify-description justify-style-three">
                                                        <div class="product_hover_details_button">
                                                            <a href="<?php the_permalink(); ?>"
                                                               class="button-fill-color"><?php esc_html_e('View Details', 'mayosis'); ?></a>
                                                        </div>

                                                    </div>
                                                <?php } else { ?>
                                                    <div class="product-justify-description justify-style-two">

                                                        <h5>
                                                            <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                                                        </h5>

                                                        <div class="bottom-metaflex">
                                                            <?php if (function_exists('edd_favorites_load_link')) {
                                                                edd_favorites_load_link($download_id);
                                                            } ?> <span> <a
                                                                        href="<?php echo mayosis_fes_author_url(get_the_author_meta('ID', $author_id)) ?>">
								     
								     <i class="zil zi-user"></i>
								 </a></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>


                                        </div>
                                    </div>

                                </div>
                            <?php } ?>
                        <?php endwhile; else: ?>
                            <div class="col-lg-12 pm-column-spacing">
                                <p><?php esc_html_e('No posts were found.', 'mayosis'); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php wp_reset_postdata(); ?>
                    </div>
                    <div class="bottom_meta product--bottom--tag photo-bottom--tag">
                        <h3><?php esc_html_e('Keywords', 'mayosis'); ?></h3>
                        <?php $download_tags = get_the_term_list(get_the_ID(), 'download_tag', ' ', ' '); ?>
                        <?php echo '<span class="tags">' . $download_tags . '</span>'; ?>
                    </div>
                    <div class="clearfix"></div>
               
                </div>
            </div>

 <div class="clearfix"></div>

<div class="mayophoto-comment-section overflow-hidden">

            <div class="container <?php if ($commentmode == 'compact') { ?>compact-container<?php } ?>"
                 id="comment_box">

                <?php if ( class_exists( 'EDD_Reviews' ) ) { ?>
                    <div class="mayosis-review-tabs">
                        <div class="tabbable-line">

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item"><a href="#commentmain" class="nav-link active" role="tab" data-bs-toggle="tab">Comments</a></li>
                                <li class="nav-item"><a href="#mayosisreview" class="nav-link" role="tab" data-bs-toggle="tab">Customer Reviews</a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="commentmain">
                                <?php if ( comments_open() || '0' != get_comments_number() ) { ?>
                                    <?php comments_template(); ?>
                                <?php } ?>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="mayosisreview">

                                <?php if ( class_exists( 'EDD_Reviews' ) ) {
                                    global $post;
                                    $user = wp_get_current_user();
                                    $user_id = ( isset( $user->ID ) ? (int) $user->ID : 0 );

                                    if ( ! edd_reviews()->is_review_status( 'disabled' ) ) {
                                        ?>
                                        <div class="mayosis-review-section reviews-section">
                                            <div class="comments">
                                                <div class="comments-wrap">
                                                    <?php
                                                    edd_get_template_part( 'reviews' );
                                                    if ( get_option( 'thread_comments' ) ) {
                                                        edd_get_template_part( 'reviews-reply' );
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } }?>
                            </div>

                        </div>
                    </div>


                <?php } else { ?>


                    <?php if ( comments_open() || '0' != get_comments_number() ) { ?>
                        <?php comments_template(); ?>
                    <?php } ?>


                <?php } ?>

            </div>
        </div>
</section>