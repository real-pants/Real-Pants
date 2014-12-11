<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);

/* CUSTOM FUNCTIONS BELOW
-----------------------------------------------------------------------------*/

/**----------------------------------------------------------------------------
 * ALLOW FOR CUSTOM POSITIONING OF JETPACK'S SHARING WIDGET
 * @link http://jetpack.me/2013/06/10/moving-sharing-icons/
 ----------------------------------------------------------------------------*/
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
 
add_action( 'loop_start', 'jptweak_remove_share' );



/**----------------------------------------------------------------------------
 * Add Custom Post Types to Wordpress Loop
 * @link http://premium.wpmudev.org/blog/how-to-add-custom-post-types-to-your-home-page-and-feeds/
 ----------------------------------------------------------------------------*/

function custom_conference_in_home_loop( $query ) {
 if ( is_home() && $query->is_main_query() )
 $query->set( 'post_type', array( 'post', 'sponsored', 'comic') );
 return $query;
 }
 add_filter( 'pre_get_posts', 'custom_conference_in_home_loop' );