<?php
/*
Plugin Name: Blahlab Framework
Plugin URI: http://themeforest.net/user/honryou/portfolio
Description: Required for blahlab themes
Author: Andy Lu
Version: 1.0
Author URI: http://themeforest.net/user/honryou/portfolio
*/

define('BLAHLAB_PLUGIN_VERSION', '1.0');

$blahlab_widget_ready = false;
$dir = plugin_dir_path( __FILE__ );

require_once $dir . '/functions.php';
require_once $dir . '/post_types.php';

foreach (glob($dir . '/initializers/*.php') as $init_file) {
  require_once $init_file;
}

foreach (glob($dir . '/helpers/*.php') as $helper_file) {
  require_once $helper_file;
}


require_once $dir . '/widgets/vue.php';

/*
  In customize-widgets.js:

  $.extend( api.controlConstructor, {
    widget_form: api.Widgets.WidgetControl,
    sidebar_widgets: api.Widgets.SidebarControl
  });
*/
// Hook up custom customize controls
function blahlab_customize_control_js() {

  $blahlab_assets_version = defined('WP_DEBUG') && WP_DEBUG ?  time() : BLAHLAB_THEME_VERSION;

  wp_enqueue_script( 'blahlab-framework-asset-admin-sortable', plugin_dir_url(__FILE__) . 'Sortable.js', array(), $blahlab_assets_version, false );
  wp_enqueue_script( 'blahlab-framework-asset-admin-vuedraggable', plugin_dir_url(__FILE__) . 'vuedraggable.js', array('blahlab-framework-asset-admin-vue', 'blahlab-framework-asset-admin-sortable'), $blahlab_assets_version, false );
  wp_enqueue_script( 'blahlab-framework-asset-admin-data', plugin_dir_url(__FILE__) . 'data.js', array('jquery'), $blahlab_assets_version, false );
  wp_localize_script( 'blahlab-framework-asset-admin-data', 'blahlabThemeData', blahlab_theme_data());
  wp_enqueue_script( 'blahlab-framework-asset-admin-vue-components', plugin_dir_url(__FILE__) . 'vue-components.js', array('jquery', 'wp-color-picker', 'blahlab-framework-asset-admin-vue'), $blahlab_assets_version, false);
  wp_enqueue_script( 'blahlab-framework-asset-admin-customize-controls', plugin_dir_url(__FILE__) . 'customize-controls.js', array( 'customize-widgets', 'blahlab-framework-asset-admin-vue', 'blahlab-framework-asset-admin-data', 'jquery', 'blahlab-framework-asset-admin-vue-components'), $blahlab_assets_version, false );
  wp_enqueue_script( 'blahlab-framework-asset-admin-vue', plugin_dir_url(__FILE__) . 'vue.js', array(), $blahlab_assets_version, false );

}

add_action( 'customize_controls_enqueue_scripts', 'blahlab_customize_control_js' );


function blahlab_register_builder_sidebars() {

  foreach( blahlab_get_builder_pages() as $page){

    register_sidebar( array(
      'id'    => 'blahlab-builder-' . $page->ID,
      'name'    => $page->post_title  . esc_html__( ' Body' , 'blahlab-framework' ),
      // should keep before_widget and after_widget not empty to make the "customize shortcut" work
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '',
      'after_title'   => '',
    ) );

  }

  $dir = plugin_dir_path( __FILE__ );

  require_once $dir . '/widgets/base.php';
  require_once $dir . '/widgets/vue.php';

  $widget_files = array_merge( glob(get_template_directory() . '/widgets/*/widget.php') );
  $dev_plugin_widgets = glob(get_template_directory() . '/plugin-widgets/*/widget.php');
  $plugin_widgets = glob($dir . '/widgets/*/widget.php');

  if ( $dev_plugin_widgets ) $widget_files = array_merge( $widget_files, $dev_plugin_widgets );
  if ( $plugin_widgets ) $widget_files = array_merge( $widget_files, $plugin_widgets );

  foreach ($widget_files as $widget_file) {
    $name = basename(dirname($widget_file));
    if (preg_match("/\.disabled$/", $name)) {
      continue;
    }

    require_once $widget_file;

    $classified_name = implode('', array_map('ucfirst', explode('-', $name)));
    $widget_class = "Blahlab_{$classified_name}_Widget";
    // var_dump($widget_class);
    register_widget($widget_class);
  }

}

