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
  }

  function adminPage()
  {
    add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-setting-page', array($this, 'shaHTML'));
  }

  function shaHTML()
  {
?>
    <div class="wrap">
      <h1>Word Count Settings</h1>
    </div>

<?php
  }
}

$wordCountAmdTimePlugin = new WordCountAmdTimePlugin;

// add_action('admin_menu', 'shaPluginSettingsLink');

// function shaPluginSettingsLink()
// {
//   add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-setting-page', 'shaSettingPageHTML');
// }

// function shaSettingPageHTML()
// {

// 
?>

<!-- <p>Hello world, real plugin</p> -->

<?php
// }
