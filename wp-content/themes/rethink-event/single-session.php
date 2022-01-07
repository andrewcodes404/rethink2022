<?php get_header();?>

<?php if (have_posts()): while (have_posts()): the_post();?>
<?php $post_id = get_the_ID();?>

<?php
        $overview = get_field('overview', $post_id);
        $moderators = get_field('moderators', $post_id);

        if ($moderators) {
            foreach ($moderators as $i => &$element) {
                $element->moderator = true;
            }
            $speakers_only = get_field('speakers', $post_id);
            $speakers = array_merge($moderators, $speakers_only);
        } else {
            $speakers = get_field('speakers', $post_id);
        }
        $partners = get_field('partners', $post_id);
        $sponsors = get_field('sponsors', $post_id);
        $learnings = get_field('learnings', $post_id);
        $postevent = get_field('post_event_actions', $post_id);
        $day = get_field('day', $post_id);
        $start = get_field('time_start', $post_id);
        $end = get_field('time_end', $post_id);
        $sdgs = get_field('sdg', $post_id);
        $category = get_field('category', $post_id);
        $location = get_field('location', $post_id);
        $homeUrl = site_url();
        $backUrl = '';

        if ($location == 'susTrans') {
            $backUrl = $homeUrl . '/sustainable-transformation/';
        } elseif ($location == 'bec') {
        $backUrl = $homeUrl . '/bec-theatre/';
    } elseif ($location == 'susPart') {
    $backUrl = $homeUrl . '';
} elseif ($location == 'susRes') {
    $backUrl = $homeUrl . '/sustainable-resources/';
} elseif ($location == 'susCom') {
    $backUrl = $homeUrl . '/sustainable-communities/';
} elseif ($location == 'change') {
    $backUrl = $homeUrl . '/change-makers/';
} elseif ($location == 'workshop1') {
    $backUrl = $homeUrl . '';
} elseif ($location == 'workshop2') {
    $backUrl = $homeUrl . '';
} elseif ($location == 'workshop3') {
    $backUrl = $homeUrl . '';
}

?>


<div class="content-layout">

    <div class="pg-single-session">
        <div class="pg-single-session__back-btn">
            <a href=" <?php echo $backUrl ?> "> &#8592; back to programme</a>
        </div>


        <h1> <?php the_title()?></h1>

        <h3> Day <?php echo ($day = 'day1') ? '1 - 5th Oct' : '2 - 6th Oct'; ?> | <?php echo $start ?> -
            <?php echo $end ?>
        </h3>


        <?php if ($sdgs): ?>
        <div class="pg-single-session__section ">
            <div class="pg-single-session__sdgs">
                <?php foreach ($sdgs as $sdg): ?>
                <div class="pg-single-session__sdg">
                    <img src="<?php echo get_template_directory_uri() . "/images/sdgs/" . $sdg . ".png" ?>" />
                </div>
                <?php endforeach;?>
            </div>
        </div>
        <?php endif?>


        <?php if ($speakers): ?>
        <div class="pg-single-session__section">
            <h3>Speakers</h3>
            <?php get_template_part('template-parts/speakers', 'speakers', array('data' => $speakers))?>
        </div>
        <?php endif;?>


        <?php if ($partners): ?>
        <div class="pg-single-session__section">
            <h3>Supported by</h3>
            <?php get_template_part('template-parts/partners', 'partners', array('data' => $partners))?>

        </div>
        <?php endif?>



        <?php if ($sponsors): ?>
        <div class="pg-single-session__section">
            <h3>Sponsored by</h3>
            <?php get_template_part('template-parts/sponsors', 'sponsors', array('data' => $sponsors))?>
        </div>
        <?php endif?>


        <?php if ($overview): ?>
        <div class="pg-single-session__section">
            <h3>Overview</h3>
            <?php echo $overview ?>
        </div>
        <?php endif?>


        <?php if ($learnings): ?>
        <div class="pg-single-session__section">
            <h3>Learnings</h3>
            <?php echo $learnings ?>
        </div>
        <?php endif?>


        <?php if ($postevent): ?>
        <div class="pg-single-session__section">
            <h3>Post Event Actions</h3>
            <?php echo $postevent ?>
        </div>
        <?php endif?>






    </div>
</div>
<?php endwhile;else: ?>
<p><?php esc_html_e('Sorry, no posts matched your criteria.');?></p>
<?php endif;?>
<?php get_footer();?>