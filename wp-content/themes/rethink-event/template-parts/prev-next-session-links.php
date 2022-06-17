<?php

$location = $args['location'];
$day = $args['day'];

$location_text = $args['location_text'];
$time_start = $args['time_start'];
$post_id = $args['post_id'];
$post_id_prev = $post_id - 1;
$post_id_next = $post_id + 1;
$the_query = new WP_Query(
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

  <?php if ($the_query->have_posts()) : ?>
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
      <?php $loop_post_id = get_the_ID(); ?>

      <?php if ($loop_post_id === $post_id_prev) : ?>
        <div class="b-cta b-cta--green c-prev-next-btns__prev">
          <a href="<?php echo get_permalink() ?>"> Prev Session </a>
        </div>
      <?php endif ?>

      <?php if ($loop_post_id === $post_id_next) : ?>
        <div class="b-cta b-cta--green c-prev-next-btns__next">
          <a href="<?php echo get_permalink() ?>"> Next Session </a>
        </div>
      <?php endif ?>


    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>
</div>
