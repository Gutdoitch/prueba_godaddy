<?php
Mayosis_Option::add_panel( 'mayosis_product', array(
	'title'       => __( 'Product Options', 'mayosis-core' ),
	'description' => __( 'Mayosis Product Options.', 'mayosis-core' ),
	'priority' => '7',
) );

Mayosis_Option::add_section( 'product_options', array(
	'title'       => __( 'General Options', 'mayosis-core' ),
	'panel'       => 'mayosis_product',

) );

Mayosis_Option::add_section( 'grid_meta', array(
	'title'       => __( 'Meta Options', 'mayosis-core' ),
	'panel'       => 'mayosis_product',

) );


Mayosis_Option::add_section( 'mayosis_grid_ribbon', array(
	'title'       => __( 'Ribbon & Badges', 'mayosis-core' ),
	'panel'       => 'mayosis_product',

) );

Mayosis_Option::add_section( 'product_information_widget', array(
	'title'       => __( 'Product Information Widget', 'mayosis-core' ),
	'panel'       => 'mayosis_product',

) );

Mayosis_Option::add_section( 'product_video', array(
	'title'       => __( 'Video Grid Options', 'mayosis-core' ),
	'panel'       => 'mayosis_product',

) );

Mayosis_Option::add_section( 'product_more', array(
	'title'       => __( 'Other Options', 'mayosis-core' ),
	'panel'       => 'mayosis_product',

) );
Mayosis_Option::add_section( 'product_subscription_widget', array(
	'title'       => __( 'Product Subscription Widget', 'mayosis-core' ),
	'panel'       => 'mayosis_product',

) );
Mayosis_Option::add_section( 'product_subscription_package', array(
	'title'       => __( 'Subscription Package Widget', 'mayosis-core' ),
	'panel'       => 'mayosis_product',

) );
Mayosis_Option::add_section( 'product_envato_api_section', array(
	'title'       => __( 'Envato API', 'mayosis-core' ),
	'panel'       => 'mayosis_product',

) );

Mayosis_Option::add_section( 'product_filtered_section', array(
	'title'       => __( 'Filterted Element', 'mayosis-core' ),
	'panel'       => 'mayosis_product',

) );




Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'radio-buttonset',
        'settings'    => 'product_grid_system',
        'label'       => __( 'Product Grid System', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 'one',
        'priority'    => 10,
        'choices'     => array(
            'one'   => esc_attr__( 'Normal', 'mayosis-core' ),
            'two' => esc_attr__( 'Masonary', 'mayosis-core' ),
            'three' => esc_attr__( 'Justified', 'mayosis-core' ),
            'four' => esc_attr__( 'List', 'mayosis-core' ),
        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'radio-buttonset',
        'settings'    => 'product_grid_options',
        'label'       => __( 'Product Grid Options', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 'one',
        'priority'    => 10,
        'choices'     => array(
            'one'   => esc_attr__( 'With Meta', 'mayosis-core' ),
            'two' => esc_attr__( 'Without Meta', 'mayosis-core' ),
        ),
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
    
    'type'        => 'color',
        'settings'     => 'product_grid_bg_color',
        'label'       => __( 'Product Grid Background', 'mayosis-core' ),
        'description' => __( 'Set Grid Background', 'mayosis-core' ),
        'section'     => 'product_options',
        'priority'    => 10,
        'default'     => 'rgba(255,255,255,0)',
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
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'product_grid_txt_color',
        'label'       => __( 'Product Grid Text', 'mayosis-core' ),
        'description' => __( 'Set Bottom text color', 'mayosis-core' ),
        'section'     => 'product_options',
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

        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'product_grid_price_color',
        'label'       => __( 'Product Price Color', 'mayosis-core' ),
        'description' => __( 'Set Price Color', 'mayosis-core' ),
        'section'     => 'product_options',
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

        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),
            

        ),
        
        
              'output' => array(
	array(
		'element'  => '.promo_price, .promo_price span',
		'property' => 'color',
	),

),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'padding_type_grid',
        'label'       => __( 'Grid Padding On', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 'meta',
        'priority'    => 10,
        'choices'     => array(
            'full'   => esc_attr__( 'Full Box', 'mayosis-core' ),
            'meta' => esc_attr__( 'Meta', 'mayosis-core' ),
        ),

        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'dimensions',
        'settings'    => 'prod_grid_padding',
        'label'       => esc_attr__( 'Grid Padding', 'mayosis-core' ),
        'description' => esc_attr__( 'Add padding on product grid', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => array(
            'padding-top'    => '0px',
            'padding-bottom' => '0px',
            'padding-left'   => '0px',
            'padding-right'  => '0px',
        ),

        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
    
) );



Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'select',
        'settings'    => 'product_masonry_column',
        'label'       => __( 'Product Masonry Column', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 3,
        'priority'    => 10,
        'choices'     => array(
            '2'   => esc_attr__( 'Two Column', 'mayosis-core' ),
            '3' => esc_attr__( 'Three Column', 'mayosis-core' ),
            '4' => esc_attr__( 'Four Column', 'mayosis-core' ),
            '5' => esc_attr__( 'Five Column', 'mayosis-core' ),
        ),
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'two',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    
    'type'        => 'color',
        'settings'     => 'list_product_bg',
        'label'       => __( 'Product List Background', 'mayosis-core' ),
        'description' => __( 'Set List Background', 'mayosis-core' ),
        'section'     => 'product_options',
        'priority'    => 10,
        'default'     => '#edf4f4',
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
		'element'  => '.mayosis_list_product',
		'property' => 'background',
	),

),

        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'four',
            ),

        ),
) );


