<?php
class ebookebookoptionsMetabox {
	private $screen = array(
		'download',
	);
	private $meta_fields = array(
		array(
			'label' => 'ASIN',
			'id' => 'm_asin',
			'default' => '',
			'type' => 'text',
		),
		array(
			'label' => 'ISBN',
			'id' => 'm_isbn',
			'default' => '',
			'type' => 'text',
		),
		array(
			'label' => 'Publisher',
			'id' => 'm_publisher',
			'default' => '',
			'type' => 'text',
		),

		array(
			'label' => 'Publication Date',
			'id' => 'm_pbdate',
			'default' => '',
			'type' => 'text',
		),
		
		array(
			'label' => 'Language',
			'id' => 'm_language',
			'default' => '',
			'type' => 'text',
		),
		
		array(
			'label' => 'Print length',
			'id' => 'm_pleanth',
			'default' => '',
			'type' => 'text',
		),
		array(
			'label' => 'PDF Preview File',
			'id' => 'pdf_preview_url',
			'default' => '',
			'type' => 'text',
		),
		
		
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'ebookoptions',
				__( 'eBook Information', 'mayosis-core' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'normal',
				'high'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'ebookoptions_data', 'ebookoptions_nonce' );
		$this->field_generator( $post );
	}
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			$idrox = $meta_field['id'];
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input,$idrox );
		}
		echo '<div class="mayosis-meta-admin">' . $output . '</div>';
	}
	public function format_rows( $label, $input,$idrox ) {
		return '<div class="mayosis-admin-col-6">'.$label.'<div class="mayosis-input-box-admin '.$idrox.'">'.$input.'</div></div>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['ebookoptions_nonce'] ) )
			return $post_id;
		$nonce = $_POST['ebookoptions_nonce'];
		if ( !wp_verify_nonce( $nonce, 'ebookoptions_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('ebookebookoptionsMetabox')) {
	new ebookebookoptionsMetabox;
};
