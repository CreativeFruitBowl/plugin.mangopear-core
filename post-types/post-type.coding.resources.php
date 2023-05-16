<?php

	/**
	 * Register custom post type for the website: Resources [resources]
	 *
	 * Resources could be simple links through to other websites or more 
	 * detailed write ups on certain techniques or tools.
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
	

	if (!function_exists('mangopear_register_type_resources')) {
		function mangopear_register_type_resources() {
			
			/**
			 * [1]	Define the labels for our post type
			 */
			
			$labels = array(
				'name'					=> _x('Coding: Resources',	'Post Type General Name', 	'mangopear'),
				'singular_name'			=> _x('Resource',			'Post Type Singular Name',	'mangopear'),
				'menu_name'				=> __('Coding: Resources',	'mangopear'),
				'parent_item_colon'		=> __('Parent resource:',	'mangopear'),
				'all_items'				=> __('All resources',		'mangopear'),
				'view_item'				=> __('View resource',		'mangopear'),
				'add_new_item'			=> __('Add new resource',	'mangopear'),
				'add_new'				=> __('Add new',			'mangopear'),
				'edit_item'				=> __('Edit resource',		'mangopear'),
				'update_item'			=> __('Update resource',	'mangopear'),
				'search_items'			=> __('Search resources',	'mangopear'),
				'not_found'				=> __('Not found',			'mangopear'),
				'not_found_in_trash'	=> __('Not found in trash',	'mangopear'),
			);


			/**
			 * [2]	Define the permalinks for the post type
			 */
			
			$rewrite = array(
				'slug'					=> 'coding/resources/%year%/%monthnum%',
				'with_front'			=> false,
				'pages'					=> false,
				'feeds'					=> true,
			);


			/**
			 * [3]	Define settings for the post type
			 */
			
			$args = array(
				'label'					=> __('coding_resources',													'mangopear'),
				'description'			=> __('Useful resources to be shown on the Mangopear creative website', 	'mangopear'),
				'labels'				=> $labels,
				'supports'				=> array('title', 'author', 'thumbnail', 'excerpt'),
				'taxonomies'			=> array('resources__tags'),
				'hierarchical'			=> true,
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_icon'				=> 'dashicons-welcome-learn-more',
				'show_in_nav_menus'		=> false,
				'show_in_admin_bar'		=> true,
				'menu_position'			=> 48,
				'can_export'			=> true,
				'has_archive'			=> true,
				'exclude_from_search'	=> false,
				'publicly_queryable'	=> true,
				'rewrite'				=> $rewrite,
				'capability_type'		=> 'page',
				'show_in_rest'			=> true,
				'menu_position'			=> 38,

				'show_in_rest'			=> true,
			);


			/**
			 * [4]	Register the post type in WordPress
			 */
			
			register_post_type('coding_resources', $args);
		}


		/**
		 * [5]	Hook into plugin activation
		 */
		
		add_action('init', 'mangopear_register_type_resources', 0);





		/**
		 * [6]	Change custom permalinks
		 *
		 * 		@since 2.0.0
		 */
		
		function fruit_bowl_register_type_coding_resources_permalinks($url, $post) {
			if (get_post_type($post) == 'coding_resources') :
				$url = str_replace('%year%',     get_the_date('Y'), $url);
				$url = str_replace('%monthnum%', get_the_date('m'), $url);
			endif;

			return $url;
		}


		add_filter('post_type_link', 'fruit_bowl_register_type_coding_resources_permalinks', 10, 2);
	}





	/**
	 * Custom taxonomy for resource tags
	 */
	
	if (! function_exists('mangopear_register_taxonomy_resource_tags')) {
		function mangopear_register_taxonomy_resource_tags() {
			$labels = array(
				'name'                       => _x('Resource tags', 					'Taxonomy General Name', 	'mangopear'),
				'singular_name'              => _x('Tag', 								'Taxonomy Singular Name', 	'mangopear'),
				'menu_name'                  => __('Resource tags', 					'mangopear'),
				'all_items'                  => __('All tags', 							'mangopear'),
				'parent_item'                => __('Parent tag', 						'mangopear'),
				'parent_item_colon'          => __('Parent tag:', 						'mangopear'),
				'new_item_name'              => __('New tag', 							'mangopear'),
				'add_new_item'               => __('Add new tag', 						'mangopear'),
				'edit_item'                  => __('Edit tag', 							'mangopear'),
				'update_item'                => __('Update tag', 						'mangopear'),
				'separate_items_with_commas' => __('Separate tags with commas', 		'mangopear'),
				'search_items'               => __('Search tags', 						'mangopear'),
				'add_or_remove_items'        => __('Add or remove tags', 				'mangopear'),
				'choose_from_most_used'      => __('Choose from the most used tags', 	'mangopear'),
				'not_found'                  => __('Category not found', 				'mangopear'),
			);


			$rewrite = array(
				'slug'                       => 'resource/collections',
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
				'query_var'                  => 'resource__tags',
				'rewrite'                    => $rewrite,
			);


			register_taxonomy('resource__tags', array('coding_resources'), $args);
		}


		add_action('init', 'mangopear_register_taxonomy_resource_tags', 0);
	}











	/**
	 * Prevent Gutenberg from being the editor of these posts
	 */
	
	function disable_gutenberg_on_coding_resources($current_status, $post_type) {
		if ($post_type === 'coding_resources') :
			return false;
		else :
			return $current_status;
		endif;
	}


	add_filter('use_block_editor_for_post_type', 'disable_gutenberg_on_coding_resources', 10, 2);
	
?>