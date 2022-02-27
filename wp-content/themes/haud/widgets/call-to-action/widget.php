<?php

class Blahlab_CallToAction_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Call To Action";
  public $widget_id = 'call-to-action';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults = array(
    'title' => '',
    'sub_title' => '',
    'url' => '',
    'bg_color' => '',
    'text_color' => '#000000'
  );

}

add_action( 'wp_ajax_blahlab_widget_ajax_call_to_action', array( 'Blahlab_CallToAction_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_call_to_action', array( 'Blahlab_CallToAction_Widget', 'ajax' ) );


?>