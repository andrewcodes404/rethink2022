<?php
$post_id = $args['post_id'];
$sessionUrl = get_permalink();
$subtitle = get_field('subtitle', $post_id);
$overview = get_field('overview', $post_id);
$learnings = get_field('learnings', $post_id);
$moderators = get_field('moderators', $post_id);
$post_event_actions = get_field('post_event_actions', $post_id);
$category = get_field('category', $post_id);
$sdg = get_field('sdg', $post_id);

$category = get_field('category', $post_id);
$category_text = "";

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
$content = false;

if ($subtitle || $speakers || $partners || $sponsors || $learnings || $postevent) {
    $content = true;
}
?>

<div class="b-programme__session">

    <div class="b-programme__session__top-bar">

        <h3 class="b-programme__session__top-bar__time"><?php the_field('time_start', $post_id)?> -
            <?php the_field('time_end', $post_id)?></h3>
        <h3 class="b-programme__session__top-bar__title"><?php the_title();?></h3>

        <!-- /the chevron -->
        <div class="b-programme__session__top-bar__chevron-wrapper">
            <?php if ($content): ?>
            <div class="b-programme__session__top-bar__chevron">
                <span class="b-programme__session__top-bar__chevron__block1"></span>
                <span class="b-programme__session__top-bar__chevron__block2"></span>
            </div>
            <?php endif;?>
        </div>
    </div>

    <div class="b-programme__session__content">


        <?php if ($category): ?>
        <div class="b-programme__session__content__category">
            <p> <?php echo $category_text ?> </p>
        </div>
        <?php endif;?>




        <?php if ($overview): ?>
        <div class="b-programme__session__content__overview">
            <p> <?php echo $overview ?> </p>
        </div>
        <?php endif;?>




        <?php if ($sdg): ?>
        <?php get_template_part('template-parts/sdg', null, array('data' => $sdg))?>
        <?php endif;?>

        <?php if ($learnings): ?>
        <div class="b-programme__session__content__learnings">
            <h3>Learnings</h3>
            <p> <?php echo $learnings ?> </p>
        </div>
        <?php endif;?>

        <?php if ($post_event_actions): ?>
        <div class="b-programme__session__content__actions">
            <h3>Post-Event Actions</h3>
            <p> <?php echo $post_event_actions ?> </p>
        </div>
        <?php endif;?>


        <?php if ($speakers): ?>
        <div class="b-programme__session__content__speakers ">
            <h3>Speakers</h3>
            <?php get_template_part('template-parts/speakers', null, array('data' => $speakers))?>
        </div>
        <?php endif;?>


        <?php if ($partners): ?>
        <h3>Supported by</h3>
        <?php get_template_part('template-parts/partners', null, array('data' => $partners))?>
        <?php endif;?>


        <?php if ($sponsors): ?>
        <h3>Sponsored by</h3>
        <?php get_template_part('template-parts/sponsors', null, array('data' => $sponsors))?>
        <?php endif;?>

    </div>

</div>