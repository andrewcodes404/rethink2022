<?php

function apd_custom_theme_js()
{
    // if ( ! is_admin() ) {
		// wp_deregister_script( 'jquery' );
    // }
    //wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
    wp_enqueue_script('app', get_template_directory_uri() . '/js/main.min.js', '', '', true);

    wp_enqueue_script('aos_animation', get_template_directory_uri() . '/js/aos_animation.js', '', '', true);
    wp_enqueue_script('aos_init', get_template_directory_uri() . '/js/aos_init.js', '', '', true);

    wp_enqueue_script('tiny-slider', get_template_directory_uri() . '/js/tiny-slider.min.js', '', '', true);

    wp_enqueue_script('tiny-slider_init', get_template_directory_uri() . '/js/tiny-slider_init.js', '', '', true);



}

///AND DON’T FORGET TO CALL IT
add_action('wp_enqueue_scripts', 'apd_custom_theme_js');




?>
