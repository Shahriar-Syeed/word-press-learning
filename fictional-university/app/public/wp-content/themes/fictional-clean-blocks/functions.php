<?php

function universityQueryVars($vars)
{
  $vars[] = 'skyColor';
  $vars[] = 'grassColor';
  return $vars;
}

add_filter('query_vars', 'universityQueryVars');

require get_theme_file_path('/inc/like-route.php');
require get_theme_file_path('/inc/search-route.php');

// adding data in data 
function university_custom_rest()
{
  register_rest_field('post', 'authorName', array(
    'get_callback' => function () {
      return get_the_author();
    }
  ));
  register_rest_field('note', 'userNoteCount', array(
    'get_callback' => function () {
      return count_user_posts(get_current_user_id(), 'note');
    }
  ));
}

add_action('rest_api_init', 'university_custom_rest');

function pageBanner($args = NULL)
{
  //php logic will live here
  if (!isset($args['title'])) {
    $args['title'] = get_the_title();
  }
  if (!isset($args['subtitle'])) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }
  if (!isset($args['photo'])) {
    if (get_field('page_banner_background_image') and !is_archive() and !is_home()) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }

?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo  $args['photo']; ?>)"></div>

    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
      <div class="page-banner__intro">
        <p><?php
            echo $args['subtitle'];
            // the_field('page_banner_subtitle');
            ?></p>
      </div>
    </div>
  </div>
<?php
}

function university_files(): void
{
  // wp_enqueue_style('university_main_style', get_stylesheet_uri()); for style css
  // wp_enqueue_script('googleMap', '//maps.googleapis.com');
  // wp_enqueue_script('googleMap', '//maps.googleapis.com.maps/api/js?key=pk.eyJ1Ijoic2FyaWthMzQzIiwiYSI6ImNsZno2OHhnaTE3emYzcXF1em5mOHVwaDcifQ.r4d8RIU9Dja96ijziSKBfQ');
  wp_enqueue_script('university-main-javascript', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_style', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extra_style', get_theme_file_uri('/build/index.css'));

  wp_localize_script('university-main-javascript', 'universityData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest'),
  ));
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features(): void
{
  // register_nav_menu('headerMenuLocation', 'Header Menu Location');
  // register_nav_menu('footerMenuLocationOne', 'Footer Menu Location One');
  // register_nav_menu('footerMenuLocationTwo', 'Footer Menu Location Two');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('professorLandscape', 400, 260, array('left', 'top'));
  add_image_size('professorPortrait', 480, 650, true);
  add_image_size('pageBanner', 1500, 350, true);
  add_theme_support('editor-styles');
  add_editor_style(array('https: //fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i', 'build/style-index.css', 'build/index.css'));
}

add_action('after_setup_theme', 'university_features');

// function university_post_type()
// {
//   register_post_type('event', array(
//     'public' => true,
//     'labels' => array(
//       'name' => 'Events',
//     ),
//     'menu_icon' => 'dashicons-calendar',
//   ));
// }
// add_action('init', 'university_post_type');
function university_adjust_query($query)
{
  // $query->set('posts_per_page', '1'); //universal
  if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
    $today = date('Ymd');
    // $query->set('posts_per_page', '1');
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric',
      ),
    ));
  }
  if (!is_admin() and is_post_type_archive('program') and $query->is_main_query()) {
    $today = date('Ymd');
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', '-1');
  }
}

add_action('pre_get_posts', 'university_adjust_query');



// Redirect subscriber accounts out of admin and onto homepage


add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend()
{
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
    wp_redirect(site_url('/'));
    exit;
  }
}

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar()
{
  $roles = wp_get_current_user()->roles;

  if (count($roles) == 1 and $roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}

// Customize Login Screen

add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl()
{
  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCss');

function ourLoginCss()
{
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_style', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extra_style', get_theme_file_uri('/build/index.css'));
}

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle()
{
  return get_bloginfo('name');
}

// Force note posts to be private
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2); // 10 is priority which wp insert post data will run {1 will run first},2 is number of parameter

function makeNotePrivate($data, $postArr)
{

  if ($data['post_type'] == 'note') {
    if (count_user_posts(get_current_user_id(), 'note') > 4 and !$postArr['ID']) {
      die("You have reached post limit.");
    }
    $data['post_content'] = sanitize_textarea_field($data['post_content']);
    $data['post_title'] = sanitize_text_field($data['post_title']);
  }
  if ($data['post_type'] == 'note' and $data['post_status'] != 'trash') {
    $data['post_status'] = "private";
  }
  return $data;
}



class PlaceholderBlock
{
  function __construct($name)
  {
    $this->name = $name;
    add_action('init', array($this, 'onInit'));
  }

