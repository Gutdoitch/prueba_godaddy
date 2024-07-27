<?php
Mayosis_Option::add_panel( 'mayosis_template', array(
    'title'       => __( 'Product Template', 'mayosis-core' ),
    'description' => __( 'Mayosis Product Template', 'mayosis-core' ),
    'priority' => '8',
) );

Mayosis_Option::add_section( 'template_automation', array(
    'title'       => __( 'Template Automation', 'mayosis-core' ),
    'panel'       => 'mayosis_template',

) );

Mayosis_Option::add_section( 'product_template', array(
    'title'       => __( 'Default Product Template', 'mayosis-core' ),
    'panel'       => 'mayosis_template',

) );

Mayosis_Option::add_section( 'photo_template', array(
    'title'       => __( 'Media Template', 'mayosis-core' ),
    'panel'       => 'mayosis_template',

) );

Mayosis_Option::add_section( 'prime_template', array(
    'title'       => __( 'Prime Template', 'mayosis-core' ),
    'panel'       => 'mayosis_template',

) );

Mayosis_Option::add_section( 'audio_template', array(
    'title'       => __( 'Audio Template', 'mayosis-core' ),
    'panel'       => 'mayosis_template',

) );


Mayosis_Option::add_section( 'product_archive', array(
    'title'       => __( 'Product Archive Template', 'mayosis-core' ),
    'panel'       => 'mayosis_template',

) );

