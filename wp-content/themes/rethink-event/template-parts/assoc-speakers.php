<?php
$post_id = $args['post_id'];
$post_type = get_post_type($post_id);
$speakers = get_posts(array(
  'post_type' => 'speaker-items',
  'meta_query' => array(
    'relation' => 'OR',
    array(
      'key' => 'sponsor_partner_company',
      'value' => '"' . $post_id . '"',
      'compare' => 'LIKE',
    )
  ),
));
?>

<?php if ($speakers) : ?>
  <?php if ($speakers) : ?>

            <h3>Meet our speakers:</h3>
            <?php get_template_part('template-parts/speakers', 'speakers', array('data' => $speakers)) ?>

        <?php endif; ?>

<?php endif; ?>
