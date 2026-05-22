<?php
/**
 * Template Name: News & Events
 * Template Post Type: page
 */
get_header();

function _nef( $k, $fb = '' ) { return function_exists('get_field') ? (get_field($k) ?: $fb) : $fb; }
?>

<!-- PAGE HERO -->
<header class="page-hero">
  <div class="page-hero-inner">
    <span class="eyebrow"><span class="eyebrow-dot"></span><?php echo esc_html( _nef('hero_eyebrow','News & Events') ); ?></span>
    <h1><?php echo excigent_h('hero_heading','Industry <strong>perspectives</strong> &amp; upcoming events.'); ?></h1>
    <p><?php echo esc_html( _nef('hero_subtext','Trade articles, quarterly newsletters, and market intelligence — alongside upcoming events where you can connect with the Excigent team.') ); ?></p>
  </div>
</header>

<!-- ══ UPCOMING EVENTS ══ -->
<?php
$ev_query = new WP_Query([
  'post_type'      => 'event',
  'posts_per_page' => 6,
  'meta_key'       => 'event_date',
  'orderby'        => 'meta_value',
  'order'          => 'ASC',
  'post_status'    => 'publish',
]);
?>
<section class="section tint" id="events">
  <div class="section-inner">
    <span class="section-eyebrow reveal" style="--d:0s"><?php echo esc_html( _nef('events_eyebrow','Upcoming Events') ); ?></span>
    <h2 class="section-title reveal" style="--d:0.06s"><?php echo excigent_h('events_heading','Where we\'ll be <strong>next</strong>.'); ?></h2>

    <div class="events-grid">
    <?php if ( $ev_query->have_posts() ) :
      while ( $ev_query->have_posts() ) : $ev_query->the_post();
        $ev_date = get_field('event_date')     ?: '';
        $ev_loc  = esc_html( get_field('event_location') ?: '' );
        $ev_type = esc_html( get_field('event_type')     ?: 'Trade Show' );
        $ev_tag  = esc_html( get_field('event_tag')      ?: '' );
        $ev_grad = esc_attr( get_field('event_gradient') ?: 'linear-gradient(135deg,#061F2E,#004569 60%,#0061B3)' );
        $month   = $ev_date ? date('M', strtotime($ev_date)) : '';
        $day     = $ev_date ? date('d', strtotime($ev_date)) : '';
    ?>
      <a href="<?php the_permalink(); ?>" class="ev-card reveal">
        <div class="ev-card-top" style="background:<?php echo $ev_grad; ?>">
          <div class="ev-badge">
            <span class="ev-month"><?php echo esc_html($month); ?></span>
            <span class="ev-day"><?php echo esc_html($day); ?></span>
          </div>
        </div>
        <div class="ev-card-body">
          <span class="ev-type"><?php echo $ev_type; ?></span>
          <h4 class="ev-name"><?php the_title(); ?></h4>
          <?php if ($ev_loc) : ?>
          <p class="ev-loc">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?php echo $ev_loc; ?>
          </p>
          <?php endif; ?>
          <?php if ($ev_tag) : ?><span class="ev-tag"><?php echo $ev_tag; ?></span><?php endif; ?>
        </div>
      </a>
    <?php endwhile; wp_reset_postdata();

    else : // Static fallback ?>
      <div class="ev-card">
        <div class="ev-card-top" style="background:linear-gradient(135deg,#061F2E,#004569 60%,#0061B3)">
          <div class="ev-badge"><span class="ev-month">Jun</span><span class="ev-day">14</span></div>
        </div>
        <div class="ev-card-body">
          <span class="ev-type">Trade Show</span>
          <h4 class="ev-name">InfoComm 2026</h4>
          <p class="ev-loc"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Las Vegas, NV</p>
          <span class="ev-tag">ICT &amp; AV Technology</span>
        </div>
      </div>
      <div class="ev-card">
        <div class="ev-card-top" style="background:linear-gradient(135deg,#0A2F45,#0061B3 80%)">
          <div class="ev-badge"><span class="ev-month">Sep</span><span class="ev-day">04</span></div>
        </div>
        <div class="ev-card-body">
          <span class="ev-type">Trade Show</span>
          <h4 class="ev-name">CEDIA Expo 2026</h4>
          <p class="ev-loc"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Denver, CO</p>
          <span class="ev-tag">Residential Technology</span>
        </div>
      </div>
      <div class="ev-card">
        <div class="ev-card-top" style="background:linear-gradient(135deg,#004569,#0061B3 80%)">
          <div class="ev-badge"><span class="ev-month">Oct</span><span class="ev-day">19</span></div>
        </div>
        <div class="ev-card-body">
          <span class="ev-type">International Expo</span>
          <h4 class="ev-name">Futurecom 2026</h4>
          <p class="ev-loc"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>São Paulo, Brazil</p>
          <span class="ev-tag">Broadband &amp; Telecom</span>
        </div>
      </div>
    <?php endif; ?>
    </div>
  </div>
