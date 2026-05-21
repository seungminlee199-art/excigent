<?php get_header(); ?>

<section class="section light" style="min-height:70vh;display:flex;align-items:center;">
  <div class="section-inner" style="text-align:center;">
    <div style="font-size:6rem;font-weight:200;color:var(--blue);line-height:1;margin-bottom:1rem;">404</div>
    <h1 style="font-size:2rem;font-weight:300;color:var(--navy);margin-bottom:1rem;">Page not found</h1>
    <p style="color:var(--muted);max-width:420px;margin:0 auto 2rem;">The page you're looking for doesn't exist or may have moved.</p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-fill dark">Back to Home</a>
  </div>
</section>

<?php get_footer(); ?>
