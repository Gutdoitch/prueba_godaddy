<?php

Mayosis_Option::add_section( 'header_search', array(
	'title'       => __( 'Search', 'mayosis-core' ),
	'panel'       => 'header',
) );


Mayosis_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'custom-title-search',
		'label'    => __( '', 'mayosis-core' ),
		'section'  => 'header_search',
		'default'  => '<div class="options-title">Search Icon Options</div>',
	)
);


Mayosis_Option::add_field( 'mayo_config',  array(
	                'type'        => 'radio-image',
                	'settings'    => 'search_style',
                	'label'       => esc_html__( 'Search Style', 'mayosis-core' ),
                	'section'     => 'header_search',
                	'default'     => 'one',
                	'priority'    => 10,
                	'choices'     => array(
                		'one'   => get_template_directory_uri() . '/images/search-style-1.png',
                		'two' => get_template_directory_uri() . '/images/search-style-2.png',
                	),
));



Mayosis_Option::add_field( 'mayo_config',  array(
    
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'search_behaviour',
                    	'label'       => __( 'Search Beahviour', 'mayosis-core' ),
                    	'section'     => 'header_search',
                    	'default'     => 'dropdown',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'dropdown'   => esc_attr__( 'Dropdown', 'mayosis-core' ),
                    		'collapse' => esc_attr__( 'Collapse', 'mayosis-core' ),
                    		'fullscreen' => esc_attr__( 'Fullscreen Overlay', 'mayosis-core' ),
                    		'offcanvas' => esc_attr__( 'Offcanvas', 'mayosis-core' ),
                    	),
                    	'required'    => array(
                        array(
                            'setting'  => 'search_style',
                            'operator' => '==',
                            'value'    => 'one',
                                ),
                            ),
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'dimensions',
	'settings'    => 'header-search-border-radius',
	'label'       => esc_attr__( 'Search Form Border Radius (px)', 'mayosis-core' ),
	'section'     => 'header_search',
	'output'      => array(
            array(
                'element'  => '.stylish-input-group input.dm_search,.mayosis-offcanvas-box .search input[type="search"]',
            ),
            
        ),
	 'default'     => array(
            'border-top-left-radius'    => '0px',
            'border-top-right-radius' => '0px',
            'border-bottom-left-radius'   => '0px',
            'border-bottom-right-radius'  => '0px',
        ),
        ));
        
        
          Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'search_edd_extra_bg',
        'label'       => __( 'Search Background Color', 'mayosis-core' ),
        'description' => __( 'Change search background color', 'mayosis-core' ),
        'section'     => 'header_search',
        'priority'    => 10,
        'default'     => '#e9edf7',
        'output' => array(
            	array(
            		'element'  => '.stylish-input-group input.dm_search,.mayosis-offcanvas-box .search input[type="search"]',
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
        
));

     Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'search_edd_extra_border',
        'label'       => __( 'Search Border Color', 'mayosis-core' ),
        'description' => __( 'Change search border color', 'mayosis-core' ),
        'section'     => 'header_search',
        'priority'    => 10,
        'default'     => '#e9edf7',
        'output' => array(
            	array(
            		'element'  => '.stylish-input-group input.dm_search,.mayosis-offcanvas-box .search input[type="search"]',
            		'property' => 'border-color',
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
        'settings'     => 'search_edd_txt_color',
        'label'       => __( 'Search Text Color', 'mayosis-core' ),
        'description' => __( 'Change search text color', 'mayosis-core' ),
        'section'     => 'header_search',
        'priority'    => 10,
        'default'     => '#282837',
        'output' => array(
            	array(
            		'element'  => '.stylish-input-group input.dm_search,.stylish-input-group i,.stylish-input-group input::placeholder,.mayosis-offcanvas-box .search input[type="search"]',
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
Mayosis_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'custom-title-search-two',
		'label'    => __( '', 'mayosis-core' ),
		'section'  => 'header_search',
		'default'  => '<div class="options-title">Search Form Options</div>',
	)
);

Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'dimension',
	'settings'    => 'header-search-form-width',
	'label'       => esc_attr__( 'Search Form Width (px or %)', 'mayosis-core' ),
	'section'     => 'header_search',
	'output'      => array(
            array(
                'element'  => '.header-search-form',
                'property' => 'width',
            ),
        ),
	'default'     => '360px',
        ));
        
        
Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'dimension',
	'settings'    => 'header-search-form-height',
	'label'       => esc_attr__( 'Search Form height (px)', 'mayosis-core' ),
	'section'     => 'header_search',
	'output'      => array(
            array(
                'element'  => '.header-search-form input[type=search], .header-search-form input[type=text], .header-search-form select,.header-search-form .search-btn,
        .header-search-form .mayosel-select,.header-search-form .search-btn::after,.header-minimal-form .search-fields',
                'property' => 'height',
            ),
            
            array(
                'element'  => '.header-search-form input[type=search], .header-search-form input[type=text], .header-search-form select,.header-search-form .search-btn,
        .header-search-form .mayosel-select,.header-search-form .search-btn::after,.header-minimal-form .search-fields',
                'property' => 'max-height',
            ),
            
            array(
                'element'  => '.header-search-form .search-btn::after,.header-minimal-form .search-fields',
                'property' => 'line-height',
            ),
        ),
	'default'     => '40px',
        ));

