<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_woo_author_Elementor extends Widget_Base {

    public function get_name() {
        return 'mayosis-woo-author';
    }

    public function get_title() {
        return __( 'Mayosis Woo Vendor', 'mayosis-core' );
    }
    public function get_categories() {
        return [ 'mayosis-woo-cat' ];
    }
    public function get_icon() {
        return 'eicon-elementor';
    }

    protected function register_controls() {

        $this->add_control(
            'section_edd',
            [
                'label' => __( 'Mayosis Vendor Settings', 'mayosis-core' ),
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
            'author_id',
            [
                'label' => __( 'Author ID (i.e 1,2,3)', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Author ID', 'mayosis-core' ),
                'section' => 'section_edd',
            ]
        );

        $this->add_control(
            'author_count',
            [
                'label' => __( 'Number of Author', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Author Number', 'mayosis-core' ),
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
			'vendor_item_style',
			[
				'label' => esc_html__( 'Vendor Style', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				 'section' => 'section_edd',
				'options' => [
					'style1'  => esc_html__( 'Style One', 'textdomain' ),
					'style2' => esc_html__( 'Style Two', 'textdomain' ),
					
				],
				
			]
		);



        $this->add_control(
            'custom_css',
            [
                'label' => __( 'Custom CSS Class', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Custom CSS name', 'mayosis-core' ),
                'section' => 'section_edd',
            ]
        );
        $this->start_controls_section(
			'vendor_style',
			[
				'label' => __( 'Vendorbox Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		  $this->add_control(
         'cs_bg_radius',
         [
            'label' => __( 'Custom Image Border radius', 'mayosis-core' ),
            'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .fes--author--image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            
         ]
      );
      $this->add_control(
         'vendor_bg_color',
         [
            'label' => __( 'Block BG Color', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Custom Background Color', 'mayosis-core' ),
            'selectors' => [
					'{{WRAPPER}} .fes--author--block' => 'background: {{VALUE}};',
				],
            
         ]
      );
       $this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Block Padding', 'mayosis-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .fes--author--block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_bx',
				'label' => __( 'Border', 'mayosis-core' ),
				'selector' => '{{WRAPPER}} .fes--author--block',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_font_size',
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
        $custom_css = $settings['custom_css'];
        $recent_section_title = $settings['title'];
        $author_id_main = $settings['author_id'];
        $num_of_authors = $settings['author_count'];
        $sub_title = $settings['sub_title'];
        $button_text = $settings['button_text'];
        $button_link = $settings['button_link'];
        $title_sec_margin = $settings['margin_bottom'];
        $venstyle = $settings['vendor_item_style'];

        ?>


        <div class="<?php
        echo esc_attr($custom_css); ?>">

            <div class="fes--author---titlebox" style="margin-bottom:<?php echo esc_attr($title_sec_margin); ?>;">
                <div class="fes--author--top-title">
                    <h3 class="section-title"><?php echo esc_attr($recent_section_title); ?> </h3>
                    <?php
                    if ($sub_title ) { ?>
                        <p class="mayos--block--subtitle"><?php echo esc_attr($sub_title); ?></p>
                    <?php } ?>
                </div>

                <div class="fes--author--buttonbox">
                    <?php
                    if ($button_link) { ?>
                        <a href="<?php echo esc_attr($button_link); ?>" class="btn fes--box-btn"><?php echo esc_attr($button_text); ?></a>
                    <?php } ?>
                </div>
            </div>

<div class="row">
            <?php
            $include =  $author_id_main;
            $userarg = array(
                'include' => $include,
                'number' => $num_of_authors,
                'orderby'      => 'include',
            );
            $allUsers = get_users($userarg);
            $users = array();

            // Remove subscribers from the list as they won't write any articles

            foreach($allUsers as $vendor)
            {
                if (!in_array( 'author', $vendor->roles))
                {
                    $users[] = $vendor;
                }
            }
            ?>

            <?php
            foreach($users as $user)
            {
                global $post;
                $post_count = count_user_posts($user->ID);
                $author = get_user_by( 'id', get_query_var( 'author' ) );
                $authoraddress = get_the_author_meta( 'address',$user->ID );

                $exclude_post_id = $post->ID;
           
                $author = $post->post_author;
                $authorID= get_the_author_meta('ID', $user->ID );
                
                
                
                 if (class_exists('Marketkingcore_Public')) {
                        $vendor_id = marketking()->get_product_vendor($authorID);
                        $storelink = marketking()->get_store_link($authorID);
                        $storename = marketking()->get_store_name_display($authorID);
                        
                        	$profileimg = marketking()->get_store_profile_image_link($authorID);
                        	
                        	if (empty($profileimg)){
					// show default image
					$profileimg = MARKETKINGCORE_URL.'includes/assets/images/store-profile.png';
				} else {
					$profileimg = marketking()->get_resized_image($profileimg, 'thumbnail');
				}
				
				$bannerimg = marketking()->get_store_banner_image_link($authorID);
		if (empty($bannerimg)){
			$bannerimg = MARKETKINGCORE_URL.'includes/assets/images/store-banner.png';
		} else {
			$bannerimg = marketking()->get_resized_image($bannerimg, 'large');
		}
				
                         }
                         
                          if (class_exists('WeDevs_Dokan')) {
                            $seller  = get_user_by( 'id', $authorID );
                            $store_user    = dokan()->vendor->get( get_query_var( $authorID ) );
                            $storelink = dokan_get_store_url( $authorID );
                            $storename = $seller->display_name;
                            $bannerimg= get_user_meta($authorID,'dokan_profile_settings', true);
                            $profileimg = get_avatar_url($authorID);
                           $bannerimg = wp_get_attachment_url($bannerimg['banner']);
                          }
                ?>
                
                 
                <?php if($venstyle=="style2"){?>
                
                
                <div class="col-12 col-md-4">
                 <div class="fes--author--block-style-2">
                     <div class="author2--cover-img" style="background-image:url(<?php echo esc_url($bannerimg); ?>);
    ">
    </div>
                     <div class="fes--author--meta-2">
                    <span class="fes--author--image-2">
                    <a href="<?php echo $storelink ?>">
                        <img class="marketking_vendor_store_page_profile_image_fes-box" src="<?php echo esc_url($profileimg);?>"></a>
                         </span>

                        <span class="fes--author--data-2">
                          <a href="<?php echo $storelink ?>"> <h4 class="authorName">
                <?php
                echo $storename; ?></h4></a>

                        <p class="author--address"><i class="isax icon-box-1"></i> <?php echo count_user_posts($authorID,'product'); ?> <?php esc_html_e('Products','mayosis-core')?></p>
                       
                   </span>
                   
                   
                    <div class="follow--au--btn">
                             <?php
                             if ( is_user_logged_in() ) { ?>
                            <?php
                            $teconcefollow = teconce_get_follow_unfollow_links( $authorID );
                            
                            echo maybe_unserialize($teconcefollow);
                            ?>
                            <?php } else  { ?>
                            
                             <a href="#vendorlogin" data-lity class="tec-follow-link"><?php esc_html_e('Follow','mayosis');?></a>
                            <?php } ?>
                        </div>





                    </div>
                    
                    
                     <div class="fes--author--products-style-2">
                        <ul class="fes--author--image--block-2">
                            <?php



                            $arguments2 = array(
                                'post_type' => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => 4,
                                'order' => 'DESC',
                                'ignore_sticky_posts' => 1,
                                'ignore_sticky_posts'=>1,
                                'author'=> $authorID,

                            );

                            $post_query_alt = new \WP_Query($arguments2); ?>
                            <?php if ( $post_query_alt->have_posts() ) : while ( $post_query_alt->have_posts() ) : $post_query_alt->the_post(); ?>
                                <li class="grid-product-box-2">
                                    <div class="product-thumb grid_dm">
                                        <figure class="mayosis-fade-in">
                                            <?php
                                            if ( has_post_thumbnail() ) {
                                                the_post_thumbnail('mayosis-product-grid-small');
                                            }
                                            ?>
                                            <figcaption>
                                                <div class="overlay_content_center">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <i class="zil zi-plus"></i>
                                                    </a>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </li>
                            <?php endwhile; else: ?>

                            <?php endif; ?>

                            <?php wp_reset_postdata(); ?>

                        </ul>
                    </div>
                    
                    
                    
                    
                    
                </div>
                </div>
                <?php } else { ?>
                <div class="fes--author--block">
                    <div class="fes--author--meta">
                    <span class="fes--author--image">
                        
                      
                    <a href="<?php echo $storelink ?>">
                       <img class="marketking_vendor_store_page_profile_image_fes-box" src="<?php echo esc_url($profileimg);?>"></a>
                         </span>

                        <span class="fes--author--data">
                          <a href="<?php echo $storelink ?>"> <h4 class="authorName">
                <?php
                echo $storename; ?></h4></a>

                        <p class="author--address"><?php echo count_user_posts($authorID,'product'); ?> <?php esc_html_e('Products','mayosis-core')?></p>
                        <a class="fes--v-portfolio" href="<?php echo $storelink ?>">
                        <?php esc_html_e('View Portfolio','mayosis-core'); ?></a>
                   </span>





                    </div>

                    <div class="fes--author--products">
                        <ul class="fes--author--image--block">
                            <?php



                            $arguments = array(
                                'post_type' => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => 4,
                                'order' => 'DESC',
                                'ignore_sticky_posts' => 1,
                                'author'=> $authorID,

                            );

                            $post_query = new \WP_Query($arguments); ?>
                            <?php if ( $post_query->have_posts() ) : while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
                                <li class="grid-product-box">
                                    <div class="product-thumb grid_dm">
                                        <figure class="mayosis-fade-in">
                                            <?php
                                            if ( has_post_thumbnail() ) {
                                                the_post_thumbnail('mayosis-product-grid-small');
                                            }
                                            ?>
                                            <figcaption>
                                                <div class="overlay_content_center">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <i class="zil zi-plus"></i>
                                                    </a>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </li>
                            <?php endwhile; else: ?>

                            <?php endif; ?>

                            <?php wp_reset_postdata(); ?>

                        </ul>
                    </div>
                </div>
                <?php } ?>
                <?php
            }

            ?>
            </div>

        </div>
<!-- Modal Login Form -->
           <div id="vendorlogin" style="background:#fff" class="lity-hide">
                   
                    <h4 class="modal-title">Login</h4>
                
                  <div class="modal-body">
                      <?php echo do_shortcode('[mayosis_woo_login]'); ?>
                  </div>
                </div>

<!-- Modal -->

        <?php

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_woo_author_Elementor );
?>