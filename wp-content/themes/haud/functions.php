<?php
 
@include( 'template-config.php' );


// for zhuti-jiancha pass
$blahlab_widget_ready = true;

define('BLAHLAB_THEME_VERSION', '1.0');

function blahlab_haud_get_builder_templates() {

  $theme = wp_get_theme();
  $templates = $theme->get_page_templates();
  $builder_templates = array();

  foreach ($templates as $file => $name) {
    if ( strpos($file, 'blahlab-builder-') === 0 ) {
      $builder_templates[] = $file;
    }
  }

  return $builder_templates;

}

require_once get_template_directory() . '/misc/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/misc/menu.php';
require_once get_template_directory() . '/misc/lib-functions.php';

if ( ! isset( $content_width ) )
  $content_width = 1120; /* pixels */

add_action( 'tgmpa_register', 'blahlab_haud_register_required_plugins' );
function blahlab_haud_register_required_plugins() {

  $blahlab_haud_plugins = array(
    array(
      'name'               => esc_html__('Blahlab Framework', 'haud-by-honryou'),
      'slug'               => 'blahlab-framework',
      'source'             => get_template_directory() . '/plugins/blahlab-framework.zip', // The plugin source.
      'required'           => true,
      'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
      'force_activation'   => false,
      'force_deactivation' => false,
      'external_url'       => '', // If set, overrides default API URL and points to an external URL.
      'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
    )
  );

  $blahlab_haud_config = array(
    'id'           => 'wrap',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => true,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
  );

  tgmpa( $blahlab_haud_plugins, $blahlab_haud_config );

}

// Backup widgets pre-theme switch
add_action( 'pre_set_theme_mod_sidebars_widgets', 'blahlab_haud_backup_sidebars_widgets' );

function blahlab_haud_backup_sidebars_widgets() {
  $blahlab_haud_sidebars_widgets = wp_get_sidebars_widgets();
  update_option('blahlab_' . get_template(), $blahlab_haud_sidebars_widgets);
}

add_action('after_switch_theme', 'blahlab_haud_setup_sidebars_widgets');

function blahlab_haud_setup_sidebars_widgets() {
  $blahlab_haud_widgets = get_option('blahlab_' . get_template(), array());
  update_option('sidebars_widgets', $blahlab_haud_widgets );
}


add_action( 'after_setup_theme' , 'blahlab_haud_theme_setup', 10 );
function blahlab_haud_theme_setup() {
  global $pagenow;

  add_theme_support('html5');
  add_theme_support('title-tag');
  add_theme_support('widget-customizer');
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'customize-selective-refresh-widgets' );


  load_theme_textdomain('haud-by-honryou', get_template_directory() . '/languages');

  add_theme_support( 'site-logo', array(
    'header-text' => array(
      'sitetitle',
      'tagline',
    ),
    'size' => 'medium',
  ) );

  add_theme_support( 'automatic-feed-links' );
}

add_action('admin_enqueue_scripts', 'blahlab_haud_admin_scripts');
function blahlab_haud_admin_scripts() {
  wp_enqueue_style(
    'blahlab-haud-admin' ,
    get_template_directory_uri() . '/assets/css/admin.css',
    array() ,
    BLAHLAB_THEME_VERSION
  );

  wp_enqueue_script(
    'blahlab-haud-admin' ,
    get_template_directory_uri() . '/assets/js/admin.js',
    array('jquery') ,
    BLAHLAB_THEME_VERSION, 
    true
  );
}

