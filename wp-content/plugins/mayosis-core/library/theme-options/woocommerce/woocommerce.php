<?php
Mayosis_Option::add_panel( 'mayosis_woo', array(
    'title'       => __( 'Mayo WooCommerce', 'mayosis-core' ),
    'description' => __( 'Mayosis WooCommerce Options', 'mayosis-core' ),
    'priority' => '15',
) );

Mayosis_Option::add_section( 'mayosis_woo_single', array(
    'title'       => __( 'Single Product Options', 'mayosis-core' ),
    'panel'       => 'mayosis_woo',

) );

Mayosis_Option::add_section( 'mayosis_woo_archive', array(
    'title'       => __( 'Archive Options', 'mayosis-core' ),
    'panel'       => 'mayosis_woo',

) );

Mayosis_Option::add_section( 'mayosis_woo_account', array(
    'title'       => __( 'My Account Options', 'mayosis-core' ),
    'panel'       => 'mayosis_woo',

) );

Mayosis_Option::add_section( 'mayosis_woo_search', array(
    'title'       => __( 'Search Options', 'mayosis-core' ),
    'panel'       => 'mayosis_woo',

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'woos_product_style',
    'label'       => __( 'Product Style', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'default'     => 'default',
    'priority'    => 10,
    'multiple'    => 1,
    'choices'     => array(
        'default' => esc_attr__( 'Default', 'mayosis-core' ),
        'media' => esc_attr__( 'Media Style', 'mayosis-core' ),
        'prime' => esc_attr__( 'Prime Style', 'mayosis-core' ),
       
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'woos_bredcrumb_type',
    'label'       => __( 'Breadcrumb Type', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'default'     => 'full-width',
    'priority'    => 10,
    'multiple'    => 1,
    'choices'     => array(
        'full-width' => esc_attr__( 'Full Width', 'mayosis-core' ),
        'container' => esc_attr__( 'Boxed', 'mayosis-core' ),
       
    ),
    
    	'required'    => array(
        array(
            'setting'  => 'woos_product_style',
            'operator' => '==',
            'value'    => 'default',
        ),
    ),

) );

 Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'wooBread_border_radius',
	'section'     => 'mayosis_woo_single',
	'label'       => esc_attr__( 'Breadcrumb Border Radius', 'mayosis-core' ),
	'default'     => [
		'top-left-radius'     => '0px',
		'top-right-radius'    => '0px',
		'bottom-left-radius'  => '0px',
		'bottom-right-radius' => '0px',
	],
	'choices'     => [
		'top-left-radius'     => esc_attr__( 'Top Left', 'mayosis-core' ),
		'top-right-radius'    => esc_attr__( 'Top Right', 'mayosis-core' ),
		'bottom-left-radius'  => esc_attr__( 'Bottom Left', 'mayosis-core' ),
		'bottom-right-radius' => esc_attr__( 'Bottom Right', 'mayosis-core' ),
	],
	'transport'   => $transport,
	'required'    => array(
        array(
            'setting'  => 'woos_bredcrumb_type',
            'operator' => '==',
            'value'    => 'container',
        ),
    ),
	'output'    => [
		[
			'property' => 'border',
			'element'  => '.mayosis-woo-single-style-one',
		],
	]
] );


Mayosis_Option::add_field( 'mayo_config', array(

    'type'        => 'dimensions',
    'settings'    => 'product_woosingle_padding',
    'label'       => esc_attr__( 'Product Breadcrumb Padding', 'mayosis-core' ),
    'description' => esc_attr__( 'Change Breadcrumb Padding', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'default'     => array(
        'padding-top'    => '80px',
        'padding-bottom' => '80px',
        'padding-left'   => '0px',
        'padding-right'  => '0px',
    ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'woos_background_product',
    'label'       => __( 'Background', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'default'     => 'color',
    'priority'    => 10,
    'multiple'    => 1,
    'choices'     => array(
        'color' => esc_attr__( 'Color', 'mayosis-core' ),
        'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
        'image' => esc_attr__( 'Image', 'mayosis-core' ),
        'featured' => esc_attr__( 'Featured Image', 'mayosis-core' ),
        'custom' => esc_attr__( 'Custom', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'woo_product_bg_default',
    'label'       => __( 'Background Color', 'mayosis-core' ),
    'description' => __( 'Change  Backgrounnd Color', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
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
            'setting'  => 'woos_background_product',
            'operator' => '==',
            'value'    => 'color',
        ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'multicolor',
    'settings'    => 'woo_product_gradient_default',
    'label'       => esc_attr__( 'Product gradient', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'priority'    => 10,
    'required'    => array(
        array(
            'setting'  => 'woos_background_product',
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

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'text',
    'settings' => 'woo_gradient_angle_product',
    'label'    => __( 'Angle', 'mayosis-core' ),
    'section'  => 'mayosis_woo_single',
    'default'  => esc_attr__( '135', 'mayosis-core' ),
    'priority' => 10,
    'required'    => array(
        array(
            'setting'  => 'woos_background_product',
            'operator' => '==',
            'value'    => 'gradient',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'image',
    'settings'    => 'woo_product-main-bg',
    'label'       => esc_attr__( 'Product Background Image', 'mayosis-core' ),
    'description' => esc_attr__( 'Custom Image.', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'required'    => array(
        array(
            'setting'  => 'woos_background_product',
            'operator' => '==',
            'value'    => 'image',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'text',
    'settings' => 'woo_main_product_blur',
    'label'    => __( 'Blur Radius', 'mayosis-core' ),
    'section'  => 'mayosis_woo_single',
    'default'  => esc_attr__( '5px', 'mayosis-core' ),
    'priority' => 10,
    'required'    => array(
        array(
            'setting'  => 'woos_background_product',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'woo_product_ovarlay_main',
    'label'       => __( 'Overlay Color', 'mayosis-core' ),
    'description' => __( 'Change  Overlay Color', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'priority'    => 10,
    'default'     => 'rgb(40,40,50,.5)',
    'choices'     => array(
        'alpha' => true,
    ),

    'required'    => array(
        array(
            'setting'  => 'woos_background_product',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'woo_parallax_featured_image',
    'label'       => __( 'Featured Image Parallax', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'default'     => 'no',
    'priority'    => 10,
    'choices'     => array(
        'yes'   => esc_attr__( 'Yes', 'mayosis-core' ),
        'no' => esc_attr__( 'No', 'mayosis-core' ),
    ),

    'required'    => array(
        array(
            'setting'  => 'woos_background_product',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'code',
    'settings'    => 'woo_product_custom_css',
    'label'       => esc_html__( 'Custom Css', 'mayosis-core' ),
    'description' => esc_html__( 'add custom css. you can add gradient code from gradienta.io', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'default'     => '',
    'choices'     => [
        'language' => 'css',
    ],
    'required'    => array(
        array(
            'setting'  => 'woos_background_product',
            'operator' => '==',
            'value'    => 'custom',
        ),
    ),
] );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'image',
    'settings'    => 'woo_default_overlay_image_product',
    'label'       => esc_attr__( 'Product Overlay Image', 'mayosis-core' ),
    'description' => esc_attr__( 'Upload product background image', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'default'     => '',

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'woo_product_bdtxt_color',
    'label'       => __( 'Breadcrumb Text Color', 'mayosis-core' ),
    'description' => __( 'Change breadcrumb text color', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
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

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'woos_audio_type_sdf',
    'label'       => __( 'Audio Type', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'default'     => 'hide',
    'priority'    => 10,
    'multiple'    => 1,
    'choices'     => array(
        'show' => esc_attr__( 'Wave', 'mayosis-core' ),
        'hide' => esc_attr__( 'Standard', 'mayosis-core' ),
       
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'woos_related_tpr_tyoe',
    'label'       => __( 'Audio Type', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'default'     => 'default',
    'priority'    => 10,
    'multiple'    => 1,
    'choices'     => array(
        'default' => esc_attr__( 'Default', 'mayosis-core' ),
        'masonry' => esc_attr__( 'Masonry', 'mayosis-core' ),
        'justified' => esc_attr__( 'Justified', 'mayosis-core' ),
       
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
    'settings'    => 'woos_related_tpr_count',
    'label'       => esc_attr__( 'Related Product Count', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'default'     => '4',

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'woo_single_title-s_typography_z',
        'label'       => esc_attr__( 'Single Title Typography', 'mayosis-core' ),
        'section'     => 'mayosis_woo_single',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => '700',
            'font-size'      => '2.25rem',
            'line-height'    => '1.25',
            'letter-spacing'    => '0',

        ),
        'priority'    => 10,

        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '.mayosis-woo-single-style-one .product_title',
            ),
        ),
        
     ) );
    
///Woo Archive
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'woos_bredcrumb_type_archive',
    'label'       => __( 'Breadcrumb Type', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'default'     => 'full-width',
    'priority'    => 10,
    'multiple'    => 1,
    'choices'     => array(
        'full-width' => esc_attr__( 'Full Width', 'mayosis-core' ),
        'container' => esc_attr__( 'Boxed', 'mayosis-core' ),
       
    ),

) );

 Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'wooBread_border_radius_archive',
	'section'     => 'mayosis_woo_archive',
	'label'       => esc_attr__( 'Breadcrumb Border Radius', 'mayosis-core' ),
	'default'     => [
		'top-left-radius'     => '0px',
		'top-right-radius'    => '0px',
		'bottom-left-radius'  => '0px',
		'bottom-right-radius' => '0px',
	],
	'choices'     => [
		'top-left-radius'     => esc_attr__( 'Top Left', 'mayosis-core' ),
		'top-right-radius'    => esc_attr__( 'Top Right', 'mayosis-core' ),
		'bottom-left-radius'  => esc_attr__( 'Bottom Left', 'mayosis-core' ),
		'bottom-right-radius' => esc_attr__( 'Bottom Right', 'mayosis-core' ),
	],
	'transport'   => $transport,
	'required'    => array(
        array(
            'setting'  => 'woos_bredcrumb_type_archive',
            'operator' => '==',
            'value'    => 'container',
        ),
    ),
	'output'    => [
		[
			'property' => 'border',
			'element'  => '.product-archive-breadcrumb-woo',
		],
	]
] );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimensions',
    'settings'    => 'woo_archive_breadcrumb_padding',
    'label'       => __( 'Archive Breadcrumb Padding', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'default'     => [
        'padding-top'    => '',
        'padding-bottom' => '',
        'padding-left'   => '',
        'padding-right'  => '',
    ],
    'transport' =>$transport,
    'output'      => [
        [
            'element' => '.product-archive-breadcrumb-woo',
        ],
    ],
) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'woo_archive_bg_type',
    'label'       => __( 'Archive Background Type', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'default'     => 'color',
    'priority'    => 10,
    'choices'     => array(
        'color'  => esc_attr__( 'Color/Image', 'mayosis-core' ),
        'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
        'featured' => esc_attr__( 'Category Image', 'mayosis-core' ),
        'custom' => esc_attr__( 'Custom', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'background',
    'settings'     => 'woo_parchive_background',
    'label'       => __( 'Breadcrumb Background', 'mayosis-core' ),
    'description' => __( 'Set Breadcrumb Background color', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'priority'    => 10,
    'default'     => '#1e0047',
    'transport' =>'auto',
    'required'    => array(
        array(
            'setting'  => 'woo_archive_bg_type',
            'operator' => '==',
            'value'    => 'color',
        ),
    ),
     'output'      => [
        [
            'element' => '.woo-archive-breadcrumb-color',
           
        ],
    ],
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
    'settings'    => 'woo_parchive_gradient',
    'label'       => esc_attr__( 'Breadcrumb gradient', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'priority'    => 10,
    'required'    => array(
        array(
            'setting'  => 'woo_archive_bg_type',
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

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'woo_pbread_ovarlay_main',
    'label'       => __( 'Overlay Color', 'mayosis-core' ),
    'description' => __( 'Change  Overlay Color', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'priority'    => 10,
    'default'     => 'rgb(40,40,50,.5)',
    'choices'     => array(
        'alpha' => true,
    ),

    'required'    => array(
        array(
            'setting'  => 'woo_archive_bg_type',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'woo_parallax_prbred_image',
    'label'       => __( 'Featured Image Parallax', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'default'     => 'no',
    'priority'    => 10,
    'choices'     => array(
        'yes'   => esc_attr__( 'Yes', 'mayosis-core' ),
        'no' => esc_attr__( 'No', 'mayosis-core' ),
    ),

    'required'    => array(
        array(
            'setting'  => 'woo_archive_bg_type',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'code',
    'settings'    => 'woo_archive_custom_css',
    'label'       => esc_html__( 'Custom Css', 'mayosis-core' ),
    'description' => esc_html__( 'add custom css. you can add gradient code from gradienta.io', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'default'     => '',
    'choices'     => [
        'language' => 'css',
    ],
    'required'    => array(
        array(
            'setting'  => 'woo_archive_bg_type',
            'operator' => '==',
            'value'    => 'custom',
        ),
    ),
] );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'woo_pbread_txt_color',
    'label'       => __( 'Breadcrumb Text Color', 'mayosis-core' ),
    'description' => __( 'Change Text Color', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'priority'    => 10,
    'default'     => '#ffffff',
    'choices'     => array(
        'alpha' => true,
    ),
    'output' => array(
        array(
            'element'  => '.product-archive-breadcrumb-woo,.product-archive-breadcrumb-woo .woocommerce-breadcrumb a,.product-archive-breadcrumb-woo .breadcrumb,product-archive-breadcrumb-woo .breadcrumb .active,
            .product-archive-breadcrumb-woo h1',
            'property' => 'color',
        ),



    ),

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'woo_archive_type',
    'label'       => __( 'Product Archive Type', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'default'     => 'one',
    'priority'    => 10,
    'choices'     => array(
        'one'   => esc_attr__( 'Full Width', 'mayosis-core' ),
        'two' => esc_attr__( 'With Sidebar', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'woot_sidebar_position_ls',
    'label'       => __( 'Sidebar Position', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'default'     => 'left',
    'priority'    => 10,
    'choices'     => array(
        'left'   => esc_attr__( 'Left', 'mayosis-core' ),
        'right' => esc_attr__( 'Right', 'mayosis-core' ),
    ),
    
     'required'    => array(
        array(
            'setting'  => 'woo_archive_type',
            'operator' => '==',
            'value'    => 'two',
        ),
        
        ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'woo_archive_column_grid',
    'label'       => __( 'Product Archive Column', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'default'     => '3',
    'priority'    => 10,
    'choices'     => array(
        '2'   => esc_attr__( 'Two Column', 'mayosis-core' ),
        '3' => esc_attr__( 'Three Column', 'mayosis-core' ),
        '4' => esc_attr__( 'Four Column', 'mayosis-core' ),
        '5' => esc_attr__( 'Five Column', 'mayosis-core' ),
        '6' => esc_attr__( 'Six Column', 'mayosis-core' ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'title_player_button_state_woo',
    'label'       => esc_html__( 'Audio Player Button Beside Title', 'mayosis-core' ),
    'section'     => 'mayosis_woo_archive',
    'default'     => 'show',
    'priority'    => 10,
    'choices'     => [
        'show'   => esc_html__( 'Show', 'mayosis-core' ),
        'hide' => esc_html__( 'hide', 'mayosis-core' ),
    ],
] );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'select',
    'settings' => 'select_login_woo_page',
    'label'    => esc_html__( 'Select Login Page', 'kirki' ),
    'section'  => 'mayosis_woo_account',
    'transport' =>'auto',
    'priority' => 10,
    'multiple' => 1,
    'choices'  => mayosis_get_posts(
        array(
            'posts_per_page' => 10,
            'post_type'      => 'page'
        )
    ),

 
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'select',
    'settings' => 'select_register_woo_page',
    'label'    => esc_html__( 'Select Register Page', 'kirki' ),
    'section'  => 'mayosis_woo_account',
    'transport' =>'auto',
    'priority' => 10,
    'multiple' => 1,
    'choices'  => mayosis_get_posts(
        array(
            'posts_per_page' => 10,
            'post_type'      => 'page'
        )
    ),

 
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'search_product_style_woo',
    'label'       => __( 'Search Product Style', 'mayosis-core' ),
    'section'     => 'mayosis_woo_search',
    'default'     => 'list',
    'priority'    => 10,
    'choices'     => array(
        'list'   => esc_attr__( 'List', 'mayosis-core' ),
        'grid' => esc_attr__( 'Grid', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'search_product_grid_count_woo',
    'label'       => __( 'Product Archive Column', 'mayosis-core' ),
    'section'     => 'mayosis_woo_search',
    'default'     => '3',
    'priority'    => 10,
    'choices'     => array(
        '2'   => esc_attr__( 'Two Column', 'mayosis-core' ),
        '3' => esc_attr__( 'Three Column', 'mayosis-core' ),
        '4' => esc_attr__( 'Four Column', 'mayosis-core' ),
        '5' => esc_attr__( 'Five Column', 'mayosis-core' ),
        '6' => esc_attr__( 'Six Column', 'mayosis-core' ),
    ),
    
     
     'required'    => array(
        array(
            'setting'  => 'search_product_style_woo',
            'operator' => '==',
            'value'    => 'grid',
        ),
        
        ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'search_category_ds',
    'label'       => __( 'Search Category', 'mayosis-core' ),
    'section'     => 'mayosis_woo_search',
    'default'     => 'show',
    'priority'    => 10,
    'choices'     => array(
        'show'   => esc_attr__( 'Show', 'mayosis-core' ),
        'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'search_style_ds',
    'label'       => __( 'Search Style', 'mayosis-core' ),
    'section'     => 'mayosis_woo_search',
    'default'     => 'one',
    'priority'    => 10,
    'choices'     => array(
        'one'   => esc_attr__( 'One', 'mayosis-core' ),
        'two' => esc_attr__( 'Two', 'mayosis-core' ),
    ),

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
    'settings'    => 'search_woo_placeholder_m',
    'label'       => __( 'Search Placeholder', 'mayosis-core' ),
    'section'     => 'mayosis_woo_search',
    'default'     => 'Search for Product...',
    'priority'    => 10,
   

) );


//Single Product Media Style
Mayosis_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'media-style-title_woo',
		'label'    => __( '', 'mayosis-core' ),
		'section'  => 'mayosis_woo_single',
		'default'  => '<div class="options-title">Media Style</div>',
		  
     'required'    => array(
        array(
            'setting'  => 'woos_product_style',
            'operator' => '==',
            'value'    => 'media',
        ),
        
        ),
	)
);

 Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'media_style_bg_wrapper_woo',
        'label'       => __( 'Top Wrapper Background', 'mayosis-core' ),
        'description' => __( 'Change top wrapper bg color', 'mayosis-core' ),
        'section'     => 'mayosis_woo_single',
        'priority'    => 10,
        'default'     => '#e9ebf7',
        'output' => array(
            	array(
            		'element'  => '.woocommerce .media-template-wrapper',
            		'property' => 'background-color',
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
        
         'required'    => array(
        array(
            'setting'  => 'woos_product_style',
            'operator' => '==',
            'value'    => 'media',
        ),
        
        ),
        
));

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
    'settings'    => 'woo_product_photo_margin_topm',
    'label'       => esc_attr__( 'Media Margin Top', 'mayosis-core' ),
    'description' => esc_attr__( 'Media Margin Top', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'default'     => '80px',
    'output'    => array(
        array(
            'element'  => '.woocommerce .photo-template-author',
            'property' => 'margin-top',

        ),
    ),
    
    	'required'    => array(
        array(
            'setting'  => 'woos_product_style',
            'operator' => '==',
            'value'    => 'media',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
    'settings'    => 'woo_product_photo_margin_bottomm',
    'label'       => esc_attr__( 'Photo Template Margin Bottom', 'mayosis-core' ),
    'description' => esc_attr__( 'Photo Template Margin Bottom', 'mayosis-core' ),
    'section'     => 'mayosis_woo_single',
    'default'     => '80px',
    'output'    => array(
        array(
            'element'  => '.woocommerce .photo-template-author',
            'property' => 'margin-bottom',

        ),
    ),
    
    	'required'    => array(
        array(
            'setting'  => 'woos_product_style',
            'operator' => '==',
            'value'    => 'media',
        ),
    ),
    
    

) );


