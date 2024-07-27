<?php
Mayosis_Option::add_panel( 'white_label', array(
	'title'       => __( 'White Label', 'mayosis-core' ),
	'description' => __( 'White Label', 'mayosis-core' ),
	'priority' => '11',
) );

Mayosis_Option::add_section( 'admin_logo_white', array(
	'title'       => __( 'Admin', 'mayosis-core' ),
	'panel'       => 'white_label',

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'image',
        'settings'    => 'admin_logo',
        'label'       => esc_attr__( 'Admin Login Logo', 'mayosis-core' ),
        'description' => esc_attr__( 'Recommanded Size 130 x 90px Maximum', 'mayosis-core' ),
        'section'     => 'admin_logo_white',
        'default'     => get_template_directory_uri() . '/images/logo.png',
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'select',
        'settings'    => 'admin_login_style',
        'label'       => __( 'Login Page Style', 'mayosis-core' ),
        'section'     => 'admin_logo_white',
        'default'     => 'style1',
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => array(
            'style1' => esc_attr__( 'Style One', 'mayosis-core' ),
            'style2' => esc_attr__( 'Style Two', 'mayosis-core' ),
        
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'select',
        'settings'    => 'admin_login_bg_type',
        'label'       => __( 'Background', 'mayosis-core' ),
        'section'     => 'admin_logo_white',
        'default'     => 'gradient',
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => array(
            'color' => esc_attr__( 'Color', 'mayosis-core' ),
            'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
            'image' => esc_attr__( 'Image', 'mayosis-core' ),
            'customcode' => esc_attr__( 'Custom Code', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'admin_login_bg_color',
        'label'       => __( 'Background Color', 'mayosis-core' ),
        'description' => __( 'Change  Background Color', 'mayosis-core' ),
        'section'     => 'admin_logo_white',
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
                'setting'  => 'admin_login_bg_type',
                'operator' => '==',
                'value'    => 'color',
            ),
        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'image',
        'settings'    => 'admin_login_bg',
        'label'       => esc_attr__( 'Background Image', 'mayosis-core' ),
        'description' => esc_attr__( 'Custom background Image.', 'mayosis-core' ),
        'section'     => 'admin_logo_white',
        'required'    => array(
            array(
                'setting'  => 'admin_login_bg_type',
                'operator' => '==',
                'value'    => 'image',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'admin_overlay_color',
        'label'       => __( 'Background Overlay Color', 'mayosis-core' ),
        'description' => __( 'Change  Background Overlay Color', 'mayosis-core' ),
        'section'     => 'admin_logo_white',
        'priority'    => 10,
        'default'     => 'rgba(0, 0, 0, 0.4)',
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

        'required'    => array(
            array(
                'setting'  => 'admin_login_bg_type',
                'operator' => '==',
                'value'    => 'image',
            ),
        ),
    
) );




Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'code',
	'settings'    => 'admin_login_custom_code_setting',
	'label'       => esc_html__( 'Add Background Custom Code CSS', 'mayosis-core' ),
	'description' => esc_html__( 'Add Custom CSS to show your desired background. you can use multiple gradient from gradienta.io', 'mayosis-core' ),
	'section'     => 'admin_logo_white',
	'default'     => '',
	'choices'     => [
		'language' => 'css',
	],
	 'required'    => array(
            array(
                'setting'  => 'admin_login_bg_type',
                'operator' => '==',
                'value'    => 'customcode',
            ),
        ),
] );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'multicolor',
        'settings'    => 'gradient_admin',
        'label'       => esc_attr__( 'Admin gradient bg', 'mayosis-core' ),
        'section'     => 'admin_logo_white',
        'priority'    => 10,
        'choices'     => array(
            'color1'    => esc_attr__( 'Form', 'mayosis-core' ),
            'color2'   => esc_attr__( 'To', 'mayosis-core' ),
        ),
        'default'     => array(
            'color1'    => '#1e0046',
            'color2'   => '#1e0064',
        ),
        
         'required'    => array(
            array(
                'setting'  => 'admin_login_bg_type',
                'operator' => '==',
                'value'    => 'gradient',
            ),
        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
        'settings'     => 'login_button_admin',
        'label'       => __( 'Login Button Color', 'mayosis-core' ),
        'description' => __( 'Main Admin Login Button Color', 'mayosis-core' ),
        'section'     => 'admin_logo_white',
        'priority'    => 10,
        'default'     => '#5a00f0',
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
        'type'        => 'color',
        'settings'     => 'admin_login_box_color',
        'label'       => __( 'Login Box Background Color', 'mayosis-core' ),
        'description' => __( 'Change Background Color', 'mayosis-core' ),
        'section'     => 'admin_logo_white',
        'priority'    => 10,
        'default'     => '#ffffff',
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

    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'admin_login_box_text_color',
        'label'       => __( 'Login Box Text Color', 'mayosis-core' ),
        'description' => __( 'Change Text Color', 'mayosis-core' ),
        'section'     => 'admin_logo_white',
        'priority'    => 10,
        'default'     => '#555d66',
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
        'type'        => 'color',
        'settings'     => 'admin_input_fields_color',
        'label'       => __( 'Input Fields Background Color', 'mayosis-core' ),
        'description' => __( 'Change Input Fields  Color', 'mayosis-core' ),
        'section'     => 'admin_logo_white',
        'priority'    => 10,
        'default'     => '#e8f0fe',
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

    
) );