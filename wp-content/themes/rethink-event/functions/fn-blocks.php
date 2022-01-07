<?php

// Allow style for the block admin editor
// Get your styles into the block editor

// add_theme_support('editor-styles');

add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_style('guttenburg-stylesheet', get_stylesheet_directory_uri() . "/style/gutenburg.min.css", false, '1.0', 'all');
    
});

// // Add backend styles for Gutenberg.
// add_action( 'enqueue_block_editor_assets', 'photographus_add_gutenberg_assets' );

// /**
//  * Load Gutenberg stylesheet.
//  */
// function photographus_add_gutenberg_assets() {
//     // Load the theme styles within Gutenberg.
//     wp_enqueue_style( 'photographus-gutenberg', get_theme_file_uri( '/assets/css/gutenberg-editor-style.css' ), false );
// }

add_filter('allowed_block_types', 'apd_allowed_block_types');

function apd_allowed_block_types($allowed_blocks)
{
    return array(

        'acf/cta',
        'acf/carousel-sponsors',
        'acf/carousel-partners',
        'acf/carousel-speakers',
        'acf/carousel-adv-com',
        'acf/space-invader',
        'acf/youtube',
        'acf/speakers-list',
        'acf/prog-snip',

        'acf/partners-co-organiser',
        'acf/partners-sus-partner',
        'acf/partners-content-partner',
        'acf/partners-corp-supporter',
        'acf/partners-event-partner',
        'acf/partners-comm-partner',
        'acf/partners-ngo-partner',
        'acf/partners-supporting-org',
        'acf/partners-sus-supplier',
        'acf/partners-media-partner',

        'acf/partners-green',
        'acf/partners-strategic',
        'acf/partners-insight',
        'acf/partners-charity',

        'acf/sponsors-headline',
        'acf/sponsors-theatre',
        'acf/sponsors-tier1',
        'acf/sponsors-tier2',
        'acf/sponsors-tier3',
        'acf/sponsors-showcase',
        'acf/sponsors-euro',
        'acf/sponsors-impact',
        'acf/sponsors-farming',
        'acf/sponsors-startup',

        'acf/odoo-form',

        'acf/programmes',

        'acf/prog-snip-bec',
        'acf/prog-snip-change',
        'acf/prog-snip-suscom',
        'acf/prog-snip-suspart',
        'acf/prog-snip-susres',
        'acf/prog-snip-sustrans',
        'acf/prog-snip-workshop1',
        'acf/prog-snip-workshop2',
        'acf/prog-snip-workshop3',

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
    );
}

function create_block_category($categories, $post)
{
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'partner-blocks',
                'title' => __('Partner Blocks', 'partner-blocks'),
            ),
            array(
                'slug' => 'sponsor-blocks',
                'title' => __('Sponsor Blocks', 'sponsor-blocks'),
            ),
            array(
                'slug' => 'carousel-blocks',
                'title' => __('Carousel Blocks', 'carousel-blocks'),
            ),
            array(
                'slug' => 'programmes',
                'title' => __('Programmes', 'programmes'),
            ),

            array(
                'slug' => 'programme-snippets',
                'title' => __('Programme Snippets', 'programme-snippets'),
            ),

        )
    );
}
add_filter('block_categories', 'create_block_category', 10, 2);

add_action('acf/init', 'apd_register_blocks');

