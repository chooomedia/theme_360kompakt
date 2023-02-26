<?php

// Shortcode to display the Site Name
add_shortcode( 'site_name','site_name_shortcode' );
function site_name_shortcode()
{
    return get_bloginfo($show = 'name');
}




