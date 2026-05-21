<?php
/**
 * Archive / News listing (news.html)
 */
get_header(); ?>

<header class="page-hero">
  <div class="page-hero-inner">
    <span class="eyebrow"><span class="eyebrow-dot"></span><?php echo is_category() ? single_cat_title('',false) : 'Media &amp; Insights'; ?></span>
    <h1>News, <strong>Articles</strong><br>&amp; Industry Insights</h1>
    <p>Market intelligence, industry analysis, and thought leadership from the Excigent team — keeping you informed at the intersection of Broadband, ICT, and Security.</p>
  </div>
</header>

<section class="section light" style="padding-top:4rem;">
  <div class="section-inner">
    <?php if ( have_posts() ) : ?>
    <div class="news-grid">
      <?php $first = true; while ( have_posts() ) : the_post();
        $cat   = get_the_category();
        $tag   = $cat ? esc_html($cat[0]->name) : 'Insight';
        $class = $first ? 'news-card' : 'news-card';
        $first = false;
      ?>
      <a class="news-card" href="<?php the_permalink(); ?>" style="text-decoration:none;">
        <div class="news-thumb<?php echo has_post_thumbnail() ? '' : ' featured'; ?>">
          <?php if (has_post_thumbnail()) the_post_thumbnail('news-thumb'); ?>
          <span class="news-tag"><?php echo $tag; ?></span>
        </div>
        <div class="news-body">
          <div class="news-date"><?php echo get_the_date(); ?></div>
          <h3><?php the_title(); ?></h3>
          <p><?php echo wp_trim_words(get_the_excerpt(), 22); ?></p>
        </div>
      </a>
      <?php endwhile; ?>
    </div>

    <!-- Pagination -->
    <div style="margin-top:3rem;text-align:center;">
      <?php the_posts_pagination([
        'mid_size'           => 2,
        'prev_text'          => '← Prev',
        'next_text'          => 'Next →',
        'before_page_number' => '<span class="screen-reader-text">Page </span>',
      ]); ?>
    </div>

    <?php else : ?>
    <p style="color:var(--muted);text-align:center;padding:4rem 0;">No articles published yet. Check back soon.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_template_part('template-parts/subscribe', null, ['show_name'=>false]); ?>
<?php get_footer(); ?>
