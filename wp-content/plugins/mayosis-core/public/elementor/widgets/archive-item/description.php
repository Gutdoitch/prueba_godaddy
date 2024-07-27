<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_archive_description extends Widget_Base {

   public function get_name() {
      return 'mayosis-archive-description';
   }

   public function get_title() {
      return __( 'Mayosis Archive Description', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-archive' ];
	}
   public function get_icon() { 
        return 'eicon-product-description';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_archive_description',
			[
				'label' => __( 'Archive Description Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
            
              $this->add_responsive_control(
                'mayosis-arch-p-desc_align',
                [
                    'label'        => __( 'Alignment', 'mayosis-core' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'left'   => [
                            'title' => __( 'Left', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right'  => [
                            'title' => __( 'Right', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'prefix_class' => 'elementor-align-%s',
                    'default'      => 'left',
                ]
            );
            
            $this->add_control(
			'desc_type',
			[
				'label' => __( 'Description Type', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', 'mayosis-core' ),
					'additional' => __( 'Additional', 'mayosis-core' ),
					
				],
			]
		);
            
              $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'mayosis-arch-p-desc_typography',
                    'label'     => __( 'Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .mayosis-arch-p-desc',
                )
            );
            
            
            $this->add_control(
                'mayosis-arch-p-desc_color',
                [
                    'label'     => __( 'Title Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-arch-p-desc' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );
            
             $this->add_responsive_control(
                'mayosis-arch-p-desc_margin',
                [
                    'label' => __( 'Margin', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-arch-p-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
			
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $desc_type = $settings['desc_type'];
      ?>


<div class="mayosis-arch-p-desc">
 <?php
 if( Plugin::instance()->editor->is_edit_mode() ){
           echo 'Horrible would used business scent participate object been he big arm, emphasis merely best';
        }else{
            if ($desc_type=="additional"){
                $categoryidextract = get_queried_object();
                       $additionaldesc  = get_term_meta($categoryidextract->term_id, 'additional_description', true);
                        $allowed_html = [
                            'a'      => [
                                'href'  => [],
                                'title' => [],
                            ],
                            'br'     => [],
                            'em'     => [],
                            'strong' => [],
                            'img' => [],
                            'i' => [],
                             'b' => [],
                             'mark' => [],
                        ]; 
                        	echo wp_kses($additionaldesc,$allowed_html);
            } else {
             echo category_description();
            }
        }
 ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_archive_description);
?>