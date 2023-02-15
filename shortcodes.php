<?php

// Shortcode to display the Site Name
add_shortcode( 'site_name','site_name_shortcode' );
function site_name_shortcode()
{
    return get_bloginfo($show = 'name');
}



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