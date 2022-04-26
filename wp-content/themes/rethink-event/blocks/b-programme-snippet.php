<!-- <?php $location = get_field('location')?> -->

<?php
$field = get_field_object( 'location' );
$value = $field['value'];
$label = strtoupper($field['choices'][ $value ]);

?>

<?php  get_template_part('template-parts/programme-snippet', null,  array(
    'data'  => array(
      'location_value' => $value ,
      'title' => $label
  ))) ?>
