<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<?php /* If the special plugin is installed.... */ if ( is_plugin_active('starbox/starbox.php') ) : ?>

		<?php echo do_shortcode( '[starbox]' ) ?>

<?php /* or do a default */ else : ?>

<div class="author-info well">
	<h2 class="author-heading"><?php _e( 'by', 'twentyfifteen' ); ?></h2>
	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 *
		 * @since Twenty Fifteen 1.0
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'twentyfifteen_author_bio_avatar_size', 56 );
		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<h2 class="author-title"><?php echo get_the_author(); ?></h2>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s', 'twentyfifteen' ), get_the_author() ); ?>
			</a>
		</p><!-- .author-bio -->
	</div><!-- .author-description -->
</div><!-- .author-info -->

<?php endif; ?>
