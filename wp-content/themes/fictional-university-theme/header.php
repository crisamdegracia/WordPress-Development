<!DOCTYPE html>
<html <?php language_attributes(); ?> >
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="<?php bloginfo('charset'); ?>" >
        <?php wp_head() ?>
        <meta charset="UTF-8">
        <title>Fictional university</title>
    </head>
    <body <?php body_class(); ?> >
        <header class="site-header">
            <div class="container">
                <h1 class="school-logo-text float-left">
                    <a href="<?php echo site_url()  ?>"><strong>Fictional</strong> University</a>
                </h1>
                <a href="<?php echo esc_url(site_url('/search')) ?>" class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
                <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
                <div class="site-header__menu group">
                    <nav class="main-navigation">
                        <ul>
                            <li <?php if( is_page('about-us') or wp_get_post_parent_id(0) == 10) echo 'class="current-menu-item"' ?> >
                                <a href="<?php echo site_url('/about-us')  ?>">About Us</a>
                            </li>

                            <li >
                                <a href="<?php echo get_post_type_archive_link('program') ?>">Programs</a>
                            </li>
                            <li <?php if( get_post_type() == 'event' OR is_page('past-events')) echo 'class="current-menu-item" '; ?> >
                                <a href="<?php echo get_post_type_archive_link('event') ?>">Events</a>
                            </li>
                            <li <?php if(get_post_type() == 'campus') echo 'class="current-menu-item"'; ?> >
                                <a href="<?php echo get_post_type_archive_link('campus'); ?>">Campuses</a>
                            </li>
                            <li <?php if(  get_post_type() == 'post' ) echo 'class="current-menu-item" '?> >  
                                <a href="<?php echo site_url('/blog') ?>">Blog</a>
                            </li>

                            <?php
    //                wp_nav_menu(array(
    //                'theme_location' => 'headerMenuLocation'
    //                
    //                
    //                ));

                            ?>
                        </ul>
                    </nav>
                    
                    <!--
                    
                    is user_user_logged_in() - checks the user if logged in
                    get_avatar(get_current_user_id(), 30)  - 1st arg the Id, 2nd size
                    wp_login_url() - login url
                    wp_registration() - register
                    wp_logout_url() - logout
                    -->
                    
                    <div class="site-header__util">
                        
                        <?php if( is_user_logged_in() ) { ?>
                               <a href="<?php echo wp_logout_url() ; ?>" class="btn btn--small btn--orange float-left push-right btn--with-photo">
                                   <span class="site-header__avatar"> <?php echo get_avatar(get_current_user_id(), 30); ?> </span>
                                   <span class="btn__text">Logout</span>
                               </a>  
                        <?php  } else { ?>
                        <a href="<?php echo wp_login_url() ; ?>" class="btn btn--small btn--orange float-left push-right">Login</a>
                        <a href="<?php echo wp_registration_url(); ?>" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
                                
                        <?php  } ?>
                        <a href="<?php echo esc_url(site_url('/search')) ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </header>

