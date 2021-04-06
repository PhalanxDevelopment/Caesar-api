<?php
add_action('after_setup_theme', 'blankslate_setup');
function blankslate_setup()
{
  load_theme_textdomain('blankslate', get_template_directory() . '/languages');
  add_theme_support('title-tag');
  add_theme_support('automatic-feed-links');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('search-form'));
  global $content_width;
  if (!isset($content_width)) {
    $content_width = 1920;
  }
  register_nav_menus(array('main-menu' => esc_html__('Main Menu', 'blankslate')));
}
add_action('wp_enqueue_scripts', 'blankslate_load_scripts');
function blankslate_load_scripts()
{
  wp_enqueue_style('blankslate-style', get_stylesheet_uri());
  wp_enqueue_script('jquery');
}
add_action('wp_footer', 'blankslate_footer_scripts');
function blankslate_footer_scripts()
{
  ?>
  <script>
    jQuery(document).ready(function($) {
      var deviceAgent = navigator.userAgent.toLowerCase();
      if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
        $("html").addClass("ios");
        $("html").addClass("mobile");
      }
      if (navigator.userAgent.search("MSIE") >= 0) {
        $("html").addClass("ie");
      } else if (navigator.userAgent.search("Chrome") >= 0) {
        $("html").addClass("chrome");
      } else if (navigator.userAgent.search("Firefox") >= 0) {
        $("html").addClass("firefox");
      } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
        $("html").addClass("safari");
      } else if (navigator.userAgent.search("Opera") >= 0) {
        $("html").addClass("opera");
      }
    });
  </script>
<?php
}
add_filter('document_title_separator', 'blankslate_document_title_separator');
function blankslate_document_title_separator($sep)
{
  $sep = '|';
  return $sep;
}
add_filter('the_title', 'blankslate_title');
function blankslate_title($title)
{
  if ($title == '') {
    return '...';
  } else {
    return $title;
  }
}
add_filter('the_content_more_link', 'blankslate_read_more_link');
function blankslate_read_more_link()
{
  if (!is_admin()) {
    return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">...</a>';
  }
}
add_filter('excerpt_more', 'blankslate_excerpt_read_more_link');
function blankslate_excerpt_read_more_link($more)
{
  if (!is_admin()) {
    global $post;
    return ' <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">...</a>';
  }
}
add_filter('intermediate_image_sizes_advanced', 'blankslate_image_insert_override');
function blankslate_image_insert_override($sizes)
{
  unset($sizes['medium_large']);
  return $sizes;
}
add_action('widgets_init', 'blankslate_widgets_init');
function blankslate_widgets_init()
{
  register_sidebar(array(
    'name' => esc_html__('Sidebar Widget Area', 'blankslate'),
    'id' => 'primary-widget-area',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
}
add_action('wp_head', 'blankslate_pingback_header');
function blankslate_pingback_header()
{
  if (is_singular() && pings_open()) {
    printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
  }
}
add_action('comment_form_before', 'blankslate_enqueue_comment_reply_script');
function blankslate_enqueue_comment_reply_script()
{
  if (get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
function blankslate_custom_pings($comment)
{
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter('get_comments_number', 'blankslate_comment_count', 0);
function blankslate_comment_count($count)
{
  if (!is_admin()) {
    global $id;
    $get_comments = get_comments('status=approve&post_id=' . $id);
    $comments_by_type = separate_comments($get_comments);
    return count($comments_by_type['comment']);
  } else {
    return $count;
  }
}

/**
 * Register a event post type, with REST API support
 *
 * Based on example at: https://codex.wordpress.org/Function_Reference/register_post_type
 */
add_action('init', 'my_event_cpt');
function my_event_cpt()
{
  $labels = array(
    'name'               => _x('Events', 'post type general name', 'your-plugin-textdomain'),
    'singular_name'      => _x('Event', 'post type singular name', 'your-plugin-textdomain'),
    'menu_name'          => _x('Events', 'admin menu', 'your-plugin-textdomain'),
    'name_admin_bar'     => _x('Event', 'add new on admin bar', 'your-plugin-textdomain'),
    'add_new'            => _x('Add New', 'event', 'your-plugin-textdomain'),
    'add_new_item'       => __('Add New Event', 'your-plugin-textdomain'),
    'new_item'           => __('New Event', 'your-plugin-textdomain'),
    'edit_item'          => __('Edit Event', 'your-plugin-textdomain'),
    'view_item'          => __('View Event', 'your-plugin-textdomain'),
    'all_items'          => __('All Events', 'your-plugin-textdomain'),
    'search_items'       => __('Search Events', 'your-plugin-textdomain'),
    'parent_item_colon'  => __('Parent Events:', 'your-plugin-textdomain'),
    'not_found'          => __('No Events found.', 'your-plugin-textdomain'),
    'not_found_in_trash' => __('No Events found in Trash.', 'your-plugin-textdomain')
  );

  $args = array(
    'labels'             => $labels,
    'description'        => __('Description.', 'your-plugin-textdomain'),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'event'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'show_in_rest'       => true,
    'rest_base'          => 'events',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
  );

  register_post_type('event', $args);
}
add_action('rest_api_init', 'register_rest_images');
function register_rest_images()
{
  register_rest_field(
    array('event'),
    'fimg_url',
    array(
      'get_callback'    => 'get_rest_featured_image',
      'update_callback' => null,
      'schema'          => null,
    )
  );
}
function get_rest_featured_image($object, $field_name, $request)
{
  if ($object['featured_media']) {
    $img = wp_get_attachment_image_src($object['featured_media'], 'app-thumb');
    return $img[0];
  }
  return false;
}

function jwt_auth_function($data, $user)
{
  $data['user_role'] = $user->roles;
  $data['user_id'] = $user->ID;
  $data['avatar'] = get_avatar_url($user->ID);
  return $data;
}
add_filter('jwt_auth_token_before_dispatch', 'jwt_auth_function', 10, 2);
