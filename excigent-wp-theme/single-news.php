<?php
/**
 * Single template for 'news' CPT
 */
get_header();
the_post();

$tag       = get_field('news_tag')       ?: 'Article';
$read_time = get_field('news_read_time') ?: '';
$is_video  = get_field('news_is_video');
$video_url = get_field('news_video_url') ?: '';
$thumb     = get_the_post_thumbnail_url(null, 'full');
?>

<!-- ARTICLE HERO -->
<header class="news-detail-hero">
  <div class="news-detail-inner">
    <a href="<?php echo esc_url(home_url('/news-events/')); ?>" class="news-back" style="color:rgba(255,255,255,0.75);">&#8592; Back to News &amp; Events</a>
    <span class="news-detail-tag"><?php echo esc_html($tag); ?></span>
    <h1 class="news-detail-title"><?php the_title(); ?></h1>
    <div class="news-detail-meta">
      <span><?php echo get_the_date('F j, Y'); ?></span>
      <?php if ($read_time) : ?><span><?php echo esc_html($read_time); ?></span><?php endif; ?>
    </div>
  </div>
</header>

<!-- FEATURED IMAGE -->
<?php if ($thumb && !$is_video) : ?>
<div class="news-detail-featured-img">
  <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" />
</div>
<?php endif; ?>

<!-- VIDEO EMBED -->
<?php if ($is_video && $video_url) : ?>
<div style="max-width:820px;margin:3rem auto 0;padding:0 2rem;">
  <?php
  $video_id = '';
  if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\s]+)/', $video_url, $m)) {
    $video_id = $m[1];
    echo '<div style="position:relative;aspect-ratio:16/9;border-radius:16px;overflow:hidden;">';
    echo '<iframe src="https://www.youtube.com/embed/' . esc_attr($video_id) . '" style="position:absolute;inset:0;width:100%;height:100%;border:0;" allowfullscreen></iframe>';
    echo '</div>';
  }
  ?>
</div>
<?php endif; ?>

<!-- ARTICLE CONTENT -->
<div class="news-detail-content">
  <?php
  $content = get_the_content();
  if ($content) {
    echo apply_filters('the_content', $content);
  } else {
    $excerpt = get_field('news_excerpt');
    if ($excerpt) echo '<p>' . esc_html($excerpt) . '</p>';
  }
  ?>
</div>

<!-- RELATED NEWS -->
<?php
$related = new WP_Query([
  'post_type'      => 'news',
  'posts_per_page' => 3,
  'post__not_in'   => [get_the_ID()],
  'orderby'        => 'date',
  'order'          => 'DESC',
  'post_status'    => 'publish',
]);
if ($related->have_posts()) :
?>
<section class="section tint">
  <div class="section-inner">
    <h2 class="section-title" style="margin-bottom:2rem;">More <strong>Articles</strong></h2>
    <div class="news-grid-full">
      <?php while ($related->have_posts()) : $related->the_post();
        $r_tag     = get_field('news_tag')       ?: 'Article';
        $r_rt      = get_field('news_read_time') ?: '';
        $r_excerpt = get_field('news_excerpt')   ?: get_the_excerpt();
        $r_thumb   = get_the_post_thumbnail_url(null,'large');
        $r_video   = get_field('news_is_video');
        $r_feat    = get_field('news_is_featured');
      ?>
      <a href="<?php the_permalink(); ?>" class="news-card">
        <div class="news-thumb <?php echo $r_feat ? 'featured' : ($r_video ? 'video' : ''); ?>">
          <?php if ($r_thumb) : ?><img src="<?php echo esc_url($r_thumb); ?>" alt="<?php the_title_attribute(); ?>" /><?php endif; ?>
          <span class="news-tag"><?php echo esc_html($r_tag); ?></span>
          <?php if ($r_video) : ?><span class="play-icon"></span><?php endif; ?>
        </div>
        <div class="news-body">
          <div class="news-date"><?php echo get_the_date('M j, Y'); ?><?php if($r_rt) echo ' &middot; ' . esc_html($r_rt); ?></div>
          <h3><?php the_title(); ?></h3>
          <?php if ($r_excerpt) : ?><p><?php echo esc_html($r_excerpt); ?></p><?php endif; ?>
        </div>
      </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
