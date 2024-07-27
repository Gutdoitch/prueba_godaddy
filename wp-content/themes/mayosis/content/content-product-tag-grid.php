<?php
/**
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$productarchivecolgrid= get_theme_mod( 'product_archive_column_grid','two' );
$productthumbvideo= get_theme_mod( 'thumbnail_video_play','show' );
$productthumbposter= get_theme_mod( 'thumbnail_video_poster','show' );
$productvcontrol= get_theme_mod( 'thumb_video_control','minimal' );
$productcartshow= get_theme_mod( 'thumb_cart_button','hide' );
$productthumbhoverstyle= get_theme_mod( 'product_thmub_hover_style','style1' );
$pagination= get_theme_mod( 'product_pagination_type','one' );
$load_more_text = get_theme_mod( 'load_more_text','More Products' );
if ($productarchivecolgrid=="five"){
    $col_5_row = 'row-cols-1 row-cols-md-5';
} else {
    $col_5_row = '';
}
?>
<div class="row <?php echo esc_html($col_5_row);?> <?php
                if ($pagination=='two') { ?>infinite-content<?php }?>">
    
    
    <?php  
    
    if( class_exists( 'MysisFilter' ) ) {
    get_template_part( 'content/content-download/content-grid-filter' );
    
    } else {
        get_template_part( 'content/content-download/content-tag-grid-default' );
        
    }
    
    ?>
    
    
   


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