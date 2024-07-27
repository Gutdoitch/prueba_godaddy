<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_edd_tab extends Widget_Base {

    public function get_name() {
        return 'mayosis-edd-tab';
    }

    public function get_title() {
        return __( 'Mayosis EDD Tabbed', 'mayosis-core' );
    }
    public function get_categories() {
        return [ 'mayosis-ele-cat' ];
    }
    public function get_icon() {
        return 'eicon-elementor';
    }

    protected function register_controls() {
        
        $this->start_controls_section(
			'edd_tabbed',
			[
				'label' => __( 'EDD Tabbed Products', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tab_title', [
				'label' => __( 'Tab Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Recent Products' , 'plugin-domain' ),
				'label_block' => true,
			]
		);
        
        $repeater->add_control(
			'product_type',
			[
				'label' => __( 'Product Type', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'recent',
				'options' => [
					'recent'  => __( 'Recent', 'plugin-domain' ),
					'featured' => __( 'Featured', 'plugin-domain' ),
					'popular' => __( 'Popular', 'plugin-domain' ),
					'catgorized' => __( 'Category', 'plugin-domain' ),
				],
			]
		);
		
		 $repeater->add_control(
            'list_layout',
            [
                'label'     => esc_html_x( 'Layout', 'Admin Panel','mayosis-core' ),
                'description' => esc_html_x('Column layout for the list"', 'mayosis-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'    =>  "1/3",
                "options"    => array(
                    "1/1" => "1",
                    "1/2" => "2",
                    "1/3" => "3",
                    "1/4" => "4",
                    "1/6" => "6",
                ),
            ]

        );

	  $repeater->add_control(
            'order',
            [
                'label' => __( 'Order', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending'
                ],
                'default' => 'desc',

            ]
        );
		 $repeater->add_control(
            'item_per_page',
            [
                'label'   => esc_html_x( 'Amount of item to display', 'Admin Panel', 'mayosis-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' =>  "10",
                'section' => 'section_edd',
            ]
        );
		
	


		$this->add_control(
			'eddtab',
			[
				'label' => __( 'Repeater List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( 'Recent Products', 'plugin-domain' ),

					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'tab_style',
			[
				'label' => __( 'Tab Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		 $this->add_control(
         'active_color',
         [
            'label' => __( 'Color of Active Tab', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#54595f',
            'title' => __( 'Select Active Tab Color', 'mayosis-core' ),
            'selectors' => [
					'{{WRAPPER}} #tabs li a' => 'color: {{VALUE}};',
				],
            
         ]
      );
      
      $this->add_control(
         'inactive_color',
         [
            'label' => __( 'Color of Inactive Tab', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#848484',
            'title' => __( 'Select inactive Tab Color', 'mayosis-core' ),
            'selectors' => [
					'{{WRAPPER}} #tabs li a.inactive' => 'color: {{VALUE}};',
				],
            
         ]
      );
      $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_font',
				'label' => __( 'Tab Typography', 'mayosis-core' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #tabs li a',
			]
		);
        	$this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.

        $settings = $this->get_settings();
        
    	$tabs = $this->get_settings_for_display( 'eddtab' );
		$id_int = substr( $this->get_id_int(), 0, 3 );
		$productthumbvideo= get_theme_mod( 'thumbnail_video_play','show' );
        $productvideointer= get_theme_mod( 'product_video_interaction','full' );
        $productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
        $productvcontrol= get_theme_mod( 'thumb_video_control','minimal' );
        $productcartshow= get_theme_mod( 'thumb_cart_button','hide' );
        $productthumbhoverstyle= get_theme_mod( 'product_thmub_hover_style','style1' );
       $author = get_user_by( 'id', get_query_var( 'author' ) );
       $author_id=$post->post_author;
        ?>

<div class="edd_fetured_ark">
            <div class="mayosis-tabbed-content">
                
                <div class="mayosis-flex-tabbed-box">
                <ul id="tabs">
 <?php
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;
					
					$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'eddtab', $index );
					
					$mainid = 'elementor-tab-title-' . $id_int . $tab_count;

					$this->add_render_attribute( $tab_title_setting_key, [
						'id' => 'elementor-tab-title-' . $id_int . $tab_count,
				        'data-toggle' =>'tab',
						'data-tab' => $tab_count,
						'role' => 'tab',
						'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
					] );
					?>
					

					
					  <li><a id="<?php echo $mainid;?>"><?php echo $item['tab_title']; ?></a></li>
						<?php endforeach; ?>
						
					


</ul>

	   <div class="regular-category-search">
            <select class="mayosis-filters-select">
                <option value=".all"><?php esc_html_e('All Categories','mayosis-core'); ?></option>
                            <?php

                            $taxonomy = 'download_category';
                            $args = array('orderby'=>'count','hide_empty'=>true, 'parent'   => 0,);
                            $terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy

                            if ( $terms && !is_wp_error( $terms ) ) :
                                ?>

                                <?php foreach ( $terms as $term ) { ?>
                                <option value=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                            <?php } ?>
                            
                            <?php endif;?>

          
            </select>
        </div>
</div>

                  <?php
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;
					$tab_content_setting_key = $this->get_repeater_setting_key( 'product_type', 'eddtab', $index );
					
					$mainid = 'elementor-tab-title-' . $id_int . $tab_count;

					$this->add_render_attribute( $tab_content_setting_key, [
						'id' => 'elementor-tab-content-' . $id_int . $tab_count,
						'data-tab' => $tab_count,
						'role' => 'tabpanel',
						'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
					] );
					?>
          <div id="<?php echo $mainid;?>C" class="tab-container">
              
               <?php
                    $post_count= $item['item_per_page'];
                    $post_order_term= $item['order'];
                    $post_type= $item['product_type'];
                    $post_column= $item['list_layout'];
                    $grid_isotope= 'mayosis_tabbed_grid_' . $post_type;
                    ?>
                    <div class="row fix <?php echo $grid_isotope; ?>">
                    
                    
                     <?php
        global $post;
       if  ($post_type == 'recent') { 
        $args = array('post_type' => 'download', 'numberposts' => $post_count, 'order' => (string)trim($post_order_term),);
       } elseif  ($post_type == 'featured') {
           
            $args = array('post_type' => 'download', 'meta_key'  => 'edd_feature_download', 'numberposts' => $post_count, 'order' => (string)trim($post_order_term),);
            
            
       } elseif($post_type == 'popular'){
              $args = array( 'post_type' => 'download','numberposts' => $post_count, 'order' => (string) trim($post_order_term), 'orderby' => 'meta_value_num','meta_key' => 'hits');
           
       } elseif($post_type == 'catgorized'){
            $args = array(
                'post_type' => 'download',
                'numberposts' => $post_count,
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'download_category',
                        'field' => 'slug',
                        'terms' => array($downloads_category),
                        'operator' => 'IN'
                    ),
                    
                    array(
                        'taxonomy' => 'download_category',
                        'field' => 'slug',
                        'terms' => array($downloads_category_not),
                        'operator' => 'NOT IN'
                    ),
                    ),
                'order' => (string)trim($post_order_term),);
       }
        $recent_posts = get_posts( $args );
    foreach( $recent_posts as $post ){?>
     <?php
                            global $post;
                            $downlodterms = get_the_terms( $post->ID, 'download_category' );// Get all terms of a taxonomy
                            $cls = '';

                            if ( ! empty( $downlodterms ) ) {
                                foreach ($downlodterms as $term ) {
                                    $cls .= $term->slug . ' ';
                                }
                            }
                            ?>
        <?php if($post_column == '1/1'){ ?>
        <div class="col-md-12 col-xs-12 col-sm-12 element-item <?php echo $cls; ?> all">
        <?php } elseif($post_column == '1/2'){ ?>
        <div class="col-md-6 col-xs-12 col-sm-6 element-item <?php echo $cls; ?> all">
        <?php } elseif($post_column == '1/3'){ ?>
        <div class="col-md-4 col-xs-12 col-sm-4 element-item <?php echo $cls; ?> all">
        <?php } elseif($post_column == '1/4'){ ?>
        <div class="col-md-3 col-xs-12 col-sm-3 element-item <?php echo $cls; ?> all">
        <?php } elseif($post_column == '1/6'){ ?>
        <div class="col-md-2 col-xs-12 col-sm-2 element-item <?php echo $cls; ?> all">
            <?php } ?>

            <div class="grid_dm ribbon-box group edge">
                <div class="product-box">
                    <?php
                    $postdate = get_the_time('Y-m-d'); // Post date
                                $postdatestamp = strtotime($postdate); 
                                
                                $riboontext = get_theme_mod('recent_ribbon_text', 'New'); // Newness in days
                                
                                $newness = get_theme_mod('recent_ribbon_time', '30'); // Newness in days
                                if ((time() - (60 * 60 * 24 * floatval($newness))) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
                                    echo '<div class="wrap-ribbon left-edge point lblue"><span>' . esc_html($riboontext) . '</span></div>';
                                }
                    ?>
                    <figure class="mayosis-fade-in">
                        
                       
                    <?php if ($productthumbvideo=='show'){ ?>
                        <?php if ( has_post_format( 'video' )) { ?>
                       
                        <div class="mayosis--video--box">
                        <div class="video-inner-box-promo"> 
                        <a href="<?php the_permalink();?>" class="mayosis-video-url"></a>
                             <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
                            <div class="video-inner-main">
                  
                       
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
                <figcaption class="thumb-caption">
                <a href="<?php the_permalink();?>" class="full-thumb-hover-plus">
                <i class="zil zi-plus"></i>
                </a>
                </figcaption>
                
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
    <?php } ?>
    
    
    
    
    
  
     <?php  wp_reset_postdata();
        ?>
        </div>
              
          </div>
        
         <?php endforeach; ?>

         
         
                </div>

</div>

        <?php

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_edd_tab );
?>