<?php

if (!defined('ABSPATH'))
	{
	exit; // Exit if accessed directly.
	}
$bgremovelogin= get_theme_mod( 'login_logout_bg_remove' );
$logintext= get_theme_mod( 'login_text','Login' );
$logouttext= get_theme_mod( 'logout_text','Logout' );
$loginpp= get_theme_mod( 'login_popup_enable','disable');
$register_url =  get_theme_mod( 'register_url');

if ($loginpp=="enable"){
    $loginpparg="data-lity";
    $loginlink= '#mayosis_vendorlogin';
} else {
    $loginpparg="";
    $loginlink= get_theme_mod( 'login_url' );
}
?>
<ul id="login-button" class="mayosis-option-menu">
<?php

if ($bgremovelogin == 'remove'): ?>
<?php
	if (!is_user_logged_in())
		{ ?> 
		
		<li class="menu-item"><a href="<?php
		echo esc_url($loginlink); ?>" class="" data-toggle="tooltip" data-placement="bottom" <?php echo esc_html($loginpparg);?>><i class="zil zi-user"></i> <?php echo esc_html($logintext); ?> </a></li>
				<?php
		}
	  else
		{ ?>
				<li class="menu-item"><a href="<?php
		echo esc_url(wp_logout_url(home_url('/'))); ?>" class=""><i class="zil zi-sign-out"></i> <?php echo esc_html($logouttext); ?></a></li><?php
		} ?>
				<?php
else: ?>
				<?php
	if (!is_user_logged_in())
		{ ?> <li class="menu-item"><a href="<?php
		echo esc_url($loginlink); ?>" class="login-button" data-toggle="tooltip" data-placement="bottom"><i class="zil zi-user"></i> <?php echo esc_html($logintext); ?></a></li>
				<?php
		}
	  else
		{ ?>
				<li class="menu-item"><a href="<?php
		echo esc_url(wp_logout_url(home_url('/'))); ?>" class="login-button"><i class="zil zi-sign-out"></i> <?php echo esc_html($logouttext); ?></a></li><?php
		} ?>
				<?php
endif; ?>
</ul>

<div id="mayosis_vendorlogin" class="lity-hide">

              
                  <div class="modal-body">
                       <h4 class="modal-title mb-4"><?php esc_html_e('Login','mayosis');?></h4>
                      <?php echo do_shortcode('[edd_login]'); ?>
                       <a class="sigining-up text-center" href="<?php echo esc_url($register_url);?>"><?php esc_html_e('New here? Create an account!','mayosis');?></a>
                  </div>
</div>