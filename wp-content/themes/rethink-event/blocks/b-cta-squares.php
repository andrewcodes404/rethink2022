<div class="programme-grid-wrapper">
    <div class="programme-grid">
        <?php if (have_rows('cta_squares')): ?>
        <?php while (have_rows('cta_squares')): the_row();?>
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

            <?php if ($info || $link): ?>
            <div class="programme-grid-item__overlay programme-grid-item__overlay--<?php echo $colour ?>">

                <div class="programme-grid-item__content">

                    <?php if ($info): ?>
                    <p class="programme-grid-item__title"> <?php echo $info ?></p>
                    <?php endif?>

                    <?php if ($link): ?>
                    <a class="programme-grid-item__link" href="<?php echo $link_url ?>"
                        target="<?php echo $link_target ?>">
                        <?php echo $link_title ?>
                    </a>
                    <?php endif?>

                </div>
            </div>

            <?php endif?>
        </div>

        <?php endwhile?>
        <?php endif;?>
    </div>
</div>
