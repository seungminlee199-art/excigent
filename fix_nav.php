<?php
require('/mnt/wp-sites/excigent/www/wp-load.php');

$menu_id = 4; // Primary Navigation

// Remove broken/empty items (IDs 28, 29, 30)
$broken = array(28, 29, 30);
foreach ($broken as $id) {
    wp_delete_post($id, true);
}

// Page IDs
$about_id    = 22;
$team_id     = 41;
$services_id = 23;
$contact_id  = 24;

// Check existing items to avoid duplication
$existing = wp_get_nav_menu_items($menu_id);
$existing_pages = array();
foreach ($existing as $item) {
    if ($item->object_id) $existing_pages[] = intval($item->object_id);
}

// Helper to add a page link if not already present
function add_page_link($menu_id, $page_id, $order) {
    $page = get_post($page_id);
    if (!$page) { echo "Page $page_id not found\n"; return; }
    $item_id = wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title'     => $page->post_title,
        'menu-item-object'    => 'page',
        'menu-item-object-id' => $page_id,
        'menu-item-type'      => 'post_type',
        'menu-item-status'    => 'publish',
        'menu-item-position'  => $order,
    ));
    if (is_wp_error($item_id)) {
        echo "ERROR adding page $page_id: " . $item_id->get_error_message() . "\n";
    } else {
        echo "Added: " . $page->post_title . " (item ID $item_id, order $order)\n";
    }
}

// Fix menu_order for existing items first
// Home=26 stays order 1, About=27 stays order 2, Team=42 stays order 3
wp_update_nav_menu_item($menu_id, 26, array('menu-item-position' => 1));
wp_update_nav_menu_item($menu_id, 27, array('menu-item-position' => 2));
wp_update_nav_menu_item($menu_id, 42, array('menu-item-position' => 3));

// Add Services, Contact
if (!in_array($services_id, $existing_pages)) {
    add_page_link($menu_id, $services_id, 4);
} else {
    echo "Services already in menu\n";
}

if (!in_array($contact_id, $existing_pages)) {
    add_page_link($menu_id, $contact_id, 5);
} else {
    echo "Contact already in menu\n";
}

// Verify final menu
echo "\n=== FINAL NAV MENU ===\n";
$items = wp_get_nav_menu_items($menu_id);
foreach ($items as $item) {
    echo $item->menu_order . ' | ' . $item->title . ' | ' . $item->url . "\n";
}
?>
