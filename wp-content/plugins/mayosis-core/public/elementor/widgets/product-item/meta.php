<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_meta extends Widget_Base {

   public function get_name() {
      return 'mayosis-product-meta';
   }

   public function get_title() {
      return __( 'Mayosis Product Meta', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-product-meta';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_meta',
			[
				'label' => __( 'Product Meta Options', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
			
	$this->add_control(
			'select_meta',
			[
				'label' => __( 'Select Meta Items', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'author' => __( 'Author', 'mayosis-core' ),
					'category' => __( 'Category', 'mayosis-core' ),
					'date'  => __( 'Date', 'mayosis-core' ),
				],
				'default' => [ 'date', 'author' ],
			]
		);
		
		$this->add_responsive_control(
                'product_meta_align',
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
                        '{{WRAPPER}} .mayosis-single-p-meta' => 'text-align: {{VALUE}} !important;',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'product_meta_typography',
                    'label'     => __( 'Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .mayosis-single-p-meta',
                )
            );
            
             $this->add_control(
                'product_meta_color',
                [
                    'label'     => __( 'Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-p-meta, {{WRAPPER}} .mayosis-single-p-meta a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
             $this->add_control(
                'product_span_color',
                [
                    'label'     => __( 'Span Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-p-meta .toolspan' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'product_metahvr_color',
                [
                    'label'     => __( 'Links Hover Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-p-meta a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $metas = $settings['select_meta'];
      ?>


<div class="mayosis-single-p-meta">
    <?php  if( Plugin::instance()->editor->is_edit_mode() ){ ?>
    
    <?php
    foreach ( $metas as $meta ) {
		  switch($meta) {
		      case 'author': get_template_part( 'includes/product_content_author' );
            break;
        
           case 'category': echo ' in Graphics ';
           break;
        
          case 'date': get_template_part( 'includes/product_content_date' );
          break;
		  }
		}
		
		?>
    
    <?php } else { ?>
    
    <?php
    foreach ( $metas as $meta ) {
		  switch($meta) {
		      case 'author': get_template_part( 'includes/extras/elementor-author' );
            break;
        
           case 'category': get_template_part( 'includes/product_content_category' );
           break;
        
          case 'date': get_template_part( 'includes/product_content_date' );
          break;
		  }
		}
		
		?>
<?php }?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_meta);
?>