<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php $post_id = get_the_ID(); ?>

    <?php
    $overview = get_field('overview', $post_id);
    $moderators = get_field('moderators', $post_id);
    $speakers_only = get_field('speakers', $post_id);

    // Add a new moderator field to the moderators.. you need this

    if ($moderators) {
      foreach ($moderators as $i => &$element) {
        $element->moderator = true;
      }
    }

    if (!empty($moderators) && !empty($speakers_only)) {
      $speakers = array_merge($moderators, $speakers_only);
    } elseif (!empty($moderators) && empty($speakers_only)) {
      $speakers = $moderators;
    } elseif (empty($moderators) && !empty($speakers_only)) {
      $speakers = $speakers_only;
    } else {
      $speakers = [];
    }

    $partners = get_field('partners', $post_id);
    $sponsors = get_field('sponsors', $post_id);
    $learnings = get_field('learnings', $post_id);
    $postevent = get_field('post_event_actions', $post_id);
    $day = get_field('day', $post_id);
    $start = get_field('time_start', $post_id);
    $end = get_field('time_end', $post_id);
    $sdgs = get_field('sdg', $post_id);
    $location = get_field('location', $post_id);
    $homeUrl = site_url();

    $category = get_field('category', $post_id);
    switch ($category) {
      case "cities":
        $category_text = "Cities & Mobility";
        break;
      case "decarb":
        $category_text = "Decarbonisation";
        break;
      case "cirEcon":
        $category_text = "Circular Economy";
        break;
      case "people":
        $category_text = "People & Purpose";
        break;
      case "redefine":
        $category_text = "Redefining Value";
        break;
      case "foodNature":
        $category_text = "Food & Nature";
        break;
    }


    $locationUrl = '';

    if ($location == 'susTrans') {
      $locationUrl = $homeUrl . '/programme/sustainable-transformation/';
      $locationText = "Sustainable Transformation Theatre (Keynote)";
    } elseif ($location == 'bec') {
      $locationUrl = $homeUrl . '/programme/bec-theatre/';
      $locationText = "BEC Sustainable Business Theatre";
    } elseif ($location == 'susPart') {
      $locationUrl = $homeUrl . '/programme/sustainable-partnerships';
      $locationText = "Sustainable Partnership Theatre";
    } elseif ($location == 'susRes') {
      $locationUrl = $homeUrl . '/programme/sustainable-resources/';
      $locationText = "Sustainable Resources Theatre";
    } elseif ($location == 'susCom') {
      $locationUrl = $homeUrl . '/programme/sustainable-communities/';
      $locationText = "Sustainable Communities Theatre";
    } elseif ($location == 'change') {
      $locationUrl = $homeUrl . '/programme/change-makers/';
      $locationText = "Change Makers Stage";
    } elseif ($location == 'workshop1') {
      $locationUrl = $homeUrl . '';
      $locationText = "Workshop 1";
    } elseif ($location == 'workshop2') {
      $locationUrl = $homeUrl . '';
      $locationText = "Workshop 2";
    } elseif ($location == 'workshop3') {
      $locationUrl = $homeUrl . '';
      $locationText = "Workshop 3";
    } elseif ($location == 'futureLeaders') {
      $locationUrl = $homeUrl . '/programme/future-leaders/';
      $locationText = "Future Leaders Stage";
    }

    $day_text = '1 - 5th Oct';
    if ($day === "day2") {
      $day_text = '2 - 6th Oct';
    }

    ?>

    <?php get_template_part('template-parts/hero', 'hero', array('post_id' => $post_id)) ?>
    <div class="content-layout">

      <div class="pg-single-session">

        <div class="pg-single-session__top-bar">

          <h4 class="pg-single-session__date-time"> Day <?php echo $day_text ?> | <?php echo $start ?> - <?php echo $end ?>
          </h4>
          <h4 class="pg-single-session__location">
            Location: <a class="pg-single-session__location-link pg-single-session__location-link--<?php echo $location ?>" href="<?php echo $locationUrl ?>"> <?php echo $locationText ?></a>
          </h4>
        </div>

        <?php if ($category) : ?>
          <div class="pg-single-session__category">
            <p> <?php echo $category_text ?> </p>
          </div>
        <?php endif; ?>

        <?php if ($overview) : ?>
          <div class="pg-single-session__section">
            <h3>Overview</h3>
            <?php echo $overview ?>
          </div>
        <?php endif ?>
        <?php if ($sdgs) : ?>
          <div class="pg-single-session__section ">
            <div class="pg-single-session__sdgs">
              <?php foreach ($sdgs as $sdg) : ?>
                <div class="pg-single-session__sdg">
                  <img src="<?php echo get_template_directory_uri() . "/images/sdgs/" . $sdg . ".png" ?>" />
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif ?>


        <?php if ($learnings) : ?>
          <div class="pg-single-session__section">
            <h3>Learnings</h3>
            <?php echo $learnings ?>
          </div>
        <?php endif ?>


        <?php if ($postevent) : ?>
          <div class="pg-single-session__section">
            <h3>Post Event Actions</h3>
            <?php echo $postevent ?>
          </div>
        <?php endif ?>

        <?php if ($speakers) : ?>
          <div class="pg-single-session__section">
            <h3>Speakers</h3>
            <?php get_template_part('template-parts/speakers', 'speakers', array('data' => $speakers)) ?>
          </div>
        <?php endif; ?>


        <?php if ($partners) : ?>
          <div class="pg-single-session__section">
            <h3>Supported by</h3>
            <?php get_template_part('template-parts/partners', 'partners', array('data' => $partners)) ?>

          </div>
        <?php endif ?>

        <?php if ($sponsors) : ?>
          <div class="pg-single-session__section">
            <h3>Sponsored by</h3>
            <?php get_template_part('template-parts/sponsors', 'sponsors', array('data' => $sponsors)) ?>
          </div>
        <?php endif ?>



        <?php get_template_part('template-parts/prev-next-session-links', 'pre-next-links', array('location_text' => 'Sustainable Transformation Theatre', 'location' => $location, 'day' => $day, "time_start" => $start, "time_end" => $end, "post_id" => $post_id)) ?>

        <div class="b-cta-wrapper">
          <div class="b-cta b-cta--green ?>">

            <a href="<?php echo site_url('conference') ?>"> Back to Conference Agenda </a>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile;
else : ?>
  <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
<?php get_footer(); ?>
