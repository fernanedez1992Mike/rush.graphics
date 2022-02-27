<?php


$metabox_variable_names = array();

function blahlab_load_metaboxes() {

  global $metabox_variable_names;

  $metaboxes_path = get_template_directory() . '/metaboxes';

  foreach (glob($metaboxes_path . '/*-view.php') as $view_file) {
    // $specs = include($spec_file);
    $view_file_name_pattern = '/(.*)(-view)(\.php)$/';
    $view_file_name = basename($view_file);
    $spec_file_name = preg_replace($view_file_name_pattern, '$1-spec$3', $view_file_name);
    $spec_file = blahlab_join_paths($metaboxes_path, $spec_file_name);

    $slug = preg_replace($view_file_name_pattern, '$1', $view_file_name);
    $escaped_slug = preg_replace('/-/', '_', $slug);
    $template_name = get_template();
    $humanized_name = ucwords(preg_replace('/_+/', ' ', $escaped_slug));

    // set default options
    $default_options = array(
      'id' => "_${escaped_slug}_meta",
      'title' => "${humanized_name}",
      'template' => $view_file,
      'prefix' => '_' . blahlab_theme_slug() . '_'
    );

    if(file_exists($spec_file)) {
      $specs = (array)include($spec_file);
      $options = array_merge($default_options, $specs);
    } else {
      $options = $default_options;
    }

    // the metabox variable name would be
    $template_name_without_by_honryou = str_replace('-by-honryou', '', $template_name);
    $var_name = "blahlab_${template_name_without_by_honryou}_${escaped_slug}_metabox";

    $metabox_variable_names[] = $var_name;

    // The global keyword lets you access a global variable, not create one.
    // Global variables are the ones created in the outermost scope (i.e. not inside a function or class),
    // and are not accessible inside function unless you declare them with global.
    // http://stackoverflow.com/questions/5355644/declaring-a-global-variable-inside-a-function
    // this will only make it accessible in outermost scope
    // so still need to "global" them in header.php
    global $$var_name;

    require_once plugin_dir_path(__FILE__) . "../classes/blahlab_wp_metabox.php";
    // to fix
    // HTML Parsing Error: Unable to modify the parent container element before the child element is closed (KB927917)
    // in IE8
    remove_action('admin_footer', array('WPAlchemy_MetaBox', '_global_foot'));

    $$var_name = new Blahlab_WP_MetaBox($options);

    // blahlab_dump($$var_name);
  }
}


function blahlab_export_demo_data( $path = null ) {
  if ( !$path ) {
    $path = blahlab_join_paths(get_template_directory(), 'data');
  }

  if ( !is_dir($path) ) {
    mkdir($path);
  }

  // export sidebars widgets
  $sidebars_widgets = get_option( 'sidebars_widgets' );
  unset( $sidebars_widgets['wp_inactive_widgets'] );
  $sidebars_widgets = blahlab_reformat( var_export( $sidebars_widgets, true ) );
  $code = <<<EOF
<?php

return {$sidebars_widgets};

?>
EOF;
  file_put_contents( blahlab_join_paths( $path, 'sidebars_widgets.php' ), $code );

  // export theme mods
  $mods = get_option( 'theme_mods_' . blahlab_theme_slug() );
  unset( $mods['nav_menu_locations'] );
  $mods = blahlab_reformat( var_export( $mods, true ) );
  $code = <<<EOF
<?php

return {$mods};

?>
EOF;
  file_put_contents( blahlab_join_paths( $path, 'mods.php' ), $code );

  // export theme options
  // $code = blahlab_get_options( 'raw' );
  // file_put_contents( blahlab_join_paths( $path, 'options.json' ), $code );

  // export content to content.xml
  require_once( ABSPATH . 'wp-admin/includes/export.php' );
  ob_start();
  export_wp();
  $content = ob_get_clean();
  if ( function_exists( 'blahlab_sanitize_content_export' ) ) {
    $content = blahlab_sanitize_content_export( $content );
  }
  file_put_contents( blahlab_join_paths( $path, 'content.xml' ), $content );

  // export widgets by iterate through all widgets
  // and save them to widgets.php
  // see wp-includes/widgets.php for details
  global $wp_registered_widgets;
  $widgets = array();
  $done = array();
  foreach ( $wp_registered_widgets as $widget ) {
    $option_name = $widget['callback'][0]->option_name;
    if ( in_array( $option_name, $done ) ) {
      continue;
    }
    $options = get_option( $option_name, 'NA' );
    if ( $options != 'NA' ) {
      $widgets[$option_name] = $options;
    }
  }

  if ( function_exists( 'blahlab_sanitize_widgets_export' ) ) {
    $widgets = blahlab_sanitize_widgets_export( $widgets );
  }

  $widgets = blahlab_reformat( var_export( $widgets, true ) );
  // $widgets = var_export( $widgets, true );
  $code = <<<EOF
<?php

return {$widgets};

?>
EOF;

  file_put_contents( blahlab_join_paths( $path, 'widgets.php' ), $code );


}

function blahlab_reformat($code) {
  $code = preg_replace('/=>\s*\n\s*/', '=> ', $code);
  $code = preg_replace('/\n/', "\n  ", $code);
  // replace windows line ending with unix line ending
  $code = preg_replace('/\r\n/', "\n", $code);
  return $code;
}

function blahlab_import_demo_data() {

  global $wp_import;

  require_once blahlab_join_paths(plugin_dir_path(__FILE__), '../classes/blahlab_wp_import.php');

  $wp_import = new Blahlab_WP_Import();
  // set fetch_attachments to false to make the import fast, but the featured images, e.g. for blog
  // post will not be imported
  // set fetch_attachments to true will work flawlessly, it has been tested
  $wp_import->fetch_attachments = true;

  // content.xml import must come first other import may depend on the ids it created
  add_filter( 'wp_import_post_data_raw', 'blahlab_wp_import_post_data_raw_filter' );
  $wp_import->do_content();
  remove_filter( 'wp_import_post_data_raw', 'blahlab_wp_import_post_data_raw_filter' );

  // $wp_import->do_options();
  $wp_import->do_widgets();
  $wp_import->do_mods();

}

function blahlab_replace_blahlab_template_url($url) {
  return str_replace('BLAHLAB_TEMPLATE_URL', blahlab_get_template_uri(), $url);
}

function blahlab_get_template_uri() {
  $parts = parse_url(get_template_directory_uri());
  $template_uri = $parts['host'] . rtrim($parts['path'], '/');

  return $template_uri;
}


function blahlab_wp_import_post_data_raw_filter($post) {

  $attrs = array(
    'attachment_url',
    'post_content'
  );

  foreach ($attrs as $attr) {
    if ( isset($post[$attr]) ) {
      $post[$attr] = blahlab_replace_blahlab_template_url($post[$attr]);
    }
  }

  require_once plugin_dir_path(__FILE__) . "../classes/blahlab_wp_dump_replacer.php";

  $replacer = new Blahlab_WP_Dump_Replacer( 'BLAHLAB_TEMPLATE_URL', blahlab_get_template_uri() );

  if ( isset($post['postmeta']) ) {
    foreach ( (array)$post['postmeta'] as $key => $meta ) {      

      $meta['value'] = $replacer->execute($meta['value']);

      // var_dump($meta);
      // var_dump($key);

      $post['postmeta'][$key] = $meta;      

    }
  }


  return $post;
}

?>