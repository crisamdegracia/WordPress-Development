<?php


function university_files(){
    //1st argument - chosen name for function
    //2nd argument - url
    //3rd argument - WordPress wants to know if this script depends on in other script
    //if it depending on other dependencies? - no so NULL
    // 4th in CSS - microtime() - to remove caching in css.
    wp_enqueue_style('university_main_styles', get_stylesheet_uri(), NULL, microtime() ); 

    wp_enqueue_style('custom-google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i' ); 

    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' ); 

    //3rd argument - WordPress wants to know if this script depends on in other script
    //if it depending on other dependencies? - no so NULL
    //4th argument - What is the version but in local dev we need microtime.
    //microtime - to remove caching of css and js
    //5th argument - if we want to load it before closing body tag. Yes (True) or No (False)
    // TRUE - going to the bottom of body tag
    wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime() , TRUE  );
}

//1st argument - what type of instructions
//2nd argument - name of the function 
add_action('wp_enqueue_scripts','university_files');


function university_features(){
    //theme functions

    // 1st arg - name para mapoint out dun sa front end 
    //2nd argument - this is the text that will show up in WP admin screen 
    register_nav_menu('headerMenuLocation', 'Header Menu Location'); 
    register_nav_menu('footerMenuLocationOne', 'Footer Menu Location One'); 
    register_nav_menu('footerMenuLocationTwo', 'Footer Menu Location Two'); 

    //show the title on browser tag
    add_theme_support('title-tag');  



}

//1st argument - wordpress event
//2nd args - function - a name of function we will invent
add_action('after_setup_theme', 'university_features');




function university_adjust_queries($query){
    // set has 2 args
    //1st args is the name of a query parameter that we want to change
    // the value that we want to use
    $query->set('posts_per_page', '1');
}

//pre_get_posts - ryt before we get the post with the query
// its going to give a reference to the wordpress query object
add_action('pre_get_posts', 'university_adjust_queries');



?>