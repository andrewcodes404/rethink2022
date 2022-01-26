<?php
/*
Template Name: Sandpit
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php $post_id = get_the_ID(); ?>

    <?php get_template_part('template-parts/hero', 'hero', array('post_id' => $post_id)) ?>

    <div class="content-layout content-layout--sandpit">


      <div class="progrid">

        <div class="progrid__row progrid__row--titles">
          <div class="progrid__item">

          </div>
          <div class="progrid__item progrid__item--col-title">
            <div class="progrid__item-text">day1 AM</div>
          </div>
          <div class="progrid__item progrid__item--col-title">
            <div class="progrid__item-text">day1 PM</div>
          </div>
          <div class="progrid__item progrid__item--col-title">
            <div class="progrid__item-text">day2 AM</div>
          </div>
          <div class="progrid__item progrid__item--col-title">
            <div class="progrid__item-text">day2 PM</div>
          </div>
        </div>


        <div class="progrid__row">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-text">Keynote</div>
          </div>

          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-text">1</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-text">2</div>
          </div>
        </div>



        <div class="progrid__row">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-text">Resources</div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-text">3</div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-text">4</div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-text">5</div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-text">6</div>
          </div>
        </div>


        <div class="progrid__row">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-text">Communities</div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-text">Rethinking Customers & Communications</div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-text">Rethinking Workforce Transformation</div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-text">Rethinking People and Purpose</div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-text">TBC</div>
          </div>
        </div>


        <div class="progrid__row">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-text">Partnerships</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-text">11</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-text">12</div>
          </div>

        </div>


        <div class="progrid__row">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-text">Business</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-text">13</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-text">Rethinking Sustainability for SMEs (Cantonese with English interpretation)</div>
          </div>

        </div>


        <div class="progrid__row">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-text">Change Makers</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-text">15</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-text">16</div>
          </div>

        </div>


        <div class="progrid__row">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-text">Future Leaders</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-text">17</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-text">18</div>
          </div>

        </div>



      </div>



    </div>


  <?php endwhile;
else : ?>
  <div class="progrid__item-text"><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></div>
<?php endif; ?>
<?php get_footer(); ?>
