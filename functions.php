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

add_action( 'wp_enqueue_scripts', 'threek_enqueue_child_theme_styles', PHP_INT_MAX);

function threek_enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'threek-style', THREEK_THEME_URL.'assets/style/style.min.css', array('parent-style'),THREEK_VERSION   );
}