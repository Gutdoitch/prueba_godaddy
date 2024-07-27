<?php
// Digital Payment Icon
class mayosis_payment_icons extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'mayosis_payment_icons', 

// Widget name will appear in UI
esc_html__('Mayosis Payment Icons', 'mayosis-core'), 

// Widget description
array( 'description' => esc_html__( 'Your site&#8217;s Payment Icons.', 'mayosis-core' ), ) 
);
}
	


// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
  $title = apply_filters( 'widget_title', $instance[ 'title' ] );
   $show_paypal = $instance[ 'show_paypal' ] ? 'true' : 'false';
   $show_stripe = $instance[ 'show_stripe' ] ? 'true' : 'false';
   $show_visa = $instance[ 'show_visa' ] ? 'true' : 'false';
  $show_mastercard = $instance[ 'show_mastercard' ] ? 'true' : 'false';
  $show_discover = $instance[ 'show_discover' ] ? 'true' : 'false';
  echo $args['before_widget']; ?>
	<div class="sidebar-theme">	
	<?php if($title){?>
	<h4 class="footer-widget-title"><?php echo $title; ?></h4>
	<?php } ?>
 <!--- Start SVG Sprite --->
 <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><symbol id="mayosis-Discover" viewBox="0 0 51 32"><title>Discover</title><path fill="#fff" style="fill: var(--color1, #fff)" d="M0 0h51.2v32h-51.2v-32z"></path><path fill="#f48120" style="fill: var(--color2, #f48120)" d="M51.2 18.744c0 0-13.088 9.16-37.072 13.256h37.072v-13.256z"></path><path fill="#000" style="fill: var(--color3, #000)" d="M9.568 13.216h-1.6v5.528h1.592c0.848 0 1.456-0.2 1.992-0.64 0.64-0.52 1.016-1.312 1.016-2.12-0.008-1.632-1.232-2.768-3-2.768zM10.84 17.368c-0.344 0.304-0.784 0.44-1.488 0.44h-0.296v-3.656h0.296c0.704 0 1.128 0.128 1.488 0.448 0.376 0.336 0.6 0.848 0.6 1.376s-0.224 1.064-0.6 1.392z"></path><path fill="#000" style="fill: var(--color3, #000)" d="M13.064 13.216h1.088v5.528h-1.088v-5.528z"></path><path fill="#000" style="fill: var(--color3, #000)" d="M16.816 15.336c-0.656-0.24-0.848-0.4-0.848-0.696 0-0.352 0.344-0.616 0.808-0.616 0.328 0 0.592 0.136 0.88 0.448l0.568-0.736c-0.464-0.408-1.024-0.616-1.64-0.616-0.984 0-1.744 0.68-1.744 1.584 0 0.76 0.352 1.152 1.376 1.52 0.424 0.152 0.64 0.248 0.752 0.312 0.216 0.144 0.328 0.336 0.328 0.576 0 0.448-0.36 0.784-0.848 0.784-0.52 0-0.936-0.256-1.184-0.736l-0.704 0.672c0.504 0.728 1.104 1.056 1.928 1.056 1.128 0 1.928-0.744 1.928-1.816 0-0.888-0.368-1.288-1.6-1.736z"></path><path fill="#000" style="fill: var(--color3, #000)" d="M18.76 15.984c0 1.624 1.288 2.888 2.944 2.888 0.472 0 0.872-0.088 1.368-0.32v-1.272c-0.432 0.432-0.824 0.608-1.312 0.608-1.096 0-1.872-0.784-1.872-1.904 0-1.064 0.8-1.896 1.824-1.896 0.52 0 0.912 0.184 1.368 0.624v-1.272c-0.48-0.24-0.872-0.336-1.336-0.336-1.664-0.016-2.984 1.272-2.984 2.88z"></path><path fill="#000" style="fill: var(--color3, #000)" d="M31.704 16.928l-1.488-3.712h-1.192l2.368 5.672h0.584l2.408-5.672h-1.176z"></path><path fill="#000" style="fill: var(--color3, #000)" d="M34.88 18.744h3.088v-0.936h-2v-1.488h1.92v-0.944h-1.92v-1.224h2v-0.936h-3.088z"></path><path fill="#000" style="fill: var(--color3, #000)" d="M42.272 14.848c0-1.032-0.72-1.632-1.976-1.632h-1.616v5.528h1.088v-2.224h0.144l1.504 2.224h1.336l-1.76-2.328c0.832-0.168 1.28-0.72 1.28-1.568zM40.088 15.76h-0.32v-1.672h0.336c0.68 0 1.048 0.28 1.048 0.816 0 0.56-0.368 0.856-1.064 0.856z"></path><path fill="#f48120" style="fill: var(--color2, #f48120)" opacity="0.65" d="M29.36 16c0 1.624-1.328 2.944-2.968 2.944s-2.968-1.32-2.968-2.944 1.328-2.944 2.968-2.944c1.64 0 2.968 1.32 2.968 2.944z"></path><path fill="#f48120" style="fill: var(--color2, #f48120)" d="M29.36 16c0 1.624-1.328 2.944-2.968 2.944s-2.968-1.32-2.968-2.944 1.328-2.944 2.968-2.944c1.64 0 2.968 1.32 2.968 2.944z"></path><path fill="#000" style="fill: var(--color3, #000)" d="M42.968 13.424c0-0.096-0.064-0.152-0.184-0.152h-0.16v0.488h0.12v-0.192l0.136 0.192h0.144l-0.16-0.2c0.064-0.016 0.104-0.072 0.104-0.136zM42.76 13.488h-0.016v-0.128h0.024c0.056 0 0.088 0.024 0.088 0.064s-0.032 0.064-0.096 0.064z"></path><path fill="#000" style="fill: var(--color3, #000)" d="M42.808 13.088c-0.24 0-0.424 0.192-0.424 0.424s0.192 0.424 0.424 0.424c0.232 0 0.424-0.192 0.424-0.424s-0.192-0.424-0.424-0.424zM42.808 13.864c-0.184 0-0.344-0.152-0.344-0.344s0.152-0.352 0.344-0.352c0.184 0 0.336 0.16 0.336 0.352 0 0.184-0.152 0.344-0.336 0.344z"></path></symbol><symbol id="mayosis-Mastercard" viewBox="0 0 51 32"><title>Mastercard</title><path fill="#fff" style="fill: var(--color1, #fff)" d="M0 0h51.2v32h-51.2v-32z"></path><path fill="#ea001b" style="fill: var(--color4, #ea001b)" d="M28.504 16c0 4.197-3.431 7.6-7.664 7.6s-7.664-3.403-7.664-7.6c0-4.197 3.431-7.6 7.664-7.6s7.664 3.403 7.664 7.6z"></path><path fill="#f79e1b" style="fill: var(--color5, #f79e1b)" d="M38.024 16c0 4.197-3.431 7.6-7.664 7.6s-7.664-3.403-7.664-7.6c0-4.197 3.431-7.6 7.664-7.6s7.664 3.403 7.664 7.6z"></path><path fill="#ff5f01" style="fill: var(--color6, #ff5f01)" d="M28.504 16c0 3.287-1.3 5.952-2.904 5.952s-2.904-2.665-2.904-5.952c0-3.287 1.3-5.952 2.904-5.952s2.904 2.665 2.904 5.952z"></path></symbol><symbol id="mayosis-Paypal" viewBox="0 0 51 32"><title>Paypal</title><path fill="#fff" style="fill: var(--color1, #fff)" d="M0 0h51.2v32h-51.2v-32z"></path><path fill="#1d3586" style="fill: var(--color7, #1d3586)" d="M31.032 13.36c-0.256-0.304-0.72-0.464-1.328-0.464h-1.824c-0.128 0-0.232 0.088-0.248 0.216l-0.736 4.64c-0.016 0.088 0.056 0.176 0.152 0.176h0.936c0.088 0 0.16-0.064 0.176-0.152l0.208-1.312c0.016-0.12 0.128-0.216 0.248-0.216h0.576c1.2 0 1.896-0.576 2.080-1.72 0.072-0.496-0.008-0.888-0.24-1.168zM29.912 14.592c-0.096 0.648-0.6 0.648-1.080 0.648h-0.272l0.192-1.216c0.008-0.072 0.072-0.128 0.152-0.128h0.128c0.328 0 0.64 0 0.8 0.184 0.088 0.12 0.112 0.288 0.080 0.512z"></path><path fill="#1d3586" style="fill: var(--color7, #1d3586)" d="M18.016 13.36c-0.256-0.304-0.72-0.464-1.328-0.464h-1.824c-0.128 0-0.232 0.088-0.248 0.216l-0.736 4.64c-0.016 0.088 0.056 0.176 0.152 0.176h0.872c0.128 0 0.232-0.088 0.248-0.208l0.2-1.248c0.016-0.12 0.128-0.216 0.248-0.216h0.576c1.2 0 1.896-0.576 2.080-1.72 0.072-0.504-0.008-0.896-0.24-1.176zM16.896 14.592c-0.096 0.648-0.6 0.648-1.080 0.648h-0.272l0.192-1.216c0.008-0.072 0.072-0.128 0.152-0.128h0.128c0.328 0 0.64 0 0.8 0.184 0.088 0.12 0.112 0.288 0.080 0.512z"></path><path fill="#1d3586" style="fill: var(--color7, #1d3586)" d="M22.136 14.576h-0.872c-0.072 0-0.136 0.056-0.152 0.128l-0.040 0.24-0.064-0.088c-0.192-0.272-0.608-0.36-1.032-0.36-0.968 0-1.792 0.728-1.952 1.744-0.080 0.504 0.032 0.992 0.328 1.328 0.264 0.312 0.648 0.44 1.104 0.44 0.776 0 1.208-0.496 1.208-0.496l-0.040 0.24c-0.016 0.088 0.056 0.176 0.152 0.176h0.784c0.128 0 0.232-0.088 0.248-0.216l0.472-2.968c0.024-0.088-0.048-0.168-0.144-0.168zM20.92 16.264c-0.088 0.496-0.48 0.824-0.984 0.824-0.256 0-0.456-0.080-0.584-0.232s-0.176-0.368-0.136-0.608c0.080-0.488 0.48-0.832 0.976-0.832 0.248 0 0.448 0.080 0.584 0.24 0.128 0.144 0.184 0.368 0.144 0.608z"></path><path fill="#1d3586" style="fill: var(--color7, #1d3586)" d="M35.16 14.576h-0.872c-0.072 0-0.136 0.056-0.152 0.128l-0.040 0.24-0.064-0.088c-0.192-0.272-0.608-0.36-1.032-0.36-0.968 0-1.792 0.728-1.952 1.744-0.080 0.504 0.032 0.992 0.328 1.328 0.264 0.312 0.648 0.44 1.104 0.44 0.776 0 1.208-0.496 1.208-0.496l-0.040 0.24c-0.016 0.088 0.056 0.176 0.152 0.176h0.784c0.128 0 0.232-0.088 0.248-0.216l0.472-2.968c0.016-0.088-0.056-0.168-0.144-0.168zM33.936 16.264c-0.088 0.496-0.48 0.824-0.984 0.824-0.256 0-0.456-0.080-0.584-0.232s-0.176-0.368-0.136-0.608c0.080-0.488 0.48-0.832 0.976-0.832 0.248 0 0.448 0.080 0.584 0.24 0.128 0.144 0.184 0.368 0.144 0.608z"></path><path fill="#1d3586" style="fill: var(--color7, #1d3586)" d="M26.792 14.576h-0.88c-0.080 0-0.16 0.040-0.208 0.112l-1.208 1.768-0.512-1.696c-0.032-0.104-0.128-0.176-0.24-0.176h-0.864c-0.104 0-0.176 0.104-0.144 0.2l0.968 2.816-0.912 1.272c-0.072 0.096 0 0.24 0.128 0.24h0.88c0.080 0 0.16-0.040 0.208-0.112l2.92-4.176c0.064-0.112-0.008-0.248-0.136-0.248z"></path><path fill="#1d3586" style="fill: var(--color7, #1d3586)" d="M37.176 12.904h-0.84c-0.072 0-0.136 0.056-0.152 0.128l-0.752 4.72c-0.016 0.088 0.056 0.176 0.152 0.176h0.752c0.128 0 0.232-0.088 0.248-0.216l0.736-4.64c0.024-0.088-0.048-0.168-0.144-0.168z"></path></symbol><symbol id="mayosis-Stripe" viewBox="0 0 51 32"><title>Stripe</title><path fill="#fff" style="fill: var(--color1, #fff)" d="M0 0h51.2v32h-51.2v-32z"></path><path fill="#6772e5" style="fill: var(--color8, #6772e5)" d="M42.12 16.224c0-2.344-1.136-4.2-3.312-4.2-2.184 0-3.504 1.856-3.504 4.184 0 2.76 1.568 4.16 3.8 4.16 1.096 0 1.92-0.248 2.544-0.592v-1.848c-0.624 0.312-1.344 0.504-2.248 0.504-0.896 0-1.68-0.32-1.784-1.392h4.488c-0.008-0.112 0.016-0.592 0.016-0.816zM37.584 15.36c0-1.032 0.64-1.464 1.208-1.464 0.56 0 1.16 0.432 1.16 1.464h-2.368z"></path><path fill="#6772e5" style="fill: var(--color8, #6772e5)" d="M31.76 12.024c-0.896 0-1.48 0.424-1.792 0.72l-0.12-0.568h-2.016v10.696l2.288-0.488 0.008-2.592c0.328 0.24 0.816 0.576 1.624 0.576 1.64 0 3.136-1.32 3.136-4.232-0.008-2.664-1.52-4.112-3.128-4.112zM31.208 18.352c-0.536 0-0.856-0.192-1.080-0.432l-0.016-3.408c0.24-0.264 0.568-0.456 1.096-0.456 0.84 0 1.416 0.936 1.416 2.136 0 1.232-0.568 2.16-1.416 2.16z"></path><path fill="#6772e5" style="fill: var(--color8, #6772e5)" d="M24.664 11.48l2.304-0.488v-1.864l-2.304 0.488z"></path><path fill="#6772e5" style="fill: var(--color8, #6772e5)" d="M24.664 12.176h2.304v8.032h-2.304v-8.032z"></path><path fill="#6772e5" style="fill: var(--color8, #6772e5)" d="M22.2 12.856l-0.144-0.68h-1.984v8.032h2.288v-5.448c0.544-0.712 1.456-0.576 1.744-0.48v-2.104c-0.296-0.104-1.368-0.304-1.904 0.68z"></path><path fill="#6772e5" style="fill: var(--color8, #6772e5)" d="M17.6 10.184l-2.24 0.472-0.008 7.352c0 1.36 1.024 2.36 2.384 2.36 0.752 0 1.304-0.136 1.608-0.304v-1.864c-0.296 0.12-1.736 0.536-1.736-0.816v-3.264h1.744v-1.952h-1.744l-0.008-1.984z"></path><path fill="#6772e5" style="fill: var(--color8, #6772e5)" d="M11.4 14.512c0-0.36 0.296-0.496 0.776-0.496 0.696 0 1.584 0.216 2.28 0.592v-2.16c-0.76-0.304-1.52-0.416-2.28-0.416-1.856 0-3.096 0.968-3.096 2.592 0 2.536 3.488 2.128 3.488 3.216 0 0.424-0.368 0.56-0.88 0.56-0.76 0-1.736-0.312-2.512-0.728v2.192c0.856 0.368 1.712 0.52 2.504 0.52 1.904 0 3.216-0.944 3.216-2.592 0.008-2.744-3.496-2.248-3.496-3.28z"></path></symbol><symbol id="mayosis-Visa" viewBox="0 0 51 32"><title>Visa</title><path fill="#fff" style="fill: var(--color1, #fff)" d="M0 0h51.2v32h-51.2v-32z"></path><path fill="#000" style="fill: var(--color3, #000)" d="M25.448 11.264l-2.048 9.504h-2.48l2.048-9.504h2.48zM35.88 17.4l1.304-3.568 0.752 3.568h-2.056zM38.648 20.76h2.296l-2-9.504h-2.112c-0.48 0-0.88 0.272-1.056 0.696l-3.72 8.8h2.608l0.52-1.416h3.184l0.28 1.424zM32.176 17.664c0.008-2.504-3.496-2.648-3.472-3.768 0.008-0.344 0.336-0.704 1.048-0.792 0.352-0.048 1.336-0.080 2.448 0.424l0.432-2.016c-0.6-0.216-1.368-0.416-2.32-0.416-2.456 0-4.176 1.288-4.192 3.136-0.016 1.368 1.232 2.128 2.168 2.584 0.968 0.464 1.288 0.768 1.288 1.184-0.008 0.64-0.768 0.92-1.48 0.928-1.248 0.016-1.968-0.336-2.544-0.6l-0.448 2.080c0.584 0.264 1.648 0.496 2.76 0.504 2.6 0 4.304-1.28 4.312-3.248zM21.904 11.264l-4.016 9.504h-2.624l-1.976-7.584c-0.12-0.464-0.224-0.64-0.592-0.832-0.592-0.32-1.584-0.624-2.448-0.808l0.056-0.272h4.216c0.536 0 1.024 0.352 1.144 0.968l1.048 5.496 2.576-6.464h2.616z"></path></symbol></defs></svg>
 
 <!--- End SVG Sprite --->
