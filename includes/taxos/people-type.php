<?php

// People Types Taxonomy ============================================ /

function register_people_type() {
	$labels = array(
		'name'              => _x( 'People Types', 'taxonomy general name' ),
		'singular_name'     => _x( 'People Type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search People Types' ),
		'all_items'         => __( 'All People Types' ),
		'parent_item'       => __( 'Parent People Type' ),
		'parent_item_colon' => __( 'Parent People Type:' ),
		'edit_item'         => __( 'Edit People Type' ),
		'update_item'       => __( 'Update People Type' ),
		'add_new_item'      => __( 'Add New People Type' ),
		'new_item_name'     => __( 'New People Type Name' ),
		'menu_name'         => __( 'People Types' ),
	);
	$args = array(
		'labels'        => $labels,
        'rewrite'       => false,
        'show_ui'       => true,
        'hierarchical'  => true,
	);
	return $args;
}
register_taxonomy( 'people_type', array( 'people' ), register_people_type() );

?>
