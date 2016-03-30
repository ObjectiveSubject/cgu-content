<?php

// Area of Study post type ================================ /
add_action('init', 'register_study_area');

function register_study_area() {

	$labels = array (
		'name' => 'Study Area',
		'singular_name' => 'Study Area',
		'menu_name' => 'Study Area',
		'name_admin_bar' => 'Study Area',
		'add_new' => 'Add Study Area',
		'add_new_item' => 'Add New Study Area',
		'edit' => 'Edit',
		'edit_item' => 'Edit Study Area',
		'new_item' => 'New Study Area',
		'all_items' => 'All Study Area',
		'view' => 'View Study Area',
		'view_item' => 'View Study Area',
		'search_items' => 'Search Study Area',
		'not_found' => 'No Study Area Found',
		'not_found_in_trash' => 'No Study Area Found in Trash',
		'parent' => 'Parent Study Area',
	);

	register_post_type('study_area', array(
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'exclude_from_search' => true,
			'map_meta_cap' => true,
			'hierarchical' => true,
			'rewrite' => array('slug' => 'area-of-study', 'with_front' => false),
			'query_var' => true,
			'menu_position' => 5,
			'supports' => array('title','editor', 'page-attributes'),
			'menu_icon' => 'dashicons-welcome-learn-more',
			'labels' => $labels
		)
	);
}
?>
