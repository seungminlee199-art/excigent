<?php
/**
 * Template Name: About
 * Template Post Type: page
 */
get_header();

function _af( $k, $fb = '' ) { return function_exists( 'get_field' ) ? ( get_field($k) ?: $fb ) : $fb; }
?>

<!-- PAGE HERO -->
<header class="page-hero">
  <div class="page-hero-inner">
    <span class="eyebrow"><span class="eyebrow-dot"></span><?php echo esc_html( _af('hero_eyebrow','About Excigent') ); ?></span>
    <h1><?php echo excigent_h( 'hero_heading', 'Built on <strong>decades</strong> of leadership<br>at the intersection of technology.' ); ?></h1>
    <p><?php echo esc_html( _af('hero_subtext','Excigent Tech Partners was formed to help innovative companies turn strong potential into market traction and revenue growth — at the convergence of Broadband, ICT, and Security.') ); ?></p>
    <div class="page-hero-actions">
      <?php excigent_link('hero_btn_primary',   home_url('/team/'), 'Meet the Team', 'btn-fill'); ?>
      <?php excigent_link('hero_btn_secondary', home_url('/contact/'),          'Work With Us',   'btn-ghost'); ?>
    </div>
  </div>
</header>

<!-- SECTION 1 — WHO WE ARE (light) -->
<section class="section light">
  <div class="section-inner">
    <div class="section-split">
      <div class="split-lead reveal from-left" style="--d:0s">
        <div class="split-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
        </div>
        <span class="section-eyebrow"><?php echo esc_html( _af('who_eyebrow','Who We Are') ); ?></span>
        <h2><?php echo excigent_h( 'who_heading', 'A commercial agency built for <strong>market development</strong>.' ); ?></h2>
        <p><?php echo esc_html( _af('who_body','Excigent Tech Partners is a commercial agency and market development partner helping innovative companies expand across North America, Latin America, and the Caribbean through strategy, channel development, market positioning, and disciplined commercial execution.') ); ?></p>
        <?php excigent_link('who_cta', home_url('/services/'), 'Explore Our Services', 'btn-fill dark'); ?>
      </div>
      <div class="split-body">
        <div class="split-stats">
          <?php
          $stats = function_exists('get_field') ? get_field('about_stats') : null;
          $default_stats = [
            ['stat_number'=>'80','stat_suffix'=>'+','stat_label'=>'Years Combined Experience'],
            ['stat_number'=>'3', 'stat_suffix'=>'', 'stat_label'=>'Core Technology Markets'],
            ['stat_number'=>'3', 'stat_suffix'=>'', 'stat_label'=>'Geographic Regions'],
            ['stat_number'=>'100','stat_suffix'=>'+','stat_label'=>'Partner Relationships'],
          ];
          foreach ( ($stats ?: $default_stats) as $i => $s ) :
            $delay = round($i * 0.06, 2);
          ?>
          <div class="stat reveal" style="--d:<?php echo $delay; ?>s">
            <div class="stat-num">
              <span class="count" data-target="<?php echo esc_attr($s['stat_number']); ?>">0</span>
              <?php if ( $s['stat_suffix'] ) : ?><span class="suffix"><?php echo esc_html($s['stat_suffix']); ?></span><?php endif; ?>
            </div>
            <div class="stat-label"><?php echo esc_html($s['stat_label']); ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2 — WHAT WE DO (dark) -->
