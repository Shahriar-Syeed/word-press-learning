<?php

add_action('rest_api_init', 'universityLikeRoutes');

function universityLikeRoutes()
{
  register_rest_route('university/v1', 'manageLike', array(
    'methods' => 'POST',
    'callback' => 'createLike',
  ));
  register_rest_route('university/v1', 'manageLike', array(
    'methods' => 'DELETE',
    'callback' => 'deleteLike',
  ));
}

function createLike($data)
{
  $professor = sanitize_text_field($data['professorId']);
  wp_insert_post(array(
    'post_type' => 'like',
    'post_status' => 'publish',
    'post_title' => '3rd PHP Create Post Test',
    // 'post_content' => 'Hello world 12345678910',
    'meta_input' => array(
      'liked_professor_id' => $professor,
    ),
  ));
  // return 'try to create Like';
}

function deleteLike()
{
  return 'try to delete Like';
}
