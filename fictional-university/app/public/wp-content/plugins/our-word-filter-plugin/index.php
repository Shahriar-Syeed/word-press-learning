<?php
/*
  Plugin Name: Our Word Filter Plugin
  Description: Replaces a list of words.
  Version: 1.0
  Author: Shahriar
  Author URI: https://www.google.com
*/
if (!defined('ABSPATH')) exit; // Exit if accessed directly



class OurWordFilterPlugin
{
  function __construct()
  {
    add_action('admin_menu', array($this, 'ourMenu'));
    add_action('admin_init', array($this, 'ourSettings'));
    if (get_option('plugin_words_to_filter')) {
      add_filter('the_content', array($this, 'filterLogic'));
    }
  }

  function ourSettings()
  {
    add_settings_section('replacement-text-section', null, null, 'word-filter-options');
    register_setting('replacementFields', 'replacementText');
    add_settings_field('replacement-text', 'Filtered Text', array($this, 'replacementFieldHTML'), 'word-filter-options', 'replacement-text-section');
  }

  function replacementFieldHTML()
  {
?>
    <input type="text" name="replacementText" value="<?php echo esc_attr(get_option('replacementText')); ?>" placeholder="***">
    <p class="description">Leave black to simply remove the filtered words.</p>
    <?php
  }

  function filterLogic($content)
  {
    $badWords = explode(',', get_option('plugin_words_to_filter'));
    $badWordsTrimmed = array_map('trim', $badWords);
    return str_ireplace($badWordsTrimmed, esc_html(get_option('replacementText', "***")), $content);
  }

  function ourMenu()
  {
    // add_menu_page('Word To Filter', 'Word Filter', 'manage_options', 'our-word-filter', array($this, 'wordFilterPage'), plugin_dir_url(__FILE__) . 'custom.svg', 100);
    $mainPageHook = add_menu_page('Word To Filter', 'Word Filter', 'manage_options', 'our-word-filter', array($this, 'wordFilterPage'), 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIiBmaWxsPSJub25lIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMCAyMEMxNS41MjI5IDIwIDIwIDE1LjUyMjkgMjAgMTBDMjAgNC40NzcxNCAxNS41MjI5IDAgMTAgMEM0LjQ3NzE0IDAgMCA0LjQ3NzE0IDAgMTBDMCAxNS41MjI5IDQuNDc3MTQgMjAgMTAgMjBaTTExLjk5IDcuNDQ2NjZMMTAuMDc4MSAxLjU2MjVMOC4xNjYyNiA3LjQ0NjY2SDEuOTc5MjhMNi45ODQ2NSAxMS4wODMzTDUuMDcyNzUgMTYuOTY3NEwxMC4wNzgxIDEzLjMzMDhMMTUuMDgzNSAxNi45Njc0TDEzLjE3MTYgMTEuMDgzM0wxOC4xNzcgNy40NDY2NkgxMS45OVoiIGZpbGw9IiNGRkRGOEQiLz4KPC9zdmc+', 100);
    add_submenu_page('our-word-filter', 'Word To Filter', 'Word list', 'manage_options', 'our-word-filter', array($this, 'wordFilterPage'), 100);
    add_submenu_page('our-word-filter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', array($this, 'optionsSubPage'), 100);
    add_action("load-{$mainPageHook}", array($this, 'mainPageAssets'));
  }

  function mainPageAssets()
  {
    wp_enqueue_style('filterAdminCss', plugin_dir_url(__FILE__) . 'style.css');
  }

  function handleForm()
  {
    if (wp_verify_nonce($_POST['ourNonce'], 'saveFilterWords') and current_user_can('manage_options')) {
      update_option('plugin_words_to_filter', sanitize_text_field($_POST['plugin-words-to-filter'])); ?>
      <div class="updated">
        <p>Your filtered words were saved.</p>
      </div>
    <?php
    } else {
    ?>
      <div class="error">
        <p>Sorry you do not have parmission to perform that action.</p>
      </div>
    <?php
    }
  }

  function wordFilterPage()
  { ?>
    <div class="wrap">
      <h1>Word Filter</h1>
      <?php if (isset($_POST['justsubmitted']) == "true") {
        // echo 'Thank you';
        $this->handleForm();
      } ?>
      <form method="POST">
        <input type="hidden" name="justsubmitted" value="true">
        <?php wp_nonce_field('saveFilterWords', 'ourNonce'); ?>
        <label for="pluginWordToFilter">
          <p>Enter a <strong>comma-separated</strong> list of words to filter form your site's content</p>
        </label>
        <div class="word-filter__flex-container">
          <textarea name="plugin-words-to-filter" id="pluginWordToFilter" placeholder="bad, mean, awful, horrible"><?php echo esc_textarea(get_option('plugin_words_to_filter')); ?></textarea>
        </div>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
      </form>
    </div>


  <?php }
  function optionsSubPage()
  { ?>
    <div class="wrap">
      <h1>Word Filter Option</h1>
      <?php if (isset($_POST['justsubmitted']) == "true") {
        // echo 'Thank you';
        $this->handleForm();
      } ?>
      <form method="POST" action="options.php">
        <?php
        settings_errors();
        settings_fields('replacementFields');
        do_settings_sections('word-filter-options');
        submit_button();
        ?>
      </form>
    </div>
<?php }
}

$ourWordFilterPlugin = new OurWordFilterPlugin();
