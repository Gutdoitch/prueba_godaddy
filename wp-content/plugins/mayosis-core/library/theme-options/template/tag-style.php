<?php //Start tag template
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
        'settings'    => 'tag_bg_type',
        'label'       => __( 'Tag Breadcrumb Background Type', 'mayosis-core' ),
        'section'     => 'tag_style',
        'default'     => 'gradient',
        'priority'    => 10,
        'choices'     => array(
            'color'  => esc_attr__( 'Color', 'mayosis-core' ),
            'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
            'custom' => esc_attr__( 'Custom', 'mayosis-core' ),
        ),
        
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
        'settings'     => 'tag_background',
        'label'       => __( 'Breadcrumb Background Color', 'mayosis-core' ),
        'description' => __( 'Set Breadcrumb Background color', 'mayosis-core' ),
        'section'     => 'tag_style',
        'priority'    => 10,
        'default'     => '#1e0047',
        'output' => array(
        	array(
        		'element'  => '.tag_breadcrumb_color',
        		'property' => 'background',
        	),
),
        'required'    => array(
            array(
                'setting'  => 'tag_bg_type',
                'operator' => '==',
                'value'    => 'color',
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
        
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'multicolor',
        'settings'    => 'tag_gradient',
        'label'       => esc_attr__( 'Breadcrumb gradient', 'mayosis-core' ),
        'section'     => 'tag_style',
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'tag_bg_type',
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

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'code',
	'settings'    => 'tag_custom_css',
	'label'       => esc_html__( 'Custom Css', 'mayosis-core' ),
	'description' => esc_html__( 'add custom css. you can add gradient code from gradienta.io', 'mayosis-core' ),
	'section'     => 'tag_style',
	'default'     => '',
	'choices'     => [
		'language' => 'css',
	],
	'required'    => array(
            array(
                'setting'  => 'tag_bg_type',
                'operator' => '==',
                'value'    => 'custom',
            ),
        ),
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'typography',
	'settings'    => 'tag_heading_typo',
	'label'       => esc_html__( 'Tag heading Typo', 'mayosis-core' ),
	'section'     => 'tag_style',
	'default'     => [
		'font-family'    => 'Lato',
		'variant'        => '700',
		'font-size'      => '36px',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'color'          => '#ffffff',
		'text-transform' => 'none',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.tag_breadcrumb_color .parchive-page-title',
		],
	],
] );