<?php
/**
 * ACF Local Field Groups — Excigent Tech Partners
 * Registered via acf_add_local_field_group() — no DB required.
 * Included from functions.php only when ACF is active.
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

/* ══════════════════════════════════════
   HELPER: build a repeater sub-field
   ══════════════════════════════════════ */
function _excigent_sub( $key, $label, $name, $type = 'text', $extra = [] ) {
    return array_merge( [ 'key' => $key, 'label' => $label, 'name' => $name, 'type' => $type ], $extra );
}

/* ══════════════════════════════════════════════════════
   1. FRONT PAGE FIELDS
   ══════════════════════════════════════════════════════ */
acf_add_local_field_group( [
    'key'      => 'group_front_page',
    'title'    => 'Home Page — Content',
    'fields'   => [

        /* Hero */
        [ 'key'=>'field_hero_heading',  'label'=>'Hero Heading',  'name'=>'hero_heading',  'type'=>'wysiwyg',  'tabs'=>'visual', 'toolbar'=>'basic', 'media_upload'=>0 ],
        [ 'key'=>'field_hero_subtext',  'label'=>'Hero Subtext',  'name'=>'hero_subtext',  'type'=>'textarea', 'rows'=>2 ],
        [ 'key'=>'field_hero_btn1',     'label'=>'Hero CTA — Primary',  'name'=>'hero_btn_primary',  'type'=>'link' ],
        [ 'key'=>'field_hero_btn2',     'label'=>'Hero CTA — Secondary','name'=>'hero_btn_secondary','type'=>'link' ],

        /* Events carousel (ACF repeater) */
        [
            'key'   => 'field_events_carousel',
            'label' => 'Events Carousel',
            'name'  => 'events_carousel',
            'type'  => 'repeater',
            'button_label' => 'Add Event',
            'sub_fields' => [
                _excigent_sub('field_ev_month',   'Month (3 letters)', 'month',    'text'),
                _excigent_sub('field_ev_day',     'Day',               'day',      'text'),
                _excigent_sub('field_ev_type',    'Event Type Label',  'type',     'text'),
                _excigent_sub('field_ev_name',    'Event Name',        'name',     'text'),
                _excigent_sub('field_ev_loc',     'Location',          'location', 'text'),
                _excigent_sub('field_ev_tag',     'Tag',               'tag',      'text'),
                _excigent_sub('field_ev_gradient','Card Gradient CSS', 'gradient', 'text', ['placeholder'=>'linear-gradient(135deg,#061F2E,#004569 60%,#0061B3)']),
            ],
        ],
        [ 'key'=>'field_events_heading',    'label'=>'Events Section Heading',   'name'=>'events_section_heading',    'type'=>'text', 'default_value'=>'Upcoming <strong>Events</strong>' ],
        [ 'key'=>'field_events_view_all',   'label'=>'Events — View All Link',   'name'=>'events_view_all_link',      'type'=>'link' ],

        /* About snapshot */
        [ 'key'=>'field_about_eyebrow',     'label'=>'About Eyebrow',   'name'=>'about_eyebrow',   'type'=>'text',     'default_value'=>'About Excigent' ],
        [ 'key'=>'field_about_heading',     'label'=>'About Heading',   'name'=>'about_heading',   'type'=>'wysiwyg',  'tabs'=>'visual','toolbar'=>'basic','media_upload'=>0 ],
        [ 'key'=>'field_about_para1',       'label'=>'About Para 1',    'name'=>'about_para1',     'type'=>'textarea', 'rows'=>3 ],
        [ 'key'=>'field_about_para2',       'label'=>'About Para 2',    'name'=>'about_para2',     'type'=>'textarea', 'rows'=>3 ],
        [ 'key'=>'field_about_cta',         'label'=>'About CTA',       'name'=>'about_cta',       'type'=>'link' ],

        /* Stats (repeater) */
        [
            'key'   => 'field_home_stats',
            'label' => 'Stats',
            'name'  => 'home_stats',
            'type'  => 'repeater',
            'layout'=> 'table',
            'button_label' => 'Add Stat',
            'sub_fields' => [
                _excigent_sub('field_stat_num',    'Number',  'num',    'text'),
                _excigent_sub('field_stat_suffix', 'Suffix',  'suffix', 'text'),
                _excigent_sub('field_stat_label',  'Label',   'label',  'text'),
            ],
        ],

        /* Process CTA */
        [ 'key'=>'field_process_cta',     'label'=>'Process CTA',      'name'=>'process_cta',    'type'=>'link' ],
        [ 'key'=>'field_convergence_cta', 'label'=>'Convergence CTA',  'name'=>'convergence_cta','type'=>'link' ],
    ],
    'location' => [ [ [ 'param'=>'page_type', 'operator'=>'==', 'value'=>'front_page' ] ] ],
    'menu_order' => 10,
    'position'   => 'normal',
] );

