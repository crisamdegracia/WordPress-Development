<?php 

/*If hindi naka logged in ang user it will be redirected

exit - meaning that after redirect - it needs to rest to save server resources
*/

if(!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));

    exit;

}





get_header();
while (have_posts()){
    the_post();

    pageBanner( array() );
?>

<div class="container container--narrow page-section">
    
    <div class="create-note">
        <h2 class="headline headline--medium">Create New Note</h2>
        
        <input class="new-note-title" type="text" placeholder="title">
        
        <textarea class="new-note-body" name="" id="" cols="30" rows="10" placeholder="Your note here..."></textarea>
        <span class="submit-note">Create note</span>
    </div>
    
    <ul class="min-list link-list" id="my-notes">
        <?php 

    /*
   author = get_current_user_id()  - only gives us post that is created by logged in user 
    */
    $userNotes = new WP_Query(array(
        'post_type'             => 'note',
        'post_per_page'      => -1,
        'author'             => get_current_user_id()

    ));


    while($userNotes->have_posts()){
        $userNotes->the_post(); ?>
        <li data-id="<?php the_ID(); ?>">
            <!--
In wordpress whenever we see database as a value we use esc_attr()
-->
            <input readonly class="note-title-field" value="<?php echo esc_attr(get_the_title()); ?>">
            <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>
            <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
            <textarea readonly class="note-body-field" name="" id="" cols="100" rows="10"> <?php echo esc_attr(get_the_content()); ?></textarea>

            <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right -o" aria-hidden="true"></i> Save </span>
            <span id="alert" class="alert-hidden">Edit Succesful!</span>
        </li>


        <?php   } /*while loop end*/     ?>
    </ul>

</div>

<?php 

}
get_footer();
?>