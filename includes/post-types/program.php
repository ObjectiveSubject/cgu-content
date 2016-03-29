<?php

// Program post type ================================ /
add_action('init', 'register_program');

function register_program() {

	$labels = array (
		'name' => 'Programs',
		'singular_name' => 'Program',
		'menu_name' => 'Programs',
		'name_admin_bar' => 'Program',
		'add_new' => 'Add Program',
		'add_new_item' => 'Add New Program',
		'edit' => 'Edit',
		'edit_item' => 'Edit Program',
		'new_item' => 'New Program',
		'all_items' => 'All Programs',
		'view' => 'View Program',
		'view_item' => 'View Program',
		'search_items' => 'Search Programs',
		'not_found' => 'No Programs Found',
		'not_found_in_trash' => 'No Programs Found in Trash',
		'parent' => 'Parent Programs',
	);

	register_post_type('program', array(
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'post',
			'exclude_from_search' => true,
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'programs', 'with_front' => false),
			'query_var' => true,
			'menu_position' => 5,
			'supports' => array('title','editor'),
			'menu_icon' => 'dashicons-book',
			'labels' => $labels
		)
	);
}

// Custom Admin Columns ======= /

function my_program_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
        'schools' => 'Schools',
        'study_areas' => 'Areas of Study',
		'date' => 'Date',
	);
	return $columns;
}
function my_program_custom_columns($column, $post_id) {
	switch ($column) {
		case "schools" :
            $terms = get_the_terms($post_id, '_school');
            $term_string = array();
            foreach( (array) $terms as $term ) {
                array_push( $term_string, '<a href="'.admin_url("edit.php?_school={$term->slug}&post_type=program").'">' . $term->name . '</a>' );
            }
            echo implode(', ', $term_string);
			break;

        case "study_areas" :
            $terms = get_the_terms($post_id, '_study_area');
            $term_string = array();
            foreach( (array) $terms as $term ) {
                array_push( $term_string, '<a href="'.admin_url("edit.php?_study_area={$term->slug}&post_type=program").'">' . $term->name . '</a>' );
            }
            echo implode(', ', $term_string);
			break;
	}
}
add_action("manage_program_posts_custom_column", "my_program_custom_columns", 10, 2);
add_filter("manage_edit-program_columns", "my_program_columns");

?>
