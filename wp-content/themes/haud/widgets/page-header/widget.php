<?php

class Blahlab_PageHeader_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Page Header";
  public $widget_id = 'page-header';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults = array(
    'title' => '',
    'desc' => '',
    'bg_color' => '',
    'bg_image' => ''    
  );

}

add_action( 'wp_ajax_blahlab_widget_ajax_call_to_action', array( 'Blahlab_PageHeader_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_call_to_action', array( 'Blahlab_PageHeader_Widget', 'ajax' ) );


?>