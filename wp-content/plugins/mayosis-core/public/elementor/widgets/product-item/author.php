<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_author extends Widget_Base {

   public function get_name() {
      return 'mayosis-author';
   }

   public function get_title() {
      return __( 'Mayosis Product Author', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-user-circle-o';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_author',
			[
				'label' => __( 'Author Options', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
        $this->add_control(
			'author_stl',
			[
				'label' => __( 'Author Style', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one'  => __( 'One', 'mayosis-core' ),
					'two' => __( 'Two', 'mayosis-core' ),
				
				],
			]
		);
		
		 $this->add_control(
			'hide_follow_button',
			[
				'label' => __( 'Follow Button', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'enable',
				'options' => [
					'enable'  => __( 'Enable', 'mayosis-core' ),
					'disable' => __( 'Disable', 'mayosis-core' ),
				
				],
			]
		);
		
		 $this->add_control(
			'hide_message_button',
			[
				'label' => __( 'Message Button', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'disable',
				'options' => [
					'enable'  => __( 'Enable', 'mayosis-core' ),
					'disable' => __( 'Disable', 'mayosis-core' ),
				
				],
			]
		);
		
		$this->add_control(
			'address_ebdbl',
			[
				'label' => __( 'Address', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'disable',
				'options' => [
					'enable'  => __( 'Enable', 'mayosis-core' ),
					'disable' => __( 'Disable', 'mayosis-core' ),
				
				],
			]
		);
            
            
            $this->add_control(
			'portfolio_text',
			[
				'label' => __( 'View Portfolio Text', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'View Portfolio', 'plugin-domain' ),
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

     $this->end_controls_section();
     
     $this->start_controls_section(
			'mayosis_product_author_style',
			[
				'label' => __( 'Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'user_name_typo',
                    'label'     => __( 'User Name Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .author-ele-information h4',
                )
            );
            
             $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'user_address_typo',
                    'label'     => __( 'Address Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .author-ele-information p',
                )
            );
            
            
     $this->add_control(
			'img_size',
			[
				'label' => __( 'Image Size', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '90',
				'options' => [
				    '60'  => __( '60px', 'mayosis-core' ),
				    '80'  => __( '80px', 'mayosis-core' ),
					'90'  => __( '90px', 'mayosis-core' ),
					'100' => __( '100px', 'mayosis-core' ),
					'120' => __( '120px', 'mayosis-core' ),
					'150' => __( '150px', 'mayosis-core' ),
				
				],
			]
		);
            
			 $this->add_responsive_control(
                'image_border-radius',
                [
                    'label' => __( 'Image Border Radius', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .author-ele-thumb-main img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
		$this->add_control(
			'uname_color',
			[
				'label' => __( 'User Name Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .author-ele-information h4' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'address_color',
			[
				'label' => __( 'Address Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .author-ele-information p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'view_port_color',
			[
				'label' => __( 'View Portfolio Link Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .author-ele-information .ele-view-portfolio-link' => 'color: {{VALUE}}',
				],
			]
		);
		
		
		 $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'follow_button',
            [
                'label' => __( 'Follow Normal', 'mayosis-core' ),
            ]
        );
        
        $this->add_control(
            'follow_button_bg',
            [
                'label' => __( 'Background Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3c78',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-elementor-author-box .tec-follow-link' => 'background: {{VALUE}}',


                ],
            ]
        );
        
        $this->add_control(
            'follow_button_border',
            [
                'label' => __( 'Border Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3c78',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-elementor-author-box .tec-follow-link' => 'border-color: {{VALUE}}',


                ],
            ]
        );
        
        $this->add_control(
            'follow_button_txt',
            [
                'label' => __( 'Text Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-elementor-author-box .tec-follow-link' => 'color: {{VALUE}}',


                ],
            ]
        );
        
        $this->end_controls_tab();



        $this->start_controls_tab(
            'follow_button_hover',
            [
                'label' => __( 'Follow Hover', 'mayosis-core' ),
            ]
        );
         $this->add_control(
            'follow_button_hvr_bg',
            [
                'label' => __( 'Background Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3c78',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-elementor-author-box .tec-follow-link:hover' => 'background: {{VALUE}}',


                ],
            ]
        );
        
        $this->add_control(
            'follow_button_hrv_border',
            [
                'label' => __( 'Border Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3c78',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-elementor-author-box .tec-follow-link:hover' => 'border-color: {{VALUE}}',


                ],
            ]
        );
        
        $this->add_control(
            'follow_button_hvr_txt',
            [
                'label' => __( 'Text Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-elementor-author-box .tec-follow-link:hover' => 'color: {{VALUE}}',


                ],
            ]
        );
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->start_controls_tabs( 'tabs_message_button_style' );

        $this->start_controls_tab(
            'message_button',
            [
                'label' => __( 'Message Normal', 'mayosis-core' ),
            ]
        );
        
        $this->add_control(
            'msg_button_bg',
            [
                'label' => __( 'Background Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3c78',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-elementor-author-box .btn.fes--author--btn' => 'background: {{VALUE}}',


                ],
            ]
        );
        
        $this->add_control(
            'msg_button_border',
            [
                'label' => __( 'Border Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3c78',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-elementor-author-box .btn.fes--author--btn' => 'border-color: {{VALUE}}',


                ],
            ]
        );
        
        $this->add_control(
            'msg_button_txt',
            [
                'label' => __( 'Text Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-elementor-author-box .btn.fes--author--btn' => 'color: {{VALUE}}',


                ],
            ]
        );
        
        $this->end_controls_tab();



        $this->start_controls_tab(
            'msg_button_hover',
            [
                'label' => __( 'Message Hover', 'mayosis-core' ),
            ]
        );
         $this->add_control(
            'msg_button_hvr_bg',
            [
                'label' => __( 'Background Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3c78',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-elementor-author-box .btn.fes--author--btn:hover' => 'background: {{VALUE}}',


                ],
            ]
        );
        
        $this->add_control(
            'msg_button_hrv_border',
            [
                'label' => __( 'Border Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3c78',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-elementor-author-box .btn.fes--author--btn:hover' => 'border-color: {{VALUE}}',


                ],
            ]
        );
        
        $this->add_control(
            'msg_button_hvr_txt',
            [
                'label' => __( 'Text Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-elementor-author-box .btn.fes--author--btn:hover' => 'color: {{VALUE}}',


                ],
            ]
        );
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
		$this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $author_stl = $settings['author_stl'];
       $hide_follow_button = $settings['hide_follow_button'];
       $hide_message_button = $settings['hide_message_button'];
        global $post;
		$author = $post->post_author;
		$authorID= get_the_author_meta( 'ID' );
		$img_size = $settings['img_size'];
		$ptext = $settings['portfolio_text'];
		$adress = $settings['address_ebdbl'];
	
       
      ?>


<div class="mayosis-single-builder-author-bd mayo-ele-author-style-<?php echo $author_stl; ?>">
 <?php
 if( Plugin::instance()->editor->is_edit_mode() ){
            $title = get_the_title( mayosis_get_last_product_id() );
            $postID= mayosis_get_last_product_id();?>
            
          <div class="mayosis-elementor-author-box">
             <div class="author-left-side-infomation-ele">
                 <div class="author-ele-thumb-main">
                     <?php echo get_avatar( $author,$img_size ) ?>
                 </div>
                 
                 <div class="author-ele-information">
                     <h4><?php echo get_the_author_meta( 'display_name',$author);?></h4>
                     <?php if($adress=="enable"){?>
                       <p><?php echo get_the_author_meta( 'address',$author);?></p>
                     <?php } ?>
                     <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID') ) ?>"
                   	        class="ele-view-portfolio-link"><?php echo esc_html($ptext);?></a>
                 </div>
             </div>
             <div class="author-left-side-infomation-ele">
                 <?php if ($hide_follow_button=="enable"){?>
                     <div class="ele-btn-left-one">
                         <?php
                                 if ( is_user_logged_in() ) { ?>
                                              
                                              
                                            <?php $mayosisfollow =teconce_get_follow_unfollow_links( get_the_author_meta( 'ID' ) ); ?>
                                            <?php if( $mayosisfollow  ){ ?>
                                                <?php echo $mayosisfollow; ?>
                                            <?php } ?>
                                            
                                      <?php } else { ?>
                            
                            <a href="#authormessageloginlity" class="tec-follow-link" data-lity><?php esc_html_e('Follow','mayosis-core');?></a>
                            
                            <?php } ?>
                     </div>
                 <?php }  ?>
                 <?php if ($hide_message_button=="enable"){?>
                     <div class="ele-btn-right-one">
                           <a href="#authormessageauthor" class="btn ghost-fes-author-btn fes--author--btn" data-lity><?php esc_html_e('Message','mayosis-core');?></a>
                    </div>
                <?php }  ?>
             </div>
         </div>
         
           
        <?php }else{ ?>
         <div class="mayosis-elementor-author-box">
             <div class="author-left-side-infomation-ele">
                 <div class="author-ele-thumb-main">
                     <?php echo get_avatar( $author,$img_size ) ?>
                 </div>
                 
                 <div class="author-ele-information">
                     <h4><?php echo get_the_author_meta( 'display_name',$author);?></h4>
                      <?php if($adress=="enable"){?>
                     <p><?php echo get_the_author_meta( 'address',$author);?></p>
                     <?php } ?>
                     <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID') ) ?>"
                   	        class="ele-view-portfolio-link"><?php echo esc_html($ptext);?></a>
                 </div>
             </div>
             <div class="author-left-side-infomation-ele">
                 <?php if ($hide_follow_button=="enable"){?>
                     <div class="ele-btn-left-one">
                         <?php
                                 if ( is_user_logged_in() ) { ?>
                                              
                                              
                                            <?php $mayosisfollow =teconce_get_follow_unfollow_links( get_the_author_meta( 'ID' ) ); ?>
                                            <?php if( $mayosisfollow  ){ ?>
                                                <?php echo $mayosisfollow; ?>
                                            <?php } ?>
                                            
                                      <?php } else { ?>
                            
                            <a href="#authormessageloginlity" class="tec-follow-link" data-lity><?php esc_html_e('Follow','mayosis-core');?></a>
                            
                            <?php } ?>
                     </div>
                 <?php }  ?>
                 <?php if ($hide_message_button=="enable"){?>
                     <div class="ele-btn-right-one">
                           <a href="#authormessageauthor" class="btn ghost-fes-author-btn fes--author--btn" data-lity><?php esc_html_e('Message','mayosis-core');?></a>
                    </div>
                <?php }  ?>
             </div>
         </div>
         
         
         
         <div id="authormessageloginlity"  class="authormessageloginele lity-hide">
             <h4 class="ele-login--title">Login</h4>
            <?php echo do_shortcode(' [edd_login]'); ?>
            </div>
            
            
            <div id="authormessageauthor"  class="authormessageauthorele lity-hide">
             <h4 class="ele-msg--title">Contact with this Author</h4>
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
       <?php }
 ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_author);
?>