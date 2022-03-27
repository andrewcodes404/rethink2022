<?php
/**
 * Plugin Name: Modula Video
 * Plugin URI: https://wp-modula.com/
 * Description: Enables video galleries for Modula.
 * URI: https://wp-modula.com/
 * Author: WPChill
 * Version: 1.0.6
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'MODULA_VIDEO_VERSION', '1.0.6' );
define( 'MODULA_VIDEO_PATH', plugin_dir_path( __FILE__ ) );
define( 'MODULA_VIDEO_URL', plugin_dir_url( __FILE__ ) );
define( 'MODULA_VIDEO_FILE', __FILE__ );

require_once MODULA_VIDEO_PATH . 'includes/class-modula-video.php';

// Load the main plugin class.
add_action('plugins_loaded','run_modula_video', 75 );
function run_modula_video(){
    $modula_video = Modula_Video::get_instance();
}