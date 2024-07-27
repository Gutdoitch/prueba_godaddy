<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_woo_masonary_item extends Widget_Base {

    public function get_name() {
        return 'mayosis-woo-masonary';
    }

    public function get_title() {
        return __( 'Mayosis Woo Masonry Grid', 'mayosis-core' );
    }
    public function get_categories() {
        return [ 'mayosis-woo-cat' ];
    }
    public function get_icon() {
        return 'eicon-elementor';
    }

    protected function register_controls() {

        $this->add_control(
            'section_woo',
            [
                'label' => __( 'Mayosis WOO Masonry', 'mayosis-core' ),
                'type' => Controls_Manager::SECTION,
            ]
        );



        $this->add_control(
            'item_per_page',
            [
                'label'   => esc_html_x( 'Amount of item to display', 'Admin Panel', 'mayosis-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' =>  "10",
                'section' => 'section_woo',
            ]
        );
        $this->add_control(
            'list_layout',
            [
                'label'     => esc_html_x( 'Layout', 'Admin Panel','mayosis-core' ),
                'description' => esc_html_x('Column layout for the list"', 'mayosis-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'    =>  "3",
                'section' => 'section_woo',
                "options"    => array(
                    "2" => "Two",
                    "3" => "Three",
                    "4" => "Four",
                    "5" => "Five",
                ),
            ]

        );

    $this->add_control(
            'pagination',
            [
                'label'     => esc_html_x( 'Pagination', 'Admin Panel','mayosis-core' ),
                'description' => esc_html_x('select pagination type', 'mayosis-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'    =>  "one",
                'section' => 'section_woo',
                "options"    => array(
                    "one" => "none",
                    "two" => "Normal Pagination",
                    "three" => "Ajax Load More",
                ),
            ]

        );
        
        $this->add_control(
            'load_more_text',
            [
                'label' => __( 'Load More Button Text', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'More Products',
                'title' => __( 'Enter Button Text', 'mayosis-core' ),
                'section' => 'section_woo',
                'condition' => [
                    'pagination' => array('three'),
                ],
            ]
        );
      
        $this->add_control(
            'filter-product',
            [
                'label' => __( 'Show Product Filter', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_woo',
                'options' => [
                    'show' => 'Show',
                    'hide' => 'Hide'
                ],
                'default' => 'hide',

            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __( 'Order', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_woo',
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending'
                ],
                'default' => 'desc',

            ]
        );
        
          $this->add_control(
      'category',
      array(
        'label'       => esc_html__( 'Select Categories', 'mayosis-core' ),
        'type'        => Controls_Manager::SELECT2,
        'multiple'    => true,
        'section' => 'section_woo',
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
                'section' => 'section_woo',
            ]
        );
        
         $this->add_control(
      'tags',
      array(
        'label'       => esc_html__( 'Select Tags', 'mayosis-core' ),
        'type'        => Controls_Manager::SELECT2,
        'multiple'    => true,
        'section' => 'section_woo',
        'options'     => array_flip(mayosis_items_extracts( 'tags', array(
          'sort_order'  => 'ASC',
          'taxonomies'    => 'product_tag',
          'hide_empty'  => false,
        ) )),
        'label_block' => true,
      )
    );
    
        $this->add_control(
            'titilebox',
            [
                'label' => __( 'Title Hover Box', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_woo',
                'options' => [
                    'show' => 'Show',
                    'hide' => 'Hide'
                ],
                'default' => 'hide',

            ]
        );
        
        $this->add_control(
            'titileboxstyle',
            [
                'label' => __( 'Title Box Style', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_woo',
                'options' => [
                    'one' => 'One',
                    'two' => 'Two',
                    'three' => 'three'
                ],
                'default' => 'one',

            ]
        );
        
        $this->add_control(
            'bottommetabox',
            [
                'label' => __( 'Grid Meta Box', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_woo',
                'options' => [
                    'show' => 'Show',
                    'hide' => 'Hide'
                ],
                'default' => 'hide',

            ]
        );
        
        $this->add_control(
            'imagehovereffect',
            [
                'label' => __( 'Image Hover Effect', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_woo',
                'options' => [
                    'enable' => 'Enable',
                    'disable' => 'Disable'
                ],
                'default' => 'disable',

            ]
        );
     

        $this->add_control(
            'custom_css',
            [
                'label' => __( 'Custom CSS Class', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Custom CSS name', 'mayosis-core' ),
                'section' => 'section_woo',
            ]
        );
        
       	$this->start_controls_section(
			'other_style',
			[
				'label' => __( 'Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
			$this->start_controls_tabs( 'tabs_button_style' );
		
		    $this->start_controls_tab(
			'load_button',
			[
				'label' => __( 'Load More Button', 'mayosis-core' ),
			]
		);
		      $this->add_control(
			'lm_button_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#1e3c78',
				'selectors' => [
					'{{WRAPPER}} .inf-load-more' => 'background-color: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .inf-load-more' => 'border-color: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .inf-load-more' => 'color: {{VALUE}}',
					
						
				],
			]
		);
			$this->end_controls_tab();
		
		
		
		  $this->start_controls_tab(
			'load_button_hover',
			[
				'label' => __( 'Load More Hover', 'mayosis-core' ),
			]
		);
		
		 $this->add_control(
			'lm_button_hvr_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#0A0FA1',
				'selectors' => [
					'{{WRAPPER}} .inf-load-more:hover' => 'background-color: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .inf-load-more:hover' => 'border-color: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .inf-load-more:hover' => 'color: {{VALUE}}',
					
						
				],
			]
		);
		
			$this->end_controls_tab();
				$this->end_controls_tabs();
				
				 $this->add_responsive_control(
			'align_button',
			[
				'label' => __( 'Button Alignment', 'mayosis-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'mayosis-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mayosis-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mayosis-core' ),
						'icon' => 'eicon-text-align-right',
					],
					
				],
				
				'default' => 'center',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .mayo-page-product,{{WRAPPER}} #infscr-loading' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'loading_txt_color',
			[
				'label' => __( 'Loading text Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} #infscr-loading' => 'color: {{VALUE}}',
					
						
				],
			]
		);
		
		 $this->add_control(
         'image_radius',
         [
            'label' => __( 'Border radius', 'mayosis-core' ),
            'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .product-masonry-item .product-masonry-item-content,
					{{WRAPPER}} .product-masonry-item .product-masonry-item-content img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            
         ]
      );
      
      $this->add_control(
			'filter_txt_color',
			[
				'label' => __( 'Filter Text Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .product-masonry-filter>li a' => 'color: {{VALUE}}',
					
						
				],
			]
		);
		$this->add_control(
			'filter_txt_hvr_color',
			[
				'label' => __( 'Filter Text Hover Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .product-masonry-filter>li a:hover' => 'color: {{VALUE}}',
					
						
				],
			]
		);
$this->end_controls_section();
      
      
      

    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.

        $settings = $this->get_settings();
        global $post;
        $post_count = ! empty( $settings['item_per_page'] ) ? (int)$settings['item_per_page'] : 5;
        $post_order_term=$settings['order'];
         $categories= $settings['category'];
        $products_category_not=$settings['categorynotin'];
        $filterproduct = $settings['filter-product'];
        $titlebox = $settings['titilebox'];
        $custom_css = $settings['custom_css'];
        $product_column= $settings['list_layout'];
        $bottommetabox = $settings['bottommetabox'];
        $titileboxstyle = $settings['titileboxstyle'];
         $author = get_user_by( 'id', get_query_var( 'author' ) );
       $author_id=$post->post_author;
       $tags = $settings['tags'];
       $pagination = $settings['pagination'];
       $imageeffect = $settings['imagehovereffect'];
        ?>


        <div class="<?php
        echo esc_attr($custom_css); ?>">
            <div class="row">
                <div class="col-md-12">
                      <?php  if( $filterproduct == 'show' ) : ?>
                    <div class="product-filter-wrap text-center">
                    <ul class="product-masonry-filter">
                        <li><a href="#" data-filter="*" class="active"> All</a></li>
        <?php

        $taxonomy = 'product_cat';
       $args = array('orderby'=>'count','hide_empty'=>true, 'parent'   => 0,);
    
                            $terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
        if ( ! empty( $terms ) && is_array( $terms )  ) :
            ?>

            <?php foreach ( $terms as $term ) { ?>
                        <li><a href="#" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
        <?php } ?>

        <?php endif;?>
                    </ul>
</div>
<?php endif; ?>
                    <div class="masonry-wrapper">
                    <div class="product-masonry product-masonry-gutter product-masonry-style-2 product-masonry-masonry product-masonry-full product-masonry-<?php echo $product_column;?>-column <?php
                if ($pagination=='three') { ?>infinite-content-masonry<?php }?>">

        <?php
        global $post;
   
            global $wp_query; 
						if ( get_query_var('paged') ) {
							$paged = get_query_var('paged');
						} else if ( get_query_var('page') ) {
							$paged = get_query_var('page');
						} else {
							$paged = 1;
						}
						
						if ($pagination == 'two' || $pagination == 'three'){
						    
						     $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => $post_count,
                            'paged' =>$paged,
                            'order' => (string)trim($post_order_term),);
						} else {
						    
						     $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => $post_count,
                            'order' => (string)trim($post_order_term),);
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
       
        $the_query =new \WP_Query($args);
    while ($the_query -> have_posts()) : $the_query -> the_post();
    $max_num_pages = $the_query->max_num_pages;
    ?>
            <?php
            global $post;
            $downlodterms = get_the_terms( $post->ID, 'product_cat' );// Get all terms of a taxonomy
            $cls = '';

            if ( ! empty( $downlodterms ) ) {
                foreach ($downlodterms as $term ) {
                    $cls .= $term->slug . ' ';
                }
            }
            
                    if ($pagination=='three') {
                                $scrollitem ='infinite-post-masonry';
                            } else {
                                $scrollitem = '';
                            }
                            
                            if($imageeffect=='enable'){
                                $imgeftcls='masonry-hover-effect-enabled';
                            } else {
                                 $imgeftcls='';
                            }
            ?>
                        <div class="product-masonry-item <?php echo $cls; ?> <?php echo $scrollitem; ?> <?php echo $imgeftcls;?>">
                            <div <?php post_class(); ?>>
                          
                            <div class="product-masonry-item-content">
                                
                                    <?php if ( has_post_format( 'video' )) {
                                    
                                      $mayosis_video = get_post_meta($post->ID, 'video_url',true);
                        
                        if (strpos($mayosis_video,'youtube.com')==true){
                            $mayosis_video_cls="mayosis-youtube-hosted-video";
                            
                        } elseif (strpos($mayosis_video,'vimeo')==true){
                            $mayosis_video_cls="mayosis-vimeo-hosted-video";
                        } else {
                            
                            $mayosis_video_cls="mayosis-self-hosted-video";
                            
                        }
                                    ?>
                                        <div class="item-thumbnail item-video-masonry <?php echo esc_html($mayosis_video_cls);?>">
                                           <?php get_template_part(
                                                            "includes/woo/inc/mayosis-video-box-thumb"
                                                        ); ?>
                                        </div>
                                    <?php } else { ?>
                                    <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                                    <div class="item-thumbnail">
                                    <a href="<?php the_permalink();?>"><img src="<?php echo $thumbnail['0']; ?>" alt=""></a>
                                     </div>
                                    <?php } ?>
                                
                                <?php if ($titlebox=="show"){?>
                                
                                <?php if ($titileboxstyle== "one"){ ?>
                                <div class="product-masonry-description">
                                    
                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                                    </div>
                                    
                                <?php } elseif ($titileboxstyle== "three"){ ?>
                                
                                 <div class="product-masonry-description masonry-style-three">
                                     <div class="product_hover_details_button">
                                  <a href="<?php the_permalink();?>"  class="button-fill-color"><?php esc_html_e('View Details','mayosis-core');?></a>
                                </div>
                                    
                                    </div>
                                <?php } else { ?>
                                <div class="product-masonry-description masonry-style-two">
                                    
                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                                    
                                    <div class="bottom-metaflex">
                                    <?php if ( function_exists( 'woo_favorites_load_link' ) ) {
                        woo_favorites_load_link( $product_id );
                    } ?> <?php do_action('mayosis_seller_information_main');?>
								 </div>
                                </div>
                                <?php } ?>
                                <?php } ?>
                                
                                <?php if ($bottommetabox=="show"){?>
                                <div class="product-meta">
                                	<?php get_template_part( 'includes/woo/inc/product-meta' ); ?>
                            </div>
                            <?php } ?>
                            
                            
                            </div>
                            
                        </div>
                            
                        </div>

      <?php endwhile; wp_reset_postdata(); ?>



                        <div class="clearfix"></div>
                       




                </div>
                <div class="clearfix"></div>
                <div class="mayo-page-product">
        <?php if ($pagination == 'two'|| $pagination == 'three'){ ?>
           
        <?php if ($pagination == 'three'){ ?>
            <a href="#" class="inf-load-more"><?php echo $settings['load_more_text']; ?></a>
            
        <?php }?>
        
        <?php if ($pagination == 'three') {
            $stylenone = 'display:none';
        } else {
            $stylenone ='';
        } ?>
<div class="nav-links" style="<?php echo $stylenone;?>">
<?php mayosis_page_paging_nav($max_num_pages); ?>
</div>
<?php } ?>
</div>
            
                </div>
                
                     
                </div>
            </div>
        </div>


        <?php

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_woo_masonary_item );
?>