Mayosis_Option::add_field( 'mayo_config', array(
    
    'type'        => 'color',
        'settings'     => 'list_product_text',
        'label'       => __( 'Product List Text Color', 'mayosis-core' ),
        'description' => __( 'Set List Text', 'mayosis-core' ),
        'section'     => 'product_options',
        'priority'    => 10,
        'default'     => '#28375a',
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
		'element'  => '.mayosis_list_product, .mayosis_list_product a,.mayosis_list_product .promo_price',
		'property' => 'color',
	),

),

));

Mayosis_Option::add_field( 'mayo_config', array(
    
    'type'        => 'color',
        'settings'     => 'list_purchase_bg',
        'label'       => __( 'List Purchase Button Background Color', 'mayosis-core' ),
        'description' => __( 'Set Purchase Button Background Color', 'mayosis-core' ),
        'section'     => 'product_options',
        'priority'    => 10,
        'default'     => '#5a00f0',
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
		'element'  => '.list_button_details .edd-add-to-cart, .list_button_details .edd-fd-button, .list_button_details .edd-submit, .list_button_details .edd-submit.button.blue, .list_button_details .edd_go_to_checkout.button, .list_button_details .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js',
		'property' => 'background',
	),
		array(
		'element'  => '.list_button_details .edd-add-to-cart, .list_button_details .edd-fd-button, .list_button_details .edd-submit, .list_button_details .edd-submit.button.blue, .list_button_details .edd_go_to_checkout.button, .list_button_details .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js',
		'property' => 'border-color',
	),

),

        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'four',
            ),

        ),
) );


Mayosis_Option::add_field( 'mayo_config', array(
    
    'type'        => 'color',
        'settings'     => 'list_purchase_text',
        'label'       => __( 'List Purchase Button Text Color', 'mayosis-core' ),
        'description' => __( 'Set Purchase Button Text Color', 'mayosis-core' ),
        'section'     => 'product_options',
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
        
        'output' => array(
	array(
		'element'  => '.list_button_details .edd-add-to-cart, .list_button_details .edd-fd-button, .list_button_details .edd-submit, .list_button_details .edd-submit.button.blue, .list_button_details .edd_go_to_checkout.button, .list_button_details .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js',
		'property' => 'color',
	),

),

        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'four',
            ),

        ),
) );


