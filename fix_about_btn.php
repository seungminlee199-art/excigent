<?php
require('/mnt/wp-sites/excigent/www/wp-load.php');

$about_page_id = 22;

// Update hero_btn_primary ACF link field on About page
$result = update_field('hero_btn_primary', array(
    'url'    => home_url('/team/'),
    'title'  => 'Meet the Team',
    'target' => '',
), $about_page_id);

echo $result ? "Updated hero_btn_primary to /team/\n" : "No change (may already be set or field not found)\n";

// Verify
$val = get_field('hero_btn_primary', $about_page_id);
echo "Current value: " . print_r($val, true) . "\n";
?>
