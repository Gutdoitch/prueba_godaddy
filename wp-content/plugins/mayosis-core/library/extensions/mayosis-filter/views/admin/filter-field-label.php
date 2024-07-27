<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

?><td class="mayosis-filter-label-td"><?php
    $label = esc_html( $attributes['label'] );
    if( $label ) :
        ?><label for="<?php if( isset( $attributes['id'] ) ){ echo esc_attr( $attributes['id'] ); } ?>" class="mayosis-filter-label"><?php
        echo '<span class="mayosis-label-text">'.$label.'</span>';
        if( isset( $attributes['required'] ) && $attributes['required'] ){
            echo '<span class="mayosis-field-required">*</span>'."\n";
        }
        ?></label>
        <?php echo mysis_field_instructions($attributes); // Already escaped in function ?>
        <?php echo mysis_tooltip($attributes); ?>
    <?php endif; ?>
</td>