<?php 
// Adds widget: Mayosis Woo Vendor Details
class Mayosiswoovendordeta_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'mayosiswoovendordeta_widget',
			esc_html__( 'Mayosis Woo Vendor Details', 'mayosis-core' )
		);
	}

	private $widget_fields = array(
		array(
			'label' => 'Widget Style',
			'id' => 'widget-style',
			'type' => 'select',
			'options' => array(
				'One',
				'Two',
			),
		),
	);

	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		
        global $post;
        global $product;
        $seller = get_post_field( 'post_author', $product->get_id());
        

        $title = apply_filters( 'widget_title', $instance['title'] );
        $author  = get_user_by( 'id', $seller );
		$authorID= get_the_author_meta( 'ID' );
		$livepreviewtext= get_theme_mod( 'live_preview_text','Live Preview' );
		$demo_link =  get_post_meta($post->ID, 'demo_link', true);
        $widstyle = $instance['widget-style'];
        ?>
		<div class="sidebar-theme">
		     <?php if( $widstyle == "One"  ){ ?>
            <div class="single-product-widget fes--widget--author--style1">
                <?php } else{ ?>
                 <div class="single-product-widget fes--widget--author--style2">
                <?php } ?>
                <h4 class="widget-title" style="margin-bottom:0px;"><i class="zil zi-user"></i> <?php echo esc_html($title); ?></h4>
                <div class="mayosis-author-details">
                    <div class="fes--author--avmeta">
                           <div class="author-avater-main image--shape--rounded">
            
                            
                            <img src = "<?php echo esc_url( get_avatar_url( $author->ID ) ); ?>" />
                            </div>
                            <div class="fes-widget--metabox">
                            <h4>
                                       <a href="<?php echo dokan_get_store_url( $author->ID ) ?>" ><?php echo $author->display_name; ?></a>
                                    </h4>
                                    
                                     <p><?php echo count_user_posts($authorID,'product'); ?> <?php esc_html_e('Products','mayosis-core')?></p>
                                    
                                   
                                   
                                   
                                   
                                   
                            </div>
                            
                           
                    </div>
                </div>
                
                   <div class="author-buttons--section">
                                <div class="solid--buttons-fx">
                             <a href="<?php echo dokan_get_store_url( $author->ID ) ?>"
                   	        class="btn fill-fes-author-btn fes--author--btn"><?php esc_html_e('Portfolio','mayosis-core'); ?></a>
                                </div>
                                
                                 <div class="ghost--buttons-fx">
                                      <?php
                             if ( is_user_logged_in() ) { ?>
                   	      <?php $mayosisfollow =teconce_get_follow_unfollow_links( get_the_author_meta( 'ID' ) ); ?>
                                        <?php if( $mayosisfollow  ){ ?>
                                            <?php echo $mayosisfollow; ?>
                                        <?php } ?>
 <?php } else { ?>
                        
                        <a  data-toggle="modal" href="#authormessagelogin" data-lity class="tec-follow-link">Follow</a>
                        
                        <?php } ?>
                                     </div>
                             </div>
                
                
                

                </div>


        </div>
        
        
        
         <!-- Modal Login Form -->
  <div id="authormessagelogin" class="lity-hide">
            
                   
                   
              
                  <div class="modal-body">
                       <h4 class="modal-title mb-4"><?php esc_html_e('Login','mayosis-core');?></h4>
                      <?php echo do_shortcode(' [mayosis_woo_login]'); ?>
                  </div>
                
            </div>
		
		<?php echo $args['after_widget'];
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
				case 'select':
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'textdomain' ).':</label> ';
					$output .= '<select id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'">';
					foreach ($widget_field['options'] as $option) {
						if ($widget_value == $option) {
							$output .= '<option value="'.$option.'" selected>'.$option.'</option>';
						} else {
							$output .= '<option value="'.$option.'">'.$option.'</option>';
						}
					}
					$output .= '</select>';
					$output .= '</p>';
					break;
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

function register_mayosiswoovendordeta_widget() {
	register_widget( 'Mayosiswoovendordeta_Widget' );
}
add_action( 'widgets_init', 'register_mayosiswoovendordeta_widget' );