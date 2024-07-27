<?php
defined('ABSPATH') or die();

?>
	<span class="toolspan"><?php esc_html_e("by","mayosis"); ?></span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID') ) ?>"><?php the_author(); ?></a>