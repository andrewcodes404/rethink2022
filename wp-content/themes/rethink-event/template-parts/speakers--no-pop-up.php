<?php $speakers = $args['data'] ?>

<div class="t-speakers">
  <?php foreach ($speakers as $speaker) : ?>

    <?php $post_id = $speaker->ID; ?>

    <?php $link = get_permalink($speaker->ID); ?>
    <?php $image = get_field('image', $post_id); ?>
    <?php $moderator = $speaker->moderator ?>

    <div class="t-speaker  t-modal-parent <?php echo $moderator ? 't-speaker--moderator' : '' ?>  ">


      <a href="<?php echo $link  ?>">
        <div class="t-speaker__img">
          <?php if ($image) : ?>
            <?php echo wp_get_attachment_image($image, 'medium'); ?>
          <?php endif; ?>
        </div>

        <div class="t-speaker__text">
          <?php if ($moderator) : ?>
            <p class="t-speaker__text__mod"> MODERATOR</p>
          <?php endif ?>

          <p class="t-speaker__text__title">
            <?php echo get_the_title($speaker->ID); ?>


          </p>

          <p class="t-speaker__text__position">
            <?php echo get_field('position', $speaker->ID); ?>
          </p>
          <p class="t-speaker__text__company">
            <?php echo get_field('company', $speaker->ID); ?>
          </p>

        </div>
      </a>
    </div>
  <?php endforeach; ?>
</div>
