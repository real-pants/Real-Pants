<?php
/**
 * The template part is for displaying post images
 *
 * Used to display image on image posts or post thumbnail for other post formats
 *
 */
 ?>
<?php /* only do stuff if there is an image */ if ( '' != get_the_post_thumbnail() ) : ?>
  <figure class="hmedia image">
    <?php /*grab the URL of the image*/ $imgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
    <a rel="enclosure" type="image/jpeg" href="<?php /*now use the image URL */ echo $imgurl;  ?>">
      <?php sempress_the_post_thumbnail('', ''); ?>
    </a>
    <figcaption class="fn">
    	<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
    </figcaption>
  </figure>
<?php endif; ?>