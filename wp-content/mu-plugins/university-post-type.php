<?php

function university_post_types(){

    //public - this will make visible to editors and viewers of the website
    //labels -> name -> the name on side panel 
    //has_archive -> true - to tell WP to create an archive page for this CPT
    //'rewrite' => array('slug' => 'events') -- will change the URL link from singular to plural - ['slug' => 'events'] we can actually invent the word 'events'  to pizza or anything!
    //supports -  para maging available ung dun sa excerpt and all
    register_post_type('event', array(
        'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar'
    )); 


    //program post type
    register_post_type('program', array(
        'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
        'rewrite' => array('slug' => 'programs'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Program',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards'
    ));


    //Professor post type
    //  'rewrite' => array('slug' => 'professors'), - was removed
    register_post_type('professor', array(
        'supports' => array('title', 'editor', 'thumbnail'),
        'public' => true,
        'labels' => array(
            'name' => 'Professor',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professor',
            'singular_name' => 'Professor'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more'
    )); 
    
    //Campus Post Type
    register_post_type('campus', array(
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug'  => 'campuses'),
        'has_archive' => true,
        'public'    => true,
        'labels' => array(
            'name' => 'Campuses',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus'
        ),
        'menu_icon' => 'dashicons-location-alt'
    ));
}

// 1st args a hook
// name of a function
add_action('init', 'university_post_types');



?>