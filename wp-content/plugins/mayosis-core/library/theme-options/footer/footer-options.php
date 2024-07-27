<?php
Mayosis_Option::add_panel( 'mayosis_footer', array(
	'title'       => __( 'Footer', 'mayosis-core' ),
	'description' => __( 'Mayosis Footer Options.', 'mayosis-core' ),
	'priority' => '6',
) );

Mayosis_Option::add_section( 'main_footer', array(
	'title'       => __( 'Footer Options', 'mayosis-core' ),
	'panel'       => 'mayosis_footer',

) );

Mayosis_Option::add_section( 'footer_copyright', array(
	'title'       => __( 'Copyright Footer', 'mayosis-core' ),
	'panel'       => 'mayosis_footer',

) );
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'enable_footer_builder',
        'label'       => __( 'Footer Builder', 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => 'hide',
        'priority'    => 10,
        'choices'     => array(
            'on'   => esc_attr__( 'Enable', 'mayosis-core' ),
            'hide' => esc_attr__( 'Disable', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
	'type'     => 'select',
	'settings' => 'select_footer_blocks',
	'label'    => esc_html__( 'Footer Template', 'mayosis-core' ),
	'section'  => 'main_footer',
	'default'  => '',
	 'transport' =>'auto',
	'priority' => 10,
	'multiple' => 1,
	'choices'  => mayosis_get_posts(
		array(
			'posts_per_page' => 10,
			'post_type'      => 'footer_builder'
		) 
	),
	
	  'required'    => array(
            array(
                'setting'  => 'enable_footer_builder',
                'operator' => '==',
                'value'    => 'on',
            ),
        ),
) );
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'text',
        'settings'    => 'footer_container_width',
        'label'       => __( 'Footer Container Width', 'mayosis-core' ),
        'description' => _('change the base container width start from 1600px.'),
        'section'     => 'main_footer',
        'default'     => '1170px',
        'priority'    => 10,
        
    
) );
Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'footer_widget_hide',
        'label'       => __( 'Footer Widget', 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => 'on',
        'priority'    => 10,
        'choices'     => array(
            'on'   => esc_attr__( 'Show', 'mayosis-core' ),
            'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'radio-buttonset',
        'settings'    => 'footer_widget_column',
        'label'       => __( 'Footer Widget Column', 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => 'four',
        'priority'    => 10,
        'choices'     => array(
            'one'   => esc_attr__( 'One', 'mayosis-core' ),
            'two' => esc_attr__( 'Two', 'mayosis-core' ),
            'three' => esc_attr__( 'Three', 'mayosis-core' ),
            'four' => esc_attr__( 'Four', 'mayosis-core' ),
            'five' => esc_attr__( 'Five', 'mayosis-core' ),
            'six' => esc_attr__( 'Six', 'mayosis-core' ),
        ),

        'required'    => array(
            array(
                'setting'  => 'footer_widget_hide',
                'operator' => '==',
                'value'    => 'on',
            ),

        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'text',
        'settings'    => 'column_one_width',
        'label'       => esc_attr__( 'Column One Width', 'mayosis-core' ),
        'description' => esc_attr__( 'Add Column One Width on % (Without %)', 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => '25',
        'required'    => array(
            array(
                'setting'  => 'footer_widget_hide',
                'operator' => '==',
                'value'    => 'on',
            ),

        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
    
        'type'        => 'text',
        'settings'    => 'column_two_width',
        'label'       => esc_attr__( 'Column Two Width', 'mayosis-core' ),
        'description' => esc_attr__( 'Add Column Two Width on % (Without %)', 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => '25',
        'required'    => array(
            array(
                'setting'  => 'footer_widget_hide',
                'operator' => '==',
                'value'    => 'on',
            ),

        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'text',
        'settings'    => 'column_three_width',
        'label'       => esc_attr__( 'Column Three Width', 'mayosis-core' ),
        'description' => esc_attr__( 'Add Column Three Width on % (Without %)', 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => '25',
        'required'    => array(
            array(
                'setting'  => 'footer_widget_hide',
                'operator' => '==',
                'value'    => 'on',
            ),

        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
        'settings'    => 'column_four_width',
        'label'       => esc_attr__( 'Column Four Width', 'mayosis-core' ),
        'description' => esc_attr__( 'Add Column Four Width on % (Without %)' , 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => '25',
        'required'    => array(
            array(
                'setting'  => 'footer_widget_hide',
                'operator' => '==',
                'value'    => 'on',
            ),

        ),

    
) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
        'settings'    => 'column_five_width',
        'label'       => esc_attr__( 'Column Five Width', 'mayosis-core' ),
        'description' => esc_attr__( 'Add Column Five Width on % (Without %)', 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => '15',
        'required'    => array(
            array(
                'setting'  => 'footer_widget_hide',
                'operator' => '==',
                'value'    => 'on',
            ),

        ),

    
) );


Mayosis_Option::add_field( 'mayo_config', array(
     'type'        => 'text',
        'settings'    => 'column_six_width',
        'label'       => esc_attr__( 'Column Six Width', 'mayosis-core' ),
        'description' => esc_attr__( 'Add Column Six Width on %(Without %)', 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => '15',
        'required'    => array(
            array(
                'setting'  => 'footer_widget_hide',
                'operator' => '==',
                'value'    => 'on',
            ),

        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
    
       'type'        => 'radio-buttonset',
        'settings'    => 'footer_additonal_widget',
        'label'       => __( 'Footer Additional Widget', 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => 'hide',
        'priority'    => 10,
        'choices'     => array(
            'show'   => esc_attr__( 'Show', 'mayosis-core' ),
            'hide' => esc_attr__( 'Hide', 'mayosis-core' ),

        ),
        'required'    => array(
            array(
                'setting'  => 'footer_widget_hide',
                'operator' => '==',
                'value'    => 'on',
            ),

        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    
       'type'        => 'dimensions',
        'settings'    => 'main_footerr_padding',
        'label'       => esc_attr__( 'Footer Padding', 'mayosis-core' ),
        'description' => esc_attr__( 'Change Footer Padding', 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => array(
            'padding-top'    => '80px',
            'padding-bottom' => '70px',
            'padding-left'   => '0px',
            'padding-right'  => '0px',
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'footer_back_to_top_hide',
        'label'       => __( 'Back to top', 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => 'on',
        'priority'    => 10,
        'choices'     => array(
            'on'   => esc_attr__( 'Enable', 'mayosis-core' ),
            'hide' => esc_attr__( 'Disable', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    
    'type'        => 'radio-buttonset',
        'settings'    => 'copyright_footer',
        'label'       => __( 'Copyright Footer', 'mayosis-core' ),
        'section'     => 'footer_copyright',
        'default'     => 'show',
        'priority'    => 10,
        'choices'     => array(
            'show'   => esc_attr__( 'Show', 'mayosis-core' ),
            'hide' => esc_attr__( 'Hide', 'mayosis-core' ),

        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
    
    'type'        => 'radio-buttonset',
        'settings'    => 'copyright_type',
        'label'       => __( 'Copyright Type', 'mayosis-core' ),
        'section'     => 'footer_copyright',
        'default'     => 'single',
        'priority'    => 10,
        'choices'     => array(
            'single'   => esc_attr__( 'Single Copyright', 'mayosis-core' ),
            'columed' => esc_attr__( 'With Widget', 'mayosis-core' ),

        ),
    
) );


Mayosis_Option::add_field( 'mayo_config', array(
         'type'        => 'editor',
        'settings'    => 'copyright_text',
        'label'       => __( 'Copyright Text', 'mayosis-core' ),
        'section'     => 'footer_copyright',
        'default'     => esc_attr__( 'Copyright 2018 Mayosis Studio, All rights reserved!', 'mayosis-core' ),
        'priority'    => 20,
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'radio-buttonset',
        'settings'    => 'enable_mobile_bottom_fx_bar',
        'label'       => __( 'Mobile Bottom Bar', 'mayosis-core' ),
        'section'     => 'main_footer',
        'default'     => 'hide',
        'priority'    => 10,
        'choices'     => array(
            'on'   => esc_attr__( 'Enable', 'mayosis-core' ),
            'hide' => esc_attr__( 'Disable', 'mayosis-core' ),
        ),
    
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'select',
    'settings' => 'select_wishlist_p_link_mb',
    'label'    => esc_html__( 'Wishlist Page Link', 'kirki' ),
    'section'  => 'main_footer',
    'transport' =>'auto',
    'priority' => 10,
    'multiple' => 1,
    'choices'  => mayosis_get_posts(
        array(
            'posts_per_page' => -1,
            'post_type'      => 'page'
        )
    ),


) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'select',
    'settings' => 'select_account_p_link_mb',
    'label'    => esc_html__( 'Account Page Link', 'kirki' ),
    'section'  => 'main_footer',
    'transport' =>'auto',
    'priority' => 10,
    'multiple' => 1,
    'choices'  => mayosis_get_posts(
        array(
            'posts_per_page' => -1,
            'post_type'      => 'page'
        )
    ),


) );
