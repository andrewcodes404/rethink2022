<?php

// MENUS -- MENUS -- MENUS -- MENUS --
add_theme_support('menus');

///create  function using registar_theme_menus() inside it, and adding parameters in the array
function register_theme_menus()
{
  register_nav_menus(
    array(
      'nav-menu' => _('Navigation'),

    )
  );
}
//don’t forget to call the function… like this
add_action('init', 'register_theme_menus');






/**
 * Add a parent CSS class for nav menu items.
 *
 * @param array  $items The menu items, sorted by each menu item's menu order.
 * @return array (maybe) modified parent CSS class.
 */
// function wpdocs_add_menu_parent_class($items)
// {
//   $parents = array();

//   // Collect menu items with parents.
//   foreach ($items as $item) {
//     if ($item->menu_item_parent && $item->menu_item_parent > 0) {
//       $parents[] = $item->menu_item_parent;
//     }
//   }

//   // Add class.
//   foreach ($items as $item) {
//     if (in_array($item->ID, $parents)) {
//       $item->classes[] = 'menu-parent-item 🧨';
//     }
//   }
//   return $items;
// }
// add_filter('wp_nav_menu_objects', 'wpdocs_add_menu_parent_class');
