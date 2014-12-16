<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php /* do special stufff on the first page of reesults */ if ( !is_paged() ) : ?>

<!-- LOOP ONE: Show the most recent post -->
<?php query_posts('showposts=1'); while (have_posts()) : the_post(); ?>

  <?php get_template_part('templates/content', get_post_format()); ?>
<?php endwhile; ?>

<!-- WIDGET AREA -->
<article class="well">
<?php if ( is_active_sidebar( 'sidebar-innerloop' ) ) : ?>
  <section id="sidebar-innerloop" class="sidebar-innerloop widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-innerloop' ); ?>
  </section><!-- #sidebar-innerloop -->
  <?php endif; ?>
 </article>

<!-- LOOP TWO: Show the remaining posts -->
<?php query_posts('offset=1'); while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_format()); ?>
<?php endwhile; ?>



<?php /* if not first page of results, do other stuff */ else : ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_format()); ?>
<?php endwhile; ?>

<?php endif; ?>



<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
