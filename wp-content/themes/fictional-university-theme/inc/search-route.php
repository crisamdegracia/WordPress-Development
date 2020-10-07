<?php




/*
Tang ina ang gulo! nung una okay mejo maikli pa ung code.!
nung dumami na andami ko nang mga kommen nagulo lalo!

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
    parang ung nagawa lang tayong custom post type dun sa pinaka 
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

      old vid 63 - 
      $result
    ----------------------------------------*/

    /*
      old vid 63 - 
      $professorsResult = array()
      array_push( $professorsResult , array() )


$results = array() <- from video 60 something 
we create an arrays, so they can array_push the array 
- then we can look and use what insides it 
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


        /*
        in f16v69 - 2:31
        we added ID - so we can add the relationship inside professors
                        [0][id] - zero is to look 1st on the 1st item
                        where the array value resides
        it will look like this $results['programs'][0]['id']
        */
        if(get_post_type() == 'program' ){

            $relatedCampus = get_field('related_campuses');
            /*
ang una ginawa ko nag gawa ako ng katulad ng mga unang ginawa nya 
about relationships, but this in the campuses are totally different approach

we will only run this code if $relatedCampus is not empty
*/
            if($relatedCampus){

                foreach($relatedCampus as $campus){
                    /*
                    f16v70 - watch there there
                    what we wanna loop here will be push into the $results['campuses'] array
                    */
                    array_push($results['campuses'], array(
                        'title' => get_the_title($campus),
                        'permalink' => get_the_permalink($campus )
                    ) );

                }
            }

            array_push($results['programs'], array(
                'title'     => get_the_title(),
                'permalink' => get_the_permalink(),
                'id'        => get_the_ID()


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


            ));

        }
    }

    /* Start of the related programs array_push ---------------------------------------------------------------------------
    Creating Search With Relationships in program

    creating relationship before returning the result


    this solves the problem on 'post_type' => 'professor'
         */
    if( $results['programs']){
        /*
    we are creating a filter just like on the early lectures

    'key'           => 'related_programs',
    'compare'       =>  'LIKE',
    'value'         =>  '"58"'   <-------------- THE ID of programs  not dynamic

    .$results['programs'][0]['id']. <---- Dynamic

    the question raised what if there are multiple programs in array?
    for example Basic-Math - Advanced-Math
    in that case we dont want to set it on the first item [0] on the filter value

    */
        // relation => OR - we just manually added it as value
        $programsMetaQuery  = array('relation'  => 'OR');


        /* loop and add other array inside 1st item on programs */
        foreach($results['programs'] as $item ){

            /*
        1st args the array we want to add into
        2nd the item we want to add


        Napaka Lupet! PWEDE pala yon?
        ung array_push 2nd args!
        tapos nilagay na dun sa filter meta_query as value
        */
            array_push($programsMetaQuery, array(
                'key'           => 'related_programs',
                'compare'       =>  'LIKE',
                'value'         =>  '"' .$item['id']. '"'

            ) );
        }
        


/*---- End of the $result['program'] ---------------------------------------*/

            /*  
    'post_type' - 'professors' <--- Problem
    - is that when we search on search?term=asldkjaklsdj with any key values
    it will still return all the programs related

    in f16v70 - e nag bago. instead just professor, we create an array()


    GO TO if - andun ung answer
    
        $programRelationshipQuery = new WP_Query(array(
            'post_type'         => array('professor','event', 'campus'),
            'meta_query'        =>  $programsMetaQuery

     f16v69 - 10:22
      NOT Dynamic - 
        $programRelationshipQuery = new WP_Query(array(
        'post_type'         => 'professor',
        'meta_query'        => array(


     array(
            'key'           => 'related_programs',
            'compare'       =>  'LIKE',
            'value'         =>  '"' .$results['programs'][0]['id']. '"'

        )), array(
            'key'           => 'related_programs',
            'compare'       =>  'LIKE',
            'value'         =>  '"' .$results['programs'][1]['id']. '"'

        )), array(
            'key'           => 'related_programs',
            'compare'       =>  'LIKE',
            'value'         =>  '"' .$results['programs'][2]['id']. '"'

        ));
        ))*/

        while($programRelationshipQuery->have_posts() ){
            $programRelationshipQuery->the_post();


            if(get_post_type() == 'professor'){

                array_push($results['professors'], array(
                    'title'     => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'image'     => get_the_post_thumbnail_url(0, 'professorLandscape')

                ) );

            } /* will be push to professors*/


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



        }


        // to remove duplicate the created from pushing data to the result variable
        /*
    2args -
    1st - the array we want to work with
    2nd -  to please look within each sub item of an array when 
    we are trying to determine if they arre dplicate or not
        - SORT_REGULAR - array unique removes any and all duplicates
        - by covering array_values() it will remove the numerical number 
        before the array values
        */
        $results['professors'] = array_values(array_unique($results['professors'], SORT_REGULAR));

        /*---------- sa Event naman -----------*/
        $results['event'] = array_values(array_unique($results['events'], SORT_REGULAR));


    }





    return $results;


}



















