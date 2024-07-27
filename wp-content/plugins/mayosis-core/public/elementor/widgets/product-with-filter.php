<?php
/**
 * @author TeconceTheme
 * @since   1.0
 * @version 1.0
 */

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class mayosis_woo_filter_product extends Widget_Base
{

    public function get_name() {
        return 'mayosis_woo_filter_product';
    }

    public function get_title() {
        return __('Filtered Products', 'mayosis-core');
    }

    public function get_categories() {
        return ['mayosis-ele-widgets-cat'];
    }

    public function get_icon() {
        return 'mayosiso-semi-solid cs-orange';
    }

    protected function register_controls() {

        $this->start_controls_section(
            'trending_woo_products_section',
            [
                'label' => __('Content', 'mayosis-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'item_per_page',
            [
                'label' => __('Number of Products to Show', 'mayosis-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 2,
                'max' => 1000,
                'step' => 1,
                'default' => 8,
            ]
        );
       

        $this->add_control(
            'margin_btm_col',
            [
                'label' => __('Column Bottom Margin', 'mayosis-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5,
                'step' => 1,
                'default' => 3,
            ]
        );


        $this->add_control(
            'filter_align',
            [
                'label' => esc_html__('Filter Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'justify-content-start',
                'options' => [

                    'justify-content-start' => esc_html__('Left', 'textdomain'),
                    'justify-content-end' => esc_html__('Right', 'textdomain'),

                    'justify-content-center' => esc_html__('Center', 'textdomain'),
                    'justify-content-between' => esc_html__('Justfied', 'textdomain'),

                ],

            ]
        );

        $this->add_control(
            'filter_title',
            [
                'label' => esc_html__('Section Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'textdomain'),
                'placeholder' => esc_html__('Type your title here', 'textdomain'),
            ]
        );


        $this->end_controls_section();
        
        
         $this->start_controls_section(
            'load_more_button_style',
            [
                'label' => __('Load More Style', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ldmore_labelx_typography',
                'label' => __('Load More Typography', 'mayosis-core'),
                'selector' => '{{WRAPPER}} .ajax-posts__load-more .js-load-more'

            ]
        );

        $this->start_controls_tabs(
            'ldmore_stl_main'
        );

        $this->start_controls_tab(
            'ldmorer_normal_state',
            [
                'label' => __('Normal', 'mayosis-core'),
            ]
        );

        $this->add_control(
            'ldmorer_bg_color',
            [
                'label' => esc_html__('Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ajax-posts__load-more .js-load-more' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ldmorer_text_color',
            [
                'label' => esc_html__('Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ajax-posts__load-more .js-load-more' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ldmore_border',
                'selector' => '{{WRAPPER}} .ajax-posts__load-more .js-load-more',
            ]
        );

        $this->add_control(
            'ldmore_bdx_radius',
            [
                'label' => __('Filter Border Radius', 'plugin-domain'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .ajax-posts__load-more .js-load-more' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();


        $this->start_controls_tab(
            'ldmore_hover_state',
            [
                'label' => __('Hover', 'mayosis-core'),
            ]
        );

        $this->add_control(
            'ldmore_bg_color_hvr',
            [
                'label' => esc_html__('Background Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ajax-posts__load-more .js-load-more:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ldmore_text_color_hvr',
            [
                'label' => esc_html__('Text Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ajax-posts__load-more .js-load-more:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ldmore_border_hvr',
                'selector' => '{{WRAPPER}} .ajax-posts__load-more .js-load-more:hover',
            ]
        );

        $this->add_control(
            'ldmore_bdx_radius_hvr',
            [
                'label' => __('Filter Border Radius', 'plugin-domain'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .ajax-posts__load-more .js-load-more:hover' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        
        
         $this->end_controls_section();
        


     


    }

    protected function render($instance = []) {

        $settings = $this->get_settings_for_display();
        $item_per_page = $settings['item_per_page'];
        $filter_align = $settings['filter_align'];
        $filter_title = $settings['filter_title'];


        ?>

        <div class="nik-store-filtered-items">
             <?php if ( class_exists( 'WooCommerce' ) ) { ?>
               <?php echo do_shortcode("[ttc_ajax_filter post_type='product' tax='product_cat' posts_per_page='$item_per_page'   filteralign='$filter_align' titlecontent='$filter_title']"); ?>
             <?php } else { ?>
               <?php echo do_shortcode("[ttc_ajax_filter post_type='download' tax='download_category' posts_per_page='$item_per_page'   filteralign='$filter_align' titlecontent='$filter_title']"); ?>
            <?php } ?>
        </div>


        <?php
    }


    protected function content_template() {
    }

    public function render_plain_content($instance = []) {
    }

}

Plugin::instance()->widgets_manager->register(new mayosis_woo_filter_product); ?>