<?php
/*
Template Name: On Demand
 */
get_header();?>
<div class="content-layout">
    <?php if (have_posts()): while (have_posts()): the_post();?>

    <?php $post_id = get_the_ID();?>
    <?php get_template_part('template-parts/hero', 'hero', array('post_id' => $post_id))?>

    <div class="content-layout">
        <?php the_content();?>
    </div>

    <?php endwhile;else: ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.');?></p>
    <?php endif;?>

    <?php wp_reset_postdata();?>
    <?php

$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query('cat=21&showposts=9&orderby=menu_order' . '&paged=' . $paged);
?>


    <div class="s-blogs">

        <?php if ($wp_query->have_posts()): ?>

        <!-- Start of the main loop. -->
        <?php while ($wp_query->have_posts()): $wp_query->the_post();?>
        <?php $post_id = get_the_ID();?>

        <div class="s-blog">
            <div class="s-blog__img">
                <?php echo get_the_post_thumbnail($post_id, 'medium'); ?>
            </div>

            <div class="s-blog__text">
                <h3 class=""><?php the_title()?></h3>
                <p><?php the_excerpt()?></p>
                <p><a href=" <?php echo get_permalink(); ?>">read more &rarr; </a></p>
            </div>
        </div>

        <?php endwhile;?>
        <!-- End of the main loop -->
    </div>

    <div class="pagination">

        <div class="nav-previous alignleft"><?php previous_posts_link('&#8592;  newer posts');?></div>
        <div class="nav-next alignright"><?php next_posts_link('older posts  &#8594;');?></div>

    </div>


    <?php wp_reset_postdata();?>

    <?php else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.');?></p>
    <?php endif;?>




</div>
</div>
<?php get_footer();?>