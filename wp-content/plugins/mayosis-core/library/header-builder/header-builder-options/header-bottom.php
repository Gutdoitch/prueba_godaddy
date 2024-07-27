<?php

Mayosis_Option::add_section( 'bottom_bar', array(
	'title'       => __( 'Header Bottom', 'mayosis-core' ),
	'panel'       => 'header',
) );

Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'radio-buttonset',
    'settings'    => 'bottom_header_show',
    'label'       => __( 'bottom Header', 'mayosis-core' ),
    'section'     => 'bottom_bar',
    'default'     => 'off',
    'choices'     => array(
        'on'   => esc_attr__( 'Show', 'mayosis-core' ),
        'off' => esc_attr__( 'Hide', 'mayosis-core' ),
    ),
) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-image',
    'settings'    => 'bottom_header_layout',
    'label'       => __( 'Bottom Header layout', 'mayosis-core' ),
    'section'     => 'bottom_bar',
    'default'     => 'one',
    'choices'     => array(
            		'one'   => get_template_directory_uri() . '/images/header-layout-2.jpg',
            		'two'  => get_template_directory_uri() . '/images/header-layout-1.jpg',
            	),
) );

Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'switch',
	'settings'    => 'bottom_bar_fullwidth',
	'label'       => __( 'Full width bottom header', 'mayosis-core' ),
	'section'     => 'bottom_bar',
	'default'     => 'off',
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'mayosis-core' ),
		'off' => esc_attr__( 'Disable', 'mayosis-core' ),
	),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
	'settings'    => 'bottom_header_height',
	'label'       => esc_attr__( 'Header Height', 'mayosis-core' ),
	'description' => esc_attr__( 'Change bottom header height', 'mayosis-core' ),
	'section'     => 'bottom_bar',
	'default'     => '40px',
	'output'      => array(
            array(
                'element'  => '.header-bottom',
                'property' => 'height',
            ),
        ),
    ) );
    
    Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
	'settings'    => 'bottom_header_line_height',
	'label'       => esc_attr__( 'Header Line Height', 'mayosis-core' ),
	'description' => esc_attr__( 'Change bottom header line height', 'mayosis-core' ),
	'section'     => 'bottom_bar',
	'default'     => '40px',
	'output'      => array(
            array(
                'element'  => '.header-bottom,.header-bottom #mayosis-menu>ul>li>a',
                'property' => 'line-height',
            ),
        ),
    ) );
    
    
Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'color',
'settings'     => 'bottom_header_bg',
'label'       => __( 'Bottom Header Background Color', 'mayosis-core' ),
'description' => __( 'Change bottom header bg Color', 'mayosis-core' ),
'section'     => 'bottom_bar',
'priority'    => 10,
'default'     => '#ffffff', 
'output'      => array(
            array(
                'element'  => '.header-bottom',
                'property' => 'background',
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
'type'        => 'color',
'settings'     => 'bottom_header_text',
'label'       => __( 'Bottom Header Text Color', 'mayosis-core' ),
'description' => __( 'Change bottom header text Color', 'mayosis-core' ),
'section'     => 'bottom_bar',
'priority'    => 10,
'default'     => '#28375a', 
'output'      => array(
            array(
                'element'  => '.header-bottom',
                'property' => 'color',
            ),
        ),
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
              
