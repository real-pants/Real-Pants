<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

?>

<?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?> data-spy="scroll" data-target=".scrollspy">
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <div class="wrap container" role="document">
      <div class="content row scrollspy">
        <main class="main col-md-8" role="main" id="primary" >
          <?php /* Leaderboard ad */  if(function_exists('oiopub_banner_zone')) oiopub_banner_zone(1, 'center'); ?>
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Config\display_sidebar()) : ?>
          <aside id="sidebar" class="sidebar hidden-xs hidden-sm" role="complementary" data-spy="affix" data-offset-top="60">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap --> 
    <?php
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
