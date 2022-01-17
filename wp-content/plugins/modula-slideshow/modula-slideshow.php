<?php
/**
 * Plugin Name: Modula Slideshow
 * Plugin URI: https://wp-modula.com/
 * Description: Convert the gallery's lightbox view into a stunning slideshow.
 * Author: WP Modula
 * Version: 1.0.3
 * Author URI: https://wp-modula.com/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'MODULA_SLIDESHOW_VERSION', '1.0.3' );
define( 'MODULA_SLIDESHOW_PATH', plugin_dir_path( __FILE__ ) );
define( 'MODULA_SLIDESHOW_URL', plugin_dir_url( __FILE__ ) );
define( 'MODULA_SLIDESHOW_FILE', __FILE__ );

require_once MODULA_SLIDESHOW_PATH . 'includes/class-modula-slideshow.php';

// Load the main plugin class.
$modula_slideshow = Modula_Slideshow::get_instance();
