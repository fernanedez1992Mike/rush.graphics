<?php

class Blahlab_ProjectColorPalette_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Project Color Palette";
  public $widget_id = 'project-color-palette';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';


  public $defaults = array(
    'title' => '',
    'colors' => array(
      array( 'bg_color' => '', 'text_color' => '' ),
      array( 'bg_color' => '', 'text_color' => '' ),
      array( 'bg_color' => '', 'text_color' => '' ),
      array( 'bg_color' => '', 'text_color' => '' )
    )
  );

}

?>