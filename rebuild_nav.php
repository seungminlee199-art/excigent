<?php
require('/mnt/wp-sites/excigent/www/wp-load.php');

$menu_id = 4; // Primary Navigation

// Delete ALL current items from this menu
$current_items = wp_get_nav_menu_items($menu_id, array('post_status' => 'any'));
if ($current_items) {
    foreach ($current_items as $item) {
        wp_delete_post($item->ID, true);
        echo "Deleted item ID: " . $item->ID . "\n";
    }
}

// Re-add all menu items fresh
$site = 'https://excigent.tequp.info';

$menu_items = array(
    array(
        'title'     => 'Home',
        'type'      => 'custom',
        'url'       => $site . '/',
        'object_id' => 0,
        'object'    => 'custom',
        'position'  => 1,
    ),
    array(
        'title'     => 'About',
        'type'      => 'post_type',
        'url'       => '',
        'object_id' => 22,
        'object'    => 'page',
        'position'  => 2,
    ),
    array(
        'title'     => 'Team',
        'type'      => 'post_type',
        'url'       => '',
        'object_id' => 41,
        'object'    => 'page',
        'position'  => 3,
    ),
    array(
        'title'     => 'Services',
        'type'      => 'post_type',
        'url'       => '',
        'object_id' => 23,
        'object'    => 'page',
        'position'  => 4,
    ),
    array(
        'title'     => 'Contact',
        'type'      => 'post_type',
        'url'       => '',
        'object_id' => 24,
        'object'    => 'page',
        'position'  => 5,
    ),
);

foreach ($menu_items as $mi) {
    $args = array(
        'menu-item-title'     => $mi['title'],
        'menu-item-type'      => $mi['type'],
        'menu-item-object'    => $mi['object'],
        'menu-item-object-id' => $mi['object_id'],
        'menu-item-url'       => $mi['url'],
        'menu-item-status'    => 'publish',
        'menu-item-position'  => $mi['position'],
    );
    $new_id = wp_update_nav_menu_item($menu_id, 0, $args);
    if (is_wp_error($new_id)) {
        echo "ERROR: " . $new_id->get_error_message() . "\n";
    } else {
        echo "Added: " . $mi['title'] . " (ID: $new_id, pos: " . $mi['position'] . ")\n";
    }
}

// Final verification
echo "\n=== FINAL MENU ===\n";
$items = wp_get_nav_menu_items($menu_id);
foreach ($items as $item) {
    echo $item->menu_order . ' | ' . $item->title . ' | ' . $item->url . "\n";
}
?>
