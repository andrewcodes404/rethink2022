<div class="programme-grid-wrapper">
    <div class="programme-grid">
        <?php if (have_rows('programme_grid')): ?>
        <?php while (have_rows('programme_grid')): the_row();?>
        <?php
    $title = get_sub_field('title');
    $colour = get_sub_field('colour');
    $info = get_sub_field('info');

    ?>

        <?php
    $link = get_sub_field('link');
    if ($link):
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
        <?php endif?>

        <div class="programme-grid-item  programme-grid-item--<?php echo $colour ?>">

            <span class="programme-grid-item__title"><?php echo $title ?></span>

            <?php if ($info): ?>
            <div class="programme-grid-item__overlay programme-grid-item__overlay--<?php echo $colour ?>">

                <div class="programme-grid-item__content">
                    <p class="programme-grid-item__title"> <?php echo $info ?></p>
                    <a class="programme-grid-item__link" href="<?php echo $link_url ?>"
                        target="<?php echo $link_target ?>">
                        <?php echo $link_title ?>
                    </a>

                </div>
            </div>

            <?php endif?>
        </div>

        <?php endwhile?>
        <?php endif;?>
    </div>
</div>