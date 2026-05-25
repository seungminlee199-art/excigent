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
    if ($link) : ?>
    <div class="event-detail-actions">
      <a href="<?php echo esc_url($link); ?>" class="btn-fill dark" target="_blank" rel="noopener">Register / Learn More</a>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-ghost navy">Contact Us</a>
    </div>
    <?php else : ?>
    <div class="event-detail-actions">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-fill dark">Get in Touch</a>
    </div>
    <?php endif;
  } else { ?>

  <!-- COMING SOON LAYOUT -->
  <div class="ecs-banner">
    <div class="ecs-banner-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
    </div>
    <div class="ecs-banner-text">
      <h3>Full Details Coming Soon</h3>
      <p>We're finalizing the details for this event. Check back soon — or reach out now to register your interest, arrange a meeting, or learn more about Excigent's presence at this show.</p>
    </div>
  </div>

  <div class="ecs-highlights">
    <div class="ecs-highlight">
      <div class="ecs-h-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </div>
      <h4>Meet Our Team</h4>
      <p>Connect with Excigent's senior leadership and explore partnership opportunities face to face.</p>
    </div>
    <div class="ecs-highlight">
      <div class="ecs-h-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
      </div>
      <h4>Discover Our Markets</h4>
      <p>See how we drive commercial growth across Broadband, ICT, and Security throughout the Americas.</p>
    </div>
    <div class="ecs-highlight">
      <div class="ecs-h-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
      </div>
      <h4>Schedule a Meeting</h4>
      <p>Reach out before the event to arrange a dedicated one-on-one with our team at the venue.</p>
    </div>
  </div>

  <div class="ecs-cta-block">
    <div class="ecs-cta-text">
      <span class="ecs-cta-label">Interested in connecting?</span>
      <p>Let us know you'll be attending — we'll reach out to coordinate.</p>
    </div>
    <div class="ecs-cta-actions">
      <?php if ($link) : ?>
      <a href="<?php echo esc_url($link); ?>" class="btn-fill dark" target="_blank" rel="noopener">Register / Learn More</a>
      <?php endif; ?>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-fill dark">Get in Touch</a>
      <a href="<?php echo esc_url(home_url('/news-events/')); ?>" class="btn-ghost navy">View All Events</a>
    </div>
  </div>

  <?php } ?>
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
