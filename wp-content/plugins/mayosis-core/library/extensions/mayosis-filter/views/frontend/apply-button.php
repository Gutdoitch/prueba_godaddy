<?php
/**
 * The Template for displaying Apply button.
 *
 * This template can be overridden by copying it to yourtheme/filters/apply-button.php.
 *
 * @see https://teconce.com/resources/templates-overriding/
 */

if ( ! defined('WPINC') ) {
    wp_die();
}

$set_id = isset( $set['ID'] ) ? esc_html( $set['ID'] ) : 0;
?>
<div class="mayosis-filters-section mayosis-filters-section-<?php echo $set_id; ?> mayosis-filter-layout-submit-button">
    <a class="mayosis-filters-submit-button" href="<?php echo esc_url( $apply_url ); ?>"><?php
        $button_text = isset( $set['apply_button_text']['value'] ) ? esc_html( $set['apply_button_text']['value'] ) : esc_html__('Apply', 'mayosis-filter');
        echo $button_text;
    ?></a>
    <a class="mayosis-filters-reset-button" href="<?php echo esc_attr( $reset_url ) ?>"><?php
        $reset_button_text = isset( $set['reset_button_text']['value'] ) ? esc_html( $set['reset_button_text']['value'] ) : esc_html__('Reset', 'mayosis-filter');
        echo $reset_button_text;
    ?></a>
</div>
