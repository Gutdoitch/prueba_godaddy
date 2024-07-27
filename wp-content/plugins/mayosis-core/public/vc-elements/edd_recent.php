<?php
if (!defined('ABSPATH')) die('-1');

class VCExtendAddonClassrecentgrid
{

    function __construct()
    {
        add_action('init', array($this, 'recentWithVC'));
        add_action('wp_enqueue_scripts', array($this, 'productCSSAndJS'));
        add_shortcode('digital_edd_recent', array($this, 'renderJustifiedgrid'));
    }

    public function recentWithVC()
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

            "base" => "digital_edd_recent",
            "name" => __("Mayosis Regular Grid", 'mayosis-core'),
            "description" => __("Mayosis easy digital download recent product grid", 'mayosis-core'),
            "class" => "",
            "icon" => get_template_directory_uri() . '/images/DM-Symbol-64px.png',
            "category" => __("Mayosis Elements", 'mayosis-core'),
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Section Title', 'mayosis-core') ,
                    'param_name' => 'recent_section_title',
                    'value' => __('Recent Edd', 'mayosis-core') ,
                    'description' => __('Title for Recent Section', 'mayosis-core') ,
                ) ,
                array(
                    "type" => "textfield",
                    "heading" => __("Amount of Edd Recent to display:", 'mayosis-core') ,
                    "param_name" => "num_of_posts",
                    "description" => __("Choose how many news posts you would like to display.", 'mayosis-core') ,
                    'value' => __('3', 'mayosis-core') ,
                ) ,
                array(
                    "type" => "dropdown",
                    "heading" => __("Amount of Edd Recent Column:", 'mayosis-core') ,
                    "param_name" => "column_of_posts",
                    "description" => __("Choose how many news posts you would like to display.", 'mayosis-core') ,
                    "value" => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6'
                    ) , //Add default value in $atts
                ) ,
                array(
                    "type" => "dropdown",
                    "heading" => __("Choose Meta Option", 'mayosis-core') ,
                    "param_name" => "metaoption",
                    "description" => __("Product Meta Option", 'mayosis-core') ,
                    "value" => array(
                        'Global' => 'global',
                        'Custom' => 'custom'
                    ) , //Add default value in $atts
                ) ,

                array(
                    "type" => "dropdown",
                    "heading" => __("Meta Option Type", 'mayosis-core') ,
                    "param_name" => "metaoptiontype",
                    "description" => __("Product Meta Option Type", 'mayosis-core') ,
                    "value" => array(
                        'None' => 'none',
                        'Vendor' => 'vendor',
                        'Category' =>'category',
                        'Vendor & Category' => 'vendorcat',
                        'Sales & Download' => 'sales',
                    ) , //Add default value in $atts

                    "dependency" => Array(
                        'element' => "metaoption",
                        'value' => array(
                            'custom'
                        )
                    )
                ) ,

                array(
                    "type" => "dropdown",
                    "heading" => __("Pricing Option", 'mayosis-core') ,
                    "param_name" => "productpriceoption",
                    "description" => __("Product Pricing Option", 'mayosis-core') ,
                    "value" => array(
                        'None' => 'none',
                        'Price' => 'price',
                    ) , //Add default value in $atts

                    "dependency" => Array(
                        'element' => "metaoption",
                        'value' => array(
                            'custom'
                        )
                    )
                ) ,

                array(
                    "type" => "dropdown",
                    "heading" => __("Free Pricing Option", 'mayosis-core') ,
                    "param_name" => "freepricingoption",
                    "description" => __("Free Product Pricing Option", 'mayosis-core') ,
                    "value" => array(
                        '$0.00' => 'none',
                        'Custom Text' => 'custom',
                    ) , //Add default value in $atts

                    "dependency" => Array(
                        'element' => "metaoption",
                        'value' => array(
                            'custom'
                        )
                    )
                ) ,

                array(
                    "type" => "textfield",
                    "heading" => __("Custom text", 'mayosis-core') ,
                    "param_name" => "customtext",
                    "value" => '',
                    "description" => __("Set Custom text i.e. FREE", 'mayosis-core') ,
                    "dependency" => Array(
                        'element' => "metaoption",
                        'value' => array(
                            'custom'
                        )
                    )
                ) ,
                
                	array(
			    "heading" => __( "Subtitle", "mayosis" ),
                "description" => __("Enter Sub title","mayosis"),
                 "param_name" => "sub_title",
                "type" => "textfield",
                
			    ),
		
			array(
			    "heading" => __( "Title Margin Bottom", "mayosis" ),
                "description" => __("Title Section Margin Bottom (With px)","mayosis"),
                 "param_name" => "title_sec_margin",
                "type" => "textfield",
                
			    ),
			    
			    array(
                    "type" => "dropdown",
                    "heading" => __("Right Side Option", 'mayosis-core') ,
                    "param_name" => "selectoption",
                    "description" => __("Set the order in which news posts will be displayed.", 'mayosis-core') ,
                    "value" => array(
                        'Button' => 'Button',
                        'Category Filter' => 'category'
                    ) , //Add default value in $atts
                ) ,
			    
			    array(
			    "heading" => __( "Exclude Terms", "mayosis" ),
                "description" => __("exclude terms by id (i.e 162,122)","mayosis"),
                 "param_name" => "exclude_terms_cat",
                "type" => "textfield",
                 "dependency" => Array('element' => "selectoption", 'value' => array('category'))
                
			    ),
			    
			    array(
			    "heading" => __( "Button Text", "mayosis" ),
                "description" => __("Enter Button Text","mayosis"),
                 "param_name" => "button_text",
                "type" => "textfield",
                
			    ),
			    
			     array(
			    "heading" => __( "Button URL", "mayosis" ),
                "description" => __("Enter Button URL","mayosis"),
                 "param_name" => "button_link",
                "type" => "textfield",
                
			    ),
			    
			    array(
                    "type" => "dropdown",
            "heading" => __("Button Style", 'mayosis-core'),
            "param_name" => "button_style",
            "description" => __("Set Button Style", 'mayosis-core'),
			"value"      => array( 'Solid' => 'solid', 'Ghost' => 'transparent'), //Add default value in $atts
        ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Post Order", 'mayosis-core') ,
                    "param_name" => "post_order",
                    "description" => __("Set the order in which news posts will be displayed.", 'mayosis-core') ,
                    "value" => array(
                        'DESC' => 'DESC',
                        'ASC' => 'ASC'
                    ) , //Add default value in $atts
                ) ,

            array(
                    "type" => "dropdown",
                    "heading" => __("Random Load Product", 'mayosis-core') ,
                    "param_name" => "random",
                    "description" => __("Product Meta Option", 'mayosis-core') ,
                    "value" => array(
                        'No' => 'no',
                        'Yes' => 'yes',
                        
                    ) , //Add default value in $atts
                ) ,
                array(
                    "type" => "dropdown",
                    "heading" => __("Category", 'mayosis-core'),
                    "param_name" => "downloads_category",
                    "description" => __("Select a category", 'mayosis-core'),
                    'value' => $categories_array,
                   

                ),
                

                array(
                    "type" => "textfield",
                    "heading" => __("Custom Css", 'mayosis-core'),
                    "param_name" => "custom_css",
                    "description" => __("Custom Css Name", 'mayosis-core'),
                    'value' => __('', 'mayosis-core'),
                ),
            )

        ));
    }


    public function renderJustifiedgrid($atts, $content = null){

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
        $css = '';
        extract(shortcode_atts(array(
            "recent_section_title" => '',
            "num_of_posts" => '3',
            "column_of_posts" => '3',
            "post_order" => 'DESC',
            'category_product' =>'no',
            'downloads_category' => '',
            'free_product_label' => '1',
            'metaoption' => '',
            'metaoptiontype' => '',
            'productpriceoption' => '',
            'freepricingoption' => '',
            'sub_title' =>'',
			'title_sec_margin' =>'',
			'button_text' =>'',
			'button_link' =>'',
			'button_style' => '',
            'customtext' => '',
            'selectoption' => '',
            'custom_css' => '',
            'random' => '',
            'exclude_terms_cat' => '',
        ), $atts));



        /* ================  Render Shortcodes ================ */



        ob_start();

      
            //Fetch data
            $arguments = array(
                'post_type' => 'download',
                'post_status' => 'publish',
                //'posts_per_page' => -1,
                'order' => (string) trim($post_order),
                'posts_per_page' => $num_of_posts,
                'ignore_sticky_posts' => 1,

            );
            
            if ($random ==="yes"){
                $arguments = array(
                'post_type' => 'download',
                'post_status' => 'publish',
                'orderby' => 'rand',
                'order' => (string) trim($post_order),
                'posts_per_page' => $num_of_posts,
                'ignore_sticky_posts' => 1,

            );
                
            }
              if(!empty($downloads_category[0])) {
      $arguments['tax_query'] = array(
        array(
          'taxonomy' => 'download_category',
          'field'    => 'ids',
          'terms'    => $downloads_category
        )
      );
    }
            

            $post_query = new WP_Query($arguments);


       

            
            
        




        ?>
<?php 
global $post;
$productthumbvideo= get_theme_mod( 'thumbnail_video_play','show' );
$productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
$productvcontrol= get_theme_mod( 'thumb_video_control','minimal' );
$productcartshow= get_theme_mod( 'thumb_cart_button','hide' );
$productthumbhoverstyle= get_theme_mod( 'product_thmub_hover_style','style1' );

?>
        <!-- Element Code start -->
    <div class="<?php
    echo esc_attr($custom_css); ?> edd_recent_ark">
        <div class="title--box--full" style="margin-bottom:<?php echo esc_attr($title_sec_margin); ?>;">
            <div class="title--promo--box">
                <h3 class="section-title"><?php echo esc_attr($recent_section_title); ?> </h3>
                <?php
                if ($sub_title ) { ?>
                    <p><?php echo esc_attr($sub_title); ?></p>
                <?php } ?>
            </div>

            <div class="title--button--box">
                <?php
                if ($selectoption=='button') { ?>
                <?php
                if ($button_link) { ?>
                    <a href="<?php echo esc_attr($button_link); ?>" class="btn title--box--btn <?php echo esc_attr($button_style);?>"><?php echo esc_attr($button_text); ?></a>
                <?php } ?>
                <?php } else { ?>
                 <div class="regular-category-search">
            <select class="mayosis-filters-select">
                <option value="*"><?php esc_html_e('All Categories','mayosis-core'); ?></option>
                            <?php

                            $taxonomy = 'download_category';
                          
                            
                            $args = array('orderby'=>'count','hide_empty'=>true, 'parent'   => 0,);
                            $terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
                            
                              $exclude_terms = array($exclude_terms_cat);

                            if ( ! empty( $terms ) && is_array( $terms ) ) :
                                ?>

                                <?php foreach ( $terms as $term ) {
                                if ( ! empty($exclude_terms) && in_array($term->term_id, $exclude_terms) ) continue;
                               
                                ?>
                                
                                <option value=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                            <?php } ?>
                            
                            <?php endif;?>

          
            </select>
        </div>
        <?php } ?>
            </div>
        </div>

    <div<?php
    echo ($num_of_posts > 3 ? ' id="digital_post"' : ''); ?>>

        <div class="row fix gridbox">
        <?php
    if ($post_query->have_posts()):
    while ($post_query->have_posts()):
        $post_query->the_post(); ?>
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
        <?php
        if ($column_of_posts == "1") { ?>
        <div class="col-md-4 col-xs-12 col-sm-4 product-grid element-item <?php echo $cls; ?>">
        <?php
        }
        elseif ($column_of_posts == "2") { ?>
        <div class="col-md-6 col-xs-12 col-sm-6 product-grid element-item <?php echo $cls; ?>">
        <?php
        }
        elseif ($column_of_posts == "3") { ?>
        <div class="col-md-4 col-xs-12 col-sm-4 product-grid element-item <?php echo $cls; ?>">
        <?php
        }
        elseif ($column_of_posts == "4") { ?>
        <div class="col-md-3 col-xs-12 col-sm-3 product-grid element-item <?php echo $cls; ?>">
            <?php
            }
            elseif ($column_of_posts == "5") { ?>
            <div class="col-md-5ths col-xs-12 col-sm-5ths product-grid element-item <?php echo $cls; ?>">
                <?php
                }
                elseif ($column_of_posts == "6") { ?>
                <div class="col-md-2 col-xs-12 col-sm-2 product-grid element-item <?php echo $cls; ?>">
                    <?php
                    }
                    else { ?>
                    <div class="col-md-4 col-xs-12 col-sm-4 product-grid element-item <?php echo $cls; ?>">
                        <?php
                        } ?>
                      <div <?php post_class(); ?>>
                        <div class="grid_dm ribbon-box group edge">
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
                                    <?php if  ($metaoption == 'custom') { ?>

                                        <div class="product-tag">

                                            <?php
                                            global $edd_logs;
                                            $single_count = $edd_logs->get_log_count(66, 'file_download');
                                            $total_count  = $edd_logs->get_log_count('*', 'file_download');
                                            $sales = edd_get_download_sales_stats( get_the_ID() );
                                            $sales = $sales > 1 ? $sales . ' sales' : $sales . ' sale';
                                            $price = edd_get_download_price(get_the_ID());

                                            $download_cats = get_the_term_list( get_the_ID(), 'download_category', '', _x(' , ', '', 'mayosis-core' ), '' );
                                            ?>

                                            <?php if ( has_post_format( 'audio' )) {
                                                get_template_part( 'includes/edd_title_audio');
                                            } ?>

                                            <?php if ( has_post_format( 'video' )) {
                                                get_template_part( 'includes/edd_title_video');
                                            } ?>
                                            <h4 class="product-title"><a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    $title  = the_title('','',false);
                                                    if(strlen($title) > 40):
                                                        echo trim(substr($title, 0, 38)).'...';
                                                    else:
                                                        echo esc_html($title);
                                                    endif;
                                                    ?>
                                                </a></h4>

                                            <?php if ($metaoptiontype=='vendor'): ?>
                                                <span><a href="<?php echo esc_url(add_query_arg( 'author_downloads', 'true', get_author_posts_url( get_the_author_meta('ID')) )); ?>"><?php the_author(); ?></a></span>
                                            <?php elseif ($metaoptiontype=='category'): ?>
                                                <span><?php echo '<span>' . $download_cats . '</span>'; ?></span>
                                            <?php elseif ($metaoptiontype=='vendorcat'): ?>
                                                <span><?php esc_html_e("by","mayosis"); ?> <a href="<?php echo esc_url(add_query_arg( 'author_downloads', 'true', get_author_posts_url( get_the_author_meta('ID')) )); ?>"><?php the_author(); ?></a>
                                                <?php if ($download_cats):?>
                                                    <?php esc_html_e("in","mayosis"); ?></span> <span><?php echo '<span>' . $download_cats . '</span>'; ?></span>
                                                <?php endif; ?>
                                            <?php elseif ($metaoptiontype=='sales'): ?>
                                                <?php if( $price == "0.00"  ){ ?>
                                                    <p><span><?php $download = $edd_logs->get_log_count(get_the_ID(), 'file_download'); echo ( is_null( $download ) ? '0' : $download ); ?> downloads </span></p>
                                                <?php } else { ?>
                                                    <p><span><?php echo esc_html($sales); ?></span></p>
                                                <?php } ?>
                                            <?php else: ?>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ($productpriceoption=='price'): ?>

                                            <div class="count-download">
                                                <?php if( $price == "0.00"  ){ ?>
                                                    <?php if ($freepricingoption=='none'): ?>
                                                        <span><?php edd_price(get_the_ID()); ?></span>
                                                    <?php else: ?>
                                                        <span><?php echo esc_html($customtext); ?></span>
                                                    <?php endif;?>


                                                <?php } else { ?>
                                                    <div class="product-price promo_price"><?php edd_price(get_the_ID()); ?></div>
                                                <?php } ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php } else { ?>
                                        
                                        <?php get_template_part( 'includes/product-meta' ); ?>

                                    
                                    <?php } ?>

                                </div>

                            </div>
                        </div>

                  </div>
                    </div>

                    <?php
                    endwhile; ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- Element Code / END -->
        </div>
        <div class="clearfix"></div>
    <?php
    endif;
        wp_reset_postdata(); ?>

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
new VCExtendAddonClassrecentgrid();
