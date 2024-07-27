<?php // Adds widget: Mayosis Recent Blog Post
// Adds widget: Mayosis Recent Blog Post
class Mayosisrecentblogpos_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'mayosisrecentblogpos_widget',
			esc_html__( 'Mayosis Recent Blog Post', 'mayosis-core' )
		);
	}

	private $widget_fields = array(
		array(
			'label' => 'Number of Post',
			'id' => 'posts_number',
			'default' => '3',
			'type' => 'number',
		),
	);

	public function widget( $args, $instance ) {
		echo $args['before_widget'];

    $title = $instance['title'] ;
		if( empty($instance['posts_number']) || $instance['posts_number'] == ' ' || !is_numeric($instance['posts_number']))	$posts_number = 3;
		else $posts_number = $instance['posts_number'];
?>
<div class="sidebar-theme">
                            
                            <h4 class="widget-title"><i class="zil zi-timer"></i> <?php echo esc_html($title); ?></h4>
                            <div class="recent_post_widget">
                                                        <?php mayosis_sidebar_post( $posts_number  )?>	
                                            </div>
                            
                                            </div> 
	<?php	
		echo $args['after_widget'];
	}

	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$default = '';
			if ( isset($widget_field['default']) ) {
				$default = $widget_field['default'];
			}
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'mayosis-core' );
			switch ( $widget_field['type'] ) {
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'mayosis-core' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'mayosis-core' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'mayosis-core' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
}

function register_mayosisrecentblogpos_widget() {
	register_widget( 'Mayosisrecentblogpos_Widget' );
}
add_action( 'widgets_init', 'register_mayosisrecentblogpos_widget' );