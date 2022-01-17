<?php
/**
 * Plugin Name: Modula Video
 * Plugin URI: https://wp-modula.com/
 * Description: Enables video galleries for Modula.
 * URI: https://wp-modula.com/
 * Author: Macho Themes
 * Version: 1.0.5
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'MODULA_VIDEO_VERSION', '1.0.5' );
define( 'MODULA_VIDEO_PATH', plugin_dir_path( __FILE__ ) );
define( 'MODULA_VIDEO_URL', plugin_dir_url( __FILE__ ) );
define( 'MODULA_VIDEO_FILE', __FILE__ );

require_once MODULA_VIDEO_PATH . 'includes/class-modula-video.php';

// Load the main plugin class.
$modula_video = Modula_Video::get_instance();