Mayosis_Option::add_field( 'mayo_config', array(
    
    'type'        => 'color',
        'settings'     => 'list_preview_border',
        'label'       => __( 'List Preview Border  Color', 'mayosis-core' ),
        'description' => __( 'Set Preview Border Color', 'mayosis-core' ),
        'section'     => 'product_options',
        'priority'    => 10,
        'default'     => 'rgb(30 60 120 / 0.5)',
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
		'element'  => '.list_button_details a',
		'property' => 'border-color',
	),

),

        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'four',
            ),

        ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    
    'type'        => 'color',
        'settings'     => 'list_preview_text',
        'label'       => __( 'List Preview Text Color', 'mayosis-core' ),
        'description' => __( 'Set Preview Text Color', 'mayosis-core' ),
        'section'     => 'product_options',
        'priority'    => 10,
        'default'     => 'rgb(30 60 120 / 0.5)',
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
		'element'  => '.list_button_details a',
		'property' => 'color',
	),

),

        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'four',
            ),

        ),
) );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'list_padding_main',
	'label'       => esc_html__( 'List Item Padding', 'mayosis-core' ),
	'description' => esc_html__( 'Add padding for list item product', 'mayosis-core' ),
	'section'     => 'product_options',
	'default'     => [
		'padding-top'    => '15px',
		'padding-bottom' => '15px',
		'padding-left'   => '15px',
		'padding-right'  => '15px',
	],
	
	    'output' => array(
	array(
		'element'  => '.mayosis_list_product',
		
	),

),

 'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'four',
            ),

        ),
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'list_image_radius',
	'label'       => esc_html__( 'List Featured Image Radius', 'mayosis-core' ),
	'description' => esc_html__( 'Add radius for featrued image', 'mayosis-core' ),
	'section'     => 'product_options',
	'default'     => [
		'border-top-left-radius'    => '3px',
		'border-top-right-radius' => '3px',
		'border-bottom-left-radius'   => '3px',
		'border-bottom-right-radius'  => '3px',
	],
	
	    'output' => array(
	array(
		'element'  => '.mayosis_list_product .list_product_thumbnail img',
		
	),

),

 'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'four',
            ),

        ),
] );


Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'select',
        'settings'    => 'product_masonry_title_hover',
        'label'       => __( 'Product Masonry Title Hover', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 1,
        'priority'    => 10,
        'choices'     => array(
            '1'   => esc_attr__( 'Show', 'mayosis-core' ),
            '2' => esc_attr__( 'Hide', 'mayosis-core' ),
            
        ),
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'two',
            ),

        ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'select',
        'settings'    => 'product_masonry_hover_style',
        'label'       => __( 'Product Masonry Hover Style', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 'one',
        'priority'    => 10,
        'choices'     => array(
            'one'   => esc_attr__( 'Style One', 'mayosis-core' ),
            'two' => esc_attr__( 'Style Two', 'mayosis-core' ),
            'three' => esc_attr__( 'Style Three', 'mayosis-core' ),
            
        ),
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'two',
            ),

        ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'select',
        'settings'    => 'product_masonry_meta_state',
        'label'       => __( 'Product Masonry Meta Box', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 'disable',
        'priority'    => 10,
        'choices'     => array(
            'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
            'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
           
            
        ),
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'two',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'select',
        'settings'    => 'product_masonry_image_hover_style',
        'label'       => __( 'Product Masonry Image Hover Effect', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 'disable',
        'priority'    => 10,
        'choices'     => array(
            'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
            'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
           
            
        ),
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'two',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'dimensions',
        'settings'    => 'masonry-image-radius',
        'label'       => esc_attr__( 'Border Radius', 'mayosis-core' ),
        'description' => esc_attr__( 'Add radius on masonry grid', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => array(
            'border-top-left-radius'    => '0px',
            'border-top-right-radius' => '0px',
            'border-bottom-left-radius'   => '0px',
            'border-bottom-right-radius'  => '0px',
        ),

        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'two',
            ),

        ),
        
        'output' => array(
	array(
		'element'  => '.product-masonry-item .product-masonry-item-content,
		.product-masonry-item .product-masonry-item-content img',
	)

),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'text',
        'settings'    => 'product_justified_gap',
        'label'       => __( 'Product Justified Image Gap', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => '5',
        'priority'    => 10,
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'three',
            ),

        ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'select',
        'settings'    => 'product_justified_title_hover',
        'label'       => __( 'Product Justified Title Hover', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 1,
        'priority'    => 10,
        'choices'     => array(
            '1'   => esc_attr__( 'Show', 'mayosis-core' ),
            '2' => esc_attr__( 'Hide', 'mayosis-core' ),
            
        ),
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'three',
            ),

        ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'select',
        'settings'    => 'product_justified_hover_style',
        'label'       => __( 'Product Justified Hover Style', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 'one',
        'priority'    => 10,
        'choices'     => array(
            'one'   => esc_attr__( 'Style One', 'mayosis-core' ),
            'two' => esc_attr__( 'Style Two', 'mayosis-core' ),
            'three' => esc_attr__( 'Style Three', 'mayosis-core' ),
            
        ),
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'three',
            ),

        ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'slider',
        'settings'    => 'grid_border_radius',
        'label'       => esc_attr__( 'Change Grid Border Radius', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 3,
        'choices'     => array(
            'min'  => 0,
            'max'  => 50,
            'step' => 1,
        ),
        
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
        'settings'    => 'product_box_shadow',
        'label'       => __( 'Product Box Shadow', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 'none',
        'priority'    => 10,
        'choices'     => array(
            'none'   => esc_attr__( 'None', 'mayosis-core' ),
            'box' => esc_attr__( 'Shadow in Whole Box', 'mayosis-core' ),
            'hover' => esc_attr__( 'Shadow on Hover', 'mayosis-core' ),
        ),
        
         'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'product_shadow_color',
        'label'       => __( 'Box Shadow Color', 'mayosis-core' ),
        'description' => __( 'Set Box Shadow Color', 'mayosis-core' ),
        'section'     => 'product_options',
        'priority'    => 10,
        'default'     => 'rgba(40, 55,90, .15)',
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
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
        'settings'    => 'product_grid_image_size',
        'label'       => __( 'Product Grid Image size', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 'full',
        'priority'    => 10,
        'choices'     => array(
            'full'   => esc_attr__( 'Full', 'mayosis-core' ),
            'custom' => esc_attr__( 'Custom', 'mayosis-core' ),
        ),
        
         'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
        'settings'    => 'product_grid_image_width',
        'label'       => __( 'Custom Width', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => '525',
        'priority'    => 10,
         'required'    => array(
            array(
                'setting'  => 'product_grid_image_size',
                'operator' => '==',
                'value'    => 'custom',
            ),

        ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
        'settings'    => 'product_grid_image_height',
        'label'       => __( 'Custom Height', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => '256',
        'priority'    => 10,
         'required'    => array(
            array(
                'setting'  => 'product_grid_image_size',
                'operator' => '==',
                'value'    => 'custom',
            ),

        ),
) );


Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'radio-buttonset',
        'settings'    => 'product_pagination_type',
        'label'       => __( 'Product Pagination Type', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 'one',
        'priority'    => 10,
        'choices'     => array(
            'one'   => esc_attr__( 'Normal Pagination', 'mayosis-core' ),
            'two' => esc_attr__( 'Ajax Load More', 'mayosis-core' ),
        ),
        'active_callback' => [
            	[
            		'setting'  => 'product_grid_system',
            		'operator' => '!=',
            		'value'    => 'three',
            	],
            	
],
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
        'settings'    => 'load_more_text',
        'label'       => __( 'Load More Button Text', 'mayosis-core' ),
        'section'     => 'product_options',
        'default'     => 'More Products',
        'priority'    => 10,
        'active_callback' => [
            	[
            		'setting'  => 'product_grid_system',
            		'operator' => '!=',
            		'value'    => 'three',
            	],
            	
],
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'load_m_bg_m',
        'label'       => __( 'Load More Background', 'mayosis-core' ),
        'section'     => 'product_options',
        'priority'    => 10,
        'default'     => '#5a00f0',
     
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
        'active_callback' => [
            	[
            		'setting'  => 'product_grid_system',
            		'operator' => '!=',
            		'value'    => 'three',
            	],
            	
            	[
        			'setting'  => 'product_pagination_type',
        			'operator' => '==',
        			'value'    => 'two',
		        ],
            	
],
        'transport' =>$transport,
        'output' => array(
            	array(
            		'element'  => '.mayo-product-loader-archive .inf-load-more',
            		'property' => 'background-color',
            	)
    	),
));

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'load_m_border_m',
        'label'       => __( 'Load More Border', 'mayosis-core' ),
        'section'     => 'product_options',
        'priority'    => 10,
        'default'     => '#5a00f0',
     
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
        'active_callback' => [
            	[
            		'setting'  => 'product_grid_system',
            		'operator' => '!=',
            		'value'    => 'three',
            	],
            		[
        			'setting'  => 'product_pagination_type',
        			'operator' => '==',
        			'value'    => 'two',
		        ],
            	
],
        'transport' =>$transport,
        'output' => array(
            	array(
            		'element'  => '.mayo-product-loader-archive .inf-load-more',
            		'property' => 'border-color',
            	)
    	),
));

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'load_m_text_m',
        'label'       => __( 'Load More Text', 'mayosis-core' ),
        'section'     => 'product_options',
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
        'active_callback' => [
            	[
            		'setting'  => 'product_grid_system',
            		'operator' => '!=',
            		'value'    => 'three',
            	],
            		[
        			'setting'  => 'product_pagination_type',
        			'operator' => '==',
        			'value'    => 'two',
		        ],
            	
],
        'transport' =>$transport,
        'output' => array(
            	array(
            		'element'  => '.mayo-product-loader-archive .inf-load-more',
            		'property' => 'color',
            	)
    	),
));

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'load_hvr_bg_m',
        'label'       => __( 'Load More Hover Background', 'mayosis-core' ),
        'section'     => 'product_options',
        'priority'    => 10,
        'default'     => '#5a00f0',
     
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
        'active_callback' => [
            	[
            		'setting'  => 'product_grid_system',
            		'operator' => '!=',
            		'value'    => 'three',
            	],
            	
            	[
        			'setting'  => 'product_pagination_type',
        			'operator' => '==',
        			'value'    => 'two',
		        ],
            	
],
        'transport' =>$transport,
        'output' => array(
            	array(
            		'element'  => '.mayo-product-loader-archive .inf-load-more:hover',
            		'property' => 'background-color',
            	)
    	),
));

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'load_hvr_border_m',
        'label'       => __( 'Load More Hover Border', 'mayosis-core' ),
        'section'     => 'product_options',
        'priority'    => 10,
        'default'     => '#5a00f0',
     
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
        'active_callback' => [
            	[
            		'setting'  => 'product_grid_system',
            		'operator' => '!=',
            		'value'    => 'three',
            	],
            	
            	[
        			'setting'  => 'product_pagination_type',
        			'operator' => '==',
        			'value'    => 'two',
		        ],
            	
],
        'transport' =>$transport,
        'output' => array(
            	array(
            		'element'  => '.mayo-product-loader-archive .inf-load-more:hover',
            		'property' => 'border-color',
            	)
    	),
));


Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'load_hvr_text_m',
        'label'       => __( 'Load More Hover Text', 'mayosis-core' ),
        'section'     => 'product_options',
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
        'active_callback' => [
            	[
            		'setting'  => 'product_grid_system',
            		'operator' => '!=',
            		'value'    => 'three',
            	],
            	
            	[
        			'setting'  => 'product_pagination_type',
        			'operator' => '==',
        			'value'    => 'two',
		        ],
            	
],
        'transport' =>$transport,
        'output' => array(
            	array(
            		'element'  => '.mayo-product-loader-archive .inf-load-more:hover',
            		'property' => 'color',
            	)
    	),
));
Mayosis_Option::add_field( 'mayo_config', array(
        'type'     => 'text',
        'settings' => 'recent_ribbon_text',
        'label'    => __( 'Recent Product Ribbon Text', 'mayosis-core' ),
        'section'  => 'mayosis_grid_ribbon',
        'default'  => esc_attr__( 'New', 'mayosis-core' ),
        'priority' => 10,
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'     => 'text',
        'settings' => 'recent_ribbon_time',
        'label'    => __( 'Recent Product Ribbon Time (in days)', 'mayosis-core' ),
        'section'  => 'mayosis_grid_ribbon',
        'default'  => esc_attr__( '30', 'mayosis-core' ),
        'priority' => 10,
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'     => 'text',
        'settings' => 'featured_ribbon_text',
        'label'    => __( 'Featured Product Ribbon Text', 'mayosis-core' ),
        'section'  => 'mayosis_grid_ribbon',
        'default'  => esc_attr__( 'FEATURED', 'mayosis-core' ),
        'priority' => 10,
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'     => 'text',
        'settings' => 'featured_ribbon_time',
        'label'    => __( 'Featured Product Ribbon Time (in days)', 'mayosis-core' ),
        'section'  => 'mayosis_grid_ribbon',
        'default'  => esc_attr__( '30', 'mayosis-core' ),
        'priority' => 10,
        'required'    => array(
            array(
                'setting'  => 'product_grid_system',
                'operator' => '==',
                'value'    => 'one',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'product_meta_title_type',
        'label'       => esc_attr__( 'Product Title Typography', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => '700',
            'font-size'      => '1rem',
            'line-height'    => '1.25',
            'text-transform' => 'none',

        ),
        'priority'    => 10,


        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '.product-meta .product-title,.overlay-style .product-title,.product-meta .product-title a',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'product_meta_med_type',
        'label'       => esc_attr__( 'Product Meta Typography', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => '400',
            'font-size'      => '13px',
            'line-height'    => '1.25',
            'text-transform' => 'none',

        ),
        'priority'    => 10,


        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '.msv_p_meta_main a, .msv_p_meta_main span,.msv_p_meta_main',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'product_meta_prcied_type',
        'label'       => esc_attr__( 'Product Price Typography', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => '400',
            'font-size'      => '16px',
            'line-height'    => '1.25',
            'text-transform' => 'none',

        ),
        'priority'    => 10,


        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '.count-download .promo_price span',
            ),
        ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'select',
        'settings'    => 'product_thmub_hover_style',
        'label'       => __( 'Thumb Hover Style', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => 'style1',
        'priority'    => 10,
        'choices'     => array(
            'style1'   => esc_attr__( 'Style One', 'mayosis-core' ),
            'style2' => esc_attr__( 'Style Two', 'mayosis-core' ),
            'style3' => esc_attr__( 'Style Three', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'select',
        'settings'    => 'hover_two_style_type',
        'label'       => __( 'Style Two Hover Elements', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => 'plus',
        'priority'    => 10,
        'choices'     => array(
            'none'   => esc_attr__( 'None', 'mayosis-core' ),
            'plus' => esc_attr__( 'Plus Sign', 'mayosis-core' ),
            'custom' => esc_attr__( 'Custom Icon', 'mayosis-core' ),
            'audio' => esc_attr__( 'Audio & Cart Button', 'mayosis-core' ),
        ),
        'required'    => array(
            array(
                'setting'  => 'product_thmub_hover_style',
                'operator' => '==',
                'value'    => 'style2',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
        'settings'    => 'custom_icon_on_hvr_2',
        'label'       => __( 'Custom icon For Hover (Icon class)', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => 'fas fa-cart',
        'priority'    => 10,
        'active_callback' => [
            	[
            		'setting'  => 'hover_two_style_type',
            		'operator' => '==',
            		'value'    => 'custom',
            	],
            	
],
) );

Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'select',
        'settings'    => 'product_hover_top',
        'label'       => __( 'Hover Top Elements', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => 'cart',
        'priority'    => 10,
        'choices'     => array(
            'none'   => esc_attr__( 'None', 'mayosis-core' ),
            'cart' => esc_attr__( 'Add to Cart', 'mayosis-core' ),
            'share' => esc_attr__( 'Share', 'mayosis-core' ),
            'sales' => esc_attr__( 'Sales and Download', 'mayosis-core' ),
        ),
        'required'    => array(
            array(
                'setting'  => 'product_thmub_hover_style',
                'operator' => '==',
                'value'    => 'style1',
            ),

        ),
    
) );



Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'select',
        'settings'    => 'product_hover_bottom',
        'label'       => __( 'Hover Bottom Elements', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => 'share',
        'priority'    => 10,
        'choices'     => array(
            'none'   => esc_attr__( 'None', 'mayosis-core' ),
            'cart' => esc_attr__( 'Add to Cart', 'mayosis-core' ),
            'share' => esc_attr__( 'Share', 'mayosis-core' ),
            'sales' => esc_attr__( 'Sales and Download', 'mayosis-core' ),
        ),
        
        'required'    => array(
            array(
                'setting'  => 'product_thmub_hover_style',
                'operator' => '==',
                'value'    => 'style1',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'select',
        'settings'    => 'product_meta_options',
        'label'       => __( 'Meta Options', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => 'vendorcat',
        'priority'    => 10,
        'choices'     => array(
            'none'   => esc_attr__( 'None', 'mayosis-core' ),
            'vendor' => esc_attr__( 'Vendor', 'mayosis-core' ),
            'category' => esc_attr__( 'Category', 'mayosis-core' ),
            'vendorcat' => esc_attr__( 'Vendor and Category', 'mayosis-core' ),
            'sales' => esc_attr__( 'Sales and Download', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'select',
        'settings'    => 'product_category_type_x',
        'label'       => __( 'Category Type', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => 'default',
        'priority'    => 10,
        'choices'     => array(
            'default'   => esc_attr__( 'Default', 'mayosis-core' ),
            'parent' => esc_attr__( 'Parent', 'mayosis-core' ),
           
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
        'settings'    => 'product_pricing_options',
        'label'       => __( 'Pricing Options', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => 'price',
        'priority'    => 10,
        'choices'     => array(
            'none'   => esc_attr__( 'None', 'mayosis-core' ),
            'price' => esc_attr__( 'Side Price', 'mayosis-core' ),
            'bprice' => esc_attr__( 'Bottom Price', 'mayosis-core' ),
        ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'radio-buttonset',
        'settings'    => 'product_free_options',
        'label'       => __( 'Free Pricing Options', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => 'custom',
        'priority'    => 10,
        'choices'     => array(
            'none'   => esc_attr__( '$0.00', 'mayosis-core' ),
            'custom' => esc_attr__( 'Custom Text', 'mayosis-core' ),
        ),
        'required'    => array(
            array(
                'setting'  => 'product_pricing_options',
                'operator' => '!=',
                'value'    => 'none',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'     => 'text',
        'settings' => 'free_text',
        'label'    => __( 'Custom Text', 'mayosis-core' ),
        'section'  => 'grid_meta',
        'default'  => esc_attr__( 'FREE', 'mayosis-core' ),
        'priority' => 10,
        'required'    => array(
            array(
                'setting'  => 'product_free_options',
                'operator' => '==',
                'value'    => 'custom',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'radio-buttonset',
        'settings'    => 'variable_pricing_options',
        'label'       => __( 'Variable Pricing Options', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => 'default',
        'priority'    => 10,
        'choices'     => array(
            'default'   => esc_attr__( 'Default', 'mayosis-core' ),
            'popup' => esc_attr__( 'Popup', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'radio-buttonset',
        'settings'    => 'msv_ebook_meta',
        'label'       => __( 'eBook Meta', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => 'disable',
        'priority'    => 10,
        'choices'     => array(
            'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
            'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'radio-buttonset',
        'settings'    => 'msv_pd_price_bg',
        'label'       => __( 'Product Price Background', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => 'disable',
        'priority'    => 10,
        'choices'     => array(
            'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
            'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'msv_pd_bg_color',
        'label'       => __( 'Product Price Background Color', 'mayosis-core' ),
        'description' => __( 'Set Price BG color', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'priority'    => 10,
        'default'     => '#28375a',
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
                'setting'  => 'msv_pd_price_bg',
                'operator' => '==',
                'value'    => 'enable',
            ),

        ),
        
          'output'    => array(
            array(
                'element' => '.msv_pc_bg_enable.count-download .promo_price span',
                'property' => 'background-color',
            ),
        ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'msv_pd_border_color',
        'label'       => __( 'Product Price Border Color', 'mayosis-core' ),
        'description' => __( 'Set Price Border color', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'priority'    => 10,
        'default'     => '#fff',
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
                'setting'  => 'msv_pd_price_bg',
                'operator' => '==',
                'value'    => 'enable',
            ),

        ),
        
          'output'    => array(
            array(
                'element' => '.msv_pc_bg_enable.count-download .promo_price span',
                'property' => 'border-color',
                'suffix'   => ' !important'
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'msv_pd_txt_color',
        'label'       => __( 'Product Price Text Color', 'mayosis-core' ),
        'description' => __( 'Set Price Text color', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'priority'    => 10,
        'default'     => '#fff',
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
                'setting'  => 'msv_pd_price_bg',
                'operator' => '==',
                'value'    => 'enable',
            ),

        ),
        
          'output'    => array(
            array(
                'element' => '.msv_pc_bg_enable.count-download .promo_price span',
                'property' => 'color',
                'suffix'   => ' !important'
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'dimensions',
        'settings'    => 'price_label_x_padding',
        'label'       => esc_attr__( 'Price Label Padding', 'mayosis-core' ),
        'description' => esc_attr__( 'Add padding on price Label', 'mayosis-core' ),
        'section'     => 'grid_meta',
        'default'     => array(
            'padding-top'    => '8px',
            'padding-bottom' => '8px',
            'padding-left'   => '15px',
            'padding-right'  => '15px',
        ),

        'required'    => array(
            array(
                'setting'  => 'msv_pd_price_bg',
                'operator' => '==',
                'value'    => 'enable',
            ),

        ),
        
       	    'output' => array(
	array(
		'element'  => '.msv_pc_bg_enable.count-download .promo_price span',
		
	),

),
    
) );
//Start product video
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'title_play_button',
        'label'       => __( 'Title Play Button', 'mayosis-core' ),
        'description'       => __( '', 'mayosis-core' ),
        'section'     => 'product_video',
        'default'     => 'show',
        'priority'    => 10,
        'choices'     => array(
            'show'   => esc_attr__( 'Show', 'mayosis-core' ),
            'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'thumbnail_video_play',
        'label'       => __( 'Thumbnail Video', 'mayosis-core' ),
        'description'       => __( '', 'mayosis-core' ),
        'section'     => 'product_video',
        'default'     => 'show',
        'priority'    => 10,
        'choices'     => array(
            'show'   => esc_attr__( 'Show', 'mayosis-core' ),
            'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'thumbnail_video_poster',
        'label'       => __( 'Thumbnail Video Poster', 'mayosis-core' ),
        'description'       => __( '', 'mayosis-core' ),
        'section'     => 'product_video',
        'default'     => 'show',
        'priority'    => 10,
        'choices'     => array(
            'show'   => esc_attr__( 'Show', 'mayosis-core' ),
            'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
        ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'thumb_video_control',
        'label'       => __( 'Thumbnail Video Contol', 'mayosis-core' ),
        'description'       => __( '', 'mayosis-core' ),
        'section'     => 'product_video',
        'default'     => 'wholecontrol',
        'priority'    => 10,
        'choices'     => array(
            'wholecontrol'   => esc_attr__( 'Full', 'mayosis-core' ),
            'minimal' => esc_attr__( 'Minimal (Cart)', 'mayosis-core' ),
        ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'thumb_cart_button',
        'label'       => __( 'Thumbnail Cart Button', 'mayosis-core' ),
        'description'       => __( '', 'mayosis-core' ),
        'section'     => 'product_video',
        'default'     => 'hide',
        'priority'    => 10,
        'choices'     => array(
            'show'   => esc_attr__( 'Show', 'mayosis-core' ),
            'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
        ),
    
) );

//End product video

//Start product audio

//End product audio
Mayosis_Option::add_field( 'mayo_config', array(
        'type'     => 'text',
        'settings' => 'live_preview_text',
        'label'    => __( 'Live Preview Text', 'mayosis-core' ),
        'section'  => 'product_more',
        'default'  => esc_attr__( 'Live Preview', 'mayosis-core' ),
        'priority' => 10,
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'select',
        'settings'    => 'product_bottom_buttons',
        'label'       => __( 'Product Bottom Buttons', 'mayosis-core' ),
        'section'     => 'product_more',
        'default'     => 'show',
        'priority'    => 10,
        'choices'     => array(
            'show'   => esc_attr__( 'Show', 'mayosis-core' ),
            'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
        ),
    
) );



Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'select',
        'settings'    => 'product_bottom_extratext',
        'label'       => __( 'Product Bottom Buttons Text & Count', 'mayosis-core' ),
        'section'     => 'product_more',
        'default'     => 'show',
        'priority'    => 10,
        'choices'     => array(
            'show'   => esc_attr__( 'Show', 'mayosis-core' ),
            'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'select',
        'settings'    => 'product_bottom_social_share',
        'label'       => __( 'Product Bottom Social Share', 'mayosis-core' ),
        'section'     => 'product_more',
        'default'     => 'show',
        'priority'    => 10,
        'choices'     => array(
            'show'   => esc_attr__( 'Show', 'mayosis-core' ),
            'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'select',
        'settings'    => 'product_bottom_tags',
        'label'       => __( 'Product Tags', 'mayosis-core' ),
        'section'     => 'product_more',
        'default'     => 'hide',
        'priority'    => 10,
        'choices'     => array(
            'show'   => esc_attr__( 'Show', 'mayosis-core' ),
            'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
        ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'product_gallery_options_alt',
        'label'       => __( 'Product Gallery System', 'mayosis-core' ),
        'description'       => __( 'On Gallery alternative mode use this hook mayosis_gallery_alt_hook for FES', 'mayosis-core' ),
        'section'     => 'product_more',
        'default'     => 'dflt',
        'priority'    => 10,
        'choices'     => array(
            'dflt'   => esc_attr__( 'Default Gallery', 'mayosis-core' ),
            'alt' => esc_attr__( 'Alternate Gallery', 'mayosis-core' ),
           
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'product_gallery_type',
        'label'       => __( 'Product Gallery Layout Type', 'mayosis-core' ),
        'section'     => 'product_more',
        'default'     => 'one',
        'priority'    => 10,
        'choices'     => array(
            'one'   => esc_attr__( 'Bottom Thumb', 'mayosis-core' ),
            'two' => esc_attr__( 'Side Thumb', 'mayosis-core' ),
            'three' => esc_attr__( 'Without Thumb', 'mayosis-core' ),
            'four' => esc_attr__( 'Carousel', 'mayosis-core' ),
            'five' => esc_attr__( 'List Image', 'mayosis-core' ),
            'six' => esc_attr__( 'Two Column', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
        'settings'    => 'site_product_type',
        'label'       => __( 'Easy Digital Download Product Type', 'mayosis-core' ),
        'section'     => 'product_more',
        'default'     => 'default',
        'priority'    => 10,
        'choices'     => array(
            'default'   => esc_attr__( 'Default', 'mayosis-core' ),
            'products' => esc_attr__( 'Products', 'mayosis-core' ),
            'items' => esc_attr__( 'Items', 'mayosis-core' ),
            'music' => esc_attr__( 'Music', 'mayosis-core' ),
            'video' => esc_attr__( 'Video', 'mayosis-core' ),
            'photo' => esc_attr__( 'Photo', 'mayosis-core' ),
            'mockup' => esc_attr__( 'Mockup', 'mayosis-core' ),
            'background' => esc_attr__( 'Background', 'mayosis-core' ),
            'custom' => esc_attr__( 'Custom', 'mayosis-core' ),
        ),
) );
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'text',
        'settings'    => 'custom_p_label_msd',
        'label'       => __( 'Custom Product label', 'mayosis-core' ),
        'section'     => 'product_more',
        'default'     => 'Template',
        'priority'    => 10,
         'required'    => array(
            array(
                'setting'  => 'site_product_type',
                'operator' => '==',
                'value'    => 'custom',
            ),

        ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'text',
        'settings'    => 'custom_p_label_msd_plural',
        'label'       => __( 'Custom Product label Plural', 'mayosis-core' ),
        'section'     => 'product_more',
        'default'     => 'Templates',
        'priority'    => 10,
          'required'    => array(
            array(
                'setting'  => 'site_product_type',
                'operator' => '==',
                'value'    => 'custom',
            ),

        ),
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'sortable',
        'settings'    => 'product_information_widget_manager',
        'label'       => __( 'Product Information Widget Layout', 'mayosis-core' ),
        'section'     => 'product_information_widget',
        'default'     => array(
            'price',
            'released',
            'updated',
            'fileincluded',
            'filesize',
            'compatible',
            'version',
        ),
        'choices'     => array(
            'price' => esc_attr__( 'Price', 'mayosis-core' ),
            'released' => esc_attr__( 'Release Date', 'mayosis-core' ),
            'updated' => esc_attr__( 'Last Update', 'mayosis-core' ),
            'version' => esc_attr__( 'Version', 'mayosis-core' ),
            'fileincluded' => esc_attr__( 'File Included', 'mayosis-core' ),
            'filesize' => esc_attr__( 'File Size', 'mayosis-core' ),
            'compatible' => esc_attr__( 'Compatible', 'mayosis-core' ),
            'documentation' => esc_attr__( 'Documentation', 'mayosis-core' ),
            'sales' => esc_attr__( 'Sales', 'mayosis-core' ),
            'category' => esc_attr__( 'Category', 'mayosis-core' ),

        ),
) );
Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'editor',
	'settings'    => 'text_on_after_login_subscribtion',
	'label'       => esc_html__( 'Add text for active subscription', 'mayosis-core' ),
	'default' => esc_html__( 'Download & use without credit. You can generate a license from your dashboard.', 'mayosis-core' ),
	'section'     => 'product_subscription_widget',
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'editor',
	'settings'    => 'text_on_loggout_user',
	'label'       => esc_html__( 'Add text for logged out user', 'mayosis-core' ),
	'default' => esc_html__( 'Subscribe to download this product. Already subscribed? Please login!', 'mayosis-core' ),
	'section'     => 'product_subscription_widget',

] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'editor',
	'settings'    => 'text_on_loggin_user',
	'label'       => esc_html__( 'Add text for logged in user', 'mayosis-core' ),
	'default' => esc_html__( 'Subscribe to download this product.Check the subscription plan.', 'mayosis-core' ),
	'section'     => 'product_subscription_widget',
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'editor',
	'settings'    => 'text_on_free_download',
	'label'       => esc_html__( 'Add text for free download', 'mayosis-core' ),
	'default' => esc_html__( 'A credit link is required for free downloads. Get a subscription & use without credit!', 'mayosis-core' ),
	'section'     => 'product_subscription_widget',
] );
Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'text',
        'settings'    => 'license_url_media',
        'label'       => __( 'License Page URL', 'mayosis-core' ),
        'section'     => 'product_subscription_widget',
        'default'     => '',
        'priority'    => 10,
       
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'text',
        'settings'    => 'page_subscription_url',
        'label'       => __( 'Purchase Button URL Loggedout user', 'mayosis-core' ),
        'section'     => 'product_subscription_widget',
        'default'     => '',
        'transport' =>$transport,
        
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'text',
        'settings'    => 'media_subscription_text',
        'label'       => __( 'Subscription Information Details', 'mayosis-core' ),
        'section'     => 'product_subscription_package',
        'default'     => 'Download Unlimited Stock Videos at $99/month',
        'priority'    => 10,
    
    
) );
Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'repeater',
	'label'       => esc_html__( 'Subscription Box Content', 'mayosis-core' ),
	'section'     => 'product_subscription_package',
	'priority'    => 10,
	'row_label' => [
		'type'  => 'field',
		'value' => esc_html__( 'Your Custom Value', 'mayosis-core' ),
		'field' => 'subscription_option',
	],
	'button_label' => esc_html__('Add New Option ', 'mayosis-core' ),
	'settings'     => 'photoz_subscription_options',
	'default'      => [
		[
			'subscription_option' => esc_html__( 'Download Unlimited Videos', 'mayosis-core' ),
			
		],
		
	],
	'fields' => [
		'subscription_option' => [
			'type'        => 'text',
			'label'       => esc_html__( 'Option', 'mayosis-core' ),
			'default'     => '',
		],
		
	],

] );
Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'text',
        'settings'    => 'media_subscription_btn_text',
        'label'       => __( 'Subscription Button Title', 'mayosis-core' ),
        'section'     => 'product_subscription_package',
        'default'     => 'Subscribe',
        'priority'    => 10,
        
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'text',
        'settings'    => 'media_subscription_url',
        'label'       => __( 'Subscription Button URL', 'mayosis-core' ),
        'section'     => 'product_subscription_package',
        'default'     => '',
        'transport' =>$transport,
        
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'text',
        'settings'    => 'envato_api_cred',
        'label'       => __( 'Envato API', 'mayosis-core' ),
        'section'     => 'product_envato_api_section',
        'description' => 'generate api from https://build.envato.com/my-apps',
        'default'     => '',
        'transport' =>$transport,
        
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'text',
        'settings'    => 'envato_username_link',
        'label'       => __( 'Envato Username', 'mayosis-core' ),
        'section'     => 'product_envato_api_section',
        'description' => 'Type the envato username to get total sales',
        'default'     => '',
        'transport' =>$transport,


) );





Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'text',
        'settings'    => 'product_filtered_number_msv',
        'label'       => __( 'Envato Username', 'mayosis-core' ),
        'section'     => 'product_envato_api_section',
        'description' => 'Type the envato username to get total sales',
        'default'     => '',
        'transport' =>$transport,


) );


Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'radio-buttonset',
        'settings'    => 'filter_tax_number_ebl',
        'label'       => __( 'Filter Tax Limit (Elementor Widget)', 'mayosis-core' ),
        'section'     => 'product_filtered_section',
        'default'     => 'false',
        'priority'    => 10,
        'choices'     => array(
            'false'   => esc_attr__( 'No', 'mayosis-core' ),
            'true' => esc_attr__( 'Yes', 'mayosis-core' ),
            
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
      'type'        => 'text',
        'settings'    => 'number_of_tax',
        'label'       => __( 'Number of Taxonomy', 'mayosis-core' ),
        'section'     => 'product_filtered_section',
        
        'default'     => '6',
        'transport' =>$transport,
           'required'    => array(
            array(
                'setting'  => 'filter_tax_number_ebl',
                'operator' => '==',
                'value'    => 'true',
            ),

        ),


) );



Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'radio-buttonset',
        'settings'    => 'product_filtered_grid_system',
        'label'       => __( 'Product Grid System', 'mayosis-core' ),
        'section'     => 'product_filtered_section',
        'default'     => 'two',
        'priority'    => 10,
        'choices'     => array(
            
            'two' => esc_attr__( 'Masonary', 'mayosis-core' ),
            'three' => esc_attr__( 'Justified', 'mayosis-core' ),
           
        ),
    
) );
