<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

?><div class="mayosis-filters-set-settings-wrapper">
    <table class="mayosis-form-fields-table">
        <?php
            $set_settings_fields = mysis_get_set_settings_fields( $post->ID );

            // Allows you to manipulate fields before show them
            do_action_ref_array( 'mayosis_before_filter_set_settings_fields', array( &$set_settings_fields ) );

            foreach ( $set_settings_fields as $key => $attributes ) {

                if( isset( $attributes['skip_view'] ) && $attributes['skip_view'] ){
                    do_action_ref_array( 'mayosis_cycle_filter_set_settings_fields', array( &$set_settings_fields ) );
                }else{
                    mysis_include_admin_view('filter-field', array(
                            'field_key'  => $key,
                            'attributes' => $attributes
                        )
                    );
                }
            }
        ?>
    </table>
</div>