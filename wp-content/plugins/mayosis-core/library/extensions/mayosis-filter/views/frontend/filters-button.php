<?php
/**
 * The Template for displaying Filters opening/closing button.
 *
 * This template can be overridden by copying it to yourtheme/filters/filters-button.php.
 *
 * $mayosis_found_posts - int|NULL, found posts number
 *
 * @see https://teconce.com/resources/templates-overriding/
 */

if ( ! defined('WPINC') ) {
    wp_die();
}

?>
<div class="mayosis-filters-open-button-container mayosis-open-button-<?php echo esc_attr( $set_id ); ?>">
    <a class="<?php echo esc_attr( $class ); ?>" href="javascript:void(0);" data-wid="<?php echo esc_attr( $set_id ); ?>"><span class="mayosis-button-inner"><?php
            // Button icon
            mysis_get_icon_html();

            ?><span class="mayosis-filters-button-text"><?php

            if( $mayosis_found_posts !== NULL ){
                esc_html_e( sprintf( __('Filters %s', 'mayosis-filter'), '('.$mayosis_found_posts.')' ) );
            } else {
                esc_html_e('Filters', 'mayosis-filter');
            }

            ?></span></span></a>
</div>