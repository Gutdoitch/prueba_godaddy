<?php

Mayosis_Option::add_section( 'header_logo', array(
	'title'       => __( 'Logo', 'mayosis-core' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'mayosis-core' ),
) );



Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'image',
	'settings'     => 'main_logo',
	'label'       => __( 'Logo image', 'mayosis-core' ),
	'description' => __( 'Upload 2X Logo for retina & use size from below.', 'mayosis-core' ),
	'section'     => 'header_logo',
	'default'     => get_template_directory_uri().'/images/Mayosis_Color_Logo.svg',
	'transport' => 'auto',
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'image',
	'settings'     => 'mobile-logo-image',
	'label'       => __( 'Mobile Logo Image', 'mayosis-core' ),
	'description' => __( 'Upload different logo on mobile', 'mayosis-core' ),
	'section'     => 'header_logo',
	
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'image',
	'settings'     => 'sticky_logo',
	'label'       => __( 'Sticky Header Logo Image', 'mayosis-core' ),
	'description' => __( 'Upload different logo on sticky header', 'mayosis-core' ),
	'section'     => 'header_logo',
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'image',
'settings'    => 'favicon-upload',
'label'       => esc_attr__( 'Favicon', 'mayosis-core' ),
'description' => esc_attr__( 'Recommanded 80 X 80px', 'mayosis-core' ),
'section'     => 'header_logo',
'default'     => get_template_directory_uri() . '/images/fav.png',
));
 
 Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
	'settings'    => 'logo_property',
	'label'       => __( 'Set Logo Property', 'mayosis-core' ),
	'section'     => 'header_logo',
	'default'     => 'width',
	'description'     => 'Set logo size property by Width or Height',
	'choices'     => array(
		'width'   => esc_attr__( 'Width', 'mayosis-core' ),
		'height' => esc_attr__( 'Height', 'mayosis-core' ),
	),
));

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
	'settings'    => 'logo-width',
	'label'       => esc_attr__( 'Logo Width', 'mayosis-core' ),
	'description' => esc_attr__( 'Add Logo Width', 'mayosis-core' ),
	'section'     => 'header_logo',
	'default'     => '',
	'required'    => array(
            array(
                'setting'  => 'logo_property',
                'operator' => '==',
                'value'    => 'width',
            ),
        ),
    ));
    
    Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
	'settings'    => 'logo-height',
	'label'       => esc_attr__( 'Logo Height', 'mayosis-core' ),
	'description' => esc_attr__( 'Add Logo Height', 'mayosis-core' ),
	'section'     => 'header_logo',
	'default'     => '',
	'required'    => array(
            array(
                'setting'  => 'logo_property',
                'operator' => '==',
                'value'    => 'height',
            ),
        ),
    ));
    
    Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
	'settings'    => 'logo_property_mobile',
	'label'       => __( 'Set Logo Property(Mobile)', 'mayosis-core' ),
	'section'     => 'header_logo',
	'default'     => 'width',
	'description'     => 'Set logo size property by Width or Height',
	'choices'     => array(
		'width'   => esc_attr__( 'Width', 'mayosis-core' ),
		'height' => esc_attr__( 'Height', 'mayosis-core' ),
	),
));

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
	'settings'    => 'logo-width-mobile',
	'label'       => esc_attr__( 'Logo Width(Mobile)', 'mayosis-core' ),
	'description' => esc_attr__( 'Add Logo Width', 'mayosis-core' ),
	'section'     => 'header_logo',
	'default'     => '',
	'required'    => array(
            array(
                'setting'  => 'logo_property_mobile',
                'operator' => '==',
                'value'    => 'width',
            ),
        ),
    ));
    
    Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
	'settings'    => 'logo-height-mobile',
	'label'       => esc_attr__( 'Logo Height(Mobile)', 'mayosis-core' ),
	'description' => esc_attr__( 'Add Logo Height', 'mayosis-core' ),
	'section'     => 'header_logo',
	'default'     => '',
	'required'    => array(
            array(
                'setting'  => 'logo_property_mobile',
                'operator' => '==',
                'value'    => 'height',
            ),
        ),
    ));
     Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
	'settings'    => 'dark_logo',
	'label'       => __( 'Dark Version Logo Enable', 'mayosis-core' ),
	'section'     => 'header_logo',
	'default'     => 'disable',
	'description'     => 'Dark Version Logo Enable/ Disable',
	'choices'     => array(
		'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
		'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
	),
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'image',
	'settings'     => 'dark_logo_img',
	'label'       => __( 'Dark Logo image', 'mayosis-core' ),
	'description' => __( 'Upload 2X Logo for retina & use size from below.', 'mayosis-core' ),
	'section'     => 'header_logo',
	'transport' => 'auto',
));

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
	'settings'    => 'logo-cs-link-m',
	'label'       => esc_attr__( 'Logo Custom URL', 'mayosis-core' ),
	'description' => esc_attr__( 'Add Logo Custom URL', 'mayosis-core' ),
	'section'     => 'header_logo',
	'default'     => '',
    ));