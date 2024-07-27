<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Counter_Elementor_Thing extends Widget_Base {

   public function get_name() {
      return 'mayosis-counter';
   }

   public function get_title() {
      return __( 'Mayosis Stats Counter', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-counter-circle';
   }

   protected function register_controls() {

      $this->add_control(
         'counter_settings',
         [
            'label' => __( 'Counter Settings', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

       $this->add_control(
         'title',
         [
            'label' => __( 'Counter Title', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'Title',
            'section' => 'counter_settings',
         ]
      );
       
       $this->add_control(
         'counter_type',
         [
            'label' => __( 'Counter Type', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'user',
            'title' => __( 'Select Counter Type', 'mayosis-core' ),
            'section' => 'counter_settings',
             'options' => [
                    'user'  => __( 'Total User', 'mayosis-core' ),
                    'product' => __( 'Total Products', 'mayosis-core' ),
                    'download' => __( 'Total Download', 'mayosis-core' ),
                    'envato_sales' => __( 'Envato Total Sales', 'mayosis-core' ),
                    'envato_site_sales' => __( 'Envato and Site Total Sales', 'mayosis-core' ),
                    'site_sales' => __( 'Site Total Sales', 'mayosis-core' ),
                    'custom' => __( 'Custom', 'mayosis-core' ),
                 ],
         ]
      );
       
       $this->add_control(
         'count',
         [
            'label' => __( 'Custom Count', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '4515',
            'section' => 'counter_settings',
         ]
      );
       
       $this->add_control(
         'count_suffix',
         [
            'label' => __( 'Counter Suffix', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'section' => 'counter_settings',
         ]
      );
       	$this->start_controls_section(
			'counter_style',
			[
				'label' => __( 'Counter Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'align_text',
			[
				'label' => __( 'Alignment', 'mayosis-core' ),
				'type' => Controls_Manager::CHOOSE,
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
				],
				'selectors' => [
					'{{WRAPPER}} .counter-box' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'counter_typo',
				'label' => __( 'Counter Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .statistic-counter,{{WRAPPER}}  .counter-suffix',
			]
		);
		
       $this->add_control(
         'count_color',
         [
            'label' => __( 'Color of Count', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Count Color', 'mayosis-core' ),
            'selectors' => [
					'{{WRAPPER}} .statistic-counter' => 'color: {{VALUE}};',
				],
         ]
      );
      
       $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'label' => __( 'Title Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .mcounter_title_promo',
			]
		);
       $this->add_control(
         'title_color',
         [
            'label' => __( 'Color of Title', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Title Color', 'mayosis-core' ),
            'selectors' => [
					'{{WRAPPER}} .mcounter_title_promo' => 'color: {{VALUE}};',
				],
         ]
      );
       
       
       $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.
       $envato_username = get_theme_mod( 'envato_username_link','');
       $settings = $this->get_settings();
        if  ($envato_username){
       $envato_total_sales_count = envato_total_sales();
        } else {
            $envato_total_sales_count = null;
        }
      ?>


        <!-- Element Code start -->
        <div class="counter-box">
               	<?php if($settings['counter_type'] == "user"){ ?>
               	
                	<h4 class="statistic-counter">
                	<?php
                        $result = count_users();
                        echo  $result['total_users'];
                        
                        ?></h4>
                 <p class="mcounter_title_promo"><?php echo $settings['title']; ?></p>
                  <?php } elseif($settings['counter_type'] == "product"){ ?>
                   <?php
			$count_products = wp_count_posts('download');
	        $total_products = $count_products->publish;
            ?>
			<h4 class="statistic-counter"><?php
			echo $total_products; ?></h4>
                 <p class="mcounter_title_promo"><?php echo $settings['title']; ?></p>

                <?php } elseif($settings['counter_type'] == "envato_sales"){ ?>
                    <h4 class="statistic-counter"><?php
                        echo $envato_total_sales_count; ?></h4>
                    <p class="mcounter_title_promo"><?php echo $settings['title']; ?></p>

                <?php } elseif($settings['counter_type'] == "envato_site_sales"){ ?>
                    <h4 class="statistic-counter"><?php
                        echo $envato_total_sales_count + edd_get_total_sales(); ?></h4>
                    <p class="mcounter_title_promo"><?php echo $settings['title']; ?></p>

                <?php } elseif($settings['counter_type'] == "site_sales"){ ?>
                    <h4 class="statistic-counter"><?php
                        echo edd_get_total_sales(); ?></h4>
                    <p class="mcounter_title_promo"><?php echo $settings['title']; ?></p>

                    <?php } elseif($settings['counter_type'] == "download"){ ?>
                     <h4 class="statistic-counter"><?php
			echo edd_count_total_file_downloads(); ?></h4>
                   <p class="mcounter_title_promo"><?php echo $settings['title']; ?></p>
                    <?php
			}
		  else
			{ ?>
			<h4 class="statistic-counter"><?php echo $settings['count']; ?></h4> <span class="counter-suffix"><?php echo $settings['count_suffix']; ?></span>
				   <p class="mcounter_title_promo"><?php echo $settings['title']; ?></p> 
					   <?php
			} ?>
                    
                </div>
      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new Counter_Elementor_Thing );
?>