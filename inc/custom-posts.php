<?php

if ( ! function_exists('thegncy_custom_post_type') ) {
	
    /**
     * Register a custom post type.
     *
     * @link http://codex.wordpress.org/Function_Reference/register_post_type
     */
    function thegncy_custom_post_type() {

        //portfolio
        register_post_type(
            'portfolio', array(
            'labels'                 => array(
                'name'               => _x( 'Portfolio', 'post type general name', 'thegncy' ),
                'singular_name'      => _x( 'Portfolio', 'post type singular name', 'thegncy' ),
                'menu_name'          => _x( 'Portfolio', 'admin menu', 'thegncy' ),
                'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'thegncy' ),
                'add_new'            => _x( 'Add New', 'Portfolio', 'thegncy' ),
                'add_new_item'       => __( 'Add New Portfolio', 'thegncy' ),
                'new_item'           => __( 'New Portfolio', 'thegncy' ),
                'edit_item'          => __( 'Edit Portfolio', 'thegncy' ),
                'view_item'          => __( 'View Portfolio', 'thegncy' ),
                'all_items'          => __( 'All Portfolio', 'thegncy' ),
                'search_items'       => __( 'Search Portfolio', 'thegncy' ),
                'parent_item_colon'  => __( 'Parent Portfolio:', 'thegncy' ),
                'not_found'          => __( 'No Portfolio found.', 'thegncy' ),
                'not_found_in_trash' => __( 'No Portfolio found in Trash.', 'thegncy' )
            ),

            'description'        => __( 'Description.', 'thegncy' ),
            'menu_icon'          => 'dashicons-layout',
            'public'             => true,
            'show_in_menu'       => true,
            'has_archive'        => false,
            'hierarchical'       => true,
            'rewrite'            => array( 'slug' => 'portfolio' ),
            'supports'           => array( 'title', 'editor', 'thumbnail' )
        ));

        // portfolio taxonomy
        register_taxonomy(
            'portfolio_category',
            'portfolio',
            array(
                'labels' => array(
                    'name' => __( 'Portfolio Category', 'thegncy' ),
                    'add_new_item'      => __( 'Add New Category', 'thegncy' ),
                ),
                'hierarchical' => true,
                'show_admin_column'     => true
        ));
    }

    add_action( 'init', 'thegncy_custom_post_type' );

}