<article <?php post_class(); ?>>
  <header class="entry-header">
  	<div class="entry-meta"><?php get_template_part('templates/entry-meta'); ?>  </div>
  	<h1 class="entry-title">
  		<a href="<?php the_permalink(); ?>">
  			<?php the_title(); ?>
  		</a>
  	</h1>
  </header>
    <section class="entry-content">
      <?php the_content(); ?>
    </section>
    <div class="article-separator">&sect;</div>
</article>
