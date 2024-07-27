<?php
/**
 * The Template for displaying filter range.
 *
 * This template can be overridden by copying it to yourtheme/filters/range.php
 *
 * $filter - array, with the Filter parameters
 * $url_manager - object, of the UrlManager PHP class
 * $terms - array, with objects of all filter terms except excluded
 *
 * @see https://teconce.com/resources/templates-overriding/
 */

if ( ! defined('WPINC') ) {
    wp_die();
}

?>
<div class="<?php echo mysis_filter_class( $filter ); // Already escaped ?>" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>">
    <?php mysis_filter_header( $filter, $terms ); // Safe, escaped ?>
    <div class="<?php echo esc_attr( mysis_filter_content_class( $filter ) ); ?>">
        <div class="mayosis-filters-range-inputs">
            <?php if( ! empty( $terms ) || $view_args['ask_to_select_parent'] ):

                if( $view_args['ask_to_select_parent'] !== false ) { ?>
                    <div><?php echo esc_html( $view_args['ask_to_select_parent'] ); ?></div>
                <?php } else {

                    $minName = mysis_range_input_name( $filter['slug'] );
                    $maxName = mysis_range_input_name( $filter['slug'], 'max' );
                    $absMin = $absMax = 0;
                    $hasSliderClass = ( $filter['range_slider'] === 'yes' ) ? 'mayosis-form-has-slider' : 'mayosis-form-without-slider';

                    foreach( $terms as $term ){

                        foreach( $terms as $term ){
                            if( isset($term->min) ){
                                $absMin = $term->min;
                            }
                            if( isset( $term->max ) ){
                                $absMax = $term->max;
                            }
                        }
                    }

                    $max = isset( $filter['values']['max'] ) ? $filter['values']['max'] : $absMax;
                    $min = isset( $filter['values']['min'] ) ? $filter['values']['min'] : $absMin;
                ?>
                <form action="<?php echo esc_url( $url_manager->getFormActionUrl() ); ?>" method="GET" class="mayosis-filter-range-form <?php echo esc_attr( $hasSliderClass ); ?>" id="mayosis-filter-range-form-<?php echo esc_attr($filter['ID']); ?>">
                    <div class="mayosis-filters-range-wrapper">
                        <div class="mayosis-filters-range-column mayosis-filters-range-min-column">
                            <?php // if there are value in $_GET we have to put it into field ?>
                            <?php // attr step should be configured in options ?>
                            <input type="number" class="mayosis-filters-range-min" name="<?php echo esc_attr( $minName ); ?>" value="<?php echo esc_attr( $min ); ?>" step="<?php echo esc_attr( $filter['step'] ); ?>" data-min="<?php echo esc_attr( $absMin ); ?>" />
                        </div>
                        <div class="mayosis-filters-range-column mayosis-filters-range-max-column">
                            <input type="number" class="mayosis-filters-range-max" name="<?php echo esc_attr( $maxName ); ?>" value="<?php echo esc_attr( $max ); ?>" step="<?php echo esc_attr( $filter['step'] ); ?>" data-max="<?php echo esc_attr( $absMax ); ?>" />
                        </div>
                    </div>
                    <?php
                    /**
                     * @bug if $absMin === $absMax slider freezes
                     */
                    ?>
                    <?php if( $filter['range_slider'] === 'yes' ): ?>
                        <div class="mayosis-filters-range-slider-wrapper">
                            <div class="mayosis-filters-range-slider-control mayosis-slider-control-<?php echo esc_attr( $filter['ID'] ); ?>" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>"></div>
                        </div>
                    <?php else: ?>
                        <div class="mayosis-filters-range-values-wrapper">
                            <p><?php echo esc_html( sprintf( __( '%s: %d &mdash; %d' ), $filter['label'], $absMin, $absMax ) ); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php

                        mysis_query_string_form_fields(
                                mysis_get_query_string_parameters(),
                                [$minName, $maxName]
                        );
                    ?>
                </form>
                <?php } ?>
            <?php  else:  ?>

                <?php esc_html_e('There are no posts with such filtering criteria on this site.', 'mayosis-filter' ); ?>

            <?php endif; ?><!-- end if -->
        </div>
    </div>
</div>

