<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_thumbnail extends Widget_Base {

   public function get_name() {
      return 'mayosis-product-thumbnail';
   }

   public function get_title() {
      return __( 'Mayosis Product Thumbnail', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-image-rollover';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_thumbnail',
			[
				'label' => __( 'Product Thumbnail Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
			
			 $this->add_responsive_control(
                'product_img_align',
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
                    'prefix_class' => 'elementor-align-%s',
                    'default'      => 'left',
                      'selectors' => [
                                '{{WRAPPER}} .mayosis-single-p-thumbnail' => 'text-align: {{VALUE}} !important',
                            ],
                ]
            );
            
          $this->add_control(
			'thums_size',
			[
				'label' => __( 'Thumbnail Size', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'mayosis-single-page-thumbnail',
				'options' => mayosis_image_size_ebl(),
			]
		);
	
            
             $this->add_responsive_control(
                'product_thumb_margin',
                [
                    'label' => __( 'Margin', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-p-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                        '{{WRAPPER}} .mayosis-single-p-thumbnail,{{WRAPPER}} .mayosis-single-p-thumbnail img,
                        {{WRAPPER}} .plyr--video,{{WRAPPER}} .msv-single-thumb-overlay-bds' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    
                ]
            );
            $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Image Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .mayosis-single-p-thumbnail,{{WRAPPER}} .mayosis-single-p-thumbnail img',
				
				'separator' => 'before',
			]
		);
           $this->add_control(
			'media',
			[
				'label' => __( 'Featured Image with Video & Audio', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Enable', 'mayosis-core' ),
				'label_off' => __( 'Disable', 'mayosis-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
	$this->add_control(
			'overlay',
			[
				'label' => __( 'Overlay', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'separator' => 'before',
				'options' => [
					'demo'  => __( 'Demo Preview Button', 'plugin-domain' ),
					'pdf' => __( 'Pdf Preview Button', 'plugin-domain' ),
					'none' => __( 'None', 'plugin-domain' ),
					
				],
			]
		);
		
		$this->add_control(
			'overlay_color',
			[
				'label' => __( 'Overlay BG Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .msv-single-thumb-overlay-bds' => 'background: {{VALUE}}',
				],
				
				'condition' => [
                    'overlay' => [ 'demo', 'pdf' ]
                ]
			]
		);
		
		$this->add_control(
			'pdf_btn_text',
			[
				'label' => __( 'Pdf Button Text', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Pdf Preview Text', 'plugin-domain' ),
				'placeholder' => __( 'Pdf Preview', 'plugin-domain' ),
				'condition' => [
                    'overlay' => [ 'pdf' ]
                ]
			]
		);
		
			$this->start_controls_tabs( 'tabs_button_style' );
		
		    $this->start_controls_tab(
			'cart_button',
			[
				'label' => __( 'Button', 'mayosis-core' ),
			]
		);
		      $this->add_control(
			'lm_button_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#1e3c78',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-p-thumbnail .ghost_button' => 'background: {{VALUE}}',
					
						
				],
			]
		);
		
		
		  $this->add_control(
			'lm_border_color',
			[
				'label' => __( 'Border Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#1e3c78',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-p-thumbnail .ghost_button' => 'border-color: {{VALUE}}',
					
						
				],
			]
		);
		$this->add_control(
			'lm_txtr_color',
			[
				'label' => __( 'Text Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-p-thumbnail .ghost_button' => 'color: {{VALUE}}',
					
						
				],
			]
		);
			$this->end_controls_tab();
		
		
		
		  $this->start_controls_tab(
			'cart_button_hover',
			[
				'label' => __( 'Button Hover', 'mayosis-core' ),
			]
		);
		
		 $this->add_control(
			'lm_button_hvr_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#0A0FA1',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-p-thumbnail .ghost_button:hover' => 'background: {{VALUE}} !important',
					
						
				],
			]
		);
		
		$this->add_control(
			'lm_button_border_color',
			[
				'label' => __( 'Border Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#0A0FA1',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-p-thumbnail .ghost_button:hover' => 'border-color: {{VALUE}} !important',
					
						
				],
			]
		);
		$this->add_control(
			'lm_button_txt_color',
			[
				'label' => __( 'Text Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .mayosis-single-p-thumbnail .ghost_button:hover' => 'color: {{VALUE}} !important',
					
						
				],
			]
		);
		
			$this->end_controls_tab();
				$this->end_controls_tabs();
            
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       global $post;
       $media = $settings['media'];
       $size = $settings['thums_size'];
       $overlay = $settings['overlay'];
       $prpreview = $settings['pdf_btn_text'];
        $demo_link =  get_post_meta($post->ID, 'demo_link', true);
        $livepreviewtext= get_theme_mod( 'live_preview_text','Live Preview' );
        $pdf_preview_url =  get_post_meta($post->ID, 'pdf_preview_url', true);
        
       
      ?>


<div class="mayosis-single-p-thumbnail">
    <?php  if( Plugin::instance()->editor->is_edit_mode() ){ ?>
    
    <?php echo get_the_post_thumbnail( mayosis_get_last_product_id(), $size ); ?>
    <?php } else { ?>
    
    <?php if ( 'yes' === $media ) { ?>
        <?php if ( has_post_format( 'video' )) { ?>
            <div class="mayosis-main-media">
            <?php get_template_part( 'library/mayosis-video-box' ); ?>
            </div>
            <?php } elseif ( has_post_format( 'audio' )) { ?>

             <div class="mayosis-main-media">
            <?php get_template_part( 'library/mayosis_audio' ); ?>
            </div>
            
             <?php } elseif ( has_post_format( 'gallery' )) { ?>
             
              <div class="mayosis-main-media">
            <?php get_template_part( 'includes/product-gallery-elementor' ); ?>
            </div>
            <?php  } else { ?>
      <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail($size);
    } ?>
<?php }?>

<?php } else { ?>
 <?php if ( has_post_thumbnail() ) {
        the_post_thumbnail($size);
    } ?>
<?php } ?>

<?php } ?>

<?php if($overlay=="demo"){?>

<div class="msv-single-thumb-overlay-bds">
    <?php if ( $demo_link  ) { ?>
    	<a href="<?php echo esc_html($demo_link); ?>" class="demopv-btn-elementor ghost_button" target="_blank"><?php echo esc_html($livepreviewtext); ?></a>
    	<?php } ?>
</div>
<?php } elseif($overlay=="pdf") { ?>
<div class="msv-single-thumb-overlay-bds">
    <?php if ( $pdf_preview_url  ) { ?>
    	<a href="#pdfpreviewbox" class="demopv-btn-elementor ghost_button" data-lity><?php echo esc_html($prpreview); ?></a>
    	<div id="pdfpreviewbox" class="lity-hide">
<embed src="<?php echo esc_html($pdf_preview_url); ?>" type="application/pdf" class="pdfpreviewboxembed">
</div>
    	<?php } ?>
</div>
<?php } ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_thumbnail);
?>