<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php /* do special stuff on the first page of results */ if ( !is_paged() ) : ?>

  <!-- LOOP ONE: Show the most recent post -->
  <?php query_posts('showposts=1&post_type[]=post&post_type[]=sponsoredpost&post_type[]=comic'); while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content', get_post_format()); ?>
  <?php endwhile; ?>

  <!-- WIDGET AREA -->
  <article id="loopwidget" class="well">
    <?php if ( is_active_sidebar( 'sidebar-innerloop' ) ) : ?>
      <section id="sidebar-innerloop" class="sidebar-innerloop widget-area" role="complementary">
        <?php dynamic_sidebar( 'sidebar-innerloop' ); ?>
      </section><!-- #sidebar-innerloop -->
    <?php endif; ?>
  </article>

  <!-- LOOP TWO: Show the remaining posts -->
  <?php query_posts('offset=1&post_type[]=post&post_type[]=sponsoredpost&post_type[]=comic'); while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content', get_post_format()); ?>
  <?php endwhile; ?>

<?php /* if not first page of results, do other stuff */ else : ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>
