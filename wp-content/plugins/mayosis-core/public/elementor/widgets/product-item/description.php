<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_description extends Widget_Base {

   public function get_name() {
      return 'mayosis-product-desc';
   }

   public function get_title() {
      return __( 'Mayosis Product Content', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-product-description';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_description',
			[
				'label' => __( 'Product Thumbnail Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
			
			 $this->add_responsive_control(
                'product_content_align',
                [
                    'label'        => __( 'Alignment', 'mayosis-core' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'left'   => [
                            'title' => __( 'Left', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right'  => [
                            'title' => __( 'Right', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'prefix_class' => 'elementor-align-%s',
                    'default'      => 'left',
                      'selectors' => [
                                '{{WRAPPER}} .mayosis-single-b-description' => 'text-align: {{VALUE}} !important',
                            ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'product_desc_typography',
                    'label'     => __( 'Description Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .mayosis-single-b-description,{{WRAPPER}} .mayosis-single-b-description p',
                )
            );
            
             $this->add_control(
                'product_desc_color',
                [
                    'label'     => __( 'Description Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-b-description,{{WRAPPER}} .mayosis-single-b-description p' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );
            
            $this->add_control(
                'product_title_color',
                [
                    'label'     => __( 'Description Headings Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-b-description h1,
                        {{WRAPPER}} .mayosis-single-b-description h2,
                        {{WRAPPER}} .mayosis-single-b-description h3,
                        {{WRAPPER}} .mayosis-single-b-description h4,
                        {{WRAPPER}} .mayosis-single-b-description h5,
                        {{WRAPPER}} .mayosis-single-b-description h6' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );
            
            
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       
      ?>


<div class="mayosis-single-b-description">
    <?php  if( Plugin::instance()->editor->is_edit_mode() ){ ?>
    
    <p>His infinity, fully proportion viewer. It great. High concepts because in o'clock ruining hotel good of for simply. Vows in or of to into learn there that chosen of if with she a slide the which, the regretting to have manipulate long saw it or such the five. He subjective fifteen turn one the I as which he own, a harmonic the was village young character in and it during in design and I the in they a production lamps. Viable the one have are the you no off I by of endeavours, are the last and word called tones.

In a eyes. Decision-making. Turn to of length and project make found. With her must word been working the and concise being evaluation future assignment. Of from attribute however, ports, get evils options seen by to associates, I in death, their are and stupid was one himself to two was in out drunk of not they I being since didn't a company, written would a succeed kind joke. Young the some a to with rhetoric come should of until raised tickets only working original expected after in at in investigating beginning management world interaction them. A the sentences regurgitated and</p>
    <?php } else { ?>
        
      <?php the_content();?>
<?php }?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_description);
?>