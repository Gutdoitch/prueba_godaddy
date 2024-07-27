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
    
    if( class_exists( 'MysisFilter' ) ) {
    get_template_part( 'content/content-download/content-list-filter' );
    
    } else {
        get_template_part( 'content/content-download/content-list-default' );
        
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
<?php if (function_exists("mayosis_page_navs")) { mayosis_page_navs(); } ?>
</div>

</div>