add_action( 'widgets_init', 'blahlab_register_builder_sidebars' );

function blahlab_customize_register( $wp_customize ) {
  // Do stuff with $wp_customize, the WP_Customize_Manager object.
  // remove the 'colors' section to somewhat fix the margin-top corrupt issue
  // $wp_customize->remove_section( 'colors' );

  // Change 'Widgets' panel title to 'Page Builder'
  $wp_customize->add_panel(
    'widgets', array(
      'priority' => 1,
      'title' => esc_html__('Page Builder' , 'blahlab-framework' ),
      'description' => esc_html__('Use this area to add widgets to your page, use the widgets for the Body section.' , 'blahlab-framework' ),
    )
  );

  $theme_options_view_path = blahlab_get_theme_options_view_path();

  if ( file_exists($theme_options_view_path) ) {

    $wp_customize->add_section( 'theme_options', array(
      'title'    => esc_html__( 'Theme Options', 'blahlab-framework' ),
      'priority' => 130, // Before Additional CSS.
    ) );

    // https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
    $wp_customize->add_setting( 'theme_options', array(
      'type' => 'theme_mod'
    ) );

    require_once plugin_dir_path( __FILE__ ) . '/classes/blahlab_wp_customize_theme_options_control.php';

    $control = new Blahlab_WP_Customize_Theme_Options_Control(
      $wp_customize,
      'theme_options',
      array(
        'section' => 'theme_options'
      )
    );

    $theme_options_defaults_path = blahlab_get_theme_options_defaults_path();

    if ( file_exists($theme_options_defaults_path) ) {
      $control->defaults = (array)include($theme_options_defaults_path);
    }

    $wp_customize->add_control($control);
    
  }

}

add_action( 'customize_register', 'blahlab_customize_register' );

// function blahlab_flush_rewrite_rules() {
if ( is_admin() ) {
  require_once(ABSPATH . 'wp-admin/includes/file.php');
  require_once(ABSPATH . 'wp-admin/includes/misc.php');
  // the flush_rewrite_rules has to be run after custom post types setup
  // because custom post types may add new rewrite rules
  // in fact, the flush_rewrite_rules has to be run after everything which can affect the rewrite rules
  // so action hook 'wp_loaded' is chosen, it is the action just fired before the 'parse_request' action
  // http://codex.wordpress.org/Plugin_API/Action_Reference
  add_action('wp_loaded', create_function('', 'flush_rewrite_rules();'));
}

if(isset($_REQUEST['flush_rewrite_rules']) && $_REQUEST['flush_rewrite_rules']) {
  require_once(ABSPATH . 'wp-admin/includes/file.php');
  require_once(ABSPATH . 'wp-admin/includes/misc.php');
  // the flush_rewrite_rules has to be run after custom post types setup
  // because custom post types may add new rewrite rules
  // in fact, the flush_rewrite_rules has to be run after everything which can affect the rewrite rules
  // so action hook 'wp_loaded' is chosen, it is the action just fired before the 'parse_request' action
  // http://codex.wordpress.org/Plugin_API/Action_Reference
  add_action('wp_loaded', create_function('', 'flush_rewrite_rules();'));
}

function blahlab_theme_data() {
  // this function polluted WP_Query for admin

  $ret = array();

  $posts = get_posts('posts_per_page=-1');

  $sanitized_posts = array();
  foreach($posts as $post) {
    $sanitized_posts[] = array(
      'ID' => $post->ID,
      'post_author' => esc_html($post->post_author),
      'post_title' => esc_html($post->post_title)
    );
  }

  $ret['posts'] = $sanitized_posts;

  $pages = get_pages();

  $sanitized_pages = array();
  foreach($pages as $page) {
    $sanitized_pages[] = array(
      'ID' => $page->ID,
      'post_author' => esc_html($page->post_author),
      'post_title' => esc_html($page->post_title)
    );
  }

  $ret['pages'] = $sanitized_pages;


  $items = blahlab_latest_posts_of_type('portfolio', -1);

  $portfolio_items = array();
  foreach ($items as $item) {
    $portfolio_items[] = array(
      "id" => $item->ID,
      "title" => esc_html($item->post_title)
    );
  }

  $ret['portfolio_items'] = $portfolio_items;

  $portfolio_items_dictionary = array();
  foreach ($items as $item) {
    $portfolio_items_dictionary[$item->ID] = array(
      "id" => $item->ID,
      "title" => esc_html($item->post_title),
      "content" => esc_html($item->post_content)
    );
  }

  $ret['portfolio_items_dictionary'] = $portfolio_items_dictionary;


  $ret['theme_slug'] = blahlab_theme_slug();
  $ret['theme_name'] = blahlab_theme_name();
  $ret['theme_options'] = blahlab_get_options();
  $ret['templateurl'] = get_template_directory_uri();
  $ret['admin_url'] = admin_url(); 

  global $post;

  if ( $post ) {
    $ret['page_url'] = get_page_link();
    $ret['theme_customizer_page_edit_url'] = blahlab_theme_customizer_page_edit_url($ret['page_url']);
  }

  return $ret;
}

