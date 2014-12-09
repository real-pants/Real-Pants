<p class="byline author vcard">
by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a> 
in  <?php the_category( ', ', 'multiple'); ?> 
<?php edit_post_link('§ EDIT'); ?>
</p>
