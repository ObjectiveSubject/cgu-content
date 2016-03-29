<?php

// Study Area Taxonomy ============================================ /

function register_shadow_study_area() {
	$labels = array(
		'name'              => _x( 'Study Areas', 'taxonomy general name' ),
		'singular_name'     => _x( 'Study Area', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Study Areas' ),
		'all_items'         => __( 'All Study Areas' ),
		'parent_item'       => __( 'Parent Study Area' ),
		'parent_item_colon' => __( 'Parent Study Area:' ),
		'edit_item'         => __( 'Edit Study Area' ),
		'update_item'       => __( 'Update Study Area' ),
		'add_new_item'      => __( 'Add New Study Area' ),
		'new_item_name'     => __( 'New Study Area Name' ),
		'menu_name'         => __( 'Study Areas' ),
	);
	$args = array(
		'labels'        => $labels,
        'rewrite'       => false,
        'show_ui'       => true,
        'show_tagcloud' => false,
        'hierarchical'  => true,
	);
	return $args;
}

register_taxonomy( '_study_area', array( 'program' ), register_shadow_study_area() );

/* Update Shadow School ========== */

function update_shadow_study_area( $post_id ) {
    // If we're running an auto-save, don't create a term
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // If we're not working with a movie, don't create a term
    if ( 'study_area' !== get_post_type( $post_id ) ) {
        return;
    }

    // If we can't retrieve the movie, don't create a term
    $study_area = get_post( $post_id );
    if ( null === $study_area ) {
        return;
    }

    // If the movie already exists, don't create a term.
    $term = get_term_by( 'name', $study_area->post_title, '_study_area' );
    if ( false === $term ) {
        // Create the term
        wp_insert_term( $study_area->post_title, '_study_area' );
    }
}
add_action( 'save_post', 'update_shadow_study_area' );

/* Delete Shadow School ========== */

function delete_shadow_study_area( $post_id ) {
    // If we're running an auto-save, don't delete a term
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // If we're not working with a movie, don't delete a term
    if ( 'study_area' !== get_post_type( $post_id ) ) {
        return;
    }

    // If we can't retrieve the movie, don't delete a term
    $study_area = get_post( $post_id );
    if ( null === $study_area ) {
        return;
    }

    // If the movie already exists, don't delete anything.
    $term = get_term_by( 'name', $study_area->post_title, '_study_area' );
    if ( false === $term ) {
        // Delete the term
        wp_delete_term( $term->term_id, '_study_area' );
    }
}
add_action( 'before_delete_post', 'delete_shadow_study_area' );


?>