Mayosis_Option::add_field( 'mayo_config',  array(
    
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'search_form_type',
                    	'label'       => __( 'Search Form Type', 'mayosis-core' ),
                    	'section'     => 'header_search',
                    	'default'     => 'normal',
                    	'description'     => 'note that category filter will not work in ajax mode',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'normal'   => esc_attr__( 'Normal', 'mayosis-core' ),
                    		'ajax' => esc_attr__( 'Ajax', 'mayosis-core' ),
                    	
                    	),
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'switch',
	'settings'    => 'header_search_category',
	'label'       => esc_html__( 'Category Dropdown', 'mayosis-core' ),
	'section'     => 'header_search',
	'default'     => '1',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
	
	'required'    => array(
    array(
        'setting'  => 'search_form_type',
        'operator' => '==',
        'value'    => 'normal',
            ),
        ),
] );
    
Mayosis_Option::add_field( 'mayo_config',  array(
    
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'search_form_style',
                    	'label'       => __( 'Search Form Style', 'mayosis-core' ),
                    	'section'     => 'header_search',
                    	'default'     => 'standard',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'standard'   => esc_attr__( 'Standard', 'mayosis-core' ),
                    		'ghost' => esc_attr__( 'Ghost', 'mayosis-core' ),
                    		'minimal' => esc_attr__( 'Minimal', 'mayosis-core' ),
                    	),
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'ghost_border_color',
        'label'       => __( 'Ghost/Minimal Search Border Color', 'mayosis-core' ),
        'description' => __( 'Change ghost search border color', 'mayosis-core' ),
        'section'     => 'header_search',
        'priority'    => 10,
        'default'     => 'rgba(40,55,90,0.25)',
        'output' => array(
            	array(
            		'element'  => '.header-ghost-form.header-search-form input[type="text"],.header-ghost-form.header-search-form .mayosel-select,.header-ghost-form.header-search-form select, .header-ghost-form.header-search-form .download_cat_filter,.header-minimal-form',
            		'property' => 'border-color',
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
        'settings'     => 'ghost_text_color',
        'label'       => __( 'Ghost/Minimal Search Text Color', 'mayosis-core' ),
        'description' => __( 'Change ghost search text color', 'mayosis-core' ),
        'section'     => 'header_search',
        'priority'    => 10,
        'default'     => 'rgba(40,55,90,1)',
        'output' => array(
            	array(
            		'element'  => '.header-ghost-form.header-search-form input[type="text"],.header-ghost-form.header-search-form .mayosel-select .current,.header-ghost-form.header-search-form select,.header-ghost-form.header-search-form .mayosel-select:after,.header-ghost-form.header-search-form .search-btn::after,.header-ghost-form.header-search-form input[type="text"]::placeholder,.header-minimal-form,.header-minimal-form input,.header-minimal-form input[type="text"]::placeholder,.header-minimal-form.header-search-form .search-btn::after',
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

  Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'dimension',
	'settings'    => 'header-seccond-border-radius',
	'label'       => esc_attr__( 'Search Form Border Radius (px)', 'mayosis-core' ),
	'section'     => 'header_search',
	'output'      => array(
            array(
                'element'  => '.header-ghost-form.header-search-form .mayosel-select,.header-ghost-form.header-search-form select,
                .header-search-form input[type="text"],.mayosis-edd-ajax-search,.mayosis-edd-ajax-search input[type="text"]',
                'property' => 'border-radius',
            ),
            
             array(
                'element'  => '.header-ghost-form.header-search-form input[type="text"],header .search-btn::after',
                'property' => 'border-top-right-radius',
            ),
            
            array(
                'element'  => '.header-ghost-form.header-search-form input[type="text"],header .search-btn::after',
                'property' => 'border-bottom-right-radius',
            ),
            
        ),
	'default'     => '3px',
        ));
        
        Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
	'settings'    => 'search_form_placeholder_cs',
	'label'       => esc_attr__( 'Change Placeholder Text', 'mayosis-core' ),
	'description' => esc_attr__( '', 'mayosis-core' ),
	'section'     => 'header_search',
	'default'     => 'e.g. mockup',
    ));
    Mayosis_Option::add_field( 'mayo_config',  array(
    
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'hide_searchbar_home',
                    	'label'       => __( 'Search Bar Front Page Position', 'mayosis-core' ),
                    	'section'     => 'header_search',
                    	'default'     => 'both',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'both'   => esc_attr__( 'Both Header', 'mayosis-core' ),
                    		'sticky' => esc_attr__( 'Sticky Header', 'mayosis-core' ),
                    	),
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config',  array(
    
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'search_result_type',
                    	'label'       => __( 'Search Result Type', 'mayosis-core' ),
                    	'section'     => 'header_search',
                    	'default'     => 'edd',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'edd'   => esc_attr__( 'Product Only', 'mayosis-core' ),
                    		'all' => esc_attr__( 'Everything', 'mayosis-core' ),
                    	),
    
    ));