<?php

  class Blahlab_BlogPosts_Widget extends Blahlab_Vue_Widget {
    public $widget_title = "Blog Posts";
    public $widget_id = "blog-posts";

    public $defaults = array(

    );

    public static function ajax() {

      $widget = new Blahlab_BlogPosts_Widget();

      if ( 'load_more_posts' == $_POST['widget_action'] ) {

        query_posts(array(
          'post_type' => 'post',
          'paged' =>  $_POST['page']
        ));

        if (have_posts()) {
          ob_start();
          include(blahlab_join_paths($widget->root, 'partials', 'posts.php'));
          $posts = ob_get_clean();
        } else {
          $posts = NULL;
        }



        $ret = array();
        $ret['posts'] = $posts;
        $ret['page'] = intval($_POST['page']) + 1;

        echo json_encode($ret);

      }

      die();

    }

  }

  add_action( 'wp_ajax_blahlab_widget_ajax_blog_posts', array( 'Blahlab_BlogPosts_Widget', 'ajax' ) );
  add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_blog_posts', array( 'Blahlab_BlogPosts_Widget', 'ajax' ) );


?>