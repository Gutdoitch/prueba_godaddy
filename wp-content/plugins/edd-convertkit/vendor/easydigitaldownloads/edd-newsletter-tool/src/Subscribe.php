<?php
/**
 * The interface for front end/subscription.
 *
 * @package EDD_Newsletter
 * @copyright Copyright (c) 2021, Easy Digital Downloads
 * @license   https://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

namespace EDD\Newsletter;

interface Subscribe {

	/**
	 * Subscribe a customer to a list.
	 *
	 * @since 1.0
	 * @param array $user_info An array containing the user info: generally `email`, `first_name`, `last_name`.
	 *                         An extension may change the array to meet its specific requirements.
	 * @param int   $list_id   The list ID to which the user should be subscribed. If false, the method
	 *                         should use `get_primary_list` to sign the user up for the primary list.
	 *
	 */
	public function subscribe_email( $user_info = array(), $list_id = false );
}
