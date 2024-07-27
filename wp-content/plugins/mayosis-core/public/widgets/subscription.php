<?php 

if ( class_exists( 'Easy_Digital_Downloads' ) ) :
class product_subscription extends WP_Widget {
  /**
  * Start Widget
  **/
	public function __construct() {
    $widget_options = array( 
      'classname' => 'product_subscription',
      'description' => 'Subscription',
    );
    parent::__construct( 'product_subscription', 'Mayosis Product Subscription', $widget_options );
  }
	/**
  * Frontend
  **/
	public function widget( $args, $instance ) {
  $title = apply_filters( 'widget_title', $instance[ 'title' ] );
  $author = get_user_by( 'id', get_query_var( 'author' ) );
  $author_id=$post->post_author;
  $download_id = get_the_ID();
    $subscriberloginst= get_theme_mod( 'text_on_after_login_subscribtion','Download & use without credit. You can generate a license from your dashboard.' );
    $textlogoutuser= get_theme_mod( 'text_on_loggout_user','Subscribe to download this product. Already subscribed? Please login!' );
    $textloginuser= get_theme_mod( 'text_on_loggin_user','Subscribe to download this product.Check the subscription plan.' );
    $textfreedownload= get_theme_mod( 'text_on_free_download','A credit link is required for free downloads. Get a subscription & use without credit!' );
    $licenseurl= get_theme_mod( 'license_url_media','' );
    $check_args = array(
    					'download_id' => $download_id,
    				);
    $all_access_check = edd_all_access_check( $check_args );
    global $edd_logs;
    $price = edd_get_download_price(get_the_ID());
    $mediasubscriblink= get_theme_mod( 'page_subscription_url','' );
  echo $args['before_widget']; ?>
  
  <h4 class="widget-title"><i class="zil zi-info-ii"></i> <?php echo esc_html($title); ?></h4>
  
   
<div class="subscribe-box-price-content">
                                    <?php if ( $all_access_check['success'] ){ ?>
                                    <?php $allowed_html = [
                                            'a'      => [
                                                'href'  => [],
                                                'title' => [],
                                            ],
                                            'br'     => [],
                                            'em'     => [],
                                            'strong' => [],
                                        ]; ?>
                			<p><?php echo  wp_kses($subscriberloginst,$allowed_html); ?></p>
                                    
                                    <?php } elseif (! $all_access_check['success'] && ( $price == "0.00"  ) ){ ?>
                                    
                                   	<p><?php echo  wp_kses($textfreedownload,$allowed_html); ?></p>
                                     
                                    <?php } else {?>
                                        <?php if ( is_user_logged_in() ) { ?>
                                        
                                        <p><?php echo  wp_kses($textloginuser,$allowed_html); ?></p>
                                        
                                        <?php } else { ?>
                                        
                                      <p><?php echo  wp_kses($textlogoutuser,$allowed_html); ?></p>
                                      
                                      <?php } ?>
                                    <?php } ?>
                                    
                                    <?php if ( $all_access_check['success'] ){ ?>
                                    <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
                                    
                                    <?php } elseif (! $all_access_check['success'] && ( $price == "0.00"  ) ){ ?>
                                     <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
                                    <?php } else { ?>
                                    <a href="<?php echo esc_url($mediasubscriblink);?>" class="btn button subscribe-btn-main"><i class="zil zi-lock"></i> Premium Download</a>
                                    <?php } ?>
                                      <div class="media-style-d-favorite">
                                            <?php if ( function_exists( 'edd_favorites_load_link' ) ) {
                                                edd_favorites_load_link( $download_id );
                                            } ?>
                        
                         <?php if ( function_exists( 'edd_wl_load_wish_list_link' ) ) { ?>
                        <?php if(edd_has_variable_prices($download_id)):?>
                                <a class="photo_edd_el_button edd-wl-button" href="#variablepricemodal">
                                    <i class="glyphicon glyphicon-add"></i> <?php esc_html_e('Add to Wishlist','mayosis-core'); ?>
                                </a>

                            <?php else: ?>
                            <?php edd_wl_load_wish_list_link( $download_id ); ?>
                            <?php endif; ?>
                   
                        
                    <?php } ?>
                </div>
                
                <div class="media-style-d-social">
                     <?php if(function_exists('mayosis_photosocial')){ ?>
                                    <div class="social-template-d"><span><?php esc_html_e('Share','mayosis-core');?></span><?php mayosis_photosocial(); ?>
                                    </div>
                                <?php } ?>
                                <div class="license-template-d">
                                    <?php if ($licenseurl){?>
                                    <a href="<?php echo esc_url($licenseurl);?>"><?php esc_html_e('License','mayosis-core');?></a>
                                    <?php } ?>
                                </div>
                </div>
                                </div>

  <?php echo $args['after_widget'];
}
	/**
  * Backend
  **/
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Product Subscription') );
  $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
?>
  <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'mayosis-core' ) ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			
			    
				<p>
    Edit subscription information from the Theme Option. Mayosis > Theme Option > Product Options > Product Subscription Widget
</p>		    
				    
			
			<?php 
}
	
	public function update( $new_instance, $old_instance ) {
  $instance = $old_instance;
  $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
 
				 
  return $instance;
}
	
	
}

function product_subscription() { 
  register_widget( 'product_subscription' );
}
add_action( 'widgets_init', 'product_subscription' );

endif;