<?php get_header();?>
<?php if (have_posts()): while (have_posts()): the_post();?>



<div class="s-hero s-hero--<?php the_field('background_color');?>">


    <div class="content-layout">
        <!-- TODO: if acf title use if not use post title   -->
        <h1><?php the_field('title');?></h1>
        <h3><?php the_field('subtitle');?></h3>
    </div>
</div>


<div class="content-layout">
    <!-- <h1><?php the_title()?></h1> -->
    <?php the_content();?>
</div>


<?php endwhile;else: ?>
<p><?php esc_html_e('Sorry, no posts matched your criteria.');?></p>
<?php endif;?>
<?php get_footer();?>