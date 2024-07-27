<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$archivesidebarstate= get_theme_mod( 'product_archive_type','one' );
$archivesideposition= get_theme_mod( 'product_sidebar_position_ls','left' );
$clsfilter= get_theme_mod( 'collapse_filter_msc','disable' );
get_header(); ?>

    <section id="primary" class="content-area">

        <div class="row common-page-breadcrumb page_breadcrumb">
            <div class="container">
                <h2 class="page_title_single"><?php esc_html_e('Search Result','mayosis'); ?></h2>
                <div class="breadcrumb">
                    <span class="active"><?php esc_html_e('Search Results for','mayosis'); ?> "<?php echo esc_html($s); ?>"</span>
                </div>
            </div>
        </div>
        <main id="main" class="site-main container search--content--main" role="main">
            <div class="row gx-5 mayosis-archive-wrapper mayosis-d-searc-main-container">
                <?php if ($archivesidebarstate=='two' && $archivesideposition=='left'): ?>
                    <div class="col-md-3 col-sm-4 col-12 mayosis-search-sidebar-bds">
                        <?php if ( is_active_sidebar( 'product-archive-sidebar' ) ) : ?>
                            <?php dynamic_sidebar( 'product-archive-sidebar' ); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>


                <?php if ($archivesidebarstate=='two'): ?>
                <div class="col-md-9 col-sm-8 col-12 ">
                    <?php else: ?>
                    <div class="col-md-12">
                        <?php endif;?>
                        <div class="side-main-title side-main-title-wd-title-x">
                            <?php do_action('mayosis_store_loop_before');?>
                               <?php if($clsfilter=="enable"){?>
                                            <button class="msv-cs-filter-btn button" type="button" data-bs-toggle="collapse" data-bs-target="#msv-cs-filter" aria-expanded="false" aria-controls="msv-cs-filter">
                                                <i class="isax icon-filter-search1"></i> <?php esc_html_e('Filter','mayosis');?>
                                            </button>
                                        <?php } ?>
                        </div>
                          <?php if($clsfilter=="enable"){?>
                                    <div class="collapse msv-cs-filter-box" id="msv-cs-filter">

                                        <?php if ( is_active_sidebar( 'product-cl-filter-sidebar' ) ) : ?>
                                            <?php dynamic_sidebar( 'product-cl-filter-sidebar' ); ?>
                                        <?php endif; ?>

                                    </div>
                                <?php } ?>
                        <?php if ( 'download' == get_post_type() ) : ?>
                            <?php get_template_part( 'content/content-search-download' ); ?>
                            
                             <?php elseif ( 'product' == get_post_type() ) : ?>
                            <?php get_template_part( 'content/content-search-woo' ); ?>

                        <?php elseif ( 'page' == get_post_type() ) : ?>
                            <?php if ( have_posts() ) : ?>


                                <?php /* Start the Loop */ ?>
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <?php get_template_part( 'content/content-search-post' ); ?>

                                <?php endwhile; ?>


                                <?php mayosis_page_navs(); ?>

                            <?php endif; ?>


                        <?php elseif ( 'post' == get_post_type() ) : ?>
                            <?php if ( have_posts() ) : ?>


                                <?php /* Start the Loop */ ?>
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <?php get_template_part( 'content/content-search-post' ); ?>

                                <?php endwhile; ?>


                                <?php mayosis_page_navs(); ?>




                            <?php endif; ?>

                        <?php else : ?>

                            <?php get_template_part( 'content/content', 'none' ); ?>


                        <?php endif; ?>


                    </div>

                    <?php if ($archivesidebarstate=='two' && $archivesideposition=='right'): ?>
                        <div class="col-md-3 col-sm-4 col-12 mayosis-search-sidebar-bds">
                            <?php if ( is_active_sidebar( 'product-archive-sidebar' ) ) : ?>
                                <?php dynamic_sidebar( 'product-archive-sidebar' ); ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>



                </div>
        </main><!-- #main -->
    </section><!-- #primary -->

<?php get_footer(); ?>