<?php
/**
 * A single download inside of the [downloads] shortcode.
 *
 * @since 2.8.0
 *
 * @package EDD
 * @category Template
 * @author Easy Digital Downloads
 * @version 1.0.0
 */

global $post, $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i;
$download_id = get_the_ID();
$productgridsystem= get_theme_mod( 'product_grid_system','one' );
$productmastitle= get_theme_mod( 'product_justified_title_hover','1' );
$titileboxstyle= get_theme_mod( 'product_justified_hover_style','one' );
$productmascol= get_theme_mod( 'product_masonry_column','3' );
$productmasonrytitle= get_theme_mod( 'product_masonry_title_hover','1' );
$titileboxstylemasonry= get_theme_mod( 'product_masonry_hover_style','one' );
?>
<?php if ($productgridsystem=='one'): ?>
   <?php $schema = ! function_exists( 'edd_get_order' ) && edd_add_schema_microdata() ? 'itemscope itemtype="http://schema.org/Product" ' : ''; ?>
  
        <div <?php echo esc_html($schema); ?>class="grid_dm ribbon-box group edge <?php echo esc_attr( apply_filters( 'edd_download_class', 'edd_download', get_the_ID(), $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i ) ); ?>" id="edd_download_<?php the_ID(); ?>">
  <div <?php post_class(); ?>>
            <div class="product-box <?php echo esc_attr( apply_filters( 'edd_download_inner_class', 'edd_download_inner', get_the_ID(), $edd_download_shortcode_item_atts, $edd_download_shortcode_item_i ) ); ?>">
                <?php
                $postdate = get_the_time('Y-m-d');   // Post date
                $postdatestamp = strtotime($postdate);   // Timestamped post date
                $newness = get_theme_mod('dm_days_products_new', '30');  // Newness in days

                if ((time() - (60 * 60 * 24 * floatval($newness))) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
                    echo '<div class="wrap-ribbon left-edge point lblue"><span>'. esc_html(__('New', 'mayosis')) .'</span></div>';
                }
                ?>
                <?php
                do_action( 'edd_download_before' );

                if ( 'false' !== $edd_download_shortcode_item_atts['thumbnails'] ) :
                    edd_get_template_part( 'shortcode', 'content-image' );
                    do_action( 'edd_download_after_thumbnail' );
                endif;

                edd_get_template_part( 'shortcode', 'content-title' );

                do_action( 'edd_download_after_title' );

                if ( 'yes' === $edd_download_shortcode_item_atts['excerpt'] && 'yes' !== $edd_download_shortcode_item_atts['full_content'] ) :
                    edd_get_template_part( 'shortcode', 'content-excerpt' );
                    do_action( 'edd_download_after_content' );
                elseif ( 'yes' === $edd_download_shortcode_item_atts['full_content'] ) :
                    edd_get_template_part( 'shortcode', 'content-full' );
                    do_action( 'edd_download_after_content' );
                endif;

                if ( 'yes' === $edd_download_shortcode_item_atts['price'] ) :
                    edd_get_template_part( 'shortcode', 'content-price' );
                    do_action( 'edd_download_after_price' );
                endif;

                if ( 'yes' === $edd_download_shortcode_item_atts['buy_button'] ) :
                    edd_get_template_part( 'shortcode', 'content-cart-button' );
                endif;

                do_action( 'edd_download_after' );
                ?>

            </div>

        </div>
    </div>
<?php elseif ($productgridsystem=='three'): ?>
    <div class="justified-items">
        <div <?php post_class(); ?>>
            <div class="product-justify-item ">
                <div class="product-justify-item-content">
                    <?php if ( has_post_format( 'video' )) { ?>
                        <div class="item-thumbnail item-video-justify">
                            <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
                        </div>
                    <?php } else { ?>
                        <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                        <div class="item-thumbnail">
                            <a href="<?php the_permalink();?>"><img src="<?php echo maybe_unserialize($thumbnail['0']); ?>" alt="product thumbnail"></a>
                        </div>
                    <?php } ?>
                    <?php if ($productmastitle==1){?>

                        <?php if ($titileboxstyle== "one"){ ?>
                            <div class="product-justify-description">

                                <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                            </div>

                        <?php } elseif ($titileboxstyle== "three"){ ?>

                            <div class="product-justify-description justify-style-three">
                                <div class="product_hover_details_button">
                                    <a href="<?php the_permalink();?>"  class="button-fill-color"><?php esc_html_e('View Details','mayosis');?></a>
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
    </div>
<?php elseif ($productgridsystem=='four'): ?>
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
                ?>
 <div class="mayosis_list_product">
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
<?php else: ?>

    <div class="product-masonry-item " id="edd_download_<?php the_ID(); ?>">
        <div <?php post_class(); ?>>
            <div class="product-masonry-item-content">
                <?php if ( has_post_format( 'video' )) { ?>
                    <div class="item-thumbnail item-video-masonry">
                        <?php get_template_part( 'library/mayosis-video-box-thumb-masonry' ); ?>
                       
                    </div>
                <?php } else { ?>
                    <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                    <div class="item-thumbnail">
                        <a href="<?php the_permalink();?>"><img src="<?php echo maybe_unserialize($thumbnail['0']); ?>" alt="<?php the_title();?>"></a>
                    </div>
                <?php } ?>
                <?php if ($productmasonrytitle==1){?>

                    <?php if ($titileboxstylemasonry== "one"){ ?>
                        <div class="product-masonry-description">

                            <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                        </div>

                    <?php } elseif ($titileboxstylemasonry== "three"){ ?>

                        <div class="product-masonry-description masonry-style-three">
                            <div class="product_hover_details_button">
                                <a href="<?php the_permalink();?>"  class="button-fill-color"><?php esc_html_e('View Details','mayosis');?></a>
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
            </div>
        </div>
    </div>

<?php endif; ?>