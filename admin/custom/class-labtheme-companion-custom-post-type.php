<?php
class Labtheme_Companion_Admin_Post_Type {
	/**
	* Get post types for templates
	*
	* @return array of default settings
	*/
	public function labtheme_get_posttype_array(){           
		$posts = array(
			'lab-portfolio' => array( 
				'singular_name'		  => __( 'Portfolio', 'labtheme-companion' ),
				'general_name'		  => __( 'Portfolios', 'labtheme-companion' ),
				'dashicon'			  => 'dashicons-portfolio',
				'taxonomy'			  => 'lab_portfolio_categories',
				'tag'				  => 'lab_portfolio_tags',
				'taxonomy_slug'		  => 'portfolio-category',
				'tag_slug'		  	  => 'portfolio-tags',
				'has_archive'         => true,		
				'exclude_from_search' => false,
				'show_in_nav_menus'	  => true,
				'supports' 			  => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
				'rewrite' 			  => array( 'slug' => 'portfolio' ),
				'hierarchical'		  => true,
				'path'				  => LABTC_BASE_PATH.'/includes/meta-parts/'
			),
			'lab-testimonial' => array( 
				'singular_name'		  => __( 'Testimonial', 'labtheme-companion' ),
				'general_name'		  => __( 'Testimonials', 'labtheme-companion' ),
				'dashicon'			  => 'dashicons-testimonial',
				'taxonomy'			  => 'lab_testimonial_categories',
				'tag'				  => 'lab_testimonial_tags',
				'taxonomy_slug'		  => 'testimonial-category',
				'tag_slug'		  	  => 'testimonial-tags',
				'has_archive'         => false,		
				'exclude_from_search' => false,
				'show_in_nav_menus'	  => true,
				'supports' 			  => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
				'rewrite' 			  => array( 'slug' => 'testimonial' ),
				'hierarchical'		  => true,
				'path'				  => LABTC_BASE_PATH.'/includes/meta-parts/'
			),
			'lab-event' => array( 
				'singular_name'		  => __( 'Event', 'labtheme-companion' ),
				'general_name'		  => __( 'Events', 'labtheme-companion' ),
				'dashicon'			  => 'dashicons-calendar-alt',
				'taxonomy'			  => 'lab_event_categories',
				'tag'			  	  => 'lab_event_tags',
				'taxonomy_slug'		  => 'event-category',
				'tag_slug'		  	  => 'event-tags',
				'has_archive'         => false,		
				'exclude_from_search' => false,
				'show_in_nav_menus'	  => true,
				'supports' 			  => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
				'rewrite' 			  => array( 'slug' => 'event' ),
				'hierarchical'		  => true,
				'path'				  => LABTC_BASE_PATH.'/includes/meta-parts/'
			),
			'lab-team' => array( 
				'singular_name'		  => __( 'Team', 'labtheme-companion' ),
				'general_name'		  => __( 'Teams', 'labtheme-companion' ),
				'dashicon'			  => 'dashicons-id-alt',
				'taxonomy'			  => 'lab_team_categories',
				'tag'			  	  => 'lab_team_tags',
				'taxonomy_slug'		  => 'team-category',
				'tag_slug'		  	  => 'team-tags',
				'has_archive'         => false,		
				'exclude_from_search' => false,
				'show_in_nav_menus'	  => true,
				'supports' 			  => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
				'rewrite' 			  => array( 'slug' => 'team' ),
				'hierarchical'		  => true,
				'path'				  => LABTC_BASE_PATH.'/includes/meta-parts/'
			),
			'lab-course' => array( 
				'singular_name'		  => __( 'Course', 'labtheme-companion' ),
				'general_name'		  => __( 'Courses', 'labtheme-companion' ),
				'dashicon'			  => 'dashicons-book',
				'taxonomy'			  => 'lab_course_categories',
				'tag'			  	  => 'lab_course_tags',
				'tag_slug'		  	  => 'course-tags',
				'taxonomy_slug'		  => 'course-category',
				'has_archive'         => true,		
				'exclude_from_search' => false,
				'show_in_nav_menus'	  => true,
				'supports' 			  => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
				'rewrite' 			  => array( 'slug' => 'course' ),
				'hierarchical'		  => true,
				'path'				  => LABTC_BASE_PATH.'/includes/meta-parts/'
			),
			'lab-faq' => array( 
				'singular_name'		  => __( 'FAQ', 'labtheme-companion' ),
				'general_name'		  => __( 'FAQS', 'labtheme-companion' ),
				'dashicon'			  => 'dashicons-info',
				'taxonomy'			  => 'lab_faq_categories',
				'tag'			  	  => 'lab_faq_tags',
				'taxonomy_slug'		  => 'faq-category',
				'tag_slug'		  	  => 'faq-tags',
				'has_archive'         => false,		
				'exclude_from_search' => false,
				'show_in_nav_menus'	  => true,
				'supports' 			  => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
				'rewrite' 			  => array( 'slug' => 'faq' ),
				'hierarchical'		  => true,
				'path'				  => LABTC_BASE_PATH.'/includes/meta-parts/'
			),
			'lab-service' => array( 
				'singular_name'		  => __( 'Service', 'labtheme-companion' ),
				'general_name'		  => __( 'Services', 'labtheme-companion' ),
				'dashicon'			  => 'dashicons-clipboard',
				'tag'			  	  => 'lab_service_tags',
				'taxonomy'			  => 'lab_service_categories',
				'taxonomy_slug'		  => 'service-category',
				'tag_slug'		  	  => 'service-tags',
				'has_archive'         => false,		
				'exclude_from_search' => false,
				'show_in_nav_menus'	  => true,
				'supports' 			  => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
				'rewrite' 			  => array( 'slug' => 'service' ),
				'hierarchical'		  => true,
				'path'				  => LABTC_BASE_PATH.'/includes/meta-parts/'
			),
			'lab-client' => array( 
				'singular_name'		  => __( 'Client', 'labtheme-companion' ),
				'general_name'		  => __( 'Clients', 'labtheme-companion' ),
				'dashicon'			  => 'dashicons-networking',
				'taxonomy'			  => 'lab_client_categories',
				'tag'			  	  => 'lab_client_tags',
				'taxonomy_slug'		  => 'client-category',
				'tag_slug'		  	  => 'client-tags',
				'has_archive'         => false,		
				'exclude_from_search' => false,
				'show_in_nav_menus'	  => true,
				'supports' 			  => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
				'rewrite' 			  => array( 'slug' => 'client' ),
				'hierarchical'		  => true,
				'path'				  => LABTC_BASE_PATH.'/includes/meta-parts/'
			),
		);
        // Parse incoming $args into an array and merge it with $defaults
        $posts  = apply_filters( 'labtheme_get_posttype_array', $posts );
        return $posts;
	}

