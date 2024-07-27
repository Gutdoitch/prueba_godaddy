<?php 

if ( class_exists( 'Easy_Digital_Downloads' ) ) :
class product_subscription_package extends WP_Widget {
  /**
  * Start Widget
  **/
	public function __construct() {
    $widget_options = array( 
      'classname' => 'product_subscription_package',
      'description' => 'Subscription',
    );
    parent::__construct( 'product_subscription_package', 'Mayosis Subscription Package', $widget_options );
  }
	/**
  * Frontend
  **/
	public function widget( $args, $instance ) {
  $author = get_user_by( 'id', get_query_var( 'author' ) );
  $author_id=$post->post_author;
  $download_id = get_the_ID();
  $check_args = array(
					'download_id' => $download_id,
				);
 $all_access_check = edd_all_access_check( $check_args );
 $mediasubscrib= get_theme_mod( 'media_subscription_text','Download Unlimited Stock Videos at $99/month' );
$mediasubscribtitle= get_theme_mod( 'media_subscription_btn_text','Subscribe' );
$mediasubscriblink= get_theme_mod( 'media_subscription_url','' );
$subscriptionoption = get_theme_mod( 'photoz_subscription_options', $defaults );
  echo $args['before_widget']; ?>
  
    <?php if ( ! $all_access_check['success'] ){ ?>
                                  <div class="subscribe-box-photo">
                                 <h4><?php echo esc_html($mediasubscrib);?></h4>
                                 <div class="photo-subscribe--content">
                                     <ul>
                                          <?php foreach( $subscriptionoption as $setting ) : ?>
                                         <li><i class="zil zi-check"></i>  <?php echo esc_html($setting['subscription_option']); ?></li>
                                         <?php endforeach; ?>
                                     </ul>
                                     <a href="<?php echo esc_url($mediasubscriblink);?>" class="btn button subscribe-block-btn"><?php echo esc_html($mediasubscribtitle);?></a>
                                 </div>
                             </div>
                             <?php } ?>
   


  <?php echo $args['after_widget'];
}
	/**
  * Backend
  **/
	public function form( $instance ) {
	
?>
  
			   
				<p>
    Edit subscription information from the Theme Option. Mayosis > Theme Option > Product Options >  Subscription Package
</p>		    
				    
			
			<?php 
}
	
	public function update( $new_instance, $old_instance ) {
  $instance = $old_instance;
 
				 
  return $instance;
}
	
	
}

function product_subscription_package() { 
  register_widget( 'product_subscription_package' );
}
add_action( 'widgets_init', 'product_subscription_package' );

endif;