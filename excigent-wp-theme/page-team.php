<?php
/**
 * Template Name: Team
 * Template Post Type: page
 */
get_header();

function _tf( $k, $fb = '' ) { return function_exists( 'get_field' ) ? ( get_field($k) ?: $fb ) : $fb; }
?>

<!-- PAGE HERO -->
<header class="page-hero">
  <div class="page-hero-inner">
    <span class="eyebrow"><span class="eyebrow-dot"></span><?php echo esc_html( _tf('hero_eyebrow','Our Leadership') ); ?></span>
    <h1><?php echo excigent_h( 'hero_heading', 'Leadership with <strong>decades</strong><br>of industry depth and credibility.' ); ?></h1>
    <p><?php echo esc_html( _tf('hero_subtext','Three industry veterans bringing 80+ combined years across broadband engineering, digital infrastructure, and security — with the relationships that move markets.') ); ?></p>
  </div>
</header>

<!-- TEAM GRID -->
<section class="section tint" id="leadership">
  <div class="section-inner">
    <span class="section-eyebrow reveal" style="--d:0s"><?php echo esc_html( _tf('section_eyebrow','The Excigent Team') ); ?></span>
    <h2 class="section-title reveal" style="--d:0.06s"><?php echo excigent_h( 'section_heading', 'Three principals. One <strong>unified team</strong>.' ); ?></h2>
    <p class="section-lead reveal" style="--d:0.12s"><?php echo esc_html( _tf('section_lead','Each brings 20–30+ years of deep domain expertise across their respective markets — and together, they provide principals with commercial leadership that spans broadband, ICT, and security.') ); ?></p>

    <div class="team-grid">
      <?php
      $team_query = new WP_Query([
        'post_type'      => 'team_member',
        'posts_per_page' => -1,
        'meta_key'       => 'member_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'post_status'    => 'publish',
      ]);

      $base_url = get_template_directory_uri() . '/assets/images/';
      $fallback = [
        ['photo' => $base_url . 'robert-lopez.png',   'alt' => 'Robert Lopez',    'name' => 'Robert Lopez',    'creds' => 'Broadband Engineering &amp; Design',  'bio' => 'Broadband engineering and design leader with 20+ years supporting major network deployments and delivering construction-ready infrastructure solutions.'],
        ['photo' => $base_url . 'paul-weintraub.png', 'alt' => 'Paul Weintraub',  'name' => 'Paul Weintraub',  'creds' => 'RCDD &middot; RTPM &middot; ESS &middot; TECH', 'bio' => 'Digital infrastructure leader with 30+ years across broadband, ICT, data center, security, and communications markets.'],
        ['photo' => $base_url . 'john-centofanti.png','alt' => 'John Centofanti', 'name' => 'John Centofanti', 'creds' => 'Security Industry Leadership',          'bio' => 'Security industry leader with 30+ years in sales, business development, and program leadership across commercial and public-sector markets.'],
      ];

      if ( $team_query->have_posts() ) :
        $i = 0;
        while ( $team_query->have_posts() ) : $team_query->the_post();
          $delay = round( 0.05 + $i * 0.10, 2 );
          $creds = esc_html( get_field('member_creds') ?: '' );
          $bio   = esc_html( get_field('member_bio')   ?: '' );
          $thumb = get_the_post_thumbnail_url( null, 'team-photo' );
          $name  = get_the_title();
      ?>
      <div class="team-card reveal" style="--d:<?php echo $delay; ?>s">
        <div class="team-photo">
          <?php if ( $thumb ) : ?>
            <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
          <?php else :
            $fb_photo = $base_url . 'paul-weintraub.png';
            $lower = strtolower( $name );
            if ( strpos($lower, 'robert') !== false || strpos($lower, 'lopez') !== false )
              $fb_photo = $base_url . 'robert-lopez.png';
            elseif ( strpos($lower, 'john') !== false || strpos($lower, 'centofanti') !== false )
              $fb_photo = $base_url . 'john-centofanti.png';
          ?>
            <img src="<?php echo esc_url( $fb_photo ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
          <?php endif; ?>
        </div>
        <div class="team-body">
          <h3><?php echo esc_html( $name ); ?></h3>
          <?php if ( $creds ) : ?><div class="team-creds"><?php echo $creds; ?></div><?php endif; ?>
          <?php if ( $bio )   : ?><p class="team-bio"><?php echo $bio; ?></p><?php endif; ?>
        </div>
      </div>
      <?php
          $i++;
        endwhile;
        wp_reset_postdata();

      else : // Static fallback
        foreach ( $fallback as $i => $m ) :
          $delay = round( 0.05 + $i * 0.10, 2 );
      ?>
      <div class="team-card reveal" style="--d:<?php echo $delay; ?>s">
        <div class="team-photo">
          <img src="<?php echo esc_url( $m['photo'] ); ?>" alt="<?php echo esc_attr( $m['alt'] ); ?>" />
        </div>
        <div class="team-body">
          <h3><?php echo esc_html( $m['name'] ); ?></h3>
          <div class="team-creds"><?php echo $m['creds']; ?></div>
          <p class="team-bio"><?php echo esc_html( $m['bio'] ); ?></p>
        </div>
      </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>

