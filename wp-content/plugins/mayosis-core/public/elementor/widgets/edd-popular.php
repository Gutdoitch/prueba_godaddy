<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_edd_popular extends Widget_Base {

   public function get_name() {
      return 'mayosis_edd_popular';
   }

   public function get_title() {
      return __( 'Mayosis EDD Popular', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-elementor';
   }

   protected function register_controls() {

      $this->add_control(
         'section_edd',
         [
            'label' => __( 'Mayosis EDD Popular', 'mayosis-core' ),
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
            'section' => 'section_edd',
         ]
      );
         $this->add_control(
            'sub_title',
            [
                'label' => __( 'Sub Title', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Sub Title', 'mayosis-core' ),
                'section' => 'section_edd',
            ]
        );

        $this->add_control(
            'margin_bottom',
            [
                'label' => __( 'Title Section Margin Bottom (With px)', 'mayosis-core' ),
                'description' => __('Add Margin Bottom','mayosis-core'),
                'type' => Controls_Manager::TEXT,
                'default' => '20px',
                'section' => 'section_edd',
            ]
        );
      $this->add_control(
            'selectoption',
            [
                'label' => __( 'Right Side Option', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'button' => 'Button',
                    'category' => 'Category Filter'
                ],
                'default' => 'button',

            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Button Text', 'mayosis-core' ),
                'section' => 'section_edd',
                 'condition' => [
                    'selectoption' => array('button'),
                ],
            ]
        );


        $this->add_control(
            'button_link',
            [
                'label' => __( 'Button URL', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Button URL', 'mayosis-core' ),
                'section' => 'section_edd',
                'condition' => [
                    'selectoption' => array('button'),
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
    			'list_layout',
    			[
    				'label'     => esc_html_x( 'Layout', 'Admin Panel','mayosis-core' ),
    				'description' => esc_html_x('Column layout for the list"', 'mayosis-core' ),	
    				'type'      =>  Controls_Manager::SELECT,
    				'default'    =>  "1/1",
    				'section' => 'section_edd',
    				"options"    => array(
    									"1/1" => "1",
    									"1/2" => "2",													
    									"1/3" => "3",													
    									"1/4" => "4",
    									
    									"1/5" => "5",
    									
    									"1/6" => "6",
    								),				
    			]
    		 
    		);
		
       $this->add_control(
         'ribbon',
         [
            'label' => __( 'Ribbon Text', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'title' => __( 'Enter Ribbon Text', 'mayosis-core' ),
            'section' => 'section_edd',
         ]
      );
       
       $this->add_control(
            'pagination',
            [
                'label'     => esc_html_x( 'Pagination', 'Admin Panel','mayosis-core' ),
                'description' => esc_html_x('select pagination type', 'mayosis-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'    =>  "one",
                'section' => 'section_edd',
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
                'section' => 'section_edd',
                'condition' => [
                    'pagination' => array('three'),
                ],
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
          'taxonomy'    => 'download_category',
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
                      'taxonomy'    => 'download_category',
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
          'taxonomies'    => 'download_tag',
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
$this->start_controls_section(
			'other_style',
			[
				'label' => __( 'Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'label' => __( 'Title Typography', 'mayosis-core' ),
				'selector' => '{{WRAPPER}} .section-title',
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
					'{{WRAPPER}} .inf-load-more-popular' => 'background-color: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .inf-load-more-popular' => 'border-color: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .inf-load-more-popular' => 'color: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .inf-load-more-popular:hover' => 'background-color: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .inf-load-more-popular:hover' => 'border-color: {{VALUE}}',
					
						
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
					'{{WRAPPER}} .inf-load-more-popular:hover' => 'color: {{VALUE}}',
					
						
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
				'separator' => 'before',
				'default' => 'center',
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
$this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
$post_count = ! empty( $settings['item_per_page'] ) ? (int)$settings['item_per_page'] : 5;
$post_order_term=$settings['order'];
$sub_title = $settings['sub_title'];
$title_sec_margin = $settings['margin_bottom'];
$selectoption = $settings['selectoption'];
$button_text = $settings['button_text'];
$button_link = $settings['button_link'];
$riboontext=$settings['ribbon'];
$pagination = $settings['pagination'];
$productthumbvideo= get_theme_mod( 'thumbnail_video_play','show' );
$productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
$productvcontrol= get_theme_mod( 'thumb_video_control','minimal' );
$productcartshow= get_theme_mod( 'thumb_cart_button','hide' );
$productthumbhoverstyle= get_theme_mod( 'product_thmub_hover_style','style1' );
$categories= $settings['category'];
$downloads_category_not=$settings['categorynotin'];
$tags = $settings['tags'];


 if($settings['list_layout'] == '1/5'){
           $col_5_row = 'row-cols-1 row-cols-md-5';
       } else {
             $col_5_row = '';
       }
      ?>


<div class="edd_fetured_ark">
  
     <div class="ms--title--container">
        <div class="title--box--full" style="margin-bottom:<?php echo esc_attr($title_sec_margin); ?>;">
            <div class="title--promo--box">
                <h3 class="section-title"><?php echo $settings['title']; ?> </h3>
                <?php
                if ($sub_title ) { ?>
                     <p class="mayos--block--subtitle"><?php echo esc_attr($sub_title); ?></p>
                <?php } ?>
            </div>

            <div class="title--button--box">
                 <?php
                if ($selectoption=='button') { ?>
                
                <?php
                if ($button_link) { ?>
                    <a href="<?php echo esc_attr($button_link); ?>" class="btn title--box--btn"><?php echo esc_attr($button_text); ?></a>
                <?php } ?>
                <?php } else { ?>
                 <div class="regular-category-search">
            <select class="mayosis-filters-select">
                <option value=".all"><?php esc_html_e('All Categories','mayosis-core'); ?></option>
                            <?php

                            $taxonomy = 'download_category';
                            $args = array('orderby'=>'count','hide_empty'=>true, 'parent'   => 0,);
                            $terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy

                            if ( ! empty( $terms ) && is_array( $terms )  ) :
                                ?>

                                <?php foreach ( $terms as $term ) { ?>
                                <option value=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                            <?php } ?>
                            
                            <?php endif;?>

          
            </select>
        </div>
        <?php } ?>
            </div>
        </div>
       </div>
             <div class="row <?php echo esc_html($col_5_row); ?> <?php
                if ($selectoption=='category') { ?>gridbox<?php }?> <?php
                if ($pagination=='three') { ?>infinite-content-popular<?php }?>">
               
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
                            'post_type' => 'download',
                            'posts_per_page' => $post_count,
                            'paged' =>$paged,
                            'order' => (string)trim($post_order_term),
                             'orderby' => 'meta_value_num','meta_key' => 'hits'
                            );
						} else {
						    
						     $args = array(
                            'post_type' => 'download',
                            'posts_per_page' => $post_count,
                            'order' => (string)trim($post_order_term),
                             'orderby' => 'meta_value_num','meta_key' => 'hits'
                            
                            );
						}
         
          if(!empty($categories[0])) {
                  $args['tax_query'] = array(
                    array(
                      'taxonomy' => 'download_category',
                      'field'    => 'ids',
                      'terms'    => $categories
                    )
                  );
                }
                
                 if(!empty($tags[0])) {
                  $args['tax_query'] = array(
                    array(
                      'taxonomy' => 'download_tag',
                      'field'    => 'ids',
                      'terms'    => $tags
                    )
                  );
                }
                
                 if(!empty($downloads_category_not[0])) {
                  $args['tax_query'] = array(
                    array(
                      'taxonomy' => 'download_category',
                      'field'    => 'ids',
                      'terms'    => $downloads_category_not,
                      'operator' => 'NOT IN'
                    )
                  );
                }
         
         
         $the_query =new \WP_Query($args);
    while ($the_query -> have_posts()) : $the_query -> the_post();
    $max_num_pages = $the_query->max_num_pages;
          if ($pagination=='three') {
                                $scrollitem ='infinite-post-popular';
                            } else {
                                $scrollitem = '';
                            }
         ?>
         <?php if($settings['list_layout'] == '1/1'){ ?>
        <div class="col-md-12 col-xs-12 col-sm-12 element-item <?php echo $cls; ?> <?php echo $scrollitem; ?> all">
        <?php } elseif($settings['list_layout'] == '1/2'){ ?>
        <div class="col-md-6 col-xs-12 col-sm-6 element-item <?php echo $cls; ?> all <?php echo $scrollitem; ?>">
        <?php } elseif($settings['list_layout'] == '1/3'){ ?>
        <div class="col-md-4 col-xs-12 col-sm-4 element-item <?php echo $cls; ?> all <?php echo $scrollitem; ?>">
        <?php } elseif($settings['list_layout'] == '1/4'){ ?>
        <div class="col-md-3 col-xs-12 col-sm-3 element-item <?php echo $cls; ?> all <?php echo $scrollitem; ?>">
        <?php } elseif($settings['list_layout'] == '1/5'){ ?>
        <div class="col element-item <?php echo $cls; ?> all <?php echo $scrollitem; ?>">
        <?php } elseif($settings['list_layout'] == '1/6'){ ?>
        <div class="col-md-2 col-xs-12 col-sm-2 element-item <?php echo $cls; ?> all <?php echo $scrollitem; ?>">
            <?php } ?>
					<div <?php post_class(); ?>>
               <div class="grid_dm group edge">
               <div class="product-box">
                   <?php if($riboontext){ ?>
               <div class="wrap-ribbon left-edge point lblue"><span><?php echo esc_html($riboontext); ?></span></div>
               <?php } ?>
					  <figure class="mayosis-fade-in">
                        
                       
                    <?php if ($productthumbvideo=='show'){ ?>
                        <?php if ( has_post_format( 'video' )) { ?>
                       
                        <div class="mayosis--video--box">
                        <div class="video-inner-box-promo"> 
                        
                        <a href="<?php the_permalink();?>" class="mayosis-video-url"></a>
                            <div class="video-inner-main">
                                
                             <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
                         </div>
                         <div class="clearfix"></div>
                          <?php if ($productcartshow=='show'){ ?>
                            <div class="product-cart-on-hover">
                                	<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?> 
                            </div>
                          <?php }?>
                         <?php if ($productvcontrol=='minimal'){ ?>
                         <div class="minimal-video-control">
                             <div class="minimal-control-left">	
                             
                      <?php if ( function_exists( 'edd_favorites_load_link' ) ) {
                        edd_favorites_load_link( $download_id );
                    } ?>
                    </div>

                         
													
								<div class="minimal-control-right">	
													<ul>
											<li>	<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>  </li>
											<?php $mayosis_video = get_post_meta($post->ID, 'video_url',true);?>
											<li><a href="<?php echo esc_attr($mayosis_video); ?>" data-lity>
        <i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>
         
        </ul>
						</div>
                                                              
                         </div>
                         <?php } ?>
                         </div>
                     
                             
                    
                    
                        
                   
                        <?php } else { ?>
                        <div class="mayosis--thumb">
                          <?php get_template_part( 'includes/product-grid-thumbnail' ); ?>
                        <?php } ?>
                        
                       <?php } else { ?>
                       
                        <div class="mayosis--thumb">
                          <?php get_template_part( 'includes/product-grid-thumbnail' ); ?>
                       <?php } ?>
                        
                          <?php
                if ($productthumbhoverstyle=='style2') { ?>
                 <?php get_template_part( 'library/product-hover-style-two' ); ?>
                
                               <?php
                } elseif ($productthumbhoverstyle=='style3') { ?>
                
               <?php get_template_part( 'library/product-hover-style-three' ); ?>
                <?php } else { ?>
                <figcaption class="thumb-caption">
                            <div class="overlay_content_center">
                                <?php get_template_part( 'includes/product-hover-content-top' ); ?>

                                <div class="product_hover_details_button">
                                    <a href="<?php the_permalink(); ?>" class="button-fill-color"><?php esc_html_e('View Details', 'mayosis-core'); ?></a>
                                </div>
                                <?php
                                $demo_link = get_post_meta(get_the_ID(), 'demo_link', true);
                                $livepreviewtext= get_theme_mod( 'live_preview_text','Live Preview' );
                                ?>
                                <?php if ( $demo_link ) { ?>
                                    <div class="product_hover_demo_button">
                                        <a href="<?php echo esc_url($demo_link); ?>" class="live_demo_onh" target="_blank"><?php echo esc_html($livepreviewtext); ?></a>
                                    </div>
                                <?php } ?>

                                <?php get_template_part( 'includes/product-hover-content-bottom' ); ?>
                            </div>
                              </figcaption>
                            <?php } ?>
                      
                     </div>
                    </figure>
					<div class="product-meta">
                     <?php get_template_part( 'includes/product-meta' ); ?>
							
						</div>
				</div>	
				</div>
                   
                   </div>
						   
           </div>
         <?php endwhile; wp_reset_postdata(); ?>
    </div>
  <div class="mayo-page-product">
        <?php if ($pagination == 'two'|| $pagination == 'three'){ ?>
           
        <?php if ($pagination == 'three'){ ?>
            <a href="#" class="inf-load-more-popular"><?php echo $settings['load_more_text']; ?></a>
            
        <?php }?>
        
        <?php if ($pagination == 'three') {
            $stylenone = 'display:none';
        } else {
            $stylenone ='';
        } ?>
<div class="nav-links" style="<?php echo $stylenone;?>">
<?php mayosis_page_paging_nav($max_num_pages); ?>
</div>

</div>


      <?php

   }
   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_edd_popular );
?>