<?php

Mayosis_Option::add_section( 'header_breadcrumbs', array(
	'title'       => __( 'Breadcrumbs', 'mayosis-core' ),
	'panel'       => 'header',
) );




Mayosis_Option::add_field( 'mayo_config',  array(
    'type'        => 'dimensions',
	'settings'    => 'blog_padding',
	'label'       => esc_attr__( 'Blog Breadcrumb Padding', 'mayosis-core' ),
	'description' => esc_attr__( 'Change Breadcrumb Padding', 'mayosis-core' ),
	'section'     => 'header_breadcrumbs',
	'default'     => array(
		'padding-top'    => '80px',
		'padding-bottom' => '80px',
		'padding-left'   => '0px',
		'padding-right'  => '0px',
	),
));