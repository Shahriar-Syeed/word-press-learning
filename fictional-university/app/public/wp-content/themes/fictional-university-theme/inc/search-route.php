<?php

add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch()
{
  register_rest_route('university/v1', 'search', array(
    'method' => WP_REST_SERVER::READABLE, //'GET'
    'callback' => 'universitySearchResults'
  ));
}

function universitySearchResults()
{
  return 'Congratulation, you created a route.';
}
