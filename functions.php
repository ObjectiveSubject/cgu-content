<?php

/**
 * CGU functions and definitions
 */

// Useful global constants
define( 'CGU_VERSION',      '0.1.0' );
define( 'CGU_URL',          get_stylesheet_directory_uri() );
define( 'CGU_TEMPLATE_URL', get_template_directory_uri() );
define( 'CGU_PATH',         get_template_directory() . '/' );
define( 'CGU_INC',          CGU_PATH . 'includes/' );

// Include compartmentalized functions
require_once CGU_INC . 'functions/core.php';

// Include Post types
include CGU_INC . 'post-types/program.php';
include CGU_INC . 'post-types/school.php';
include CGU_INC . 'post-types/study-area.php';
include CGU_INC . 'post-types/people.php';

// Include Taxonomies
include CGU_INC . 'taxos/school.php';
include CGU_INC . 'taxos/study-area.php';
include CGU_INC . 'taxos/people-type.php';


// Include lib classes
include( CGU_INC . 'libraries/cmb2/init.php' );
include( CGU_INC . 'libraries/cmb2-attached-posts/cmb2-attached-posts-field.php' );
include( CGU_INC . 'libraries/cmb2-post-search-field/cmb2_post_search_field.php' );


// Run the setup functions
CGU\Core\setup();




/**
 * Get post by slug
 *
 * @param string Post Slug.
 * @return post object
 */
function get_post_by_slug( $slug, $type='post' ){
    $posts = get_posts( array(
            'name' => $slug,
            'posts_per_page' => 1,
            'post_type' => $type,
            'post_status' => 'publish'
    ));

    if( ! $posts ) {
        return false;
    }

    return $posts[0];
}
