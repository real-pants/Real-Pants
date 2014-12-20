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
 $query->set( 'post_type', array( 'post', 'sponsoredpost', 'comic') );
 return $query;
 }
 add_filter( 'pre_get_posts', 'custom_conference_in_home_loop' );


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
 * Post Navigation 
 * @link https://github.com/Themekraft/_tk/blob/master/includes/template-tags.php
 ----------------------------------------------------------------------------*/
if ( ! function_exists( '_tk_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function _tk_content_nav( $nav_id ) {
  global $wp_query, $post;
  // Don't print empty markup on single pages if there's nowhere to navigate.
  if ( is_single() ) {
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next = get_adjacent_post( false, '', false );
    if ( ! $next && ! $previous )
      return;
  }
  // Don't print empty markup in archives if there's only one page.
  if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
    return;
  $nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';
  ?>
  <nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
    <ul class="pager">

    <?php if ( is_single() ) : // navigation links for single posts ?>

      <?php previous_post_link( '<li class="nav-previous previous">%link</li>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', '_tk' ) . '</span> %title' ); ?>
      <?php next_post_link( '<li class="nav-next next">%link</li>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', '_tk' ) . '</span>' ); ?>

    <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

      <?php if ( get_next_posts_link() ) : ?>
      <li class="nav-previous previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', '_tk' ) ); ?></li>
      <?php endif; ?>

      <?php if ( get_previous_posts_link() ) : ?>
      <li class="nav-next next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', '_tk' ) ); ?></li>
      <?php endif; ?>

    <?php endif; ?>

    </ul>
  </nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
  <?php
}
endif; // _tk_content_nav

/*
Plugin Name: CF Post Formats Fallback
Plugin URI: http://crowdfavorite.com
Description: Add post format field content to main post content.
Version: 1.0dev
Author: crowdfavorite
Author URI: http://crowdfavorite.com 
*/
/**
 * Copyright (c) 2011 Crowd Favorite, Ltd. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * **********************************************************************
 */
function cfpff_init() {
  if (!is_admin()) {
//  if (!current_theme_support('post-formats') && !is_admin()) {
// TODO - also check for post format support here?
// Was getting a suprious true response on check, not sure why. Also, need to consider
// themes that support post formats but not these custom fields
    add_action('the_posts', 'cfpff_the_posts');
  }
}
add_action('init', 'cfpff_init');
function cfpff_the_posts($posts) {
  if (is_array($posts) && count($posts)) {
    foreach ($posts as &$post) {
// check to see if the post has a format
// taken directly from get_post_format(), but without the check for post format support
  
      $_format = get_the_terms( $post->ID, 'post_format' );
    
      if ( empty( $_format ) )
        continue;
    
      $format = array_shift( $_format );
      $format = str_replace('post-format-', '', $format->slug);
    
// check for custom fields and attach to the post content
    
      switch ($format) {
        case 'link':
        case 'image':
        case 'gallery':
        case 'video':
        case 'audio':
        case 'quote':
          $post->post_content = call_user_func('cfpff_fallback_'.$format, $post);
      }
    }
  }
  return $posts;
}
function cfpff_fallback_link($post) {
  $url = get_post_meta($post->ID, '_format_link_url', true);
  if (!empty($url) && strpos($post->post_content, $url) === false) {
    $parts = parse_url($url);
    $post->post_content .= "\n\n"
    .'<p><a href="'.esc_url($url).'">'.sprintf(__('View on %s', 'cf-post-formats-fallback'), esc_html($parts['host'])).'</a></p>';
  }
  return $post->post_content;
}
// TODO - check for existing image in post before prepending
function cfpff_fallback_image($post) {
  $image_id = intval(get_post_meta($post->ID, '_thumbnail_id', true));
  if ($image_id) {
    $post->post_content = wp_get_attachment_image($image_id, 'small')."\n\n".$post->post_content;
  }
  return $post->post_content;
}
function cfpff_fallback_gallery($post) {
  if (strpos($post->post_content, '[gallery') === false) {
    $gallery = do_shortcode('[gallery]');
    if (!empty($gallery)) {
      $post->post_content = $gallery."\n\n".$post->post_content;
    }
  }
  return $post->post_content;
}
function cfpff_fallback_video($post) {
  $embed = get_post_meta($post->ID, '_format_video_embed', true);
  if (!empty($embed) && strpos($post->post_content, $embed) === false) {
    $post->post_content = $embed."\n\n".$post->post_content;
  }
  return $post->post_content;
}
function cfpff_fallback_audio($post) {
  $embed = get_post_meta($post->ID, '_format_audio_embed', true);
  if (!empty($embed) && strpos($post->post_content, $embed) === false) {
    $post->post_content = $embed."\n\n".$post->post_content;
  }
  return $post->post_content;
}
function cfpff_fallback_quote($post) {
  $name = get_post_meta($post->ID, '_format_quote_source_name', true);
  $url = get_post_meta($post->ID, '_format_quote_source_url', true);
  if (!empty($name) && strpos($post->post_content, esc_html($name)) === false) {
    $post->post_content .= "\n\n".'<p>&mdash; <i>'.(!empty($url) ? '<a href="'.esc_url($url).'">'.esc_html($name).'</a>' : esc_html($name)).'</i></p>';
  }
  return $post->post_content;
}

/**----------------------------------------------------------------------------
 * Customized WordPress Administration Filters
 * @link http://www.sitepoint.com/customized-wordpress-administration-filters/
 ----------------------------------------------------------------------------*/
//defining the filter that will be used to select posts by 'post formats'
function add_post_formats_filter_to_post_administration(){
 
    //execute only on the 'post' content type
    global $post_type;
    if($post_type == 'post'){
 
        $post_formats_args = array(
            'show_option_all'   => 'All Post formats',
            'orderby'           => 'NAME',
            'order'             => 'ASC',
            'name'              => 'post_format_admin_filter',
            'taxonomy'          => 'post_format'
        );
 
        //if we have a post format already selected, ensure that its value is set to be selected
        if(isset($_GET['post_format_admin_filter'])){
            $post_formats_args['selected'] = sanitize_text_field($_GET['post_format_admin_filter']);
        }
 
        wp_dropdown_categories($post_formats_args);
 
    }
}
add_action('restrict_manage_posts','add_post_formats_filter_to_post_administration');

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

//restrict the posts by the chosen post format
function add_post_format_filter_to_posts($query){
 
    global $post_type, $pagenow;
 
    //if we are currently on the edit screen of the post type listings
    if($pagenow == 'edit.php' && $post_type == 'post'){
        if(isset($_GET['post_format_admin_filter'])){
 
            //get the desired post format
            $post_format = sanitize_text_field($_GET['post_format_admin_filter']);
            //if the post format is not 0 (which means all)
            if($post_format != 0){
 
                $query->query_vars['tax_query'] = array(
                    array(
                        'taxonomy'  => 'post_format',
                        'field'     => 'ID',
                        'terms'     => array($post_format)
                    )
                );
 
            }
        }
    }   
}
add_action('pre_get_posts','add_post_format_filter_to_posts');

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