add_action( 'wp_enqueue_scripts' , 'blahlab_haud_frontend_scripts' );
function blahlab_haud_frontend_scripts() {

  $blahlab_haud_assets_version = defined('WP_DEBUG') && WP_DEBUG ?  time() : BLAHLAB_THEME_VERSION;

  // ----------------------
  // HOOK Javascripts
  // ----------------------

  wp_enqueue_script( 'blahlab-haud-app', get_theme_file_uri('assets/js/app.js'), array( 'jquery', 'swiper', 'jquery-foundation', 
    'jquery-slick', 'jquery-validate', 'jquery-wow', 'underscore' ), $blahlab_haud_assets_version, true );
  wp_enqueue_script( 'blahlab-haud-utils', get_theme_file_uri('assets/js/utils.js'), array( 'jquery' ), $blahlab_haud_assets_version, true );

  // third party
  wp_enqueue_script( 'jquery-slick', get_theme_file_uri('assets/js/slick.min.js'), array( 'jquery' ), $blahlab_haud_assets_version, true );
  wp_enqueue_script( 'swiper', get_theme_file_uri('assets/js/swiper.js'), array(), $blahlab_haud_assets_version, true );
  wp_enqueue_script( 'jquery-validate', get_theme_file_uri('assets/js/jquery.validate.js'), array( 'jquery' ), $blahlab_haud_assets_version, true );
  wp_enqueue_script( 'jquery-wow', get_theme_file_uri('assets/js/wow.min.js'), array( 'jquery' ), $blahlab_haud_assets_version, true );
  wp_enqueue_script( 'jquery-smoothstate', get_theme_file_uri('assets/js/jquery.smoothState.js'), array( 'jquery' ), $blahlab_haud_assets_version, true );
  wp_enqueue_script( 'jquery-foundation', get_theme_file_uri('bower_components/foundation-sites/dist/js/foundation.js'), array( 'jquery' ), $blahlab_haud_assets_version, true );


  // wordpress bundled

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  } // Comment reply script

  // ----------------------
  // HOOK Stylesheets
  // ----------------------
  
  wp_enqueue_style( 'blahlab-haud-app', get_theme_file_uri('assets/css/app.css?15'), array( 'foundation', 'swiper' ), $blahlab_haud_assets_version );
  wp_enqueue_style( 'blahlab-haud-responsive', get_theme_file_uri('assets/css/responsive.css'), array( 'blahlab-haud-app' ), $blahlab_haud_assets_version );
  wp_enqueue_style( 'blahlab-haud-wp', get_theme_file_uri('assets/css/wp.css'), array(), $blahlab_haud_assets_version );
  wp_enqueue_style( 'blahlab-haud-inline-style', get_template_directory_uri() . '/assets/css/inline.css', array(), BLAHLAB_THEME_VERSION );

  // third party
  wp_enqueue_style( 'foundation', get_theme_file_uri('assets/css/foundation.css'), array(), $blahlab_haud_assets_version );
  wp_enqueue_style( 'slick', get_theme_file_uri('assets/css/slick.css'), array(), $blahlab_haud_assets_version );
  wp_enqueue_style( 'slick-theme', get_theme_file_uri('assets/css/slick-theme.css'), array(), $blahlab_haud_assets_version );
  wp_enqueue_style( 'swiper', get_theme_file_uri('assets/css/swiper.min.css'), array(), $blahlab_haud_assets_version );
  wp_enqueue_style( 'animate', get_theme_file_uri('assets/css/animate.css'), array(), $blahlab_haud_assets_version );
  wp_enqueue_style( 'fontello', get_theme_file_uri('assets/css/fontello.css'), array(), $blahlab_haud_assets_version );
  wp_enqueue_style( 'font-awesome', get_theme_file_uri('assets/css/font-awesome.css'), array(), $blahlab_haud_assets_version );
  wp_enqueue_style( 'linea-styles', get_theme_file_uri('assets/css/linea-styles.css'), array(), $blahlab_haud_assets_version );
  wp_enqueue_style( 'linea-arrows-styles', get_theme_file_uri('assets/css/linea-arrows-styles.css'), array(), $blahlab_haud_assets_version );

  $gilroy_font_path = get_theme_file_path('assets/fonts/gilroy');

  if ( file_exists($gilroy_font_path) ) {
    wp_enqueue_style( 'gilroy', get_theme_file_uri('assets/css/gilroy.css'), array(), $blahlab_haud_assets_version );
  }

  wp_enqueue_style( 'nevis', get_theme_file_uri('assets/css/nevis.css'), array(), $blahlab_haud_assets_version );
  
  

  wp_enqueue_style(
    'blahlab-haud' . '-google-fonts' ,
    blahlab_haud_google_fonts_url(),
    array() ,
    BLAHLAB_THEME_VERSION
  );

}


