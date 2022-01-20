<?php
$post_id = $args['post_id'];
$post_type = get_post_type($post_id);
$sessions = get_posts(array(
    'post_type' => 'session',
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key' => 'speakers',
            'value' => '"' . $post_id . '"',
            'compare' => 'LIKE',
        ),
        array(
            'key' => 'moderators',
            'value' => '"' . $post_id . '"',
            'compare' => 'LIKE',
        ),
        array(
            'key' => 'partners',
            'value' => '"' . $post_id . '"',
            'compare' => 'LIKE',
        ),
        array(
            'key' => 'sponsors',
            'value' => '"' . $post_id . '"',
            'compare' => 'LIKE',
        ),
    ),
));
?>

<?php if ($sessions): ?>
<div class="t-session-links">

    <?php if ($post_type === 'speaker-items'): ?>
    <h3>Speaking at:</h3>
    <?php elseif ($post_type === 'partner-items'): ?>
    <h3>Supporting:</h3>
    <?php elseif ($post_type === 'sponsor-items'): ?>
    <h3>Sponsoring:</h3>
    <?php endif?>


    <!-- loop through and find day 1 sessions -->
    <h4>Day 1</h4>
    <?php foreach ($sessions as $session): ?>
    <?php $location = get_field('location', $session->ID);?>
    <?php $day = get_field('day', $session->ID);?>
    <?php if ($day === 'day1'): ?>
    <a class="t-session-link" href="<?php echo get_permalink($session->ID); ?>">
        <?php echo $session->post_title ?>
    </a>
    <?php endif?>
    <?php endforeach;?>

    <!-- loop through AGAIN and find day 2 sessions -->
    <h4>Day 2</h4>
    <?php foreach ($sessions as $session): ?>
    <?php $location = get_field('location', $session->ID);?>
    <?php $day = get_field('day', $session->ID);?>
    <?php if ($day === 'day2'): ?>
    <a class="t-session-link" href="<?php echo get_permalink($session->ID); ?>">
        <?php echo $session->post_title ?>
    </a>
    <?php endif?>
    <?php endforeach;?>


</div>
<?php endif;?>
