<?php

Mayosis_Option::add_field( 'mayo_config', array(
            'type'        => 'radio-buttonset',
            'settings'    => 'wd_bg_type',
            'label'       => __( 'Title Background Type', 'mayosis-core' ),
            'section'     => 'widget_color',
            'default'     => 'color',
            'priority'    => 10,
            'choices'     => array(
                'color'  => esc_attr__( 'Color', 'mayosis-core' ),
                'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
            ),
));

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'multicolor',
        'settings'    => 'wd_title_gradient',
        'label'       => esc_attr__( 'Widget gradient', 'mayosis-core' ),
        'section'     => 'widget_color',
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'wd_bg_type',
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
        'settings'     => 'wd_title_bg',
        'label'       => __( 'Title Background Color', 'mayosis-core' ),
        'description' => __( 'Set Title Background color', 'mayosis-core' ),
        'section'     => 'widget_color',
        'priority'    => 10,
        'default'     => '#1e0046',
        'required'    => array(
            array(
                'setting'  => 'wd_bg_type',
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
));



Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'color',
        'settings'     => 'wd_title_text',
        'label'       => __( 'Title Color', 'mayosis-core' ),
        'description' => __( 'Set Title color', 'mayosis-core' ),
        'section'     => 'widget_color',
        'priority'    => 10,
        'default'     => '#ffffff',
             'output' => array(
            	array(
            		'element'  => '.widget_block .wp-block-group__inner-container h2',
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

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'theme_widget_bg_color_main',
        'label'       => __( 'Widget Background Color', 'mayosis-core' ),
        'description' => __( 'Change Widget Backgrounnd Color', 'mayosis-core' ),
        'section'     => 'widget_color',
        'priority'    => 10,
        'default'     => '#e9edf7',
        'output' => array(
            	array(
            		'element'  => '.theme--sidebar--widget,.subscribe-box-photo,.sidebar-theme',
            		'property' => 'background',
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
    
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'wd_field_text',
        'label'       => __( 'Field Text Color', 'mayosis-core' ),
        'description' => __( 'Set Field Text color', 'mayosis-core' ),
        'section'     => 'widget_color',
        'priority'    => 10,
        'default'     => '#28375a',
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
       'type'        => 'radio-buttonset',
        'settings'    => 'wd_field_type',
        'label'       => __( 'Form Field Type', 'mayosis-core' ),
        'section'     => 'widget_color',
        'default'     => 'solid',
        'priority'    => 10,
        'choices'     => array(
            'solid'  => esc_attr__( 'Solid', 'mayosis-core' ),
            'border' => esc_attr__( 'Border', 'mayosis-core' ),
        ),
));

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'color',
        'settings'     => 'wd_field_color',
        'label'       => __( 'Form Field Color', 'mayosis-core' ),
        'description' => __( 'Change Form Field Color', 'mayosis-core' ),
        'section'     => 'widget_color',
        'priority'    => 10,
        'default'     => '#edeff2',
        'required'    => array(
            array(
                'setting'  => 'wd_field_type',
                'operator' => '==',
                'value'    => 'solid',
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

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'color',
        'settings'     => 'wd_border_color',
        'label'       => __( 'Form Border Color', 'mayosis-core' ),
        'description' => __( 'Change Form border Color', 'mayosis-core' ),
        'section'     => 'widget_color',
        'priority'    => 10,
        'default'     => '#282837',
        'required'    => array(
            array(
                'setting'  => 'wd_field_type',
                'operator' => '==',
                'value'    => 'border',
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

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'dimension',
        'settings'    => 'wd_border_thikness',
        'label'       => esc_attr__( 'Border Thickness', 'mayosis-core' ),
        'description' => esc_attr__( 'Add Main Site Form Border Thickness', 'mayosis-core' ),
        'section'     => 'widget_color',
        'default'     => '2px',
        'required'    => array(
            array(
                'setting'  => 'wd_field_type',
                'operator' => '==',
                'value'    => 'border',
            ),
        ),
));

  Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'sidebar_border_radius',
	'section'     => 'widget_color',
	'label'       => esc_attr__( 'Border Radius', 'mayosis-core' ),
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
			'element'  => '.theme--sidebar--widget,.subscribe-box-photo',
		],
	]
] );

 Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'sidebar_border_radius_title',
	'section'     => 'widget_color',
	'label'       => esc_attr__( 'Title Border Radius', 'mayosis-core' ),
	'default'     => [
		'top-left-radius'     => '3px',
		'top-right-radius'    => '3px',
		'bottom-left-radius'  => '0px',
		'bottom-right-radius' => '0px',
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
			'element'  => '.theme--sidebar--widget .widget-title',
		],
	]
] );

 Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'sidebar_box_padding_main',
	'section'     => 'widget_color',
	'label'       => esc_attr__( 'Widget Box Padding', 'mayosis-core' ),
	'default'     => [
		'top'     => '10px',
		'right'    => '30px',
		'bottom'  => '10px',
		'left' => '30px',
	],
	'choices'     => [
		'top'     => esc_attr__( 'Top', 'mayosis-core' ),
		'right'    => esc_attr__( 'Right', 'mayosis-core' ),
		'bottoms'  => esc_attr__( 'Bottom', 'mayosis-core' ),
		'left' => esc_attr__( 'Left', 'mayosis-core' ),
	],
	'transport'   => 'auto',
	'output'    => [
		[
			'property' => 'padding',
			'element'  => '.theme--sidebar--widget',
		],
	]
] );

 Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'sidebar_box_title_margin',
	'section'     => 'widget_color',
	'label'       => esc_attr__( 'Widget Title Margin', 'mayosis-core' ),
	'default'     => [
		'top'     => '-10px',
		'right'    => '-30px',
		'bottom'  => '20px',
		'left' => '-30px',
	],
	'choices'     => [
		'top'     => esc_attr__( 'Top', 'mayosis-core' ),
		'right'    => esc_attr__( 'Right', 'mayosis-core' ),
		'bottoms'  => esc_attr__( 'Bottom', 'mayosis-core' ),
		'left' => esc_attr__( 'Left', 'mayosis-core' ),
	],
	'transport'   => 'auto',
	'output'    => [
		[
			'property' => 'margin',
			'element'  => '.theme--sidebar--widget .widget-title',
		],
	]
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'sidebar_box_title_padding',
	'section'     => 'widget_color',
	'label'       => esc_attr__( 'Widget Title Padding', 'mayosis-core' ),
	'default'     => [
		'top'     => '25px',
		'right'    => '25px',
		'bottom'  => '25px',
		'left' => '25px',
	],
	'choices'     => [
		'top'     => esc_attr__( 'Top', 'mayosis-core' ),
		'right'    => esc_attr__( 'Right', 'mayosis-core' ),
		'bottoms'  => esc_attr__( 'Bottom', 'mayosis-core' ),
		'left' => esc_attr__( 'Left', 'mayosis-core' ),
	],
	'transport'   => 'auto',
	'output'    => [
		[
			'property' => 'padding',
			'element'  => '.theme--sidebar--widget .widget-title',
		],
	]
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'hide_widget_title',
	'label'       => esc_html__( 'Hide/Show Widget Title', 'mayosis-core' ),
	'section'     => 'widget_color',
	'default'     => 'block',
	'priority'    => 10,
	'choices'     => [
		'none'   => esc_html__( 'Hide', 'mayosis-core' ),
		'block' => esc_html__( 'Show', 'mayosis-core' ),
	],
	'transport'   => 'auto',
	'output'    => [
		[
			'property' => 'display',
			'element'  => '.theme--sidebar--widget .widget-title',
		],
	]
] );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'color',
        'settings'     => 'wd_button_color_m',
        'label'       => __( 'Widget Button BG Color', 'mayosis-core' ),
        'description' => __( 'Change Widget Button Background Color', 'mayosis-core' ),
        'section'     => 'widget_color',
        'priority'    => 10,
        'default'     => '#1e0046',
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
        'settings'     => 'wd_button_color_b',
        'label'       => __( 'Widget Button Border Color', 'mayosis-core' ),
        'description' => __( 'Change Widget Button Border Color', 'mayosis-core' ),
        'section'     => 'widget_color',
        'priority'    => 10,
        'default'     => '#1e0046',
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
        'settings'     => 'wd_button_color_tx',
        'label'       => __( 'Widget Button Text Color', 'mayosis-core' ),
        'description' => __( 'Change Widget Button Text Color', 'mayosis-core' ),
        'section'     => 'widget_color',
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
