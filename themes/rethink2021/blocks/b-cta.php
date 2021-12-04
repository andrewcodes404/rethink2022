<div class="b-cta-wrapper">
  <div class="b-cta b-cta--<?php the_field('color') ?>">


    <?php if( get_field('external_link') ): ?>
    <a href="<?php the_field('external_link') ?>" target="_blank">
      <?php endif; ?>


      <?php if( get_field('internal_link') ): ?>
      <a href="<?php the_field('internal_link') ?>">
        <?php endif; ?>

        <?php if( get_field('download') ): ?>
        <a href="<?php the_field('download') ?>" target="_blank">
          <?php endif; ?>

          <p><?php the_field('text') ?> </p>
        </a>


  </div>
</div>