<?php

class Blahlab_Skills_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Skills";
  public $widget_id = 'skills';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults = array(
    'title' => '',
    'bg' => '',
    'skills' => array(
      array( 'title' => '', 'percent' => '' ),
      array( 'title' => '', 'percent' => '' ),
      array( 'title' => '', 'percent' => '' )
    )
  );

}

add_action( 'wp_ajax_blahlab_widget_ajax_skills', array( 'Blahlab_Skills_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_skills', array( 'Blahlab_Skills_Widget', 'ajax' ) );


?>