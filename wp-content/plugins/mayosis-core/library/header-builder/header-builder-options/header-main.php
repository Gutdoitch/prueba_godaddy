<?php
Mayosis_Option::add_section( 'master_head', array(
	'title'       => __( 'Main Header', 'mayosis-core' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'mayosis-core' ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-image',
    'settings'    => 'main_header_layout_type',
    'label'       => __( 'Main Header layout', 'mayosis-core' ),
    'section'     => 'master_head',
    'default'     => 'one',
    'choices'     => array(
            		'one'   => get_template_directory_uri() . '/images/header-layout-2.jpg',
            		'two'  => get_template_directory_uri() . '/images/header-layout-1.jpg',
            	),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
	'settings'    => 'middle_header_align',
	'label'       => esc_html__( 'Middle Part Content Align', 'mayosis-core' ),
	'section'     => 'master_head',
	'default'     => 'flexleft',
	'choices'     => [
		'flexleft'   => esc_html__( 'Left', 'mayosis-core' ),
		'flexcenter' => esc_html__( 'Center', 'mayosis-core' ),
		'flexright'  => esc_html__( 'Right', 'mayosis-core' ),
	],
	
	
	'required'    => array(
            array(
                'setting'  => 'main_header_layout_type',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
    ) );
    
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
	'settings'    => 'left_header_align',
	'label'       => esc_html__( 'Left Side Content Align', 'mayosis-core' ),
	'section'     => 'master_head',
	'default'     => 'flexleft',
	'choices'     => [
		'flexleft'   => esc_html__( 'Left', 'mayosis-core' ),
		'flexcenter' => esc_html__( 'Center', 'mayosis-core' ),
		'flexright'  => esc_html__( 'Right', 'mayosis-core' ),
	],
	
	
	'required'    => array(
            array(
                'setting'  => 'main_header_layout_type',
                'operator' => '==',
                'value'    => 'two',
            ),

        ),
    ) );
    
    
    Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
	'settings'    => 'right_header_align',
	'label'       => esc_html__( 'Right Side Content Align', 'mayosis-core' ),
	'section'     => 'master_head',
	'default'     => 'flexright',
	'choices'     => [
		'flexleft'   => esc_html__( 'Left', 'mayosis-core' ),
		'flexcenter' => esc_html__( 'Center', 'mayosis-core' ),
		'flexright'  => esc_html__( 'Right', 'mayosis-core' ),
	],
	
	
	'required'    => array(
            array(
                'setting'  => 'main_header_layout_type',
                'operator' => '==',
                'value'    => 'two',
            ),

        ),
    ) );
    
     Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
	'settings'    => 'mobile_header_align',
	'label'       => esc_html__( 'Mobile Right Content Align', 'mayosis-core' ),
	'section'     => 'master_head',
	'default'     => 'flexright',
	'choices'     => [
		'flexleft'   => esc_html__( 'Left', 'mayosis-core' ),
		'flexcenter' => esc_html__( 'Center', 'mayosis-core' ),
		'flexright'  => esc_html__( 'Right', 'mayosis-core' ),
	],
	
	
	'required'    => array(
            array(
                'setting'  => 'main_header_layout_type',
                'operator' => '==',
                'value'    => 'two',
            ),

        ),
    ) );


Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'switch',
	'settings'    => 'main_bar_fullwidth',
	'label'       => __( 'Full width main header', 'mayosis-core' ),
	'section'     => 'master_head',
	'default'     => 'off',
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'mayosis-core' ),
		'off' => esc_attr__( 'Disable', 'mayosis-core' ),
	),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
	'settings'    => 'main_header_height',
	'label'       => esc_attr__( 'Header Height', 'mayosis-core' ),
	'description' => esc_attr__( 'Change main header height', 'mayosis-core' ),
	'section'     => 'master_head',
	'default'     => '80px',
));


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
	'settings'    => 'main_header_line_height',
	'label'       => esc_attr__( 'Header Line Height', 'mayosis-core' ),
	'description' => esc_attr__( 'Change main header line height', 'mayosis-core' ),
	'section'     => 'master_head',
	'default'     => '80px',
	'output'      => array(
            array(
                'element'  => '.header-master #mayosis-menu > ul > li > a,.header-master ul li.cart-style-one a.cart-button,.header-master ul li a.cart-button,.header-master .search-dropdown-main a,.main-header
        .maxcollapse,.maxcollapse-icon, .maxcollapse-submit,.header-master .my-account-menu > a',
                'property' => 'line-height',
            ),
        ),
));
                    
 Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'dimensions',
