<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_edd_carousel_Elementor extends Widget_Base {

    public function get_name() {
        return 'mayosis-edd-carousel';
    }

    public function get_title() {
        return __( 'Mayosis Download Carousel', 'mayosis-core' );
    }
    public function get_categories() {
        return [ 'mayosis-ele-cat' ];
    }
    public function get_icon() {
        return 'eicon-elementor';
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_edd',
            [
                'label' => __( 'Mayosis EDD Carousel', 'mayosis-core' ),
                'type' => Controls_Manager::SECTION,
            ]
        );

        $this->add_control(
            'c_style',
            [
                'label' => __( 'Style', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'one',
                
                'options' => [
                    'one' => __( 'Style One', 'elementor' ),
                    'two' => __( 'Style Two', 'elementor' ),
                ],
            ]
        );

        $this->add_control(
            'item_per_page',
            [
                'label'   => esc_html_x( 'Amount of item to display', 'Admin Panel', 'mayosis-core' ),
                'type'    => Controls_Manager::NUMBER,
                'default' =>  "10",
                
            ]
        );

        $this->add_control(
            'category',
            array(
                'label'       => esc_html__( 'Select Categories', 'mayosis-core' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                
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
                
            ]
        );

        $this->add_control(
            'tags',
            array(
                'label'       => esc_html__( 'Select Tags', 'mayosis-core' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                
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
            'pcarousel_column',
            [
                'label' => __( 'Column', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                
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
            'centered_slide',
            [
                'label' => __( 'Centered Slideshow', 'mayosis-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'mayosis-core' ),
                'label_off' => __( 'off', 'mayosis-core' ),
                
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'random_product',
            [
                'label' => __( 'Random Load Product', 'mayosis-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'mayosis-core' ),
                'label_off' => __( 'Hide', 'mayosis-core' ),
                
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'list_style_section',
            [
                'label' => __( 'Carousel Style', 'mayosis-core' ),
                'type' => Controls_Manager::SECTION,
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
        $this->add_control(
            'carousel_title_color',
            [
                'label' => __( 'Carousel Product Title Color', 'mayosis-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',

                'selectors' => [
                    '{{WRAPPER}} .m-carousel-title,{{WRAPPER}} .m-carousel-title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'carousel_title_typography',
                'label' => __( 'Carousel Product Title Typography', 'mayosis-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .m-carousel-title, {{WRAPPER}} .m-carousel-title a',
            ]
        );

        $this->add_control(
            'carousel_content_color',
            [
                'label' => __( 'Carousel Content Color', 'mayosis-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',

                'selectors' => [
                    '{{WRAPPER}} .mayo-p-carouselbox,{{WRAPPER}} .pcarousel-metabox,{{WRAPPER}} .pcarousel-metabox a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'carousel_content_typography',
                'label' => __( 'Carousel Content Typography', 'mayosis-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .mayo-p-carouselbox,{{WRAPPER}} .pcarousel-metabox,{{WRAPPER}} .pcarousel-metabox a',
            ]
        );

        $this->add_control(
            'carousel_product_price_color',
            [
                'label' => __( 'Carousel Product Price', 'mayosis-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',

                'selectors' => [
                    '{{WRAPPER}} .carousel-price,{{WRAPPER}} .carousel-price span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'carousel_product_price_typography',
                'label' => __( 'Carousel Product Price Typography', 'mayosis-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .carousel-price,{{WRAPPER}} .carousel-price span',
            ]
        );



        $this->add_control(
            'overlay_color',
            [
                'label' => __( 'Overlay Color', 'mayosis-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'separator' => 'before',
                'default' => 'rgb(4 31 59 / 49%)',
                'selectors' => [
                    '{{WRAPPER}} .mayo-p-slidebox:before' => 'background: {{VALUE}}',

                ],
            ]
        );



        $this->add_responsive_control(
            'carousel_border_radius',
            [
                'label' => __( 'Carousel Border Radius', 'plugin-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .carouselbox_product_thumbnail img,{{WRAPPER}} .mayo-p-carouselbox,{{WRAPPER}} .mayosis-carousel-item:hover .carouselbox_product_thumbnail,{{WRAPPER}} .mayosis-carousel-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'align_content',
            [
                'label' => __( 'Carousel Text Alignment', 'mayosis-core' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
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
                    'justify' => [
                        'title' => __( 'Justified', 'mayosis-core' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'prefix_class' => 'mayosis%s-align-',
                'selectors' => [
                    '{{WRAPPER}} .carousel-caption-product,{{WRAPPER}} .msuv-c-rating-main .edd_reviews_rating_box' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'overlay_bg',
                'label' => __( 'Overlay Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .carousel_overlay_mm,{{WRAPPER}} .msv-style-two-carousel-wrapper',
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __( 'Arrow Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#3c465a',
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
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'title-margin',
            [
                'label' => __( 'Title Gap', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 45,
                        'step' => 1,
                    ],

                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .m-carousel-title' => 'margin-bottom: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'rating_star_color',
            [
                'label' => __( 'Rating Star Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#F3A712',
                'selectors' => [
                    '{{WRAPPER}} .msuv-carousel-rating .edd_star_rating span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cd_image_box_shadow',
				'label' => __( 'Thumbnail Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .mayosis-carousel-item .carouselbox_product_thumbnail,{{WRAPPER}} .msv-style-two-carousel-wrapper img',
			]
		);
		
        $this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.

        $settings = $this->get_settings();
        $post_count = ! empty( $settings['item_per_page'] ) ? (int)$settings['item_per_page'] : 5;
        $post_order_term=$settings['order'];
        $categories= $settings['category'];
        $tags = $settings['tags'];
        $random = $settings['random_product'];
        $downloads_category_not=$settings['categorynotin'];
        $navigation = $settings['navigation'];
        $c_style = $settings['c_style'];
        $centered_slide = $settings['centered_slide'];
        $size = $settings['thums_size'];

        if ($centered_slide==="yes"){
            $msv_center_slides="msv_centered_carousel";
        } else {
            $msv_center_slides="";
        }
        ?>


        <div class="edd_recent_ark">

            <div class="full--grid-elementor">

                <div id="product--carousel--elementor--d" class="product--grid--elementor swiper-container swiper-container-initialized carousol-col-<?php echo $settings['pcarousel_column'];?>">

                    <div id="mayosis-full-product-carousel" class="swiper-wrapper mayosis-full-product-carousel <?php echo esc_html($msv_center_slides);?>">

                        <?php
                        global $post;

                        $args = array(
                            'post_type' => 'download',
                            'numberposts' => $post_count,
                            'order' => (string)trim($post_order_term),);


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

                        if($random === 'yes') {
                            $args = array(
                                'post_type' => 'download',
                                'numberposts' => $post_count,
                                'order' => (string)trim($post_order_term),
                                'orderby' => 'rand',
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

                        $recent_posts = get_posts( $args ); ?>

                        <?php foreach( $recent_posts as $post ){?>

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
                            $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                            <div class="mayosis-carousel-item swiper-slide">
                                <div class="mayo-p-carouselbox swiper-slide-inner">
                                    <?php  if($c_style=='two'){ ?>
                                    <div class="msv-style-two-carousel-wrapper">
                                        <div class="row msv-style-two-carousel align-items-center">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                            <div class="col-12 col-md-5 msv-thumbnail-carousel">
                                                
                                                    <div class="carouselbox_product_thumbnail_alt">
                                                        <a href="<?php
                                                        the_permalink(); ?>"> <?php
                                                            the_post_thumbnail( $size, array( 'class' => 'img-responsive' ) );
                                                            ?></a>
                                                    </div>
                                                
                                            </div>
                                            <?php endif; ?>
                                            <div class="col-12 col-md-7 msv-st-carousel-meta">
                                                <h3 class="m-carousel-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                                <div class="pcarousel-metabox">
                                            
                                            
                                           <span class="pcarousel-author"><span class="opacitydown75"><?php esc_html_e("by","mayosis"); ?></span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">
    								     
    								     
    								     <?php echo get_the_author_meta( 'display_name',$author_id);?>
    								     </a></span>
                                                    <span class="pcarousel-cats">
    								         <span class="opacitydown75"><?php esc_html_e("in","mayosis"); ?></span> <span><?php echo '<span>' . $download_cats . '</span>'; ?></span>
    								    </span>
                                                </div>

                                                <div class="carousel-count-download">

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
                                                            <div class="carousel-price carousel_promo_price"><?php
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

                                                <div class="msuv-carousel-rating msuv-rating-alt">
                                                    <?php if ( class_exists( 'EDD_Reviews' ) ) {

                                                        echo mayosis_avarage_rating();


                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                    <?php } else { ?>
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <div class="carouselbox_product_thumbnail">
                                                <a href="<?php
                                                the_permalink(); ?>"> <?php
                                                    the_post_thumbnail( $size, array( 'class' => 'img-responsive' ) );
                                                    ?></a>
                                            </div>
                                        <?php endif; ?>

                                        <a href="<?php the_permalink();?>" class="carousel_overlay_mm"></a>
                                        <div class="carousel-caption-product carousel-caption-effect">
                                            <div class="pcarousel-metabox">
                                            
                                            
                                           <span class="pcarousel-author"><span class="opacitydown75"><?php esc_html_e("by","mayosis"); ?></span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">
    								     
    								     
    								     <?php echo get_the_author_meta( 'display_name',$author_id);?>
    								     </a></span>
                                                <span class="pcarousel-cats">
    								         <span class="opacitydown75"><?php esc_html_e("in","mayosis"); ?></span> <span><?php echo '<span>' . $download_cats . '</span>'; ?></span>
    								    </span>
                                            </div>
                                            <h3 class="m-carousel-title"><?php the_title();?></h3>

                                            <div class="carousel-count-download">

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
                                                        <div class="carousel-price carousel_promo_price"><?php
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
                                            
                                            <div class="msuv-carousel-rating msuv-c-rating-main">
                                                    <?php if ( class_exists( 'EDD_Reviews' ) ) {

                                                        echo mayosis_avarage_rating();


                                                    } ?>
                                                </div>


                                        </div>

                                    <?php } ?>

                                </div>
                            </div>



                        <?php } ?>

                        <?php  wp_reset_postdata();
                        ?>



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
            </div>
        </div>
        <?php

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_edd_carousel_Elementor );
?>