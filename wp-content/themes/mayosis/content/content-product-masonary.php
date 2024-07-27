<?php
/**
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$productmascol= get_theme_mod( 'product_masonry_column','3' );
$productmastitle= get_theme_mod( 'product_masonry_title_hover','1' );
$titileboxstyle= get_theme_mod( 'product_masonry_hover_style','one' );
$author = get_user_by( 'id', get_query_var( 'author' ) );
$author_id=$post->post_author;
$pagination= get_theme_mod( 'product_pagination_type','one' );
$masonrymetastate= get_theme_mod( 'product_masonry_meta_state','disable' );
$imageeffect= get_theme_mod( 'product_masonry_image_hover_style','disable' );
$load_more_text = get_theme_mod( 'load_more_text','More Products' );
if($imageeffect=='enable'){
                                $imgeftcls='masonry-hover-effect-enabled';
                            } else {
                                 $imgeftcls='';
                            }
?>
<div class="row">
<div class="masonryrow">
    <div class="product-masonry product-masonry-gutter product-masonry-style-2 product-masonry-masonry product-masonry-full product-masonry-<?php echo esc_html($productmascol);?>-column  <?php
                if ($pagination=='two') { ?>infinite-content-masonry<?php }?>">
        
          <?php  
    
    if( class_exists( 'MysisFilter' ) ) {
    get_template_part( 'content/content-download/content-masonry-filter' );
    
    } else {
        get_template_part( 'content/content-download/content-masonry-default' );
        
    }
    
    ?>
    
       


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
<?php mayosis_page_navs();?>
</div>

</div>
</div>