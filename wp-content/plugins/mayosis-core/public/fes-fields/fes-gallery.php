<?php
class FES_vdw_gallery_id_Field extends FES_Field {
    
use \EDD\FES\Fields\Traits\NeedsCompatStyle;

	/** @var string Version of field */
	public $version = '1.0.0';

	/** @var bool For 3rd parameter of get_post/user_meta */
	public $single = true;

	/** @var array Supports are things that are the same for all fields of a field type. Like whether or not a field type supports jQuery Phoenix. Stored in obj, not db. */
	public $supports = array(
		'multiple'    => true,
		'is_meta'     => true,  // in object as public (bool) $meta;
		'forms'       => array(
			'registration'   => false,
			'submission'     => true,
			'vendor-contact' => false,
			'profile'        => true,
			'login'          => false,
		),
		'position'    => 'extension',
		'permissions' => array(
			'can_remove_from_formbuilder' => true,
			'can_change_meta_key'         => true,
			'can_add_to_formbuilder'      => true,
		),
		'template'    => 'vdw_gallery_id',
		'title'       => 'Gallery',
		'phoenix'     => false,
	);

	/** @var array Characteristics are things that can change from field to field of the same field type. Like the placeholder between two file_upload fields. Stored in db. */
	public $characteristics = array(
		'name'        => 'vdw_gallery_id',
		'template'    => 'vdw_gallery_id',
		'public'      => true,
		'required'    => false,
		'label'       => '',
		'css'         => '',
		'default'     => '',
		'size'        => '',
		'help'        => '',
		'placeholder' => '',
		'count'       => '1',
		'max_size'    => '',
		'extension'   => array(),
		'single'      => false,
	);


	public function set_title() {
		$this->supports['title'] = apply_filters( 'fes_' . $this->name() . '_field_title', _x( 'Gallery', 'FES Field title translation', 'edd_fes' ) );
	}

	/** Returns the HTML to render a field in admin */
	public function render_field_admin( $user_id = -2, $readonly = -2 ) {

		$user_id  = apply_filters( 'fes_render_file_upload_field_user_id_admin', fes_get_user_id( $user_id ), $this->id );
		$readonly = apply_filters( 'fes_render_file_upload_field_readonly_admin', $this->is_readonly( $readonly ), $user_id, $this->id );
		$value    = $this->get_field_value_admin( $this->save_id, $user_id, $readonly );

		$uploaded_items = $value;
		if ( ! is_array( $uploaded_items ) || empty( $uploaded_items ) ) {
			$uploaded_items = array( 0 => '' );
		}

		$max_files = 0;
		if ( $this->characteristics['count'] > 0 ) {
			$max_files = $this->characteristics['count'];
		}

		$output  = '';
		$output .= sprintf( '<div class="fes-el %1s %2s %3s">', $this->template(), $this->name(), $this->css() );
		$output .= $this->label( $readonly );

		ob_start(); ?>
			<div class="fes-fields">
				 <table class="<?php echo sanitize_key( $this->name() ); ?>">
					<thead>
						<tr>
							<td class="fes-file-column"><?php _e( 'File URL', 'edd_fes' ); ?></td>
							<?php if ( empty( $this->characteristics['single'] ) || $this->characteristics['single'] !== 'yes' ) { ?>
									 <td class="fes-remove-column">&nbsp;</td>
							<?php } ?>
						 </tr>
					</thead>
					<tbody class="fes-variations-list-<?php echo sanitize_key( $this->name() ); ?>">
							 <input type="hidden" id="fes-upload-max-files-<?php echo sanitize_key( $this->name() ); ?>" value="<?php echo $max_files; ?>" />
							<?php
							foreach ( $uploaded_items as $index => $attach_id ) {
								$download = wp_get_attachment_url( $attach_id ); ?>
								<tr class="fes-single-variation" data-key="<?php echo esc_attr( $index ); ?>">
									<td class="fes-url-group">
										<div class="fes-url-row">
											<input type="text" class="fes-file-value" placeholder="<?php _e( "https://", 'edd_fes' ); ?>" name="<?php echo esc_attr( $this->name() ); ?>[<?php echo esc_attr( $index ); ?>]" value="<?php echo esc_attr( $download ); ?>" />
										</div>
										<div class="fes-url-choose-row">
											<button class="edd-submit button upload_file_button" data-choose="<?php _e( 'Choose Image', 'edd_fes' ); ?>" data-update="<?php _e( 'Insert file URL', 'edd_fes' ); ?>">
											<?php echo str_replace( ' ', '&nbsp;', __( 'Choose Image', 'edd_fes' ) ); ?></button>
										</div>
									</td>
									 <?php if ( empty( $this->characteristics['single'] ) || $this->characteristics['single'] !== 'yes' ) { ?>
										<td class="fes-delete-row">
											<button class="fes-action-button edd-fes-delete delete">
												<span class="screen-reader-text"><?php esc_html_e( 'Delete File', 'edd_fes' ); ?></span>
												<?php esc_html_e( '&times;', 'edd_fes' ); ?>
											</button>
										</td>
									<?php } ?>
								</tr>
							<?php } ?>
					</tbody>
					<?php if ( empty( $this->characteristics['count'] ) || $this->characteristics['count'] > 1 ) : ?>
					<tfoot>
						<tr>
							<th colspan="5">
								<button class="edd-submit button insert-file-row" id="<?php echo sanitize_key( $this->name() ); ?>"><?php esc_html_e( 'Add Image', 'edd_fes' ); ?></button>
							</th>
						</tr>
					</tfoot>
					<?php endif; ?>
				</table>
			</div> <!-- .fes-fields -->
		<?php
		$output .= ob_get_clean();
		$output .= '</div>';
		return $output;
	}

