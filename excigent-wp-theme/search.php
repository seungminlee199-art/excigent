<?php
/**
 * Search Results
 */

// Keyword redirect map — if query matches, send user directly to the right page
$keyword_redirects = [
    'fiber'              => '/services/#channel',
    'fiber installation' => '/services/#channel',
    'ftth'               => '/services/#channel',
    'fttx'               => '/services/#channel',
    'broadband'          => '/services/#channel',
    'fixed wireless'     => '/services/#channel',
    'osp'                => '/services/#channel',
    'channel'            => '/services/#channel',
    'channel development'=> '/services/#channel',
    'channel management' => '/services/#channel',
    'reseller'           => '/services/#channel',
    'distributor'        => '/services/#channel',
    'oem'                => '/services/#channel',
    'ict'                => '/services/#positioning',
    'structured cabling' => '/services/#positioning',
    'optical lan'        => '/services/#positioning',
    'data center'        => '/services/#positioning',
    'networking'         => '/services/#positioning',
    'market positioning' => '/services/#positioning',
    'market intelligence'=> '/services/#positioning',
    'specification'      => '/services/#positioning',
    'security'           => '/services/#marketing',
    'access control'     => '/services/#marketing',
    'surveillance'       => '/services/#marketing',
    'biometric'          => '/services/#marketing',
    'intrusion'          => '/services/#marketing',
    'trade show'         => '/services/#marketing',
    'marketing'          => '/services/#marketing',
    'webinar'            => '/services/#marketing',
    'services'           => '/services/',
    'about'              => '/about/',
    'team'               => '/team/',
    'leadership'         => '/team/',
    'contact'            => '/contact/',
    'news'               => '/news-events/',
    'events'             => '/news-events/',
];

$raw_q = isset($_GET['s']) ? strtolower(trim($_GET['s'])) : '';
if ($raw_q) {
    foreach ($keyword_redirects as $kw => $url) {
        if (strpos($raw_q, $kw) !== false) {
            wp_redirect(home_url($url));
            exit;
        }
    }
}

get_header();
$query = get_search_query();

// Run custom query across all relevant post types
$search_args = [
    's'              => $query,
    'post_type'      => ['page', 'news', 'event'],
    'post_status'    => 'publish',
    'posts_per_page' => 18,
    'paged'          => max(1, get_query_var('paged')),
];
$search_q = new WP_Query($search_args);
$count    = $search_q->found_posts;

$type_labels = [
    'page'  => 'Page',
    'news'  => 'News',
    'event' => 'Event',
];
?>

