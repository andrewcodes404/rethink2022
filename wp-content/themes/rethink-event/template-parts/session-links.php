<?php
$post_id = $args['post_id'];
$post_type = get_post_type($post_id);
$day1sessions = [];
$day2sessions = [];
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

<?php if ($sessions) : ?>
    <div class="t-session-links">

        <?php if ($post_type === 'speaker-items') : ?>
            <h3>Speaking at:</h3>
        <?php elseif ($post_type === 'partner-items') : ?>
            <h3>Supporting:</h3>
        <?php elseif ($post_type === 'sponsor-items') : ?>
            <h3>Sponsoring:</h3>
        <?php endif ?>


        <?php foreach ($sessions as $session) : ?>

            <?php $day = get_field('day', $session->ID); ?>

            <!-- split sessions into two arrays day1/day2 -->
            <?php
            if ($day === 'day1') {
                array_push($day1sessions, $session);
            } elseif ($day === 'day2') {

                array_push($day2sessions, $session);
            }
            ?>
        <?php endforeach; ?>
        <!-- loop through day 1 sessions -->
        <?php if ($day1sessions) : ?>
            <h4>Day 1</h4>
        <?php endif ?>

        <?php foreach ($day1sessions as $session) : ?>
            <a class="t-session-link" href="<?php echo get_permalink($session->ID); ?>">
                <?php echo $session->post_title ?>
            </a>
        <?php endforeach; ?>

        <!-- loop through day 2 sessions -->
        <?php if ($day2sessions) : ?>
            <h4>Day 2</h4>
        <?php endif ?>
        <?php foreach ($day2sessions as $session) : ?>
            <a class="t-session-link" href="<?php echo get_permalink($session->ID); ?>">
                <?php echo $session->post_title ?>
            </a> <br>
        <?php endforeach; ?>

    </div>
<?php endif; ?>
