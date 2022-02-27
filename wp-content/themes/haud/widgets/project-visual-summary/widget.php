<?php

class Blahlab_ProjectVisualSummary_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Project Visual Summary";
  public $widget_id = 'project-visual-summary';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults = array(
    'big_image' => '',
    'small_image' => '',
    'bg_text' => ''
  );

}

?>