<?php
if (!defined('ABSPATH')) die('-1');

class VCExtendAddonClassjustifiedgrid
{

    function __construct()
    {
        add_action('init', array($this, 'justifiedWithVC'));
        add_action('wp_enqueue_scripts', array($this, 'productCSSAndJS'));
        add_shortcode('edd_jusitifed_grid', array($this, 'renderJustifiedgrid'));
    }

    public function justifiedWithVC()
    {
        $categories_array = array(esc_html__('Select Category', 'mayosis-core') => '');
        $category_list = get_terms('download_category', array('hide_empty' => false));

        if (is_array($category_list) && !empty($category_list)) {
            foreach ($category_list as $category_details) {
                $begin = __(' (ID: ', 'mayosis-core');
                $end = __(')', 'mayosis-core');
                $categories_array[$category_details->name . $begin . $category_details->term_id . $end] = $category_details->term_id;
            }
        }

        vc_map(array(

            "base" => "edd_jusitifed_grid",
            "name" => __("Mayosis EDD Justified Grid", 'mayosis-core'),
            "description" => __("Mayosis easy digital download justified product grid", 'mayosis-core'),
            "class" => "",
            "icon" => get_template_directory_uri() . '/images/DM-Symbol-64px.png',
            "category" => __("Mayosis Elements", 'mayosis-core'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Amount of Edd Recent to display:", 'mayosis-core'),
                    "param_name" => "num_of_posts",
                    "description" => __("Choose how many news posts you would like to display.", 'mayosis-core'),
                    'value' => __('3', 'mayosis-core'),
                ),

                array(
                    "type" => "dropdown",
                    "heading" => __("Post Order", 'mayosis-core'),
                    "param_name" => "post_order",
                    "description" => __("Set the order in which news posts will be displayed.", 'mayosis-core'),
                    "value" => array('DESC' => 'DESC', 'ASC' => 'ASC'), //Add default value in $atts
                ),

                array(
                    "type" => "dropdown",
                    "heading" => __("Show Product Category", 'mayosis-core'),
                    "param_name" => "category_product",
                    "description" => __("Show Product By Category", 'mayosis-core'),
                    "value" => array('No' => 'no','Yes' => 'yes' ), //Add default value in $atts
                ),
                
                 array(
                    "type" => "dropdown",
                    "heading" => __("Show Product Category Filter", 'mayosis-core'),
                    "param_name" => "filterproduct",
                    "description" => __("Show Product Filter", 'mayosis-core'),
                    "value" => array( 'No' => 'no','Yes' => 'yes'), //Add default value in $atts
                ),

                array(
                    "type" => "dropdown",
                    "heading" => __("Category", 'mayosis-core'),
                    "param_name" => "downloads_category",
                    "description" => __("Select a category", 'mayosis-core'),
                    'value' => $categories_array,
                    "dependency" => Array('element' => "category_product", 'value' => array('yes'))

                ),

                array(
                    'type' => 'textfield',
                    'heading' => __('Grid Gap', 'mayosis-core'),
                    'param_name' => 'grid_gap',
                    'value' => __('2.5', 'mayosis-core'),
                    'description' => __('Input integer value without px (ie. 5)', 'mayosis-core'),
                ),
             array(
                    "type" => "textfield",
                    "heading" => __("Custom Css", 'mayosis-core'),
                    "param_name" => "custom_css",
                    "description" => __("Custom Css Name", 'mayosis-core'),
                    'value' => __('', 'mayosis-core'),
                ),
                
                  array(
                    "type" => "dropdown",
                    "heading" => __("Show Product Hover Title", 'mayosis-core'),
                    "param_name" => "titlebox",
                    "description" => __("Show Product Filter", 'mayosis-core'),
                    "value" => array('No' => 'no','Yes' => 'yes'), //Add default value in $atts
                ),
                
                array(
                    "type" => "dropdown",
                    "heading" => __("Show Product Hover Title", 'mayosis-core'),
                    "param_name" => "titileboxstyle",
                    "description" => __("Show Product Hover Title Style", 'mayosis-core'),
                    "value" => array('Style One' => 'one', 'Style Two' => 'two','Style Three' => 'three'), //Add default value in $atts
                ),
            )

        ));
    }


    public function renderJustifiedgrid($atts, $content = null){

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
        $css = '';
        extract(shortcode_atts(array(
            "num_of_posts" => '3',
            "column_of_posts" => '3',
            "post_order" => 'DESC',
            'category_product' =>'no',
            'downloads_category' => '',
            'grid_gap' =>'',
            'filterproduct' => 'no',
            'titlebox' => 'no',
            'titileboxstyle' => 'one',
            'custom_css' => ''
        ), $atts));
        


        /* ================  Render Shortcodes ================ */



        ob_start();
        global $post;
        if( $category_product == 'no' ) {
            //Fetch data
            $arguments = array(
                'post_type' => 'download',
                'post_status' => 'publish',
                //'posts_per_page' => -1,
                'order' => (string) trim($post_order),
                'posts_per_page' => $num_of_posts,
                'ignore_sticky_posts' => 1,

            );

            $post_query = new WP_Query($arguments);


        } else {

            //Fetch data
            $arguments = array(
                'post_type' => 'download',
                'post_status' => 'publish',
                //'posts_per_page' => -1,
                'order' => (string) trim($post_order),
                'posts_per_page' => $num_of_posts,
                'ignore_sticky_posts' => 1,

                'tax_query' => array(
                    array(
                        'taxonomy' => 'download_category',
                        'field' => 'term_id',
                        'terms' => $downloads_category,
                    )
                )
                //'tag' => get_query_var('tag')
            );
            $post_query = new WP_Query($arguments);
        }




        ?>
        <?php
        global $post;
        $author = get_user_by( 'id', get_query_var( 'author' ) );
        $author_id=$post->post_author;
        ?>
        <div class="<?php
		echo esc_attr($custom_css); ?>">
        <div class="row">
            <div class="col-md-12">
            <?php  if( $filterproduct == 'yes' ) : ?>
              <div id="justifiedfiltercontrol">
                            <button value="*"><?php esc_html_e('All Categories','mayosis-core'); ?></button>
                            <?php

                            $taxonomy = 'download_category';
                            $terms = get_terms($taxonomy); // Get all terms of a taxonomy

                            if ( $terms && !is_wp_error( $terms ) ) :
                                ?>

                                <?php foreach ( $terms as $term ) { ?>
                                <button value=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></button>
                            <?php } ?>

                            <?php endif;?>
                        </div>
            <?php endif;?>
                        

                <div class="gridzy justified-gallery-main gridzyLightProgressIndicator gridzyAnimated" data-gridzy-spaceBetween="<?php echo esc_html($grid_gap);?>" data-gridzy-filterControls="#justifiedfiltercontrol button">
                    <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
                        <?php
                        $terms = get_the_terms( $post->ID, 'download_category' );// Get all terms of a taxonomy
                        $cls = '';

                        if ( ! empty( $terms ) ) {
                            foreach ( $terms as $term ) {
                                $cls .= $term->slug . ' ';
                            }
                        }
                        ?>
                        <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                        <div class="justified-items <?php echo $cls; ?> ">
                            <div <?php post_class(); ?>>
                            <div class="product-justify-item-content">
                                
                                    <?php if ( has_post_format( 'video' )) { ?>
                                        <div class="item-thumbnail item-video-justify">
                                            <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
                                        </div>
                                    <?php } else { ?>
                                    <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                                    <div class="item-thumbnail">
                                    <a href="<?php the_permalink();?>"><img src="<?php echo $thumbnail['0']; ?>" alt=""></a>
                                     </div>
                                    <?php } ?>
                                
                                <?php if ($titlebox=="yes"){?>
                                
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
                    <?php endwhile; ?>





                        <div class="clearfix"></div>
                    <?php endif; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
        </div>
        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }


    /*
        Load plugin css and javascript files which you may need on front end of your site
        */
    public function productCSSAndJS()
    {
        //  wp_register_style( 'vc_extend_style', plugins_url('assets/vc_extend.css', __FILE__) );
        // wp_enqueue_style( 'slick-slider-css', get_template_directory_uri() . '/css/slick.css' );

        // If you need any javascript files on front end, here is how you can load them.
    }
}
new VCExtendAddonClassjustifiedgrid();
