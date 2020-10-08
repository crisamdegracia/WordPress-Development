
        <!--
this template part will be use in getting get_post_type()    

  for the result page  
-->

         <div class="post-item">
        <h2 class="headline headline--medium headline--post-title"><a href=" <?php the_permalink() ?>" > <?php the_title(); ?> </a> </h2>

       
        <div class="generic-content">
            <?php the_excerpt(); ?>
            <p><a class="btn btn--blue" href="<?php the_permalink() ?>"> view program &raquo; </a></p>
        </div>
    </div>