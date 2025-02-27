<?php

add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch()
{
  register_rest_route('university/v1', 'search', array(
    'method' => WP_REST_SERVER::READABLE, //'GET'
    'callback' => 'universitySearchResults'
  ));
}

function universitySearchResults($data)
{
  $professors = new WP_Query(array(
    'post_type' => 'professor',
    's' => sanitize_text_field($data['term']), //s for search
  ));

  $professorResult = array();

  while ($professors->have_posts()) {
    $professors->the_post();
    array_push($professorResult, array(
      'title' => get_the_title(),
      'permalink' => get_the_permalink(),
    ));
  }
  return $professorResult;
}
