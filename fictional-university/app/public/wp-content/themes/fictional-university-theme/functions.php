<?php

function university_files(): void
{
  // wp_enqueue_style('university_main_style', get_stylesheet_uri()); for style css
  wp_enqueue_script('university-main-javascript', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_style', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extra_style', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features(): void
{
  // register_nav_menu('headerMenuLocation', 'Header Menu Location');
  // register_nav_menu('footerMenuLocationOne', 'Footer Menu Location One');
  // register_nav_menu('footerMenuLocationTwo', 'Footer Menu Location Two');
  add_theme_support('title-tag');
}

add_action('after_setup_theme', 'university_features');

// function university_post_type()
// {
//   register_post_type('event', array(
//     'public' => true,
//     'labels' => array(
//       'name' => 'Events',
//     ),
//     'menu_icon' => 'dashicons-calendar',
//   ));
// }
// add_action('init', 'university_post_type');
function university_adjust_query($query)
{
  // $query->set('posts_per_page', '1'); //universal
  if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
    $today = date('Ymd');
    // $query->set('posts_per_page', '1');
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric',
      ),
    ));
  }
  if (!is_admin() and is_post_type_archive('program') and $query->is_main_query()) {
    $today = date('Ymd');
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', '-1');
  }
}

add_action('pre_get_posts', 'university_adjust_query');
