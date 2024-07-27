<?php

Mayosis_Option::add_section( 'header_login', array(
	'title'       => __( 'Account Options', 'mayosis-core' ),
	'panel'       => 'header',
) );


Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
	'settings'    => 'login_logout_bg_remove',
	'label'       => __( 'Login/Logout Button Background Remove', 'mayosis-core' ),
	'section'     => 'header_login',
	'default'     => 'notremove',
	'priority'    => 10,
	'choices'     => array(
		'remove'   => esc_attr__( 'On', 'mayosis-core' ),
		'notremove' => esc_attr__( 'Off', 'mayosis-core' ),
	),
));
 
 Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'radio-buttonset',
	'settings'    => 'login_popup_enable',
	'label'       => __( 'Login Popup', 'mayosis-core' ),
	'section'     => 'header_login',
	'default'     => 'disable',
	'priority'    => 10,
	'choices'     => array(
		'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
		'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
	),
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'     => 'text',
'settings' => 'login_url',
'label'    => __( 'Login Link', 'mayosis-core' ),
'section'  => 'header_login',
'default'  => esc_attr__( '/login', 'mayosis-core' ),
'priority' => 10,
'required'    => array(
            array(
                'setting'  => 'login_popup_enable',
                'operator' => '==',
                'value'    => 'disable',
            ),

        ),
 ));
 Mayosis_Option::add_field( 'mayo_config',  array(
'type'     => 'text',
'settings' => 'login_text',
'label'    => __( 'Login Button Text', 'mayosis-core' ),
'section'  => 'header_login',
'default'  => esc_attr__( 'Login', 'mayosis-core' ),
'priority' => 10,
 ));
 
 Mayosis_Option::add_field( 'mayo_config',  array(
'type'     => 'text',
'settings' => 'logout_text',
'label'    => __( 'Logout Button Text', 'mayosis-core' ),
'section'  => 'header_login',
'default'  => esc_attr__( 'Logout', 'mayosis-core' ),
'priority' => 10,
 ));
 
 Mayosis_Option::add_field( 'mayo_config',  array(
'type'     => 'text',
'settings' => 'register_url',
'label'    => __( 'Register Link', 'mayosis-core' ),
'section'  => 'header_login',
'default'  => esc_attr__( '/register', 'mayosis-core' ),
'priority' => 10,

        'required'    => array(
            array(
                'setting'  => 'login_popup_enable',
                'operator' => '==',
                'value'    => 'enable',
            ),

        ),
 ));
 Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'color',
'settings'     => 'acc_border_color',
'label'       => __( 'Account Border Color', 'mayosis-core' ),
'description' => __( 'Change border Color', 'mayosis-core' ),
'section'     => 'header_login',
'priority'    => 10,
'default'     => '#29293e', 
'output' => array(
        array(
            'element'  => '.mayosis-logout-information,.msv-wallet-value',
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
'settings'     => 'acc_header_text',
'label'       => __( 'Account all Text & Link Color', 'mayosis-core' ),
'description' => __( 'Change text & link Color', 'mayosis-core' ),
'section'     => 'header_login',
'priority'    => 10,
'default'     => '#fff', 
'output' => array(
        array(
            'element'  => '.mayosis-account-user-information,
            .mayosis-logout-information > a.mayosis-logout-link,
.header-top .mayosis-logout-information > a.mayosis-logout-link,
.mayosis-logout-information > a.mayosis-logout-link i,
.header-top .mayosis-logout-information > a.mayosis-logout-link i,
.dropdown-menu.my-account-list a,.dropdown-menu.my-account-list li a,
.dropdown-menu.my-account-list a i,.msv-wallet-value',
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

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'acc_user_image_border_radius',
	'label'       => esc_html__( 'User Image Border Radius', 'mayosis-core' ),
	'description' => esc_html__( 'add border-radius.', 'mayosis-core' ),
	'section'     => 'header_login',
	'default'     => [
		'top-left-radius'    => '0',
		'top-right-radius' => '0',
		'bottom-left-radius'   => '0',
		'bottom-right-radius'  => '0',
	],
	'output' => array(
	    array(
	     'element' =>".mayosis-account-user-information img",
	     'property'    => 'border',
	     ),
	    ),
] );


 Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'color',
'settings'     => 'mbacc_bg_color',
'label'       => __( 'Mobile Account Menu Bar Bg Color', 'mayosis-core' ),
'description' => __( 'Change background Color', 'mayosis-core' ),
'section'     => 'header_login',
'priority'    => 10,
'default'     => '#29293e', 
'output' => array(
        array(
            'element'  => '.msv-mobile-pop-account .btn,.msv-mob-login-menu a',
            'property' => 'background',
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
'settings'     => 'mbacc_txt_color',
'label'       => __( 'Mobile Account Menu Bar Text Color', 'mayosis-core' ),
'description' => __( 'Change Text Color', 'mayosis-core' ),
'section'     => 'header_login',
'priority'    => 10,
'default'     => '#fff', 
'output' => array(
        array(
            'element'  => '.msv-mobile-pop-account .btn,.msv-mob-login-menu a',
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

 Mayosis_Option::add_field( 'mayo_config', array(
'type'        => 'color',
'settings'     => 'mbacc_ppbg_color',
'label'       => __( 'Mobile Account Popup Bar Bg Color', 'mayosis-core' ),
'description' => __( 'Change background Color', 'mayosis-core' ),
'section'     => 'header_login',
'priority'    => 10,
'default'     => '#29293e', 
'output' => array(
        array(
            'element'  => '.msv-mobile-pop-account .dropdown-menu',
            'property' => 'background',
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
'settings'     => 'mbacc_pptxt_color',
'label'       => __( 'Mobile Account Popup Bar Text Color', 'mayosis-core' ),
'description' => __( 'Change text Color', 'mayosis-core' ),
'section'     => 'header_login',
'priority'    => 10,
'default'     => '#ffffff', 
'output' => array(
        array(
            'element'  => '.msv-mobile-pop-account .dropdown-menu,.msv-mobile-pop-account .dropdown-menu a',
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
