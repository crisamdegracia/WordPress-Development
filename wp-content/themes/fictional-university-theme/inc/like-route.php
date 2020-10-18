<?php


/*

*/
add_action('rest_api_init', 'universityLikeRoute');


function universityLikeRoute(){
    /* 3 args
    1st - the 1st part of the URL
    2nd - the name for the specific route URL
    3rd - an array - 2 things
        method - is the type of HTTP request that this route is responsible
        callback - is the function we want to run when a request is sent to one of these routes
        
        2 becoz we want the 
            - 1st one be POST request
            - 2nd one to be DELETE request
    */
    register_rest_route('university/v1','manageLike', array(

        'methods'    =>  'POST',
        'callback'  =>  'createLike'
    ));
    
    
  register_rest_route('university/v1','manageLike', array(

        'methods'    =>  'DELETE',
        'callback'  =>  'deleteLike'
    ));

}


function createLike(){
    
    return 'create PHP';
}


function deleteLike(){
    
    return 'Delete PHP';

}