/* ══════════════════════════════════════════════════════
   2. ABOUT PAGE FIELDS
   ══════════════════════════════════════════════════════ */
acf_add_local_field_group( [
    'key'   => 'group_about_page',
    'title' => 'About Page — Content',
    'fields' => [

        /* Hero */
        [ 'key'=>'field_ab_hero_eyebrow', 'label'=>'Hero Eyebrow', 'name'=>'hero_eyebrow', 'type'=>'text', 'default_value'=>'About Excigent' ],
        [ 'key'=>'field_ab_hero_heading', 'label'=>'Hero Heading', 'name'=>'hero_heading', 'type'=>'wysiwyg', 'tabs'=>'visual','toolbar'=>'basic','media_upload'=>0 ],
        [ 'key'=>'field_ab_hero_subtext', 'label'=>'Hero Subtext', 'name'=>'hero_subtext', 'type'=>'textarea','rows'=>2 ],
        [ 'key'=>'field_ab_hero_btn1',    'label'=>'Hero CTA — Primary',   'name'=>'hero_btn_primary',   'type'=>'link' ],
        [ 'key'=>'field_ab_hero_btn2',    'label'=>'Hero CTA — Secondary', 'name'=>'hero_btn_secondary', 'type'=>'link' ],

        /* Who We Are */
        [ 'key'=>'field_ab_who_eyebrow',  'label'=>'Who We Are — Eyebrow', 'name'=>'who_eyebrow', 'type'=>'text' ],
        [ 'key'=>'field_ab_who_heading',  'label'=>'Who We Are — Heading', 'name'=>'who_heading', 'type'=>'wysiwyg','tabs'=>'visual','toolbar'=>'basic','media_upload'=>0 ],
        [ 'key'=>'field_ab_who_body',     'label'=>'Who We Are — Body',    'name'=>'who_body',    'type'=>'textarea','rows'=>4 ],
        [ 'key'=>'field_ab_who_cta',      'label'=>'Who We Are — CTA',     'name'=>'who_cta',     'type'=>'link' ],

        /* Stats repeater */
        [
            'key'   => 'field_ab_stats',
            'label' => 'Stats',
            'name'  => 'about_stats',
            'type'  => 'repeater',
            'layout'=> 'table',
            'button_label' => 'Add Stat',
            'sub_fields' => [
                _excigent_sub('field_ab_stat_num',    'Number',  'stat_number', 'text'),
                _excigent_sub('field_ab_stat_suffix', 'Suffix',  'stat_suffix', 'text'),
                _excigent_sub('field_ab_stat_label',  'Label',   'stat_label',  'text'),
            ],
        ],

        /* What We Do */
        [ 'key'=>'field_ab_mkt_eyebrow', 'label'=>'Markets — Eyebrow',  'name'=>'markets_eyebrow', 'type'=>'text' ],
        [ 'key'=>'field_ab_mkt_heading', 'label'=>'Markets — Heading',  'name'=>'markets_heading', 'type'=>'wysiwyg','tabs'=>'visual','toolbar'=>'basic','media_upload'=>0 ],
        [ 'key'=>'field_ab_mkt_body',    'label'=>'Markets — Body',     'name'=>'markets_body',    'type'=>'textarea','rows'=>3 ],
        [ 'key'=>'field_ab_mkt_cta',     'label'=>'Markets — CTA',      'name'=>'markets_cta',     'type'=>'link' ],
        [
            'key'   => 'field_ab_mkt_items',
            'label' => 'Markets — Items',
            'name'  => 'markets_items',
            'type'  => 'repeater',
            'button_label' => 'Add Item',
            'sub_fields' => [
                _excigent_sub('field_ab_it_num',   'Number Label','item_number','text'),
                _excigent_sub('field_ab_it_title', 'Title',       'item_title', 'text'),
                _excigent_sub('field_ab_it_body',  'Body',        'item_body',  'textarea', ['rows'=>2]),
            ],
        ],

        /* Network regions */
        [
            'key'   => 'field_ab_regions',
            'label' => 'Network Regions',
            'name'  => 'network_regions',
            'type'  => 'repeater',
            'layout'=> 'table',
            'button_label' => 'Add Region',
            'sub_fields' => [
                _excigent_sub('field_ab_rg_name', 'Region Name', 'region_name', 'text'),
                _excigent_sub('field_ab_rg_meta', 'Region Meta', 'region_meta', 'text'),
            ],
        ],

        /* Why Engage */
        [ 'key'=>'field_ab_why_eyebrow', 'label'=>'Why — Eyebrow', 'name'=>'why_eyebrow', 'type'=>'text' ],
        [ 'key'=>'field_ab_why_heading', 'label'=>'Why — Heading', 'name'=>'why_heading', 'type'=>'wysiwyg','tabs'=>'visual','toolbar'=>'basic','media_upload'=>0 ],
        [ 'key'=>'field_ab_why_body',    'label'=>'Why — Body',    'name'=>'why_body',    'type'=>'textarea','rows'=>3 ],
        [ 'key'=>'field_ab_why_cta',     'label'=>'Why — CTA',     'name'=>'why_cta',     'type'=>'link' ],
        [
            'key'   => 'field_ab_why_items',
            'label' => 'Why — Bullet Items',
            'name'  => 'why_items',
            'type'  => 'repeater',
            'layout'=> 'table',
            'button_label' => 'Add Bullet',
            'sub_fields' => [
                _excigent_sub('field_ab_wi_text', 'Text', 'item_text', 'text'),
            ],
        ],

        /* Leadership */
        [ 'key'=>'field_ab_lead_heading', 'label'=>'Leadership Heading', 'name'=>'leadership_heading', 'type'=>'wysiwyg','tabs'=>'visual','toolbar'=>'basic','media_upload'=>0 ],
        [ 'key'=>'field_ab_lead_subtext', 'label'=>'Leadership Subtext', 'name'=>'leadership_subtext', 'type'=>'textarea','rows'=>2 ],
        [
            'key'   => 'field_ab_team',
            'label' => 'Leadership Team',
            'name'  => 'leadership_team',
            'type'  => 'repeater',
            'button_label' => 'Add Team Member',
            'sub_fields' => [
                _excigent_sub('field_ab_tm_name',  'Name',        'member_name',  'text'),
                _excigent_sub('field_ab_tm_creds', 'Credentials', 'member_creds', 'text'),
                _excigent_sub('field_ab_tm_bio',   'Bio',         'member_bio',   'textarea', ['rows'=>3]),
                _excigent_sub('field_ab_tm_photo', 'Photo',       'member_photo', 'image',    ['return_format'=>'array','preview_size'=>'medium']),
            ],
        ],

        /* Process */
        [ 'key'=>'field_ab_proc_heading', 'label'=>'Process Heading', 'name'=>'process_heading', 'type'=>'wysiwyg','tabs'=>'visual','toolbar'=>'basic','media_upload'=>0 ],
        [ 'key'=>'field_ab_proc_body',    'label'=>'Process Body',    'name'=>'process_body',    'type'=>'textarea','rows'=>3 ],
        [ 'key'=>'field_ab_proc_cta1',    'label'=>'Process CTA 1',   'name'=>'process_cta1',    'type'=>'link' ],
        [ 'key'=>'field_ab_proc_cta2',    'label'=>'Process CTA 2',   'name'=>'process_cta2',    'type'=>'link' ],
        [
            'key'   => 'field_ab_proc_steps',
            'label' => 'Process Steps',
            'name'  => 'process_steps',
            'type'  => 'repeater',
            'layout'=> 'table',
            'button_label' => 'Add Step',
            'sub_fields' => [
                _excigent_sub('field_ab_ps_num',   'Step Label', 'step_number', 'text'),
                _excigent_sub('field_ab_ps_title', 'Title',      'step_title',  'text'),
                _excigent_sub('field_ab_ps_body',  'Body',       'step_body',   'textarea', ['rows'=>2]),
            ],
        ],
    ],
    'location'   => [ [ [ 'param'=>'page_template', 'operator'=>'==', 'value'=>'page-about.php' ] ] ],
    'menu_order' => 10,
    'position'   => 'normal',
] );

