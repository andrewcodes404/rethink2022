<?php $partners = $args['data']?>

<div class="t-partners ">

    <?php foreach ($partners as $partner): ?>

    <?php $post_id = $partner->ID;?>
    <?php $image = get_field('image', $post_id);?>
    <?php $link = get_permalink($partner->ID);?>


    <div class="t-partner s-card-logo t-modal-parent">
        <?php if ($image): ?>
        <?php echo wp_get_attachment_image($image, 'medium'); ?>
        <?php endif;?>
    </div>

    <?php get_template_part('template-parts/single-modal', null, array('post_id' => $post_id))?>

    <?php endforeach;?>
</div>