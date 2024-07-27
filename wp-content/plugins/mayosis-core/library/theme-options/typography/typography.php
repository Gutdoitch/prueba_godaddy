<?php
Mayosis_Option::add_panel( 'mayosis_typgraphy', array(
	'title'       => __( 'Global Typography', 'mayosis-core' ),
	'description' => __( 'Mayosis Typography', 'mayosis-core' ),
	'priority' => '5',
) );

Mayosis_Option::add_section( 'general_typo', array(
	'title'       => __( 'Global Typography', 'mayosis-core' ),
	'panel'       => 'mayosis_typgraphy',

) );

Mayosis_Option::add_section( 'headings_typo', array(
	'title'       => __( 'Headings Typography', 'mayosis-core' ),
	'panel'       => 'mayosis_typgraphy',

) );

Mayosis_Option::add_section( 'menu_typo', array(
	'title'       => __( 'Menu Typography', 'mayosis-core' ),
	'panel'       => 'mayosis_typgraphy',

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'body_typography',
        'label'       => esc_attr__( 'Body Typography', 'mayosis-core' ),
        'section'     => 'general_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'font-size'      => '1rem',
            'line-height'    => '1.75',
            'variant'        => '400',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => 'body,table tbody tr td,table thead tr th, table tfoot tr td,.edd-download .single-post-block,.edd-download  .single-post-block p',
            ),
        ),

    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'breadcrumb_typography',
        'label'       => esc_attr__( 'Page Breadcrumb Title Typography', 'mayosis-core' ),
        'section'     => 'general_typo',
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
                'element' => 'h1.page_title_single',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'product_title_typography',
        'label'       => esc_attr__( 'Product/Blog Breadcrumb Title Typography', 'mayosis-core' ),
        'section'     => 'general_typo',
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
                'element' => 'h1.single-post-title',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'h1_typography',
        'label'       => esc_attr__( 'H1 Typography', 'mayosis-core' ),
        'section'     => 'headings_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => '700',
            'font-size'      => '3rem',
            'line-height'    => '1.25',
            'letter-spacing'    => '0',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => 'h1',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'h2_typography',
        'label'       => esc_attr__( 'H2 Typography', 'mayosis-core' ),
        'section'     => 'headings_typo',
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
                'element' => 'h2',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'h3_typography',
        'label'       => esc_attr__( 'H3 Typography', 'mayosis-core' ),
        'section'     => 'headings_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => '700',
            'font-size'      => '1.75rem',
            'line-height'    => '1.35',
            'letter-spacing'    => '0',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => 'h3',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'typography',
        'settings'    => 'h4_typography',
        'label'       => esc_attr__( 'H4 Typography', 'mayosis-core' ),
        'section'     => 'headings_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => '700',
            'font-size'      => '1.5rem',
            'line-height'    => '1.5',
            'letter-spacing'    => '0',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => 'h4',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'typography',
        'settings'    => 'h5_typography',
        'label'       => esc_attr__( 'H5 Typography', 'mayosis-core' ),
        'section'     => 'headings_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => '700',
            'font-size'      => '1.25rem',
            'line-height'    => '1.5',
            'letter-spacing'    => '0',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => 'h5',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'h6_typography',
        'label'       => esc_attr__( 'H6 Typography', 'mayosis-core' ),
        'section'     => 'headings_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => '700',
            'font-size'      => '1.125rem',
            'line-height'    => '1.75',
            'letter-spacing'    => '0',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => 'h6',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'typography',
        'settings'    => 'main_menu_typography',
        'label'       => esc_attr__( 'Main Menu', 'mayosis-core' ),
        'section'     => 'menu_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => 'regular',
            'font-size'      => '1rem',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '#mayosis-menu.msv-main-menu > ul > li > a,.main-header ul li.cart-style-one a.cart-button,.search-dropdown-main a,.menu-item a,.cart-style-two .cart-button',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'sub_menu_typography',
        'label'       => esc_attr__( 'Sub Menu', 'mayosis-core' ),
        'section'     => 'menu_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => 'regular',
            'font-size'      => '1rem',
            'line-height'    => '1.75',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '#mayosis-menu.msv-main-menu ul ul a, .nav-style-megamenu>li.nav-item .dropdown-menu .dropdown-item',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'mg_menu_title_typography',
        'label'       => esc_attr__( 'Mega Menu Title', 'mayosis-core' ),
        'section'     => 'menu_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => '700',
            'font-size'      => '1rem',
            'line-height'    => '1.75',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '.nav-style-megamenu>li.nav-item .dropdown-menu .xoopic-mg-col-title',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'top_menu_typography',
        'label'       => esc_attr__( 'Top Menu', 'mayosis-core' ),
        'section'     => 'menu_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => 'regular',
            'font-size'      => '0.875rem',
            'line-height'    => '0.875rem',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '#top-main-menu > ul > li > a ,.top-header #cart-menu li a',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'top_submenu_typography',
        'label'       => esc_attr__( 'Top Sub Menu', 'mayosis-core' ),
        'section'     => 'menu_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => 'regular',
            'font-size'      => '0.875rem',
            'line-height'    => '1',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => ' #top-main-menu ul ul a',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'typography',
        'settings'    => 'btm_menu_typography',
        'label'       => esc_attr__( 'Bottom Main Menu', 'mayosis-core' ),
        'section'     => 'menu_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => 'regular',
            'font-size'      => '1rem',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '#mayosis-menu.mayosis-bottom-menu > ul > li > a',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'btmsub_menu_typography',
        'label'       => esc_attr__( 'Botom Sub Menu', 'mayosis-core' ),
        'section'     => 'menu_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => 'regular',
            'font-size'      => '1rem',
            'line-height'    => '1.75',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '#mayosis-menu.mayosis-bottom-menu ul ul a',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'mobile_menu_typography',
        'label'       => esc_attr__( 'Mobile Menu', 'mayosis-core' ),
        'section'     => 'menu_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => 'regular',
            'font-size'      => '0.875rem',
            'line-height'    => '1.5',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '#sidebar-wrapper .navbar-nav > li > a, #sidebar-wrapper #mega-menu-wrap-main-menu #mega-menu-main-menu > li.mega-menu-item > a.mega-menu-link',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'mobile_submenu_typography',
        'label'       => esc_attr__( 'Mobile Sub Menu', 'mayosis-core' ),
        'section'     => 'menu_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => 'regular',
            'font-size'      => '0.875rem',
            'line-height'    => '1.5',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '#sidebar-wrapper .dropdown-menu > li > a',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'sidebar_main_menu_p',
        'label'       => esc_attr__( 'Sidebar Main Menu (Accordion)', 'mayosis-core' ),
        'section'     => 'menu_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => 'regular',
            'font-size'      => '1rem',
            'line-height'    => '1.5',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '#mayosis-sidebar #mayosis-sidemenu > ul > li > a',
            ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
        'settings'    => 'sidebar_sub_menu_p',
        'label'       => esc_attr__( 'Sidebar Sub Menu (Accordion)', 'mayosis-core' ),
        'section'     => 'menu_typo',
        'default'     => array(
            'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
            'variant'        => 'regular',
            'font-size'      => '1rem',
            'line-height'    => '1.5',

        ),
        'priority'    => 10,
        'transport' => 'auto',
        'output'    => array(
            array(
                'element' => '#mayosis-sidebar #mayosis-sidemenu ul ul li a',
            ),
        ),
    
) );
