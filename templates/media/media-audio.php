<?php
/**
 * The template part is for displaying audio, for the audio post format
 * It requires the use of the Crowd Favorie Post Formats Plugin
 * more info: https://github.com/dylan-k/SemPress/issues/1#issuecomment-42489972
 */
 ?>

<div class="entry-media">
	<div class="audio-content">
		<?php echo get_post_meta($post->ID,'_format_audio_embed',TRUE); ?>
	</div><!-- .audio-content -->
</div><!-- .entry-media -->
