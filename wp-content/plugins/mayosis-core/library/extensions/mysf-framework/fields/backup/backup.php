<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'MYSF_Field_backup' ) ) {
  class MYSF_Field_backup extends MYSF_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'mysf_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'mysf-export', 'unique' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo $this->field_before();

      echo '<textarea name="mysf_import_data" class="mysf-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary mysf-confirm mysf-import" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Import', 'mysf' ) .'</button>';
      echo '<hr />';
      echo '<textarea readonly="readonly" class="mysf-export-data">'. esc_attr( json_encode( get_option( $unique ) ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary mysf-export" target="_blank">'. esc_html__( 'Export & Download', 'mysf' ) .'</a>';
      echo '<hr />';
      echo '<button type="submit" name="mysf_transient[reset]" value="reset" class="button mysf-warning-primary mysf-confirm mysf-reset" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Reset', 'mysf' ) .'</button>';

      echo $this->field_after();

    }

  }
}
