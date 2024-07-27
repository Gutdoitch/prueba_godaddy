<?php
defined('ABSPATH') or die();
$cartstyle= get_theme_mod( 'cart_style','one' );
$carticontype= get_theme_mod( 'cart_icon_type','zi-cart' );
$carttype = get_theme_mod('header_cart_type','dropdown');

?>


<?php

if (class_exists('Easy_Digital_Downloads'))
	{ ?>
	
	
	<ul id="cart-menu" class="mayosis-option-menu">
                        <?php
	$cart_quantity = edd_get_cart_quantity();
	$display = $cart_quantity > 0 ? '' : ' style="display:none;"';
?>
<?php if($cartstyle == 'one') : ?>
					
					<li class="dropdown cart_widget cart-style-one">
					<?php if($carttype=="offcanvas"){?>
					
					<button  class="msv-dsk-cart-button cart-button"><i class="zil <?php
	echo esc_html($carticontype); ?>"></i> <span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?></span></button>
	

					
					<?php } else { ?>
					<a href="#" data-toggle="dropdown" class="cart-button"><i class="zil <?php
	echo esc_html($carticontype); ?>"></i> <span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?></span></a>
	
	
	<ul role="menu" class="dropdown-menu mini_cart"><li class="widget"><?php mayosis_mini_cart_items();?>
					</li></ul>
					<?php } ?>
					
					
					
					</li> 
					
		<?php else: ?>
		
			<li class="dropdown cart_widget cart-style-two">
			
				<?php if($carttype=="offcanvas"){?>
					
			
	
		<a data-bs-toggle="offcanvas" href="#sitecart" class="cart-button"><i class="zil <?php
	echo esc_html($carticontype); ?>"></i> <span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?> <?php esc_html_e('Items','mayosis'); ?></span></a>
	
	
	<div class="offcanvas offcanvas-end mayosis-site-offcanvas-cart has_mayosis_dark_sec_bg" tabindex="-1" id="sitecart" aria-labelledby="sitecartLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"><?php esc_html_e('Cart','mayosis');?> <span>(<span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?></span>)</span></h5>
    <button type="button" class="text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i class="zil zi-cross"></i></button>
  </div>
  <div class="offcanvas-body">
   <?php mayosis_mini_cart_items();?>
  </div>
</div>
					
					<?php } else { ?>
			<a href="#" data-toggle="dropdown" class="cart-button"><i class="zil <?php
	echo esc_html($carticontype); ?>"></i> <span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?> <?php esc_html_e('Items','mayosis'); ?></span></a>
	
	<ul role="menu" class="dropdown-menu mini_cart"><li class="widget"><?php mayosis_mini_cart_items();?>
					</li></ul>
					<?php } ?>
					
					</li> 
		<?php endif; ?>
		
		</ul>
		
		<ul class="mobile-cart d-none">
		<li class="cart-style-one"><a href="<?php echo edd_get_checkout_uri(); ?>" class="btn btn-danger btn-lg mobile-cart-button">
                        <i class="zil <?php
	echo esc_html($carticontype); ?>"></i></a></li>
                        
        </ul>
                        <?php
	} ?>
	
	
	
	
	
<?php

if (class_exists('WooCommerce'))
	{ ?>
	
	
	<ul id="cart-menu" class="mayosis-option-menu d-none d-lg-block">
                        <?php
	$cart_quantity = WC()->cart->get_cart_contents_count();
	$display = $cart_quantity > 0 ? '' : ' style="display:none;"';
?>
<?php if($cartstyle == 'one') : ?>
					
					<li class="dropdown cart_widget cart-style-one">
					<?php if($carttype=="offcanvas"){?>
					
						<a data-bs-toggle="offcanvas" href="#sitecart" class="cart-button"><i class="zil <?php
	echo esc_html($carticontype); ?>"></i> <span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?></span></a>
	
	
		<div class="offcanvas offcanvas-end mayosis-site-offcanvas-cart has_mayosis_dark_sec_bg" tabindex="-1" id="sitecart" aria-labelledby="sitecartLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"><?php esc_html_e('Cart','mayosis');?> <span>(<span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?></span>)</span></h5>
    <button type="button" class="text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i class="zil zi-cross"></i></button>
  </div>
  <div class="offcanvas-body">
  <div class="widget_shopping_cart_content">
    <?php  
                       
                        woocommerce_mini_cart();
                    ?>
                    
       </div> 
  </div>
</div>
	

					
					<?php } else { ?>
					<a href="#" data-toggle="dropdown" class="cart-button"><i class="zil <?php
	echo esc_html($carticontype); ?>"></i> <span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?></span></a>
	
	
	<ul role="menu" class="dropdown-menu mini_cart woo-mini_cart"><li class="widget">    <div class="widget_shopping_cart_content">
    <?php  
                       
                        woocommerce_mini_cart();
                    ?>
                    
       </div> 
					</li></ul>
					<?php } ?>
					
					
					
					</li> 
					
		<?php else: ?>
		
			<li class="dropdown cart_widget cart-style-two">
			
				<?php if($carttype=="offcanvas"){?>
					
			
	
		<a data-bs-toggle="offcanvas" href="#sitecart" class="cart-button"><i class="zil <?php
	echo esc_html($carticontype); ?>"></i> <span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?> <?php esc_html_e('Items','mayosis'); ?></span></a>
	
	
	<div class="offcanvas offcanvas-end mayosis-site-offcanvas-cart has_mayosis_dark_sec_bg" tabindex="-1" id="sitecart" aria-labelledby="sitecartLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"><?php esc_html_e('Cart','mayosis');?> <span>(<span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?></span>)</span></h5>
    <button type="button" class="text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i class="zil zi-cross"></i></button>
  </div>
  <div class="offcanvas-body">
  <div class="widget_shopping_cart_content">
    <?php  
                       
                        woocommerce_mini_cart();
                    ?>
                    
       </div> 
  </div>
</div>
					
					<?php } else { ?>
			<a href="#" data-toggle="dropdown" class="cart-button"><i class="zil <?php
	echo esc_html($carticontype); ?>"></i> <span class="items edd-cart-quantity"><?php
	echo esc_html($cart_quantity); ?> <?php esc_html_e('Items','mayosis'); ?></span></a>
	
	<ul role="menu" class="dropdown-menu mini_cart woo-mini_cart"><li class="widget"><div class="widget_shopping_cart_content">
    <?php  
                       
                        woocommerce_mini_cart();
                    ?>
                    
       </div> 
					</li></ul>
					<?php } ?>
					
					</li> 
		<?php endif; ?>
		
		</ul>
		
		<ul class="mobile-cart d-block d-lg-none">
		<li class="cart-style-one"><a href="<?php //echo edd_get_checkout_uri(); ?>" class="btn btn-danger btn-lg mobile-cart-button">
                        <i class="zil <?php
	echo esc_html($carticontype); ?>"></i></a></li>
                        
        </ul>
                        <?php
	} ?>
	
	