<?php

// People post type ================================ /
add_action('init', 'register_people');

function register_people() {

	$labels = array (
		'name' => 'People',
		'singular_name' => 'Person',
		'menu_name' => 'People',
		'name_admin_bar' => 'Person',
		'add_new' => 'Add Person',
		'add_new_item' => 'Add New Person',
		'edit' => 'Edit',
		'edit_item' => 'Edit Person',
		'new_item' => 'New Person',
		'all_items' => 'All People',
		'view' => 'View Person',
		'view_item' => 'View Person',
		'search_items' => 'Search People',
		'not_found' => 'No People Found',
		'not_found_in_trash' => 'No People Found in Trash',
		'parent' => 'Parent People',
	);

	register_post_type('people', array(
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'exclude_from_search' => true,
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'people', 'with_front' => false),
			'query_var' => true,
			'menu_position' => 5,
			'supports' => array('title','editor'),
			'menu_icon' => 'dashicons-businessman',
			'labels' => $labels
		)
	);
}

// Custom Admin Columns ======= /

function my_people_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'type' => 'Type',
        'schools' => 'Schools',
		'date' => 'Date',
	);
	return $columns;
}
function my_people_custom_columns($column, $post_id) {
	switch ($column) {
		case "type" :
            $terms = get_the_terms($post_id, 'people_type');
            $term_string = array();
            foreach( (array) $terms as $term ) {
                array_push( $term_string, '<a href="'.admin_url("edit.php?people_type={$term->slug}&post_type=people").'">' . $term->name . '</a>' );
            }
            echo implode(', ', $term_string);
			break;
		case "schools" :
            $terms = get_the_terms($post_id, '_school');
            $term_string = array();
            foreach( (array) $terms as $term ) {
                array_push( $term_string, '<a href="'.admin_url("edit.php?_school={$term->slug}&post_type=people").'">' . $term->name . '</a>' );
            }
            echo implode(', ', $term_string);
			break;
	}
}
add_action("manage_people_posts_custom_column", "my_people_custom_columns", 10, 2);
add_filter("manage_edit-people_columns", "my_people_columns");

?>
