<?php
/**
 * The Template for displaying filter labels.
 *
 * This template can be overridden by copying it to yourtheme/filters/labels.php.
 *
 * $set - array, with the Filter Set parameters
 * $filter - array, with the Filter parameters
 * $url_manager - object, of the UrlManager PHP class
 * $terms - array, with objects of all filter terms except excluded
 *
 * @see https://teconce.com/resources/templates-overriding/
 */

if ( ! defined('WPINC') ) {
    wp_die();
}

$args = [
    'hide' => $view_args['ask_to_select_parent']
];

?>
<div class="<?php echo mysis_filter_class( $filter, [], $terms, $args ); // Already escaped ?>" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>">
    <?php mysis_filter_header( $filter, $terms ); // Safe, escaped ?>
    <div class="<?php echo esc_attr( mysis_filter_content_class( $filter ) ); ?>">
        <?php if( $filter['search'] === 'yes' && ! empty( $terms ) && $view_args['ask_to_select_parent'] === false ):  ?>
            <div class="mayosis-filter-search-wrapper mayosis-filter-search-wrapper-<?php echo esc_attr( $filter['ID'] ); ?>">
                <input class="mayosis-filter-search-field" type="text" value="" placeholder="<?php esc_html_e('Search', 'mayosis-filter' ) ?>" />
                <button class="mayosis-search-clear" type="button" title="<?php esc_html_e('Clear search', 'mayosis-filter' ) ?>"><span class="mayosis-search-clear-icon">&#215;</span></button>
            </div>
        <?php endif; ?>
        <ul class="mayosis-filters-ul-list mayosis-filters-labels mayosis-filters-list-<?php echo esc_attr( $filter['ID'] ); ?>">
            <?php if( ! empty( $terms ) || $view_args['ask_to_select_parent'] ):

                if( $view_args['ask_to_select_parent'] !== false ) { ?>
                    <li><?php echo esc_html( $view_args['ask_to_select_parent'] ); ?></li>
                <?php } else {
                    foreach ( $terms as $id => $term_object ){
                        $disabled       = 0;
                        $checked         = ( in_array( $term_object->slug, $filter['values'] ) ) ? 1 : 0;

                        if( isset( $term_object->wp_queried ) && $term_object->wp_queried ){
                            $checked    = 1;
                            $disabled   = 1;
                        }

                        $active_class    = $checked ? ' mayosis-term-selected' : '';
                        $disabled_class  = $disabled ? ' mayosis-term-disabled' : '';
                        $link            = $url_manager->getTermUrl( $term_object->slug, $filter['e_name'] );
                        $link_attributes = 'href="'.esc_url($link).'"';
                    ?>
                        <li class="mayosis-label-item mayosis-term-item<?php echo esc_attr( $active_class ); ?><?php echo esc_attr( $disabled_class ); ?> mayosis-term-count-<?php echo esc_attr( $term_object->cross_count ); ?> mayosis-term-id-<?php echo esc_attr( $id ); ?>" id="<?php mysis_term_id('term', $filter, $id ); ?>">
                            <div class="mayosis-term-item-content-wrapper">
                                <input class="mayosis-label-input" <?php checked( 1, $checked ); disabled( 1, $disabled ); ?> type="checkbox" data-mayosis-link="<?php echo esc_url( $link ); ?>" id="<?php mysis_term_id('checkbox', $filter, $id); ?>" />
                                <label for="<?php mysis_term_id('checkbox', $filter, $id); ?>">
                                    <span class="mayosis-filter-label-wrapper">
                                        <?php
                                        /**
                                         * Allow developers to change filter terms html
                                         */
                                        echo apply_filters( 'mayosis_filters_label_term_html', '<a '.$link_attributes.'>'.$term_object->name.'</a>', $link_attributes, $term_object, $filter );

                                        ?>&nbsp;<?php mysis_count( $term_object, $set['show_count']['value'] ); // Safe, escaped?>
                                    </span>
                                </label>
                            </div>
                        </li>
                    <?php } ?><!-- end foreach -->
                <?php } ?>
            <?php  else:
                if( ! mysis_is_filter_request() ){
                    ?><li><?php esc_html_e('There are no terms yet', 'mayosis-filter' );
                        if( mysis_is_debug_mode() ){
                            echo '&nbsp;'.mysis_help_tip(
                                    esc_html__('Possible reasons: 1) Filter\'s criteria doesn\'t contain any terms yet and you have to add them 2) Terms may be created, but no one post that should be filtered attached to these terms 3) You excluded all possible terms in Filter\'s options.', 'mayosis-filter')
                                );
                        }
                    ?></li><?php
                }else{
                    esc_html_e('N/A', 'mayosis-filter' );
                }
            ?>
            <?php endif; ?><!-- end if -->
        </ul>
        <?php  if ( isset( $filter['more_less'] ) && $filter['more_less'] === 'yes' ): ?>
            <a class="mayosis-see-more-control mayosis-toggle-a" href="javascript:void(0);" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>"><?php esc_html_e('See more', 'mayosis-filter' ); ?></a>
            <a class="mayosis-see-less-control mayosis-toggle-a" href="javascript:void(0);" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>"><?php esc_html_e('See less', 'mayosis-filter' ); ?></a>
        <?php endif;  ?>
    </div>
</div>