<section class="section dark">
  <div class="section-inner">
    <div class="section-split flip">
      <div class="split-lead reveal from-left" style="--d:0s">
        <div class="split-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        </div>
        <span class="section-eyebrow"><?php echo esc_html( _af('markets_eyebrow','What We Do') ); ?></span>
        <h2><?php echo excigent_h( 'markets_heading', 'Commercial execution across <strong>three critical</strong> technology markets.' ); ?></h2>
        <p><?php echo esc_html( _af('markets_body','We position ourselves at the convergence of Broadband, ICT, and Security — markets where we bring deep expertise, trusted relationships, and proven commercial frameworks.') ); ?></p>
        <?php excigent_link('markets_cta', home_url('/services/'), 'View Our Services', 'btn-fill'); ?>
      </div>
      <div class="split-body">
        <div class="split-items">
          <?php
          $items = function_exists('get_field') ? get_field('markets_items') : null;
          $default_items = [
            ['num'=>'01 / Connect','title'=>'Broadband','body'=>'Fiber infrastructure, FTTH/FTTx, OSP networks, CPE, and wireless broadband solutions across the Americas.'],
            ['num'=>'02 / Enable','title'=>'ICT','body'=>'Structured cabling, optical LAN, DAS, data center infrastructure, and network connectivity systems.'],
            ['num'=>'03 / Protect','title'=>'Security','body'=>'Access control, biometrics, video surveillance, intrusion systems, and integrated security platforms.'],
            ['num'=>'Our Focus','title'=>'Convergence','body'=>'The greatest value is realized when Broadband, ICT, and Security come together — this is where Excigent sees growing opportunity.'],
          ];
          foreach ( ($items ?: $default_items) as $i => $it ) :
            $delay = round(0.06 + $i * 0.06, 2);
          ?>
          <div class="split-item reveal" style="--d:<?php echo $delay; ?>s">
            <div class="split-item-num"><?php echo esc_html($it['num'] ?? $it['item_number'] ?? ''); ?></div>
            <h4><?php echo esc_html($it['title'] ?? $it['item_title'] ?? ''); ?></h4>
            <p><?php echo esc_html($it['body'] ?? $it['item_body'] ?? ''); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 3 — GLOBAL NETWORK (light) -->
<section class="section light" id="network">
  <div class="section-inner">
    <div class="network-grid">
      <div class="network-copy">
        <span class="section-eyebrow reveal" style="--d:0s">Geographic Reach</span>
        <h2 class="section-title reveal" style="--d:0.06s">A footprint that spans<br>the <strong>Americas</strong>.</h2>
        <p class="section-lead reveal" style="--d:0.12s">Trusted relationships and on-the-ground commercial intelligence across three interconnected regions — giving principals a faster, smarter path to traction.</p>
        <ul class="region-list">
          <?php
          $regions = function_exists('get_field') ? get_field('network_regions') : null;
          $default_regions = [
            ['name'=>'North America','meta'=>'USA · Canada · Mexico'],
            ['name'=>'Latin America','meta'=>'Central &amp; South America'],
            ['name'=>'Caribbean',    'meta'=>'Greater &amp; Lesser Antilles'],
          ];
          foreach ( ($regions ?: $default_regions) as $i => $r ) :
            $delay = round(0.05 + $i * 0.10, 2);
          ?>
          <li class="region reveal from-left" style="--d:<?php echo $delay; ?>s">
            <span class="region-dot"></span>
            <span class="region-name"><?php echo esc_html($r['name'] ?? $r['region_name'] ?? ''); ?></span>
            <span class="region-meta"><?php echo wp_kses_post($r['meta'] ?? $r['region_meta'] ?? ''); ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="map-stage reveal zoom" style="--d:0.1s">
        <svg class="map-svg" viewBox="0 0 500 400" fill="none" aria-hidden="true">
          <g class="map-land">
            <path d="M70 60 Q90 50 130 55 L170 50 L200 60 L230 50 L260 60 L280 80 L290 110 L280 140 L260 150 L240 145 L220 160 L200 170 L180 175 L160 165 L140 170 L120 160 L100 150 L85 130 L75 110 L70 90 Z"/>
            <path d="M200 175 L210 195 L215 215 L220 230 L225 240 L235 245 L230 255 L240 265"/>
            <path d="M245 250 Q270 245 290 260 L305 280 L315 305 L320 330 L310 355 L295 370 L280 375 L265 365 L255 345 L250 320 L245 295 L240 275 Z"/>
            <circle cx="245" cy="195" r="2.5"/><circle cx="255" cy="200" r="2"/><circle cx="266" cy="200" r="3"/><circle cx="278" cy="198" r="2"/><circle cx="290" cy="205" r="2.5"/><circle cx="302" cy="210" r="2"/>
          </g>
          <g class="map-pulse"><circle class="map-pulse-ring" cx="170" cy="115" r="6"/><circle class="map-pulse-ring r2" cx="170" cy="115" r="6"/><circle class="map-pulse-dot" cx="170" cy="115" r="4"/></g>
          <g class="map-pulse"><circle class="map-pulse-ring" cx="270" cy="200" r="6"/><circle class="map-pulse-ring r2" cx="270" cy="200" r="6"/><circle class="map-pulse-dot" cx="270" cy="200" r="4"/></g>
          <g class="map-pulse"><circle class="map-pulse-ring" cx="285" cy="320" r="6"/><circle class="map-pulse-ring r2" cx="285" cy="320" r="6"/><circle class="map-pulse-dot" cx="285" cy="320" r="4"/></g>
        </svg>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4 — WHY COMPANIES ENGAGE US (dark) -->