<!--- Payment Icon --->
<div class="payment-icons">
<?php if( 'on' == $instance[ 'show_paypal' ] ) {?>
<svg class="mayosisicon mayosis-Paypal"><use xlink:href="#mayosis-Paypal"></use></svg>
<?php } ?>

<?php if( 'on' == $instance[ 'show_stripe' ] ) {?>
 <svg class="mayosisicon mayosis-Stripe"><use xlink:href="#mayosis-Stripe"></use></svg>
 <?php } ?>
 
 <?php if( 'on' == $instance[ 'show_visa' ] ) {?>
 <svg class="mayosisicon mayosis-Visa"><use xlink:href="#mayosis-Visa"></use></svg>
  <?php } ?>
  
   <?php if( 'on' == $instance[ 'show_mastercard' ] ) {?>
 <svg class="mayosisicon mayosis-Mastercard"><use xlink:href="#mayosis-Mastercard"></use></svg>
 <?php } ?>
 
 <?php if( 'on' == $instance[ 'show_discover' ] ) {?>
 <svg class="mayosisicon mayosis-Discover"><use xlink:href="#mayosis-Discover"></use></svg>
 <?php } ?>
 
 

 
 </div>
</div>

	<?php echo $args['after_widget'];
}
	
	
	/**
	 * Handles updating the settings for the current Digital Recent Productswidget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	/**
	 * Handles updating the settings for the current Digital Recent Productswidget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['show_paypal'] = sanitize_text_field( $new_instance['show_paypal'] );
		
		$instance['show_stripe'] = sanitize_text_field( $new_instance['show_stripe'] );
		
		$instance['show_visa'] = sanitize_text_field( $new_instance['show_visa'] );
		
		$instance['show_mastercard'] = sanitize_text_field( $new_instance['show_mastercard'] );
			
		$instance['show_discover'] = sanitize_text_field( $new_instance['show_discover'] );

		return $instance;
	}

	/**
	 * Outputs the settings form for the Categories widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = sanitize_text_field( $instance['title'] );
		
		?>
		
			<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'mayosis-core' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"> </p>
		
	 <p>
        <input class="checkbox" type="checkbox" <?php checked( $instance[ 'show_paypal' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_paypal' ); ?>" name="<?php echo $this->get_field_name( 'show_paypal' ); ?>" /> 
        <label for="<?php echo $this->get_field_id( 'show_paypal' ); ?>">Show Paypal</label>
    </p>
    
    
    <p>
        <input class="checkbox" type="checkbox" <?php checked( $instance[ 'show_stripe' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_stripe' ); ?>" name="<?php echo $this->get_field_name( 'show_stripe' ); ?>" /> 
        <label for="<?php echo $this->get_field_id( 'show_stripe' ); ?>">Show Stripe</label>
    </p>
    
    
    <p>
        <input class="checkbox" type="checkbox" <?php checked( $instance[ 'show_visa' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_visa' ); ?>" name="<?php echo $this->get_field_name( 'show_visa' ); ?>" /> 
        <label for="<?php echo $this->get_field_id( 'show_visa' ); ?>">Show Visa</label>
    </p>
    
    <p>
        <input class="checkbox" type="checkbox" <?php checked( $instance[ 'show_mastercard' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_mastercard' ); ?>" name="<?php echo $this->get_field_name( 'show_mastercard' ); ?>" /> 
        <label for="<?php echo $this->get_field_id( 'show_mastercard' ); ?>">Show Mastercard</label>
    </p>
    
    <p>
        <input class="checkbox" type="checkbox" <?php checked( $instance[ 'show_discover' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_discover' ); ?>" name="<?php echo $this->get_field_name( 'show_discover' ); ?>" /> 
        <label for="<?php echo $this->get_field_id( 'show_discover' ); ?>">Show Discover</label>
    </p>
		<?php
	}

}
	
// Class mayosis_payment_icons ends here

// Register and load the widget
function load_payment_icons() {
	register_widget( 'mayosis_payment_icons' );
}
add_action( 'widgets_init', 'load_payment_icons' );
