<?php

function blahlab_render_view($slug, $locals = array()) {
  global $metabox_variable_names;

  // refer to
  // wp-includes/template.php
  // function locate_template
  // function load_template
  // wp-includes/general-template.php
  // function get_template_part

  if(!$slug) {
    throw new Exception("\$slug should not be empty!");
  }

  $file = blahlab_end_with($slug, '.php') ? $slug : "{$slug}.php";
  $located = locate_template($file);

  if (!$located) {
    // should throw an error
    throw new Exception("View {$file} doesn't exist!");
  } else {
    global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;
    global $blahlab_wp_lorem;

    if ( is_array( $wp_query->query_vars ) )
      extract( $wp_query->query_vars, EXTR_SKIP );

    foreach($metabox_variable_names as $name) {
      global $$name;
    }

    extract($locals);

    include $located;
  }

}

function blahlab_render_module($slug, $locals = array()) {
  blahlab_render_view("modules/$slug", $locals);
}

function blahlab_render_partial($slug, $locals = array()) {
  blahlab_render_view("partials/$slug", $locals);
}


?>