<?php

	/**
	 * Register custom post type for the website: Our views [our-views]
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
	

	if (!function_exists('mangopear_register_type_views')) {
		function mangopear_register_type_views() {
			
			/**
			 * [1]	Define the labels for our post type
			 */
			
			$labels = array(
				'name'					=> _x('Our views',			'Post Type General Name', 	'mangopear'),
				'singular_name'			=> _x('View',				'Post Type Singular Name',	'mangopear'),
				'menu_name'				=> __('Views',				'mangopear'),
				'parent_item_colon'		=> __('Parent view:',		'mangopear'),
				'all_items'				=> __('All views',			'mangopear'),
				'view_item'				=> __('View view',			'mangopear'),
				'add_new_item'			=> __('Add new view',		'mangopear'),
				'add_new'				=> __('Add new',			'mangopear'),
				'edit_item'				=> __('Edit view',			'mangopear'),
				'update_item'			=> __('Update view',		'mangopear'),
				'search_items'			=> __('Search views',		'mangopear'),
				'not_found'				=> __('Not found',			'mangopear'),
				'not_found_in_trash'	=> __('Not found in trash',	'mangopear'),
			);


			/**
			 * [2]	Define the permalinks for the post type
			 */
			
			$rewrite = array(
				'slug'					=> 'our-views',
				'with_front'			=> true,
				'pages'					=> true,
				'feeds'					=> true,
			);


			/**
			 * [3]	Define settings for the post type
			 */
			
			$args = array(
				'label'					=> __('Our views',						'mangopear'),
				'description'			=> __('Our views on popular topics', 	'mangopear'),
				'labels'				=> $labels,
				'supports'				=> array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
				'taxonomies'			=> array('cat'),
				'hierarchical'			=> true,
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_icon'				=> 'dashicons-welcome-learn-more',
				'show_in_nav_menus'		=> true,
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
			
			register_post_type('our-views', $args);
		}


		/**
		 * [5]	Hook into plugin activation
		 */
		
		add_action('init', 'mangopear_register_type_views', 0);
	}





	/**
	 * Custom taxonomy for resource types
	 */
	
	if (! function_exists('mangopear_register_taxonomy_view_cats')) {
		function mangopear_register_taxonomy_view_cats() {
			$labels = array(
				'name'                       => _x('Topics', 							'Taxonomy General Name', 	'mangopear'),
				'singular_name'              => _x('Topic', 							'Taxonomy Singular Name', 	'mangopear'),
				'menu_name'                  => __('Topics', 							'mangopear'),
				'all_items'                  => __('All topics', 						'mangopear'),
				'parent_item'                => __('Parent topic', 						'mangopear'),
				'parent_item_colon'          => __('Parent topic:', 					'mangopear'),
				'new_item_name'              => __('New topic', 						'mangopear'),
				'add_new_item'               => __('Add new topic', 					'mangopear'),
				'edit_item'                  => __('Edit topic', 						'mangopear'),
				'update_item'                => __('Update topic', 						'mangopear'),
				'separate_items_with_commas' => __('Separate topics with commas', 		'mangopear'),
				'search_items'               => __('Search topics', 					'mangopear'),
				'add_or_remove_items'        => __('Add or remove topics', 				'mangopear'),
				'choose_from_most_used'      => __('Choose from the most used topics', 	'mangopear'),
				'not_found'                  => __('Category not found', 				'mangopear'),
			);


			$rewrite = array(
				'slug'                       => 'views/topics',
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
				'rewrite'                    => $rewrite,
			);


			register_taxonomy('our-views__categories', array('our-views'), $args);
		}


		add_action('init', 'mangopear_register_taxonomy_view_cats', 0);
	}





	/**
	 * Sort this post type by Data (DSC) in wp-admin
	 */
	
	function mangopear_change_sort_views($wp_query) {
		if (is_admin()) :
			$post_type = $wp_query->query['post_type'];


			if ($post_type == 'our-views') :
				$wp_query->set('orderby', 'date');
				$wp_query->set('order', 'DSC');
			endif;
		endif;
	}


	add_filter('pre_get_posts', 'mangopear_change_sort_views');
	
?>