<?php
// Menu icons for Custom Post Types
// https://developer.wordpress.org/resource/dashicons/
function add_menu_icons_styles(){
?>
 
<style>
#menu-posts-editorial .dashicons-admin-post:before {
    content: '\f319';
}
</style>
 
<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );


//Register Custom Post Types
add_action( 'init', 'register_cpt_editorial' );

function register_cpt_editorial() {

    $labels = array( 
        'name' => _x( 'Editorials', 'editorial' ),
        'singular_name' => _x( 'Editorial', 'editorial' ),
        'add_new' => _x( 'Add New', 'editorial' ),
        'add_new_item' => _x( 'Add New Editorial', 'editorial' ),
        'edit_item' => _x( 'Edit Editorial', 'editorial' ),
        'new_item' => _x( 'New Editorial', 'editorial' ),
        'view_item' => _x( 'View Editorial', 'editorial' ),
        'search_items' => _x( 'Search Editorials', 'editorial' ),
        'not_found' => _x( 'No editorials found', 'editorial' ),
        'not_found_in_trash' => _x( 'No editorials found in Trash', 'editorial' ),
        'parent_item_colon' => _x( 'Parent Editorial:', 'editorial' ),
        'menu_name' => _x( 'Editorials', 'editorial' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'editorial', $args );
}
