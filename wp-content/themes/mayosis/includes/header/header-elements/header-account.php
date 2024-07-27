<?php
defined('ABSPATH') or die();
global $current_user;
wp_get_current_user();
$bgremovelogin= get_theme_mod( 'login_logout_bg_remove' );
$logintext= get_theme_mod( 'login_text','Login' );
$logouttext= get_theme_mod( 'logout_text','Logout' );
$accountmenus = get_theme_mod( 'my_account_repeater',  array() );
$loginpp= get_theme_mod( 'login_popup_enable','disable');
$register_url =  get_theme_mod( 'register_url');
if ($loginpp=="enable"){
    $loginpparg="data-lity";
    $loginlink= '#userloginbox';
} else {
    $loginpparg="";
    $loginlink= get_theme_mod( 'login_url' );
}
?>
<ul id="account-button" class="mayosis-option-menu d-none d-lg-block">
    <?php
    if (!is_user_logged_in())
    { ?>
        <li class="menu-item">
            <?php

            if ($bgremovelogin == 'remove'): ?>
                <a href="<?php
                echo esc_url($loginlink); ?>" <?php echo esc_html($loginpparg);?>><i class="isax icon-user1"></i> <?php echo esc_html($logintext); ?></a>
            <?php else : ?>

                <a href="<?php
                echo esc_url($loginlink); ?>" class="login-button" <?php echo esc_html($loginpparg);?>><i class="isax icon-user1"></i> <?php echo esc_html($logintext); ?></a>
            <?php endif; ?>
        </li>

        <?php
    }
    else
    { ?>

        <li class="dropdown cart_widget cart-style-one menu-item my-account-menu">
            <a href="#"><i class="isax icon-user1"></i> <?php echo esc_html($current_user->display_name ); ?></a>


            <div class="dropdown-menu my-account-list">


                <div class="mayosis-account-user-information">
                    <span><?php echo get_avatar( $current_user->ID, '40'); ?></span>

                    <span class="user-display-name-acc"><?php echo esc_html($current_user->display_name ); ?></span>
                </div>

                <?php wp_nav_menu(
                    array(
                        'theme_location' => 'account-menu',
                        'container_class' => 'msv-acc-menu-itemwrap',
                        'menu_class' => 'msv-acc-menu-itembox',
                        'fallback_cb' => 'mayosis_menu_walker::fallback',
                        'walker'  => new mayosis_menu_walker()
                    )
                ); ?>

                <?php if( class_exists( 'EDD_Wallet' ) ) { ?>
                    <div class="msv-wallet-value">
                        <?php esc_html_e('Balance','mayosis');?>: <?php echo do_shortcode('[edd_wallet_value]');?>
                    </div>
                <?php }?>
                <div class="mayosis-logout-information">
                    <a href="<?php echo wp_logout_url(home_url('/'));?> " class="mayosis-logout-link"><i class="zil zi-sign-out"></i> <?php esc_html_e('Logout','mayosis');?></a>
                </div>
            </div>
        </li>

    <?php } ?>
</ul>

<div id="account-mob" class="mayosis-option-menu d-block d-lg-none">
    <?php
    if (!is_user_logged_in())
    { ?>
        <div id="mayosis-sidemenu">

            <ul>
                <li class="menu-item msv-mob-login-menu">
                    <a href="<?php
                    echo esc_url($loginlink); ?>" <?php echo esc_html($loginpparg);?>><i class="isax icon-user1"></i> <?php echo esc_html($logintext); ?></a>
                </li>
            </ul>
        </div>
    <?php } else { ?>

        <div class="btn-group dropup msv-mobile-pop-account">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="isax icon-user1"></i> <?php echo esc_html($current_user->display_name ); ?>
            </button>
            <ul class="dropdown-menu popr-box">
                <?php wp_nav_menu(
                    array(
                        'theme_location' => 'account-menu',
                        'container_id' => 'mayosis-sidemenu',
                        'fallback_cb' => 'mayosis_menu_walker::fallback',
                        'walker'  => new mayosis_accordion_navwalker()
                    )
                ); ?>
                <div class="mayosis-account-information mobile_account_info">
                    <span><?php echo get_avatar( $current_user->ID, '30'); ?></span>

                    <a href="<?php echo wp_logout_url(home_url('/'));?> " class="mayosis-logout-link"><?php esc_html_e('Logout','mayosis');?></a>
                </div>
            </ul>
        </div>


    <?php } ?>

