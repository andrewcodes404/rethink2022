<?php $speakers = $args['data'] ?>

<div class="t-speakers">
  <?php foreach ($speakers as $speaker) : ?>

    <?php $post_id = $speaker->ID; ?>

    <?php $link = get_permalink($speaker->ID); ?>
    <?php $image = get_field('image', $post_id); ?>
    <?php $moderator = $speaker->moderator ?>

<?php echo '<pre>';
print_r($speaker);
echo '</pre> '?>;


    <div class="t-speaker  t-modal-parent <?php echo $moderator ? 't-speaker--moderator' : '' ?>  ">

      <div class="t-speaker__img">
        <?php if ($image) : ?>
          <?php echo wp_get_attachment_image($image, 'medium'); ?>
        <?php endif; ?>
      </div>

      <div class="t-speaker__text">
        <?php if ($moderator) : ?> <p class="t-speaker__text__mod">MODERATOR
          </p>
        <?php endif ?>

        <p class="t-speaker__text__title">
          <?php echo get_the_title($speaker->ID); ?>
        </p>

        <p class="t-speaker__text__position"> <?php echo get_field('position', $speaker->ID); ?></p>
        <p class="t-speaker__text__company"> <?php echo get_field('company', $speaker->ID); ?></p>
      </div>

    </div>

    <?php get_template_part('template-parts/single-modal', null, array('post_id' => $post_id, 'allow_pop_up' => true)) ?>

  <?php endforeach; ?>
</div>
