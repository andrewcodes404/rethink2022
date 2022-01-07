<?php
$sticky_cta = get_field('sticky_cta', 'option');
if( $sticky_cta ): ?>

<?php  if($sticky_cta['sticky_cta_is_active']): ?>
<a class="sticky-cta" target="_blank" href="   <?php echo  $sticky_cta['sticky_cta_url']  ?>">
    <?php echo  $sticky_cta['sticky_cta_text']  ?>
</a>
<?php endif; ?>

<?php endif; ?>