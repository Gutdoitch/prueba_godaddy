<?php
/**
 * Endpoint.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\API\Endpoints\v1;

use WP_Error;

abstract class Endpoint {

	/**
	 * Determines whether or not the current user is able to
	 * perform the action.
	 *
	 * @since 1.0
	 *
	 * @return bool|WP_Error
	 */
	public function permissionsCheck() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return new WP_Error(
				'rest_forbidden',
				__( 'You do not have permission to perform this action.', 'edd-multi-currency' ),
				[ 'status' => is_user_logged_in() ? 403 : 401 ]
			);
		}

		return true;
	}

}
