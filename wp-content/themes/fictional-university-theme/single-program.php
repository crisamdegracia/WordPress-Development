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


    <?php the_content() ?>
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs </a> <span class="metabox__main"><?php the_title() ?> </span></p>

    </div>
    <div class="generic-content"><?php the_content() ?></div>


    <?php
        //post_per_page - kung ilan lilitaw dun sa fron-end
        //post_type - kung anong post type
        // orderby - post_date - the date that the post was created or published
        // ^       - value [post_date] is the default value
        //^ value [title] - will be alphabetically
        //^ orderby->rand - post will be random
        //^ orderby->meta_value_num - it need the meta_key 1st - then the value means that the orderby will be base on any value of Post Type.
        // meta_key-event_date - the ACF variabe
        // 'posts_per_page' => -1, -1 meaning the WP will give all the posts
        // order -> DESC - post will be descending 
        // order -> ASC - post will be Ascending 

        // meta_query - array-> 
        //  ^key - the ACF
        //  ^compare - the condition
        //  ^value  - here is date $today

        $relatedProfessor = new WP_Query(array(
            'posts_per_page'   => -1,
            'post_type'        => 'professor',
            'orderby'          => 'title',
            'order'            => 'ASC',
            'meta_query' => array(
                array(
                    'key'      => 'related_programs',
                    'compare'  => 'LIKE',
                    'value'    =>  '"'. get_the_ID() .'"'
                )
            )

        ));

    /* IF CONDITION */
    /* para hindi mag appear ung UPCOMING EVENTS na title tag
    tapos sa loob nun ung content na relation nun sa event?? gets moba ? ano kaya pa?
    */

    if( $relatedProfessor->have_posts()) { 


        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium" >' . get_the_title() . ' Professor </h2>';

echo '<ul class="professor-cards">';
        while( $relatedProfessor->have_posts()){
            $relatedProfessor->the_post(); 

    ?>
    <li class="professor-card__list-item">
        <a class="professor-card" href="<?php the_permalink() ?>">
        <img src="<?php the_post_thumbnail_url('professorLandscape'); ?>" alt="" class="professor-card__image">
        <span class="professor-card__name"><?php the_title(); ?></span>
        </a>
    </li>




    <?php }
    echo '</ul>' 
    ?>
    <!--related Professor-->

    <?php }  
    wp_reset_postdata();

    ?>
    <!--Event post type Loop-->


    <?php


    //post_per_page - kung ilan lilitaw dun sa fron-end
    //post_type - kung anong post type
    // orderby - post_date - the date that the post was created or published
    // ^       - value [post_date] is the default value
    //^ value [title] - will be alphabetically
    //^ orderby->rand - post will be random
    //^ orderby->meta_value_num - it need the meta_key 1st - then the value means that the orderby will be base on any value of Post Type.
    // meta_key-event_date - the ACF variabe
    // 'posts_per_page' => -1, -1 meaning the WP will give all the posts
    // order -> DESC - post will be descending 
    // order -> ASC - post will be Ascending 

    // meta_query - array-> 
    //  ^key - the ACF
    //  ^compare - the condition
    //  ^value  - here is date $today
    $today = date('Ymd');
    $eventPostType = new WP_Query(array(
        'posts_per_page'   => 2,
        'post_type'        => 'event',
        'meta_key'         => 'event_date',
        'orderby'          => 'meta_value_num',
        'order'            => 'ASC',
        'meta_query' => array(
            array(
                'key'      => 'event_date',
                'compare'  => '>=',
                'value'    =>   $today,
                'type'     => 'numeric'
            ),
            array(
                'key'      => 'related_programs',
                'compare'  => 'LIKE',
                'value'    =>  '"'. get_the_ID()  .'"'
            )
        )

    ));

    /* IF CONDITION */
    /* para hindi mag appear ung UPCOMING EVENTS na title tag
    tapos sa loob nun ung content na relation nun sa event?? gets moba ? ano kaya pa?
    */

    if($eventPostType->have_posts()) { 


        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium" > Upcoming ' . get_the_title() . ' Events </h2>';
        while($eventPostType->have_posts()){
            $eventPostType->the_post(); 

            //     echo get_fields('event_date') . 'asddasd <br>';
            //     echo get_field_object('event_date') . 'asddasd <br>';
            //     echo get_sub_field('event_date') . 'asddasd<br> ';
            //     echo get_post_field('event_date') . 'asddasd<br> ';
    ?>
    <div class="event-summary">
        <a class="event-summary__date t-center" href="<?php the_permalink() ?>">
            <span class=" event-summary__month"><?php 
        $eventDate = new DateTime( get_post_field('event_date')) ;
            echo $eventDate->format('M');

                ?></span>
            <span class="event-summary__day"><?php echo $eventDate->format('d') ?></span>
        </a>
        <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
            <p><?php if( has_excerpt() ) {
                    echo get_the_excerpt();          
                } else {
                    echo wp_trim_words(get_the_content(), 18 );
                } ?> <a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
        </div>
    </div>
    <?php } ?>



</div>
<?php }  ?>
<!--Event post type Loop-->


<?php } /*php end loop */  ?>




<?php 

get_footer();
?>