<?php 


get_header();

while (have_posts()){

    the_post();
    pageBanner(array(
        'title' => 'WAOAOAO TITLE',
        'sub-title' => 'Lorem ipsum dolor esmet'

    ));


?>



<div class="container container--narrow page-section">


    <div class="generic-content">
        <div class="row group">
            <div class="one-third">
                <?php the_post_thumbnail('professorPortrait'); ?>
            </div>
            <div class="two-thirds">
               
                    <?php 
    /*
                meta_query - we need to use it coz we only want to pull in like posts
                where the liked Professor ID value matches the ID of the current professor
                page that we are viewing
                    - remember that the meta_query is a filter of arrays
                    - key - the Custom Field key
                    - compare - (=)  - coz we are looking at the exact match 
                    - value - the id of the current viewer
                */

    $likeCount =  new WP_Query(array(

        'post_type'     => 'like',
        'meta_query'    => array(
            array(
            'key'       => 'liked_professor_id',
            'value'     => get_the_ID(),
            'compare'   => '='
        ))
    ));
    
    if(is_user_logged_in()){
           
    // this will change the value to yes and then will change the heart icon to active
    $existStatus = 'no';
    
        
        
    /*
    this query will contain results if the current user has already liked the current
    professor
    */
    $existQuery =  new WP_Query(array(
        'author'        => get_current_user_id(),
        'post_type'     => 'like',
        'meta_query'    => array(
            array(
            'key'       => 'liked_professor_id',
            'value'     => get_the_ID(),
            'compare'   => '='
        ))
    ));
    
    if( $existQuery->found_posts) { $existStatus = 'yes'; } 
      
    }
    
               ?>
               <!--
               $existQuery - will contain result if the current user has liked the current professor
               
               data-like=$existQuery->posts[0]->ID
                   - we will look inside the $existQuery for the 1st array of posts (posts[0]) 
                   - then we will look inside that posts[0] for the ID
                   - we can now use this value on our JS
               -->
 <span class="like-box" data-like="<?php echo $existQuery->posts[0]->ID ?>" data-professor="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>">
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <span class="like-count"><?php echo $likeCount->found_posts;?></span>
                </span>
                <?php the_content(); ?>
            </div>
        </div>

    </div>


    <!--
Ni-loop ung related programs from Advance custom fields
programs and events ung ginawan dito ng relationship
f10v39
-->
    <?php

    $relatedPrograms = get_field('related_programs');

    //kung merong related program - will output

    if( $relatedPrograms ) {

        echo '<hr class="section-break">';
        echo '<h2 class="headline headline headline--medium">Subject(s) Taught</h2>';  
        echo '<ul class="link-list min-list">';


        foreach($relatedPrograms as $program ){    ?>

    <li> <a href="<?php echo get_the_permalink($program) ?>"> <?php echo get_the_title($program); ?></a></li>

    <?php   echo '</ul>';
                                              } // end foreach
    } // if end
} //main loop
    ?>
    <br>


</div>





<?php 

get_footer();
?>