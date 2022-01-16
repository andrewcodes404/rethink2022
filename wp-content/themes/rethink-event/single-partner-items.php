<?php get_header();?>

<?php if (have_posts()): while (have_posts()): the_post();?>
<?php $post_id = get_the_ID();?>

<?php get_template_part('template-parts/single-page', 'single-page', array('post_id' => $post_id))?>

<?php endwhile;else: ?>
<p><?php esc_html_e('Sorry, no posts matched your criteria.');?></p>
<?php endif;?>
<?php get_footer();?>
