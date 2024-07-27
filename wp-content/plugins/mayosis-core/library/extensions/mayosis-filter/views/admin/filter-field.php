<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

?>
<tr class="<?php echo esc_attr( mysis_filter_row_class( $attributes ) ); ?>"<?php mysis_maybe_hide_row( $attributes ); ?>><?php

    mysis_include_admin_view('filter-field-label', array(
            'field_key'  => $field_key,
            'attributes' => $attributes
        )
    );

    mysis_include_admin_view('filter-field-input', array(
            'field_key'  => $field_key,
            'attributes' => $attributes
        )
    );
?>
</tr>