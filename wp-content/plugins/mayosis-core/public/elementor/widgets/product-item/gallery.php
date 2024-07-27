<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_gallery extends Widget_Base {

   public function get_name() {
      return 'mayosis-product-gallery';
   }

   public function get_title() {
      return __( 'Mayosis Product Gallery', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-gallery-group';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_gallery',
			[
				'label' => __( 'Product Gallery Style', 'mayosis-core' ),
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
                        '{{WRAPPER}} #mayosisone_1,{{WRAPPER}} .lSSlideWrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                        '{{WRAPPER}} #mayosisone_1,{{WRAPPER}} .lSSlideWrapper,
                        {{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
            
            $this->add_control(
			'gallerybg',
			[
				'label' => __( 'Background color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #mayosisone_1' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'gallery_style',
			[
				'label' => __( 'Gallery Style', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => [
					'standard'  => __( 'Standard', 'mayosis-core' ),
					'masonry' => __( 'Masonry', 'mayosis-core' ),
					
				],
			]
		);

     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $gallery_style = $settings['gallery_style'];
      ?>


<div class="mayosis-single-p-gallery">
    <?php  if( Plugin::instance()->editor->is_edit_mode() ){ ?>
     <?php echo get_the_post_thumbnail( mayosis_get_last_product_id(), 'mayosis-single-page-thumbnail' ); ?>

    <?php } else { ?>

        <?php if($gallery_style =="standard"){ ?>
         <?php get_template_part( 'includes/product-gallery-elementor' ); ?>
         <?php } else { 
             global $post;
         $ids = get_post_meta($post->ID, 'vdw_gallery_id', true);
         $thumburl= wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
         ?>
         <div class="masonry-wrapper">
              <div class="product-masonry product-masonry-gutter product-masonry-masonry product-masonry-full product-masonry-2-column ">
                  <div class="product-masonry-item">
                        <img src="<?php echo esc_url($thumburl); ?>" alt="gallery-image" data-lity />
                  </div>
                  <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value,$size = 'full'); ?>
                  <div class="product-masonry-item">
                        <img src="<?php echo esc_url($image[0]); ?>" alt="gallery-image" data-lity />
                  </div>
                   <?php endforeach; endif; ?>
                  
              </div>
             </div>
         <?php } ?>

<?php } ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_gallery);
?>