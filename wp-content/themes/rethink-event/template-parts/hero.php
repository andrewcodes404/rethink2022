<?php $post_id = $args['post_id']; ?>

<?php if (!get_field('show_custom_header')) : ?>
  <div class="t-hero-simple">
    <div class="content-layout">
      <h1><?php the_title() ?></h1>
    </div>
  </div>
<?php endif ?>

<?php if (get_field('show_custom_header')) : ?>

  <div class="t-hero <?php echo get_field('background_image') ? 't-hero--with-image' : "" ?>">

    <div class="t-hero__background  t-hero__background--<?php echo the_field('background_color', $post_id); ?>"></div>


    <div class="t-hero__background-image-mobile <?php echo get_field('dark_filter') ? 't-hero__background-image-mobile--darken' : "" ?>">
      <?php
      $image = get_field('background_image_mobile');
      $size = 'full'; // (thumbnail, medium, large, full or custom size)
      if ($image) {
        echo wp_get_attachment_image($image, $size);
      }
      ?>
    </div>


    <div class="t-hero__background-image <?php echo get_field('dark_filter') ? 't-hero__background-image--darken' : "" ?>">
      <?php
      $image = get_field('background_image');
      $size = 'full'; // (thumbnail, medium, large, full or custom size)
      if ($image) {
        echo wp_get_attachment_image($image, $size);
      }
      ?>
    </div>

    <?php if(get_field('caption', $post_id)): ?>
    <div class="t-hero__caption">
      <span><?php the_field('caption', $post_id); ?> </span>
    </div>
    <?php endif ?>

    <div class="content-layout content-layout--wide">
      <!-- check if title is from ACF or post -->
      <div class="t-hero__text t-hero__text--<?php echo the_field('text_color', $post_id); ?>">

        <?php if (get_field('title', $post_id)) : ?>
          <h1><?php the_field('title', $post_id); ?></h1>
        <?php else : ?>
          <h1><?php the_title(); ?></h1>
        <?php endif; ?>

        <?php if (get_field('subtitle', $post_id)) : ?>
          <h3><?php the_field('subtitle', $post_id); ?></h3>
        <?php endif ?>

        <?php if (get_field('cta', $post_id)) : ?>
          <?php get_template_part('template-parts/link', 'link', array('post_id' => $post_id)) ?>
        <?php endif ?>


        </div>
    </div>

  </div>

<?php endif ?>
