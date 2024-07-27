<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

?><td class="mayosis-filter-field-td">
    <div class="mayosis-field-wrap <?php if( isset( $attributes['id'] ) ){ echo esc_attr( $attributes['id'] ); } ?>-wrap">
        <?php echo mysis_render_input( $attributes ); // Already escaped in function ?>
        <?php do_action('mayosis_after_filter_input', $attributes ); ?>
    </div>
</td>