<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_eddarchive_title extends Widget_Base {

   public function get_name() {
      return 'mayosis-archive-title-edd';
   }

   public function get_title() {
      return __( 'Mayosis Product Archive Title', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-archive' ];
	}
   public function get_icon() { 
        return 'eicon-editor-h1';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_eddarchive_title',
			[
				'label' => __( 'Archive Title Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		 $this->add_control(
                'product_title_html_tag',
                [
                    'label'   => __( 'Title HTML Tag', 'mayosis-core' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => mayosis_html_tag_lists(),
                    'default' => 'h1',
                ]
            );
            
              $this->add_responsive_control(
                'product_title_align',
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
                ]
            );
            
              $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'product_title_typography',
                    'label'     => __( 'Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .product_title',
                )
            );
            
            
            $this->add_control(
                'product_title_color',
                [
                    'label'     => __( 'Title Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product_title' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );
            
             $this->add_responsive_control(
                'product_title_margin',
                [
                    'label' => __( 'Margin', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .product_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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


<div class="mayosis-single-p-title">
 <?php
 if( Plugin::instance()->editor->is_edit_mode() ){
            $title = get_the_title( mayosis_get_last_product_id() );
            echo sprintf( "<%s class='product_title entry-title'>%s</%s>", $settings['product_title_html_tag'], $title, $settings['product_title_html_tag'] );
        }else{
            global $wp_query;
            if ( is_tax( 'download_category' ) || is_tax( 'download_tag' ) ) {
	$download_term = $wp_query->get_queried_object();

	// change the download archive page title based on the taxonomy
	if ( 'download_category' === $download_term->taxonomy ) {
		$term_type = _x( 'Category', 'download category archive page title', 'mayosis-core' ) . ': ';
	} elseif ( 'download_tag' === $download_term->taxonomy ) {
		$term_type = _x( 'Tag', 'download tag archive page title', 'mayosis-core' ) . ': ';
	}
            }
            echo sprintf( "<%s class='product_title entry-title'>%s</%s>", $settings['product_title_html_tag'], $download_term->name, $settings['product_title_html_tag']  );
        }
 ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_eddarchive_title);
?>