<?php
require('/mnt/wp-sites/excigent/www/wp-load.php');

$page_id = 41; // Team page

// Hero
update_field('field_tp_hero_eyebrow', 'Our Leadership', $page_id);
update_field('field_tp_hero_heading', 'Leadership with <strong>decades</strong><br>of industry depth and credibility.', $page_id);
update_field('field_tp_hero_subtext', 'Three industry veterans bringing 80+ combined years across broadband engineering, digital infrastructure, and security — with the relationships that move markets.', $page_id);

// Team Grid Section
update_field('field_tp_sec_eyebrow', 'The Excigent Team', $page_id);
update_field('field_tp_sec_heading', 'Three principals. One <strong>unified team</strong>.', $page_id);
update_field('field_tp_sec_lead',    'Each brings 20–30+ years of deep domain expertise across their respective markets — and together, they provide principals with commercial leadership that spans broadband, ICT, and security.', $page_id);

// Stats Band
update_field('field_tp_stats_eyebrow', 'By the Numbers', $page_id);
update_field('field_tp_stats_heading', '80+ combined years.<br><strong>One focused team</strong>.', $page_id);
update_field('field_tp_stats', array(
    array('stat_num' => '80',  'stat_suffix' => '+', 'stat_label' => 'Years Combined Experience'),
    array('stat_num' => '3',   'stat_suffix' => '',  'stat_label' => 'Core Technology Markets'),
    array('stat_num' => '3',   'stat_suffix' => '',  'stat_label' => 'Geographic Regions'),
    array('stat_num' => '100', 'stat_suffix' => '+', 'stat_label' => 'Partner Relationships'),
), $page_id);

// CTA Band
update_field('field_tp_cta_heading', 'Work with a team that knows <strong>your market</strong>.', $page_id);
update_field('field_tp_cta_subtext', "Whether you're a principal looking for commercial representation or a channel partner exploring new opportunities — let's start a conversation.", $page_id);
update_field('field_tp_cta_btn1', array(
    'title'  => 'Get in Touch',
    'url'    => home_url('/contact/'),
    'target' => '',
), $page_id);
update_field('field_tp_cta_btn2', array(
    'title'  => 'Our Services',
    'url'    => home_url('/services/'),
    'target' => '',
), $page_id);

// Verify
echo "=== TEAM PAGE ACF VALUES ===\n";
echo "hero_eyebrow: "   . get_field('hero_eyebrow', $page_id)   . "\n";
echo "hero_heading: "   . get_field('hero_heading', $page_id)   . "\n";
echo "hero_subtext: "   . get_field('hero_subtext', $page_id)   . "\n";
echo "section_eyebrow: ". get_field('section_eyebrow', $page_id). "\n";
echo "section_heading: ". get_field('section_heading', $page_id). "\n";
echo "stats_eyebrow: "  . get_field('stats_eyebrow', $page_id)  . "\n";
echo "stats_heading: "  . get_field('stats_heading', $page_id)  . "\n";
$stats = get_field('team_stats', $page_id);
echo "stats count: " . count($stats) . "\n";
foreach ($stats as $s) echo "  " . $s['stat_num'] . $s['stat_suffix'] . " — " . $s['stat_label'] . "\n";
$btn1 = get_field('cta_btn1', $page_id);
$btn2 = get_field('cta_btn2', $page_id);
echo "cta_btn1: " . $btn1['title'] . " → " . $btn1['url'] . "\n";
echo "cta_btn2: " . $btn2['title'] . " → " . $btn2['url'] . "\n";
echo "\nDone.\n";
?>
