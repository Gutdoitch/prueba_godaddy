<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_related_products extends Widget_Base {

   public function get_name() {
      return 'mayosis-rel-p';
   }

   public function get_title() {
      return __( 'Mayosis Related Product', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-product-related';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_related_products',
			[
				'label' => __( 'Related Product', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
        $this->add_control(
			'product_stl',
			[
				'label' => __( 'Product Style', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one'  => __( 'Regular', 'mayosis-core' ),
					'two' => __( 'Masonry', 'mayosis-core' ),
					'four' => __( 'Justified', 'mayosis-core' ),
					'three' => __( 'List', 'mayosis-core' ),
				
				],
			]
		);
		
		$this->add_control(
			'post_number',
			[
				'label' => __( 'Number of Post', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '3',
			
			]
		);
            
            $this->add_control(
			'product_col_grid',
			[
				'label' => __( 'Product Column', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'two',
				'condition' => [ 'product_stl' => 'one' ],
				'options' => [
					'one'  => __( 'Two', 'mayosis-core' ),
					'two' => __( 'Three', 'mayosis-core' ),
					'three' => __( 'Four', 'mayosis-core' ),
					'five' => __( 'Five', 'mayosis-core' ),
					'four' => __( 'Six', 'mayosis-core' ),
				
				],
			]
		);
		
		$this->add_control(
			'product_thumb_video',
			[
				'label' => __( 'Product Thumbnail Video', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'hide',
				'condition' => [ 'product_stl' => 'one' ],
				'options' => [
					'show'  => __( 'Show', 'mayosis-core' ),
					'hide' => __( 'Hide', 'mayosis-core' ),
					
				
				],
			]
		);
		
		$this->add_control(
			'product_v_control',
			[
				'label' => __( 'Product Video Control', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'full',
				'condition' => [ 'product_stl' => 'one' ],
				'options' => [
					'full'  => __( 'Full', 'mayosis-core' ),
					'minimal' => __( 'Minimal', 'mayosis-core' ),
					
				
				],
			]
		);
		
		$this->add_control(
			'product_cart_show',
			[
				'label' => __( 'Product Cart Show', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'hide',
				'condition' => [ 'product_stl' => 'one' ],
				'options' => [
					'show'  => __( 'Show', 'mayosis-core' ),
					'hide' => __( 'Hide', 'mayosis-core' ),
					
				
				],
			]
		);
		
			$this->add_control(
			'product_thumb_h_style',
			[
				'label' => __( 'Product Hover Style', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'condition' => [ 'product_stl' => 'one' ],
				'options' => [
					'style1'  => __( 'Style One', 'mayosis-core' ),
					'style2' => __( 'Style Two', 'mayosis-core' ),
					'style3' => __( 'Style Three', 'mayosis-core' ),
					
				
				],
			]
		);
             $this->add_control(
			'masonry_col',
			[
				'label' => __( 'Masonry Columns', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '2',
				'condition' => [ 'product_stl' => 'two' ],
				'options' => [
					'2'  => __( 'Two', 'mayosis-core' ),
					'3' => __( 'Three', 'mayosis-core' ),
					'4' => __( 'Four', 'mayosis-core' ),
					'5' => __( 'Five', 'mayosis-core' ),
				
				],
			]
		);
            
        
    
            
			 $this->add_responsive_control(
                'tag_padding',
                [
                    'label' => __( 'Padding', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} ul.mayosis-exif-lists li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
            
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $product_stl = $settings['product_stl'];
       $posts_number = $settings['post_number'];
       $masonry_col = $settings['masonry_col'];
       $productarchivecolgrid = $settings['product_col_grid'];
       $productthumbvideo = $settings['product_thumb_video'];
       $productvcontrol = $settings['product_v_control'];
       $productcartshow = $settings['product_cart_show'];
       $productthumbhoverstyle = $settings['product_thumb_h_style'];
       if($productarchivecolgrid=="five"){
           $fivecol ="row-cols-1 row-cols-md-5 ";
       } else {
            $fivecol ="";
       }
      ?>

<?php if($product_stl=="two"){?>
<div class="mayosis-single-builderrel-pro-bd mayo-ele-relp-style-<?php echo $product_stl; ?>">
    
    <?php } else { ?>
    <div class="row <?php echo $fivecol; ?> mayosis-single-builderrel-pro-bd mayo-ele-relp-style-<?php echo $product_stl; ?>">
    
    <?php } ?>

            <?php if($product_stl=="one"){?>
            
             <?php global $post;
    $original_post = $post;
    $exclude_post_id = $post->ID;
    $taxchoice = isset( $edd_options['related_filter_by_cat'] ) ? 'download_tag' : 'download_category';
    $custom_taxterms = wp_get_object_terms( $post->ID, $taxchoice, array('fields' => 'ids') );
    $args = array(
        'post_type' => 'download',
        'post_status' => 'publish',
        'posts_per_page' => $posts_number,
        'orderby' => 'rand',
        'ignore_sticky_posts' => 1,
        'post__not_in' => array($post->ID),
        'ignore_sticky_posts'=>1,
        'tax_query' => array(
            array(
                'taxonomy' => $taxchoice,
                'field' => 'id',
                'terms' => $custom_taxterms
            )
        ),
    );
    $popularposts = new \WP_Query($args);
    if ($popularposts->have_posts()):
        while ($popularposts->have_posts()):
            $popularposts->the_post() ?>
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
            <?php
        endwhile;
    endif;
    $post = $original_post;
    wp_reset_postdata();
            ?>
            
            <?php } elseif($product_stl=="two") {?>
                <div class="product-masonry product-masonry-gutter product-masonry-masonry product-masonry-full product-masonry-<?php echo esc_html($masonry_col);?>-column">
                <?php mayosis_related_product_masonry($posts_number);?>
                </div>
                
                
                  <?php } elseif($product_stl=="four") {
                  $justified_gap= get_theme_mod( 'product_justified_gap','5' );
                  ?>
                <div class="gridzy justified-gallery-main gridzyLightProgressIndicator gridzyAnimated" data-gridzy-spaceBetween="<?php echo esc_html($justified_gap);?>">
                <?php mayosis_related_product_justified($posts_number);?>
                </div>
                
            <?php } else { 
            
             mayosis_related_product_footer( $posts_number  );?>
            
            
       <?php }
 ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_related_products);
?>