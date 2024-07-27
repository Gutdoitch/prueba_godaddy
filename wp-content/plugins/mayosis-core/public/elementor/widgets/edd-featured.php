<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_edd_Elementor_Thing extends Widget_Base {

    public function get_name() {
        return 'mayosis-edd-featured';
    }

    public function get_title() {
        return __( 'Mayosis Featured Grid', 'mayosis-core' );
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
                'label' => __( 'Mayosis EDD Featured', 'mayosis-core' ),
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
                    "1/6" => "6",
                ),
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
			'sub_title_color',
			[
				'label' => __( 'Sub Title Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayos--block--subtitle' => 'color: {{VALUE}}',
				],
			]
		);
	
$this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.

        $settings = $this->get_settings();
        $post_count = ! empty( $settings['item_per_page'] ) ? (int)$settings['item_per_page'] : 5;
        $recent_section_title = $settings['title'];
        $post_order_term=$settings['order'];
        $sub_title = $settings['sub_title'];
        $title_sec_margin = $settings['margin_bottom'];
        $button_text = $settings['button_text'];
        $button_link = $settings['button_link'];
        $productthumbvideo= get_theme_mod( 'thumbnail_video_play','show' );
        $productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
        $productvcontrol= get_theme_mod( 'thumb_video_control','minimal' );
        $productcartshow= get_theme_mod( 'thumb_cart_button','hide' );
        $productthumbhoverstyle= get_theme_mod( 'product_thmub_hover_style','style1' );
        ?>


        <div class="edd_fetured_ark">

        <div class="full--grid-elementor">
        <div class="title--box--full" style="margin-bottom:<?php echo esc_attr($title_sec_margin); ?>;">
            <div class="title--promo--box">
                <h3 class="section-title"><?php echo esc_attr($recent_section_title); ?> </h3>
                <?php
                if ($sub_title ) { ?>
                   <p class="mayos--block--subtitle"><?php echo esc_attr($sub_title); ?></p>
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
        $args = array( 'post_type' => 'download','numberposts' => $post_count, 'order' => (string) trim($post_order_term),  'meta_key' => 'edd_feature_download',);
        $recent_posts = get_posts( $args );
    foreach( $recent_posts as $post ){?>
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
            <?php } ?>
            <div <?php post_class(); ?>>
            <div class="grid_dm group edge">
                <div class="product-box">
                    <?php $postdate = get_the_time('Y-m-d'); // Post date
                    $postdatestamp = strtotime($postdate);

                    $riboontextfet = get_theme_mod('featured_ribbon_text', 'Featured'); // Newness in days

                    $newnessfet = get_theme_mod('featured_ribbon_time', '30'); // Newness in days
                    if ((time() - (60 * 60 * 24 * $newnessfet)) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
                        echo '<div class="wrap-ribbon left-edge point lblue"><span>' . esc_html($riboontextfet) . '</span></div>';
                    } ?>
                         <figure class="mayosis-fade-in">
                        
                       
                    <?php if ($productthumbvideo=='show'){ ?>
                        <?php if ( has_post_format( 'video' )) {
                        $mayosis_video = get_post_meta($post->ID, 'video_url',true);
                        
                        if (strpos($mayosis_video,'youtube.com')==true){
                            $mayosis_video_cls="mayosis-youtube-hosted-video";
                            
                        } elseif (strpos($mayosis_video,'vimeo')==true){
                            $mayosis_video_cls="mayosis-vimeo-hosted-video";
                            
                        } elseif (strpos($mayosis_video, "mediadelivery") == true) {
                                                    $mayosis_video_cls =
                                                        "mayosis-mediadelivery-hosted-video";
                        } else {
                            
                            $mayosis_video_cls="mayosis-self-hosted-video";
                            
                        }
                        
                        ?>
                       
                        <div class="mayosis--video--box <?php echo esc_html($mayosis_video_cls);?>">
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
    <?php } ?>
        <?php  wp_reset_postdata();
        ?>
        </div>
        </div>
                                </div>

        <?php

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_edd_Elementor_Thing );
?>