<?php
// Create some posttype for this theme

if (function_exists('add_action')) {
    // add_action('init', 'book_post_type');
    add_action('init', 'testimonial_post_type');
    add_action('init', 'team_post_type');
    add_action('init', 'author_book_post_type');
    add_action('init', 'publisher_post_type');
    add_action('init', 'store_post_type');
    add_action('init', 'retailers_post_type');
}


//Author postype
function author_post_type()
{
    $labels = array(
        'name' => _x('Author', 'post type general name', 'bebostore'),
        'singular_name' => _x('Author', 'post type singular name', 'bebostore'),
        'add_new' => _x('Add New', 'author', 'bebostore'),
        'add_new_item' => __('Add new author', 'bebostore'),
        'edit_item' => __('Edit author', 'bebostore'),
        'new_item' => __('New author', 'bebostore'),
        'all_items' => __('All author', 'bebostore'),
        'view_item' => __('View author', 'bebostore'),
        'search_items' => __('Search author', 'bebostore'),
        'not_found' =>  __('No partner Found', 'bebostore'),
        'not_found_in_trash' => __('No author Found in Trash', 'bebostore'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-admin-users',
        'rewrite' => array('slug' => 'author', 'with_front' => false),
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes', 'editor'),
    );
    register_post_type( 'author' , $args );
}

//Author postype
function author_book_post_type()
{
    $labels = array(
        'name' => _x('Author book', 'post type general name', 'bebostore'),
        'singular_name' => _x('Author book', 'post type singular name', 'bebostore'),
        'add_new' => _x('Add New', 'author book', 'bebostore'),
        'add_new_item' => __('Add new author book', 'bebostore'),
        'edit_item' => __('Edit author book', 'bebostore'),
        'new_item' => __('New author book', 'bebostore'),
        'all_items' => __('All author book', 'bebostore'),
        'view_item' => __('View author book', 'bebostore'),
        'search_items' => __('Search author book', 'bebostore'),
        'not_found' =>  __('No partner Found', 'bebostore'),
        'not_found_in_trash' => __('No author book Found in Trash', 'bebostore'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-admin-users',
        'rewrite' => array('slug' => 'author-book', 'with_front' => false),
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes', 'editor'),
    );
    register_post_type( 'authorbook' , $args );
}




//Publisher postype
function publisher_post_type()
{
    $labels = array(
        'name' => _x('Publisher', 'post type general name', 'bebostore'),
        'singular_name' => _x('Publisher', 'post type singular name', 'bebostore'),
        'add_new' => _x('Add New', 'publisher', 'bebostore'),
        'add_new_item' => __('Add new publisher', 'bebostore'),
        'edit_item' => __('Edit publisher', 'bebostore'),
        'new_item' => __('New publisher', 'bebostore'),
        'all_items' => __('All publisher', 'bebostore'),
        'view_item' => __('View publisher', 'bebostore'),
        'search_items' => __('Search publisher', 'bebostore'),
        'not_found' =>  __('No partner Found', 'bebostore'),
        'not_found_in_trash' => __('No publisher Found in Trash', 'bebostore'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-category',
        'rewrite' => array('slug' => 'publisher', 'with_front' => false),
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes', 'editor'),
    );
    register_post_type( 'publisher' , $args );
}

// Posttype testimonial
function testimonial_post_type()
{
    $labels = array(
        'name' => _x('Testimonial', 'post type general name', 'bebostore'),
        'singular_name' => _x('Testimonial', 'post type singular name', 'bebostore'),
        'add_new' => _x('Add New', 'testimonial', 'bebostore'),
        'add_new_item' => __('Add new testimonial', 'bebostore'),
        'edit_item' => __('Edit testimonial', 'bebostore'),
        'new_item' => __('New testimonial', 'bebostore'),
        'all_items' => __('All testimonial', 'bebostore'),
        'view_item' => __('View testimonial', 'bebostore'),
        'search_items' => __('Search testimonial', 'bebostore'),
        'not_found' =>  __('No partner Found', 'bebostore'),
        'not_found_in_trash' => __('No testimonial Found in Trash', 'bebostore'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-testimonial',
        'rewrite' => array('slug' => 'testimonial', 'with_front' => false),
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes')
    );
    register_post_type( 'testimonial' , $args );
}

// Posttype Store
function store_post_type()
{
    $labels = array(
        'name' => _x('Store', 'post type general name', 'bebostore'),
        'singular_name' => _x('Store', 'post type singular name', 'bebostore'),
        'add_new' => _x('Add New', 'store', 'bebostore'),
        'add_new_item' => __('Add new store', 'bebostore'),
        'edit_item' => __('Edit store', 'bebostore'),
        'new_item' => __('New store', 'bebostore'),
        'all_items' => __('All store', 'bebostore'),
        'view_item' => __('View store', 'bebostore'),
        'search_items' => __('Search store', 'bebostore'),
        'not_found' =>  __('No partner Found', 'bebostore'),
        'not_found_in_trash' => __('No store Found in Trash', 'bebostore'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-store',
        'rewrite' => array('slug' => 'store', 'with_front' => false),
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes')
    );
    register_post_type( 'store' , $args );
}

// Posttype Team
function team_post_type()
{
    $labels = array(
        'name' => _x('Team', 'post type general name', 'bebostore'),
        'singular_name' => _x('Team', 'post type singular name', 'bebostore'),
        'add_new' => _x('Add New', 'team', 'bebostore'),
        'add_new_item' => __('Add new team', 'bebostore'),
        'edit_item' => __('Edit team', 'bebostore'),
        'new_item' => __('New team', 'bebostore'),
        'all_items' => __('All team', 'bebostore'),
        'view_item' => __('View team', 'bebostore'),
        'search_items' => __('Search team', 'bebostore'),
        'not_found' =>  __('No partner Found', 'bebostore'),
        'not_found_in_trash' => __('No team Found in Trash', 'bebostore'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-image-filter',
        'rewrite' => array('slug' => 'team', 'with_front' => false),
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes')
    );
    register_post_type( 'team' , $args );
}

// Posttype Retailers
function retailers_post_type()
{
    $labels = array(
        'name' => _x('Retailers', 'post type general name', 'bebostore'),
        'singular_name' => _x('Retailers', 'post type singular name', 'bebostore'),
        'add_new' => _x('Add New', 'retailers', 'bebostore'),
        'add_new_item' => __('Add new retailers', 'bebostore'),
        'edit_item' => __('Edit retailers', 'bebostore'),
        'new_item' => __('New retailers', 'bebostore'),
        'all_items' => __('All retailers', 'bebostore'),
        'view_item' => __('View retailers', 'bebostore'),
        'search_items' => __('Search retailers', 'bebostore'),
        'not_found' =>  __('No partner Found', 'bebostore'),
        'not_found_in_trash' => __('No retailers Found in Trash', 'bebostore'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-image-filter',
        'rewrite' => array('slug' => 'retailers', 'with_front' => false),
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes')
    );
    register_post_type( 'retailers' , $args );
}

?>