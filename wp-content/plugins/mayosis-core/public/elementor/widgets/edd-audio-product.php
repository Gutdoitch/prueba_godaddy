<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_edd_audio_Elementor_Thing extends Widget_Base {

    public function get_name() {
        return 'mayosis-edd-audio';
    }

    public function get_title() {
        return __( 'Mayosis Audio Grid', 'mayosis-core' );
    }
    public function get_categories() {
        return [ 'mayosis-ele-cat' ];
    }
    public function get_icon() {
        return 'eicon-elementor';
    }

    protected function register_controls() {

        $this->add_control(
            'section_edd',
            [
                'label' => __( 'Mayosis Audio Grid', 'mayosis-core' ),
                'type' => Controls_Manager::SECTION,
            ]
        );
        

        $this->add_control(
            'title',
            [
                'label' => __( 'Section Title', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Section Title', 'mayosis-core' ),
                'section' => 'section_edd',
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __( 'Sub Title', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Sub Title', 'mayosis-core' ),
                'section' => 'section_edd',
            ]
        );

        $this->add_control(
            'margin_bottom',
            [
                'label' => __( 'Title Section Margin Bottom (With px)', 'mayosis-core' ),
                'description' => __('Add Margin Bottom','mayosis-core'),
                'type' => Controls_Manager::TEXT,
                'default' => '20px',
                'section' => 'section_edd',
                'label_block' => true,
            ]
        );
      $this->add_control(
            'post_style',
            [
                'label' => __( 'Post Style', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'list' => 'Fixed',
                    'normal' => 'Normal'
                ],
                'default' => 'list',

            ]
        );
        
       
        
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Button Text', 'mayosis-core' ),
                'section' => 'section_edd',
                
            ]
        );


        $this->add_control(
            'button_link',
            [
                'label' => __( 'Button URL', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Button URL', 'mayosis-core' ),
                'section' => 'section_edd',
               
            ]
        );

        $this->add_control(
            'item_per_page',
            [
                'label'   => esc_html_x( 'Amount of item to display', 'Admin Panel', 'mayosis-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' =>  "10",
                'section' => 'section_edd',
            ]
        );
        $this->add_control(
            'list_layout',
            [
                'label'     => esc_html_x( 'Layout', 'Admin Panel','mayosis-core' ),
                'description' => esc_html_x('Column layout for the list"', 'mayosis-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'    =>  "1/1",
                'section' => 'section_edd',
                "options"    => array(
                    "1" => "One Column",
                    "2" => "Two Column",
                    "3" => "Three Column",
                    "4" => "Four Column",
                   
                ),
            ]

        );
        
        
        $this->add_control(
            'product_type',
            [
                'label'     => esc_html_x( 'Type', 'Admin Panel','mayosis-core' ),
                'description' => esc_html_x('Select Product Type', 'mayosis-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'    =>  "recent",
                'section' => 'section_edd',
                "options"    => array(
                    "recent" => "Recent",
                    "featured" => "Featured",
                    "popular" => "Popular",
                   
                   
                ),
            ]

        );
        
       
      
        
        $this->add_control(
      'category',
      array(
        'label'       => esc_html__( 'Select Categories', 'mayosis-core' ),
        'type'        => Controls_Manager::SELECT2,
        'multiple'    => true,
        'section' => 'section_edd',
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
                'section' => 'section_edd',
            ]
        );
        
  $this->add_control(
      'tags',
      array(
        'label'       => esc_html__( 'Select Tags', 'mayosis-core' ),
        'type'        => Controls_Manager::SELECT2,
        'multiple'    => true,
        'section' => 'section_edd',
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
                'section' => 'section_edd',
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending'
                ],
                'default' => 'desc',

            ]
        );
        
      
			$this->start_controls_section(
			'other_style',
			[
				'label' => __( 'Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'label' => __( 'Section Title Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .title--promo--box .section-title',
			]
		);
		
		$this->add_responsive_control(
			'title_max_width',
			[
				'label' => __( 'Title Box Width', 'mayosis-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .ms--title--container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Sub Title Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayos--block--subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pr_title_typo',
				'label' => __( 'Product Heading Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .product-audio-meta-titlebar h3, {{WRAPPER}} .product-audio-meta-titlebar h3 a',
			]
		);
		
		
		$this->add_control(
			'pr_title_color',
			[
				'label' => __( 'Product Title Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-audio-meta-titlebar h3, {{WRAPPER}} .product-audio-meta-titlebar h3 a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'pr_meta_color',
			[
				'label' => __( 'Product Meta Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .msb-alt-metas a,{{WRAPPER}} .msb-alt-metas span,{{WRAPPER}} .msb-alt-metas,
					{{WRAPPER}} .msb-inner-meta-price' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'product_box_background_color',
			[
				'label' => __( 'Product Background Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-normal-audio-player-msb .awp-player-wrap' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'product_box_text_color',
			[
				'label' => __( 'Product Box Text', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-normal-audio-player-msb .awp-player-wrap,
					{{WRAPPER}} .mayosis-normal-audio-player-msb .awp-waveform-preloader,
					{{WRAPPER}} .mayosis-normal-audio-player-msb .awp-playback-rate-min,
{{WRAPPER}} .mayosis-normal-audio-player-msb .awp-playback-rate-max,
{{WRAPPER}} .mayosis-normal-audio-player-msb .promo_price, {{WRAPPER}} .mayosis-normal-audio-player-msb .promo_price span,
{{WRAPPER}} .mayosis-normal-audio-player-msb .awp-visible' => 'color: {{VALUE}} !important',
				],
			]
		);
		
		$this->add_control(
			'product_wave_color',
			[
				'label' => __( 'Player Wave Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			
			]
		);
		
			$this->add_control(
			'play_btn_color',
			[
				'label' => __( 'Play Button Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-normal-audio-player-msb .awp-contr-btn i' => 'color: {{VALUE}}',
				],
			]
		);
		
		
		
		
		$this->add_control(
			'play_btn_color_hvr',
			[
				'label' => __( 'Play Button Hover Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-normal-audio-player-msb .awp-contr-btn i:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		
			$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-normal-audio-player-msb .msb-ad-post-content' => 'border-color: {{VALUE}}',
				],
			]
		);
			
		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Thumbnail Border Radius', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mayosis-normal-audio-player-msb .awp-player-thumb-wrapper,
					{{WRAPPER}} .mayosis-normal-audio-player-msb .awp-player-thumb-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

$this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.
        global $post;
        $settings = $this->get_settings();
        $post_count = ! empty( $settings['item_per_page'] ) ? (int)$settings['item_per_page'] : 5;
        $post_order_term=$settings['order'];
        $recent_section_title = $settings['title'];
        $sub_title = $settings['sub_title'];
        $title_sec_margin = $settings['margin_bottom'];
        $post_style = $settings['post_style'];
        
        $button_text = $settings['button_text'];
        $button_link = $settings['button_link'];
        $categories= $settings['category'];
        $tags = $settings['tags'];
        $downloads_category_not=$settings['categorynotin'];

        

       
  
       
        ?>
        
         <div class="ms--title--container">
        <div class="title--box--full" style="margin-bottom:<?php echo esc_attr($title_sec_margin); ?>;">
            <div class="title--promo--box">
                <h3 class="section-title"><?php echo esc_attr($recent_section_title); ?> </h3>
                <?php
                if ($sub_title ) { ?>
                     <p class="mayos--block--subtitle"><?php echo esc_attr($sub_title); ?></p>
                <?php } ?>
            </div>

            <div class="title--button--box">
                
                
                <?php
                if ($button_link) { ?>
                    <a href="<?php echo esc_attr($button_link); ?>" class="btn title--box--btn"><?php echo esc_attr($button_text); ?></a>
                <?php } ?>
             
   
            </div>
        </div>
       </div>
       
       <div class="mayosis-<?php echo esc_html($post_style);?>-audio-player-msb">
           <?php mayosis_wave_all_elementor($settings);?>
       </div>



        <?php
        

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_edd_audio_Elementor_Thing );
?>