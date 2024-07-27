<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_edd_cateory_audio_Elementor_Thing extends Widget_Base {

    public function get_name() {
        return 'mayosis-edd-cat-audio';
    }

    public function get_title() {
        return __( 'Archive Audio Grid', 'mayosis-core' );
    }
    public function get_categories() {
        return [ 'mayosis-product-archive' ];
    }
    public function get_icon() {
        return 'eicon-elementor';
    }

    protected function register_controls() {

        $this->add_control(
            'section_edd',
            [
                'label' => __( 'Archive Audio Grid', 'mayosis-core' ),
                'type' => Controls_Manager::SECTION,
            ]
        );
        

        $this->add_control(
            'title',
            [
                'label' => __( 'Section Title Prefix', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Section Title', 'mayosis-core' ),
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
                    "5" => "Five Column",
                    "6" => "Six Column",
                   
                ),
            ]

        );
        
        
        $this->add_control(
            'product_style',
            [
                'label'     => esc_html_x( 'Style', 'Admin Panel','mayosis-core' ),
                'description' => esc_html_x('Select Product style', 'mayosis-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'    =>  "one",
                'section' => 'section_edd',
                "options"    => array(
                    "one" => "Style One",
                    "two" => "Style Two",
                   
                   
                   
                ),
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
				'selector' => '{{WRAPPER}} .msb-title-section-tld',
			]
		);
		
	
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .msb-title-section-tld' => 'color: {{VALUE}}',
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
			'player_bg_color',
			[
				'label' => __( 'Player Background', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .awp-player-thumb-wrapper, {{WRAPPER}} .awp-player-holder,
					{{WRAPPER}} .mayosis-normal-audio-player-msb .awp-player-wrap' => 'background: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'player_icon_color',
			[
				'label' => __( 'Player Icon Background', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-wave-catgeory-box-msv .awp-contr-btn i' => 'background: {{VALUE}} !important',
				],
			]
		);
		
		$this->add_control(
			'player_icon_font_color',
			[
				'label' => __( 'Player Icon Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-wave-catgeory-box-msv .awp-contr-btn i,
					{{WRAPPER}} .mayosis-normal-audio-player-msb .awp-contr-btn i' => 'color: {{VALUE}} !important',
				],
			]
		);
		
		$this->add_control(
			'pr_title_color',
			[
				'label' => __( 'Product Title Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-meta .product-title a,
					{{WRAPPER}}  .product-audio-meta-titlebar h3 a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'pr_meta_color',
			[
				'label' => __( 'Product Meta Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-meta a,{{WRAPPER}} .product-meta span,
					{{WRAPPER}} .mayosis-normal-audio-player-msb .msb-alt-metas span,
					{{WRAPPER}} .mayosis-normal-audio-player-msb .msb-alt-metas a,
					{{WRAPPER}} .msb-inner-meta-price span' => 'color: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			'thumbnail_inner_btn_link',
			[
				'label' => __( 'Player Inner Button Bg Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-wave-catgeory-box-msv .awp-playlist-thumb-style:before' => 'background: {{VALUE}} !important',
				],
			]
		);
		
		
		$this->add_control(
			'thumbnail_inner_btn_icon',
			[
				'label' => __( 'Player Inner Button Icon Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-wave-catgeory-box-msv .awp-playlist-thumb-style:before' => 'color: {{VALUE}} !important',
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
		
		 $this->add_responsive_control(
                'bar_radius',
                [
                    'label' => __( 'Bar Border Radius', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-wave-catgeory-box-msv .awp-player-thumb-wrapper,
                        {{WRAPPER}} .mayosis-wave-catgeory-box-msv .awp-player-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
            
            $this->add_responsive_control(
                'thumbnail_radius',
                [
                    'label' => __( 'Thumbnail Radius', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-wave-catgeory-box-msv .awp-playlist-thumb img,
                        {{WRAPPER}} .mayosis-wave-catgeory-box-msv .awp-playlist-thumb,
                        {{WRAPPER}} .mayosis-wave-catgeory-box-msv .awp-playlist-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
			
		

$this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.
        global $post;
        $settings = $this->get_settings();
        $recent_section_title = $settings['title'];
       $pstyle= $settings['product_style'];
        
if ($pstyle== "two"){
    $pcatclass="mayosis-normal-audio-player-msb";
} else {
    $pcatclass="mayosis-wave-catgeory-box-msv";
}
       
  
       
        ?>
        
       
       
       <div class="<?php echo $pcatclass;?>">
           <?php mayosis_wave_cat_elementor($settings);?>
       </div>



        <?php
        

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_edd_cateory_audio_Elementor_Thing );
?>