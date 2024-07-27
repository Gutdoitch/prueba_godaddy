<?php
// Adds widget: Mayosis Social Widget
class Mayosissocialwidget_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'mayosissocialwidget_widget',
			esc_html__( 'Mayosis Social Widget', 'textdomain' )
		);
	}

	private $widget_fields = array(
		array(
			'label' => 'Show Facebook',
			'id' => 'facebook',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Show Twitter',
			'id' => 'twitter',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Show Google',
			'id' => 'google',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Show Pinterest',
			'id' => 'pinterest',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Show Instagram',
			'id' => 'instagram',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Show Behance',
			'id' => 'behance',
			'type' => 'checkbox',
		),
		array(
			'label' => ' Show Youtube',
			'id' => 'youtube',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Show Linkedin',
			'id' => 'linkedin',
			'type' => 'checkbox',
		),
		array(
			'label' => 'how Github',
			'id' => 'github',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Show Slack',
			'id' => 'slack',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Show Envato',
			'id' => 'envato',
			'type' => 'checkbox',
		),
		array(
			'label' => 'how Dribbble',
			'id' => 'dribbble',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Show Vimeo',
			'id' => 'vimeo',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Show Spotify',
			'id' => 'spotify',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Target',
			'id' => 'target',
			'type' => 'select',
			'options' => array(
				'self',
				'blank',
			),
		),
		array(
			'label' => 'Align',
			'id' => 'align',
			'type' => 'select',
			'options' => array(
				'left',
				'center',
				'right',
			),
		),
		array(
			'label' => 'Show Icon Without Background',
			'id' => 'without_bg',
			'type' => 'checkbox',
		),
	);

	public function widget( $args, $instance ) {
		echo $args['before_widget'];

	$title = $instance['title'];
        $facebook = $instance['facebook'];
		$twitter = $instance[ 'twitter' ] ;
		$google = $instance[ 'google' ] ;
		$pinterest = $instance[ 'pinterest' ] ;
		$instagram = $instance[ 'instagram' ];
		$behance = $instance[ 'behance' ];
		$youtube = $instance[ 'youtube' ];
		$linkedin = $instance[ 'linkedin' ] ;
		$github = $instance[ 'github' ] ;
		$slack = $instance[ 'slack' ] ;
		$envato = $instance[ 'envato' ] ;
		$dribbble = $instance[ 'dribbble' ] ;
		$vimeo = $instance[ 'vimeo' ] ;
		$spotify = $instance[ 'spotify' ] ;
		$target = $instance[ 'target' ] ;
		$align = $instance[ 'align' ] ;
		$without_bg = $instance[ 'without_bg' ];

        ?>
		  <div class="sidebar-theme">
          <?php if($title){?>
		<h4 class="footer-widget-title"><?php echo esc_html($title); ?></h4>
		<?php } ?>

        <?php
            $facebookurl= get_theme_mod('facebook_url','https://facebook.com/'); 
            $twitterurl= get_theme_mod('twitter_url','https://twitter.com/'); 
            $instagramurl= get_theme_mod('instagram_url','https://instagram.com/');
            $pinteresturl= get_theme_mod('pinterest_url','https://pinterest.com/'); 
            $youtubeurl= get_theme_mod('youtube_url','https://youtube.com/');
            $linkedinurl= get_theme_mod('linkedin_url','https://linkedin.com/');
            $githuburl= get_theme_mod('github_url','https://github.io/'); 
            $slackurl= get_theme_mod('slack_url','https://slack.com/');
            $envatourl= get_theme_mod('envato_url','https://envato.com/');
            $behanceurl= get_theme_mod('behance_url','https://behance.com/');
            $dribbbleurl= get_theme_mod('dribbble_url','https://dribbble.com/');
            $vimeourl= get_theme_mod('vimeo_url','https://vimeo.com/'); 
            $spotifyurl= get_theme_mod('spotify_url','https://spotify.com/');
            ?>

<?php if ( $without_bg ){ ?>
<div class="without-bg-social" style="text-align:<?php echo esc_html($align); ?>">
<?php } else { ?>
    <div class="social-profile" style="text-align:<?php echo esc_html($align); ?>">
<?php } ?>
                   <?php if($facebook){ ?>
							<a href="<?php echo esc_url($facebookurl); ?>" class="facebook" target="_<?php echo esc_html($target); ?>"><i class="zil zi-facebook"></i></a>
							<?php } ?>
							
							 <?php if($twitter){ ?>
							<a href="<?php echo esc_url($twitterurl); ?>" class="twitter" target="_<?php echo esc_html($target); ?>"><i class="zil zi-twitter"></i></a>
							<?php } ?>
							
							
							<?php if($pinterest){ ?>
							<a href="<?php echo esc_url($pinteresturl); ?>" class="pinterest" target="_<?php echo esc_html($target); ?>"><i class="zil zi-pinterest"></i></a>
							<?php } ?>
							
							<?php if($instagram){ ?>
							<a href="<?php echo esc_url($instagramurl); ?>" class="instagram" target="_<?php echo esc_html($target); ?>"><i class="zil zi-instagram"></i></a>
							<?php } ?>
							
							<?php if($behance){ ?>
							<a href="<?php echo esc_url($behanceurl); ?>" class="behance" target="_<?php echo esc_html($target); ?>"><i class="zil zi-behance"></i></a>
			            	<?php } ?>
			            	
			            	<?php if($youtube){ ?>
				            <a href="<?php echo esc_url($youtubeurl); ?>" class="youtube" target="_<?php echo esc_html($target); ?>"><i class="zil zi-youtube"></i></a>
				            <?php } ?>
				            
				            <?php if($linkedin){ ?>
				            <a href="<?php echo esc_url($linkedinurl); ?>" class="linkedin" target="_<?php echo esc_html($target); ?>"><i class="zil zi-linked-in"></i></a>
				            <?php } ?>
				            
				            <?php if($github){ ?>
				            <a href="<?php echo esc_url($githuburl); ?>" class="github" target="_<?php echo esc_html($target); ?>"><i class="zil zi-github"></i></a>
				            <?php } ?>
				            
				            <?php if($slack){ ?>
				            <a href="<?php echo esc_url($slackurl); ?>" class="slack" target="_<?php echo esc_html($target); ?>"><i class="zil zi-slack"></i></a>
				            <?php } ?>
				            
				             <?php if($envato){ ?>
				            <a href="<?php echo esc_url($envatourl); ?>" class="envato" target="_<?php echo esc_html($target); ?>"><i class="zil zi-envato"></i></a>
				            <?php } ?>
				            
				             <?php if($dribbble){ ?>
				            <a href="<?php echo esc_url($dribbbleurl); ?>" class="dribbble" target="_<?php echo esc_html($target); ?>"><i class="zil zi-dribbble"></i></a>
				            <?php } ?>
				            
				             <?php if($vimeo){ ?>
				            <a href="<?php echo esc_url($vimeourl); ?>" class="vimeo" target="_<?php echo esc_html($target); ?>"><i class="zil zi-vimeo"></i></a>
				            <?php } ?>
				            
				             <?php if($spotify){ ?>
				            <a href="<?php echo esc_url($spotifyurl); ?>" class="spotify" target="_<?php echo esc_html($target); ?>"><i class="zil zi-spotify"></i></a>
				            <?php } ?>
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
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'textdomain' );
			switch ( $widget_field['type'] ) {
				case 'checkbox':
					$output .= '<p>';
					$output .= '<input class="checkbox" type="checkbox" '.checked( $widget_value, true, false ).' id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" value="1">';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'textdomain' ).'</label>';
					$output .= '</p>';
					break;
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
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'textdomain' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'textdomain' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'textdomain' ); ?></label>
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

function register_mayosissocialwidget_widget() {
	register_widget( 'Mayosissocialwidget_Widget' );
}
add_action( 'widgets_init', 'register_mayosissocialwidget_widget' );