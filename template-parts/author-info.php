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
     <?php if ($link) {

        ?>

         <img alt="<?php echo sprintf(__('Autorenfoto von %s', 'kompakt'), $author_name) ?>" title="<?php echo sprintf(__('Autorenfoto von %s', 'kompakt'), $author_name) ?>" src="<?php echo get_avatar_url($author_id) ?>" />
         
         <?php echo __('Von ', 'kompakt');?>
         
         <a title="<?php echo sprintf(__('Autorenprofil von %s', 'kompakt'), $author_name) ?>" href="<?php echo get_author_posts_url($author_id) ?> ">
         <?php  } ?>
         
         <?php echo $author_name ?>

         <?php if ($link) {
                echo '</a>';
            }
            ?>
 </div>