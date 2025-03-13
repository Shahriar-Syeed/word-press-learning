<?php

/*
  Plugin Name: Our Test word count Plugin
  Description: A truly amazing plugin,
  Version: 1.0
  Author: Shahriar
  Author URI: HTTPS://WWW.GOOGLE.COM

*/

class WordCountAndTimePlugin
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
    register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => array($this, 'sanitizeLocation'), 'default' => '0'));

    add_settings_field('wcp_headline', 'Headline Text', array($this, 'headlineHTML'), 'word-count-settings-page', 'wcp_first_section');
    register_setting('wordcountplugin', 'wcp_headline', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics'));

    // add_settings_field('wcp_wordCount', 'Word Count', array($this, 'wordCountHTML'), 'word-count-settings-page', 'wcp_first_section');
    // register_setting('wordcountplugin', 'wcp_wordCount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

    // add_settings_field('wcp_characterCount', 'Character Count', array($this, 'characterCountHTML'), 'word-count-settings-page', 'wcp_first_section');
    // register_setting('wordcountplugin', 'wcp_characterCount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

    // add_settings_field('wcp_readTime', 'Read Time', array($this, 'readTimeHTML'), 'word-count-settings-page', 'wcp_first_section');
    // register_setting('wordcountplugin', 'wcp_readTime', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

    add_settings_field('wcp_wordCount', 'Word Count', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_wordCount'));
    register_setting('wordcountplugin', 'wcp_wordCount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

    add_settings_field('wcp_characterCount', 'Character Count', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_characterCount'));
    register_setting('wordcountplugin', 'wcp_characterCount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

    add_settings_field('wcp_readTime', 'Read Time', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_readTime'));
    register_setting('wordcountplugin', 'wcp_readTime', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));
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

  function sanitizeLocation($input)
  {
    if ($input != '0' and $input != '1') {
      add_settings_error('wcp_location', 'wcp_location_error', 'Display location must be either beginning or end.');
      return get_option('wcp_location');
    }
    return $input;
  }

  function headlineHTML()
  {
  ?>
    <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline'));  ?>">

    <?php
  }

  // reusable checkbox function

  function checkboxHTML($args)
  {
    if (isset($args['theName'])) {
    ?>
      <input type="checkbox" name="<?php echo $args['theName']; ?>" value="1" <?php checked(get_option($args['theName']), '1'); ?>>

    <?php
    }
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

$wordCountAndTimePlugin = new WordCountAndTimePlugin;

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
