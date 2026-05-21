<?php
/**
 * Template Name: Services
 * Template Post Type: page
 */
get_header();

function _sf( $k, $fb = '' ) { return function_exists( 'get_field' ) ? ( get_field($k) ?: $fb ) : $fb; }

/* 3 core services — each has: eyebrow, heading, body, cta, and 4 items */
$services = function_exists('get_field') ? get_field('services_list') : null;
$default_services = [
  [
    'section_id'   => 'channel',
    'section_class'=> 'light',
    'section_flip' => false,
    'eyebrow'      => '01 / Service',
    'heading'      => 'Channel &amp; <strong>Business Development</strong>',
    'body'         => 'We build and manage channel programs that connect principals with the right distributors, resellers, and integrators across the Americas — driving real pipeline and revenue growth.',
    'cta_label'    => 'Discuss This Service',
    'cta_url'      => 'contact',
    'icon_path'    => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
    'items' => [
      ['num'=>'Development','title'=>'Channel Development','body'=>'Identifying, recruiting, and onboarding the right channel partners — distributors, resellers, and integrators matched to your product and market.'],
      ['num'=>'Management','title'=>'Channel Management','body'=>'Ongoing relationship management, enablement, and performance tracking to keep partners engaged and producing.'],
      ['num'=>'Partnerships','title'=>'OEM / ODM / JDM','body'=>'Strategic OEM, ODM, and JDM partnership development for principals looking to expand through manufacturing or co-branding arrangements.'],
      ['num'=>'Revenue','title'=>'Revenue Growth Activation','body'=>'Converting channel relationships into active pipeline and closed revenue — through structured commercial programs and consistent follow-through.'],
    ],
  ],
  [
    'section_id'   => 'positioning',
    'section_class'=> 'dark',
    'section_flip' => true,
    'eyebrow'      => '02 / Service',
    'heading'      => '<strong>Market Positioning</strong> &amp; Intelligence',
    'body'         => 'We help principals position their solutions effectively in complex, competitive markets — through strategic intelligence, specification engagement, and standards body representation.',
    'cta_label'    => 'Discuss This Service',
    'cta_url'      => 'contact',
    'icon_path'    => '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
    'items' => [
      ['num'=>'Positioning','title'=>'Solution Positioning','body'=>'Crafting and communicating compelling value propositions that resonate with buyers, specifiers, and channel partners in each target market.'],
      ['num'=>'Intelligence','title'=>'Market Intelligence','body'=>'Ongoing competitive analysis, buyer intelligence, and market trend monitoring to keep principals ahead of shifts in their space.'],
      ['num'=>'Specifications','title'=>'Specification Positioning','body'=>'Engaging architects, engineers, and consultants to include principal products in project specifications — driving demand at the design stage.'],
      ['num'=>'Standards','title'=>'Standards Representation','body'=>'Representing principals in standards bodies and trade associations to build credibility and influence market direction in their technology area.'],
    ],
  ],
  [
    'section_id'   => 'marketing',
    'section_class'=> 'light',
    'section_flip' => false,
    'eyebrow'      => '03 / Service',
    'heading'      => 'Marketing, <strong>Visibility</strong> &amp; Support',
    'body'         => 'We amplify principal presence in the markets that matter — through trade content, event management, public engagement, and targeted marketing support across the Americas.',
    'cta_label'    => 'Discuss This Service',
    'cta_url'      => 'contact',
    'icon_path'    => '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>',
    'items' => [
      ['num'=>'Content','title'=>'Trade Articles &amp; Newsletters','body'=>'Authored articles, case studies, and newsletters that establish principal thought leadership and maintain visibility in industry media.'],
      ['num'=>'Events','title'=>'Trade Show &amp; Event Management','body'=>'End-to-end support for trade show participation — from booth strategy and logistics to meeting facilitation and follow-up activation.'],
      ['num'=>'Speaking','title'=>'Public Speaking &amp; Webinars','body'=>'Representing principals on panels, keynotes, and webinars to build brand authority and engage target audiences directly.'],
      ['num'=>'Digital','title'=>'Marketing Support','body'=>'Collateral development, digital presence support, and brand visibility campaigns tailored to each principal\'s market and audience.'],
    ],
  ],
];
?>

