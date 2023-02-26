<?php 

        ?>
        <article>
        <?php

            /* FEATURED IMAGE */
            ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a><?php
            /* FEATURED IMAGE END */

            ?><div class="inside-article"><?php

            /* POST categories */
			do_shortcode('[categories]');
            /* POST categories END */

                /* POST TITLE */
                echo '<a class="loop-title" href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
                /* POST TITLE END */
                ?>
                <?php get_template_part('template-parts/author-info', null,["link"=> true]);?>


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
                