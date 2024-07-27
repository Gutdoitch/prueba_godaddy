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

$footerbacktotop = get_theme_mod( 'footer_back_to_top_hide','on');
$enable_footer_builder = get_theme_mod( 'enable_footer_builder','hide');
$carttype = get_theme_mod('header_cart_type','dropdown');
$mobfixedbar = get_theme_mod('enable_mobile_bottom_fx_bar','hide');
$whspage = get_theme_mod('select_wishlist_p_link_mb','');
$whspagelink = get_permalink($whspage);
$accpage = get_theme_mod('select_account_p_link_mb','');
$accpagelink = get_permalink($accpage);
$backtohd ="";
if($mobfixedbar=="on"){
    $backtohd ="d-none d-sm-block";
}

?>

	<div class="clearfix"></div>
	
	<?php if($enable_footer_builder== 'on'){?>
	         <?php get_template_part( 'templates/footer-builder'); ?>
	<?php  } else { ?>
	
	  <?php get_template_part( 'templates/footer-normal'); ?>
	<?php } ?>
	



</div>
</div>
  <?php if( class_exists( 'Easy_Digital_Downloads' ) ){ 
  $cart_quantity = edd_get_cart_quantity();
  $display = $cart_quantity > 0 ? '' : ' style="display:none;"';
  ?>
<div class="msv_fixed_cart_sidebar has_mayosis_dark_alt_bg">
    <button class="cart-close"><i class="zil zi-cross"></i></button>
    <div class="msv-cart-b-body">
        <h4 class="msv-mobile-cart-title"><?php esc_html_e('Cart','mayosis');?> (<span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?></span>)</h4>
         <?php mayosis_mini_cart_items();?>
    </div>
</div>
<?php if($mobfixedbar=="on"){?>
<div class="msv-mobile-stiky-bar d-block d-sm-none">
    <ul>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="isax icon-home-21"></i> <?php esc_html_e('Home','mayosis');?></a></li>
         <li><button class="msv-fixed-cart-btn"><i class="isax icon-shopping-cart1"></i> <?php esc_html_e('Cart','mayosis');?></button></li>
         <?php if($whspage){?>
          <li><a href="<?php echo esc_url($whspagelink);?>"><i class="isax icon-heart1"></i> <?php esc_html_e('Wishlist','mayosis');?></a></li>
          <?php } ?>
          <?php if($accpage){?>
          <li><a href="<?php echo esc_url($accpagelink);?>"><i class="isax icon-user1"></i> <?php esc_html_e('Account','mayosis');?></a> </li>
          <?php } ?>
          
          
    </ul>
</div>
<?php } ?>
	<?php if($carttype=="offcanvas"){?>

	<div class="mayosis-site-offcanvas-cart has_mayosis_dark_alt_bg" id="sitecart">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"><?php esc_html_e('Cart','mayosis');?> <span>(<span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?></span>)</span></h5>
    <button type="button" class="text-reset"><i class="zil zi-cross"></i></button>
  </div>
  <div class="msv_offcanvas-body">
   <?php mayosis_mini_cart_items();?>
  </div>
</div>
<?php } } ?>


<div class="msv_backdrop" style="display: none;"></div>

	<?php if($footerbacktotop== 'on'){ ?>
	<a id="back-to-top" href="#" class="back-to-top <?php echo esc_html($backtohd);?>" role="button"><i class="zil zi-chevron-up"></i></a>
	<?php } ?>
<?php wp_footer(); ?>
</body>
<!-- End Main Layout --> 

</html>