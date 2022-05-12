<?php
/*
Template Name: Sandpit
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php $post_id = get_the_ID(); ?>

    <?php get_template_part('template-parts/hero', 'hero', array('post_id' => $post_id)) ?>

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
        <span class="track-slot" aria-hidden="true" style="grid-column: track-5; grid-row: tracks;">Track 5</span>
        <span class="track-slot" aria-hidden="true" style="grid-column: track-6; grid-row: tracks;">Track 6</span>
        <span class="track-slot" aria-hidden="true" style="grid-column: track-7; grid-row: tracks;">Track 7</span>

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



        <!-- susTrans : Sustainable Transformation Theatre
bec : BEC Sustainable Business Theatre
susPart : Sustainable Partnerships Theatre
susRes : Sustainable Resources Theatre
susCom : Sustainable Communities Theatre
change : Change Makers Stage
futureLeaders : Future Leaders Stage -->



        <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location' => "susTrans", 'day' => "day1", 'index' => "1", 'color' => '#20a056')) ?>
        <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location' => "bec", 'day' => "day1", 'index' => "2", 'color' => '#cdda60')) ?>
        <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location' => "susPart", 'day' => "day1", 'index' => "3", 'color' => '#1fbbee')) ?>
        <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location' => "susRes", 'day' => "day1", 'index' => "4", 'color' => '#e5593f')) ?>
        <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location' => "susCom", 'day' => "day1", 'index' => "5", 'color' => '#edb71a')) ?>
        <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location' => "change", 'day' => "day1", 'index' => "6", 'color' => '#e97193')) ?>
        <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location' => "futureLeaders", 'day' => "day1", 'index' => "7", 'color' => '#8d5da7')) ?>














      </div>

    </div>



    <div class="content-layout">
      <?php the_content(); ?>
    </div>



  <?php endwhile;
else : ?>
  <div class="progrid__item-title"><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></div>
<?php endif; ?>
<?php get_footer(); ?>
