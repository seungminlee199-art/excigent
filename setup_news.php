<?php
require('/mnt/wp-sites/excigent/www/wp-load.php');

/* ── 1. Update page ID=25 to use page-news-events.php template ── */
$ne_page_id = 25;
wp_update_post(array(
    'ID'         => $ne_page_id,
    'post_title' => 'News & Events',
    'post_name'  => 'news-events',
    'post_status'=> 'publish',
));
update_post_meta($ne_page_id, '_wp_page_template', 'page-news-events.php');
echo "Updated page ID=$ne_page_id to News & Events with page-news-events.php\n";

/* ── 2. Seed ACF content for News & Events page ── */
update_field('field_ne_hero_eyebrow',   'News & Events',                                                                    $ne_page_id);
update_field('field_ne_hero_heading',   'Industry <strong>perspectives</strong> &amp; upcoming events.',                    $ne_page_id);
update_field('field_ne_hero_subtext',   'Trade articles, quarterly newsletters, and market intelligence — alongside upcoming events where you can connect with the Excigent team.', $ne_page_id);
update_field('field_ne_events_eyebrow', 'Upcoming Events',                                                                  $ne_page_id);
update_field('field_ne_events_heading', 'Where we\'ll be <strong>next</strong>.',                                           $ne_page_id);
update_field('field_ne_news_eyebrow',   'Latest News',                                                                      $ne_page_id);
update_field('field_ne_news_heading',   'Industry <strong>perspectives</strong>,<br>delivered from the inside.',            $ne_page_id);
echo "Seeded News & Events page ACF content\n";

/* ── 3. Flush rewrite rules so /news-events/ and /news/ slugs work ── */
flush_rewrite_rules();
echo "Flushed rewrite rules\n";

/* ── 4. Add News & Events to Primary Navigation after Services ── */
$menu_id = 4; // Primary Navigation
$items = wp_get_nav_menu_items($menu_id);

// Check if already exists
$already = false;
foreach ($items as $item) {
    if ($item->object_id == $ne_page_id || strpos($item->url, 'news-events') !== false) {
        $already = true;
        echo "News & Events already in nav\n";
        break;
    }
}

if (!$already) {
    // Find Services item and insert after it (position 5, Contact becomes 6)
    foreach ($items as $item) {
        if ($item->menu_order >= 5) {
            wp_update_nav_menu_item($menu_id, $item->ID, array(
                'menu-item-position' => $item->menu_order + 1,
                'menu-item-title'    => $item->title,
                'menu-item-object'   => $item->object,
                'menu-item-object-id'=> $item->object_id,
                'menu-item-type'     => $item->type,
                'menu-item-status'   => 'publish',
                'menu-item-url'      => $item->url,
            ));
        }
    }
    $new_item = wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title'      => 'News & Events',
        'menu-item-object'     => 'page',
        'menu-item-object-id'  => $ne_page_id,
        'menu-item-type'       => 'post_type',
        'menu-item-status'     => 'publish',
        'menu-item-position'   => 5,
    ));
    echo is_wp_error($new_item) ? "NAV ERROR: ".$new_item->get_error_message()."\n" : "Added News & Events to nav (pos 5)\n";
}

/* ── 5. Create 3 sample News posts ── */
$theme_url = get_template_directory_uri();
$upload_dir = wp_upload_dir();

