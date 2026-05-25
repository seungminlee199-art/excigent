<?php
/**
 * Single template for 'team_member' CPT
 */
get_header();
the_post();

$name      = get_the_title();
$creds     = get_field('member_creds')     ?: '';
$short_bio = get_field('member_bio')       ?: '';
$full_bio  = get_field('member_full_bio')  ?: $short_bio;
$expertise = get_field('member_expertise') ?: '';
$linkedin  = get_field('member_linkedin')  ?: '';
$market    = get_field('member_market')    ?: '';

// Photo — featured image first, then name-based fallback
$base_url = get_template_directory_uri() . '/assets/images/';
$thumb    = get_the_post_thumbnail_url( null, 'large' );
if ( ! $thumb ) {
    $lower = strtolower( $name );
    if      ( strpos($lower,'robert') !== false || strpos($lower,'lopez') !== false )      $thumb = $base_url . 'robert-lopez.png';
    elseif  ( strpos($lower,'john')   !== false || strpos($lower,'centofanti') !== false ) $thumb = $base_url . 'john-centofanti.png';
    else                                                                                    $thumb = $base_url . 'paul-weintraub.png';
}

$expertise_tags = $expertise ? array_map('trim', explode(',', $expertise)) : [];
?>

<style>
/* ── Team member hero ── */
.tm-hero { background: linear-gradient(135deg,#061F2E 0%,#0F405A 55%,#1260A7 100%); padding: 6rem 2rem 5rem; position: relative; overflow: hidden; }
.tm-hero::before { content:''; position:absolute; inset:0; background-image:radial-gradient(circle,rgba(255,255,255,.07) 1px,transparent 1px); background-size:24px 24px; pointer-events:none; }
.tm-back { display:inline-flex; align-items:center; gap:.4rem; font-size:.82rem; font-weight:500; color:rgba(255,255,255,.6); text-decoration:none; margin-bottom:3rem; position:relative; z-index:2; transition:color .2s; }
.tm-back:hover { color:#fff; }
.tm-back svg { width:16px; height:16px; }
.tm-hero-grid { display:grid; grid-template-columns:320px 1fr; gap:4rem; align-items:center; max-width:1000px; margin:0 auto; position:relative; z-index:2; }
.tm-photo-col { position:relative; }
.tm-photo-frame { position:relative; border-radius:20px; overflow:hidden; box-shadow:0 30px 80px rgba(0,0,0,.45); aspect-ratio:3/4; background:#0a2f45; }
.tm-photo-frame img { width:100%; height:100%; object-fit:cover; object-position:top center; display:block; }
.tm-photo-frame::after { content:''; position:absolute; inset:0; background:linear-gradient(to top,rgba(6,31,46,.6) 0%,transparent 50%); pointer-events:none; }
.tm-market-badge { position:absolute; bottom:1.2rem; left:1.2rem; z-index:3; font-size:.65rem; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:#fff; background:var(--blue); border-radius:20px; padding:.28rem .85rem; }
.tm-copy { }
.tm-eyebrow { font-size:.67rem; font-weight:700; letter-spacing:.2em; text-transform:uppercase; color:rgba(184,219,255,.8); display:block; margin-bottom:1rem; }
.tm-name { font-size:clamp(2rem,4vw,3.2rem); font-weight:700; color:#fff; margin:0 0 .6rem; letter-spacing:-.025em; line-height:1.1; }
.tm-creds { font-size:.95rem; font-weight:500; color:rgba(255,255,255,.55); margin-bottom:2rem; letter-spacing:.01em; }
.tm-divider { width:48px; height:3px; background:var(--blue); border-radius:2px; margin-bottom:1.8rem; }
.tm-bio-text { font-size:1.05rem; line-height:1.82; color:rgba(255,255,255,.82); margin-bottom:2rem; }
.tm-actions { display:flex; gap:1rem; flex-wrap:wrap; }
.tm-linkedin { display:inline-flex; align-items:center; gap:.55rem; font-size:.82rem; font-weight:600; color:#fff; background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.2); border-radius:8px; padding:.55rem 1.1rem; text-decoration:none; transition:background .2s,border-color .2s; }
.tm-linkedin:hover { background:rgba(255,255,255,.18); border-color:rgba(255,255,255,.4); }
.tm-linkedin svg { width:16px; height:16px; fill:currentColor; }

/* ── Expertise tags section ── */
.tm-expertise { background:#F4F8FC; padding:4rem 2rem; }
.tm-expertise-inner { max-width:1000px; margin:0 auto; }
.tm-expertise-inner .section-eyebrow { display:block; margin-bottom:1.2rem; }
.tm-expertise-inner h2 { font-size:1.45rem; font-weight:700; color:var(--navy); margin:0 0 2rem; }
.tm-tags { display:flex; flex-wrap:wrap; gap:.75rem; }
.tm-tag { font-size:.82rem; font-weight:600; color:var(--navy); background:#fff; border:1.5px solid #d0dff0; border-radius:30px; padding:.4rem 1.1rem; letter-spacing:.01em; transition:background .2s,border-color .2s,color .2s; }
.tm-tag:hover { background:var(--navy); color:#fff; border-color:var(--navy); }

/* ── More from the team ── */
.tm-more { background:#fff; padding:5rem 2rem; }
.tm-more-inner { max-width:1000px; margin:0 auto; }
.tm-more-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:1.6rem; margin-top:2.5rem; }
.tm-peer-card { display:flex; align-items:center; gap:1.4rem; background:#F4F8FC; border:1px solid #e2edf7; border-radius:14px; padding:1.6rem; text-decoration:none; transition:box-shadow .2s,transform .2s; }
.tm-peer-card:hover { box-shadow:0 10px 32px rgba(15,64,90,.12); transform:translateY(-3px); }
.tm-peer-photo { width:72px; height:72px; border-radius:50%; overflow:hidden; flex-shrink:0; background:#d0dff0; }
.tm-peer-photo img { width:100%; height:100%; object-fit:cover; object-position:top center; }
.tm-peer-name { font-size:1rem; font-weight:700; color:var(--navy); margin:0 0 .25rem; }
.tm-peer-creds { font-size:.8rem; color:#5a6a7e; margin:0 0 .5rem; }
.tm-peer-arrow { font-size:.85rem; color:var(--blue); font-weight:600; }

/* ── Responsive ── */
@media (max-width:768px) {
  .tm-hero-grid { grid-template-columns:1fr; gap:2.5rem; }
  .tm-photo-frame { aspect-ratio:4/3; max-height:340px; }
  .tm-more-grid { grid-template-columns:1fr; }
  .tm-peer-card { }
}
@media (max-width:480px) {
  .tm-hero { padding:5rem 1.2rem 4rem; }
  .tm-expertise, .tm-more { padding:3rem 1.2rem; }
}
</style>

<!-- TEAM MEMBER HERO -->
<section class="tm-hero">
  <div style="max-width:1000px;margin:0 auto;position:relative;z-index:2;">
    <a href="<?php echo esc_url( home_url('/team/') ); ?>" class="tm-back">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
      Back to Team
    </a>
  </div>

  <div class="tm-hero-grid">

    <!-- Photo -->
    <div class="tm-photo-col">
      <div class="tm-photo-frame">
        <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($name); ?>" />
        <?php if ($market) : ?><span class="tm-market-badge"><?php echo esc_html($market); ?></span><?php endif; ?>
      </div>
    </div>

    <!-- Copy -->
    <div class="tm-copy">
      <span class="tm-eyebrow">Excigent Leadership</span>
      <h1 class="tm-name"><?php echo esc_html($name); ?></h1>
      <?php if ($creds) : ?><p class="tm-creds"><?php echo esc_html($creds); ?></p><?php endif; ?>
      <div class="tm-divider"></div>
      <?php if ($full_bio) : ?><p class="tm-bio-text"><?php echo nl2br(esc_html($full_bio)); ?></p><?php endif; ?>
      <div class="tm-actions">
        <?php if ($linkedin) : ?>
        <a href="<?php echo esc_url($linkedin); ?>" class="tm-linkedin" target="_blank" rel="noopener noreferrer">
          <svg viewBox="0 0 24 24"><path d="M4.98 3.5C4.98 4.881 3.87 6 2.49 6S0 4.881 0 3.5 1.11 1 2.49 1s2.49 1.119 2.49 2.5zM.22 8h4.54v14H.22V8zm7.61 0h4.35v1.91h.06c.61-1.15 2.09-2.36 4.31-2.36 4.61 0 5.46 3.03 5.46 6.97V22h-4.54v-6.95c0-1.66-.03-3.79-2.31-3.79-2.31 0-2.66 1.81-2.66 3.67V22H7.83V8z"/></svg>
          View LinkedIn Profile
        </a>
        <?php endif; ?>
        <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="btn-fill" style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;font-size:.82rem;padding:.55rem 1.3rem;">Get in Touch</a>
      </div>
    </div>

  </div>
</section>

<!-- EXPERTISE TAGS -->
<?php if ($expertise_tags) : ?>
<section class="tm-expertise">
  <div class="tm-expertise-inner">
    <span class="section-eyebrow">Areas of Expertise</span>
    <h2>Specialties &amp; Focus Areas</h2>
    <div class="tm-tags">
      <?php foreach ($expertise_tags as $tag) : ?>
      <span class="tm-tag"><?php echo esc_html($tag); ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- MORE FROM THE TEAM -->
<?php
$others = new WP_Query([
  'post_type'      => 'team_member',
  'posts_per_page' => -1,
  'post__not_in'   => [get_the_ID()],
  'meta_key'       => 'member_order',
  'orderby'        => 'meta_value_num',
  'order'          => 'ASC',
  'post_status'    => 'publish',
]);

$has_others = $others->have_posts();

// Static fallback peers (exclude current by name)
$static_peers = [
  ['photo' => $base_url . 'robert-lopez.png',   'name' => 'Robert Lopez',   'creds' => 'Broadband Engineering & Design',    'url' => home_url('/team/robert-lopez/')],
  ['photo' => $base_url . 'paul-weintraub.png', 'name' => 'Paul Weintraub', 'creds' => 'RCDD · RTPM · ESS · TECH',           'url' => home_url('/team/paul-weintraub/')],
  ['photo' => $base_url . 'john-centofanti.png','name' => 'John Centofanti','creds' => 'Security Industry Leadership',        'url' => home_url('/team/john-centofanti/')],
];
$static_peers = array_filter($static_peers, fn($p) => strtolower($p['name']) !== strtolower($name));
?>
<section class="tm-more">
  <div class="tm-more-inner">
    <span class="section-eyebrow">The Excigent Team</span>
    <h2 class="section-title" style="margin-bottom:0;">More <strong>Leadership</strong></h2>
    <div class="tm-more-grid">
      <?php if ($has_others) :
        while ($others->have_posts()) : $others->the_post();
          $p_creds = esc_html(get_field('member_creds') ?: '');
          $p_thumb = get_the_post_thumbnail_url(null,'thumbnail');
          if (!$p_thumb) {
            $lower2 = strtolower(get_the_title());
            if (strpos($lower2,'robert')!==false||strpos($lower2,'lopez')!==false)        $p_thumb=$base_url.'robert-lopez.png';
            elseif(strpos($lower2,'john')!==false||strpos($lower2,'centofanti')!==false)  $p_thumb=$base_url.'john-centofanti.png';
            else $p_thumb=$base_url.'paul-weintraub.png';
          }
      ?>
      <a href="<?php the_permalink(); ?>" class="tm-peer-card">
        <div class="tm-peer-photo"><img src="<?php echo esc_url($p_thumb); ?>" alt="<?php the_title_attribute(); ?>" /></div>
        <div>
          <p class="tm-peer-name"><?php the_title(); ?></p>
          <?php if ($p_creds) : ?><p class="tm-peer-creds"><?php echo $p_creds; ?></p><?php endif; ?>
          <span class="tm-peer-arrow">View Profile →</span>
        </div>
      </a>
      <?php endwhile; wp_reset_postdata();
      else :
        foreach ($static_peers as $p) : ?>
      <a href="<?php echo esc_url($p['url']); ?>" class="tm-peer-card">
        <div class="tm-peer-photo"><img src="<?php echo esc_url($p['photo']); ?>" alt="<?php echo esc_attr($p['name']); ?>" /></div>
        <div>
          <p class="tm-peer-name"><?php echo esc_html($p['name']); ?></p>
          <p class="tm-peer-creds"><?php echo esc_html($p['creds']); ?></p>
          <span class="tm-peer-arrow">View Profile →</span>
        </div>
      </a>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<?php
get_template_part('template-parts/subscribe', null, [
  'heading'   => 'Work with a team that knows <strong>your market</strong>.',
  'subtext'   => 'Whether you\'re a principal looking for commercial representation or a channel partner exploring new opportunities — let\'s start a conversation.',
  'cta_links' => [
    ['url' => home_url('/contact/'), 'label' => 'Get in Touch',  'class' => 'btn-fill'],
    ['url' => home_url('/team/'),    'label' => 'Meet the Team', 'class' => 'btn-ghost', 'style' => 'border-color:rgba(255,255,255,.35);color:rgba(255,255,255,.85)'],
  ],
]);

get_footer();
?>
