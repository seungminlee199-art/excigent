<?php
/**
 * page.php — default page template
 */
get_header(); ?>

<header class="page-hero">
  <div class="page-hero-inner">
    <h1><?php the_title(); ?></h1>
  </div>
</header>

<section class="section light">
  <div class="section-inner" style="max-width:820px;">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="font-size:1.05rem;line-height:1.8;color:#2d3f50;">
      <?php the_content(); ?>
    </article>
    <?php endwhile; endif; ?>
  </div>
</section>

<?php get_footer(); ?>