</div>

<div id="userloginbox" class="lity-hide">

    <div class="modal-body">
        
        <div class="mayosis-main-login">
            <h4 class="modal-title mb-4"><?php esc_html_e('Login','mayosis');?></h4>
        <form id="mayosis-login">
            <!-- additional fields start -  -->
            <p class="mayosis-msg-status"></p>
            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
            <!-- additional fields end -  -->
            <div class="mayosis-field-holder">
                
                <input id="username" name="name" type="text" placeholder="<?php esc_html_e('Username','mayosis'); ?>">
            </div>
            <div class="mayosis-field-holder">
                <input id="password" type="password" placeholder="<?php esc_html_e('Password','mayosis'); ?>">
            </div>
            <div class="msv-btn-main">
                <input id="msv-login-submit" type="submit" value="<?php esc_attr_e('Login','mayosis'); ?> " class="btn msv-login-reg-submit">
                <span class="msv-btn-spinner"><div class="msv-lds-ring"><div></div><div></div><div></div><div></div></div></span>
            </div>
        </form>
        

        <div class="msv-header-login-btm-part">
           <a href="<?php echo wp_lostpassword_url(); ?>" class="msv-reset-p-link" title="<?php esc_html_e( 'Lost Password', 'mayosis' ); ?>"><?php esc_html_e( 'Lost Password?', 'mayosis' ); ?></a>
            <?php if(shortcode_exists('edd_social_login')){ echo do_shortcode('[edd_social_login]'); } ?>
        <a class="msv-sign-up-link" href="#"><?php esc_html_e('New here? Create an account!','mayosis');?></a>
        </div>

        
        </div>
        
        <div class="mayosis-main-register" style="display:none">
             <h4 class="modal-title mb-4"><?php esc_html_e('Register','mayosis');?></h4>
             <form id="mayosis-register">
                            <p class="status"></p>
                            <!-- additional fields start -  -->
                            <p class="mayosis-msg-status"></p>
                            <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>   
                            <!-- additional fields end -  -->  
                            <div class="mayosis-field-holder">
                               
                                <input id="reg-username" name="username" type="text" placeholder="<?php esc_html_e('Username','mayosis'); ?>">
                            </div>
                            <div class="mayosis-field-holder">
                                
                                <input name="email" id="reg-email" type="text" placeholder="<?php esc_html_e('Email','mayosis'); ?>">
                            </div>
                            <div class="mayosis-field-holder">
                               
                                <input name="password" id="reg-password" type="password" placeholder="<?php esc_html_e('Password','mayosis'); ?>">
                            </div>
                            <div class="mayosis-field-holder">
                               
                                <input id="reg-password2" name="password2" type="password" placeholder="<?php esc_html_e('Confirm Password','mayosis'); ?>">
                            </div>
                            <div class="msv-btn-main">
                                <input type="submit" value="<?php esc_attr_e('Register','mayosis'); ?>" class="btn msv-login-reg-submit">
                                <span class="msv-btn-spinner"><div class="msv-lds-ring"><div></div><div></div><div></div><div></div></div></span>
                            </div>
                        </form>
                        <div class="msv-header-login-btm-part">
                            
                            <?php if(shortcode_exists('edd_social_login')){ echo do_shortcode('[edd_social_login]'); } ?>
                        
                         <a class="msv-sign-in-link" href="#"><?php esc_html_e('Already Registered? Login','mayosis');?></a>
                        </div>
                        
                       
        </div>
        
    </div>
</div>