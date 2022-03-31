<?php
$profiles = get_field('profiles');
$allow_pop_up = get_field('allow_pop_up');
$logo_class = "";
if ($allow_pop_up) {
  $logo_class = "s-card-logo--allow-pop-up";
}
if ($profiles) : ?>
  <div class="s-cards-wrapper">
    <div class="s-cards s-cards--<?php the_field('size') ?>">
      <?php foreach ($profiles as $profile) : ?>
        <div class="s-card  s-card--<?php the_field('size') ?>">
          <div class="s-card-logo <?php echo $logo_class ?> s-card__logo t-modal-parent">
            <?php
            $image = get_field('image', $profile->ID);
            $size = 'large';
            if ($image) {
              echo wp_get_attachment_image($image, $size);
            }
            ?>


          </div>
          <?php get_template_part('template-parts/single-modal', null, array('post_id' => $profile->ID, 'allow_pop_up' => $allow_pop_up)) ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>
