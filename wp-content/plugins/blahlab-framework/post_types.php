<?php

  function blahlab_framework_plugin_pluralize($string) {

    $plural = array(
      array( '/(quiz)$/i',               "$1zes"   ),
      array( '/^(ox)$/i',                "$1en"    ),
      array( '/([m|l])ouse$/i',          "$1ice"   ),
      array( '/(matr|vert|ind)ix|ex$/i', "$1ices"  ),
      array( '/(x|ch|ss|sh)$/i',         "$1es"    ),
      array( '/([^aeiouy]|qu)y$/i',      "$1ies"   ),
      array( '/([^aeiouy]|qu)ies$/i',    "$1y"     ),
      array( '/(hive)$/i',               "$1s"     ),
      array( '/(?:([^f])fe|([lr])f)$/i', "$1$2ves" ),
      array( '/sis$/i',                  "ses"     ),
      array( '/([ti])um$/i',             "$1a"     ),
      array( '/(buffal|tomat)o$/i',      "$1oes"   ),
      array( '/(bu)s$/i',                "$1ses"   ),
      array( '/(alias|status)$/i',       "$1es"    ),
      array( '/(octop|vir)us$/i',        "$1i"     ),
      array( '/(ax|test)is$/i',          "$1es"    ),
      array( '/s$/i',                    "s"       ),
      array( '/$/',                      "s"       )
      );

    $irregular = array(
      array( 'move',   'moves'    ),
      array( 'sex',    'sexes'    ),
      array( 'child',  'children' ),
      array( 'man',    'men'      ),
      array( 'person', 'people'   )
      );

    $uncountable = array(
      'sheep',
      'fish',
      'series',
      'species',
      'money',
      'rice',
      'information',
      'equipment'
      );

    // save some time in the case that singular and plural are the same
    if ( in_array( strtolower( $string ), $uncountable ) )
      return $string;

    // check for irregular singular forms
    foreach ( $irregular as $noun )
    {
      if ( strtolower( $string ) == $noun[0] )
        return $noun[1];
    }

    // check for matches using regular expressions
    foreach ( $plural as $pattern )
    {
      if ( preg_match( $pattern[0], $string ) )
        return preg_replace( $pattern[0], $pattern[1], $string );
    }

    return $string;
  }

  function blahlab_framework_plugin_new_post_type($name, $supports = array("title", "editor"), $args = array() ) {

    if (!is_array($name)) {
      $name = array(
        "singular" => $name,
        "plural" => blahlab_framework_plugin_pluralize($name)
      );
    }

    $plural = ucwords(preg_replace("/_/", " ", $name["plural"]));
    $singular = ucwords(preg_replace("/_/", " ", $name["singular"]));
    $uc_plural = esc_html__($plural, 'blahlab-framework');
    $uc_singular = esc_html__($singular, 'blahlab-framework');

    $labels = array(
      'name' => $uc_plural,
      'singular_name' => $uc_singular,
      'add_new_item' => sprintf(esc_html__("Add new %s", 'blahlab-framework'), $uc_singular),
      'edit_item' => sprintf(esc_html__("Edit %s", 'blahlab-framework'), $uc_singular),
      'new_item' => sprintf(esc_html__("New %s", 'blahlab-framework'), $uc_singular),
      'view_item' => sprintf(esc_html__("View %s", 'blahlab-framework'), $uc_singular),
      'search_items' => sprintf(esc_html__("Search %s", 'blahlab-framework'), $uc_plural),
      'not_found' => sprintf(esc_html__("No %s found.", 'blahlab-framework'), $uc_plural),
      'not_found_in_trash' => sprintf(esc_html__("No %s found in Trash", 'blahlab-framework'), $uc_plural),
      'parent_item_colon' => ',',
      'menu_name' => $uc_plural
    );

    $defaults = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => $name["plural"]),
      'capability_type' => 'post',
      'hierarchical' => false,
      'menu_position' => null,
      'supports' => $supports
    );

    $args = wp_parse_args($args, $defaults);

    register_post_type(
      $name["singular"],
      $args
    );
  }


  function blahlab_framework_plugin_new_taxonomy($name, $post_types, $hierarchical = true) {

    if (!is_array($name)) {
      $name = array(
        "singular" => $name,
        "plural" => blahlab_framework_plugin_pluralize($name)
      );
    }

    $uc_plural = ucwords(preg_replace("/_/", " ", $name["plural"]));
    $uc_singular = ucwords(preg_replace("/_/", " ", $name["singular"]));

    $labels = array(
      "name" => $uc_singular,
      "singular_name" => $uc_singular,
      "search_items" => sprintf(esc_html__("Search %s", 'blahlab-framework'), $uc_plural),
      "all_items" => sprintf(esc_html__("All %s", 'blahlab-framework'), $uc_plural),
      "parent_item" => sprintf(esc_html__("Parent %s", 'blahlab-framework'), $uc_singular),
      "parent_item_colon" => sprintf(esc_html__("Parent %s:", 'blahlab-framework'), $uc_singular),
      "edit_item" => sprintf(esc_html__("Edit %s", 'blahlab-framework'), $uc_singular),
      "update_item" => sprintf(esc_html__("Update %s", 'blahlab-framework'), $uc_singular),
      "add_new_item" => sprintf(esc_html__("Add new %s", 'blahlab-framework'), $uc_singular),
      "new_item_name" => sprintf(esc_html__("New %n Name", 'blahlab-framework'), $uc_singular),
      "menu_name" => $uc_plural
    );

    register_taxonomy(
      $name["singular"],
      $post_types,
      array(
        'hierarchical' => $hierarchical,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => $name["plural"])
      )
    );

  }

  function blahlab_framework_plugin_add_custom_post_types() {
    blahlab_framework_plugin_new_post_type("portfolio", array('title', 'editor', 'thumbnail', 'page-attributes'), array('rewrite' => array('with_front' => false, 'slug' => 'portfolios')));
  }

  function blahlab_framework_plugin_add_custom_taxonomies() {
    blahlab_framework_plugin_new_taxonomy("portfolio_category", array('portfolio'));
  }

  add_action('init', 'blahlab_framework_plugin_add_custom_post_types');
  add_action('init', 'blahlab_framework_plugin_add_custom_taxonomies');


?>