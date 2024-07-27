<?php
/**
 * Output a list of EDD's terms (with links) from the 'download_category' taxonomy
*/
function mayosis_edd_list() { 
	$taxonomy = 'download_category'; // EDD's taxonomy for categories
	$terms = get_terms( $taxonomy ); // get the terms from EDD's download_category taxonomy
?>


<?php foreach ( $terms as $term ) : ?>
<?php $category_grid_image = get_term_meta( $term->term_id, 'category_image_main', true); ?>
	<div class="list-download-cat">
		<a href="<?php echo esc_attr( get_term_link( $term, $taxonomy ) ); ?>" title="<?php echo $term->name; ?>"><span><?php echo $term->name; ?></span></a>
</div>
<?php endforeach; ?>


<?php }