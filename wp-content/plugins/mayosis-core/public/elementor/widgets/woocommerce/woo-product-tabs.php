<?php

/**
 * @author TeconceTheme
 * @since   1.0
 * @version 1.0
 */

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class mayosis_woo_p_tab extends Widget_Base
{

    public function get_name()
    {
        return 'mayosis_woo_p_tab';
    }

    public function get_title()
    {
        return __('Mayosis Woo Product Tabs', 'elitio');
    }
    public function get_categories()
    {
        return ['mayosis-woo-cat'];
    }
    public function get_icon()
    {
        return 'eicon-tabs';
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'eliteo_product_tabs',
            [
                'label' => __('Content', 'elitio'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );




        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__( 'Title', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'List Title' , 'textdomain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'select_tab_conent',
            [
                'label' => __('Select Tab Content', 'mayosis-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'product',
                'options' => [
                    'product'  => __('Product', 'mayosis-core'),
                    'content' => __('Content', 'mayosis-core'),

                ],
            ]
        );

        $repeater->add_control(
            'tab_content_shortcode',
            [
                'label' => esc_html__( 'Content', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'placeholder' => esc_html__( 'Type your content here', 'textdomain' ),
                'condition' => [
                    'select_tab_conent' => 'content',
                ],
            ]
        );

        $repeater->add_control(
            'category',
            array(
                'label'       => esc_html__('Select Categories', 'pivoo'),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => array_flip(mayosis_items_extracts('categories', array(
                    'sort_order'  => 'ASC',
                    'taxonomy'    => 'product_cat',
                    'hide_empty'  => false,
                ))),
                'label_block' => true,
            )
        );
        $repeater->add_control(
            'order',
            [
                'label' => __('Order', 'elitio'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC'  => __('Descending', 'elitio'),
                    'ASC' => __('Ascending', 'elitio'),
                ],
            ]
        );

        $repeater->add_control(
            'product_type',
            [
                'label' => __('Select Product Type', 'mayosis-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'regular',
                'options' => [
                    'regular'  => __('Recent', 'mayosis-core'),
                    'featured' => __('Featured', 'mayosis-core'),

                ],
            ]
        );
        $repeater->add_control(
            'item_per_page',
            [
                'label' => __('Number of Product to Show', 'elitio'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 8,
            ]
        );
        $repeater->add_control(
            'product_style',
            [
                'label'     => esc_html_x( 'Product Style', 'Admin Panel','mayosis-core' ),
                'description' => esc_html_x('Style for the list"', 'mayosis-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'    =>  "regular",
                "options"    => array(
                    "regular" => "Regular",
                    "masonry" => "Masonry",

                ),
            ]

        );
        $repeater->add_control(
            'list_layout',
            [
                'label'     => esc_html_x( 'Column Layout', 'Admin Panel','mayosis-core' ),
                'description' => esc_html_x('Column layout for the list"', 'mayosis-core' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'    =>  "1/3",
                "options"    => array(
                    "1/1" => "1",
                    "1/2" => "2",
                    "1/3" => "3",
                    "1/4" => "4",
                    "1/5" => "5",
                    "1/6" => "6",
                ),
            ]

        );

        $repeater->add_control(
            'active_tab',
            [
                'label' => esc_html__( 'Active Tab', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'your-plugin' ),
                'label_off' => esc_html__( 'No', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Repeater List', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Title #1', 'textdomain' ),

                    ],
                    [
                        'list_title' => esc_html__( 'Title #2', 'textdomain' ),

                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );






        $this->end_controls_section();


        $this->start_controls_section(
            'tab_style',
            [
                'label' => esc_html__( 'Tab Style', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'masonry_grid_min_height',
            [
                'label' => esc_html__( 'Masonry Min Height', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ]

                ],

                'selectors' => [
                    '{{WRAPPER}} .masonry-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }


    protected function render($instance = [])
    {

        $settings = $this->get_settings_for_display();

        ?>

<div class="msv-tab-desktop d-none d-sm-block">

<ul class="products-tab-list nav d-sm-flex d-none nav-pills pt-20 justify-content-center" id="pills-tab" role="tablist">

<?php foreach (  $settings['list'] as $item ) {
	$active_tab = $item['active_tab'];
	$acvtclass="";
	if($active_tab=="yes"){
		$acvtclass="active";
	}

	?>

	<li class="nav-item" role="presentation">
		<button class="<?php echo esc_html($acvtclass);?>" id="pills-<?php echo esc_attr( $item['_id'] ); ?>-tab" data-bs-toggle="pill" data-bs-target="#pill-<?php echo esc_attr( $item['_id'] ); ?>" type="button" role="tab"  aria-controls="pills-<?php echo esc_attr( $item['_id'] ); ?>"><?php echo $item['list_title']; ?></button>
	</li>
<?php } ?>

</ul><!-- end products-tab-list -->
<div class="tab-content" id="pills-tabContent">
<?php foreach (  $settings['list'] as $item ) {
                $category = $item['category'];
                $product_type = $item['product_type'];
                $item_per_page = $item['item_per_page'];
                $order = $item['order'];
                $active_tab = $item['active_tab'];
                $select_product_style = $item['product_style'];
                $tabcontentype = $item['select_tab_conent'];

                $acvpclass="";
                if($active_tab=="yes"){
                    $acvpclass="show active";
                }

                if($item['list_layout'] == '1/1'){
                    $deskcolclass="col-md-12";

                } elseif($item['list_layout'] == '1/2'){
                    $deskcolclass="col-12 col-md-6";
                    $product_column ="2";
                    $rowclass="";

                } elseif($item['list_layout'] == '1/4'){
                    $deskcolclass="col-12 col-md-3";
                    $product_column ="4";
                    $rowclass="";

                } elseif($item['list_layout'] == '1/5'){
                    $deskcolclass="col";
                    $product_column ="5";
                    $rowclass="row-cols-1 row-cols-md-5";
                } elseif($item['list_layout'] == '1/6'){
                    $deskcolclass="col-12 col-md-2";
                    $product_column ="6";
                    $rowclass="";

                } else {
                    $deskcolclass="col-12 col-md-4";
                    $product_column ="3";
                    $rowclass="";

                }


                ?>
<div class="tab-pane fade <?php echo esc_html($acvpclass);?>" id="pill-<?php echo esc_attr( $item['_id'] ); ?>" role="tabpanel" aria-labelledby="tab-pill-<?php echo esc_attr( $item['_id'] ); ?>">

                <?php if($tabcontentype=="content"){?>
                        <?php echo do_shortcode($item['tab_content_shortcode']);?>
                    <?php } else { ?>

						<?php if ($select_product_style=="masonry"){?>
                    <div class="masonry-wrapper">
                        <div class="product-masonry product-masonry-gutter product-masonry-style-2 product-masonry-masonry product-masonry-full product-masonry-<?php echo $product_column;?>-column">
                            <?php } else { ?>
                            <div class="tab-regular-product-msv">
                                <div class="row <?php echo $rowclass; ?> custom-row-padding justify-content-center">
                                    <?php } ?>


	
                                    <?php



                                    $product_args =  array(
                                        'post_type' => 'product',
                                        'post_status' => 'publish',
                                        'posts_per_page' => $item_per_page,
                                        'order' => $order,

                                    );

                                    if (!empty($category[0])) {
                                        $product_args['tax_query'] = array(
                                            array(
                                                'taxonomy' => 'product_cat',
                                                'field'    => 'ids',
                                                'terms'    => $category
                                            )
                                        );
                                    }
                                    if ($product_type == 'featured') {
                                        $product_args['tax_query'] = array(
                                            array(
                                                'taxonomy' => 'product_visibility',
                                                'field'    => 'name',
                                                'terms'    => 'featured',
                                                'operator' => 'IN',
                                            )
                                        );
                                    }



                                    $the_query = new \WP_Query($product_args);

                                    if ($the_query->have_posts()) :
                                        while ($the_query->have_posts()) :
                                            $the_query->the_post();
                                            global $product;
                                            ?>

                                            <?php
                                            switch ($select_product_style) {
                                                case "masonry":
                                                    get_template_part('/includes/woo/product-styles/masonry-style');
                                                    break;
                                                case "regular":
                                                    echo '<div class=" '. $deskcolclass .' mt-30 ">';
                                                    get_template_part('/includes/woo/product-styles/regular-style');
                                                    echo '</div>';
                                                    break;

                                            }
                                            ?>
                                        <?php endwhile;
										endif;
										wp_reset_postdata();
										?>


								</div>
							</div>
						<?php } ?>


</div><!-- end tab-pane -->

<?php } ?>
</div><!-- end tab-content -->
</div><!-- end products-tab -->


<div class="msv-mobile-accordion d-block d-sm-none">
            <div class="accordion" id="msbmovaccordion">
			<?php foreach (  $settings['list'] as $item ) {
                $category = $item['category'];
                $product_type = $item['product_type'];
                $item_per_page = $item['item_per_page'];
                $order = $item['order'];
                $active_tab = $item['active_tab'];
                $select_product_style = $item['product_style'];
                $tabcontentype = $item['select_tab_conent'];

                $acvpclass="";
                if($active_tab=="yes"){
                    $acvpclass="show";
                }

                if($item['list_layout'] == '1/1'){
                    $deskcolclass="col-md-12";

                } elseif($item['list_layout'] == '1/2'){
                    $deskcolclass="col-12 col-md-6";
                    $product_column ="2";
                    $rowclass="";

                } elseif($item['list_layout'] == '1/4'){
                    $deskcolclass="col-12 col-md-3";
                    $product_column ="4";
                    $rowclass="";

                } elseif($item['list_layout'] == '1/5'){
                    $deskcolclass="col";
                    $product_column ="5";
                    $rowclass="row-cols-1 row-cols-md-5";
                } elseif($item['list_layout'] == '1/6'){
                    $deskcolclass="col-12 col-md-2";
                    $product_column ="6";
                    $rowclass="";

                } else {
                    $deskcolclass="col-12 col-md-4";
                    $product_column ="3";
                    $rowclass="";

                } ?>
  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#acc-<?php echo esc_attr( $item['_id'] ); ?>" aria-expanded="true" aria-controls="msbmovaccordion">
                            <?php echo $item['list_title']; ?>
                        </button>
                    </h2>

					<div id="acc-<?php echo esc_attr( $item['_id'] ); ?>" class="accordion-collapse collapse <?php echo $acvpclass;?>" aria-labelledby="headingOne" data-bs-parent="#msvmobaccordion">
                        <div class="accordion-body">

						<?php if($tabcontentype=="content"){?>
                                <?php echo do_shortcode($item['tab_content_shortcode']);?>
                            <?php } else { ?>

								<?php if ($select_product_style=="masonry"){?>
                    <div class="masonry-wrapper">
                        <div class="product-masonry product-masonry-gutter product-masonry-style-2 product-masonry-masonry product-masonry-full product-masonry-<?php echo $product_column;?>-column">
                            <?php } else { ?>
                            <div class="tab-regular-product-msv">
                                <div class="row <?php echo $rowclass; ?> custom-row-padding justify-content-center">
                                    <?php } ?>


	
                                    <?php



                                    $product_args =  array(
                                        'post_type' => 'product',
                                        'post_status' => 'publish',
                                        'posts_per_page' => $item_per_page,
                                        'order' => $order,

                                    );

                                    if (!empty($category[0])) {
                                        $product_args['tax_query'] = array(
                                            array(
                                                'taxonomy' => 'product_cat',
                                                'field'    => 'ids',
                                                'terms'    => $category
                                            )
                                        );
                                    }
                                    if ($product_type == 'featured') {
                                        $product_args['tax_query'] = array(
                                            array(
                                                'taxonomy' => 'product_visibility',
                                                'field'    => 'name',
                                                'terms'    => 'featured',
                                                'operator' => 'IN',
                                            )
                                        );
                                    }



                                    $the_query = new \WP_Query($product_args);

                                    if ($the_query->have_posts()) :
                                        while ($the_query->have_posts()) :
                                            $the_query->the_post();
                                            global $product;
                                            ?>

                                            <?php
                                            switch ($select_product_style) {
                                                case "masonry":
                                                    get_template_part('/includes/woo/product-styles/masonry-style');
                                                    break;
                                                case "regular":
                                                    echo '<div class=" '. $deskcolclass .' mt-30 ">';
                                                   get_template_part('/includes/woo/product-styles/regular-style');
                                                    echo '</div>';
                                                    break;

                                            }
                                            ?>
                                        <?php endwhile;
										endif;
										wp_reset_postdata();
										?>


								</div>
							</div>


								<?php } ?>







							</div><!--end accordion-body -->
						</div><!--end accordion-collapse -->

</div><!-- end accordion-item -->

<?php } ?>

			</div><!-- end accordion -->
</div><!-- end msv-mobile-accordion -->






        <?php

    }
    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }
}
Plugin::instance()->widgets_manager->register(new mayosis_woo_p_tab);
?>