<?php

	/**
	 * Register custom post type for the website: Portfolio [portfolio]
	 *
	 * This post type, rather obviously, holds information for the portfolio items that are posted onto the website.
	 *
	 * @category 	Post types
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
	 * [1]	Define the labels for our post type
	 * [2]	Define the permalinks for the post type
	 * [3]	Define settings for the post type
	 * [4]	Register the post type in WordPress
	 * [5]	Hook into plugin activation
	 */
	

	if (!function_exists('mangopear_register_type_portfolio')) {
		function mangopear_register_type_portfolio() {
			
			/**
			 * [1]	Define the labels for our post type
			 */
			
			$labels = array(
				'name'					=> _x('Our work',						'Post Type General Name', 	'mangopear'),
				'singular_name'			=> _x('Our work &amp; case studies',	'Post Type Singular Name',	'mangopear'),
				'menu_name'				=> __('Portfolio',				'mangopear'),
				'parent_item_colon'		=> __('Parent portfolio:',	 	'mangopear'),
				'all_items'				=> __('All portfolios',			'mangopear'),
				'view_item'				=> __('View portfolio',		 	'mangopear'),
				'add_new_item'			=> __('Add new portfolio',	 	'mangopear'),
				'add_new'				=> __('Add new',			 	'mangopear'),
				'edit_item'				=> __('Edit portfolio',		 	'mangopear'),
				'update_item'			=> __('Update portfolio',		'mangopear'),
				'search_items'			=> __('Search portfolio',		'mangopear'),
				'not_found'				=> __('Not found',			 	'mangopear'),
				'not_found_in_trash'	=> __('Not found in trash',	 	'mangopear'),
			);


			/**
			 * [2]	Define the permalinks for the post type
			 */
			
			$rewrite = array(
				'slug'					=> 'our-work',
				'with_front'			=> false,
				'hierarchical'          => true,
				'pages'					=> true,
				'feeds'					=> true,
			);


			/**
			 * [3]	Define settings for the post type
			 */
			
			$args = array(
				'label'					=> __('portfolio',	'mangopear'),
				'description'			=> __('', 			'mangopear'),
				'labels'				=> $labels,
				'supports'				=> array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes', 'comments'),
				'taxonomies'			=> array('portfolio_types'),
				'hierarchical'			=> true,
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_icon'				=> 'dashicons-portfolio',
				'show_in_nav_menus'		=> false,
				'show_in_admin_bar'		=> true,
				'menu_position'			=> 49,
				'can_export'			=> true,
				'has_archive'			=> true,
				'exclude_from_search'	=> false,
				'publicly_queryable'	=> true,
				'rewrite'				=> $rewrite,
				'capability_type'		=> 'page',
				'menu_position'			=> 40,

				'show_in_rest'			=> true,
			);


			/**
			 * [4]	Register the post type in WordPress
			 */
			
			register_post_type('portfolio', $args);
		}


		/**
		 * [5]	Hook into plugin activation
		 */
		
		add_action('init', 'mangopear_register_type_portfolio', 0);
	}





	/**
	 * Custom taxonomy for profiles
	 */
	
	if (! function_exists('mangopear_register_taxonomy_portfolio')) {
		function mangopear_register_taxonomy_portfolio() {
			$labels = array(
				'name'                       => _x('Categories', 							'Taxonomy General Name', 'mangopear'),
				'singular_name'              => _x('Category', 								'Taxonomy Singular Name', 'mangopear'),
				'menu_name'                  => __('Profile categories', 					'mangopear'),
				'all_items'                  => __('All categories', 						'mangopear'),
				'parent_item'                => __('Parent category', 						'mangopear'),
				'parent_item_colon'          => __('Parent category:', 						'mangopear'),
				'new_item_name'              => __('New category', 							'mangopear'),
				'add_new_item'               => __('Add new category', 						'mangopear'),
				'edit_item'                  => __('Edit category', 						'mangopear'),
				'update_item'                => __('Update category', 						'mangopear'),
				'separate_items_with_commas' => __('Separate categories with commas', 		'mangopear'),
				'search_items'               => __('Search categories', 					'mangopear'),
				'add_or_remove_items'        => __('Add or remove categories', 				'mangopear'),
				'choose_from_most_used'      => __('Choose from the most used categories', 	'mangopear'),
				'not_found'                  => __('Category not found', 					'mangopear'),
			);


			$rewrite = array(
				'slug'                       => 'our-work/filter',
				'with_front'                 => true,
				'hierarchical'               => true,
			);


			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => false,
				'query_var'                  => 'portfolio_types',
				'rewrite'                    => $rewrite,
			);


			register_taxonomy('portfolio_types', array('portfolio'), $args);
		}


		add_action('init', 'mangopear_register_taxonomy_portfolio', 0);
	}
	
?>