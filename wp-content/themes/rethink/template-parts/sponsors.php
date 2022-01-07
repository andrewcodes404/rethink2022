<?php $sponsors = $args['data']?>

<div class="t-sponsors ">

    <?php foreach ($sponsors as $sponsor): ?>

    <?php $post_id = $sponsor->ID;?>
    <?php $image = get_field('image', $post_id);?>
    <?php $link = get_permalink($sponsor->ID);?>


    <div class="t-sponsor s-card-logo t-modal-parent">
        <?php if ($image): ?>
        <?php echo wp_get_attachment_image($image, 'medium'); ?>
        <?php endif;?>
    </div>

    <?php get_template_part('template-parts/single-modal', null, array('post_id' => $post_id))?>

    <?php endforeach;?>
</div>