<style>
.search-hero-bar{max-width:580px;margin:2rem auto 0;display:flex;gap:.5rem;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.22);border-radius:50px;padding:.4rem .4rem .4rem 1.4rem}
.search-hero-bar input{flex:1;border:none;background:transparent;outline:none;color:#fff;font-family:inherit;font-size:.95rem;color-scheme:dark}
.search-hero-bar input::placeholder{color:rgba(255,255,255,.55)}
.search-hero-bar button{font-family:inherit;font-size:.8rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;padding:.72rem 1.4rem;background:#fff;color:var(--navy);border:none;border-radius:50px;cursor:pointer;transition:background .2s,color .2s;flex-shrink:0}
.search-hero-bar button:hover{background:#B8DBFF;color:#fff}
.result-meta{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2.5rem}
.result-count{font-size:.88rem;color:var(--muted)}
.result-count strong{color:var(--navy);font-weight:600}
.results-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.4rem}
.result-card{display:flex;flex-direction:column;background:#fff;border:1px solid rgba(0,69,105,.10);border-radius:16px;overflow:hidden;text-decoration:none;transition:transform .35s cubic-bezier(.22,1,.36,1),box-shadow .35s ease,border-color .35s ease}
.result-card:hover{transform:translateY(-4px);border-color:rgba(0,97,179,.25);box-shadow:0 16px 44px -18px rgba(0,69,105,.28)}
.result-card-thumb{aspect-ratio:16/9;background:linear-gradient(135deg,#0F405A 0%,#1260A7 60%,#3B6998 100%);position:relative;overflow:hidden}
.result-card-thumb::before{content:'';position:absolute;inset:0;background-image:radial-gradient(circle,rgba(255,255,255,.08) 1px,transparent 1px);background-size:18px 18px}
.result-card-thumb img{width:100%;height:100%;object-fit:cover}
.result-card-thumb.event-thumb{background:linear-gradient(135deg,#061F2E,#004569 60%,#0061B3)}
.result-card-thumb.page-thumb{background:linear-gradient(135deg,#0A2F45,#1260A7 80%)}
.result-type{position:absolute;top:.8rem;left:.8rem;font-size:.6rem;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:#fff;padding:.28rem .65rem;background:rgba(15,64,90,.62);backdrop-filter:blur(8px);border-radius:30px}
.result-card-body{padding:1.4rem 1.5rem 1.6rem;flex:1;display:flex;flex-direction:column}
.result-card-date{font-size:.74rem;color:var(--muted);margin-bottom:.5rem;letter-spacing:.02em}
.result-card-title{font-size:1rem;font-weight:600;color:var(--navy);line-height:1.4;margin-bottom:.55rem;transition:color .2s}
.result-card:hover .result-card-title{color:var(--blue)}
.result-card-excerpt{font-size:.86rem;line-height:1.6;color:var(--muted);margin:0}
.search-empty{text-align:center;padding:5rem 2rem}
.search-empty svg{width:56px;height:56px;stroke:var(--muted);margin:0 auto 1.5rem;display:block;opacity:.45}
.search-empty h2{font-size:1.7rem;font-weight:300;color:var(--navy);margin-bottom:.8rem}
.search-empty p{color:var(--muted);max-width:420px;margin:0 auto 2rem;line-height:1.7}
.search-pagination{margin-top:3rem;text-align:center}
.search-pagination .nav-links{display:inline-flex;gap:.5rem;align-items:center;flex-wrap:wrap;justify-content:center}
.search-pagination .page-numbers{display:inline-flex;align-items:center;justify-content:center;min-width:40px;height:40px;padding:0 .5rem;border-radius:8px;border:1px solid rgba(0,69,105,.14);font-size:.86rem;font-weight:500;color:var(--navy);text-decoration:none;transition:background .2s,border-color .2s,color .2s}
.search-pagination .page-numbers.current{background:var(--navy);color:#fff;border-color:var(--navy)}
.search-pagination .page-numbers:hover:not(.current){background:rgba(0,97,179,.07);border-color:var(--blue)}
@media(max-width:768px){.results-grid{grid-template-columns:1fr 1fr}}
@media(max-width:540px){.results-grid{grid-template-columns:1fr}.search-hero-bar{border-radius:18px;padding:.5rem}.search-hero-bar button{border-radius:14px}}
</style>

<!-- SEARCH HERO -->
<header class="page-hero">
  <div class="page-hero-inner">
    <span class="eyebrow"><span class="eyebrow-dot"></span>Search Results</span>
    <h1><?php if ($query) : ?>Results for <strong>"<?php echo esc_html($query); ?>"</strong><?php else : ?>Search <strong>Excigent</strong><?php endif; ?></h1>
    <form class="search-hero-bar" method="get" action="<?php echo esc_url(home_url('/')); ?>">
      <input type="search" name="s" value="<?php echo esc_attr($query); ?>" placeholder="Search pages, news, events…" aria-label="Search" autofocus />
      <button type="submit">Search</button>
    </form>
  </div>
</header>

<!-- RESULTS -->
<section class="section light" style="padding-top:3.5rem;padding-bottom:5rem;">
  <div class="section-inner">

    <?php if ($query && $search_q->have_posts()) : ?>

    <div class="result-meta">
      <p class="result-count">Showing <strong><?php echo $count; ?></strong> result<?php echo $count !== 1 ? 's' : ''; ?> for "<strong><?php echo esc_html($query); ?></strong>"</p>
    </div>

    <div class="results-grid">
      <?php while ($search_q->have_posts()) : $search_q->the_post();
        $ptype   = get_post_type();
        $tlabel  = $type_labels[$ptype] ?? ucfirst($ptype);
        $thumb   = get_the_post_thumbnail_url(null, 'large');
        $excerpt = '';
        if ($ptype === 'news') {
            $excerpt = get_field('news_excerpt') ?: wp_trim_words(get_the_excerpt(), 16);
        } elseif ($ptype === 'event') {
            $ev_date = get_field('event_date');
            $ev_loc  = get_field('event_location');
            $excerpt = ($ev_date ? date('F j, Y', strtotime($ev_date)) : '') . ($ev_loc ? ' · ' . $ev_loc : '');
        } else {
            $excerpt = wp_trim_words(get_the_excerpt(), 16);
        }
        $thumb_cls = $ptype === 'event' ? 'event-thumb' : ($ptype === 'page' ? 'page-thumb' : '');
      ?>
      <a class="result-card" href="<?php the_permalink(); ?>">
        <div class="result-card-thumb <?php echo esc_attr($thumb_cls); ?>">
          <?php if ($thumb) : ?><img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" /><?php endif; ?>
          <span class="result-type"><?php echo esc_html($tlabel); ?></span>
        </div>
        <div class="result-card-body">
          <div class="result-card-date"><?php echo get_the_date('M j, Y'); ?></div>
          <div class="result-card-title"><?php the_title(); ?></div>
          <?php if ($excerpt) : ?><p class="result-card-excerpt"><?php echo esc_html($excerpt); ?></p><?php endif; ?>
        </div>
      </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>

    <?php if ($search_q->max_num_pages > 1) : ?>
    <div class="search-pagination">
      <?php echo paginate_links(['total' => $search_q->max_num_pages, 'current' => max(1, get_query_var('paged')), 'prev_text' => '&#8592;', 'next_text' => '&#8594;']); ?>
    </div>
    <?php endif; ?>

    <?php else : ?>
    <div class="search-empty">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <?php if ($query) : ?>
      <h2>No results found for "<?php echo esc_html($query); ?>"</h2>
      <p>Try different keywords — or explore our services, news, and team pages below.</p>
      <?php else : ?>
      <h2>What are you looking for?</h2>
      <p>Search across all pages, news articles, and events on the Excigent website.</p>
      <?php endif; ?>
      <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn-fill dark">Our Services</a>
        <a href="<?php echo esc_url(home_url('/news-events/')); ?>" class="btn-ghost navy">News &amp; Events</a>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php get_footer(); ?>
