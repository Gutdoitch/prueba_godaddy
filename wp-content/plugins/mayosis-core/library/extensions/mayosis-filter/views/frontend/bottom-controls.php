<?php
/**
 * The Template for displaying Filters widget bottom controls.
 *
 * This template can be overridden by copying it to yourtheme/filters/bottom-controls.php.
 *
 * $action_url - string, URL to the page with filtering results
 * $found_posts - int|NULL, found posts number
 *
 * @see https://teconce.com/resources/templates-overriding/
 */

if ( ! defined('WPINC') ) {
    wp_die();
}

?>
<div class="mayosis-filters-widget-controls-item mayosis-filters-widget-controls-one">
    <a class="mayosis-filters-apply-button mayosis-posts-loaded" href="<?php echo esc_url($action_url); ?>"><?php
        echo wp_kses(
            sprintf( __('Show %s', 'mayosis-filter'),
            '<span class="mayosis-filters-found-posts-wrapper">(<span class="mayosis-filters-found-posts">'.esc_html($found_posts).'</span>)</span>'),
        array( 'span' => array('class'=>true) )
        );
  ?></a>
</div>
<div class="mayosis-filters-widget-controls-item mayosis-filters-widget-controls-two">
    <a class="mayosis-filters-close-button" href="<?php echo esc_url($action_url); ?>"><?php
        echo esc_html__('Cancel', 'mayosis-filter');
        ?>
    </a>
</div>