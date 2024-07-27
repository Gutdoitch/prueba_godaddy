<?php
/*
*Template Name: Artists List
* @package mayosis
*/

// Get all users order by amount of posts
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header();
$mayosis_breadcrumb_color = get_post_meta( $post->ID, 'mayosis_breadcrumb_color', true );


$mayosis_gradient= get_post_meta( $post->ID, 'breadcrumb_gradient', true );

$mayosis_gradient_a = get_post_meta( $post->ID, 'mayosis_gradient_a', true );

$mayosis_gradient_b = get_post_meta( $post->ID, 'mayosis_gradient_b', true );

?>

<?php if ( is_home() ) {
    $breadcrumb_hide = get_post_meta(get_queried_object_id(), 'breadcrumb_hide', true );
     $sidebar_hide = get_post_meta(get_queried_object_id(), 'page_sidebar', true );
} else {
    $breadcrumb_hide = get_post_meta(get_queried_object_id(), 'breadcrumb_hide', true );
     $sidebar_hide = get_post_meta(get_the_ID(), 'page_sidebar', true );
} ?>

<div class="container-fluid">
<?php  if($breadcrumb_hide == "Yes"){ ?>

						<?php  if($mayosis_gradient == "Yes"){ ?>
				<div class="row page_breadcrumb" style="background:linear-gradient(45deg, <?php echo esc_html($mayosis_gradient_a); ?> , <?php echo esc_html($mayosis_gradient_b); ?>);">
				<?php } else { ?>
					<div class="row page_breadcrumb" style="background-color:<?php echo esc_html($mayosis_breadcrumb_color); ?>;background-image:url(<?php echo get_post_meta(get_the_ID(), 'breadcrumb_image', true ); ?>);">
					 <?php } ?>
					 <div class="container">
					<h2 class="page_title_single"><?php
	the_title(); ?></h2>
						<?php
	if (function_exists('dm_breadcrumbs')) dm_breadcrumbs(); ?>
						</div>
						</div>
			 <?php } ?>
</div>
<div class="container-fluid">
	<?php  if($sidebar_hide == "Show"){ ?>
						
						<div class="container dm-column-container artist-list-page">
						<div class="row">
							<div class="col-md-8">
							
						<div class="row fix">
						     <?php $mayosis_custom_taxonomy = get_theme_mod( 'product_audio_taxonomoy','hide');
          
          if ($mayosis_custom_taxonomy == 'show'){ ?>
<?php

$taxonomy = 'artist'; // EDD's taxonomy for categories
	$terms = get_terms( $taxonomy );
	
	

?>

<?php foreach ( $terms as $term ) : ?>
<?php $artistsimage =get_field('artist_image', $term); ?>
    <div class="artists-boxes col-md-3 col-12">
        <div class="artist-items">
	   <a href="<?php echo esc_attr( get_term_link( $term, $taxonomy ) ); ?>" title="<?php echo esc_html($term->name); ?>" class="artist--grid--main"><img src="<?php echo esc_url($artistsimage);?>"></a>
		<h3><a href="<?php echo esc_attr( get_term_link( $term, $taxonomy ) ); ?>" title="<?php echo esc_html($term->name); ?>" class="artist--grid--main"><span><?php echo esc_html($term->name); ?></span></a></h3>
		</div>
</div>
<?php endforeach; ?>
<?php } ?>
	</div>
						</div>
						<div class="col-md-4 ">
							     <?php
	if (is_active_sidebar('single-post')): ?>
					<?php
		dynamic_sidebar('single-post'); ?>
				<?php
	endif; ?>
						</div>
							<div class="clearfix"></div>
							</div>
						</div>
						<?php
} else{ ?>
					<div class="container dm-column-container artist-list-page">
				 
					   <div class="row fix">
					            <?php $mayosis_custom_taxonomy = get_theme_mod( 'product_audio_taxonomoy','hide');
          
          if ($mayosis_custom_taxonomy == 'show'){ ?>
<?php

$taxonomy = 'artist'; // EDD's taxonomy for categories
	$terms = get_terms( $taxonomy );
	
	

?>

<?php foreach ( $terms as $term ) : ?>
<?php $artistsimage =get_field('artist_image', $term); ?>
    <div class="artists-boxes col-md-3 col-12">
        <div class="artist-items">
	   <a href="<?php echo esc_attr( get_term_link( $term, $taxonomy ) ); ?>" title="<?php echo esc_html($term->name); ?>" class="artist--grid--main"><img src="<?php echo esc_url($artistsimage);?>"></a>
		<h3><a href="<?php echo esc_attr( get_term_link( $term, $taxonomy ) ); ?>" title="<?php echo esc_html($term->name); ?>" class="artist--grid--main"><span><?php echo esc_html($term->name); ?></span></a></h3>
		</div>
</div>
<?php endforeach; ?>
<?php } ?>
	</div>
						</div>
		<?php } ?>


</div>
<?php
get_footer(); ?>