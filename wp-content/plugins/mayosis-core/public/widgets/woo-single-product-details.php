<?php
// Adds widget: Woocommerce Product Details
class mayosis_woo_product_details extends WP_Widget {

	function __construct() {
		parent::__construct(
			'mayosis_woo_product_details',
			esc_html__( 'Mayosis Woo Product Details', 'mayosis-core' )
		);
	}

	private $widget_fields = array(
	);

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		global $post;
$livepreviewtext= get_theme_mod( 'live_preview_text','Live Preview' );

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		} 
			// Output generated fields
		?>

	
		<div class="mayosis-woo-sidebar-p-details">
		   <?php if ( is_singular( 'product' ) ) {?>
		    <?php woocommerce_template_single_price(); ?>
		    <?php woocommerce_template_single_add_to_cart();?>
		    <?php $demo_link =  get_post_meta($post->ID, 'woo_demo_link', true); ?>
       <?php if ( $demo_link ) { ?>
       <div class="comment-button">
                               <a href="<?php echo esc_html($demo_link); ?>" class="btn btn-default" target="_blank"><?php echo esc_html($livepreviewtext); ?></a>
                               </div>
       <?php } ?>
       
       <?php } ?>
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

function register_mayosis_woo_product_details() {
	register_widget( 'mayosis_woo_product_details' );
}
add_action( 'widgets_init', 'register_mayosis_woo_product_details' );