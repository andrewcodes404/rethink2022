<?php
$carousel_items = get_field('carousel_items');
$index = get_field('index');
if ($carousel_items) : ?>

  <div class="b-carousel-wrapper">
    <div class="b-carousel b-carousel--all-in-one b-carousel--all-in-one<?php echo $index ?>">

      <?php foreach ($carousel_items as $carousel_item) : ?>

        <div class="b-carousel-item">

          <div class="b-carousel-item__img">
            <?php
            $image = get_field('image', $carousel_item->ID);
            $size = 'carousel';
            if ($image) {
              echo wp_get_attachment_image($image, $size);
            }
            ?>
          </div>

          <?php if (get_post_type($carousel_item->ID)  === "speaker-items") : ?>
            <div class="b-carousel-item__text">
              <p><?php echo get_the_title($carousel_item->ID); ?></p>
              <p><?php the_field('position', $carousel_item->ID); ?></p>
              <p><?php the_field('company', $carousel_item->ID); ?></p>
            </div>
          <?php endif ?>
        </div>

      <?php endforeach; ?>

    </div>
  </div>

<?php endif; ?>
