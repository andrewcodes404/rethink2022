<?php
$picked_post_type = get_field('picked_post_type');
$picked_year = get_field('picked_year');

if ($picked_post_type === "advisory-com") {

  $picked_post_type = "speaker-items";

  $args = array(

    'numberposts' => -1,
    'post_type'    => $picked_post_type,
    'meta_query' => array(
      'relation' => 'AND',

      array(
        'key'     => 'adv_com',
        'value'   => '1'
      ),
      array(
        'key'     => 'year',
        'value'   => $picked_year,
        'compare' => 'LIKE'
      ),
      array(
        'key' => 'carousel',
        'value' => '1',
      ),
    )
  );
} else {

  $args = array(
    'numberposts' => -1,
    'post_type'    => $picked_post_type,
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key'     => 'year',
        'value'   => $picked_year,
        'compare' => 'LIKE'
      ),
      array(
        'key' => 'carousel',
        'value' => '1',
      ),
    )
  );
}


// query
$the_query = new WP_Query($args);
?>

<?php if ($the_query->have_posts()) : ?>

  <div class="b-carousel-wrapper">
    <div class="b-carousel b-carousel--speakers">

      <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <?php $post_id = get_the_ID(); ?>
        <div class="b-carousel-item">

          <div class="b-carousel-item__img">
            <?php
            $image = get_field('image', $post_id);
            $size = 'carousel';
            if ($image) {
              echo wp_get_attachment_image($image, $size);
            }
            ?>
          </div>

          <?php if ($picked_post_type === "speaker-items") : ?>
            <div class="b-carousel-item__text">
              <p><?php echo get_the_title(); ?></p>
              <p><?php the_field('position', $post_id); ?></p>
              <p><?php the_field('company', $post_id); ?></p>
            </div>
          <?php endif ?>
        </div>

      <?php endwhile; ?>
    </div>
  </div>
<?php endif; ?>

<?php wp_reset_query();   // Restore global post data stomped by the_post().
?>
