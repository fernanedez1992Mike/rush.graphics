<?php

class Blahlab_Process_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Process";
  public $widget_id = 'process';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';
  
  public $defaults = array(
    'introductions' => array(
      array( 'title' => '', 'text' => '', 'small_text' => '' )
    ),
    'steps' => array(
      array( 'title' => '', 'desc' => '' ),
      array( 'title' => '', 'desc' => '' ),
      array( 'title' => '', 'desc' => '' )
    ),
    'hint_text' => array(
      'normal' => '',
      'touch' => ''
    )
  );

}

?>