<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

?><span class="mayosis-container-handle-wrapper">
    <a href="javascript:void(0);" class="mayosis-open-container button" data-field="<?php echo esc_attr( $field_id ); ?>"><?php
        esc_html_e( 'Insert variable', 'mayosis-filter' );
    ?></a>
    <?php do_action( 'mayosis_after_seo_vars_button', $field_id, $field_html ); ?>
</span>
<?php echo $field_html; ?>
<div id="mayosis-vars-container-<?php echo esc_attr( $field_id ); ?>" data-container="<?php echo esc_attr( $field_id ); ?>" class="mayosis-vars-container">
    <ul class="mayosis-seo-vars-list"></ul>
</div>