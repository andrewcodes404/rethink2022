<?php
$post_id = $args['post_id'];

$cta = get_field('cta', $post_id);

$link = $cta['link'];
$color = $cta['colour'];
if ($link) :
  $link_url = $link['url'];
  $link_title = $link['title'];
  $link_target = $link['target'] ? $link['target'] : '_self';
?>

  <a href="<?php echo $link_url ?>" class="t-link-button t-link-button--<?php echo $color ?> " target="<?php echo $link_target ?>">
    <span>
      <i>
        <?php echo $link_title ?>
      </i>
    </span>
  </a>
<?php endif; ?>
