<?php $sdgs = $args['data']?>

<div class="t-sdgs">
    <?php foreach ($sdgs as $sdg): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/images/sdgs/<?php echo $sdg ?>.png" alt="">
    <?php endforeach;?>
</div>