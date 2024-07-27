<?php

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'popup_bg_main',
        'label'       => __( 'Popup Background Color', 'mayosis-core' ),
        'description' => __( 'Change site popup background color', 'mayosis-core' ),
        'section'     => 'popup_style',
        'priority'    => 10,
        'default'     => '#ffffff',
        'transport' =>$transport,
        'output' => array(
            	array(
            		'element'  => '#authormessage, #authormessagelogin, #mayosis_variable_price, #mayosis_vendorcontact, #userloginbox,.modal-content',
            		'property' => 'background',
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
        'settings'     => 'popup_bg_main_text',
        'label'       => __( 'Popup Text Color', 'mayosis-core' ),
        'description' => __( 'Change site popup text color', 'mayosis-core' ),
        'section'     => 'popup_style',
        'priority'    => 10,
        'default'     => '#28375a',
        'transport' =>$transport,
        'output' => array(
            	array(
            		'element'  => '#authormessage, #authormessagelogin, #mayosis_variable_price, #mayosis_vendorcontact, #userloginbox,#mayosis_variable_price .edd_download_purchase_form .edd_price_options li,
            		#mayosis_variable_price .edd_download_purchase_form .edd_price_options li label,
            		#mayosis_variable_price h1,#mayosis_variable_price h2,#mayosis_variable_price h3, #mayosis_variable_price h4,
            		#userloginbox h4, #userloginbox p,#userloginbox p a,#userloginbox p label, #userloginbox p label span,.modal,
            		.modal p,.modal h1,.modal h2,.modal h3 ,.modal h4, .modal h5, .modal h6,.modal label',
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

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'popup_radius_main',
	'label'       => esc_html__( 'Popup Border Radius', 'mayosis-core' ),
	'description' => esc_html__( 'add radius here', 'mayosis-core' ),
	'section'     => 'popup_style',
	'default'     => [
		'top-left-radius'    => '3px',
		'top-right-radius'    => '3px',
		'bottom-left-radius'    => '3px',
		'bottom-right-radius'    => '3px',
	],
	'output' => array(
            	array(
            		'element'  => '#authormessage, #authormessagelogin, #mayosis_variable_price, #mayosis_vendorcontact, #userloginbox,
            		.modal-content',
            		'property' => 'border',
            	),
    	),
] );