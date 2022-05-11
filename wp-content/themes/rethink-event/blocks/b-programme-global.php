
<?php

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
        'value' => 'susTrans',
      ),
      array(
        'key' => 'day',
        'value' => 'day1',
      ),

    ),
  )
);


$the_query2 = new WP_Query(
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
        'value' => 'bec',
      ),
      array(
        'key' => 'day',
        'value' => 'day1',
      ),

    ),
  )
);

$the_query3 = new WP_Query(
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
        'value' => 'susPart',
      ),
      array(
        'key' => 'day',
        'value' => 'day1',
      ),

    ),
  )
);

?>





<div class="pro-global">


<div class="schedule" aria-labelledby="schedule-heading">

	<span class="track-slot" aria-hidden="true" style="grid-column: track-1; grid-row: tracks;">SusTrans</span>
	<span class="track-slot" aria-hidden="true" style="grid-column: track-2; grid-row: tracks;">BEC</span>
	<span class="track-slot" aria-hidden="true" style="grid-column: track-3; grid-row: tracks;">SusPart</span>
	<span class="track-slot" aria-hidden="true" style="grid-column: track-4; grid-row: tracks;">Track 4</span>

	<h2 class="time-slot" style="grid-row: time-0900;">09:00am</h2>
  <h2 class="time-slot" style="grid-row: time-0930;">09:30am</h2>
	<h2 class="time-slot" style="grid-row: time-1000;">10:00am</h2>
  <h2 class="time-slot" style="grid-row: time-1030;">10:30am</h2>
  <h2 class="time-slot" style="grid-row: time-1100;">11:00am</h2>
  <h2 class="time-slot" style="grid-row: time-1130;">11:30am</h2>
  <h2 class="time-slot" style="grid-row: time-1200;">12:00am</h2>
  <h2 class="time-slot" style="grid-row: time-1230;">12:30am</h2>

  <h2 class="time-slot" style="grid-row: time-1300;">13:00am</h2>
  <h2 class="time-slot" style="grid-row: time-1330;">13:30am</h2>

  <h2 class="time-slot" style="grid-row: time-1400;">14:00am</h2>
  <h2 class="time-slot" style="grid-row: time-1430;">14:30am</h2>

  <h2 class="time-slot" style="grid-row: time-1500;">15:00am</h2>
  <h2 class="time-slot" style="grid-row: time-1530;">15:30am</h2>

  <h2 class="time-slot" style="grid-row: time-1600;">16:00am</h2>
  <h2 class="time-slot" style="grid-row: time-1630;">16:30am</h2>


  <h2 class="time-slot" style="grid-row: time-1700;">17:00am</h2>
  <h2 class="time-slot" style="grid-row: time-1730;">17:30am</h2>



  <?php if ($the_query->have_posts()) : ?>




      <?php  $i = 0; while ($the_query->have_posts()) : $the_query->the_post(); ?>
      <?php
        $i++;
        $post_id = get_the_ID();
        $time_start = get_field('time_start', $post_id);
        $time_end = get_field('time_end', $post_id);
        $start = str_replace(':', '', $time_start);
        $end = str_replace(':', '', $time_end);
        ?>


	<div class="session session-1 track-1" style="grid-column: track-1; grid-row: time-<?php echo $start ?> / time-<?php echo $end ?>;">

    <h3 class="session-title"><a href="#"><?php the_title() ?></a></h3>
    <span class="session-time"><?php the_field('time_start', $post_id)?> - <?php the_field('time_end', $post_id)?></span>

	</div>

  <?php endwhile; ?>

  <?php wp_reset_postdata(); ?>

  <?php endif; ?>




  <?php if ($the_query2->have_posts()) : ?>

<?php  $i = 0; while ($the_query2->have_posts()) : $the_query2->the_post(); ?>
<?php
  $i++;
  $post_id = get_the_ID();
  $time_start = get_field('time_start', $post_id);
  $time_end = get_field('time_end', $post_id);
  $start = str_replace(':', '', $time_start);
  $end = str_replace(':', '', $time_end);
  ?>


<div class="session session-1 track-2" style="grid-column: track-2; grid-row: time-<?php echo $start ?> / time-<?php echo $end ?>;">

<h3 class="session-title"><a href="#"><?php the_title() ?></a></h3>
<span class="session-time"><?php the_field('time_start', $post_id)?> - <?php the_field('time_end', $post_id)?></span>

</div>

<?php endwhile; ?>

<?php wp_reset_postdata(); ?>

<?php endif; ?>






<?php if ($the_query3->have_posts()) : ?>

<?php  $i = 0; while ($the_query3->have_posts()) : $the_query3->the_post(); ?>
<?php
  $i++;
  $post_id = get_the_ID();
  $time_start = get_field('time_start', $post_id);
  $time_end = get_field('time_end', $post_id);
  $start = str_replace(':', '', $time_start);
  $end = str_replace(':', '', $time_end);
  ?>


<div class="session session-1 track-3" style="grid-column: track-3; grid-row: time-<?php echo $start ?> / time-<?php echo $end ?>;">

<h3 class="session-title"><a href="#"><?php the_title() ?></a></h3>
<span class="session-time"><?php the_field('time_start', $post_id)?> - <?php the_field('time_end', $post_id)?></span>

</div>

<?php endwhile; ?>

<?php wp_reset_postdata(); ?>

<?php endif; ?>

</div>

</div>

