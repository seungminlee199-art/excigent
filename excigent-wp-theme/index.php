<?php
/**
 * index.php — fallback for any unmatched template
 */
get_header(); ?>

<header class="page-hero">
  <div class="page-hero-inner">
    <h1><?php the_title(); ?></h1>
  </div>
</header>

<section class="section light">
  <div class="section-inner">
    <?php if ( have_posts() ) :
      while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php the_content(); ?>
      </article>
      <?php endwhile;
    else : ?>
      <p><?php esc_html_e( 'No content found.', 'excigent' ); ?></p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
