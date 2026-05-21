<?php
/**
 * Template Part: Affiliations marquee strip
 * Used on: front-page, about, services, media, contact
 */
$aff_dir = get_template_directory_uri() . '/assets/images/affiliations/';
$affs = [];
for ( $i = 1; $i <= 8; $i++ ) {
    $affs[] = $aff_dir . 'aff-' . $i . '.svg';
}
// If ACF affiliations repeater exists, override
if ( function_exists( 'get_field' ) ) {
    $acf_affs = get_field( 'affiliations_logos', 'option' );
    if ( $acf_affs ) {
        $affs = array_map( fn( $row ) => is_array( $row['logo'] ) ? esc_url( $row['logo']['url'] ) : esc_url( $row['logo'] ), $acf_affs );
    }
}
?>
<section class="affiliations">
  <div class="affiliations-head">
    <h3 class="reveal">
      <?php
      if ( function_exists( 'get_field' ) && get_field( 'affiliations_heading', 'option' ) ) {
          echo wp_kses_post( get_field( 'affiliations_heading', 'option' ) );
      } else {
          esc_html_e( 'Our Affiliations & Industry Memberships', 'excigent' );
      }
      ?>
    </h3>
  </div>
  <div class="marquee">
    <div class="marquee-track">
      <?php foreach ( $affs as $src ) : ?>
        <img src="<?php echo esc_url( $src ); ?>" alt="Industry Affiliation" />
      <?php endforeach; ?>
      <?php foreach ( $affs as $src ) : ?>
        <img src="<?php echo esc_url( $src ); ?>" alt="" aria-hidden="true" />
      <?php endforeach; ?>
    </div>
  </div>
</section>
