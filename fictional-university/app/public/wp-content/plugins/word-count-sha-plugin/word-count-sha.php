<?php

/*
  Plugin Name: Our Test word count Plugin
  Description: A truly amazing plugin,
  Version: 1.0
  Author: Shahriar
  Author URI: HTTPS://WWW.GOOGLE.COM
  Text Domain: wcpdomain
  Domain Path: /languages

*/

class WordCountAndTimePlugin
{
  function __construct()
  {
    add_action('admin_menu', array($this, 'adminPage'));
    add_action('admin_init', array($this, 'settings'));
    add_filter('the_content', array($this, 'ifWrap'));
    add_action('init', array($this, 'languages'));
  }

  function languages()
  {
    // load_plugin_textdomain('wcpdomain', false, dirname(plugin_basename(__FILE__)) . '/languages');
    load_plugin_textdomain('wcpdomain', false, dirname(plugin_basename(__FILE__)) . '/languages');
  }

  function ifWrap($content)
  {
    // error_log('Checking ifWrap conditions...');
    // error_log('is_admin(): ' . (is_admin() ? 'true' : 'false'));
    // error_log('wp_doing_ajax(): ' . (wp_doing_ajax() ? 'true' : 'false'));
    // error_log('is_main_query(): ' . (is_main_query() ? 'true' : 'false'));
    // error_log('is_single(): ' . (is_single() ? 'true' : 'false'));
    if (is_admin() || wp_doing_ajax()) {
      return $content;
    }
    if (is_main_query() and is_single() and (get_option('wcp_wordcount', '1') or get_option('wcp_characterCount', '1') or get_option('wcp_readTime', '1'))) {
      return $this->createHTML($content);
    }
    return $content;
  }
  function createHTML($content)
  {
    $html = '<h3>' . esc_html(get_option('wcp_headline', 'Post Statistics')) . '</h3><p>';
    // get word count once because both word count  and read time will need it.
    if (get_option('wcp_wordcount', '1') or get_option('wcp_readTime', '1')) {

      $wordCount = str_word_count(strip_tags($content));
    }
    if (get_option('wcp_wordcount', '1')) {
      $html .= esc_html__('This post has', 'wcpdomain') . ' ' . $wordCount . ' ' . esc_html__('words.', 'wcpdomain') . '<br>';
    }
    if (get_option('wcp_characterCount', '1')) {
      $html .= esc_html__('This post has', 'wcpdomain') . ' ' . strlen(strip_tags($content)) . ' ' . esc_html__('characters.', 'wcpdomain') . '<br>';
    }
    if (get_option('wcp_readTime', '1')) {
      $html .= esc_html__('This post will take about', 'wcpdomain') . ' ' . round($wordCount / 225) . ' ' . esc_html__('minute(s) to read.', 'wcpdomain') . '<br>';
    }
    $html .= '</p>';
    if (get_option('wcp_location', '0') == '0') {
      return $html . $content;
    }
    return $content . $html;
  }

  function settings()
  {
    add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');

    add_settings_field('wcp_location', 'Display Location', array($this, 'locationHTML'), 'word-count-settings-page', 'wcp_first_section');
    register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => array($this, 'sanitizeLocation'), 'default' => '0'));

    add_settings_field('wcp_headline', 'Headline Text', array($this, 'headlineHTML'), 'word-count-settings-page', 'wcp_first_section');
    register_setting('wordcountplugin', 'wcp_headline', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics'));

    /*add_settings_field('wcp_wordCount', 'Word Count', array($this, 'wordCountHTML'), 'word-count-settings-page', 'wcp_first_section');
    register_setting('wordcountplugin', 'wcp_wordCount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

    add_settings_field('wcp_characterCount', 'Character Count', array($this, 'characterCountHTML'), 'word-count-settings-page', 'wcp_first_section');
    register_setting('wordcountplugin', 'wcp_characterCount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

    add_settings_field('wcp_readTime', 'Read Time', array($this, 'readTimeHTML'), 'word-count-settings-page', 'wcp_first_section');
    register_setting('wordcountplugin', 'wcp_readTime', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));*/

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
      <input type="checkbox" name="<?php echo esc_attr($args['theName']); ?>" value="1" <?php checked(get_option($args['theName']), '1'); ?>>

    <?php
    }
  }

  function adminPage()
  {
    add_options_page('Word Count Settings', __('Word Count', 'wcpdomain'), 'manage_options', 'word-count-settings-page', array($this, 'shaHTML'));
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

$wordCountAndTimePlugin = new WordCountAndTimePlugin();

/*add_action('admin_menu', 'shaPluginSettingsLink');

function shaPluginSettingsLink()
{
  add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings-page', 'shaSettingPageHTML');
}

function shaSettingPageHTML()
{


?>

<p>Hello world, real plugin</p>

<?php
}*/
