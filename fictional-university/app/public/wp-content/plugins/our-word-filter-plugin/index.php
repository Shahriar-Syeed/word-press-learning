<?php
/*
  Plugin Name: Our Word Filter Plugin
  Description: Replaces a list of words.
  Version: 1.0
  Author: Shahriar
  Author URI: https://www.google.com
*/
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}


class OurWordFilterPlugin
{
  function __construct()
  {
    add_action('admin_menu', array($this, 'ourMenu'));
  }

  function ourMenu()
  {
    add_menu_page('Word To Filter', 'Word Filter', 'manage_options', 'our-word-filter', array($this, 'wordFilterPage'), 'dashicons-smiley', 100);
    add_submenu_page('our-word-filter', 'Word To Filter', 'Word list', 'manage_options', 'our-word-filter', array($this, 'wordFilterPage'), 100);
    add_submenu_page('our-word-filter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', array($this, 'optionsSubPage'), 100);
  }
  function wordFilterPage()
  { ?>

    Hello World

  <?php }
  function optionsSubPage()
  { ?>

    Sub menu page.
<?php }
}

$ourWordFilterPlugin = new OurWordFilterPlugin();
