<?php

//javascript
function apd_enqueue_script()
{
  // if ( ! is_admin() ) {
  // wp_deregister_script( 'jquery' );
  // }
  wp_enqueue_script('tiny-slider', get_template_directory_uri() . '/js/tiny-slider.min.js', '', '', true);
  wp_enqueue_script('tiny-slider_init', get_template_directory_uri() . '/js/tiny-slider_init.js', '', '', true);
  wp_enqueue_script('aos_animation_js', get_template_directory_uri() . '/js/aos_animation.js', '', '', true);
  wp_enqueue_script('aos_init_js', get_template_directory_uri() . '/js/aos_init.js', '', '', true);
  wp_enqueue_script('app_js', get_template_directory_uri() . '/js/main.min.js', '', '', true);
}



///AND DON’T FORGET TO CALL IT
add_action('wp_enqueue_scripts', 'apd_enqueue_script');

//Stylesheets

function apd_custom_theme_styles()
{
  //tiny-slider css
  wp_enqueue_style('tiny-slider', get_template_directory_uri() . '/style/tiny-slider.css');
  wp_enqueue_style('tiny-slider-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css');

  //aos animation css
  wp_enqueue_style('aos_animate', get_template_directory_uri() . '/style/style-aos-animation.css');

  ///google fonts
  wp_enqueue_style('gfonts_css', 'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap');

  // internal style sheet
  wp_enqueue_style('style_custom', get_template_directory_uri() . '/style/style.min.css', array(), filemtime(get_template_directory() . '/style/style.min.css'), false);
}

add_action('wp_enqueue_scripts', 'apd_custom_theme_styles');

add_action('enqueue_block_editor_assets', function () {
  wp_enqueue_style('guttenburg-stylesheet', get_stylesheet_directory_uri() . "/style/gutenburg.min.css", array(), filemtime(get_template_directory() . '/style/gutenburg.min.css'), false);
});
