<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$blogarchivestyle = get_theme_mod( 'blog_archive_post_style','both' );
?>
<div class="col-md-12">
    <div class="posts-wrapper">


        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


            <!-- Begin Blog Main Post Layout -->
            <section class="container blog-main-content main-post-body">
                <div class="row">
                    <div class="main-post-body col-12 col-lg-8">

                        <div class=" main-post-block index-block">
                            <div class="post-view-style row align-items-center">
                                <div class="col-8 col-lg-6 total-post-count">
                                    <?php
                                    $count = $GLOBALS['wp_query']->found_posts;
                                    $countall = $GLOBALS['wp_query']->post_count;
                                    ?>
                                    <p><?php esc_html_e('Showing','mayosis'); ?> <strong><?php echo esc_html($countall);?></strong>  <?php esc_html_e('of','mayosis'); ?> <strong><?php echo esc_html($count);?></strong> <?php esc_html_e('Blog Posts','mayosis'); ?></p>
                                </div>
                                <?php if ($blogarchivestyle=="both"): ?>
                                    <div class="col-4 col-lg-6 post-viewas">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="list-ptab" data-bs-toggle="tab" data-bs-target="#listpost" type="button" role="tab" aria-controls="listpost" aria-selected="true"><i class="zil zi-bars"></i></button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="grid-ptab" data-bs-toggle="tab" data-bs-target="#gridpost" type="button" role="tab" aria-controls="gridpost" aria-selected="false"><i class="zil zi-grid"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <div class="clearfix"></div>
                            </div>


                            <?php if ($blogarchivestyle=="both"): ?>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="listpost" role="tabpanel" aria-labelledby="list-ptab">

                                        <?php get_template_part( 'content/content-archive-post-full' ); ?>
                                        <?php mayosis_page_navs(); ?><!-- Blog Post-->
                                    </div>
                                    <div class="tab-pane" id="gridpost" role="tabpanel" aria-labelledby="grid-ptab">
                                        <?php get_template_part( 'content/content-archive-post-grid' ); ?>
                                        <?php mayosis_page_navs(); ?>

                                    </div>

                                </div>
                            <?php endif; ?>

                            <?php if ($blogarchivestyle=="list"): ?>
                                <div id="list">
                                    <?php get_template_part( 'content/content-archive-post-full' ); ?>
                                    <?php mayosis_page_navs(); ?><!-- Blog Post-->
                                </div>
                            <?php endif;?>

                            <?php if ($blogarchivestyle=="grid"): ?>
                                <div id="grid">
                                    <?php get_template_part( 'content/content-archive-post-grid' ); ?>
                                    <?php mayosis_page_navs(); ?>
                                </div>
                            <?php endif;?>



                        </div>
                    </div>
                    <div class="col-12 col-lg-4 blog-sidebar">
                        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                            <?php dynamic_sidebar( 'sidebar-1' ); ?>
                        <?php endif; ?>


                        <!--sidebar widget-->
                    </div>
                </div>
            </section>
            <!-- End Blog Main Post Layout-->
            <div class="clearfix"></div>

        </article>


    </div>

</div>