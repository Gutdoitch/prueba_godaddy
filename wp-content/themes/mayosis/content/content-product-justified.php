<?php
/**
 * @package mayosis
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$justified_gap= get_theme_mod( 'product_justified_gap','5' );
$productmastitle= get_theme_mod( 'product_justified_title_hover','1' );
$titileboxstyle= get_theme_mod( 'product_justified_hover_style','one' );
$author = get_user_by( 'id', get_query_var( 'author' ) );
$author_id=$post->post_author;

?>
<div class="row">
	<div class="gridzy justified-gallery-main gridzyLightProgressIndicator gridzyAnimated" data-gridzy-spaceBetween="
		<?php echo esc_html($justified_gap);?>">
	    
	    
	      <?php  
    
    if( class_exists( 'MysisFilter' ) ) {
    get_template_part( 'content/content-download/content-justified-filter' );
    
    } else {
        get_template_part( 'content/content-download/content-justified-default' );
        
    }
    
    ?>
	
		</div>
	</div>
	<div class="clearfix"></div>
   <div class="mayo-page-product mayo-product-loader-archive">
	<?php mayosis_page_navs(); ?>
	</div