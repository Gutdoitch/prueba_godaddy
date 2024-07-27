<?php
/**
 * @snippet       WooCommerce User Login Shortcode
 * @compatible    WooCommerce 4.0
 */

   
add_shortcode( 'mayosis_woo_login', 'mayosis_separate_login_form' );
    
function mayosis_separate_login_form() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) return;
   ob_start();
 
   do_action( 'woocommerce_before_customer_login_form' );
 
   ?>
      <form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'mayosis' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'mayosis' ); ?>&nbsp;<span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>
			<div class="row">
			    <div class="col-12 col-md-6">
			        	<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'mayosis' ); ?></span>
				</label>
			    </div>
			    
				 <div class="col-12 col-md-6">
				<p class="woocommerce-LostPassword lost_password text-md-end">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'mayosis' ); ?></a>
			</p>
			</div>
			</div>

			<p class="form-row">
			
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'mayosis' ); ?>"><?php esc_html_e( 'Log in', 'mayosis' ); ?></button>
			</p>
			

			<?php do_action( 'woocommerce_login_form_end' ); ?>
		<div class="my-account-register-btn">
   <?php 
   $regpage = get_theme_mod('select_register_woo_page');
   ?>
    <a href="<?php echo esc_attr( esc_url( get_page_link( $regpage ) ) ) ?>" class="mayosis_register_link"><?php esc_attr_e('New here? Create an Account','mayosis');?></a>
</div>
		</form>
		
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
   <?php
     
   return ob_get_clean();
}