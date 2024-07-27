<?php

    if ( ! defined('WPINC') ) {
        wp_die();
    }

    $fields     = mysis_get_seo_rules_fields( $post->ID );
    $post_type  = mysis_extract_vars($fields, array('rule_post_type') );
    $postType   = reset( $post_type );
    $seo_fields = mysis_extract_vars( $fields, array( 'rule_seo_title', 'rule_meta_desc', 'rule_h1', 'rule_description') );
?>

<div class="mayosis-filters-seo-rules-wrapper">
    <div class="mayosis-mayosis-filter-hidden-fields">
        <input type="hidden" id="mayosis_seo_rule_nonce" name="_mysis_nonce" value="<?php echo esc_attr( mysis_create_seo_rules_nonce() ); ?>" />
    </div>
    <div class="mayosis-column-labels-wrapper">
        <table class="mayosis-form-fields-table">
            <tr id="mayosis-rule-post-type">
                <td class="mayosis-filter-label-td">
                    <label for="<?php echo esc_attr( $postType['id'] ); ?>" class="mayosis-filter-label">
                        <?php esc_html_e('Post Type', 'mayosis-filter'); ?>
                    </label>
                    <p class="mayosis-field-description"><?php esc_html_e('Select Post Type for SEO Rule', 'mayosis-filter'); ?></p>
                </td>
                <td class="mayosis-filter-field-td">
                    <?php echo mysis_render_input( $postType ); //Safe, escaped inside ?>
                </td>
            </tr>
            <tr class="mayosis-filter-intersection-tr">
                <td class="mayosis-filter-label-td">
                    <label class="mayosis-filter-label">
                        <?php esc_html_e('Filters Combination', 'mayosis-filter'); ?>
                    </label>
                    <p class="mayosis-field-description"><?php esc_html_e('Specify filter or filters combination for which you need to set SEO data', 'mayosis-filter'); ?></p>
                    <?php echo mysis_help_tip(
                            wp_kses(
                                    __('For example you need to set SEO data for the page with URL path:<br />/color-blue/size-large/<br />For this purpose you have to select filters «Color» and «Size» only.<br />If you want to create common template for all color and size values, please chose<br />«Any Color» and «Any Size». If you need to set SEO data for specific Color and Size, please chose specific values like «Blue» and «Large».', 'mayosis-filter'),
                                    array('br' => array() )
                            ), true ); ?>
                </td>
                <td class="mayosis-filter-field-td">
                    <div class="mayosis-intersection-fields-wrapper" id="mayosis-intersection-fields-container">
                        <span class="spinner"></span>
                        <?php
                            mysis_include_admin_view('filters-intersections', array(
                                    'fields'  => $fields
                                )
                            );
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr />
                </td>
            </tr>
            <?php foreach ( $seo_fields as $key => $attributes ): ?>
                <tr class="mayosis-filter-tr <?php echo esc_attr( $attributes['class'] ); ?>-tr">
                    <td class="mayosis-filter-label-td">
                        <label for="<?php echo esc_attr( $attributes['id'] ); ?>" class="mayosis-filter-label">
                            <?php echo esc_html( $attributes['label'] ); ?>
                        </label>
                        <?php echo mysis_field_instructions($attributes); // Already escaped in function ?>
                        <?php echo mysis_tooltip($attributes); ?>
                    </td>
                    <td class="mayosis-filter-field-td">
                        <div class="mayosis-field-wrap <?php echo esc_attr( $attributes['id'] ); ?>-wrap">
                            <?php echo mysis_render_input( $attributes ); ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>