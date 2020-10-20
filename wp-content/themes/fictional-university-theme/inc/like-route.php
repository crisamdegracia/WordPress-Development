<?php


/*
JS and PHP - Custom API request
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



function createLike($data){
    /*limit the Like to 1
    but check 1st if user is logged in
    */
    if(is_user_logged_in() ){


        /*
    JS set this 1st. then we can call it on PHP
    $data - container for the value from JS
    $data[] - array, so we can look inside of all the value
        - coz WordPress smushes all the incoming data
        - whether if its JS or PHP 
    $data['professorId'] - is the exact data object variable we set from JS    
        - now we sanitize it and set it in variable
        - this variable contain the ID number of the professor

*/
        $professor = sanitize_text_field($data['professorId']);




        /*Nag kanda leche leche  f20v90 13:00-----------------------*/

        /*
    this query will contain results if the current user has already liked the current
    professor
    
    so then, if not, we can create new like
    */
        $existQuery =  new WP_Query(array(
            'author'        => get_current_user_id(),
            'post_type'     => 'like',
            'meta_query'    => array(
                array(
                    'key'       => 'liked_professor_id',
                    'compare'   => '=',
                    'value'     => $professor
                ))
        ));
        /*-----------------------*/


        /* f20v89
  wp_insert_post()
    this function will let us programmatically create a new post right from within our PHP code
    array() - a post we want to create

    meta_input - value pair
        - and this will create wordpress native custom fields
        - or sometimes WordPress officially refers to them
        - 
    return - to return somthing so that server sends back response so that we have
        - something to see in our JS - we will also see in console.log
    */

        // if like doesnt already exist, then create new like post
        // 2nd condition - to make sure that the ID belongs to the professor
            // get_post_type() - needs ID
            // if it professor then the code will run
        if( $existQuery->found_posts == 0 AND get_post_type($professor) == 'professor' ){

            return wp_insert_post(array(
                'post_type'     => 'like',
                'post_status'   => 'publish',
                'post_title'    => '4rd test',
                'meta_input'    => array(
                    'liked_professor_id' => $professor
                )

            ));
        }
        else {
            die('Invalid Professor');
        }
    }
    else {
        die('You need to log in to do that.');
    }
}


function deleteLike($data){
/* this ID contain whatever the JS will send us here on PHP
$data['like'] - must match the property that ajax.data will send us.
*/
    
  $likeID  = sanitize_text_field($data['like']);
      
      /* 1st args is the id that post we want to delete 
        2nd - if we want to trash itt or completely delete it 
            - true - will skip the trash and totally delete it
      wp_delete_post($likeID, true ) - very unsecure! 
      
      
      if get_current_user_id - so malicious user cannot just delete 
        - and it must be their post to delete - ung gawa nila.
      
      get_post_field() - 2 args - 2nd - is the ID of the post we want info about 
        - 1st args - is what information we want from that post
      
      2nd condition - get_post_type() - whatever post type we want to delete
        - to make sure that is equals to 'like' post_type
      
      */
      
      
      if(get_current_user_id() == get_post_field('post_author', $likeID ) AND  get_post_type( $likeID ) == 'like') {
          
      wp_delete_post($likeID, true );
          return 'Congrats! like deleted.';
      
      } else {
          die('You do not have permission to delete that.');
      }

}

