<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 *  @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$footerwidgetswitch = get_theme_mod( 'footer_widget_hide','off');
$footeradditonalwidget= get_theme_mod( 'footer_additonal_widget','hide');
$footercopyright = get_theme_mod( 'copyright_footer','show');
$footercopyrighttxt = get_theme_mod( 'copyright_text');
$copyrighttype = get_theme_mod( 'copyright_type','single');
$dm_subscribe_widget_do_shortcode_priority = has_filter( 'widget_text', 'do_shortcode' );
$footercopyrighttxt = apply_filters( 'widget_text', $footercopyrighttxt );
if ( has_filter( 'widget_text_content', 'do_shortcode' ) && ! $dm_subscribe_widget_do_shortcode_priority ) {
    if ( ! empty( $instance['filter'] ) ) {
        $footercopyrighttxt = shortcode_unautop( $footercopyrighttxt );
    }
    $footercopyrighttxt = do_shortcode( $footercopyrighttxt );
}
?>


<?php if($footerwidgetswitch== 'on'): ?>
    <footer class="main-footer container-fluid">
        <div class="container">
            <div class="footer-row">

                <?php get_template_part( 'templates/main-footer-widget'); ?>

            </div>
            <?php if($footeradditonalwidget== 'show'): ?>
                <div class="additional-footer">
                    <?php get_template_part( 'templates/additional-footer-widget'); ?>
                </div>
            <?php endif;?>
        </div>
    </footer>

<?php endif;?>


<?php if($footercopyright== 'show'): ?>
    <div class="copyright-footer container-fluid">
        <div class="container">

            <?php if($copyrighttype== 'columed'): ?>
                <div class="copyright-columned row">
                 
                        <div class="copyright-text text-left col-md-6 col-12">
                            <?php if ($footercopyrighttxt) :?>
                                <?php $allowed_html = [
                                    'a'      => [
                                        'href'  => [],
                                        'title' => [],
                                    ],
                                    'br'     => [],
                                    'em'     => [],
                                    'strong' => [],
                                    'img' => [],
                                    'i' => [],
                                ]; ?>
                                <?php echo  wp_kses($footercopyrighttxt,$allowed_html); ?>
                            <?php else:?>
                                <p class="copyright-text">© Copyright 2021 I <a href="https://teconce.com/item/mayosis-digital-marketplace-wordpress-theme/" target="_blank">Mayosis</a> Theme</p>
                            <?php endif; ?>
                        </div>

                        <div class="copyright-col-right col-md-6 col-12">
                            <?php if ( is_active_sidebar( 'copyright-footer' ) ) : ?>
                                <?php dynamic_sidebar( 'copyright-footer' ); ?>
                            <?php endif; ?>
                        </div>
                    
                </div>
            <?php else : ?>
                <div class="text-center copyright-full-width-text">
                    <?php if ($footercopyrighttxt) :?>
                        <?php $allowed_html = [
                            'a'      => [
                                'href'  => [],
                                'title' => [],
                            ],
                            'br'     => [],
                            'em'     => [],
                            'strong' => [],
                            'img' => [],
                            'i' => [],
                        ]; ?>
                        <?php echo  wp_kses($footercopyrighttxt,$allowed_html); ?>
                    <?php else:?>
                        <p class="copyright-text text-center">© Copyright 2021 I Mayosis Theme by <a href="https://teconce.com/">Teconce</a> I Powered by <a href="https://wordpress.org/">WordPress</a></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
<?php endif; ?>
<!-- End Footer Section-->