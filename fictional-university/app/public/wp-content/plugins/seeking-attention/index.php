<?php
/*
  Plugin Name: Seeking Attention Quiz
  Description: Give your readers a multiple choice question.
  Version: 1.0
  Author: Shahriar
  Author URI: http://google.com
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class SeekingAttention
{
  function __construct()
  {
    add_action('enqueue_block_editor_assets', array($this, 'adminAssets'));
  }

  function adminAssets()
  {
    wp_enqueue_script('ourNewBlockType', plugin_dir_url(__FILE__) . 'test.js', array('wp-blocks', 'wp-element'));
  }
}

$seekingAttention = new SeekingAttention();
