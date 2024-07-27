<?php
Mayosis_Option::add_field( 'mayo_config', array(
            'type'        => 'radio-buttonset',
            'settings'    => 'thumbnail_bg_type',
            'label'       => __( 'Thumbnail Background Type', 'mayosis-core' ),
            'section'     => 'product_color',
            'default'     => 'color',
            'priority'    => 10,
            'choices'     => array(
                'color'  => esc_attr__( 'Color', 'mayosis-core' ),
                'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
            ),
));
Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'color',
        'settings'     => 'product_thumb_hover',
        'label'       => __( 'Thumbnail Hover Background', 'mayosis-core' ),
        'description' => __( 'Set Thumbnail Hover Background', 'mayosis-core' ),
        'section'     => 'product_color',
        'priority'    => 10,
        'default'     => 'rgba(40,40,55,.8)',
        'required'    => array(
            array(
                'setting'  => 'thumbnail_bg_type',
                'operator' => '==',
                'value'    => 'color',
            ),
        ),
        'choices' => array(
            'alpha' => true,
            'palettes' => array(
                '#28375a',
                '#282837',
                '#5a00f0',
                '#ff6b6b',
                '#c44d58',
                '#ecca2e',
                '#bada55',
            ),
        ),
        
));

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'multicolor',
        'settings'    => 'product_thumbnail_gradient',
        'label'       => esc_attr__( 'Thumbnail Hover gradient', 'mayosis-core' ),
        'section'     => 'product_color',
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'thumbnail_bg_type',
                'operator' => '==',
                'value'    => 'gradient',
            ),
        ),
        'choices'     => array(
            'color1'    => esc_attr__( 'Form', 'mayosis-core' ),
            'color2'   => esc_attr__( 'To', 'mayosis-core' ),
        ),
        'default'     => array(
            'color1'    => '#1e73be',
            'color2'   => '#00897e',
        ),
));

Mayosis_Option::add_field( 'mayo_config', array(
 'type'        => 'color',
        'settings'     => 'product_thumb_hover_text',
        'label'       => __( 'Thumbnail Hover Text Color', 'mayosis-core' ),
        'description' => __( 'Set Thumbnail Hover Text Color', 'mayosis-core' ),
        'section'     => 'product_color',
        'priority'    => 10,
        'default'     => '#ffffff',
        'choices' => array(
            'palettes' => array(
                '#28375a',
                '#282837',
                '#5a00f0',
                '#ff6b6b',
                '#c44d58',
                '#ecca2e',
                '#bada55',
            ),
        ),
));

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'color',
        'settings'     => 'product_label',
        'label'       => __( 'Product Label Color', 'mayosis-core' ),
        'description' => __( 'Set Product Label Color', 'mayosis-core' ),
        'section'     => 'product_color',
        'priority'    => 10,
        'default'     => '#e6174b',
        'choices' => array(
            'palettes' => array(
                '#28375a',
                '#282837',
                '#5a00f0',
                '#ff6b6b',
                '#c44d58',
                '#ecca2e',
                '#bada55',
            ),
        ),
));

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'color',
        'settings'     => 'product_label_edge',
        'label'       => __( 'Product Label Edge Color', 'mayosis-core' ),
        'description' => __( 'Set Product Label Edge Color', 'mayosis-core' ),
        'section'     => 'product_color',
        'priority'    => 10,
        'default'     => '#b71338',
        'choices' => array(
            'palettes' => array(
                '#28375a',
                '#282837',
                '#5a00f0',
                '#ff6b6b',
                '#c44d58',
                '#ecca2e',
                '#bada55',
            ),
        ),
));
