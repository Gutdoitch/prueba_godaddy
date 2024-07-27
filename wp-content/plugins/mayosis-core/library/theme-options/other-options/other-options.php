<?php
Mayosis_Option::add_panel( 'other_options_extra', array(
	'title'       => __( 'Other Options', 'mayosis-core' ),
	'description' => __( 'Mayosis Other Options.', 'mayosis-core' ),
	'priority' => '9',
) );

Mayosis_Option::add_section( 'social_options_all', array(
	'title'       => __( 'Social Options', 'mayosis-core' ),
	'panel'       => 'other_options_extra',

) );

Mayosis_Option::add_section( 'disable_extra_features', array(
	'title'       => __( 'Advanced Features', 'mayosis-core' ),
	'panel'       => 'other_options_extra',

) );

Mayosis_Option::add_section( 'sticky_notification_bar', array(
	'title'       => __( 'Sticky Notification Bar', 'mayosis-core' ),
	'panel'       => 'other_options_extra',

) );
Mayosis_Option::add_section( 'sticky_product_bar', array(
	'title'       => __( 'Sticky Add To Cart Bar', 'mayosis-core' ),
	'panel'       => 'other_options_extra',

) );

Mayosis_Option::add_section( 'mayosis_translation', array(
	'title'       => __( 'String Translation', 'mayosis-core' ),
	'panel'       => 'other_options_extra',

) );



Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'facebook_url',
	'label'    => __( 'Facebook URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://facebook.com/',
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'twitter_url',
	'label'    => __( 'Twitter URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://twitter.com/',
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'instagram_url',
	'label'    => __( 'Instagram URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://instagram.com/',
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'pinterest_url',
	'label'    => __( 'Pinterest URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://pinterest.com/',
));


Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'youtube_url',
	'label'    => __( 'Youtube URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://youtube.com/',
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'linkedin_url',
	'label'    => __( 'Linked In URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://linkedin.com/',
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'github_url',
	'label'    => __( 'Github URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://github.io/',
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'slack_url',
	'label'    => __( 'Slack URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://slack.com/',
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'envato_url',
	'label'    => __( 'Envato URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://envato.com/',
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'behance_url',
	'label'    => __( 'Behance URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://behance.com/',
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'dribbble_url',
	'label'    => __( 'Dribbble URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://dribble.com/',
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'vimeo_url',
	'label'    => __( 'Vimeo URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://vimeo.com/',
));

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'     => 'link',
	'settings' => 'spotify_url',
	'label'    => __( 'Spotify URL', 'mayosis-core' ),
	'section'  => 'social_options_all',
	'default'  => 'https://spotify.com/',
));

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'disable_hit_count',
	'label'       => esc_html__( 'Disable Page View Counter', 'mayosis-core' ),
	'section'     => 'disable_extra_features',
	'default'     => 'show',
	'priority'    => 10,
	'choices'     => [
		'show'   => esc_html__( 'Enable', 'mayosis-core' ),
		'hide' => esc_html__( 'Disable', 'mayosis-core' ),
	],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'disable_font_awesome',
	'label'       => esc_html__( 'Enable/Disable Font Awesome 5', 'mayosis-core' ),
	'section'     => 'disable_extra_features',
	'default'     => 'hide',
	'priority'    => 10,
	'choices'     => [
		'show'   => esc_html__( 'Enable', 'mayosis-core' ),
		'hide' => esc_html__( 'Disable', 'mayosis-core' ),
	],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'disable_google_fonts',
	'label'       => esc_html__( 'Enable/Disable Google Fonts', 'mayosis-core' ),
	'section'     => 'disable_extra_features',
	'default'     => 'show',
	'priority'    => 10,
	'choices'     => [
		'show'   => esc_html__( 'Enable', 'mayosis-core' ),
		'hide' => esc_html__( 'Disable', 'mayosis-core' ),
	],
] );


Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'disable_extra_js',
	'label'       => esc_html__( 'Enable/Disable Extra JS Files', 'mayosis-core' ),
	'section'     => 'disable_extra_features',
	'default'     => 'hide',
	'priority'    => 10,
	'choices'     => [
		'show'   => esc_html__( 'Enable', 'mayosis-core' ),
		'hide' => esc_html__( 'Disable', 'mayosis-core' ),
	],
] );


Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'disable_anim_js',
	'label'       => esc_html__( 'Enable/Disable Animation JS Files', 'mayosis-core' ),
	'section'     => 'disable_extra_features',
	'default'     => 'hide',
	'priority'    => 10,
	'choices'     => [
		'show'   => esc_html__( 'Enable', 'mayosis-core' ),
		'hide' => esc_html__( 'Disable', 'mayosis-core' ),
	],
] );


Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'enable_dbl_filter',
	'label'       => esc_html__( 'Enable/Disable Product Filter', 'mayosis-core' ),
	'section'     => 'disable_extra_features',
	'default'     => 'hide',
	'priority'    => 10,
	'choices'     => [
		'show'   => esc_html__( 'Enable', 'mayosis-core' ),
		'hide' => esc_html__( 'Disable', 'mayosis-core' ),
	],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'edd_registration_email_login_url',
	'label'       => esc_html__( 'EDD Welcome Email Login Link', 'mayosis-core' ),
	'section'     => 'disable_extra_features',
	'default'     => 'hide',
	'priority'    => 10,
	'choices'     => [
		'show'   => esc_html__( 'Change', 'mayosis-core' ),
		'hide' => esc_html__( 'Default', 'mayosis-core' ),
	],
] );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'select',
    'settings' => 'select_reg_page_link',
    'label'    => esc_html__( 'Select Login Page', 'kirki' ),
    'section'  => 'disable_extra_features',
    'transport' =>'auto',
    'priority' => 10,
    'multiple' => 1,
    'choices'  => mayosis_get_posts(
        array(
            'posts_per_page' => -1,
            'post_type'      => 'page'
        )
    ),

    'required'    => array(
        array(
            'setting'  => 'edd_registration_email_login_url',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),
) );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'enable_notification_bar',
	'label'       => esc_html__( 'Enable Sticky Notificaion Bar', 'mayosis-core' ),
	'section'     => 'sticky_notification_bar',
	'default'     => 'hide',
	'priority'    => 10,
	'choices'     => [
		'show'   => esc_html__( 'Enable', 'mayosis-core' ),
		'hide' => esc_html__( 'Disable', 'mayosis-core' ),
	],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'notification_bar_background_type',
	'label'       => esc_html__( 'Notificaion Bar Background Type', 'mayosis-core' ),
	'section'     => 'sticky_notification_bar',
	'default'     => 'standard',
	'priority'    => 10,
	'choices'     => [
		'standard'   => esc_html__( 'Standard', 'mayosis-core' ),
		'gradient' => esc_html__( 'Gradient', 'mayosis-core' ),
		'custom' => esc_html__( 'Custom', 'mayosis-core' ),
	],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'background',
	'settings'    => 'notification_bar_standard',
	'label'       => esc_html__( 'Color Options', 'mayosis-core' ),
	'description' => esc_html__( '', 'mayosis-core' ),
	'section'     => 'sticky_notification_bar',
	'default'     => [
		'background-color'      => '#483dba',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.mayosis-standard-bar',
		],
	],
	
	'required'    => array(
            array(
                'setting'  => 'notification_bar_background_type',
                'operator' => '==',
                'value'    => 'standard',
            ),
        ),
] );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'multicolor',
        'settings'    => 'sticky_bar_gradient',
        'label'       => esc_attr__( 'Sticky bar gradient', 'mayosis-core' ),
        'section'     => 'sticky_notification_bar',
        'priority'    => 10,
        'choices'     => array(
            'color1'    => esc_attr__( 'Form', 'mayosis-core' ),
            'color2'   => esc_attr__( 'To', 'mayosis-core' ),
        ),
        'default'     => array(
            'color1'    => '#1e0046',
            'color2'   => '#1e0064',
        ),
    'required'    => array(
            array(
                'setting'  => 'notification_bar_background_type',
                'operator' => '==',
                'value'    => 'gradient',
            ),
        ),
) );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'code',
	'settings'    => 'notification_custom_css',
	'label'       => esc_html__( 'Custom Css', 'mayosis-core' ),
	'description' => esc_html__( 'add custom css. you can add gradient code from gradienta.io', 'mayosis-core' ),
	'section'     => 'sticky_notification_bar',
	'default'     => '',
	'choices'     => [
		'language' => 'css',
	],
	'required'    => array(
            array(
                'setting'  => 'notification_bar_background_type',
                'operator' => '==',
                'value'    => 'custom',
            ),
        ),
] );


Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'color',
	'settings'    => 'notification_btn_bg_color',
	'label'       => __( 'Notification button background Color', 'mayosis-core' ),
	'section'     => 'sticky_notification_bar',
	'default'     => '#f6d937',
	'output'      => [
		[
			'element' => '.mayosis-sticky-bar-btn',
			'property' => 'background',
		],
	],
] );



