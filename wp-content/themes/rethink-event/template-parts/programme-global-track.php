<?php

use function Sodium\compare;

$location = $args['location'];
$day = $args['day'];
$index = $args['index'];
$color = $args['color'];
$location_text = $args['location_text'];

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
      array(
        'key' => 'time_start',
        'value' => "10:59",
        'type' => 'NUMERIC',
        'compare' => ">"
      ),

    ),
  )
);

?>




<?php if ($the_query->have_posts()) : ?>

  <div class="pro-global-tracks-mobile">
    <div class="pro-global-tracks-title pro-global-tracks-title--<?php echo $location ?>">
      <span> <?php echo $location_text ?> </span> <span class="pro-global-tracks-title__arrow">&darr;</span>
    </div>

    <div class="pro-global-track-wrapper">
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

        <div class="pro-global__session pro-global__session--<?php echo $index ?>" style="grid-column: track-<?php echo $index ?>;
    grid-row: time-<?php echo $start ?> / time-<?php echo $end ?>;
background-color: <?php echo $color ?>;
    ">

          <h3 class="pro-global__session-title"><a href="<?php echo get_permalink($post_id); ?> " target="_blank"><?php the_title() ?></a></h3>
          <span class=" pro-global__session-time"><?php the_field('time_start', $post_id) ?> - <?php the_field('time_end', $post_id) ?></span>

        </div>
      <?php endwhile; ?>
    </div>


  </div>

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

    <div class="pro-global-tracks-desktop  pro-global__session pro-global__session--<?php echo $index ?> " style="grid-column: track-<?php echo $index ?>;
    grid-row: time-<?php echo $start ?> / time-<?php echo $end ?>;
background-color: <?php echo $color ?>;
    ">

      <h3 class="pro-global__session-title"><a href="<?php echo get_permalink($post_id); ?>" target="_blank"><?php the_title() ?></a></h3>
      <span class="pro-global__session-time"><?php the_field('time_start', $post_id) ?> - <?php the_field('time_end', $post_id) ?></span>

    </div>

  <?php endwhile; ?>

  <?php wp_reset_postdata(); ?>

<?php endif; ?>
