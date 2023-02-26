<?php 

        ?>
        <article>
        <?php

            /* FEATURED IMAGE */
            ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a><?php
            /* FEATURED IMAGE END */

            ?><div class="inside-article"><?php

            /* POST CATEGORYS */
			do_shortcode('[categorys]');
            /* POST CATEGORYS END */

                /* POST TITLE */
                echo '<a class="loop-title" href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
                /* POST TITLE END */
                ?>

                <!-- AUTHOR INFO -->
                <div class="author-info">
                    <?php
                    global $post;  
                    $author_id = get_post_field('post_author' , $post->ID); 
					if(!is_archive()) {$linkToAuthor = '&nbsp;<a href="'.get_author_posts_url($author_id).'">';}
                    echo '<img alt="' . __("Autorenfoto", "gpct") . '" title="' . __("Autorenfoto", "gpct") . '" src="'.get_avatar_url($author_id).'"/> ' . __("Von ", "gpct") . $linkToAuthor . get_author_name($author_id).'</a>';
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

                    <div class="read-more"><a href="<?php the_permalink(); ?>"><?php _e('Weiterlesen >', 'gpct'); ?></a></div>
                <?php 
                }

        ?>
        </div>
        </article>
        <?php
                