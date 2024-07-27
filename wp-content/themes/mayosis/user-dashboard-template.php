<?php
/**
 * Template Name:EDD User Dashboard
 *
 * This is EDD User Dashboard .
 *
 * @package mayosis-digital-marketplace-theme
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
get_header();
$mayosis_breadcrumb_color = get_post_meta( $post->ID, 'mayosis_breadcrumb_color', true );
$mayosis_page_bg = get_post_meta( $post->ID, 'mayosis_page_bg', true );

$mayosis_gradient= get_post_meta( $post->ID, 'breadcrumb_gradient', true );

$mayosis_gradient_a = get_post_meta( $post->ID, 'mayosis_gradient_a', true );

$mayosis_gradient_b = get_post_meta( $post->ID, 'mayosis_gradient_b', true );
?>
<?php if ( is_home() ) {
    $breadcrumb_hide = get_post_meta(get_queried_object_id(), 'breadcrumb_hide', true );
    $breadcrumb_menu_hide = get_post_meta(get_queried_object_id(), 'breadcrumb_menu_hide', true );
} else {
    $breadcrumb_hide = get_post_meta(get_queried_object_id(), 'breadcrumb_hide', true );
    $breadcrumb_menu_hide = get_post_meta(get_queried_object_id(), 'breadcrumb_menu_hide', true );
} ?>


    <div class="container-fluid">
        <?php  if($breadcrumb_hide == "Yes"){ ?>
            <?php  if($mayosis_gradient == "Yes"){ ?>
            <div class="row page_breadcrumb" style="background:linear-gradient(45deg, <?php echo esc_html($mayosis_gradient_a); ?> , <?php echo esc_html($mayosis_gradient_b); ?>);">
                <?php } else { ?>
                <div class="row page_breadcrumb" style="background-color:<?php echo esc_html($mayosis_breadcrumb_color); ?>;background-image:url(<?php echo get_post_meta(get_the_ID(), 'breadcrumb_image', true ); ?>);">
                    <?php } ?>

                    <h2 class="page_title_single"><?php the_title(); ?></h2>
                    <?php  if($breadcrumb_menu_hide == 'Yes'){ ?>
                        <?php if (function_exists('dm_breadcrumbs')) dm_breadcrumbs(); ?>
                    <?php } ?>
                </div>


        <?php } ?>

        <div class="dm-column-container" style="background:<?php echo esc_html($mayosis_page_bg); ?>">
            <div class="user-dashboard-page">
                  <?php
                    if ( is_user_logged_in() ) { ?>
                <div class="dasboard-tab">
                    <div class="container">

                        <ul class="nav nav-pills">
                            <?php
                            $layouts  = get_theme_mod( 'dashboard_menu_items', array( 'profile','purchase','download','discount','followed' ,'access','subscription') );

                            if ($layouts): foreach ($layouts as $layout) {

                                switch($layout) {
                                    case 'profile': ?>
                                        <li class="nav-item"><a class="nav-link active" href="#" id="profile-tab" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab"><?php esc_html_e('Profile','mayosis'); ?></a></li>
                                        <?php
                                        break;
                                    case 'purchase':

                                        ?>
                                        <li class="nav-item"><a class="nav-link" href="#" id="purchase-tab" data-bs-toggle="pill" data-bs-target="#purchase" type="button" role="tab"><?php esc_html_e('Purchase History','mayosis'); ?></a></li>

                                        <?php
                                        break;
                                    case 'download':

                                        ?>
                                        <li class="nav-item"><a class="nav-link" href="#" id="download-tab" data-bs-toggle="pill" data-bs-target="#download" type="button" role="tab"><?php esc_html_e('Download History','mayosis'); ?></a></li>

                                        <?php
                                        break;
                                    case 'discount':
                                        ;
                                        ?>
                                        <li class="nav-item"><a class="nav-link" href="#" id="discount-tab" data-bs-toggle="pill" data-bs-target="#discount" type="button" role="tab"><?php esc_html_e('Discount','mayosis'); ?></a></li>

                                        <?php
                                        break;
                                    case 'followed':
                                        ;
                                        ?>
                                        <li class="nav-item"><a class="nav-link" href="#" id="follow-recent-tab" data-bs-toggle="pill" data-bs-target="#follow-recent" type="button" role="tab"><?php esc_html_e('Followed Items','mayosis'); ?></a></li>

                                        <?php
                                        break;
                                    case 'access':
                                        ;
                                        ?>
                                        <?php if( class_exists( 'EDD_All_Access' ) ) { ?>


                                        <li class="nav-item"><a class="nav-link" href="#" id="access-pass-tab" data-bs-toggle="pill" data-bs-target="#access-pass" type="button" role="tab"><?php esc_html_e('Access Pass','mayosis'); ?></a></li>
                                    <?php } ?>

                                        <?php
                                        break;
                                    case 'subscription':
                                        ;
                                        ?>
                                        <?php if( class_exists( 'EDD_Recurring' ) ) { ?>


                                        <li class="nav-item"><a class="nav-link" href="#" id="subscription-tab" data-bs-toggle="pill" data-bs-target="#subscription" type="button" role="tab"><?php esc_html_e('Subscription','mayosis'); ?></a></li>
                                    <?php } ?>

                                        <?php break; ?>

                                    <?php } }  ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                    <?php }?>


                <div class="container">
                    <div class="tab-content user--dasboard--box clearfix">
                        <div class="tab-pane active" id="profile">
                            <?php echo do_shortcode('[edd_profile_editor]');?>
                        </div>

                        <div class="tab-pane" id="purchase">
                            <?php echo do_shortcode('[purchase_history]');?>
                        </div>

                        <div class="tab-pane" id="download">
                            <?php echo do_shortcode('[download_history]');?>
                        </div>

                        <div class="tab-pane" id="discount">
                            <?php echo do_shortcode('[download_discounts]');?>
                        </div>

                        <div class="tab-pane" id="follow-recent">
                            <?php echo do_shortcode('[following_posts]'); ?>

                        </div>
                        <?php if( class_exists( 'EDD_All_Access' ) ) { ?>
                            <div class="tab-pane" id="access-pass">
                                <?php echo do_shortcode('[edd_aa_customer_passes]'); ?>

                            </div>
                        <?php } ?>
                        <?php if( class_exists( 'EDD_Recurring' ) ) { ?>
                            <div class="tab-pane" id="subscription">
                                <?php echo do_shortcode('[edd_subscriptions]'); ?>

                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>


    </div>
<?php
get_footer(); ?>