<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

$css_class  = 'mayosis-filter-item mayosis-filter-item-apply-button mayosis-filter-' . $apply_button['value'];
$css_class .= ( isset( $use_apply_button['value'] ) && $use_apply_button['value'] === 'yes' ) ? ' mayosis-opened' : '';
$apply_text      = ( isset( $apply_button_text['value'] ) ) ? $apply_button_text['value'] : esc_html__('Apply', 'mayosis-filter');
$reset_text      = ( isset( $reset_button_text['value'] ) ) ? $reset_button_text['value'] : esc_html__('Reset', 'mayosis-filter');

?>
<div id="mayosis-filter-id-apply-button" class="<?php echo esc_attr( $css_class ); ?>" data-fid="apply-button">
    <div class="mayosis-filter-head">
        <div class="mayosis-filter-title-widbar ui-sortable-handle">
            <ul class="mayosis-custom-row mayosis-filter-item-labels">
                <li class="mayosis-filter-order" title="<?php echo $apply_button_order; ?>"><span class="mayosis-filter-sortable-handle dashicons dashicons-menu"></span></li>
                <li class="mayosis-filter-label"><span class="mayosis-button-style mayosis-button-apply"><?php echo $apply_text; ?></span></li>
                <li class="mayosis-filter-label"><span class="mayosis-button-style mayosis-button-reset"><?php echo $reset_text; ?></span></li>
            </ul>
        </div>
    </div>
    <div class="mayosis-filter-body">
        <div class="mayosis-filter-main-fields">
            <table class="mayosis-form-fields-table mayosis-filter-apply-button">
                <tr class="mayosis-filter-tr">
                    <td colspan="2">
                        <?php echo mysis_render_input( $apply_button ); ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>