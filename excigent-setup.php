<?php
/**
 * Excigent WP Setup Script
 * Creates pages, assigns templates, populates ACF data, sets up menus.
 * Run once then DELETE from server.
 */

// Bootstrap WordPress
$wp_load = '/mnt/wp-sites/excigent/www/wp-load.php';
if ( ! file_exists( $wp_load ) ) { die("wp-load.php not found\n"); }
require_once $wp_load;

echo "WordPress " . get_bloginfo('version') . " loaded\n";
echo "Site URL: " . get_site_url() . "\n";
echo "ACF available: " . ( function_exists('get_field') ? 'YES' : 'NO' ) . "\n\n";

if ( ! function_exists('get_field') ) { die("ACF not available — aborting\n"); }

/* ── helper ── */
function excigent_create_page( $title, $slug, $template ) {
    $existing = get_page_by_path( $slug );
    if ( $existing ) {
        update_post_meta( $existing->ID, '_wp_page_template', $template );
        echo "Page '$title' already exists (ID {$existing->ID}), template set to $template\n";
        return $existing->ID;
    }
    $id = wp_insert_post([
        'post_title'  => $title,
        'post_name'   => $slug,
        'post_status' => 'publish',
        'post_type'   => 'page',
        'post_author' => 1,
    ]);
    if ( is_wp_error($id) ) {
        echo "ERROR creating '$title': " . $id->get_error_message() . "\n";
        return 0;
    }
    update_post_meta( $id, '_wp_page_template', $template );
    echo "Page '$title' created (ID $id), template: $template\n";
    return $id;
}

/* ═══════════════════════════════════════════
   1. HOME PAGE — Populate ACF Fields
   ═══════════════════════════════════════════ */
$home_id = (int) get_option('page_on_front');
echo "\n--- HOME PAGE (ID: $home_id) ---\n";
if ( $home_id ) {
    // Hero
    update_field('field_hero_heading',  'Where <strong>Broadband, ICT</strong> &amp; Security Converge', $home_id);
    update_field('field_hero_subtext',  'Helping innovative companies build channels, strengthen market presence, and accelerate revenue growth across North America, Latin America & the Caribbean.', $home_id);
    update_field('field_hero_btn1', ['url' => home_url('/services/'), 'title' => 'Explore Our Services', 'target' => ''], $home_id);
    update_field('field_hero_btn2', ['url' => home_url('/about/'),    'title' => 'Meet the Team',        'target' => ''], $home_id);

    // Events carousel
    update_field('field_events_heading', 'Upcoming <strong>Events</strong>', $home_id);
    update_field('field_events_carousel', [
        ['month'=>'Jun','day'=>'14','type'=>'Trade Show',       'name'=>'InfoComm 2026',    'location'=>'Las Vegas, NV',    'tag'=>'ICT & AV Technology',    'gradient'=>'linear-gradient(135deg,#061F2E,#004569 60%,#0061B3)'],
        ['month'=>'Sep','day'=>'04','type'=>'Trade Show',       'name'=>'CEDIA Expo 2026',  'location'=>'Denver, CO',       'tag'=>'Residential Technology', 'gradient'=>'linear-gradient(135deg,#0A2F45,#0061B3 80%)'],
        ['month'=>'Oct','day'=>'19','type'=>'International Expo','name'=>'Futurecom 2026',  'location'=>'São Paulo, Brazil','tag'=>'Broadband & Telecom',    'gradient'=>'linear-gradient(135deg,#004569,#0061B3 80%)'],
        ['month'=>'Nov','day'=>'09','type'=>'Security Expo',    'name'=>'GSX 2026',         'location'=>'Houston, TX',      'tag'=>'Security & Access Control','gradient'=>'linear-gradient(135deg,#061F2E,#0061B3 90%)'],
    ], $home_id);

    // About snapshot
    update_field('field_about_eyebrow', 'About Excigent', $home_id);
    update_field('field_about_heading', 'Built on <strong>decades</strong> of industry leadership across broadband, ICT &amp; security.', $home_id);
    update_field('field_about_para1',   'Excigent Tech Partners is a commercial agency and market development partner helping innovative companies expand across North America, Latin America, and the Caribbean.', $home_id);
    update_field('field_about_para2',   'We turn strong potential into market traction and revenue growth — through strategy, channel development, market positioning, and disciplined commercial execution.', $home_id);
    update_field('field_about_cta', ['url'=>home_url('/about/'),'title'=>'Learn More About Us','target'=>''], $home_id);

    // Stats
    update_field('field_home_stats', [
        ['num'=>'80', 'suffix'=>'+','label'=>'Years Combined Experience'],
        ['num'=>'3',  'suffix'=>'', 'label'=>'Core Technology Markets'],
        ['num'=>'3',  'suffix'=>'', 'label'=>'Geographic Regions Served'],
        ['num'=>'100','suffix'=>'+','label'=>'Channel Partner Relationships'],
    ], $home_id);

    // CTAs
    update_field('field_process_cta',     ['url'=>home_url('/services/'),'title'=>'See Our Services',  'target'=>''], $home_id);
    update_field('field_convergence_cta', ['url'=>home_url('/about/'),   'title'=>'View Our Expertise','target'=>''], $home_id);

    echo "Home page ACF fields populated!\n";
} else {
    echo "WARNING: No static front page set. Please set Home Page (ID 19) as the static front page.\n";
    // Force it just in case
    update_option('show_on_front', 'page');
    update_option('page_on_front', 19);
    $home_id = 19;
}

