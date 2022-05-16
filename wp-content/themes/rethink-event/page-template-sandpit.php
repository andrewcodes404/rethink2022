<?php
/*
Template Name: Sandpit
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php $post_id = get_the_ID(); ?>

    <?php get_template_part('template-parts/hero', 'hero', array('post_id' => $post_id)) ?>




    <div class="pro-global-page-wrapper">


      <div class="pro-global">

        <div class="pro-global__buttons">
          <button class="pro-global__button pro-global__button--day1 pro-global__button--active">Day 1 - Weds 5th Oct</button>
          <button class="pro-global__button pro-global__button--day2">Day 2 - Thur 6th Oct </button>
        </div>


        <div class="pro-global__day1 pro-global__day1--show">
          <div class="pro-global__schedule" aria-labelledby="schedule-heading">


            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-1; grid-row: tracks;">Sustainable Transformation Theatre</span>
            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-2; grid-row: tracks;">BEC Sustainable Business Theatre</span>
            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-3; grid-row: tracks;">Sustainable Partnerships Theatre</span>
            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-4; grid-row: tracks;">Sustainable Resources Theatre</span>
            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-5; grid-row: tracks;">Sustainable Communities Theatre</span>
            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-6; grid-row: tracks;">Change Makers Stage</span>
            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-7; grid-row: tracks;">Future Leaders Stage</span>

            <!-- <h2 class="pro-global__time-slot" style="grid-row: time-0900;">09:00am</h2> -->
            <h2 class="pro-global__time-slot" style="grid-row: time-0930;">09:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1000;">10:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1030;">10:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1100;">11:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1130;">11:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1200;">12:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1230;">12:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1300;">13:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1330;">13:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1400;">14:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1430;">14:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1500;">15:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1530;">15:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1600;">16:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1630;">16:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1700;">17:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1730;">17:30</h2>




            <div class="pro-global__session" style="grid-column: track-1-start / track-7-end; grid-row: time-0915 / time-0940; background-color:#f7f7f7;">
              <h3 class="pro-global__session-title pro-global__session-title--black"><a href="#">Opening Welcome</a></h3>
              <span class="session-time">09:15 - 0940</span>
            </div>

            <div class="pro-global__session" style="grid-column: track-1-start / track-7-end; grid-row: time-0940 / time-0950; background-color: #f7f7f7;">
              <h3 class="pro-global__session-title pro-global__session-title--black"><a href="#">Opening Welcome</a></h3>
              <span class="session-time">09:40 - 0950</span>
            </div>

            <div class="pro-global__session" style="grid-column: track-1-start / track-7-end; grid-row: time-1000 / time-1100; background-color: #f7f7f7;">
              <h3 class="pro-global__session-title pro-global__session-title--black"><a href="#"> From Ambition to Action: Hong Kong’s Race Towards a Net-Zero Future</a></h3>
              <span class="session-time">10:00 - 11:00</span>
            </div>

            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Transformation Theatre', 'location' => "susTrans", 'day' => "day1", 'index' => "1", 'color' => '#20a056')) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'BEC Sustainable Business Theatre', 'location' => "bec", 'day' => "day1", 'index' => "2", 'color' => '#cdda60')) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Partnerships Theatre', 'location' => "susPart", 'day' => "day1", 'index' => "3", 'color' => '#1fbbee')) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Resources Theatre', 'location' => "susRes", 'day' => "day1", 'index' => "4", 'color' => '#e5593f')) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Communities Theatre', 'location' => "susCom", 'day' => "day1", 'index' => "5", 'color' => '#edb71a')) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Change Makers Stage', 'location' => "change", 'day' => "day1", 'index' => "6", 'color' => '#e97193')) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Future Leaders Stage', 'location' => "futureLeaders", 'day' => "day1", 'index' => "7", 'color' => '#8d5da7')) ?>


          </div>
        </div>

        <div class="pro-global__day2">
          <div class="pro-global__schedule" aria-labelledby="schedule-heading">


            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-1; grid-row: tracks;">Sustainable Transformation Theatre</span>
            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-2; grid-row: tracks;">BEC Sustainable Business Theatre</span>
            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-3; grid-row: tracks;">Sustainable Partnerships Theatre</span>
            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-4; grid-row: tracks;">Sustainable Resources Theatre</span>
            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-5; grid-row: tracks;">Sustainable Communities Theatre</span>
            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-6; grid-row: tracks;">Change Makers Stage</span>
            <span class="pro-global__track-slot" aria-hidden="true" style="grid-column: track-7; grid-row: tracks;">Future Leaders Stage</span>

            <!-- <h2 class="pro-global__time-slot" style="grid-row: time-0900;">09:00am</h2> -->
            <h2 class="pro-global__time-slot" style="grid-row: time-0930;">09:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1000;">10:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1030;">10:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1100;">11:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1130;">11:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1200;">12:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1230;">12:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1300;">13:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1330;">13:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1400;">14:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1430;">14:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1500;">15:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1530;">15:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1600;">16:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1630;">16:30</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1700;">17:00</h2>
            <h2 class="pro-global__time-slot" style="grid-row: time-1730;">17:30</h2>




            <div class="pro-global__session" style="grid-column: track-1-start / track-7-end; grid-row: time-0915 / time-0950; background-color:#f7f7f7;">
              <h3 class="pro-global__session-title pro-global__session-title--black"><a href="#">Opening Welcome for day2</a></h3>
              <span class="session-time">09:15 - 0950</span>
            </div>

            <div class="pro-global__session" style="grid-column: track-1-start / track-7-end; grid-row: time-0950 / time-1015; background-color: #f7f7f7;">
              <h3 class="pro-global__session-title pro-global__session-title--black"><a href="#">Opening Welcome</a></h3>
              <span class="session-time">09:50 - 1015</span>
            </div>

            <div class="pro-global__session" style="grid-column: track-1-start / track-7-end; grid-row: time-1015 / time-1100; background-color: #f7f7f7;">
              <h3 class="pro-global__session-title pro-global__session-title--black"><a href="#"> From Ambition to Action: Hong Kong’s Race Towards a Net-Zero Future</a></h3>
              <span class="session-time">10:15 - 11:00</span>
            </div>

            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Transformation Theatre', 'location' => "susTrans", 'day' => "day2", 'index' => "1", 'color' => '#20a056')) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'BEC Sustainable Business Theatre', 'location' => "bec", 'day' => "day2", 'index' => "2", 'color' => '#cdda60')) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Partnerships Theatre', 'location' => "susPart", 'day' => "day2", 'index' => "3", 'color' => '#1fbbee')) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Resources Theatre', 'location' => "susRes", 'day' => "day2", 'index' => "4", 'color' => '#e5593f')) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Communities Theatre', 'location' => "susCom", 'day' => "day2", 'index' => "5", 'color' => '#edb71a')) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Change Makers Stage', 'location' => "change", 'day' => "day2", 'index' => "6", 'color' => '#e97193')) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Future Leaders Stage', 'location' => "futureLeaders", 'day' => "day2", 'index' => "7", 'color' => '#8d5da7')) ?>


          </div>
        </div>

      </div>



      <div class="content-layout">
        <?php the_content(); ?>
      </div>

    </div>

  <?php endwhile;
else : ?>
  <div class="progrid__item-title"><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></div>
<?php endif; ?>
<?php get_footer(); ?>
