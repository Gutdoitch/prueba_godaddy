<?php
/**
 * Requirements
 *
 * Checks system requirements.
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Utils;

use WP_Error;

class Requirements {

	/**
	 * Requirements
	 *
	 * @var array
	 */
	private $requirements = [];

	/**
	 * Requirements constructor.
	 *
	 * @since 1.0
	 *
	 * @param array $requirements
	 */
	public function __construct( $requirements = [] ) {
		if ( ! empty( $requirements ) ) {
			foreach ( $requirements as $id => $requirement ) {
				$this->addRequirement( $id, $requirement );
			}
		}
	}

	/**
	 * Adds a new requirement.
	 *
	 * @since 1.0
	 *
	 * @param string $id      Unique ID for the requirement.
	 * @param array  $args    {
	 *                        Array of arguments.
	 *
	 * @type string  $minimum Minimum version required.
	 * @type string  $name    Display name for the requirement.
	 *                     }
	 *
	 * @return void
	 */
	public function addRequirement( $id, $args ) {
		$args = wp_parse_args( $args, [
			'minimum' => '1',   // Minimum version number
			'name'    => '',    // Display name
			'exists'  => false, // Whether or not this requirement exists.
			'current' => false, // The currently installed version number.
			'checked' => false, // Whether or not the requirement has been checked.
			'met'     => false, // Whether or not all requirements are met.
		] );

		$this->requirements[ sanitize_key( $id ) ] = $args;
	}

	/**
	 * Whether or not all requirements have been met.
	 *
	 * @since 1.0
	 *
	 * @return bool
	 */
	public function met() {
		$this->check();

		$requirements_met = true;

		// If any one requirement is not met, we return false.
		foreach ( $this->requirements as $requirement ) {
			if ( empty( $requirement['met'] ) ) {
				$requirements_met = false;
				break;
			}
		}

		return $requirements_met;
	}

	/**
	 * Checks the requirements.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	private function check() {
		foreach ( $this->requirements as $requirement_id => $properties ) {
			switch ( $requirement_id ) {
				case 'php':
					$exists  = true;
					$version = phpversion();
					break;
				case 'wp':
					$exists  = true;
					$version = get_bloginfo( 'version' );
					break;
				case 'easy-digital-downloads':
					$version = defined( 'EDD_VERSION' ) ? EDD_VERSION : false;
					$exists  = defined( 'EDD_VERSION' );
					break;
				default:
					$version = false;
					break;
			}

			if ( ! empty( $version ) ) {
				$this->requirements[ $requirement_id ] = array_merge( $this->requirements[ $requirement_id ], array(
					'current' => $version,
					'checked' => true,
					'met'     => version_compare( $version, $properties['minimum'], '>=' ),
					'exists'  => isset( $exists ) ? $exists : $this->requirements[ $requirement_id ]['exists']
				) );
			}
		}
	}

	/**
	 * Returns requirements errors.
	 *
	 * @since 1.0
	 *
	 * @return WP_Error
	 */
	public function getErrors() {
		$error = new WP_Error();

		foreach ( $this->requirements as $requirement_id => $properties ) {
			if ( empty( $properties['met'] ) ) {
				$error->add( $requirement_id, $this->unmetRequirementDescription( $properties ) );
			}
		}

		return $error;
	}

	/**
	 * Generates an HTML error description.
	 *
	 * @since 1.0
	 *
	 * @param array $requirement
	 *
	 * @return string
	 */
	private function unmetRequirementDescription( $requirement ) {
		// Requirement exists, but is out of date.
		if ( ! empty( $requirement['exists'] ) ) {
			return sprintf(
				$this->unmetRequirementsDescriptionText(),
				'<strong>' . esc_html( $requirement['name'] ) . '</strong>',
				'<strong>' . esc_html( $requirement['minimum'] ) . '</strong>',
				'<strong>' . esc_html( $requirement['current'] ) . '</strong>'
			);
		}

		// Requirement could not be found.
		return sprintf(
			$this->unmetRequirementsMissingText(),
			esc_html( $requirement['name'] ),
			'<strong>' . esc_html( $requirement['minimum'] ) . '</strong>'
		);
	}

	/**
	 * Plugin specific text to describe a single unmet requirement.
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	private function unmetRequirementsDescriptionText() {
		/* Translators: %1$s name of the requirement; %2$s required version; %3$s current version */
		return esc_html__( '%1$s: minimum required %2$s (you have %3$s)', 'edd-multi-currency' );
	}

	/**
	 * Plugin specific text to describe a single missing requirement.
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	private function unmetRequirementsMissingText() {
		/* Translators: %1$s name of the requirement; %2$s required version */
		return wp_kses( __( '<strong>Missing %1$s</strong>: minimum required %2$s', 'edd-multi-currency' ), array( 'strong' => array() ) );
	}

}