/* ══════════════════════════════════════════════════════
   3. SERVICES PAGE FIELDS
   ══════════════════════════════════════════════════════ */
acf_add_local_field_group( [
    'key'    => 'group_services_page',
    'title'  => 'Services Page — Content',
    'fields' => [
        [ 'key'=>'field_sv_hero_eyebrow', 'label'=>'Hero Eyebrow', 'name'=>'hero_eyebrow', 'type'=>'text' ],
        [ 'key'=>'field_sv_hero_heading', 'label'=>'Hero Heading', 'name'=>'hero_heading', 'type'=>'wysiwyg','tabs'=>'visual','toolbar'=>'basic','media_upload'=>0 ],
        [ 'key'=>'field_sv_hero_subtext', 'label'=>'Hero Subtext', 'name'=>'hero_subtext', 'type'=>'textarea','rows'=>2 ],
        [ 'key'=>'field_sv_hero_btn1',    'label'=>'Hero CTA 1',   'name'=>'hero_btn_primary',   'type'=>'link' ],
        [ 'key'=>'field_sv_hero_btn2',    'label'=>'Hero CTA 2',   'name'=>'hero_btn_secondary', 'type'=>'link' ],
        [
            'key'   => 'field_sv_services_list',
            'label' => 'Services (repeater of sections)',
            'name'  => 'services_list',
            'type'  => 'repeater',
            'button_label' => 'Add Service Section',
            'sub_fields' => [
                _excigent_sub('field_sv_svc_id',      'Section ID (anchor)',  'section_id',    'text'),
                _excigent_sub('field_sv_svc_class',   'Color (light/dark)',   'section_class', 'select', ['choices'=>['light'=>'Light','dark'=>'Dark']]),
                _excigent_sub('field_sv_svc_flip',    'Flip layout?',         'section_flip',  'true_false'),
                _excigent_sub('field_sv_svc_eyebrow', 'Eyebrow',             'svc_eyebrow',   'text'),
                _excigent_sub('field_sv_svc_heading', 'Heading',             'svc_heading',   'wysiwyg'),
                _excigent_sub('field_sv_svc_body',    'Body',                'svc_body',      'textarea'),
                _excigent_sub('field_sv_svc_cta',     'CTA Link',            'svc_cta',       'link'),
                [
                    'key'   => 'field_sv_svc_items',
                    'label' => 'Items (4)',
                    'name'  => 'svc_items',
                    'type'  => 'repeater',
                    'button_label' => 'Add Item',
                    'sub_fields' => [
                        _excigent_sub('field_sv_it_num',   'Number Label','item_number','text'),
                        _excigent_sub('field_sv_it_title', 'Title',       'item_title', 'text'),
                        _excigent_sub('field_sv_it_body',  'Body',        'item_body',  'textarea',['rows'=>2]),
                    ],
                ],
            ],
        ],
        /* Partners pillars */
        [
            'key'   => 'field_sv_partners',
            'label' => 'Partner Pillars',
            'name'  => 'partner_pillars',
            'type'  => 'repeater',
            'button_label' => 'Add Pillar',
            'sub_fields' => [
                _excigent_sub('field_sv_pl_icon',  'Icon SVG path', 'pillar_icon', 'textarea', ['rows'=>2]),
                _excigent_sub('field_sv_pl_title', 'Title',         'pillar_title','text'),
                _excigent_sub('field_sv_pl_body',  'Body',          'pillar_body', 'textarea', ['rows'=>2]),
            ],
        ],
        [ 'key'=>'field_sv_partners_cta', 'label'=>'Partners CTA', 'name'=>'partners_cta', 'type'=>'link' ],
        /* Process */
        [
            'key'   => 'field_sv_process',
            'label' => 'Process Steps',
            'name'  => 'process_steps',
            'type'  => 'repeater',
            'layout'=> 'table',
            'button_label' => 'Add Step',
            'sub_fields' => [
                _excigent_sub('field_sv_ps_label', 'Label', 'step_label', 'text'),
                _excigent_sub('field_sv_ps_title', 'Title', 'step_title', 'text'),
                _excigent_sub('field_sv_ps_desc',  'Desc',  'step_desc',  'text'),
            ],
        ],
    ],
    'location'   => [ [ [ 'param'=>'page_template', 'operator'=>'==', 'value'=>'page-services.php' ] ] ],
    'menu_order' => 10,
    'position'   => 'normal',
] );

