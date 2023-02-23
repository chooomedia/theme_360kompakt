<?php 

        $args = array(
            'cat'      => '224',
            'posts_per_page' => '3'
        );
        
        $featuredPosts = new WP_Query($args);

        ?> 
        <article> 
        <?php

        if($featuredPosts->have_posts()){

            while ($featuredPosts->have_posts()) : $featuredPosts->the_post();

            /* FEATURED IMAGE */
            the_post_thumbnail();
            /* FEATURED IMAGE END */

            /* POST CATEGORYS */
			do_shortcode('[categorys]');
            /* POST CATEGORYS END */

                /* POST TITLE */
				if ( generate_show_title() ) {
					$params = generate_get_the_title_parameters();
					the_title( $params['before'], $params['after'] );
				}
                /* POST TITLE END */
                ?>

                <!-- AUTHOR INFO -->
                <div class="author-info">
                    <?php
                    global $post;  
                    $author_id = get_post_field('post_author' , $post->ID); 
					if(!is_archive()) {$linkToAuthor = '&nbsp;<a href="'.get_author_posts_url($author_id).'">';}
                    echo '<img alt="' . __("Autorenfoto", "threek") . '" title="' . __("Autorenfoto", "threek") . '" src="'.get_avatar_url($author_id).'"/> ' . __("Von ", "threek") . $linkToAuthor . get_author_name($author_id).'</a>';
                    ?>
                </div>
                <!-- AUTHOR INFO END -->

                <?php

                /* EXPCERPT */
                if ( generate_show_excerpt() ){
                ?>
                    <!-- EXCERPT -->
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>
                    <!-- EXCERPT END -->

                    <div class="read-more"><a href="<?php the_permalink(); ?>"><?php _e('Weiterlesen >', 'threek'); ?></a></div>
                <?php 
                }
                
            endwhile;
            
        }
        ?> </article> <?php