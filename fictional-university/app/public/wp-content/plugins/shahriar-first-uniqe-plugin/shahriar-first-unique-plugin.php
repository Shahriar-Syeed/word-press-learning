<?php

/*
  Plugin Name: Our Test Plugin
  Description: A truly amazing plugin,
  Version: 1.0
  Author: Shahriar
  Author URI: HTTPS://WWW.GOOGLE.COM

*/

add_filter('the_content', 'addToEndOfPost');

function addToEndOfPost($content)
{
  if (is_single() && is_main_query()) {

    return $content . '<p>My Name is Shahriar </p>';
  }
  if (is_page() && is_main_query()) {

    return $content . '<p>My Name is Alif </p>';
  }
  return $content;
}
