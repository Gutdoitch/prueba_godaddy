<?php
global $builder_items;
Mayosis_Option::add_section( 'header-layout', array(
'title'       => __( 'Header Layout', 'mayosis-core' ),
'panel'       => 'header',
) );

Mayosis_Option::add_field( 'mayo_config',  array(
	'type'        => 'text',
	'settings'     => 'mayosis_version',
	'label'       => __( 'Mayosis Version', 'mayosis-admin' ),
	'section'     => 'header-layout',
	'default'     => '',
));

Mayosis_Option::add_field( '', array(
'type'        => 'custom',
'settings' => 'custom_title_header_layout_top',
'label'       => __( '', 'mayosis-core' ),
'section'     => 'header-layout',
'default'     => '<div class="options-title">Top Header</div>',
) );

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'topbar_elements_left',
'label'       => __( 'Left Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'transport' => $transport,
'choices'     => $builder_items
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'topbar_elements_center',
'label'       => __( 'Center Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'default'     => array(),
'transport' => $transport,
'choices'     => $builder_items
));


Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'topbar_elements_right',
'label'       => __( 'Right Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'transport' => $transport,
'choices'     => $builder_items
));


Mayosis_Option::add_field( '', array(
'type'        => 'custom',
'settings' => 'custom_title_header_layout_main',
'label'       => __( '', 'mayosis-core' ),
'section'     => 'header-layout',
'default'     => '<div class="options-title">Main Header</div>',
) );

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_elements_left',
'label'       => __( 'Main Header Left Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple' => 5,
'transport' => $transport,
'default'     => mayosis_header_elements_left(),
'choices'     => $builder_items
));


Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_elements_center',
'label'       => __( 'Main Header Center Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'transport' => $transport,
'default'     => mayosis_header_elements_center(),
'multiple' => 5,
'choices'     => $builder_items
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_elements_right',
'label'       => __( 'Main Header Right Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'transport' => $transport,
'multiple' => 5,
'default' => mayosis_header_elements_right(),
'choices'     => $builder_items
));


Mayosis_Option::add_field( '', array(
'type'        => 'custom',
'settings' => 'custom_title_header_layout_bottom',
'label'       => __( '', 'mayosis-core' ),
'section'     => 'header-layout',
'default'     => '<div class="options-title">Bottom Header</div>',
) );

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_elements_bottom_left',
'label'       => __( 'Left Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'transport' => $transport,
'choices'     => $builder_items
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_elements_bottom_center',
'label'       => __( 'Center Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'transport' => $transport,
'choices'     => $builder_items
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_elements_bottom_right',
'label'       => __( 'Right Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'transport' => $transport,
'choices'     => $builder_items
));



Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_mobile_elements_top',
'label'       => __( 'Mobile Top', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'transport' => $transport,
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_mobile_elements_left',
'label'       => __( 'Left Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'default' => mayosis_header_mobile_elements_left(),
'transport' => $transport,
'multiple'    => 5,
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_mobile_elements_center',
'label'       => __( 'Left Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'transport' => $transport,
'multiple'    => 5,
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_mobile_elements_right',
'label'       => __( 'Left Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'transport' => $transport,
'default' => mayosis_header_mobile_elements_right(),
'choices'     => $builder_items
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_mobile_elements_bottom',
'label'       => __( 'Bottom Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'default'     => array(),
'transport' => $transport,
'choices'     => $builder_items
));


Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_mobile_sidebar_left',
'label'       => __( 'Sidebar Top Left Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'default'     => array(),
'transport' => $transport,
'choices'     => $builder_items
));


Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_mobile_sidebar_right',
'label'       => __( 'Sidebar Top Right Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'default'     => array(),
'transport' => $transport,
'choices'     => $builder_items
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_mobile_elements_sidebar_main',
'label'       => __( 'Sidebar Main Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'default'     => array(),
'transport' => $transport,
'choices'     => $builder_items
));


Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_mobile_sidebar_bottom_left',
'label'       => __( 'Sidebar Bottom Left Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'transport' => $transport,
'choices'     => $builder_items
));

Mayosis_Option::add_field( 'mayo_config',  array(
'type'        => 'select',
'settings'     => 'header_mobile_sidebar_bottom_right',
'label'       => __( 'Sidebar Bottom Right Elements', 'mayosis-core' ),
'section'     => 'header-layout',
'multiple'    => 5,
'transport' => $transport,
'choices'     => $builder_items
));