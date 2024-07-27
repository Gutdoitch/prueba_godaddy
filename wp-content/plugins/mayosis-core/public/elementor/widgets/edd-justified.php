<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_edd_justified_Elementor extends Widget_Base {

    public function get_name() {
        return 'mayosis-edd-justified';
    }

    public function get_title() {
        return __( 'Mayosis EDD Justified Grid', 'mayosis-core' );
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
                'label' => __( 'Mayosis EDD Justified', 'mayosis-core' ),
                'type' => Controls_Manager::SECTION,
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
      'category',
      array(
        'label'       => esc_html__( 'Select Categories', 'mayosis-core' ),
        'type'        => Controls_Manager::SELECT2,
        'multiple'    => true,
        'section' => 'section_edd',
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
                'section' => 'section_edd',
            ]
        );
        
          $this->add_control(
      'tags',
      array(
        'label'       => esc_html__( 'Select Tags', 'mayosis-core' ),
        'type'        => Controls_Manager::SELECT2,
        'multiple'    => true,
        'section' => 'section_edd',
        'options'     => array_flip(mayosis_items_extracts( 'tags', array(
          'sort_order'  => 'ASC',
          'taxonomies'    => 'download_tag',
          'hide_empty'  => false,
        ) )),
        'label_block' => true,
      )
    );
    
        $this->add_control(
            'filter-product',
            [
                'label' => __( 'Show Product Filter', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'show' => 'Show',
                    'hide' => 'Hide'
                ],
                'default' => 'hide',

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
         $this->add_control(
            'titilebox',
            [
                'label' => __( 'Title Hover Box', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'show' => 'Show',
                    'hide' => 'Hide'
                ],
                'default' => 'hide',

            ]
        );
        
        $this->add_control(
            'titileboxstyle',
            [
                'label' => __( 'Title Box Style', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'one' => 'One',
                    'two' => 'Two',
                    'three' => 'three'
                ],
                'default' => 'one',

            ]
        );
        
        $this->add_control(
            'grid_gap',
            [
                'label' => __( 'Grid Gap', 'mayosis-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'title' => __( 'Enter Grid gap Without PX', 'mayosis-core' ),
                'section' => 'section_edd',
                'default' => '2.5',
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
	
$this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        // get our input from the widget settings.

        $settings = $this->get_settings();
        $post_count = ! empty( $settings['item_per_page'] ) ? (int)$settings['item_per_page'] : 5;
        $post_order_term=$settings['order'];
        $categories= $settings['category'];
        $downloads_category_not=$settings['categorynotin'];
        $filterproduct = $settings['filter-product'];
        $custom_css = $settings['custom_css'];
        $grid_gap= $settings['grid_gap'];
        $titlebox = $settings['titilebox'];
        $titileboxstyle = $settings['titileboxstyle'];
        $tags = $settings['tags'];
        ?>

   
        <div class="<?php
        echo esc_attr($custom_css); ?>">
            <div class="row">
                <div class="col-md-12">
                    <?php  if( $filterproduct == 'show' ) : ?>
                         <div id="justifiedfiltercontrol">
                            <button value="*"><?php esc_html_e('All Categories','mayosis-core'); ?></button>
                            <?php

                            $taxonomy = 'download_category';
                             $args = array('orderby'=>'count','hide_empty'=>true, 'parent'   => 0,);
                            $terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy

                            if ( ! empty( $terms ) && is_array( $terms )  ) :
                                ?>

                                <?php foreach ( $terms as $term ) { ?>
                                <button value=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></button>
                            <?php } ?>

                            <?php endif;?>
                        </div>
                    <?php endif;?>


                    <div class="gridzy justified-gallery-main gridzyLightProgressIndicator gridzyAnimated" data-gridzy-spaceBetween="<?php echo esc_html($grid_gap);?>" data-gridzy-filterControls="#justifiedfiltercontrol button">

        <?php
        global $post;
       
            $args = array('post_type' => 'download', 'numberposts' => $post_count, 'order' => (string)trim($post_order_term),);
        
        
        
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
                        <div class="justified-items <?php echo $cls; ?> ">
                            
                            <div <?php post_class(); ?>>
                            <div class="product-justify-item-content">
                                
                                    <?php if ( has_post_format( 'video' )) {
                                      $mayosis_video = get_post_meta($post->ID, 'video_url',true);
                        
                        if (strpos($mayosis_video,'youtube.com')==true){
                            $mayosis_video_cls="mayosis-youtube-hosted-video";
                            
                        } elseif (strpos($mayosis_video,'vimeo')==true){
                            $mayosis_video_cls="mayosis-vimeo-hosted-video";
                        } else {
                            
                            $mayosis_video_cls="mayosis-self-hosted-video";
                            
                        }
                                    
                                    ?>
                                        <div class="item-thumbnail item-video-justify <?php echo esc_html($mayosis_video_cls);?>">
                                            <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
                                        </div>
                                    <?php } else { ?>
                                    <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                                    <div class="item-thumbnail">
                                    <a href="<?php the_permalink();?>"><img src="<?php echo $thumbnail['0']; ?>" alt=""></a>
                                     </div>
                                    <?php } ?>
                                
                                <?php if ($titlebox=="show"){?>
                                
                                <?php if ($titileboxstyle== "one"){ ?>
                                <div class="product-justify-description">
                                    
                                    <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                                    </div>
                                    
                                <?php } elseif ($titileboxstyle== "three"){ ?>
                                
                                 <div class="product-justify-description justify-style-three">
                                     <div class="product_hover_details_button">
                                  <a href="<?php the_permalink();?>"  class="button-fill-color"><?php esc_html_e('View Details','mayosis-core');?></a>
                                </div>
                                    
                                    </div>
                                <?php } else { ?>
                                <div class="product-justify-description justify-style-two">
                                    
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
                                
                                
                            
                            
                            </div>
                            </div>
                        </div>

        <?php } ?>



                        <div class="clearfix"></div>
                        <?php  wp_reset_postdata();
                        ?>




                </div>
                </div>
            </div>
        </div>


        <?php

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_edd_justified_Elementor );
?>