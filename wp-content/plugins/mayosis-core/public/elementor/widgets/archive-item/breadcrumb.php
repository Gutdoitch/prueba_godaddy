<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_parchive_breadcrumb extends Widget_Base {

   public function get_name() {
      return 'mayosis-parchive-breadcrumb';
   }

   public function get_title() {
      return __( 'Mayosis Archive Breadcrumb', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-archive' ];
	}
   public function get_icon() { 
        return 'eicon-product-breadcrumbs';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_parchive_breadcrumb',
			[
				'label' => __( 'Archive Breadcrumb Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
	
	 $this->add_responsive_control(
                'product_bd_align',
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
                    'selectors' => [
                                '{{WRAPPER}} .mayosis-single-p-breadcrumb .breadcrumb' => 'text-align: {{VALUE}} !important',
                            ],
                ]
            );
            
             $this->add_control(
                'product_bd_color',
                [
                    'label'     => __( 'Breadcrumb Text Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-p-breadcrumb .breadcrumb, {{WRAPPER}} .mayosis-single-p-breadcrumb .breadcrumb span,
                        {{WRAPPER}} .mayosis-single-p-breadcrumb .breadcrumb span.active' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
             $this->add_control(
                'product_bd_link_color',
                [
                    'label'     => __( 'Breadcrumb Link Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-p-breadcrumb .breadcrumb a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'product_bd_linkhvr_color',
                [
                    'label'     => __( 'Breadcrumb Link Hover Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-p-breadcrumb .breadcrumb a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
             $this->add_control(
                'product_separator_color',
                [
                    'label'     => __( 'Breadcrumb Separator Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-p-breadcrumb .breadcrumb span.active.bredcrumb-separator' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
              $this->add_responsive_control(
                'breadcrumb_margin',
                [
                    'label' => __( 'Margin', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .breadcrumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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


<div class="mayosis-single-p-breadcrumb">
    <?php  if( Plugin::instance()->editor->is_edit_mode() ){ ?>
    
  
    <div class="breadcrumb" style="font-size: 14px;">
    <a href="#" class="breadcrumb-item">Home</a> 
    <span class="bredcrumb-separator active">&gt;</span> 
        <a href="#" class="breadcrumb-item">Downloads</a> 
        <span class="bredcrumb-separator active">&gt;</span> <span class="active"><?php echo  get_the_title( mayosis_get_last_product_id() ); ?></span>
        </div>
    <?php } else {
    
    if (function_exists('dm_breadcrumbs')) dm_breadcrumbs();
    
    }
    ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_parchive_breadcrumb);
?>