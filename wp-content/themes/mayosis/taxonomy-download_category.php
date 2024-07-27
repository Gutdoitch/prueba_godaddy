<?php
/**
 * Downloads archive page.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
get_header();
$allproducttext= get_theme_mod( 'all_product_text','ALL PRODUCTS FORM' );
$productgridsystem= get_theme_mod( 'product_grid_system','one' );
$archivetitledisable= get_theme_mod( 'archive_title_disable','enable' );
$archivesidebarstate= get_theme_mod( 'product_archive_type','one' );
$archivesideposition= get_theme_mod( 'product_sidebar_position_ls','left' );
$archivebreadcrumbdisable= get_theme_mod( 'archive_breadcrumb_disable','enable' );
$archivecategoryfilterdisable= get_theme_mod( 'archive_category_filter_disable','disable' );
$clsfilter= get_theme_mod( 'collapse_filter_msc','disable' );


$custom_archive_tpl_state = get_theme_mod('custom_archive_tpl_state','disable');
?>
    <article content='<?php the_ID(); ?>' id="post-<?php the_ID(); ?>" >

        <?php if($custom_archive_tpl_state=='enable') { ?>

            <?php mayosis_eddarchive_builder (); ?>
        <?php } else { ?>

            <?php  $productarchivetype = get_theme_mod( 'archive_bg_type','gradient' ); ?>


            <!-- Begin Page Headings Layout -->
            <?php if ( $archivebreadcrumbdisable == 'enable' ): ?>
                <div class="product-archive-breadcrumb container-fluid">
                    <?php if ($productarchivetype=='featured'): ?>
                        <?php
                        $category_grid_image = get_term_meta( get_queried_object_id(), 'category_image_main', true); ?>
                        <div class="container-fluid featuredimageparchive" style="background:url(<?php echo esc_url($category_grid_image); ?>) center center;">
                        </div>

                    <?php endif; ?>


                    <div class="container">
                        <?php if (is_tax( array( 'download_category', 'download_tag' ) )){ ?>
                            <h1 class="parchive-page-title has_fade_anim"><?php single_cat_title( __( '', 'mayosis' ) ); ?></h1>
                        <?php } else {?>
                            <h1 class="parchive-page-title has_fade_anim"><?php echo esc_html(edd_get_label_plural()); ?></h1>
                        <?php } ?>

                        <p class="product-cat-desc has_fade_anim"> <?php echo category_description(); ?> </p>
                        <?php if (function_exists('dm_breadcrumbs')) dm_breadcrumbs(); ?>

                    </div>

                </div>
            <?php endif; ?>
            <!-- End Page Headings Layout -->
            <!-- Begin Blog Main Post Layout -->

            <section class="product-main-content has_mayosis_dark_bg">
                <div class="container">
                    <div class="row gx-5">

                        <?php if ($archivesidebarstate=='two' && $archivesideposition=='left'): ?>
                            <div class="col-md-3 col-sm-4 col-12">
                                <?php if ( is_active_sidebar( 'product-archive-sidebar' ) ) : ?>
                                    <?php dynamic_sidebar( 'product-archive-sidebar' ); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($archivesidebarstate=='two'): ?>
                        <div class="col-md-9 col-sm-8 col-12">
                            <?php else: ?>
                            <div class="col-md-12">
                                <?php endif;?>

                                <?php if ( $archivecategoryfilterdisable == 'enable' ): ?>
                                    <?php if(function_exists('mayosis_download_child_categories')){
                                        mayosis_download_child_categories();
                                    }?>
                                <?php endif;?>

                                <?php if ($archivetitledisable=='enable'): ?>
                                    <div class="side-main-title">




                                        <h2 class="section-title"><?php echo esc_html($allproducttext); ?> <?php single_cat_title( __( '', 'mayosis' ) ); ?></h2>

                                        <?php

                                        if( class_exists( 'MysisFilter' ) ) { ?>

                                            <?php do_action('mayosis_store_loop_before');?>
                                        <?php } else { ?>
                                            <?php if(function_exists('mayosis_cat_filter')){
                                                mayosis_cat_filter();
                                            } ?>
                                        <?php } ?>
                                        <?php if($clsfilter=="enable"){?>
                                            <button class="msv-cs-filter-btn button" type="button" data-bs-toggle="collapse" data-bs-target="#msv-cs-filter" aria-expanded="false" aria-controls="msv-cs-filter">
                                                <i class="isax icon-filter-search1"></i> <?php esc_html_e('Filter','mayosis');?>
                                            </button>
                                        <?php } ?>
                                    </div>
                                <?php endif; ?>

                                <?php if($clsfilter=="enable"){?>
                                    <div class="collapse msv-cs-filter-box" id="msv-cs-filter">

                                        <?php if ( is_active_sidebar( 'product-cl-filter-sidebar' ) ) : ?>
                                            <?php dynamic_sidebar( 'product-cl-filter-sidebar' ); ?>
                                        <?php endif; ?>

                                    </div>
                                <?php } ?>

                                <div class="mayosis-archive-wrapper">

                                    <?php if ($productgridsystem=='two'): ?>
                                        <?php get_template_part( 'content/content-product-masonary' ); ?>

                                    <?php elseif ($productgridsystem=='three'): ?>
                                        <?php get_template_part( 'content/content-product-justified' ); ?>
                                    <?php elseif ($productgridsystem=='four'): ?>
                                        <?php get_template_part( 'content/content-product-list' ); ?>
                                    <?php else : ?>
                                        <?php get_template_part( 'content/content-product-grid' ); ?>
                                    <?php endif; ?>



                                </div>
                            </div>

                            <?php if ($archivesidebarstate=='two' && $archivesideposition=='right'): ?>
                                <div class="col-md-3 col-sm-4 col-12">
                                    <?php if ( is_active_sidebar( 'product-archive-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'product-archive-sidebar' ); ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
            </section>
            <?php $categoryidextract = get_queried_object();
            $additionaldesc  = get_term_meta($categoryidextract->term_id, 'additional_description', true);
            $allowed_html = [
                'a'      => [
                    'href'  => [],
                    'title' => [],
                ],
                'br'     => [],
                'em'     => [],
                'strong' => [],
                'img' => [],
                'i' => [],
                'b' => [],
                'mark' => [],
            ];
            ?>

            <?php if ($additionaldesc){ ?>
                <div class="additional_description">
                    <div class="container">
                        <div class="col-md-8 offset-md-2 col-sm-12 col-12">
                            <?php
                            echo wp_kses($additionaldesc,$allowed_html); ?>
                        </div>
                    </div>
                </div>
            <?php } } ?>

    </article>


<?php
get_footer();
