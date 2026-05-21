<?php
$logo_src    = esc_url( get_template_directory_uri() . '/assets/images/logo.svg' );
$email       = esc_html( get_theme_mod( 'excigent_email', 'hello@excigent.com' ) );
$phone       = esc_html( get_theme_mod( 'excigent_phone', '+1 (800) 000-0000' ) );
$phone_raw   = preg_replace( '/[^0-9+]/', '', get_theme_mod( 'excigent_phone', '+18000000000' ) );
$tagline     = esc_html( get_theme_mod( 'excigent_footer_tagline', 'A commercial agency and market development partner helping innovative companies build channels, strengthen market presence, and accelerate sustainable revenue growth.' ) );
$linkedin    = esc_url( get_theme_mod( 'excigent_linkedin', '#' ) );
$twitter     = esc_url( get_theme_mod( 'excigent_twitter', '#' ) );
$youtube     = esc_url( get_theme_mod( 'excigent_youtube', '#' ) );
$copy_year   = date( 'Y' );
?>

<footer>
  <div class="footer-inner">

    <!-- Brand column -->
    <div class="footer-brand">
      <img src="<?php echo $logo_src; ?>" alt="<?php bloginfo( 'name' ); ?>" />
      <p><?php echo $tagline; ?></p>
      <div class="footer-contact">
        <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
        <a href="tel:<?php echo $phone_raw; ?>"><?php echo $phone; ?></a>
      </div>
    </div>

    <!-- Company -->
    <div class="footer-col">
      <h4>Company</h4>
      <?php wp_nav_menu( [
          'theme_location' => 'footer-company',
          'container'      => false,
          'items_wrap'     => '<ul>%3$s</ul>',
          'depth'          => 1,
          'fallback_cb'    => function() {
              echo '<ul>
                <li><a href="' . esc_url( home_url( '/about/' ) ) . '">About</a></li>
                <li><a href="' . esc_url( home_url( '/team/' ) ) . '">Team</a></li>
                <li><a href="' . esc_url( home_url( '/about/#why' ) ) . '">Why Us</a></li>
                <li><a href="' . esc_url( home_url( '/contact/' ) ) . '">Contact</a></li>
              </ul>';
          },
      ] ); ?>
    </div>

    <!-- Markets -->
    <div class="footer-col">
      <h4>Markets</h4>
      <?php wp_nav_menu( [
          'theme_location' => 'footer-markets',
          'container'      => false,
          'items_wrap'     => '<ul>%3$s</ul>',
          'depth'          => 1,
          'fallback_cb'    => function() {
              echo '<ul>
                <li><a href="' . esc_url( home_url( '/expertise/#broadband' ) ) . '">Broadband</a></li>
                <li><a href="' . esc_url( home_url( '/expertise/#ict' ) ) . '">ICT</a></li>
                <li><a href="' . esc_url( home_url( '/expertise/#security' ) ) . '">Security</a></li>
                <li><a href="' . esc_url( home_url( '/about/#network' ) ) . '">Our Regions</a></li>
              </ul>';
          },
      ] ); ?>
    </div>

    <!-- Services -->
    <div class="footer-col">
      <h4>Services</h4>
      <?php wp_nav_menu( [
          'theme_location' => 'footer-services',
          'container'      => false,
          'items_wrap'     => '<ul>%3$s</ul>',
          'depth'          => 1,
          'fallback_cb'    => function() {
              echo '<ul>
                <li><a href="' . esc_url( home_url( '/services/#channel' ) ) . '">Channel Development</a></li>
                <li><a href="' . esc_url( home_url( '/services/#positioning' ) ) . '">Market Positioning</a></li>
                <li><a href="' . esc_url( home_url( '/services/#marketing' ) ) . '">Marketing &amp; Visibility</a></li>
                <li><a href="' . esc_url( home_url( '/services/#process' ) ) . '">Our Process</a></li>
              </ul>';
          },
      ] ); ?>
    </div>

  </div><!-- .footer-inner -->

  <div class="footer-bottom">
    <span>© <?php echo $copy_year; ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</span>
    <div class="footer-social">
      <a href="<?php echo $linkedin; ?>" aria-label="LinkedIn">
        <svg viewBox="0 0 24 24"><path d="M4.98 3.5C4.98 4.881 3.87 6 2.49 6S0 4.881 0 3.5 1.11 1 2.49 1s2.49 1.119 2.49 2.5zM.22 8h4.54v14H.22V8zm7.61 0h4.35v1.91h.06c.61-1.15 2.09-2.36 4.31-2.36 4.61 0 5.46 3.03 5.46 6.97V22h-4.54v-6.95c0-1.66-.03-3.79-2.31-3.79-2.31 0-2.66 1.81-2.66 3.67V22H7.83V8z"/></svg>
      </a>
      <a href="<?php echo $twitter; ?>" aria-label="X (Twitter)">
        <svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
      </a>
      <a href="<?php echo $youtube; ?>" aria-label="YouTube">
        <svg viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
      </a>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