/* ══════════════════════════════════════════════════════
   4. CONTACT PAGE FIELDS
   ══════════════════════════════════════════════════════ */
acf_add_local_field_group( [
    'key'    => 'group_contact_page',
    'title'  => 'Contact Page — Content',
    'fields' => [
        [ 'key'=>'field_ct_col_heading', 'label'=>'Info Column Heading', 'name'=>'contact_col_heading', 'type'=>'text', 'default_value'=>'Get in touch' ],
        [ 'key'=>'field_ct_col_subtext', 'label'=>'Info Column Subtext', 'name'=>'contact_col_subtext', 'type'=>'textarea','rows'=>2 ],
    ],
    'location'   => [ [ [ 'param'=>'page_template', 'operator'=>'==', 'value'=>'page-contact.php' ] ] ],
    'menu_order' => 10,
] );

/* ══════════════════════════════════════════════════════
   5. OPTIONS PAGE (site-wide fields)
   ══════════════════════════════════════════════════════ */
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( [
        'page_title'  => 'Site Settings',
        'menu_title'  => 'Site Settings',
        'menu_slug'   => 'excigent-settings',
        'capability'  => 'edit_posts',
        'redirect'    => false,
        'icon_url'    => 'dashicons-admin-customizer',
    ] );

    acf_add_local_field_group( [
        'key'    => 'group_options',
        'title'  => 'Site-wide Settings',
        'fields' => [
            /* Affiliations logos */
            [
                'key'   => 'field_opt_affiliations',
                'label' => 'Affiliation Logos',
                'name'  => 'affiliations_logos',
                'type'  => 'repeater',
                'layout'=> 'table',
                'button_label' => 'Add Logo',
                'sub_fields' => [
                    _excigent_sub('field_opt_aff_logo', 'Logo (SVG/PNG)', 'logo', 'image', ['return_format'=>'array','preview_size'=>'thumbnail']),
                    _excigent_sub('field_opt_aff_alt',  'Alt Text',       'alt',  'text'),
                ],
            ],
            [ 'key'=>'field_opt_aff_heading', 'label'=>'Affiliations Heading', 'name'=>'affiliations_heading', 'type'=>'text', 'default_value'=>'Our Affiliations & Industry Memberships' ],
            /* Subscribe */
            [ 'key'=>'field_opt_sub_heading', 'label'=>'Subscribe Heading', 'name'=>'subscribe_heading', 'type'=>'wysiwyg','tabs'=>'visual','toolbar'=>'basic','media_upload'=>0 ],
            [ 'key'=>'field_opt_sub_subtext', 'label'=>'Subscribe Subtext', 'name'=>'subscribe_subtext', 'type'=>'textarea','rows'=>2 ],
        ],
        'location' => [ [ [ 'param'=>'options_page', 'operator'=>'==', 'value'=>'excigent-settings' ] ] ],
    ] );
}

