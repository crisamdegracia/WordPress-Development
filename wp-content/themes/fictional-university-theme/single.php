<?php 


get_header();

while (have_posts()){
    the_post();
?>
<?php the_title() ?>

<?php the_content() ?>
<?php 
}

?>


single





<?php 

get_footer();
?>