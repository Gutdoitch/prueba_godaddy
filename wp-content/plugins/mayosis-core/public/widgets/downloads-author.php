<?php
if ( class_exists( 'Easy_Digital_Downloads' ) ) :

add_action('widgets_init', 'dm_download_author');

function dm_download_author()
{
	register_widget('dm_download_author');
}

class dm_download_author extends WP_Widget {

	function __construct()
	{
		$widget_ops = array('classname' => 'dm_download_author', 'description' => esc_html__('Display Donwload Author Information','mayosis-core') );
		$control_ops = array('id_base' => 'dm_download_author');
		parent::__construct('dm_download_author', esc_html__('Mayosis Download Author widget','mayosis-core'), $widget_ops, $control_ops);

	}
	function widget($args, $instance)
	{
		extract($args);

		$title = $instance['title'];
		$stylex= $instance['stylex'];
		$vendorlink = $instance['vendorlink'];
		$solidbtn = $instance['solidbtn'];
		$ghostbtn = $instance['ghostbtn'];
		$imagecx= $instance['imagecx'];
		echo $before_widget;
		global $post;
		$author = $post->post_author;
		$authorID= get_the_author_meta( 'ID' );
		$livepreviewtext= get_theme_mod( 'live_preview_text','Live Preview' );
		$demo_link =  get_post_meta($post->ID, 'demo_link', true);
		?>

		<div class="sidebar-theme">
		     <?php if( $stylex == "styleone"  ){ ?>
            <div class="single-product-widget fes--widget--author--style1">
                <?php } else{ ?>
                 <div class="single-product-widget fes--widget--author--style2">
                <?php } ?>
                 <h4 class="widget-title" style="margin-bottom:0px;"><i class="zil zi-user"></i> <?php echo esc_html($title); ?></h4>
                <div class="mayosis-author-details">
                    <div class="fes--author--avmeta">
                        <div class="author-avater-main image--shape--<?php echo $imagecx; ?>">
                            <?php echo get_avatar( $author,90 ) ?>
                            </div>
                            <div class="fes-widget--metabox">
                                  <h4>
                                      <?php echo get_the_author_meta( 'display_name',$author);?></h4>
                                  <p><?php echo get_the_author_meta( 'address',$author);?></p>
                                   <?php if( $vendorlink == "portfolio"  ){ ?>

                                      <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID') ) ?>"
                                       class="meta--widget--fes--btn"><?php esc_html_e('Portfolio','mayosis-core'); ?></a>

                                    <?php } elseif( $vendorlink == "follow"  ){ ?>
                                         <?php
                             if ( is_user_logged_in() ) { ?>
                                          
                                          
                                        <?php $mayosisfollow =teconce_get_follow_unfollow_links( get_the_author_meta( 'ID' ) ); ?>
                                        <?php if( $mayosisfollow  ){ ?>
                                            <?php echo $mayosisfollow; ?>
                                        <?php } ?>
                                        
                                  <?php } else { ?>
                        
                        <a  data-toggle="modal" href="#authormessagelogin" data-lity class="tec-follow-link">Follow</a>
                        
                        <?php } ?>
                        
                        
                                    <?php } elseif( $vendorlink == "message"  ){ ?>
                                        <a href="#authormessage" data-lity class="meta--widget--fes--btn">
                                        <?php esc_html_e('Message','mayosis-core');?></a>
                                    <?php } ?>
                            </div>
                    </div>



                    <div class="author-buttons--section">
                        <div class="solid--buttons-fx">
                         <?php if( $solidbtn == "portfolio"  ){ ?>
                   	        <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID') ) ?>"
                   	        class="btn fill-fes-author-btn fes--author--btn"><?php esc_html_e('Portfolio','mayosis-core'); ?></a>
                   	      <?php } elseif( $solidbtn == "follow"  ){ ?>
                            
                            <?php
                             if ( is_user_logged_in() ) { ?>
                   	      <?php $mayosisfollow =teconce_get_follow_unfollow_links( get_the_author_meta( 'ID' ) ); ?>
                                        <?php if( $mayosisfollow  ){ ?>
                                            <?php echo $mayosisfollow; ?>
                                        <?php } ?>
                                        
                        <?php } else { ?>
                        
                        <a  data-toggle="modal" href="#authormessagelogin" data-lity class="tec-follow-link">Follow</a>
                        
                        <?php } ?>

                   	      <?php } elseif( $solidbtn == "message"  ){ ?>
                   	        <a href="#authormessage" data-lity class="btn fill-fes-author-btn fes--author--btn"><?php esc_html_e('Message','mayosis-core');?></a>
                   	      <?php } ?>

                         </div>

                         <div class="ghost--buttons-fx">
                   	     <?php if( $ghostbtn == "portfolio"  ){ ?>
                   	       <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID') ) ?>"
                   	       class="btn ghost-fes-author-btn fes--author--btn"><?php esc_html_e('Portfolio','mayosis-core'); ?></a>

                   	    <?php } elseif( $ghostbtn == "follow"  ){ ?>
 <?php
                             if ( is_user_logged_in() ) { ?>
                   	      <?php $mayosisfollow =teconce_get_follow_unfollow_links( get_the_author_meta( 'ID' ) ); ?>
                                        <?php if( $mayosisfollow  ){ ?>
                                            <?php echo $mayosisfollow; ?>
                                        <?php } ?>
 <?php } else { ?>
                        
                        <a  data-toggle="modal" href="#authormessagelogin" data-lity class="tec-follow-link">Follow</a>
                        
                        <?php } ?>
                   	    <?php } elseif( $ghostbtn == "message"  ){ ?>
                   	          <a  data-toggle="modal" href="#authormessage" data-lity class="btn ghost-fes-author-btn fes--author--btn"><?php esc_html_e('Message','mayosis-core');?></a>
                   	    <?php } ?>
</div>


                   	</div>
                </div>
            </div>
        </div>

  <!-- Modal Login Form -->
  <div id="authormessagelogin" class="lity-hide">
            
                   
                   
              
                  <div class="modal-body">
                       <h4 class="modal-title mb-4"><?php esc_html_e('Login','mayosis-core');?></h4>
                      <?php echo do_shortcode(' [edd_login]'); ?>
                  </div>
                
            </div>
        <!-- Modal Author Form -->
          <div id="authormessage" class="lity-hide">
          

                  
                  <div class="modal-body">
                       <h4 class="modal-title mb-4"><?php esc_html_e('Contact with this Author','mayosis-core');?></h4>
                      <?php
					if(is_author()){
						$author_id = get_user_by( 'id', get_query_var( 'author' ) );
						$author_id=$author_id->ID;

					}
					else if(is_singular('download')){
						global $post;
						$author_id=$post->post_author;


					}
					else{
						return;
					}
					?>
                    <?php echo do_shortcode( '[fes_vendor_contact_form id="'.$author_id.'"]' );  ?>
                  </div>
               
            </div>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['stylex']  = strip_tags( $new_instance['stylex'] );
		$instance['vendorlink']   = strip_tags( $new_instance['vendorlink'] );
		$instance['solidbtn']     = strip_tags( $new_instance['solidbtn'] );
		$instance['ghostbtn']     = strip_tags( $new_instance['ghostbtn'] );
		$instance['imagecx']     = strip_tags( $new_instance['imagecx'] );
		return $instance;
	}

