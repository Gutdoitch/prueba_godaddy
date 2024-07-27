<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class before_after_slider extends Widget_Base {

   public function get_name() {
      return 'mayosis-before-after';
   }

   public function get_title() {
      return __( 'Mayosis Before After', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-image-before-after';
   }
      


   protected function register_controls() {

      $this->add_control(
         'before_settings',
         [
            'label' => __( 'Mayosis Before After', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

       $this->add_control(
			'before_image',
			[
				'label' => __( 'Before Image', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'section' => 'before_settings',
			]
		);
       
       
       $this->add_control(
			'after_image',
			[
				'label' => __( 'After Image', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'section' => 'before_settings',
			]
		);
		
		
		$this->add_control(
			'before_title',
			[
				'label' => __( 'Before Image Title', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'before', 'mayosis-core' ),
				'placeholder' => __( 'Type your text here', 'mayosis-core' ),
				'section' => 'before_settings',
			]
		);
		
		$this->add_control(
			'after_title',
			[
				'label' => __( 'After Image Title', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'after', 'mayosis-core' ),
				'placeholder' => __( 'Type your text here', 'mayosis-core' ),
				'section' => 'before_settings',
			]
		);
   }

  
  
   protected function render( $instance = [] ) {


       $settings = $this->get_settings();
       
      ?>

<div id="mayosis-before-after" class="beer-slider" data-beer-label="<?php echo esc_html($settings['before_title']);?>">
                        <?php echo wp_get_attachment_image( $settings['before_image']['id'], 'full' ); ?>
                        <div class="beer-reveal" data-beer-label="<?php echo esc_html($settings['after_title']);?>">
                         <?php echo wp_get_attachment_image( $settings['after_image']['id'], 'full' ); ?>
                        </div>
                      </div>
      
      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new before_after_slider );
?>