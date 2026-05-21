<?php
/**
 * Single Post — Blog / News article (news-detail.html)
 */
get_header(); ?>

<style>
.article-hero{padding-top:64px;background:linear-gradient(160deg,#061F2E 0%,#0A2F45 50%,#004569 100%);padding-bottom:4rem;position:relative;overflow:hidden}
.article-hero::before{content:'';position:absolute;inset:0;background-image:radial-gradient(circle,rgba(255,255,255,.045) 1px,transparent 1px);background-size:36px 36px;pointer-events:none}
.article-hero-inner{max-width:820px;margin:0 auto;padding:4rem 2rem 0;position:relative;z-index:2}
.article-category{display:inline-flex;align-items:center;gap:.45rem;font-size:.67rem;font-weight:600;letter-spacing:.2em;text-transform:uppercase;color:#B8DBFF;padding:.3rem .85rem;border:1px solid rgba(184,219,255,.3);border-radius:30px;background:rgba(184,219,255,.08);margin-bottom:1.4rem}
.article-hero h1{font-size:clamp(1.9rem,3.8vw,3rem);font-weight:300;line-height:1.18;letter-spacing:-.022em;color:#fff;margin-bottom:1.2rem}
.article-hero h1 strong{font-weight:700}
.article-meta{display:flex;gap:1.4rem;flex-wrap:wrap;align-items:center;margin-top:1.8rem;padding-top:1.8rem;border-top:1px solid rgba(255,255,255,.10)}
.article-meta span{font-size:.8rem;color:rgba(255,255,255,.6)}
.article-meta strong{color:rgba(255,255,255,.9)}
.article-body{max-width:820px;margin:0 auto;padding:4rem 2rem 6rem}
.article-body p{font-size:1.05rem;line-height:1.82;color:#2d3f50;margin-bottom:1.6rem}
.article-body h2{font-size:1.7rem;font-weight:600;color:var(--navy);margin:3rem 0 1rem;letter-spacing:-.015em}
.article-body h3{font-size:1.3rem;font-weight:600;color:var(--navy);margin:2rem 0 .8rem}
.article-body ul,.article-body ol{padding-left:1.6rem;margin-bottom:1.6rem}
.article-body li{font-size:1rem;line-height:1.72;color:#2d3f50;margin-bottom:.45rem}
.article-body blockquote{border-left:3px solid var(--blue);padding:.8rem 1.6rem;margin:2rem 0;background:rgba(0,97,179,.04);border-radius:0 8px 8px 0}
.article-body blockquote p{margin:0;color:var(--navy);font-style:italic}
.article-body figure{margin:2.5rem 0}
.article-body figure img{width:100%;border-radius:12px;display:block}
.article-body figcaption{font-size:.82rem;color:var(--muted);margin-top:.6rem;text-align:center}
.article-nav{display:flex;justify-content:space-between;gap:1.5rem;padding:2.5rem 0;border-top:1px solid rgba(0,69,105,.10);flex-wrap:wrap}
.article-nav a{font-size:.9rem;font-weight:500;color:var(--navy);text-decoration:none;display:flex;align-items:center;gap:.4rem;transition:color .2s}
.article-nav a:hover{color:var(--blue)}
.related-section{background:#F4F7FB;padding:5rem 2rem}
.related-inner{max-width:1180px;margin:0 auto}
</style>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <!-- ARTICLE HERO -->
  <header class="article-hero">
    <div class="article-hero-inner">
      <?php $cat = get_the_category(); if ( $cat ) : ?>
      <span class="article-category"><?php echo esc_html( $cat[0]->name ); ?></span>
      <?php endif; ?>
      <h1><?php the_title(); ?></h1>
      <div class="article-meta">
        <span><?php echo get_the_date(); ?></span>
        <span>By <strong><?php the_author(); ?></strong></span>
        <span><?php echo esc_html( get_the_modified_date() !== get_the_date() ? 'Updated ' . get_the_modified_date() : '' ); ?></span>
      </div>
    </div>
  </header>

  <!-- ARTICLE CONTENT -->
  <div class="article-body">
    <?php the_content(); ?>

    <!-- Post navigation -->
    <nav class="article-nav">
      <?php
      $prev = get_previous_post();
      $next = get_next_post();
      if ( $prev ) echo '<a href="' . esc_url(get_permalink($prev)) . '">← ' . esc_html(get_the_title($prev)) . '</a>';
      if ( $next ) echo '<a href="' . esc_url(get_permalink($next)) . '">' . esc_html(get_the_title($next)) . ' →</a>';
      ?>
    </nav>
  </div>

</article>

<?php endwhile; endif; ?>

<!-- RELATED / RECENT POSTS -->
<?php
$related = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post__not_in'   => [ get_the_ID() ],
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
if ( $related->have_posts() ) :
?>
<section class="related-section">
  <div class="related-inner">
    <h3 style="font-size:1.35rem;font-weight:600;color:var(--navy);margin-bottom:2rem;">More from the Blog</h3>
    <div class="news-grid">
      <?php while ( $related->have_posts() ) : $related->the_post();
        $cat = get_the_category(); ?>
      <a class="news-card" href="<?php the_permalink(); ?>" style="text-decoration:none;">
        <div class="news-thumb<?php echo has_post_thumbnail() ? '' : ' featured'; ?>">
          <?php if (has_post_thumbnail()) the_post_thumbnail('news-thumb'); ?>
          <span class="news-tag"><?php echo $cat ? esc_html($cat[0]->name) : 'Insight'; ?></span>
        </div>
        <div class="news-body">
          <div class="news-date"><?php echo get_the_date(); ?></div>
          <h3><?php the_title(); ?></h3>
          <p><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
        </div>
      </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
