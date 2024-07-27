<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

$filterID           = isset( $filter['ID']['value'] ) ? $filter['ID']['value'] : 0;
$belongs_class      = ( $filter['entity']['entity_belongs'] ) ? 'mayosis-belongs ' : 'mayosis-belongs-not ';
$short_entity       = $filter['entity']['short_entity'];
$rowClass           = ( $filterID === \FilterEverything\Filter\FilterFields::MYSIS_NEW_FILTER_ID ) ? 'mayosis-filter-item mayosis-new-filter-item' : 'mayosis-filter-item';
?>
<div id="<?php echo esc_attr('mayosis-filter-id-' . $filterID); ?>" class="mayosis-filter-<?php echo esc_attr($filter['menu_order']['value']); ?> <?php echo esc_attr($belongs_class); ?><?php echo esc_attr($rowClass); ?>" data-fid="<?php echo esc_attr($filterID); ?>">
    <div class="mayosis-filter-head">
        <div class="mayosis-title-action widget-title-action">
            <button type="button" class="mayosis-action widget-action hide-if-no-js" aria-expanded="false">
                <span class="toggle-indicator" aria-hidden="true"></span>
            </button>
        </div>
        <div class="mayosis-filter-title-widbar ui-sortable-handle">
            <ul class="mayosis-custom-row mayosis-filter-item-labels">
                <li class="mayosis-filter-order" title="<?php echo $filter['menu_order']['value']; ?>"><span class="mayosis-filter-sortable-handle dashicons dashicons-menu"></span></li>
                <li class="mayosis-filter-label"><?php echo esc_html($filter['label']['value']); ?></li>
                <li class="mayosis-filter-entity"><?php
                    echo mysis_get_filter_entity_name( $filter['entity']['value'] ); // Already escaped in function
                    if( ! $filter['entity']['entity_belongs'] && ! in_array( $filter['entity']['value'], [ 'tax_numeric', 'post_meta_exists' ] ) ){
                        echo ' ' . mysis_help_tip( esc_html__('This filter is inactive because it is not related with the selected post type.', 'mayosis-filter'), $allow_html = false );
                    }
                    ?></li>
                <li class="mayosis-filter-view"><?php echo mysis_get_filter_view_name( $filter['view']['value'] ); // Already escaped in function ?></li>
                <li class="mayosis-filter-slug"><?php echo esc_html( $filter['slug']['value'] ); ?></li>
            </ul>
        </div>
    </div>
    <div class="mayosis-filter-body">
        <div class="mayosis-additional-fields-selector"><a href="#" class="mayosis-more-options-toggle"><?php esc_html_e('More options', 'mayosis-filter'); ?></a></div>
        <div class="mayosis-filter-main-fields">
            <table class="mayosis-form-fields-table mayosis-filter-<?php echo esc_attr($short_entity); ?>">
                <tr class="mayosis-filter-tr">
                    <td colspan="2">
                        <?php
                            $meta = mysis_extract_vars( $filter, array( 'ID', 'parent', 'menu_order' ) );
                            $_meta = $meta;
                            foreach ( $meta as $field_attributes ) {
                                echo mysis_render_input( $field_attributes ); // Safe, escaped
                            }
                        ?>
                    </td>
                </tr>
                <?php

                    $first_filters = mysis_extract_vars($filter, array( 'entity', 'instead-entity', 'e_name', 'label', 'slug', 'view') );

                    foreach( $first_filters as $field_key => $field_attributes ){

                        if( isset( $field_attributes['skip_view'] ) && $field_attributes['skip_view'] ){
                            do_action_ref_array( 'mayosis_cycle_filter_fields', array( &$first_filters ) );
                        } else {
                            mysis_include_admin_view('filter-field', array(
                                    'field_key' => $field_key,
                                    'attributes' => $field_attributes
                                )
                            );
                        }
                    }
                ?>
            </table>
            </div>

            <div class="mayosis-filter-additional-fields">
                <table class="mayosis-form-fields-table mayosis-filter-<?php echo esc_attr($short_entity); ?>">
                <?php

                    foreach( $filter as $field_key => $field_attributes ) {

                        if( isset( $field_attributes['skip_view'] ) && $field_attributes['skip_view'] ) {
                            do_action_ref_array( 'mayosis_cycle_filter_fields', array( &$filter ) );
                        } else {
                            mysis_include_admin_view('filter-field', array(
                                    'field_key' => $field_key,
                                    'attributes' => $field_attributes
                                )
                            );
                        }
                    }

                ?>
                </table>
            </div>
        <div class="mayosis-remove-filter-wrapper">
            <table class="mayosis-form-fields-table">
                <tr class="mayosis-filter-tr">
                    <td class="mayosis-filter-label-td mayosis-filter-delete-controls-td">
                        <div class="alignleft">
                            <span class="widget-control-close-wrapper"><button type="button" class="button-link mayosis-done-action"><?php esc_html_e('Close', 'mayosis-filter'); ?></button> |
                                <button type="button" class="button-link button-link-delete mayosis-button-link-delete"><?php esc_html_e('Delete', 'mayosis-filter'); ?></button>
                            </span>
                        </div>
                        <br class="clear" />
                    </td>
                    <td class="mayosis-filter-field-td mayosis-filter-delete-td">
                        <div class="alignright mayosis-filter-delete-wrapper" id="mayosis-filter-delete-wrapper-<?php echo esc_attr( $_meta['ID']['value'] ); ?>">
                            <span class="spinner"></span>
                            <input type="button" class="button mayosis-filter-delete" data-fid="<?php echo esc_attr( $_meta['ID']['value'] ); ?>" value="<?php echo esc_attr( __('Delete, I\'m sure', 'mayosis-filter') ); ?>">
                            <input type="button" class="button right mayosis-filter-delete-cancel" value="<?php echo esc_attr( __('Cancel', 'mayosis-filter') ); ?>">
                        </div>
                        <br class="clear" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>