<section class="section dark" id="why">
  <div class="section-inner">
    <div class="section-split">
      <div class="split-lead reveal from-left" style="--d:0s">
        <div class="split-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        </div>
        <span class="section-eyebrow"><?php echo esc_html( _af('why_eyebrow','Why Companies Engage Us') ); ?></span>
        <h2><?php echo excigent_h( 'why_heading', 'Not just relationships — <strong>commercial outcomes</strong>.' ); ?></h2>
        <p><?php echo esc_html( _af('why_body','We bring the experience, relationships, and commercial discipline to turn market potential into real revenue growth across the Americas.') ); ?></p>
        <?php excigent_link('why_cta', home_url('/contact/'), 'Start a Conversation', 'btn-fill'); ?>
      </div>
      <ul class="why-list reveal" style="--d:0.08s">
        <?php
        $why_items = function_exists('get_field') ? get_field('why_items') : null;
        $default_why = [
          'Commercial agency and market development focus',
          'Senior leadership experience across broadband, ICT, and security',
          'Channel-building orientation, not just transactional representation',
          'Cross-border market engagement capability across North America, Latin America, and the Caribbean',
          'Bilingual English- and Spanish-language capability to support cross-border engagement',
          'Partner-driven model that expands technical and commercial capability',
          'Disciplined execution supported by market insight and strong industry relationships',
        ];
        $why_data = $why_items ?: array_map( fn($t) => ['item_text'=>$t], $default_why );
        foreach ( $why_data as $wi ) : ?>
        <li class="why-item">
          <span class="why-check"><svg viewBox="0 0 12 12" fill="none" stroke="white" stroke-width="3"><polyline points="2 6 5 9 10 3"/></svg></span>
          <span><?php echo esc_html($wi['item_text'] ?? $wi); ?></span>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- SECTION 5 — LEADERSHIP (light) -->
<section class="section light" id="leadership">
  <div class="section-inner">
    <span class="section-eyebrow reveal" style="--d:0s">Leadership</span>
    <h2 class="section-title reveal" style="--d:0.06s"><?php echo excigent_h( 'leadership_heading', 'Three industry veterans. <strong>One team</strong>.' ); ?></h2>
    <p class="section-lead reveal" style="--d:0.12s"><?php echo esc_html( _af('leadership_subtext','80+ combined years across broadband engineering, digital infrastructure, and security — with the relationships that move markets.') ); ?></p>
    <div class="team-grid">
      <?php
      $team = function_exists('get_field') ? get_field('leadership_team') : null;
      $base_url = get_template_directory_uri() . '/assets/images/';
      $default_team = [
        ['name'=>'Robert Lopez','creds'=>'Broadband Engineering &amp; Design','bio'=>'Broadband engineering and design leader with 20+ years of experience supporting major network deployments and delivering construction-ready infrastructure solutions.','photo_url'=>$base_url.'robert-lopez.png','photo_alt'=>'Robert Lopez — Broadband Engineering Leader, Excigent Tech Partners'],
        ['name'=>'Paul Weintraub','creds'=>'RCDD · RTPM · ESS · TECH','bio'=>'Digital infrastructure leader with 30+ years of experience across broadband, ICT, data center, security, and communications markets.','photo_url'=>$base_url.'paul-weintraub.png','photo_alt'=>'Paul Weintraub RCDD — Digital Infrastructure Leader, Excigent Tech Partners'],
        ['name'=>'John Centofanti','creds'=>'Security Industry Leadership','bio'=>'Security industry leader with 30+ years of experience in sales, business development, and program leadership across commercial and public-sector markets.','photo_url'=>$base_url.'john-centofanti.png','photo_alt'=>'John Centofanti — Security Industry Leader, Excigent Tech Partners'],
      ];
      $team_data = $team ?: $default_team;
      foreach ( $team_data as $i => $member ) :
        $delay = round(0.05 + $i * 0.10, 2);
        $name  = esc_html($member['name'] ?? $member['member_name'] ?? '');
        $creds = wp_kses_post($member['creds'] ?? $member['member_creds'] ?? '');
        $bio   = esc_html($member['bio'] ?? $member['member_bio'] ?? '');
        // Photo: ACF image array or fallback URL
        $photo_acf = $member['photo'] ?? $member['member_photo'] ?? null;
        if ($photo_acf && is_array($photo_acf)) {
          $photo_url = esc_url($photo_acf['url']);
          $photo_alt = esc_attr($photo_acf['alt'] ?: $name);
        } else {
          $photo_url = esc_url($member['photo_url'] ?? '');
          $photo_alt = esc_attr($member['photo_alt'] ?? $name);
        }
      ?>
      <div class="team-card reveal" style="--d:<?php echo $delay; ?>s">
        <div class="team-photo">
          <?php if ($photo_url) : ?>
          <img src="<?php echo $photo_url; ?>" alt="<?php echo $photo_alt; ?>" />
          <?php endif; ?>
        </div>
        <div class="team-body">
          <h3><?php echo $name; ?></h3>
          <div class="team-creds"><?php echo $creds; ?></div>
          <p class="team-bio"><?php echo $bio; ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SECTION 6 — HOW IT'S DONE (dark) -->