/* ═══════════════════════════════════════════
   2. ABOUT PAGE
   ═══════════════════════════════════════════ */
echo "\n--- ABOUT PAGE ---\n";
$about_id = excigent_create_page( 'About', 'about', 'page-about.php' );
if ( $about_id ) {
    update_field('field_ab_hero_eyebrow', 'About Excigent', $about_id);
    update_field('field_ab_hero_heading', 'Commercial Excellence Across <strong>Broadband, ICT &amp; Security</strong>', $about_id);
    update_field('field_ab_hero_subtext', 'A market development partner built on deep relationships, domain expertise, and disciplined commercial execution across the Americas.', $about_id);
    update_field('field_ab_hero_btn1', ['url'=>home_url('/services/'),'title'=>'Our Services','target'=>''], $about_id);
    update_field('field_ab_hero_btn2', ['url'=>home_url('/contact/'), 'title'=>'Contact Us',  'target'=>''], $about_id);

    // Who We Are
    update_field('field_ab_who_eyebrow', 'Who We Are', $about_id);
    update_field('field_ab_who_heading', 'Your <strong>commercial partner</strong> in the Americas', $about_id);
    update_field('field_ab_who_body',    'Excigent Tech Partners is a commercial agency and market development firm specializing in the convergence of broadband, ICT, and security. We help principals grow their channel presence, strengthen market position, and accelerate revenue in North America, Latin America, and the Caribbean.', $about_id);
    update_field('field_ab_who_cta', ['url'=>home_url('/contact/'),'title'=>'Get in Touch','target'=>''], $about_id);

    // Stats
    update_field('field_ab_stats', [
        ['stat_number'=>'80', 'stat_suffix'=>'+','stat_label'=>'Years Combined Experience'],
        ['stat_number'=>'3',  'stat_suffix'=>'', 'stat_label'=>'Core Technology Markets'],
        ['stat_number'=>'3',  'stat_suffix'=>'', 'stat_label'=>'Geographic Regions Served'],
        ['stat_number'=>'100','stat_suffix'=>'+','stat_label'=>'Channel Partner Relationships'],
    ], $about_id);

    // Markets / What We Do
    update_field('field_ab_mkt_eyebrow', 'What We Do', $about_id);
    update_field('field_ab_mkt_heading', 'Deep expertise across <strong>three converging markets</strong>', $about_id);
    update_field('field_ab_mkt_body',    'We operate at the intersection of broadband, ICT, and security — three markets whose convergence defines the future of connected infrastructure.', $about_id);
    update_field('field_ab_mkt_cta', ['url'=>home_url('/services/'),'title'=>'View Our Services','target'=>''], $about_id);
    update_field('field_ab_mkt_items', [
        ['item_number'=>'01','item_title'=>'Broadband','item_body'=>'Fiber, wireless, FTTH — the connected foundation for every market we serve.'],
        ['item_number'=>'02','item_title'=>'ICT','item_body'=>'Cabling, data centers, LAN — the systems that power enterprise communication and operations.'],
        ['item_number'=>'03','item_title'=>'Security','item_body'=>'Access control, surveillance, biometrics — protecting people, assets, and environments.'],
    ], $about_id);

    // Network regions
    update_field('field_ab_regions', [
        ['region_name'=>'North America',     'region_meta'=>'USA & Canada'],
        ['region_name'=>'Latin America',     'region_meta'=>'Mexico, Central & South America'],
        ['region_name'=>'Caribbean',         'region_meta'=>'Island markets & territories'],
    ], $about_id);

    // Why Engage
    update_field('field_ab_why_eyebrow', 'Why Excigent', $about_id);
    update_field('field_ab_why_heading', 'Why principals choose <strong>Excigent</strong>', $about_id);
    update_field('field_ab_why_body',    'We bring the market knowledge, channel relationships, and commercial discipline that principals need to succeed in complex, competitive markets.', $about_id);
    update_field('field_ab_why_cta', ['url'=>home_url('/contact/'),'title'=>'Let\'s Talk','target'=>''], $about_id);
    update_field('field_ab_why_items', [
        ['item_text'=>'Deep principal relationships across broadband, ICT, and security'],
        ['item_text'=>'Established channel networks across North America, LATAM & Caribbean'],
        ['item_text'=>'Disciplined commercial execution — from strategy to revenue'],
        ['item_text'=>'Trade show visibility and industry event representation'],
        ['item_text'=>'Market intelligence and strategic positioning support'],
    ], $about_id);

    // Leadership
    update_field('field_ab_lead_heading', 'Experienced <strong>leadership</strong> you can count on', $about_id);
    update_field('field_ab_lead_subtext', 'Our principals bring decades of combined expertise in broadband, ICT, and security markets across the Americas.', $about_id);

    // Process
    update_field('field_ab_proc_heading', 'A <strong>six-step</strong> path to market success', $about_id);
    update_field('field_ab_proc_body',    'Every engagement follows a structured approach — from market assessment to sustainable revenue growth.', $about_id);
    update_field('field_ab_proc_cta1', ['url'=>home_url('/services/'),'title'=>'Our Services','target'=>''], $about_id);
    update_field('field_ab_proc_cta2', ['url'=>home_url('/contact/'),'title'=>'Get Started',  'target'=>''], $about_id);
    update_field('field_ab_proc_steps', [
        ['step_number'=>'01','step_title'=>'Assess',   'step_body'=>'Market fit & opportunity sizing.'],
        ['step_number'=>'02','step_title'=>'Align',    'step_body'=>'Right partners & channels identified.'],
        ['step_number'=>'03','step_title'=>'Build',    'step_body'=>'Strategic relationships developed.'],
        ['step_number'=>'04','step_title'=>'Position', 'step_body'=>'Solutions positioned effectively.'],
        ['step_number'=>'05','step_title'=>'Activate', 'step_body'=>'Visibility opportunities executed.'],
        ['step_number'=>'06','step_title'=>'Grow',     'step_body'=>'Pipeline, traction & revenue.'],
    ], $about_id);

    echo "About page ACF fields populated!\n";
}

