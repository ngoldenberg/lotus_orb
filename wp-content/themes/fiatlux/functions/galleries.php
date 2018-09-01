<?php
add_action( 'init', 'register_taxonomy_ml_gallery' );

function register_taxonomy_ml_gallery() {

    $labels = array( 
        'name' => __( 'Galleries', 'meydjer' ),
        'singular_name' => __( 'Gallery', 'meydjer' ),
        'search_items' => __( 'Search Galleries', 'meydjer' ),
        'popular_items' => __( 'Popular Galleries', 'meydjer' ),
        'all_items' => __( 'All Galleries', 'meydjer' ),
        'parent_item' => __( 'Parent Gallery', 'meydjer' ),
        'parent_item_colon' => __( 'Parent Gallery:', 'meydjer' ),
        'edit_item' => __( 'Edit Gallery', 'meydjer' ),
        'update_item' => __( 'Update Gallery', 'meydjer' ),
        'add_new_item' => __( 'Add New Gallery', 'meydjer' ),
        'new_item_name' => __( 'New Gallery Name', 'meydjer' ),
        'separate_items_with_commas' => __( 'Separate galleries with commas', 'meydjer' ),
        'add_or_remove_items' => __( 'Add or remove galleries', 'meydjer' ),
        'choose_from_most_used' => __( 'Choose from the most used galleries', 'meydjer' ),
        'menu_name' => __( 'Galleries', 'meydjer' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,

        'rewrite' => array( 
            'slug' => 'gallery', 
            'with_front' => true,
            'feeds' => true,
            'pages' => true
        ),
        'query_var' => true
    );

    register_taxonomy( 'ml_gallery', array('ml_pictures'), $args );
}

add_action( 'init', 'register_cpt_ml_pictures' );

function register_cpt_ml_pictures() {

    $labels = array( 
        'name' => __( 'Pictures', 'meydjer' ),
        'singular_name' => __( 'Picture', 'meydjer' ),
        'add_new' => __( 'Add New', 'meydjer' ),
        'add_new_item' => __( 'Add New Picture', 'meydjer' ),
        'edit_item' => __( 'Edit Picture', 'meydjer' ),
        'new_item' => __( 'New Picture', 'meydjer' ),
        'view_item' => __( 'View Picture', 'meydjer' ),
        'search_items' => __( 'Search Pictures', 'meydjer' ),
        'not_found' => __( 'No pictures found', 'meydjer' ),
        'not_found_in_trash' => __( 'No pictures found in Trash', 'meydjer' ),
        'parent_item_colon' => __( 'Parent Picture:', 'meydjer' ),
        'menu_name' => __( 'Pictures', 'meydjer' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'thumbnail' ),
        'taxonomies' => array( 'ml_gallery' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'ml_pictures', $args );
}

?>