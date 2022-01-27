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
            <div class="progrid__item-title">day1 AM</div>
          </div>
          <div class="progrid__item progrid__item--col-title">
            <div class="progrid__item-title">day1 PM</div>
          </div>
          <div class="progrid__item progrid__item--col-title">
            <div class="progrid__item-title">day2 AM</div>
          </div>
          <div class="progrid__item progrid__item--col-title">
            <div class="progrid__item-title">day2 PM</div>
          </div>
        </div>


        <div class="progrid__row progrid__row--1 ">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-title">Keynote</div>
          </div>

          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-title">1</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-title">2</div>
          </div>
        </div>



        <div class="progrid__row progrid__row--2">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-title">Resources</div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-title">3</div>
            <div class="progrid__item-info">
              <div class="progrid__item-info-text">
                Curabitur aliquet quam id dui posuere blandit. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Pellentesque in ipsum id orci porta dapibus.Curabitur aliquet quam id dui posuere blandit. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Pellentesque in ipsum id orci porta dapibus.Curabitur aliquet quam id dui posuere blandit. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Pellentesque in ipsum id orci porta dapibus.
              </div>
            </div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-title">4</div>
            <div class="progrid__item-info">
              <div class="progrid__item-info-text">
                Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec sollicitudin molestie malesuada.
              </div>
            </div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-title">5</div>
            <div class="progrid__item-info">
              <div class="progrid__item-info-text">
                Nulla quis lorem ut libero malesuada feugiat. Nulla porttitor accumsan tincidunt. Vivamus suscipit tortor eget felis porttitor volutpat. Proin eget tortor risus. Proin eget tortor risus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.
              </div>
            </div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-title">6</div>
            <div class="progrid__item-info">
              <div class="progrid__item-info-text">
                Nulla porttitor accumsan tincidunt. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur aliquet quam id dui posuere blandit. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
              </div>
            </div>
          </div>
        </div>


        <div class="progrid__row progrid__row--3">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-title">Communities</div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-title">Rethinking Customers & Communications</div>
            <div class="progrid__item-info">
              <div class="progrid__item-info-text">
                Rethinking Customers & Communications will explore how brands are rethinking their interactions with customers and reacting to the changing values of today’s consumers; how do they communicate big claims around sustainability credentials, goals and ambitions in a way that all stakeholders will care about?
              </div>
            </div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-title">Rethinking Workforce Transformation</div>

            <div class="progrid__item-info">
              <div class="progrid__item-info-text">
                Rethinking Supply Chains will look at the examples from the Apparel, Footwear and Textile industries, and explore how businesses (Brands, Retailers, Sourcing Agents, Manufacturers) have taken collective actions to drive transparency within the supply chain, as well as implement and measure sustainability performance to drive efficiencies and accelerate the adoption of efficient carbon solutions. 
              </div>
            </div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-title">Rethinking People and Purpose</div>
            <div class="progrid__item-info">
              <div class="progrid__item-info-text">
                Rethinking People & Purpose will share market insight and tried-and-tested best practice from people-centric organisations, practitioners and thought leaders who put their people and their communities at the very core of everything they stand for.
              </div>
            </div>
          </div>
          <div class="progrid__item">
            <div class="progrid__item-title">TBC</div>
          </div>
        </div>


        <div class="progrid__row  progrid__row--4">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-title">Partnerships</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-title">11</div>
            <div class="progrid__item-info">
              <div class="progrid__item-info-text">
                Rethinking People & Purpose will share market insight and tried-and-tested best practice from people-centric organisations, practitioners and thought leaders who put their people and their communities at the very core of everything they stand for.
              </div>
            </div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-title">12</div>
            <div class="progrid__item-info">
              <div class="progrid__item-info-text">
                Rethinking People & Purpose will share market insight and tried-and-tested best practice from people-centric organisations, practitioners and thought leaders who put their people and their communities at the very core of everything they stand for.
              </div>
            </div>
          </div>

        </div>


        <div class="progrid__row  progrid__row--5">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-title">Business</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-title">13</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-title">Rethinking Sustainability for SMEs (Cantonese with English interpretation)</div>
          </div>

        </div>


        <div class="progrid__row  progrid__row--6">
          <div class=" progrid__item pro grid__item--row-title">
            <div class="progrid__item-title">Change Makers</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-title">15</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-title">16</div>
          </div>

        </div>


        <div class="progrid__row  progrid__row--7">
          <div class="progrid__item progrid__item--row-title">
            <div class="progrid__item-title">Future Leaders</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-title">17</div>
          </div>
          <div class="progrid__item progrid__item--double">
            <div class="progrid__item-title">18</div>
          </div>

        </div>



      </div>



    </div>


  <?php endwhile;
else : ?>
  <div class="progrid__item-title"><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></div>
<?php endif; ?>
<?php get_footer(); ?>
