<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class icon_box_Elementor_Thing extends Widget_Base {

   public function get_name() {
      return 'mayosis-icon-box';
   }

   public function get_title() {
      return __( 'Mayosis Icon Box', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-info-box';
   }

   protected function register_controls() {

      $this->add_control(
         'section_icon_box',
         [
            'label' => __( 'Box Content', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'section_heading',
         [
            'label' => __( 'Title', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'title' => __( 'Enter Icon Box Title', 'mayosis-core' ),
            'section' => 'section_icon_box',
         ]
      );

		$this->add_control(
         'section_icon',
         [
            'label' => __( 'Icon', 'mayosis-core' ),
            'type' => Controls_Manager::ICONS,
           'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
            'title' => __( 'Select Icon', 'mayosis-core' ),
            'section' => 'section_icon_box',
         ]
      );
      $this->add_control(
        	'show_cicon',
        	[
        		'label' => __( 'Show Custom Icon', 'mayosis-core' ),
        		'type' => Controls_Manager::SWITCHER,
        		'default' => '',
        		'label_on' => __( 'Show', 'mayosis-core' ),
        		'label_off' => __( 'Hide', 'mayosis-core' ),
        		'return_value' => 'yes',
        		'section' => 'section_icon_box',
        	]
        );
              $this->add_control(
         'image',
         [
            'label' => __( 'Custom Icon', 'mayosis-core' ),
            'type' => Controls_Manager::MEDIA,
            'section' => 'section_icon_box',
         ]
      );
      $this->add_control(
              'icon_width',
              [
                 'label'       => __( 'Custom Icon Width', 'mayosis-core' ),
                 'type'        => Controls_Manager::TEXT,
                 'default'     => __( '60', 'mayosis-core' ),
                 'placeholder' => __( 'Input only integear value', 'mayosis-core' ),
                 'section' => 'section_icon_box',
                 
              ]
            );
            
            $this->add_control(
              'icon_height',
              [
                 'label'       => __( 'Custom Icon Height', 'mayosis-core' ),
                 'type'        => Controls_Manager::TEXT,
                 'default'     => __( '60', 'mayosis-core' ),
                 'placeholder' => __( 'Input only integear value', 'mayosis-core' ),
                 'section' => 'section_icon_box',
                 
              ]
            );
      
		$this->add_control(
         'section_content',
         [
            'label' => __( 'Content', 'mayosis-core' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => '',
            'title' => __( 'Add Content', 'mayosis-core' ),
            'section' => 'section_icon_box',
         ]
      );
      $this->add_control(
         'cbtn_text',
         [
            'label' => __( 'Custom Button Text', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'title' => __( 'Enter Custom Button Text', 'mayosis-core' ),
            'section' => 'section_icon_box',
         ]
      );
      
       $this->add_control(
         'cbtn_url',
         [
            'label' => __( 'Custom Button Url', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'title' => __( 'Enter Custom Button Url', 'mayosis-core' ),
            'section' => 'section_icon_box',
         ]
      );
      
       
      //icon style start
      
      $this->start_controls_section(
			'icon_style',
			[
				'label' => __( 'Icon Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
    

       $this->add_control(
         'icon_color',
         [
            'label' => __( 'Icon Color', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Icon Color', 'mayosis-core' ),
            'selectors' => [
					'{{WRAPPER}} .quality-box i' => 'color: {{VALUE}};',
				],
            
         ]
      );
      
      $this->add_control(
         'icon_background',
         [
            'label' => __( 'Icon Background', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'yes',
            'title' => __( 'Add Icon Background', 'mayosis-core' ),
            
             'options' => [
                    'yes'  => __( 'Yes', 'mayosis-core' ),
                    'no' => __( 'No', 'mayosis-core' ),
                 ],
         ]
      ); 
      $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg',
				'title' => __( 'Select Icon Bg Color', 'mayosis-core' ),
				'description' => __( 'Icon Bg Color', 'mayosis-core' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .quality-box .icon-with-bg i',
				'condition' => [
                    'icon_background' => array('yes'),
                ],
			]
		);
		
		 $this->add_control(
         'icon_gradient',
         [
            'label' => __( 'Icon Gradient', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'no',
            'title' => __( 'Add Icon Gradient', 'mayosis-core' ),
            
             'options' => [
                    'yes'  => __( 'Yes', 'mayosis-core' ),
                    'no' => __( 'No', 'mayosis-core' ),
                 ],
         ]
      );
    
       $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_grad',
				'title' => __( 'Select Icon Gradient Color', 'mayosis-core' ),
				'description' => __( 'Icon Gradient Color', 'mayosis-core' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .quality-box .mayo-ico-gradient i',
				 'condition' => [
                    'icon_gradient' => array('yes'),
                ],
			]
		);
       
		$this->add_control(
        	'icon_beside',
        	[
        		'label' => __( 'Icon Beside Title', 'mayosis-core' ),
        		'type' => Controls_Manager::SWITCHER,
        		'default' => '',
        		'label_on' => __( 'Yes', 'mayosis-core' ),
        		'label_off' => __( 'No', 'mayosis-core' ),
        		'return_value' => 'yes',
        		
        	]
        );
      
      $this->add_responsive_control(
			'align_icon',
			[
				'label' => __( 'Icon Alignment', 'mayosis-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'mayosis-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mayosis-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mayosis-core' ),
						'icon' => 'eicon-text-align-right',
					],
				
				],
				'selectors' => [
					'{{WRAPPER}} .add-align-box' => 'text-align: {{VALUE}};',
				],
			]
		);

		   $this->end_controls_section();
		   //iconstyle end
		   
		   
		   //Custom Image Start
		   
		    $this->start_controls_section(
			'custom_style',
			[
				'label' => __( 'Custom Image Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		   
		  
      
      $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'cs_bg_type',
				'label' => __( 'Custom Image Background Type', 'mayosis-core' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .qxbox-cs-bg',
			]
		);
      
     $this->add_responsive_control(
			'cs_bg_padding',
			[
				'label' => __( 'Custom Background Padding', 'mayosis-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .qxbox-cs-bg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
     
      
      $this->add_control(
         'cs_bg_radius',
         [
            'label' => __( 'Custom Image Background Border radius', 'mayosis-core' ),
            'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .qxbox-cs-bg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            
         ]
      );
      
       $this->add_control(
         'cs_bg_stop',
         [
            'label' => __( 'Custom Image Stacked on Top', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '20px',
            'title' => __( 'Custom Image Stacked on Top (with px or %)', 'mayosis-core' ),
            
         ]
      );
      
      $this->end_controls_section();
      
      //Custom Image End
		   //other style start
		   
		$this->start_controls_section(
			'other_style',
			[
				'label' => __( 'Content Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
    
       $this->add_control(
         'title_color',
         [
            'label' => __( 'Title Color', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Title Color', 'mayosis-core' ),
            'selectors' => [
					'{{WRAPPER}} .mix-iconb-title' => 'color: {{VALUE}}',
					]
            
         ]
      );
      
         $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_font_size',
				'label' => __( 'Title Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .quality-box h4',
			]
		);
		
      
      $this->add_control(
         'description_color',
         [
            'label' => __( 'Description  Color', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Description Color', 'mayosis-core' ),
            
            'selectors' => [
					'{{WRAPPER}} .icon-box-content' => 'color: {{VALUE}}',
					]
         ]
      );
      
       $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'Description Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .icon-box-content',
			]
		);
       
      
      $this->add_responsive_control(
			'align_title',
			[
				'label' => __( 'Title Alignment', 'mayosis-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'mayosis-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mayosis-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mayosis-core' ),
						'icon' => 'eicon-text-align-right',
					],
					
				],
				'selectors' => [
					'{{WRAPPER}} .mix-iconb-title' => 'text-align: {{VALUE}};',
				],
			]
		);

      
      $this->add_responsive_control(
			'align_content',
			[
				'label' => __( 'Content Alignment', 'mayosis-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'mayosis-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mayosis-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mayosis-core' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'mayosis-core' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box-content' => 'text-align: {{VALUE}};',
				],
			]
		);

       
   
      
      
 
        $this->add_responsive_control(
			'btn_align',
			[
				'label' => __( 'Button Alignment', 'mayosis-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'mayosis-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mayosis-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mayosis-core' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .qb-custom-button' => 'text-align: {{VALUE}};',
				],
			]
		);

      
      
       $this->add_responsive_control(
			'cbtn_margin',
			[
				'label' => __( 'Button margin', 'mayosis-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .qb-custom-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
      
      $this->add_control(
         'cbtn_bg_color',
         [
            'label' => __( 'Button BG Color', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#2d3ce6',
            'title' => __( 'Custom Image Background Color', 'mayosis-core' ),
            'selectors' => [
					'{{WRAPPER}} .qb-btn-cs' => 'background: {{VALUE}};',
				],
            
         ]
      );
      
      $this->add_control(
         'cbtn_text_color',
         [
            'label' => __( 'Button Text Color', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Custom Image Text Color', 'mayosis-core' ),
            'selectors' => [
					'{{WRAPPER}} .qb-btn-cs' => 'color: {{VALUE}};',
				],
            
         ]
      );
      
       
        
        $this->end_controls_section();
     
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $images = $this->get_settings( 'image' );
      ?>


    <div class="mayosis-icon-box">
     <?php if ($settings['icon_beside'] == "yes"){ ?>
     <div class="quality-box quality-box-flex">
     <div class="icon-beside-title <?php if($settings['icon_background'] == 'yes'){ ?>icon-with-bg<?php }?>">
     <?php } else{ ?>
     <div class="quality-box">
     <div style="margin-top:-<?php echo $settings['cs_bg_stop']; ?>" class="add-align-box <?php if($settings['icon_background'] == 'yes'){ ?>icon-with-bg<?php }?>">
     <?php } ?>
        
            <?php if ($settings['show_cicon'] == "yes"){ ?>
            
            
            <p class="qxbox-cs-bg">
          
              <img src="<?php echo $images['url']; ?>" class="img-responsive" alt="custom-img" style="width:<?php echo $settings['icon_width'];?>px; height:<?php echo $settings['icon_height'];?>px">
              
              </p>
            <?php } else { ?>   
        <?php if($settings['icon_gradient'] == 'yes'){ ?>
        <span class="mayo-ico-gradient">
         <?php \Elementor\Icons_Manager::render_icon( $settings['section_icon'], [ 'aria-hidden' => 'true' ] ); ?>
         </span>
	
       
        <?php } else { ?>				  
       
        <?php \Elementor\Icons_Manager::render_icon( $settings['section_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        <?php } ?>
               <?php } ?>  
			</div>
			  <?php if ($settings['icon_beside'] == "yes"){ ?>
			  <div class="icon-beside-title-text">
			  <h4  class="mix-iconb-title"><?php echo $settings['section_heading']; ?></h4>
			   <div class="icon-box-content">	
			  <?php echo $settings['section_content']; ?>
			  
			  <?php if($settings['cbtn_url']){ ?>		
		    <div class="qb-custom-button">
		        <a href="<?php echo $settings['cbtn_url']; ?>" class="btn qb-btn-cs"><?php echo $settings['cbtn_text']; ?></a>
		    </div>
		    <?php } ?>
			  </div>
			  </div>
			  <?php } else { ?>
			  <h4 class="mix-iconb-title"><?php echo $settings['section_heading']; ?></h4>
			  <div class="icon-box-content">
			  <div><?php echo $settings['section_content']; ?></div>
			  
			  <?php if($settings['cbtn_url']){ ?>		
		    <div class="qb-custom-button">
		        <a href="<?php echo $settings['cbtn_url']; ?>" class="btn qb-btn-cs"><?php echo $settings['cbtn_text']; ?></a>
		    </div>
		    <?php } ?>
		    
			    </div>
			  	
			  <?php } ?>
            
			
		</div>
		
		</div>

      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new icon_box_Elementor_Thing );
?>