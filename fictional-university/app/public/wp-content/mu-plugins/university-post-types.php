<?php
function university_post_type()
{
  // camus post type
  register_post_type('campus', array(
    'show_in_rest' => true,
    'capability_type' => 'campus',
    'map_meta_cap' => true,
    'supports' => array(
      'title',
      'editor',
      // 'thumbnail',
      'excerpt',
      // 'custom-fields'
    ),
    'rewrite' => array('slug' => 'campuses'),
    'has_archive' => true,
    'public' => true,
    // 'show_in_reset' => true,
    'labels' => array(
      'name' => 'campuses',
      'add_new_item' => 'Add New campus',
      'edit_item' => 'Edit campus',
      'all_items' => 'All campuses',
      'singular_name' => 'campus',
    ),
    'menu_icon' => 'dashicons-location-alt',
  ));
  // event post type
  register_post_type('event', array(
    'show_in_rest' => true,
    'capability_type' => 'event',
    'map_meta_cap' => true,
    'supports' => array(
      'title',
      'editor',
      'excerpt',
      // 'custom-fields'
    ),
    'rewrite' => array('slug' => 'events'),
    'has_archive' => true,
    'public' => true,
    'show_in_reset' => true,
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event',
    ),
    'menu_icon' => 'dashicons-calendar',
  ));

  //Program post type
  register_post_type('program', array(
    'show_in_rest' => true, //add custom route through rest api
    'supports' => array(
      'title',
      // 'editor',
      // 'excerpt',
      // 'custom-fields'
    ),
    'rewrite' => array('slug' => 'programs'),
    'has_archive' => true,
    'public' => true,
    // 'show_in_reset' => true,
    'labels' => array(
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Program',
    ),
    'menu_icon' => 'dashicons-awards',
  ));
  //Professor post type
  register_post_type('professor', array(
    'show_in_rest' => true,
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
      // 'excerpt',
      // 'custom-fields'
    ),
    // 'rewrite' => array('slug' => 'professors'),
    // 'has_archive' => true,
    'public' => true,
    // 'show_in_reset' => true,
    'labels' => array(
      'name' => 'Professors',
      'add_new_item' => 'Add New Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All Professors',
      'singular_name' => 'Professor',
    ),
    'menu_icon' => 'dashicons-welcome-learn-more',
  ));
  //Professor post type
  register_post_type('note', array(
    'show_in_rest' => true,
    'supports' => array(
      'title',
      'editor',
      // 'thumbnail',
      // 'excerpt',
      // 'custom-fields'
    ),
    // 'rewrite' => array('slug' => 'notes'),
    // 'has_archive' => true,
    'public' => false,
    'show_ui' => true,
    // 'show_in_reset' => true,
    'labels' => array(
      'name' => 'notes',
      'add_new_item' => 'Add New note',
      'edit_item' => 'Edit note',
      'all_items' => 'All notes',
      'singular_name' => 'note',
    ),
    'menu_icon' => 'dashicons-welcome-write-blog',
  ));
}
add_action('init', 'university_post_type');
