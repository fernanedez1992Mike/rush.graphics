<?php

  // define WP_LOAD_IMPORTERS to let the file load the WP_Import class
  if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

  require_once ABSPATH . 'wp-admin/includes/import.php';
  require_once blahlab_join_paths(plugin_dir_path(__FILE__), '../vendor/wordpress-importer/wordpress-importer.php');
  // remove the action to prevent the wordpress-importer plugin from initializing
  // remove_action( 'admin_init', 'wordpress_importer_init' );

  class Blahlab_WP_Import extends WP_Import {

    function __construct() {
      $this->data_path = blahlab_join_paths(get_template_directory(), 'data');
    }

    function do_options() {
      $file = blahlab_join_paths( $this->data_path, 'options.json' );
      if ( file_exists( $file ) ) {
        $options = file_get_contents( $file );
        update_option( blahlab_theme_slug(), $options );
      }
    }

    function do_widgets() {

      $file = blahlab_join_paths( $this->data_path, 'sidebars_widgets.php' );
      if ( file_exists( $file ) ) {
        $sidebars_widgets = include( $file );

        $sidebars_widgets_remapped = array();

        foreach ($sidebars_widgets as $key => $value) {
          $updated_key = $key;

          if ( preg_match('/blahlab-builder-(\d+)(-.*)?/', $key, $matches) ) {

            // get the corresponding post id for widget to import into
            $widget_number = intval($matches[1]);

            // wordpress-importer.php            
            if ( isset($this->processed_posts[$widget_number]) ) {
              $updated_key = "blahlab-builder-" . $this->processed_posts[$widget_number] . $matches[2];
            }
            
          }

          $sidebars_widgets_remapped[$updated_key] = $value;

        }

        update_option( 'sidebars_widgets', $sidebars_widgets_remapped );
      }

      $file = blahlab_join_paths( $this->data_path, 'widgets.php' );
      if ( file_exists( $file ) ) {
        $widgets = include( $file );
        foreach ( $widgets as $widget_slug => $widget_confs ) {

          foreach ($widget_confs as $key => $opts) {

            if ( isset($opts['options']) ) {
              $opts['options'] = blahlab_replace_blahlab_template_url($opts['options']);
              $widget_confs[$key] = $opts;
            }            

          }

          update_option( $widget_slug, $widget_confs );
        }
      }

    }

    function do_mods() {
      $file = blahlab_join_paths( $this->data_path, 'mods.php' );
      if ( file_exists( $file) ) {
        $mods = include( $file );

        $mods['theme_options'] = blahlab_replace_blahlab_template_url($mods['theme_options']);

        update_option( 'theme_mods_' . blahlab_theme_slug() , $mods );
      }
    }

    // &&&START&&&
    // dsafdsaf
    // &&&END&&&

    // import the content.xml file
    function do_content() {

      $file = blahlab_join_paths( $this->data_path, 'content.xml' );
      if ( file_exists( $file) ) {
        $this->import( $file );
      }

    }

    // &&&START&&&
    // the menu term id will be different from the original backup after importing
    // so it need to be fixed
    // otherwise there will be an "Trying to get property of non-object" error
    // on nav-menus.php
    // function setup_menus() {
    //   $locations = get_theme_mod( 'nav_menu_locations' );

    //   $menus = wp_get_nav_menus();

    //   if ( !empty( $menus ) ) {
    //     foreach ( $menus as $menu ) {

    //     }
    //   }

    // }
    // &&&END&&&

  }

?>