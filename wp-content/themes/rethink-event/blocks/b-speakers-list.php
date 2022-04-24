<?php

$args = array(
  'post_type' => 'speaker-items',
  'post_status' => 'publish',
  'orderby' => 'wpse_last_word',
  'order' => 'ASC',
  'posts_per_page' => -1,
);

$the_query = new WP_Query($args); ?>

<?php if ($the_query->have_posts()) : ?>


  <div class="speakers-list-wrapper" id="speakers-list-wrapper">
    <div class="filters filters--day">
      <button class="day-filter filter-button filter-button--active" data-day="all">All</button>
      <button class="day-filter filter-button" data-day="day1">Day 1</button>
      <button class="day-filter filter-button" data-day="day2">Day 2</button>
    </div>

    <div class="filters filters--location">
      <button class="location-filter filter-button filter-button--active" data-location="all">All</button>
      <button class="location-filter filter-button" data-location="susTrans">Sustainable Transformation
        Theatre</button>
      <button class="location-filter filter-button" data-location="bec">BEC Sustainable Business Theatre</button>
      <button class="location-filter filter-button" data-location="susPart">Sustainable Partnerships
        Theatre</button>
      <button class="location-filter filter-button" data-location="susRes">Sustainable Resources
        Theatre</button>
      <button class="location-filter filter-button" data-location="susCom">Sustainable Communities
        Theatre</button>
      <button class="location-filter filter-button" data-location="change">Change Makers Stage</button>
      <button class="location-filter filter-button" data-location="futureLeaders">Future Leaders Stage</button>

    </div>



    <div class="b-speakers-list">


      <div class="t-speakers ">

        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
          <?php $post_id_speakers = get_the_ID(); ?>

          <?php
          $sessions = get_posts(array(
            'post_type' => 'session-2022',
            'meta_query' => array(
              'relation' => 'OR',
              array(
                'key' => 'speakers',
                'value' => '"' . $post_id_speakers . '"',
                'compare' => 'LIKE',
              ),
              array(
                'key' => 'moderators',
                'value' => '"' . $post_id_speakers . '"',
                'compare' => 'LIKE',
              ),
            ),
          ));
          ?>

          <?php if ($sessions) : ?>

            <?php $link = get_permalink(); ?>
            <?php $image = get_field('image', $post_id_speakers); ?>


            <div class="b-speakers-list__speaker t-speaker t-modal-parent">

              <div class="t-speaker__img">
                <?php if ($image) : ?>
                  <?php echo wp_get_attachment_image($image, 'medium'); ?>
                <?php endif; ?>
              </div>

              <div class="t-speaker__text">
                <p class="t-speaker__text__title">
                  <?php echo get_the_title(); ?>
                </p>
                <p class="t-speaker__text__position"> <?php echo get_field('position', $post_id_speakers); ?></p>
                <p class="t-speaker__text__company"> <?php echo get_field('company', $post_id_speakers); ?></p>
              </div>

              <!-- this is to just to pass data to the filters will not show on screen -->
              <ul class="sessionUl" style="display: none">
                <!-- <ul class="sessionUl"> -->
                <?php foreach ($sessions as $session) : ?>

                  <?php $location = get_field('location', $session->ID); ?>
                  <?php $day = get_field('day', $session->ID); ?>
                  <li class="<?php echo $location . " " . $day ?> sessionLi"> <?php echo $day ?>

                    <?php echo $location ?>
                    <?php echo $day ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>

            <?php get_template_part('template-parts/single-modal', null, array('post_id' => $post_id_speakers, 'allow_pop_up' => true)) ?>


          <?php endif; ?>

          <?php wp_reset_postdata(); ?>
        <?php endwhile; ?>



      </div>

    </div>
  </div>
<?php endif; ?>