  function ourRenderCallback($attributes, $content)
  {
    ob_start();
    require get_theme_file_path("/our-blocks/{$this->name}.php");
    return ob_get_clean();
  }

  function onInit()
  {
    wp_register_script("{$this->name}BlockScript", get_stylesheet_directory_uri() . "/our-blocks/{$this->name}.js", array('wp-blocks', 'wp-editor'), null, true);

    register_block_type("ourblocktheme/{$this->name}", array(
      'editor_script' => "{$this->name}BlockScript",
      'render_callback' => [$this, 'ourRenderCallback'],
    ));
  }
}

function our_new_blocks()
{
  // wp_localize_script('wp-editor', 'ourThemeData', array('fallbackImagePath' => get_stylesheet_directory_uri()));
  wp_localize_script('wp-editor', 'ourThemeData', array('themeImagePath' => get_stylesheet_directory_uri()));

  register_block_type_from_metadata(__DIR__ . '/build/genericbutton');
  register_block_type_from_metadata(__DIR__ . '/build/genericheading');
  register_block_type_from_metadata(__DIR__ . '/build/slideshow');
  register_block_type_from_metadata(__DIR__ . '/build/slide');
  register_block_type_from_metadata(__DIR__ . '/build/banner');
  register_block_type_from_metadata(__DIR__ . '/build/footer');
  register_block_type_from_metadata(__DIR__ . '/build/header');
  register_block_type_from_metadata(__DIR__ . '/build/eventsandblogs');
  register_block_type_from_metadata(__DIR__ . '/build/singlepost');
  register_block_type_from_metadata(__DIR__ . '/build/page');
  register_block_type_from_metadata(__DIR__ . '/build/blogindex');
  register_block_type_from_metadata(__DIR__ . '/build/programarchive');
  register_block_type_from_metadata(__DIR__ . '/build/singleprogram');
  register_block_type_from_metadata(__DIR__ . '/build/singleprofessor');
  register_block_type_from_metadata(__DIR__ . '/build/mynotes');
  register_block_type_from_metadata(__DIR__ . '/build/search');
  register_block_type_from_metadata(__DIR__ . '/build/searchresults');
}

// Register our new blocks
add_action('init', 'our_new_blocks');
// new PlaceholderBlock("eventsandblogs");
// new PlaceholderBlock("header");
// new PlaceholderBlock("footer");
// new PlaceholderBlock("singlepost");
// new PlaceholderBlock("page");
// new PlaceholderBlock("blogindex");
// new PlaceholderBlock("programarchive");
// new PlaceholderBlock("singleprogram");
// new PlaceholderBlock("singleprofessor");
// new PlaceholderBlock("mynotes");

class JSXBlock
{
  function __construct($name, $renderCallback = null, $data = null)
  {
    $this->name = $name;
    $this->data = $data;
    $this->renderCallback = $renderCallback;
    add_action('init', array($this, 'onInit'));
  }

  function ourRenderCallback($attributes, $content)
  {
    ob_start();
    require get_theme_file_path("/our-blocks/{$this->name}.php");
    return ob_get_clean();
  }

  function onInit()
  {
    wp_register_script("{$this->name}BlockScript", get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'), null, true);

    if ($this->data) {
      wp_localize_script("{$this->name}BlockScript", $this->name, $this->data);
    }

    $ourArgs = array(
      'editor_script' => "{$this->name}BlockScript"
    );

    if ($this->renderCallback) {
      $ourArgs['render_callback'] = [$this, 'ourRenderCallback'];
    }

    register_block_type("ourblocktheme/{$this->name}", $ourArgs);
  }
}

// new JSXBlock('banner', true, ['fallbackimage' => get_theme_file_uri('/images/library-hero.jpg')]);
// new JSXBlock('genericheading');
// new JSXBlock('genericbutton');
// new JSXBlock('slideshow', true);
// new JSXBlock('slide', true, ['themeimagepath' => get_theme_file_uri('/images/')]);

// function myallowedblocks($allowed_block_types, $editor_context)
// {
//   // if post is professor  then only paragraph and list block is allowed
//   if ($editor_context->post->post_type == "professor") {
//     return array('core/paragraph', 'core/list');
//   }
//   // return $allowed_block_types; // passing through all blocks

//   // return array('ourblocktheme/header', 'ourblocktheme/footer'); //only two blocks are allowed in all templates site editor
//   // if you are on a page/post editor screen
//   if (!empty($editor_context->post)) {
//     return $allowed_block_types;
//   }
//   // if you are on the FSE(full site editor screen)
//   return array('ourblocktheme/header', 'ourblocktheme/footer');
// }

// add_filter('allowed_block_types_all', 'myallowedblocks', 10, 2);
