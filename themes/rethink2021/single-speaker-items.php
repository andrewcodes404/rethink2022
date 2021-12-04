<?php get_header();?>

<?php if (have_posts()): while (have_posts()): the_post();?>
<div class="content-layout">

    <div class="s-profile">

        <h1><?php the_title()?></h1>
        <div class="s-profile__image">
            <?php
        $image = get_field('image', $post->ID);
        $size = 'carousel';
        if ($image) {
            echo wp_get_attachment_image($image, $size);
        }
        ?>
        </div>

        <p class="s-profile__position"> <?php the_field('position')?> </p>
        <p class="s-profile__company"> <?php the_field('company')?></p>
        <div class="s-profile__social">


            <?php $linkedin = get_field('linkedin');if ($linkedin): ?>
            <div class="s-profile__social-icon">
                <a href="<?php echo $linkedin ?>" target="_blank" rel="noopener noreferrer">
                    <?php echo file_get_contents(get_template_directory() . '/images/svg/linkedin.svg'); ?>
                </a>
            </div>
            <?php endif;?>


            <?php $facebook = get_field('facebook');if ($facebook): ?>
            <div class="s-profile__social-icon">
                <a href="<?php the_field('facebook')?>" target="_blank" rel="noopener noreferrer">
                    <?php echo file_get_contents(get_theme_file_uri('images/svg/facebook.svg')); ?>
                </a>
            </div>
            <?php endif;?>

            <?php $instagram = get_field('instagram');if ($instagram): ?>
            <div class="s-profile__social-icon">
                <a href="<?php the_field('instagram')?>" target="_blank" rel="noopener noreferrer">
                    <?php echo file_get_contents(get_theme_file_uri('images/svg/insta.svg')); ?>
                </a>
            </div>
            <?php endif;?>


            <?php $twitter = get_field('twitter');if ($twitter): ?>
            <div class="s-profile__social-icon">
                <a href="<?php the_field('twitter')?>" target="_blank" rel="noopener noreferrer">
                    <?php echo file_get_contents(get_theme_file_uri('images/svg/twitter.svg')); ?>
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





</div>



</div>
<?php endwhile;else: ?>
<p><?php esc_html_e('Sorry, no posts matched your criteria.');?></p>
<?php endif;?>
<?php get_footer();?>