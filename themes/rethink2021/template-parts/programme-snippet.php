<?php
$the_queryDayOne = new WP_Query(array(
    'post_type' => 'session',
    'meta_key' => 'time_start',
    'order' => 'ASC',
    'orderby' => 'meta_value',

    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'location',
            'value' => $args['data']['location_value'],
        ),
        array(
            'key' => 'day',
            'value' => 'day1',
        ),
    ),
)
);

$the_queryDayTwo = new WP_Query(array(
    'post_type' => 'session',
    'meta_key' => 'time_start',
    'order' => 'ASC',
    'orderby' => 'meta_value',

    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'location',
            'value' => $args['data']['location_value'],
        ),
        array(
            'key' => 'day',
            'value' => 'day2',
        ),
    ),
)
);
?>

<?php if (is_admin()) {
    echo '<p class="b-snippet-hint"> <code >hint: this is the ' . $args["data"]["title"] . ' programme SNIPPPETS block</code></p>';
}
?>
<div class="b-snippet-wrapper  b-snippet-wrapper--<?php echo $args['data']['location_value'] ?>">

    <?php if ($the_queryDayOne->have_posts()): ?>

    <div class="b-snippet">
        <h4>Day 1 - 05 Oct 2021</h4>
        <?php while ($the_queryDayOne->have_posts()): $the_queryDayOne->the_post();?>
        <?php $post_id = get_the_ID();?>

        <p><?php the_field('time_start', $post_id)?> : <?php the_title();?></p>

        <?php endwhile;?>

        <?php wp_reset_postdata();?>
    </div>
    <?php endif;?>
</div>





<?php if ($the_queryDayTwo->have_posts()): ?>


<div class="b-snippet-wrapper  b-snippet-wrapper--<?php echo $args['data']['location_value'] ?>">


    <div class="b-snippet">
        <h4>Day 2 - 06 Oct 2021</h4>
        <?php while ($the_queryDayTwo->have_posts()): $the_queryDayTwo->the_post();?>
        <?php $post_id = get_the_ID();?>

        <p><?php the_field('time_start', $post_id)?> : <?php the_title();?></p>

        <?php endwhile;?>

        <?php wp_reset_postdata();?>
    </div>


</div>

<?php endif;?>