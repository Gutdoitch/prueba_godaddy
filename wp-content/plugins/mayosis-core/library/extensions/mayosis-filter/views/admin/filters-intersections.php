<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

?><table class="mayosis-form-fields-table" id="mayosis-intersections-table">
    <tr class="mayosis-first-row">
        <?php if( ! empty( $fields ) ): ?>
            <?php

            $count = count( $fields );
            $rows  = intdiv( $count, 3 ) + 1;
            $i = 1;

            foreach( $fields as $key => $attributes ){ ?>
                <td class="mayosis-filter-field-td"<?php
                    if( $count >= 5 && $i == 1 && isset( $fields['wp_entity'] ) ){
                        echo ' rowspan="'.$rows.'" ';
                    }
                ?>>
                    <?php echo mysis_render_input( $attributes ); ?>
                </td>
            <?php
                // Do not try to understand this code.
                // Just believe it works.
                $sep    = 4;
                $k      = $i;
                if( isset( $fields['wp_entity'] ) && $count >= 5 && ($i > 4) ){
                    $sep = 3;
                    $k = $i - 1;
                }
                if( ($k % $sep) === 0 ){
                    ?>
    </tr>
    <tr>
                    <?php
                }
                $i++;
            }  ?>

        <?php else: ?>

            <td class="mayosis-filter-field-td">
                <span class="mayosis-no-seo-filters-message"><?php echo esc_html__( 'Sorry. There is no filters active for SEO for selected post type', 'mayosis-filter' ); ?></span>
            </td>

        <?php endif; ?>
    </tr>
</table>