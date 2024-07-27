<?php
$store_user    = dokan()->vendor->get( get_query_var( 'author' ) );
$store_info    = $store_user->get_shop_info();
$social_info   = $store_user->get_social_profiles();
$store_tabs    = dokan_get_store_tabs( $store_user->get_id() );
$social_fields = dokan_get_social_profile_fields();

$dokan_store_times = ! empty( $store_info['dokan_store_time'] ) ? $store_info['dokan_store_time'] : [];
$current_time      = dokan_current_datetime();
$today             = strtolower( $current_time->format( 'l' ) );

$dokan_appearance = get_option( 'dokan_appearance' );
$profile_layout   = empty( $dokan_appearance['store_header_template'] ) ? 'default' : $dokan_appearance['store_header_template'];
$store_address    = dokan_get_seller_short_address( $store_user->get_id(), false );

$dokan_store_time_enabled = isset( $store_info['dokan_store_time_enabled'] ) ? $store_info['dokan_store_time_enabled'] : '';
$store_open_notice        = isset( $store_info['dokan_store_open_notice'] ) && ! empty( $store_info['dokan_store_open_notice'] ) ? $store_info['dokan_store_open_notice'] : __( 'Store Open', 'mayosis' );
$store_closed_notice      = isset( $store_info['dokan_store_close_notice'] ) && ! empty( $store_info['dokan_store_close_notice'] ) ? $store_info['dokan_store_close_notice'] : __( 'Store Closed', 'mayosis' );
$show_store_open_close    = dokan_get_option( 'store_open_close', 'dokan_appearance', 'on' );

$general_settings = get_option( 'dokan_general', [] );
$banner_width     = dokan_get_vendor_store_banner_width();

if ( ( 'default' === $profile_layout ) || ( 'layout2' === $profile_layout ) ) {
    $profile_img_class = 'profile-img-circle';
} else {
    $profile_img_class = 'profile-img-square';
}

if ( 'layout3' === $profile_layout ) {
    unset( $store_info['banner'] );

    $no_banner_class      = ' profile-frame-no-banner';
    $no_banner_class_tabs = ' dokan-store-tabs-no-banner';
} else {
    $no_banner_class      = '';
    $no_banner_class_tabs = '';
}

$contentlayouts  = get_theme_mod( 'vendor_layout_control', array( 'products','sales','page','follower','following' ) );

