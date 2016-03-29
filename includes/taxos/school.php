<?php

// School Taxonomy ============================================ /

function register_shadow_schools() {
	$labels = array(
		'name'              => _x( 'Schools', 'taxonomy general name' ),
		'singular_name'     => _x( 'School', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Schools' ),
		'all_items'         => __( 'All Schools' ),
		'parent_item'       => __( 'Parent School' ),
		'parent_item_colon' => __( 'Parent School:' ),
		'edit_item'         => __( 'Edit School' ),
		'update_item'       => __( 'Update School' ),
		'add_new_item'      => __( 'Add New School' ),
		'new_item_name'     => __( 'New School Name' ),
		'menu_name'         => __( 'Schools' ),
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

register_taxonomy( '_school', array( 'program', 'people' ), register_shadow_schools() );

/* Update Shadow School ========== */

function update_shadow_school( $post_id ) {
    // If we're running an auto-save, don't create a term
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // If we're not working with a movie, don't create a term
    if ( 'school' !== get_post_type( $post_id ) ) {
        return;
    }

    // If we can't retrieve the movie, don't create a term
    $school = get_post( $post_id );
    if ( null === $school ) {
        return;
    }

    // If the movie already exists, don't create a term.
    $term = get_term_by( 'name', $school->post_title, '_school' );
    if ( false === $term ) {
        // Create the term
        wp_insert_term( $school->post_title, '_school' );
    }
}
add_action( 'save_post', 'update_shadow_school' );

/* Delete Shadow School ========== */

function delete_shadow_school_term( $post_id ) {
    // If we're running an auto-save, don't delete a term
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // If we're not working with a movie, don't delete a term
    if ( 'school' !== get_post_type( $post_id ) ) {
        return;
    }

    // If we can't retrieve the movie, don't delete a term
    $school = get_post( $post_id );
    if ( null === $school ) {
        return;
    }

    // If the movie already exists, don't delete anything.
    $term = get_term_by( 'name', $school->post_title, '_school' );
    if ( false === $term ) {
        // Delete the term
        wp_delete_term( $term->term_id, '_school' );
    }
}
add_action( 'before_delete_post', 'delete_shadow_school_term' );

?>