function apd_register_blocks()
{

    if (function_exists('acf_register_block')) {

        acf_register_block(array(
            'name' => 'programmes',
            'title' => __('Programmes'),
            'render_template' => get_template_directory() . '/blocks/programmes/b-programmes.php',
            'category' => '',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
        ));

        acf_register_block(array(
            'name' => 'programme-bec',
            'title' => __('BEC'),
            'render_template' => get_template_directory() . '/blocks/programmes/b-programme--bec.php',
            'category' => 'programmes',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'programme-change',
            'title' => __('Change'),
            'render_template' => get_template_directory() . '/blocks/programmes/b-programme--change.php',
            'category' => 'programmes',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'programme-suscom',
            'title' => __('Sustainable Communities Theatre'),
            'render_template' => get_template_directory() . '/blocks/programmes/b-programme--susCom.php',
            'category' => 'programmes',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'programme-suspart',
            'title' => __('Sustainable Partnerships'),
            'render_template' => get_template_directory() . '/blocks/programmes/b-programme--susPart.php',
            'category' => 'programmes',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'programme-susres',
            'title' => __('Sustainable Resources Theatre'),
            'render_template' => get_template_directory() . '/blocks/programmes/b-programme--susRes.php',
            'category' => 'programmes',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'programme-sustrans',
            'title' => __('Sustainable Transformation Theatre'),
            'render_template' => get_template_directory() . '/blocks/programmes/b-programme--sustTrans.php',
            'category' => 'programmes',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'programme-workshop1',
            'title' => __('Workshop 1'),
            'render_template' => get_template_directory() . '/blocks/programmes/b-programme--workshop1.php',
            'category' => 'programmes',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'programme-workshop2',
            'title' => __('Workshop 2'),
            'render_template' => get_template_directory() . '/blocks/programmes/b-programme--workshop2.php',
            'category' => 'programmes',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'programme-workshop3',
            'title' => __('Workshop 3'),
            'render_template' => get_template_directory() . '/blocks/programmes/b-programme--workshop3.php',
            'category' => 'programmes',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'prog-snip-bec',
            'title' => __('BEC'),
            'render_template' => get_template_directory() . '/blocks/programme-snippets/b-programme-snippet--bec.php',
            'category' => 'programme-snippets',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'prog-snip-change',
            'title' => __('Change'),
            'render_template' => get_template_directory() . '/blocks/programme-snippets/b-programme-snippet--change.php',
            'category' => 'programme-snippets',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'prog-snip-suscom',
            'title' => __('Sustainable Communities Theatre'),
            'render_template' => get_template_directory() . '/blocks/programme-snippets/b-programme-snippet--susCom.php',
            'category' => 'programme-snippets',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'prog-snip-suspart',
            'title' => __('Sustainable Partnerships'),
            'render_template' => get_template_directory() . '/blocks/programme-snippets/b-programme-snippet--susPart.php',
            'category' => 'programme-snippets',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'prog-snip-susres',
            'title' => __('Sustainable Resources Theatre'),
            'render_template' => get_template_directory() . '/blocks/programme-snippets/b-programme-snippet--susRes.php',
            'category' => 'programme-snippets',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'prog-snip-sustrans',
            'title' => __('Sustainable Transformation Theatre'),
            'render_template' => get_template_directory() . '/blocks/programme-snippets/b-programme-snippet--susTrans.php',
            'category' => 'programme-snippets',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'prog-snip-workshop1',
            'title' => __('Workshop 1'),
            'render_template' => get_template_directory() . '/blocks/programme-snippets/b-programme-snippet--workshop1.php',
            'category' => 'programme-snippets',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'prog-snip-workshop2',
            'title' => __('Workshop 2'),
            'render_template' => get_template_directory() . '/blocks/programme-snippets/b-programme-snippet--workshop2.php',
            'category' => 'programme-snippets',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
        ));

        acf_register_block(array(
            'name' => 'prog-snip-workshop3',
            'title' => __('Workshop 3'),
            'render_template' => get_template_directory() . '/blocks/programme-snippets/b-programme-snippet--workshop3.php',
            'category' => 'programme-snippets',
            'icon' => 'megaphone',
            'keywords' => array('Theatre', 'Programme'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
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
            'example' => array(
                'attributes' => array(
                    'mode' => 'edit',
                    'data' => array(
                        'text' => "This is an Odoo Form",
                    ),
                ),
            ),
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
            'name' => 'partners-charity',
            'title' => __('Charity Partners'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--charity.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'partners-insight',
            'title' => __('Insight & Strategy Partners'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--insight.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'partners-strategic',
            'title' => __('ESG Partner'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--strategic.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'partners-green',
            'title' => __('Green Finance Partners'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--green.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',

        ));

        acf_register_block(array(
            'name' => 'partners-co-organiser',
            'title' => __('Co-Organisers'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--co-organiser.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'partners-sus-partner',
            'title' => __('Sustainability Partners'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--sus-partner.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'partners-content-partner',
            'title' => __('Content Partners'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--content-partner.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'partners-corp-supporter',
            'title' => __('Corporate Supporters'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--corp-supporter.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'partners-event-partner',
            'title' => __('Event Partners'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--event-partner.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'partners-supporting-org',
            'title' => __('Supporting Organisations'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--supporting-org.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'partners-comm-partner',
            'title' => __('Community Partners'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--comm-partner.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'partners-ngo-partner',
            'title' => __('NGO Partners'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--ngo-partner.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
        ));

        acf_register_block(array(
            'name' => 'partners-sus-supplier',
            'title' => __('Sustainable Suppliers'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--sus-supplier.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));
        acf_register_block(array(
            'name' => 'partners-media-partner',
            'title' => __('Media Partners'),
            'render_template' => get_template_directory() . '/blocks/partners/b-partners--media-partner.php',
            'category' => 'partner-blocks',
            'icon' => 'groups',
            'keywords' => array('partners'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'sponsors-startup',
            'title' => __('Start-up Pavilion'),
            'render_template' => get_template_directory() . '/blocks/sponsors/b-sponsors--startup.php',
            'category' => 'sponsor-blocks',
            'icon' => 'awards',
            'keywords' => array('sponsors'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'sponsors-farming',
            'title' => __('Urban Farming'),
            'render_template' => get_template_directory() . '/blocks/sponsors/b-sponsors--farming.php',
            'category' => 'sponsor-blocks',
            'icon' => 'awards',
            'keywords' => array('sponsors'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'sponsors-impact',
            'title' => __('Impact Kommons'),
            'render_template' => get_template_directory() . '/blocks/sponsors/b-sponsors--impact.php',
            'category' => 'sponsor-blocks',
            'icon' => 'awards',
            'keywords' => array('sponsors'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'sponsors-euro',
            'title' => __('European Pavilion'),
            'render_template' => get_template_directory() . '/blocks/sponsors/b-sponsors--euro.php',
            'category' => 'sponsor-blocks',
            'icon' => 'awards',
            'keywords' => array('sponsors'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'sponsors-headline',
            'title' => __('Headline Event Sponsor'),
            'render_template' => get_template_directory() . '/blocks/sponsors/b-sponsors--headline.php',
            'category' => 'sponsor-blocks',
            'icon' => 'awards',
            'keywords' => array('sponsors'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'sponsors-theatre',
            'title' => __('Theatre Sponsor'),
            'render_template' => get_template_directory() . '/blocks/sponsors/b-sponsors--theatre.php',
            'category' => 'sponsor-blocks',
            'icon' => 'awards',
            'keywords' => array('sponsors'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'sponsors-tier1',
            'title' => __('Tier 1'),
            'render_template' => get_template_directory() . '/blocks/sponsors/b-sponsors--tier1.php',
            'category' => 'sponsor-blocks',
            'icon' => 'awards',
            'keywords' => array('sponsors'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'sponsors-tier2',
            'title' => __('Tier 2'),
            'render_template' => get_template_directory() . '/blocks/sponsors/b-sponsors--tier2.php',
            'category' => 'sponsor-blocks',
            'icon' => 'awards',
            'keywords' => array('sponsors'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'sponsors-tier3',
            'title' => __('Tier 3'),
            'render_template' => get_template_directory() . '/blocks/sponsors/b-sponsors--tier3.php',
            'category' => 'sponsor-blocks',
            'icon' => 'awards',
            'keywords' => array('sponsors'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'sponsors-showcase',
            'title' => __('Solutions Showcase'),
            'render_template' => get_template_directory() . '/blocks/sponsors/b-sponsors--showcase.php',
            'category' => 'sponsor-blocks',
            'icon' => 'awards',
            'keywords' => array('sponsors'),
            'post_types' => array('post', 'page'),
            'mode' => 'preview',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'carousel-speakers',
            'title' => __('Speakers'),
            'render_template' => get_template_directory() . '/blocks/carousels/b-carousel-speakers.php',
            'category' => 'carousel-blocks',
            'icon' => 'images-alt2',
            'keywords' => array('carousel', 'slider'),
            'post_types' => array('post', 'page'),
            'mode' => 'edit',
            'example' => array(
                'attributes' => array(
                    'mode' => 'edit',
                    'carousel-items' => array(

                    ),
                ),
            ),
        ));

        acf_register_block(array(
            'name' => 'carousel-partners',
            'title' => __('Partners'),
            'render_template' => get_template_directory() . '/blocks/carousels/b-carousel--partners.php',
            'category' => 'carousel-blocks',
            'icon' => 'images-alt2',
            'keywords' => array('carousel', 'slider'),
            'post_types' => array('post', 'page'),
            'mode' => 'edit',

        ));

        acf_register_block(array(
            'name' => 'carousel-sponsors',
            'title' => __('Sponsors'),
            'render_template' => get_template_directory() . '/blocks/carousels/b-carousel--sponsors.php',
            'category' => 'carousel-blocks',
            'icon' => 'images-alt2',
            'keywords' => array('carousel', 'slider'),
            'post_types' => array('post', 'page'),
            'mode' => 'edit',

        ));

        acf_register_block(array(
            'name' => 'carousel-adv-com',
            'title' => __('Advisory Com'),
            'render_template' => get_template_directory() . '/blocks/carousels/b-carousel--adv-com.php',
            'category' => 'carousel-blocks',
            'icon' => 'images-alt2',
            'keywords' => array('carousel', 'slider'),
            'post_types' => array('post', 'page'),
            'mode' => 'edit',

        ));

    }
}