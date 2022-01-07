<div class="b-image-wrapper" id="<?php echo "b-image-" . $block['id'] ?>">
  <div class="b-image b-layout">
    <?php if( get_field('image') ): ?>

    <div class="b-image__img ">
      <?php echo wp_get_attachment_image( get_field('image'), 'full' ); ?>
    </div>
    <?php endif; ?>

    <?php if( get_field('caption') ): ?>
    <small class="b-image__caption"> <?php the_field('caption') ?></small>
    <?php endif; ?>
  </div>
</div>