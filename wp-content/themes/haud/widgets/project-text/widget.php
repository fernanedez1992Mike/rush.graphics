<?php

class Blahlab_ProjectText_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Project Text";
  public $widget_id = 'project-text';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults = array(
    'title' => '',
    'title_style' => '',
    'text' => '',
    'position' => '',
    'bg_color' => '',
    'no_top_space' => '',
    'no_bottom_space' => ''
  );

}

?>