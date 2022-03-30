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
        <small>Copyright © <?php echo date("Y"); ?> EnviroEvents (ReThink Limited)</small>
        <small>All rights reserved.</small>
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
        <a href="<?php echo get_site_url(); ?>/privacy-policy">privacy policy</a>

      </div>

    </div>
  </footer>
</div>

<?php wp_footer(); ?>
</body>

<!-- LinkedIn Insight Tag --- LinkedIn Insight Tag --- LinkedIn Insight Tag ---  -->

<script type="text/javascript">
  _linkedin_partner_id = "4291537";
  window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
  window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script>
<script type="text/javascript">
  (function(l) {
    if (!l) {
      window.lintrk = function(a, b) {
        window.lintrk.q.push([a, b])
      };
      window.lintrk.q = []
    }
    var s = document.getElementsByTagName("script")[0];
    var b = document.createElement("script");
    b.type = "text/javascript";
    b.async = true;
    b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
    s.parentNode.insertBefore(b, s);
  })(window.lintrk);
</script>
<noscript>
  <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=4291537&fmt=gif" />
</noscript>

</html>
