<div class="nav-fake">

</div>
<div class="nav-wrapper">

    <nav class="nav">

        <div class="nav__logo">
            <a href="<?php echo get_site_url(); ?>">
                <?php echo file_get_contents( get_template_directory() . '/images/svg/logo-green.svg' ); ?>
            </a>
        </div>


        <div class="nav__menu-mobile" id="nav__menu-mobile">
            <?php 
        wp_nav_menu( array(
            'menu' => 'navigation', 
            'container' => 'ul'
        ) );
   ?>
        </div>


        <div class="nav__menu-desktop" id="nav__menu-desktop">
            <?php 
        wp_nav_menu( array(
            'menu' => 'navigation', 
            'container' => 'ul'
        ) );
   ?>
        </div>





        <div class="nav__hamburger nav__button nav__button--show" id="hamburger">
            <?php echo file_get_contents( get_template_directory() . '/images/svg/hamburger.svg' ); ?>
        </div>

        <div class="nav__close nav__button nav__button--hide" id="closeBtn">

            <?php echo file_get_contents( get_template_directory() . '/images/svg/close.svg'  ); ?>
        </div>

    </nav>
</div>