<?php
/**
 * The template for displaying Archive pages.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div <?php generate_do_attr( 'content' ); ?>>
		<main <?php generate_do_attr( 'main' ); ?>>

			<?php
			/**
			 * generate_before_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_before_main_content' );

			// Author Page Header
		
			if(is_author()){

             //  global $post;  
                $author_id = get_post_field('post_author' , $post->ID); 
                ?>
            
                <section class="author_bio_section">
                    <span class="author-title">
                        <h1><?php echo '<span>'. get_the_author() . '</span>'; ?></h1>
                    </span>
                    <div class="author-avatar">
                        <img alt=<?php _e("Autorenfoto", "KOMPAKT"); ?> title=<?php _e("Autorenfoto", "KOMPAKT"); ?> src="<?php echo get_avatar_url($author_id); ?>"tes/>
                    </div>
                    <div class="author-info">
                        <?php echo get_the_author_meta("description", $author_id); ?>
                    </div>
            </section>
                <?php
			}

			// Author Page Header - END
		

			if ( generate_has_default_loop() ) {
				if ( have_posts() ) :

					/**
					 * generate_archive_title hook.
					 *
					 * @since 0.1
					 *
					 * @hooked generate_archive_title - 10
					 */
                    
                    // Disable Archive Title for Authors Page 
					if(!is_author()){
						do_action( 'generate_archive_title' );
					}
					

					/**
					 * generate_before_loop hook.
					 *
					 * @since 3.1.0
					 */
					do_action( 'generate_before_loop', 'archive' );

					while ( have_posts() ) :

						the_post();

						generate_do_template_part( 'archive' );

					endwhile;

					/**
					 * generate_after_loop hook.
					 *
					 * @since 2.3
					 */
					do_action( 'generate_after_loop', 'archive' );

				else :

					generate_do_template_part( 'none' );

				endif;
			}

			/**
			 * generate_after_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_after_main_content' );
			?>
		</main>
	</div>

	<?php
	/**
	 * generate_after_primary_content_area hook.
	 *
	 * @since 2.0
	 */
	do_action( 'generate_after_primary_content_area' );

	generate_construct_sidebars();

	get_footer();
