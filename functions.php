<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */
/* 

KOMPAKT ==  360Kompakt

*/

define( 'KOMPAKT_THEME_URL', get_stylesheet_directory_uri() );
define( 'KOMPAKT_THEME_PATH', get_stylesheet_directory() );
define( 'KOMPAKT_VERSION', '1.0.0' );

function kompakt_enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'kompakt-style', KOMPAKT_THEME_URL . '/build/main.css', ['parent-style'], filemtime( KOMPAKT_THEME_PATH . '/build/main.css' ) );
    wp_enqueue_script( 'kompakt-slider', KOMPAKT_THEME_URL . '/build/slider.js', [], filemtime( KOMPAKT_THEME_PATH . '/build/slider.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'kompakt_enqueue_child_theme_styles' );

function backend_assets() {
	wp_enqueue_script( 
        'kompakt-be-js', 
        KOMPAKT_THEME_URL . '/build/backend.js', 

        ['wp-block-editor', 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-api', 'wp-polyfill','media-upload', 'thickbox'], 

        filemtime( KOMPAKT_THEME_PATH . '/build/backend.js' ), 
        true 
    );
}
add_action('admin_enqueue_scripts', 'backend_assets');

add_image_size( 'widget-slider-770', 770, 450, true );
add_image_size( 'widget-slider-450', 450, 263, true );

function add_custom_sizes_to_gutenberg( $sizes ) {
  return array_merge( $sizes, [
    'widget-slider-770' => __('Slider 770', 'kompakt'),
    'widget-slider-450' => __('Slider 450', 'kompakt'),
  ] );
}
add_filter( 'image_size_names_choose', 'add_custom_sizes_to_gutenberg' );


// includes
require_once KOMPAKT_THEME_PATH . '/classes/CheckedBy.php';
add_action( 'init', function() {
    new \Threek\CheckedBy;
} );

require_once KOMPAKT_THEME_PATH . '/shortcodes.php';


// Change 404 Page Title
add_filter( 'generate_404_title','generate_custom_404_title' );
function generate_custom_404_title()
{
      return __('<center>Nichts gefunden</center>', 'kompakt');
}


// Change 404 Page Text
add_filter( 'generate_404_text','generate_custom_404_text' );
function generate_custom_404_text()
{
      return __('<center>Haben Sie sich verirrt? Nutzen Sie unsere Suche oder klicken Sie auf einen unserer neuesten Beiträge.</center>', 'kompakt');
}


// Change 404 Page Search Form
function wpdocs_my_search_form( $form ) {
	$form = '<form role="search" method="get" action="/" class="wp-block-search__button-inside wp-block-search__text-button wp-block-search"><label for="wp-block-search__input-1" class="wp-block-search__label screen-reader-text">Suchen</label><div class="wp-block-search__inside-wrapper " ><input type="search" id="wp-block-search__input-1" class="wp-block-search__input wp-block-search__input " name="s" value="" placeholder="Suchen..."  required /><button type="submit" class="wp-block-search__button wp-element-button">Suchen</button></div></form>';

	return $form;
}
add_filter( 'get_search_form', 'wpdocs_my_search_form' );


// Author Box
function show_author_box(){ 

    global $post;  
    $author_id = get_post_field('post_author' , $post->ID);
    
    // Check if is not 404 Page
    if(!is_404() && is_single()){
    ?>
<div class="author-box">
    <div class="author-box-avatar">
        <img alt=<?php _e("Autorenfoto", "kompakt"); ?> title=<?php _e("Autorenfoto", "kompakt"); ?>
            src=<?php echo get_avatar_url($author_id); ?> />
    </div>
    <div class="author-box-meta">
        <div class="author-box_name"><?php echo '<span>'. get_the_author() . '</span>'; ?></div>
        <div class="author-box_bio">
            <?php echo get_the_author_meta("description", $author_id); ?>
        </div>
    </div>
</div>
<?php 
    }
}

add_action('generate_after_content', 'show_author_box', 10);

// Headline on home page 
add_action( 'generate_before_main_content', function() {
	if ( is_front_page() && is_home() ) {
	?>

<div class="home-headline">
    <div class="wp-block-group__inner-container">
        <h2><?php _e('Aktuelle Beiträge', 'kompakt'); ?></h2>

    </div>
</div>
<?php
	}
} );

// Featured posts on home page
add_action( 'generate_after_header', function() {
    if ( is_front_page() && is_home() ) {

        $sticky = get_option('sticky_posts');

        if (!empty($sticky)) {
            $args = array(
                'post__in' => $sticky,
                'posts_per_page' => '3',
                'ignore_sticky_posts' => 1
            );

            
            $featuredPosts = new WP_Query($args);

            ?> <section class="posts-list featured"> <?php

            if($featuredPosts->have_posts()){
            while ($featuredPosts->have_posts()) : $featuredPosts->the_post();
                get_template_part('template-parts/custom-post-loop');
            endwhile;
            }

        ?>
</section> <?php
    }
}
});


/* Get categories of Post
Output (string): "Cat1, Cat2"
*/
function show_all_categories_of_post(){
    $post_categories = wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) );
   
	if( $post_categories ){
        echo '<span class="category-list">'. implode(',',$post_categories) .'</span>';   
    }   
}




/**
*
* Add custom user profile information
*
*/
// Add custom user meta fields
function add_custom_user_profile_fields($user) {
	wp_enqueue_media();
    ?>
<h3><?php _e('Profile Picture', 'kompakt'); ?></h3>
<table class="form-table">
    <tr>
        <th><label for="profile_picture"><?php _e('Please upload your profile picture.', 'kompakt'); ?></label></th>
        <td>

            <?php
                $profile_picture = get_the_author_meta('profile_picture', $user->ID);
                if (!empty($profile_picture)) {
               
                    echo '<img src="' . esc_url($profile_picture) . '" width="100" /><br />';
                }
                ?>
            <input type="text" style="display:none;" name="profile_picture" id="profile_picture"
                value="<?php echo esc_attr($profile_picture); ?>" class="regular-text" /><br />
            <input type="button" class="button" value="<?php _e('Upload Image', 'kompakt'); ?>"
                id="upload_profile_picture_button" />

        </td>
    </tr>
</table>
<?php
}
add_action('show_user_profile', 'add_custom_user_profile_fields');
add_action('edit_user_profile', 'add_custom_user_profile_fields');


// Save custom user meta fields
function save_custom_user_profile_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'profile_picture', $_POST['profile_picture']);
}
add_action('personal_options_update', 'save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'save_custom_user_profile_fields');

function modify_get_avatar_url_defaults($url, $id) { 

    if(get_the_author_meta('profile_picture', $id)){
     return get_the_author_meta('profile_picture', $id);   
    }
  
    return $url; 
}
// add the filter
add_filter( "get_avatar_url", "modify_get_avatar_url_defaults", 10, 3 );

// Recommended posts on post single
add_action( 'generate_after_content', function() {

    $categories = get_the_category();
   
 
    if ( ! $categories ) {
        return;
    }
  
    $category_id = get_cat_ID($categories[0]->name);

    $args = array(
        'cat'      => $category_id,
        'posts_per_page' => '3'
    );

    $featuredPosts = new WP_Query($args);
    if($featuredPosts->have_posts() && is_single()){
    ?>


    <h3 class="recommended-headline">
        <?php _e('Weitere Beiträge dieser Kategorie', 'kompakt'); ?>
    </h3>


<section class="posts-list recommended">
    <?php



            while ($featuredPosts->have_posts()) : $featuredPosts->the_post();

                get_template_part('template-parts/custom-post-loop');
            
            endwhile;
            
  
    ?>
</section> <?php
          }
 }, 20);
