<?php

	/**
	 * Plugin name: Mangopear creative: Core requirements
	 * Plugin URI:	https://mangopear.co.uk/
	 * Description:	This plugin contains all bespoke functionality for this website. In the main it includes the custom post types that form the website content; holds any functions that are required outside of the theme and contains data links between various WordPress plugins (such as WooCommerce).
	 * Version:		1.0.0
	 * Author:		Andi North
	 * Author URI:	https://mangopear.co.uk
	 * License:		GNU General Public License
	 */
	

	/**
	 * Core mangopear website plugin
	 *
	 * @package  	mangopear
	 * @author  	Andi North <andi@mangopear.co.uk>
	 * @copyright  	2015 Mangopear creative
	 * @license   	GNU General Public License <http://opensource.org/licenses/gpl-license.php>
	 * @version  	1.0.0
	 * @link 		https://mangopear.co.uk/
	 * @since   	1.0.0
	 */
	

	/**
	 * Contents
	 *
	 * [1]	Global variables
	 * [2]	Post type registration
	 */
	

	/**
	 * [1]	Global variables
	 *
	 * 		These global variables are used throughout this document, typically to avoid repitition.
	 *
	 * 		[a]	$var to get the plugin directory URL
	 */
	
	$plugin_path = plugin_dir_path(__FILE__); // [a]





	/**
	 * [2]	Post type registration
	 *
	 * 		Group of includes for our various custom post types
	 *
	 * 		[a]	Portfolio items
	 * 		[b]	Coding: Useful resources
	 * 		[c]	Coding: Articles
	 * 		[d]	Witterings: Articles
	 */

	require_once $plugin_path . 'post-types/mangopear.post-type.portfolio.php'; 	// [a]

	require_once $plugin_path . 'post-types/post-type.coding.resources.php'; 		// [b]
	require_once $plugin_path . 'post-types/post-type.coding.articles.php'; 		// [c]

	require_once $plugin_path . 'post-types/post-type.witterings.php'; 	// [d]
	require_once $plugin_path . 'post-types/post-type.press.php'; 	// [d]





	/**
	 * [3]	Register additional functions
	 *
	 * 		[a]	If user not logged in, redirect to log in URL
	 */

	require_once $plugin_path . 'functions/function.redirect-if-not-logged-in.php'; 	// [a]





	/**
	 * [4]	Custom admin menu order
	 *
	 * 		@since 10.0.0
	 *
	 * 		[a]	
	 */
	
	function mangopear_add_admin_menu_separator($position) {
		global $menu;
		$index = 0;


		foreach($menu as $offset => $section) {
			if (substr($section[2],0,9)=='separator') {
				$index++;
			}


			if ($offset>=$position) {
				$menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
				break;
			}
		}


		ksort( $menu );
	}





	function mangopear_add_seperators() {
		mangopear_add_admin_menu_separator(35);
		mangopear_add_admin_menu_separator(40);
		mangopear_add_admin_menu_separator(42);
		mangopear_add_admin_menu_separator(48);
	}


	add_action('admin_init', 'mangopear_add_seperators', 0);