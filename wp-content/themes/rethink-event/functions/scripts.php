<?php
function apd_enqueue_style() {
    // internal style sheet
    wp_enqueue_style('style_custom_css', get_template_directory_uri() . '/style/style.min.css');

    ///google fonts
    wp_enqueue_style('gfonts_css', 'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap');

    ///Adobe fonts
    // wp_enqueue_style('adobe_fonts', 'https://use.typekit.net/ftu0cki.css');

    //aos animation css
    wp_enqueue_style('aos_animate_css', get_template_directory_uri() . '/style/style-aos-animation.css');
}
add_action('wp_enqueue_scripts', 'apd_enqueue_style'); 

function apd_enqueue_script() {
    if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
    }
    //wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
    wp_enqueue_script('app_js', get_template_directory_uri() . '/js/main.min.js', '', '', true);
    wp_enqueue_script('aos_animation_js', get_template_directory_uri() . '/js/aos_animation.js', '', '', true);
    wp_enqueue_script('aos_init_js', get_template_directory_uri() . '/js/aos_init.js', '', '', true);
}

///AND DON’T FORGET TO CALL IT
add_action('wp_enqueue_scripts', 'apd_enqueue_script');