<?php 
get_header();

/* Without the value of [title] [sub-title] e walang value ung sa hero title. */

pageBanner(array(
    'title' => 'Welcome to our blog!',
    'sub-title'  => 'Keep up with our latest news.'

))
?>

<!-- THE BLOG PAGE -->




<div class="container container--narrow page-section">

    <?php
    while( have_posts()  ) {
        the_post(); ?>
    <div class="post-item">
        <h2 class="headline headline--medium headline--post-title"><a href=" <?php the_permalink() ?>" > <?php the_title(); ?> </a> </h2>

        <div class="metabox">
            <p>Posted by: <?php the_author_posts_link(); ?> on <?php the_date(); ?> in <?php echo get_the_category_list(', ');?> </p>
        </div>
        <div class="generic-content">
            <?php the_excerpt(); ?>
            <p><a class="btn btn--blue" href="<?php the_permalink() ?>"> Continue reading &raquo; </a></p>
        </div>
    </div>
    <?php
    }
    ?>
    
    
    <?php echo paginate_links() ?>

</div>    











<?php 
get_footer();
?>