<?php
class FES_Gallery_Alt extends FES_Field {
	/** @var string Version of field */
	public $version = '1.0.0';

	/** @var bool For 3rd parameter of get_post/user_meta */
	public $single = true;

	/** @var array Supports are things that are the same for all fields of a field type. Like whether or not a field type supports jQuery Phoenix. Stored in obj, not db. */
	public $supports = array(
		'multiple'    => true, // You can have multiples of this field
		'is_meta'     => true,  // in object as public (bool) $meta;
		'forms'       => array( // the forms you can use this field on
			'registration'   => true,
			'submission'     => true,
			'vendor-contact' => true,
			'profile'        => true,
			'login'          => true,
		),
		'position'    => 'extension', // the position on the formbuilder
		'permissions' => array(
			'can_remove_from_formbuilder' => true, // this field can be removed once inserted into the formbuilder
			'can_change_meta_key'         => true, // you can change the meta key this field saves to in the formbuilder
			'can_add_to_formbuilder'      => true, // you can add this field to a form via the formbuilder
		),
		'template'    => 'action_hook', // the type of field
		'title'       => 'Gallery Alt',
		'phoenix'     => false, // whether this field will support jQuery Phoenix in 2.4
	);

	/** @var array Characteristics are things that can change from field to field of the same field type. Like the placeholder between two email fields. Stored in db. */
	public $characteristics = array(
		'name'        => '', // the metakey where this field saves to
		'template'    => 'action_hook',
		'public'      => false, // can you display this publicly (used by FES_Field->display_field() )
		'required'    => false, // is it a required field (default is false)
	);

	public function set_title() {
		$this->supports['title'] = apply_filters( 'fes_' . $this->name() . '_field_title', _x( 'Gallery Alt', 'FES Field title translation', 'edd_fes' ) );
	}

	/**
	 * Returns the Action_Hook to render a field in admin.
	 * Because the output is identical, this just calls $this->render_field_frontend().
	 *
	 * @param int      $user_id  The current user ID.
	 * @param int|bool $readonly Whether the field is readonly.
	 * @return string
	 */
	public function render_field_admin( $user_id = -2, $readonly = -2 ) {
		return $this->render_field_frontend( $user_id, $readonly );
	}

	/**
	 * Returns the Action_Hook to render a field in the frontend.
	 *
	 * @param int      $user_id  The current user ID.
	 * @param int|bool $readonly Whether the field is readonly.
	 * @return string
	 */
	public function render_field_frontend( $user_id = -2, $readonly = -2 ) {
		$classes = array(
			'fes-el',
			$this->template(),
			$this->name(),
			$this->css(),
		);
		ob_start();
		?>
		<div class="<?php echo implode( ' ', array_map( 'sanitize_html_class', array_unique( array_filter( $classes ) ) ) ); ?>">
			<?php do_action( $this->name(), $this->form, $this->save_id, $this ); ?>
		</div>
		<?php

		return ob_get_clean();
	}

	/** Returns the Action_Hook to render a field for the formbuilder */
	public function render_formbuilder_field( $index = -2, $insert = false ) {
		$removable    = $this->can_remove_from_formbuilder();
		$title_name   = sprintf( '%s[%d][name]', 'fes_input', $index );
		$title_value  = esc_attr( $this->name() );
		ob_start(); ?>
		<li class="action_hook">
			<?php $this->legend( $this->title(), $this->name(), $removable ); ?>
			<?php FES_Formbuilder_Templates::public_radio( $index, $this->characteristics, $this->form_name, true ); ?>
			<?php FES_Formbuilder_Templates::hidden_field( "[$index][template]", $this->template() ); ?>

			<?php FES_Formbuilder_Templates::field_div( $index, $this->name(), $this->characteristics, $insert ); ?>
				<div class="fes-form-rows edd-form-group">
					<label for="<?php echo esc_attr( $title_name ); ?>" class="edd-form-group__label">
						<?php esc_html_e( 'Hook Name', 'edd_fes' ); ?>
						<span class="required">*<span class="screen-reader-text"><?php esc_html_e( 'Required', 'edd_fes' ); ?></span></span>
					</label>
					<div class="fes-form-sub-fields edd-form-group__control">
						<input type="text" id="<?php echo esc_attr( $title_name ); ?>" class="edd-form-group__input" name="<?php echo esc_attr( $title_name ); ?>" value="<?php echo esc_attr( $title_value ); ?>" required />
					</div>
					<p class="edd-form-group__help description">
						<?php esc_html_e( 'This is for developers to add dynamic elements as they want. It provides the chance to add whatever input type you want to add in this form.', 'edd_fes' ); ?>
					</p>
					<p class="edd-form-group__help description">
						<?php esc_html_e( 'You can bind your own functions to render the form to this action hook. You\'ll be given 3 parameters to play with: $form_id, $post_id, $form_settings.', 'edd_fes' ); ?>
					</p>
					<textarea class="large-text fes-textarea-code" rows="8" readonly>
add_action( '{hookname}', '{my_function_name}', 10, 3 );
/**
 * @param $form    Form Object
 * @param $save_id Save ID of post/user/custom
 * @param $field   Field Object
 */
function my_function_name( $form, $save_id, $field ) {
	// Do whatever you want here
}
					</textarea>
				</div>
			</div>
		</li>
		<?php
		return ob_get_clean();
	}

	// note in order for this to run, a hidden text field should be output in the render function with an id of the meta_key, else this won't run
	public function save_field_admin( $save_id = -2, $value = '', $user_id = -2 ) {
		do_action( $this->name() . '_save_admin', $save_id, $value, $user_id, $this );
	}

	// note in order for this to run, a hidden text field should be output in the render function with an id of the meta_key, else this won't run
	public function save_field_frontend( $save_id = -2, $value = '', $user_id = -2 ) {
		do_action( $this->name() . '_save_frontend', $save_id, $value, $user_id, $this );
	}

	/** Returns the HTML to a public field in frontend */
	public function display_field( $user_id = -2, $single = false ) {
		return apply_filters( 'fes_display_' . $this->template() . '_field', '', $user_id, $single );
	}

	/** Returns formatted data of field in frontend */
	public function formatted_data( $user_id = -2 ) {
		return apply_filters( 'fes_formatted_' . $this->template() . '_field', '', $user_id );
	}

	public function validate( $values = array(), $save_id = -2, $user_id = -2 ) {
		return apply_filters( 'fes_validate_' . $this->template() . '_field', false, $values,  $this->name(), $save_id, $user_id );
	}

	public function sanitize( $values = array(), $save_id = -2, $user_id = -2 ) {
		return apply_filters( 'fes_sanitize_' . $this->template() . '_field', $values, $this->name(), $save_id, $user_id );
	}
}
