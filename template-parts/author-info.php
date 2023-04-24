 <?php

    $link = !is_archive();
    $args = wp_parse_args(
        $args,
        array(
            'link' => $link
        )
    );
    $link = $args['link'];
    $author_id = get_post_field('post_author', $post->ID);
    $author_name = get_the_author_meta('display_name', $author_id);
    ?>
 <div class="author-info">
     



         <img alt="<?php echo sprintf(__('Autorenfoto von %s', 'kompakt'), $author_name) ?>" title="<?php echo sprintf(__('Autorenfoto von %s', 'kompakt'), $author_name) ?>" src="<?php echo get_avatar_url($author_id) ?>" />
        <span>
            <?php echo __('Von ', 'kompakt');?>

            <?php if (is_home() || is_archive()) {
                    echo $author_name;
                } else {
                    echo '<a title="' . sprintf(__('Autorenprofil von %s', 'kompakt'), $author_name) . '" href="' . get_author_posts_url($author_id) . '">' . $author_name . '</a>'; // Zeige den Autor-Namen als Link an
                }
            ?>
        </span>
         
         <?php echo $author_name;
         } ?>
 </div>
