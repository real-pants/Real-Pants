<?php
/**
 * The template part is for displaying video
 *
 * Used to display video on video posts
 *
 */
 ?>

    <figure class="hmedia embed-responsive embed-responsive-16by9">
        <?php echo get_post_meta($post->ID,'_format_video_embed',TRUE); ?>
    </figure>