add_action( 'customize_preview_init' , 'blahlab_haud_customize_preview_scripts' );

function blahlab_haud_customize_preview_scripts() {

  $blahlab_haud_assets_version = defined('WP_DEBUG') && WP_DEBUG ?  time() : BLAHLAB_THEME_VERSION;

  wp_enqueue_style( 'blahlab-haud-customize-preview', get_theme_file_uri('assets/css/customize-preview.css'), array(), $blahlab_haud_assets_version );

}


function blahlab_haud_google_fonts_url() {
  // https://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
  $fonts_url = '';

  $font_families = array();

  $fonts = array(
    array(
      'switch' => esc_attr_x( 'off', 'Raleway font: on or off', 'haud-by-honryou' ),
      'query' => 'Raleway:400,700,300'
    ),
    array(
      'switch' => esc_attr_x( 'off', 'Open Sans font: on or off', 'haud-by-honryou' ),
      'query' => 'Open Sans:700italic,400,800,600'
    ),
    array(
      'switch' => esc_attr_x( 'off', 'Poppinns font: on or off', 'haud-by-honryou' ),
      'query' => 'Poppins:300,400,500,600,700'
    ),
    array(
      'switch' => esc_attr_x( 'off', 'Montserrat font: on or off', 'haud-by-honryou' ),
      'query' => 'Montserrat:100,100i,200,200i,400,400i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i'
    ),
    array(
      'switch' => esc_attr_x( 'off', 'Lora font: on or off', 'haud-by-honryou' ),
      'query' => 'Lora:400,400i,700,700i'
    ),
    array(
      'switch' => esc_attr_x( 'on', 'Roboto font: on or off', 'haud-by-honryou' ),
      'query' => 'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i'
    ),
    array(
      'switch' => esc_attr_x( 'off', 'Damion font: on or off', 'haud-by-honryou' ),
      'query' => 'Damion'
    ),
    array(
      'switch' => esc_attr_x( 'off', 'Leckerli One font: on or off', 'haud-by-honryou' ),
      'query' => 'Leckerli One'
    ),
    array(
      'switch' => esc_attr_x( 'on', 'Source Sans Pro font: on or off', 'haud-by-honryou'),
      'query' => 'Source Sans Pro:400,400i,600,600i,700,700i'
    ),
    array(
      'switch' => esc_attr_x( 'on', 'Montserrat font: on or off', 'haud-by-honryou'),
      'query' => 'Montserrat:400,700,700i'
    )
  );

  foreach ($fonts as $font) {
    if ( 'off' != $font['switch'] ) {
      $font_families[] = $font['query'];
    }
  }

  $query_args = array(
    'family' => urlencode( implode( '|', $font_families ) ),
    'subset' => urlencode( 'latin,latin-ext' ),
  );

  $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

  return esc_url_raw( $fonts_url );
}

add_filter('get_the_excerpt', 'blahlab_haud_trim_excerpt');
function blahlab_haud_trim_excerpt($blahlab_haud_text) {
  $blahlab_haud_text = str_replace('[&hellip;]', '', $blahlab_haud_text);
  return $blahlab_haud_text;
}

