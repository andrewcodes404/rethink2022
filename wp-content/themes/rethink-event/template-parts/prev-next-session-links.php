<?php

use function Sodium\compare;

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
      // array(
      //   'key' => 'time_start',
      //   'value' => $time_start,
      //   // 'type' => 'NUMERIC',
      //   'compare' => "<"
      // ),

    ),
  )
);

?>




<?php echo $location ?> <br>
<?php echo $day ?><br>

<?php echo $location_text ?><br>
<?php echo $time_start ?><br>
<?php echo $post_id ?>


<?php if ($the_query->have_posts()) : ?>


  <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

    <?php $loop_post_id = get_the_ID(); ?>



    <?php if ($loop_post_id === $post_id_prev) : ?>
      <p>this is the prev <?php the_title() ?></p>
    <?php endif ?>

    <!-- <p> <?php echo $the_query->current_post; ?> - <?php echo $loop_post_id ?> <?php the_title() ?>
    </p> -->

    <?php if ($loop_post_id === $post_id_next) : ?>
      <p>this is the next <?php the_title() ?></p>
    <?php endif ?>

  <?php endwhile; ?>


  <?php wp_reset_postdata(); ?>

<?php endif; ?>
