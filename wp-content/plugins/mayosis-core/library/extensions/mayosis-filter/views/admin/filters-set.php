<?php

    if ( ! defined('WPINC') ) {
        wp_die();
    }

    $set_id    = $post->ID;
    $filters    = mysis_get_configured_filters( $set_id );

    $filterSet  = \FilterEverything\Filter\Container::instance()->getFilterSetService();
    $the_set    = $filterSet->getSet( $set_id );

    $order = 1;
    $apply_button_order = ( isset( $the_set['apply_button_menu_order']['value'] ) && $the_set['apply_button_menu_order']['value'] > -1 ) ? $the_set['apply_button_menu_order']['value'] : (count($filters) + 1);
    $displayed = false;

?>
<div class="mayosis-mayosis-filter-wrapper">
    <div class="mayosis-mayosis-filter-hidden-fields">
        <input type="hidden" id="mayosis_set_nonce" name="_mysis_nonce" value="<?php echo esc_attr( mysis_create_filters_nonce() ); ?>" />
    </div>
    <div class="mayosis-column-labels-wrapper">
        <table class="mayosis-form-fields-table">
            <?php
//            $attributes = $filterSet->getPostTypeField($set_id);

            $attributes['post_type'] = $the_set['post_type'];
            $post_type  = ( isset( $the_set['post_type']['value'] ) && $the_set['post_type']['value'] ) ? $the_set['post_type']['value'] : $the_set['post_type']['default'];

            mysis_include_admin_view('filter-field', array(
                    'field_key'  => key($attributes),
                    'attributes' =>  reset($attributes)
                )
            );

            ?>
        </table>
    </div>
    <div class="mayosis-column-labels-wrapper">
        <div class="mayosis-column-labels widget-title">
            <ul class="mayosis-custom-row">
                <li class="mayosis-filter-order">&nbsp;</li>
                <li class="mayosis-filter-label"><?php esc_html_e('Label', 'mayosis-filter' ); ?></li>
                <li class="mayosis-filter-entity"><?php esc_html_e('Filter by', 'mayosis-filter' ); ?></li>
                <li class="mayosis-filter-view"><?php esc_html_e('View', 'mayosis-filter' ); ?></li>
                <li class="mayosis-filter-slug"><?php esc_html_e('URL Prefix', 'mayosis-filter' ); ?></li>
            </ul>
        </div>
    </div>
    <div class="mayosis-no-filters"<?php if( ! $filters ){ echo ' style="display: block;"'; }?>>
        <?php
            echo wp_kses(
                    __('No filters yet. Click the <strong>Add Filter</strong> button to create your first one.', 'mayosis-filter' ),
                    array( 'strong' => array() )
                );
            ?>
    </div>
    <div id="mayosis-filters-list" class="mayosis-filters-list" data-posttype="<?php echo $post_type; ?>">

        <?php if( $filters ):

                foreach( $filters as $filter ):

                    if( $apply_button_order == $order ){
                        mysis_include_admin_view( 'filter-apply-button', array(
                                'apply_button' => $the_set['apply_button_menu_order'],
                                'use_apply_button' => $the_set['use_apply_button'],
                                'apply_button_text' => $the_set['apply_button_text'],
                                'reset_button_text' => $the_set['reset_button_text'],
                                'apply_button_order' => $apply_button_order
                            )
                        );
                        $displayed = true;
                    }

                    mysis_include_admin_view( 'filter-row', array( 'filter' => $filter ) );

                    $order++;
                endforeach;

         endif; ?>
        <?php
        if( ! $displayed ) :
            mysis_include_admin_view( 'filter-apply-button', array(
                    'apply_button' => $the_set['apply_button_menu_order'],
                    'use_apply_button' => $the_set['use_apply_button'],
                    'apply_button_text' => $the_set['apply_button_text'],
                    'reset_button_text' => $the_set['reset_button_text'],
                    'apply_button_order' => $apply_button_order
                )
            );
        endif; ?>
    </div>

    <div class="mayosis-add-filter-wrapper">
        <div class="mayosis-add-filter-div">
            <a href="#" class="button button-primary button-large mayosis-add-filter"><?php esc_html_e('Add Filter','mayosis-filter' ); ?></a>
        </div>
    </div>

    <script type="text/html" id="mayosis-new-filter">
        <?php
            mysis_include_admin_view( 'filter-row', array( 'filter' => mysis_get_empty_filter( $set_id ) ) );
        ?>
    </script>
</div>