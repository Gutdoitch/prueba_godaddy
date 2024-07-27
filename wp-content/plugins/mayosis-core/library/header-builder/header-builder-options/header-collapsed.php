<?php

Mayosis_Option::add_section( 'header_collapsed', array(
	'title'       => __( 'Sidebar Header', 'mayosis-core' ),
	'panel'       => 'header',
) );

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
'settings'    => 'default_menu_type',
'label'       => __( 'Sidebar Menu Type', 'mayosis-core' ),
'section'     => 'header_collapsed',
'default'     => 'normal',
'priority'    => 10,
'choices'     => array(
	'normal'   => esc_attr__( 'Normal', 'mayosis-core' ),
	'accordion' => esc_attr__( 'Accordion', 'mayosis-core' ),
),
));
 Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'sidebar_top_color_max',
        'label'       => __( 'Top Part Logo Background', 'mayosis-core' ),
        'description' => __( 'Change Logo Background', 'mayosis-core' ),
        'section'     => 'header_collapsed',
        'priority'    => 10,
        'default'     => '#26264d',
        'output' => array(
             array(
                	        'element' => '#mayosis-sidebar .mayosis-sidebar-header',
                	        'property' =>'background-color',
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
        'settings'     => 'sidebar_bg_main_ms',
        'label'       => __( 'Sidebar Background', 'mayosis-core' ),
        'description' => __( 'Change Sidebar Background', 'mayosis-core' ),
        'section'     => 'header_collapsed',
        'priority'    => 10,
        'default'     => '#ffffff',
        'output' => array(
             array(
                	        'element' => '#mayosis-sidebar,#mayosis-sidebar .sidebar-fixed',
                	        'property' =>'background-color',
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
Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
'settings'    => 'sidebar_logo_state',
'label'       => __( 'Sidebar Logo Box', 'mayosis-core' ),
'section'     => 'header_collapsed',
'default'     => 'enable',
'priority'    => 10,
'choices'     => array(
	'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
	'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
),
));
Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'image',
'settings'    => 'sidebar_logo_icon',
'label'       => esc_attr__( 'Sidebar Logo Icon Upload', 'mayosis-core' ),
'description' => esc_attr__( 'Recommanded Size 40x40px', 'mayosis-core' ),
'section'     => 'header_collapsed',
'default'     => '',
));

                        
Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
'settings'    => 'default_side_menu',
'label'       => __( 'Default Side Menu', 'mayosis-core' ),
'section'     => 'header_collapsed',
'default'     => 'expanded',
'priority'    => 10,
'choices'     => array(
	'collapse'   => esc_attr__( 'Collapsed', 'mayosis-core' ),
	'expanded' => esc_attr__( 'Expanded', 'mayosis-core' ),
),
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
'settings'    => 'secondary_header',
'label'       => __( 'Secondary Header', 'mayosis-core' ),
'section'     => 'header_collapsed',
'default'     => 'on',
'priority'    => 10,
'choices'     => array(
	'on'   => esc_attr__( 'Enable', 'mayosis-core' ),
	'off' => esc_attr__( 'Disable', 'mayosis-core' ),
),
));


Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
'settings'    => 'secondary_header_state',
'label'       => __( 'Secondary Header Type', 'mayosis-core' ),
'section'     => 'header_collapsed',
'default'     => 'standard',
'priority'    => 10,
'choices'     => array(
	'standard'   => esc_attr__( 'Standard', 'mayosis-core' ),
	'full' => esc_attr__( 'Full-Width', 'mayosis-core' ),
),
));
                    

       
                    
Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
'settings'    => 'icon_in_expanded',
'label'       => __( 'Icon in Expanded Mode', 'mayosis-core' ),
'section'     => 'header_collapsed',
'default'     => 'on',
'priority'    => 10,
'choices'     => array(
	'on'   => esc_attr__( 'Show', 'mayosis-core' ),
	'off' => esc_attr__( 'Hide', 'mayosis-core' ),
),
));
                    
Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
'settings'    => 'text_in_collapsed',
'label'       => __( 'Text in Collapsed Mode', 'mayosis-core' ),
'section'     => 'header_collapsed',
'default'     => 'on',
'priority'    => 10,
'choices'     => array(
	'on'   => esc_attr__( 'Show', 'mayosis-core' ),
	'off' => esc_attr__( 'Hide', 'mayosis-core' ),
),
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'    => 'shadow_on_sidebar',
'label'       => __( 'Shadow on Sidebar', 'mayosis-core' ),
'section'     => 'header_collapsed',
'default'     => 'off',
'priority'    => 10,
'choices'     => array(
	'shadowonsidebar'   => esc_attr__( 'Show', 'mayosis-core' ),
	'off' => esc_attr__( 'Hide', 'mayosis-core' ),
),
));
                    


   Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'sidebar_main_logo_margin',
	'label'       => esc_html__( 'Main Logo Margin', 'mayosis-core' ),
	'description' => esc_html__( 'add logo margin', 'mayosis-core' ),
	'section'     => 'header_collapsed',
	'default'     => [
		'margin-top'    => '0',
		'margin-bottom' => '0',
		'margin-left'   => '0',
		'margin-right'  => '0',
	],
	'output' => array(
             array(
                	        'element' => '.sidebar-main-logo img',
                	        
                	        ),
            ),
] );

   Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'inner_menu_padding',
	'label'       => esc_html__( 'Menu Padding', 'mayosis-core' ),
	'description' => esc_html__( 'add menu padding', 'mayosis-core' ),
	'section'     => 'header_collapsed',
	'default'     => [
		'margin-top'    => '0',
		'margin-bottom' => '0',
		'margin-left'   => '0',
		'margin-right'  => '0',
	],
	'output' => array(
             array(
                	        'element' => '.side-header-inner-m',
                	        
                	        ),
            ),
] );              
  Mayosis_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'custom-title-scl',
		'label'    => __( '', 'mayosis-core' ),
		'section'  => 'header_collapsed',
		'default'  => '<div class="options-title">Sidebar Bottom</div>',
	)
);

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
'settings'    => 'bottom_social_part_sideheader',
'label'       => __( 'Show Bottom Social', 'mayosis-core' ),
'section'     => 'header_collapsed',
'default'     => 'off',
'priority'    => 10,
'choices'     => array(
	'on'   => esc_attr__( 'Show', 'mayosis-core' ),
	'off' => esc_attr__( 'Hide', 'mayosis-core' ),
),
));

 Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'bottom_social_part_bg',
        'label'       => __( 'Bottom Part BG', 'mayosis-core' ),
        'description' => __( 'Change Social Part BG Color', 'mayosis-core' ),
        'section'     => 'header_collapsed',
        'priority'    => 10,
        'default'     => '#26264d',
        'output' => array(
             array(
                	        'element' => '#mayosis-sidebar .social-icon-sidebar-header',
                	        'property' =>'background-color',
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
        'settings'     => 'bottom_social_part_text',
        'label'       => __( 'Social Icon Color', 'mayosis-core' ),
        'description' => __( 'Change Social Part icon Color', 'mayosis-core' ),
        'section'     => 'header_collapsed',
        'priority'    => 10,
        'default'     => '#ffffff',
        'output' => array(
             array(
                	        'element' => '#mayosis-sidebar .social-icon-sidebar-header a',
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
    ));
    
     Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'sidebar_btm_part_padding',
	'label'       => esc_html__( 'Bottom Part Padding', 'mayosis-core' ),
	'description' => esc_html__( 'add bottom part padding', 'mayosis-core' ),
	'section'     => 'header_collapsed',
	'default'     => [
		'padding-top'    => '0',
		'padding-bottom' => '0',
		'padding-left'   => '0',
		'padding-right'  => '0',
	],
	'output' => array(
             array(
                	        'element' => '.social-icon-sidebar-header',
                	        
                	        ),
            ),
] );              
    
    Mayosis_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'custom-title-csbtn',
		'label'    => __( '', 'mayosis-core' ),
		'section'  => 'header_collapsed',
		'default'  => '<div class="options-title">Collapse Button Options</div>',
	)
);

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
'settings'    => 'collapse_button',
'label'       => __( 'Collapse & expand button', 'mayosis-core' ),
'section'     => 'header_collapsed',
'default'     => 'off',
'priority'    => 10,
'choices'     => array(
	'on'   => esc_attr__( 'Show', 'mayosis-core' ),
	'off' => esc_attr__( 'Hide', 'mayosis-core' ),
),
));
  Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'col-btn-color-mm',
        'label'       => __( 'Collapse Button Color', 'mayosis-core' ),
        'description' => __( 'Change collapse button Color', 'mayosis-core' ),
        'section'     => 'header_collapsed',
        'priority'    => 10,
        'default'     => '#ffffff',
        'output' => array(
             array(
                	        'element' => '#mayosis-sidebar .burger span,#mayosis-sidebar .burger span::before,#mayosis-sidebar .burger span::after,#mayosis-sidebar .burger.clicked span:before,#mayosis-sidebar .burger.clicked span:after',
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
    ));
    
        Mayosis_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'accordion-menu-csbtn',
		'label'    => __( '', 'mayosis-core' ),
		'section'  => 'header_collapsed',
		'default'  => '<div class="options-title">Accordion Menu</div>',
	)
);

  Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'sidebar_accordion_men_color',
        'label'       => __( 'Accordion Menu Color', 'mayosis-core' ),
        'description' => __( 'Change menu text Color', 'mayosis-core' ),
        'section'     => 'header_collapsed',
        'priority'    => 10,
        'default'     => '#ffffff',
        'output' => array(
             array(
                	        'element' => '#mayosis-sidebar #mayosis-sidemenu > ul > li > a',
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
    ));
    
      Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'sidebar_accordion_sub_men_color',
        'label'       => __( 'Accordion Sub Menu Color', 'mayosis-core' ),
        'description' => __( 'Change menu text Color', 'mayosis-core' ),
        'section'     => 'header_collapsed',
        'priority'    => 10,
        'default'     => '#ffffff',
        'output' => array(
             array(
                	        'element' => '#mayosis-sidebar #mayosis-sidemenu ul ul li a',
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
    ));


 Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'sidebar_accordion_sub_hovermen_color',
        'label'       => __( 'Accordion Menu Hover & Active BG Color', 'mayosis-core' ),
        'description' => __( 'Change menu bg Color', 'mayosis-core' ),
        'section'     => 'header_collapsed',
        'priority'    => 10,
        'default'     => '#ffffff',
        'output' => array(
             array(
                	        'element' => '#mayosis-sidebar #mayosis-sidemenu > ul > li > a:hover,#mayosis-sidebar #mayosis-sidemenu ul li.active>a',
                	        'property' =>'background',
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
        'settings'     => 'sidebar_accordion_sub_hovertxt_color',
        'label'       => __( 'Accordion Menu Hover & Active Text Color', 'mayosis-core' ),
        'description' => __( 'Change menu bg Color', 'mayosis-core' ),
        'section'     => 'header_collapsed',
        'priority'    => 10,
        'default'     => '#ffffff',
        'output' => array(
             array(
                	        'element' => '#mayosis-sidebar #mayosis-sidemenu > ul > li > a:hover,#mayosis-sidebar #mayosis-sidemenu ul li.active>a',
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
    ));
