<?php get_header();?>

<div class="s-blogs-wrapper">
    <?php

global $post;
$page_for_posts_id = get_option('page_for_posts');
if ($page_for_posts_id):
    $post = get_page($page_for_posts_id);
    setup_postdata($post);
    ?>
    <?php $post_id = get_the_ID();?>
    <?php get_template_part('template-parts/hero', 'hero', array('post_id' => $post_id))?>

    <div class="content-layout">
        <?php the_content();?>
    </div>

    <?php rewind_posts();endif;?>

    <div class="s-blogs content-layout">
        <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post();?>
        <?php $post_id = get_the_ID();?>


        <a href=" <?php echo get_permalink(); ?>" class="s-blog">

            <div class="s-blog__img">
                <?php echo get_the_post_thumbnail($post_id, 'medium'); ?>
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


        <!-- pagination -->
        <div class="content-layout">

            <div class="pagination">
                <div class="nav-previous alignleft"><?php previous_posts_link('&#8592;  newer posts');?></div>
                <div class="nav-next alignright"><?php next_posts_link('older posts  &#8594;');?></div>
            </div>

            <?php else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.');?></p>
            <?php endif;?>

        </div>
    </div>
</div>

<?php get_footer();?>