Mayosis_Option::add_section( 'product_author', array(
    'title'       => __( 'Product Vendor Template', 'mayosis-core' ),
    'panel'       => 'mayosis_template',

) );
Mayosis_Option::add_section( 'tag_style', array(
    'title'       => __( 'Product Tag Template', 'mayosis-core' ),
    'panel'       => 'mayosis_template',

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'product_template_autmation_main',
    'label'       => __( 'Select Product Template Selection Type', 'mayosis-core' ),
    'section'     => 'template_automation',
    'default'     => 'single-download',
    'transport' =>$transport,
    'choices'     => array(
        'single-download'   => esc_attr__( 'Default', 'mayosis-core' ),
        'allcat' => esc_attr__( 'Whole Site', 'mayosis-core' ),
    ),

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'whole_site_product_template',
    'label'       => __( 'Whole Site Product Template', 'mayosis-core' ),
    'section'     => 'template_automation',
    'transport' =>$transport,
    'multiple'    => 1,
    'choices'     => array(
        'photo' => esc_attr__( 'Media Template', 'mayosis-core' ),
        'multi' => esc_attr__( 'Prime Template', 'mayosis-core' ),
        'audio' => esc_attr__( 'Audio Template', 'mayosis-core' ),
        'full' => esc_attr__( 'Full Width Template', 'mayosis-core' ),
        'narrow' => esc_attr__( 'Narrow Template', 'mayosis-core' ),
        'elemnts' => esc_attr__( 'Custom Template', 'mayosis-core' )

    ),

    'required'    => array(
        array(
            'setting'  => 'product_template_autmation_main',
            'operator' => '==',
            'value'    => 'allcat',
        ),
    ),

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'defultp_bottom_widget_control',
    'label'       => __( 'Bottom Widget Control', 'mayosis-core' ),
    'section'     => 'template_automation',
    'default'     => 'default',
    'priority'    => 10,
    'choices'     => array(
        'default'   => esc_attr__( 'Default', 'mayosis-core' ),
        'widget' => esc_attr__( 'From Widget', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'select',
    'settings' => 'select_product_blocks',
    'label'    => esc_html__( 'Custom Product Template', 'kirki' ),
    'section'  => 'template_automation',
    'default'  => 'product-template-1',
    'transport' =>'auto',
    'priority' => 10,
    'multiple' => 1,
    'choices'  => mayosis_get_posts(
        array(
            'posts_per_page' => 10,
            'post_type'      => 'product_template'
        )
    ),

    'required'    => array(
        array(
            'setting'  => 'product_template_autmation_main',
            'operator' => '==',
            'value'    => 'allcat',
        ),
    ),
) );

//start default template

Mayosis_Option::add_field( 'mayo_config', array(

    'type'        => 'dimensions',
    'settings'    => 'product_dif_padding',
    'label'       => esc_attr__( 'Product Breadcrumb Padding', 'mayosis-core' ),
    'description' => esc_attr__( 'Change Breadcrumb Padding', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => array(
        'padding-top'    => '80px',
        'padding-bottom' => '80px',
        'padding-left'   => '0px',
        'padding-right'  => '0px',
    ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'featured_image_visibility',
    'label'       => __( 'Featured Image Visibility', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => 'show',
    'priority'    => 10,
    'choices'     => array(
        'show'   => esc_attr__( 'Show', 'mayosis-core' ),
        'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'featured_image_position',
    'label'       => __( 'Featured Image Position', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => 'left',
    'priority'    => 10,
    'choices'     => array(
        'left'   => esc_attr__( 'Left', 'mayosis-core' ),
        'right' => esc_attr__( 'Right', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'product_header_content_position',
    'label'       => __( 'Product Header Content Position', 'mayosis-core' ),
    'section'     => 'product_template',
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
    'settings'    => 'background_product',
    'label'       => __( 'Background', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => 'color',
    'priority'    => 10,
    'multiple'    => 1,
    'choices'     => array(
        'color' => esc_attr__( 'Color', 'mayosis-core' ),
        'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
        'image' => esc_attr__( 'Image', 'mayosis-core' ),
        'featured' => esc_attr__( 'Featured Image', 'mayosis-core' ),
        'custom' => esc_attr__( 'Custom', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'product_bg_default',
    'label'       => __( 'Background Color', 'mayosis-core' ),
    'description' => __( 'Change  Backgrounnd Color', 'mayosis-core' ),
    'section'     => 'product_template',
    'priority'    => 10,
    'default'     => '#460082',
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

    'required'    => array(
        array(
            'setting'  => 'background_product',
            'operator' => '==',
            'value'    => 'color',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'product_bg_alt_dark',
    'label'       => __( 'Background Color Alt', 'mayosis-core' ),
    'description' => __( 'Change  Dark Backgrounnd Color', 'mayosis-core' ),
    'section'     => 'product_template',
    'priority'    => 10,
    'default'     => '',
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

    'required'    => array(
        array(
            'setting'  => 'background_product',
            'operator' => '==',
            'value'    => 'color',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'multicolor',
    'settings'    => 'product_gradient_default',
    'label'       => esc_attr__( 'Product gradient', 'mayosis-core' ),
    'section'     => 'product_template',
    'priority'    => 10,
    'required'    => array(
        array(
            'setting'  => 'background_product',
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
    'settings' => 'gradient_angle_product',
    'label'    => __( 'Angle', 'mayosis-core' ),
    'section'  => 'product_template',
    'default'  => esc_attr__( '135', 'mayosis-core' ),
    'priority' => 10,
    'required'    => array(
        array(
            'setting'  => 'background_product',
            'operator' => '==',
            'value'    => 'gradient',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'image',
    'settings'    => 'product-main-bg',
    'label'       => esc_attr__( 'Product Background Image', 'mayosis-core' ),
    'description' => esc_attr__( 'Custom Image.', 'mayosis-core' ),
    'section'     => 'product_template',
    'required'    => array(
        array(
            'setting'  => 'background_product',
            'operator' => '==',
            'value'    => 'image',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'text',
    'settings' => 'main_product_blur',
    'label'    => __( 'Blur Radius', 'mayosis-core' ),
    'section'  => 'product_template',
    'default'  => esc_attr__( '5px', 'mayosis-core' ),
    'priority' => 10,
    'required'    => array(
        array(
            'setting'  => 'background_product',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'product_ovarlay_main',
    'label'       => __( 'Overlay Color', 'mayosis-core' ),
    'description' => __( 'Change  Overlay Color', 'mayosis-core' ),
    'section'     => 'product_template',
    'priority'    => 10,
    'default'     => 'rgb(40,40,50,.5)',
    'choices'     => array(
        'alpha' => true,
    ),

    'required'    => array(
        array(
            'setting'  => 'background_product',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'parallax_featured_image',
    'label'       => __( 'Featured Image Parallax', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => 'no',
    'priority'    => 10,
    'choices'     => array(
        'yes'   => esc_attr__( 'Yes', 'mayosis-core' ),
        'no' => esc_attr__( 'No', 'mayosis-core' ),
    ),

    'required'    => array(
        array(
            'setting'  => 'background_product',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'code',
    'settings'    => 'product_custom_css',
    'label'       => esc_html__( 'Custom Css', 'mayosis-core' ),
    'description' => esc_html__( 'add custom css. you can add gradient code from gradienta.io', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => '',
    'choices'     => [
        'language' => 'css',
    ],
    'required'    => array(
        array(
            'setting'  => 'background_product',
            'operator' => '==',
            'value'    => 'custom',
        ),
    ),
] );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'image',
    'settings'    => 'default_overlay_image_product',
    'label'       => esc_attr__( 'Product Overlay Image', 'mayosis-core' ),
    'description' => esc_attr__( 'Upload product background image', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => '',

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'product_bdtxt_color',
    'label'       => __( 'Breadcrumb Text Color', 'mayosis-core' ),
    'description' => __( 'Change breadcrumb text color', 'mayosis-core' ),
    'section'     => 'product_template',
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

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'product_buttontxt_color',
    'label'       => __( 'Breadcrumb Button Text Color', 'mayosis-core' ),
    'description' => __( 'Change breadcrumb Button text color', 'mayosis-core' ),
    'section'     => 'product_template',
    'priority'    => 10,
    'default'     => '#ffffff',
    'transport' =>$transport,
    'output' => array(
        array(
            'element'  => '.default-product-template.product-main-header .single_main_header_products .edd-add-to-cart span',
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

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'product_ghost_border_color',
    'label'       => __( 'Breadcrumb Ghost Button Border Color', 'mayosis-core' ),
    'description' => __( 'Change ghost breadcrumb button border color', 'mayosis-core' ),
    'section'     => 'product_template',
    'priority'    => 10,
    'default'     => 'rgba(255,255,255,0.25)',
    'transport' =>$transport,
    'output' => array(
        array(
            'element'  => '.comment-button a.btn,.social-button',
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

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'product_ghost_social_bg',
    'label'       => __( 'Breadcrumb Ghost Social Button Background', 'mayosis-core' ),
    'description' => __( 'Change Ghost Social Button Background color', 'mayosis-core' ),
    'section'     => 'product_template',
    'priority'    => 10,
    'default'     => '#ffffff',
    'transport' =>$transport,
    'output' => array(
        array(
            'element'  => '.social-button a i',
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

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'product_ghost_social_txt',
    'label'       => __( 'Breadcrumb Ghost Social Button Text', 'mayosis-core' ),
    'description' => __( 'Change Ghost Social Button Text color', 'mayosis-core' ),
    'section'     => 'product_template',
    'priority'    => 10,
    'default'     => '#000046',
    'transport' =>$transport,
    'output' => array(
        array(
            'element'  => '.social-button a i',
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

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'sortable',
    'settings'    => 'product_content_layout_manager',
    'label'       => __( 'Product Content Layout Manager', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => array(
        'breadcrumb',
        'title',
        'category',
        'date',
        'button'
    ),
    'choices'     => array(
        'breadcrumb' => esc_attr__( 'Breadcrumb', 'mayosis-core' ),
        'title' => esc_attr__( 'Title', 'mayosis-core' ),
        'author' => esc_attr__( 'Author', 'mayosis-core' ),
        'category' => esc_attr__( 'Category', 'mayosis-core' ),
        'date' => esc_attr__( 'Date', 'mayosis-core' ),
        'button' => esc_attr__( 'Action Button', 'mayosis-core' ),
    ),

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'product_gallery_width',
    'label'       => __( 'Product Gallery Type', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => 'two',
    'priority'    => 10,
    'choices'     => array(
        'one'   => esc_attr__( 'Full Width', 'mayosis-core' ),
        'two' => esc_attr__( 'With Sidebar', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'product_top_social_share',
    'label'       => __( 'Product Top Social Share', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => 'show',
    'priority'    => 10,
    'choices'     => array(
        'show'   => esc_attr__( 'Show', 'mayosis-core' ),
        'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'defultp_bottom_widget',
    'label'       => __( 'Enable/Disable Bottom Widget Panel', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'   => esc_attr__( 'Enable', 'mayosis-core' ),
        'off' => esc_attr__( 'Disable', 'mayosis-core' ),
    ),

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'defultp_bottom_widget_col',
    'label'       => __( 'Bottom Widget Column', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => 'three',
    'priority'    => 10,
    'choices'     => array(
        'one'   => esc_attr__( 'One Column', 'mayosis-core' ),
        'two' => esc_attr__( 'Two Column', 'mayosis-core' ),
        'three' => esc_attr__( 'Three Column', 'mayosis-core' ),
    ),

    'required'    => array(
        array(
            'setting'  => 'defultp_bottom_widget_control',
            'operator' => '==',
            'value'    => 'widget',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'audio_player_bread',
    'label'       => __( 'Audio Player Show in Breadcrumb', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => 'two',
    'priority'    => 10,
    'choices'     => array(
        'one'   => esc_attr__( 'In Breadcrumb', 'mayosis-core' ),
        'two' => esc_attr__( 'In Content', 'mayosis-core' ),

    ),


) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'free_product_cart_button',
    'label'       => __( 'Cart Button Show/hide on free products', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => 'hide',
    'priority'    => 10,
    'choices'     => array(
        'show'   => esc_attr__( 'Show', 'mayosis-core' ),
        'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
    ),


) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'hide_comment_on_review',
    'label'       => __( 'Hide Comment on Review', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => 'show',
    'priority'    => 10,
    'choices'     => array(
        'show'   => esc_attr__( 'Show', 'mayosis-core' ),
        'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
    ),


) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'df_related_loads_from',
    'label'       => __( 'Related Download From', 'mayosis-core' ),
    'section'     => 'product_template',
    'default'     => 'download_category',
    'priority'    => 10,
    'choices'     => array(
        'download_category'   => esc_attr__( 'Category', 'mayosis-core' ),
        'download_tag' => esc_attr__( 'Tags', 'mayosis-core' ),
    ),

) );


// End Deafult template

// Start Photo template

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'photo_template_wrapper_bg',
    'label'       => __( 'Photo Template Bg Color', 'mayosis-core' ),
    'description' => __( 'Change  Background Color', 'mayosis-core' ),
    'section'     => 'photo_template',
    'priority'    => 10,
    'default'     => '#e9ebf7',
    'transport' =>$transport,
    'output' => array(
        array(
            'element' =>'.media-template-wrapper',
            'property' => 'background',
        )
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
        'alpha' => true,
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'photo_template_boxdf_bg',
    'label'       => __( 'Top Box Background Color', 'mayosis-core' ),
    'description' => __( 'Change  Background Color', 'mayosis-core' ),
    'section'     => 'photo_template',
    'priority'    => 10,
    'default'     => '#fcfdff',
    'transport' =>$transport,
    'output' => array(
        array(
            'element' =>'.photo-template-author',
            'property' => 'background',
        )
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
        'alpha' => true,
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'photo_template_right_bg',
    'label'       => __( 'Photo Template Right Background Color', 'mayosis-core' ),
    'description' => __( 'Change  Background Color', 'mayosis-core' ),
    'section'     => 'photo_template',
    'priority'    => 10,
    'default'     => '#fff',
    'transport' =>$transport,
    'output' => array(
        array(
            'element' =>'.photo--credential--box,.photo-credential',
            'property' => 'background',
        )
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
        'alpha' => true,
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'photo_template_right_txt',
    'label'       => __( 'Photo Template Right Text Color', 'mayosis-core' ),
    'description' => __( 'Change  Background Color', 'mayosis-core' ),
    'section'     => 'photo_template',
    'priority'    => 10,
    'default'     => '#222',
    'transport' =>$transport,
    'output' => array(
        array(
            'element' =>'.photo--title-block h1,.photo--title-block span, .photo--title-block,.photo--price--block h3 span,.photo--author--details p,.photo--author--details h4,.photo--template--button',
            'property' => 'color',
        )
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
        'alpha' => true,
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'photo_template_promo',
    'label'       => __( 'Photo Template Promo Bar', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'hide',
    'priority'    => 10,
    'choices'     => array(
        'show'   => esc_attr__( 'Show', 'mayosis-core' ),
        'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'dimensions',
    'settings'    => 'photo-video-template-padding',
    'label'       => esc_html__( 'Promo Padding', 'mayosis-core' ),
    'description' => esc_html__( 'add promo padding here.', 'mayosis-core' ),
    'section'     => 'photo_template',
    'required'    => array(
        array(
            'setting'  => 'photo_template_promo',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),
    'default'     => [
        'padding-top'    => '80px',
        'padding-bottom' => '80px',
        'padding-left'   => '0',
        'padding-right'  => '0',
    ],
] );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'photo_promobar_type',
    'label'       => __( 'Photo Template Promo Bar Background Type', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'none',
    'priority'    => 10,
    'required'    => array(
        array(
            'setting'  => 'photo_template_promo',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),
    'choices'     => array(
        'none'   => esc_attr__( 'None', 'mayosis-core' ),
        'color'   => esc_attr__( 'Single Color', 'mayosis-core' ),
        'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
        'image' => esc_attr__( 'Image', 'mayosis-core' ),
        'featured' => esc_attr__( 'Featured Image', 'mayosis-core' ),
        'video' => esc_attr__( 'Video', 'mayosis-core' ),
    ),

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'photo_template_bg',
    'label'       => __( 'Photo Template Bg Color', 'mayosis-core' ),
    'description' => __( 'Change  Background Color', 'mayosis-core' ),
    'section'     => 'photo_template',
    'priority'    => 10,
    'default'     => '#e9ebf7',
    'required'    => array(
        array(
            'setting'  => 'photo_promobar_type',
            'operator' => '==',
            'value'    => 'color',
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

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'photo_template_g1',
    'label'       => __( 'Photo Template Bg Gradient A', 'mayosis-core' ),
    'description' => __( 'Change  Background Color', 'mayosis-core' ),
    'section'     => 'photo_template',
    'priority'    => 10,
    'default'     => '#1e0046',
    'required'    => array(
        array(
            'setting'  => 'photo_promobar_type',
            'operator' => '==',
            'value'    => 'gradient',
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

) );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'image',
    'settings'    => 'background_image_photo_promo',
    'label'       => esc_html__( 'Background Image', 'mayosis-core' ),
    'description' => esc_html__( 'Add Background Image.', 'mayosis-core' ),
    'section'     => 'photo_template',
    'required'    => array(
        array(
            'setting'  => 'photo_promobar_type',
            'operator' => '==',
            'value'    => 'image',
        ),
    ),
    'default'     => '',
] );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'photo_template_g2',
    'label'       => __( 'Photo Template Bg Gradient B', 'mayosis-core' ),
    'description' => __( 'Change  Background Color', 'mayosis-core' ),
    'section'     => 'photo_template',
    'priority'    => 10,
    'default'     => '#1e0064',
    'required'    => array(
        array(
            'setting'  => 'photo_promobar_type',
            'operator' => '==',
            'value'    => 'gradient',
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

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'photov_overlay_color',
    'label'       => __( 'Photo Template Promo Overlay Color', 'mayosis-core' ),
    'description' => __( 'Change  Overlay Color', 'mayosis-core' ),
    'section'     => 'photo_template',
    'priority'    => 10,
    'default'     => 'rgba(25,30,75,0.85)',
    'required'    => array(
        array(
            'setting'  => 'photo_promobar_type',
            'operator' => '==',
            'value'    => 'featured',
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
    'type'        => 'color',
    'settings'     => 'photov_overlay_color_video',
    'label'       => __( 'Video Overlay Color', 'mayosis-core' ),
    'description' => __( 'Change  Overlay Color', 'mayosis-core' ),
    'section'     => 'photo_template',
    'priority'    => 10,
    'default'     => 'rgba(25,30,75,0.85)',
    'required'    => array(
        array(
            'setting'  => 'photo_promobar_type',
            'operator' => '==',
            'value'    => 'video',
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
    'type'        => 'color',
    'settings'     => 'photo_template_contnt_bg',
    'label'       => __( 'Photo Template content Background Color', 'mayosis-core' ),
    'description' => __( 'Change  Background Color', 'mayosis-core' ),
    'section'     => 'photo_template',
    'priority'    => 10,
    'default'     => '#fff',
    'transport' =>$transport,
    'output' => array(
        array(
            'element' =>'.photo--template--content',
            'property' => 'background',
        )
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
        'alpha' => true,
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'photo_template_contnt_txt',
    'label'       => __( 'Photo Template content Text Color', 'mayosis-core' ),
    'description' => __( 'Change  Text Color', 'mayosis-core' ),
    'section'     => 'photo_template',
    'priority'    => 10,
    'default'     => '#222',
    'transport' =>$transport,
    'output' => array(
        array(
            'element' =>'.photo--template--content,.photo--template--content p',
            'property' => 'color',
        )
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
        'alpha' => true,
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'photo_template_view',
    'label'       => __( 'Photo Template Layout', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'fixed',
    'priority'    => 10,
    'choices'     => array(
        'fixed'   => esc_attr__( 'Fixed', 'mayosis-core' ),
        'flexible' => esc_attr__( 'Flexible', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
    'settings'    => 'product_photo_margin',
    'label'       => esc_attr__( 'Photo Template Margin Top', 'mayosis-core' ),
    'description' => esc_attr__( 'Photo Template Margin Top', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => '80px',
    'output'    => array(
        array(
            'element'  => '.photo-template-author',
            'property' => 'margin-top',

        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimension',
    'settings'    => 'product_photo_margin_bottom',
    'label'       => esc_attr__( 'Photo Template Margin Bottom', 'mayosis-core' ),
    'description' => esc_attr__( 'Photo Template Margin Bottom', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => '80px',
    'output'    => array(
        array(
            'element'  => '.photo-template-author',
            'property' => 'margin-bottom',

        ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'photo_template_author_enable',
    'label'       => __( 'Author Information Enable/Disable', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'enable',
    'priority'    => 10,
    'choices'     => array(
        'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
        'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'text',
    'settings' => 'photography_by',
    'label'    => esc_html__( 'Author Type Name (i.e Photography By)', 'mayosis-core' ),
    'required'    => array(
        array(
            'setting'  => 'photo_template_author_enable',
            'operator' => '==',
            'value'    => 'enable',
        ),
    ),
    'section'  => 'photo_template',
    'default'  => esc_html__( 'Photography By', 'mayosis-core' ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'photo_template_box_gap',
    'label'       => __( 'Gap Between Photo & Infobox', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'disable',
    'priority'    => 10,
    'choices'     => array(
        'enable'   => esc_attr__( 'Gap', 'mayosis-core' ),
        'disable' => esc_attr__( 'No Gap', 'mayosis-core' ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'photo_template_backgrund_remove',
    'label'       => __( 'Background Color Remove from Photobox', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'enable',
    'priority'    => 10,
    'choices'     => array(
        'enable'   => esc_attr__( 'Background', 'mayosis-core' ),
        'disable' => esc_attr__( 'Transparent', 'mayosis-core' ),
    ),

    'required'    => array(
        array(
            'setting'  => 'photo_template_box_gap',
            'operator' => '==',
            'value'    => 'enable',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'photo_template_shadow',
    'label'       => __( 'Add Shadow on boxes', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'disable',
    'priority'    => 10,
    'choices'     => array(
        'enable'   => esc_attr__( 'Shadow on Whole box', 'mayosis-core' ),
         'seprate'   => esc_attr__( 'Shadow on Seprate Box', 'mayosis-core' ),
        'disable' => esc_attr__( 'No Shadow', 'mayosis-core' ),
    ),
    

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'photo_equal_height',
    'label'       => __( 'Equal height Both Box', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'disable',
    'priority'    => 10,
    'choices'     => array(
        'enable'   => esc_attr__( 'Equal', 'mayosis-core' ),
        'disable' => esc_attr__( 'Not Equal', 'mayosis-core' ),
    ),
    'required'    => array(
        array(
            'setting'  => 'photo_template_box_gap',
            'operator' => '==',
            'value'    => 'enable',
        ),
    ),
) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'photo_zoom_disable',
    'label'       => __( 'Photo Zoom Button', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'enable',
    'priority'    => 10,
    'choices'     => array(
        'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
        'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
    ),

) );



Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'media_subscription_style',
    'label'       => __( 'Media Template Style', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'stylec',
    'priority'    => 10,
    'choices'     => array(
        'stylea'   => esc_attr__( 'Style One', 'mayosis-core' ),
        'styleb' => esc_attr__( 'Style Two (with sidebar)', 'mayosis-core' ),
        'stylec' => esc_attr__( 'Style Three', 'mayosis-core' ),
        'styled' => esc_attr__( 'Style Four (with sidebar)', 'mayosis-core' ),
    ),


) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'subscription_content_show',
    'label'       => __( 'Subscription Widgets', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'enable',
    'priority'    => 10,
    'choices'     => array(
        'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
        'disable' => esc_attr__( 'Disable', 'mayosis-core' ),

    ),


) );



Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'media_price_align',
    'label'       => __( 'Price Align', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'center',
    'transport' =>$transport,
    'choices'     => array(
        'left'   => esc_attr__( 'Left', 'mayosis-core' ),
        'center' => esc_attr__( 'Center', 'mayosis-core' ),
        'right' => esc_attr__( 'Right', 'mayosis-core' ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
    'settings'    => 'media_price_desc_txt',
    'label'       => __( 'Price Above Text', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => '',
    'priority'    => 10,


) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
    'settings'    => 'related_product_title',
    'label'       => __( 'Related Product Title', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'Similar Images',
    'priority'    => 10,


) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'related_download_style',
    'label'       => __( 'Related Download Style', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'justified',
    'priority'    => 10,
    'choices'     => array(
        'normal'   => esc_attr__( 'Normal', 'mayosis-core' ),
        'justified' => esc_attr__( 'Justified Grid', 'mayosis-core' ),
        'masonry' => esc_attr__( 'Masonry Grid', 'mayosis-core' ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'text',
    'settings'    => 'related_product_number',
    'label'       => __( 'Related Product Number', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => '8',
    'priority'    => 10,


) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'ps_related_loads_from',
    'label'       => __( 'Related Download From', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'download_category',
    'priority'    => 10,
    'choices'     => array(
        'download_category'   => esc_attr__( 'Category', 'mayosis-core' ),
        'download_tag' => esc_attr__( 'Tags', 'mayosis-core' ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'media_coment',
    'label'       => __( 'Comment Width Mode', 'mayosis-core' ),
    'section'     => 'photo_template',
    'default'     => 'normal',
    'priority'    => 10,
    'choices'     => array(
        'normal'   => esc_attr__( 'Normal', 'mayosis-core' ),
        'compact' => esc_attr__( 'Compact', 'mayosis-core' ),
    ),

) );

// End Photo template

// Start prime template

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'typography',
    'settings'    => 'prime_typography',
    'label'       => esc_attr__( 'Prime Title Typography', 'mayosis-core' ),
    'section'     => 'prime_template',
    'default'     => array(
        'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
        'variant'        => '700',
        'font-size'      => '36px',
        'line-height'    => '45px',
        'letter-spacing'    => '-0.75',

    ),
    'priority'    => 10,

    'choices' => array(
        'fonts' => array(
            'google' => array( 'popularity', 60 ),
        ),
    ),

    'transport' => 'auto',
    'output'    => array(
        array(
            'element' => '.prime-product-template h1.single-post-title',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimensions',
    'settings'    => 'product_prime_padding',
    'label'       => esc_attr__( 'Product Breadcrumb Padding', 'mayosis-core' ),
    'description' => esc_attr__( 'Change Breadcrumb Padding', 'mayosis-core' ),
    'section'     => 'prime_template',
    'default'     => array(
        'padding-top'    => '80px',
        'padding-bottom' => '80px',
        'padding-left'   => '0px',
        'padding-right'  => '0px',
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'product_prime_content_position',
    'label'       => __( 'Product Header Content Position', 'mayosis-core' ),
    'section'     => 'prime_template',
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
    'settings'    => 'background_prime',
    'label'       => __( 'Background', 'mayosis-core' ),
    'section'     => 'prime_template',
    'default'     => 'color',
    'priority'    => 10,
    'multiple'    => 1,
    'choices'     => array(
        'color' => esc_attr__( 'Color', 'mayosis-core' ),
        'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
        'image' => esc_attr__( 'Image', 'mayosis-core' ),
        'featured' => esc_attr__( 'Featured Image', 'mayosis-core' ),
        'custom' => esc_attr__( 'Custom', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'prime_bg_default',
    'label'       => __( 'Background Color', 'mayosis-core' ),
    'description' => __( 'Change  Backgrounnd Color', 'mayosis-core' ),
    'section'     => 'prime_template',
    'priority'    => 10,
    'default'     => '#edf0f7',
    'choices' => array(
        'palettes' => array(
            '#28375a',
            '#282837',
            '#5a00f0',
            '#edf0f7',
            '#c44d58',
            '#ecca2e',
            '#bada55',
        ),
    ),

    'required'    => array(
        array(
            'setting'  => 'background_prime',
            'operator' => '==',
            'value'    => 'color',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'multicolor',
    'settings'    => 'prime_gradient_default',
    'label'       => esc_attr__( 'Product gradient', 'mayosis-core' ),
    'section'     => 'prime_template',
    'priority'    => 10,
    'required'    => array(
        array(
            'setting'  => 'background_prime',
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
    'settings' => 'gradient_angle_prime',
    'label'    => __( 'Angle', 'mayosis-core' ),
    'section'  => 'prime_template',
    'default'  => esc_attr__( '135', 'mayosis-core' ),
    'priority' => 10,
    'required'    => array(
        array(
            'setting'  => 'background_prime',
            'operator' => '==',
            'value'    => 'gradient',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'image',
    'settings'    => 'prime-main-bg',
    'label'       => esc_attr__( 'Image', 'mayosis-core' ),
    'description' => esc_attr__( 'Custom Image.', 'mayosis-core' ),
    'section'     => 'prime_template',
    'required'    => array(
        array(
            'setting'  => 'background_prime',
            'operator' => '==',
            'value'    => 'image',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'text',
    'settings' => 'main_prime_blur',
    'label'    => __( 'Blur Radius', 'mayosis-core' ),
    'section'  => 'prime_template',
    'default'  => esc_attr__( '5px', 'mayosis-core' ),
    'priority' => 10,
    'required'    => array(
        array(
            'setting'  => 'background_prime',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'prime_ovarlay_main',
    'label'       => __( 'Overlay Color', 'mayosis-core' ),
    'description' => __( 'Change  Overlay Color', 'mayosis-core' ),
    'section'     => 'prime_template',
    'priority'    => 10,
    'default'     => 'rgb(40,40,50,.5)',
    'choices'     => array(
        'alpha' => true,
    ),

    'required'    => array(
        array(
            'setting'  => 'background_prime',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'parallax_prime_image',
    'label'       => __( 'Featured Image Parallax', 'mayosis-core' ),
    'section'     => 'prime_template',
    'default'     => 'no',
    'priority'    => 10,
    'choices'     => array(
        'yes'   => esc_attr__( 'Yes', 'mayosis-core' ),
        'no' => esc_attr__( 'No', 'mayosis-core' ),
    ),

    'required'    => array(
        array(
            'setting'  => 'background_prime',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'code',
    'settings'    => 'prime_custom_css',
    'label'       => esc_html__( 'Custom Css', 'mayosis-core' ),
    'description' => esc_html__( 'add custom css. you can add gradient code from gradienta.io', 'mayosis-core' ),
    'section'     => 'prime_template',
    'default'     => '',
    'choices'     => [
        'language' => 'css',
    ],
    'required'    => array(
        array(
            'setting'  => 'background_prime',
            'operator' => '==',
            'value'    => 'custom',
        ),
    ),
] );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'image',
    'settings'    => 'prime_overlay_image_product',
    'label'       => esc_attr__( 'Product Overlay Image', 'mayosis-core' ),
    'description' => esc_attr__( 'Upload product background image', 'mayosis-core' ),
    'section'     => 'prime_template',
    'default'     => '',

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'prime_bdtxt_color',
    'label'       => __( 'Breadcrumb Text Color', 'mayosis-core' ),
    'description' => __( 'Change breadcrumb text color', 'mayosis-core' ),
    'section'     => 'prime_template',
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

) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'sortable',
    'settings'    => 'prime_content_layout_manager',
    'label'       => __( 'Product Content Layout Manager', 'mayosis-core' ),
    'section'     => 'prime_template',
    'default'     => array(
        'title',
    ),
    'choices'     => array(
        'breadcrumb' => esc_attr__( 'Breadcrumb', 'mayosis-core' ),
        'title' => esc_attr__( 'Title', 'mayosis-core' ),
        'author' => esc_attr__( 'Author', 'mayosis-core' ),
        'category' => esc_attr__( 'Category', 'mayosis-core' ),
        'date' => esc_attr__( 'Date', 'mayosis-core' ),
        'button' => esc_attr__( 'Action Button', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'prime_bottom_widget',
    'label'       => __( 'Enable/Disable Bottom Widget Panel', 'mayosis-core' ),
    'section'     => 'prime_template',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => array(
        'on'   => esc_attr__( 'Enable', 'mayosis-core' ),
        'off' => esc_attr__( 'Disable', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'prime_gallery_width',
    'label'       => __( 'Product Gallery/Thumbnail Width', 'mayosis-core' ),
    'section'     => 'prime_template',
    'default'     => 'two',
    'priority'    => 10,
    'choices'     => array(
        'one'   => esc_attr__( 'Full Width', 'mayosis-core' ),
        'two' => esc_attr__( 'With Sidebar', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'prime_media_position',
    'label'       => __( 'EDD Audio/Video Position', 'mayosis-core' ),
    'section'     => 'prime_template',
    'default'     => 'top',
    'priority'    => 10,
    'choices'     => array(
        'top'   => esc_attr__( 'Above Featured Image', 'mayosis-core' ),
        'bottom' => esc_attr__( 'Below Featured Image', 'mayosis-core' ),

    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'hide_comment_on_review_prime',
    'label'       => __( 'Hide Comment on Review', 'mayosis-core' ),
    'section'     => 'prime_template',
    'default'     => 'show',
    'priority'    => 10,
    'choices'     => array(
        'show'   => esc_attr__( 'Show', 'mayosis-core' ),
        'hide' => esc_attr__( 'Hide', 'mayosis-core' ),
    ),


) );

//end prime template

//Start archive template
Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'custom_archive_tpl_state',
    'label'       => esc_html__( 'Product Archive Custom Template', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'disable',
    'priority'    => 10,
    'choices'     => [
        'enable'   => esc_html__( 'Enable', 'kirki' ),
        'disable' => esc_html__( 'Disable', 'kirki' ),
    ],
] );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'select',
    'settings' => 'select_product_archive_blocks',
    'label'    => esc_html__( 'Custom Product Archive Template', 'mayosis-core' ),
    'section'  => 'product_archive',
    'default'  => 'product-archive-1',
    'transport' =>'auto',
    'priority' => 10,
    'multiple' => 1,
    'choices'  => mayosis_get_posts(
        array(
            'posts_per_page' => -1,
            'post_type'      => 'edd_archive_builder'
        )
    ),

    'required'    => array(
        array(
            'setting'  => 'custom_archive_tpl_state',
            'operator' => '==',
            'value'    => 'enable',
        ),
    ),
) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'archive_bg_type',
    'label'       => __( 'Archive Background Type', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'gradient',
    'priority'    => 10,
    'choices'     => array(
        'color'  => esc_attr__( 'Color', 'mayosis-core' ),
        'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
        'image' => esc_attr__( 'Image', 'mayosis-core' ),
        'featured' => esc_attr__( 'Category Image', 'mayosis-core' ),
        'custom' => esc_attr__( 'Custom', 'mayosis-core' ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'archive_breadcrumb_disable',
    'label'       => __( 'Archive Breadcrumb', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'enable',
    'transport' =>$transport,
    'choices'     => array(
        'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
        'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'dimensions',
    'settings'    => 'archive_breadcrumb_padding',
    'label'       => __( 'Archive Breadcrumb Padding', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => [
        'padding-top'    => '',
        'padding-bottom' => '',
        'padding-left'   => '',
        'padding-right'  => '',
    ],
    'transport' =>$transport,
    'output'      => [
        [
            'element' => '.product-archive-breadcrumb',
        ],
    ],
) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'parchive_background',
    'label'       => __( 'Breadcrumb Background Color', 'mayosis-core' ),
    'description' => __( 'Set Breadcrumb Background color', 'mayosis-core' ),
    'section'     => 'product_archive',
    'priority'    => 10,
    'default'     => '#1e0047',
    'required'    => array(
        array(
            'setting'  => 'archive_bg_type',
            'operator' => '==',
            'value'    => 'color',
        ),
    ),
     'choices'     => array(
        'alpha' => true,
    ),


) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'parchive_background_dark_alt',
    'label'       => __( 'Breadcrumb Dark Background Color', 'mayosis-core' ),
    'description' => __( 'Set Breadcrumb Dark Background color', 'mayosis-core' ),
    'section'     => 'product_archive',
    'priority'    => 10,
    'default'     => '',
    'required'    => array(
        array(
            'setting'  => 'archive_bg_type',
            'operator' => '==',
            'value'    => 'color',
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

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'multicolor',
    'settings'    => 'parchive_gradient',
    'label'       => esc_attr__( 'Breadcrumb gradient', 'mayosis-core' ),
    'section'     => 'product_archive',
    'priority'    => 10,
    'required'    => array(
        array(
            'setting'  => 'archive_bg_type',
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
    'settings'    => 'parchive_image',
    'label'       => esc_attr__( 'Breadcrumb Background Image', 'mayosis-core' ),
    'description' => esc_attr__( 'Upload Product/Blog background image', 'mayosis-core' ),
    'section'     => 'product_archive',
    'required'    => array(
        array(
            'setting'  => 'archive_bg_type',
            'operator' => '==',
            'value'    => 'image',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'parchive_bg_image_repeat',
    'label'       => __( 'Image Repeat', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'repeat',
    'priority'    => 10,
    'choices'     => array(
        'repeat'  => esc_attr__( 'Repeat', 'mayosis-core' ),
        'cover' => esc_attr__( 'Cover', 'mayosis-core' ),

    ),
    'required'    => array(
        array(
            'setting'  => 'archive_bg_type',
            'operator' => '==',
            'value'    => 'image',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'text',
    'settings' => 'pbread_blog_blur',
    'label'    => __( 'Blur Radius', 'mayosis-core' ),
    'section'  => 'product_archive',
    'default'  => esc_attr__( '5px', 'mayosis-core' ),
    'priority' => 10,
    'required'    => array(
        array(
            'setting'  => 'archive_bg_type',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'pbread_ovarlay_main',
    'label'       => __( 'Overlay Color', 'mayosis-core' ),
    'description' => __( 'Change  Overlay Color', 'mayosis-core' ),
    'section'     => 'product_archive',
    'priority'    => 10,
    'default'     => 'rgb(40,40,50,.5)',
    'choices'     => array(
        'alpha' => true,
    ),

    'required'    => array(
        array(
            'setting'  => 'archive_bg_type',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'parallax_prbred_image',
    'label'       => __( 'Featured Image Parallax', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'no',
    'priority'    => 10,
    'choices'     => array(
        'yes'   => esc_attr__( 'Yes', 'mayosis-core' ),
        'no' => esc_attr__( 'No', 'mayosis-core' ),
    ),

    'required'    => array(
        array(
            'setting'  => 'archive_bg_type',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'code',
    'settings'    => 'archive_custom_css',
    'label'       => esc_html__( 'Custom Css', 'mayosis-core' ),
    'description' => esc_html__( 'add custom css. you can add gradient code from gradienta.io', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => '',
    'choices'     => [
        'language' => 'css',
    ],
    'required'    => array(
        array(
            'setting'  => 'archive_bg_type',
            'operator' => '==',
            'value'    => 'custom',
        ),
    ),
] );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'pbread_txt_color',
    'label'       => __( 'Breadcrumb Text Color', 'mayosis-core' ),
    'description' => __( 'Change Text Color', 'mayosis-core' ),
    'section'     => 'product_archive',
    'priority'    => 10,
    'default'     => '#ffffff',
    'choices'     => array(
        'alpha' => true,
    ),
    'output' => array(
        array(
            'element'  => '.product-archive-breadcrumb .breadcrumb a,.product-archive-breadcrumb .breadcrumb,.product-archive-breadcrumb .breadcrumb .active',
            'property' => 'color',
        ),



    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'pbread_txt_align',
    'label'       => __( 'Breadcrumb Text Align', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'center',
    'priority'    => 10,
    'choices'     => array(
        'left'   => esc_attr__( 'Left', 'mayosis-core' ),
        'center' => esc_attr__( 'Center', 'mayosis-core' ),
        'right' => esc_attr__( 'Right', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'product_archive_type',
    'label'       => __( 'Product Archive Type', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'one',
    'priority'    => 10,
    'choices'     => array(
        'one'   => esc_attr__( 'Full Width', 'mayosis-core' ),
        'two' => esc_attr__( 'With Sidebar', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'product_sidebar_position_ls',
    'label'       => __( 'Sidebar Position', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'left',
    'priority'    => 10,
    'choices'     => array(
        'left'   => esc_attr__( 'Left', 'mayosis-core' ),
        'right' => esc_attr__( 'Right', 'mayosis-core' ),
    ),
    
     'required'    => array(
        array(
            'setting'  => 'product_archive_type',
            'operator' => '==',
            'value'    => 'two',
        ),
        
        ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'product_archive_column_grid',
    'label'       => __( 'Product Archive Column', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'two',
    'priority'    => 10,
    'choices'     => array(
        'one'   => esc_attr__( 'Two Column', 'mayosis-core' ),
        'two' => esc_attr__( 'Three Column', 'mayosis-core' ),
        'three' => esc_attr__( 'Four Column', 'mayosis-core' ),
        'five' => esc_attr__( 'Five Column', 'mayosis-core' ),
        'four' => esc_attr__( 'Six Column', 'mayosis-core' ),
    ),

) );
//Mayosis_Option::add_field( 'mayo_config', array(

//'type'     => 'editor',
//'settings' => 'archive_page_hero',
//'label'    => __( 'Archive Page Hero', 'mayosis-core' ),
//'section'  => 'product_archive',
//'default'  => esc_attr__( '', 'mayosis-core' ),
//'priority' => 10,
//) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'archive_title_disable',
    'label'       => __( 'Archive Titlebar', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'enable',
    'transport' =>$transport,
    'choices'     => array(
        'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
        'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'collapse_filter_msc',
    'label'       => __( 'Collapse Filter', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'disable',
    'transport' =>$transport,
    'choices'     => array(
        'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
        'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
    ),
    
     'required'    => array(
        array(
            'setting'  => 'archive_title_disable',
            'operator' => '==',
            'value'    => 'enable',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'product_extra_meta_mcs',
    'label'       => __( 'Product Extra Meta', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'disable',
    'transport' =>$transport,
    'choices'     => array(
        'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
        'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
    ),
    
     'required'    => array(
        array(
            'setting'  => 'archive_title_disable',
            'operator' => '==',
            'value'    => 'enable',
        ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'archive_category_filter_disable',
    'label'       => __( 'Archive Subcategory Buttons', 'mayosis-core' ),
    'section'     => 'product_archive',
    'default'     => 'disable',
    'transport' =>$transport,
    'choices'     => array(
        'enable'   => esc_attr__( 'Enable', 'mayosis-core' ),
        'disable' => esc_attr__( 'Disable', 'mayosis-core' ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(

    'type'     => 'text',
    'settings' => 'all_product_text',
    'label'    => __( 'Archive Page Title Prefix Text', 'mayosis-core' ),
    'section'  => 'product_archive',
    'default'  => esc_attr__( 'ALL PRODUCTS FROM', 'mayosis-core' ),
    'priority' => 10,
) );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'typography',
	'settings'    => 'archive_heading_typo',
	'label'       => esc_html__( 'Category heading Typo', 'mayosis-core' ),
	'section'     => 'product_archive',
	'default'     => [
		'font-family'    => 'Lato',
		'variant'        => '700',
		'font-size'      => '36px',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'color'          => '#ffffff',
		'text-transform' => 'none',
	
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.product-archive-breadcrumb .parchive-page-title',
		],
	],
] );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'sortable',
        'settings'    => 'p_archive_sorting_items',
        'label'       => __( 'Archive Sorting Filter Items', 'mayosis-core' ),
        'section'     => 'product_archive',
        'default'     => array(
            'popular',
            'recent',
            'older',
            'pricel2h',
            'priceh2l',
            'titlea2z',
            'titlez2a',
        ),
        'choices'     => array(
            'popular' => esc_attr__( 'Popular', 'mayosis-core' ),
            'recent' => esc_attr__( 'Recent', 'mayosis-core' ),
            'older' => esc_attr__( 'Older', 'mayosis-core' ),
            'pricel2h' => esc_attr__( 'Price (Low to High)', 'mayosis-core' ),
            'priceh2l' => esc_attr__( 'Price (High to Low)', 'mayosis-core' ),
            'titlea2z' => esc_attr__( 'Title (A - Z)', 'mayosis-core' ),
            'titlez2a' => esc_attr__( 'Title (Z - A)', 'mayosis-core' ),
            

        ),
) );

//vendor profile

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'sortable',
    'settings'    => 'vendor_layout_control',
    'label'       => __( 'Vendor Content Layout Manager', 'mayosis-core' ),
    'section'     => 'product_author',
    'default'     => array(
        'products',
        'sales',
        'page',
        'follower',
        'following'
    ),
    'choices'     => array(
        'products' => esc_attr__( 'Product Count', 'mayosis-core' ),
        'sales' => esc_attr__( 'Lifetime Sales', 'mayosis-core' ),
        'page' => esc_attr__( 'Page Views', 'mayosis-core' ),
        'follower' => esc_attr__( 'Follower', 'mayosis-core' ),
        'following' => esc_attr__( 'Following', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'dimension',
    'settings' => 'vendor_form_border_radius',
    'label'    => __( 'Vendor Search Form Border Radius', 'mayosis-core' ),
    'section'  => 'product_author',
    'default'  => '20px',
    'priority' => 10,
    'output'    => array(
        array(

            'element'     => '.vendor--search--box input[type="text"]',
            'property'    => 'border-radius',

        ),
    )
) );


Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'dimension',
    'settings' => 'gap_on_audio_template_top',
    'label'    => __( 'Audio Template Top Gap', 'mayosis-core' ),
    'section'  => 'audio_template',
    'default'  => '0',
    'priority' => 10,
    'output'    => array(
        array(

            'element'     => '.mayosis_wave-audio_template',
            'property'    => 'padding-top',

        ),
    )
) );

Mayosis_Option::add_field( 'mayo_config', array(

    'type'        => 'dimensions',
    'settings'    => 'audio_breadcrumb_padding',
    'label'       => esc_attr__( 'Audio Breadcrumb Padding', 'mayosis-core' ),
    'description' => esc_attr__( 'Change Breadcrumb Padding', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => array(
        'padding-top'    => '0px',
        'padding-bottom' => '0px',
        'padding-left'   => '0px',
        'padding-right'  => '0px',
    ),

    'output'    => array(
        array(

            'element'     => '.maysosis-audio_hero',

        ),
    )
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'audio_featured_image_position',
    'label'       => __( 'Featured Image Position', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => 'left',
    'priority'    => 10,
    'choices'     => array(
        'left'   => esc_attr__( 'Left', 'mayosis-core' ),
        'right' => esc_attr__( 'Right', 'mayosis-core' ),
    ),

) );
Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'select',
    'settings'    => 'background_audio_hero',
    'label'       => __( 'Background', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => 'color',
    'priority'    => 10,
    'multiple'    => 1,
    'choices'     => array(
        'color' => esc_attr__( 'Color', 'mayosis-core' ),
        'gradient' => esc_attr__( 'Gradient', 'mayosis-core' ),
        'image' => esc_attr__( 'Image', 'mayosis-core' ),
        'featured' => esc_attr__( 'Featured Image', 'mayosis-core' ),
        'custom' => esc_attr__( 'Custom', 'mayosis-core' ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'audio_bg_default',
    'label'       => __( 'Background Color', 'mayosis-core' ),
    'description' => __( 'Change  Backgrounnd Color', 'mayosis-core' ),
    'section'     => 'audio_template',
    'priority'    => 10,
    'default'     => '#0d0d0d',
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

    'required'    => array(
        array(
            'setting'  => 'background_audio_hero',
            'operator' => '==',
            'value'    => 'color',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'multicolor',
    'settings'    => 'audio_gradient_default',
    'label'       => esc_attr__( 'Audio gradient', 'mayosis-core' ),
    'section'     => 'audio_template',
    'priority'    => 10,
    'required'    => array(
        array(
            'setting'  => 'background_audio_hero',
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
    'settings' => 'gradient_angle_audio',
    'label'    => __( 'Angle', 'mayosis-core' ),
    'section'  => 'audio_template',
    'default'  => esc_attr__( '135', 'mayosis-core' ),
    'priority' => 10,
    'required'    => array(
        array(
            'setting'  => 'background_audio_hero',
            'operator' => '==',
            'value'    => 'gradient',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'image',
    'settings'    => 'audio-main-bg',
    'label'       => esc_attr__( 'Audio Background Image', 'mayosis-core' ),
    'description' => esc_attr__( 'Custom Image.', 'mayosis-core' ),
    'section'     => 'audio_template',
    'required'    => array(
        array(
            'setting'  => 'background_audio_hero',
            'operator' => '==',
            'value'    => 'image',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'     => 'text',
    'settings' => 'main_audio_blur',
    'label'    => __( 'Blur Radius', 'mayosis-core' ),
    'section'  => 'audio_template',
    'default'  => esc_attr__( '5px', 'mayosis-core' ),
    'priority' => 10,
    'required'    => array(
        array(
            'setting'  => 'background_audio_hero',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),
) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'color',
    'settings'     => 'audio_ovarlay_main',
    'label'       => __( 'Overlay Color', 'mayosis-core' ),
    'description' => __( 'Change  Overlay Color', 'mayosis-core' ),
    'section'     => 'audio_template',
    'priority'    => 10,
    'default'     => 'rgb(40,40,50,.5)',
    'choices'     => array(
        'alpha' => true,
    ),

    'required'    => array(
        array(
            'setting'  => 'background_audio_hero',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'audio_parallax_featured_image',
    'label'       => __( 'Featured Image Parallax', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => 'no',
    'priority'    => 10,
    'choices'     => array(
        'yes'   => esc_attr__( 'Yes', 'mayosis-core' ),
        'no' => esc_attr__( 'No', 'mayosis-core' ),
    ),

    'required'    => array(
        array(
            'setting'  => 'background_audio_hero',
            'operator' => '==',
            'value'    => 'featured',
        ),
    ),

) );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'code',
    'settings'    => 'audio_custom_css',
    'label'       => esc_html__( 'Custom Css', 'mayosis-core' ),
    'description' => esc_html__( 'add custom css. you can add gradient code from gradienta.io', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => '',
    'choices'     => [
        'language' => 'css',
    ],
    'required'    => array(
        array(
            'setting'  => 'background_audio_hero',
            'operator' => '==',
            'value'    => 'custom',
        ),
    ),
] );

Mayosis_Option::add_field( 'mayo_config', [
	'type'        => 'typography',
	'settings'    => 'audio_title_typography',
	'label'       => esc_html__( 'Title Typography', 'mayosis-core' ),
	'section'     => 'audio_template',
	 'default'     => array(
        'font-family'    => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif',
        'variant'        => '700',
        'font-size'      => '36px',
        'line-height'    => '45px',
        'letter-spacing'    => '-0.75',

    ),
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.mayosis-music-main-title',
		],
	],
] );
Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'product_wave_audio',
    'label'       => esc_html__( 'Audio Player Type', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => 'hide',
    'priority'    => 10,
    'choices'     => [
        'show'   => esc_html__( 'Wave Player', 'mayosis-core' ),
        'hide' => esc_html__( 'Default Audio Player', 'mayosis-core' ),
    ],
] );


Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'product_wave_style',
    'label'       => esc_html__( 'Wave Type', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => 'standard',
    'priority'    => 10,
    'choices'     => [
        'standard'   => esc_html__( 'Standard', 'mayosis-core' ),
        'fixed' => esc_html__( 'Fixed', 'mayosis-core' ),
    ],

    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),
] );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'product_thumbnail_state',
    'label'       => esc_html__( 'Thumbnail State', 'mayosis-core' ),
    'description'=>esc_html__( 'only for standard audio', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => 'disable',
    'priority'    => 10,
    'choices'     => [
        'enable'   => esc_html__( 'Enable', 'mayosis-core' ),
        'disable' => esc_html__( 'Disable', 'mayosis-core' ),
    ],

    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),
] );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'product_playlist',
    'label'       => esc_html__( 'Playlist', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => 'disable',
    'priority'    => 10,
    'choices'     => [
        'enable'   => esc_html__( 'Enable', 'mayosis-core' ),
        'disable' => esc_html__( 'Disable', 'mayosis-core' ),
    ],

    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),
] );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'color',
    'settings'    => 'wave_p_background',
    'label'       => __( 'Wave Player Background Color', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => '#e9edf7',
    'choices'     => [
        'alpha' => true,
    ],

    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),

    'output' => array(
        array(
            'element'  => '.awp-player-holder',
            'property' => 'background',
        ),
    )
] );


Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'color',
    'settings'    => 'wave_thumb_background',
    'label'       => __( 'Wave Thumbnail Background Color', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => '#222',
    'choices'     => [
        'alpha' => true,
    ],

    'required'    => array(
        array(
            'setting'  => 'product_wave_style',
            'operator' => '==',
            'value'    => 'standard',
        ),
    ),

    'output' => array(
        array(
            'element'  => '.awp-player-thumb-wrapper',
            'property' => 'background',
        ),
    )
] );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'color',
    'settings'    => 'wave_color',
    'label'       => __( 'Wave Color', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => '#5a00f0',
    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),

] );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'color',
    'settings'    => 'wave_text_color',
    'label'       => __( 'Text Color', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => '#000046',

    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),


    'output' => array(
        array(
            'element'  => '.mayosis-floating-box-title > span,.mayosis-floating-box-title p,.awp-media-time-current,.awp-media-time-total,.default-product-template.product-main-header .single_main_header_products .mayosis-floating-box-title > span',
            'property' => 'color',
        ),

    )

] );


Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'color',
    'settings'    => 'wave_button_icon_color',
    'label'       => __( 'Button Color', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => '#28375a',
    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),

    'output' => array(
        array(
            'element'  => '.awp-icon-color,.mayosis_add_to_cart_wrap .edd_purchase_submit_wrapper .button.edd-submit:after',
            'property' => 'color',
        ),

        array(
            'element'  => '.awp-waveform.awp-visible wave',
            'property' => 'border-color',
            'suffix' => ' !important',
        ),

    )

] );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'color',
    'settings'    => 'wave_fixed_button_bg',
    'label'       => __( 'Button play bg Color(work on fixed mode only)', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => '#262626',
    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),

    'output' => array(
        array(
            'element'  => '.mayosis-audio-template-play-button a',
            'property' => 'background-color',
        ),

    )

] );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'color',
    'settings'    => 'wave_fixed_button_text',
    'label'       => __( 'Button play icon Color(work on fixed mode only)', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => '#D9D9D9',
    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),

    'output' => array(
        array(
            'element'  => '.mayosis-audio-template-play-button a',
            'property' => 'color',
        ),

    )

] );
Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'color',
    'settings'    => 'playlist_bg',
    'label'       => __( 'Playlist Background Color', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => '#f0f4f7',
    'choices'     => [
        'alpha' => true,
    ],

    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),

    'output' => array(
        array(
            'element'  => '.awp-playlist-holder',
            'property' => 'background',
        ),
    )
] );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'color',
    'settings'    => 'playlist_text',
    'label'       => __( 'Playlist Title Color', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => '#000046',
    'choices'     => [
        'alpha' => true,
    ],

    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),

    'output' => array(
        array(
            'element'  => '.awp-playlist-title',
            'property' => 'color',
            'suffix' =>' !important'
        ),
    )
] );

Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'color',
    'settings'    => 'playlist_thumbnail_bg',
    'label'       => __( 'Thumbnail Background', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => '#222',
    'choices'     => [
        'alpha' => true,
    ],

    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),

    'output' => array(
        array(
            'element'  => '.awp-player-thumb-wrapper',
            'property' => 'background',
            'suffix' =>' !important'
        ),
    )
] );
Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'dimensions',
    'settings'    => 'wave_padding',
    'label'       => esc_html__( 'Wave Player Padding', 'mayosis-core' ),
    'section'     => 'audio_template',
    'required'    => array(
        array(
            'setting'  => 'product_wave_audio',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),

    'output' => array(
        array(
            'element'  => '.mayosis_audio_wave_container'
        ),

    ),

    'default'     => [
        'padding-top'    => '16px',
        'padding-bottom' => '16px',
        'padding-left'   => '16px',
        'padding-right'  => '16px',
    ],


] );
Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'audio_template_taxonomoy',
    'label'       => esc_html__( 'Audio Custom Taxonomoy', 'mayosis-core' ),
    'description' => 'Enable this option for use playlist & artist options',
    'section'     => 'audio_template',
    'default'     => 'hide',
    'priority'    => 10,
    'choices'     => [
        'show'   => esc_html__( 'Show', 'mayosis-core' ),
        'hide' => esc_html__( 'Hide', 'mayosis-core' ),
    ],
] );
Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'product_ae_playlist_fes',
    'label'       => esc_html__( 'Audio Playlist for FES', 'mayosis-core' ),
    'section'     => 'audio_template',
    'description' => 'After enable this option please use action hook mayosis_audio_playlist_hook on FES Submission Form',
    'default'     => 'hide',
    'priority'    => 10,
    'choices'     => [
        'show'   => esc_html__( 'Enable', 'mayosis-core' ),
        'hide' => esc_html__( 'Disable', 'mayosis-core' ),
    ],

    'required'    => array(
        array(
            'setting'  => 'audio_template_taxonomoy',
            'operator' => '==',
            'value'    => 'show',
        ),
    ),
] );


Mayosis_Option::add_field( 'mayo_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'title_player_button_state',
    'label'       => esc_html__( 'Audio Player Button Beside Title', 'mayosis-core' ),
    'section'     => 'audio_template',
    'default'     => 'show',
    'priority'    => 10,
    'choices'     => [
        'show'   => esc_html__( 'Show', 'mayosis-core' ),
        'hide' => esc_html__( 'hide', 'mayosis-core' ),
    ],
] );