<?php 
get_header();
pageBanner(array(
    'title' => 'All Campuses',
    'sub-title' => 'We have several conveniently located campuses.'

))
?>



<div class="container container--narrow page-section">  
    <?php    get_template_part('template-parts/content-campus'); ?>
</div>    











<?php 
get_footer();
?>