function blahlab_theme_customizer_page_edit_url($page_url) {
  return add_query_arg(array( 'url' => urlencode($page_url) ), admin_url() . 'customize.php');
}

function blahlab_ajax_services() {
  $ret = blahlab_theme_data();

  echo json_encode($ret);

  die();
}

add_action( 'wp_ajax_blahlab_ajax_services', 'blahlab_ajax_services' );

add_action( 'customize_controls_print_footer_scripts' , 'blahlab_admin_scripts' );
add_action( 'admin_enqueue_scripts' , 'blahlab_admin_scripts' );

function blahlab_admin_scripts(){
  wp_enqueue_style(
    'blahlab-framework-asset' . '-font-awesome' ,
    plugin_dir_url(__FILE__) . '/assets/css/font-awesome.css',
    array() ,
    BLAHLAB_PLUGIN_VERSION
  );

  wp_enqueue_style(
    'blahlab-framework-asset' . '-linea-styles' ,
    plugin_dir_url(__FILE__) . '/assets/css/linea-styles.css',
    array() ,
    BLAHLAB_PLUGIN_VERSION
  );

  // &&&START&&&
  // wp_enqueue_style(
  //   'blahlab-framework-asset' . '-linea-styles' ,
  //   get_template_directory_uri() . '/assets/css/linea-styles.css',
  //   array() ,
  //   BLAHLAB_PLUGIN_VERSION
  // );
  // &&&END&&&

  // &&&START&&&
  // wp_enqueue_style(
  //   'blahlab-framework-asset' . '-linea-arrow-styles' ,
  //   get_template_directory_uri() . '/assets/css/linea-arrows-styles.css.css',
  //   array() ,
  //   BLAHLAB_PLUGIN_VERSION
  // );
  // &&&END&&&

  wp_enqueue_style(
    'blahlab-framework-asset' . '-admin-hack',
    plugin_dir_url(__FILE__) . '/assets/css/admin.css',
    array(),
    BLAHLAB_PLUGIN_VERSION
  );

  wp_enqueue_style(
    'blahlab-framework-asset' . '-admin-widgets_builder',
    plugin_dir_url(__FILE__) . '/assets/css/widgets-builder.css',
    array(),
    BLAHLAB_PLUGIN_VERSION
  );

  wp_enqueue_style(
    'blahlab-framework-asset' . '-admin-theme_options',
    plugin_dir_url(__FILE__) . '/assets/css/theme-options.css',
    array(),
    BLAHLAB_PLUGIN_VERSION
  );

  wp_enqueue_script(
    'blahlab-framework-asset-admin-vue' ,
    plugin_dir_url(__FILE__) . 'vue.js' ,
    array(),
    BLAHLAB_PLUGIN_VERSION,
    false
  );

  wp_enqueue_script( 
    'blahlab-framework-asset-admin-data', 
    plugin_dir_url(__FILE__) . 'data.js', 
    array('jquery'), 
    BLAHLAB_PLUGIN_VERSION, 
    false 
  );

  wp_localize_script( 'blahlab-framework-asset-admin-data', 'blahlabThemeData', blahlab_theme_data());

  wp_enqueue_script(
    'blahlab-framework-asset-admin-vue-components', 
    plugin_dir_url(__FILE__) . 'vue-components.js', 
    array('jquery', 'wp-color-picker', 'blahlab-framework-asset-admin-vue', 'underscore'), 
    BLAHLAB_PLUGIN_VERSION, 
    false
  );

  wp_enqueue_script( 
    'blahlab-framework-asset-admin-sortable', 
    plugin_dir_url(__FILE__) . 'Sortable.js', 
    array(), 
    BLAHLAB_PLUGIN_VERSION, 
    false 
  );

  wp_enqueue_script( 
    'blahlab-framework-asset-admin-vuedraggable', 
    plugin_dir_url(__FILE__) . 'vuedraggable.js', 
    array('blahlab-framework-asset-admin-vue', 'blahlab-framework-asset-admin-sortable'), 
    BLAHLAB_PLUGIN_VERSION, 
    false 
  );

  wp_enqueue_script(
    'blahlab-framework-asset' . '-admin-application' ,
    plugin_dir_url(__FILE__) . 'application.js' ,
    array('jquery', 'blahlab-framework-asset-admin-vue', 'blahlab-framework-asset-admin-data', 'blahlab-framework-asset-admin-vue-components', 'blahlab-framework-asset-admin-vuedraggable'),
    BLAHLAB_PLUGIN_VERSION,
    false
  );

  // wp_enqueue_script(
  //   'blahlab-framework-asset' . '-admin-optionsframework' ,
  //   plugin_dir_url(__FILE__) . 'optionsframework.js' ,
  //   array('jquery', 'wp-color-picker'),
  //   BLAHLAB_PLUGIN_VERSION,
  //   false
  // );

  wp_localize_script(
    'blahlab-framework-asset' . '-admin-onboarding' ,
    'onboardingi18n',
    array(
      'step_saving_message' => esc_html__( 'Saving...' , 'blahlab-framework' ),
      'step_done_message' => esc_html__( 'Done!' , 'blahlab-framework' )
    )
  ); // Onboarding localization

  wp_localize_script('blahlab-framework-asset' . '-admin-application', 'builder_templates', blahlab_get_builder_templates());

  wp_enqueue_media();

}


