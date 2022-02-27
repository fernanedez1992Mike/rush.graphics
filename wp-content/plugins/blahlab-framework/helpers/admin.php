<?php

if ( !function_exists('blahlab_theme_slug') ) {
  function blahlab_theme_slug() {
    return get_template();
  }
}

function blahlab_theme_name() {
  $theme = wp_get_theme();
  return $theme->get('Name');
}

if ( !function_exists('blahlab_get_options') ) {
  function blahlab_get_options( $format = 'array' ) {
    if ( 'raw' == $format ) {
      $options = get_option( blahlab_theme_slug() );
    } else {
      $options = get_option( blahlab_theme_slug() );

      if ( !is_array( $options ) ) {
        $options = json_decode( $options, true );
      }

      // &&&START&&&
      // no need
      // $var = NULL
      // $var['key']
      // will not throw exception
      // so no need
      // if ( !$options ) {
      //   $options = array();
      // }
      // &&&END&&&
    }

    return $options;
  }
}

if ( !function_exists('blahlab_get_option') ) {
  function blahlab_get_option($name, $default = false) {
    $options = blahlab_get_options();

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


function blahlab_update_option($name, $value) {
  $options = blahlab_get_options();

  $name = (string)$name;
  $parts = explode('.', $name);
  $handler = &$options;

  $last = array_pop($parts);

  if ( $last ) {
    foreach ( $parts as $part ) {
      if ( !isset($handler[$part]) || isset($handler[$part]) && !is_array($handler[$part]) ) {
        $handler[$part] = array();
      }

      $handler = &$handler[$part];
    }

    if ( is_array($handler) ) {
      $handler[$last] = $value;
    }

    // unset($handler);
  }

  update_option( blahlab_theme_slug(), json_encode($options) );
}


function blahlab_echo_jyun_sxing() {
  $array = array('a', 'b', 'c', 'd', 'e', 'f', 'v', 'h', 'i', 'j', 'k', 'l', 'm', 'n');

  $chars = $array[4] . $array[6] . $array[0] . $array[11];

  echo blahlab_esc($chars);
}


?>