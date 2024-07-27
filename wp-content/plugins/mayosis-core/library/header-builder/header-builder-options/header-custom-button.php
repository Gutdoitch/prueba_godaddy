<?php

Mayosis_Option::add_section( 'header_custom_button', array(
	'title'       => __( 'Custom Button', 'mayosis-core' ),
	'panel'       => 'header',
) );


Mayosis_Option::add_field( 'mayo_config',  array(
    'type'     => 'text',
	'settings' => 'custom_button_text',
	'label'    => __( 'Button Text', 'mayosis-core' ),
	'section'  => 'header_custom_button',
	'default'  => esc_attr__( 'Button', 'mayosis-core' ),
));


Mayosis_Option::add_field( 'mayo_config',  array(
    'type'     => 'link',
	'settings' => 'custom_button_url',
	'label'    => __( 'Button URL', 'mayosis-core' ),
	'section'  => 'header_custom_button',
	'default'  => esc_attr__( 'http://yourdomain.com', 'mayosis-core' ),
));
Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'radio-buttonset',
	'settings'    => 'ct-position-sd',
	'label'       => __( 'Custom Button Show', 'mayosis-core' ),
	'section'     => 'header_custom_button',
	'default'     => 'always',
	'priority'    => 10,
	'choices'     => array(
		'always'  => esc_attr__( 'Always', 'mayosis-core' ),
		'logout' => esc_attr__( 'Logout', 'mayosis-core' ),
		'login' => esc_attr__( 'Login', 'mayosis-core' ),
	),
) );
Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'radio-buttonset',
	'settings'    => 'ct-button-type',
	'label'       => __( 'Custom Button Type', 'mayosis-core' ),
	'section'     => 'header_custom_button',
	'default'     => 'standard-button',
	'priority'    => 10,
	'choices'     => array(
		'standard-button'  => esc_attr__( 'Standard', 'mayosis-core' ),
		'ghost-button' => esc_attr__( 'Ghost', 'mayosis-core' ),
	),
) );


Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'color',
	'settings'    => 'button-bg-ct',
	'label'       => __( 'Custom Button Background', 'mayosis-core' ),
	'section'     => 'header_custom_button',
	'default'     => '#0088CC',
	'choices'     => array(
		'alpha' => true,
	),
) );

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'color',
	'settings'    => 'button-border-ct',
	'label'       => __( 'Custom Button Border', 'mayosis-core' ),
	'section'     => 'header_custom_button',
	'default'     => '#0088CC',
	'choices'     => array(
		'alpha' => true,
	),
) );

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'color',
	'settings'    => 'button-color-text',
	'label'       => __( 'Custom Button Text', 'mayosis-core' ),
	'section'     => 'header_custom_button',
	'default'     => '#ffffff',
	'choices'     => array(
		'alpha' => true,
	),
) );


Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'color',
	'settings'    => 'button-bghover-ct',
	'label'       => __( 'Custom Button Background Hover Color', 'mayosis-core' ),
	'section'     => 'header_custom_button',
	'default'     => '#0088CC',
	'choices'     => array(
		'alpha' => true,
	),
) );

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'color',
	'settings'    => 'button-borderhov-ct',
	'label'       => __( 'Custom Button Border Hover Color', 'mayosis-core' ),
	'section'     => 'header_custom_button',
	'default'     => '#0088CC',
	'choices'     => array(
		'alpha' => true,
	),
) );

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'color',
	'settings'    => 'button-colorhov-text',
	'label'       => __( 'Custom Button Text Hover Color', 'mayosis-core' ),
	'section'     => 'header_custom_button',
	'default'     => '#ffffff',
	'choices'     => array(
		'alpha' => true,
	),
) );

    Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'dimensions',
	'settings'    => 'header-cs-button-border-radius',
	'label'       => esc_attr__( 'Border Radius (px)', 'mayosis-core' ),
	'section'     => 'header_custom_button',
	'output'      => array(
            array(
                'element'  => '.custom-button',
            ),
            
        ),
	 'default'     => array(
            'border-top-left-radius'    => '0px',
            'border-top-right-radius' => '0px',
            'border-bottom-left-radius'   => '0px',
            'border-bottom-right-radius'  => '0px',
        ),
        ));
