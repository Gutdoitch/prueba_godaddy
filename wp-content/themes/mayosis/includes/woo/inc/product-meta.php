<?php
/**
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $post;
 global $product;
$product_id = get_the_ID();
$productmetaoptions= get_theme_mod( 'product_grid_options','one' );
$productmetadisplayop= get_theme_mod( 'product_meta_options' ,'vendorcat');
$productpricingoptions= get_theme_mod( 'product_pricing_options','price' );
$productfreeoptins= get_theme_mod( 'product_free_options','custom' );
$productcustomtext= get_theme_mod( 'free_text','FREE' );
$author = get_user_by( 'id', get_query_var( 'author' ) );
$author_id=$post->post_author;
$productvideoiconhide= get_theme_mod( 'title_play_button','show' );
$envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );
$pcattype= get_theme_mod( 'product_category_type_x','default' );

if ($envato_item_id){
    $api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
    $item_price = $api_item_results_json['price_cents'];
    $item_url = $api_item_results_json['url'];
    $item_number_of_sales = $api_item_results_json['number_of_sales'];
}
?>
<?php if ($productmetaoptions=='two'): ?>
    <div class="without-meta-box">

    </div>
<?php else : ?>

    <div class="product-tag">
        <?php
      
        $price = $product->get_price_html();
        ?>

        <?php if ( has_post_format( 'audio' )) {
            get_template_part( 'includes/woo/inc/woo_title_audio');
        } ?>
        <?php if ($productvideoiconhide=='show') { ?>
            <?php if ( has_post_format( 'video' )) {
                get_template_part( 'includes/woo/inc/woo_title_video');
            } ?>
        <?php } ?>
        <h4 class="product-title"><a href="<?php the_permalink(); ?>">
                <?php
                the_title();
                ?>
            </a></h4>
       

        <?php if ($productmetadisplayop=='vendor'): 
        
        ?>
               <?php do_action('mayosis_seller_information_main');?>
        <?php elseif ($productmetadisplayop=='category'):
            
          $download_cats = get_the_term_list( get_the_ID(), 'product_cat', '', _x(', ', '', 'mayosis' ), '' );
            ?>
            
            
             <?php if ($pcattype=="parent"){ ?>
                <span class="mayosis-parent-cats-z">
             <?php
             $categories = get_the_terms( get_the_ID(), 'product_cat' );
             if($categories){
foreach ( $categories as $key => $category ) {
    if( $category->parent == 0 ){
        $term_link = get_term_link( $category );
        echo "<a href='".$term_link."'>" . $category->name. "</a> ";
    }
}
}
             ?>
             </span>
           
              <?php } else { ?>
            <span><?php echo '<span>' . $download_cats . '</span>'; ?></span>
            <?php } ?>
            
            
            
        <?php elseif ($productmetadisplayop=='vendorcat'):
            $download_cats = get_the_term_list( get_the_ID(), 'product_cat', '', _x(', ', '', 'mayosis' ), '' );
            
            ?>
           <?php do_action('mayosis_seller_information_main');?>


            <?php if ($download_cats):?>
            
             <?php if ($pcattype=="parent"){ ?>
              <span class="opacitydown75"><?php esc_html_e("in","mayosis"); ?></span><span class="mayosis-parent-cats-z">
             <?php
             $categories = get_the_terms( get_the_ID(), 'product_cat' );
foreach ( $categories as $key => $category ) {
    if( $category->parent == 0 ){
        $term_link = get_term_link( $category );
        echo "<a href='".$term_link."'>" . $category->name. "</a> ";
    }
}
             ?>
             </span>
             <?php } else { ?>
                <span class="opacitydown75"><?php esc_html_e("in","mayosis"); ?></span> <span><?php echo '<span>' . $download_cats . '</span>'; ?></span>
                <?php } ?>
                
                
                
                
            <?php endif; ?>
        <?php elseif ($productmetadisplayop=='sales'): ?>
            <?php if( $product->get_price() == "0.00"  ){ ?>
                <p><span><?php mayosis_woo_downloads_count(); ?></span></p>
            <?php } else { ?>
                <p><span><?php echo esc_html($sales); ?></span></p>
            <?php } ?>
        <?php else: ?>
        <?php endif; ?>
        
        
        <div class="msuv-rating-box-p">

                               <?php echo mayosis_get_star_rating(); ?>

           </div>
                            
 <?php if ($productpricingoptions=='bprice'): ?>

        <div class="msb-inner-meta-price">

            <?php if ($envato_item_id) { ?>
                <span><?php esc_html_e('$','mayosis');?><?php echo number_format(($item_price /100), 2, '.', ' ');?></span>
            <?php } else { ?>
                <?php if( $product->get_price() == "0.00"  ){ ?>
                    <?php if ($productfreeoptins=='none'): ?>
                        <span> <?php echo maybe_unserialize($product->get_price_html()); ?></span>
                    <?php else: ?>
                        <span><?php echo esc_html($productcustomtext); ?></span>
                    <?php endif;?>


                <?php } else { ?>
                    <div class="product-price promo_price"> <?php echo maybe_unserialize($product->get_price_html()); ?></div>
                <?php } ?>
            <?php } ?>

        </div>
    <?php endif; ?>


    </div>
    <?php if ($productpricingoptions=='price'): ?>

        <div class="count-download">

            <?php if ($envato_item_id) { ?>
                <span><?php esc_html_e('$','mayosis');?><?php echo number_format(($item_price /100), 2, '.', ' ');?></span>
            <?php } else { ?>
                <?php if( $product->get_price() == "0.00"  ){ ?>
                    <?php if ($productfreeoptins=='none'): ?>
                        <span> <?php echo maybe_unserialize($product->get_price_html()); ?></span>
                    <?php else: ?>
                        <span><?php echo esc_html($productcustomtext); ?></span>
                    <?php endif;?>


                <?php } else { ?>
                    <div class="product-price promo_price"><?php echo maybe_unserialize($product->get_price_html()); ?></div>
                <?php } ?>
            <?php } ?>

        </div>
    <?php endif; ?>

    <div class="clearfix"></div>
<?php endif; ?>