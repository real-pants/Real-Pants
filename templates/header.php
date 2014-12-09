
<header class="banner navbar navbar-default navbar-static-top" role="banner" style="background-color:#000000;">
  <div class="container">
<!--     <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    </div> -->

    <nav role="navigation">
       <?php
         if (has_nav_menu('primary_navigation')) :
           wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav'));
         endif;
       ?>
    </nav>
  </div>
</header>

<?php  /*
<div class="container">
  <header class="masthead">

    <div class="masthead-title">
      <h1>
        <a href="/" title="Home">Real Pants</a>
      </h1>
      <p>
        literature and the new
        literary community
      </p>
    </div>

    <?php if (has_nav_menu('primary_navigation')) : wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav hidden-print hidden-xs hidden-sm')); endif; ?>
  </header>
</div>
 */ ?>