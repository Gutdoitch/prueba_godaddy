<?php
global $post;
global $current_user;
$user_id  = empty( $user_id ) ? get_current_user_id() : $user_id;
$logininnerlogo= get_theme_mod( 'dash_inner_logo', get_template_directory_uri().'/images/logo.png' );
 $layouts  = get_theme_mod( 'dashboard_menu_items', array( 'profile','purchase','download','discount','followed','follower','following' ,'access','subscription','vendor') );
?>
<?php
if ( is_user_logged_in() ) { ?>
    <div class="extended-dasboard-tab">
        <div class="logo-dashboard d-none d-lg-block">

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo_box">
                <img src="<?php echo esc_url($logininnerlogo);  ?>" class="img-responsive" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>"/>
            </a>
        </div>
        <ul class="nav nav-tabs d-none d-lg-block" id="myTab" role="tablist">
            <?php
             if ($layouts): foreach ($layouts as $layout) {

                                switch($layout) {
                                    case 'profile':
            ?>
            <li class="nav-item"><a class="nav-link" data-bs-target="#profile" data-bs-toggle="tab"><i class="zil zi-user"></i> <?php esc_html_e('Profile','mayosis'); ?></a></li>
             <?php
                                        break;
                                    case 'purchase':

                                        ?>
            <li class="nav-item"><a class="nav-link" data-bs-target="#purchase" data-bs-toggle="tab"><i class="zil zi-bars"></i> <?php esc_html_e('Purchase History','mayosis'); ?></a></li>
            
              <?php
                                        break;
                                    case 'download':

                                        ?>
            <li class="nav-item"><a class="nav-link" data-bs-target="#download" data-bs-toggle="tab"><i class="zil zi-cube"></i> <?php esc_html_e('Download History','mayosis'); ?></a></li>
            
           <?php
                                        break;
                                    case 'followed':
                                        ;
                                        ?>
            <li class="nav-item"><a class="nav-link" data-bs-target="#follow-recent" data-bs-toggle="tab"><i class="zil zi-grid"></i> <?php esc_html_e('Followed Items','mayosis'); ?></a></li>
            
               
           <?php
                                        break;
                                    case 'follower':
                                        ;
                                        ?>

            <li class="nav-item"><a class="nav-link" data-bs-target="#followers" data-bs-toggle="tab"><i class="zil zi-info-ii"></i> <?php esc_html_e('Followers','mayosis'); ?></a></li>
            
             <?php
                                        break;
                                    case 'following':
                                        ;
                                        ?>


            <li class="nav-item"><a class="nav-link" data-bs-target="#following" data-bs-toggle="tab"><i class="zil zi-info-ii"></i> <?php esc_html_e('Following','mayosis'); ?></a></li>
            
             <?php
                                        break;
                                    case 'access':
                                        ;
                                        ?>

            <?php if( class_exists( 'EDD_All_Access' ) ) { ?>
                <li class="nav-item"><a class="nav-link" data-bs-target="#accesspass" data-bs-toggle="tab"><i class="zil zi-circle-dot"></i> <?php esc_html_e('Access Pass','mayosis'); ?></a></li>
            <?php } ?>
             <?php
                                        break;
                                    case 'subscription':
                                        ;
                                        ?>
            <?php if( class_exists( 'EDD_Recurring' ) ) { ?>
                <li class="nav-item"><a class="nav-link" data-bs-target="#subscription" data-bs-toggle="tab"><i class="zil zi-tag"></i> <?php esc_html_e('Subscription','mayosis'); ?></a></li>
            <?php } ?>
            
            
            <?php
                                        break;
                                    case 'vendor':
                                        ;
                                        ?>
           <?php if (class_exists( 'EDD_Front_End_Submissions' ) ) { ?>
            <li class="nav-item"><a class="nav-link" data-bs-target="#vendor" data-bs-toggle="tab"><i class="zil zi-star"></i> <?php esc_html_e('Become a Seller','mayosis'); ?></a></li>
           <?php } ?>
            <?php break; ?>

                                    <?php } }  ?>
                            <?php endif; ?>
        </ul>

        <div class="d-block d-lg-none mayosis-mobile-user-menu mobile-dashboard-menu">
            
            <div class="row">
            <div class="logo-dashboard">

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo_box">
                    <img src="<?php echo esc_url($logininnerlogo);  ?>" class="img-responsive" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>"/>
                </a>
            </div>
            <nav  class="mobile--nav-menu mayosis-dashboard-menu-main">

           <ul class="nav nav-tabs" id="myTab" role="tablist">
               
            <?php
             if ($layouts): foreach ($layouts as $layout) {

                                switch($layout) {
                                    case 'profile':
            ?>
            <li class="nav-item"><a class="nav-link" data-bs-target="#profile" data-bs-toggle="tab"><i class="zil zi-user"></i> <?php esc_html_e('Profile','mayosis'); ?></a></li>
             <?php
                                        break;
                                    case 'purchase':

                                        ?>
            <li class="nav-item"><a class="nav-link" data-bs-target="#purchase" data-bs-toggle="tab"><i class="zil zi-bars"></i> <?php esc_html_e('Purchase History','mayosis'); ?></a></li>
            
              <?php
                                        break;
                                    case 'download':

                                        ?>
            <li class="nav-item"><a class="nav-link" data-bs-target="#download" data-bs-toggle="tab"><i class="zil zi-cube"></i> <?php esc_html_e('Download History','mayosis'); ?></a></li>
            
           <?php
                                        break;
                                    case 'followed':
                                        ;
                                        ?>
            <li class="nav-item"><a class="nav-link" data-bs-target="#follow-recent" data-bs-toggle="tab"><i class="zil zi-grid"></i> <?php esc_html_e('Followed Items','mayosis'); ?></a></li>
            
               
           <?php
                                        break;
                                    case 'follower':
                                        ;
                                        ?>

            <li class="nav-item"><a class="nav-link" data-bs-target="#followers" data-bs-toggle="tab"><i class="zil zi-info-ii"></i> <?php esc_html_e('Followers','mayosis'); ?></a></li>
            
             <?php
                                        break;
                                    case 'following':
                                        ;
                                        ?>


            <li class="nav-item"><a class="nav-link" data-bs-target="#following" data-bs-toggle="tab"><i class="zil zi-info-ii"></i> <?php esc_html_e('Following','mayosis'); ?></a></li>
            
             <?php
                                        break;
                                    case 'access':
                                        ;
                                        ?>

            <?php if( class_exists( 'EDD_All_Access' ) ) { ?>
                <li class="nav-item"><a class="nav-link" data-bs-target="#accesspass" data-bs-toggle="tab"><i class="zil zi-circle-dot"></i> <?php esc_html_e('Access Pass','mayosis'); ?></a></li>
            <?php } ?>
             <?php
                                        break;
                                    case 'subscription':
                                        ;
                                        ?>
            <?php if( class_exists( 'EDD_Recurring' ) ) { ?>
                <li class="nav-item"><a class="nav-link" data-bs-target="#subscription" data-bs-toggle="tab"><i class="zil zi-tag"></i> <?php esc_html_e('Subscription','mayosis'); ?></a></li>
            <?php } ?>
            
            
            <?php
                                        break;
                                    case 'vendor':
                                        ;
                                        ?>
           <?php if (class_exists( 'EDD_Front_End_Submissions' ) ) { ?>
            <li class="nav-item"><a class="nav-link" data-bs-target="#vendor" data-bs-toggle="tab"><i class="zil zi-star"></i> <?php esc_html_e('Become a Seller','mayosis'); ?></a></li>
           <?php } ?>
            <?php break; ?>

                                    <?php } }  ?>
                            <?php endif; ?>
           
           
        </ul>

            </nav>
            <div class="overlaymobile"></div>

            <div class="mobile_user float-end">
                <ul  class="dashboard-mobile-menu">
                    <li class="burger"><span></span></li>
                </ul>
            </div>
            
            </div>
        </div>
        
        
        <div class="user-information-ex-dashboard">
            <a href="#" data-toggle="dropdown"> <?php echo get_avatar( $user_id,40 ) ?> <?php echo esc_html($current_user->display_name ); ?></a>
            <a href="<?php echo wp_logout_url(home_url('/')) ?>" class="acc-logout-btn"><i class="zil zi-sign-out"></i></a>
        </div>
    </div>
<?php }?>
<div class="extended-tab-content">
    <div class="tab-content user--dasboard--box clearfix">
         <?php
             if ($layouts): foreach ($layouts as $layout) {

                                switch($layout) {
                                    case 'profile':
            ?>
        <div class="tab-pane active" id="profile">
            <?php echo do_shortcode('[edd_profile_editor]');?>
        </div>
        
         <?php
                                        break;
                                    case 'purchase':

                                        ?>

        <div class="tab-pane" id="purchase">
            <?php echo do_shortcode('[purchase_history]');?>
        </div>
        
         <?php
                                        break;
                                    case 'download':

                                        ?>

        <div class="tab-pane" id="download">
            <?php echo do_shortcode('[download_history]');?>
        </div>
        
         <?php
                                        break;
                                    case 'followed':

                                        ?>


        <div class="tab-pane" id="follow-recent">
            <?php echo do_shortcode('[following_posts]'); ?>

        </div>
        
          <?php
                                        break;
                                    case 'follower':

                                        ?>


        <div class="tab-pane" id="followers">
            <?php echo do_shortcode('[get_follower]'); ?>

        </div>
        <?php
                                        break;
                                    case 'following':

                                        ?>

        <div class="tab-pane" id="following">
            <?php echo do_shortcode('[get_following]'); ?>

        </div>
<?php
                                        break;
                                    case 'access':

                                        ?>
        <?php if( class_exists( 'EDD_All_Access' ) ) { ?>
            <div class="tab-pane" id="accesspass" >
                <?php echo do_shortcode('[edd_aa_customer_passes]'); ?>
            </div>
        <?php } ?>
        <?php
                                        break;
                                    case 'subscription':

                                        ?>
        <?php if( class_exists( 'EDD_Recurring' ) ) { ?>
            <div class="tab-pane" id="subscription">
                <?php echo do_shortcode('[edd_subscriptions]'); ?>
            </div>
        <?php } ?>
        <?php
                                        break;
                                    case 'vendor':

                                        ?>
        
        <?php if (class_exists( 'EDD_Front_End_Submissions' ) ) { ?>
            <div class="tab-pane" id="vendor">
                <?php echo do_shortcode('[fes_registration_form]'); ?>
            </div>
           <?php } ?>
           
            <?php break; ?>

                                    <?php } }  ?>
                            <?php endif; ?>
    </div>
</div>