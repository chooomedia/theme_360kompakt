<?php
/**
 * The template for displaying posts within the loop.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_do_microdata( 'article' ); ?>>
	<div class="inside-article">
		<?php
		/**
		 * generate_before_content hook.
		 *
		 * @since 0.1
		 *
		 * @hooked generate_featured_page_header_inside_single - 10
		 */
		do_action( 'generate_before_content' );

		if ( generate_show_entry_header() ) : ?>

		<div class="archive-single-featured-image">
            <?php
                /**
             * generate_after_entry_header hook.
             *
             * @since 0.1
             *
             * @hooked generate_post_image - 10
             */
            do_action( 'generate_after_entry_header' ); ?>
        </div>
        <div class="archive-single-content">
			<header <?php generate_do_attr( 'entry-header' ); ?>>
            <?php
            $category = get_the_category(); echo '<span class="archive-single-category">'.$category[0]->cat_name.'</span>';
            ?>
				<?php
				/**
				 * generate_before_entry_title hook.
				 *
				 * @since 0.1
				 */
				do_action( 'generate_before_entry_title' );

				if ( generate_show_title() ) {
					$params = generate_get_the_title_parameters();

					the_title( $params['before'], $params['after'] );
				}
                
                ?>
                <div class="archive-single-author-info">
                    <?php
                    global $post;  
                    $author_id = get_post_field('post_author' , $post->ID); 
					if(!is_archive()) {$linkToAuthor = '&nbsp;<a href="'.get_author_posts_url($author_id).'">';}
                    echo '<img src="'.get_avatar_url($author_id).'"/> Von '. $linkToAuthor . get_author_name($author_id).'</a>';
                    ?>
                </div>
			</header>
			<?php
		endif;

		

		$itemprop = '';

		if ( 'microdata' === generate_get_schema_type() ) {
			$itemprop = ' itemprop="text"';
		}

		if ( generate_show_excerpt() ) :
			?>

			<div class="entry-summary"<?php echo $itemprop; // phpcs:ignore -- No escaping needed. ?>>
				<?php the_excerpt(); ?>
			</div>

		<?php else : ?>

			<div class="entry-content"<?php echo $itemprop; // phpcs:ignore -- No escaping needed. ?>>
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'generatepress' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
        </div>
			<?php
		endif;


		/**
		 * generate_after_content hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_after_content' );
		?>
        <div class="read-more"><a href="<?php the_permalink(); ?>">Weiterlesen ></a></div>
	</div>
</article>