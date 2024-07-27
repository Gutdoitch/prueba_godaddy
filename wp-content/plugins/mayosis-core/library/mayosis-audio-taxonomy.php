<?php
$fesplayliststate= get_theme_mod( 'product_ae_playlist_fes', 'hide' );
// Register Taxonomy Artist
function mayosis_artist_taxonomy() {

	$labels = array(
		'name'              => _x( 'Artists', 'taxonomy general name', 'mayosis-core' ),
		'singular_name'     => _x( 'Artist', 'taxonomy singular name', 'mayosis-core' ),
		'search_items'      => __( 'Search Artists', 'mayosis-core' ),
		'all_items'         => __( 'All Artists', 'mayosis-core' ),
		'parent_item'       => __( 'Parent Artist', 'mayosis-core' ),
		'parent_item_colon' => __( 'Parent Artist:', 'mayosis-core' ),
		'edit_item'         => __( 'Edit Artist', 'mayosis-core' ),
		'update_item'       => __( 'Update Artist', 'mayosis-core' ),
		'add_new_item'      => __( 'Add New Artist', 'mayosis-core' ),
		'new_item_name'     => __( 'New Artist Name', 'mayosis-core' ),
		'menu_name'         => __( 'Artist', 'mayosis-core' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'mayosis-core' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
	);
	register_taxonomy( 'artist', array('download'), $args );

}
add_action( 'init', 'mayosis_artist_taxonomy' );

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5eb4d5ad67447',
	'title' => 'Playlist',
	'fields' => array(
		array(
			'key' => 'field_5eb4d5cabe4cc',
			'label' => 'Audio Playlist',
			'name' => 'playlist_repeater',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => 'Add New Audio',
			'sub_fields' => array(
				array(
					'key' => 'field_5eb4d5e5be4cd',
					'label' => 'Song Title',
					'name' => 'song_title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5eb4d62bbe4cf',
					'label' => 'Song Cover Image',
					'name' => 'song_cover_image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'url',
					'preview_size' => 'medium',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
				array(
					'key' => 'field_5eb631f3b514a',
					'label' => 'Songs',
					'name' => 'cover_songs',
					'type' => 'file',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'library' => 'all',
					'min_size' => '',
					'max_size' => '',
					'mime_types' => 'mp3',
				),
				
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'download',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;


if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5eaaede67eb31',
	'title' => 'Artist Fields',
	'fields' => array(
		array(
			'key' => 'field_5eaaee0b351dd',
			'label' => 'Artists Biography',
			'name' => 'artists_biography',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_5eaaee415a998',
			'label' => 'Artist Image',
			'name' => 'artist_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'artist',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;

 if($fesplayliststate== "show"){
function mayosis_audio_fe_submit( $form_id, $post_id, $form_settings) {

    $new_post = array(
        // PUT IN YOUR OWN FIELD GROUP ID(s)
        'post_id' => $post_id,
        'field_groups' => array('group_5eb4d5ad67447'), // Create post field group ID(s)
        'form' => false,
        'return' => '', 
         'post_title' => false,
         'post_content' => false,
    );
    acf_form( $new_post );

 
}


add_action( 'mayosis_audio_playlist_hook', 'mayosis_audio_fe_submit', 10, 3 );
add_action( 'save_post', 'mayosis_audio_playlist_fe_submission' );

function mayosis_audio_playlist_fe_submission($post_id) {
  
   $field_key = "field_5eb4d5cabe4cc";
    $posted_flexible = $_POST["acf"][$field_key];
    if ( isset( $posted_flexible ) ) {
    $value =  (get_field($field_key) ? get_field($field_key) : array());
    foreach($posted_flexible as $layout){
        $value[] = array("song_title" => $layout['field_5eb4d5e5be4cd'], "cover_songs" => $layout['field_5eb631f3b514a'], "song_cover_image" => $layout['field_5eb4d62bbe4cf']);
    }
    update_field( $field_key, $value, $post_id );
        
    }

}

}

