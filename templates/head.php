<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700,400italic' rel='stylesheet' type='text/css'>

  <?php wp_head(); ?>
  <?php if(is_home()) : ?>
  	<meta property="article:author" content="http://facebook.com/actualpants" />
	<?php else : ?>
		<meta property="og:image" content="http://realpants.com/wp-content/uploads/2015/01/pants1.png" />
	<?php endif; ?>
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
</head>