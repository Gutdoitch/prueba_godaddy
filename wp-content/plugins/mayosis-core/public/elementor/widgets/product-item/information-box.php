<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_information extends Widget_Base {

   public function get_name() {
      return 'mayosis-product-information';
   }

   public function get_title() {
      return __( 'Mayosis Product Information', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-product-info';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_information',
			[
				'label' => __( 'Product Information Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		

            
              $this->add_responsive_control(
                'product_title_align',
                [
                    'label'        => __( 'Alignment', 'mayosis-core' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'flex-start'   => [
                            'title' => __( 'Left', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'flex-end'  => [
                            'title' => __( 'Right', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'prefix_class' => 'elementor-align-%s',
                    'default'      => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-builder-information-title' => 'justify-content: {{VALUE}} !important;',
                    ],
                ]
            );
            
              $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'product_tag_typography',
                    'label'     => __( 'Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .mayosis-single-builder-information-title ul li a',
                )
            );
            
            
          	$this->start_controls_tabs( 'tabs_button_style' );
		
		    $this->start_controls_tab(
			'tag_button',
			[
				'label' => __( 'Tag Normal', 'mayosis-core' ),
			]
		);
		      $this->add_control(
			'lm_button_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#1e3c78',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-builder-information-title ul li a' => 'background: {{VALUE}}',
					
						
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
					'{{WRAPPER}}  .mayosis-single-builder-information-title ul li a' => 'border-color: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .mayosis-single-builder-information-title ul li a' => 'color: {{VALUE}}',
					
						
				],
			]
		);
			$this->end_controls_tab();
		
		
		
		  $this->start_controls_tab(
			'tag_button_hover',
			[
				'label' => __( 'Tag Hover', 'mayosis-core' ),
			]
		);
		
		 $this->add_control(
			'lm_button_hvr_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#0A0FA1',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-builder-information-title ul li a:hover' => 'background: {{VALUE}} !important',
					
						
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
					'{{WRAPPER}} .mayosis-single-builder-information-title ul li a:hover' => 'border-color: {{VALUE}} !important',
					
						
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
					'{{WRAPPER}} .mayosis-single-builder-information-title ul li a:hover' => 'color: {{VALUE}} !important',
					
						
				],
			]
		);
		
			$this->end_controls_tab();
				$this->end_controls_tabs();
            
			 $this->add_responsive_control(
                'tag_padding',
                [
                    'label' => __( 'Padding', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-builder-information-title ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
            
             $this->add_responsive_control(
                'tag_border_radius',
                [
                    'label' => __( 'Border Radius', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-builder-information-title ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       
      ?>


<div class="mayosis-single-builder-information-bd">
 <?php
 if( Plugin::instance()->editor->is_edit_mode() ){
            $title = get_the_title( mayosis_get_last_product_id() ); ?>
            
            <?php $widgetlayouts  = get_theme_mod( 'product_information_widget_manager', array( 'price','released','updated','fileincluded','filesize' ,'compatible') );
			  if ($widgetlayouts): foreach ($widgetlayouts as $layout) {
 
                            switch($layout) {
                         
                                
                                case 'price': get_template_part( 'includes/products/information-price' );
                                break;
                                
                                 case 'released': get_template_part( 'includes/products/information-released' );
                                break;
                                
                                
                                 case 'updated': get_template_part( 'includes/products/information-updated' );
                                break;
                                
                                case 'version': get_template_part( 'includes/products/information-version' );
                                break;
                                
                                 case 'fileincluded': get_template_part( 'includes/products/information-fileincluded' );
                                break;
                         
                               case 'filesize': get_template_part( 'includes/products/information-filesize' );
                                break;
                                
                                
                                 case 'compatible': get_template_part( 'includes/products/information-compatible' );
                                break;
                                
                                case 'documentation': get_template_part( 'includes/products/information-documentation' );
                                break;
                                
                                 case 'sales': get_template_part( 'includes/products/information-sales' );
                                break;
                              
                              
                               case 'category': get_template_part( 'includes/products/information-category' );
                                break;
                         
                            }
                         
                        }
                         
                        endif; 
			?>
           
        <?php }else{ ?>
           <?php $widgetlayouts  = get_theme_mod( 'product_information_widget_manager', array( 'price','released','updated','fileincluded','filesize' ,'compatible') );
			  if ($widgetlayouts): foreach ($widgetlayouts as $layout) {
 
                            switch($layout) {
                         
                                
                                case 'price': get_template_part( 'includes/products/information-price' );
                                break;
                                
                                 case 'released': get_template_part( 'includes/products/information-released' );
                                break;
                                
                                
                                 case 'updated': get_template_part( 'includes/products/information-updated' );
                                break;
                                
                                case 'version': get_template_part( 'includes/products/information-version' );
                                break;
                                
                                 case 'fileincluded': get_template_part( 'includes/products/information-fileincluded' );
                                break;
                         
                               case 'filesize': get_template_part( 'includes/products/information-filesize' );
                                break;
                                
                                
                                 case 'compatible': get_template_part( 'includes/products/information-compatible' );
                                break;
                                
                                case 'documentation': get_template_part( 'includes/products/information-documentation' );
                                break;
                                
                                 case 'sales': get_template_part( 'includes/products/information-sales' );
                                break;
                              
                              
                               case 'category': get_template_part( 'includes/products/information-category' );
                                break;
                         
                            }
                         
                        }
                         
                        endif; 
			?>
       <?php }
 ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_information);
?>