?>
<div class="dokan-profile-frame-wrapper">
    <div class="profile-frame<?php echo esc_attr( $no_banner_class ); ?>">

        <div class="profile-info-box profile-layout-<?php echo esc_attr( $profile_layout ); ?>">
            <?php if ( $store_user->get_banner() ) { ?>
                <img src="<?php echo esc_url( $store_user->get_banner() ); ?>"
                    alt="<?php echo esc_attr( $store_user->get_shop_name() ); ?>"
                    title="<?php echo esc_attr( $store_user->get_shop_name() ); ?>"
                    class="profile-info-img">
            <?php } else { ?>
                <div class="profile-info-img dummy-image">&nbsp;</div>
            <?php } ?>
            
            <?php if ( $show_store_open_close === 'on' && $dokan_store_time_enabled === 'yes' ) : ?>
                                <div class="dokan-store-open-close mayosis-store-notice d-none">
                                    <i class="fas fa-shopping-cart"></i>
                                    <div class="store-open-close-notice">
                                        <?php if ( dokan_is_store_open( $store_user->get_id() ) ) : ?>
                                            <span class='store-notice'><?php echo esc_attr( $store_open_notice ); ?></span>
                                        <?php else : ?>
                                            <span class='store-notice'><?php echo esc_attr( $store_closed_notice ); ?></span>
                                        <?php endif; ?>

                                        <span class="fas fa-angle-down"></span>
                                        <?php
                                        // Vendor store times template shown here.
                                        dokan_get_template_part(
                                            'store-header-times',
                                            '',
                                            [
                                                'dokan_store_times' => $dokan_store_times,
                                                'today'             => $today,
                                                'dokan_days' => dokan_get_translated_days(),
                                                'current_time' => $current_time,
                                                'times_heading' => __( 'Weekly Store Timing', 'mayosis' ),
                                                'closed_status' => __( 'CLOSED', 'mayosis' ),
                                            ]
                                        );
                                        ?>
                                    </div>
                                </div>
                            <?php endif ?>

        </div> <!-- .profile-info-box -->
    </div> <!-- .profile-frame -->
    
    
    
    
     <!-- Begin Page Headings Layout -->
    <div class="single--author--content has_mayosis_dark_alt_bg container-fluid">
        <div class="container">
            <div class="single--author--flex row">
                <div class="single--author--part col-12 col-lg-4">
                    <div class="author--name--image">
                       <div class="profile-img <?php echo esc_attr( $profile_img_class ); ?>">
                            <img src="<?php echo esc_url( $store_user->get_avatar() ); ?>"
                                alt="<?php echo esc_attr( $store_user->get_shop_name() ); ?>"
                                size="150">
                        </div>
                        <div class="author--identity--box">
                        
                          <?php if ( ! empty( $store_user->get_shop_name() ) && 'default' === $profile_layout ) { ?>
                           <h5 class="author--single--title"><?php echo esc_html( $store_user->get_shop_name() ); ?><?php apply_filters( 'dokan_store_header_after_store_name', $store_user ); ?></h5>
                        <?php } ?>
                        
                         
                      
                      
                     
                      
                        <?php if ( ! dokan_is_vendor_info_hidden( 'address' ) && isset( $store_address ) && ! empty( $store_address ) ) { ?>
                                 <p class="single--author-address"><i class="fas fa-map-marker-alt"></i>
                                    <?php echo wp_kses_post( $store_address ); ?>
                                </p>
                            <?php } ?>
                       
                        </div>
                    </div>
                    <div class="author--box--btn">
                        <div class="follow--au--btn">
                             <?php
                             if ( is_user_logged_in() ) { ?>
                            <?php
                            $teconcefollow = teconce_get_follow_unfollow_links( $store_user->get_id() );
                            
                            echo maybe_unserialize($teconcefollow);
                            ?>
                            <?php } else  { ?>
                            
                             <a href="#vendorlogin" data-lity class="tec-follow-link"><?php esc_html_e('Follow','mayosis');?></a>
                            <?php } ?>
                        </div>
                        <div class="contact--au--btn">
                            <a href="#vendorcontact" data-lity class="btn ghost-fes-author-btn fes--author--btn"><?php esc_html_e('Contact','mayosis'); ?></a>
                        </div>
                    </div>
                </div>

                <div class="single--meta--part col-12 col-lg-8">
                    <div class="single--meta--top--part row row-cols-2  row-cols-md-5 ">
                       <?php if ($contentlayouts): foreach ($contentlayouts as $layout) {
 
                            switch($layout) {
                         
                         
                                case 'products': get_template_part( 'content/content-items/vendor-product-count-woo' );
                                break;
                                
                                 case 'sales': get_template_part( 'content/content-items/vendor-product-sales-woo' );
                                break;
                                
                                
                                 case 'page': get_template_part( 'content/content-items/vendor-product-page-view-woo' );
                                break;
                                
                                
                                 case 'follower': get_template_part( 'content/content-items/vendor-product-follower-woo' );
                                break;
                         
                               
                                case 'following': get_template_part( 'content/content-items/vendor-product-following-woo' );
                                break;
                         
                            }
                         
                        }
                         
                        endif; ?>
                      
                    </div> <!-- top part-->

                    <div class="single--meta--bottom--part row ">
                      
                        
                        <div class="bottom--meta--desc col-6 col-lg-5">
                          <div class="dokan-store-rating">
                               
                                <?php echo wp_kses_post( dokan_get_readable_seller_rating( $store_user->get_id() ) ); ?>
                            </div>
                        </div>
                        
                        
                          <div class="bottom--meta--social col-6 col-lg-7">
                            <?php if ( $social_fields ) { ?>
                            <div class="store-social-wrapper">
                                <ul class="store-social">
                                    <?php foreach ( $social_fields as $key => $field ) { ?>
                                        <?php if ( ! empty( $social_info[ $key ] ) ) { ?>
                                            <li>
                                                <a href="<?php echo esc_url( $social_info[ $key ] ); ?>" target="_blank"><i class="fab fa-<?php echo esc_attr( $field['icon'] ); ?>"></i></a>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                        </div>
                        
                          
                        
                             <?php do_action( 'dokan_store_header_info_fields', $store_user->get_id() ); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    
          


</div>

 <!-- Modal Login Form -->
           <div id="vendorlogin" style="background:#fff" class="lity-hide">
                   
                    <h4 class="modal-title">Login</h4>
                
                  <div class="modal-body">
                      <?php echo do_shortcode('[mayosis_woo_login]');?>
                  </div>
                </div>

<!-- Modal -->
           <div id="vendorcontact" style="background:#fff" class="lity-hide">
                <h4 class="modal-title"><?php esc_html_e('Contact with this Author','mayosis') ?></h4>
           
            <div class="modal-body">
             
                <?php 
                 dokan_store_contact_widget();?>
            </div>
        
</div>
