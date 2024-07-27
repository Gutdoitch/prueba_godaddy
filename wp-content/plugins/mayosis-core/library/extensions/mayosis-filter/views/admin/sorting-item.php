<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

$num = $i;

$title = ($title) ? $title : esc_html__( 'Item #', 'mayosis-filter' ) . $num;
$meta_key_class = '';
if( isset( $orderbiesSelect->attributes['value'] ) ){
    if( in_array( $orderbiesSelect->attributes['value'], ['m', 'n'] ) ){
        $meta_key_class = ' mayosis-opened';
    }
}
?>
<div class="mayosis-sorting-item-wrapper mayosis-sorting-item-<?php echo $num; ?>">
    <div class="mayosis-sorting-item-top">
        <div class="mayosis-sorting-item-handle"><span class="dashicons dashicons-menu"></span></div>
        <div class="mayosis-sorting-item-title" data-title="<?php esc_html_e( 'Item #', 'mayosis-filter' ); ?>"><?php echo esc_attr( $title ); ?></div>
        <div class="mayosis-sorting-item-remove">×</div>
    </div>
    <div class="mayosis-sorting-item-inside">
        <p>
            <label for="<?php echo esc_attr( $widget->get_field_id( 'titles' ) . '-' . $i ); ?>"><?php esc_html_e( 'Title', 'mayosis-filter' ); ?></label>
            <input class="widefat mayosis-sorting-item-label" id="<?php echo esc_attr( $widget->get_field_id( 'titles' ) . '-' . $i ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'titles' ) . '[]'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $widget->get_field_id( 'orderbies' ) . '-' . $i ); ?>"><?php esc_html_e( 'Order By', 'mayosis-filter' ); ?></label>
            <?php echo $orderbiesSelect->render(); ?>
        </p>
        <p class="mayosis-sorting-item-meta-key-wrapper<?php echo $meta_key_class; ?>">
            <label for="<?php echo esc_attr( $widget->get_field_id( 'meta_keys' ) . '-' . $i ); ?>"><?php esc_html_e( 'Meta key', 'mayosis-filter' ); ?></label>
            <input class="widefat mayosis-sorting-item-meta-key" id="<?php echo esc_attr( $widget->get_field_id( 'meta_keys' ) . '-' . $i ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'meta_keys' ) . '[]'); ?>" type="text" value="<?php echo esc_attr( $metaKey ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $widget->get_field_id( 'orders' ) . '-' . $i ); ?>"><?php esc_html_e( 'Order', 'mayosis-filter' ); ?></label>
            <?php echo $ordersSelect->render(); ?>
        </p>
    </div>
</div>
