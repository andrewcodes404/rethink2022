<?php
/**
 * Plugin Name: Modula Slideshow
 * Plugin URI: https://wp-modula.com/
 * Description: Convert the gallery's lightbox view into a stunning slideshow.
 * Author: WPChill
 * Version: 1.0.4
 * Author URI: https://wp-modula.com/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'MODULA_SLIDESHOW_VERSION', '1.0.4' );
define( 'MODULA_SLIDESHOW_PATH', plugin_dir_path( __FILE__ ) );
define( 'MODULA_SLIDESHOW_URL', plugin_dir_url( __FILE__ ) );
define( 'MODULA_SLIDESHOW_FILE', __FILE__ );

require_once MODULA_SLIDESHOW_PATH . 'includes/class-modula-slideshow.php';

// Load the main plugin class.
add_action('plugins_loaded','run_modula_slideshow', 85 );
function run_modula_slideshow(){
    $modula_slideshow = Modula_Slideshow::get_instance();
}