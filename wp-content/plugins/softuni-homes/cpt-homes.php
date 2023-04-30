<?php
/**
 * Register a custom post type called "home".
 *
 * @see get_post_type_labels() for label keys.
 */
function softuni_homes_cpt() {
	$labels = array(
		'name'                  => _x( 'Homes', 'Post type general name', 'softuni' ),
		'singular_name'         => _x( 'Home', 'Post type singular name', 'softuni' ),
		'menu_name'             => _x( 'Homes', 'Admin Menu text', 'softuni' ),
		'name_admin_bar'        => _x( 'Home', 'Add New on Toolbar', 'softuni' ),
		'add_new'               => __( 'Add New', 'softuni' ),
		'add_new_item'          => __( 'Add New Home', 'softuni' ),
		'new_item'              => __( 'New Home', 'softuni' ),
		'edit_item'             => __( 'Edit Home', 'softuni' ),
		'view_item'             => __( 'View Home', 'softuni' ),
		'all_items'             => __( 'All Homes', 'softuni' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'home' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions' ),
        'show_in_rest'       => true
	);

	register_post_type( 'home', $args );

    flush_rewrite_rules();
}
add_action( 'init', 'softuni_homes_cpt' );

/**
 * Register a 'field' taxonomy for post type 'home', with a rewrite to match book CPT slug.
 *
 * @see register_post_type for registering post types.
 */
function softuni_homes_field_taxonomy() {
    $labels = array(
		'name'              => _x( 'Field', 'taxonomy general name', 'softuni' ),
		'singular_name'     => _x( 'Field', 'taxonomy singular name', 'softuni' ),
		'search_items'      => __( 'Search Field', 'softuni' ),
		'all_items'         => __( 'All Field', 'softuni' ),
		'parent_item'       => __( 'Parent Field', 'softuni' ),
		'parent_item_colon' => __( 'Parent Field:', 'softuni' ),
		'edit_item'         => __( 'Edit Field', 'softuni' ),
		'update_item'       => __( 'Update Field', 'softuni' ),
		'add_new_item'      => __( 'Add New Field', 'softuni' ),
		'new_item_name'     => __( 'New Field Name', 'softuni' ),
		'menu_name'         => __( 'Field', 'softuni' ),
	);

    $args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
        'show_in_rest'      => true
	);


    register_taxonomy( 'field', 'home', $args );
}
add_action( 'init', 'softuni_homes_field_taxonomy' );
