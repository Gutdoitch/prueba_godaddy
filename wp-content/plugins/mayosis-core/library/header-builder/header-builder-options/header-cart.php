<?php

Mayosis_Option::add_section( 'header_cart', array(
	'title'       => __( 'Cart', 'mayosis-core' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'mayosis-core' ),
) );
Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
'settings'    => 'header_cart_type',
'label'       => __( 'Header Cart Type', 'mayosis-core' ),
'section'     => 'header_cart',
'default'     => 'dropdown',
'priority'    => 10,
'choices'     => array(
	'dropdown'   => esc_attr__( 'Dropdown', 'mayosis-core' ),
	'offcanvas' => esc_attr__( 'Off Canvas', 'mayosis-core' ),
),
));
   
Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'radio-image',
'settings'    => 'cart_icon_type',
'label'       => esc_html__( 'Cart Icon', 'mayosis-core' ),
'section'     => 'header_cart',
'Description' =>'There are available two type of cart icon. Choose your desired one',
'default'     => 'zi-cart',
'priority'    => 10,
'choices'     => array(
	'zi-cart'   => get_template_directory_uri() . '/images/cart-icon-1.png',
	'zi-cart-ii' => get_template_directory_uri() . '/images/cart-icon-2.png',
	'fa fa-shopping-cart' => get_template_directory_uri() . '/images/cart-icon-3.png',
	' isax icon-shopping-cart1' => get_template_directory_uri() . '/images/cart-icon-3.png',
),
    ));
    
Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'radio-image',
'settings'    => 'cart_style',
'label'       => esc_html__( 'Cart Style', 'mayosis-core' ),
'section'     => 'header_cart',
'Description' =>'There are available two type of cart design. Choose your desired one',
'default'     => 'one',
'priority'    => 10,
'choices'     => array(
	'one'   => get_template_directory_uri() . '/images/cart-style-1.png',
	'two' => get_template_directory_uri() . '/images/cart-style-2.png',
),
    ));
    
    
    
     Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'offcanvas_cart_bg',
        'label'       => __( 'Offcanvas Cart Background', 'mayosis-core' ),
        'description' => __( 'Change Offcanvas Cart BG Color', 'mayosis-core' ),
        'section'     => 'header_cart',
        'priority'    => 10,
        'default'     => '#26264d',
        'output' => array(
             array(
                	        'element' => '.mayosis-site-offcanvas-cart',
                	        'property' =>'background',
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
        
        'required'    => array(
    array(
        'setting'  => 'header_cart_type',
        'operator' => '==',
        'value'    => 'offcanvas',
            ),
        ),
    ));
    
        
     Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'offcanvas_cart_text',
        'label'       => __( 'Offcanvas Text Color', 'mayosis-core' ),
        'description' => __( 'Change Offcanvas Text Color', 'mayosis-core' ),
        'section'     => 'header_cart',
        'priority'    => 10,
        'default'     => '#ffffff',
        'output' => array(
             array(
                	        'element' => '.mayosis-site-offcanvas-cart .offcanvas-title,
                	        .mayosis-site-offcanvas-cart .text-reset,
                	        .emerce-min-cart-content h4,
                	        .offcanvas .emerce-min-cart-content h4,
                	        .offcanvas .min-cart-quantity .amount,
                	        .offcanvas .mini-cart-bottom-set p.total,
                	        .offcanvas .min-cart-quantity,
                	        .offcanvas span,
                	        .msv_offcanvas-body a,
                	        .msv_offcanvas-body span,
                	        .msv_offcanvas-body',
                	        'property' =>'color',
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
        
        'required'    => array(
    array(
        'setting'  => 'header_cart_type',
        'operator' => '==',
        'value'    => 'offcanvas',
            ),
        ),
    ));
    
      Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'offcanvas_cart_text_hvr',
        'label'       => __( 'Offcanvas Text Hover Color', 'mayosis-core' ),
        'description' => __( 'Change Offcanvas Text Color', 'mayosis-core' ),
        'section'     => 'header_cart',
        'priority'    => 10,
        'default'     => '#ffffff',
        'output' => array(
             array(
                	        'element' => '.msv_offcanvas-body a:hover,
                	        .msv_offcanvas-body span:hover,
                	        .msv_offcanvas-body:hover',
                	        'property' =>'color',
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
        
        'required'    => array(
    array(
        'setting'  => 'header_cart_type',
        'operator' => '==',
        'value'    => 'offcanvas',
            ),
        ),
    ));