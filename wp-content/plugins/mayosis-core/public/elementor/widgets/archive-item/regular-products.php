<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_archive_rproduct extends Widget_Base {

   public function get_name() {
      return 'mayosis-archive-rproduct';
   }

   public function get_title() {
      return __( 'Archive Regular Product', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-archive' ];
	}
   public function get_icon() { 
        return 'eicon-gallery-grid';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_archive_description',
			[
				'label' => __( 'Regular Product Options', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		
		$this->add_control(
			'product_archive_column_grid',
			[
				'label' => __( 'Column Amount', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'two',
				'options' => [
					'one'  => __( 'Two Column', 'plugin-domain' ),
					'two' => __( 'Three Column', 'plugin-domain' ),
					'three' => __( 'Four Column', 'plugin-domain' ),
					'five' => __( 'Five Column', 'plugin-domain' ),
					'four' => __( 'Six Column', 'plugin-domain' ),
				
				],
			]
		);
		
		$this->add_control(
			'thumbnail_video_play',
			[
				'label' => __( 'Thumbnail Video Play', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'show',
				'options' => [
					'show'  => __( 'Show', 'plugin-domain' ),
					'hide' => __( 'Hide', 'plugin-domain' ),
				
				],
			]
		);
		
		$this->add_control(
			'thumb_video_control',
			[
				'label' => __( 'Thumbnail Video Control', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'minimal',
				'options' => [
					'minimal'  => __( 'Minimal', 'plugin-domain' ),
					'wholecontrol' => __( 'Full', 'plugin-domain' ),
				
				],
			]
		);
		
		$this->add_control(
			'thumb_cart_button',
			[
				'label' => __( 'Thumbnail Cart Button', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'hide',
				'options' => [
					'show'  => __( 'Show', 'plugin-domain' ),
					'hide' => __( 'Hide', 'plugin-domain' ),
				
				],
			]
		);
		
			$this->add_control(
			'product_thmub_hover_style',
			[
				'label' => __( 'Thumbnail Hover Style', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1'  => __( 'Style One', 'plugin-domain' ),
					'style2' => __( 'Style Two', 'plugin-domain' ),
					'style3' => __( 'Style Three', 'plugin-domain' ),
				
				],
			]
		);
		
		$this->add_control(
			'product_pagination_type',
			[
				'label' => __( 'Pagination Type', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one'  => __( 'Normal Pagination', 'plugin-domain' ),
					'two' => __( 'Ajax Load More', 'plugin-domain' ),
				
				],
			]
		);
            
              
             
     $this->end_controls_section();
     
     $this->start_controls_section(
	'style_section',
	[
		'label' => __( 'Product Style', 'plugin-name' ),
		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	]
);


          $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'title_typography',
                    'label'     => __( 'Title Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .product-meta .product-title,{{WRAPPER}} .product-meta .product-title a',
                )
            );
            
            
            $this->add_control(
                'mayosis-arch-p-desc_color',
                [
                    'label'     => __( 'Title Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product-meta .product-title a' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );
            
             $this->add_group_control(
              Group_Control_Typography::get_type(),
                array(
                    'name'      => 'meta_typo',
                    'label'     => __( 'Meta Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .product-meta,{{WRAPPER}} .product-meta span,{{WRAPPER}} .product-meta a',
                )
            );
            
            
            $this->add_control(
                'meta_color',
                [
                    'label'     => __( 'Meta Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product-meta,{{WRAPPER}} .product-meta span,{{WRAPPER}} .product-meta a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            
             $this->add_group_control(
              Group_Control_Typography::get_type(),
                array(
                    'name'      => 'price_typo',
                    'label'     => __( 'Price Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .product-meta .count-download .promo_price,{{WRAPPER}} .product-meta .count-download .promo_price span',
                )
            );
            
            
            $this->add_control(
                'price_color',
                [
                    'label'     => __( 'Price Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product-meta .count-download .promo_price,{{WRAPPER}} .product-meta .count-download .promo_price span' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            
           
		
		
		 
            $this->add_control(
			'thumbnail_border-radius',
			[
				'label' => __( 'Thumb Border Radius', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} figure.mayosis-fade-in,{{WRAPPER}} figure.mayosis-fade-in img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
			
			
		);
		
		
		$this->add_control(
			'grid_style_title',
			[
				'label' => __( 'Grid Style', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'grid_bg',
				'label' => __( 'Grid Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .product-box',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'grid_border',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .product-box',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'grid_box_shadow',
				'label' => __( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .product-box',
			]
		);
            
         $this->add_control(
			'grid_border-radius',
			[
				'label' => __( 'Grid Border Radius', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .product-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
			
			
		);
		
		$this->add_control(
			'grid_padding',
			[
				'label' => __( 'Grid Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .product-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
			
			
		);
		
		$this->add_control(
			'meta_padding',
			[
				'label' => __( 'Grid Meta Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .product-box .product-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
			
			
		);
		
		
		$this->add_control(
			'grid_overlay_title',
			[
				'label' => __( 'Overlay Style', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'overlay_bg',
				'label' => __( 'Overlay Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} figure.mayosis-fade-in figcaption',
			]
		);
          
         $this->add_control(
			'overlay_text_color',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} figure.mayosis-fade-in figcaption' => 'color: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			'grid_overlay_view_btn',
			[
				'label' => __( 'View Details Button', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->start_controls_tabs(
			'overlay_btn_tab'
		);

		$this->start_controls_tab(
			'view_details_normal',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
		);
		
		$this->add_control(
			'view_dteail_bg',
			[
				'label' => __( 'Background', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product_hover_details_button a.button-fill-color' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'view_dteail_border',
			[
				'label' => __( 'Border', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product_hover_details_button a.button-fill-color' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'view_dteail_txt',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .product_hover_details_button a.button-fill-color' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'view_details_hover',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);
    
    $this->add_control(
			'view_dteail_hvr_bg',
			[
				'label' => __( 'Background', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product_hover_details_button a.button-fill-color:hover' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'view_dteail_hvr_border',
			[
				'label' => __( 'Border', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product_hover_details_button a.button-fill-color:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'view_dteail_hvr_txt',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product_hover_details_button a.button-fill-color:hover' => 'color: {{VALUE}}',
				],
			]
		);
    
    $this->end_controls_tab();
    
    $this->end_controls_tabs();
    
    $this->add_control(
			'view_details_padding',
			[
				'label' => __( 'Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .product_hover_details_button a.button-fill-color' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
			
			
		);
		
		  $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'view_btn_typography',
                    'label'     => __( 'Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .product_hover_details_button a.button-fill-color',
                )
            );
            
            
            $this->add_control(
			'grid_overlay_previw_btn',
			[
				'label' => __( 'Preview Button', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->start_controls_tabs(
			'overlay_previewbtn_tab'
		);

		$this->start_controls_tab(
			'preview_btn_normal',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
		);
		
		$this->add_control(
			'preview_btn_bg',
			[
				'label' => __( 'Background', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .overlay_content_center .live_demo_onh' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'preview_btn_border',
			[
				'label' => __( 'Border', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .overlay_content_center .live_demo_onh' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'preview_btn_txt',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .overlay_content_center .live_demo_onh' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'preview_btn_hover',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);
    
    $this->add_control(
			'preview_btn_hvr_bg',
			[
				'label' => __( 'Background', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .overlay_content_center .live_demo_onh:hover' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'preview_hvr_border',
			[
				'label' => __( 'Border', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .overlay_content_center .live_demo_onh:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'preview_hvr_txt',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .overlay_content_center .live_demo_onh:hover' => 'color: {{VALUE}}',
				],
			]
		);
    
    $this->end_controls_tab();
    
    $this->end_controls_tabs();
    
    $this->add_control(
			'preview_padding',
			[
				'label' => __( 'Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .overlay_content_center .live_demo_onh' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
			
			
		);
		
		  $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'preview_typography',
                    'label'     => __( 'Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .overlay_content_center .live_demo_onh',
                )
            );
$this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       global $post;
        $productarchivecolgrid= $settings['product_archive_column_grid'];
        $productthumbvideo= $settings['thumbnail_video_play'];
        $productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
        $productvcontrol= $settings['thumb_video_control'];
        $productcartshow= $settings['thumb_cart_button'];
        $productthumbhoverstyle= $settings[ 'product_thmub_hover_style'];
        $pagination=$settings['product_pagination_type'];
        
         if($productarchivecolgrid=="five"){
           $fivecol ="row-cols-1 row-cols-md-5 ";
       } else {
            $fivecol ="";
       }
      ?>


<div class="mayosis-arch-p-desc mayosis-archive-wrapper">
           <div class="row <?php echo $fivecol; ?> fix <?php
                if ($pagination=='two') { ?>infinite-content<?php }?>">
   
   
   <?php if ( have_posts() ) :
while ( have_posts() ) : the_post();

?>
    
    <?php if ($productarchivecolgrid=='one'): ?>
    <div class="col-md-6 col-xs-12 col-sm-6 product-grid" id="edd_download_<?php the_ID(); ?>">
        <?php elseif ($productarchivecolgrid=='two'): ?>
        <div class="col-md-4 col-xs-12 col-sm-4 product-grid" id="edd_download_<?php the_ID(); ?>">
            
            <?php elseif ($productarchivecolgrid=='four'): ?>
            <div class="col-md-2 col-xs-12 col-sm-2 product-grid" id="edd_download_<?php the_ID(); ?>">
                
                 <?php elseif ($productarchivecolgrid=='five'): ?>
            <div class="col product-grid" id="edd_download_<?php the_ID(); ?>">
            <?php else:?>
            <div class="col-md-3 col-xs-12 col-sm-3 product-grid" id="edd_download_<?php the_ID(); ?>">
                <?php endif;?>
                <div <?php post_class(); ?>>
                <div class="grid_dm ribbon-box group
                                        edge">
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
<?php endwhile; ?>
<?php else : ?>
<h4 class="msv-no-p-title">No products Available on this category</h4>
<?php endif; ?>


    

        </div>
        <div class="clearfix"></div>
           <div class="mayo-page-product mayo-product-loader-archive">
       
           
        <?php if ($pagination == 'two'){ ?>
            <a href="#" class="inf-load-more"><?php _e( 'More Items', 'mayosis-core' ); ?></a>
            
        <?php }?>
        
        <?php if ($pagination == 'two') {
            $stylenone = 'display:none';
        } else {
            $stylenone ='';
        } ?>
<div class="nav-links" style="<?php echo esc_html($stylenone);?>">
<?php if (function_exists("mayosis_page_navs")) { mayosis_page_navs(); } ?>
</div>

</div>
     
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_archive_rproduct);
?>