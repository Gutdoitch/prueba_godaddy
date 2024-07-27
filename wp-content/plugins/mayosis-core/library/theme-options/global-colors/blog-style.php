<?php
Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'color',
	'settings'    => 'blog_box_bg_color',
	'label'       => __( 'Blog Grid background Color', 'mayosis-core' ),
	'description' => esc_html__( 'Change the background color', 'mayosis-core' ),
	'section'     => 'blog_style',
	'default'     => '#ffffff',
	'choices'     => [
		'alpha' => true,
	],
	'output'      => [
		[
			'property' => 'background',
			'element'  => '.blog-box.grid_dm',
		],
		],
] );
Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'gblog_box_radius',
	'section'     => 'blog_style',
	'label'       => esc_attr__( 'Blog Grid Border Radius', 'mayosis-core' ),
	'default'     => [
		'top-left-radius'     => '3px',
		'top-right-radius'    => '3px',
		'bottom-left-radius'  => '3px',
		'bottom-right-radius' => '3px',
	],
	'choices'     => [
		'top-left-radius'     => esc_attr__( 'Top Left', 'mayosis-core' ),
		'top-right-radius'    => esc_attr__( 'Top Right', 'mayosis-core' ),
		'bottom-left-radius'  => esc_attr__( 'Bottom Left', 'mayosis-core' ),
		'bottom-right-radius' => esc_attr__( 'Bottom Right', 'mayosis-core' ),
	],
	'transport'   => 'auto',
	'output'    => [
		[
			'property' => 'border',
			'element'  => '.blog-box.grid_dm',
		],
	]
] );


Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'gblog_image_radius',
	'section'     => 'blog_style',
	'label'       => esc_attr__( 'Image Border Radius', 'mayosis-core' ),
	'default'     => [
		'top-left-radius'     => '3px',
		'top-right-radius'    => '3px',
		'bottom-left-radius'  => '3px',
		'bottom-right-radius' => '3px',
	],
	'choices'     => [
		'top-left-radius'     => esc_attr__( 'Top Left', 'mayosis-core' ),
		'top-right-radius'    => esc_attr__( 'Top Right', 'mayosis-core' ),
		'bottom-left-radius'  => esc_attr__( 'Bottom Left', 'mayosis-core' ),
		'bottom-right-radius' => esc_attr__( 'Bottom Right', 'mayosis-core' ),
	],
	'transport'   => 'auto',
	'output'    => [
		[
			'property' => 'border',
			'element'  => '.blog-box.grid_dm .mayosis-fade-in img, .blog-box.grid_dm figure',
		],
	]
] );

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'dimensions',
	'settings'    => 'blog_border_width',
	'label'       => esc_attr__( 'Blog Box Border Width', 'mayosis-core' ),
	'section'     => 'blog_style',
	'default'     => [
		'top-width'    => '0px',
		'right-width'  => '0px',
		'bottom-width' => '0px',
		'left-width'   => '0px',
	],
	'choices'     => [
		'top-width'    => esc_attr__( 'Top', 'mayosis-core' ),
		'right-width'  => esc_attr__( 'Bottom', 'mayosis-core' ),
		'bottom-width' => esc_attr__( 'Left', 'mayosis-core' ),
		'left-width'   => esc_attr__( 'Right', 'mayosis-core' ),
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'property' => 'border',
			'element'  => '.blog-box.grid_dm',
		],
	],
) );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'color',
	'settings'    => 'blog_box_border_color',
	'label'       => __( 'Border Color', 'mayosis-core' ),
	'description' => esc_html__( 'Change the border color', 'mayosis-core' ),
	'section'     => 'blog_style',
	'default'     => '#cccccc',
	'choices'     => [
		'alpha' => true,
	],
	'output'      => [
		[
			'property' => 'border-color',
			'element'  => '.blog-box.grid_dm',
		],
		],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'select',
	'settings'    => 'blog_box_border_style',
	'label'       => esc_html__( 'Border Style', 'mayosis-core' ),
	'section'     => 'blog_style',
	'default'     => 'solid',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'solid' => esc_html__( 'Solid', 'mayosis-core' ),
		'dotted' => esc_html__( 'Dotted', 'mayosis-core' ),
		'dashed' => esc_html__( 'Dashed', 'mayosis-core' ),
	],
		'output'      => [
		[
			'property' => 'border-style',
			'element'  => '.blog-box.grid_dm',
		],
		],
] );

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'dimensions',
	'settings'    => 'blog_meta_padding',
	'label'       => esc_attr__( 'Blog Meta Padding', 'mayosis-core' ),
	'section'     => 'blog_style',
	'default'     => [
		'top'    => '0px',
		'right'  => '0px',
		'bottom' => '0px',
		'left'   => '0px',
	],
	'choices'     => [
		'top'    => esc_attr__( 'Top', 'mayosis-core' ),
		'right'  => esc_attr__( 'Bottom', 'mayosis-core' ),
		'bottom' => esc_attr__( 'Left', 'mayosis-core' ),
		'left'   => esc_attr__( 'Right', 'mayosis-core' ),
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'property' => 'padding',
			'element'  => '.blog-box.grid_dm .blog-meta',
		],
	],
) );
