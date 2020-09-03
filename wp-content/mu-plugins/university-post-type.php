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
}

// 1st args a hook
// name of a function
add_action('init', 'university_post_types');



?>