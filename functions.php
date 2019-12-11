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

function my_pre_get_posts( $query ) {

	// do not modify queries in the admin
	if( is_admin() ) {

		return $query;

	}
if (!empty($query->query['cat'])) {
	$query->set('orderby', 'meta_value');
	$query->set('meta_key', 'date');
	$query->set('order', 'DESC');



	// return
	return $query;
  }
}

add_action('pre_get_posts', 'my_pre_get_posts');
