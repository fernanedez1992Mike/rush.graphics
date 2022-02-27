<?php

class Blahlab_Testimonials_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Testimonials";
  public $widget_id = 'testimonials';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults = array(
    'title' => '',
    'testimonials' => array(
      array( 'quote' => '', 'author' => '', 'position' => '' ),
      array( 'quote' => '', 'author' => '', 'position' => '' ),
      array( 'quote' => '', 'author' => '', 'position' => '' )
    )
  );

}

add_action( 'wp_ajax_blahlab_widget_ajax_testimonials', array( 'Blahlab_Testimonials_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_testimonials', array( 'Blahlab_Testimonials_Widget', 'ajax' ) );


?>