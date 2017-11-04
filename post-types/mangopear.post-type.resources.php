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
				'name'					=> _x('Useful resources',	'Post Type General Name', 	'mangopear'),
				'singular_name'			=> _x('Resource',			'Post Type Singular Name',	'mangopear'),
				'menu_name'				=> __('Resources',			'mangopear'),
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
				'slug'					=> 'resources',
				'with_front'			=> true,
				'pages'					=> true,
				'feeds'					=> true,
			);


			/**
			 * [3]	Define settings for the post type
			 */
			
			$args = array(
				'label'					=> __('resources',															'mangopear'),
				'description'			=> __('Useful resources to be shown on the Mangopear creative website', 	'mangopear'),
				'labels'				=> $labels,
				'supports'				=> array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
				'taxonomies'			=> array('resource__types', 'resources__tags'),
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
			);


			/**
			 * [4]	Register the post type in WordPress
			 */
			
			register_post_type('resources', $args);
		}


		/**
		 * [5]	Hook into plugin activation
		 */
		
		add_action('init', 'mangopear_register_type_resources', 0);
	}





	/**
	 * Custom taxonomy for resource types
	 */
	
	if (! function_exists('mangopear_register_taxonomy_resource_types')) {
		function mangopear_register_taxonomy_resource_types() {
			$labels = array(
				'name'                       => _x('Resource types', 						'Taxonomy General Name', 	'mangopear'),
				'singular_name'              => _x('Type', 									'Taxonomy Singular Name', 	'mangopear'),
				'menu_name'                  => __('Resource types', 						'mangopear'),
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
				'slug'                       => 'resource/type',
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
				'query_var'                  => 'resource__types',
				'rewrite'                    => $rewrite,
			);


			register_taxonomy('resource__types', array('resources'), $args);
		}


		add_action('init', 'mangopear_register_taxonomy_resource_types', 0);
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


			register_taxonomy('resource__tags', array('resources'), $args);
		}


		add_action('init', 'mangopear_register_taxonomy_resource_tags', 0);
	}





	/**
	 * Sort this post type by Data (DSC) in wp-admin
	 */
	
	function mangopear_change_sort_resources($wp_query) {
		if (is_admin()) :
			$post_type = $wp_query->query['post_type'];


			if ($post_type == 'resources') :
				$wp_query->set('orderby', 'date');
				$wp_query->set('order', 'DSC');
			endif;
		endif;
	}


	add_filter('pre_get_posts', 'mangopear_change_sort_resources');
	
?>