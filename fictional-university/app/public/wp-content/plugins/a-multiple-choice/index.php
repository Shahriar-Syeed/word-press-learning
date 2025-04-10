<?php
/*
  Plugin Name: A Multiple Choice
  Description: Give your readers a multiple choice question.
  Version: 1.0
  Author: Shahriar
  Author URI: https://google.com
*/

if (!defined('ABSPATH')) exit;

class MultipleChoice
{
  function __construct()
  {
    add_action('init', array($this, 'adminAssets'));
  }

  function adminAssets()
  {
    wp_register_style('quizEditCSS', plugin_dir_url(__FILE__) . 'build/index.css');
    wp_register_script('ourLatestBlockType', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'));
    register_block_type("ourplugin/a-multiple-choice", array(
      'editor_script' => 'ourLatestBlockType',
      'editor_style' => 'quizEditCSS',
      'render_callback' => array($this, 'thisHTML'),
    ));
  }
  function thisHTML($attributes)
  {
    if (!is_admin()) {
      wp_enqueue_script('multipleChoiceFrontend', plugin_dir_url(__FILE__) . 'build/frontend.js', array('wp-element', 'wp-blocks'));
      wp_enqueue_style('multipleChoiceFrontendStyle', plugin_dir_url(__FILE__) . 'build/frontend.css');
    }

    ob_start(); ?>
    <div class="multiple-choice-update-me"></div>
<?php return ob_get_clean();
  }
}

$aMultipleChoice = new MultipleChoice();
