<?php

/*

Reason Why We Are Creating Our Own 
New REST API URL

1. Custom Search Logic
2. Respond with less JSON data ( load faster for visitors )
3. Send only 1 JSON request instead of 6 in our JS
4. Perfect excercise for sharpening PHP
*/


function university_post_types(){


    //Professor post type
    //  'rewrite' => array('slug' => 'professors'), - was removed
    // show_in_rest = true - you can now access the json URL - 
    // /wp-json/wp/v2/professor
    register_post_type('professor', array(
        'show_in_rest'  => true,
        'supports'      => array('title', 'editor', 'thumbnail'),
        'public'        => true,
        'labels'        => array(
            'name'      => 'Professor',
            'add_new_item'  => 'Add New Professor',
            'edit_item'     => 'Edit Professors',
            'all_items'     => 'All Professors',
            'singular_name' => 'Professor'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more'
    )); 





    //public - this will make visible to editors and viewers of the website
    //labels -> name -> the name on side panel 
    //has_archive -> true - to tell WP to create an archive page for this CPT
    //'rewrite' => array('slug' => 'events') -- will change the URL link from singular to plural - ['slug' => 'events'] we can actually invent the word 'events'  to pizza or anything!
    //supports -  para maging available ung dun sa excerpt and all
    /*
     'capability_type'   => 'event',
        'map_meta_cap'      => true,
        these 2 - are required to create user roles, 

        now with these two - events has been created in the plugin members
    */
    register_post_type('event', array(
        'capability_type'   => 'event',
        'map_meta_cap'      => true,

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
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards'
    ));


    /*
     'capability_type'   => 'event',
        'map_meta_cap'      => true,
        these 2 - are required to create user roles, 

        now with these two - events has been created in the plugin members
    */
    //Campus Post Type
    register_post_type('campus', array(
        'capability_type'   => 'campus',
        'map_meta_cap'      => true,

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


    /*
    show_in_rest = yes | so we can use it in WP rest
    public = false | because its a private
        - false, will also hide it in admin dashboard
    show_ui - will show now in WP admin dashboard
    'capability_type' => 'note', - note value doesnt need to be the same on postype name
        - why we set this? because the default permission is set to blog post type
        - so by saying capability type is equals something new and unique we are setting up a brand new permission 
    'map_meta_cap'   => true, - will enforce and require the permission at the right time 
        and at the right place 

        those 2 will allow us to grant subscriber role to post note - after this we will give all the checks grants for notes
            -this also needed when we want to display it in side panel on dashboard

    */
    register_post_type('note', array(
        'capability_type' => 'note',
        'map_meta_cap'   => true,
        'show_in_rest'  => true,
        'supports'      => array('title', 'editor'),
        'public'        => false,
        'show_ui'    => true,
        'labels'        => array(
            'name'      => 'Note',
            'add_new_item'  => 'Add New Note',
            'edit_item'     => 'Edit Note',
            'all_items'     => 'All Notes',
            'singular_name' => 'Note'
        ),
        'menu_icon' => 'dashicons-welcome-write-blog'
    )); 


    /*
    Like Post Type
    Custom API
    
    */
    register_post_type('like', array(
        
        'supports'      => array('title'),
        'public'        => false,
        'show_ui'    => true,
        'labels'        => array(
            'name'      => 'Like',
            'add_new_item'  => 'Add New Like',
            'edit_item'     => 'Edit Like',
            'all_items'     => 'All Like',
            'singular_name' => 'Like'
        ),
        'menu_icon' => 'dashicons-heart'
    )); 




}

// 1st args a hook
// name of a function
add_action('init', 'university_post_types');



?>