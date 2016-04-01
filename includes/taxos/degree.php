<?php

// Degrees Taxonomy ============================================ /

function register_degree() {
	$labels = array(
		'name'              => _x( 'Degrees', 'taxonomy general name' ),
		'singular_name'     => _x( 'Degree', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Degrees' ),
		'all_items'         => __( 'All Degrees' ),
		'parent_item'       => __( 'Parent Degree' ),
		'parent_item_colon' => __( 'Parent Degree:' ),
		'edit_item'         => __( 'Edit Degree' ),
		'update_item'       => __( 'Update Degree' ),
		'add_new_item'      => __( 'Add New Degree' ),
		'new_item_name'     => __( 'New Degree Name' ),
		'menu_name'         => __( 'Degrees' ),
	);
	$args = array(
		'labels'        => $labels,
        'rewrite'       => false,
        'show_ui'       => true,
        'hierarchical'  => true,
	);
	return $args;
}
register_taxonomy( 'degree', array( 'program' ), register_degree() );

?>
