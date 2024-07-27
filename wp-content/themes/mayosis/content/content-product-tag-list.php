<?php
/**
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$author = get_user_by( 'id', get_query_var( 'author' ) );
$author_id=$post->post_author;
$pagination= get_theme_mod( 'product_pagination_type','one' );
$load_more_text = get_theme_mod( 'load_more_text','More Products' );
?>
<div class="row">
    <div class="mayosis-product-list <?php
                if ($pagination=='two') { ?>infinite-content<?php }?>">
         <?php
    $term=get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $paged=( get_query_var( 'paged')) ? get_query_var( 'paged') : 1;
    if ( ! isset( $wp_query->query['orderby'] ) ) {
        $args = array(
            'order' => 'DESC',
            'post_type' => 'download',
            'download_tag'=>$term->slug,
            'paged' => $paged );
    } else {
        switch ($wp_query->query['orderby']) {
            case 'newness_asc':
                $args = array(
                    'orderby' => 'newness_asc',
                    'order' => 'ASC',
                    'post_type' => 'download',
                    'download_tag'=>$term->slug,
                    'paged' => $paged );
                break;
            case 'newness_desc':
                $args = array(
                    'orderby' => 'newness_desc',
                    'order' => 'DESC',
                    'post_type' => 'download',
                    'download_tag'=>$term->slug,
                    'paged' => $paged );
                break;
            case 'sales':
                $args = array(
                    'meta_key'=>'_edd_download_sales',
                    'order' => 'DESC',
                    'orderby' => 'meta_value_num',
                    'download_tag'=>$term->slug,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
            case 'price_asc':
                $args = array(
                    'meta_key'=>'edd_price',
                    'order' => 'ASC',
                    'orderby' => 'meta_value_num',
                    'download_tag'=>$term->slug,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
                
                case 'price_desc':
                $args = array(
                    'meta_key'=>'edd_price',
                    'order' => 'DESC',
                    'orderby' => 'meta_value_num',
                    'download_tag'=>$term->slug,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
                
                case 'title_asc':
                $args = array(
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'download_tag'=>$term->slug,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
                
                case 'title_desc':
                $args = array(
                    'orderby' => 'title',
                    'order' => 'DESC',
                    'download_tag'=>$term->slug,
                    'post_type' => 'download',
                    'paged' => $paged );
                break;
        } }
    $temp = $wp_query; $wp_query = null;
    $wp_query = new WP_Query(); $wp_query->query($args); ?>
    <?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
    ?>
             <?php
                       global $post;
                    $author = get_user_by( 'id', get_query_var( 'author' ) );
                     $author_id=$post->post_author;
                      $download_cats = get_the_term_list( get_the_ID(), 'download_category', '', _x(' , ', '', 'mayosis' ), '' );
                      $productfreeoptins= get_theme_mod( 'product_free_options','custom' );
                      $productcustomtext= get_theme_mod( 'free_text','FREE' );
                      $envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );

                        if ($envato_item_id){
                         $api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
                        $item_price = $api_item_results_json['price_cents'];
                         $item_url = $api_item_results_json['url'];
                         $item_number_of_sales = $api_item_results_json['number_of_sales'];
                        }
                        
                        global $edd_logs;
															$single_count = $edd_logs->get_log_count(66, 'file_download');
															$total_count  = $edd_logs->get_log_count('*', 'file_download');
                                                            $sales = edd_get_download_sales_stats( get_the_ID() );
                                                            $sales = $sales > 1 ? $sales . ' sales' : $sales . ' sale';
                                        $price = edd_get_download_price(get_the_ID());
                                        
                                           if ($pagination=='two') {
                                $scrollitem ='infinite-post';
                            } else {
                                $scrollitem = '';
                            }
                ?>
                    <div class="mayosis_list_product <?php echo esc_html($scrollitem);?>">
                          <div class="list-mayosis-first-part">
                              <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="list_product_thumbnail">
                                       <a href="<?php
                                                    the_permalink(); ?>"> <?php
                                            the_post_thumbnail( 'mayosis-grid-list', array( 'class' => 'img-responsive' ) );
                                            ?></a>
                                    </div>
                                    <?php endif; ?>
                                    <div class="list_product_details">
                                        <h4><a href="<?php
                                                    the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                     
                                        <div class="list-metabox">
                                            
                                            
                                           <span class="list-author"><span class="opacitydown75"><?php esc_html_e("by","mayosis"); ?></span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">
    								     
    								     
    								     <?php echo get_the_author_meta( 'display_name',$author_id);?>
    								     </a></span>
    								     <span class="list-cats">
    								         <span class="opacitydown75"><?php esc_html_e("in","mayosis"); ?></span> <span><?php echo '<span>' . $download_cats . '</span>'; ?></span>
    								    </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="list_price_details">
                                     	<div class="list-count-download">
								    
								     <?php if ($envato_item_id) { ?>
								     <span><?php esc_html_e('$','mayosis');?><?php echo number_format(($item_price /100), 2, '.', ' ');?></span>
								     <?php } else { ?>
								 <?php if( $price == "0.00"  ){ ?>
								 <?php if ($productfreeoptins=='none'): ?>		
									<span><?php edd_price(get_the_ID()); ?></span>
								<?php else: ?>
								    <span><?php echo esc_html($productcustomtext); ?></span>
								<?php endif;?>
								
								
									 <?php } else { ?>
                       <div class="product-price promo_price"><?php
				if(edd_has_variable_prices(get_the_ID())){
					echo edd_price_range( get_the_ID() );
				}
				else{
					edd_price(get_the_ID());
				}
					?></div>
                    <?php } ?>
                    <?php } ?>
									
								</div>
                                    </div>
                                    
                                    <div class="list_publish_date">
                                        <span><?php echo esc_html(get_the_date()); ?></span>
                                    </div>
                                <div class="list_button_details">
                                    
                      			 <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>  
                                      <?php $demo_link =  get_post_meta($post->ID, 'demo_link', true); ?>
       <?php if ( $demo_link ) { ?>
                      
                         
                               <a href="<?php echo esc_html($demo_link); ?>" class="list-preview-button" target="_blank"><i class="zil zi-eye"></i> 	<?php esc_html_e('Preview', 'mayosis');?></a>
                                 
                        
              
                     <?php } ?>
                                    </div>
                            </div>

        <?php endwhile; else : ?>
        <?php endif; ?>


    </div>
</div>
<div class="clearfix"></div>
   <div class="mayo-page-product mayo-product-loader-archive">
        
           
        <?php if ($pagination == 'two'){ ?>
            <a href="#" class="inf-load-more"><?php echo esc_html($load_more_text); ?></a>
            
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