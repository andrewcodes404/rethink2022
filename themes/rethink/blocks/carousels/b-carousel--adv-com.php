<div class="b-carousel-wrapper b-carousel--adv-com">
  <div class="b-carousel">
    <?php
    $featured_posts = get_field('carousel_items');
    if( $featured_posts ): ?>

    <?php foreach( $featured_posts as $post ): 
        // Setup this post for WP functions (variable must be named $post).
        setup_postdata($post); ?>

    <div class="b-carousel-item">

      <div class="b-carousel-item__img">
        <?php 
          $image = get_field('image' , $post->ID);
          $size = 'carousel';
          if( $image ) {
              echo wp_get_attachment_image( $image, $size );
          }
          ?>
      </div>

      <div class="b-carousel-item__text">
        <p><?php echo get_the_title($post->ID); ?></p>
        <p><?php the_field( 'position' , $post->ID ); ?></p>
        <p><?php the_field( 'company' , $post->ID ); ?></p>
      </div>
    </div>

    <?php endforeach; ?>

    <?php 
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
    <?php endif; ?>

  </div>
</div>