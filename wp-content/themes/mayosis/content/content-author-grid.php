<?php
/**
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $post;
$productarchivecolgrid= get_theme_mod( 'product_archive_column_grid','two' );
$author = get_user_by( 'id', get_query_var( 'author' ) );
$productthumbhoverstyle= get_theme_mod( 'product_thmub_hover_style','style1' );
?>
<div class="row fix">
    <?php
    $term=get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $authordownload =get_the_author_meta( 'ID',$author->ID );
    $paged=( get_query_var( 'paged')) ? get_query_var( 'paged') : 1;
    $CatTerms=(isset($term->slug))?$term->slug:null;
    $cat = ( isset( $_GET['download_category'] ) ) ? $_GET['download_category'] : null;
    
     $search = ( isset( $_GET['search'] ) ) ? $_GET['search'] : null;


    
     
    if (! isset( $wp_query->query['orderby'] ) ) {
       
         $args = array(
            'order' => 'DESC',
            'post_type' => 'download',
            'author' => $authordownload,
            'paged' => $paged ,
            'download_category'=>$cat,
            's' =>$search,
             
            );
     
   }
   
  else{
   switch ($wp_query->query['orderby']) {
            case 'newness_asc':
                $args = array(
                    'orderby' => 'newness_asc',
                    'order' => 'ASC',
                    'post_type' => 'download',
                    'download_category'=>$cat,
                    'author' => $authordownload,
                     's' =>$search,
                    'paged' => $paged );
                break;
            case 'newness_desc':
                $args = array(
                    'orderby' => 'newness_desc',
                    'order' => 'DESC',
                    'post_type' => 'download',
                    'download_category'=>$cat,
                    'author' => $authordownload,
                     's' =>$search,
                    'paged' => $paged );
                break;
            case 'sales':
                $args = array(
                    'meta_key'=>'_edd_download_sales',
                    'order' => 'DESC',
                    'orderby' => 'meta_value_num',
                    'download_category'=>$cat,
                    'post_type' => 'download',
                    'author' => $authordownload,
                     's' =>$search,
                    'paged' => $paged );
                break;
            case 'price_asc':
                $args = array(
                    'meta_key'=>'edd_price',
                    'order' => 'ASC',
                    'orderby' => 'meta_value_num',
                    'download_category'=>$cat,
                    'post_type' => 'download',
                    'author' => $authordownload,
                     's' =>$search,
                    'paged' => $paged );
                break;
                
                case 'price_desc':
                $args = array(
                    'meta_key'=>'edd_price',
                    'order' => 'DESC',
                    'orderby' => 'meta_value_num',
                    'download_category'=>$cat,
                    'post_type' => 'download',
                    'author' => $authordownload,
                     's' =>$search,
                    'paged' => $paged );
                break;
                
                case 'title_asc':
                $args = array(
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'download_category'=>$cat,
                    'post_type' => 'download',
                    'author' => $authordownload,
                     's' =>$search,
                    'paged' => $paged );
                break;
                
                case 'title_desc':
                $args = array(
                    'orderby' => 'title',
                    'order' => 'DESC',
                    'download_category'=>$cat,
                    'post_type' => 'download',
                    'author' => $authordownload,
                     's' =>$search,
                    'paged' => $paged );
                break;
        } }
    $temp = $wp_query; $wp_query = null;
    $wp_query = new WP_Query(); $wp_query->query($args); ?>
    <?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
    
    <?php if ($productarchivecolgrid=='one'): ?>
    <div class="col-md-6 col-12 col-sm-6 product-grid">
        <?php elseif ($productarchivecolgrid=='two'): ?>
        <div class="col-md-4 col-12 col-sm-4 product-grid">
            <?php elseif ($productarchivecolgrid=='four'): ?>
            <div class="col-md-2 col-12 col-sm-2 product-grid">
            <?php else:?>
            <div class="col-md-3 col-12 col-sm-3 product-grid">
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
                            <?php
                            // display featured image?
                            if ( has_post_thumbnail() ) :
                                the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                            endif;

                            ?>
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
                                    <a href="<?php the_permalink(); ?>" class="button-fill-color"><?php esc_html_e('View Details', 'mayosis'); ?></a>
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
                      

                        </figure>
                        <div class="product-meta">
                            <?php get_template_part( 'includes/product-meta' ); ?>

                        </div>
                    </div>
                </div>
            </div>
            </div>
<?php endwhile; else : ?>
<h2>Nothing found</h2>
<?php endif; ?>


        </div>