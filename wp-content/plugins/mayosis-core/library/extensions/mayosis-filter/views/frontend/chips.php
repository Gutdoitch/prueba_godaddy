<?php
/**
 * The Template for displaying filter selected terms.
 *
 * This template can be overridden by copying it to yourtheme/filters/chips.php.
 *
 * $chips - array, with the Filter Set parameters
 *
 * @see https://teconce.com/resources/templates-overriding/
 */

if ( ! defined('WPINC') ) {
    wp_die();
}

?>
<ul class="mayosis-filter-chips-list mayosis-filter-chips-<?php echo esc_attr( $setid ); ?><?php if( ! $chips ){echo ' mayosis-empty-chips-container';} ?>" data-set="<?php echo esc_attr( $setid ); ?>">
<?php if( $chips ) : ?>
    <?php foreach( $chips as $chip ): ?>
    <li class="mayosis-filter-chip <?php echo esc_attr( $chip['class'] ); ?>">
        <a href="<?php echo esc_url( $chip['link'] ); ?>" title="<?php if( $chip['name'] !== esc_html__('Reset all', 'mayosis-filter') ){ echo esc_attr( sprintf( __('Remove %s from results', 'mayosis-filter'), '&laquo;'.$chip['label'] .': '.$chip['name'].'&raquo;' ) ); } ?>">
            <span class="mayosis-chip-content">
                <span class="mayosis-filter-chip-name"><?php echo esc_html( $chip['name'] ); ?></span>
                <span class="mayosis-chip-remove-icon">&#215;</span></a>
            </span>
    </li>
    <?php endforeach; ?>
<?php endif; ?>
</ul>