<!-- PAGE HERO -->
<header class="page-hero">
  <div class="page-hero-inner">
    <span class="eyebrow"><span class="eyebrow-dot"></span><?php echo esc_html( _sf('hero_eyebrow','What We Offer') ); ?></span>
    <h1><?php echo wp_kses_post( _sf('hero_heading','Commercial &amp; <strong>market development</strong>,<br>delivered as a partnership.') ); ?></h1>
    <p><?php echo esc_html( _sf('hero_subtext','We help principals establish channels, position solutions effectively, and expand visibility through disciplined commercial and market development support across the Americas.') ); ?></p>
    <div class="page-hero-actions">
      <?php excigent_link('hero_btn_primary',   home_url('/contact/'),    'Start a Conversation', 'btn-fill'); ?>
      <?php excigent_link('hero_btn_secondary', '#process',               'Our Process',           'btn-ghost'); ?>
    </div>
  </div>
</header>

<!-- SERVICES 1–3 -->
<?php
$svc_data = $services ?: $default_services;
foreach ( $svc_data as $svc ) :
  $id      = esc_attr($svc['section_id'] ?? '');
  $cls     = esc_attr($svc['section_class'] ?? 'light');
  $flip    = !empty($svc['section_flip']);
  $eyebrow = esc_html($svc['eyebrow'] ?? $svc['svc_eyebrow'] ?? '');
  $heading = wp_kses_post($svc['heading'] ?? $svc['svc_heading'] ?? '');
  $body    = esc_html($svc['body'] ?? $svc['svc_body'] ?? '');
  $cta_url = function_exists('get_field') && !empty($svc['svc_cta']) ? esc_url($svc['svc_cta']['url']) : esc_url(home_url('/contact/'));
  $cta_lbl = esc_html($svc['cta_label'] ?? 'Discuss This Service');
  $icon    = $svc['icon_path'] ?? '';
  $items   = $svc['items'] ?? $svc['svc_items'] ?? [];
  $btn_cls = ($cls === 'dark') ? 'btn-fill' : 'btn-fill dark';
?>
<section class="section <?php echo $cls; ?>" id="<?php echo $id; ?>">
  <div class="section-inner">
    <div class="section-split <?php echo $flip ? 'flip' : ''; ?>">
      <div class="split-lead reveal from-left" style="--d:0s">
        <?php if ($icon) : ?>
        <div class="split-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $icon; ?></svg>
        </div>
        <?php endif; ?>
        <span class="section-eyebrow"><?php echo $eyebrow; ?></span>
        <h2><?php echo $heading; ?></h2>
        <p><?php echo $body; ?></p>
        <a href="<?php echo $cta_url; ?>" class="<?php echo $btn_cls; ?>"><?php echo $cta_lbl; ?></a>
      </div>
      <div class="split-body">
        <div class="split-items">
          <?php foreach ($items as $i => $it) :
            $delay = round(0.06 + $i * 0.06, 2);
          ?>
          <div class="split-item reveal" style="--d:<?php echo $delay; ?>s">
            <div class="split-item-num"><?php echo esc_html($it['num'] ?? $it['item_number'] ?? ''); ?></div>
            <h4><?php echo wp_kses_post($it['title'] ?? $it['item_title'] ?? ''); ?></h4>
            <p><?php echo esc_html($it['body'] ?? $it['item_body'] ?? ''); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endforeach; ?>

