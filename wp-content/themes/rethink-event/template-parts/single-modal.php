<?php $post_id = $args['post_id'];
 $post_type = get_post_type($post_id);
 $image = get_field('image', $post_id);
 $companyLogo = get_field('company_logo', $post_id);
 $title = get_the_title($post_id);
 $booth = get_field('booth', $post_id);
 $website = get_field('website', $post_id);
 $linkedin = get_field('linkedin', $post_id);
 $facebook = get_field('facebook', $post_id);
 $twitter = get_field('twitter', $post_id);
 $instagram = get_field('instagram', $post_id);
 $description = get_field("description", $post_id);
 $bio = get_field("bio", $post_id);
 $position = get_field("position", $post_id);
 $works_for_a_assoc_company = get_field("works_for_a_company",  $post_id);
 $assoc_company = get_field("sponsor_partner_company", $post_id);
 $company = get_field("company", $post_id);

 $company_text = "";
 if ($company) {
   $company_text = $company;
 }

 if ($works_for_a_assoc_company ) {
   foreach ($assoc_company as $value) {
     $company_text =  $value->post_title;
     $companyLogo = get_field('image', $value->ID);
   }
 }
?>



<?php $allow_pop_up = isset($args['allow_pop_up']) ? $args['allow_pop_up'] : ''; ?>

<!-- only show modal if $allow_pop_up true -->
<?php if ($allow_pop_up) : ?>
  <div class="t-modal-wrapper ">
    <div class="t-modal t-modal--<?php echo $post_type ?>">

      <div class="t-modal__close-btn">
        <div class="t-modal__close-btn__svg">
          <?php echo file_get_contents(get_template_directory() . '/images/svg/close2.svg'); ?>
        </div>
      </div>


      <div class="t-modal__top">

        <div class="t-modal__bg">
          <img src="<?php echo get_template_directory_uri(); ?>/images/jpg/modal-bg--<?php echo $post_type ?>.jpg" alt="">
        </div>


        <div class="t-modal__logo">
          <?php echo wp_get_attachment_image($image, 'medium'); ?>
          <div class="t-modal__logo__outline"></div>
          <div class="t-modal__logo__outline t-modal__logo__outline--2"></div>
          <!-- company icon for speakers only -->
          <?php if ($companyLogo) : ?>
            <div class="t-modal__logo__company">
              <?php echo wp_get_attachment_image($companyLogo, 'medium'); ?>
            </div>
          <?php endif; ?>


        </div>

        <div class="t-modal__top__right">
          <div class="t-modal__titles-info">
            <div class="t-modal__title">
              <p class=""><?php echo $title ?>
            </div>

            <?php if ($position) : ?> <p class="t-modal__position"> <?php echo $position ?> </p> <?php endif ?>
            <?php if ($company_text) : ?> <p class="t-modal__company"> <?php echo $company_text ?></p> <?php endif ?>
          </div>


          <div class="t-modal__socials">
            <?php if ($website) : ?>

              <a class="t-modal__social" href="<?php echo $website ?>" target="_blank" rel="noopener noreferrer">
                <?php echo file_get_contents(get_template_directory() . '/images/svg/modal-website.svg'); ?>
              </a>

            <?php endif; ?>

            <?php if ($linkedin) : ?>

              <a class="t-modal__social" href="<?php echo $linkedin; ?>" target="_blank" rel="noopener noreferrer">
                <?php echo file_get_contents(get_template_directory() . '/images/svg/modal-linkedin.svg'); ?>
              </a>

            <?php endif; ?>

            <?php if ($facebook) : ?>

              <a class="t-modal__social" href="<?php echo $facebook; ?>" target="_blank" rel="noopener noreferrer">
                <?php echo file_get_contents(get_template_directory() . '/images/svg/modal-facebook.svg'); ?>
              </a>

            <?php endif; ?>

            <?php if ($twitter) : ?>

              <a class="t-modal__social" href="<?php echo $twitter; ?>" target="_blank" rel="noopener noreferrer">
                <?php echo file_get_contents(get_template_directory() . '/images/svg/modal-twitter.svg'); ?>
              </a>

            <?php endif; ?>

            <?php if ($instagram) : ?>

              <a class="t-modal__social" href="<?php echo $instagram; ?>" target="_blank" rel="noopener noreferrer">
                <?php echo file_get_contents(get_template_directory() . '/images/svg/modal-instagram.svg'); ?>
              </a>

            <?php endif; ?>
          </div>
          <?php if ($booth) : ?>
            <p class="t-modal__logo__booth"> Booth <?php echo $booth ?></p>
          <?php endif ?>
        </div>
      </div>

      <div class="t-modal__bottom">


        <?php if ($description) : ?>
          <div class="t-modal__desc">
            <?php echo $description ?>
          </div>
        <?php endif ?>

        <?php if ($bio) : ?>
          <div class="t-modal__desc">
            <?php echo $bio ?>
          </div>
        <?php endif ?>





        <?php get_template_part('template-parts/assoc-speakers', 'assoc-speakers', array('post_id' => $post_id, 'allow_pop_up' => false, 'post_type' => $post_type)) ?>

        <!--only show session links on speker pop-ups -->
        <?php if($post_type === "speaker-items"): ?>
          <?php get_template_part('template-parts/session-links', 'session-links', array('post_id' => $post_id)) ?>
        <?php endif ?>



      </div>
    </div>
  </div>


<?php endif ?>
