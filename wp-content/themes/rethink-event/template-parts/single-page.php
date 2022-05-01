<?php $post_id = $args['post_id']?>
<?php $post_type = get_post_type($post_id);?>
<?php $image = get_field('image', $post_id);?>
<?php $companyLogo = get_field('company_logo', $post_id);?>
<?php $title = get_the_title($post_id)?>
<?php $booth = get_field('booth', $post_id)?>
<?php $website = get_field('website', $post_id)?>
<?php $linkedin = get_field('linkedin', $post_id)?>
<?php $facebook = get_field('facebook', $post_id)?>
<?php $twitter = get_field('twitter', $post_id)?>
<?php $instagram = get_field('instagram', $post_id)?>

<?php $description = get_field("description", $post_id)?>
<?php $bio = get_field("bio", $post_id)?>

<?php $position = get_field("position", $post_id)?>
<?php $company = get_field("company", $post_id)?>

<div class="content-layout">


    <div class="pg-single-wrapper">
        <div class="pg-single pg-single--<?php echo $post_type ?>">

            <div class="pg-single__top">

                <div class="pg-single__bg">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/jpg/modal-bg--<?php echo $post_type ?>.jpg"
                        alt="">
                </div>


                <div class="pg-single__logo">
                    <?php echo wp_get_attachment_image($image, 'medium'); ?>
                    <div class="pg-single__logo__outline"></div>
                    <div class="pg-single__logo__outline pg-single__logo__outline--2"></div>
                    <!-- company icon for speakers only -->
                    <?php if ($companyLogo): ?>
                    <div class="pg-single__logo__company">
                        <?php echo wp_get_attachment_image($companyLogo, 'medium'); ?>
                    </div>
                    <?php endif;?>


                </div>

                <div class="pg-single__top__right">
                    <div class="pg-single__titles-info">
                        <div class="pg-single__title">
                            <p class=""><?php echo $title ?>
                        </div>

                        <?php if ($position): ?> <p class="pg-single__position"> <?php echo $position ?> </p>
                        <?php endif?>
                        <?php if ($company): ?> <p class="pg-single__company"> <?php echo $company ?> </p> <?php endif?>
                    </div>


                    <div class="pg-single__socials">
                        <?php if ($website): ?>

                        <a class="pg-single__social" href="<?php echo $website ?>" target="_blank"
                            rel="noopener noreferrer">
                            <?php echo file_get_contents(get_template_directory() . '/images/svg/modal-website.svg'); ?>
                        </a>

                        <?php endif;?>

                        <?php if ($linkedin): ?>

                        <a class="pg-single__social" href="<?php echo $linkedin; ?>" target="_blank"
                            rel="noopener noreferrer">
                            <?php echo file_get_contents(get_template_directory() . '/images/svg/modal-linkedin.svg'); ?>
                        </a>

                        <?php endif;?>

                        <?php if ($facebook): ?>

                        <a class="pg-single__social" href="<?php echo $facebook; ?>" target="_blank"
                            rel="noopener noreferrer">
                            <?php echo file_get_contents(get_template_directory() . '/images/svg/modal-facebook.svg'); ?>
                        </a>

                        <?php endif;?>

                        <?php if ($twitter): ?>

                        <a class="pg-single__social" href="<?php echo $twitter; ?>" target="_blank"
                            rel="noopener noreferrer">
                            <?php echo file_get_contents(get_template_directory() . '/images/svg/modal-twitter.svg'); ?>
                        </a>

                        <?php endif;?>

                        <?php if ($instagram): ?>

                        <a class="pg-single__social" href="<?php echo $instagram; ?>" target="_blank"
                            rel="noopener noreferrer">
                            <?php echo file_get_contents(get_template_directory() . '/images/svg/modal-instagram.svg'); ?>
                        </a>

                        <?php endif;?>
                    </div>
                    <?php if ($booth): ?>
                    <p class="pg-single__logo__booth"> Booth <?php echo $booth ?></p>
                    <?php endif?>
                </div>
            </div>

            <div class="pg-single__bottom">

                <?php if ($description): ?>
                <div class="pg-single__desc">
                    <?php echo $description ?>
                </div>
                <?php endif?>

                <?php if ($bio): ?>
                <div class="pg-single__desc">
                    <?php echo $bio ?>
                </div>
                <?php endif?>

                <?php get_template_part('template-parts/assoc-speakers', 'assoc-speakers', array('post_id' => $post_id))?>
                <?php get_template_part('template-parts/session-links', 'session-links', array('post_id' => $post_id))?>
            </div>
        </div>
    </div>

</div>
