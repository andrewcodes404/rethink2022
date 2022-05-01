<?php get_header();?>

<?php if (have_posts()): while (have_posts()): the_post();?>
<?php $post_id = get_the_ID();?>
<?php $post_type = get_post_type($post_id);?>

<?php get_template_part('template-parts/hero', 'hero', array('post_id' => $post_id))?>

<div class="content-layout">
    <div class="s-profile">


        <div class="s-profile__images">
            <div class="s-profile__image">
                <?php
        $image = get_field('image', $post->ID);
        $size = 'carousel';
        if ($image) {
            echo wp_get_attachment_image($image, $size);
        }
        ?>
            </div>

            <div class="s-profile__logo">
                <?php
        $image = get_field('company_logo', $post->ID);
        $size = 'carousel';
        if ($image) {
            echo wp_get_attachment_image($image, $size);
        }
        ?>
            </div>

        </div>

        <p class="s-profile__position"> <?php the_field('position')?> </p>

                <?php $assoc_company = get_field("sponsor_partner_company", $post->ID)?>
                <?php $company = get_field("company", $post->ID) ?>
                <?php
                        if($company){
                          $company_text = $company;
                        }

                        if($assoc_company){
                          foreach ($assoc_company as $value) {
                            $company_text =  get_the_title($value->ID);
                          }
                        }
                        ?>

        <p class="s-profile__company"> <?php echo $company_text ?></p>



        <div class="s-profile__social">

            <?php $linkedin = get_field('linkedin');if ($linkedin): ?>
            <div class="s-profile__social-icon">
                <a href="<?php echo $linkedin ?>" target="_blank" rel="noopener noreferrer">

                    <?php echo load_inline_svg('linkedin.svg') ?>
                </a>
            </div>
            <?php endif;?>


            <?php $facebook = get_field('facebook');if ($facebook): ?>
            <div class="s-profile__social-icon">
                <a href="<?php the_field('facebook')?>" target="_blank" rel="noopener noreferrer">
                    <?php include get_theme_file_uri('images/svg/facebook.svg');?>
                </a>
            </div>
            <?php endif;?>

            <?php $instagram = get_field('instagram');if ($instagram): ?>
            <div class="s-profile__social-icon">
                <a href="<?php the_field('instagram')?>" target="_blank" rel="noopener noreferrer">
                    <?php include get_theme_file_uri('images/svg/insta.svg');?>
                </a>
            </div>
            <?php endif;?>


            <?php $twitter = get_field('twitter');if ($twitter): ?>
            <div class="s-profile__social-icon">
                <a href="<?php the_field('twitter')?>" target="_blank" rel="noopener noreferrer">
                    <?php include get_theme_file_uri('images/svg/twitter.svg');?>
                </a>
            </div>
            <?php endif;?>


            <?php $website = get_field('website');if ($website): ?>
            <div class="s-profile__social-icon website">
                <a href="<?php the_field('website')?>" target="_blank" rel="noopener noreferrer">
                    <p>www.</p>
                </a>
            </div>
            <?php endif;?>

        </div>


        <div> <?php the_field('bio')?> </div>

    </div>


    <?php get_template_part('template-parts/session-links', null, array('post_id' => $post_id, 'post_type' => $post_type))?>


</div>



</div>
<?php endwhile;else: ?>
<p><?php esc_html_e('Sorry, no posts matched your criteria.');?></p>
<?php endif;?>
<?php get_footer();?>
