<?php
/**
 * Output a list of EDD's terms (with links) from the 'download_category' taxonomy
*/
function mayosis_edd_grid_carousel() { 
	$taxonomy = 'download_category'; // EDD's taxonomy for categories
	$terms = get_terms( $taxonomy ); // get the terms from EDD's download_category taxonomy
?>

<div class="edd-category-grid-carousel">
  
         <div id="grid-cat-edd">
<?php foreach ( $terms as $term ) : ?>
<?php $category_grid_image = get_term_meta( $term->term_id, 'category_image_main', true); ?>
		<a href="<?php echo esc_attr( get_term_link( $term, $taxonomy ) ); ?>" title="<?php echo $term->name; ?>"  class="cat--grid--main">
		    <div class="edd-cat-box-main"><span><?php echo $term->name; ?></span>
		    <div class="edd-cat-overlay-img" style="background:url(<?php echo $category_grid_image; ?>)">
		        </div>
	
		</div></a>

<?php endforeach; ?>
</div>
</div>

<?php }