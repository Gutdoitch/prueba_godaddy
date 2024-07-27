<?php

Mayosis_Option::add_section( 'follow', array(
	'title'       => __( 'Social', 'mayosis-core' ),
	'panel'       => 'header',
) );

Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'facebook_enable',
	'label'       => esc_html__( 'Enable Facebook', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '1',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'twitter_enable',
	'label'       => esc_html__( 'Enable Twitter', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '1',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
      Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'instagram_enable',
	'label'       => esc_html__( 'Enable Instagram', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '1',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'pinterest_enable',
	'label'       => esc_html__( 'Enable Pinterest', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '1',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'youtube_enable',
	'label'       => esc_html__( 'Enable Youtube', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '1',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'linkedin_enable',
	'label'       => esc_html__( 'Enable Linked In', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '2',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
     Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'github_enable',
	'label'       => esc_html__( 'Enable Github', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '2',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'slack_enable',
	'label'       => esc_html__( 'Enable Slack', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '2',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'envato_enable',
	'label'       => esc_html__( 'Enable Envato', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '2',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'behance_enable',
	'label'       => esc_html__( 'Enable Behance', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '2',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'dribbble_enable',
	'label'       => esc_html__( 'Enable Dribbble', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '2',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
     Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'vimeo_enable',
	'label'       => esc_html__( 'Enable Vimeo', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '2',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
    Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'switch',
	'settings'    => 'spotify_enable',
	'label'       => esc_html__( 'Enable Spotify', 'mayosis-core' ),
	'section'     => 'follow',
	'default'     => '2',
	'priority'    => 10,
	'choices'     => [
		'on'  => esc_html__( 'Enable', 'mayosis-core' ),
		'off' => esc_html__( 'Disable', 'mayosis-core' ),
	],
    
    ));
    
    
    Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'head_social_icon_color',
        'label'       => __( 'Icon Color', 'mayosis-core' ),
        'section'     => 'follow',
        'priority'    => 10,
        'default'     => '#3d3d3d',
     
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
        'transport' =>$transport,
        'output' => array(
            	array(
            		'element'  => '.top-social-icon li a',
            		'property' => 'color',
            	)
    	),
));

 Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'head_social_icon_hvr_color',
        'label'       => __( 'Icon Hover Color', 'mayosis-core' ),
        'section'     => 'follow',
        'priority'    => 10,
        'default'     => '#3d3d3d',
     
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
        'transport' =>$transport,
        'output' => array(
            	array(
            		'element'  => '.top-social-icon li a:hover',
            		'property' => 'color',
            	)
    	),
));

 Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimension',
	'settings'    => 'head_social_icon_size',
	'label'       => esc_html__( 'Icon Size', 'kirki' ),
	'section'     => 'follow',
	'default'     => '12px',
	'transport' =>$transport,
        'output' => array(
            	array(
            		'element'  => '.top-social-icon li a',
            		'property' => 'font-size',
            	)
    	),
] );