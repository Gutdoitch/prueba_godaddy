<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_edd_slider_Elementor extends Widget_Base {

    public function get_name() {
        return 'mayosis-edd-slider';
    }

    public function get_title() {
        return __( 'Mayosis Download Slider', 'mayosis-core' );
    }
    public function get_categories() {
        return [ 'mayosis-ele-cat' ];
    }
    public function get_icon() {
        return 'eicon-elementor';
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_edd',
            [
                'label' => __( 'Mayosis EDD Slider', 'mayosis-core' ),
                'type' => Controls_Manager::SECTION,
            ]
        );


        
        $this->add_control(
            'item_per_page',
            [
                'label'   => esc_html_x( 'Amount of item to display', 'Admin Panel', 'mayosis-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' =>  "10",
               
            ]
        );

        $this->add_control(
              'category',
              array(
                'label'       => esc_html__( 'Select Categories', 'mayosis-core' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
               
                'options'     => array_flip(mayosis_items_extracts( 'categories', array(
                  'sort_order'  => 'ASC',
                  'taxonomy'    => 'download_category',
                  'hide_empty'  => false,
                ) )),
                'label_block' => true,
              )
            );
            
                $this->add_control(
                    'categorynotin',
                    [
                        'label' => __( 'Exclude Category', 'mayosis-core' ),
                        'description' => __('Add one category slug','mayosis-core'),
                        'type' =>  Controls_Manager::SELECT2,
                        'multiple'    => true,
                         'options'     => array_flip(mayosis_items_extracts( 'categories', array(
                              'sort_order'  => 'ASC',
                              'taxonomy'    => 'download_category',
                              'hide_empty'  => false,
                            ) )),
                            'label_block' => true,
                       
                    ]
                );
                
          $this->add_control(
              'tags',
              array(
                'label'       => esc_html__( 'Select Tags', 'mayosis-core' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
               
                'options'     => array_flip(mayosis_items_extracts( 'tags', array(
                  'sort_order'  => 'ASC',
                  'taxonomies'    => 'download_tag',
                  'hide_empty'  => false,
                ) )),
                'label_block' => true,
              )
            );
        $this->add_control(
            'order',
            [
                'label' => __( 'Order', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
               
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending'
                ],
                'default' => 'desc',
                'condition' => [
                    'show_single' => array('recent'),
                ],

            ]
        );
        
         $this->add_control(
			'random_product',
			[
				'label' => __( 'Random Load Product', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mayosis-core' ),
				'label_off' => __( 'Hide', 'mayosis-core' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        
         $this->end_controls_section();
         
       $this->start_controls_section(
                 'list_style_section',
         [
            'label' => __( 'Slider Style', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      
      
         $this->add_control(
			'slider_title_color',
			[
				'label' => __( 'Slider Title Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#ffffff',
				
				'selectors' => [
					'{{WRAPPER}} .slide-caption-product h3.m-slider-title' => 'color: {{VALUE}}',
				],
			]
		); 
      $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slide_title_typography',
				'label' => __( 'Slider Title Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .slide-caption-product h3.m-slider-title',
			]
		);
		
		  $this->add_control(
			'slider_content_color',
			[
				'label' => __( 'Slider Content Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#ffffff',
				
				'selectors' => [
					'{{WRAPPER}} .slide-caption-product,{{WRAPPER}} .slide-caption-product p' => 'color: {{VALUE}}',
				],
			]
		); 
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slide_content_typography',
				'label' => __( 'Slider Content Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .slide-caption-product,{{WRAPPER}} .slide-caption-product p',
			]
		);
		
		$this->add_control(
			'slider_product_price_color',
			[
				'label' => __( 'Slider Product Price', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#ffffff',
				
				'selectors' => [
					'{{WRAPPER}} .mayoslide-count-download,{{WRAPPER}} .slide_promo_price span' => 'color: {{VALUE}}',
				],
			]
		); 
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slide_product_price_typography',
				'label' => __( 'Slider Product Price Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .mayoslide-count-download,{{WRAPPER}} .slide_promo_price span',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'slide_button_typography',
				'label' => __( 'Slider Button Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .slider_button_m',
			]
		);
      
    
		
		$this->start_controls_tabs( 'tabs_button_style' );
		
		    $this->start_controls_tab(
			'normal',
			[
				'label' => __( 'Normal', 'mayosis-core' ),
			]
		);
		      $this->add_control(
			'purchase_button_color',
			[
				'label' => __( 'Background Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#1e3c78',
				'selectors' => [
					'{{WRAPPER}} .slider_button_m' => 'background-color: {{VALUE}}',
					
						
				],
			]
		);
		
		 $this->add_control(
			'purchase_buttonborder_color',
			[
				'label' => __( 'Border Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#1e3c78',
				'selectors' => [
					'{{WRAPPER}} .slider_button_m' => 'border-color: {{VALUE}}',
					
						
				],
			]
		);
		
		 $this->add_control(
			'purchase_button_txt_color',
			[
				'label' => __( 'Text Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .slider_button_m' => 'color: {{VALUE}}',
					
				],
			]
		);
		$this->end_controls_tab();
		
		
		
		  $this->start_controls_tab(
			'hover',
			[
				'label' => __( 'Hover', 'mayosis-core' ),
			]
		);
		      $this->add_control(
			'preview_button_color',
			[
				'label' => __( 'Background Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#A10A8000',
				'selectors' => [
					'{{WRAPPER}} .slider_button_m:hover' => 'background-color: {{VALUE}}',
					
						
				],
			]
		);
		
		 $this->add_control(
			'preview_buttonborder_color',
			[
				'label' => __( 'Border Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => 'rgb(30 60 120 / 0.5)',
				'selectors' => [
					'{{WRAPPER}} .slider_button_m:hover' => 'border-color: {{VALUE}}',
					
						
				],
			]
		);
		
		 $this->add_control(
			'preview_button_txt_color',
			[
				'label' => __( 'Text Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => 'rgb(30 60 120 / 0.5)',
				'selectors' => [
					'{{WRAPPER}} .slider_button_m:hover' => 'color: {{VALUE}}',
					
				],
			]
		);
		$this->end_controls_tab();
			
			
		$this->end_controls_tabs();
		
		
		 $this->add_control(
			'overlay_color',
			[
				'label' => __( 'Overlay Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'separator' => 'before',
				 'default' => 'rgb(4 31 59 / 49%)',
				'selectors' => [
					'{{WRAPPER}} .mayo-p-slidebox:before' => 'background: {{VALUE}}',
					
				],
			]
		);
		
		$this->add_responsive_control(
			'slider_padding',
			[
				'label' => __( 'Slider Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
				    'top' => '225',
				    'right' => '50',
				    'bottom' => '225',
				    'left' => '50',
				    ],
				'selectors' => [
					'{{WRAPPER}} .mayo-p-slidebox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
			$this->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Slider Border Radius', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mayo-p-slidebox,{{WRAPPER}} .mayo-p-slidebox:before,{{WRAPPER}} .lSSlideWrapper,{{WRAPPER}} #mayosis-full-product-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		  $this->add_responsive_control(
			'align_button',
			[
				'label' => __( 'Slider Text Alignment', 'mayosis-core' ),
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
					'{{WRAPPER}} .mayo-p-slidebox' => 'text-align: {{VALUE}};',
				],
			]
		);

		
       $this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.

        $settings = $this->get_settings();
        $post_count = $settings['item_per_page'];
        $post_order_term= $settings['order'];
        $categories= $settings['category'];
        $tags = $settings['tags'];
        $random = $settings['random_product'];
        $downloads_category_not=$settings['categorynotin'];
        ?>


        <div class="edd_recent_ark">

        <div class="full--grid-elementor">
           
            <div id="carousel-product-msv-elmentor" class="swiper-container product--grid--elementor">
               
                <ul id="mayosis-full-product-slider" class="mayosis-full-product-slider swiper-wrapper">
             
                <?php
                global $post;
          global $wp_query; 
					
						
					
						    
						   
           
        
        
         if(!empty($categories[0])) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'download_category',
          'field'    => 'ids',
          'terms'    => $categories
        )
      );
    }
    
    if(!empty($tags[0])) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'download_tag',
          'field'    => 'ids',
          'terms'    => $tags
        )
      );
    }
    
    if($random === 'yes') {
        $args = array(
            'post_type' => 'download',
            'posts_per_page' => $post_count,
            'order' => (string)trim($post_order_term),
            'orderby' => 'rand',
            );
    } else {
          $args = array(
                            'post_type' => 'download',
                            'posts_per_page' => $post_count,
                            'order' => (string)trim($post_order_term),);
						
    }
    
     if(!empty($downloads_category_not[0])) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'download_category',
          'field'    => 'ids',
          'terms'    => $downloads_category_not,
          'operator' => 'NOT IN'
        )
      );
    }
    
                $the_query =new \WP_Query($args);
    ?>
                
                    <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                   
                   <?php 
                     global $post;
                    $author = get_user_by( 'id', get_query_var( 'author' ) );
                     $author_id=$post->post_author;
                      $download_cats = get_the_term_list( get_the_ID(), 'download_category', '', _x(' , ', '', 'mayosis-core' ), '' );
                      $productfreeoptins= get_theme_mod( 'product_free_options','custom' );
                      $productcustomtext= get_theme_mod( 'free_text','FREE' );
                      $envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );

                        if ($envato_item_id){
                         $api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
                        $item_price = $api_item_results_json['price_cents'];
                         $item_url = $api_item_results_json['url'];
                         $item_number_of_sales = $api_item_results_json['number_of_sales'];
                        }
                        
                        global $edd_logs;
															$single_count = $edd_logs->get_log_count(66, 'file_download');
															$total_count  = $edd_logs->get_log_count('*', 'file_download');
                                                            $sales = edd_get_download_sales_stats( get_the_ID() );
                                                            $sales = $sales > 1 ? $sales . ' sales' : $sales . ' sale';
                                        $price = edd_get_download_price(get_the_ID());
                   $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                   <li class="mayosis-slide-item swiper-slide">
                       <div class="mayo-p-slidebox" style="background:url(<?php echo  $feat_image; ?>);">
                                    
                        <div class="slide-caption-product slide-caption-effect">
                            
                                <h3 class="m-slider-title"><?php the_title();?></h3>
                                  <?php the_excerpt();?>
                                  	<div class="mayoslide-count-download">
								    
								     <?php if ($envato_item_id) { ?>
								     <span><?php esc_html_e('$','mayosis-core');?><?php echo number_format(($item_price /100), 2, '.', ' ');?></span>
								     <?php } else { ?>
								 <?php if( $price == "0.00"  ){ ?>
								 <?php if ($productfreeoptins=='none'): ?>		
									<span><?php edd_price(get_the_ID()); ?></span>
								<?php else: ?>
								    <span><?php echo esc_html($productcustomtext); ?></span>
								<?php endif;?>
								
								
									 <?php } else { ?>
                       <div class="slide_product-price slide_promo_price"><?php
				if(edd_has_variable_prices(get_the_ID())){
					echo edd_price_range( get_the_ID() );
				}
				else{
					edd_price(get_the_ID());
				}
					?></div>
                    <?php } ?>
                    <?php } ?>
									
								</div>
                                  <a href="<?php the_permalink();?>" class="slider_button_m"><?php esc_html_e('View Details','mayosis-core');?></a>
                      
                      
                      </div>
                      
                      </div>
                  </li>
  
                    

                    <?php endwhile; wp_reset_postdata(); ?>
                    
                    
					
                
    </ul>
    
    	<div class="swiper-pagination"></div>
<div class="elementor-swiper-button elementor-swiper-button-prev">
						<i class="eicon-chevron-left" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php _e( 'Previous', 'elementor' ); ?></span>
					</div>
					<div class="elementor-swiper-button elementor-swiper-button-next">
						<i class="eicon-chevron-right" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php _e( 'Next', 'elementor' ); ?></span>
					</div>
                
            </div>


        </div>
        <?php

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_edd_slider_Elementor );
?>