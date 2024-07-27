<?php
defined('ABSPATH') or die();
/**
 * The Sidemenu Header
 *
 * @package mayosis
 * @since mayosis 1.0
 */
$mainlogo= get_theme_mod( 'main_logo' );
$mainlogoicon= get_theme_mod( 'sidebar_logo_icon' );
$defaultsidecollaspe= get_theme_mod( 'default_side_menu' ,'expanded');
$searchshowhide= get_theme_mod( 'search_cartmenu','off' );
$iconinexpand= get_theme_mod( 'icon_in_expanded','off' );
$textincollapse= get_theme_mod( 'text_in_collapsed','on' );
$secondaryheader= get_theme_mod( 'secondary_header','on' );
$menutype= get_theme_mod( 'default_menu_type','normal' );
$customlogoUrl= get_theme_mod( 'logo-cs-link-m' );
if($customlogoUrl){
     $logourl= $customlogoUrl;
} else{
    $logourl= home_url( '/' );
}

global $mayosis_options
?>
<!-- mayosis-sidebar Holder -->
 <?php if($defaultsidecollaspe == 'collapse') :?>
            <aside id="mayosis-sidebar" class="active">
                <?php else: ?>
                <aside id="mayosis-sidebar" class="">
                <?php endif; ?>
                <div class="sidebar-fixed">
                <di v class="mayosis-sidebar-header">
                    <a href="<?php echo esc_url( $logourl ); ?>" class="sidebar-main-logo">
                        <img src="<?php echo esc_url($mainlogo);  ?>" class="img-responsive main-logo light-version-logo" alt="<?php esc_html__( 'Logo', 'mayosis' ); ?>"/>
                        </a>
                   
                </div>
               
    			<div class="clearfix"></div>
    			<?php if($iconinexpand == 'on') :?>
    			<div class="show-expand-icon">
    			 <?php else: ?>
    			 <div class="hide-expand-icon">
    			 <?php endif;?>
    			 <?php if($textincollapse == 'on') :?>
    			 <div class="collapse-text-show">
    			     <?php else: ?>
    			     <div class="collapse-text-hide">
    			     <?php endif; ?>
    			     <?php if($menutype=="accordion"){?>
    			      <?php get_template_part( 'includes/sidebar-accordion-menu' ); ?>
    			     
    			     <?php } else { ?>
               <?php get_template_part( 'includes/main-navigation' ); ?>
               <?php } ?>
               </div>
               </div>
               </div>
              
            </aside>
              <!-- Page Content Holder -->
              <div id="mayosis-sidebarnav-content" class="container-fluid">
                  	<?php get_template_part( 'includes/mobile-header' ); ?>
              	<?php if($secondaryheader == 'on') :?>
             <?php get_template_part( 'includes/sidebar-second-header' ); ?>
             <?php endif; ?>
