<?php




/*
The idea is to create custom JSON API 
then ung mga PHP code is ma convert to Javascript

GOODNEWS!
by creating this we dont need JSON Syntax.
wordpress will automatically convert PHP into JSON

it can covert PHP into JSON


in F15v64 kaya WATCH MO sana - things mejo nakaklito - my inexplain sya
na alam kong importante pero cant follow 


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
    callback - a function to return - what we want to display
             - and this will make our search-route operation
    */
        'methods'       => WP_REST_SERVER::READABLE,
        'callback'      => 'universitySearchResults'

    ));
}


/*
what ever we return here even if its not valid JSON
if its PHP array
if its JS array
it will still output JSON data - meaning it will convert -

f15v64 - we added a parameter $data
        - by adding this parameter - we can now pass a wordp to our search
        $data['term'] - term is property inside professor post_type
                        - pero tinignan ko ung 'term' dun sa JSON data sa professor wala naman 
                        - sabi nya the point daw ung['term'] is we have the control
                        - it can be anything
                        - now the user can search using keyword that matches data inside the professors post_type

SECURITY CHECKS! - > sanitize -> Sanitize text field

*/
function universitySearchResults( $data ){

    /*
    Create a class kung san natin kukunin ung data
    - isa lang need natin, post_type lang.
    parang ung nagawa lang tayong custom posty ype dun sa pinaka 
    fron-end php file AHA!

    's' - stands for seach

    v64 ata?
    'post_type'     => 'professors' 
    to
    'post_type'     => array('post','page','professor', 'program', 'campus', 


    v65 - we change from 'post_type' => 'professors' to  
        - $professors to $mainQuery
    */


    $mainQuery = new WP_Query(array(

        'post_type'     => array('post','page','professor', 'program', 'campus', 'event'),
        's'             => sanitize_text_field($data['term'])  
    ));
    /* --------------------------------------
    1st example - return $professors->posts - binura ;

    tapos ia-output ng return 
    titignan lang natin ung posts. 
    un lang ung datang lalabas
    ----------------------------------------*/


    /* 2nd example---------------------------
    we will create an array 
    we will loop 
    then we will push inside a loop to the new php variable
    $professorsResult

    2 args array_push()
    - 1st - the array we want to add in to
    - 2nd - kung anong ilalagay natin sa array

    1st example
      array_push($professorsResult, get_the_title() )
      pero kung get_title() nga lang daw - parang kulang - array()

      old vud 63 - 
      $result
    ----------------------------------------*/

    /*
      old vid 63 - 
      $professorsResult = array()
      array_push( $professorsResult , array() )



    ----------------------------------------*/

    $results = array( 
        'generalInfo'       => array(),
        'professors'        => array(),
        'programs'          => array(),
        'events'            => array(),
        'campuses'          => array()
    );


    /* 
    everything we loop here will be pushed
    into $results arrays
    */
    while($mainQuery->have_posts()){
        $mainQuery->the_post();

        if(get_post_type() == 'post' OR get_post_type() == 'page'){

            array_push($results['generalInfo'], array(
                'title'     => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType'  => get_post_type(),
                'authorName'    => get_the_author()


            ) );

        }  /* will be push to generalInfo    -- post % page*/

        if(get_post_type() == 'professor'){

            array_push($results['professors'], array(
                'title'     => get_the_title(),
                'permalink' => get_the_permalink(),
                'image'     => get_the_post_thumbnail_url(0, 'professorLandscape')

            ) );

        } /* will be push to professors*/

        if(get_post_type() == 'program' ){

            array_push($results['programs'], array(
                'title'     => get_the_title(),
                'permalink' => get_the_permalink(),


            ) );

        } /*will be push to programs*/


        if(get_post_type() == 'event' ){

            /* Tricky! create a day and month*/

            $eventDate = new DateTime( get_post_field('event_date') );

            /*Create short description from events*/
            $description = null;

            if( has_excerpt() ) {
                $description = get_the_excerpt();          
            } else {
                $description =  wp_trim_words(get_the_content(), 18 );
            } 

            array_push($results['events'], array(
                'title'     => get_the_title(),
                'permalink' => get_the_permalink(),
                'month'     => $eventDate->format('M'),
                'day'       => $eventDate->format('d'),
                'description'   => $description


            ) );

        } /*will be push to events */

        if(get_post_type() == 'campus' ){

            array_push($results['campuses'], array(
                'title'     => get_the_title(),
                'permalink' => get_the_permalink(),


            ) );

        }
    }

    
    /* 
    Creating Search With Relationship
    
    we are creating a filter just like on the earlu lectures
    */
    
    
    $programRelationshipQuery = new WP_Query(array(
        'post_type'         => 'professor',
        'meta_query'        => array(
        array(
         
        
        ))
    ));
    
    return $results;


}



















