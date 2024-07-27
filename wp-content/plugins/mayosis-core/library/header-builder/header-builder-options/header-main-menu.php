<?php

Mayosis_Option::add_section( 'header_main_menu', array(
	'title'       => __( 'Main Menu', 'mayosis-core' ),
	'panel'       => 'header',
) );


Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
	'settings'    => 'menu_position',
	'label'       => __( 'Menu Position', 'mayosis-core' ),
	'section'     => 'header_main_menu',
	'default'     => 'text-end',
	'priority'    => 10,
	'choices'     => array(
		'text-start'   => esc_attr__( 'Left', 'mayosis-core' ),
		'text-center' => esc_attr__( 'Center', 'mayosis-core' ),
		'text-end' => esc_attr__( 'Right', 'mayosis-core' ),
	),
	
));





 Mayosis_Option::add_field( 'mayo_config',  array(
  'type'        => 'color',
  'settings'     => 'main_nav_text',
  'label'       => __( 'Main Navigation Text Color', 'mayosis-core' ),
  'description' => __( 'Change navigation text Color', 'mayosis-core' ),
  'section'     => 'header_main_menu',
  'priority'    => 10,
  'default'     => '#28375a', 
  'output'      => array(
            array(
                'element'  => '#mayosis-menu > ul > li > a,.header-master .main-header ul li.cart-style-one a.cart-button,.search-dropdown-main a,.header-master .menu-item a,.header-master .cart-style-two .cart-button,.my-account-list>li>a ,.header-master .burger,.header-master .cart-button, .cart_top_1>.navbar-nav>li>a.cart-button,.header-master .my-account-menu a,.header-master .searchoverlay-button,.nav-style-megamenu>li.nav-item .nav-link',
                'property' => 'color',
            ),
            
            array (
                'element '=> '',
                'property' => 'hover',
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
              
Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'select',
	'settings'    => 'menu_hover_type',
	'label'       => __( 'Menu Hover Type', 'mayosis-core' ),
	'section'     => 'header_main_menu',
	'default'     => 'opacity',
	'priority'    => 10,
	'multiple'    => 1,
	 
	'choices'     => array(
		'opacity' => esc_attr__( 'Opacity', 'mayosis-core' ),
		'underline' => esc_attr__( 'Underline', 'mayosis-core' ),
		'dotted' => esc_attr__( 'Dotted', 'mayosis-core' ),
	),

));
                                        
              
Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'main_nav_text_hover',
'label'       => __( 'Main Navigation Text Hover Color', 'mayosis-core' ),
'description' => __( 'Change navigation text hover Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#28375a', 
'output'      => array(
            array(
                'element'  => '#mayosis-menu > ul > li > a:hover, .my-account-menu a:hover,.mayosis-option-menu > li > a:hover,.dropdown.cart_widget > a:hover,
                .nav-style-megamenu>li.nav-item .nav-link:hover',
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
              
Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'sub_nav_bg',
'label'       => __( 'Sub Navigation Background Color', 'mayosis-core' ),
'description' => __( 'Change navigation bg Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#1e1e2d', 
'output'      => array(
            array(
                'element'  => ' #mayosis-menu ul ul,.search-dropdown-main ul,.mayosis-option-menu .mini_cart,#mayosis-sidemenu > ul > li > a:hover, 
        .my-account-menu .my-account-list',
                'property' => 'background',
            ),
            
             array(
            'element'  => '.search-dropdown-main ul:after,.header-master .mayosis-option-menu .mini_cart:after,.header-master .my-account-menu .my-account-list:after,#mayosis-menu ul ul:before',
            'property' => 'border-bottom-color',
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
              
Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'sub_nav_text',
'label'       => __( 'Sub Navigation Text Color', 'mayosis-core' ),
'description' => __( 'Change navigation text Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#ffffff', 
'output'      => array(
            array(
                'element'  => '#mayosis-menu ul ul,.header-master .dropdown-menu li a,#mayosis-menu ul ul a,.header-master.fixedheader .dropdown-menu li a,
                .edd-cart-item-quantity, .edd-cart-item-title,.mini_cart .widget .edd-cart-item-price,.mini_cart .widget .edd-remove-from-cart,.mini_cart .widget .cart_item.empty .edd_empty_cart, .widget_edd_cart_widget.cart-empty .cart_item.empty,
                .edd-cart-item-quantity, .edd-cart-item-title,.mini_cart .widget .edd-cart-item-price,.cart_item.edd-cart-meta.edd_total, .mini_cart .cart_item.edd-cart-meta.edd_subtotal, .mini_cart .edd-cart-meta.edd_cart_tax,
                .mayosis-mini-cart-widget .cart-total,
                .emerce-min-cart-content h4,
                .min-cart-quantity,.woocommerce-mini-cart__total,
                .woocommerce-mini-cart__empty-message',
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


Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'sub_nav_text_hover',
'label'       => __( 'Sub Navigation Text Hover Color', 'mayosis-core' ),
'description' => __( 'Change navigation text hover Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#ffffff', 
'output'      => array(
            array(
                'element'  => '#mayosis-menu ul ul,.header-master .dropdown-menu li a:hover,#mayosis-menu ul ul a:hover,.header-master.fixedheader .dropdown-menu li a:hover',
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

Mayosis_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'mega-menu-Options',
		'label'    => __( '', 'mayosis-core' ),
		'section'  => 'header_main_menu',
		'default'  => '<div class="options-title">Mega Menu Options</div>',
	)
);    
Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
	'settings'    => 'mega_menu_ebl',
	'label'       => __( 'Mega Menu', 'mayosis-core' ),
	'section'     => 'header_main_menu',
	'default'     => 'disable',
	'priority'    => 10,
	'choices'     => array(
		'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
		'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
	
	),
	
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'mega_menu_bg',
'label'       => __( 'Mega Navigation Background Color', 'mayosis-core' ),
'description' => __( 'Change navigation bg Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#fff', 
'output'      => array(
            array(
                'element'  => '.xoopic-m-menu .nav-style-megamenu>li.nav-item .dropdown-menu .submenu-box',
                'property' => 'background',
            )
            
           
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

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'mega_menu_title_color',
'label'       => __( 'Mega Navigation Title Color', 'mayosis-core' ),
'description' => __( 'Change navigation title Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#28375a', 
'output'      => array(
            array(
                'element'  => '.nav-style-megamenu>li.nav-item .dropdown-menu .xoopic-mg-col-title',
                'property' => 'color',
            )
            
           
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

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'mega_menu_title_color_hvr',
'label'       => __( 'Mega Navigation Title Hover Color', 'mayosis-core' ),
'description' => __( 'Change navigation title  hover Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#28375a', 
'output'      => array(
            array(
                'element'  => '.nav-style-megamenu>li.nav-item .dropdown-menu .xoopic-mg-col-title:hover',
                'property' => 'color',
            )
            
           
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
Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'mega_menu_text_color',
'label'       => __( 'Mega Navigation Submenu Color', 'mayosis-core' ),
'description' => __( 'Change navigation submenu Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#28375a', 
'output'      => array(
            array(
                'element'  => '.nav-style-megamenu>li.nav-item .dropdown-menu .dropdown-item',
                'property' => 'color',
            )
            
           
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
Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'mega_menu_text_hvr_color',
'label'       => __( 'Mega Navigation Submenu Hover Color', 'mayosis-core' ),
'description' => __( 'Change navigation submenu hover Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#28375a', 
'output'      => array(
            array(
                'element'  => '.nav-style-megamenu>li.nav-item .dropdown-menu .dropdown-item:hover',
                'property' => 'color',
            )
            
           
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

Mayosis_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'acc-menu-Options',
		'label'    => __( '', 'mayosis-core' ),
		'section'  => 'header_main_menu',
		'default'  => '<div class="options-title">Accordion Menu Options</div>',
	)
); 

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'accordion_menu_txt_color',
'label'       => __( 'Accordion Menu Text Color', 'mayosis-core' ),
'description' => __( 'Change accordion menu Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#28375a', 
'output'      => array(
            array(
                'element'  => '#mayosis-sidebar #mayosis-sidemenu > ul > li > a',
                'property' => 'color',
            )
            
           
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


Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'accordion_menu_txt_hvr_color',
'label'       => __( 'Accordion Menu Text Hover Color', 'mayosis-core' ),
'description' => __( 'Change accordion menu hover Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#28375a', 
'output'      => array(
            array(
                'element'  => '#mayosis-sidebar #mayosis-sidemenu > ul > li > a:hover,
                 #mayosis-sidebar #mayosis-sidemenu > ul > li.open > a',
                'property' => 'color',
            )
            
           
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

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'accordion_menu_txt_hvrbg_color',
'label'       => __( 'Accordion Menu Text Hover Background Color', 'mayosis-core' ),
'description' => __( 'Change accordion menu hover Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#28375a', 
'output'      => array(
            array(
                'element'  => '#mayosis-sidebar #mayosis-sidemenu > ul > li > a:hover,
                #mayosis-sidebar #mayosis-sidemenu > ul > li.open > a',
                'property' => 'background',
            )
            
           
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

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'accordion_sbmenu_txt_color',
'label'       => __( 'Accordion Sub Menu Text Color', 'mayosis-core' ),
'description' => __( 'Change accordion sub menu Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#fff', 
'output'      => array(
            array(
                'element'  => '#mayosis-sidebar #mayosis-sidemenu ul ul li a',
                'property' => 'color',
            )
            
           
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

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'color',
'settings'     => 'accordion_sbmenu_txthvr_color',
'label'       => __( 'Accordion Sub Menu Text Hover Color', 'mayosis-core' ),
'description' => __( 'Change accordion sub menu hover Color', 'mayosis-core' ),
'section'     => 'header_main_menu',
'priority'    => 10,
'default'     => '#fff', 
'output'      => array(
            array(
                'element'  => '#mayosis-sidebar #mayosis-sidemenu ul ul li a:hover',
                'property' => 'color',
            )
            
           
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