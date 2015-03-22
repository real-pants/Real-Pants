<!--- content-single template -->
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
  <header class="entry-header">
    <div class="entry-meta"><?php get_template_part('templates/entry-meta'); ?>  </div>
    <h1 class="entry-title">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h1>
    <p class="byline author vcard">by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a> on <?php the_time( get_option( 'date_format' ) ); ?></p>

    <?php
    // display jetpack's sharing widget http://jetpack.me/2013/06/10/moving-sharing-icons/
      if ( function_exists( 'sharing_display' ) ) {
          sharing_display( '', true );
    }; ?>

  </header>
    <div class="entry-content">
      <?php get_template_part('templates/entry-media'); ?>
      <?php the_content(); ?>
    </div>
    <footer>
      <?php  if ( is_singular( 'sponsoredpost' )  && get_the_author_meta( 'description' ) ) : get_template_part( 'templates/sponsor-bio' ); endif; ?>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>

    <?php if ( comments_open() ) : comments_template('/templates/comments.php');endif; ?>
  </article>
<?php endwhile; ?>
