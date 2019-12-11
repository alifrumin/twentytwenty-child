<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}


// Our custom post type function
function create_posttype() {

    register_post_type( 'books',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Books' ),
                'singular_name' => __( 'Books' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'books'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

function my_pre_get_posts( $query ) {

	// do not modify queries in the admin
	if( is_admin() ) {

		return $query;

	}

	// only modify queries for 'event' post type

	$query->set('orderby', 'meta_value');
	$query->set('meta_key', 'date');
	$query->set('order', 'DESC');



	// return
	return $query;

}

add_action('pre_get_posts', 'my_pre_get_posts');
