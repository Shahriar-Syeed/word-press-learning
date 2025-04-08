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
    // add_action('enqueue_block_editor_assets', array($this, 'adminAssets')); // deprecate history
    add_action('init', array($this, 'adminAssets'));
  }

  function adminAssets()
  {
    // wp_enqueue_script('ourNewBlockType', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element')); // deprecate history
    wp_register_script('ourNewBlockType', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
    register_block_type('ourplugin/seeking-attention', array(
      'editor_script' => 'ourNewBlockType',
      'render_callback' => array($this, 'theHTML'),
    ));
  }
  function theHTML($attributes)
  {
    // return '<h1> Today the sky is completely ' . $attributes['skyColor'] . ' and the grass is ' . $attributes['grassColor'] . '.!!!!</h1>';
    ob_start(); ?>
    <h3> Today the sky is completely <?php echo esc_html($attributes['skyColor']); ?> and the grass is <?php echo esc_html($attributes['grassColor']); ?>.</h3>

<?php return ob_get_clean();
  }
}

$seekingAttention = new SeekingAttention();
