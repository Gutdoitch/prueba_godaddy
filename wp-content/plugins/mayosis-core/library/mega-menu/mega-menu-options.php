<?php
// Control core classes for avoid errors
if( class_exists( 'MYSF' ) ) {

  //
  // Set a unique slug-like ID
  $prefix = '_xoopic_nav_options';

  //
  // Create profile options
  MYSF::createNavMenuOptions( $prefix, array(
    'data_type' => 'unserialize', // The type of the database save options. `serialize` or `unserialize`
  ) );

  //
  // Create a section
  MYSF::createSection( $prefix, array(
    'fields' => array(

      array(
        'id'    => 'menu_item_icon',
        'type'  => 'icon',
        'title' => 'Icon',
        'class' => 'xpc-sub-depth-all',
      ),
         array(
  'id'      => 'menu-item-enable_label',
  'type'    => 'checkbox',
  'title'   => 'Menu Label Enable',
  'label'   => 'Enable',
  'class' => 'xpc-label-block-m',
  'default' => false // or false
),
 array(
  'id'          => 'menu-item-label-type',
  'type'        => 'select',
  'title'       => 'Menu Label Type',
  'placeholder' => 'Select an option',
  'options' => array(
						'blue' => esc_attr__( 'Blue', 'xoopic' ),
						'red' => esc_attr__( 'Red', 'xoopic' ),
						'brown' => esc_attr__( 'Brown', 'xoopic' ),
						'yellow' => esc_attr__( 'Yellow', 'xoopic' ),
						'green' => esc_attr__( 'Green', 'xoopic' ),
						'black' => esc_attr__( 'Black', 'xoopic' ),
						'grey' => esc_attr__( 'Grey', 'xoopic' ),
						'aqua' => esc_attr__( 'Aqua', 'xoopic' ),
						'purple' => esc_attr__( 'Purple', 'xoopic' ),
						'olive' => esc_attr__( 'Olive', 'xoopic' ),
	
					),
  'default'     => 'blue',
  'class' => 'xpc-label-block-m',
  'dependency' => array( 'menu-item-enable_label', '==', 'true' ),

),
array(
  'id'      => 'menu-label_xpc_text',
  'type'    => 'text',
  'title'   => 'Label Text',
  'default' => 'Popular',
  'class' => 'xpc-label-block-m',
   'dependency' => array( 'menu-item-enable_label', '==', 'true' ),
),


      array(
  'id'      => 'menu-item-xpc_is_megamenu',
  'type'    => 'checkbox',
  'title'   => 'Mega Menu',
  'label'   => 'Enable',
  'class' => 'xpc-sub-depth-0 xpc-mega-block-nav',
  'default' => false // or false
),



array(
  'id'          => 'menu-item-dropdown-position',
  'type'        => 'select',
  'title'       => 'Dropdown Start From',
  'placeholder' => 'Select an option',
  'options' => array(
						'start-0' => esc_attr__( 'Left', 'xoopic' ),
						'center' => esc_attr__( 'Center', 'xoopic' ),
						'end-0' => esc_attr__( 'Right', 'xoopic' ),
	
					),
  'default'     => 'start-0',
   'class' => 'xpc-sub-depth-0 xpc-mega-block-nav',
   'dependency' => array( 'menu-item-xpc_is_megamenu', '==', 'true' ),
),

  array(
  'id'      => 'menu-item-xpc_custom_width',
  'type'    => 'checkbox',
  'title'   => 'Mega Sub Custom Width',
  'label'   => 'Enable',
  'class' => 'xpc-sub-depth-0 xpc-mega-block-nav',
   'dependency' => array( 'menu-item-xpc_is_megamenu', '==', 'true' ),
  'default' => false // or false
),

array(
  'id'    => 'menu_item-xpc-sub-width',
  'type'  => 'slider',
  'min'     => 240,
  'max'     => 2070,
  'step'    => 30,
  'unit'    => 'px',
  'default' => 600,
    'class' => 'xpc-sub-depth-0 xpc-mega-block-nav',
  'title' => 'Submenu Width',
    'dependency' => array( 'menu-item-xpc_custom_width', '==', 'true' ),
),

array(
  'id'    => 'menu_item-xpc-sub-pull-left',
  'type'  => 'slider',
  'min'     => 0,
  'max'     => 600,
  'step'    => 20,
  'unit'    => '%',
  'default' => -110,
    'class' => 'xpc-sub-depth-0 xpc-mega-block-nav',
  'title' => 'Submenu Left Pull',
    'dependency' => array( 'menu-item-xpc_custom_width', '==', 'true' ),
),



array(
  'id'      => 'menu-item-xpc_is_column_item',
  'type'    => 'checkbox',
  'title'   => 'Convert to column item',
  'label'   => 'Enable',
  'default' => false, // or false
  'class' => 'xpc-hide-depth-0 column-xpc-c',
  
),

array(
  'id'      => 'menu-item-xpc_hide_column_label',
  'type'    => 'checkbox',
  'title'   => 'Hide The Label',
  'label'   => 'Enable',
  'class' => 'xpc-hide-depth-0 column-xpc-c',
  'default' => false,
   'dependency' => array( 'menu-item-xpc_is_column_item', '==', 'true' ),
),

array(
  'id'          => 'menu-item-xpc_is_column_padding',
  'type'        => 'select',
  'title'       => 'Column Padding',
  'placeholder' => 'Select an option',
  'options' => array(
                        '0' => esc_attr__( 'No', 'xoopic' ),
						'1' => esc_attr__( 'Normal', 'xoopic' ),
						'2' => esc_attr__( 'Small', 'xoopic' ),
					),
  'default'     => '0',
  'class' => 'xpc-hide-depth-0 column-xpc-c',
   'dependency' => array( 'menu-item-xpc_is_column_item', '==', 'true' ),
),
array(
  'id'          => 'menu-item-xpc_columns_number',
  'type'        => 'select',
  'title'       => 'Sub Menu Column',
  'placeholder' => 'Select an option',
  'options' => array(
						'2' => esc_attr__( '2 Columns (~16% of Mega menu)', 'xoopic' ),
						'3' => esc_attr__( '3 Columns (25% of Mega menu)', 'xoopic' ),
						'4' => esc_attr__( '4 Columns (~33% of Mega menu)', 'xoopic' ),
						'6' => esc_attr__( '6 Columns (50% of Mega menu)', 'xoopic' ),
						'12' => esc_attr__( '12 Columns (100% of Mega menu)', 'xoopic' ),
					),
  'default'     => '3',
  'class' => 'xpc-hide-depth-0 column-xpc-c',
   'dependency' => array( 'menu-item-xpc_is_column_item', '==', 'true' ),
),

array(
  'id'          => 'menu-item-xpc_columns_line',
  'type'        => 'select',
  'title'       => 'Add column line',
  'placeholder' => 'Select an option',
  'options' => array(
						'none' => esc_attr__( 'Disabled', 'xoopic' ),
						'xpc-menu-line-right' => esc_attr__( 'Right', 'xoopic' ),
						'xpc-menu-line-top' => esc_attr__( 'Top', 'xoopic' ),
						'xpc-menu-line-right-top' => esc_attr__( 'Right & Top', 'xoopic' ),
					),
  'default'     => 'none',
  'class' => 'xpc-hide-depth-0 column-xpc-c',
  'dependency' => array( 'menu-item-xpc_is_column_item', '==', 'true' ),
),



array(
  'id'      => 'menu-item-xpc_is_image_item',
  'type'    => 'checkbox',
  'title'   => 'Convert to box item',
  'label'   => 'Enable',
  'default' => false, // or false
  'class' => 'xpc-hide-depth-0 box-xpc-c',
),

array(
  'id'      => 'menu-item-xpc_box_title',
  'type'    => 'text',
  'title'   => 'Box Title',
  'default' => '',
   'class' => 'xpc-hide-depth-0 box-xpc-c',
   'dependency' => array( 'menu-item-xpc_is_image_item', '==', 'true' ),
),
array(
  'id'      => 'menu-item-xpc_box_text',
  'type'    => 'text',
  'title'   => 'Box text',
  'default' => '',
   'class' => 'xpc-hide-depth-0 box-xpc-c',
   'dependency' => array( 'menu-item-xpc_is_image_item', '==', 'true' ),
),

array(
  'id'      => 'menu-item-xpc_bg_image',
  'type'    => 'text',
  'title'   => 'Box BG Image/video',
   'class' => 'xpc-hide-depth-0 box-xpc-c box-xpc-media-nav',
   'dependency' => array( 'menu-item-xpc_is_image_item', '==', 'true' ),
),

array(
  'id'          => 'menu-item-xpc_box_style',
  'type'        => 'select',
  'title'       => 'Box Style',
  'placeholder' => 'Select an option',
 'options' => array(
                        'no-padding' => esc_attr__( 'No Padding', 'xoopic' ),
						'default' => esc_attr__( 'Default', 'xoopic' ),
						'padding' => esc_attr__( 'With padding', 'xoopic' ),
						'padding-no-top' => esc_attr__( 'With padding (No padding top)', 'xoopic' ),
					),
  'default'     => 'default',
   'class' => 'xpc-hide-depth-0 box-xpc-c',
   'dependency' => array( 'menu-item-xpc_is_image_item', '==', 'true' ),
),

array(
  'id'      => 'menu_item_box_shortcode',
  'type'    => 'text',
  'title'   => 'Enter Mayosis Block Shortcode',
   'class' => 'xpc-hide-depth-0 box-xpc-c',
   'dependency' => array( 'menu-item-xpc_is_image_item', '==', 'true' ),
  'default' => ''
),

array(
  'id'      => 'menu-item-xpc_is_hide_menu_link',
  'type'    => 'checkbox',
  'title'   => 'Show Menu Text',
  'label'   => 'Enable',
  'default' => false, // or false
  'class' => 'xpc-hide-depth-0 box-xpc-c',
  'dependency' => array( 'menu-item-xpc_is_image_item', '==', 'true' ),
),
array(
  'id'      => 'menu-item-xpc_is_box_dark',
  'type'    => 'checkbox',
  'title'   => 'Dark Mode',
  'label'   => 'Enable',
  'default' => false, // or false
  'class' => 'xpc-hide-depth-0 box-xpc-c',
  'dependency' => array( 'menu-item-xpc_is_image_item', '==', 'true' ),
),

array(
  'id'      => 'menu-item-xpc_is_full_height',
  'type'    => 'checkbox',
  'title'   => 'Box Full Height',
  'label'   => 'Enable',
  'default' => false,
   'class' => 'xpc-hide-depth-0 box-xpc-c',// or false
   'dependency' => array( 'menu-item-xpc_is_image_item', '==', 'true' ),
),
    )
  ) );

}
