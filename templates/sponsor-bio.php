<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<div class="author-info well">


	<div class="author-description">
		<h2 class="author-title"><?php echo get_the_author(); ?></h2>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p><!-- .author-bio -->
		<p>
					<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				View all sponsored posts.
			</a></p>
	</div><!-- .author-description -->
</div><!-- .author-info -->