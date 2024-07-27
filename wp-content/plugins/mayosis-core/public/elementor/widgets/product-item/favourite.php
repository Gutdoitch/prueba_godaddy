<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_favourite extends Widget_Base {

   public function get_name() {
      return 'mayosis-product-favourite';
   }

   public function get_title() {
      return __( 'Mayosis Product Favourite', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-heart-o';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_favourite',
			[
				'label' => __( 'Product Favourite', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
            
              $this->add_responsive_control(
                'product_favourite_align',
                [
                    'label'        => __( 'Alignment', 'mayosis-core' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'flex-start'   => [
                            'title' => __( 'Left', 'mayosis-core' ),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mayosis-core' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'flex-end'  => [
                            'title' => __( 'Right', 'mayosis-core' ),
                            'icon'  => 'eicon-text-align-right',
                        ],
                    ],
                    'prefix_class' => 'elementor-align-%s',
                    'default'      => 'flex-start',
                     'selectors' => [
                                '{{WRAPPER}} .msv-favourite-single-p' => 'justify-content: {{VALUE}} !important',
                            ],
                ]
            );
            
              $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'product_favourite_typography',
                    'label'     => __( 'Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .msv-favourite-single-p .edd-wl-button,
                    {{WRAPPER}} .msv-favourite-single-p .edd-wl-button span',
                )
            );
            
            
            $this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .edd-wl-favorite i.glyphicon:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
            
       
            
             $this->add_responsive_control(
                'product_favourite_margin',
                [
                    'label' => __( 'Padding', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .msv-favourite-single-p .edd-wl-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
            
              $this->add_responsive_control(
                'product_border_radius',
                [
                    'label' => __( 'Border Radius', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .msv-favourite-single-p .edd-wl-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
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
                    '{{WRAPPER}} .msv-favourite-single-p .edd-wl-button' => 'background: {{VALUE}}',


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
                    '{{WRAPPER}} .msv-favourite-single-p .edd-wl-button' => 'border-color: {{VALUE}}',


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
                    '{{WRAPPER}} .msv-favourite-single-p .edd-wl-button,
                    {{WRAPPER}} .msv-favourite-single-p .edd-wl-button span,{{WRAPPER}} .msv-favourite-single-p .edd-wl-button i' => 'color: {{VALUE}};',


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
                    '{{WRAPPER}} .msv-favourite-single-p .edd-wl-button:hover' => 'background: {{VALUE}} !important',


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
                    '{{WRAPPER}} .msv-favourite-single-p .edd-wl-button:hover' => 'border-color: {{VALUE}} !important',


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
                    '{{WRAPPER}} .msv-favourite-single-p .edd-wl-button:hover,
                    {{WRAPPER}} .msv-favourite-single-p .edd-wl-button:hover span,{{WRAPPER}} .msv-favourite-single-p .edd-wl-button:hover i' => 'color: {{VALUE}} ',


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
       $download_id = get_the_ID();
       $last_product_id = mayosis_get_last_product_id();
      ?>


<div class="msv-single-favourite">
 <?php
 if( Plugin::instance()->editor->is_edit_mode() ){
     ?>
             <div class="msv-favourite-single-p">
            <?php edd_favorites_load_link( $last_product_id ); ?>
                    </div>
       <?php  } else{ ?>
       
       <div class="msv-favourite-single-p">
            <?php edd_favorites_load_link( $download_id ); ?>
                    
                    </div>
       <?php }
 ?>
</div>
	  


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_favourite);
?>