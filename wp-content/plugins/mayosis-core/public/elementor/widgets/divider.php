<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_section_divider extends Widget_Base {

   public function get_name() {
      return 'mayosis-section-divider';
   }

   public function get_title() {
      return __( 'Mayosis Section Divider', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-divider-shape';
   }

   protected function register_controls() {

      $this->start_controls_section(
         'section_divider',
         [
            'label' => __( 'Divider Options', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      
      
       
        
        $this->end_controls_section();
     
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $images = $this->get_settings( 'image' );
      ?>
  
    <div class="mayosis-section-divider">
    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="300px" viewBox="0 0 1200 366" preserveAspectRatio="none">
        
        <g class="mayosis-waiting animated" data-anim-type="fade-in-up" data-anim-delay="300">
            
            
            <polygon fill="url(#mayosis-devider-bottom-layer-3)" points="0 240 1200 0 1200 366 0 366"></polygon></g>
        
        
        <polygon fill="url(#mayosis-devider-bottom-layer-2)" points="0 300 1200 60 1200 366 0 366"></polygon>
        
        
        <polygon fill="#ccc" points="0 360 1200 120 1200 366 0 366"></polygon>
        
        
        
        
         <!-- Fill Gradient --><defs><linearGradient id="mayosis-devider-bottom-layer-3" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#00000014"></stop><stop offset="100%" stop-color="#FFFFFF03"></stop></linearGradient><linearGradient id="mayosis-devider-bottom-layer-3" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#FFFFFF03"></stop><stop offset="100%" stop-color="#FFFFFF03"></stop></linearGradient></defs><!-- /Fill Gradient -->
    
    </svg>
		
	</div>

      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_section_divider );
?>