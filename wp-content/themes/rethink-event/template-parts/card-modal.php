<?php

$the_query = new WP_Query(array(
  'post_type' => $args['data']['post_type'],
  'posts_per_page' => -1,
  'meta_key' => $args['data']['meta-key'] ?? null,
  'meta_value' => $args['data']['meta_value'],
  'orderby' => 'post_title',
  'order' => 'ASC',
));

if ($the_query->have_posts()) : ?>

  <div class="s-cards-wrapper  s-cards-wrapper--<?php echo $args['data']['meta_value'] ?>">

    <?php if (is_admin()) {
      echo '<p class="s-cards-wrapper__hint"> <code >hint: this is the ' . $args["data"]["meta_value"] . ' block</code></p>';
    }
    ?>

    <div class="s-cards s-cards--<?php echo $args['data']['meta_value'] ?> s-cards--<?php the_field('pick_a_size_for_the_logos') ?>">

      <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <?php $post_id = get_the_ID(); ?>
        <?php $title = get_the_title($post_id) ?>
        <?php $position = get_field("position", $post_id) ?>
        <?php $company = get_field("company", $post_id) ?>
        <?php $booth = get_field('booth', $post_id) ?>
        <?php $year = get_field('year', $post_id) ?>


        <?php
        $show = true;
        if ($year) {
          if (in_array('2022', $year)) {
            $show = false;
          }
          if (in_array('2021', $year)) {
            $show = true;
          }
        }
        ?>

        <?php if ($show) : ?>
          <div class="s-card  s-card--<?php the_field('pick_a_size_for_the_logos') ?>">
            <div class="s-card-logo s-card__logo t-modal-parent">
              <?php
              $image = get_field('image', $post_id);
              $size = 'full'; // (thumbnail, medium, large, full or custom size)

              if ($image) {
                echo wp_get_attachment_image($image, $size);
              } ?>
            </div>
          </div>
        <?php endif ?>


      <?php endwhile; ?>

      <?php wp_reset_postdata(); ?>
    </div>

  </div>
<?php endif; ?>