/* ══════════════════════════════════════════════════════
   6. EVENTS CPT FIELDS
   ══════════════════════════════════════════════════════ */
acf_add_local_field_group( [
    'key'    => 'group_event_cpt',
    'title'  => 'Event Details',
    'fields' => [
        [ 'key'=>'field_ev_date',     'label'=>'Event Date',  'name'=>'event_date',     'type'=>'date_picker', 'display_format'=>'d/m/Y', 'return_format'=>'Y-m-d' ],
        [ 'key'=>'field_ev_location', 'label'=>'Location',    'name'=>'event_location', 'type'=>'text' ],
        [ 'key'=>'field_ev_type_cpt', 'label'=>'Event Type',  'name'=>'event_type',     'type'=>'text', 'default_value'=>'Trade Show' ],
        [ 'key'=>'field_ev_tag_cpt',  'label'=>'Tag/Market',  'name'=>'event_tag',      'type'=>'text' ],
        [ 'key'=>'field_ev_gradient_cpt','label'=>'Card Gradient CSS','name'=>'event_gradient','type'=>'text', 'placeholder'=>'linear-gradient(135deg,#061F2E,#004569 60%,#0061B3)' ],
        [ 'key'=>'field_ev_link',     'label'=>'Event URL',   'name'=>'event_link',     'type'=>'url' ],
        [ 'key'=>'field_ev_coming_soon_text', 'label'=>'Coming Soon Message', 'name'=>'event_coming_soon_text', 'type'=>'textarea', 'rows'=>3, 'instructions'=>'Shown in the banner when no full content is added. Leave blank for the default message.' ],
        [ 'key'=>'field_ev_booth',    'label'=>'Booth / Extra Detail', 'name'=>'event_booth', 'type'=>'text', 'instructions'=>'e.g. "Booth #C2145" or "Hall 4, Stand 210". Shown as a badge in the banner.' ],
        [ 'key'=>'field_ev_cta_desc', 'label'=>'CTA Description', 'name'=>'event_cta_desc', 'type'=>'text', 'instructions'=>'Line shown in the dark CTA block. Leave blank for default.' ],
    ],
    'location' => [ [ [ 'param'=>'post_type', 'operator'=>'==', 'value'=>'event' ] ] ],
] );

