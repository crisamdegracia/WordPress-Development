
       
<!--
The form for search that we can call by
get_search_form      
-->
       
        <form class="search-form" method="get" action="<?php echo esc_url( site_url('/') )?>">
            <label class="headline headline--medium" for="s">Perform a new search input</label>
            <div class="search-form-row">

                <input placeholder="What are you looking for?" class="s" id="s" type="search" name="s">
                <input class="search-submit" type="submit" value="Search">
            </div>
        </form>
   