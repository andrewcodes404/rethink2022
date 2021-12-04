<?php get_header();?>

<?php if (have_posts()): while (have_posts()): the_post();?>


<?php include "inc/fp-hero.php";?>


<div class="odoo-pop-wrapper" id="odoo-pop-wrapper">
    <div class="odoo-pop">


        <iframe src="<?php the_field('front_page_popup_form', 'option')?>?iframe=1" width="100%" border="0" style="">
        </iframe>

        <div class="odoo-pop__close-btn">
            <div class="odoo-pop__close-btn__svg">
                <?php echo file_get_contents(get_template_directory() . '/images/svg/close2.svg'); ?>
            </div>
        </div>
    </div>
</div>


<div class="content-layout">
    <?php the_content();?>
    <?php endwhile;else: ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.');?></p>
    <?php endif;?>
</div>



<?php get_footer();?>