<?php
/**
 * The template for displaying the download tags.
 *
 * 
 * 
 * @package Mayosis
 */
get_header(); ?>

<article content='<?php the_ID(); ?>' id="post-<?php the_ID(); ?>" >


                        <!-- Begin Page Headings Layout -->

                        <div class="tag_breadcrumb_color container-fluid pr_breadcrumb_dark_def">
                          
                            <div class="container">
                                <h1 class="parchive-page-title has_fade_anim"><?php single_cat_title( __( '', 'mayosis' ) ); ?></h1>
                                <p class="product-cat-desc has_fade_anim"> <?php echo category_description(); ?> </p>
                                
                                <?php if (function_exists('mayosis_breadcrumbs')) mayosis_breadcrumbs(); ?>

                            </div>
                        </div>
                        <?php
                        $allproducttext= get_theme_mod( 'all_product_text','ALL PRODUCTS FROM' );
                        $productgridsystem= get_theme_mod( 'product_grid_system','one' );
                        $archivetitledisable= get_theme_mod( 'archive_title_disable','enable' );
                        $archivesidebarstate= get_theme_mod( 'product_archive_type','one' );
                        $archivesideposition= get_theme_mod( 'product_sidebar_position_ls','left' );
                        ?>
                        <!-- End Page Headings Layout -->
                        <!-- Begin Blog Main Post Layout -->

                        <section class="product-main-content has_mayosis_dark_bg">
                            <div class="container">
                            <div class="row">
                                  <?php if ($archivesidebarstate=='two' && $archivesideposition=='left'): ?>
                                <div class="col-md-4 col-sm-4 col-12">
                                    <?php if ( is_active_sidebar( 'product-archive-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'product-archive-sidebar' ); ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                                <?php if ($archivesidebarstate=='one'): ?>
                                <div class="col-md-12">
                                    <?php else: ?>
                                    <div class="col-md-8 col-sm-8 col-12">
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
                                            </div>
                                        <?php endif; ?>
                                         
                                               <div class="mayosis-archive-wrapper">
                                            
                                            <?php if ($productgridsystem=='two'): ?>
                                                <?php get_template_part( 'content/content-product-tag-masonary' ); ?>
                                                <?php elseif ($productgridsystem=='three'): ?>
                                                <?php get_template_part( 'content/content-product-tag-justified' ); ?>
                                                
                                                <?php elseif ($productgridsystem=='four'): ?>
                                                <?php get_template_part( 'content/content-product-tag-list' ); ?>
                                            <?php else : ?>
                                                <?php get_template_part( 'content/content-product-tag-grid' ); ?>
                                            <?php endif; ?>
                                           
                                        </div>
                                    </div>

                                    <?php if ($archivesidebarstate=='two' && $archivesideposition=='right'): ?>
                                <div class="col-md-4 col-sm-4 col-12">
                                    <?php if ( is_active_sidebar( 'product-archive-sidebar' ) ) : ?>
                                        <?php dynamic_sidebar( 'product-archive-sidebar' ); ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                                </div>
                                </div>
                        </section>
                    </article>

<?php get_footer();?>