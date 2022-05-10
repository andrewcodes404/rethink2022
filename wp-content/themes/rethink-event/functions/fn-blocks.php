<?php

add_filter('allowed_block_types_all', 'apd_allowed_block_types', 10, 2);

function apd_allowed_block_types($allowed_blocks)
{
  return array(

    'acf/cta',
    'acf/carousel-all-in-one',
    'acf/space-invader',
    'acf/youtube',
    'acf/speakers-list',
    'acf/cta-squares',
    'acf/progrid',
    'acf/logos',
    'acf/odoo-form',
    'acf/programmes',
    'acf/programme-snippet',
    // 'acf/prog-snip-bec',
    // 'acf/prog-snip-change',
    // 'acf/prog-snip-suscom',
    // 'acf/prog-snip-suspart',
    // 'acf/prog-snip-susres',
    // 'acf/prog-snip-sustrans',
    // 'acf/prog-snip-workshop1',
    // 'acf/prog-snip-workshop2',
    // 'acf/prog-snip-workshop3',

    // the wp-blocks
    'core/heading',
    'core/paragraph',
    'core/list',
    'core/image',
    // 'core/embed',
    'core/code',
    'core/quote',
    // 'core/video',
    // 'core/embed[3]',
    // 'core/audio',
    'core/separator',
    // 'core/spacer',
    'core/shortcode',

    // modula
    'modula/gallery',
    // 'modula/link',
  );
}

// function create_block_category($categories, $post)
// {
//   return array_merge(
//     $categories,
//     array(
//       array(
//         'slug' => 'programmes',
//         'title' => __('Programmes', 'programmes'),
//       ),

//       array(
//         'slug' => 'programme-snippets',
//         'title' => __('Programme Snippets', 'programme-snippets'),
//       ),

//     )
//   );
// }
// add_filter('block_categories_all', 'create_block_category', 10, 2);

add_action('acf/init', 'apd_register_blocks');

function apd_register_blocks()
{

  if (function_exists('acf_register_block')) {


    acf_register_block(array(
      'name' => 'logos',
      'title' => __('logos'),
      'render_template' => get_template_directory() . '/blocks/b-logos.php',
      'category' => 'media',
      'icon' => 'images-alt',
      'post_types' => array('post', 'page'),
      'mode'  => 'edit',
      'supports' => array('mode' => false)
    ));

    acf_register_block(array(
      'name' => 'programmes',
      'title' => __('Programmes'),
      'render_template' => get_template_directory() . '/blocks/b-programmes.php',
      'category' => '',
      'icon' => 'megaphone',
      'keywords' => array('Theatre', 'Programme'),
      'post_types' => array('post', 'page'),
      'mode' => 'auto',
    ));

    acf_register_block(array(
      'name' => 'programme-snippet',
      'title' => __('Programme Snippet'),
      'render_template' => get_template_directory() . '/blocks/b-programme-snippet.php',
      'category' => '',
      'icon' => 'megaphone',
      'post_types' => array('post', 'page'),
      'mode' => 'auto',
    ));

    acf_register_block(array(
      'name' => 'odoo-form',
      'title' => __('Odoo Form'),
      'render_template' => get_template_directory() . '/blocks/b-odoo-form.php',

      'category' => 'layout',
      'icon' => 'media-text',
      'keywords' => array('odoo', 'form'),
      'post_types' => array('post', 'page'),
      'mode' => 'edit',
      'supports' => array('mode' => false),

    ));

    acf_register_block(array(
      'name' => 'cta',
      'title' => __('Call to action (CTA)'),
      'render_template' => get_template_directory() . '/blocks/b-cta.php',

      'category' => 'layout',
      'icon' => 'media-text',
      'keywords' => array('cta', 'call to action', 'link', 'download'),
      'post_types' => array('post', 'page'),
      'mode' => 'auto',
      'example' => array(
        'attributes' => array(
          'mode' => 'preview',
          'data' => array(
            'text' => "This is a CTA",
          ),
        ),
      ),
    ));

    acf_register_block(array(
      'name' => 'space-invader',
      'title' => __('Space Invader'),
      'render_template' => get_template_directory() . '/blocks/b-space-invader.php',
      'category' => 'design',
      'icon' => 'button',
      'keywords' => array('space', 'margin', 'padding'),
      'post_types' => array('post', 'page'),
      'mode' => 'auto',

    ));

    acf_register_block(array(
      'name' => 'youtube',
      'title' => __('YouTube'),
      'render_template' => get_template_directory() . '/blocks/b-youtube.php',
      'category' => 'media',
      'icon' => 'format-video',
      'keywords' => array('video', 'youtube', 'embed'),
      'post_types' => array('post', 'page'),
      'mode' => 'edit',

    ));

    acf_register_block(array(
      'name' => 'speakers-list',
      'title' => __('Speakers Filtered List'),
      'render_template' => get_template_directory() . '/blocks/b-speakers-list.php',
      'category' => '',
      'icon' => 'button',
      'post_types' => array('post', 'page'),
      'mode' => 'preview',
    ));

    acf_register_block(array(
      'name' => 'cta-squares',
      'title' => __('CTA Squares'),
      'render_template' => get_template_directory() . '/blocks/b-cta-squares.php',
      'category' => '',
      'icon' => 'grid-view',
      'post_types' => array('post', 'page'),
      'mode' => 'auto',
    ));

    acf_register_block(array(
      'name' => 'progrid',
      'title' => __('Pro-Grid'),
      'render_template' => get_template_directory() . '/blocks/b-progrid.php',
      'category' => '',
      'icon' => 'button',
      'post_types' => array('post', 'page'),
      'mode' => 'preview',
    ));

    acf_register_block(array(
      'name' => 'carousel-all-in-one',
      'title' => __('Carousel - All in One'),
      'render_template' => get_template_directory() . '/blocks/b-carousel.php',
      'category' => 'media',
      'icon' => 'buddicons-groups',
      'keywords' => array('carousel', 'slider'),
      'post_types' => array('post', 'page'),
      'mode'  => 'edit',
      'supports' => array('mode' => false),
      'example' => array(
        'attributes' => array(
          'mode' => 'edit',
          'carousel-items' => array(),
        ),
      ),
    ));







  }
}
