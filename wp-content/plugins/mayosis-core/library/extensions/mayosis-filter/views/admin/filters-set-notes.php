<?php

    if ( ! defined('WPINC') ) {
        wp_die();
    }

?>
<p><strong><?php esc_html_e( 'WordPress', 'mayosis-filter' ); ?>:</strong></p>
<table class="mayosis-notes-table"><?php
    printf( '<tr><th>_thumbnail_id</th><td>%s</td></tr>', esc_html__( 'filter by Featured Image (Custom Field Exists)', 'mayosis-filter' ) );
    ?>
</table>
<p><strong><?php esc_html_e( 'WooCommerce', 'mayosis-filter' ); ?>:</strong></p>
<table class="mayosis-notes-table">
    <?php
    printf( '<tr><th>_price</th><td>%s</td></tr>', esc_html__( 'filter by Product price (Custom Field Numeric)', 'mayosis-filter' ) );
    printf( '<tr><th>_stock_status</th><td>%s</td></tr>', esc_html__( 'filter by Product Stock status (Custom Field)', 'mayosis-filter' ) );
    printf( '<tr><th>_sale_price</th><td>%s</td></tr>', esc_html__( 'by Sale Price (Custom Field Numeric) or on Sale Status (Custom Field Exists)', 'mayosis-filter' ) );
    printf( '<tr><th>total_sales</th><td>%s</td></tr>', esc_html__( 'by Sales Count', 'mayosis-filter' ) );
    printf( '<tr><th>_backorders</th><td>%s</td></tr>', esc_html__( 'by Backorders Status (Custom Field)', 'mayosis-filter' ) );
    printf( '<tr><th>_downloadable</th><td>%s</td></tr>', esc_html__( 'by Downloadable Status (Custom Field)', 'mayosis-filter' ) );
    printf( '<tr><th>_sold_individually</th><td>%s</td></tr>', esc_html__( 'by Sold Individually status (Custom Field)', 'mayosis-filter' ) );
    printf( '<tr><th>_stock</th><td>%s</td></tr>', esc_html__( 'by Stock Quantity (Custom Field Numeric)', 'mayosis-filter' ) );
    printf( '<tr><th>_virtual</th><td>%s</td></tr>', esc_html__( 'by Product Virtual status (Custom Field)', 'mayosis-filter' ) );
    printf( '<tr><th>_length</th><td>%s</td></tr>', esc_html__( 'by product Length', 'mayosis-filter' ) );
    printf( '<tr><th>_width</th><td>%s</td></tr>', esc_html__( 'by product Width', 'mayosis-filter' ) );
    printf( '<tr><th>_height</th><td>%s</td></tr>', esc_html__( 'by product Height', 'mayosis-filter' ) );
    printf( '<tr><th>_weight</th><td>%s</td></tr>', esc_html__( 'by product Weight', 'mayosis-filter' ) );
    echo wp_kses (
        sprintf(
            __( '<tr><th>_wc_average_rating</th><td>filter by Product Average Rating. Optionally use <a href="%s" target="_blank">Product Visibility</a> taxonomy instead</td></tr>', 'mayosis-filter' ),
            'https://demo.teconce.com/example/by-rating/'
        ),
        array(
            'a' => array( 'href' => true, 'target' => true ),
            'tr' => array(),
            'th' => array(),
            'td' => array()
        )
    );
    ?>
</table>