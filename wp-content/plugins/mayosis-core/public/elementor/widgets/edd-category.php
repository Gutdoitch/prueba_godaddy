<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_edd_category_Elementor extends Widget_Base {

    public function get_name() {
        return 'mayosis-edd-category';
    }

    public function get_title() {
        return __( 'Mayosis Download Category', 'mayosis-core' );
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
                'label' => __( 'Mayosis Download Category', 'mayosis-core' ),
                'type' => Controls_Manager::SECTION,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Title', 'mayosis-core' ),
                'section' => 'section_edd',
            ]
        );



        $this->add_control(
            'custom_css',
            [
                'label' => __( 'Custom CSS', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Custom CSS name', 'mayosis-core' ),
                'section' => 'section_edd',
            ]
        );
        $this->add_control(
            'catstyle',
            [
                'label' => __( 'Category Style', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'grid' => 'Grid',
                    'list' => 'List'
                ],
                'default' => 'grid',

            ]
        );

        $this->add_control(
            'grid-col',
            [
                'label' => __( 'Grid Column', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    '2' => 'Two',
                    '3' => 'Three',
                    '4' => 'Four',
                    '5' => 'Five',
                    '6' => 'Six',


                ],
                'default' => '4',
                'condition' => [
                    'catstyle' => array('grid'),
                ],

            ]
        );
        
          $this->add_control(
            'grid-style',
            [
                'label' => __( 'Grid Style', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'style1' => 'Style One',
                    'style2' => 'Style Two',


                ],
                'default' => 'style1',
                'condition' => [
                    'catstyle' => array('grid'),
                ],

            ]
        );
        $this->add_control(
            'number_of_category',
            [
                'label' => __( 'Number of Category', 'mayosis-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'section' => 'section_edd',
                'default' => __( '', 'mayosis-core' ),
                'placeholder' => __( 'Input Number of Category', 'mayosis-core' ),
            ]
        );

        
   
        $this->add_control(
            'showcatwise',
            [
                'label' => __( 'Category Type', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'all' => 'All',
                    'parent' => 'Parent Category Wise'
                ],
                'default' => 'all',

            ]
        );

        $this->add_control(
            'parent_cat_slug',
            [
                'label' => __( 'Category ID', 'mayosis-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'section' => 'section_edd',
                'default' => __( '', 'mayosis-core' ),
                'placeholder' => __( 'Parent Category ID', 'mayosis-core' ),
                'condition' => [
                    'showcatwise' => array('parent'),
                ],
            ]
        );
        $this->add_control(
            'carousel',
            [
                'label' => __( 'Carousel', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'enable' => 'Enable',
                    'disable' => 'Disable'
                ],
                'default' => 'disable',
                'condition' => [
                    'catstyle' => array('grid'),
                ],

            ]
        );

        $this->add_control(
            'carousel-col',
            [
                'label' => __( 'Carousel Column', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    '3' => 'Three',
                    '4' => 'Four',
                    '5' => 'Five',
                    '6' => 'Six',
                    '7' => 'Seven',

                ],
                'default' => '3',
                'condition' => [
                    'catstyle' => array('grid'),
                ],

            ]
        );
        $this->add_control(
            'showtitleas',
            [
                'label' => __( 'Show Main Category as Title', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'hide' => 'Hide',
                    'show' => 'Show'
                ],
                'default' => 'hide',

                'condition' => [
                    'catstyle' => array('list'),
                ],

            ]

        );
        
        $this->add_control(
            'hide_empty_cats',
            [
                'label' => __( 'Hide Empty Category', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'true' => 'Hide',
                    'false' => 'Show'
                ],
                'default' => 'true',
                
                'condition' => [
                    'showtitleas' => array('show'),
                ],


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
            'list-col',
            [
                'label' => __( 'List Style Column', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'One',
                    '2' => 'Two',
                    '3' => 'Three',
                    '4' => 'Four',
                    '5' => 'Five',
                    '6' => 'Six',

                ],
                'default' => '3',
                'condition' => [
                    'catstyle' => array('list'),
                ],

            ]
        );



        $this->add_control(
            'list-style-text',
            [
                'label' => __( 'List Style Item Color', 'mayosis-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#54595f',
                'title' => __( 'Select Item Color', 'mayosis-core' ),
                'selectors' => [
                    '{{WRAPPER}} .list-download-cat a,{{WRAPPER}} .msuv-cat-title-w-style li ul.children a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'catstyle' => array('list'),
                ],

            ]
        );

        $this->add_control(
            'list-style-text-hover',
            [
                'label' => __( 'List Style Item Hover Color', 'mayosis-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#4054b2',
                'title' => __( 'Select Item Hover Color', 'mayosis-core' ),
                'selectors' => [
                    '{{WRAPPER}} .list-download-cat a:hover,{{WRAPPER}} .msuv-cat-title-w-style li ul.children a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'catstyle' => array('list'),
                ],

            ]
        );
        
        $this->add_control(
            'list-ttl-style-text',
            [
                'label' => __( 'List Title Color', 'mayosis-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#54595f',
                'title' => __( 'Select Item Color', 'mayosis-core' ),
                'selectors' => [
                    '{{WRAPPER}} .msuv-cat-title-w-style li a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'catstyle' => array('list'),
                ],

            ]
        );

        $this->add_control(
            'list-ttl--style-text-hover',
            [
                'label' => __( 'List Title Hover Color', 'mayosis-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#4054b2',
                'title' => __( 'Select Item Hover Color', 'mayosis-core' ),
                'selectors' => [
                    '{{WRAPPER}} .msuv-cat-title-w-style li a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'catstyle' => array('list'),
                ],

            ]
        );

      $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_title_typo',
                'label' => __( 'List Title Typography', 'mayosis-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .msuv-cat-title-w-style li a',
                'condition' => [
                    'catstyle' => array('list'),
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_text_typo',
                'label' => __( 'List Sub Category Typography', 'mayosis-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .list-download-cat a,{{WRAPPER}} .msuv-cat-title-w-style li ul.children a',
                'condition' => [
                    'catstyle' => array('list'),
                ],
            ]
        );


        $this->start_controls_tabs(
            'style_bg_tabs'
        );

        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => __( 'Normal', 'mayosis-core' ),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'cat_bg',
                'label' => __( 'Background', 'mayosis-core' ),
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .mayoelementor-grid--download--categories a.cat--grid--main::after,
				{{WRAPPER}} #grid-cat-edd .edd-cat-box-main::after,
				{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2',
            ]
        );
        $this->add_control(
            'normal_state_cat_color',
            [
                'label' => __(  'Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .mayoelementor-grid--download--categories a.cat--grid--main,
					{{WRAPPER}} #grid-cat-edd .edd-cat-box-main,
						{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2,
							{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2 span' => 'color: {{VALUE}}',
							
							'{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2 svg,
							{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2 svg path' => 'fill: {{VALUE}}',
								'{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2 svg,
							{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2 svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => __( 'Hover', 'mayosis-core' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'cat_bg_hover',
                'label' => __( 'Background', 'mayosis-core' ),
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .mayoelementor-grid--download--categories a.cat--grid--main:hover::after,
				{{WRAPPER}} #grid-cat-edd .edd-cat-box-main:hover::after,
					{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2:hover',
            ]
        );

        $this->add_control(
            'hover_state_cat_color',
            [
                'label' => __(  'Hover Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .mayoelementor-grid--download--categories a.cat--grid--main:hover,
					{{WRAPPER}} #grid-cat-edd .edd-cat-box-main:hover,
					{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2:hover,
					{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2:hover span' => 'color: {{VALUE}}',
						'{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2:hover svg,
							{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2:hover svg path' => 'fill: {{VALUE}}',
								'{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2:hover svg,
							{{WRAPPER}} #grid-cat-edd .cat--grid--stl-2:hover svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();



        $this->add_responsive_control(
            'cat_padding',
            [
                'label' => __( 'Grid Padding', 'mayosis-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mayoelementor-grid--download--categories a,
            					{{WRAPPER}} #grid-cat-edd .edd-cat-box-main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cat_br',
            [
                'label' => __( 'Grid Border Radius', 'mayosis-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mayoelementor-grid--download--categories a,{{WRAPPER}}
            					.mayoelementor-grid--download--categories a.cat--grid--main::after,
            					{{WRAPPER}} #grid-cat-edd .edd-cat-box-main,
            					{{WRAPPER}} #grid-cat-edd .edd-cat-box-main::after,
            					{{WRAPPER}} #grid-cat-edd .edd-cat-box-main .edd-cat-overlay-img,
            					{{WRAPPER}} #grid-cat-edd a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cat_typo',
                'label' => __( 'Typography', 'mayosis-core' ),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .mayoelementor-grid--download--categories a,
				{{WRAPPER}} #grid-cat-edd .edd-cat-box-main',
            ]
        );

        $this->add_responsive_control(
            'cat_gap',
            [
                'label' => __( 'Grid Gap', 'mayosis-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mayoelementor-grid--download--categories .mayo-grid-box-elementor-cats' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.

        $settings = $this->get_settings();
        $custom_css = $settings['custom_css'];
        $recent_section_title = $settings['title'];
        $catstyle = $settings['catstyle'];
        $carousel_enable = $settings['carousel'];
        $listcol = $settings['list-col'];
        $amount=$settings['number_of_category'];
        $hide_empty_cats= $settings['hide_empty_cats'];
        $showcid=$settings['showcatwise'];
        $pid=$settings['parent_cat_slug'];
        $curoselcol = $settings['carousel-col'];
        $gridcol = $settings['grid-col'];
        $showtitleas = $settings['showtitleas'];
        $gridstyle = $settings['grid-style'];
      
       
     
        ?>


        <div class="<?php
        echo esc_attr($custom_css); ?>">
            <h2 class="section-title"><?php echo esc_attr($recent_section_title); ?> </h2>
            <?php if ($catstyle=='list'){ ?>
            <div class="grid--download--list col-count-<?php echo $listcol; ?>">
                <?php if($showtitleas=="show"){ 
                if  ($hide_empty_cats == "false"){
                        $ttlcatarg = array( 'taxonomy' => 'download_category', 'title_li' => "",'hide_title_if_empty' => false,'hide_empty' => false,'number' => $amount,);
                    } else {
                        $ttlcatarg = array( 'taxonomy' => 'download_category', 'title_li' => "", 'number' => $amount,);
                    }
                ?>
                    <ul class="msuv-cat-title-w-style">
                        <?php echo wp_list_categories( $ttlcatarg ); ?>
                    </ul>
                   
                <?php } else { ?>
                    <?php if($showcid=='parent'){
                    
                    
                    ?>
                    
                   
                        <?php $categories=get_categories( array( 'taxonomy' => 'download_category','parent' => $pid, 'number' => $amount,)); ?>
                    <?php } else{ ?>
                        <?php $categories=get_categories(
                            array( 'taxonomy' => 'download_category', 'number' => $amount, )
                        ); ?>

                    <?php } ?>
                    <?php foreach ( $categories as $term ) : ?>
                        <?php $category_grid_image = get_term_meta( $term->term_id, 'category_image_main', true); ?>
                        <div class="list-download-cat">
                            <a href="<?php echo esc_attr( get_term_link( $term, $taxonomy ) ); ?>" title="<?php echo $term->name; ?>"><span><?php echo $term->name; ?></span></a>
                        </div>
                    <?php endforeach; ?>

                <?php }?>
 </div>
            <?php }  else { ?>

                <?php if ($carousel_enable=='enable'){ ?>

                    <?php if($showcid=='parent'){?>
                        <?php $categories=get_categories(
                            array( 'taxonomy' => 'download_category','parent' => $pid, 'number' => $amount, )
                        ); ?>
                    <?php } else{ ?>
                        <?php $categories=get_categories(
                            array( 'taxonomy' => 'download_category', 'number' => $amount, )
                        ); ?>

                    <?php } ?>
<div class="cat-carousel-ms-ls-v">
                    <div id="carousel-category-msv-elmentor" class="edd-category-grid-carousel  swiper-container grid-cat-edd-<?php echo $curoselcol;?>">

                        <div id="grid-cat-edd" class="swiper-wrapper grid-cat-edd">
                            <?php foreach ( $categories as $term ) : ?>
                             <?php 
                             
                             $category_grid_image = get_term_meta( $term->term_id, 'category_image_main', true); 
                             $path= $category_grid_image;
                            $e = pathinfo($path, PATHINFO_EXTENSION);
                             
                             
                             ?>
                            <?php if($gridstyle=="style2"){ ?>
                            
                            <a href="<?php echo esc_attr( get_term_link( $term ) ); ?>" title="<?php echo $term->name; ?>"  class="swiper-slide cat--grid--stl-2">
                                    <div class="edd-cat-box-main-stl2">
                                        <div class="edd-cat-box-main-stl2-img">
                                         <?php if($e == "svg") { ?>
                                                    <?php echo file_get_contents( $path ); ?>
                                                    <?php } else { ?>
                                        <img src="<?php echo $category_grid_image; ?>" alt="cat image">
                                        <?php } ?>
                                        </div>
                                        <span><?php echo $term->name; ?></span>
                                       

                                    </div></a>
                            
                            <?php } else { ?>
                               
                                <a href="<?php echo esc_attr( get_term_link( $term ) ); ?>" title="<?php echo $term->name; ?>"  class="swiper-slide cat--grid--main">
                                    <div class="edd-cat-box-main"><span><?php echo $term->name; ?></span>
                                        <div class="edd-cat-overlay-img" style="background:url(<?php echo $category_grid_image; ?>)">
                                        </div>

                                    </div></a>
                                    <?php } ?>

                            <?php endforeach; ?>
                        </div>
                       
                    </div>
    <?php if($gridstyle=="style2"){ ?>
                       
					<?php } else { ?>
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

                <?php } else { ?>

                    <?php if($showcid=='parent'){?>
                        <?php $categories=get_categories(
                            array( 'taxonomy' => 'download_category','parent' => $pid, 'number' => $amount)
                        ); ?>
                    <?php } else{ ?>
                    
             
                        <?php 
                       
                        $categories=get_categories(
                            array( 'taxonomy' => 'download_category', 'number' => $amount, )
                        ); ?>

                    <?php } ?>

                    <div class="mayoelementor-grid--download--categories mayosis-cat--grid-col-<?php echo $gridcol;?>">
                        <?php foreach ( $categories as $term ) : ?>
                            <?php $category_grid_image = get_term_meta( $term->term_id, 'category_image_main', true); ?>
                                    
                            <div class="mayo-grid-box-elementor-cats">
                                <a href="<?php echo esc_attr( get_term_link( $term ) ); ?>" title="<?php echo $term->name; ?>" style="background:url(<?php echo $category_grid_image; ?>)" class="cat--grid--main"><span><?php echo $term->name; ?></span></a>
                            </div>

                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            <?php } ?>

        </div>


        <?php

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_edd_category_Elementor );
?>