<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

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

function custom_posttype_in_home_loop( $query ) {
 if ( is_home() && $query->is_main_query() )
$query->set( 'post_type', array( 'post', 'sponsoredpost', 'comic', 'podcast', 'any') );
 return $query;
 }
 add_filter( 'pre_get_posts', 'custom_posttype_in_home_loop' );


/**----------------------------------------------------------------------------
Plugin Name: Author META
Version: 1.0
Plugin URI: http://www.ktstudios.com/wordpress-plugin-author-meta/
Description: Adds meta name="author" to the &lt;head&gt; of your posts and pages.
Author: Copyright 2011  KTStudios  (email : admin@ktstudios.com)
Author URI: http://www.ktstudios.com/
Licesne: http://opensource.org/licenses/GPL-3.0
 ----------------------------------------------------------------------------*/

add_action('wp_head', 'kts_author_meta',1);

function kts_author_meta() {
  global $post;
  $postauthor = get_the_author_meta('display_name', $post->post_author);

  if ( $postauthor ) {
    echo '<meta name="author" content="'.$postauthor.'">'."\n";
  }
}


/**----------------------------------------------------------------------------
 * Customized WordPress Administration Filters
 * @link http://www.sitepoint.com/customized-wordpress-administration-filters/
 ----------------------------------------------------------------------------*/

//defining the filter that will be used so we can select posts by 'author'
function add_author_filter_to_posts_administration(){

    //execute only on the 'post' content type
    global $post_type;
    if($post_type == 'post'){

        //get a listing of all users that are 'author' or above
        $user_args = array(
            'show_option_all'   => 'All Users',
            'orderby'           => 'display_name',
            'order'             => 'ASC',
            'name'              => 'aurthor_admin_filter',
            'who'               => 'authors',
            'include_selected'  => true
        );

        //determine if we have selected a user to be filtered by already
        if(isset($_GET['aurthor_admin_filter'])){
            //set the selected value to the value of the author
            $user_args['selected'] = (int)sanitize_text_field($_GET['aurthor_admin_filter']);
        }

        //display the users as a drop down
        wp_dropdown_users($user_args);
    }

}
add_action('restrict_manage_posts','add_author_filter_to_posts_administration');

//restrict the posts by an additional author filter
function add_author_filter_to_posts_query($query){

    global $post_type, $pagenow;

    //if we are currently on the edit screen of the post type listings
    if($pagenow == 'edit.php' && $post_type == 'post'){

        if(isset($_GET['aurthor_admin_filter'])){

            //set the query variable for 'author' to the desired value
            $author_id = sanitize_text_field($_GET['aurthor_admin_filter']);

            //if the author is not 0 (meaning all)
            if($author_id != 0){
                $query->query_vars['author'] = $author_id;
            }

        }
    }
}

add_action('pre_get_posts','add_author_filter_to_posts_query');


/**----------------------------------------------------------------------------
 * Add Custom Post Types to Author Archives Pages
 * @link http://isabelcastillo.com/add-custom-post-types-to-author-archives-wordpress
 ----------------------------------------------------------------------------*/

function custom_post_author_archive($query) {
    if ($query->is_author)
        $query->set( 'post_type', array('post', 'sponsoredpost', 'comic') );
    remove_action( 'pre_get_posts', 'custom_post_author_archive' );
}
add_action('pre_get_posts', 'custom_post_author_archive');


/**----------------------------------------------------------------------------
 * Add Custom Post Types to Category Archives Pages
 * @link http://css-tricks.com/snippets/wordpress/make-archives-php-include-custom-post-types/
 ----------------------------------------------------------------------------*/

function custom_post_category_archive( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'sponsoredpost', 'comic'
        ));
      return $query;
    }
}
add_filter( 'pre_get_posts', 'custom_post_category_archive' );
