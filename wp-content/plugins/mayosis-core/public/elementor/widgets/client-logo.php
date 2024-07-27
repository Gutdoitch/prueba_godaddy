<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class client_logo_Elementor_Thing extends Widget_Base {

   public function get_name() {
      return 'mayosis-client-logo';
   }

   public function get_title() {
      return __( 'Mayosis Logo Grid', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-logo';
   }

   protected function register_controls() {

      $this->start_controls_section(
         'section_client_logo',
         [
            'label' => __( 'Mayosis Logo Grid', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

    $this->add_control(
  'gallery',
  [
     'label' => __( 'Add Images', 'mayosis-core' ),
     'type' => Controls_Manager::GALLERY,
  ]
);

$this->add_control(
			'desktop_col_count',
			[
				'label' => __( 'Column Count(Desktop)', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '5',
				'options' => [
					'1'  => __( 'One', 'mayosis-core' ),
					'2' => __( 'Two', 'mayosis-core' ),
					'3' => __( 'Three', 'mayosis-core' ),
					'4' => __( 'Four', 'mayosis-core' ),
					'5' => __( 'Five', 'mayosis-core' ),
					'6' => __( 'Six', 'mayosis-core' ),
				],
			]
		);
		
		$this->add_control(
			'mobile_col_count',
			[
				'label' => __( 'Column Count(Mobile)', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1'  => __( 'One', 'mayosis-core' ),
					'2' => __( 'Two', 'mayosis-core' ),
					'3' => __( 'Three', 'mayosis-core' ),
					'4' => __( 'Four', 'mayosis-core' ),
					'5' => __( 'Five', 'mayosis-core' ),
					'6' => __( 'Six', 'mayosis-core' ),
				],
			]
		);
		
		$this->add_responsive_control(
			'spacing',
			[
				'label' => __( 'Spacing', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .slides li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'logo_col_height',
			[
				'label' => esc_html__( 'Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
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
					'{{WRAPPER}} .dm_clients ul li' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
$this->end_controls_section();
       
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $images = $this->get_settings( 'gallery' );
       $dcol = $settings['desktop_col_count'];
       $mcol = $settings['mobile_col_count'];
       
      ?>


<div class="dm_clients" style="width:100%;">
    <ul class="slides has_fade_anim row row-cols-<?php echo esc_html($mcol);?> row-cols-md-<?php echo esc_html($dcol);?>">
<?php foreach ( $images as $image ) {
    echo '<li class="col"><img src="' . $image['url'] . '"></li>';
}
 ?>
</ul>
</div>
      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new client_logo_Elementor_Thing );
?>