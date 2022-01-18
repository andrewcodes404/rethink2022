<?php $post_id = $args['post_id'];?>



<div class="t-hero">

    <div class="t-hero__background  t-hero__background--<?php echo the_field('background_color', $post_id); ?>"></div>


    <div
        class="t-hero__background-image <?php echo get_field('dark_filter') ? 't-hero__background-image--darken' : "" ?>">


        <?php
$image = get_field('background_image');
$size = 'full'; // (thumbnail, medium, large, full or custom size)
if ($image) {
    echo wp_get_attachment_image($image, $size);
}
?>
    </div>

    <div class="content-layout">
        <!-- check if title is from ACF or post -->
        <?php if (get_field('title', $post_id)): ?>


        <div class="t-hero__text t-hero__text--<?php echo the_field('text_color', $post_id); ?>">
            <h1><?php the_field('title', $post_id);?></h1>
            <?php else: ?>
            <h1><?php the_title();?></h1>
            <?php endif;?>

            <?php if (get_field('subtitle', $post_id)): ?>
            <h3><?php the_field('subtitle', $post_id);?></h3>
            <?php endif?>
        </div>
    </div>

</div>