$sample_news = array(
    array(
        'title'      => 'Why Broadband, ICT & Security Convergence Is Rewriting the Infrastructure Playbook',
        'content'    => '<p>The future of infrastructure isn\'t three silos — it\'s an integrated system. For principals operating in broadband, ICT, or physical security, the convergence of these markets represents both an enormous opportunity and a genuine challenge: how do you position solutions effectively when the landscape itself is shifting?</p><p>At Excigent, we\'ve spent years working at the intersection of these three markets. What we\'ve observed is that the buyers, specifiers, and channel partners who are winning are those who understand that convergence isn\'t a trend — it\'s the new baseline.</p><h2>What Convergence Actually Means for Principals</h2><p>Convergence in this context doesn\'t simply mean that technologies are being bundled together. It means that the decision-makers, the procurement processes, and the channel relationships are merging. An IT director who once only cared about network infrastructure is now evaluating physical security platforms. A security integrator who once sold access control is now deploying fiber and structured cabling.</p><p>This creates a fundamental challenge for principals: your traditional channel may no longer reach the full universe of buyers for your solution.</p><h2>The Opportunity for Forward-Thinking Principals</h2><p>Principals who recognize this shift early have a significant advantage. By establishing relationships in adjacent markets — through the right channel partners, trade associations, and specification bodies — they can capture demand that competitors simply don\'t know exists.</p><p>This is precisely where Excigent\'s model delivers value: we sit at the convergence point, with deep relationships across all three markets and the commercial infrastructure to move quickly.</p>',
        'tag'        => 'Featured Article',
        'read_time'  => '6 min read',
        'is_featured'=> 1,
        'excerpt'    => 'The future of infrastructure isn\'t three silos — it\'s an integrated system. Here\'s what principals need to understand about positioning solutions in a converged market.',
    ),
    array(
        'title'      => 'Latin America & the Caribbean: Where Channel Relationships Still Win Deals',
        'content'    => '<p>In mature North American markets, technology sales increasingly run through automated procurement platforms, RFP processes, and digital-first buyer journeys. But across Latin America and the Caribbean, the dynamics are fundamentally different — and for principals who understand this, the opportunity is significant.</p><p>Relationships still drive decisions in this region. Not just introductions, but sustained, trust-based partnerships built over years of consistent follow-through. For a principal entering these markets for the first time, this is both the challenge and the advantage: if you invest in the right relationships early, you build a durable competitive position that is very difficult to replicate.</p><h2>What We\'ve Seen in the Field</h2><p>Working across the Americas, Excigent has observed several patterns that consistently hold true in the LAC region. First, local representation matters enormously. Distributors and end-customers in this region want to know that someone is present, responsive, and accountable — not just an email address on the other side of a continent.</p><p>Second, the channel structure is different. The layers between manufacturer and end-user can be more complex, and navigating them requires both regional knowledge and existing relationships with the key intermediaries.</p><p>Third, patience is not optional. The sales cycles in government and enterprise segments in particular can be long — but the contracts, when they close, tend to be substantial and sticky.</p>',
        'tag'        => 'Trade Article',
        'read_time'  => '4 min read',
        'is_featured'=> 0,
        'excerpt'    => 'Notes from the field on what really moves the needle for principals expanding into Latin America and the Caribbean.',
    ),
    array(
        'title'      => 'Q2 2026 Market Intelligence: Signals Worth Tracking Across Broadband, ICT & Security',
        'content'    => '<p>Each quarter, the Excigent team compiles the market signals we consider most significant for principals operating across broadband, ICT, and security. This edition covers the key movements from Q1 2026 and what they mean for channel strategy in the months ahead.</p><h2>Broadband</h2><p>Federal funding disbursements continue to drive fiber deployment activity across underserved regions. Principals with OSP, FTTH, and broadband CPE solutions should be actively engaging with ISPs and co-ops that are entering construction phases — the procurement window is narrowing as projects move from planning to execution.</p><h2>ICT & Infrastructure</h2><p>Optical LAN continues to gain specification traction as an alternative to traditional copper-based structured cabling. We\'re seeing increased specification activity from architects and engineers in new construction and campus retrofit projects. Principals in this space should be prioritizing specification engagement now to influence projects that will begin procurement in late 2026.</p><h2>Security</h2><p>The convergence of physical security with IT infrastructure is accelerating. Access control and video surveillance vendors who can demonstrate integration with IT management platforms are winning evaluations. Principals who have not yet built this narrative into their channel enablement materials should do so immediately.</p>',
        'tag'        => 'Newsletter',
        'read_time'  => '5 min read',
        'is_featured'=> 0,
        'excerpt'    => 'Quarterly insights on market signals worth tracking across broadband, ICT, and security — from the Excigent team.',
    ),
);

foreach ($sample_news as $idx => $n) {
    // Check if post with same title exists
    $existing = get_page_by_title($n['title'], OBJECT, 'news');
    if ($existing) {
        echo "News already exists: {$n['title']}\n";
        continue;
    }

    $post_id = wp_insert_post(array(
        'post_type'    => 'news',
        'post_title'   => $n['title'],
        'post_content' => $n['content'],
        'post_status'  => 'publish',
        'post_date'    => date('Y-m-d H:i:s', strtotime("-" . ($idx * 14) . " days")),
    ));

    if (is_wp_error($post_id)) {
        echo "Error creating news post: " . $post_id->get_error_message() . "\n";
        continue;
    }

    update_field('field_news_tag',        $n['tag'],        $post_id);
    update_field('field_news_read_time',  $n['read_time'],  $post_id);
    update_field('field_news_excerpt',    $n['excerpt'],    $post_id);
    update_field('field_news_is_featured',$n['is_featured'],$post_id);
    update_field('field_news_is_video',   0,                $post_id);

    echo "Created news post ID=$post_id: {$n['title']}\n";
}

/* ── 6. Verify final nav ── */
echo "\n=== FINAL NAV ===\n";
$final = wp_get_nav_menu_items($menu_id);
foreach ($final as $fi) {
    echo $fi->menu_order . ' | ' . $fi->title . ' | ' . $fi->url . "\n";
}
echo "\nDone.\n";
?>
