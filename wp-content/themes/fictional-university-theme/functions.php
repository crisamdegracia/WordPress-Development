<?php


function university_files(){
    //1st argument - chosen name for function
    //2nd argument - url
    wp_enqueue_style('university_main_styles', get_stylesheet_uri() ); 
    
    wp_enqueue_style('custom-google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i' ); 
    
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' ); 
}

//1st argument - what type of instructions
//2nd argument - name of the function 
add_action('wp_enqueue_scripts','university_files');












?>