<?php 


get_header();

while (have_posts()){
    the_post();
?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: <?php bloginfo('template_directory') ?>/images/ocean.jpg"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title() ?> </h1>
        <div class="page-banner__intro">
            <p>Dont ForGET TO CHANGE ME LATER</p>
        </div>
    </div>  
</div>

<div class="container container--narrow page-section">


    <div class="generic-content"><?php the_content() ?></div>
    
    
    <!--
     Ni-loop ung related programs from Advance custom fields
    programs and events ung ginawan dito ng relationship
     
       -->
    <?php

        $relatedPrograms = get_field('related_programs');

    if( $relatedPrograms ) {

        echo '<hr class="section-break">';
        echo '<h2 class="headline headline headline--medium">Subject(s) Taught</h2>';  
        echo '<ul class="link-list min-list">';
        foreach($relatedPrograms as $program ){    ?>

    <li> <a href="<?php echo get_the_permalink($program) ?>"> <?php echo get_the_title($program); ?></a></li>

    <?php   echo '</ul>';
                                               }
    }
}
    ?>
    <br>


</div>





<?php 

get_footer();
?>