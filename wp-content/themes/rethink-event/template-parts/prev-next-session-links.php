<?php

$location = $args['location'];
$day = $args['day'];

$show_back_btn = $args['show_back_btn'];
$location_text = $args['location_text'];
$time_start = $args['time_start'];
$post_id = $args['post_id'];
$i = 0;


$prev_next_query = new WP_Query(
  array(
    'post_type' => 'session-2022',
    'posts_per_page' => -1,
    'meta_key' => 'time_start',
    'order' => 'ASC',
    'orderby' => 'meta_value',

    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key' => 'location',
        'value' => $location,
      ),
      array(
        'key' => 'day',
        'value' => $day,
      ),
    ),
  )
);

?>


<div class="c-prev-next-btns">

  <?php if ($prev_next_query->have_posts()) : ?>

    <?php
    foreach ($prev_next_query->posts as $key => $value) {

      if ($value->ID == $post->ID) {

        if (isset($prev_next_query->posts[$key + 1]->ID)) {
          $nextID = $prev_next_query->posts[$key + 1]->ID;
        }

        if (isset($prev_next_query->posts[$key - 1]->ID)) {
          $prevID = $prev_next_query->posts[$key - 1]->ID;
        }
        break;
      }
    }
    ?>


    <?php while ($prev_next_query->have_posts()) : $prev_next_query->the_post(); ?>
      <?php $loop_post_id = get_the_ID(); ?>

      <?php if ($loop_post_id === $post_id) : ?>

        <?php if (isset($prevID)) : ?>
          <div class="b-cta-wrapper c-prev-next-btns__button c-prev-next-btns__button--mobile">
            <a href="<?= get_the_permalink($prevID) ?>" class="b-cta b-cta--<?php echo $location ?>" rel="prev"> Prev</a>
          </div>


          <div class="b-cta-wrapper c-prev-next-btns__button c-prev-next-btns__button--desktop">
            <a href="<?= get_the_permalink($prevID) ?>" class="b-cta b-cta--<?php echo $location ?>" rel="prev">Prev Session </a>
          </div>
        <?php endif; ?>



        <?php if ($show_back_btn == "true") : ?>
          <div class="b-cta-wrapper c-prev-next-btns__button c-prev-next-btns__button--mobile">

            <a href="<?php echo site_url('conference') ?>" class="b-cta b-cta--<?php echo $location ?>"> Conference Agenda </a>

          </div>
          <div class="b-cta-wrapper c-prev-next-btns__button c-prev-next-btns__button--desktop">
            <a class="b-cta b-cta--<?php echo $location ?>" href="<?php echo site_url('conference') ?>"> Back to Conference Agenda </a>
          </div>
        <?php endif ?>



        <?php if (isset($nextID)) : ?>
          <div class="b-cta-wrapper c-prev-next-btns__button c-prev-next-btns__button--mobile">

            <a href="<?= get_the_permalink($nextID) ?>" class="b-cta b-cta--<?php echo $location ?>" rel="next"> Next</a>

          </div>

          <div class="b-cta-wrapper c-prev-next-btns__button c-prev-next-btns__button--desktop">
            <a href="<?= get_the_permalink($nextID) ?>" class="b-cta b-cta--<?php echo $location ?>" rel="next"> Next Session </a>
          </div>
        <?php endif; ?>


      <?php endif ?>



    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>
</div>
