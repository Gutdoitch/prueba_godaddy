<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_edd_grid_Elementor_Thing extends Widget_Base {

    public function get_name() {
        return 'mayosis-edd-grid';
    }

    public function get_title() {
        return __( 'Mayosis Small Grid', 'mayosis-core' );
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
                'label' => __( 'Mayosis Small Grid', 'mayosis-core' ),
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
            'selectoption',
            [
                'label' => __( 'Right Side Option', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'button' => 'Button',
                    'category' => 'Category Filter'
                ],
                'default' => 'button',

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
                 'condition' => [
                    'selectoption' => array('button'),
                ],
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
                         'condition' => [
                    'selectoption' => array('button'),
                ],
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
            'grid_type',
            [
                'label' => __( 'Grid Type', 'mayosis-core' ),
                'type' => Controls_Manager::SELECT,
                'section' => 'section_edd',
                'options' => [
                    'normal' => 'Normal',
                    'waterfall' => 'Masonry',
                    'justified' => 'Justified'
                ],
                'default' => 'normal',

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
        $recent_section_title = $settings['title'];
        $post_count = ! empty( $settings['item_per_page'] ) ? (int)$settings['item_per_page'] : 5;
         $categories= $settings['category'];
        $downloads_category_not=$settings['categorynotin'];
        $post_order_term=$settings['order'];
        $sub_title = $settings['sub_title'];
        $tags = $settings['tags'];
        $title_sec_margin = $settings['margin_bottom'];
        $button_text = $settings['button_text'];
        $button_link = $settings['button_link'];
        $selectoption = $settings['selectoption'];
        $grid_type = $settings['grid_type'];
        ?>
    
        <div class="edd_recent_ark">

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
                if ($selectoption=='button') { ?>
                    <?php
                    if ($button_link) { ?>
                        <a href="<?php echo esc_attr($button_link); ?>" class="btn title--box--btn"><?php echo esc_attr($button_text); ?></a>
                    <?php } ?>
                    
                     <?php } else { ?>
                 <div class="regular-category-search">
            <select class="mayosis-filters-select-small">
                <option value="*"><?php esc_html_e('All Categories','mayosis-core'); ?></option>
                            <?php

                            $taxonomy = 'download_category';
                           $args = array('orderby'=>'count','hide_empty'=>true, 'parent'   => 0,);
                            $terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy

                            if ( $terms && !is_wp_error( $terms ) ) :
                                ?>

                                <?php foreach ( $terms as $term ) { ?>
                                <option value=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                            <?php } ?>
                            
                            <?php endif;?>

          
            </select>
        </div>
        <?php } ?>
                </div>
            </div>
            <div class="product--grid--elementor <?php
                if ($selectoption=='category') { ?>gridboxsmall<?php }?>">

                <?php
                global $post;
               
                    $args = array( 'post_type' => 'download','numberposts' => $post_count, 'order' => (string) trim($post_order_term), );
               
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
                $recent_posts = get_posts( $args ); ?>
                <?php
                 if ($grid_type=="waterfall"){
                     $gridzy= 'gridzy';
                     $grid_state = 'data-gridzy-layout="waterfall"';
                 } elseif ($grid_type=="justified") {
                      $gridzy= 'gridzy';
                     $grid_state = 'data-gridzy-layout="justified"';
                 } else{
                      $gridzy= '';
                     $grid_state ='';
                 }
                ?>
                <ul class="recent_image_block <?php echo esc_html($gridzy);?>"  <?php echo esc_attr($grid_state);?>>
                    <?php foreach( $recent_posts as $post ){?>
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
                        <li class="grid-product-box <?php echo $cls; ?>">
                            <div class="product-thumb grid_dm">
                                <figure class="mayosis-fade-in">
                                    <?php
                                    the_post_thumbnail( 'mayosis-grid-small', array( 'class' => 'img-responsive' ) );
                                    ?>
                                    <figcaption>
                                        <div class="overlay_content_center">
                                            <a href="<?php
                                            the_permalink(); ?>"><i class="zil zi-plus"></i></a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </li>

                    <?php } ?>
                </ul>
                <?php  wp_reset_postdata();
                ?>
            </div>


        </div>
        <?php

    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_edd_grid_Elementor_Thing );
?>