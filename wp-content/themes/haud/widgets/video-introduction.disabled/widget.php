<?php

class Blahlab_VideoIntroduction_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Video Introduction";
  public $widget_id = 'video-introduction';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults = array(
    'video_url' => '',
    'title' => '',
    'text' => '',
    'small_text' => '',
    'hint_text' => ''
  );

}

?>