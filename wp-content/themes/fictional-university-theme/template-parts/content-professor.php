
     <!--
this template part will be use in getting get_post_type()      

for the result page 
-->

    <div class="post-item">

    <li class="professor-card__list-item">
        <a class="professor-card" href="<?php the_permalink() ?>">
            <img src="<?php the_post_thumbnail_url('professorLandscape'); ?>" alt="" class="professor-card__image">
            <span class="professor-card__name"><?php the_title(); ?></span>
        </a>
    </li>
</div>
