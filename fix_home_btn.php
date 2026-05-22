<?php
require('/mnt/wp-sites/excigent/www/wp-load.php');

// Front page ID
$front_page_id = get_option('page_on_front');
echo "Front page ID: $front_page_id\n";

// Update hero_btn_secondary (Meet the Team) on front page
$result = update_field('hero_btn_secondary', array(
    'url'    => home_url('/team/'),
    'title'  => 'Meet the Team',
    'target' => '',
), $front_page_id);

echo $result ? "Updated hero_btn_secondary to /team/\n" : "No change\n";

$val = get_field('hero_btn_secondary', $front_page_id);
echo "Current value: " . print_r($val, true) . "\n";
?>
