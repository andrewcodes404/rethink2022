<div class="push-down"></div>

<div class="footer-wrapper">
    <footer class="footer">

        <div class="footer__flex-item-1">



            <div class="footer__logo">
                <a href="<?php echo get_site_url(); ?>">
                    <?php echo file_get_contents(get_template_directory() . '/images/svg/logo-green.svg'); ?>
                </a>
            </div>

            <div class="footer__copyright">
                <small>Copyright © <?php echo date("Y"); ?> EnviroEvents (REthink) · All rights reserved.</small>
            </div>

        </div>

        <div class="footer__flex-item-2">

            <div class="footer__social ">

                <div class="footer__social-icon">
                    <a href="https://www.linkedin.com/company/rethinkhk/" target="_blank" rel="noopener noreferrer">
                        <?php echo file_get_contents(get_template_directory() . '/images/svg/linkedin.svg'); ?>

                    </a>
                </div>

                <div class="footer__social-icon">
                    <a href="https://www.facebook.com/rethinkhongkong" target="_blank" rel="noopener noreferrer">
                        <?php echo file_get_contents(get_template_directory() . '/images/svg/facebook.svg'); ?>
                    </a>
                </div>

                <div class="footer__social-icon">
                    <a href="https://www.instagram.com/rethink_event/" target="_blank" rel="noopener noreferrer">
                        <?php echo file_get_contents(get_template_directory() . '/images/svg/insta.svg'); ?>
                    </a>
                </div>


                <a href="mailto:hello@rethink-event.com?subject=Hello" target="_blank" rel="noopener noreferrer">
                    <div class="footer__social-icon mail">
                        <?php echo file_get_contents(get_template_directory() . '/images/svg/mail.svg'); ?>
                    </div>
                </a>
            </div>
            <div class="footer__privacy">
                <a href="<?php echo get_site_url(); ?>/privacy-policy">privacy policy +</a>

            </div>

        </div>
    </footer>
</div>

<?php wp_footer();?>
</body>

</html>