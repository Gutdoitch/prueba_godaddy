<?php
/**
 * The Template for displaying filter checkboxes.
 *
 * This template can be overridden by copying it to yourtheme/filters/checkboxes.php.
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
        <ul class="mayosis-filters-ul-list mayosis-filters-checkboxes mayosis-filters-list-<?php echo esc_attr( $filter['ID'] ); ?>"><?php

            if( ! empty( $terms ) || $view_args['ask_to_select_parent'] ):

                 if( $view_args['ask_to_select_parent'] !== false ) { ?>
                     <li><?php echo esc_html( $view_args['ask_to_select_parent'] ); ?></li>
                <?php } else {

                     $args = array(
                         'url_manager'  => $url_manager,
                         'filter'       => $filter,
                         'show_count'   => $set['show_count']['value'],
                         'set'          => $set
                     );

                     echo mysis_walk_terms_tree($terms, $args);
                 }
            else:

                if( ! mysis_is_filter_request() ){
                    ?><li><?php esc_html_e('There are no terms yet', 'mayosis-filter' );


                    if( mysis_is_debug_mode() ){
                        echo '&nbsp;'.mysis_help_tip(
                                esc_html__('Possible reasons: 1) Filter\'s criteria doesn\'t contain any terms yet and you have to add them 2) Terms may be created, but no one post that should be filtered attached to these terms 3) You excluded all possible terms in Filter\'s options.', 'mayosis-filter')
                            );
                    }
                }else{
                    esc_html_e('N/A', 'mayosis-filter' );
                }

                ?></li><?php

            endif;

?>      </ul>
        <?php  if ( isset( $filter['more_less'] ) && $filter['more_less'] === 'yes' ): ?>
            <a class="mayosis-see-more-control mayosis-toggle-a" href="javascript:void(0);" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>"><?php esc_html_e('See more', 'mayosis-filter' ); ?></a>
            <a class="mayosis-see-less-control mayosis-toggle-a" href="javascript:void(0);" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>"><?php esc_html_e('See less', 'mayosis-filter' ); ?></a>
        <?php endif;  ?>
    </div>
</div>