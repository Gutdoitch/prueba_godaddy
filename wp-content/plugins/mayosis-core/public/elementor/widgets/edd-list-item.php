<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_edd_list_Elementor extends Widget_Base {

    public function get_name() {
        return 'mayosis-edd-list';
    }

    public function get_title() {
        return __( 'Mayosis Download List', 'mayosis-core' );
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
                'label' => __( 'Mayosis EDD List', 'mayosis-core' ),
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
            'item_per_page',
            [
                'label'   => esc_html_x( 'Amount of item to display', 'Admin Panel', 'mayosis-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' =>  "10",
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
            'button_text',
            [
                'label' => __( 'Button Text', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Button Text', 'mayosis-core' ),
                'section' => 'section_edd',
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
                    ]
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
                'condition' => [
                    'show_single' => array('recent'),
                ],

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
         
        
         $this->end_controls_section();
         
       $this->start_controls_section(
                 'list_style_section',
         [
            'label' => __( 'List Style', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      
      
      
      $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'list_background',
				'label' => __( 'List Post Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .mayosis_list_product',
				
			]
		);
      
      $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_border',
				'label' => __( 'List Post Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .mayosis_list_product',
			]
		);
      
       $this->add_control(
			'list_text_color',
			[
				'label' => __( 'List Text Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#1e3c78',
				
				'selectors' => [
					'{{WRAPPER}} .mayosis_list_product,{{WRAPPER}} .mayosis_list_product a,{{WRAPPER}} .list-count-download .promo_price' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->start_controls_tabs( 'tabs_load_style' );
		
		    $this->start_controls_tab(
			'purchase_button',
			[
				'label' => __( 'Purchase Button', 'mayosis-core' ),
			]
		);
		      $this->add_control(
			'purchase_button_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#1e3c78',
				'selectors' => [
					'{{WRAPPER}} .list_button_details .edd-add-to-cart, {{WRAPPER}} .list_button_details .edd-fd-button, {{WRAPPER}} .list_button_details .edd-submit, {{WRAPPER}} .list_button_details .edd-submit.button.blue, {{WRAPPER}} .list_button_details .edd_go_to_checkout.button,{{WRAPPER}} .list_button_details .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js' => 'background-color: {{VALUE}}',
					
						
				],
			]
		);
		
		 $this->add_control(
			'purchase_buttonborder_color',
			[
				'label' => __( 'Border Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#1e3c78',
				'selectors' => [
					'{{WRAPPER}} .list_button_details .edd-add-to-cart, {{WRAPPER}} .list_button_details .edd-fd-button, {{WRAPPER}} .list_button_details .edd-submit, {{WRAPPER}} .list_button_details .edd-submit.button.blue, {{WRAPPER}} .list_button_details .edd_go_to_checkout.button,{{WRAPPER}} .list_button_details .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js' => 'border-color: {{VALUE}}',
					
						
				],
			]
		);
		
		 $this->add_control(
			'purchase_button_txt_color',
			[
				'label' => __( 'Text Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .list_button_details .edd-add-to-cart, {{WRAPPER}} .list_button_details .edd-fd-button, {{WRAPPER}} .list_button_details .edd-submit, {{WRAPPER}} .list_button_details .edd-submit.button.blue, {{WRAPPER}} .list_button_details .edd_go_to_checkout.button,{{WRAPPER}} .list_button_details .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js' => 'color: {{VALUE}}',
					
				],
			]
		);
		$this->end_controls_tab();
		
		
		
		  $this->start_controls_tab(
			'demo_button',
			[
				'label' => __( 'Preview Button', 'mayosis-core' ),
			]
		);
		      $this->add_control(
			'preview_button_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#A10A8000',
				'selectors' => [
					'{{WRAPPER}} .list_button_details a' => 'background-color: {{VALUE}}',
					
						
				],
			]
		);
		
		 $this->add_control(
			'preview_buttonborder_color',
			[
				'label' => __( 'Border Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => 'rgb(30 60 120 / 0.5)',
				'selectors' => [
					'{{WRAPPER}} .list_button_details a' => 'border-color: {{VALUE}}',
					
						
				],
			]
		);
		
		 $this->add_control(
			'preview_button_txt_color',
			[
				'label' => __( 'Text Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				 'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .list_button_details a' => 'color: {{VALUE}}',
					
				],
			]
		);
		$this->end_controls_tab();
			
			
		$this->end_controls_tabs();
		
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
        $recent_section_title = $settings['title'];
        $post_count = ! empty( $settings['item_per_page'] ) ? (int)$settings['item_per_page'] : 5;
        $post_order_term=$settings['order'];
        $sub_title = $settings['sub_title'];
        $title_sec_margin = $settings['margin_bottom'];
        $button_text = $settings['button_text'];
        $button_link = $settings['button_link'];
        $pagination = $settings['pagination'];
        ?>


        <div class="edd_recent_ark">

        <div class="full--grid-elementor">
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
                        <a href="<?php echo esc_attr($button_link); ?>" class="btn title--box--btn"><?php echo esc_attr($button_text); ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="product--grid--elementor <?php
                if ($pagination=='three') { ?>infinite-content<?php }?>">
               
                
             
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
                            'order' => (string)trim($post_order_term),);
						} else {
						    
						     $args = array(
                            'post_type' => 'download',
                            'posts_per_page' => $post_count,
                            'order' => (string)trim($post_order_term),);
						}
    
                
                 $the_query =new \WP_Query($args);
    while ($the_query -> have_posts()) : $the_query -> the_post();
    $max_num_pages = $the_query->max_num_pages;
    ?>
                   
                   
                    <?php
                       global $post;
                    $author = get_user_by( 'id', get_query_var( 'author' ) );
                     $author_id=$post->post_author;
                      $download_cats = get_the_term_list( get_the_ID(), 'download_category', '', _x(' , ', '', 'mayosis-core' ), '' );
                      $productfreeoptins= get_theme_mod( 'product_free_options','custom' );
                      $productcustomtext= get_theme_mod( 'free_text','FREE' );
                      $envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );

                        if ($envato_item_id){
                         $api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
                        $item_price = $api_item_results_json['price_cents'];
                         $item_url = $api_item_results_json['url'];
                         $item_number_of_sales = $api_item_results_json['number_of_sales'];
                        }
                        
                        global $edd_logs;
															$single_count = $edd_logs->get_log_count(66, 'file_download');
															$total_count  = $edd_logs->get_log_count('*', 'file_download');
                                                            $sales = edd_get_download_sales_stats( get_the_ID() );
                                                            $sales = $sales > 1 ? $sales . ' sales' : $sales . ' sale';
                                        $price = edd_get_download_price(get_the_ID());
                                        
                                         if ($pagination=='three') {
                                $scrollitem ='infinite-post';
                            } else {
                                $scrollitem = '';
                            }
                ?>
                    <div class="mayosis_list_product <?php echo $scrollitem; ?>">
                          <div class="list-mayosis-first-part">
                              <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="list_product_thumbnail">
                                       <a href="<?php
                                                    the_permalink(); ?>"> <?php
                                            the_post_thumbnail( 'mayosis-grid-list', array( 'class' => 'img-responsive' ) );
                                            ?></a>
                                    </div>
                                    <?php endif; ?>
                                    <div class="list_product_details">
                                        <h4><a href="<?php
                                                    the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                     
                                        <div class="list-metabox">
                                            
                                            
                                           <span class="list-author"><span class="opacitydown75"><?php esc_html_e("by","mayosis"); ?></span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">
    								     
    								     
    								     <?php echo get_the_author_meta( 'display_name',$author_id);?>
    								     </a></span>
    								     <span class="list-cats">
    								         <span class="opacitydown75"><?php esc_html_e("in","mayosis"); ?></span> <span><?php echo '<span>' . $download_cats . '</span>'; ?></span>
    								    </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="list_price_details">
                                     	<div class="list-count-download">
								    
								     <?php if ($envato_item_id) { ?>
								     <span><?php esc_html_e('$','mayosis-core');?><?php echo number_format(($item_price /100), 2, '.', ' ');?></span>
								     <?php } else { ?>
								 <?php if( $price == "0.00"  ){ ?>
								 <?php if ($productfreeoptins=='none'): ?>		
									<span><?php edd_price(get_the_ID()); ?></span>
								<?php else: ?>
								    <span><?php echo esc_html($productcustomtext); ?></span>
								<?php endif;?>
								
								
									 <?php } else { ?>
                       <div class="product-price promo_price"><?php
				if(edd_has_variable_prices(get_the_ID())){
					echo edd_price_range( get_the_ID() );
				}
				else{
					edd_price(get_the_ID());
				}
					?></div>
                    <?php } ?>
                    <?php } ?>
									
								</div>
                                    </div>
                                    
                                    <div class="list_publish_date">
                                        <span><?php echo esc_html(get_the_date()); ?></span>
                                    </div>
                                <div class="list_button_details">
                                    
                      			 <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>  
                                      <?php $demo_link =  get_post_meta($post->ID, 'demo_link', true); ?>
       <?php if ( $demo_link ) { ?>
                      
                         
                               <a href="<?php echo esc_html($demo_link); ?>" class="list-preview-button" target="_blank"><i class="zil zi-eye"></i> 	<?php esc_html_e('Preview', 'mayosis-core');?></a>
                                 
                        
              
                     <?php } ?>
                                    </div>
                            </div>

                     <?php endwhile; wp_reset_postdata(); ?>
            </div>

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

</div>

        </div>
        <?php
}
    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_edd_list_Elementor );
?>