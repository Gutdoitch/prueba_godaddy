<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_audio extends Widget_Base {

   public function get_name() {
      return 'mayosis-product-audio';
   }

   public function get_title() {
      return __( 'Mayosis Product Audio', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-play';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_audio',
			[
				'label' => __( 'Product Audio Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
            
             $this->add_responsive_control(
                'product_thumb_margin',
                [
                    'label' => __( 'Margin', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .plyr--audio' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
            
            $this->add_responsive_control(
                'product_thumb_border-radius',
                [
                    'label' => __( 'Border Radius', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .plyr--audio' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
            
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
      ?>


<div class="mayosis-single-p-audio">
    <?php  if( Plugin::instance()->editor->is_edit_mode() ){ ?>
    
   <?php if ( has_post_format( 'audio' )) { ?>

 <div class="mayosis-main-media">
<?php get_template_part( 'library/mayosis_audio' ); ?>
</div>
<?php } ?> 


    <?php } else { ?>


<?php if ( has_post_format( 'audio' )) { ?>

 <div class="mayosis-main-media">
<?php get_template_part( 'library/mayosis_audio' ); ?>
</div>
<?php } ?>

<?php } ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_audio);
?>