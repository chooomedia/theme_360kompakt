<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */
/* 
THREEK ==  360Kompakt
*/
define( 'THREEK_THEME_URL', get_stylesheet_directory_uri() );
define( 'THREEK_THEME_PATH', get_stylesheet_directory() );
define( 'THREEK_VERSION', '1.0.0' );

function threek_enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'threek-style', THREEK_THEME_URL . '/build/main.css', ['parent-style'], filemtime( THREEK_THEME_PATH . '/build/main.css' ) );
    wp_enqueue_script( 'threek-slider', THREEK_THEME_URL . '/build/slider.js', [], filemtime( THREEK_THEME_PATH . '/build/slider.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'threek_enqueue_child_theme_styles' );

function backend_assets() {
	wp_enqueue_script( 
        'threek-be-js', 
        THREEK_THEME_URL . '/build/backend.js', 
        ['wp-block-editor', 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-api', 'wp-polyfill'], 
        filemtime( THREEK_THEME_PATH . '/build/backend.js' ), 
        true 
    );
}
add_action('admin_enqueue_scripts', 'backend_assets');

add_image_size( 'widget-slider-770', 770, 450, true );
add_image_size( 'widget-slider-450', 450, 263, true );

function add_custom_sizes_to_gutenberg( $sizes ) {
  return array_merge( $sizes, [
    'widget-slider-770' => __('Slider 770', 'threek'),
    'widget-slider-450' => __('Slider 450', 'threek'),
  ] );
}
add_filter( 'image_size_names_choose', 'add_custom_sizes_to_gutenberg' );


// includes
require_once __DIR__ . '/classes/CheckedBy.php';
add_action( 'init', function() {
    new \Threek\CheckedBy;
} );


// Shortcode to display the Site Name
add_shortcode( 'site_name','site_name_shortcode' );
function site_name_shortcode()
{
    return get_bloginfo($show = 'name');
}


// Change 404 Page Title
add_filter( 'generate_404_title','generate_custom_404_title' );
function generate_custom_404_title()
{
      return '<center>Nichts gefunden</center>';
}


// Change 404 Page Text
add_filter( 'generate_404_text','generate_custom_404_text' );
function generate_custom_404_text()
{
      return '<center>Haben Sie sich verirrt? Nutzen Sie unsere Suche oder klicken Sie auf einen unserer neuesten Beiträge.</center>';
}


// Change 404 Page Search Form
function wpdocs_my_search_form( $form ) {
	$form = '<form role="search" method="get" action="https://360kompakt.10.41.41.70.nip.io/" class="wp-block-search__button-inside wp-block-search__text-button wp-block-search"><label for="wp-block-search__input-1" class="wp-block-search__label screen-reader-text">Suchen</label><div class="wp-block-search__inside-wrapper " ><input type="search" id="wp-block-search__input-1" class="wp-block-search__input wp-block-search__input " name="s" value="" placeholder="Suchen..."  required /><button type="submit" class="wp-block-search__button wp-element-button">Suchen</button></div></form>';

	return $form;
}
add_filter( 'get_search_form', 'wpdocs_my_search_form' );


// Author Box
function show_author_box(){ 

    global $post;  
    $author_id = get_post_field('post_author' , $post->ID); 
    
    ?>
    <div class="author-box">
            <div class="author-box-avatar">
                <img src=<?php echo get_avatar_url($author_id); ?>/>
            </div>
            <div class="author-box-meta">
                <div class="author-box_name"><?php echo '<span>'. get_the_author() . '</span>'; ?></div>
                <div class="author-box_bio">
                    <?php echo get_the_author_meta("description", $author_id); ?>
                </div>
            </div>
    <?php 
}
add_action('generate_after_content', 'show_author_box');


/* Get Categorys of Post
Output (string): "Cat1, Cat2"
*/
add_shortcode( 'categorys','show_all_categorys_of_post' );
function show_all_categorys_of_post(){
    $post_categories = wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) );
    $names = '';
	if( $post_categories ){
		foreach($post_categories as $key => $name){
            // Check if is not last loop
            if ($key !== array_key_last($post_categories)) {
                $space = ', ';
            }else{
                $space = '';
            }
        
			$names .= $name . $space;
		}
    } 

    echo '<span class="category-list">'. $names .'</span>';
}


// 3 featured posts on home page
function show_featured_posts(){ 
    if ( is_front_page() && is_home() ) {

        $args = array(
            'cat'      => '224',
            'posts_per_page' => '3'
        );
        
        $featuredPosts = new WP_Query($args);

        ?> <section class="featured-posts"> <?php

        if($featuredPosts->have_posts()){
        while ($featuredPosts->have_posts()) : $featuredPosts->the_post();
        ?>
        <!-- Loop Content ############################################## -->
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_do_microdata( 'article' ); ?>>
	    <div class="inside-article">
		<?php

		if ( generate_show_entry_header() ) : ?>

		<div class="archive-single-featured-image">
        <?php
            do_action( 'generate_after_entry_header' ); ?>
        </div>
        <div class="archive-single-content">
			<header <?php generate_do_attr( 'entry-header' ); ?>>
            <?php
    
			do_shortcode('[categorys]');

				if ( generate_show_title() ) {
					$params = generate_get_the_title_parameters();

					the_title( $params['before'], $params['after'] );
				}
                
                ?>
                <div class="author-info">
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

		if ( generate_show_excerpt() ) :
			?>

			<div class="entry-summary">
				<?php the_excerpt() ?>
			</div>

		<?php else : ?>

			<div class="entry-content">
				<?php
				the_content();
				?>
			</div>
        </div>
			<?php
		endif;

		?>
        <div class="read-more"><a href="<?php the_permalink(); ?>">Weiterlesen ></a></div>
	</div>
</article>

        <!-- Loop Content - End ############################################### -->
        <?php
        endwhile;
        }

        ?> </section> <?php
    }
    
}
add_action('generate_after_header', 'show_featured_posts');


add_action( 'generate_before_main_content', function() {
	if ( is_front_page() && is_home() ) {
	?>
	<div class="home-headline">
		<div class="wp-block-group__inner-container">
			<h2><?php _e('Aktuelle Beiträge', 'threek'); ?></h2>
		</div>
	</div>
	<?php
	}
} );