/* ══════════════════════════════════════════════════════
   7. TEAM PAGE FIELDS
   ══════════════════════════════════════════════════════ */
acf_add_local_field_group( [
    'key'    => 'group_team_page',
    'title'  => 'Team Page Content',
    'fields' => [
        [ 'key'=>'field_tp_hero_eyebrow', 'label'=>'Hero Eyebrow',    'name'=>'hero_eyebrow',    'type'=>'text',    'default_value'=>'Our Leadership' ],
        [ 'key'=>'field_tp_hero_heading', 'label'=>'Hero Heading',    'name'=>'hero_heading',    'type'=>'wysiwyg', 'toolbar'=>'basic', 'media_upload'=>0 ],
        [ 'key'=>'field_tp_hero_subtext', 'label'=>'Hero Subtext',    'name'=>'hero_subtext',    'type'=>'textarea','rows'=>3 ],
        [ 'key'=>'field_tp_sec_eyebrow',  'label'=>'Section Eyebrow', 'name'=>'section_eyebrow', 'type'=>'text',    'default_value'=>'The Excigent Team' ],
        [ 'key'=>'field_tp_sec_heading',  'label'=>'Section Heading', 'name'=>'section_heading', 'type'=>'wysiwyg', 'toolbar'=>'basic', 'media_upload'=>0 ],
        [ 'key'=>'field_tp_sec_lead',      'label'=>'Section Lead',      'name'=>'section_lead',      'type'=>'textarea','rows'=>3 ],
        [ 'key'=>'field_tp_stats_eyebrow', 'label'=>'Stats Eyebrow',    'name'=>'stats_eyebrow',     'type'=>'text',    'default_value'=>'By the Numbers' ],
        [ 'key'=>'field_tp_stats_heading', 'label'=>'Stats Heading',    'name'=>'stats_heading',     'type'=>'wysiwyg', 'toolbar'=>'basic', 'media_upload'=>0 ],
        [
            'key'        => 'field_tp_stats',
            'label'      => 'Stats',
            'name'       => 'team_stats',
            'type'       => 'repeater',
            'min'        => 0,
            'max'        => 6,
            'layout'     => 'table',
            'button_label' => 'Add Stat',
            'sub_fields' => [
                [ 'key'=>'field_tp_stat_num',    'label'=>'Number', 'name'=>'stat_num',    'type'=>'text', 'wrapper'=>['width'=>'25'] ],
                [ 'key'=>'field_tp_stat_suffix', 'label'=>'Suffix', 'name'=>'stat_suffix', 'type'=>'text', 'wrapper'=>['width'=>'15'] ],
                [ 'key'=>'field_tp_stat_label',  'label'=>'Label',  'name'=>'stat_label',  'type'=>'text', 'wrapper'=>['width'=>'60'] ],
            ],
        ],
        [ 'key'=>'field_tp_cta_heading', 'label'=>'CTA Heading', 'name'=>'cta_heading', 'type'=>'wysiwyg', 'toolbar'=>'basic', 'media_upload'=>0 ],
        [ 'key'=>'field_tp_cta_subtext', 'label'=>'CTA Subtext', 'name'=>'cta_subtext', 'type'=>'textarea','rows'=>2 ],
        [ 'key'=>'field_tp_cta_btn1',    'label'=>'CTA Button 1','name'=>'cta_btn1',    'type'=>'link' ],
        [ 'key'=>'field_tp_cta_btn2',    'label'=>'CTA Button 2','name'=>'cta_btn2',    'type'=>'link' ],
    ],
    'location' => [ [ [ 'param'=>'page_template', 'operator'=>'==', 'value'=>'page-team.php' ] ] ],
] );