	/** Returns the HTML to render a field in frontend */
	public function render_field_frontend( $user_id = -2, $readonly = -2 ) {
		$this->enqueue_compatibility_css();
		$user_id  = apply_filters( 'fes_render_file_upload_field_user_id_frontend', fes_get_user_id( $user_id ), $this->id );
		$readonly = apply_filters( 'fes_render_file_upload_field_readonly_frontend', $this->is_readonly( $readonly ), $user_id, $this->id );
		$value    = $this->get_field_value_frontend( $this->save_id, $user_id, $readonly );

		$uploaded_items = $value;
		if ( ! is_array( $uploaded_items ) || empty( $uploaded_items ) ) {
			$uploaded_items = array( 0 => '' );
		}

		$max_files = 0;
		if ( $this->characteristics['count'] > 0 ) {
			$max_files = $this->characteristics['count'];
		}
		$output  = '';
		$output .= sprintf( '<div class="fes-el %1s %2s %3s">', $this->template(), $this->name(), $this->css() );
		$output .= $this->label( $readonly );
		ob_start(); ?>
			<div class="fes-fields">
				 <table class="<?php echo sanitize_key( $this->name() ); ?>">
					<thead>
						<tr>
							<th class="fes-file-column"><?php _e( 'File URL', 'edd_fes' ); ?></th>
							<?php if ( empty( $this->characteristics['single'] ) || $this->characteristics['single'] !== 'yes' ) { ?>
									 <th class="fes-remove-column">&nbsp;</th>
							<?php } ?>
						 </tr>
					</thead>
					<tbody class="fes-variations-list-<?php echo sanitize_key( $this->name() ); ?>">
							 <input type="hidden" id="fes-upload-max-files-<?php echo sanitize_key( $this->name() ); ?>" value="<?php echo $max_files; ?>" />
							<?php
							foreach ( $uploaded_items as $index => $attach_id ) {
								$download = wp_get_attachment_url( $attach_id ); ?>
								<tr class="fes-single-variation" data-key="<?php echo esc_attr( $index ); ?>">
									<td class="fes-url-group">
										<div class="fes-url-row">
											<input type="text" class="fes-file-value" data-formid="<?php echo $this->form;?>" data-fieldname="<?php echo $this->name();?>" placeholder="<?php _e( "http://", 'edd_fes' ); ?>" name="<?php echo $this->name(); ?>[<?php echo esc_attr( $index ); ?>]" value="<?php echo esc_attr( $download ); ?>" />
										</div>
										<div class="fes-url-choose-row">
											<button class="edd-submit button upload_file_button" data-choose="<?php _e( 'Choose Image', 'edd_fes' ); ?>" data-update="<?php _e( 'Insert file URL', 'edd_fes' ); ?>">
											<?php echo str_replace( ' ', '&nbsp;', __( 'Choose Image', 'edd_fes' ) ); ?></button>
										</div>
									</td>
									<?php if ( empty( $this->characteristics['single'] ) || $this->characteristics['single'] !== 'yes' ) { ?>
										<td class="fes-delete-row">
											<button class="fes-action-button button edd-fes-delete delete">
												<span class="screen-reader-text"><?php esc_html_e( 'Delete File', 'edd_fes' ); ?></span>
												<?php esc_html_e( '&times;', 'edd_fes' ); ?>
											</button>
										</td>
									<?php } ?>
								</tr>
							<?php } ?>
					</tbody>
					<?php if ( empty( $this->characteristics['count'] ) || $this->characteristics['count'] > 1 ) : ?>
					<tfoot>
						<tr>
							<th colspan="5">
								<button class="edd-submit button insert-file-row" id="<?php echo sanitize_key( $this->name() ); ?>"><?php esc_html_e( 'Add Image', 'edd_fes' ); ?></button>
							</th>
						</tr>
					</tfoot>
					<?php endif; ?>
				</table>
			</div> <!-- .fes-fields -->
		<?php
		$output .= ob_get_clean();
		$output .= '</div>';
		return $output;
	}