add_action('admin_footer', 'blahlab_admin_print_scripts');
// add_action('customize_controls_print_scripts', 'blahlab_admin_print_scripts');
add_action('customize_controls_print_footer_scripts', 'blahlab_admin_print_scripts');
function blahlab_admin_print_scripts() {

  $dir = plugin_dir_path( __FILE__ );

  global $blahlab_widget_ready;

  include($dir . '/customizer.css.php');
}

add_action('init', 'blahlab_init_metaboxes');

function blahlab_init_metaboxes() {

  blahlab_load_metaboxes();

}

// for classic editor
function blahlab_page_builder_panel() {
  global $post;

  $is_builder_used = in_array( basename( get_page_template() ), blahlab_get_builder_templates() ) ? true : false;

?>
  <div id="blahlab_toggle_builder" class=" <?php echo ( true == $is_builder_used ? '' : 'blahlab-hide' ) ?>">
    <p class="blahlab-excerpt">
      <?php ( 'auto-draft' == $post->post_status ? esc_html_e( 'Click the Start link below to set this page up.' , 'blahlab_framework' ) : esc_html_e( 'You can drag and drop widgets, edit content and tweak the design. Click the link below to see your page come to life.' , 'blahlab_framework' ) ); ?>
    </p>
    <p>
      <a href="<?php echo admin_url() . 'customize.php?url=' . esc_url( get_the_permalink() ); ?>" class="<?php echo ( 'auto-draft' == $post->post_status ? 'disable' : '' ); ?>" id="<?php echo ( isset( $post->ID ) ? 'builder-button-' . $post->ID : 'builder-button-' . rand(0,1) ); ?>">
        <?php ( 'auto-draft' == $post->post_status ? esc_html_e( 'Start' , 'blahlab_framework' ) : esc_html_e( 'Edit Your Page in theme Customizer' , 'blahlab_framework' ) ); ?>
      </a>
    </p>
  </div>
<?php
}

// for block editor
function blahlab_edit_in_customizer() {
  $current_screen = get_current_screen();

  if ( $current_screen->is_block_editor() ) {

    ?>
      <script id="blahlab_gutenberg_edit_in_customizer_button_wrapper" type="text/html">
        <button id="blahlab_gutenberg_edit_in_customizer_button" type="button" class="button"><?php echo __( 'Edit in the Theme Customizer', 'blahlab_framework' ); ?></button>
      </script>
    <?php

  }

}

