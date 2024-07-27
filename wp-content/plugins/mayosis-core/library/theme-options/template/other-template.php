<?php
Mayosis_Option::add_panel( 'mayosis_other_template', array(
    'title'       => __( 'Other Template', 'mayosis-core' ),
    'description' => __( 'Mayosis Other Template', 'mayosis-core' ),
    'priority' => '9',
) );

Mayosis_Option::add_section( 'blog_template', array(
    'title'       => __( 'Blog Template', 'mayosis-core' ),
    'panel'       => 'mayosis_other_template',

) );

Mayosis_Option::add_section( 'page_template', array(
    'title'       => __( 'Page Template', 'mayosis-core' ),
    'panel'       => 'mayosis_other_template',

) );

Mayosis_Option::add_section( 'dashboard_template', array(
    'title'       => __( 'Dashboard Template', 'mayosis-core' ),
    'panel'       => 'mayosis_other_template',

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
    'settings'    => 'post_content_font_family',
    'label'       => esc_attr__( 'Post Content Typography', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => array(
        'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
        'variant'        => '400',
        'font-size'      => '1.125rem',
        'line-height'    => '1.75',
        'letter-spacing'    => '0',


    ),
    'priority'    => 10,

   

    'transport' => 'auto',
    'output'    => array(
        array(
            'element' => '.single-post-block,.single-post-block p',
        ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'blog_featured_visibility',
    'label'       => __( 'Blog Featured Image Visibility', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => 'show',
    'priority'    => 10,
    'choices'     => array(
        'show'   => esc_attr__( 'Show', 'mayosis-core' ),
        'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
    ),

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'featured_position_blog',
    'label'       => __( 'Blog Featured Image Position', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => 'left',
    'priority'    => 10,
    'choices'     => array(
        'left'   => esc_attr__( 'Left', 'mayosis-core' ),
        'right' => esc_attr__( 'Right', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'blog_header_content_position',
    'label'       => __( 'Blog Header Content Position', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => 'left',
    'priority'    => 10,
    'multiple'    => 1,
    'choices'     => array(
        'left' => esc_attr__( 'Left', 'mayosis-core' ),
        'center' => esc_attr__( 'Center', 'mayosis-core' ),
        'right' => esc_attr__( 'Right', 'mayosis-core' ),

    ),

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'blog_bg_type',
    'label'       => __( 'Blog Breadcrumb Background Type', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => 'gradient',
    'priority'    => 10,
    'choices'     => array(
        'color'  => esc_attr__( 'Color', 'mayosis-core' ),
        'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
        'image' => esc_attr__( 'Image', 'mayosis-core' ),
        'featured' => esc_attr__( 'Featured Image', 'mayosis-core' ),
        'custom' => esc_attr__( 'Custom', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'blog_background',
    'label'       => __( 'Breadcrumb Background Color', 'mayosis-core' ),
    'description' => __( 'Set Breadcrumb Background color', 'mayosis-core' ),
    'section'     => 'blog_template',
    'priority'    => 10,
    'default'     => '#282837',
    'required'    => array(
        array(
            'setting'  => 'blog_bg_type',
            'operator' => '==',
            'value'    => 'color',
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

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'multicolor',
    'settings'    => 'blog_gradient',
    'label'       => esc_attr__( 'Breadcrumb gradient', 'mayosis-core' ),
    'section'     => 'blog_template',
    'priority'    => 10,
    'required'    => array(
        array(
            'setting'  => 'blog_bg_type',
            'operator' => '==',
            'value'    => 'gradient',
        ),
    ),
    'choices'     => array(
        'color1'    => esc_attr__( 'Form', 'mayosis-core' ),
        'color2'   => esc_attr__( 'To', 'mayosis-core' ),
    ),
    'default'     => array(
        'color1'    => '#1e0046',
        'color2'   => '#1e0064',
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'image',
    'settings'    => 'blog_bg_image',
    'label'       => esc_attr__( 'Breadcrumb Background Image', 'mayosis-core' ),
    'description' => esc_attr__( 'Upload Product/Blog background image', 'mayosis-core' ),
    'section'     => 'blog_template',
    'required'    => array(
        array(
            'setting'  => 'blog_bg_type',
            'operator' => '==',
            'value'    => 'image',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'blog_bg_image_repeat',
    'label'       => __( 'Image Repeat', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => 'repeat',
    'priority'    => 10,
    'choices'     => array(
        'repeat'  => esc_attr__( 'Repeat', 'mayosis-core' ),
        'cover' => esc_attr__( 'Cover', 'mayosis-core' ),

    ),
    'required'    => array(
        array(
            'setting'  => 'blog_bg_type',
            'operator' => '==',
            'value'    => 'image',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'text',
    'settings' => 'main_blog_blur',
    'label'    => __( 'Blur Radius', 'mayosis-core' ),
    'section'  => 'blog_template',
    'default'  => esc_attr__( '5px', 'mayosis-core' ),
    'priority' => 10,
    'required'    => array(
        array(
            'setting'  => 'blog_bg_type',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'blog_ovarlay_main',
    'label'       => __( 'Overlay Color', 'mayosis-core' ),
    'description' => __( 'Change  Overlay Color', 'mayosis-core' ),
    'section'     => 'blog_template',
    'priority'    => 10,
    'default'     => 'rgb(40,40,50,.5)',
    'choices'     => array(
        'alpha' => true,
    ),

    'required'    => array(
        array(
            'setting'  => 'blog_bg_type',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'parallax_featured_image_blog',
    'label'       => __( 'Featured Image Parallax', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => 'no',
    'priority'    => 10,
    'choices'     => array(
        'yes'   => esc_attr__( 'Yes', 'mayosis-core' ),
        'no' => esc_attr__( 'No', 'mayosis-core' ),
    ),

    'required'    => array(
        array(
            'setting'  => 'blog_bg_type',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'code',
    'settings'    => 'blog_custom_css',
    'label'       => esc_html__( 'Custom Css', 'mayosis-core' ),
    'description' => esc_html__( 'add custom css. you can add gradient code from gradienta.io', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => '',
    'choices'     => [
        'language' => 'css',
    ],
    'required'    => array(
        array(
            'setting'  => 'blog_bg_type',
            'operator' => '==',
            'value'    => 'custom',
        ),
    ),
] );

Mayosis_Option::add_field( 'mayo_config', array(
        'type'        => 'color',
        'settings'     => 'sp_breadcrumb_content_color',
        'label'       => __( 'Breadcrumb Text Color', 'mayosis-core' ),
        'description' => __( 'Change Breadcrumb Text Color', 'mayosis-core' ),
        'section'     => 'blog_template',
        'priority'    => 10,
        'default'     => '#fff',
        'output' => array(
            	array(
            		'element'  => '.main-post-promo h1.single-post-title,.main-post-promo .single--post--content a,
            		.main-post-promo .single-user-info ul li.datearchive,.main-post-promo .single-post-breadcrumbs .breadcrumb a,
            		.main-post-promo .single-user-info ul li a,.main-post-promo.main-blog-promo h1,
            		.main-post-promo .breadcrumb a, .main-post-promo .breadcrumb span,
            		.main-post-promo .blog--layout--contents a,
            		.main-post-promo .datearchive,
            		.main-post-promo .blog--layout--contents,
            		.single--post--header--content .toolspan,
            		.mayosis-global-breadcrumb-style .page_title_single',
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
    'type'        => 'image',
    'settings'    => 'blog_overlay_image',
    'label'       => esc_attr__( 'Blog Overlay Image', 'mayosis-core' ),
    'description' => esc_attr__( 'Upload product background image', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => '',

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'sortable',
    'settings'    => 'blog_content_layout_manager',
    'label'       => __( 'Blog Content Layout Manager', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => array(
        'breadcrumb',
        'title',
        'category',
        'date',
    ),
    'choices'     => array(
        'breadcrumb' => esc_attr__( 'Breadcrumb', 'mayosis-core' ),
        'title' => esc_attr__( 'Title', 'mayosis-core' ),
        'author' => esc_attr__( 'Author', 'mayosis-core' ),
        'category' => esc_attr__( 'Category', 'mayosis-core' ),
        'date' => esc_attr__( 'Date', 'mayosis-core' ),
    ),

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'author_single_post',
    'label'       => __( 'Blog Author Box In Single Post', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => 'hide',
    'priority'    => 10,
    'choices'     => array(
        'on'   => esc_attr__( 'Show', 'mayosis-core' ),
        'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
    ),

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'blog_sidebar_remove',
    'label'       => __( 'Blog Sidebar Hide', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => 'hide',
    'priority'    => 10,
    'choices'     => array(
        'on'   => esc_attr__( 'Show', 'mayosis-core' ),
        'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'blog_bottom_widget',
    'label'       => __( 'Related Post & Products', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'   => esc_attr__( 'Show', 'mayosis-core' ),
        'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'blog_comment_size',
    'label'       => __( 'Blog Comment', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => 'two',
    'priority'    => 10,
    'choices'     => array(
        'one'   => esc_attr__( 'Full Width', 'mayosis-core' ),
        'two' => esc_attr__( 'With Sidebar', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'blog_archive_post_style',
    'label'       => __( 'Blog Archive Post Style', 'mayosis-core' ),
    'section'     => 'blog_template',
    'default'     => 'both',
    'priority'    => 10,
    'choices'     => array(
        'list'   => esc_attr__( 'List', 'mayosis-core' ),
        'grid' => esc_attr__( 'Grid', 'mayosis-core' ),
        'both' => esc_attr__( 'Both', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'page_bredcrumb_content_position',
    'label'       => __( 'Page Bredcrumb Content Position', 'mayosis-core' ),
    'section'     => 'page_template',
    'default'     => 'center',
    'priority'    => 10,
    'multiple'    => 1,
    'choices'     => array(
        'left' => esc_attr__( 'Left', 'mayosis-core' ),
        'center' => esc_attr__( 'Center', 'mayosis-core' ),
        'right' => esc_attr__( 'Right', 'mayosis-core' ),

    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'background_page',
    'label'       => __( 'Background', 'mayosis-core' ),
    'section'     => 'page_template',
    'default'     => 'color',
    'priority'    => 10,
    'multiple'    => 1,
    'choices'     => array(
        'color' => esc_attr__( 'Color', 'mayosis-core' ),
        'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
        'image' => esc_attr__( 'Image', 'mayosis-core' ),
        'custom' => esc_attr__( 'Custom', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'page_bg_default',
    'label'       => __( 'Background Color', 'mayosis-core' ),
    'description' => __( 'Change  Backgrounnd Color', 'mayosis-core' ),
    'section'     => 'page_template',
    'priority'    => 10,
    'default'     => '#460082',
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

    'required'    => array(
        array(
            'setting'  => 'background_page',
            'operator' => '==',
            'value'    => 'color',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'page_txt_default',
    'label'       => __( 'Text Color', 'mayosis-core' ),
    'description' => __( 'Change  Backgrounnd text Color', 'mayosis-core' ),
    'section'     => 'page_template',
    'priority'    => 10,
    'default'     => '#ffffff',
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

    'output' => array(
        array(
            'element'  => '.mayosis-global-breadcrumb-style h1.page_title_single,
            		.mayosis-global-breadcrumb-style .breadcrumb a,.mayosis-global-breadcrumb-style .breadcrumb .active,.common-page-breadcrumb.page_breadcrumb .page_title_single,.common-page-breadcrumb.page_breadcrumb a,.common-page-breadcrumb.page_breadcrumb .breadcrumb .active',
            'property' => 'color',
        ),
    )

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'multicolor',
    'settings'    => 'page_gradient_default',
    'label'       => esc_attr__( 'Product gradient', 'mayosis-core' ),
    'section'     => 'page_template',
    'priority'    => 10,
    'required'    => array(
        array(
            'setting'  => 'background_page',
            'operator' => '==',
            'value'    => 'gradient',
        ),
    ),
    'choices'     => array(
        'color1'    => esc_attr__( 'Form', 'mayosis-core' ),
        'color2'   => esc_attr__( 'To', 'mayosis-core' ),
    ),
    'default'     => array(
        'color1'    => '#1e0046',
        'color2'   => '#1e0064',
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'text',
    'settings' => 'gradient_angle_page',
    'label'    => __( 'Angle', 'mayosis-core' ),
    'section'  => 'page_template',
    'default'  => esc_attr__( '135', 'mayosis-core' ),
    'priority' => 10,
    'required'    => array(
        array(
            'setting'  => 'background_page',
            'operator' => '==',
            'value'    => 'gradient',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'image',
    'settings'    => 'page-main-bg',
    'label'       => esc_attr__( 'Page Background Image', 'mayosis-core' ),
    'description' => esc_attr__( 'Custom Image.', 'mayosis-core' ),
    'section'     => 'page_template',
    'required'    => array(
        array(
            'setting'  => 'background_page',
            'operator' => '==',
            'value'    => 'image',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'code',
    'settings'    => 'page_custom_css',
    'label'       => esc_html__( 'Custom Css', 'mayosis-core' ),
    'description' => esc_html__( 'add custom css. you can add gradient code from gradienta.io', 'mayosis-core' ),
    'section'     => 'page_template',
    'default'     => '',
    'choices'     => [
        'language' => 'css',
    ],
    'required'    => array(
        array(
            'setting'  => 'background_page',
            'operator' => '==',
            'value'    => 'custom',
        ),
    ),
] );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'image',
    'settings'    => 'page_overlay_image',
    'label'       => esc_attr__( 'Page Breadcrumb Overlay Image', 'mayosis-core' ),
    'description' => esc_attr__( 'Upload page overlay image', 'mayosis-core' ),
    'section'     => 'page_template',
    'default'     => '',

) );
Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'dimensions',
    'settings'    => 'page_padding',
    'label'       => esc_attr__( 'Page Breadcrumb Padding', 'mayosis-core' ),
    'description' => esc_attr__( 'Change Breadcrumb Padding', 'mayosis-core' ),
    'section'     => 'page_template',
    'default'     => array(
        'padding-top'    => '80px',
        'padding-bottom' => '80px',
        'padding-left'   => '0px',
        'padding-right'  => '0px',
    ),
));
if (class_exists('Easy_Digital_Downloads')){
Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'image',
    'settings'     => 'login_page_logo',
    'label'       => __( 'Dasboard Login Logo', 'mayosis-core' ),
    'description' => __( 'Upload 2X Logo for retina & use size from below.', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'default'     => get_template_directory_uri().'/images/logo.png',
    'transport' => 'auto',
));

Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'image',
    'settings'     => 'dash_inner_logo',
    'label'       => __( 'Dasboard Inner Logo', 'mayosis-core' ),
    'description' => __( 'Upload 2X Logo for retina & use size from below.', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'default'     => get_template_directory_uri().'/images/logo.png',
    'transport' => 'auto',
));

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'sortable',
    'settings'    => 'dashboard_menu_items',
    'label'       => esc_html__( 'Dashboard Menus', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'default'     => [
        'profile',
        'purchase',
        'download',
        'access',
        'followed',
        'follower',
        'following',
        'subscription',
        'vendor'
    ],
    'choices'     => [
        'profile' => esc_html__( 'Profile', 'mayosis-core' ),
        'purchase' => esc_html__( 'Purchase History', 'mayosis-core' ),
        'download' => esc_html__( 'Download History', 'mayosis-core' ),
        'discount' => esc_html__( 'Discount', 'mayosis-core' ),
        'followed' => esc_html__( 'Followed Items', 'mayosis-core' ),
        'follower' => esc_html__( 'Followers', 'mayosis-core' ),
        'following' => esc_html__( 'Following', 'mayosis-core' ),
        'access' => esc_html__( 'Access Pass', 'mayosis-core' ),
        'subscription' => esc_html__( 'Subscription', 'mayosis-core' ),
        'vendor' => esc_html__( 'Become Vendor', 'mayosis-core' ),

    ],
    'priority'    => 10,
] );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'sortable',
    'settings'    => 'vendor_purchase_box_item',
    'label'       => esc_html__( 'Vendor Purchase Menu Items', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'default'     => [
        'purchase',
        'download',
        
    ],
    'choices'     => [
        'purchase' => esc_html__( 'Purchase History', 'mayosis-core' ),
        'download' => esc_html__( 'Download History', 'mayosis-core' ),
        

    ],
    'priority'    => 10,
] );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_cover_bg_color',
    'label'       => __( 'Cover Background Color', 'mayosis-core' ),
    'description' => __( 'Change  Backgrounnd  Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#1e0050',
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

    'output' => array(
        array(
            'element'  => '.single-author--cover',
            'property' => 'background',
        ),
    )

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_db_top_part',
    'label'       => __( 'Top Part Background Color', 'mayosis-core' ),
    'description' => __( 'Change Top Part Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#e9edf7',
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

    'output' => array(
        array(
            'element'  => '.single--author--content',
            'property' => 'background',
        ),
    )

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_db_top_part_text',
    'label'       => __( 'Top Part Text Color', 'mayosis-core' ),
    'description' => __( 'Change Top Part Text Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#28375a',
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

    'output' => array(
        array(
            'element'  => '.single--author--content, .single--author--content a, .single--author--content h1, .single--author--content h2, .single--author--content h3,
            		.single--author--content h4, .single--author--content h5, .single--author--content h6, .single--author--content p',
            'property' => 'color',
        ),
    )

) );

Mayosis_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'vd_contact_btn_title',
		'label'    => __( '', 'mayosis-core' ),
		'section'  => 'dashboard_template',
		'default'  => '<div class="options-title">Contact Button</div>',
	)
);
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_cb_bg_color',
    'label'       => __( 'Background Color', 'mayosis-core' ),
    'description' => __( 'Change Contact button Background Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => 'rgb(31 0 70 / 0%)',
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

    'output' => array(
        array(
            'element'  => '.author--box--btn .contact--au--btn a',
            'property' => 'background',
        ),
    ),


) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_cb_border_color',
    'label'       => __( 'Border Color', 'mayosis-core' ),
    'description' => __( 'Change Contact button Border Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#28375a',
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

    'output' => array(
        array(
            'element'  => '.author--box--btn .contact--au--btn a',
            'property' => 'border-color',
        ),
    ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_cb_text_color',
    'label'       => __( 'Text Color', 'mayosis-core' ),
    'description' => __( 'Change Contact button Text Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#28375a',
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

    'output' => array(
        array(
            'element'  => '.author--box--btn .contact--au--btn a',
            'property' => 'color',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_cb_bghv_color',
    'label'       => __( 'Background Hover Color', 'mayosis-core' ),
    'description' => __( 'Change Contact button Background Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#28375a',
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

    'output' => array(
        array(
            'element'  => '.author--box--btn .contact--au--btn a:hover',
            'property' => 'background',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_cb_borderhv_color',
    'label'       => __( 'Border Hover Color', 'mayosis-core' ),
    'description' => __( 'Change Contact button Border Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#28375a',
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

    'output' => array(
        array(
            'element'  => '.author--box--btn .contact--au--btn a:hover',
            'property' => 'border-color',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_cb_texthv_color',
    'label'       => __( 'Text Hover Color', 'mayosis-core' ),
    'description' => __( 'Change Contact button Text Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#ffffff',
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

    'output' => array(
        array(
            'element'  => '.author--box--btn .contact--au--btn a:hover',
            'property' => 'color',
        ),
    ),

) );

Mayosis_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'vd_follow_btn_title',
		'label'    => __( '', 'mayosis-core' ),
		'section'  => 'dashboard_template',
		'default'  => '<div class="options-title">Follow Button</div>',
	)
);

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_fl_bg_color',
    'label'       => __( 'Background Color', 'mayosis-core' ),
    'description' => __( 'Change Follow button Background Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => 'rgb(31 0 70 / 0%)',
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

    'output' => array(
        array(
            'element'  => '.follow--au--btn a',
            'property' => 'background',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_fl_border_color',
    'label'       => __( 'Border Color', 'mayosis-core' ),
    'description' => __( 'Change Follow button Border Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#28375a',
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

    'output' => array(
        array(
            'element'  => '.follow--au--btn a',
            'property' => 'border-color',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_fl_text_color',
    'label'       => __( 'Text Color', 'mayosis-core' ),
    'description' => __( 'Change Follow button Text Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#28375a',
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

    'output' => array(
        array(
            'element'  => '.follow--au--btn a',
            'property' => 'color',
        ),
    ),


) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_fl_bghv_color',
    'label'       => __( 'Background Hover Color', 'mayosis-core' ),
    'description' => __( 'Change Follow button Background Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#28375a',
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

    'output' => array(
        array(
            'element'  => '.follow--au--btn a:hover',
            'property' => 'background',
        ),
    ),


) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_fl_borderhv_color',
    'label'       => __( 'Border Hover Color', 'mayosis-core' ),
    'description' => __( 'Change Follow button Border Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#28375a',
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

    'output' => array(
        array(
            'element'  => '.follow--au--btn a:hover',
            'property' => 'border-color',
        ),
    ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'vendor_fl_texthv_color',
    'label'       => __( 'Text Hover Color', 'mayosis-core' ),
    'description' => __( 'Change Follow button Text Color', 'mayosis-core' ),
    'section'     => 'dashboard_template',
    'priority'    => 10,
    'default'     => '#ffffff',
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

    'output' => array(
        array(
            'element'  => '.follow--au--btn a:hover',
            'property' => 'color',
        ),
    ),

) );

Mayosis_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'vend_list_page_titl',
		'label'    => __( '', 'mayosis-core' ),
		'section'  => 'dashboard_template',
		'default'  => '<div class="options-title">Vendor List Page Options</div>',
	)
);

Mayosis_Option::add_field( '',
	array(
	    'type'     => 'text',
		'settings' => 'fes_vendor_list_search_text',
		'label'    => esc_html__( 'Vendor List Search Placeholder', 'mayosis-core' ),
		'section'  => 'dashboard_template',
		'default'  => esc_html__( 'Search Contributor', 'mayosis-core' ),
		'priority' => 10,
	)
);
}