'settings'    => 'main_header_padding',
'label'       => esc_attr__( 'Header Padding', 'mayosis-core' ),
'description' => esc_attr__( 'Change main header Padding', 'mayosis-core' ),
'section'     => 'master_head',
'default'     => array(
	'padding-top'    => '0px',
	'padding-bottom' => '0px',
	'padding-left'   => '0px',
	'padding-right'  => '0px',
),
));
                    
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
	'settings'    => 'header_icon_size',
	'label'       => esc_attr__( 'Header Icon Size', 'mayosis-core' ),
	'description' => esc_attr__( 'Change Header Icon Size', 'mayosis-core' ),
	'section'     => 'master_head',
	'default'     => '13px',
	'output' => array(
        array(
            'element'  => '.mayosis-option-menu li a i, .mayosis-option-menu li i, .desktop-hamburger-item i, #mayosis-menu ul li a i',
            'property' => 'font-size',
        ),
    ),
    ));
    
Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'radio-buttonset',
'settings'    => 'header_bg_type',
'label'       => __( 'Header Background Type', 'mayosis-core' ),
'section'     => 'master_head',
'default'     => 'color',
'priority'    => 10,
'choices'     => array(
	'color'  => esc_attr__( 'Color', 'mayosis-core' ),
	'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
	'image' => esc_attr__( 'Image', 'mayosis-core' ),
),
));
         
Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'color',
'settings'     => 'header_background',
'label'       => __( 'Main Header Background Color', 'mayosis-core' ),
'description' => __( 'Set main header background color', 'mayosis-core' ),
'section'     => 'master_head',
'priority'    => 10,
'default'     => '#ffffff', 
'required'    => array(
    array(
        'setting'  => 'header_bg_type',
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
'type'        => 'color',
'settings'     => 'main_header_text',
'label'       => __( 'Main Header Text Color', 'mayosis-core' ),
'description' => __( 'Set main header text color', 'mayosis-core' ),
'section'     => 'master_head',
'priority'    => 10,
'default'     => '#ffffff', 
'output' => array(
	array(
		'element'  => '.header-master,.header-master > a',
		'property' => 'color',
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
'settings'     => 'header_container_background',
'label'       => __( 'Main Header Container Background Color', 'mayosis-core' ),
'description' => __( 'Set main header container background color', 'mayosis-core' ),
'section'     => 'master_head',
'priority'    => 10,
'default'     => '', 
'required'    => array(
    array(
        'setting'  => 'header_bg_type',
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
     'output' => array(
            	array(
            		'element'  => '.header-master .container',
            		'property' => 'background',
            	),
            	
    	),
));
Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'color',
'settings'     => 'header_container_background_sticky',
'label'       => __( 'Container Background Sticky Color', 'mayosis-core' ),
'description' => __( 'Set main header container background sticky color', 'mayosis-core' ),
'section'     => 'master_head',
'priority'    => 10,
'default'     => '', 
'required'    => array(
    array(
        'setting'  => 'header_bg_type',
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
     'output' => array(
            	array(
            		'element'  => '.header-master.stickyenabled.fixedheader  .container',
            		'property' => 'background',
            	),
            	
    	),
));

Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'color',
'settings'     => 'header_container_background_alt',
'label'       => __( 'Main Header Container Background Color Alt', 'mayosis-core' ),
'description' => __( 'Set main header container background color for dark version', 'mayosis-core' ),
'section'     => 'master_head',
'priority'    => 10,
'default'     => '', 
'required'    => array(
    array(
        'setting'  => 'header_bg_type',
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
     'output' => array(
            	array(
            		'element'  => 'body.sp-night-mode-on .header-master .container',
            		'property' => 'background',
            	),
            	
    	),
));

Mayosis_Option::add_field( 'mayo_config', array(
  'type'        => 'multicolor',
    'settings'    => 'header_gradient',
    'label'       => esc_attr__( 'Header gradient', 'mayosis-core' ),
    'section'     => 'master_head',
    'priority'    => 10,
    'required'    => array(
    array(
        'setting'  => 'header_bg_type',
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
  'type'        => 'text',
    'settings'    => 'header_gradient_angle',
    'label'       => esc_attr__( 'Header gradient Angle', 'mayosis-core' ),
    'section'     => 'master_head',
    'priority'    => 10,
    'default'=>'90deg',
    'required'    => array(
    array(
        'setting'  => 'header_bg_type',
        'operator' => '==',
        'value'    => 'gradient',
    ),
),
  ));
Mayosis_Option::add_field( 'mayo_config', array(
   'type'        => 'image',
	'settings'    => 'header_bg_image',
	'label'       => esc_attr__( 'Header Background Image', 'mayosis-core' ),
	'description' => esc_attr__( 'Upload header background image', 'mayosis-core' ),
	'section'     => 'master_head',
	'required'    => array(
array(
    'setting'  => 'header_bg_type',
    'operator' => '==',
    'value'    => 'image',
        ),
    ),
	'default'     => '',
   ));
   
   
    
                    
 Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'dimensions',
'settings'    => 'main_header_container_padding',
'label'       => esc_attr__( 'Header Container Padding', 'mayosis-core' ),
'description' => esc_attr__( 'Change main header container Padding', 'mayosis-core' ),
'section'     => 'master_head',
'default'     => array(
	'padding-top'    => '0px',
	'padding-bottom' => '0px',
	'padding-left'   => '0px',
	'padding-right'  => '0px',
),
'output' => array(
            	array(
            		'element'  => '.header-master .container',
            	),
            	
    	),
));



                    
 Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'dimensions',
'settings'    => 'main_header_container_border_radius',
'label'       => esc_attr__( 'Header Container Border Radius', 'mayosis-core' ),
'description' => esc_attr__( 'Change main header container Border Radius', 'mayosis-core' ),
'section'     => 'master_head',
'default'     => array(
	'border-top-left-radius'    => '0px',
	'border-top-right-radius' => '0px',
	'border-bottom-left-radius'   => '0px',
	'border-bottom-right-radius'  => '0px',
),
'output' => array(
            	array(
            		'element'  => '.header-master .container',
            	),
            	
    	),
));

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
	'settings'    => 'main_header_container_margin-top',
	'label'       => esc_attr__( 'Header Container margin top', 'mayosis-core' ),
	'description' => esc_attr__( 'Change Header container margin top', 'mayosis-core' ),
	'section'     => 'master_head',
	'default'     => '0',
	'output' => array(
        array(
            'element'  => '.header-master .container',
            'property' => 'margin-top',
        ),
    ),
    ));