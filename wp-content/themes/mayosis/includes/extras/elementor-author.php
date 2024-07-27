<?php
defined('ABSPATH') or die();
global $post;
$author_id=$post->post_author;
?>
	 <span class="toolspan"><?php esc_html_e("by","mayosis"); ?> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">
								     
								     <?php echo get_the_author_meta( 'display_name',$author_id );?>
								 </a>