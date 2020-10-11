<?php

/*-------------------------------------------------------
this 
require get_theme_file_path('/inc/search-route.php')
is not required - its just for making things organize

*/
require get_theme_file_path('/inc/search-route.php');
/*-------------------------------------------------------*/



function university_custom_rest(){
    
    /*
    VERY POWERFUL
    3args
    1st arg - the post type we want to customize
    2nd arg - whatever name you want to add.
    3rd arg - an array that describes how we want to manage this field.
    
    We can create as many property as we want.
    
    The added Idea here - we can create a data using PHP and use it to Javascript
    */
    register_rest_field('post', 'authorName', array(
    /*
    our function is going to look for an argument named 
    get_callback and set it equal to function
    whatever the function return, it will be use as a value
    for authorName - that we can call in Javascript
    */
    'get_callback'      => function(){ return get_the_author(); }

));
    /*
    Create more!
    register_rest_field();
    register_rest_field();
    register_rest_field();
    */
    
}

/*
1st arg - a hook 
2nd arg - function name
*/
add_action('rest_api_init', 'university_custom_rest');


// php logic will live here
// !args['title'] - if the title is not passed into it page - and if thats the case,
// then let's just set the title field for that post or page to get_the_title()

function pageBanner($args = NULL ){

    if( !$args['title'] ){
        $args['title'] = get_the_title();
    }     
    if( !$args['sub-title'] ){
        $args['sub-title'] = get_field('page_banner_subtitle');
    } 
    if ( !$args['photo'] ){
        if(get_field('page_banner_background_image')){
            $args['photo']     =  get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo']     =  get_theme_file_uri('/images/ocean.jpg');

        }
    }


?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']  ?>)">   
    </div> 
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title']; ?> </h1>
        <div class="page-banner__intro">
            <p><?php echo $args['sub-title'] ?></p>
        </div>
    </div>  
</div>



<?php 
        // var_dump($pageBannerImage );
}



function university_files(){

    // we start [//] for 2nd args so the web will not throw error
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyD-rsOXjG5-vXQEjd-YFC4zBBEEAb8tl6w', NULL, '1.0' , true  );

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


    //f14v57 - 12:00 - you watch
    // will let us output a little bit of JS data into source
    // 1st arg - the name of the handle of our main JS file
    // dapat daw match kung nasan ung main JS file - pero gamit lang ung name ng handle as argument
    // 2nd arg - gawagawa ng variable  name
    // 3rd arg - an array of data that we want to be availabe in Javascript
    wp_localize_script('main-university-js', 'universityData', array(
    
        /* 
        nonce - wp_create_nonce - wordPress will not allow us to delete 
        data in Javascript - 
                - its a secret data
        Nonce - stands for number use once or number one.
        
        whenever we succesfully logged in, wordpress will gives us NONCE
        */
    'root_url'  => get_site_url(),
    'nonce' =>  wp_create_nonce('wp_rest')   
    
    ) );
    
    

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

    // add post thumbnail
    add_theme_support('post-thumbnails');  

    //1st arg nickname for the image size - any name
    // image wide - 400 - tall - 260
    // 3rd image - if we want to crop - FALSE
    // if we want the image to be exactly this wide
    // and exactly this tall, we need to give it TRUE
    // array args - to control the cropping array('left','bottom')
    add_image_size('professorLandscape', 400, 260, true );
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);






}

//1st argument - wordpress event
//2nd args - function - a name of function we will invent
add_action('after_setup_theme', 'university_features');




function university_adjust_queries($query){

    //on this campus archive page 
    // we only want to display the title on the map 
    // that is why theere is only  posts_per_page here
    if( !is_admin() AND is_post_type_archive('campus') AND $query->is_main_query() ) {
        $query->set('posts_per_page', -1); 
    }



    // set has 2 args
    //1st args is the name of a query parameter that we want to change
    // the value that we want to use
    //$query->set('posts_per_page', '1');
    //if not in the admin -
    // kung nasa post type archive event daw tayo
    //$query so if daw the $query that is being passed into our function
    // the $query then we can look for a method named is_main_query() 
    // so this way daw we cannot accidentally manipulate a custom query
    // $query->is_main_query() - will only evaluate to true if
    // the query in question is the default URL based query
    //Always perform 1 more check
    // is_admin() - will return true if we are on the admin panel of our website
    // !is_admin() - will return true if we are on the front-end of our website
    if ( !is_admin() AND is_post_type_archive('event') AND $query->is_main_query() ) {

        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key'      => 'event_date',
                'compare'  => '>=',
                'value'    =>   $today,
                'type'     => 'numeric'
            )
        )
                   );

    }

    //the 3rd condition - if only the $query in question can look inside its main 
    //query -- so that way we dont manipulate any secondary custom queries,
    // we only want to manipulate the main default URL based query
    // this is the safest condition check
    if( !is_admin() AND is_post_type_archive('program') AND $query->is_main_query() ) {
        $query->set('orderby','title');
        $query->set('order','ASC'); 
        $query->set('posts_per_page', 5); 
    }





}

//pre_get_posts - ryt before we get the post with the query
// its going to give a reference to the wordpress query object
add_action('pre_get_posts', 'university_adjust_queries');

function UniversityMapKey($api){

    $api['key'] = 'AIzaSyD-rsOXjG5-vXQEjd-YFC4zBBEEAb8tl6w';
    return $api;

}
//1st args to target the Advanced Custom Fields and let it know
// that we have Google Maps API
add_filter('acf/fields/google_map/api', 'UniversityMapKey');






//redirect subscriber to homepage

/*
1st arg - name of worpress event we want to hook
2nd arg - name of function

admin_init is triggered before any other hook when a user accesses the admin area.
*/
add_action('admin_init', 'redirectSubsToFrontend');
    
    function redirectSubsToFrontend(){
     
        $currentUser = wp_get_current_user();
        
        /*
        before we create condition we need to create variable
        so we can look inside it. AHA! so we can look pala ha!
        
        if how many users are in the array, if there is 1 user, another check
        if the user is subscriber
        then exit
        
        exit- so the engine will not do anything after redirects
        */
        if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber') {
            wp_redirect(site_url('/'));
            
            exit;
        }
        
    }


add_action('wp_loaded', 'noSubAdminBar');
    
    function noSubAdminBar(){
     
        $currentUser = wp_get_current_user();
        
        /*
        before we create condition we need to create variable
        so we can look inside it. AHA! so we can look pala ha!
        
        if how many users are in the array, if there is 1 user, another check
        if the user is subscriber
       
        
        
        */
        if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber') {
            
            /* removes the admin bar */
           show_admin_bar(false);
            
           
        }
        
    }
/*Logout Redirect*/

add_action('wp_logout','logoutRedirect');
function logoutRedirect(){
         wp_redirect( site_url('/') );
         exit();
}




/*
Customize Login Screen
*/

add_filter('login_headerurl', 'ourHeaderUrl');
function ourHeaderUrl(){
    return esc_url(site_url('/'));
}




/*
this script will fire on login to override the css
*/
add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS(){
      wp_enqueue_style('university_main_styles', get_stylesheet_uri(), NULL, microtime() ); 
    
     wp_enqueue_style('custom-google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i' ); 
}

/*

iremove ung pag hover mo sa logo ng login na wordpress logo ung title ng wordpress 
palitan ung Powered by WordPress
*/

add_filter('login_headertitle', 'ourLoginTitle' );

function ourLoginTitle(){
    
    //we can return like anything asdasdsad
    return get_bloginfo('name');
    
}


?>