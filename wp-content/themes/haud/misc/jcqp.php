<?php

// misc code for blog

ob_start();
  try {
    the_tags();
    if ( ! isset( $content_width ) ) $content_width = 900;
    unset($content_width);
    paginate_comments_links();
    function comment_reply_enqueue() {
      wp_enqueue_script( "comment-reply" );
      wp_dequeue_script( "comment-reply" );
    }
    wp_link_pages();
    post_class();
    add_theme_support( 'automatic-feed-links' );
  } catch (Exception $e) {

  }
ob_clean();

?>