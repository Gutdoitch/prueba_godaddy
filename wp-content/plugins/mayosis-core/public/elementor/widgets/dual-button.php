<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Double_button_Elementor_Thing extends Widget_Base {

   public function get_name() {
      return 'mayosis-double-button';
   }

   public function get_title() {
      return __( 'Mayosis Dual Button', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-dual-button';
   }

   protected function register_controls() {

      $this->add_control(
         'section_double_button',
         [
            'label' => __( 'General', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
 $this->add_control(
         'button-separator',
         [
        'label' => __( 'Show Separator', 'mayosis-core' ),
		'type' => Controls_Manager::SWITCHER,
		'default' => '',
		'label_on' => __( 'Show', 'mayosis-core' ),
		'label_off' => __( 'Hide', 'mayosis-core' ),
		'return_value' => 'yes',
        'section' => 'section_double_button',
         ]
      );
       $this->add_control(
         'button_separator_text',
         [
            'label' => __( 'Button Separator Text', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'or',
            'title' => __( 'Enter Button Separator Text', 'mayosis-core' ),
            'section' => 'section_double_button',
         ]
      );
      
        $this->add_responsive_control(
			'align_button',
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
				'section' => 'section_double_button',
				'selectors' => [
					'{{WRAPPER}} .block_of_dual_button' => 'text-align: {{VALUE}};',
				],
			]
		);

       
       $this->add_control(
         'sep_color',
         [
            'label' => __( 'Separator Color', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#666666',
            'title' => __( 'Select Separator Color', 'mayosis-core' ),
            'section' => 'section_double_button',
         ]
      );
      
 $this->add_control(
         'section_btn_one',
         [
            'label' => __( 'Button A', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
       
      $this->add_control(
         'button_a_heading',
         [
            'label' => __( 'Title', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'Button',
            'title' => __( 'Enter Button Title', 'mayosis-core' ),
            'section' => 'section_btn_one',
         ]
      );
       $this->add_control(
         'button_a_url',
         [
            'label' => __( 'Button Url', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'http://teconce.com',
            'title' => __( 'Enter Button Url', 'mayosis-core' ),
            'section' => 'section_btn_one',
         ]
      );
       $this->add_control(
         'target_button_a',
         [
            'label' => __( 'Button Target', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => '_blank',
            'title' => __( 'Select Button Target', 'mayosis-core' ),
            'section' => 'section_btn_one',
             'options' => [
                    '_blank'  => __( 'Blank', 'mayosis-core' ),
                    '_self' => __( 'Self', 'mayosis-core' ),
                 ],
         ]
      );
		$this->add_control(
         'button_icon_a',
         [
            'label' => __( 'Icon', 'mayosis-core' ),
            'type' => Controls_Manager::ICON,
            'default' => '',
            'title' => __( 'Select Icon', 'mayosis-core' ),
            'section' => 'section_btn_one',
         ]
      );
      
      
      $this->add_control(
         'button_a_video_popup',
         [
            'label' => __( 'Video Popup For Button A', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'title' => __( 'Select Popup', 'mayosis-core' ),
            'section' => 'section_btn_one',
             'options' => [
                    ''  => __( 'No', 'mayosis-core' ),
                    'data-lity' => __( 'Yes', 'mayosis-core' ),
                 ],
         ]
      );
      
     
       
       $this->add_control(
         'section_btn_two',
         [
            'label' => __( 'Button B', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
       
      $this->add_control(
         'button_b_heading',
         [
            'label' => __( 'Title', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'Button',
            'title' => __( 'Enter Button Title', 'mayosis-core' ),
            'section' => 'section_btn_two',
         ]
      );
       $this->add_control(
         'button_b_url',
         [
            'label' => __( 'Button Url', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'http://teconce.com',
            'title' => __( 'Enter Button Url', 'mayosis-core' ),
            'section' => 'section_btn_two',
         ]
      );
       $this->add_control(
         'target_button_b',
         [
            'label' => __( 'Button Target', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => '_blank',
            'title' => __( 'Select Button Target', 'mayosis-core' ),
            'section' => 'section_btn_two',
             'options' => [
                    '_blank'  => __( 'Blank', 'mayosis-core' ),
                    '_self' => __( 'Self', 'mayosis-core' ),
                 ],
         ]
      );
		$this->add_control(
         'button_icon_b',
         [
            'label' => __( 'Icon', 'mayosis-core' ),
            'type' => Controls_Manager::ICON,
            'default' => '',
            'title' => __( 'Select Icon', 'mayosis-core' ),
            'section' => 'section_btn_two',
         ]
      );
      
      
      $this->add_control(
         'button_b_video_popup',
         [
            'label' => __( 'Video Popup For Button B', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'title' => __( 'Select Popup', 'mayosis-core' ),
            'section' => 'section_btn_two',
             'options' => [
                    ''  => __( 'No', 'mayosis-core' ),
                    'data-lity' => __( 'Yes', 'mayosis-core' ),
                 ],
         ]
      );
      
      
      
    //start btn one
      
       $this->start_controls_section(
			'btn_a_style',
			[
				'label' => __( 'Button A Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_a_typo',
				'label' => __( 'Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .btn_a',
			]
		);
		 $this->add_responsive_control(
			'btn_a_padding',
			[
				'label' => __( 'Padding', 'mayosis-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .btn_a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		 $this->add_control(
         'btn_a_radius',
         [
            'label' => __( 'Border radius', 'mayosis-core' ),
            'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .btn_a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            
         ]
      );
		 $this->add_control(
         'button_style_a',
         [
            'label' => __( 'Button Style', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'styleone',
            'title' => __( 'Select Button Style', 'mayosis-core' ),
             'options' => [
                    'styleone'  => __( 'Style One', 'mayosis-core' ),
                    'styletwo' => __( 'Style Two', 'mayosis-core' ),
                    'transbutton' => __( 'Transparent', 'mayosis-core' ),
                    'gradienta' => __( 'Gradient', 'mayosis-core' ),
                    'custombuttona' => __( 'Custom', 'mayosis-core' ),
                 ],
         ]
      );
      
      $this->add_control(
         'gradient_aone',
         [
            'label' => __( 'Gradient Color One', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => 'rgb(60,40,180)',
            'title' => __( 'Select Gradient Color One', 'mayosis-core' ),
            
            'condition' => [
                    'button_style_a' => array('gradienta'),
                ],
         ]
      );
       
       $this->add_control(
         'gradient_atwo',
         [
            'label' => __( 'Gradient Color Two', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => 'rgb(100,60,220)',
            'title' => __( 'Select Gradient Color Two', 'mayosis-core' ),
            'condition' => [
                    'button_style_a' => array('gradienta'),
                ],
         ]
      );

		
		 $this->add_control(
         'buton_one_bg',
         [
            'label' => __( 'Button One Background', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button One Background', 'mayosis-core' ),
            'condition' => [
                    'button_style_a' => array('custombuttona'),
                ],
                'selectors' => [
					'.custombuttona.btn' => 'background-color: {{VALUE}}',
				],
         ]
      );
      
      $this->add_control(
         'buton_one_border',
         [
            'label' => __( 'Button One Border', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button One Border', 'mayosis-core' ),
            
              
             'condition' => [
                    'button_style_a' => array('custombuttona'),
                ],
                'selectors' => [
					'.custombuttona.btn' => 'border-color: {{VALUE}}',
				],
         ]
      );
      
      $this->add_control(
         'buton_one_text',
         [
            'label' => __( 'Button One Text', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button One Text', 'mayosis-core' ),
             'selectors' => [
					'.custombuttona.btn' => 'color: {{VALUE}}',
				],
         ]
      );
      
      $this->add_control(
         'buton_one_bg_hover',
         [
            'label' => __( 'Button One Background Hover', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button One Background', 'mayosis-core' ),
            'condition' => [
                    'button_style_a' => array('custombuttona'),
                ],
                'selectors' => [
					'.custombuttona.btn:hover' => 'background-color: {{VALUE}}',
				],
         ]
      );
      
      $this->add_control(
         'buton_one_border_hover',
         [
            'label' => __( 'Button One Border Hover', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button One Border', 'mayosis-core' ),
            
              
             'condition' => [
                    'button_style_a' => array('custombuttona'),
                ],
                
                 'selectors' => [
					'.custombuttona.btn:hover' => 'border-color: {{VALUE}}',
				],
         ]
      );
      
      $this->add_control(
         'buton_one_text_hover',
         [
            'label' => __( 'Button One Hover Text', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button One Text', 'mayosis-core' ),
             'selectors' => [
					'.custombuttona.btn:hover' => 'color: {{VALUE}}',
				],
         ]
      );
      
      
      
      
       $this->add_control(
         'button_a_class',
         [
            'label' => __( 'Button a Custom Class', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '',
         ]
      );
         $this->end_controls_section();
         
         //start btn two
          $this->start_controls_section(
			'btn_b_style',
			[
				'label' => __( 'Button B Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_b_typo',
				'label' => __( 'Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .btn_b',
			]
		);
		 $this->add_responsive_control(
			'btn_b_padding',
			[
				'label' => __( 'Padding', 'mayosis-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .btn_b' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		 $this->add_control(
         'btn_b_radius',
         [
            'label' => __( 'Border radius', 'mayosis-core' ),
            'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .btn_b' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            
         ]
      );
		 $this->add_control(
         'button_style_b',
         [
            'label' => __( 'Button Style', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'styleone',
            'title' => __( 'Select Button Style', 'mayosis-core' ),
             'options' => [
                    'styleone'  => __( 'Style One', 'mayosis-core' ),
                    'styletwo' => __( 'Style Two', 'mayosis-core' ),
                    'transbutton' => __( 'Transparent', 'mayosis-core' ),
                    'gradientb' => __( 'Gradient', 'mayosis-core' ),
                    'custombuttonb' => __( 'Custom', 'mayosis-core' ),
                 ],
         ]
      );
      
      $this->add_control(
         'gradient_bone',
         [
            'label' => __( 'Gradient Color One', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => 'rgb(60,40,180)',
            'title' => __( 'Select Gradient Color One', 'mayosis-core' ),
            
            'condition' => [
                    'button_style_b' => array('gradientb'),
                ],
         ]
      );
       
       $this->add_control(
         'gradient_btwo',
         [
            'label' => __( 'Gradient Color Two', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => 'rgb(100,60,220)',
            'title' => __( 'Select Gradient Color Two', 'mayosis-core' ),
            'condition' => [
                    'button_style_b' => array('gradientb'),
                ],
         ]
      );
		$this->add_control(
         'buton_two_bg',
         [
            'label' => __( 'Button Two Background', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button Two Background', 'mayosis-core' ),
            'condition' => [
                    'button_style_b' => array('custombuttonb'),
                ],
                'selectors' => [
					'{{WRAPPER}} .custombuttonb.btn' => 'background: {{VALUE}}',
				],
         ]
      );
      
      $this->add_control(
         'buton_two_border',
         [
            'label' => __( 'Button Two Border', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button Two Border', 'mayosis-core' ),
            
              
             'condition' => [
                    'button_style_b' => array('custombuttonb'),
                ],
                'selectors' => [
					'{{WRAPPER}} .custombuttonb.btn' => 'border-color: {{VALUE}}',
				],
         ]
      );
      
       $this->add_control(
         'buton_two_text',
         [
            'label' => __( 'Button Two Text', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button Two Text', 'mayosis-core' ),
            'selectors' => [
					'{{WRAPPER}} .custombuttonb.btn' => 'color: {{VALUE}}',
				],
            
         ]
      );
		
		  $this->add_control(
         'buton_two_bg_hover',
         [
            'label' => __( 'Button Two Background Hover', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button Two Background Hover', 'mayosis-core' ),
            'condition' => [
                    'button_style_b' => array('custombuttonb'),
                ],
                'selectors' => [
					'{{WRAPPER}} .custombuttonb.btn:hover' => 'background: {{VALUE}}',
				],
         ]
      );
      
      $this->add_control(
         'buton_two_border_hover',
         [
            'label' => __( 'Button Two Border Hover', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button Two Border Hover', 'mayosis-core' ),
            
              
             'condition' => [
                    'button_style_b' => array('custombuttonb'),
                ],
                'selectors' => [
					'{{WRAPPER}} .custombuttonb.btn:hover' => 'border-color: {{VALUE}}',
				],
         ]
      );
      
       $this->add_control(
         'buton_two_text_hover',
         [
            'label' => __( 'Button Two Text Hover', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button Two Text Hover', 'mayosis-core' ),
            'selectors' => [
					'{{WRAPPER}} .custombuttonb.btn:hover' => 'color: {{VALUE}}',
				],
            
         ]
      );
      
      $this->add_control(
         'button_b_class',
         [
            'label' => __( 'Button B Custom Class', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '',
         ]
      );
         $this->end_controls_section();
   }
   

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $button_a_style= $settings['button_style_a'];
       $gradient_color_aa = $settings['gradient_aone'];
        $gradient_color_ab = $settings['gradient_atwo'];
        
        $button_b_style= $settings['button_style_b'];
       $gradient_color_ba = $settings['gradient_bone'];
        $gradient_color_bb = $settings['gradient_btwo'];
       
      ?>

 <!-- Element Code start -->
       

<div class="block_of_dual_button col-md-12">
                        
                            <a <?php echo $settings['button_a_video_popup']; ?> href="<?php echo $settings['button_a_url']; ?>" class="<?php echo $settings['button_style_a']; ?> btn btn-lg browse-free btn_a <?php echo $settings['button_a_class']; ?>" target="<?php echo $settings['target_button_a']; ?>" 
                            
                            style="<?php  if($button_a_style=="gradienta"){ ?>background-image:linear-gradient( 90deg, <?php echo esc_attr($gradient_color_aa) ?> 0%, <?php echo esc_attr($gradient_color_ab) ?> 100%);color:<?php echo $settings['buton_one_text']; ?>;border-color:<?php echo $settings['buton_one_border']; ?>;
		<?php } ?>"
                            
                            ><?php echo $settings['button_a_heading']; ?>  <i class="<?php echo $settings['button_icon_a']; ?>"></i></a> 
                            
                            <?php if ( 'yes' == $settings['button-separator'] ) { ?>
                            <span class="divide-button" style="color:<?php echo $settings['sep_color']; ?>"><?php echo $settings['button_separator_text']; ?></span>
                      <?php } else { ?>
                      <span style="width:8px;padding: 4px;"></span>
                      <?php } ?>
   <a <?php echo $settings['button_b_video_popup']; ?>  href="<?php echo $settings['button_b_url']; ?>" class="<?php echo $settings['button_style_b']; ?> btn btn-lg browse-free btn_b <?php echo $settings['button_b_class']; ?>" target="<?php echo $settings['target_button_b']; ?>"
   
   style="<?php if($button_b_style=="gradientb"){ ?>background-image:linear-gradient( 90deg, <?php echo esc_attr($gradient_color_ba) ?> 0%, <?php echo esc_attr($gradient_color_bb) ?> 100%);color:<?php echo $settings['buton_two_text']; ?>;border-color:<?php echo $settings['buton_two_border']; ?>;
		<?php } ?>" 
   
   ><?php echo $settings['button_b_heading']; ?>  <i class="<?php echo $settings['button_icon_b']; ?>"></i></a>
                        
                           
                        
                    </div>
      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new Double_button_Elementor_Thing );
?>