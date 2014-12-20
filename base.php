<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>  data-target="#scrollspy" data-spy="scroll">

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    get_template_part('templates/header');
  ?>

  <div class="wrap container" role="document">
    <div class="content row">

      <?php if (roots_display_sidebar()) : ?>
        <aside class="sidebar hidden-xs" role="complementary">
          <?php include roots_sidebar_path(); ?>
        </aside><!-- /.sidebar -->
      <?php endif; ?>
      
      <section id="primary" class="col-md-8" role="main">
        <?php /* Leaderboard ad */  if(function_exists('oiopub_banner_zone')) oiopub_banner_zone(1, 'center'); ?>
        <?php include roots_template_path(); ?>
      </section><!-- /.main -->

    </div><!-- /.content -->
  </div><!-- /.wrap -->
  <?php // _tk_content_nav( 'nav-below' ); ?>
  <?php get_template_part('templates/footer'); ?>

</body>
</html>
