<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Theme_testimonial_Elementor_Thing extends Widget_Base {

   public function get_name() {
      return 'mayosis-theme-testimonial';
   }

   public function get_title() {
      return __( 'Mayosis Testimonial', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return ' eicon-testimonial';
   }

   protected function register_controls() {

      $this->add_control(
         'section_hero_testimonial',
         [
            'label' => __( 'Testimonial Content', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      
      $this->add_control(
            'title',
            [
                'label' => __( 'Section Title', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Section Title', 'mayosis-core' ),
                'section' => 'section_hero_testimonial',
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __( 'Sub Title', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Sub Title', 'mayosis-core' ),
                'section' => 'section_hero_testimonial',
            ]
        );
      
      $this->add_control(
            'margin_bottom',
            [
                'label' => __( 'Title Section Margin Bottom (With px)', 'mayosis-core' ),
                'description' => __('Add Margin Bottom','mayosis-core'),
                'type' => Controls_Manager::TEXT,
                'default' => '20px',
                'section' => 'section_hero_testimonial',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Button Text', 'mayosis-core' ),
                'section' => 'section_hero_testimonial',
            ]
        );


                $this->add_control(
                    'button_link',
                    [
                        'label' => __( 'Button URL', 'mayosis-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '',
                        'title' => __( 'Enter Button URL', 'mayosis-core' ),
                        'section' => 'section_hero_testimonial',
                    ]
                );
                
        $this->add_control(
            'button_style',
            [
                'label' => __( 'Button Style', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_hero_testimonial',
                'options' => [
                    'solid' => 'Solid',
                    'transparent' => 'Ghost'
                ],
                'default' => 'solid',

            ]
        );

       $this->add_control(
         'amount_display',
         [
            'label' => __( 'Amount of Testimonial to display:', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '3',
            'title' => __( 'Enter Amount of Testimonial to display', 'mayosis-core' ),
            'section' => 'section_hero_testimonial',
         ]
      );
        $this->add_control(
            'order',
            [
                'label' => __( 'Order', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_hero_testimonial',
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending'
                ],
                'default' => 'desc',

            ]
        );
       
       $this->add_control(
            'display_type',
            [
                'label' => __( 'Display Type', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_hero_testimonial',
                'options' => [
                    'normal' => 'Normal',
                    'grid' => 'Carousel'
                ],
                'default' => 'normal',

            ]
        );
       
       $this->add_control(
            'testimonial_column',
            [
                'label' => __( 'Column', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_hero_testimonial',
                'options' => [
                    'one' => 'One',
                    'two' => 'Two',
                    'three' => 'Three',
                    'four' => 'Four',
                    'five' => 'Five',
                    'six' => 'Six',
                ],
                'default' => 'three',

            ]
        );
        
        $this->add_control(
			'grid-spacing',
			[
				'label' => __( 'Spacing', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'section' => 'section_hero_testimonial',
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 45,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-slide' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

       	$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'section' => 'section_hero_testimonial',
				'options' => [
					'both' => __( 'Arrows and Dots', 'elementor' ),
					'arrows' => __( 'Arrows', 'elementor' ),
					'dots' => __( 'Dots', 'elementor' ),
					'none' => __( 'None', 'elementor' ),
				],
				'frontend_available' => true,
			]
		);
        
$this->add_control(
         'section_style_testimonial',
         [
            'label' => __( 'Style', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
   $this->add_control(
         'pre_color',
         [
            'label' => __( 'Color of Pre Title Unit', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#c2c9cc',
            'section' => 'section_style_testimonial',
         ]
      );
       
       $this->add_control(
         'main_color',
         [
            'label' => __( 'Color of Main Title', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#c2c9cc',
            'section' => 'section_style_testimonial',
         ]
      );
       
       $this->add_control(
         'author_color',
         [
            'label' => __( 'Color of Author Title', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'section' => 'section_style_testimonial',
         ]
      );
       
       $this->add_control(
         'span_color',
         [
            'label' => __( 'Color of Span', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'section' => 'section_style_testimonial',
         ]
      );
       
       $this->add_control(
         'desc_color',
         [
            'label' => __( 'Color of Grid Description', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#c2c9cc',
            'section' => 'section_style_testimonial',
         ]
      );
       $this->add_control(
         'designation_color',
         [
            'label' => __( 'Color of Designation', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#c2c9cc',
            'section' => 'section_style_testimonial',
         ]
      );
     
      $this->add_control(
			'arrow_color',
			[
				'label' => __( 'Arrow Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#3c465a',
				'section' => 'section_style_testimonial',
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button-prev i,{{WRAPPER}} .elementor-swiper-button-next i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'dots_color',
			[
				'label' => __( 'Dots Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#3c465a',
				'section' => 'section_style_testimonial',
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'tm_border_radius',
			[
				'label' => __( 'Thumbnail Border Radius', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'section' => 'section_style_testimonial',
				'selectors' => [
					'{{WRAPPER}} .grid_photo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
        $recent_section_title = $settings['title'];
       $post_count = ! empty( $settings['amount_display'] ) ? (int)$settings['amount_display'] : 5;
        $post_order_term=$settings['order'];
        $sub_title = $settings['sub_title'];
        $title_sec_margin = $settings['margin_bottom'];
        $button_text = $settings['button_text'];
        $button_link = $settings['button_link'];
        $button_style = $settings['button_style'];
        $navigation = $settings['navigation'];
      ?>

 <!-- Element Code start -->
 
 <div class="title--box--full" style="margin-bottom:<?php echo esc_attr($title_sec_margin); ?>;">
                <div class="title--promo--box">
                    <h3 class="section-title"><?php echo esc_attr($recent_section_title); ?> </h3>
        <?php
        if ($sub_title ) { ?>
                    <p><?php echo esc_attr($sub_title); ?></p>
            <?php } ?>
                </div>

                <div class="title--button--box">
                    <?php
                    if ($button_link) { ?>
                        <a href="<?php echo esc_attr($button_link); ?>" class="btn title--box--btn <?php echo esc_attr($button_style);?>"><?php echo esc_attr($button_text); ?></a>
                    <?php } ?>
                </div>
            </div>
<?php if($settings['display_type'] == 'normal'){ ?>
       <?php
        global $post;
         $args = array( 'post_type' => 'testimonial','numberposts' => $post_count, 'order' => (string) trim($post_order_term),);
         $recent_posts = get_posts( $args );
         foreach( $recent_posts as $post ){?>
        <div class="testimonal-promo">
                    <?php $pre_title = get_field( 'pre_title' ); ?>
        <?php if ( $pre_title ) { ?>
                            <small style=" color: <?php echo $settings['pre_color']; ?>;"><?php echo esc_html($pre_title); ?></small>
                            <?php } ?>
                            <h2 style=" color: <?php echo $settings['main_color'];?>;">&#34;<?php the_title(); ?>&#34;</h2>
                            <?php $testimonial_author_name = get_field( 'testimonial_author_name' ); ?>
        <?php if ( $testimonial_author_name ) { ?>
                        <p style="color: <?php echo $settings['author_color'];?>;"><span style="color:<?php echo $settings['span_color'];?>;">By</span> <?php echo esc_html($testimonial_author_name); ?></p>
                        <?php } ?>

                </div>
  	     <?php } ?>
         <?php  wp_reset_postdata();
         ?>
         <?php } ?>

<?php if($settings['display_type'] == 'grid'){ ?>

 
      <div id="carousel-testimonial-elmentor" class="elementor-image-carousel-wrapper swiper-container  swiper-container-initialized swiper-container-horizontal carousol-col-<?php echo $settings['testimonial_column'];?>">
          
          <div class="mayosis-testimonial-carousel swiper-wrapper">
              
              
              
<?php
        global $post;
         $args = array( 'post_type' => 'testimonial','numberposts' => $post_count, 'order' => (string) trim($post_order_term),);
         $recent_posts = get_posts( $args );
         foreach( $recent_posts as $post ){?>
<div class="swiper-slide">
    <figure class="swiper-slide-inner">'
                          <div class="grid-testimonal-promo">
                          <div class="testimonial_details" style="color:<?php echo $settings['desc_color'];?>;">
                         
                          <?php the_field('testimonial_small_description(_for_grid_style_only)'); ?>
                          
                          </div>
                          <div class="arrow-down"></div>
    		
					<?php $testimonial_author_name = get_field( 'testimonial_author_name' ); ?>

   			<div class="testimonial-grid-author">
   			<div class="grid_photo text-center">
   				 <?php
								// display featured image?
								if ( has_post_thumbnail() ) :
									the_post_thumbnail( 'full', array( 'class' => 'img-responsive img-circle grid-thumbnail-left' ) );
								endif; 

							?>   
   			</div>
   			<?php if ( $testimonial_author_name ) { ?>
    			<div class="testimonial_grid_titles  text-center">
    			<h4 class="grid_main_author" style="color: <?php echo $settings['author_color'];?>;"><?php echo esc_html($testimonial_author_name); ?></h4>
    			<p class="grid_designation" style="color: <?php echo $settings['designation_color'];?>;"><?php the_field('testimonial_author_job_title'); ?></p>
    			
    			</div>
    			<div class="clearfix"></div>
    			<?php } ?>
    			</div>
    			
    		
    	</div>
    	</figure>
                          </div>

<?php } ?>


		
</div>
<?php if ($navigation=="both"){?>

	<div class="swiper-pagination"></div>
<div class="elementor-swiper-button elementor-swiper-button-prev">
						<i class="eicon-chevron-left" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php _e( 'Previous', 'elementor' ); ?></span>
					</div>
					<div class="elementor-swiper-button elementor-swiper-button-next">
						<i class="eicon-chevron-right" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php _e( 'Next', 'elementor' ); ?></span>
					</div>
					
					
					<?php } elseif($navigation=="dots"){?>
						<div class="swiper-pagination"></div>
					<?php } elseif($navigation=="arrows"){?>
					
					<div class="elementor-swiper-button elementor-swiper-button-prev">
						<i class="eicon-chevron-left" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php _e( 'Previous', 'elementor' ); ?></span>
					</div>
					<div class="elementor-swiper-button elementor-swiper-button-next">
						<i class="eicon-chevron-right" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php _e( 'Next', 'elementor' ); ?></span>
					</div>
					<?php } ?>
</div>
         <?php  wp_reset_postdata();
         ?>
         
        
<?php } ?>
<div class="clearfix"></div>
      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new Theme_testimonial_Elementor_Thing );
?>