<?php
//using "apd_" to prevent clashes with other functions
function apd_custom_theme_styles()
{

    //tiny-slider css
    wp_enqueue_style('tiny-slider', get_template_directory_uri() . '/style/tiny-slider.css');

    wp_enqueue_style('tiny-slider-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css');

    //aos animation css
    wp_enqueue_style('aos_animate', get_template_directory_uri() . '/style/style-aos-animation.css');

    // internal style sheet
    wp_enqueue_style('style_custom', get_template_directory_uri() . '/style/style.min.css');


}

add_action('wp_enqueue_scripts', 'apd_custom_theme_styles'); 
?>