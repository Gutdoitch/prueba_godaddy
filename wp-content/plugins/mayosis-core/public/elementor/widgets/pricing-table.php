<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_pricing_table extends Widget_Base {

   public function get_name() {
      return 'mayosis-pricing-table';
   }

   public function get_title() {
      return __( 'Mayosis Pricing Table', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-price-list';
   }

   protected function register_controls() {

      $this->start_controls_section(
         'section_pricing',
         [
            'label' => __( 'Pricing Content', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
       $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'Title',
            'title' => __( 'Enter Table Title', 'mayosis-core' ),
           
         ]
      );
      
       $this->add_control(
         'currency',
         [
            'label' => __( 'Currency', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '$',
            'title' => __( 'Enter Table Price Currency', 'mayosis-core' ),
           
         ]
      );
       
       $this->add_control(
         'price',
         [
            'label' => __( 'Price', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '25',
            'title' => __( 'Enter Table Price Value', 'mayosis-core' ),
           
         ]
      );
      
      $this->add_control(
         'time',
         [
            'label' => __( 'Timeframe', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '/mo',
            'title' => __( 'Enter Table Price Timeframe', 'mayosis-core' ),
           
         ]
      );
       
       $this->add_control(
         'icon',
         [
            'label' => __( 'Icon', 'mayosis-core' ),
            'type' => Controls_Manager::ICONS,
           'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
            'title' => __( 'Enter Table Title Icon', 'mayosis-core' ),
           
         ]
      );
      
      $repeater = new \Elementor\Repeater();
       
       
       $repeater->add_control(
			'list_title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'plugin-domain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_icon', [
				'label' => __( 'Icon', 'mayosis-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fa-check-circle',
                'options' => [
                    'fa-check-circle'  => __( 'Correct', 'mayosis-core' ),
                    'fa-times-circle' => __( 'Wrong', 'mayosis-core' ),
                 ],
			]
		);


$this->add_control(
			'list',
			[
				'label' => __( 'Repeater List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Title #1', 'plugin-domain' ),
						'list_icon' => __( 'fa-check-circle', 'plugin-domain' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

       $this->add_control(
         'button_text',
         [
            'label' => __( 'Button Text', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'title' => __( 'Enter Button Text', 'mayosis-core' ),
           
         ]
      );
       
       $this->add_control(
         'button_url',
         [
            'label' => __( 'Button Url', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'https://teconce.com',
            'title' => __( 'Enter Button Url', 'mayosis-core' ),
           
         ]
      );
      $this->end_controls_section();
       
       $this->start_controls_section(
         'section_style',
         [
            'label' => __( 'Style', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
       
       $this->add_control(
         'icon-color',
         [
            'label' => __( 'Icon Color', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#666666',
            'title' => __( 'Select Icon Color', 'mayosis-core' ),
            
            'selector' => [
					'{{WRAPPER}} .dm_pricing_table .pricing-title-main i' => 'color: {{VALUE}}',
				],
         ]
      );
       
        $this->add_control(
         'title_color_mayosis',
         [
            'label' => __( 'Title Color', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Title Color', 'mayosis-core' ),
            
            'selectors' => [
					'{{WRAPPER}} .pricing-title-main' => 'color: {{VALUE}}',
				],
            
         ]
      );
       
       $this->add_control(
         'title-bg',
         [
            'label' => __( 'Title Background Color', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#c6c9cc',
            'title' => __( 'Select Title Color', 'mayosis-core' ),
            
         ]
      );
       $this->add_control(
         'amount-color',
         [
            'label' => __( 'Pricing Amount Color', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#1d314f',
            'title' => __( 'Select Pricing Amount Color', 'mayosis-core' ),
            
            'selectors' => [
					'{{WRAPPER}} .table_pricing_amount' => 'color: {{VALUE}}',
				],
         ]
      );
       
       $this->add_control(
         'button-color',
         [
            'label' => __( 'Button Background Color', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button Background Color', 'mayosis-core' ),
            
         ]
      );
      $this->add_control(
         'button-border-color',
         [
            'label' => __( 'Button Border Color', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button Border Color', 'mayosis-core' ),
            
         ]
      );
      $this->add_control(
         'button-text-color',
         [
            'label' => __( 'Button Text Color', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button Text Color', 'mayosis-core' ),
            
         ]
      );
      
      $this->add_control(
         'content-color',
         [
            'label' => __( 'Pricing Content Color', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#1d314f',
            'title' => __( 'Select Pricing Content Color', 'mayosis-core' ),
            
            'selectors' => [
					'{{WRAPPER}} .pricing_content ul' => 'color: {{VALUE}}',
				],
         ]
      );
       $this->add_control(
         'align_title',
         [
            'label' => __( 'Alignment of Title', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'left',
            'title' => __( 'Select Alignment of Title', 'mayosis-core' ),
            
             'options' => [
                    'left'  => __( 'Left', 'mayosis-core' ),
                    'center' => __( 'Center', 'mayosis-core' ),
                    'right' => __( 'Right', 'mayosis-core' ),
                 ],
         ]
      );
      
       $this->add_control(
         'button-hover-color',
         [
            'label' => __( 'Button Background Hover Color', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button Background Hover Color', 'mayosis-core' ),
            
            'selectors' => [
					'{{WRAPPER}} .btn_blue_pricing:hover' => 'background-color: {{VALUE}} !important',],
         ]
      );
      
       $this->add_control(
         'button-border-hover-color',
         [
            'label' => __( 'Button Border Hover Color', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button Border Hover Color', 'mayosis-core' ),
            
            'selectors' => [
					'{{WRAPPER}} .btn_blue_pricing:hover' => 'border-color: {{VALUE}} !important',],
         ]
      );
      
      $this->add_control(
         'button-text-hover-color',
         [
            'label' => __( 'Button Text Hover Color', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Button Text Hover Color', 'mayosis-core' ),
            
            'selectors' => [
					'{{WRAPPER}} .btn_blue_pricing:hover' => 'color: {{VALUE}} !important',],
         ]
      );
       $this->add_control(
         'align_content',
         [
            'label' => __( 'Alignment of Content', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'left',
            'title' => __( 'Select Alignment of Content', 'mayosis-core' ),
            
             'options' => [
                    'left'  => __( 'Left', 'mayosis-core' ),
                    'center' => __( 'Center', 'mayosis-core' ),
                    'right' => __( 'Right', 'mayosis-core' ),
                 ],
         ]
      );
      
      $this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Title Padding', 'mayosis-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				
				'selectors' => [
					'{{WRAPPER}} .pricing_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		 $this->add_responsive_control(
	'pricing_padding',
			[
				'label' => __( 'Pricing Padding', 'mayosis-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				
				'selectors' => [
					'{{WRAPPER}} .pricing_table_title_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
       
       $this->add_responsive_control(
			'button_margin',
			[
				'label' => __( 'Button Margin', 'mayosis-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				
				'selectors' => [
					'{{WRAPPER}} .btn_blue_pricing ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		 $this->end_controls_section();
		 
       $this->start_controls_section(
         'section_label',
         [
            'label' => __( 'Label', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
             );
       
            $this->add_control(
         'show_label',
         [
            'label' => __( 'Label', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'show',
            
             'options' => [
                    'show'  => __( 'Show', 'mayosis-core' ),
                    'hide' => __( 'Hide', 'mayosis-core' ),
                 ],
         ]
      );
            
    $this->add_control(
         'label_text',
         [
            'label' => __( 'Label Text', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'Featured',
            'title' => __( 'Enter Label Text', 'mayosis-core' ),
            
         ]
      );
        
    $this->add_control(
         'label_bg',
         [
            'label' => __( 'Label Background', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#94a63a',
            
         ]
      );
       
       
            $this->add_control(
         'show_save',
         [
            'label' => __( 'Save', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'hide',
            
             'options' => [
                    'show'  => __( 'Show', 'mayosis-core' ),
                    'hide' => __( 'Hide', 'mayosis-core' ),
                 ],
         ]
      );
       $this->add_control(
         'save_label_text',
         [
            'label' => __( 'Save Label Text', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'Save',
            'title' => __( 'Enter Save Label Text', 'mayosis-core' ),
            
         ]
      );
       $this->add_control(
         'save_p_amount',
         [
            'label' => __( 'Save Amount', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '45%',
            'title' => __( 'Enter Save Amount', 'mayosis-core' ),
            
         ]
      );
       
       $this->add_control(
         'save_label_bg',
         [
            'label' => __( 'Save Label Background', 'mayosis-core' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '45%',
            'title' => __( 'Enter Save Label Background', 'mayosis-core' ),
            
         ]
      );
       $this->end_controls_section();
        
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $list = $this->get_settings( 'list' );
      ?>

 <!-- Element Code start -->
       
   <div class="dm_pricing_table">
        	<div class="pricing_title" style="background:<?php echo $settings['title-bg']; ?>">
				<h2 class="pricing-title-main" style="text-align:<?php echo $settings['align_title']; ?>;"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?> <?php echo $settings['title']; ?></h2>
			</div>
			  <?php if($settings['show_label'] == "show"){ ?>
			<div class="lable_price_data">
				<span class="label_pricing" style="background:<?php echo $settings['label_bg']; ?>;"><?php echo $settings['label_text']; ?></span>
			</div>
			<?php } else { ?>
			 <?php } ?>
			<div class="pricing_content">
			    <div class="pricing_table_title_box">
				<h3 class="price_tag_table table_pricing_amount"> <sub class="pricing_currency"><?php echo $settings['currency']; ?></sub> <?php echo $settings['price']; ?><span class="pricing_timeframe"><?php echo $settings['time']; ?></span></h3>
				</div>
			  <?php if($settings['show_save'] == "show"){ ?>
				<span class="save_tooltip"  style="background:<?php echo $settings['save_label_bg']; ?>;"><?php echo $settings['save_label_text']; ?> <br>
				<?php echo $settings['save_p_amount']; ?></span>
				<?php } else { ?>
			 <?php } ?>
				
				<div class="main_price_content" style="text-align:<?php echo $settings['align_content']; ?>;">
				<?php if ( $list ) {
                    echo '<ul>';
                    foreach ( $list as $item ) {
                        echo '<li>'.'<i class="fa '.$item['list_icon'].'" aria-hidden="true">'.'</i>' . $item['list_title'] . '</li>';
                    }
                    echo '</ul>';
                          
                }?>
				</div>
				<a href="<?php echo $settings['button_url']; ?>" class="btn_blue_pricing btn"  style="background:<?php echo $settings['button-color']; ?>;border-color:<?php echo $settings['button-border-color']; ?>;color:<?php echo $settings['button-text-color']; ?>;"><?php echo $settings['button_text']; ?></a>
			</div>
		</div>

      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_pricing_table );
?>