<?php

class Blahlab_ProjectImage_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Project Image";
  public $widget_id = 'project-image';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults = array(
    'image' => '',
    'bg_color' => '',
    'no_top_space' => '',
    'no_bottom_space' => '',
    'full' => false
  );

}

?>