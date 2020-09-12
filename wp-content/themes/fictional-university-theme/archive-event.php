<?php 
get_header();
pageBanner( array( 
    'title'      => 'All Events',
    'sub-title'  =>  'See what is going on in our world.'

));
?>





<div class="container container--narrow page-section">

    <?php
    //    $today = date('Ymd');
    //         $eventKo = new WP_Query( array(
    //             'post_type' => 'event',
    //             'meta_key' => 'event_date',
    //             'orderby'   => 'meta_value_num',
    //             'order'     => 'ASC',
    //             'meta_query' => array( 
    //                 array(
    //                     'key' => 'event_date',
    //                     'compare' => '>=',
    //                     'value' => $today,
    //                     'type'     => 'numeric'
    //                 )
    //             )
    //
    //         ));

    while(have_posts()  ){
        the_post(); 
        get_template_part('template-parts/content-event');
    ?>


    <?php
    }
    ?>


    <?php echo paginate_links() ?>

    <hr class="section-break">
    <p> Looking for our past events? <a href="<?php echo site_url('/past-events') ?>">checkout our past events archives.</a> </p>
</div>    











<?php 
    get_footer();
?>