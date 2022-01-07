<?php get_header();?>
<?php if (have_posts()): while (have_posts()): the_post();?>
<div class="content-layout">
    <h1><?php the_title()?></h1>
    <?php the_content();?>
</div>
<?php endwhile;else: ?>
<p><?php esc_html_e('Sorry, no posts matched your criteria.');?></p>
<?php endif;?>
<?php get_footer();?>