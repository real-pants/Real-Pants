<?php use Roots\Sage\Titles; ?>
<?php if /* this it not home */ (! is_home()) { ?>
<div class="page-header">
<p class="byline author vcard">
  <?php the_category( ', ', ''); ?>  <?php edit_post_link('EDIT'); ?>
</p>
  <h1>
    <?= Titles\title(); ?>
  </h1>
</div>
<?php } ?>
