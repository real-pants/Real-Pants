<?php
/**
 * The template part is for displaying post images
 *
 * Used to display image on image posts or post thumbnail for other post formats
 *
 */
 ?>

<div class="well">
<?php get_template_part( 'templates/media/media', 'image' ); ?>

		       		<h2>
		       		<a href="<?php the_permalink();  ?>">
		       			<?php the_title();  ?>
		       		</a>
		       		</h2>
		        <p>
		        <?php the_excerpt();  ?>
		        </p></div>
