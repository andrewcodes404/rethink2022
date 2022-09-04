<?php
$location = $args['data']['location_value'];
$day = $args['data']['day'];
$daytext = "";
$show_title = $args['data']['show_title'];
$am_or_pm = "";
$am_or_pm = $args['data']['am_or_pm'];

if ($day === "day1") {
  $daytext = "Day 1 - Wednesday 05 Oct 2022";
} elseif ($day === "day2") {
  $daytext = "Day 2 - Thursday 06 Oct 2022";
}

if ($am_or_pm === "both" || null) {
  $the_query = new WP_Query(
    array(
      'post_type' => 'session-2022',
      'posts_per_page' => '-1',
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
} else {
  $the_query = new WP_Query(
    array(
      'post_type' => 'session-2022',
      'posts_per_page' => '-1',
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
          'key' => 'am_or_pm',
          'value' => $am_or_pm,
        ),

      ),
    )
  );
}

?>

<?php if (is_admin()) {
  echo '<p class="b-programme-hint"> <code >hint: this is the ' . $day . " - " . $location . " - " . $am_or_pm . ' PROGRAMME block</code></p>';
}
?>

<div class="programme-wrapper">
  <div class="programme b-layout">

    <div class="b-programme__day  b-programme__day--<?php echo $args['data']['location_value'] ?>">

      <?php if ($the_query->have_posts()) : ?>

        <?php if ($show_title) : ?>
          <h3> <?php echo $daytext ?> </h3>
        <?php endif ?>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
          <?php $post_id = get_the_ID(); ?>

          <?php $am_or_pm = get_field('am_or_pm', $post_id); ?>



          <?php get_template_part('template-parts/session', null, array('post_id' => $post_id)) ?>

        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>

      <?php endif; ?>


    </div>
  </div>
</div>