/* ═══════════════════════════════════════════
   3. SERVICES PAGE
   ═══════════════════════════════════════════ */
echo "\n--- SERVICES PAGE ---\n";
$services_id = excigent_create_page( 'Services', 'services', 'page-services.php' );
if ( $services_id ) {
    update_field('field_sv_hero_eyebrow', 'What We Do', $services_id);
    update_field('field_sv_hero_heading', 'Our <strong>Services</strong> &amp; Capabilities', $services_id);
    update_field('field_sv_hero_subtext', 'Comprehensive market development across broadband, ICT, and security — from strategy to revenue.', $services_id);
    update_field('field_sv_hero_btn1', ['url'=>home_url('/contact/'),'title'=>'Get Started',  'target'=>''], $services_id);
    update_field('field_sv_hero_btn2', ['url'=>home_url('/about/'),  'title'=>'About Us',     'target'=>''], $services_id);

    // Services list (3 main sections)
    update_field('field_sv_services_list', [
        [
            'section_id'    => 'broadband',
            'section_class' => 'light',
            'section_flip'  => 0,
            'svc_eyebrow'   => 'Broadband',
            'svc_heading'   => '<strong>Broadband</strong> &amp; Connectivity',
            'svc_body'      => 'We represent leading broadband principals across fiber, wireless, and FTTH solutions — helping them build channel presence and grow revenue across the Americas.',
            'svc_cta'       => ['url'=>home_url('/contact/'),'title'=>'Learn More','target'=>''],
            'svc_items'     => [
                ['item_number'=>'01','item_title'=>'Fiber & FTTH',         'item_body'=>'Residential and commercial fiber deployment and sales programs.'],
                ['item_number'=>'02','item_title'=>'Fixed Wireless Access', 'item_body'=>'Last-mile wireless solutions for underserved and enterprise markets.'],
                ['item_number'=>'03','item_title'=>'Channel Development',   'item_body'=>'Building and activating dealer and reseller networks.'],
                ['item_number'=>'04','item_title'=>'Market Strategy',       'item_body'=>'Go-to-market planning, positioning, and commercial execution.'],
            ],
        ],
        [
            'section_id'    => 'ict',
            'section_class' => 'dark',
            'section_flip'  => 1,
            'svc_eyebrow'   => 'ICT',
            'svc_heading'   => '<strong>ICT</strong> Infrastructure',
            'svc_body'      => 'Cabling, data centers, LAN — we connect ICT principals with the integrators, contractors, and enterprise customers who drive volume in this market.',
            'svc_cta'       => ['url'=>home_url('/contact/'),'title'=>'Learn More','target'=>''],
            'svc_items'     => [
                ['item_number'=>'01','item_title'=>'Structured Cabling',   'item_body'=>'Cat6A, fiber, and specialty cabling for enterprise environments.'],
                ['item_number'=>'02','item_title'=>'Data Center Solutions','item_body'=>'Racks, cooling, power, and physical infrastructure.'],
                ['item_number'=>'03','item_title'=>'LAN & Switching',      'item_body'=>'Enterprise networking from access to core.'],
                ['item_number'=>'04','item_title'=>'AV Integration',       'item_body'=>'Pro-AV and unified communications infrastructure.'],
            ],
        ],
        [
            'section_id'    => 'security',
            'section_class' => 'light',
            'section_flip'  => 0,
            'svc_eyebrow'   => 'Security',
            'svc_heading'   => 'Physical <strong>Security</strong> Solutions',
            'svc_body'      => 'Access control, surveillance, and biometrics — we represent security principals and connect them with the integrators and end-users who protect critical environments.',
            'svc_cta'       => ['url'=>home_url('/contact/'),'title'=>'Learn More','target'=>''],
            'svc_items'     => [
                ['item_number'=>'01','item_title'=>'Access Control',    'item_body'=>'Card, credential, and biometric entry management systems.'],
                ['item_number'=>'02','item_title'=>'Video Surveillance', 'item_body'=>'IP cameras, NVRs, and intelligent analytics platforms.'],
                ['item_number'=>'03','item_title'=>'Biometrics',        'item_body'=>'Fingerprint, facial recognition, and multi-factor solutions.'],
                ['item_number'=>'04','item_title'=>'Intrusion Detection','item_body'=>'Perimeter, motion, and alarm systems for enterprise environments.'],
            ],
        ],
    ], $services_id);

    // Partner pillars
    update_field('field_sv_partners', [
        ['pillar_title'=>'Principal Representation', 'pillar_body'=>'We act as your in-market commercial team — representing your brand, products, and value proposition across the Americas.'],
        ['pillar_title'=>'Channel Activation',       'pillar_body'=>'We identify, recruit, and activate the right dealers, distributors, and integrators for your solutions.'],
        ['pillar_title'=>'Market Development',       'pillar_body'=>'From trade shows to targeted campaigns, we build visibility and preference for your brand in competitive markets.'],
        ['pillar_title'=>'Revenue Execution',        'pillar_body'=>'We don\'t just open doors — we drive commercial outcomes through disciplined pipeline management and follow-through.'],
    ], $services_id);
    update_field('field_sv_partners_cta', ['url'=>home_url('/contact/'),'title'=>'Become a Principal Partner','target'=>''], $services_id);

    // Process steps
    update_field('field_sv_process', [
        ['step_label'=>'01','step_title'=>'Assess',    'step_desc'=>'Market fit & opportunity sizing'],
        ['step_label'=>'02','step_title'=>'Align',     'step_desc'=>'Right partners & channels'],
        ['step_label'=>'03','step_title'=>'Build',     'step_desc'=>'Strategic relationships'],
        ['step_label'=>'04','step_title'=>'Position',  'step_desc'=>'Effective market positioning'],
        ['step_label'=>'05','step_title'=>'Activate',  'step_desc'=>'Visibility & campaigns'],
        ['step_label'=>'06','step_title'=>'Grow',      'step_desc'=>'Pipeline & revenue'],
    ], $services_id);

    echo "Services page ACF fields populated!\n";
}

