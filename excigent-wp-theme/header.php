<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav>
  <div class="nav-logo">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>"
           alt="<?php bloginfo( 'name' ); ?>" />
    </a>
  </div>

  <?php
  wp_nav_menu( [
      'theme_location' => 'primary',
      'container'      => false,
      'items_wrap'     => '<ul class="nav-links">%3$s</ul>',
      'walker'         => new Excigent_Nav_Walker(),
      'fallback_cb'    => 'excigent_fallback_nav',
  ] );
  ?>

  <div class="nav-right">
    <span class="nav-phone">
      <?php echo esc_html( get_theme_mod( 'excigent_phone', '+1 (800) 000-0000' ) ); ?>
    </span>
    <a href="#" class="nav-cta">Connect With Us</a>
    <button class="nav-hamburger" aria-label="Menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<?php
/* Fallback nav if no menu is assigned */
function excigent_fallback_nav() {
    echo '<ul class="nav-links">
      <li><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li>
      <li><a href="' . esc_url( home_url( '/about/' ) ) . '">About Us</a></li>
      <li><a href="' . esc_url( home_url( '/services/' ) ) . '">Services</a></li>
      <li><a href="' . esc_url( home_url( '/media/' ) ) . '">Media / Press</a></li>
      <li><a href="' . esc_url( home_url( '/contact/' ) ) . '">Connect With Us</a></li>
    </ul>';
}
