<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'MYSF_Field_icon' ) ) {
  class MYSF_Field_icon extends MYSF_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'button_title' => esc_html__( 'Add Icon', 'mysf' ),
        'remove_title' => esc_html__( 'Remove Icon', 'mysf' ),
      ) );

      echo $this->field_before();

      $nonce  = wp_create_nonce( 'mysf_icon_nonce' );
      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="mysf-icon-select">';
      echo '<span class="mysf-icon-preview'. esc_attr( $hidden ) .'"><i class="'. esc_attr( $this->value ) .'"></i></span>';
      echo '<a href="#" class="button button-primary mysf-icon-add" data-nonce="'. esc_attr( $nonce ) .'">'. $args['button_title'] .'</a>';
      echo '<a href="#" class="button mysf-warning-primary mysf-icon-remove'. esc_attr( $hidden ) .'">'. $args['remove_title'] .'</a>';
      echo '<input type="hidden" name="'. esc_attr( $this->field_name() ) .'" value="'. esc_attr( $this->value ) .'" class="mysf-icon-value"'. $this->field_attributes() .' />';
      echo '</div>';

      echo $this->field_after();

    }

    public function enqueue() {
      add_action( 'admin_footer', array( 'MYSF_Field_icon', 'add_footer_modal_icon' ) );
      add_action( 'customize_controls_print_footer_scripts', array( 'MYSF_Field_icon', 'add_footer_modal_icon' ) );
    }

    public static function add_footer_modal_icon() {
    ?>
      <div id="mysf-modal-icon" class="mysf-modal mysf-modal-icon hidden">
        <div class="mysf-modal-table">
          <div class="mysf-modal-table-cell">
            <div class="mysf-modal-overlay"></div>
            <div class="mysf-modal-inner">
              <div class="mysf-modal-title">
                <?php esc_html_e( 'Add Icon', 'mysf' ); ?>
                <div class="mysf-modal-close mysf-icon-close"></div>
              </div>
              <div class="mysf-modal-header">
                <input type="text" placeholder="<?php esc_html_e( 'Search...', 'mysf' ); ?>" class="mysf-icon-search" />
              </div>
              <div class="mysf-modal-content">
                <div class="mysf-modal-loading"><div class="mysf-loading"></div></div>
                <div class="mysf-modal-load"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }

  }
}