/* ═══════════════════════════════════════════
   4. CONTACT PAGE
   ═══════════════════════════════════════════ */
echo "\n--- CONTACT PAGE ---\n";
$contact_id = excigent_create_page( 'Contact', 'contact', 'page-contact.php' );
if ( $contact_id ) {
    update_field('field_ct_col_heading', 'Get in touch', $contact_id);
    update_field('field_ct_col_subtext', 'Ready to explore how Excigent can help you grow across the Americas? Reach out and we\'ll connect you with the right person.', $contact_id);
    echo "Contact page ACF fields populated!\n";
}

/* ═══════════════════════════════════════════
   5. NEWS / MEDIA PAGE
   ═══════════════════════════════════════════ */
echo "\n--- NEWS PAGE ---\n";
$news_id = excigent_create_page( 'News & Media', 'news', 'default' );
if ( $news_id ) {
    echo "News page ready (uses archive.php for blog posts).\n";
}

/* ═══════════════════════════════════════════
   6. PRIMARY NAV MENU
   ═══════════════════════════════════════════ */
echo "\n--- NAV MENU ---\n";
$menu_name  = 'Primary Navigation';
$menu_obj   = wp_get_nav_menu_object( $menu_name );
$menu_id    = $menu_obj ? $menu_obj->term_id : wp_create_nav_menu( $menu_name );

