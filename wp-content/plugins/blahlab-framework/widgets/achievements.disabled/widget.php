<?php

class Blahlab_Achievements_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Achievements";
  public $widget_id = 'achievements';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';


  public $defaults = array(
    'title' => '',
    'desc' => '',
    'bg' => '',
    'achievements' => array(
      array('title' => '', 'number' => '', 'icon' => ''),
      array('title' => '', 'number' => '', 'icon' => ''),
      array('title' => '', 'number' => '', 'icon' => '')
    )
  );

}

add_action( 'wp_ajax_blahlab_widget_ajax_achievements', array( 'Blahlab_Achievements_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_achievements', array( 'Blahlab_Achievements_Widget', 'ajax' ) );

?>