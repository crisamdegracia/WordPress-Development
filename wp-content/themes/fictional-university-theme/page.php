<?php 

get_header();
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

    <?php

    $parentPageID  = wp_get_post_parent_id( get_the_ID() );


         if (  $parentPageID  ) { ?>

    <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_the_permalink( $parentPageID) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title( $parentPageID ) ?></a> <span class="metabox__main"><?php the_title() ?></span></p>

    </div>


    <?php
                                }
    ?>


    <?php 

    $testArray = get_pages(array(
        'child_of'  => get_the_ID()
    ));

    if( $parentPageID or $testArray ) { ?>

    <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_the_permalink( $parentPageID ) ?>"><?php echo get_the_title($parentPageID) ?></a></h2>
        <ul class="min-list">

            <?php 

        if( $parentPageID ){
            $findChildrenOf = $parentPageID;
        } else {
            $findChildrenOf = get_the_ID();
        }

                                       wp_list_pages( array(
                                           //title_li is empty 
                                           //child_of - numerical ID of a certain page or post
                                           //sort_column => 'menu_order' we can choose the order output of link -
                                           // ^ you can control this on right panel and choose the order number
                                           'title_li' => NULL,
                                           'child_of' => $findChildrenOf,
                                           'sort_column' => 'menu_order'


                                       ))   ?>

        </ul>
    </div>
    <?php } ?>

    <div class="generic-content">
        <p><?php the_content(); ?></p>
    </div>

</div>


<?php
while (have_posts()){
    the_post();
?>
<?php the_title() ?>

<?php the_content() ?> 
<?php 
}
?>





<?php 

get_footer();
?>