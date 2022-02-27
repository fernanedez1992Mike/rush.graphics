<?php

  function blahlab_esc($var) {
    return $var;
  }

  function blahlab_get_builder_templates() {

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

  function blahlab_get_builder_pages() {
    $pages = get_posts(array(
      'post_status' => 'publish,draft,private',
      'post_type' => 'page',
      'meta_query' => array(
        array(
          'key' => '_wp_page_template',
          'value' => blahlab_get_builder_templates(),
          'compare' => 'IN'
        )
      ),
      'posts_per_page' => -1
    ));

    $blog_pages = get_posts(array(
      'post_status' => 'publish,draft,private',
      'post_type' => 'page',
      'meta_key' => '_wp_page_template',
      'meta_value' => "blog.php",
      'posts_per_page' => -1
    ));

    $portfolio_pages = blahlab_latest_posts_of_type('portfolio');

    // var_dump(array_merge($pages, $blog_pages));

    return array_merge($pages, $blog_pages, $portfolio_pages);
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


  if ( !function_exists('blahlab_join_paths') ) {
    function blahlab_join_paths() {
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

  function blahlab_wpgethttp( $url, $file_path = false, $red = 1 ) {

    @set_time_limit( 60 );

    if ( $red > 5 )
      return false;

    $options = array();
    $options['redirection'] = 5;

    if ( false == $file_path )
      $options['method'] = 'HEAD';
    else
      $options['method'] = 'GET';

    $response = wp_safe_remote_request( $url, $options );

    if ( is_wp_error( $response ) )
      return false;

    $headers = wp_remote_retrieve_headers( $response );
    $headers['response'] = wp_remote_retrieve_response_code( $response );

    // WP_HTTP no longer follows redirects for HEAD requests.
    if ( 'HEAD' == $options['method'] && in_array($headers['response'], array(301, 302)) && isset( $headers['location'] ) ) {
      return blahlab_wpgethttp( $headers['location'], $file_path, ++$red );
    }

    if ( false == $file_path )
      return $headers;

    // GET request - write it to the supplied filename
    $out_fp = fopen($file_path, 'w');
    if ( !$out_fp )
      return $headers;

    fwrite( $out_fp,  wp_remote_retrieve_body( $response ) );
    fclose($out_fp);
    clearstatcache();

    return $headers;
  }

?>