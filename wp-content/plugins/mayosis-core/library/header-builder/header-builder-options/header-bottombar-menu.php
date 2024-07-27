<?php

Mayosis_Option::add_section( 'header_bttom_nav_menu', array(
	'title'       => __( 'Bottom Menu', 'mayosis-core' ),
	'panel'       => 'header',
) );


Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'color',
'settings'     => 'bottom_header_menu',
'label'       => __( 'Bottom Header Menu Text Color', 'mayosis-core' ),
'description' => __( 'Change bottom header menu text Color', 'mayosis-core' ),
'section'     => 'header_bttom_nav_menu',
'priority'    => 10,
'default'     => '#28375a', 
'output'      => array(
            array(
                'element'  => '.header-bottom #mayosis-menu>ul>li>a,.header-bottom ul li.cart-style-one a.cart-button,.header-bottom .my-account-menu a,  #mayosis-menu.mayosis-bottom-menu>ul>li>a',
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
'settings'     => 'bottom_header_sub_menu',
'label'       => __( 'Bottom Header Sub Menu Text Color', 'mayosis-core' ),
'description' => __( 'Change bottom header sub menu text Color', 'mayosis-core' ),
'section'     => 'header_bttom_nav_menu',
'priority'    => 10,
'default'     => '#ffffff', 
'output'      => array(
            array(
                'element'  => '.header-bottom #mayosis-menu ul ul a,.header-bottom #mayosis-menu ul ul, .header-bottom .search-dropdown-main ul,.header-bottom .mayosis-option-menu .mini_cart,.header-bottom #mayosis-sidemenu > ul > li > a:hover,
        .header-bottom #mayosis-sidemenu > ul > li.active > a, .header-bottom #mayosis-sidemenu > ul > li.open > a,.header-bottom  .my-account-menu .my-account-list,.header-bottom .my-account-list a,#mayosis-menu.mayosis-bottom-menu ul ul a',
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
'settings'     => 'bottom_sub_menu_bg',
'label'       => __( 'Bottom Header Sub Menu Background Color', 'mayosis-core' ),
'description' => __( 'Change bottom header sub menu background Color', 'mayosis-core' ),
'section'     => 'header_bttom_nav_menu',
'priority'    => 10,
'default'     => '#1e1e2d', 
'output'      => array(
            array(
                'element'  => '.header-bottom #mayosis-menu ul ul, .header-bottom .search-dropdown-main ul,.header-bottom .mayosis-option-menu .mini_cart,.header-bottom #mayosis-sidemenu > ul > li > a:hover,
        .header-bottom #mayosis-sidemenu > ul > li.active > a, .header-bottom #mayosis-sidemenu > ul > li.open > a,.header-bottom  .my-account-menu .my-account-list, #mayosis-menu.mayosis-bottom-menu ul ul',
                'property' => 'background',
            ),
            
            array(
                'element'  => '.header-bottom #mayosis-menu ul ul:before,.header-bottom .mayosis-option-menu .mini_cart:after,.header-bottom .my-account-menu .my-account-list:after, #mayosis-menu.mayosis-bottom-menu ul ul:before',
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
    'type'        => 'select',
	'settings'    => 'btmmenu_hover_type',
	'label'       => __( 'Menu Hover Type', 'mayosis-core' ),
	'section'     => 'header_bttom_nav_menu',
	'default'     => 'opacity',
	'priority'    => 10,
	'multiple'    => 1,
	 
	'choices'     => array(
		'opacity' => esc_attr__( 'Opacity', 'mayosis-core' ),
		'underline' => esc_attr__( 'Underline', 'mayosis-core' ),
		'dotted' => esc_attr__( 'Dotted', 'mayosis-core' ),
	),

));