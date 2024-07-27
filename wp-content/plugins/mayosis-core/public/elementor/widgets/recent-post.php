<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_blog_Elementor_Thing extends Widget_Base {

   public function get_name() {
      return 'mayosis-blog-grid';
   }

   public function get_title() {
      return __( 'Mayosis Blog Post', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-posts-grid';
   }

   protected function register_controls() {

      $this->add_control(
         'section_blog_posts',
         [
            'label' => __( 'mayosis Blog Posts', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'section_heading',
         [
            'label' => __( 'Heading', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'title' => __( 'Enter Section Headings', 'mayosis-core' ),
            'section' => 'section_blog_posts',
         ]
      );

       $this->add_control(
           'sub_title',
           [
               'label' => __( 'Sub Title', 'mayosis-core' ),
               'type' => Controls_Manager::TEXT,
               'default' => '',
               'title' => __( 'Enter Sub Title', 'mayosis-core' ),
               'section' => 'section_blog_posts',
           ]
       );
       
       $this->add_control(
    			'list_style',
    			[
    				'label'     => esc_html_x( 'Blog Style', 'Admin Panel','mayosis-core' ),
    				'description' => esc_html_x('Style For Blog Post"', 'mayosis-core' ),	
    				'type'      =>  Controls_Manager::SELECT,
    				'default'    =>  "style1",
    				'section' => 'section_blog_posts',
    				"options"    => array(
    									"style1" => "Style One",
    									"style2" => "Style Two",													
    								
    								),				
    			]
    		 
    		);
    $this->add_control(
    			'list_layout',
    			[
    				'label'     => esc_html_x( 'Layout', 'Admin Panel','mayosis-core' ),
    				'description' => esc_html_x('Column layout for the list"', 'mayosis-core' ),	
    				'type'      =>  Controls_Manager::SELECT,
    				'default'    =>  "1/1",
    				'section' => 'section_blog_posts',
    				"options"    => array(
    									"1/1" => "1",
    									"1/2" => "2",													
    									"1/3" => "3",													
    									"1/4" => "4",		 											
    									"1/6" => "6",
    								),				
    			]
    		 
    		);
		
      $this->add_control(
				'item_per_page',
				[
					'label'   => esc_html_x( 'Amount of item to display', 'Admin Panel', 'mayosis-core' ),
					'type'    => Controls_Manager::NUMBER,
					'default' =>  "10",
                    'section' => 'section_blog_posts',
				]
		);  
		
		$this->add_control(
            'category',
            [
                'label' => __( 'Category Name', 'mayosis-core' ),
                'description' => __('Comma separated list of category Name','mayosis-core'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                 'section' => 'section_blog_posts',
            ]
        );

       $this->add_control(
           'margin_bottom',
           [
               'label' => __( 'Title Section Margin Bottom (With px)', 'mayosis-core' ),
               'description' => __('Add Margin Bottom','mayosis-core'),
               'type' => Controls_Manager::TEXT,
               'default' => '20px',
               'section' => 'section_blog_posts',
           ]
       );

       $this->add_control(
           'button_text',
           [
               'label' => __( 'Button Text', 'mayosis-core' ),
               'type' => Controls_Manager::TEXT,
               'default' => '',
               'title' => __( 'Enter Button Text', 'mayosis-core' ),
               'section' => 'section_blog_posts',
           ]
       );


       $this->add_control(
           'button_link',
           [
               'label' => __( 'Button URL', 'mayosis-core' ),
               'type' => Controls_Manager::TEXT,
               'default' => '',
               'title' => __( 'Enter Button URL', 'mayosis-core' ),
               'section' => 'section_blog_posts',
           ]
       );


       $this->add_control(
            'order',
            [
                'label' => __( 'Order', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_blog_posts',
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
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .section-title',
			]
		);
		
		$this->add_control(
            'title_color',
            [
                'label' => esc_html__('Blog Title Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-title a' => 'color: {{VALUE}}',
                
                ],
                

            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'blog_title_typo',
				'label' => __( 'Blog Title Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .blog-title a,
				{{WRAPPER}} .blog-title',
			]
		);
	$this->add_control(
            'meta_color',
            [
                'label' => esc_html__('Meta Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .user-info,
                    {{WRAPPER}} .user-info a,
                    {{WRAPPER}} .user-info span' => 'color: {{VALUE}}',
                
                ],
                

            ]
        );
$this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
        $post_count = ! empty( $settings['item_per_page'] ) ? (int)$settings['item_per_page'] : 5;
        $posts_category= $settings['category'];
        $post_order_term=$settings['order'];
       $recent_section_title = $settings['section_heading'];
       $sub_title = $settings['sub_title'];
       $title_sec_margin = $settings['margin_bottom'];
       $button_text = $settings['button_text'];
       $button_link = $settings['button_link'];
       $blogstyle = $settings['list_style'];
      ?>


<div class="elementor-recent-post">
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
             <div class="row fix">
               
                   <?php
                   global $post;
                   $args =  array(
                    'post_type'      => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => $post_count,
                    'order' => (string) trim($post_order_term),
                    );

                    if(!empty($posts_category[0])) {
                        $args['tax_query'] = array(
                          array(
                            'taxonomy' => 'category',
                           'terms'    => $posts_category,
                          )
                        );
                      }
         $the_query = new \WP_Query($args);
         if($the_query->have_posts()){
            while($the_query->have_posts()){
               $the_query->the_post();?>
         <?php if($settings['list_layout'] == '1/1'){ ?>
          <div class="col-md-12 col-xs-12 col-sm-12">
          <?php } elseif($settings['list_layout'] == '1/2'){ ?>
           <div class="col-md-6 col-xs-12 col-sm-6">
         <?php } elseif($settings['list_layout'] == '1/3'){ ?>
         <div class="col-md-4 col-xs-12 col-sm-4">
        <?php } elseif($settings['list_layout'] == '1/4'){ ?>
          <div class="col-md-3 col-xs-12 col-sm-3">
         <?php } elseif($settings['list_layout'] == '1/6'){ ?>
            <div class="col-md-2 col-xs-12 col-sm-2">
                    <?php } 
                     global $post;
                    
                    ?>
                    <?php if($blogstyle=="style2"){
                     $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                    ?>
                    <div class="blog-box-stl2">
                     
                        <div class="blog-meta">
				
							<h4 class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<div class="meta-bottom">
								<div class="user-info">
									<span><?php esc_html_e('by','mayosis-core'); ?></span> 	<a href="<?php
	echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php
	the_author(); ?></a> <span><?php esc_html_e('in','mayosis-core'); ?></span>	<?php mayosis_category_list(); ?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="blog-details-stl-2">
							    <?php echo mayosis_excerpt(18)?>
							</div>
							
							<a class="blg-stle2-btn" href="<?php the_permalink();?>"><?php esc_html_e('Read More','mayosis-core');?> <i class=" isax icon-arrow-right-11"></i></a>
						</div>
						
						   <div class="blog-style2-hover-img" style="background:url(<?php echo esc_url($featured_img_url);?>);">
				    
				</div>
                    </div>
                    <?php } else { ?>
               <div class="blog-box grid_dm">
							<figure class="mayosis-fade-in">
							
								<?php
								// display featured image?
								if ( has_post_thumbnail() ) :
									the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
								endif; 

							?>                                                   
						
							<figcaption>
							    <div class="overlay_content_center blog_overlay_content">
							    <a href="<?php the_permalink(); ?>"><i class="zil zi-plus"></i></a>
							    </div>
							</figcaption>
						</figure>
						<div class="clearfix"></div>
	
						<div class="blog-meta">
				
							<h4 class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<div class="meta-bottom">
								<div class="user-info">
									<span><?php esc_html_e('by','mayosis-core'); ?></span> 	<a href="<?php
	echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php
	the_author(); ?></a> <span><?php esc_html_e('in','mayosis-core'); ?></span>	<?php mayosis_category_list(); ?>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div><!-- .blog box -->
					<?php } ?>
           </div>
         <?php } } ?>
         <?php  wp_reset_postdata();
         ?>
    </div>

     
            </div>




      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_blog_Elementor_Thing );
?>