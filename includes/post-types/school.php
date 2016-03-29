<?php

// School post type ================================ /
add_action('init', 'register_school');

function register_school() {

	$labels = array (
		'name' => 'Schools',
		'singular_name' => 'School',
		'menu_name' => 'Schools',
		'name_admin_bar' => 'School',
		'add_new' => 'Add School',
		'add_new_item' => 'Add New School',
		'edit' => 'Edit',
		'edit_item' => 'Edit School',
		'new_item' => 'New School',
		'all_items' => 'All Schools',
		'view' => 'View School',
		'view_item' => 'View School',
		'search_items' => 'Search Schools',
		'not_found' => 'No Schools Found',
		'not_found_in_trash' => 'No Schools Found in Trash',
		'parent' => 'Parent Schools',
	);

	register_post_type('school', array(
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'exclude_from_search' => true,
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'schools', 'with_front' => false),
			'query_var' => true,
			'menu_position' => 5,
			'supports' => array('title','editor'),
			'menu_icon' => 'dashicons-admin-multisite',
			'labels' => $labels
		)
	);
}
?>
