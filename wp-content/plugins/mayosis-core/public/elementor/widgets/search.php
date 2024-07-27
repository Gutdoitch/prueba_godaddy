<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Search_Elementor_Thing extends Widget_Base {

   public function get_name() {
      return 'mayosis-search';
   }

   public function get_title() {
      return __( 'Mayosis Search', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
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
           'search-type',
           [
               'label' => __( 'Search Type', 'mayosis-core' ),
               'type' => Controls_Manager::SELECT,
               'default' => 'normal',
               'title' => __( 'Search Type', 'mayosis-core' ),
               'section' => 'search_style',
               'options' => [
                   'normal'  => __( 'Normal Search', 'mayosis-core' ),
                   'ajax' => __( 'Ajax Search', 'mayosis-core' ),
               ],

           ]
       );

 $this->add_control(
         'ajax_count',
         [
            'label' => __( 'Input Text Length', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '3',
            'section' => 'Input Text Length',
            
             'condition' => [
            'search-type' => 'ajax'
        ],
         ]
      );
       $this->add_control(
         'not_found_text',
         [
            'label' => __( 'Download Not Found Text', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'Download Not Found',
            'section' => 'Download Not Found Text',
            
             'condition' => [
            'search-type' => 'ajax'
        ],
         ]
      );
       $this->add_control(
           'search-style',
           [
               'label' => __( 'Search Style', 'mayosis-core' ),
               'type' => Controls_Manager::SELECT,
               'default' => 'style1',
               'title' => __( 'Search Style', 'mayosis-core' ),
               'section' => 'search_style',
               'options' => [
                   'style1'  => __( 'Style One', 'mayosis-core' ),
                   'style2' => __( 'Style Two', 'mayosis-core' ),
                   'style3' => __( 'Style Three', 'mayosis-core' ),
               ],
               
               'condition' => [
            'search-type' => 'normal'
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
               
               'condition' => [
            'search-type' => 'normal'
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
       $searchType = $settings['search-type'];
       $eblSearchFilter = $settings['ebl_search_filter'];
      ?>

 <!-- Element Code start -->
        <div class="product-search-form <?php echo $settings['search-style']; ?>">
            <?php if($searchType =="ajax"){ ?>
            <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
          
            <div class="mayosis-edd-ajax-search">
			<input type="text" value="<?php echo (isset($_GET['s']))?$_GET['s']: null; ?>" name="s" class="mayosisajaxsearch" autocomplete="off" placeholder="<?php echo $settings['placeholder_text']; ?>" data-length="<?php echo $settings['ajax_count'];?>"  data-not-found="<?php echo $settings['not_found_text'];?>" />
				
            <div class='mayosis-ajax-loader'></div>
            <button type="submit" value="Search" class="mayosis-ajax-search-btn">
                          <i class="zil zi-search"></i>
                         
                             <?php if (class_exists('woocommerce')){ ?>
                  		<input type="hidden" name="post_type" value="product">
                  <?php } else { ?>
                  		<input type="hidden" name="post_type" value="download">
                  <?php } ?>
                        </button>
            <div class="mayosis_edd_search_result"></div>
		</div>
		</form>
		<?php } else { ?>
	
		<form method="GET" action="<?php echo esc_url(home_url('/')); ?>">

			<?php 
			if ($eblSearchFilter=="enable"){
			    if (class_exists('woocommerce')){ 
			        $taxonomies = array('product_cat');
			    }else {
			        $taxonomies = array('download_category');
			    }
				
				$args = array('orderby'=>'count','hide_empty'=>true, 'parent'   => 0,);
				echo mayosis_get_terms_dropdown($taxonomies, $args);
			}
			 ?>
			
			
			<div class="search-fields">
				<input name="s" value="<?php echo (isset($_GET['s']))?$_GET['s']: null; ?>" type="text" placeholder="<?php echo $settings['placeholder_text']; ?>">
				   <?php if (class_exists('woocommerce')){ ?>
                  		<input type="hidden" name="post_type" value="product">
                  <?php } else { ?>
                  		<input type="hidden" name="post_type" value="download">
                  <?php } ?>
			<span class="search-btn"><input value="" type="submit"></span>
			</div>
		</form>
		
		<?php  } ?>
	</div>
      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new Search_Elementor_Thing );
?>