if ( is_wp_error($menu_id) ) {
    echo "ERROR creating menu: " . $menu_id->get_error_message() . "\n";
} else {
    // Remove existing items so we don't duplicate
    $existing_items = wp_get_nav_menu_items( $menu_id );
    if ( $existing_items ) {
        foreach ( $existing_items as $item ) {
            wp_delete_post( $item->ID, true );
        }
    }

    $menu_items = [
        ['title'=>'Home',         'url'=>home_url('/'),          'type'=>'custom',    'object_id'=>0,            'object'=>''],
        ['title'=>'About',        'url'=>home_url('/about/'),     'type'=>'post_type', 'object_id'=>$about_id,    'object'=>'page'],
        ['title'=>'Services',     'url'=>home_url('/services/'),  'type'=>'post_type', 'object_id'=>$services_id, 'object'=>'page'],
        ['title'=>'News & Media', 'url'=>home_url('/news/'),      'type'=>'post_type', 'object_id'=>$news_id,     'object'=>'page'],
        ['title'=>'Contact',      'url'=>home_url('/contact/'),   'type'=>'post_type', 'object_id'=>$contact_id,  'object'=>'page'],
    ];

    foreach ( $menu_items as $order => $item ) {
        $args = [
            'menu-item-title'     => $item['title'],
            'menu-item-status'    => 'publish',
            'menu-item-position'  => $order + 1,
        ];
        if ( $item['type'] === 'custom' ) {
            $args['menu-item-url']  = $item['url'];
            $args['menu-item-type'] = 'custom';
        } else {
            $args['menu-item-object-id'] = $item['object_id'];
            $args['menu-item-object']    = $item['object'];
            $args['menu-item-type']      = 'post_type';
        }
        wp_update_nav_menu_item( $menu_id, 0, $args );
    }

    // Assign menu to primary location
    $locations = get_theme_mod('nav_menu_locations', []);
    $locations['primary'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);

    echo "Primary nav menu set up with " . count($menu_items) . " items.\n";
}

/* ═══════════════════════════════════════════
   7. FLUSH REWRITE RULES
   ═══════════════════════════════════════════ */
flush_rewrite_rules();
echo "\nRewrite rules flushed.\n";

/* ═══════════════════════════════════════════
   8. VERIFY
   ═══════════════════════════════════════════ */
echo "\n=== SETUP COMPLETE ===\n";
echo "Home:     " . home_url('/') . "\n";
echo "About:    " . home_url('/about/') . "\n";
echo "Services: " . home_url('/services/') . "\n";
echo "Contact:  " . home_url('/contact/') . "\n";
echo "News:     " . home_url('/news/') . "\n";

// Verify ACF data on home page
echo "\n=== VERIFY HOME ACF ===\n";
$test_heading = get_field('field_hero_heading', $home_id);
echo "Hero heading: " . ($test_heading ? 'POPULATED ✓' : 'EMPTY ✗') . "\n";
$test_events = get_field('field_events_carousel', $home_id);
echo "Events count: " . ($test_events ? count($test_events) : 0) . "\n";
$test_stats = get_field('field_home_stats', $home_id);
echo "Stats count: " . ($test_stats ? count($test_stats) : 0) . "\n";

echo "\nDONE. Delete this file from server!\n";
