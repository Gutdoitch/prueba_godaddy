<?php
/**
 * The template for displaying the download artist.
 *
 * 
 * 
 * @package Mayosis
 */
get_header(); 
$term = get_queried_object();


// vars
$artistimage = get_field('artist_image', $term);
$atistsdesc = get_field('artists_biography', $term);
?>
<article content='<?php the_ID(); ?>' id="post-<?php the_ID(); ?>" >


                        <!-- Begin Page Headings Layout -->

                        <div class="tag_breadcrumb_color container-fluid">
                          
                            <div class="container">
                                
                                <div class="mayosis-artist-box row">
                                    <div class="mayosis-artist-image col-md-3 col-12">
                                        <div class="author_meta_single author_single_dm_box">
                                        <?php if($artistimage) { ?>
                                        <img src="<?php echo esc_url($artistimage);?>" alt="artist-image">
                                        <?php } ?>
                                         <h2 class="artist-page-title"><i class="zil zi-user" aria-hidden="true"></i> <?php single_cat_title( __( '', 'mayosis' ) ); ?></h2>
                                         </div>
                                    </div>
                                   
                                   <div class="mayosis-artist-description col-md-9 col-12">
                                       <h3><?php esc_html_e('Artist&#39;s Biography','mayosis');?></h3>
                                    <p class="product-cat-desc"> <?php echo maybe_unserialize($atistsdesc);?> </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                        $allproducttext= get_theme_mod( 'all_product_text','ALL PRODUCTS FROM' );
                        $productgridsystem= get_theme_mod( 'product_grid_system','one' );
                        $archivetitledisable= get_theme_mod( 'archive_title_disable','enable' );
                        $productarchivetype= get_theme_mod( 'product_archive_type','one' );
                        ?>
                        <!-- End Page Headings Layout -->
                        <!-- Begin Blog Main Post Layout -->

                        <section class="container product-main-content">
                            <div class="row">
                                <?php if ($productarchivetype=='one'): ?>
                                <div class="col-md-12">
                                    <?php else: ?>
                                    <div class="col-md-8 col-sm-8 col-12">
                                        <?php endif;?>

                                        <?php if ($archivetitledisable=='enable'): ?>
                                            <div class="side-main-title">
                                                <h2 class="section-title"><?php echo esc_html($allproducttext); ?> <?php single_cat_title( __( '', 'mayosis' ) ); ?></h2>

                                                <?php if(function_exists('mayosis_cat_filter')){
                                                    mayosis_cat_filter();
                                                } ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="mayosis-archive-wrapper container">
                                            <?php if ($productgridsystem=='two'): ?>
                                                <?php get_template_part( 'content/content-product-tag-masonary' ); ?>
                                                <?php elseif ($productgridsystem=='three'): ?>
                                                <?php get_template_part( 'content/content-product-tag-justified' ); ?>
                                            <?php else : ?>
                                                <?php get_template_part( 'content/content-product-artist-grid' ); ?>
                                            <?php endif; ?>
                                            <?php mayosis_page_navs(); ?>
                                        </div>
                                    </div>

                                    <?php if ($productarchivetype=='two'): ?>
                                        <div class="col-md-4 col-sm-4 col-12">
                                            <?php if ( is_active_sidebar( 'product-archive-sidebar' ) ) : ?>
                                                <?php dynamic_sidebar( 'product-archive-sidebar' ); ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                        </section>
                    </article>

<?php get_footer();?>