<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_cart extends Widget_Base {

    public function get_name() {
        return 'mayosis-product-cart';
    }

    public function get_title() {
        return __( 'Mayosis Product Cart', 'mayosis-core' );
    }
    public function get_categories() {
        return [ 'mayosis-product-elements' ];
    }
    public function get_icon() {
        return 'eicon-product-add-to-cart';
    }

    protected function register_controls() {
        $this->start_controls_section(
            'mayosis_product_cart',
            [
                'label' => __( 'Product Cart Style', 'mayosis-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_responsive_control(
            'product_button_align',
            [
                'label'        => __( 'Alignment', 'mayosis-core' ),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'flex-start'   => [
                        'title' => __( 'Left', 'mayosis-core' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'mayosis-core' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end'  => [
                        'title' => __( 'Right', 'mayosis-core' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    
                    'mayosis-cart-justify'  => [
                        'title' => __( 'Justify', 'mayosis-core' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'prefix_class' => 'elementor-align-%s',
                'default'      => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-single-b-cart' => 'justify-content: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'variation_style',
            [
                'label' => __( 'Variable Pricing Type', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal'  => __( 'Normal', 'plugin-domain' ),
                    'popup' => __( 'Popup', 'plugin-domain' ),
                    'button' => __( 'Button', 'plugin-domain' ),

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'product_button_typography',
                'label'     => __( 'Add to Cart Typography', 'mayosis-core' ),
                'selector'  => '{{WRAPPER}} .mayosis-single-b-cart .edd-add-to-cart,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-fd-button,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit.button.blue,
                                    {{WRAPPER}} .mayosis-single-b-cart.edd_go_to_checkout.button,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js,
                                    {{WRAPPER}} .mayosis-single-b-cart a',
            )
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'cart_button',
            [
                'label' => __( 'Cart Button', 'mayosis-core' ),
            ]
        );
        $this->add_control(
            'lm_button_color',
            [
                'label' => __( 'Background Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3c78',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-single-b-cart .edd-add-to-cart,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-fd-button,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit.button.blue,
                                    {{WRAPPER}} .mayosis-single-b-cart.edd_go_to_checkout.button,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js,
                                    {{WRAPPER}} .mayosis-single-b-cart a' => 'background: {{VALUE}}',


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
                    '{{WRAPPER}} .mayosis-single-b-cart .edd-add-to-cart,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-fd-button,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit.button.blue,
                                    {{WRAPPER}} .mayosis-single-b-cart.edd_go_to_checkout.button,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js,
                                    {{WRAPPER}} .mayosis-single-b-cart a' => 'border-color: {{VALUE}}',


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
                    '{{WRAPPER}} .mayosis-single-b-cart .edd-add-to-cart,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-fd-button,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit.button.blue,
                                    {{WRAPPER}} .mayosis-single-b-cart.edd_go_to_checkout.button,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js,
                                    {{WRAPPER}} .mayosis-single-b-cart a' => 'color: {{VALUE}}',


                ],
            ]
        );
        $this->end_controls_tab();



        $this->start_controls_tab(
            'cart_button_hover',
            [
                'label' => __( 'Cart Button Hover', 'mayosis-core' ),
            ]
        );

        $this->add_control(
            'lm_button_hvr_color',
            [
                'label' => __( 'Background Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0A0FA1',
                'selectors' => [
                    '{{WRAPPER}} .mayosis-single-b-cart .edd-add-to-cart:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-fd-button:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit.button.blue:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart.edd_go_to_checkout.button:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart a:hover,
                                    {{WRAPPER}} .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js:hover' => 'background: {{VALUE}} !important',


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
                    '{{WRAPPER}} .mayosis-single-b-cart .edd-add-to-cart:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-fd-button:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit.button.blue:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart.edd_go_to_checkout.button:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart a:hover,
                                    {{WRAPPER}} .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js:hover' => 'border-color: {{VALUE}} !important',


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
                    '{{WRAPPER}} .mayosis-single-b-cart .edd-add-to-cart:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-fd-button:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit.button.blue:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart.edd_go_to_checkout.button:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js:hover,
                                    {{WRAPPER}} .mayosis-single-b-cart a:hover,
                                    {{WRAPPER}} .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js:hover' => 'color: {{VALUE}} !important',


                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'cart_padding',
            [
                'label' => __( 'Padding', 'mayosis-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mayosis-single-b-cart .edd-add-to-cart,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-fd-button,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit.button.blue,
                                    {{WRAPPER}} .mayosis-single-b-cart.edd_go_to_checkout.button,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js,
                                    {{WRAPPER}} .mayosis-single-b-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );

 $this->add_responsive_control(
            'cart_border_radius',
            [
                'label' => __( 'Border Radius', 'mayosis-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mayosis-single-b-cart .edd-add-to-cart,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-fd-button,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd-submit.button.blue,
                                    {{WRAPPER}} .mayosis-single-b-cart.edd_go_to_checkout.button,
                                    {{WRAPPER}} .mayosis-single-b-cart .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js,
                                    {{WRAPPER}} .mayosis-single-b-cart a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );


        $this->start_controls_tabs( 'variation_button_style' );

        $this->start_controls_tab(
            'variation_button',
            [
                'label' => __( 'Variable Button', 'mayosis-core' ),
            ]
        );
        $this->add_control(
            'vl_button_color',
            [
                'label' => __( 'Background Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3c78',
                'selectors' => [
                    '{{WRAPPER}} .msv-btn-stl-variation .edd_price_options li label' => 'background: {{VALUE}}',


                ],
            ]
        );


        $this->add_control(
            'vl_border_color',
            [
                'label' => __( 'Border Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3c78',
                'selectors' => [
                    '{{WRAPPER}} .msv-btn-stl-variation .edd_price_options li label' => 'border-color: {{VALUE}}',


                ],
            ]
        );
        $this->add_control(
            'vl_txtr_color',
            [
                'label' => __( 'Text Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .msv-btn-stl-variation .edd_price_options li label' => 'color: {{VALUE}}',


                ],
            ]
        );
        $this->end_controls_tab();



        $this->start_controls_tab(
            'variable_button_hover',
            [
                'label' => __( 'Variable Button Active', 'mayosis-core' ),
            ]
        );

        $this->add_control(
            'vl_button_hvr_color',
            [
                'label' => __( 'Background Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0A0FA1',
                'selectors' => [
                    '{{WRAPPER}} .msv-btn-stl-variation .edd_download_purchase_form .edd_price_options ul li.item-selected label' => 'background: {{VALUE}} !important',


                ],
            ]
        );

        $this->add_control(
            'vl_button_border_color',
            [
                'label' => __( 'Border Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0A0FA1',
                'selectors' => [
                    '{{WRAPPER}} .msv-btn-stl-variation .edd_download_purchase_form .edd_price_options ul li.item-selected label' => 'border-color: {{VALUE}} !important',


                ],
            ]
        );
        $this->add_control(
            'vl_button_txt_color',
            [
                'label' => __( 'Text Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .msv-btn-stl-variation .edd_download_purchase_form .edd_price_options ul li.item-selected label' => 'color: {{VALUE}} !important',


                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

       
     
  $this->add_responsive_control(
            'vbtn_padding',
            [
                'label' => __( 'Variation Button Padding', 'mayosis-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .msv-btn-stl-variation .edd_download_purchase_form .edd_price_options ul li label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
                'condition' => [
                    'variation_style' => array('button'),
                ],
            ]
        );
        
        $this->add_responsive_control(
            'vbtn_padding_bradius',
            [
                'label' => __( 'Variation Button Border Radius', 'mayosis-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .msv-btn-stl-variation .edd_download_purchase_form .edd_price_options ul li label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                 'condition' => [
                    'variation_style' => array('button'),
                ],
                
            ]
        );
        
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'variation_button_typography',
                'label'     => __( 'Variation Button Typography', 'mayosis-core' ),
                'selector'  => '{{WRAPPER}} .msv-btn-stl-variation .edd_download_purchase_form .edd_price_options ul li label',
                'condition' => [
                    'variation_style' => array('button'),
                ],
            )
        );
        
        $this->add_control(
			'gap_v_btn',
			[
				'label' => __( 'Gap Variation to Purchase Button', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .msv-btn-stl-variation .edd_price_options ul' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.

        $settings = $this->get_settings();
        global $post;
        $download_id = get_the_ID();
        $mayosis_last_product_id= mayosis_get_last_product_id();
        $producttopsocialbuttons= get_theme_mod( 'product_top_social_share','show' );
        $livepreviewtext= get_theme_mod( 'live_preview_text','Live Preview' );
        $showcartonfree= get_theme_mod( 'free_product_cart_button','hide' );

        $envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );
        $custom_purchase_text= get_post_meta( $post->ID, 'custom_product_text', true );
        $custom_purchase_btn= get_post_meta( $post->ID, 'custom_product_url', true );
        if ($envato_item_id){
            $api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
            $item_price = $api_item_results_json['price_cents'];
            $item_url = $api_item_results_json['url'];

        }
        $variation_style = $settings['variation_style'];

        ?>


        <div class="mayosis-single-b-cart">
            <?php  if( Plugin::instance()->editor->is_edit_mode() ){ ?>


                <?php if(edd_has_variable_prices($mayosis_last_product_id)):?>
                    <?php if($variation_style=="popup"){?>
                        <div class="mayosis-b-cart-button">
                            <a class="btn btn-primary multiple_button_v" href="#mayosis_variable_price" data-lity>
                                <?php esc_html_e('Purchase','mayosis-core'); ?>
                            </a>
                        </div>
                    <?php } elseif($variation_style=="button"){ ?>
                        <div class="msv-btn-stl-variation">
                            <?php echo edd_get_purchase_link( array( 'download_id' => $mayosis_last_product_id ) ); ?>
                        </div>
                    <?php } else { ?>
                        <?php echo edd_get_purchase_link( array( 'download_id' => $mayosis_last_product_id ) ); ?>

                    <?php } ?>
                <?php else: ?>


                    <?php echo edd_get_purchase_link( array( 'download_id' => $mayosis_last_product_id ) ); ?>

                <?php endif; ?>

            <?php } else { ?>

                <?php if ($envato_item_id) { ?>
                    <div class="mayosis-b-cart-button">

                        <?php if ($custom_purchase_btn){ ?>
                            <a href="<?php echo esc_url($custom_purchase_btn);?>" class="button blue edd-submit custom-envato-btn">
                                <?php echo esc_html($custom_purchase_text);?>
                            </a>
                        <?php } else { ?>
                            <a href="<?php echo esc_url($item_url);?>" class="button blue edd-submit custom-envato-btn">
                                <?php esc_html_e('Purchase','mayosis-core');?>
                            </a>

                        <?php } ?>
                    </div>

                <?php } else { ?>


                    <?php if ($custom_purchase_btn){ ?>
                        <div class="mayosis-b-cart-button">
                            <a href="<?php echo esc_url($custom_purchase_btn);?>" class="button blue edd-submit custom-envato-btn">
                                <?php echo esc_html($custom_purchase_text);?>
                            </a>
                        </div>
                    <?php } else { ?>
                        <?php
                        global $edd_logs;
                        $single_count = $edd_logs->get_log_count(66, 'file_download');
                        $total_count  = $edd_logs->get_log_count('*', 'file_download');
                        $price = edd_get_download_price(get_the_ID());
                        $download_id = get_the_ID();
                        ?>
                        <?php if( $price == "0.00"  ){ ?>
                           
                                <div class="mayosis-b-cart-button">
                                    <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
                                </div>
                           
                        <?php } else { ?>


                            <?php if(edd_has_variable_prices($download_id)):?>
                                <?php if($variation_style=="popup"){?>
                                    <div class="mayosis-b-cart-button">
                                        <a class="btn btn-primary multiple_button_v" href="#mayosis_variable_price" data-lity>
                                            <?php esc_html_e('Purchase','mayosis-core'); ?>
                                        </a>
                                    </div>
                                <?php } elseif($variation_style=="button"){ ?>
                                    <div class="msv-btn-stl-variation">
                                        <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
                                    </div>
                                <?php } else { ?>
                                    <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>

                                <?php } ?>
                            <?php else: ?>


                                <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>

                            <?php endif; ?>
                        <?php } ?>

                    <?php } ?>
                <?php }?>

            <?php } ?>
        </div>
        <?php if($variation_style=="popup"){?>
            <div id="mayosis_variable_price" class="lity-hide">

                <h4><?php esc_html_e('Choose Your Desired Option(s)','mayosis-core'); ?></h4>


                <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID()) ); ?>


            </div>
        <?php } ?>


        <?php

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_cart);
?>