	public function display_field( $user_id = -2, $single = false ) {
		$user_id = apply_filters( 'fes_display_' . $this->template() . '_field_user_id', fes_get_user_id( $user_id ), $this->id );
		$value   = $this->get_field_value_frontend( $this->save_id, $user_id );
		ob_start(); ?>

			<?php if ( $single ) { ?>
			<table class="fes-display-field-table">
			<?php } ?>

				<tr class="fes-display-field-row <?php echo $this->template(); ?>" id="<?php echo $this->name(); ?>">
					<td class="fes-display-field-label"><?php echo $this->get_label(); ?></td>
					<td class="fes-display-field-values">
						<?php
						$uploads = array();
						if ( is_array( $value ) ) {
							foreach ( $value as $attachment_id ) {
								$uploads[] = wp_get_attachment_link( $attachment_id, 'thumbnail', false, true );
							}
							$value = implode( '<br />', $uploads );
						}
						echo $value;
						?>
					</td>
				</tr>
			<?php if ( $single ) { ?>
			</table>
			<?php } ?>
		<?php
		return ob_get_clean();
	}

	public function formatted_data( $user_id = -2 ) {
		$user_id   = apply_filters( 'fes_formatted_' . $this->template() . '_field_user_id', fes_get_user_id( $user_id ), $this->id );
		$value     = $this->get_field_value_frontend( $this->save_id, $user_id );
		$uploads = array();
		if ( is_array( $value ) ) {
			foreach ( $value as $attachment_id ) {
				$uploads[] = wp_get_attachment_link( $attachment_id, 'thumbnail', false, true );
			}
			$value = implode( '<br />', $uploads );
		}
		return $value;
	}

