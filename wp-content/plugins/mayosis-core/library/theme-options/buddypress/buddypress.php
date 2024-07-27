<?php

Mayosis_Option::add_section( 'buddypress_options_all', array(
	'title'       => __( 'Buddypress Options', 'mayosis-core' ),
	'panel'       => 'other_options_extra',

) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'select',
        'settings'    => 'bbpress_bg',
        'label'       => __( 'Buddypress Other Pages Background', 'mayosis-core' ),
        'section'     => 'buddypress_options_all',
        'default'     => 'color',
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => array(
            'color' => esc_attr__( 'Color', 'mayosis-core' ),
            'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
            'image' => esc_attr__( 'Image', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'bbpress_bg_color',
        'label'       => __( 'Background Color', 'mayosis-core' ),
        'description' => __( 'Change  Background Color', 'mayosis-core' ),
        'section'     => 'buddypress_options_all',
        'priority'    => 10,
        'default'     => '#460082',
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

        'required'    => array(
            array(
                'setting'  => 'bbpress_bg',
                'operator' => '==',
                'value'    => 'color',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'multicolor',
        'settings'    => 'bbpress_gradient_color',
        'label'       => esc_attr__( 'Product gradient', 'mayosis-core' ),
        'section'     => 'buddypress_options_all',
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'bbpress_bg',
                'operator' => '==',
                'value'    => 'gradient',
            ),
        ),
        'choices'     => array(
            'color1'    => esc_attr__( 'Form', 'mayosis-core' ),
            'color2'   => esc_attr__( 'To', 'mayosis-core' ),
        ),
        'default'     => array(
            'color1'    => '#1e0046',
            'color2'   => '#1e0064',
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'image',
        'settings'    => 'bbpress_bg_img',
        'label'       => esc_attr__( 'Background Image', 'mayosis-core' ),
        'description' => esc_attr__( 'Custom Image.', 'mayosis-core' ),
        'section'     => 'buddypress_options_all',
        'required'    => array(
            array(
                'setting'  => 'bbpress_bg',
                'operator' => '==',
                'value'    => 'image',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'image',
        'settings'    => 'buddypress_header_logo',
        'label'       => esc_attr__( 'Header Logo', 'mayosis-core' ),
        'description' => esc_attr__( 'Custom Image.', 'mayosis-core' ),
        'section'     => 'buddypress_options_all',
    
) );