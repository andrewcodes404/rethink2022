<?php $location = get_field('location')?>
<?php $day = get_field('day')?>
<?php $am_or_pm = get_field('am_or_pm')?>
<?php $show_title = get_field('show_title')?>

<?php get_template_part('template-parts/programme', null, array(
    'data' => array(
        'location_value' => $location,
        'day' => $day,
        'am_or_pm' => $am_or_pm,
        'show_title' => $show_title,
    )))?>