	/** Returns the HTML to render a field for the formbuilder */
	public function render_formbuilder_field( $index = -2, $insert = false ) {
		$max_files_name   = sprintf( '%s[%d][count]', 'fes_input', $index );
		$max_size_name    = sprintf( '%s[%d][max_size]', 'fes_input', $index);
		$extensions_value = isset( $this->characteristics['extension'] ) ? $this->characteristics['extension'] : array();
		$max_size_value   = isset( $this->characteristics['max_size'] ) ? $this->characteristics['max_size'] : false;
		ob_start();
		?>
		<li class="custom-field file_upload vdw_gallery_id">
			<?php $this->legend( $this->title(), $this->get_label(), $this->can_remove_from_formbuilder() ); ?>
			<?php FES_Formbuilder_Templates::hidden_field( "[$index][template]", $this->template() ); ?>

			<?php FES_Formbuilder_Templates::field_div( $index, $this->name(), $this->characteristics, $insert ); ?>
				<?php FES_Formbuilder_Templates::public_radio( $index, $this->characteristics, $this->form_name ); ?>
				<?php FES_Formbuilder_Templates::standard( $index, $this ); ?>

				<div class="fes-form-rows edd_form_group">
					<label for="<?php echo esc_attr( $max_files_name ); ?>"><?php esc_html_e( 'Maximum number of files which can be uploaded', 'edd_fes' ); ?></label>
					<div class="edd-form-group__control">
						<input type="text" id="<?php echo esc_attr( $max_files_name ); ?>" class="edd-form-group__input" name="<?php echo esc_attr( $max_files_name ); ?>" value="<?php echo esc_attr( $this->characteristics['count'] ); ?>">
					</div>
				</div>
				<div class="fes-form-rows">
					<label for="<?php echo esc_attr( $max_size_name ); ?>"><?php esc_html_e( 'Max. file size (in MB). Leave empty or 0 for no limit.', 'edd_fes' ); ?></label>
					<div class="edd-form-group__control">
						<input type="text" id="<?php echo esc_attr( $max_size_name ); ?>" class="edd-form-group__input" name="<?php echo esc_attr( $max_size_name ); ?>" value="<?php echo esc_attr( $max_size_value ); ?>">
					</div>
				</div>

				<div class="fes-form-rows edd-form-group">
					<label for="fes_input<?php echo esc_attr( $index ); ?>_extension"><?php esc_html_e( 'Allowed Files', 'edd_fes' ); ?></label>

					<div class="edd-form-group__control">
						<?php
						$args = array(
							'options'          => fes_allowed_extensions(),
							'name'             => sprintf( '%s[%d][extension][]', 'fes_input', $index ),
							'class'            => 'edd-form-group__input',
							'id'               => sprintf( '%s_%d_extension', 'fes_input', $index ),
							'selected'         => $extensions_value,
							'chosen'           => true,
							'placeholder'      => __( 'Pick which file types to allow. Leave empty for all types.', 'edd_fes' ),
							'multiple'         => true,
							'show_option_all'  => false,
							'show_option_none' => false,
							'data'             => array( 'search-type' => 'no_ajax' ),
						);
						echo EDD()->html->select( $args );
						?>
					</div>
				</div>
			</div>
		</li>
		<?php

		return ob_get_clean();
	}

	public function validate( $values = array(), $save_id = -2, $user_id = -2 ) {

		$name = $this->name();

		$return_value = false;

		if ( $this->required() ) {
			if ( !empty( $values[ $name ] ) ) {
				if ( is_array( $values[ $name ] ) ){
					foreach( $values[ $name ] as $key => $file  ){
						if ( filter_var( $file, FILTER_VALIDATE_URL ) === false ) {
							// if that's not a url
							$return_value = __( 'Please enter a valid URL', 'edd_fes' );
							break;
						} else {

							if ( ! edd_is_local_file( $file ) ) {
								$return_value = __( 'Files must be uploaded through the upload form', 'edd_fes' );
							}
						}
					}
				} else {
					$return_value = __( 'Please fill out this field.', 'edd_fes' );
				}
			} else {
				$return_value = __( 'Please fill out this field.', 'edd_fes' );
			}
		}

		if ( ! $return_value ) {
			if ( !empty( $values[ $name ] ) ) {
				if ( is_array( $values[ $name ] ) ){
					foreach( $values[ $name ] as $key => $file  ){
						if ( filter_var( $file, FILTER_VALIDATE_URL ) !== false && ! empty( $this->characteristics['extension'] ) ){
							$parts = parse_url( $file );
							$file_type = wp_check_filetype( basename( $parts["path"] ) );
							$file_type = $file_type["ext"];
							if ( ! in_array( $file_type, $this->characteristics['extension'] ) ) {
								$allowed_types = implode( ', ', array_values( $this->characteristics['extension'] ) );
								// if that's not a url
								$return_value = sprintf( __( 'Please use files with one of these extensions: %s', 'edd_fes' ), $allowed_types );
								break;
							}
							if ( ! edd_is_local_file( $file ) ) {
								$return_value = __( 'Files must be uploaded through the upload form', 'edd_fes' );
								break;
							}
						}
					}
				}
			}
		}
		return apply_filters( 'fes_validate_' . $this->template() . '_field', $return_value, $values, $name, $save_id, $user_id );
	}

