<?php
/* GET post title show in <a> element attributes- */ 
$post_title = get_the_title();
        ?>
        <article>
        <?php

            /* FEATURED IMAGE */
            ?><a href="<?php the_permalink(); ?>" title="<?php echo $post_title ?>"><?php the_post_thumbnail(); ?></a><?php
            /* FEATURED IMAGE END */

            ?><div class="inside-article"><?php

            /* POST categories */
            echo show_all_categories_of_post();
	
            /* POST categories END */

                /* POST TITLE */
                echo '<a class="loop-title" href="' . get_the_permalink() . '" title="' . $post_title . '">' . get_the_title() . '</a>';
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

                    <div class="read-more"><a href="<?php the_permalink(); ?>" title="Weiterlesen - <?php echo $post_title ?>"><?php _e('Weiterlesen >', 'kompakt'); ?></a></div>
                <?php 
                }

        ?>
        </div>
        </article>
        <?php
                