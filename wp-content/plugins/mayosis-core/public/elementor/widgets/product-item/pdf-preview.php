<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_pdfpreview extends Widget_Base {

   public function get_name() {
      return 'mayosis-product-pdfpreview';
   }

   public function get_title() {
      return __( 'Mayosis Product PDF Preview Button', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-button';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_pdfpreview',
			[
				'label' => __( 'Product PSDF Preview Button Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
			$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'plugin-domain' ),
				'placeholder' => __( 'PDF Preview', 'plugin-domain' ),
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
                                '{{WRAPPER}} .mayosis-single-pdfpreview-button' => 'text-align: {{VALUE}} !important',
                            ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'product_button_typography',
                    'label'     => __( 'Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .mayosis-single-pdfpreview-button .ghost_button',
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
					'{{WRAPPER}} .mayosis-single-pdfpreview-button .ghost_button' => 'background: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .mayosis-single-pdfpreview-button .ghost_button' => 'border-color: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .mayosis-single-pdfpreview-button .ghost_button' => 'color: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .mayosis-single-pdfpreview-button .ghost_button:hover' => 'background: {{VALUE}} !important',
					
						
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
					'{{WRAPPER}} .mayosis-single-pdfpreview-button .ghost_button:hover' => 'border-color: {{VALUE}} !important',
					
						
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
					'{{WRAPPER}} .mayosis-single-pdfpreview-button .ghost_button:hover' => 'color: {{VALUE}} !important',
					
						
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
                        '{{WRAPPER}} .mayosis-single-pdfpreview-button .ghost_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
      $pdf_preview_url =  get_post_meta($post->ID, 'pdf_preview_url', true);
      $pdfpreviewtxt= $settings['button_text'];
      ?>


<div class="mayosis-single-pdfpreview-button">
    <?php  if( Plugin::instance()->editor->is_edit_mode() ){ ?>
     	<a href="#pdfpreviewbox" class="pdfpreview-btn-elementor ghost_button" data-lity><?php echo esc_html($pdfpreviewtxt); ?></a>

    <?php } else { ?>
          <?php if ( $pdf_preview_url  ) { ?>
    
				<a href="#pdfpreviewbox" class="pdfpreview-btn-elementor ghost_button" data-lity><?php echo esc_html($pdfpreviewtxt); ?></a>
          
       	<?php } ?>

 	<?php } ?>
</div>
<div id="pdfpreviewbox" class="lity-hide">
<embed src="<?php echo esc_html($pdf_preview_url); ?>" type="application/pdf" class="pdfpreviewboxembed">
</div>

      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_pdfpreview);
?>