	public function sanitize( $values = array(), $save_id = -2, $user_id = -2 ) {
		$name = $this->name();
		if ( ! empty( $values[ $name ] ) ) {
			if ( is_array( $values[ $name ] ) ){
				foreach( $values[ $name ] as $key => $option  ){
					$values[ $name ][ $key ] = sanitize_text_field( trim( $values[ $name ][ $key ] ) );
				}
			}
		}
		return apply_filters( 'fes_sanitize_' . $this->template() . '_field', $values, $name, $save_id, $user_id );
	}

	public function save_field_admin( $save_id = -2, $value = '', $user_id = -2 ) {
		if ( $save_id == -2 ) {
			$save_id = $this->save_id;
		}

		$user_id  = apply_filters( 'fes_save_field_user_id_admin', fes_get_user_id( $user_id ), $save_id, $value );
		$value    = apply_filters( 'fes_save_field_value_admin', $value, $save_id, $user_id );

		do_action( 'fes_save_field_before_save_admin', $save_id, $value, $user_id );
		if ( !is_array( $value ) ) {
			return;
		}

		if ( $this->type === 'user' ) {
			delete_user_meta( $save_id, $this->name() );
			$ids = array();
			foreach ( $value as $file => $url ) {
				if ( empty ( $url ) ) {
					continue;
				}
				$attachment_id = fes_get_attachment_id_from_url( $url );
				$ids[] = $attachment_id;
			}
			update_user_meta( $save_id, $this->name(), $ids );
		} else if ( $this->type === 'post' ) {
			$ids = array();
			// We need to detach all previously attached files for this field. See #559
			$old_files = get_post_meta( $save_id, $this->name(), true );
			if ( ! empty( $old_files ) && is_array( $old_files ) ) {
				foreach ( $old_files as $file_id ) {
					global $wpdb;
					$wpdb->update(
						$wpdb->posts,
						array(
							'post_parent' => 0,
						),
						array(
							'ID' => $file_id,
						),
						array(
							'%d'
						),
						array(
							'%d'
						)
					);
				}
			}
			foreach ( $value as $file => $url ) {
				if ( empty ( $url ) ) {
					continue;
				}
				if ( ! EDD_FES()->vendors->user_is_admin() ) {
					$author_id = get_post_field( 'post_author', $save_id );
				} else {
					$author_id = 0;
				}
				$attachment_id = fes_get_attachment_id_from_url( $url, $author_id );
				fes_associate_attachment( $attachment_id, $save_id );
				$ids[] = $attachment_id;
			}
			update_post_meta( $save_id, $this->name(), $ids );
		}

		$this->value = $value;
		do_action( 'fes_save_field_after_save_admin', $save_id, $value, $user_id );
	}

	public function save_field_frontend( $save_id = -2, $value = array(), $user_id = -2 ) {
		if ( $save_id == -2 ) {
			$save_id = $this->save_id;
		}

		$user_id  = apply_filters( 'fes_save_field_user_id_frontend', fes_get_user_id( $user_id ), $save_id, $value );
		$value    = apply_filters( 'fes_save_field_value_frontend', $value, $save_id, $user_id );

		do_action( 'fes_save_field_before_save_frontend', $save_id, $value, $user_id );
		if ( !is_array( $value ) ) {
			return;
		}

		if ( $this->type === 'user' ) {
			delete_user_meta( $save_id, $this->name() );
			$ids = array();
			foreach ( $value as $file => $url ) {
				if ( empty ( $url ) ) {
					continue;
				}
				$attachment_id = fes_get_attachment_id_from_url( $url );
				$ids[] = $attachment_id;
			}
			update_user_meta( $save_id, $this->name(), $ids );
		} else if ( $this->type === 'post' ) {
			$ids = array();
			// We need to detach all previously attached files for this field. See #559
			$old_files = get_post_meta( $save_id, $this->name(), true );
			if ( ! empty( $old_files ) && is_array( $old_files ) ) {
				foreach ( $old_files as $file_id ) {
					global $wpdb;
					$wpdb->update(
						$wpdb->posts,
						array(
							'post_parent' => 0,
						),
						array(
							'ID' => $file_id,
						),
						array(
							'%d'
						),
						array(
							'%d'
						)
					);
				}
			}
			foreach ( $value as $file => $url ) {
				if ( empty ( $url ) ) {
					continue;
				}
				if ( ! EDD_FES()->vendors->user_is_admin() ) {
					$author_id = get_post_field( 'post_author', $save_id );
				} else {
					$author_id = 0;
				}
				$attachment_id = fes_get_attachment_id_from_url( $url, $author_id );
				fes_associate_attachment( $attachment_id, $save_id );

				$ids[] = $attachment_id;
			}
			update_post_meta( $save_id, $this->name(), $ids );
		}

		$this->value = $value;
		do_action( 'fes_save_field_after_save_frontend', $save_id, $value, $user_id );
	}