<!-- PRODUCTS & PARTNERS (tint) -->
<section class="section tint" id="partners">
  <div class="section-inner">
    <span class="section-eyebrow reveal" style="--d:0s">04 / Service</span>
    <h2 class="section-title reveal" style="--d:0.06s">Products &amp; <strong>Partners</strong></h2>
    <p class="section-lead reveal" style="--d:0.12s">Excigent represents and supports a curated portfolio of technology principals across Broadband, ICT, and Security — connecting innovative companies with the right channels and markets across the Americas.</p>
    <div class="pillars" style="margin-top:3rem;">
      <?php
      $partners = function_exists('get_field') ? get_field('partner_pillars') : null;
      $default_partners = [
        ['icon'=>'<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>','title'=>'Broadband Principals','body'=>'Fiber infrastructure, FTTH/FTTx equipment, OSP solutions, broadband CPE, and fixed wireless access technology companies.'],
        ['icon'=>'<rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>','title'=>'ICT &amp; Infrastructure','body'=>'Structured cabling, optical LAN, data center, DAS, in-building wireless, and network connectivity solution manufacturers.'],
        ['icon'=>'<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>','title'=>'Security Manufacturers','body'=>'Access control, biometrics, video surveillance, intrusion detection, and integrated physical security platform companies.'],
        ['icon'=>'<circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/>','title'=>'Become a Partner','body'=>'We work with a select portfolio of principals at a time — ensuring every partner relationship gets dedicated focus and commercial execution.'],
      ];
      foreach ( ($partners ?: $default_partners) as $i => $p ) :
        $delay = round(0.05 + $i * 0.07, 2);
      ?>
      <div class="pillar reveal" style="--d:<?php echo $delay; ?>s">
        <div class="pillar-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $p['icon'] ?? $p['pillar_icon'] ?? ''; ?></svg>
        </div>
        <h3><?php echo wp_kses_post($p['title'] ?? $p['pillar_title'] ?? ''); ?></h3>
        <p><?php echo esc_html($p['body'] ?? $p['pillar_body'] ?? ''); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:3rem;">
      <?php excigent_link('partners_cta', home_url('/contact/'), 'Inquire About Partnership', 'btn-fill dark'); ?>
    </div>
  </div>
</section>

<!-- PROCESS (deep) -->
<section class="section deep" id="process">
  <div class="section-inner">
    <span class="section-eyebrow reveal" style="--d:0s">How We Work</span>
    <h2 class="section-title reveal" style="--d:0.06s">A <strong>disciplined six-step</strong> path<br>from market fit to revenue growth.</h2>
    <p class="section-lead reveal" style="--d:0.12s">Not introductions — execution. Each engagement moves principals through six stages designed to convert potential into sustainable commercial outcomes.</p>
    <div class="process-track reveal" style="--d:0.2s">
      <div class="process-line-bg"></div>
      <div class="process-line-fill"></div>
      <div class="steps">
        <?php
        $process = function_exists('get_field') ? get_field('process_steps') : null;
        $default_process = [
          ['label'=>'01','title'=>'Assess','desc'=>'Market fit &amp; opportunity sizing.'],
          ['label'=>'02','title'=>'Align','desc'=>'Right partners &amp; channels identified.'],
          ['label'=>'03','title'=>'Build','desc'=>'Strategic relationships developed.'],
          ['label'=>'04','title'=>'Position','desc'=>'Solutions positioned effectively.'],
          ['label'=>'05','title'=>'Activate','desc'=>'Visibility opportunities executed.'],
          ['label'=>'06','title'=>'Grow','desc'=>'Pipeline, traction &amp; revenue.'],
        ];
        foreach ( ($process ?: $default_process) as $step ) : ?>
        <div class="step">
          <div class="step-node"><?php echo esc_html($step['label'] ?? $step['step_label'] ?? ''); ?></div>
          <h4><?php echo esc_html($step['title'] ?? $step['step_title'] ?? ''); ?></h4>
          <p><?php echo wp_kses_post($step['desc'] ?? $step['step_desc'] ?? ''); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- CTA band -->
<?php get_template_part('template-parts/subscribe', null, [
  'heading'   => 'Ready to <strong>accelerate</strong> your market growth?',
  'subtext'   => "Let's talk about how Excigent can help your company build channels and grow revenue across the Americas.",
  'cta_links' => [
    ['url' => home_url('/contact/'),   'label' => 'Start a Conversation', 'class' => 'btn-fill', 'style' => 'background:#fff;color:#004569;'],
    ['url' => home_url('/expertise/'), 'label' => 'View Our Expertise',   'class' => 'btn-ghost'],
  ],
]); ?>

<?php get_footer(); ?>
