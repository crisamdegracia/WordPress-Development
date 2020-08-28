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

    <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="#"><i class="fa fa-home" aria-hidden="true"></i> Back to About Us</a> <span class="metabox__main">Our History</span></p>
    </div>

<!--
    <div class="page-links">
        <h2 class="page-links__title"><a href="#">About Us</a></h2>
        <ul class="min-list">
            <li class="current_page_item"><a href="#">Our History</a></li>
            <li><a href="#">Our Goals</a></li>
        </ul>
    </div>
-->

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