<section class="section dark">
  <div class="section-inner">
    <div class="section-split flip">
      <div class="split-lead reveal from-left" style="--d:0s">
        <div class="split-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <span class="section-eyebrow">How It's Done</span>
        <h2><?php echo excigent_h( 'process_heading', 'A disciplined path from <strong>assessment</strong> to revenue growth.' ); ?></h2>
        <p><?php echo esc_html( _af('process_body','Every engagement follows a structured six-step commercial framework — moving principals from market fit through to sustainable revenue growth across the Americas.') ); ?></p>
        <div style="display:flex;gap:1rem;flex-wrap:wrap;">
          <?php excigent_link('process_cta1', home_url('/contact/'),          'Start a Conversation', 'btn-fill'); ?>
          <?php excigent_link('process_cta2', home_url('/services/#process'), 'Full Process',          'btn-ghost'); ?>
        </div>
      </div>
      <div class="split-body">
        <div class="split-items">
          <?php
          $steps = function_exists('get_field') ? get_field('process_steps') : null;
          $default_steps = [
            ['num'=>'01 — Assess','title'=>'Market Fit &amp; Opportunity Sizing','body'=>'We evaluate where your solution has genuine traction potential across North America, Latin America, and the Caribbean.'],
            ['num'=>'02 — Align','title'=>'Right Partners &amp; Channels','body'=>'We map the distribution landscape and identify the channel relationships most likely to move your product.'],
            ['num'=>'03 — Build','title'=>'Strategic Relationships','body'=>'We make introductions, facilitate conversations, and build the commercial relationships that deliver results.'],
            ['num'=>'04–06 — Position · Activate · Grow','title'=>'From Visibility to Revenue','body'=>'Solution positioning, trade events, outreach, pipeline development, and ongoing commercial execution to sustain growth.'],
          ];
          foreach ( ($steps ?: $default_steps) as $i => $st ) :
            $delay = round(0.06 + $i * 0.06, 2);
          ?>
          <div class="split-item reveal" style="--d:<?php echo $delay; ?>s">
            <div class="split-item-num"><?php echo esc_html($st['num'] ?? $st['step_number'] ?? ''); ?></div>
            <h4><?php echo wp_kses_post($st['title'] ?? $st['step_title'] ?? ''); ?></h4>
            <p><?php echo esc_html($st['body'] ?? $st['step_body'] ?? ''); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_template_part( 'template-parts/affiliations' ); ?>
<?php get_template_part( 'template-parts/subscribe', null, ['show_name'=>false] ); ?>
<?php get_footer(); ?>