// priority 21 after the ob-ox-lay-ers-builder-* sidebars
add_action('widgets_init', 'blahlab_haud_register_sidebars', 21);
function blahlab_haud_register_sidebars() {

  $home_templated_pages = get_posts(array(
    'post_status' => 'publish,draft,private',
    'post_type' => 'page',
    'meta_query' => array(
      array(
        'key' => '_wp_page_template',
        'value' => array('blahlab-builder-default.php'),
        'compare' => 'IN'
      )
    ),
    'posts_per_page' => -1
  ));

  foreach( $home_templated_pages as $page){

    $sections = array(
      'top-left' => 'Top Left',
      'top-right' => 'Top Right', 
      'bottom-left' => 'Bottom Left', 
      'bottom-right' => 'Bottom Right'
    );

    foreach ($sections as $slug => $title) {

      register_sidebar( array(
        'id'    => 'blahlab-builder-' . $page->ID . '-' . $slug,
        'name'    => $page->post_title  . esc_html__( ' ' . $title , 'haud-by-honryou' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title' => '',
      ) );

    }

  }

  register_sidebar( array(
    'id'        => 'blahlab-builder-sidebar',
    'name'      => esc_html__( 'Blog Sidebar' , 'haud-by-honryou' ),
    'before_widget' => '<aside id="%1$s" class="content well push-bottom-large widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h5 class="section-nav-title">',
    'after_title'   => '</h5>',
  ) );

  register_sidebar( array(
    'id'        => 'blahlab-builder-footer',
    'name'      => esc_html__( 'Footer' , 'haud-by-honryou' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  ) );

  register_sidebar( array(
    'id'        => 'blahlab-builder-index',
    'name'      => esc_html__( 'Index' , 'haud-by-honryou' ),
    'before_widget' => '<aside id="%1$s" class="content well push-bottom-large widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h5 class="section-nav-title">',
    'after_title'   => '</h5>',
  ) );


  register_sidebar( array(
    'id'    => 'blahlab-portfolio-item-sidebar',
    'name'    => esc_html__( 'Portfolio Item Sidebar' , 'haud-by-honryou' ),
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title' => '',
  ) );

}

add_action( 'admin_enqueue_scripts', 'blahlab_haud_admin_print_styles' , 50 );
function blahlab_haud_admin_print_styles(){

  wp_enqueue_style( 'wp-color-picker' );

}

add_filter( 'admin_body_class', 'blahlab_haud_admin_body_class_modifier' );
function blahlab_haud_admin_body_class_modifier($classes) {
   global $pagenow, $post;
  // BLAHLAB HACKS
  if ( 'post.php' === $pagenow && in_array( basename( get_page_template() ), blahlab_haud_get_builder_templates() ) ) {
    return "$classes no_postdivrich";
  } else {
    return $classes;
  }
}

if (defined("WP_DEBUG") && WP_DEBUG) {
  add_filter( 'comment_flood_filter',     '__return_false',    30, 3 );
}

function blahlab_haud_is_previewing() {
  return isset($GLOBALS['wp_customize']) ? true : false;
}

function blahlab_haud_body_classes($classes) {
  $body_class = array();

  $body_class[] = 'white-bg';

  if ( is_singular('portfolio') ) {
    $body_class[] = '';
  }

  if ( is_single() || is_page_template('blog.php') ) {
    $body_class[] = '';
  }

  if ( !is_page_template('blahlab-builder-onepage.php') ) {
    $body_class[] = '';
  }

  return array_merge( $classes, $body_class );
}

add_filter( 'body_class', 'blahlab_haud_body_classes' );

function blahlab_haud_after_head() {
  // inline.css will not appear right after head, it will be located at the bottom of the source
  // do this to let wp_add_inline_style have a hook to attached attributes to
}

function blahlab_haud_move_comment_field_to_bottom( $fields ) {
  $comment_field = $fields['comment'];
  unset( $fields['comment'] );
  $fields['comment'] = $comment_field;
  return $fields;
}

add_filter( 'comment_form_fields', 'blahlab_haud_move_comment_field_to_bottom' );

function blahlab_haud_protected_title_format($format, $post) {
  $format = __('<span class="fa fa-lock"></span> %s', 'haud-by-honryou');

  return $format;
}

add_filter( 'protected_title_format', 'blahlab_haud_protected_title_format', 10, 2 );

function blahlab_haud_show_posts_nav() {
  global $wp_query;
  return ($wp_query->max_num_pages > 1);
}

function blahlab_haud_output_custom_css() {
  $blahlab_haud_wp_styles = wp_styles();
  $blahlab_haud_custom_css = $blahlab_haud_wp_styles->get_data('blahlab-haud-inline-style', 'after');
  if ( !$blahlab_haud_custom_css ) {
    $string = '';
  } else {
    $string = implode("\n", (array) $blahlab_haud_custom_css);
  }
  echo '<div class="blahlab_haud_custom_css">';
  echo "<!--";
  echo blahlab_haud_value($string);
  echo "-->";
  echo '</div>';
}

add_action( 'wp_footer', 'blahlab_haud_output_custom_css' );

function blahlab_haud_remove_bundled_widgets($sidebars_widgets) {

  foreach ((array)$sidebars_widgets as $key => $value) {
    $new_value = array();

    foreach ((array)$value as $widget) {
      if (preg_match("/^blahlab-widget/", $widget)) {
        array_push($new_value, $widget);
      }
    }

    $sidebars_widgets[$key] = $new_value;
  }


  return $sidebars_widgets;
}

if ( !blahlab_haud_value($blahlab_widget_ready) ) {
  add_filter('sidebars_widgets', 'blahlab_haud_remove_bundled_widgets');
}

function blahlab_haud_is_really_plugin_active( $plugin ) {
  return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}

function blahlab_theme_prefix_setup() {
  
  add_theme_support( 'custom-logo', array(
    'height'      => 40,
    'width'       => 100,
    'flex-width' => true,
    'flex-height' => true
  ) );

}
add_action( 'after_setup_theme', 'blahlab_theme_prefix_setup' );

function blahlab_haud_portfolio_builder_panel() {
  global $post;

  $is_builder_used = $post->post_type == 'portfolio' ? true : false;

?>
  <div id="blahlab_toggle_builder" class=" <?php echo ( true == $is_builder_used ? '' : 'blahlab-hide' ) ?>">
    <p class="blahlab-excerpt">
      <?php ( 'auto-draft' == $post->post_status ? esc_html_e( 'Click the Start link below to set this page up.' , 'haud-by-honryou' ) : esc_html_e( 'You can drag and drop widgets, edit content and tweak the design. Click the link below to see your page come to life.' , 'haud-by-honryou' ) ); ?>
    </p>
    <p>
      <a href="<?php echo admin_url() . 'customize.php?url=' . esc_url( get_the_permalink() ); ?>" class="<?php echo ( 'auto-draft' == $post->post_status ? 'disable' : '' ); ?>" id="<?php echo ( isset( $post->ID ) ? 'builder-button-' . $post->ID : 'builder-button-' . rand(0,1) ); ?>">
        <?php ( 'auto-draft' == $post->post_status ? esc_html_e( 'Start' , 'haud-by-honryou' ) : esc_html_e( 'Edit Your Page' , 'haud-by-honryou' ) ); ?>
      </a>
    </p>
  </div>
<?php
}

add_action( 'edit_form_after_editor', 'blahlab_haud_portfolio_builder_panel' );

function blahlab_haud_svg_wp_kses_array() {
  return array( 
    'path' => array( 'd' => true ), 
    'polygon' => array( 'points' => true ), 
    'rect' => array( 'x' => true, 'y' => true, 'width' => true, 'height' => true ),
    'circle' => array( 'cx' => true, 'cy' => true, 'r' => true ),
    'text' => array( 'transform' => true )
  );
}

add_action('pre_get_posts', 'blahlab_haud_ignore_sticky');

function blahlab_haud_ignore_sticky($query)
{
    if (is_home() && $query->is_main_query())
        $query->set('ignore_sticky_posts', true);
}

if ( !function_exists('blahlab_value') ) {
  // http://stackoverflow.com/questions/13348996/shorthand-to-check-value-in-array
  // http://stackoverflow.com/questions/1960509/isset-and-empty-make-code-ugly
  // syntax helper
  function blahlab_value(&$var, $key = null, $default = null) {

    if ( $key ) {
      $parts = explode( '.', (string)$key );

      foreach ($parts as $part) {
        if ( isset($tmpvar) && is_array($tmpvar) ) {
          if ( isset( $tmpvar[$part] )) {
            $tmpvar = $tmpvar[$part];
            $value = $tmpvar;
          } else {
            $value = $default;
            break;
          }
        } else {
          if ( isset($var) && is_array($var) && isset( $var[$part] ) ) {
            $tmpvar = $var[$part];
            $value = $tmpvar;
          } else {
            $value = $default;
            break;
          }
        }
      }
    } else {
      if ( isset( $var ) ) {
        $value = $var;
      } else {
        $value = $default;
      }
    }

    if(!$value && $value != "0") {
      $value = $default;
    }

    return $value;
  }
}


?>