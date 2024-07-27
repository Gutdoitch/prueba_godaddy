<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_exif_information extends Widget_Base {

   public function get_name() {
      return 'mayosis-exif-information';
   }

   public function get_title() {
      return __( 'Mayosis Exif Data', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-product-info';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_exif_information',
			[
				'label' => __( 'Exif Data Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
        $this->add_control(
			'exif_stl',
			[
				'label' => __( 'Exif Style', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one'  => __( 'One', 'mayosis-core' ),
					'two' => __( 'Two', 'mayosis-core' ),
				
				],
			]
		);
            
             $this->add_responsive_control(
                'product_exif_align',
                [
                    'label'        => __( 'Alignment', 'mayosis-core' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'flex-start'   => [
                            'title' => __( 'Left', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'flex-end'  => [
                            'title' => __( 'Right', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'prefix_class' => 'elementor-align-%s',
                    'default'      => 'left',
                    
                ]
            );
            
            
              $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'exif_label_typo',
                    'label'     => __( 'Label Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .mayo-exif-tag',
                )
            );
            
             $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'exif_value_typo',
                    'label'     => __( 'Value Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .mayo-exif-value',
                )
            );
            
            
    
            
			 $this->add_responsive_control(
                'tag_padding',
                [
                    'label' => __( 'Padding', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} ul.mayosis-exif-lists li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
            
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $exif_stl = $settings['exif_stl'];
       
      ?>


<div class="mayosis-single-builder-exif-bd mayo-ele-exif-style-<?php echo $exif_stl; ?>">
 <?php
 if( Plugin::instance()->editor->is_edit_mode() ){
            $title = get_the_title( mayosis_get_last_product_id() );
            $postID= mayosis_get_last_product_id();?>
            
           <?php echo mayosis_image_exif_data($postID);?>  
           
        <?php }else{ ?>
          <?php echo mayosis_image_exif_data();?>  
       <?php }
 ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_exif_information);
?>