<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Single_button_Elementor_Thing extends Widget_Base {

   public function get_name() {
      return 'mayosis-single-button';
   }

   public function get_title() {
      return __( 'Mayosis Single Button', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-button';
   }

   protected function register_controls() {

      $this->add_control(
         'section_single_button',
         [
            'label' => __( 'Button Content', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'section_heading',
         [
            'label' => __( 'Title', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'Button',
            'title' => __( 'Enter Button Title', 'mayosis-core' ),
            'section' => 'section_single_button',
         ]
      );
       $this->add_control(
         'button_url',
         [
            'label' => __( 'Button Url', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'http://teconce.com',
            'title' => __( 'Enter Button Url', 'mayosis-core' ),
            'section' => 'section_single_button',
         ]
      );
       $this->add_control(
         'target_button',
         [
            'label' => __( 'Button Target', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => '_blank',
            'title' => __( 'Select Button Target', 'mayosis-core' ),
            'section' => 'section_single_button',
             'options' => [
                    '_blank'  => __( 'Blank', 'mayosis-core' ),
                    '_self' => __( 'Self', 'mayosis-core' ),
                 ],
         ]
      );
		$this->add_control(
         'section_icon',
         [
            'label' => __( 'Icon', 'mayosis-core' ),
            'type' => Controls_Manager::ICON,
            'default' => '',
            'title' => __( 'Select Icon', 'mayosis-core' ),
            'section' => 'section_single_button',
         ]
      );
      
       $this->add_control(
         'button_video_popup',
         [
            'label' => __( 'Video Popup For Button', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'title' => __( 'Select Popup', 'mayosis-core' ),
            'section' => 'section_single_button',
             'options' => [
                    ''  => __( 'No', 'mayosis-core' ),
                    'data-lity' => __( 'Yes', 'mayosis-core' ),
                 ],
         ]
      );
      
   $this->start_controls_section(
			'button_style_tab',
			[
				'label' => __( 'Button Style', 'mayosis-core' ),
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
					'{{WRAPPER}} .elementor-button-area .btn i' => 'color: {{VALUE}};',
				],
           
         ]
      );
      
      
       
        $this->add_responsive_control(
			'align_button',
			[
				'label' => __( 'Button Alignment', 'mayosis-core' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
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
				'prefix_class' => 'mayosis%s-align-',
				'selectors' => [
					'{{WRAPPER}} .elementor-button-area' => 'text-align: {{VALUE}};',
				],
			]
		);
       
       $this->add_control(
         'button_style',
         [
            'label' => __( 'Button Style', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'styleone',
            'title' => __( 'Select Button Style', 'mayosis-core' ),
           
             'options' => [
                    'styleone'  => __( 'Style One', 'mayosis-core' ),
                    'styletwo' => __( 'Style Two', 'mayosis-core' ),
                    'transbutton' => __( 'Transparent', 'mayosis-core' ),
                    'gradient' => __( 'Gradient', 'mayosis-core' ),
                    'custombuttonmain' => __( 'Custom', 'mayosis-core' ),
                 ],
         ]
      );
      
      $this->add_control(
         'gradient_one',
         [
            'label' => __( 'Gradient Color One', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => 'rgb(60,40,180)',
            'title' => __( 'Select Gradient Color One', 'mayosis-core' ),
           
            
            'condition' => [
                    'button_style' => array('gradient'),
                ],
         ]
      );
       
       $this->add_control(
         'gradient_two',
         [
            'label' => __( 'Gradient Color Two', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => 'rgb(100,60,220)',
            'title' => __( 'Select Gradient Color Two', 'mayosis-core' ),
           
            'condition' => [
                    'button_style' => array('gradient'),
                ],
         ]
      );
         $this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Button Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-button-area .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
      
      $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typo',
				'label' => __( 'Button Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementor-button-area .btn',
			]
		);

         $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.
       $settings = $this->get_settings();
       $button_main_style= $settings['button_style'];
       $gradient_color_a= $settings['gradient_one'];
       $gradient_color_b= $settings['gradient_two'];
      ?>

 <!-- Element Code start -->
        <div class="elementor-button-area">
        <a <?php echo $settings['button_video_popup']; ?> class="<?php echo $settings['button_style']; ?> btn btn-primary btn-lg browse-more single_dm_btn" href="<?php echo $settings['button_url']; ?>" target="<?php echo $settings['target_button']; ?>" 
         <?php if($button_main_style=="gradient"){ ?>
            style="background-image:linear-gradient( 90deg, <?php echo esc_attr($gradient_color_a) ?> 0%, <?php echo esc_attr($gradient_color_b) ?> 100%);"
        <?php } ?>
        
        ><?php echo $settings['section_heading']; ?>  <i class="<?php echo $settings['section_icon']; ?>"></i></a>
        </div>


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new Single_button_Elementor_Thing );
?>