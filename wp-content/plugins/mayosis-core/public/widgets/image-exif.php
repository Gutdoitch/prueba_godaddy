<?php 

if ( class_exists( 'Easy_Digital_Downloads' ) ) :
class product_exif_info extends WP_Widget {
  /**
  * Start Widget
  **/
	public function __construct() {
    $widget_options = array( 
      'classname' => 'product_exif_info',
      'description' => 'Image Exif',
    );
    parent::__construct( 'product_exif_info', 'Mayosis Exif Data', $widget_options );
  }
	/**
  * Frontend
  **/
	public function widget( $args, $instance ) {
	     global $post;
	$author = get_user_by( 'id', get_query_var( 'author' ) );
  $author_id=$post->post_author;
  $title = apply_filters( 'widget_title', $instance[ 'title' ] );
  $postID = get_the_ID();

  echo $args['before_widget']; ?>
  
  <h4 class="widget-title"><i class="zil zi-eye"></i> <?php echo esc_html($title); ?></h4>
  
  <div class="mayosis-exif-data">
   
                 <?php echo mayosis_image_exif_data();?>        
   </div>


  <?php echo $args['after_widget'];
}
	/**
  * Backend
  **/
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Exif Data') );
  $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
?>
  <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'mayosis-core' ) ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			
		    
			
				    
			
			<?php 
}
	
	public function update( $new_instance, $old_instance ) {
  $instance = $old_instance;
  $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
 
				 
  return $instance;
}
	
	
}

function product_exif_info() { 
  register_widget( 'product_exif_info' );
}
add_action( 'widgets_init', 'product_exif_info' );

endif;