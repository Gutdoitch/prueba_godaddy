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
$collapsebutton= get_theme_mod( 'collapse_button','off' );
$iconinexpand= get_theme_mod( 'icon_in_expanded','off' );
$textincollapse= get_theme_mod( 'text_in_collapsed','on' );
$secondaryheader= get_theme_mod( 'secondary_header','on' );
$showbottomsocialpart= get_theme_mod( 'bottom_social_part_sideheader','off' );
$shadow_on_sidebar = get_theme_mod('shadow_on_sidebar');
$menutype= get_theme_mod( 'default_menu_type','normal' );
$sidebarlogo= get_theme_mod( 'sidebar_logo_state','enable' );
$secheader= get_theme_mod( 'secondary_header_state','standard' );
$darklogo= get_theme_mod( 'dark_logo','disable' );
$darklogoimg= get_theme_mod( 'dark_logo_img' );

global $mayosis_options
?>
<!-- mayosis-sidebar Holder -->
	<?php if($secondaryheader == 'on'  && $secheader=="full") :?>
	<section class="sidebar-header-promo-full-width">
	     <?php get_template_part( 'includes/sidebar-second-header' ); ?>
	</section>
            
             <?php endif; ?>
 <?php if($defaultsidecollaspe == 'collapse') :?>
            <aside id="mayosis-sidebar" class="active d-none d-lg-block hide-sidebar-mob <?php echo esc_html($shadow_on_sidebar);?>">
                <?php else: ?>
                <aside id="mayosis-sidebar" class="d-none d-lg-block  hide-sidebar-mob">
                <?php endif; ?>
                <div class="sidebar-fixed">
                  <?php if($sidebarlogo=="enable"){?>
                <div class="mayosis-sidebar-header">
                    <?php if($collapsebutton=="on"){?>
                      <div class="mayosis-collapsible-box">
                            <button type="button" id="mayosis-sidebarCollapse" class="mayosis-collapse-btn burger">
                             <span></span>
                               
                            </button>
                       </div>
                       <?php } ?>
                       
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="sidebar-main-logo">
                        
                        <?php if($darklogo=="enable"){?>
                        <img src="<?php echo esc_url($mainlogo);  ?>" class="img-responsive main-logo light-version-logo" alt="<?php esc_html__( 'Logo', 'mayosis' ); ?>"/>
                        <img src="<?php echo esc_url($darklogoimg);  ?>" class="img-responsive main-logo dark-version-logo" alt="<?php esc_html__( 'Logo', 'mayosis' ); ?>"/>
                        <?php } else { ?>
                        <img src="<?php echo esc_url($mainlogo);  ?>" class="img-responsive main-logo" alt="<?php esc_html__( 'Logo', 'mayosis' ); ?>"/>
                        <?php } ?>
                        </a>
                        
                        </a>
                  
                </div>
                <?php } ?>
                
                <?php if($searchshowhide == 'on') :?>
                <div class="sidebar-option-menu">
	            <ul id="cart-menu" class="mayosis-option-menu">
					<?php get_template_part( 'includes/sidemenu-cart-search' ); ?>
    			</ul>
    			</div>
    			<?php endif; ?>
    			<div class="clearfix"></div>
    			<?php if($iconinexpand == 'on') :?>
    			<div class="show-expand-icon">
    			 <?php else: ?>
    			 <div class="hide-expand-icon">
    			 <?php endif;?>
    			 <?php if($textincollapse == 'on') :?>
    			 <div class="collapse-text-show side-header-inner-m">
    			     <?php else: ?>
    			     <div class="collapse-text-hide side-header-inner-m">
    			     <?php endif; ?>
              <?php if($menutype=="accordion"){?>
    			      <?php get_template_part( 'includes/sidebar-accordion-menu' ); ?>
    			     
    			     <?php } else { ?>
               <?php get_template_part( 'includes/main-navigation' ); ?>
               <?php } ?>
                   
               </div>
               </div>
              
               <div class="social-icon-sidebar-header">
                   <?php if($mainlogoicon){?>
                    <div class="mayosis-sidebar-s-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($mainlogoicon);  ?>" class="center-block" alt="<?php esc_html__( 'Icon', 'mayosis' ); ?>"/></a></div>
                    <?php } ?>
                    
                     <?php if ($showbottomsocialpart=="on"){?>
                      <?php get_template_part( 'includes/social-icons' ); ?>
                       <?php } ?>
                   </div>
                  
               </div>
              
            </aside>
              <!-- Page Content Holder -->
              <div id="mayosis-sidebarnav-content" class="container-fluid">
                  <div class="sidebar-header-mobile-nav d-block d-lg-none">
                  <div class="to-flex-row th-flex-flex-middle ">
                  	 <div class="to-flex-col th-col-left ">
                    
                      <?php mayosis_header_elements('header_mobile_elements_left','mobile'); ?>
                  
        </div>
                  
                  <div class="to-flex-col th-col-center ">
                    
                      <?php mayosis_header_elements('header_mobile_elements_center','mobile'); ?>
                  
                  </div>
    
    
          <div class="to-flex-col th-col-right ">
            
              <?php mayosis_header_elements('header_mobile_elements_right','mobile'); ?>
           
          </div>
          </div>
          
          </div>
              	<?php if($secondaryheader == 'on'  && $secheader=="standard") :?>
             <?php get_template_part( 'includes/sidebar-second-header' ); ?>
             <?php endif; ?>