<!-- STATS BAND -->
<section class="section dark">
  <div class="section-inner">
    <span class="section-eyebrow reveal" style="--d:0s"><?php echo esc_html( _tf('stats_eyebrow','By the Numbers') ); ?></span>
    <h2 class="section-title reveal" style="--d:0.06s"><?php echo excigent_h( 'stats_heading', '80+ combined years.<br><strong>One focused team</strong>.' ); ?></h2>
    <div class="about-stats" style="margin-top:3rem;">
      <?php
      $acf_stats = function_exists('get_field') ? get_field('team_stats') : null;
      $default_stats = [
        ['stat_num'=>'80', 'stat_suffix'=>'+', 'stat_label'=>'Years Combined Experience'],
        ['stat_num'=>'3',  'stat_suffix'=>'',  'stat_label'=>'Core Technology Markets'],
        ['stat_num'=>'3',  'stat_suffix'=>'',  'stat_label'=>'Geographic Regions'],
        ['stat_num'=>'100','stat_suffix'=>'+', 'stat_label'=>'Partner Relationships'],
      ];
      $stats_data = $acf_stats ?: $default_stats;
      foreach ( $stats_data as $i => $s ) :
        $delay = round( $i * 0.08, 2 );
      ?>
      <div class="stat reveal" style="--d:<?php echo $delay; ?>s">
        <div class="stat-num">
          <span><?php echo esc_html( $s['stat_num'] ); ?></span>
          <?php if ( $s['stat_suffix'] ) : ?><span class="suffix"><?php echo esc_html( $s['stat_suffix'] ); ?></span><?php endif; ?>
        </div>
        <div class="stat-label"><?php echo esc_html( $s['stat_label'] ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA BAND -->
<?php
$cta_heading = function_exists('get_field') ? get_field('cta_heading') : null;
$cta_subtext = function_exists('get_field') ? get_field('cta_subtext') : null;
$cta_btn1    = function_exists('get_field') ? get_field('cta_btn1')    : null;
$cta_btn2    = function_exists('get_field') ? get_field('cta_btn2')    : null;

$heading = $cta_heading ?: 'Work with a team that knows <strong>your market</strong>.';
$subtext = $cta_subtext ?: 'Whether you\'re a principal looking for commercial representation or a channel partner exploring new opportunities — let\'s start a conversation.';

$links = [];
if ( $cta_btn1 ) {
    $links[] = ['url' => esc_url($cta_btn1['url']), 'label' => esc_html($cta_btn1['title']), 'class' => 'btn-fill', 'target' => $cta_btn1['target'] ?? ''];
} else {
    $links[] = ['url' => home_url('/contact/'), 'label' => 'Get in Touch', 'class' => 'btn-fill'];
}
if ( $cta_btn2 ) {
    $links[] = ['url' => esc_url($cta_btn2['url']), 'label' => esc_html($cta_btn2['title']), 'class' => 'btn-ghost', 'style' => 'border-color:rgba(255,255,255,.35);color:rgba(255,255,255,.85)', 'target' => $cta_btn2['target'] ?? ''];
} else {
    $links[] = ['url' => home_url('/services/'), 'label' => 'Our Services', 'class' => 'btn-ghost', 'style' => 'border-color:rgba(255,255,255,.35);color:rgba(255,255,255,.85)'];
}

get_template_part( 'template-parts/subscribe', null, [
  'heading'   => $heading,
  'subtext'   => $subtext,
  'cta_links' => $links,
]);
?>

<?php get_footer(); ?>
