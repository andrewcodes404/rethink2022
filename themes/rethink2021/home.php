<?php get_header();?>

<div class="s-blogs-wrapper">
    <?php

global $post;
$page_for_posts_id = get_option('page_for_posts');
if ($page_for_posts_id):
    $post = get_page($page_for_posts_id);
    setup_postdata($post);
    ?>

    <div id="post-<?php the_ID();?>">
        <div>
            <!-- <h1> <?php the_title();?></h1> -->
            <?php the_content();?>
        </div>
    </div>

    <?php rewind_posts();endif;?>

    <div class="s-blogs">

        <?php if (have_posts()): ?>

        <!-- Start of the main loop. -->
        <?php while (have_posts()): the_post();?>

        <!-- the rest of your theme's main loop -->

        <a href=" <?php echo get_permalink(); ?>" class="s-blog">

            <div class="s-blog__img">

                <?php
    $post_thumbnail_id = get_post_thumbnail_id($post_id);
    echo wp_get_attachment_image(
        $post_thumbnail_id,
        false,
        $size,
        array('title' => $image['title'], 'alt' => $image['alt']));
    ?>
            </div>

            <div class="s-blog__text">
                <h3 class="s-blog__text__title"><?php the_title()?></h3>
                <span class="">
                    <?php the_excerpt()?>
                </span>

            </div>

            <p class="s-blog__text__link">read more &rarr; </p>
        </a>


        <?php endwhile;?>
        <!-- End of the main loop -->
    </div>
    <!-- Add the pagination functions here. -->




    <?php the_posts_pagination(array(
    'mid_size' => 2,
    'prev_text' => __('< forward', 'textdomain'),
    'next_text' => __('back >', 'textdomain'),
));?>


    <!-- <nav class="navigation pagination" role="navigation" aria-label="Posts">
        <h2 class="screen-reader-text b-h2 aos-init aos-animate" data-aos="h2-heading">Posts navigation</h2>
        <div class="nav-links">

        <a class="prev page-numbers" href="https://rethink2.local/insight/">← newer posts</a>

            <a class="page-numbers" href="https://rethink2.local/insight/">1</a>
            <span aria-current="page" class="page-numbers current">2</span>
            <a class="page-numbers" href="https://rethink2.local/insight/page/3/">3</a>
            <a class="page-numbers" href="https://rethink2.local/insight/page/4/">4</a>
            <span class="page-numbers dots">…</span>
            <a class="page-numbers" href="https://rethink2.local/insight/page/9/">9</a>

            <a class="next page-numbers" href="https://rethink2.local/insight/page/3/">older posts →</a>

        </div>
    </nav> -->






    <!-- <div class="pagination">
        <div class="nav-previous alignleft"><?php previous_posts_link('&#8592;  newer posts');?></div>
        <div class="nav-next alignright"><?php next_posts_link('older posts  &#8594;');?></div>
    </div> -->

    <?php else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.');?></p>
    <?php endif;?>



</div>

<?php get_footer();?>