	function form($instance)
	{
		$defaults = array(
		    'title' => esc_html__('Download Author','mayosis-core'),
		    'solidbtn' => 'portfolio',
		    'ghostbtn' => 'message',
		    'imagecx' =>'rounded',

		    );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title','mayosis-core');?>:</label>
			<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'stylex' ) ); ?>"><?php printf( esc_html__( 'Style Type', 'mayosis-core' ), edd_get_label_singular() ); ?></label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'stylex' ) ); ?>"
				id="<?php echo esc_attr( $this->get_field_id( 'stylex' ) ); ?>">
					<option value="styleone" <?php if ( $instance['stylex'] == 'styleone' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Style One', 'mayosis-core' ); ?></option>
					<option value="styletwo" <?php if ( $instance['stylex'] == 'styletwo' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Style Two', 'mayosis-core' ); ?></option>
				</select>
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'imagecx' ) ); ?>">
				<?php printf( esc_html__( 'Image Type', 'mayosis-core' ), edd_get_label_singular() ); ?></label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'imagecx' ) ); ?>"
				id="<?php echo esc_attr( $this->get_field_id( 'imagecx' ) ); ?>">
					<option value="square" <?php if ( $instance['imagecx'] == 'square' ) echo 'selected="selected"'; ?>>
					<?php esc_html_e( 'Square', 'mayosis-core' ); ?></option>
					<option value="rounded" <?php if ( $instance['imagecx'] == 'rounded' ) echo 'selected="selected"'; ?>>
					<?php esc_html_e( 'Rounded', 'mayosis-core' ); ?></option>
					
					<option value="Circle" <?php if ( $instance['imagecx'] == 'circle' ) echo 'selected="selected"'; ?>>
					<?php esc_html_e( 'Circle', 'mayosis-core' ); ?></option>
				</select>
			</p>
			
				<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'vendorlink' ) ); ?>"><?php printf( esc_html__( 'Vendor Link', 'mayosis-core' ), edd_get_label_singular() ); ?></label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'vendorlink' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'vendorlink' ) ); ?>">
					<option value="none" <?php if ( $instance['vendorlink'] == 'none' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'None', 'mayosis-core' ); ?></option>
					<option value="portfolio" <?php if ( $instance['vendorlink'] == 'portfolio' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Portfolio Link', 'mayosis-core' ); ?></option>
					<option value="follow" <?php if ( $instance['vendorlink'] == 'follow' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Follow Link', 'mayosis-core' ); ?></option>
					<option value="message" <?php if ( $instance['vendorlink'] == 'message' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Message Link', 'mayosis-core' ); ?></option>
				</select>
			</p>
			
			
				<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'solidbtn' ) ); ?>"><?php printf( esc_html__( 'Solid Button', 'mayosis-core' ), edd_get_label_singular() ); ?></label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'solidbtn' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'solidbtn' ) ); ?>">
					<option value="none" <?php if ( $instance['solidbtn'] == 'none' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'None', 'mayosis-core' ); ?></option>
					<option value="portfolio" <?php if ( $instance['solidbtn'] == 'portfolio' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Portfolio', 'mayosis-core' ); ?></option>
					<option value="follow" <?php if ( $instance['solidbtn'] == 'follow' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Follow', 'mayosis-core' ); ?></option>
					<option value="message" <?php if ( $instance['solidbtn'] == 'message' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Message', 'mayosis-core' ); ?></option>
				</select>
			</p>
			
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'ghostbtn' ) ); ?>"><?php printf( esc_html__( 'Ghost Button', 'mayosis-core' ), edd_get_label_singular() ); ?></label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'ghostbtn' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'ghostbtn' ) ); ?>">
					<option value="none" <?php if ( $instance['ghostbtn'] == 'none' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'None', 'mayosis-core' ); ?></option>
					<option value="portfolio" <?php if ( $instance['ghostbtn'] == 'portfolio' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Portfolio', 'mayosis-core' ); ?></option>
					<option value="follow" <?php if ( $instance['ghostbtn'] == 'follow' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Follow', 'mayosis-core' ); ?></option>
					<option value="message" <?php if ( $instance['ghostbtn'] == 'message' ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Message', 'mayosis-core' ); ?></option>
				</select>
			</p>
		<?php }
	}

endif;