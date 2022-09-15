<?php
/*
Template Name: Conference
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php $post_id = get_the_ID(); ?>

    <?php get_template_part('template-parts/hero', 'hero', array('post_id' => $post_id)) ?>

    <div class="content-layout">

      <h3 class="has-black-color has-text-color">ReThink HK provides insight and inspiration for driving sustainable development across globally recognised risk and opportunity topics, from a Hong Kong context.</h3>


      <h3>Conference Diversity</h3>



      <p>ReThink HK believes in spreading the knowledge of leaders and experts across the many areas of sustainable business. We believe that greater understanding, collaboration and change are better facilitated by a variety of perspectives, and our goal is to create an inclusive, respectful conference environment that invites participation from people of all races, ethnicities, genders, ages, abilities, religions, and sexual orientation.</p>

      <p class="has-black-color has-text-color">ReThink HK is committed to striving for&nbsp;<em>no</em>&nbsp;‘manels’ (<em>no</em>&nbsp;all-male panels) and works closely with all those contributing to the programme to ensure a full spectrum of perspectives, opinions and experiences are represented across the programme.</p>
      <br>
      <br>
      <br>
      <br>
      <br>


      <h2 style="text-align:center">Conference Agenda</h2>
    </div>



    <div class="pro-global-page-wrapper">


      <div class="pro-global">

        <div class="pro-global__buttons">


          <div class="pro-global__button-wrapper pro-global__button-wrapper--day1 pro-global__button-wrapper--active">
            <h3>Day 1 - Weds 5th Oct</h3>
            <button class="pro-global__button"> Show Day 2 </button>
          </div>

          <div class="pro-global__button-wrapper pro-global__button-wrapper--day2">
            <h3>Day 2 - Thur 6th Oct </h3>
            <button class="pro-global__button ">Show Day1 </button>
          </div>


        </div>



        <div class="pro-global__day1 pro-global__day1--show">



          <div class="pro-global__schedule" aria-labelledby="schedule-heading">


            <a href="<?php echo site_url('/programme/sustainable-transformation') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--susTrans" aria-hidden="true" style="grid-column: track-1; grid-row: tracks;">Sustainable Transformation Theatre (Keynote)</a>

            <a href="<?php echo site_url('/programme/bec-theatre') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--bec" aria-hidden="true" style="grid-column: track-2; grid-row: tracks;">BEC Sustainable Business Theatre</a>

            <a href="<?php echo site_url('/programme/sustainable-partnerships') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--susPart" aria-hidden="true" style="grid-column: track-3; grid-row: tracks;">Sustainable Partnerships Theatre</a>


            <a href="<?php echo site_url('/programme/sustainable-resources') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--susRes" aria-hidden="true" style="grid-column: track-4; grid-row: tracks;">Sustainable Resources Theatre</a>


            <a href="<?php echo site_url('/programme/sustainable-communities') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--susCom" aria-hidden="true" style="grid-column: track-5; grid-row: tracks;">Sustainable Communities Theatre</a>


            <a href="<?php echo site_url('/programme/change-makers') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--change" aria-hidden="true" style="grid-column: track-6; grid-row: tracks;">Change Makers Stage</a>


            <a href="<?php echo site_url('/programme/future-leaders') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--futureLeaders" aria-hidden="true" style="grid-column: track-7; grid-row: tracks;">Future Leaders Stage</a>

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




            <div class="pro-global__session" style="grid-column: track-1-start / track-7-end; grid-row: time-0915 / time-0940; background-color:#20a056;">
              <h3 class="pro-global__session-title pro-global__session-title--green"><a href="<?php echo site_url('/programme/sessions2022/opening-welcome/') ?>" target="_blank">Opening Ceremony</a></h3>
              <span class="session-time">09:25 - 0950</span>
            </div>

            <div class="pro-global__session" style="grid-column: track-1-start / track-7-end; grid-row: time-0940 / time-1000; background-color: #20a056;">
              <h3 class="pro-global__session-title pro-global__session-title--green"><a href="<?php echo site_url('/programme/sessions2022/opening-address/') ?>" target="_blank">Opening Address</a></h3>
              <span class="session-time">09:50 - 10:00</span>
            </div>

            <div class="pro-global__session" style="grid-column: track-1-start / track-7-end; grid-row: time-1000 / time-1050; background-color: #20a056;">
              <h3 class="pro-global__session-title pro-global__session-title--green"><a href="<?php echo site_url('/programme/sessions2022/from-ambition-to-action-hong-kongs-race-towards-a-net-zero-future/') ?>" target="_blank">From Ambition to Action: Hong Kong's Race Towards a Net-Zero Future</a></h3>
              <span class="session-time">10:00 - 10:50</span>
            </div>

            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Transformation Theatre', 'location' => "susTrans", 'day' => "day1", 'index' => "1", 'color' => '#20a056', "time_start" => "10:59")) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'BEC Sustainable Business Theatre', 'location' => "bec", 'day' => "day1", 'index' => "2", 'color' => '#cdda60', "time_start" => "10:59")) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Partnerships Theatre', 'location' => "susPart", 'day' => "day1", 'index' => "3", 'color' => '#1fbbee', "time_start" => "10:59")) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Resources Theatre', 'location' => "susRes", 'day' => "day1", 'index' => "4", 'color' => '#e5593f', "time_start" => "10:59")) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Communities Theatre', 'location' => "susCom", 'day' => "day1", 'index' => "5", 'color' => '#edb71a', "time_start" => "10:59")) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Change Makers Stage', 'location' => "change", 'day' => "day1", 'index' => "6", 'color' => '#e97193', "time_start" => "10:59")) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Future Leaders Stage', 'location' => "futureLeaders", 'day' => "day1", 'index' => "7", 'color' => '#8d5da7', "time_start" => "10:59")) ?>


          </div>
        </div>

        <div class="pro-global__day2">


          <div class="pro-global__schedule" aria-labelledby="schedule-heading">
            <a href="<?php echo site_url('/programme/sustainable-transformation') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--susTrans" aria-hidden="true" style="grid-column: track-1; grid-row: tracks;">Sustainable Transformation Theatre (Keynote)</a>

            <a href="<?php echo site_url('/programme/bec-theatre') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--bec" aria-hidden="true" style="grid-column: track-2; grid-row: tracks;">BEC Sustainable Business Theatre</a>

            <a href="<?php echo site_url('/programme/sustainable-partnerships') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--susPart" aria-hidden="true" style="grid-column: track-3; grid-row: tracks;">Sustainable Partnerships Theatre</a>


            <a href="<?php echo site_url('/programme/sustainable-resources') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--susRes" aria-hidden="true" style="grid-column: track-4; grid-row: tracks;">Sustainable Resources Theatre</a>


            <a href="<?php echo site_url('/programme/sustainable-communities') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--susCom" aria-hidden="true" style="grid-column: track-5; grid-row: tracks;">Sustainable Communities Theatre</a>


            <a href="<?php echo site_url('/programme/change-makers') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--change" aria-hidden="true" style="grid-column: track-6; grid-row: tracks;">Change Makers Stage</a>


            <a href="<?php echo site_url('/programme/future-leaders') ?>" target="_blank" class="pro-global__track-slot pro-global__track-slot--futureLeaders" aria-hidden="true" style="grid-column: track-7; grid-row: tracks;">Future Leaders Stage</a>


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




            <div class="pro-global__session" style="grid-column: track-1-start / track-7-end; grid-row: time-0930 / time-0940; background-color:#20a056;">
              <h3 class="pro-global__session-title pro-global__session-title--green"><a href="<?php echo site_url('/programme/sessions2022/opening-welcome-the-sustainability-imperative-for-business-2/') ?>" target="_blank">Opening Welcome - livestreamed from Sustainable Transformation Theatre (Keynote) across all Theatres/Stages</a></h3>
              <span class="session-time">09:30 - 0940</span>
            </div>

            <div class="pro-global__session" style="grid-column: track-1-start / track-7-end; grid-row: time-0945 / time-1000; background-color: #20a056;">
              <h3 class="pro-global__session-title pro-global__session-title--green"><a href="<?php echo site_url('/programme/sessions2022/opening-address-net-positive/') ?>" target="_blank">
                  Opening Address: Net Positive</a></h3>
              <span class="session-time">09:45 - 10:00</span>
            </div>


            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Transformation Theatre', 'location' => "susTrans", 'day' => "day2", 'index' => "1", 'color' => '#20a056', "time_start" => "09:59")) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'BEC Sustainable Business Theatre', 'location' => "bec", 'day' => "day2", 'index' => "2", 'color' => '#cdda60', "time_start" => "09:59")) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Partnerships Theatre', 'location' => "susPart", 'day' => "day2", 'index' => "3", 'color' => '#1fbbee', "time_start" => "09:59")) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Resources Theatre', 'location' => "susRes", 'day' => "day2", 'index' => "4", 'color' => '#e5593f', "time_start" => "09:59")) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Sustainable Communities Theatre', 'location' => "susCom", 'day' => "day2", 'index' => "5", 'color' => '#edb71a', "time_start" => "09:59")) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Change Makers Stage', 'location' => "change", 'day' => "day2", 'index' => "6", 'color' => '#e97193', "time_start" => "09:59")) ?>
            <?php get_template_part('template-parts/programme-global-track', 'proglo', array('location_text' => 'Future Leaders Stage', 'location' => "futureLeaders", 'day' => "day2", 'index' => "7", 'color' => '#8d5da7', "time_start" => "09:59")) ?>


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
