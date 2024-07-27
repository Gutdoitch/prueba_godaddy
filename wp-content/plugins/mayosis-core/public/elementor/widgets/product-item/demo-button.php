<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_demobutton extends Widget_Base {

   public function get_name() {
      return 'mayosis-product-demobutton';
   }

   public function get_title() {
      return __( 'Mayosis Product Demo Preview Button', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-button';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_demobutton',
			[
				'label' => __( 'Product Preview Button Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
			
			 $this->add_responsive_control(
                'product_button_align',
                [
                    'label'        => __( 'Alignment', 'mayosis-core' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'left'   => [
                            'title' => __( 'Left', 'mayosis-core' ),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mayosis-core' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'right'  => [
                            'title' => __( 'Right', 'mayosis-core' ),
                            'icon'  => 'eicon-text-align-right',
                        ],
                    ],
                    'prefix_class' => 'elementor-align-%s',
                    'default'      => 'left',
                      'selectors' => [
                                '{{WRAPPER}} .mayosis-single-demopv-button' => 'text-align: {{VALUE}} !important',
                            ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'product_button_typography',
                    'label'     => __( 'Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .mayosis-single-demopv-button .ghost_button',
                )
            );
            
        	$this->start_controls_tabs( 'tabs_button_style' );
		
		    $this->start_controls_tab(
			'cart_button',
			[
				'label' => __( 'Button', 'mayosis-core' ),
			]
		);
		      $this->add_control(
			'lm_button_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#1e3c78',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-demopv-button .ghost_button' => 'background: {{VALUE}}',
					
						
				],
			]
		);
		
		
		  $this->add_control(
			'lm_border_color',
			[
				'label' => __( 'Border Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#1e3c78',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-demopv-button .ghost_button' => 'border-color: {{VALUE}}',
					
						
				],
			]
		);
		$this->add_control(
			'lm_txtr_color',
			[
				'label' => __( 'Text Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-demopv-button .ghost_button' => 'color: {{VALUE}}',
					
						
				],
			]
		);
			$this->end_controls_tab();
		
		
		
		  $this->start_controls_tab(
			'cart_button_hover',
			[
				'label' => __( 'Button Hover', 'mayosis-core' ),
			]
		);
		
		 $this->add_control(
			'lm_button_hvr_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#0A0FA1',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-demopv-button .ghost_button:hover' => 'background: {{VALUE}} !important',
					
						
				],
			]
		);
		
		$this->add_control(
			'lm_button_border_color',
			[
				'label' => __( 'Border Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#0A0FA1',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-demopv-button .ghost_button:hover' => 'border-color: {{VALUE}} !important',
					
						
				],
			]
		);
		$this->add_control(
			'lm_button_txt_color',
			[
				'label' => __( 'Text Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-demopv-button .ghost_button:hover' => 'color: {{VALUE}} !important',
					
						
				],
			]
		);
		
			$this->end_controls_tab();
				$this->end_controls_tabs();
            
            $this->add_responsive_control(
                'cart_padding',
                [
                    'label' => __( 'Padding', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-demopv-button .ghost_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
            
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
         global $post;
      $demo_link =  get_post_meta($post->ID, 'demo_link', true);
      $livepreviewtext= get_theme_mod( 'live_preview_text','Live Preview' );
      ?>


<div class="mayosis-single-demopv-button">
    <?php  if( Plugin::instance()->editor->is_edit_mode() ){ ?>
     	<a href="<?php echo esc_html($demo_link); ?>" class="demopv-btn-elementor ghost_button" target="_blank"><?php echo esc_html($livepreviewtext); ?></a>

    <?php } else { ?>
          <?php if ( $demo_link  ) { ?>
    
				<a href="<?php echo esc_html($demo_link); ?>" class="demopv-btn-elementor ghost_button" target="_blank"><?php echo esc_html($livepreviewtext); ?></a>
          
       	<?php } ?>

 	<?php } ?>
</div>


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_demobutton);
?>