

<!--

//     echo get_fields('event_date') . 'asddasd <br>';
//     echo get_field_object('event_date') . 'asddasd <br>';
//     echo get_sub_field('event_date') . 'asddasd<br> ';
//     echo get_post_field('event_date') . 'asddasd<br> ';
-->

<div class="event-summary">
    <a class="event-summary__date t-center" href="<?php the_permalink() ?>">
        <span class="event-summary__month">

            <!--
dito we create a date base on the  ACF we created. 
then look for the format. Month
-->
            <?php 
    $eventDate = new DateTime( get_post_field('event_date') ) ;
       echo $eventDate->format('M');
            ?>
        </span>
        <!-- looking for a DAY -->
        <span class="event-summary__day">
            <?php echo $eventDate->format('d') ?>
        </span>
    </a>
    <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny">
            <a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
        <p>
            <?php if( has_excerpt() ) {
    echo get_the_excerpt();          
} else {
    echo wp_trim_words(get_the_content(), 18 );
} ?> 
            <a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
    </div>
</div>