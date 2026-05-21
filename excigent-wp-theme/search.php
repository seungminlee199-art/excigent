<?php
/**
 * Search Results (search.html)
 */
get_header();
$query = get_search_query();
$count = $GLOBALS['wp_query']->found_posts;
?>

<style>
.search-hero-bar{max-width:620px;margin:2rem auto 0;display:flex;gap:.6rem;background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.18);border-radius:50px;padding:.4rem .4rem .4rem 1.4rem}
.search-hero-bar input{flex:1;border:none;background:transparent;outline:none;color:#fff;font-family:inherit;font-size:1rem;color-scheme:dark}
.search-hero-bar input::placeholder{color:rgba(255,255,255,.55)}
.search-hero-bar button{font-family:inherit;font-size:.82rem;font-weight:700;padding:.7rem 1.5rem;background:#fff;color:var(--navy);border:none;border-radius:50px;cursor:pointer;transition:background .2s}
.search-hero-bar button:hover{background:#B8DBFF}
.result-count{font-size:.85rem;color:var(--muted);margin-bottom:2rem}
.result-count strong{color:var(--navy)}
.results-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.4rem}
.result-card{display:block;background:#fff;border:1px solid rgba(0,69,105,.10);border-radius:14px;overflow:hidden;padding:1.5rem 1.6rem;text-decoration:none;transition:transform .3s cubic-bezier(.22,1,.36,1),box-shadow .3s ease,border-color .3s ease}
.result-card:hover{transform:translateY(-4px);border-color:rgba(0,97,179,.25);box-shadow:0 14px 40px -18px rgba(0,69,105,.28)}
.result-cat{font-size:.64rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:var(--blue);margin-bottom:.55rem}
.result-title{font-size:1rem;font-weight:600;color:var(--navy);margin-bottom:.5rem;line-height:1.4}
.result-excerpt{font-size:.86rem;line-height:1.6;color:var(--muted)}
.search-empty{text-align:center;padding:5rem 2rem}
.search-empty h2{font-size:1.8rem;font-weight:300;color:var(--navy);margin-bottom:.8rem}
.search-empty p{color:var(--muted);max-width:440px;margin:0 auto 2rem}
</style>

<header class="page-hero">
  <div class="page-hero-inner">
    <span class="eyebrow"><span class="eyebrow-dot"></span>Search Results</span>
    <h1>Results for <strong>"<?php echo esc_html($query); ?>"</strong></h1>
    <form class="search-hero-bar" method="get" action="<?php echo esc_url(home_url('/')); ?>">
      <input type="search" name="s" value="<?php echo esc_attr($query); ?>" placeholder="Search again…" aria-label="Search" />
      <button type="submit">Search</button>
    </form>
  </div>
</header>

<section class="section light" style="padding-top:3.5rem;">
  <div class="section-inner">
    <?php if ( have_posts() ) : ?>
    <p class="result-count">Showing <strong><?php echo $count; ?></strong> result<?php echo $count !== 1 ? 's' : ''; ?> for "<?php echo esc_html($query); ?>"</p>
    <div class="results-grid">
      <?php while ( have_posts() ) : the_post();
        $cat = get_the_category();
        $cat_name = $cat ? esc_html($cat[0]->name) : esc_html(get_post_type());
      ?>
      <a class="result-card" href="<?php the_permalink(); ?>">
        <div class="result-cat"><?php echo $cat_name; ?></div>
        <div class="result-title"><?php the_title(); ?></div>
        <div class="result-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></div>
      </a>
      <?php endwhile; ?>
    </div>
    <div style="margin-top:3rem;text-align:center;">
      <?php the_posts_pagination(['prev_text'=>'← Prev','next_text'=>'Next →']); ?>
    </div>
    <?php else : ?>
    <div class="search-empty">
      <h2>No results found for "<?php echo esc_html($query); ?>"</h2>
      <p>Try different keywords or browse the sections below.</p>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-fill dark">Back to Home</a>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
