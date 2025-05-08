

<?php
/**
 * Plugin Name: Custom Slider Widget
 * Description: A custom slider widget for Elementor.
 * Plugin URI:  https://your-site.com/
 * Version:     1.0.0
 * Author:      Shahriar
 * Author URI:  https://your-site.com/
 * Text Domain: custom-slide-widget
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

// Define plugin constants
define('CUSTOM_SLIDER_WIDGET_URL', plugin_dir_url(__FILE__));

// Register widget
function register_custom_slider_widget($widgets_manager)
{
  require_once(__DIR__ . '/custom-elementor-widget/custom-widget.php');
  $widgets_manager->register(new \Elementor_Slide_Widget());
}
add_action('elementor/widgets/register', 'register_custom_slider_widget');

// Enqueue styles and scripts
function custom_slider_widget_scripts()
{
  // CSS
  wp_enqueue_style(
    'splide-core',
    'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css'
  );
  wp_enqueue_style(
    'custom-slider-widget-style',
    CUSTOM_SLIDER_WIDGET_URL . 'css/slider-style.css',
    [],
    '1.0.0'
  );

  // JS
  wp_enqueue_script(
    'splide-js',
    'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js',
    [],
    '4.1.4',
    true
  );
}
add_action('wp_enqueue_scripts', 'custom_slider_widget_scripts');
add_action('elementor/frontend/after_enqueue_styles', 'custom_slider_widget_scripts');
