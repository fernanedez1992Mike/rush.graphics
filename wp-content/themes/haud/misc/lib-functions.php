<?php

if ( !function_exists('blahlab_haud_value') ) {
  // http://stackoverflow.com/questions/13348996/shorthand-to-check-value-in-array
  // http://stackoverflow.com/questions/1960509/isset-and-empty-make-code-ugly
  // syntax helper
  function blahlab_haud_value(&$var, $key = null, $default = null) {

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

if ( !function_exists('blahlab_haud_join_paths') ) {
  function blahlab_haud_join_paths() {
    $args = func_get_args();

    $paths = array();

    foreach($args as $arg) {
      $paths = array_merge($paths, (array)$arg);
    }

    foreach($paths as &$path) {
      $path = trim($path, '/');
    }

    if (substr($args[0], 0, 1) == '/') {
      $paths[0] = '/' . $paths[0];
    }

    return join('/', $paths);
  }
}

if ( !function_exists('blahlab_haud_get_options') ) {
  function blahlab_haud_get_options( $format = 'array' ) {
    if ( 'raw' == $format ) {
      $options = get_theme_mod( 'theme_options' );
    } else {
      $options = get_theme_mod( 'theme_options' );

      if ( !is_array( $options ) ) {
        $options = json_decode( $options, true );
      }
    }

    return $options;
  }
}

if ( !function_exists('blahlab_haud_get_option') ) {
  function blahlab_haud_get_option($name, $default = false) {
    $options = blahlab_haud_get_options();

    // the key could use the dot operator
    $name = (string)$name;
    $parts = explode('.', $name);
    $parent = $options;

    foreach ($parts as $part) {
      if(is_array($parent) && isset($parent[$part])) {
        $parent = $parent[$part];
        $value = $parent;
      } else {
        $value = $default;
        break;
      }
    }

    return $value;
  }
}

if ( !function_exists('blahlab_haud_theme_slug') ) {
  function blahlab_haud_theme_slug() {
    return get_template();
  }
}

if ( !function_exists('blahlab_haud_custom_comment') ) {
  function blahlab_haud_custom_comment($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    $GLOBALS['args'] = $args;
    $GLOBALS['depth'] = $depth;

    get_template_part('comment');

  }
}

?>