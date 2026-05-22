<?php
/**
 * Single template for 'event' CPT
 */
get_header();
the_post();

$date     = get_field('event_date')     ?: '';
$location = get_field('event_location') ?: '';
$type     = get_field('event_type')     ?: 'Event';
$tag      = get_field('event_tag')      ?: '';
$gradient = get_field('event_gradient') ?: 'linear-gradient(135deg,#061F2E,#0F405A 50%,#1260A7)';
$link     = get_field('event_link')     ?: '';
$fmt_date = $date ? date('F j, Y', strtotime($date)) : '';
?>

<!-- EVENT HERO -->
<header class="event-detail-hero" style="background:<?php echo esc_attr($gradient); ?>">
  <div class="event-detail-inner">
    <a href="<?php echo esc_url(home_url('/news-events/')); ?>" class="news-back" style="color:rgba(255,255,255,0.7);">&#8592; Back to News &amp; Events</a>
    <span class="event-detail-type"><?php echo esc_html($type); ?><?php if ($tag) echo ' &middot; ' . esc_html($tag); ?></span>
    <h1 class="event-detail-title"><?php the_title(); ?></h1>
    <div class="event-meta-grid">
      <?php if ($fmt_date) : ?>
      <div class="event-meta-item">
        <label>Date</label>
        <span><?php echo esc_html($fmt_date); ?></span>
      </div>
      <?php endif; ?>
      <?php if ($location) : ?>
      <div class="event-meta-item">
        <label>Location</label>
        <span><?php echo esc_html($location); ?></span>
      </div>
      <?php endif; ?>
      <?php if ($type) : ?>
      <div class="event-meta-item">
        <label>Event Type</label>
        <span><?php echo esc_html($type); ?></span>
      </div>
      <?php endif; ?>
      <?php if ($tag) : ?>
      <div class="event-meta-item">
        <label>Market</label>
        <span><?php echo esc_html($tag); ?></span>
      </div>
      <?php endif; ?>
    </div>
  </div>
</header>

<!-- EVENT BODY -->
<div class="event-detail-body">
  <?php
  $content = get_the_content();
  if ($content) {
    echo apply_filters('the_content', $content);
  } else {
    echo '<p>More details about this event coming soon. <a href="' . esc_url(home_url('/contact/')) . '" style="color:var(--blue)">Contact us</a> to learn more or register your interest.</p>';
  }
  ?>

  <?php if ($link) : ?>
  <div class="event-detail-actions">
    <a href="<?php echo esc_url($link); ?>" class="btn-fill dark" target="_blank" rel="noopener">Register / Learn More</a>
    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-ghost navy">Contact Us</a>
  </div>
  <?php else : ?>
  <div class="event-detail-actions">
    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-fill dark">Get in Touch</a>
  </div>
  <?php endif; ?>
</div>

<!-- MORE EVENTS -->
<?php
$more_events = new WP_Query([
  'post_type'      => 'event',
  'posts_per_page' => 3,
  'post__not_in'   => [get_the_ID()],
  'meta_key'       => 'event_date',
  'orderby'        => 'meta_value',
  'order'          => 'ASC',
  'post_status'    => 'publish',
]);
if ($more_events->have_posts()) :
?>
<section class="section tint">
  <div class="section-inner">
    <h2 class="section-title" style="margin-bottom:2rem;">More <strong>Events</strong></h2>
    <div class="events-grid">
      <?php while ($more_events->have_posts()) : $more_events->the_post();
        $e_date     = get_field('event_date')     ?: '';
        $e_location = esc_html( get_field('event_location') ?: '' );
        $e_type     = esc_html( get_field('event_type')     ?: 'Trade Show' );
        $e_tag      = esc_html( get_field('event_tag')      ?: '' );
        $e_gradient = esc_attr( get_field('event_gradient') ?: 'linear-gradient(135deg,#061F2E,#004569 60%,#0061B3)' );
        $e_month    = $e_date ? date('M', strtotime($e_date)) : '';
        $e_day      = $e_date ? date('d', strtotime($e_date)) : '';
      ?>
      <a href="<?php the_permalink(); ?>" class="ev-card">
        <div class="ev-card-top" style="background:<?php echo $e_gradient; ?>">
          <div class="ev-badge">
            <span class="ev-month"><?php echo esc_html($e_month); ?></span>
            <span class="ev-day"><?php echo esc_html($e_day); ?></span>
          </div>
        </div>
        <div class="ev-card-body">
          <span class="ev-type"><?php echo $e_type; ?></span>
          <h4 class="ev-name"><?php the_title(); ?></h4>
          <?php if ($e_location) : ?>
          <p class="ev-loc">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?php echo $e_location; ?>
          </p>
          <?php endif; ?>
          <?php if ($e_tag) : ?><span class="ev-tag"><?php echo $e_tag; ?></span><?php endif; ?>
        </div>
      </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