	/**
	 * Register post types.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	function labtheme_register_post_types() {
		$myarray = $this->labtheme_get_posttype_array();
		foreach ($myarray as $key => $value) {
			$labels = array(
				'name'                  => $value['general_name'],
				'singular_name'         => $value['singular_name'],
				'menu_name'             => $value['general_name'],
				'name_admin_bar'        => $value['singular_name'],
				'archives'              => sprintf(__('%s Archives', 'labtheme-companion'), $value['singular_name']),
				'attributes'            => sprintf(__('%s Attributes', 'labtheme-companion'), $value['singular_name']),
				'parent_item_colon'     => sprintf(__('%s Parent', 'labtheme-companion'), $value['singular_name']),
				'all_items'             => sprintf(__('All %s', 'labtheme-companion'), $value['general_name']),
				'add_new_item'          => sprintf(__('Add New %s', 'labtheme-companion'), $value['singular_name']),
				'add_new'               => __( 'Add New', 'labtheme-companion' ),
				'new_item'              => sprintf(__('New %s', 'labtheme-companion'), $value['singular_name']),
				'edit_item'             => sprintf(__('Edit %s', 'labtheme-companion'), $value['singular_name']),
				'update_item'           => sprintf(__('Update %s', 'labtheme-companion'), $value['singular_name']),
				'view_item'             => sprintf(__('View %s', 'labtheme-companion'), $value['singular_name']),
				'view_items'            => sprintf(__('View %s', 'labtheme-companion'), $value['singular_name']),
				'search_items'          => sprintf(__('Search %s', 'labtheme-companion'), $value['singular_name']),
				'not_found'             => __( 'Not found', 'labtheme-companion' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'labtheme-companion' ),
				'featured_image'        => __( 'Featured Image', 'labtheme-companion' ),
				'set_featured_image'    => __( 'Set featured image', 'labtheme-companion' ),
				'remove_featured_image' => __( 'Remove featured image', 'labtheme-companion' ),
				'use_featured_image'    => __( 'Use as featured image', 'labtheme-companion' ),
				'insert_into_item'      => sprintf(__('Insert into %s', 'labtheme-companion'), $value['singular_name']),
				'uploaded_to_this_item' => sprintf(__('Uploaded to this %s', 'labtheme-companion'), $value['singular_name']),
				'items_list'            => sprintf(__('%s list', 'labtheme-companion'), $value['singular_name']),
				'items_list_navigation' => sprintf(__('%s list navigation', 'labtheme-companion'), $value['singular_name']),
				'filter_items_list'     => sprintf(__('Filter %s list', 'labtheme-companion'), $value['singular_name']),
			);
			$args = array(
				'label'                 => $value['singular_name'],
				'description'           => sprintf(__('%s Post Type', 'labtheme-companion'), $value['singular_name']),
				'labels'                => $labels,
				'supports'              => $value['supports'],
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'show_in_rest' 		  	=> true,
				'menu_icon'             => $value['dashicon'],
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => $value['show_in_nav_menus'],
				'can_export'            => true,
				'has_archive'           => true,		
				'exclude_from_search'   => $value['exclude_from_search'],
				'publicly_queryable'    => true,
				'capability_type'       => 'post',
				'rewrite'               => $value['rewrite'],
			);
			register_post_type( $key, $args );
	    	flush_rewrite_rules();
		}
	}

	/**
	 * Register a taxonomy, post_types_categories for the post types.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	function labtheme_create_post_type_taxonomies() {
		// Add new taxonomy, make it hierarchical
		$myarray = $this->labtheme_get_posttype_array();
		foreach ($myarray as $key => $value) {
			if(isset($value['taxonomy']))
			{
				$labels = array(
					'name'              => sprintf(__('%s Categories', 'labtheme-companion'), $value['singular_name']),
					'singular_name'     => sprintf(__('%s Categories', 'labtheme-companion'), $value['singular_name']),
					'search_items'      => __( 'Search Categories', 'labtheme-companion' ),
					'all_items'         => __( 'All Categories', 'labtheme-companion' ),
					'parent_item'       => __( 'Parent Categories', 'labtheme-companion' ),
					'parent_item_colon' => __( 'Parent Categories:', 'labtheme-companion' ),
					'edit_item'         => __( 'Edit Categories', 'labtheme-companion' ),
					'update_item'       => __( 'Update Categories', 'labtheme-companion' ),
					'add_new_item'      => __( 'Add New Categories', 'labtheme-companion' ),
					'new_item_name'     => __( 'New Categories Name', 'labtheme-companion' ),
					'menu_name'         => sprintf(__('%s Categories', 'labtheme-companion'), $value['singular_name']),
				);

				$args = array(
					'hierarchical'      => isset( $value['hierarchical'] ) ? $value['hierarchical']:true,
					'labels'            => $labels,
					'show_ui'           => true,
					'show_admin_column' => true,
					'show_in_nav_menus' => true,
					'show_in_rest' 		=> true,
					'rewrite'           => array( 'slug' => $value['taxonomy_slug'], 'hierarchical' => isset( $value['hierarchical'] ) ? $value['hierarchical']:true ),
				);
				register_taxonomy( $value['taxonomy'], array( $key ), $args );
			}
		}
	}

	/**
	 * Register a taxonomy, post_types_categories for the post types.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	function labtheme_create_post_type_taxonomies_tags() {
		// Add new taxonomy, make it hierarchical
		$tagsarray = $this->labtheme_get_posttype_array();
		foreach ($tagsarray as $key => $value) {
			if(isset($value['tag']))
			{
				$labels = array(
					'name'              => sprintf(__('%s Tags', 'labtheme-companion'), $value['singular_name']),
					'singular_name'     => sprintf(__('%s Tag', 'labtheme-companion'), $value['singular_name']),
					'search_items'      => __( 'Search Tag', 'labtheme-companion' ),
					'all_items'         => __( 'All Tag', 'labtheme-companion' ),
					'popular_items' 	=> __( 'Popular Tags' ),
					'parent_item'       => __( 'Parent Tag', 'labtheme-companion' ),
					'parent_item_colon' => __( 'Parent Tag:', 'labtheme-companion' ),
					'edit_item'         => __( 'Edit Tag', 'labtheme-companion' ),
					'update_item'       => __( 'Update Tag', 'labtheme-companion' ),
					'add_new_item'      => __( 'Add New Tag', 'labtheme-companion' ),
					'new_item_name'     => __( 'New Tag Name', 'labtheme-companion' ),
					'separate_items_with_commas' => __( 'Separate tags with commas' ),
					'add_or_remove_items' => __( 'Add or remove tags' ),
    				'choose_from_most_used' => __( 'Choose from the most used tags' ),
    				'not_found'             => sprintf(__('No %s Tags found', 'labtheme-companion'), $value['singular_name']),
					'menu_name'         => sprintf(__('%s Tag', 'labtheme-companion'), $value['singular_name']),
				);

				$args = array(
					'hierarchical'      => false,
					'labels'            => $labels,
					'show_ui'           => true,
					'update_count_callback' => '_update_post_term_count',
					'show_admin_column' => true,
					'show_in_nav_menus' => true,
					'show_in_rest'		=> true,
					'query_var' 		=> true,
					'rewrite'           => array( 'slug' => $value['tag_slug'] ),
				);

				register_taxonomy( 'writer', 'book', $args );
				register_taxonomy( $value['tag'], array( $key ), $args );
			}
		}
	}
}