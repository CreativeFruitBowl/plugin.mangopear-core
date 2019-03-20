<?php

	/**
	 * A function to redirect non-logged in users.
	 *
	 * @category 	Theme output
	 * @package  	hildon
	 * @author  	Andi North <andi@mangopear.co.uk>
	 * @copyright  	2015 Mangopear creative
	 * @license   	GNU General Public License <http://opensource.org/licenses/gpl-license.php>
	 * @version  	1.0.0
	 * @link 		https://mangopear.co.uk/account/clients/hildon/docs/themes/hildon/
	 * @since   	1.0.0
	 */
	
	function mangopear_redirect_if_not_logged_in() {
		if (!is_user_logged_in()) {
			$redirect_url = urlencode(get_site_url() . $_SERVER[REQUEST_URI]);
			wp_redirect('/account/?redirect_to=' . $redirect_url, $status = 302);
		}
	}