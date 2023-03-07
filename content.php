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
        echo  show_all_categories_of_post();
		
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
				  <?php get_template_part('template-parts/author-info');?>
				
				
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
				<?php the_excerpt() ?>
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
		//do_action( 'generate_after_content' );
		
		?>
        <div class="read-more"><a href="<?php the_permalink(); ?>"><?php _e("Weiterlesen >", "kompakt") ?></a></div>
	</div>
</article>