</section>

<!-- ══ NEWS / ARTICLES ══ -->
<?php
$news_query = new WP_Query([
  'post_type'      => 'news',
  'posts_per_page' => 9,
  'orderby'        => 'date',
  'order'          => 'DESC',
  'post_status'    => 'publish',
]);
?>
<section class="section light" id="news">
  <div class="section-inner">
    <span class="section-eyebrow reveal" style="--d:0s"><?php echo esc_html( _nef('news_eyebrow','Latest News') ); ?></span>
    <h2 class="section-title reveal" style="--d:0.06s"><?php echo excigent_h('news_section_heading','Industry <strong>perspectives</strong>,<br>delivered from the inside.'); ?></h2>

    <?php if ( $news_query->have_posts() ) : ?>
    <div class="news-grid-full">
      <?php $ni = 0; while ( $news_query->have_posts() ) : $news_query->the_post();
        $tag       = get_field('news_tag')       ?: 'Article';
        $read_time = get_field('news_read_time') ?: '';
        $excerpt   = get_field('news_excerpt')   ?: get_the_excerpt();
        $is_feat   = get_field('news_is_featured');
        $is_video  = get_field('news_is_video');
        $thumb     = get_the_post_thumbnail_url(null,'large');
        $delay     = round(0.05 + ($ni % 3) * 0.08, 2);
        $thumb_cls = $is_feat ? 'featured' : ($is_video ? 'video' : '');
      ?>
      <a href="<?php the_permalink(); ?>" class="news-card reveal<?php echo $is_video ? ' video' : ''; ?>" style="--d:<?php echo $delay; ?>s">
        <div class="news-thumb <?php echo esc_attr($thumb_cls); ?>">
          <?php if ($thumb) : ?><img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" /><?php endif; ?>
          <span class="news-tag"><?php echo esc_html($tag); ?></span>
          <?php if ($is_video) : ?><span class="play-icon"></span><?php endif; ?>
        </div>
        <div class="news-body">
          <div class="news-date"><?php echo get_the_date('M j, Y'); ?><?php if($read_time) echo ' &middot; ' . esc_html($read_time); ?></div>
          <h3><?php the_title(); ?></h3>
          <?php if ($excerpt) : ?><p><?php echo esc_html($excerpt); ?></p><?php endif; ?>
        </div>
      </a>
      <?php $ni++; endwhile; wp_reset_postdata(); ?>
    </div>

    <?php else : ?>
    <div class="news-grid-full" style="margin-top:2.5rem;">
      <?php foreach ([
        ['tag'=>'Featured Article','title'=>'Why broadband, ICT & security convergence is rewriting the infrastructure playbook','excerpt'=>'The future of infrastructure isn\'t three silos — it\'s an integrated system. Here\'s what principals need to understand about positioning solutions in a converged market.','feat'=>true,'date'=>'May 12, 2026','rt'=>'6 min read'],
        ['tag'=>'Video','title'=>'Inside our market model: from assessment to revenue growth','excerpt'=>'Walk through the six-stage commercial framework Excigent uses with every principal we represent.','feat'=>false,'video'=>true,'date'=>'April 28, 2026','rt'=>'4 min watch'],
        ['tag'=>'Newsletter','title'=>'Latin America & Caribbean: where channel relationships still win deals','excerpt'=>'Notes from the field on what really moves the needle for principals expanding into the region.','feat'=>false,'date'=>'April 15, 2026','rt'=>'3 min read'],
      ] as $i => $a) : ?>
      <div class="news-card reveal" style="--d:<?php echo round(0.05+$i*0.10,2); ?>s">
        <div class="news-thumb <?php echo !empty($a['feat']) ? 'featured' : (!empty($a['video']) ? 'video' : ''); ?>">
          <span class="news-tag"><?php echo esc_html($a['tag']); ?></span>
          <?php if (!empty($a['video'])) : ?><span class="play-icon"></span><?php endif; ?>
        </div>
        <div class="news-body">
          <div class="news-date"><?php echo esc_html($a['date']); ?> &middot; <?php echo esc_html($a['rt']); ?></div>
          <h3><?php echo esc_html($a['title']); ?></h3>
          <p><?php echo esc_html($a['excerpt']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- CTA -->
<?php get_template_part('template-parts/subscribe', null, [
  'heading'   => 'Stay <strong>connected</strong> to what\'s moving the market.',
  'subtext'   => 'Quarterly insights, trade articles, and convergence intelligence — delivered straight to your inbox.',
  'show_name' => true,
]); ?>

<?php get_footer(); ?>
