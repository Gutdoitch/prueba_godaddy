<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_archive_masonry extends Widget_Base {

   public function get_name() {
      return 'mayosis-archive-mproduct';
   }

   public function get_title() {
      return __( 'Archive Masonry Product', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-archive' ];
	}
   public function get_icon() { 
        return 'eicon-posts-masonry';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_archive_description',
			[
				'label' => __( 'Masonry Product Options', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'product_masonry_column',
			[
				'label' => __( 'Masonry Column', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'2'  => __( 'Two Column', 'plugin-domain' ),
					'3' => __( 'Three Column', 'plugin-domain' ),
					'4' => __( 'Four Column', 'plugin-domain' ),
					'5' => __( 'Five Column', 'plugin-domain' ),
					
				
				],
			]
		);
		
		
		
		$this->add_control(
			'product_masonry_title_hover',
			[
				'label' => __( 'Masonry Title Hover', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1'  => __( 'Enable', 'plugin-domain' ),
					'2' => __( 'Disable', 'plugin-domain' ),
					
				
				],
			]
		);
		
		$this->add_control(
			'product_masonry_hover_style',
			[
				'label' => __( 'Masonry Hover Style', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'two',
				'options' => [
					'one'  => __( 'Style One', 'plugin-domain' ),
					'two' => __( 'Style Two', 'plugin-domain' ),
					'three' => __( 'Style Three', 'plugin-domain' ),
				
				],
			]
		);
		
		$this->add_control(
			'product_masonry_meta_state',
			[
				'label' => __( 'Masonry Meta', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'disable',
				'options' => [
					'enable'  => __( 'Enable', 'plugin-domain' ),
					'disable' => __( 'Disable', 'plugin-domain' ),
				
				],
			]
		);
		
		$this->add_control(
			'product_masonry_image_hover_style',
			[
				'label' => __( 'Masonry Image hover effect', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'disable',
				'options' => [
					'enable'  => __( 'Enable', 'plugin-domain' ),
					'disable' => __( 'Disable', 'plugin-domain' ),
				
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
				'selector' => '{{WRAPPER}} .product-masonry-item-content',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'grid_border',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .product-masonry-item-content',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'grid_box_shadow',
				'label' => __( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .product-masonry-item-content',
			]
		);
            
         $this->add_control(
			'grid_border-radius',
			[
				'label' => __( 'Grid Border Radius', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .product-masonry-item-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .product-masonry-item .product-masonry-item-content img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .product-masonry-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
			
			
		);
		
		
	$this->add_control(
			'grid_style_meta',
			[
				'label' => __( 'Meta Style', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'meta_padding',
			[
				'label' => __( 'Grid Meta Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .product-masonry-item-content .product-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'selector' => '{{WRAPPER}} .product-masonry-description',
			]
		);
		
		$this->add_group_control(
              Group_Control_Typography::get_type(),
                array(
                    'name'      => 'overlay_title_typography',
                    'label'     => __( 'Title Typography', 'mayosis-core' ),
                    'selector'  => '.product-masonry-description h5 a',
                )
            );
          
         $this->add_control(
			'overlay_text_color',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-masonry-description,{{WRAPPER}} .product-masonry-description h5 a,{{WRAPPER}} .product-masonry-description a,{{WRAPPER}} .bottom-metaflex i' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .product-masonry-item-content .product_hover_details_button  a.button-fill-color' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'view_dteail_border',
			[
				'label' => __( 'Border', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-masonry-item-content .product_hover_details_button  a.button-fill-color' => 'border-color: {{VALUE}}',
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
					'{{WRAPPER}} .product-masonry-item-content .product_hover_details_button  a.button-fill-color' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .product-masonry-item-content  a.button-fill-color:hover' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'view_dteail_hvr_border',
			[
				'label' => __( 'Border', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-masonry-item-content .product_hover_details_button  a.button-fill-color:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'view_dteail_hvr_txt',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-masonry-item-content .product_hover_details_button  a.button-fill-color:hover' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .product-masonry-item-content .product_hover_details_button  a.button-fill-color' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
			
			
		);
		
		  $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'view_btn_typography',
                    'label'     => __( 'Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .product-masonry-item-content .product_hover_details_button  a.button-fill-color',
                )
            );
            
            
         
$this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       global $post;
        $productmascol= $settings['product_masonry_column'];
        $productmastitle= $settings['product_masonry_title_hover'];
        $titileboxstyle= $settings[ 'product_masonry_hover_style'];
        $author = get_user_by( 'id', get_query_var( 'author' ) );
        $author_id=$post->post_author;
        $masonrymetastate=  $settings['product_masonry_meta_state'];
        $imageeffect= $settings['product_masonry_image_hover_style'];
        if($imageeffect=='enable'){
                                        $imgeftcls='masonry-hover-effect-enabled';
                                    } else {
                                         $imgeftcls='';
                                    }
        $pagination=$settings['product_pagination_type'];
      ?>


<div class="mayosis-arch-masonry">
          
    <div class="product-masonry product-masonry-gutter product-masonry-style-2 product-masonry-masonry product-masonry-full product-masonry-<?php echo esc_html($productmascol);?>-column  <?php
                if ($pagination=='two') { ?>infinite-content-masonry<?php }?>">
        <?php
        $term=get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        $CatTerms=(isset($term->slug))?$term->slug:null;
        $paged=( get_query_var( 'paged')) ? get_query_var( 'paged') : 1;
        if ( ! isset( $wp_query->query['orderby'] ) ) {
            $args = array(
                'order' => 'DESC',
                'post_type' => 'download',
                'download_category'=>$CatTerms,
                'paged' => $paged );
        } else {
            switch ($wp_query->query['orderby']) {
                case 'newness_asc':
                    $args = array(
                        'orderby' => 'newness_asc',
                        'order' => 'ASC',
                        'post_type' => 'download',
                        'download_category'=>$CatTerms,
                        'paged' => $paged );
                    break;
                case 'newness_desc':
                    $args = array(
                        'orderby' => 'newness_desc',
                        'order' => 'DESC',
                        'post_type' => 'download',
                        'download_category'=>$CatTerms,
                        'paged' => $paged );
                    break;
                case 'sales':
                    $args = array(
                        'meta_key'=>'_edd_download_sales',
                        'order' => 'DESC',
                        'orderby' => 'meta_value_num',
                        'download_category'=>$CatTerms,
                        'post_type' => 'download',
                        'paged' => $paged );
                    break;
                case 'price_asc':
                    $args = array(
                        'meta_key'=>'edd_price',
                        'order' => 'ASC',
                        'orderby' => 'meta_value_num',
                        'download_category'=>$CatTerms,
                        'post_type' => 'download',
                        'paged' => $paged );
                    break;

                case 'price_desc':
                    $args = array(
                        'meta_key'=>'edd_price',
                        'order' => 'DESC',
                        'orderby' => 'meta_value_num',
                        'download_category'=>$CatTerms,
                        'post_type' => 'download',
                        'paged' => $paged );
                    break;

                case 'title_asc':
                    $args = array(
                        'orderby' => 'title',
                        'order' => 'ASC',
                        'download_category'=>$CatTerms,
                        'post_type' => 'download',
                        'paged' => $paged );
                    break;

                case 'title_desc':
                    $args = array(
                        'orderby' => 'title',
                        'order' => 'DESC',
                        'download_category'=>$CatTerms,
                        'post_type' => 'download',
                        'paged' => $paged );
                    break;
            } }
            
        $wp_query = new \WP_Query(); $wp_query->query($args); ?>
        <?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
            <div class="product-masonry-item <?php echo esc_html($imgeftcls);?>" id="edd_download_<?php the_ID(); ?>">
                <div <?php post_class(); ?>>
                <div class="product-masonry-item-content">
                    <?php if ( has_post_format( 'video' )) { ?>
                        <div class="item-thumbnail item-video-masonry">
                            <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
                            <a href="<?php the_permalink();?>" class="video-masonry-link"></a>
                        </div>
                    <?php } else { ?>
                        <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                        <div class="item-thumbnail">
                            <a href="<?php the_permalink();?>"><img src="<?php echo maybe_unserialize($thumbnail['0']); ?>" alt="<?php the_title();?>"></a>
                        </div>
                    <?php } ?>
                    <?php if ($productmastitle==1){?>

                        <?php if ($titileboxstyle== "one"){ ?>
                            <div class="product-masonry-description">

                                <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                            </div>

                        <?php } elseif ($titileboxstyle== "three"){ ?>

                            <div class="product-masonry-description masonry-style-three">
                                <div class="product_hover_details_button">
                                    <a href="<?php the_permalink();?>"  class="button-fill-color"><?php esc_html_e('View Details','mayosis-core');?></a>
                                </div>

                            </div>
                        <?php } else { ?>
                            <div class="product-masonry-description masonry-style-two">

                                <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>

                                <div class="bottom-metaflex">
                                    <?php if ( function_exists( 'edd_favorites_load_link' ) ) {
                                        edd_favorites_load_link( $download_id );
                                    } ?> <span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">

								     <i class="zil zi-user"></i>
								 </a></span>
                                </div>
                            </div>
                        <?php } ?>

                    <?php } ?>
                    
                     <?php if ($masonrymetastate=="enable"){?>
                                <div class="product-meta">
                                <?php get_template_part( 'includes/product-meta' ); ?>
                            </div>
                            <?php } ?>
                </div>
            </div>
            </div>
        <?php endwhile; else : ?>
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
<?php mayosis_page_navs();?>
</div>

</div>
     
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_archive_masonry);
?>