	/** Gets field value for admin */
	public function get_field_value_admin( $save_id = -2, $user_id = -2, $public = -2 ) {
		if ( $public === -2 ) {
			$public  = $this->readonly;
		}

		$user_id = fes_get_user_id( $user_id );
		$public   = apply_filters( 'fes_get_field_value_public_admin', $public , $this->id, $user_id );
		$user_id  = apply_filters( 'fes_get_field_value_user_id_admin', $user_id, $this->id );
		$save_id  = apply_filters( 'fes_get_field_value_save_id_admin', $save_id, $this->id );

		if ( $save_id === -2 ) {
			// if the place we are saving to doesn't have a save_id, we are likely on a draft product or draft vendor and therefore don't have a value
			// if there's a default lets use that
			if ( isset( $this->characteristics ) && isset( $this->characteristics ) && isset( $this->characteristics['default'] ) ) {
				$value = $this->characteristics['default'];
			}
			return apply_filters( 'fes_get_field_value_early_value_admin', null, $save_id, $user_id, $public );
		}

		$value = '';
		if ( $this->type === 'user' ) {
			$value = get_user_meta( $save_id, $this->name(), $this->single );
		} else if ( $this->type === 'post' ) {
			$value = get_post_meta( $save_id, $this->name(), $this->single );
		} else {
			$value = apply_filters( 'fes_get_custom_file_upload_value_admin', $save_id, $user_id, $public );
		}

		return apply_filters( 'fes_get_field_value_return_value_admin', $value, $save_id, $user_id, $public  );
	}

	/** Gets field value for frontend */
	public function get_field_value_frontend( $save_id = -2, $user_id = -2, $public = -2 ) {
		if ( $public === -2 ) {
			$public  = $this->readonly;
		}

		$user_id = fes_get_user_id( $user_id );
		$public   = apply_filters( 'fes_get_field_value_public_frontend', $public , $this->id, $user_id );
		$user_id  = apply_filters( 'fes_get_field_value_user_id_frontend', $user_id, $this->id );
		$save_id  = apply_filters( 'fes_get_field_value_save_id_frontend', $save_id, $this->id );

		if ( $save_id === -2 ) {
			// if the place we are saving to doesn't have a save_id, we are likely on a draft product or draft vendor and therefore don't have a value
			// if there's a default lets use that
			if ( isset( $this->characteristics ) && isset( $this->characteristics ) && isset( $this->characteristics['default'] ) ) {
				$value = $this->characteristics['default'];
			}
			return apply_filters( 'fes_get_field_value_early_value_frontend', null, $save_id, $user_id, $public );
		}

		$value = '';
		if ( $this->type === 'user' ) {
			$value = get_user_meta( $save_id, $this->name(), $this->single );
		} else if ( $this->type === 'post' ) {
			$value = get_post_meta( $save_id, $this->name(), $this->single );
		} else {
			$value = apply_filters( 'fes_get_custom_file_upload_value_frontend', $save_id, $user_id, $public );
		}

		return apply_filters( 'fes_get_field_value_return_value_frontend', $value, $save_id, $user_id, $public  );
	}
}
