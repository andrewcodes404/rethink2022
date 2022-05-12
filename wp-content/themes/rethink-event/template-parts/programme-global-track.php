<?php

$location = $args['location'];
$day = $args['day'];
$index = $args['index'];
$color = $args['color'];
$the_query = new WP_Query(
  array(
    'post_type' => 'session',
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




<?php if ($the_query->have_posts()) : ?>

  <?php $i = 0;
  while ($the_query->have_posts()) : $the_query->the_post(); ?>
    <?php
    $i++;
    $post_id = get_the_ID();
    $time_start = get_field('time_start', $post_id);
    $time_end = get_field('time_end', $post_id);
    $start = str_replace(':', '', $time_start);
    $end = str_replace(':', '', $time_end);
    ?>

    <div class="session session-<?php echo $index ?> track-<?php echo $index ?>" style="grid-column: track-<?php echo $index ?>;
    grid-row: time-<?php echo $start ?> / time-<?php echo $end ?>;
background-color: <?php echo $color ?>;
    ">

      <h3 class="session-title"><a href="#"><?php the_title() ?></a></h3>
      <span class="session-time"><?php the_field('time_start', $post_id) ?> - <?php the_field('time_end', $post_id) ?></span>

    </div>

  <?php endwhile; ?>

  <?php wp_reset_postdata(); ?>

<?php endif; ?>
