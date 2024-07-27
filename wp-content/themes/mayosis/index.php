<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the listpost page when no listpost.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mayosis
 */
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header(); ?>
<?php
$blogarchivestyle = get_theme_mod( 'blog_archive_post_style','both' );
$mayosis_breadcrumb_color = get_post_meta( get_queried_object_id(), 'mayosis_breadcrumb_color', true );
$mayosis_page_bg = get_post_meta( get_queried_object_id(), 'mayosis_page_bg', true );

$mayosis_gradient= get_post_meta( get_queried_object_id(), 'breadcrumb_gradient', true );

$page_color_type = get_post_meta(get_queried_object_id(), 'breadcrumb_color_type', true);

$mayosis_gradient_a = get_post_meta( get_queried_object_id(), 'mayosis_gradient_a', true );

$mayosis_gradient_b = get_post_meta( get_queried_object_id(), 'mayosis_gradient_b', true );

$custom_page_title = get_post_meta( get_queried_object_id(), 'custom_page_title', true );

$custom_bd_bg_image = get_post_meta( get_queried_object_id(), 'breadcrumb_image', true );

$custom_page_padding_on= get_post_meta( get_queried_object_id(), 'custom_padding', true );

$custom_page_padding_top = get_post_meta( get_queried_object_id(), 'custom_page_padding_top', true );

$custom_page_padding_bottom = get_post_meta( get_queried_object_id(), 'custom_page_padding_bottom', true );

$breadcrumb_hide = get_post_meta(get_queried_object_id(), 'breadcrumb_hide', true );
     
$breadcrumb_menu_hide = get_post_meta(get_queried_object_id(), 'breadcrumb_menu_hide', true );
?>
<?php if ($custom_page_padding_on =="Yes") { ?>
<style>
    .page_breadcrumb{
        padding-top:<?php echo esc_html($custom_page_padding_top); ?>;
        padding-bottom:<?php echo esc_html($custom_page_padding_bottom); ?>;
    }
</style>
<?php } ?>

<div class="wrap">
	 <?php  if($breadcrumb_hide == "No"){ ?>
<?php } else { ?>
   
    <?php if ($page_color_type == "Custom"){ ?>
    <?php if ($mayosis_gradient == "Yes"){ ?>
    <div class="row page_breadcrumb mayosis-custom-breadcrumb-style"
         style="background:linear-gradient(45deg, <?php echo esc_html($mayosis_gradient_a); ?> , <?php echo esc_html($mayosis_gradient_b); ?>);">
    <?php } else { ?>
    <div class="row page_breadcrumb mayosis-custom-breadcrumb-style"
         style="background-color:<?php echo esc_html($mayosis_breadcrumb_color); ?>; <?php if ($custom_bd_bg_image) { ?>background-image:url(<?php echo esc_url($custom_bd_bg_image); ?>); <?php } ?>">
    <?php } ?>

    <?php } else { ?>
    <div class="row page_breadcrumb mayosis-global-breadcrumb-style">
        <?php } ?>

          
            <div class="container">
            <h1 class="page_title_single">
                <?php  if($custom_page_title){ ?>
                    <?php echo esc_html($custom_page_title);?>
                <?php } else { ?>
                    <h2 class="page_title_single"><?php esc_html_e('Blog','mayosis'); ?></h2>
                <?php } ?>
            </h1>
            <?php  if($breadcrumb_menu_hide == 'Yes'){ ?>
            <?php if (function_exists('dm_breadcrumbs')) dm_breadcrumbs(); ?>
            <?php }?>
            </div>
        </div>
      
 
      <?php } ?>

    <!-- Begin Blog Main Post Layout -->
    <section class="container mx-auto">
        <div class="blog-main-content">
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
                <?php get_sidebar(); ?>
                
                
                <!--sidebar widget-->
            </div>
        </div>
        </div>
    </section>
    <!-- End Blog Main Post Layout-->
    <div class="clearfix"></div>
	
</div>

	<?php
get_footer(); ?>