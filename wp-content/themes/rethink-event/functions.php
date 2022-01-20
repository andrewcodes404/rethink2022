<?php

//turn this back to true in prod
// show_admin_bar(false);

//for page titles
add_theme_support('title-tag');

// Image sizes
add_image_size('carousel', 400, 400);

//remove yoast from CPTs

function my_remove_wp_seo_meta_box_speakers()
{
    remove_meta_box('wpseo_meta', ['speakers-items', 'partner-items', 'sponser-items'], 'normal');
}
add_action('add_meta_boxes', 'my_remove_wp_seo_meta_box_speakers', 100);

//Remove category from posts home

function exclude_category($query)
{
    if ($query->is_home() && $query->is_main_query()) {
        $query->set('cat', '-21');
    }
}
add_action('pre_get_posts', 'exclude_category');

// Add menu order to posts

add_action('admin_init', 'posts_order_wpse_91866');

function posts_order_wpse_91866()
{
    add_post_type_support('post', 'page-attributes');
}

/**
 * Order posts by the last word in the post_title.
 * Activated when orderby is 'wpse_last_word'
 * @link https://wordpress.stackexchange.com/a/198624/26350
 */
add_filter('posts_orderby', function ($orderby, \WP_Query $q) {
    if ('wpse_last_word' === $q->get('orderby') && $get_order = $q->get('order')) {
        if (in_array(strtoupper($get_order), ['ASC', 'DESC'])) {
            global $wpdb;
            $orderby = " SUBSTRING_INDEX( {$wpdb->posts}.post_title, ' ', -1 ) " . $get_order;
        }
    }
    return $orderby;
}, PHP_INT_MAX, 2);

//ACF

// create options page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

/**
 * Load an inline SVG.
 *
 * @param string $filename The filename of the SVG you want to load.
 *
 * @return string The content of the SVG you want to load.
 */
function load_inline_svg($filename)
{

    // Add the path to your SVG directory inside your theme.
    $svg_path = '/images/svg/';

    // Check the SVG file exists
    if (file_exists(get_stylesheet_directory() . $svg_path . $filename)) {

        // Load and return the contents of the file
        return file_get_contents(get_stylesheet_directory_uri() . $svg_path . $filename);
    }

    // Return a blank string if we can't find the file.
    return '';
}

// Import more functions

require_once get_template_directory() . '/functions/fn-stylesheets.php';

// Scripts
require_once get_template_directory() . '/functions/fn-js.php';

// Menus
require_once get_template_directory() . '/functions/fn-menus.php';

// Blog & Ecerpt
require_once get_template_directory() . '/functions/fn-blog.php';

//Guttenburg Blocks
require_once get_template_directory() . '/functions/fn-blocks.php';