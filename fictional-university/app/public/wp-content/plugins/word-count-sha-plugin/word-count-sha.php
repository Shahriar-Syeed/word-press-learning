<?php

/*
  Plugin Name: Our Test word count Plugin
  Description: A truly amazing plugin,
  Version: 1.0
  Author: Shahriar
  Author URI: HTTPS://WWW.GOOGLE.COM

*/

class WordCountAmdTimePlugin
{
  function __construct()
  {
    add_action('admin_menu', array($this, 'adminPage'));
    add_action('admin_init', array($this, 'settings'));
  }

  function settings()
  {
    add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');

    add_settings_field('wcp_location', 'Display Location', array($this, 'locationHTML'), 'word-count-settings-page', 'wcp_first_section');
    register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

    add_settings_field('wcp_headline', 'Headline Text', array($this, 'headlineHTML'), 'word-count-settings-page', 'wcp_first_section');
    register_setting('wordcountplugin', 'wcp_headline', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics'));
  }

  function locationHTML()
  {
?>
    <select name="wcp_location">
      <option value="0" <?php selected(get_option('wcp_location'), '0') ?>>Beginning of post</option>
      <option value="1" <?php selected(get_option('wcp_location'), '1') ?>>End of post</option>
    </select>
  <?php
  }

  function headlineHTML()
  {
  ?>
    <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline'));  ?>">

  <?php
  }

  function adminPage()
  {
    add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings-page', array($this, 'shaHTML'));
  }

  function shaHTML()
  {
  ?>
    <div class="wrap">
      <h1>Word Count Settings</h1>
      <form action="options.php" method="Post">
        <?php
        settings_fields('wordcountplugin');
        do_settings_sections('word-count-settings-page');
        submit_button();

        ?>
      </form>
    </div>

<?php
  }
}

$wordCountAmdTimePlugin = new WordCountAmdTimePlugin;

// add_action('admin_menu', 'shaPluginSettingsLink');

// function shaPluginSettingsLink()
// {
//   add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings-page', 'shaSettingPageHTML');
// }

// function shaSettingPageHTML()
// {

// 
?>

<!-- <p>Hello world, real plugin</p> -->

<?php
// }
