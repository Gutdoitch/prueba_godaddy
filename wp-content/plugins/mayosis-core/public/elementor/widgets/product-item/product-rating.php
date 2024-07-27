<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_rating extends Widget_Base {

   public function get_name() {
      return 'mayosis-product-rating';
   }

   public function get_title() {
      return __( 'Mayosis Product Rating', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-product-rating';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_rating',
			[
				'label' => __( 'Product Title Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
            
              $this->add_responsive_control(
                'product_star_align',
                [
                    'label'        => __( 'Alignment', 'mayosis-core' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'left'   => [
                            'title' => __( 'Left', 'mayosis-core' ),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mayosis-core' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'right'  => [
                            'title' => __( 'Right', 'mayosis-core' ),
                            'icon'  => 'eicon-text-align-right',
                        ],
                    ],
                    'default'      => 'left',
                ]
            );
            
            
            $this->add_control(
                'product_star_color',
                [
                    'label'     => __( 'Star Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .msv-single-rating-p .edd_reviews_rating_box .edd_star_rating span' => 'color: {{VALUE}}',
                    ],
                ]
            );
            
            $this->add_control(
                'product_count_color',
                [
                    'label'     => __( 'Count Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .msv-single-rating-p .edd_star_rating p' => 'color: {{VALUE}}',
                    ],
                ]
            );
            
			
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $ratingaligb = $settings['product_star_align'];
       
      ?>


<div class="msv-single-rating-p" style="text-align:<?php echo esc_html($ratingaligb);?>">
 <?php
 if( Plugin::instance()->editor->is_edit_mode() ){
            echo mayosis_avarage_rating(mayosis_get_last_product_id());
        }else{
            echo mayosis_avarage_rating();
        }
 ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_rating);
?>