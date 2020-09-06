<?php 

get_header();

?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php bloginfo()  ?>images/library-hero.jpg);"></div>
    <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">Welcome! GAMERS woop!!asd  </h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
        <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
        <a href="<?php echo get_post_type_archive_link('program') ?>" class="btn btn--large btn--blue">Find Your Major</a>
    </div>
</div>
<div class="full-width-split group">
    <div class="full-width-split__one">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>

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
                 )
             )

         ));


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
            <?php
         }


            ?>



            <p class="t-center no-margin"><a href="<?php  echo get_post_type_archive_link('event')  ?>" class="btn btn--blue">View All Events</a></p>
        </div>
    </div>
    <div class="full-width-split__two">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>




            <?php
    $homepagePosts = new WP_Query(array(
        'posts_per_page' => 2
    ));

                                             while( $homepagePosts->have_posts()  ){
                                                 $homepagePosts->the_post();
            ?>
            <div class="event-summary">
                <a class="event-summary__date event-summary__date--beige t-center" href="#">
                    <span class="event-summary__month"><?php the_time('M'); ?></span>
                    <span class="event-summary__day"><?php the_time('d'); ?></span>
                </a>
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
                    <p><?php if( has_excerpt() ) {
                echo get_the_excerpt();          
            } else {
                echo wp_trim_words(get_the_content(), 18 );
            }
                        ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
                </div>
            </div>
            <?php } wp_reset_postdata(); ?>

            <p class="t-center no-margin"><a href="<?php echo site_url('/blog') ?>" class="btn btn--yellow">View All Blog Posts</a></p>
        </div>
    </div>
</div>

<div class="hero-slider">
    <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
            <div class="hero-slider__slide" style="background-image: url(<?php bloginfo('template_directory')   ?>/images/bus.jpg);">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Transportation</h2>
                        <p class="t-center">All students have free unlimited bus fare.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide" style="background-image: url(<?php  echo get_theme_file_uri() ?>/images/apples.jpg);">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">An Apple a Day</h2>
                        <p class="t-center">Our dentistry program recommends eating apples.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri() ?>/images/bread.jpg);">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Food</h2>
                        <p class="t-center">Fictional University offers lunch plans for those in need.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
</div>










<?php 

    get_footer();
?>