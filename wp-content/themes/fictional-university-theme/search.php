<?php 
get_header();
pageBanner(array(
    'title' => 'Search results',
    'sub-title'  => 'You search for &ldquo;'. esc_html( get_search_query() ) . '&ldquo;'

))
?>

<!-- Search results -->




<div class="container container--narrow page-section">

    <?php

    if( have_posts() ){

        while( have_posts()  ) {
            the_post(); 
            get_template_part('template-parts/content', get_post_type() );


        }  echo paginate_links();

    } else { 
    echo "<h2 class='headline headline--small-plus'> No Results match that result</h2>";
        
        
    
/*
this is from searchform.php
*/
get_search_form();   
  

 } ?>



</div>    











<?php 
get_footer();
?>