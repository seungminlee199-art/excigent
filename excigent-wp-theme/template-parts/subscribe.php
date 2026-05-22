<?php
/**
 * Template Part: Subscribe / newsletter CTA band
 * Accepts $args: [
 *   'heading'    => string  (HTML allowed)
 *   'subtext'    => string
 *   'show_name'  => bool    (true = name + email fields; false = email only)
 *   'cta_links'  => array   (optional array of ['url','label','class'] for button-style CTA instead of form)
 * ]
 */
$heading   = $args['heading']   ?? null;
$subtext   = $args['subtext']   ?? null;
$show_name = $args['show_name'] ?? false;
$cta_links = $args['cta_links'] ?? null;

// ACF overrides (Options page)
if ( function_exists( 'get_field' ) ) {
    $heading ??= get_field( 'subscribe_heading', 'option' );
    $subtext ??= get_field( 'subscribe_subtext', 'option' );
}

$heading = $heading ?: 'Stay <strong>connected</strong> to what\'s moving the market.';
$subtext = $subtext ?: 'Quarterly insights, trade articles, and convergence intelligence — delivered straight to your inbox.';
?>
<section class="subscribe">
  <div class="subscribe-inner">
    <h2 class="reveal"><?php echo wp_kses_post( excigent_strip_p( $heading ) ); ?></h2>
    <p class="reveal" style="--d:0.08s"><?php echo wp_kses_post( $subtext ); ?></p>

    <?php if ( $cta_links ) : ?>
      <div class="page-hero-actions reveal" style="--d:0.16s; justify-content:center; margin-top:0;">
        <?php foreach ( $cta_links as $btn ) :
          $url   = esc_url( $btn['url'] ?? '#' );
          $label = esc_html( $btn['label'] ?? 'Learn More' );
          $cls   = esc_attr( $btn['class'] ?? 'btn-fill' );
          $style = isset( $btn['style'] ) ? ' style="' . esc_attr( $btn['style'] ) . '"' : '';
        ?>
          <a href="<?php echo $url; ?>" class="<?php echo $cls; ?>"<?php echo $style; ?>><?php echo $label; ?></a>
        <?php endforeach; ?>
      </div>

    <?php elseif ( $show_name ) : ?>
      <form class="subscribe-form-stack reveal" style="--d:0.16s" onsubmit="return excigentSubscribeSubmit(this)">
        <div class="subscribe-fields">
          <input type="text"  placeholder="Full Name"              required aria-label="<?php esc_attr_e( 'Full name', 'excigent' ); ?>" />
          <input type="email" placeholder="your.name@company.com" required aria-label="<?php esc_attr_e( 'Email address', 'excigent' ); ?>" />
        </div>
        <button type="submit"><?php esc_html_e( 'Subscribe', 'excigent' ); ?></button>
      </form>

    <?php else : ?>
      <form class="subscribe-form reveal" style="--d:0.16s" onsubmit="return excigentSubscribeSubmit(this)">
        <input type="email" placeholder="your.name@company.com" required aria-label="<?php esc_attr_e( 'Email address', 'excigent' ); ?>" />
        <button type="submit"><?php esc_html_e( 'Subscribe', 'excigent' ); ?></button>
      </form>
    <?php endif; ?>

  </div>
</section>

<script>
function excigentSubscribeSubmit(form) {
  var btn = form.querySelector('button');
  if (btn) { btn.textContent = 'Subscribed ✓'; btn.style.background = '#0061B3'; btn.style.color = '#fff'; }
  return false;
}
</script>