Mayosis_Option::add_field( 'mayo_config', [
	'type'     => 'editor',
	'settings' => 'notification_text',
	'label'    => esc_html__( 'Notification Text', 'mayosis-core' ),
	'default'  => esc_html__( 'Get Big Discount For a Limited time', 'mayosis-core' ),
	'section'  => 'sticky_notification_bar',
	'priority' => 10,
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'typography',
	'settings'    => 'notification_text_typography',
	'label'       => esc_html__( 'Typography', 'kirki' ),
	'section'     => 'sticky_notification_bar',
	'default'     => [
		'font-family'    => 'Roboto',
		'variant'        => 'regular',
		'font-size'      => '16px',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'color'          => '#ffffff',
		'text-transform' => 'none',
		'text-align'     => 'center',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '#mayosis-sticky-bar,.mayosis-sticky-text',
		],
	],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'     => 'text',
	'settings' => 'notification_btn_text',
	'label'    => esc_html__( 'Button Text', 'mayosis-core' ),
	'default'  => esc_html__( 'Get the discount', 'mayosis-core' ),
	'section'  => 'sticky_notification_bar',
	'priority' => 10,
] );



Mayosis_Option::add_field( 'mayo_config', [
	'type'     => 'text',
	'settings' => 'notification_btn_url',
	'label'    => esc_html__( 'Button URL', 'mayosis-core' ),
	'default'  => esc_html__( '#', 'mayosis-core' ),
	'section'  => 'sticky_notification_bar',
	'priority' => 10,
] );
Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'typography',
	'settings'    => 'notification_btn_typography',
	'label'       => esc_html__( 'Button Typography', 'kirki' ),
	'section'     => 'sticky_notification_bar',
	'default'     => [
		'font-family'    => 'Roboto',
		'variant'        => 'regular',
		'font-size'      => '16px',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'color'          => '#28375a',
		'text-transform' => 'none',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.mayosis-sticky-bar-btn',
		],
	],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'noty_button_target',
	'label'       => esc_html__( 'Notificaion button target', 'mayosis-core' ),
	'section'     => 'sticky_notification_bar',
	'default'     => 'self',
	'priority'    => 10,
	'choices'     => [
		'blank'   => esc_html__( 'Blank', 'mayosis-core' ),
		'self' => esc_html__( 'self', 'mayosis-core' ),
	],
] );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'dimensions',
        'settings'    => 'pnotification_bar_padding',
        'label'       => esc_attr__( 'Notification Bar Pading', 'mayosis-core' ),
        'description' => esc_attr__( 'Change Notification Bar Padding', 'mayosis-core' ),
        'section'     => 'sticky_notification_bar',
        'default'     => array(
            'padding-top'    => '10px',
            'padding-bottom' => '10px',
            'padding-left'   => '0px',
            'padding-right'  => '0px',
        ),
    'output'      => [
		[
			'element' => '.howdydo-box',
		],
	],
) );

Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'dimensions',
        'settings'    => 'pnotification_button_padding',
        'label'       => esc_attr__( 'Notification Button Pading', 'mayosis-core' ),
        'description' => esc_attr__( 'Change Notification Button Padding', 'mayosis-core' ),
        'section'     => 'sticky_notification_bar',
        'default'     => array(
            'padding-top'    => '6px',
            'padding-bottom' => '6px',
            'padding-left'   => '12px',
            'padding-right'  => '12px',
        ),
    'output'      => [
		[
			'element' => '.mayosis-sticky-bar-btn',
		],
	],
) );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'dimensions',
	'settings'    => 'pnotification_button_radius',
	'section'     => 'sticky_notification_bar',
	'label'       => esc_attr__( 'Button Border Radius', 'mayosis-core' ),
	'default'     => [
		'top-left-radius'     => '3px',
		'top-right-radius'    => '3px',
		'bottom-left-radius'  => '3px',
		'bottom-right-radius' => '3px',
	],
	'choices'     => [
		'top-left-radius'     => esc_attr__( 'Top Left', 'mayosis-core' ),
		'top-right-radius'    => esc_attr__( 'Top Right', 'mayosis-core' ),
		'bottom-left-radius'  => esc_attr__( 'Bottom Left', 'mayosis-core' ),
		'bottom-right-radius' => esc_attr__( 'Bottom Right', 'mayosis-core' ),
	],
	'output'    => [
		[
			'property' => 'border',
			'element'  => '.mayosis-sticky-bar-btn',
		],
	]
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'     => 'date',
	'settings' => 'notification_btn_ddate',
	'label'    => esc_html__( 'Notification Counter Date', 'mayosis-core' ),
	'section'  => 'sticky_notification_bar',
	'priority' => 10,
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'color',
	'settings'    => 'notification_btn_ddate_bg',
	'label'       => __( 'Timer background Color', 'mayosis-core' ),
	'section'     => 'sticky_notification_bar',
	'default'     => '#ffffff',
	'output'      => [
		[
			'element' => '.mayosis-sticky-notification-timer .countdown .emerce-count-value',
			'property' => 'background',
		],
	],
] );
Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'color',
	'settings'    => 'notification_btn_ddate_txt',
	'label'       => __( 'Timer Text Color', 'mayosis-core' ),
	'section'     => 'sticky_notification_bar',
	'default'     => '#222',
	'output'      => [
		[
			'element' => '.mayosis-sticky-notification-timer .countdown .emerce-count-value',
			'property' => 'color',
		],
	],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'color',
	'settings'    => 'notification_btn_ddate_sept',
	'label'       => __( 'Separator Color', 'mayosis-core' ),
	'section'     => 'sticky_notification_bar',
	'default'     => '#fff',
	'output'      => [
		[
			'element' => '.mayosis-sticky-notification-timer .countdown .separator',
			'property' => 'color',
		],
	],
] );
/****
 * Sticky Add To Cart bar
 * 
 * ***/
 Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'enable_sticky_cart_bar',
	'label'       => esc_html__( 'Enable Sticky Cart Bar', 'mayosis-core' ),
	'section'     => 'sticky_product_bar',
	'default'     => 'hide',
	'priority'    => 10,
	'choices'     => [
		'show'   => esc_html__( 'Enable', 'mayosis-core' ),
		'hide' => esc_html__( 'Disable', 'mayosis-core' ),
	],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'radio-buttonset',
	'settings'    => 'sticky_cart_bar_background_type',
	'label'       => esc_html__( 'Cart Bar Background Type', 'mayosis-core' ),
	'section'     => 'sticky_product_bar',
	'default'     => 'standard',
	'priority'    => 10,
	'choices'     => [
		'standard'   => esc_html__( 'Standard', 'mayosis-core' ),
		'gradient' => esc_html__( 'Gradient', 'mayosis-core' ),
		'custom' => esc_html__( 'Custom', 'mayosis-core' ),
	],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'background',
	'settings'    => 'sticky_cart_bar_standard',
	'label'       => esc_html__( 'Color Options', 'mayosis-core' ),
	'description' => esc_html__( '', 'mayosis-core' ),
	'section'     => 'sticky_product_bar',
	'default'     => [
		'background-color'      => '#ffffff',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.mayosis-sticky-cart-standard#mayosis-sticky-cart-bar',
		],
	],
	
	'required'    => array(
            array(
                'setting'  => 'sticky_cart_bar_background_type',
                'operator' => '==',
                'value'    => 'standard',
            ),
        ),
] );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'multicolor',
        'settings'    => 'sticky_cart_bar_gradient',
        'label'       => esc_attr__( 'Sticky bar gradient', 'mayosis-core' ),
        'section'     => 'sticky_product_bar',
        'priority'    => 10,
        'choices'     => array(
            'color1'    => esc_attr__( 'Form', 'mayosis-core' ),
            'color2'   => esc_attr__( 'To', 'mayosis-core' ),
        ),
        'default'     => array(
            'color1'    => '#1e0046',
            'color2'   => '#1e0064',
        ),
    'required'    => array(
            array(
                'setting'  => 'sticky_cart_bar_background_type',
                'operator' => '==',
                'value'    => 'gradient',
            ),
        ),
) );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'code',
	'settings'    => 'stk_cart_custom_css',
	'label'       => esc_html__( 'Custom Css', 'mayosis-core' ),
	'description' => esc_html__( 'add custom css. you can add gradient code from gradienta.io', 'mayosis-core' ),
	'section'     => 'sticky_product_bar',
	'default'     => '',
	'choices'     => [
		'language' => 'css',
	],
	'required'    => array(
            array(
                'setting'  => 'sticky_cart_bar_background_type',
                'operator' => '==',
                'value'    => 'custom',
            ),
        ),
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'color',
	'settings'    => 'sk_cart_all_text',
	'label'       => __( 'Title Color', 'mayosis-core' ),
	'section'     => 'sticky_product_bar',
	'default'     => '#222',
	'output'      => [
		[
			'element' => '#mayosis-sticky-cart-bar h4',
			'property' => 'color',
		],
	],
] );
Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'color',
	'settings'    => 'sk_cart_prc_text',
	'label'       => __( 'Price Color', 'mayosis-core' ),
	'section'     => 'sticky_product_bar',
	'default'     => '#222',
	'output'      => [
		[
			'element' => '#mayosis-sticky-cart-bar .global-price-msc,#mayosis-sticky-cart-bar .price',
			'property' => 'color',
		],
	],
] );
Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'color',
	'settings'    => 'stk_cart_btn_bg_color',
	'label'       => __( 'Button background Color', 'mayosis-core' ),
	'section'     => 'sticky_product_bar',
	'default'     => '#222',
	'output'      => [
		[
			'element' => '#mayosis-sticky-cart-bar .multiple_button_v,
#mayosis-sticky-cart-bar .edd-submit,#mayosis-sticky-cart-bar .single_add_to_cart_button,#mayosis-sticky-cart-bar .multiple_button_v',
			'property' => 'background',
		],
	],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'color',
	'settings'    => 'stk_cart_btn_border_color',
	'label'       => __( 'Button Border Color', 'mayosis-core' ),
	'section'     => 'sticky_product_bar',
	'default'     => '#222',
	'output'      => [
		[
			'element' => '#mayosis-sticky-cart-bar .multiple_button_v,
#mayosis-sticky-cart-bar .edd-submit,#mayosis-sticky-cart-bar .single_add_to_cart_button,#mayosis-sticky-cart-bar .multiple_button_v',
			'property' => 'border-color',
		],
	],
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'color',
	'settings'    => 'stk_cart_btn_txt_color',
	'label'       => __( 'Button Text Color', 'mayosis-core' ),
	'section'     => 'sticky_product_bar',
	'default'     => '#fff',
	'output'      => [
		[
			'element' => '#mayosis-sticky-cart-bar .multiple_button_v,
#mayosis-sticky-cart-bar .edd-submit,#mayosis-sticky-cart-bar .single_add_to_cart_button,#mayosis-sticky-cart-bar .multiple_button_v',
			'property' => 'color',
		],
	],
] );



Mayosis_Option::add_field( 'mayo_config', [
	'type'     => 'editor',
	'settings' => 'stk_txt_text',
	'label'    => esc_html__( 'Title before Text', 'mayosis-core' ),
	'default'  => esc_html__( 'Youre Viewing', 'mayosis-core' ),
	'section'  => 'sticky_product_bar',
	'priority' => 10,
] );


/****
 * String Translation
 * 
 * ***/
 Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'text',
        'settings'    => 'empty_cart_title',
        'label'       => esc_attr__( 'Empty Cart Title', 'mayosis-core' ),
        'description' => esc_attr__( 'Change empty cart title', 'mayosis-core' ),
        'default'     => 'Your Cart is Empty',
        'section'     => 'mayosis_translation',
      
) );

 Mayosis_Option::add_field( 'mayo_config', array(
       'type'        => 'text',
        'settings'    => 'empty_cart_subtitle',
        'label'       => esc_attr__( 'Empty Cart Sub Title', 'mayosis-core' ),
        'description' => esc_attr__( 'Change empty cart Sub title', 'mayosis-core' ),
        'default'     => 'No Problem, Lets Start Browse',
        'section'     => 'mayosis_translation',
      
) );
 