add_action( 'edit_form_after_title', 'blahlab_page_builder_panel' );
add_action( 'admin_footer', 'blahlab_edit_in_customizer' );

function blahlab_update_page_builder_meta() {
  // Get the Post ID
  $post_id = $_POST['id'];
  // BLAHLAB HACKS
  if( isset($_POST[ 'template' ] ) && in_array( $_POST[ 'template' ], blahlab_get_builder_templates() ) ){
    update_post_meta( $post_id , '_wp_page_template', $_POST[ 'template' ] );
  } else {
    delete_post_meta( $post_id , '_wp_page_template' );
  }
  die("OK");
}

add_action( 'wp_ajax_update_page_builder_meta' , 'blahlab_update_page_builder_meta' );

add_filter( 'template_include', 'blahlab_blog_page_template', 99 );

function blahlab_blog_page_template( $template ) {

  $queried_object = get_queried_object();

  // check property_exists($queried_object, 'ID'), in case you go to a list, e.g. a page for a certain post type

  if (  $queried_object && property_exists($queried_object, 'ID') && $queried_object->ID == get_option('page_for_posts') ) {

    $queried_object_page_template = get_page_template_slug( $queried_object->ID );

    $new_template = locate_template( array( $queried_object_page_template ) );
    if ( '' != $new_template ) {
      return $new_template ;
    }
  }

  return $template;
}

function blahlab_add_ajax() {
  ?>
    <script type="text/javascript">
      var ajaxurl = '<?php echo admin_url("admin-ajax.php"); ?>';
      var templateurl = '<?php echo get_template_directory_uri() ?>';
      var homeurl = '<?php echo home_url("/") ?>';
    </script>
  <?php
}

add_action('wp_head', 'blahlab_add_ajax');

function blahlab_can_do_one_click_setup() {
  $path = get_template_directory() . '/data';

  return is_dir($path) && current_user_can('import') ? true: false;
}

function blahlab_one_click_setup() {
  if ( !blahlab_can_do_one_click_setup() ) {
    return false;
  }
  ob_start();
  blahlab_import_demo_data();
  // sleep(5);
  $log = ob_get_clean();
  die();
}

add_action( 'wp_ajax_blahlab_one_click_setup', 'blahlab_one_click_setup' );

function blahlab_get_theme_options_view_path() {
  return get_template_directory() . '/theme-options/view.php';
}

function blahlab_get_theme_options_defaults_path() {
  return get_template_directory() . '/theme-options/defaults.php';
}

/**
*  Make sure that all excerpts have class="excerpt"
*/
function blahlab_excerpt_class( $excerpt ) {
  return str_replace('<p', '<p class="excerpt"', $excerpt);
}
add_filter( "the_excerpt", "blahlab_excerpt_class" );
add_filter( "get_the_excerpt", "blahlab_excerpt_class" );

function blahlab_excerpt_length( $length ) {
  return 30;
}
add_filter( 'excerpt_length', 'blahlab_excerpt_length', 999 );


function blahlab_filter_admin_row_actions( $actions ) {
  global $post;

  $post_type = get_post_type($post);

  $is_page_or_portfolio = in_array($post_type, array('page', 'portfolio'));

  $blahlab_builder_templates = blahlab_get_builder_templates();
  $page_template = get_page_template_slug($post->ID);

  $page_url = get_permalink($post);

  $built_with_blahlab_template = in_array($page_template, $blahlab_builder_templates) || get_post_type($post) == 'portfolio';

  if ( $is_page_or_portfolio && $built_with_blahlab_template && current_user_can('edit_posts', $post->ID) ) {
    $actions['edit_in_theme_customizer'] = sprintf(
      '<a href="%1$s">%2$s</a>',
      blahlab_theme_customizer_page_edit_url($page_url),
      __( 'Edit in theme Customizer', 'blahlab_framework' )
    );
  }

  return $actions;

}

add_filter( 'post_row_actions', 'blahlab_filter_admin_row_actions', 11 );
add_filter( 'page_row_actions', 'blahlab_filter_admin_row_actions', 11 );



function blahlab_debug($it) {
  echo "<pre>";
  var_dump($it);
  echo "</pre>";
}

?>
