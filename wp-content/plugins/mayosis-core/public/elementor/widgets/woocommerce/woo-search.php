<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class woo_Search_Elementor extends Widget_Base {

   public function get_name() {
      return 'mayosis-woo-search';
   }

   public function get_title() {
      return __( 'Mayosis Woo Search', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-woo-cat' ];
	}
   public function get_icon() { 
        return 'eicon-search';
   }

   protected function register_controls() {

      $this->add_control(
         'search_style',
         [
            'label' => __( 'Search Content', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

       $this->add_control(
         'placeholder_text',
         [
            'label' => __( 'Placeholder text', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'Search Now',
            'section' => 'search_style',
         ]
      );
    


  
       $this->add_control(
           'search-style',
           [
               'label' => __( 'Search Style', 'mayosis-core' ),
               'type' => Controls_Manager::SELECT,
               'default' => 'one',
               'title' => __( 'Search Style', 'mayosis-core' ),
               'section' => 'search_style',
               'options' => [
                   'one'  => __( 'Style One', 'mayosis-core' ),
                   'two' => __( 'Style Two', 'mayosis-core' ),
               ],
               
         

           ]
       );
       
       $this->add_control(
           'ebl_search_filter',
           [
               'label' => __( 'Search Category Filter', 'mayosis-core' ),
               'type' => Controls_Manager::SELECT,
               'default' => 'enable',
               'title' => __( 'Category Enable/Disable', 'mayosis-core' ),
               'section' => 'search_style',
               'options' => [
                   'enable'  => __( 'Enable', 'mayosis-core' ),
                   'disable' => __( 'Disable', 'mayosis-core' ),
               ],
               
          

           ]
       );
       
       
       $this->start_controls_section(
			'other_style',
			[
				'label' => __( 'Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'search_bg',
			[
				'label' => __( 'Search Background Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .product-search-form.style2 input[type="text"],{{WRAPPER}} .product-search-form.style1 input[type="text"]' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'search_border',
			[
				'label' => __( 'Search Border Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .product-search-form.style2 input[type="text"],{{WRAPPER}} .product-search-form.style1 input[type="text"]' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'search_text',
			[
				'label' => __( 'Search Text Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .product-search-form.style2 input[type="text"],{{WRAPPER}} .product-search-form.style1 input[type="text"]' => 'color: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			'search_placeholder_text',
			[
				'label' => __( 'Search Placeholder Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .product-search-form.style2 input[type="text"]::placeholder,{{WRAPPER}} .product-search-form.style1 input[type="text"]::placeholder,{{WRAPPER}}  .product-search-form.style2 input[type="text"]::-webkit-input-placeholder,{{WRAPPER}} .product-search-form.style1 input[type="text"]::-webkit-input-placeholder' => 'color: {{VALUE}} !important',
				],
			]
		);
		
		$this->add_control(
			'filter_bg',
			[
				'label' => __( 'Filter Background Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .download_cat_filter' => 'background: {{VALUE}}',
				],
				     'condition' => [
            'search-type' => 'normal'
        ],
			]
		);
			$this->add_control(
			'filter_active_text',
			[
				'label' => __( 'Filter Active Text Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-search-form .download_cat_filter .mayosel-select span.current, {{WRAPPER}} .product-search-form .download_cat_filter .mayosel-select:after' => 'color: {{VALUE}}',
				],
				     'condition' => [
            'search-type' => 'normal'
        ],
			]
		);
		
			$this->add_control(
			'filter_text',
			[
				'label' => __( 'Filter Text Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosel-select .option' => 'color: {{VALUE}}',
				],
				     'condition' => [
            'search-type' => 'normal'
        ],
			]
		);
		
			$this->add_control(
			'filter_selected_text',
			[
				'label' => __( 'Filter Selected Text Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosel-select .option.selected' => 'color: {{VALUE}}',
				],
				
				     'condition' => [
            'search-type' => 'normal'
        ],
			]
		);
		$this->add_control(
			'filter_list_bg',
			[
				'label' => __( 'Filter Dropdown Background Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosel-select .list' => 'background: {{VALUE}}',
				],
				
				     'condition' => [
            'search-type' => 'normal'
        ],
			]
		);
		
		$this->add_control(
			'filter_hover',
			[
				'label' => __( 'Filter Hover Background Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosel-select .option:hover,{{WRAPPER}} .mayosel-select .option.focus' => 'background: {{VALUE}}',
				],
				     'condition' => [
            'search-type' => 'normal'
        ],
			]
		);
		$this->add_control(
			'submit_icon_color',
			[
				'label' => __( 'Submit Icon Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} input[type="submit"],
					{{WRAPPER}} .product-search-form.style2 .search-btn::after,
					{{WRAPPER}} .search-btn::after,
					{{WRAPPER}} .mayosis-ajax-search-btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'submit_bg_color',
			[
				'label' => __( 'Submit Background Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-btn::after' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'border-radius',
			[
				'label' => esc_html__( 'Border Radius', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mayosisajaxsearch,
					{{WRAPPER}} .search-fields input[type="text"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'ajax_Loader_icon_color',
			[
				'label' => __( 'Loader Icon Back Border Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-edd-ajax-search .mayosis-ajax-loader' => 'border-color: {{VALUE}}',
				],
				    'condition' => [
            'search-type' => 'ajax'
        ],
			]
		);
		$this->add_control(
			'ajax_Loader_Topicon_color',
			[
				'label' => __( 'Loader Icon Top Border Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-edd-ajax-search .mayosis-ajax-loader' => 'border-top-color: {{VALUE}}',
				],
				    'condition' => [
            'search-type' => 'ajax'
        ],
			]
		);
		$this->end_controls_section();
       
   }
   
   

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
    
      ?>

 <!-- Element Code start -->
        <div class="product-search-form">
           <?php mayosis_live_search_elementor($settings); ?> 
	</div>
      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new woo_Search_Elementor );
?>