/* ══════════════════════════════════════════════════════
   8. TEAM MEMBER CPT FIELDS
   ══════════════════════════════════════════════════════ */
acf_add_local_field_group( [
    'key'    => 'group_team_member_cpt',
    'title'  => 'Team Member Details',
    'fields' => [
        [ 'key'=>'field_tm_creds',      'label'=>'Credentials',       'name'=>'member_creds',      'type'=>'text' ],
        [ 'key'=>'field_tm_bio',        'label'=>'Short Bio',         'name'=>'member_bio',        'type'=>'textarea', 'rows'=>4 ],
        [ 'key'=>'field_tm_full_bio',   'label'=>'Full Bio (Detail Page)', 'name'=>'member_full_bio', 'type'=>'textarea', 'rows'=>7, 'instructions'=>'Longer bio shown on the individual team member page. Falls back to Short Bio if empty.' ],
        [ 'key'=>'field_tm_expertise',  'label'=>'Expertise Tags',    'name'=>'member_expertise',  'type'=>'text', 'instructions'=>'Comma-separated. e.g. Access Control, Video Surveillance, Program Leadership' ],
        [ 'key'=>'field_tm_linkedin',   'label'=>'LinkedIn URL',      'name'=>'member_linkedin',   'type'=>'url' ],
        [ 'key'=>'field_tm_market',     'label'=>'Primary Market',    'name'=>'member_market',     'type'=>'text', 'instructions'=>'e.g. Security, Broadband, ICT — shown as a badge in the hero.' ],
        [ 'key'=>'field_tm_order',      'label'=>'Display Order',     'name'=>'member_order',      'type'=>'number', 'default_value'=>10 ],
    ],
    'location' => [ [ [ 'param'=>'post_type', 'operator'=>'==', 'value'=>'team_member' ] ] ],
] );

