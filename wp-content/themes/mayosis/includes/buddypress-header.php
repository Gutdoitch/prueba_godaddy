<?php

if (!defined('ABSPATH'))
	{
	exit; // Exit if accessed directly.
	}
$collapsebuttonshow= get_theme_mod( 'collapse_button','on');
 $headertypestcked = get_theme_mod( 'header_transparency','normal');
  $header_logo_bp= get_theme_mod( 'buddypress_header_logo', get_template_directory_uri().'/images/logo.png' );
   global $current_user;
wp_get_current_user();
$bgremovelogin= get_theme_mod( 'login_logout_bg_remove' );
$loginlink= get_theme_mod( 'login_url' );
$logintext= get_theme_mod( 'login_text','Login' );
$logouttext= get_theme_mod( 'logout_text','Logout' );
$accountmenus = get_theme_mod( 'my_account_repeater',  array() ); 
?>

        <header id="main-header" class="mayosis-buddypress-extra-header d-none d-md-block">

<div class="row">
              <div class="buddypress-header-logo col-md-3 col-xs-6">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo_box">
                  <img src="<?php echo esc_url($header_logo_bp);  ?>" class="img-responsive" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>"/>
                  </a>
              </div>
                
                <div class="buddypress-header-search col-md-7 ">
                    
                </div>
                
                <div class="buddypress-header-account col-md-2 col-xs-6">
                    	<?php
		get_template_part('templates/buddypress-header-account');
	?>
                </div>
                </div>
                </header>
                
                
                <header id="main-header" class="mayosis-buddypress-extra-header d-block d-md-none">
                 
                    
                    
                      <div class="buddypress-mobile-menu d-block d-md-none row">
     
        <div class="buddypress-m-n-ic col-12 px-4">
               <div class="buddypress-header-logo d-inline">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo_box">
                  <img src="<?php echo esc_url($header_logo_bp);  ?>" class="img-responsive" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>"/>
                  </a>
              </div>
         <a class="mayosis-buddypress-header-burger float-end" data-bs-toggle="collapse" href="#buddypressmobile-nav" role="button" aria-expanded="false" aria-controls="buddypressmobile-nav"><ul><li class="burger"><span></span></li></ul></a>
         <div class="collapse multi-collapse" id="buddypressmobile-nav">
              <div class="card card-body">
                	<ul>
						<?php bp_get_displayed_user_nav(); ?>

						<?php

						/**
						 * Fires after the display of member options navigation.
						 *
						 * @since 1.2.4
						 */
						do_action( 'bp_member_options_nav' ); ?>

						<li class="more"><span> </span></li>
					</ul>
					
					
					   <div id="account-mob-ex" class="mayosis-option-menu d-block d-md-none">
    <?php
	if (!is_user_logged_in())
		{ ?> 
		<div id="mayosis-sidemenu">
		       
		  <ul>
               <li class="menu-item">
                <a href="<?php
            		echo esc_url($loginlink); ?>"><i class="zil zi-user"></i> <?php echo esc_html($logintext); ?></a>
            </li>
        </ul>
</div>
<?php } else { ?>
<div class="inner norm"><div class="popr" data-id="3" data-mode="top"><i class="zil zi-user"></i> <?php echo esc_html($current_user->display_name ); ?> <i class="zil zi-chevron-up right-position-mob"></i></div></div>

<div class="popr-box" data-box-id="3">
<?php wp_nav_menu( 
	array( 
	'theme_location' => 'account-menu', 
	'container_id' => 'mayosis-sidemenu',
	'fallback_cb' => 'mayosis_menu_walker::fallback',
	'walker'  => new mayosis_accordion_navwalker()
	) 
); ?>
</div>

<?php } ?>
   
</div>
              </div>
    </div>
    </div>
 
    </div>
                </header>
                
                
                