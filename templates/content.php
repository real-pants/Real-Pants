<article <?php post_class(); ?>>
  <header class="entry-header">
  	<div class="entry-meta"><?php get_template_part('templates/entry-meta'); ?>  </div>
  	<h1 class="entry-title">
  		<a href="<?php the_permalink(); ?>">
  			<?php the_title(); ?>
  		</a>
  	</h1>
    <p>by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a> on <?php the_date(); ?>
 </p>
  </header>
    <section class="entry-content">
      <?php the_content(); ?>
    </section>
    <div class="article-separator">&sect;</div>
</article>
