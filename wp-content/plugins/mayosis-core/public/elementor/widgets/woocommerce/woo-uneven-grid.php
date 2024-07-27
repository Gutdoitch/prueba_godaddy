<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_woo_uneven_grid extends Widget_Base {

    public function get_name() {
        return 'mayosis-woo-uneven-grid';
    }

    public function get_title() {
        return __( 'Mayosis Woo Uneven Grid', 'mayosis-core' );
    }
    public function get_categories() {
        return [ 'mayosis-woo-cat' ];
    }
    public function get_icon() {
        return 'eicon-elementor';
    }

    protected function register_controls() {

        $this->add_control(
            'section_edd',
            [
                'label' => __( 'Mayosis Woo Uneven Grid', 'mayosis-core' ),
                'type' => Controls_Manager::SECTION,
            ]
        );

$this->add_control(
			'p_style',
			[
				'label' => esc_html__( 'Grid Style', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'section' => 'section_edd',
				'options' => [
					'style1'  => esc_html__( 'Style One', 'textdomain' ),
					'style2' => esc_html__( 'Style Two', 'textdomain' ),
					
					
				],
			
			]
		);
		
			$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Sub Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Find Your Video', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your title here', 'textdomain' ),
				'section' => 'section_edd',
				'condition' => [
			'p_style' => 'style3',
		],
			]
		);
		
			$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'section' => 'section_edd',
				'default' => esc_html__( 'Great Videos start here', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your title here', 'textdomain' ),
						'condition' => [
			'p_style' => 'style3',
		],
			]
		);
		
			$this->add_control(
			'item_description',
			[
				'label' => esc_html__( 'Description', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'section' => 'section_edd',
				'default' => esc_html__( 'Default description', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
								'condition' => [
			'p_style' => 'style3',
		],
			]
		);

		
        $this->add_control(
            'item_per_page',
            [
                'label'   => esc_html_x( 'Amount of item to display', 'Admin Panel', 'mayosis-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' =>  "10",
                'section' => 'section_edd',
            ]
        );

        $this->add_control(
            'category',
            array(
                'label'       => esc_html__( 'Select Categories', 'mayosis-core' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'section' => 'section_edd',
                'options'     => array_flip(mayosis_items_extracts( 'categories', array(
                    'sort_order'  => 'ASC',
                    'taxonomy'    => 'product_cat',
                    'hide_empty'  => false,
                ) )),
                'label_block' => true,
            )
        );

        $this->add_control(
            'categorynotin',
            [
                'label' => __( 'Exclude Category', 'mayosis-core' ),
                'description' => __('Add one category slug','mayosis-core'),
                'type' =>  Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => array_flip(mayosis_items_extracts( 'categories', array(
                    'sort_order'  => 'ASC',
                    'taxonomy'    => 'product_cat',
                    'hide_empty'  => false,
                ) )),
                'label_block' => true,
                'section' => 'section_edd',
            ]
        );

        $this->add_control(
            'tags',
            array(
                'label'       => esc_html__( 'Select Tags', 'mayosis-core' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'section' => 'section_edd',
                'options'     => array_flip(mayosis_items_extracts( 'tags', array(
                    'sort_order'  => 'ASC',
                    'taxonomies'    => 'product_tag',
                    'hide_empty'  => false,
                ) )),
                'label_block' => true,
            )
        );



        $this->add_control(
            'order',
            [
                'label' => __( 'Order', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending'
                ],
                'default' => 'desc',

            ]
        );
        
        $this->add_control(
			'featured_product',
			[
				'label' => __( 'Featured', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Featured', 'your-plugin' ),
				'label_off' => __( 'Normal', 'your-plugin' ),
				'section' => 'section_edd',
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


        $this->start_controls_section(
            'other_style',
            [
                'label' => __( 'Style', 'mayosis-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'img-border-radius',
			[
				'label' => __( 'Small Image Border Radius', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mayosis-uv-common-slot .msuv-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'large-img-border-radius',
			[
				'label' => __( 'Large Image Border Radius', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mayosis-uv-middle-slot .msuv-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'smimage_box_shadow',
				'label' => __( 'Small Image Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .mayosis-uv-common-slot .msuv-thumbnail img',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'lgimage_box_shadow',
				'label' => __( 'Large Image Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .mayosis-uv-middle-slot .msuv-thumbnail img',
			]
		);
  $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => __( 'Subtitle Typography', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .mayosis-uv-style3-grid-text .ptl-alttext',
				'condition' => [
			'p_style' => 'style3',
		],
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'Subtitle Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-uv-style3-grid-text .ptl-alttext' => 'color: {{VALUE}}',
				],
						'condition' => [
			'p_style' => 'style3',
		],
			]
		);
		
		  $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .mayosis-uv-style3-grid-text h3',
				'condition' => [
			'p_style' => 'style3',
		],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-uv-style3-grid-text h3' => 'color: {{VALUE}}',
				],
						'condition' => [
			'p_style' => 'style3',
		],
			]
		);
		
		  $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'Description Typography', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .mayosis-uv-style3-grid-text p',
				'condition' => [
			'p_style' => 'style3',
		],
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Description Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-uv-style3-grid-text p' => 'color: {{VALUE}}',
				],
						'condition' => [
			'p_style' => 'style3',
		],
			]
		);

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.

        $settings = $this->get_settings();
        $post_count = ! empty( $settings['item_per_page'] ) ? (int)$settings['item_per_page'] : 5;
        $categories= $settings['category'];
        $products_category_not=$settings['categorynotin'];
        $post_order_term=$settings['order'];
        $tags = $settings['tags'];
        $fproduct = $settings['featured_product'];
        $productstyle= $settings['p_style'];
        
        ?>

        <div class="edd_recent_ark">
       
            <div class="mfull-undeven-grid-elementor">
                
                  
                 
                <div class="product--uneven--grid--elementor">
                

                    <?php
                    global $post;

$args = array( 'post_type' => 'product','posts_per_page' => $post_count, 'order' => (string) trim($post_order_term), ); 



                    if ($fproduct==="yes"){
                   
                    
                        $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                )
            );
                    } 

                    if(!empty($categories[0])) {
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'ids',
                                'terms'    => $categories
                            )
                        );
                    }

                    if(!empty($tags[0])) {
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'product_tag',
                                'field'    => 'ids',
                                'terms'    => $tags
                            )
                        );
                    }

                    if(!empty($products_category_not[0])) {
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'ids',
                                'terms'    => $products_category_not,
                                'operator' => 'NOT IN'
                            )
                        );
                    }
                    $the_query = new \WP_Query($args);

                    ?>
                     <?php if($productstyle=="style2"){ ?>
         <div class="product--uneven--grid--elementorstyle2">
             <?php  while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
       <div class="mayosis-uv-style2-grid">
<?php if ( has_post_thumbnail() ) : ?>
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('mayosis-single-page-thumbnail'); ?>
                                            </a>
                                        <?php endif; ?>
</div>
  <?php endwhile; wp_reset_postdata(); ?>
</div>


 <?php } elseif($productstyle=="style3"){ ?>
 <div class="muuri-wrapper">
         <div class="product--uneven--grid--elementorstyle3 product-muuri-uneven-column row">
             
              <?php for ($i = 0; $i < 1; $i ++): $the_query -> the_post(); ?>
                <div class="mayosis-uv-style3-grid product-muuri-item">
           
            <div class="product-muuri-item-content">
  <?php if ( has_post_format( 'video' )) { ?>
                                        <div class="item-thumbnail item-video-masonry item-video-masonry-ms3">
                                            <span class="msv-identy-iconms3"><i class="isax icon-video-play"></i></span>
                                            <a href="<?php the_permalink();?>" class="msv-whole-bx-link">
                                            <?php get_template_part( 'library/mayosis-video-box-thumb-uvg' ); ?>
                                            
                                            <div class="msv-overlay-ms3-sdt">
                                            <?php get_template_part( 'includes/product-meta' ); ?>
                                            </div>
                                            </a>
                                        </div>
                                    <?php } else { ?>
                                    
                                   
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('mayosis-single-page-thumbnail'); ?>
                                            </a>
                                             <div class="msv-overlay-ms3-sdt">
                                            <?php get_template_part( 'includes/product-meta' ); ?>
                                            </div>
                                        <?php } ?>
                                        </div>
</div>
               <?php
                                if (!$the_query -> have_posts()) :
                                    break;
                                endif; ?>
                            <?php endfor; ?>
             
                   <div class="mayosis-uv-style3-grid-text product-muuri-item">
       <div class="product-muuri-item-content has_mayosis_dark_alt_bg">
           <span class="ptl-alttext"><?php echo $settings['subtitle'];?></span>
         <h3><?php echo $settings['title'];?></h3>
         <p><?php echo $settings['item_description'];?></p>
       </div>
     </div>
             
             
             
            <?php $mayosis_small_grid_count = $the_query -> post_count - 1;
                            if ($the_query -> have_posts() && $mayosis_small_grid_count > 0):
                                $posts_per_column = $post_count - 1; ?>
                                
                                 <?php for ($i = 0; $i < $post_count ; $i++):

                                if (!$the_query -> have_posts()) :
                                    break;
                                endif;
                                $the_query -> the_post();
                                ?>
       <div class="mayosis-uv-style3-grid product-muuri-item">
           
            <div class="product-muuri-item-content">
  <?php if ( has_post_format( 'video' )) { ?>
                                         <div class="item-thumbnail item-video-masonry item-video-masonry-ms3">
                                              <span class="msv-identy-iconms3"><i class="isax icon-video-play"></i></span>
                                            <a href="<?php the_permalink();?>" class="msv-whole-bx-link">
                                            <?php get_template_part( 'library/mayosis-video-box-thumb-uvg' ); ?>
                                            
                                            <div class="msv-overlay-ms3-sdt">
                                            <?php get_template_part( 'includes/product-meta' ); ?>
                                            </div>
                                            </a>
                                        </div>
                                    <?php } else { ?>
                                    
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('mayosis-single-page-thumbnail'); ?>
                                            </a>
                                             <div class="msv-overlay-ms3-sdt">
                                            <?php get_template_part( 'includes/product-meta' ); ?>
                                            </div>
                                        <?php } ?>
                                        </div>
</div>
 <?php endfor; ?>

                            <?php endif; ?>
</div>
</div>
        <?php } else { ?>
                    <div class="row mayosis-uv-style-product msuv-style-one">

                        <div class="col-12 col-md-4 mayosis-uv-common-slot">
                            <?php for ($i = 0; $i < 4; $i ++): $the_query -> the_post(); ?>

                                <div class="mayosis-uv-left-product">
                                    <div class="msuv-thumbnail">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('mayosis-uneven-left-small'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php
                                if (!$the_query -> have_posts()) :
                                    break;
                                endif; ?>
                            <?php endfor; ?>
                        </div>

                        <div class="col-12 col-md-4 mayosis-uv-middle-slot">
                            <?php $mayosis_small_grid_count = $the_query -> post_count - 4;
                            if ($the_query -> have_posts() && $mayosis_small_grid_count > 0):
                                $posts_per_column = $post_count - 4; ?>

                                <?php for ($i = 0; $i < 1; $i++):

                                if (!$the_query -> have_posts()) :
                                    break;
                                endif;
                                $the_query -> the_post();
                                ?>
                                <div class="mayosis-uv-middle-product">
                                    <div class="msuv-thumbnail">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('mayosis-uneven-middle-large'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endfor; ?>

                            <?php endif; ?>
                        </div>

                        <div class="col-12 col-md-4 mayosis-uv-common-slot">
                            <?php $mayosis_small_grid_count = $the_query -> post_count - 5;
                            if ($the_query -> have_posts() && $mayosis_small_grid_count > 0):
                                $posts_per_column = $post_count - 5; ?>

                                <?php for ($i = 0; $i < 4; $i++):

                                if (!$the_query -> have_posts()) :
                                    break;
                                endif;
                                $the_query -> the_post();
                                ?>
                                <div class="mayosis-uv-right-product">
                                    <div class="msuv-thumbnail">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail('mayosis-uneven-left-small'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endfor; ?>

                            <?php endif; ?>
                        </div>
                    </div>
                   <?php } ?>
                </div>
            </div>
           
        </div>
        <?php

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_woo_uneven_grid );
?>