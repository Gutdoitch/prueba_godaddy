<?php
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'button_style_type',
        'label'       => __( 'Solid Button Style Type', 'mayosis-core' ),
        'section'     => 'button_style',
        'default'     => 'default',
        'priority'    => 10,
        'choices'     => array(
            'default'  => esc_attr__( 'Default', 'mayosis-core' ),
            'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
        ),
    ));
    
    
    Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
        'settings'     => 'btn_gradient_color_a',
        'label'       => __( 'Gradient Color A', 'mayosis-core' ),
        'description' => __( 'Choose Gradient Color A', 'mayosis-core' ),
        'section'     => 'button_style',
        'priority'    => 10,
        'default'     => '#3c28b4',
        'required'    => array(
            array(
                'setting'  => 'button_style_type',
                'operator' => '==',
                'value'    => 'gradient',
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
        'settings'     => 'btn_gradient_color_b',
        'label'       => __( 'Gradient Color B', 'mayosis-core' ),
        'description' => __( 'Choose Gradient Color B', 'mayosis-core' ),
        'section'     => 'button_style',
        'priority'    => 10,
        'default'     => '#643cdc',
        'required'    => array(
            array(
                'setting'  => 'button_style_type',
                'operator' => '==',
                'value'    => 'gradient',
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
        'type'        => 'radio-buttonset',
        'settings'    => 'gost_button_style_type',
        'label'       => __( 'Ghost Button Style Type', 'mayosis-core' ),
        'section'     => 'button_style',
        'default'     => 'default',
        'priority'    => 10,
        'choices'     => array(
            'default'  => esc_attr__( 'Default', 'mayosis-core' ),
            'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
        ),
    ));
    
    
    Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
        'settings'     => 'ghost_gradient_color_a',
        'label'       => __( 'Gradient Color A', 'mayosis-core' ),
        'description' => __( 'Choose Gradient Color A', 'mayosis-core' ),
        'section'     => 'button_style',
        'priority'    => 10,
        'default'     => '#3c28b4',
        'required'    => array(
            array(
                'setting'  => 'gost_button_style_type',
                'operator' => '==',
                'value'    => 'gradient',
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
        'settings'     => 'ghost_gradient_color_b',
        'label'       => __( 'Gradient Color B', 'mayosis-core' ),
        'description' => __( 'Choose Gradient Color B', 'mayosis-core' ),
        'section'     => 'button_style',
        'priority'    => 10,
        'default'     => '#643cdc',
        'required'    => array(
            array(
                'setting'  => 'gost_button_style_type',
                'operator' => '==',
                'value'    => 'gradient',
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
Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'global_button_border_radius',
	'section'     => 'button_style',
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
			'element'  => '.author-buttons--section .tec-follow-link,
			#commentform input[type=submit],
			button,.button,
			.media-style-d-favorite a.edd-wl-button,
			.media-style-d-favorite a.edd-wl-action.edd-wl-button,
			.btn,.ghost_button,.nl__item--submit,.back-to-top,
			.single-news-letter .nl__item--submit,#edd-purchase-button,
			.dm_register_button, 
			.edd-submit, input.edd-submit[type=submit],
			.btn.fes--author--btn,
			.mayosis-product-widget-counter .edd-advanced-sale-title span,
			.product_hover_details_button .button-fill-color,
			.post-promo-box.grid_dm .overlay_content_center a,
			.post-promo-box,
			.post-view-style,.author--name--image img,
			.follow--au--btn a,
			.common-paginav a.page-numbers, .common-paginav span.page-numbers,
			.upload-cover-button,
			.vendor-dasboard-template-main div.fes-form .fes-submit input[type="submit"],
			div.fes-form .fes-submit input[type="submit"],
			#fes-save-as-draft,
			.fes-product-list-td img,
			.msv-cs-filter-btn.button,.social-button,.overlay_content_center .live_demo_onh'
		],
	]
] );

//Start Common Colors
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'mayosis_rating_star_color',
        'label'       => __( 'Rating Star Color', 'mayosis-core' ),
        'description' => __( 'Change site rating star color', 'mayosis-core' ),
        'section'     => 'button_style',
        'priority'    => 10,
        'default'     => '#F3A712',
        'transport' =>$transport,
        'output' => array(
            	array(
            		'element'  => '.edd_star_rating span',
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