/* ══════════════════════════════════════════════════════
   9. NEWS CPT FIELDS
   ══════════════════════════════════════════════════════ */
acf_add_local_field_group( [
    'key'    => 'group_news_cpt',
    'title'  => 'News Article Details',
    'fields' => [
        [ 'key'=>'field_news_tag',        'label'=>'Article Tag',    'name'=>'news_tag',        'type'=>'select',
          'choices'=>['Featured Article'=>'Featured Article','Trade Article'=>'Trade Article','Newsletter'=>'Newsletter','Video'=>'Video','Industry News'=>'Industry News'],
          'default_value'=>'Trade Article', 'return_format'=>'value' ],
        [ 'key'=>'field_news_read_time',  'label'=>'Read / Watch Time', 'name'=>'news_read_time', 'type'=>'text', 'placeholder'=>'5 min read' ],
        [ 'key'=>'field_news_excerpt',    'label'=>'Card Excerpt',   'name'=>'news_excerpt',    'type'=>'textarea','rows'=>3, 'instructions'=>'Short summary shown on cards (1-2 sentences).' ],
        [ 'key'=>'field_news_is_featured','label'=>'Featured Card',  'name'=>'news_is_featured','type'=>'true_false','default_value'=>0, 'instructions'=>'Use dark featured gradient on thumbnail.' ],
        [ 'key'=>'field_news_is_video',   'label'=>'Video Post',     'name'=>'news_is_video',   'type'=>'true_false','default_value'=>0 ],
        [ 'key'=>'field_news_video_url',  'label'=>'Video URL',      'name'=>'news_video_url',  'type'=>'url', 'instructions'=>'YouTube / Vimeo link (used on detail page).' ],
    ],
    'location' => [ [ [ 'param'=>'post_type', 'operator'=>'==', 'value'=>'news' ] ] ],
] );

/* ══════════════════════════════════════════════════════
   10. NEWS & EVENTS PAGE FIELDS
   ══════════════════════════════════════════════════════ */
acf_add_local_field_group( [
    'key'    => 'group_news_events_page',
    'title'  => 'News & Events Page Content',
    'fields' => [
        [ 'key'=>'field_ne_hero_eyebrow',    'label'=>'Hero Eyebrow',       'name'=>'hero_eyebrow',      'type'=>'text',    'default_value'=>'News & Events' ],
        [ 'key'=>'field_ne_hero_heading',    'label'=>'Hero Heading',       'name'=>'hero_heading',      'type'=>'wysiwyg', 'toolbar'=>'basic','media_upload'=>0 ],
        [ 'key'=>'field_ne_hero_subtext',    'label'=>'Hero Subtext',       'name'=>'hero_subtext',      'type'=>'textarea','rows'=>2 ],
        [ 'key'=>'field_ne_events_eyebrow',  'label'=>'Events Eyebrow',     'name'=>'events_eyebrow',    'type'=>'text',    'default_value'=>'Upcoming Events' ],
        [ 'key'=>'field_ne_events_heading',  'label'=>'Events Heading',     'name'=>'events_heading',    'type'=>'wysiwyg', 'toolbar'=>'basic','media_upload'=>0 ],
        [ 'key'=>'field_ne_news_eyebrow',    'label'=>'News Eyebrow',       'name'=>'news_eyebrow',      'type'=>'text',    'default_value'=>'Latest News' ],
        [ 'key'=>'field_ne_news_heading',    'label'=>'News Section Heading','name'=>'news_section_heading','type'=>'wysiwyg','toolbar'=>'basic','media_upload'=>0 ],
    ],
    'location' => [ [ [ 'param'=>'page_template', 'operator'=>'==', 'value'=>'page-news-events.php' ] ] ],
] );
