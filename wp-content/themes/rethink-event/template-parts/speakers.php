<?php $speakers = $args['data'] ?>

<div class="t-speakers">
  <?php foreach ($speakers as $speaker) : ?>

    <?php $post_id = $speaker->ID; ?>

    <?php $link = get_permalink($speaker->ID); ?>
    <?php $image = get_field('image', $post_id); ?>
    <?php $moderator = $speaker->moderator ?>

    <div class="t-speaker t-speaker--hover t-modal-parent <?php echo $moderator ? 't-speaker--moderator' : '' ?>  ">

      <div class="t-speaker__img">
        <?php if ($image) : ?>
          <?php echo wp_get_attachment_image($image, 'medium'); ?>
        <?php endif; ?>
      </div>

      <div class="t-speaker__text">
        <?php if ($moderator) : ?>
          <p class="t-speaker__text__mod"> MODERATOR</p>
        <?php endif ?>

        <p class="t-speaker__text__title">
          <?php echo get_the_title($speaker->ID); ?>
        </p>

        <p class="t-speaker__text__position"> <?php echo get_field('position', $speaker->ID); ?></p>

        <?php

        $company = get_field("company", $speaker->ID);
        $works_for_a_assoc_company = get_field("works_for_a_company", $speaker->ID);
        $assoc_company = get_field("sponsor_partner_company",  $speaker->ID);

        $company_text = "";
        if ($company) {
          $company_text = $company;
        }

        if ($assoc_company) {
          foreach ($assoc_company as $value) {
            $company_text =  $value->post_title;
          }
        }
        ?>


        <p class="t-speaker__text__company"> <?php echo $company_text ?></p>
      </div>

    </div>

    <?php get_template_part('template-parts/single-modal', null, array('post_id' => $post_id, 'allow_pop_up' => true)) ?>

  <?php endforeach; ?>
</div>
