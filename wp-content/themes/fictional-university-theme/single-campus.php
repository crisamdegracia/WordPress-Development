<?php 


get_header();

while (have_posts()){
    the_post();
    pageBanner();
?>



<div class="container container--narrow page-section">


    <?php the_content() ?>
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Campus </a> <span class="metabox__main"><?php the_title() ?> </span></p>

    </div>
    <div class="generic-content"><?php the_content() ?></div>

        <?php
        $mapLocation = get_field('map_location'); ?>
    <div class="acf-map">


        <div class="marker" data-lat='<?php echo $mapLocation['lat'] ?>' data-lng='<?php echo $mapLocation['lng'] ?>' >

            <h3><?php the_title(); ?></h3>
            <?php echo  $mapLocation['address']; ?>
        </div>

    </div>


    <?php
    //post_per_page - kung ilan lilitaw dun sa fron-end
    // 'posts_per_page' => -1, -1 meaning the WP will give all the 
    //post_type - kung anong post type
    // orderby - post_date - the date that the post was created or published
    // ^       - value [post_date] is the default value
    //^ value [title] - will be alphabetically
    //^ orderby->rand - post will be random
    //^ orderby->meta_value_num - it need the meta_key 1st - then the value means that the orderby will be base on any value of Post Type.
    // meta_key-event_date - the ACF variabe posts
    // order -> DESC - post will be descending 
    // order -> ASC - post will be Ascending 
    
    // meta_query is parang filter 
    // so its looking for a KEY - which is the POST TYPE
    // meta_query - array-> 
    //  ^key - the ACF
    //  ^compare - the condition
    //  ^value  - here is date $today
    
    // to sum up on meta_query = 
    // ^ the post type program is looking for a 
    // meta_query that has a KEY 'related_campus'
    // that LIKE - means exactly
    // thas has a VALUE of the current campus that we are viewing
    // 

    // we are creating this new query to give us any program post
    //  that has relation on related_campuse post type
    $relatedPrograms = new WP_Query(array(
        'posts_per_page'   => -1,
        'post_type'        => 'program',
        'orderby'          => 'title',
        'order'            => 'ASC',
        'meta_query' => array(
            array(
                'key'      => 'related_campuses',
                'compare'  => 'LIKE',
                'value'    =>  '"'. get_the_ID() .'"'
            )
        )

    ));

    /* IF CONDITION */
    /* para hindi mag appear ung UPCOMING EVENTS na title tag
    tapos sa loob nun ung content na relation nun sa event?? gets moba ? ano kaya pa?
    */
    if(  $relatedPrograms->have_posts() ) { 

        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium" > Programs Available At This Campus </h2>';

        echo '<ul class="min-list link-list">';
        while( $relatedPrograms->have_posts() ){
            $relatedPrograms->the_post(); 

    ?>
    <li class="">
        <a class="" href="<?php the_permalink() ?>">
          <?php the_title(); ?>
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


            get_template_part('template-parts/content', 'event');
        } ?>



</div>
<?php }  ?>
<!--Event post type Loop-->


<?php } /*php end loop */  ?>




<?php 

get_footer();
?>