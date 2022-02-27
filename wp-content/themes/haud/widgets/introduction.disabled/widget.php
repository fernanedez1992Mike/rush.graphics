<?php

class Blahlab_Introduction_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Introduction";
  public $widget_id = 'introduction';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults = array(
    'title' => '',
    'text' => '',
    'hint_text' => array(
      'normal' => '',
      'touch' => ''
    ),
    'button' => array(
      'text' => '',
      'url' => ''
    )
  );

}

?>