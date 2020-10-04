<?php


/*
GOODNEWS!
by creating this we dont need JSON Syntax.
wordpress will automatically convert PHP into JSON

it can covert PHP into JSON

*/


add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch(){
    
    /*
    3 args
    1st - name we want to use - eg( /wp-json/wp/v2/professor )
        - instead of /wp/ we use university 
        - /wp/v2/ - the v2 -- is just a version. we can include it in the custom URL
        - university/v1
    2nd - Route eg( /wp-json/wp/v2/professor ) <- here professor is the route
    3rd - An array that describes what shud happen when someone visits the URL
    */
    register_rest_route('university/v1','search', array(
    /*
    'method' - think about the CRUD acronym
    'method' => 'GET' - will always work but. if we want to make sure that it will work on all browser then do this - WP_REST_SERVER::READABLE
            - a wordpress constant - 
    callback - we want this function to return - what we want to display
    */
    'methods'       => WP_REST_SERVER::READABLE,
    'callback'      => 'universitySearchResults'
    
    ));
}



function universitySearchResults(){
    
    return 'Congrats nigga babes';
}
