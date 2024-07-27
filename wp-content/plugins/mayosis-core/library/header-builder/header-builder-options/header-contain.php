<?php
Mayosis_Option::add_config( 'mayo_config', array(
        'option_name'   => 'theme_options', 
        'capability'    => 'edit_theme_options'
    ) );


Mayosis_Option::add_panel( 'header', array(
	'title'       => __( 'Header', 'mayosis-core' ),
	'description' => __( 'Change Site Header Options here.', 'mayosis-core' ),
	'priority' => '1',
) );

Mayosis_Option::add_section( 'header-content-main', array(
    'title' => __( 'Layout', 'mayosis-admin' ),
    'panel' => 'header',
    'priority' => '1',
    'description' => __( 'Whole header option here! please check them', 'mayosis-admin' ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-image',
    'settings'    => 'header_layout_type',
    'label'       => __( 'Header layout', 'mayosis-core' ),
    'section'     => 'header-content-main',
    'description'     => 'These are header layouts, we have 2 type of header layouts. You can use standard mode or sidebar mode. After select the mode use header builder to re-aarange the header content',
    'default'     => 'one',
    'choices'     => array(
            		'one'   => get_template_directory_uri() . '/images/Header-1.png',
            		'two'  => get_template_directory_uri() . '/images/Header-3.png',
            	),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
	'settings'    => 'header_transparency',
	'label'       => __( 'Header Type', 'mayosis-core' ),
	'section'     => 'header-content-main',
	'default'     => 'normal',
	'description'     => 'Standard work as a normal header.If you want to create transparent header then you should choose the Stacked mode after that down the opacity of header color from every header part.',
	'choices'     => array(
		'normal'   => esc_attr__( 'Standard', 'mayosis-core' ),
		'transparent' => esc_attr__( 'Stacked', 'mayosis-core' ),
	),
));


Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'color',
'settings'     => 'header_accent_color',
'label'       => __( 'Header Accent Color', 'mayosis-core' ),
'description' => __( 'Header dominating the main color is accent color. You can choose to a match your branding color', 'mayosis-core' ),
'section'     => 'header-content-main',
'priority'    => 10,
'default'     => '#5a00f0', 
'transport' =>$transport,
'output' => array(
	array(
		'element'  => '.cart-style-one .cart-button .edd-cart-quantity, 
        .cart_top_1 > .navbar-nav > li > a.login-button,
        .main-header .login-button:hover,.sidemenu-login .login-button,
        .header-search-form .download_cat_filter,
        .header-search-form .search-btn::after,
        header .product-search-form .mayosis_vendor_cat',
		'property' => 'background',
	),
	array(
		'element'  => '.cart-style-one .cart-button .edd-cart-quantity, 
        .cart_top_1 > .navbar-nav > li > a.login-button,
        .main-header .login-button:hover,.sidemenu-login .login-button,
        .header-search-form .download_cat_filter,
        .header-search-form .search-btn::after,
        header .product-search-form .mayosis_vendor_cat,.header-search-form input[type="text"],.product-search-form.header-search-form input[type="text"]',
		'property' => 'border-color',
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
'settings'     => 'header_accent_text_color',
'label'       => __( 'Header Accent Text Color', 'mayosis-core' ),
'description' => __( 'This is the color which is on top of the accent color.', 'mayosis-core' ),
'section'     => 'header-content-main',
'priority'    => 10,
'default'     => '#ffffff', 
'output' => array(
	array(
		'element'  => '.cart-style-one .cart-button .edd-cart-quantity, 
        .cart_top_1 > .navbar-nav > li > a.login-button,
        .main-header .login-button:hover,.sidemenu-login .login-button,
        .header-search-form .download_cat_filter,
        .header-search-form .search-btn::after,
        header .product-search-form .mayosis_vendor_cat,header .product-search-form .mayosel-select .current',
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
'type'        => 'radio-buttonset',
'settings'    => 'header_form_type',
'label'       => __( 'Form Field Type', 'mayosis-core' ),
'section'     => 'header-content-main',
'default'     => 'solid',
'priority'    => 10,
'choices'     => array(
	'solid'  => esc_attr__( 'Solid', 'mayosis-core' ),
	'border' => esc_attr__( 'Border', 'mayosis-core' ),
),
));
         
Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'color',
'settings'     => 'header_form_field_bg',
'label'       => __( 'Form Field Color', 'mayosis-core' ),
'description' => __( 'Change Form Field Color', 'mayosis-core' ),
'section'     => 'header-content-main',
'priority'    => 10,
'default'     => '#edeff2', 
'required'    => array(
    array(
        'setting'  => 'header_form_type',
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
'settings'     => 'header_form_border',
'label'       => __( 'Form Field Border Color', 'mayosis-core' ),
'description' => __( 'Change form field border color', 'mayosis-core' ),
'section'     => 'header-content-main',
'priority'    => 10,
'default'     => '#1e1e2d', 
'required'    => array(
    array(
        'setting'  => 'header_form_type',
        'operator' => '==',
        'value'    => 'border',
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
'type'        => 'dimension',
'settings'    => 'header_border_thikness',
'label'       => esc_attr__( 'Border Thickness', 'mayosis-core' ),
'description' => esc_attr__( 'Add header form border thickness', 'mayosis-core' ),
'section'     => 'header-content-main',
'default'     => '2px',
'required'    => array(
array(
    'setting'  => 'header_form_type',
    'operator' => '==',
    'value'    => 'border',
),
),

));


 Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'radio-buttonset',
'settings'    => 'header_menu_arrow',
'label'       => __( 'Show/Hide Header Menu Arrow', 'mayosis-core' ),
'section'     => 'header-content-main',
'default'     => 'show',
'priority'    => 10,
'choices'     => array(
	'show'  => esc_attr__( 'Show', 'mayosis-core' ),
	'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
),
));

Mayosis_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'custom-title-bx-shadow',
		'label'    => __( '', 'mayosis-core' ),
		'section'  => 'header-content-main',
		'default'  => '<div class="options-title">Box Shadow</div>',
	)
); 

 Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'radio-buttonset',
'settings'    => 'msv_shadow_ebl',
'label'       => __( 'Shadow', 'mayosis-core' ),
'section'     => 'header-content-main',
'default'     => 'disable',
'priority'    => 10,
'choices'     => array(
	'enable'  => esc_attr__( 'Enable', 'mayosis-core' ),
	'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
),
));

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'slider',
	'settings'    => 'msv-shadow-h-horizontal',
	'label'       => esc_html__( 'Horizontal', 'kirki' ),
	'section'     => 'header-content-main',
	'default'     => 5,
	'choices'     => [
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	],
	
	'active_callback' => [
	[
		'setting'  => 'msv_shadow_ebl',
		'operator' => '==',
		'value'    => 'enable',
	]
],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'slider',
	'settings'    => 'msv-shadow-h-vertical',
	'label'       => esc_html__( 'Vertical', 'kirki' ),
	'section'     => 'header-content-main',
	'default'     => 3,
	'choices'     => [
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	],
	'active_callback' => [
	[
		'setting'  => 'msv_shadow_ebl',
		'operator' => '==',
		'value'    => 'enable',
	]
],
] ); 

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'slider',
	'settings'    => 'msv-shadow-h-blur',
	'label'       => esc_html__( 'Blur', 'kirki' ),
	'section'     => 'header-content-main',
	'default'     => 0,
	'choices'     => [
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	],
	
	'active_callback' => [
	[
		'setting'  => 'msv_shadow_ebl',
		'operator' => '==',
		'value'    => 'enable',
	]
],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'slider',
	'settings'    => 'msv-shadow-h-spread',
	'label'       => esc_html__( 'Spread', 'kirki' ),
	'section'     => 'header-content-main',
	'default'     => 0,
	'choices'     => [
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	],
	
	'active_callback' => [
	[
		'setting'  => 'msv_shadow_ebl',
		'operator' => '==',
		'value'    => 'enable',
	]
],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'color',
	'settings'    => 'msv-shadow-h-color',
	'label'       => __( 'Shadow Color', 'kirki' ),
	'section'     => 'header-content-main',
	'default'     => '#0088CC',
	'choices'     => [
		'alpha' => true,
	],
	
	'active_callback' => [
	[
		'setting'  => 'msv_shadow_ebl',
		'operator' => '==',
		'value'    => 'enable',
	]
],
] );
include_once(dirname( __FILE__ ).'/header-presets.php');              
include_once(dirname( __FILE__ ).'/header-logo.php');
include_once(dirname( __FILE__ ).'/header-layout.php');
include_once(dirname( __FILE__ ).'/header-main.php');
include_once(dirname( __FILE__ ).'/header-top.php');
include_once(dirname( __FILE__ ).'/header-bottom.php');
include_once(dirname( __FILE__ ).'/header-sticky.php');
include_once(dirname( __FILE__ ).'/header-mobile.php');
include_once(dirname( __FILE__ ).'/header-main-menu.php');
include_once(dirname( __FILE__ ).'/header-bottombar-menu.php');
include_once(dirname( __FILE__ ).'/header-cart.php');
include_once(dirname( __FILE__ ).'/header-search.php');
include_once(dirname( __FILE__ ).'/header-social.php');
include_once(dirname( __FILE__ ).'/header-hamburger.php');
include_once(dirname( __FILE__ ).'/header-breadcrumbs.php');
include_once(dirname( __FILE__ ).'/header-code.php');
include_once(dirname( __FILE__ ).'/header-login-button.php');
include_once(dirname( __FILE__ ).'/header-collapsed.php');
include_once(dirname( __FILE__ ).'/header-custom-button.php');
include_once(dirname( __FILE__ ).'/header-dark.php');
