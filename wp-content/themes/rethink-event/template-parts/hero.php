<?php $post_id = $args['post_id'];?>

<div class="t-hero t-hero--<?php echo the_field('background_color', $post_id); ?>">
    <div class="content-layout">

        <!-- check if title is from ACF or post -->
        <?php if (get_field('title', $post_id)): ?>
        <h1><?php the_field('title', $post_id);?></h1>
        <?php else: ?>
        <h1><?php the_title();?></h1>
        <?php endif;?>

        <?php if (get_field('subtitle', $post_id)): ?>
        <h3><?php the_field('subtitle', $post_id);?></h3>
        <?php endif?>

    </div>
</div>